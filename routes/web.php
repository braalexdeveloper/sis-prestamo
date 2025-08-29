<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});




Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
    return view('layouts.dashboard');
})->name('dashboard');
    //Ruta para administradores
    Route::middleware(['role:Admin'])->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
    });

    // Rutas para PRÉSTAMOS (todos los usuarios autenticados)
    Route::middleware(['role:User|Admin'])->group(function () {
        Route::get('/loans/search-client', [LoanController::class, 'getClientByDni'])->name('loans.getClientByDni');
        Route::resource('loans', LoanController::class);
    });

    // Rutas para CLIENTES (todos los usuarios autenticados)
    Route::middleware(['role:User|Admin'])->group(function () {
        Route::resource('clients', ClientController::class);
    });
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
