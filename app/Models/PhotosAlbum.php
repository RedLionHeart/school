<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotosAlbum extends Model
{
    use HasFactory;

    protected $table = 'photos_albums';
    protected $fillable = [
        'album_id',
        'path',
    ];

    public function album(){
        $this->belongsTo(Album::class,'album_id');
    }
}
