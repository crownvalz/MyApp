<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sadaka;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SadakaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'note' => 'nullable|string|max:1000',
        ]);

        // Save sadaka record
        $sadaka = Sadaka::create([
            'category' => $request->category,
            'amount' => $request->amount,
            'note' => $request->note,
        ]);

        $user = Auth::user(); // Get the authenticated user

        // Send payment request to TigoPesa API (Simulated)
        $response = Http::post('https://api.tigopesa.co.tz/stkpush', [
            'phone' => $user->phone, // Make sure user has a 'phone' field
            'amount' => $request->amount,
            'reference' => 'Sadaka-' . $sadaka->id,
            'description' => 'Church Offering - ' . $request->category,
            'callback_url' => route('sadaka.callback'),
        ]);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Enter TigoPesa PIN to confirm payment.');
        } else {
            return redirect()->back()->with('error', 'Failed to initiate TigoPesa payment.');
        }
    }
    
}