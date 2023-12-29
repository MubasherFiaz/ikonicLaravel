<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Feedback extends Model
{
    use HasFactory;
    protected $fillable = ['item', 'category', 'description','votes'];

    /**
     * Get all of the comments for the feedback
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'feedback_id', 'id');
    }


}
