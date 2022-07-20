<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'title', 'slug', 'content', 'image', 'status'];

    /**
     * Get the BlogCategory that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function BlogCategory(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class);
    }
}
