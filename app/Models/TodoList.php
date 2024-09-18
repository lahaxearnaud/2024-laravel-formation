<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\TodoListFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TodoList extends Model
{
    /** @use HasFactory<TodoListFactory> */
    use HasFactory;

    /**
     * @return HasMany<Todo>
     */
    public function todos(): HasMany
    {
        return $this->hasMany(Todo::class);
    }

    /**
     * @return BelongsTo<User, TodoList>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
