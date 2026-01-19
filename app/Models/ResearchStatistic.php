<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResearchStatistic extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'year',
        'count',
        'category',
    ];

    /**
     * Scope to get statistics by year.
     */
    public function scopeByYear($query, $year)
    {
        return $query->where('year', $year);
    }
}
