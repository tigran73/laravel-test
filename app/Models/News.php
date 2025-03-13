<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'author',
        'views'
    ];

    public function authorUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author');
    }
}
