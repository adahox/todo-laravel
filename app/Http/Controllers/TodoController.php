<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\TodoColletion;
use App\Models\Todo;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        return Todo::paginate()->toResourceCollection();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request): JsonResource
    {
        $todo = Todo::create($request->only('item'));

        return $todo->toResource();
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo): JsonResource
    {
        return $todo->toResource();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $todo->update($request->only('item'));

        return $todo->toResource();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        return $todo->deleteOrFail();
    }
}
