<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchiveVideo extends Model
{
    use HasFactory;

    protected $table = 'archive_videos';
    protected $fillable = [
        'category_id',
        'title',
        'description',
        'slug',
    ];

    public function categoryArchive()
    {
        return $this->belongsTo(CategoryLife::class, 'category_id');
    }

    public function videos()
    {
        return $this->hasMany(VideosAlbum::class, 'archive_id');
    }
}
