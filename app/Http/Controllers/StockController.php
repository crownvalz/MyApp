<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\StockReport;
use App\Models\StockLog;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'item_name' => 'required|string|max:255',
            'supplier' => 'required|string|max:255',
            'unit_price' => 'required|numeric|min:0',
            'restocked_quantity' => 'required|numeric|min:0',
            'requested_by' => 'required|string|max:255',
        ]);
    
        $item = Inventory::firstOrNew(['item_name' => $data['item_name']]);
    
        $item->fill(array_merge($data, [
            'description' => 'Replenishment',
            'status' => 'Pending',
            'approved_by' => null,
            'approved_date' => null,
            'applied_date' => now(),
        ]))->save();
    
        // Save the same information into StockLog
        StockLog::create([
            'item_name' => $data['item_name'],
            'supplier' => $data['supplier'],
            'unit_price' => $data['unit_price'],
            'stock_quantity' => $data['restocked_quantity'],
            'requested_by' => $data['requested_by'],
            'log_date' => now(), // assuming you have a log_date column
            'status' => 'Pending', // optionally track status in logs too
            'description' => 'Replenishment',
        ]);
    
        return back()->with('success', $item->wasRecentlyCreated
            ? 'New item added and restock request submitted.'
            : 'Existing item updated with new restock request.');
    }

    public function approve($id)
    {
        $item = Inventory::findOrFail($id);

        if ($item->status === 'Approved') {
            return back()->with('error', 'This item is already approved.');
        }

        $last = StockReport::where('item_name', $item->item_name)->latest()->first();
        $before = $last->balance ?? 0;
        $quantity = $item->restocked_quantity;
        $balance = $before + $quantity;

        $item->update([
            'approved_by' => Auth::user()->name,
            'status' => 'Approved',
            'approved_date' => now(),
            'stock_before' => $before,
            'balance' => $balance,
        ]);

        StockReport::create([
            'stock_before' => $before,
            'requested_quantity' => $quantity,
            'balance' => $balance,
            'item_name' => $item->item_name,
            'requested_by' => $item->requested_by,
            'description' => 'Replenishment',
            'approved_by' => Auth::user()->name,
            'approved_date' => now(),
            'status' => 'Approved',
        ]);
        $log = StockLog::where('item_name', $item->item_name)->latest()->first(); // or use ->find($id)

        if ($log) {
            $log->update([
                'approved_by' => Auth::user()->name,
                'approved_date' => now(),
                'status' => 'Approved',
            ]);
        }
        Inventory::where('item_name', $item->item_name)
            ->where('id', '!=', $item->id)
            ->update([
                'stock_before' => $before,
                'restocked_quantity' => $quantity,
                'balance' => $balance,
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Item approved and inventory updated.');
    }

    public function reject($id)
    {
        $item = Inventory::findOrFail($id);

        if ($item->status === 'Approved') {
            return back()->with('error', 'Already approved; cannot reject.');
        }

        if ($item->requested_by === Auth::user()->name) {
            return back()->with('error', 'You cannot reject your own request.');
        }

        $item->update([
            'approved_by' => 'Rejected',
            'status' => 'Rejected',
            'approved_date' => now(),
        ]);

        return back()->with('warning', 'Request rejected.');
    }

    public function destroy($id)
    {
        $item = Inventory::findOrFail($id);

        if ($item->status === 'Approved') {
            return back()->with('error', 'Approved requests cannot be deleted.');
        }

        if ($item->requested_by !== Auth::user()->name) {
            return back()->with('error', 'Only your own requests can be deleted.');
        }

        $item->delete();
        return back()->with('error', 'Request deleted.');
    }
}
