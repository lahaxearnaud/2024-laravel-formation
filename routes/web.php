<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;

Route::get('/', AppController::class)
    ->name('app')
    ->middleware(['auth']);

require __DIR__.'/auth.php';
