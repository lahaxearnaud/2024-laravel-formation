<?php

use App\Http\Controllers\Api\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', static function (Request $request) {
        return $request->user();
    });
    Route::get('tags', [TagController::class, 'index']);
    Route::resource('todo-lists', \App\Http\Controllers\Api\TodoListController::class);
    Route::resource('todo-lists/{todoList}/todos', \App\Http\Controllers\Api\TodoController::class);
});
