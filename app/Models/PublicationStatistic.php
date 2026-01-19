<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublicationStatistic extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category',
        'count',
        'year',
    ];

    /**
     * Scope to get statistics by category.
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}
