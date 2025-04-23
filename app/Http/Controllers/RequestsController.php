<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StationeryRequest;
use App\Models\Inventory;
use App\Models\StockReport;
use Illuminate\Support\Facades\Auth;

class RequestsController extends Controller
{
    // Store the form data in the database
    public function store(Request $request)
    {
        // Validate the form input
        $validated = $request->validate([
            'item_name' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'requested_by' => 'required|string',
        ]);
    
        // Store the data in the requests table
        StationeryRequest::create([
            'item_name' => $validated['item_name'],
            'quantity' => $validated['quantity'],
            'requested_by' => $validated['requested_by'],
            'request_date' => now(), // Store the current date and time
        ]);
    
        // Redirect with success message
        return redirect('stationery')->with('success', 'Request submitted successfully!');
    }

    public function approve($id)
    {
        $request = StationeryRequest::findOrFail($id);
    
        if ($request->status === 'Approved') {
            return redirect('stationery')->with('error', 'This request has already been approved.');
        }
    
        $inventory = Inventory::where('item_name', $request->item_name)->first();
    
        if (!$inventory) {
            return redirect('stationery')->with('error', 'Item not found in inventory.');
        }
    
        if ($inventory->balance < $request->quantity) {
            return redirect('stationery')->with('error', 'Not enough stock to fulfill the request.');
        }
    
        $stockBefore = $inventory->balance;
        $newBalance = $stockBefore - $request->quantity;
    
        // Update Inventory balance
        $inventory->update([
            'stock_before' => $stockBefore,
            'balance' => $newBalance,
            'updated_at' => now(),
        ]);
    
        // Approve the request
        $request->update([
            'status' => 'Approved',
            'approved_by' => Auth::user()->name,
            'approved_date' => now(),
        ]);
    
        // Record in StockReport
        StockReport::create([
            'item_name' => $request->item_name,
            'requested_quantity' => $request->quantity,
            'stock_before' => $stockBefore,
            'balance' => $newBalance,
            'requested_by' => $request->requested_by,
            'approved_by' => Auth::user()->name,
            'approved_date' => now(),
            'applied_date' => $request->request_date,
            'description' => 'Withdrawal - Sabasaba Branch',
            'status' => 'Approved',
        ]);
        return redirect('stationery')->with('success', 'Request approved and inventory updated.');
    }

    // Reject a request
    public function reject($id)
    {
        $request = StationeryRequest::findOrFail($id);

        // Check if the request has already been approved
        if ($request->status === 'Approved') {
            return redirect('stationery')->with('error', 'Approved requests cannot be Rejected.');
        }

        // If not approved, set status to 'Rejected'
        $request->status = 'Rejected';
        $request->save();

        return redirect('stationery')->with('success', 'Request rejected successfully!');
    }

    // Delete a request
    // Destroy a request record (renamed from delete to destroy)
    public function destroy($id)
    {
        $request = StationeryRequest::findOrFail($id);

        // Check if the request has already been approved
        if ($request->status === 'Approved') {
            return redirect('stationery')->with('error', 'Approved requests cannot be deleted.');
        }

        // If not approved, delete the request
        $request->delete();

        return redirect('stationery')->with('success', 'Request deleted successfully!');
    }
}