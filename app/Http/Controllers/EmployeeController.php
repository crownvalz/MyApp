<?php

// EmployeeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class EmployeeController extends Controller
{
    // Display the list of employees
    public function index()
    {
        return redirect('staff');
    }

    // Store a new employee
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
        ]);

        User::create($request->all());
        return redirect('staff')->with('success', 'Employee added successfully!');
    }




    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        $data = $request->except(['_token', '_method', 'profile_pic']);
    
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename); // Move to public/img
            $data['profile_pic'] = $filename; // Save filename only
        }
    
        $user->update($data);
    
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }



    // Delete an employee
    public function destroy($id)
    {
        $staff = User::findOrFail($id);
        $staff->delete();
        return redirect('staff')->with('success', 'Employee deleted successfully');
    }


    // Reset (Activate) user account
    public function resetUser($id)
    {
        $user = User::findOrFail($id);
        if ($user->status === 'Active') {
            return redirect('staff')->with('error', 'User is already active.');
        }
        $user->status = 'Active';
        $user->save();
        return redirect('staff')->with('success', 'User reset successfully!');
    }



        // Reset (Activate) user account
        public function blockUser($id)
        {
            $user = User::findOrFail($id);
            if ($user->status === 'Blocked') {
                return redirect('staff')->with('error', 'User is already Blocked.');
            }
            $user->status = 'Blocked';
            $user->save();
            return redirect('staff')->with('success', 'User reset successfully!');
        }

        // Approve user account
        public function ApproveUser($id)
        {
            $user = User::findOrFail($id);
            $user->status = 'Approved';
            $user->save();
            return redirect('staff')->with('success', 'User reset successfully!');
        }
}