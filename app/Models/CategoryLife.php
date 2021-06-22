<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CategoryLife extends Model
{
    use HasFactory;

    protected $table = 'category_lives';
    protected $fillable = [
        'title',
        'image',
    ];

    public function archivePhoto()
    {
        return $this->hasOne(ArchivePhoto::class, 'category_id');
    }

    public function archiveVideo()
    {
        return $this->hasOne(ArchiveVideo::class, 'category_id');
    }

    public function deleteConnectingPhotoAlbums(){
        $archive = $this->archivePhoto;

        foreach ($archive->photos as $photo){
            Storage::delete('/public/photos_albums/' . $photo->path);

            $photo->delete();
        }

        $archive -> delete();
    }

    public function deleteConnectingVideoAlbums(){

    }
}
