<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthenticatedSessionController::class, 'form'])
    ->middleware('guest')
    ->name('login');


Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest')
                ->name('login_do');

