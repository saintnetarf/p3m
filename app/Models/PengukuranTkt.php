<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class PengukuranTkt extends Model
{
    use SoftDeletes;

    protected $table = 'pengukuran_tkt';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'file',
        'file_name',
        'file_type',
        'file_size',
        'kategori',
        'level_tkt',
        'download_count',
        'author_id',
    ];

    /**
     * Get the author (user) who created this TKT.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Increment download count.
     */
    public function incrementDownloadCount()
    {
        $this->increment('download_count');
    }

    /**
     * Generate slug from title.
     */
    public static function generateSlug($title)
    {
        return Str::slug($title);
    }
}
