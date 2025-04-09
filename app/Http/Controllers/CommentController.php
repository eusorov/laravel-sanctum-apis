<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return Comment::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'todo_id' => 'required|exists:todo_items,id',
            'author_id' => 'required|exists:users,id',
            'message' => 'required|string'
        ]);

        $comment = Comment::create($validated);

        return response()->json($comment, 201);
    }

    public function show($id)
    {
        return Comment::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        $validated = $request->validate([
            'message' => 'sometimes|required|string'
        ]);

        $comment->update($validated);

        return response()->json($comment);
    }

    public function destroy($id)
    {
        Comment::destroy($id);
        return response()->json(null, 204);
    }
}

