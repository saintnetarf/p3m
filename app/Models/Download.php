<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Download extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'download_category_id',
        'title',
        'slug',
        'description',
        'file',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
        'download_count',
        'author_id',
    ];

    /**
     * Get the author (user) who created this download.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Get the category of this download.
     */
    public function category()
    {
        return $this->belongsTo(DownloadCategory::class, 'download_category_id');
    }

    /**
     * Increment download count.
     */
    public function incrementDownloadCount()
    {
        $this->increment('download_count');
    }
}
