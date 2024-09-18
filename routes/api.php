<?php

use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', static function (Request $request) {
        return $request->user();
    });
    Route::get('tags', [TagController::class, 'index']);
    Route::resource('todo-lists', \App\Http\Controllers\TodoListController::class);
    Route::resource('todo-lists/{todoList}/todos', \App\Http\Controllers\TodoController::class);
});
