<?php


namespace App\Services\CategoryArticle;

use App\Models\CategoryArticle;
use App\Services\MainService;

class Service
{
    public function store($data){
        $mainService = new MainService();
        $data += ['slug' => $mainService->makeSlug($data['title'], 'category_articles')];

        CategoryArticle::create($data);
    }

    public function update($category, $data){
        $category->update($data);
    }
}
