<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TodoItemController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;

Route::middleware(['auth:sanctum'])->group(function () {
    // User route
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('users', UserController::class);

   });

// public routes
Route::apiResource('todos', TodoItemController::class);
Route::get('todos/{todoId}/comments', [TodoItemController::class, 'getComments']);
Route::post('todos/{todoId}/comments', [TodoItemController::class, 'addComment']);

// Comments routes
Route::apiResource('comments', CommentController::class);

require __DIR__ . '/auth.php';
