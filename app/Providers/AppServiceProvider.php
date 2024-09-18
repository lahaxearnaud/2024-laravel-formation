<?php

namespace App\Providers;

use App\Models\Todo;
use App\Models\TodoList;
use App\Policies\TodoListPolicy;
use App\Policies\TodoPolicy;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Todo::class, TodoPolicy::class);
        Gate::policy(TodoList::class, TodoListPolicy::class);

        Route::bind('todo', function (int $id) {
            return Todo::findOrFail($id);
        });

        Route::bind('todoList', function (int $id) {
            return TodoList::findOrFail($id);
        });
    }
}
