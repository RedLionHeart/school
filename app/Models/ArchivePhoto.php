<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivePhoto extends Model
{
    use HasFactory;

    protected $table = 'archive_photos';
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

    public function album()
    {
        return $this->hasOne(ArchivePhoto::class, 'archive_id');
    }

}
