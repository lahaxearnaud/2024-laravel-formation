<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTodoListRequest;
use App\Http\Requests\UpdateTodoListRequest;
use App\Http\Resources\TodoResource;
use App\Models\TodoList;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(
            TodoResource::collection(
                auth()->user()?->todoLists()->get()
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoListRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            return response(
            )->json(
                TodoList::create([
                    ...$validated,
                    'user_id' => auth()->id(),
                ]),
                status: Response::HTTP_CREATED,
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()
                ->json(
                    $th->getMessage(),
                    status: Response::HTTP_NOT_ACCEPTABLE
                );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TodoList $todoList): JsonResponse
    {
        if (!Gate::allows('view', $todoList)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return response()->json(
            $todoList
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoListRequest $request, TodoList $todoList): JsonResponse
    {
        $validated = $request->validated();

        try {
            $todoList->update($validated);

            return response()->json(
                $todoList,
                status: Response::HTTP_ACCEPTED
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()
                ->json(
                    $th->getMessage(),
                    status: Response::HTTP_NOT_ACCEPTABLE
                );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TodoList $todoList): JsonResponse
    {
        if (!Gate::allows('delete', $todoList)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $todoList->deleteQuietly();
        return response()->json(null, status: Response::HTTP_ACCEPTED);
    }
}
