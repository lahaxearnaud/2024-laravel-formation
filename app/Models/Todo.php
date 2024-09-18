<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Todo extends Model
{
    use HasFactory;

    protected $casts = [
        'completed' => 'boolean',
    ];

    protected $fillable = [
        'title',
        'completed'
    ];

    public function todoList(): HasOne
    {
        return $this->hasOne(TodoList::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
