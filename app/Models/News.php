<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'news_category_id',
        'user_id',
        'title',
        'slug',
     //   'content',
        'image',
        'status',
        'published_at',
        'views',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Get the category of this news.
     */
    public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'news_category_id');
    }

    /**
     * Get the author of this news.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope to get only published news.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }
}
