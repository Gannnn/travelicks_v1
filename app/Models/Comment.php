<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['listingId', 'userId', 'comment_text'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

}
