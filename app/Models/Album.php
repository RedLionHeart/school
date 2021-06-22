<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Album extends Model
{
    use HasFactory;

    protected $table = 'albums';
    protected $fillable = [
        'id',
        'archive_id',
        'title',
        'preview',
        'description',
        'slug',
    ];

    public function archive()
    {
        return $this->belongsTo(ArchivePhoto::class, 'archive_id');
    }

    public function photos(){
        return $this->hasMany(PhotosAlbum::class, 'album_id');
    }

    public function deleteConnectingPhotos(){
        foreach ($this->photos as $photo){
            Storage::delete('/public/photos_albums/' . $photo->path);

            $photo->delete();
        }
    }
}
