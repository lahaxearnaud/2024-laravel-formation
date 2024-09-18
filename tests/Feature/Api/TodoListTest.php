<?php

namespace Feature\Api;

use App\Models\TodoList;
use App\Models\User;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    public function testIndex(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $todoList = TodoList::create([
            'name' => uniqid(__FUNCTION__, true),
            'user_id' => $user->id,
        ]);

        $token = $user->createToken('token')->plainTextToken;

        $response = $this->get('/api/todo-lists', [
            'Authorization' => "Bearer $token"
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $data = $response->json();
        $this->assertIsArray($data);
        $this->assertCount(1, $data);
        $this->assertArrayHasKey('id', $data[0]);
        $this->assertArrayHasKey('name', $data[0]);
        $this->assertArrayHasKey('user_id', $data[0]);
        $this->assertEquals($user->id, $data[0]['user_id']);
        $this->assertEquals($todoList->name, $data[0]['name']);
    }
}
