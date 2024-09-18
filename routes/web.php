<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;

Route::get('/', AppController::class)
    ->name('app')
    ->middleware(['auth']);

Route::get('/tokens/create', static function (Request $request) {
    $token = Auth::user()?->createToken('test');

    return ['token' => $token->plainTextToken];
})
    ->name('app')
    ->middleware(['auth']);

require __DIR__.'/auth.php';
