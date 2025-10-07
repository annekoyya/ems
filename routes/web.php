<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    NewHireController,
    EmployeeController,
    TerminationController,
    AuthController,
    AccessRightsController
};

Route::get('/', function () {
    return redirect()->route('login');
});

// -------------------------------
// 🔐 Authentication Routes
// -------------------------------
Route::middleware(['web'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// -------------------------------
// 👨‍💼 Protected Admin & Employee Routes
// -------------------------------
Route::middleware(['auth'])->group(function () {
    // Employees
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/create/{newHire}', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees/store/{newHire}', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::get('/employees/{employee}/view', [EmployeeController::class, 'view'])->name('employees.view');
    Route::get('/employees/{employee}/pdf', [EmployeeController::class, 'generatePdf'])->name('employees.pdf');

    // New Hires
    Route::get('/newhires', [NewHireController::class, 'index'])->name('newhires.index');

    // Terminations
    Route::get('/terminations/create/{employee}', [TerminationController::class, 'create'])->name('terminations.create');
    Route::post('/terminations/store/{employee}', [TerminationController::class, 'store'])->name('terminations.store');

    // Admin Access
    // Route::get('/admin/access-rights', [AccessRightsController::class, 'accessRights'])->name('admin.access-rights');
    // Route::post('/admin/grant-access', [AccessRightsController::class, 'grantAccess'])->name('admin.grant-access');

    Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/admin/access-rights', [AccessRightsController::class, 'accessRights'])
        ->name('admin.access-rights');
    Route::post('/admin/grant-access', [AccessRightsController::class, 'grantAccess'])
        ->name('admin.grant-access');
});

});

Route::post('/employees/check-email', [EmployeeController::class, 'checkEmail'])->name('employees.check-email');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/access-rights', [AccessRightsController::class, 'accessRights'])
        ->name('admin.access-rights');
    Route::post('/admin/grant-access', [AccessRightsController::class, 'grantAccess'])
        ->name('admin.grant-access');
});

// Make sure you have these routes
Route::get('/admin/access-rights', [AccessRightsController::class, 'accessRights'])->name('admin.access-rights');
Route::post('/admin/grant-access', [AccessRightsController::class, 'grantAccess'])->name('admin.grant-access');

Route::get('/employees/filter', [EmployeeController::class, 'filter'])->name('employees.filter');