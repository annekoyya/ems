<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewHireController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TerminationController;
use App\Http\Controllers\AuthController;

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth Routes (Guest only - not logged in)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Protected Routes (Must be authenticated)
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard redirect
    Route::get('/dashboard', function () {
        return redirect()->route('employees.index');
    })->name('dashboard');
    
    // New Hires Management
    Route::controller(NewHireController::class)->prefix('newhires')->name('newhires.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/approve/{newHire}', 'approve')->name('approve');
        Route::post('/approve-bulk', 'approveBulk')->name('approve.bulk');
        Route::delete('/{newHire}', 'destroy')->name('destroy');
    });
    
    // Employee Management
    Route::controller(EmployeeController::class)->prefix('employees')->name('employees.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store-direct', 'storeDirect')->name('store.direct');
        Route::get('/create/{newHire}', 'create')->name('create');
        Route::post('/store/{newHire}', 'store')->name('store');
        Route::get('/{employee}/view', 'view')->name('view');
        Route::get('/{employee}/edit', 'edit')->name('edit');
        Route::put('/{employee}', 'update')->name('update');
        Route::get('/{employee}/pdf', 'generatePdf')->name('pdf');
    });
    
    // Termination Management
    Route::controller(TerminationController::class)->prefix('terminations')->name('terminations.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/{employee}', 'create')->name('create');
        Route::post('/store/{employee}', 'store')->name('store');
    });
});