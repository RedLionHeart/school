<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $table = 'articles';
    protected $fillable = [
        'category_id',
        'title',
        'content',
        'image',
        'slug',
    ];

    public function category(){
        return $this->belongsTo(CategoryArticle::class);
    }

}
