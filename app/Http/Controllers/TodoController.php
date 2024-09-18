<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Models\Todo;
use App\Models\TodoList;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TodoList $todoList)
    {
        if (!Gate::allows('view', $todoList)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return response()->json(
            Todo::with('tags')->where(
                [
                    'todo_list_id' => $todoList->id
                ]
            )->orderBy('id', 'desc')->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request, TodoList $todoList)
    {
        $validated = $request->validated();

        try {
            $todo = new Todo($validated);
            $todoList->todos()->save($todo);

            return response()->json(
                data: $todo,
                status: Response::HTTP_CREATED,
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response(
                status: Response::HTTP_NOT_ACCEPTABLE
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TodoList $todoList, Todo $todo)
    {
        if (!Gate::allows('view', $todo)) {

            abort(Response::HTTP_FORBIDDEN);
        }

        return response()->json(
            $todo
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, TodoList $todoList, Todo $todo)
    {
        if (!Gate::allows('update', $todo)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $validated = $request->validated();

        try {
            $todo->update([
                ...$validated,
                'todo_list_id' => $todoList->id
            ]);

            return response()->json(
                $todo,
                status: Response::HTTP_ACCEPTED
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response(
                $th->getMessage(),
                status: Response::HTTP_NOT_ACCEPTABLE
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TodoList $todoList, Todo $todo)
    {
        if (!Gate::allows('delete', $todo)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $todo->deleteQuietly();
        return response()->json(null, status: Response::HTTP_ACCEPTED);
    }
}
