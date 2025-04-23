<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login request
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Attempt login
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended('/dashboard');  // Redirect to a protected page
        }

        // Authentication failed
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    // Show the register form
    public function showRegisterForm()
    {
        return view('auth.login');
    }

    // Handle registration request
    public function register(Request $request)
    {
        $hire_date = now();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'hire_date' => $hire_date,

        ]);

        return view('auth.login')->with('success', 'Registration successful! You can now login.');
        
    }

    // Logout the user
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }


//     public function handle($request, Closure $next)
// {
//     if (Auth::guest()) {
//         return redirect()->route('login');
//     }

//     return $next($request);
// }
}