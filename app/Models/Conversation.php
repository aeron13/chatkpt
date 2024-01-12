<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'current_node',
        'create_time',
        'update_time',
        'author_id',
        'categories'
    ];
    protected $casts = [
        'categories' => 'array'
    ];
}
