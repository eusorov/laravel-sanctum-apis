<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['todo_id', 'author_id', 'message'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }


    public function todoItem()
    {
        return $this->belongsTo(TodoItem::class, 'todo_id');
    }
}

