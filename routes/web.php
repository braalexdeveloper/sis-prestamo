<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('home');
})->name('dashboard');


Route::middleware(['auth'])->group(function () {
    //Ruta para administradores
    Route::middleware(['role:Admin'])->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
    });

    // Rutas para PRÉSTAMOS (todos los usuarios autenticados)
    Route::middleware(['permission:view loans'])->group(function () {
        Route::get('/loans/search-client', [LoanController::class, 'getClientByDni'])->name('loans.getClientByDni');
        Route::resource('loans', LoanController::class);
    });

    // Rutas para CLIENTES (todos los usuarios autenticados)
    Route::middleware(['permission:view clients'])->group(function () {
        Route::resource('clients', ClientController::class);
    });
});
