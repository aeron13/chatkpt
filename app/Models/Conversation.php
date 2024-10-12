<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\AuthorScope;
use App\Models\Scopes\DeletedScope;

class Conversation extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new DeletedScope());
        static::addGlobalScope(new AuthorScope());
    }

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
