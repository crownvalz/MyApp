<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Leave;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    // Store a new leave request
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
            'leave_type' => 'required|string',
        ]);

        $validated['status'] = 'Pending';

        Leave::create($validated);

        return redirect('leave')->with('success', 'Leave request submitted!');
    }

    // Delete a Leave (with check on status)
    public function destroy($id)
    {
        $Leave = Leave::findOrFail($id);

        if ($Leave->status === 'Approved') {
            return redirect('leave')->with('error', 'Approved requests cannot be deleted.');
        }

        $Leave->delete();

        return redirect('leave')->with('success', 'Request deleted successfully!');
    }


    // Approve a Leave
    public function approve($id)
    {
        $Leave = Leave::findOrFail($id);

        if ($Leave->status === 'Approved') {
            return redirect('leave')->with('error', 'Request is already Approved and cannot be resubmitted.');
        }

        $Leave->status = 'Approved';
        $Leave->save();

        return redirect('leave')->with('success', 'Request Approved successfully!');
    }

    // Reject a Leave
    public function reject($id)
    {
        $Leave = Leave::findOrFail($id);

        if ($Leave->status === 'Approved') {
            return redirect('leave')->with('error', 'Approved requests cannot be rejected.');
        }

        $Leave->status = 'rejected';
        $Leave->save();

        return redirect('leave')->with('success', 'Request rejected successfully!');
    }


    public function update(Request $request, $id)
    {
        // Find the leave entry by ID
        $leave = Leave::findOrFail($id);
    
        // Check if the leave status is 'Approved'
        if ($leave->status === 'Approved') {
            return redirect('leave')->with('error', 'Approved leave requests cannot be edited.');
        }
    
        // Validate the incoming data
        $validated = $request->validate([
            'leave_type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required|string',
        ]);
    
        // Update the leave entry
        $leave->leave_type = $validated['leave_type'];
        $leave->start_date = $validated['start_date'];
        $leave->end_date = $validated['end_date'];
        $leave->status = $validated['status'];
        $leave->save();
    
        return redirect('leave')->with('success', 'Leave request updated successfully!');
    }
}