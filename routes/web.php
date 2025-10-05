<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewHireController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TerminationController;
use App\Http\Controllers\AuthController;

// Redirect root to login
Route::get('/', function () {
    return redirect('/login');
});

// Auth Routes (Guest only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Protected Routes (Authenticated users only)
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard redirect
    Route::get('/dashboard', function () {
        return redirect()->route('employees.index');
    })->name('dashboard');
    
    // New Hires Management
    Route::prefix('newhires')->name('newhires.')->group(function () {
        Route::get('/', [NewHireController::class, 'index'])->name('index');
        Route::post('/approve/{newHire}', [NewHireController::class, 'approve'])->name('approve');
        Route::delete('/{newHire}', [NewHireController::class, 'destroy'])->name('destroy');
    });
    
    // Employee Management
    Route::prefix('employees')->name('employees.')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('index');
        Route::get('/create/{newHire}', [EmployeeController::class, 'create'])->name('create');
        Route::post('/store/{newHire}', [EmployeeController::class, 'store'])->name('store');
        Route::get('/{employee}/view', [EmployeeController::class, 'view'])->name('view');
        Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])->name('edit');
        Route::put('/{employee}', [EmployeeController::class, 'update'])->name('update');
        Route::get('/{employee}/pdf', [EmployeeController::class, 'generatePdf'])->name('pdf');
    });
    
    // Termination Management
    Route::prefix('terminations')->name('terminations.')->group(function () {
        Route::get('/create/{employee}', [TerminationController::class, 'create'])->name('create');
        Route::post('/store/{employee}', [TerminationController::class, 'store'])->name('store');
        Route::get('/', [TerminationController::class, 'index'])->name('index');
    });
});


Route::middleware('auth')->group(function () {
    Route::controller(EmployeeController::class)->prefix('employees')->name('employees.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/{newHire}', 'create')->name('create');
        Route::post('/store/{newHire}', 'store')->name('store');
        Route::get('/{employee}/view', 'view')->name('view');
        Route::get('/{employee}/edit', 'edit')->name('edit');
        Route::put('/{employee}', 'update')->name('update');
        Route::get('/{employee}/pdf', 'generatePdf')->name('pdf');
    });
});