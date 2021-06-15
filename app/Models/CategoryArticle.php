<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryArticle extends Model
{
    use HasFactory;

    protected $table = 'category_articles';
    protected $fillable = [
        'parent_id',
        'title',
        'slug',
    ];

    public function scopeMain($query)
    {
        return $query->where('parent_id', 0);
    }

    public function scopeMainWithoutCurrent($query, $id)
    {
        return $query->where('parent_id', 0)->whereNotIn('id', [$id]);
    }

    public function subcategories()
    {
        return $this->hasMany(CategoryArticle::class, 'parent_id');
    }

    public function isMain()
    {
        return $this->parent_id === 0;
    }

    public function parent()
    {
        return $this->belongsTo(CategoryArticle::class, 'parent_id');
    }
}
