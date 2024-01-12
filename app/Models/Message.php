<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'create_time',
        'update_time',
        'content',
        'status',
        'end_turn',
        'metadata',
    ];

    protected $casts = [
        'content' => 'object',
        'metadata' => 'object'
    ];

    public function getAuthorAttribute($value)
    {
        if ($value === 'assistant') {
            return 'ChatGPT';
        }

        return $value;
    }
}
