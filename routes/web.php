<?php

use Illuminate\Support\Facades\{Route, Auth};
use App\Http\Controllers\{HomeController, LeaveController, ExcelQueryController, 
    RequestsController, AuthController, EmployeeController, StockController, SadakaController};
use Illuminate\Support\Facades\File;

// =================== Employee Routes ===================
Route::middleware('auth')->group(function () {
    Route::view('/staff', 'staff'); // Staff page
    Route::post('/staff', [EmployeeController::class, 'store'])->name('staff.store'); // Add employee
    Route::delete('/staff/{id}', [EmployeeController::class, 'destroy'])->name('staff.destroy'); // Delete employee
    Route::put('/staff/{id}', [EmployeeController::class, 'update'])->name('staff.update'); // Update employee
    Route::put('/staff/reset/{id}', [EmployeeController::class, 'resetUser'])->name('staff.reset'); // Reset user password
    Route::put('/staff/block/{id}', [EmployeeController::class, 'blockUser'])->name('staff.block'); // Block user
    Route::put('/staff/{id}/approve', [EmployeeController::class, 'ApproveUser'])->name('staff.approve'); // Approve user

    // =================== Leave Routes ===================
    Route::view('/leave', 'leave'); // Leave page
    Route::post('/leave', [LeaveController::class, 'store'])->name('leaves.store'); // Submit leave
    Route::put('/leave/{id}', [LeaveController::class, 'update'])->name('leave.update'); // Update leave
    Route::delete('/leave/{id}', [LeaveController::class, 'destroy'])->name('leave.destroy'); // Delete leave
    Route::put('/leave/{id}/approve', [LeaveController::class, 'approve'])->name('leave.approve'); // Approve leave
    Route::put('/leave/{id}/reject', [LeaveController::class, 'reject'])->name('leave.reject'); // Reject leave

    // =================== Requests Routes ===================
    Route::get('/requests', [RequestsController::class, 'index'])->name('requests.index'); // View requests
    Route::post('/requests', [RequestsController::class, 'store'])->name('requests.store'); // Submit request
    Route::delete('/requests/{id}', [RequestsController::class, 'destroy'])->name('requests.destroy'); // Delete request
    Route::put('/requests/{id}/approve', [RequestsController::class, 'approve'])->name('requests.approve'); // Approve request
    Route::put('/requests/{id}/reject', [RequestsController::class, 'reject'])->name('requests.reject'); // Reject request

    // =================== Stock Routes ===================
    Route::post('/stock', [StockController::class, 'store'])->name('stock.store'); // Add stock
    Route::delete('/stock/{id}', [StockController::class, 'destroy'])->name('stock.destroy'); // Delete stock
    Route::put('/stock/{id}/approve', [StockController::class, 'approve'])->name('stock.approve'); // Approve stock
    Route::put('/stock/{id}/reject', [StockController::class, 'reject'])->name('stock.reject'); // Reject stock

    Route::put('/stockreport', [RequestsController::class, 'update'])->name('stockreport.update'); // Update stock report

    // =================== Static Page Views ===================
    Route::get('/dashboard', fn() => view('dashboard', ['user' => Auth::user()]))->name('dashboard'); // Dashboard
    Route::get('/profile', fn() => view('profile', ['user' => Auth::user()]))->name('profile'); // Profile
    Route::get('/leave', fn() => view('leave', ['user' => Auth::user()]))->name('leave'); // Leave view
    Route::get('/edit', fn() => view('edit', ['user' => Auth::user()]))->name('edit'); // Edit profile
    Route::get('/staff', fn() => view('staff', ['user' => Auth::user()]))->name('staff'); // Staff view
    Route::get('/stationery', fn() => view('stationery', ['user' => Auth::user()]))->name('stationery'); // Stationery
    Route::get('/excel', fn() => view('excel', ['user' => Auth::user()]))->name('excel'); // Excel query
    Route::get('/stockreport', fn() => view('stockreport', ['user' => Auth::user()]))->name('stockreport'); // Stock report
    Route::get('/welcome', fn() => view('welcome', ['user' => Auth::user()]))->name('welcome'); // Welcome page
    Route::get('/sadaka', fn() => view('sadaka', ['user' => Auth::user()]))->name('sadaka'); // sadaka page
    Route::get('/stockreplenish', fn() => view('stockreplenish', ['user' => Auth::user()]))->name('stockreplenish'); // Replenish stock





    Route::post('/sadaka', [SadakaController::class, 'store'])->name('sadaka.store'); // Add stock


});

    // =================== Public Auth Routes ===================
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // Login form
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit'); // Submit login
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register'); // Register form
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit'); // Submit register
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // Logout

    // =================== Profile Edit Routes ===================
    Route::get('/profile/{id}/edit', [EmployeeController::class, 'edit'])->name('profile.edit'); // Edit user
    Route::put('/profile/{id}', [EmployeeController::class, 'update'])->name('profile.update'); // Update user

    // =================== API Routes ===================
    Route::get('/api/products', function () {
        $files = File::files(public_path('img'));
        return collect($files)->map(fn($file) => asset('img/' . $file->getFilename()));
    }); // Get product images

    Route::get('/api/forms', function () {
        $files = File::files(public_path('forms'));
        return collect($files)->map(fn($file) => asset('forms/' . $file->getFilename()));
    }); // Get form documents

    Route::get('/api/check-session', function () {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }
        return response()->json(['message' => 'Authenticated']);
}); // Session check

