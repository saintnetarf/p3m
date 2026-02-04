<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Announcement extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
      //  'content',
        'file_pdf',
        'start_date',
        'end_date',
        'is_important',
        'is_active',
        'author_id',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_important' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get the author (user) who created this announcement.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Scope to get active announcements based on date range.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                     ->where('start_date', '<=', Carbon::today())
                     ->where('end_date', '>=', Carbon::today());
    }

    /**
     * Scope to get important announcements.
     */
    public function scopeImportant($query)
    {
        return $query->where('is_important', true);
    }
}
