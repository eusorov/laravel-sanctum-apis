<?php

namespace App\Http\Controllers;

use App\Models\TodoItem;
use Illuminate\Http\Request;

class TodoItemController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10); // Default to 10 if not specified
  
        return TodoItem::with('comments')->paginate($perPage);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean'
        ]);

        $todo = TodoItem::create($validated);

        return response()->json($todo, 201);
    }

    public function show($id)
    {
        $todo = TodoItem::with('comments')->findOrFail($id);
        return response()->json($todo);
    }

    public function update(Request $request, $id)
    {
        $todo = TodoItem::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean'
        ]);

        $todo->update($validated);

        return response()->json($todo);
    }

    public function destroy($id)
    {
        TodoItem::destroy($id);
        return response()->json(null, 204);
    }

    /**
     * Get comments for a specific todo item
     */
    public function getComments($todoId)
    {
        $todo = TodoItem::findOrFail($todoId);
        return response()->json($todo->comments()->with(['author' => function($query) {
            $query->select('id', 'name');
        }])->get());
    }

    /**
     * Add a comment to a specific todo item
     */
    public function addComment(Request $request, $todoId)
    {
        $todo = TodoItem::findOrFail($todoId);
        
        $validated = $request->validate([
            'author_id' => 'required|exists:users,id',
            'message' => 'required|string'
        ]);

        $comment = $todo->comments()->create([
            'todo_id' => $todoId,
            'author_id' => $validated['author_id'],
            'message' => $validated['message']
        ]);

        return response()->json($comment, 201);
    }
}
