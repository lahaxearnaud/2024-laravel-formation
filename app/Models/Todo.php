<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\TodoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Todo extends Model
{
    /** @use HasFactory<TodoFactory> */
    use HasFactory;

    protected $casts = [
        'completed' => 'boolean',
    ];

    protected $fillable = [
        'title',
        'completed'
    ];

    /**
     * @return HasOne<TodoList>
     */
    public function todoList(): HasOne
    {
        return $this->hasOne(TodoList::class);
    }

    /**
     * @return BelongsToMany<Tag>
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
