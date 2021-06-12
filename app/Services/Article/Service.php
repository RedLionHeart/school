<?php


namespace App\Services\Article;


use App\Models\Article;
use App\Services\MainService;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class Service
{
    public function store($data){
        $mainService = new MainService();

        if (!empty(request()->file('image_file')))
            $data += ['image' => $mainService->saveImage(Request::file('image_file'), 'articles_img')];

        $data += ['slug' => $mainService->makeSlug($data['title'], 'articles')];

        Article::create($data);
    }

    public function update($article, $data){
        $mainService = new MainService();

        if (!empty(request()->file('image_file'))) {
            if (!empty($article->image)) Storage::delete('/public/articles_img/' . $article->image);
            $data += ['image' => $mainService->saveImage(Request::file('image_file'), 'articles_img')];
        }

        $article->update($data);
    }
}
