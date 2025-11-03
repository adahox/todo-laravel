<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Gate;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        return Todo::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate()
            ->toResourceCollection();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request): JsonResource
    {
        Gate::authorize('create', Todo::class);

        $todoItem = [
            'item' => $request->item,
            'user_id' => $request->user()->id
        ];

        $todo = Todo::create($todoItem);

        return $todo->toResource();
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo): JsonResource
    {
        Gate::authorize('view', $todo);

        return $todo->toResource();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
       Gate::authorize('update', $todo);

        $todo->update($request->only('item'));

        return $todo->toResource();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        Gate::authorize('delete', $todo);

        return $todo->deleteOrFail();
    }
}
