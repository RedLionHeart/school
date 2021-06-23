<?php


namespace App\Services\OurLife;


class Service
{
    public function findArchiveFromSlug(string $slug)
    {
        $category = Category::where('slug', $slug)->first();
        if (empty($category)) abort(404);
        return $category;
    }
}
