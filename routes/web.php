<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NewHireController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TerminationController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect('/login');
});
// Route::get('/', function () {
//     return redirect()->route('employees.index');
// });

Route::get('/newhires', [NewHireController::class, 'index'])->name('newhires.index');
Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index'); // must be first
Route::get('/employees/create/{newHire}', [EmployeeController::class, 'create'])->name('employees.create');
Route::post('/employees/store/{newHire}', [EmployeeController::class, 'store'])->name('employees.store');
Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');

Route::get('/employees/{employee}/view', [EmployeeController::class, 'view'])->name('employees.view');
Route::get('/employees/{employee}/pdf', [EmployeeController::class, 'generatePdf'])->name('employees.pdf');

Route::get('/terminations/create/{employee}', [TerminationController::class, 'create'])->name('terminations.create');
Route::post('/terminations/store/{employee}', [TerminationController::class, 'store'])->name('terminations.store');
Route::post('/employees/store/{newHire}', [EmployeeController::class, 'store'])->name('employees.store');

Route::get('/newhires', [NewHireController::class, 'index'])->name('newhires.index');
Route::post('/employees/store/{newHire}', [EmployeeController::class, 'store'])->name('employees.store');
Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');


// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Redirect root to login

// Protected routes - only authenticated users
Route::get('/debug-user', function () {
    $user = \App\Models\User::first();
    
    if (!$user) {
        return "No users found in database";
    }
    
    echo "User: " . $user->name . "<br>";
    echo "Role: " . $user->role . "<br>";
    echo "Methods available: " . implode(', ', get_class_methods($user)) . "<br>";
    
    // Test the method
    if (method_exists($user, 'canAccessHR')) {
        echo "✅ canAccessHR method EXISTS!<br>";
        echo "Result: " . ($user->canAccessHR() ? 'YES' : 'NO');
    } else {
        echo "❌ canAccessHR method does NOT exist!";
    }
});