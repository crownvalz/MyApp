<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\LeaveController;
use App\Http\Controllers\RequestsController;



use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;



Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->get('/home', [HomeController::class, 'index'])->name('home');



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// =================== Employee Routes ===================
Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index'); // Show all employees
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store'); // Store a new employee
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy'); // Delete an employee by ID

// =================== Leave Routes ===================
Route::delete('/leave/{id}', [LeaveController::class, 'destroy'])->name('leave.destroy'); // Delete a leave request by ID
Route::put('/leaves/{id}/approve', [LeaveController::class, 'approve'])->name('leave.approve'); // Approve a leave request
Route::put('/leaves/{id}/reject', [LeaveController::class, 'reject'])->name('leave.reject'); // Reject a leave request
Route::get('/leaves', [LeaveController::class, 'index'])->name('leaves.index'); // Show all leave requests
Route::post('/leaves', [LeaveController::class, 'store'])->name('leaves.store'); // Store a new leave request

// =================== Requests Routes ===================
Route::delete('/requests/{id}', [RequestsController::class, 'destroy'])->name('requests.destroy'); // Delete a request by ID
Route::put('/requests/{id}/approve', [RequestsController::class, 'approve'])->name('requests.approve'); // Approve a request
Route::put('/requests/{id}/reject', [RequestsController::class, 'reject'])->name('requests.reject'); // Reject a request
Route::get('/requests', [RequestsController::class, 'index'])->name('requests.index'); // Show all requests
Route::post('/requests', [RequestsController::class, 'store'])->name('requests.store'); // Store a new request

// =================== Home Route ===================
Route::get('/home', [HomeController::class, 'index'])->name('home.index'); // Show the home page with employee details

// =================== Auth  Route===================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// =================== Root Route ===================
Route::get('/', function () {
    return view('welcome');
}); // Show the welcome page
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');











require __DIR__.'/auth.php';