<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\TodoItem;
use App\Models\Comment;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory(10)->create()->each(function ($user) {
            TodoItem::factory(3)->create(['user_id' => $user->id])->each(function ($todo) {
                Comment::factory(2)->create(['todo_id' => $todo->id, 'author_id' => $todo->user_id]);
            });
        });
    }
}
