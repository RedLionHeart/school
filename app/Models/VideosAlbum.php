<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideosAlbum extends Model
{
    use HasFactory;

    protected $table = 'videos_albums';
    protected $fillable = [
        'archive_id',
        'title',
        'link',
    ];

    public function archive()
    {
        return $this->belongsTo(ArchiveVideo::class, 'archive_id');
    }
}
