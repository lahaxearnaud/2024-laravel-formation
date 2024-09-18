<?php

namespace Database\Seeders;


use App\Models\Tag;
use App\Models\Todo;
use App\Models\TodoList;
use App\Models\User;
use Illuminate\Database\Seeder;

class TodoListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(2)->create();
        Tag::factory(10)->create();

        $tags = Tag::all();
        User::all()->each(function (User $user)  use ($tags): void {
            TodoList::factory(3)->create([
                'user_id' => $user->id,
            ]);

            TodoList::all()
                ->each(function (TodoList $todoList) use ($tags): void {
                    Todo::factory(5)->create([
                        'todo_list_id' => $todoList->id,
                    ])
                        ->each(function (Todo $todo) use ($tags) : void {
                            $todo->tags()->attach(
                                $tags->random(random_int(1, 3))->pluck('id')->toArray()
                            );
                        });
                });
        });

    }
}
