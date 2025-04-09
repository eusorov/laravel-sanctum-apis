<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\TodoItem;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    protected $model = Comment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'todo_id' => TodoItem::factory(),
            'author_id' => User::factory(),
            'message' => $this->faker->sentence(10),
        ];
    }
}
