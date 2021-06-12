<?php


namespace App\Services\News;


use App\Models\News;
use App\Services\MainService;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class Service
{
    public function store($data){
        $mainService = new MainService();

        if (!empty(request()->file('image_file')))
            $data += ['image' => $mainService->saveImage(Request::file('image_file'), 'news_img')];

        $data += ['slug' => $mainService->makeSlug($data['title'], 'news')];

        News::create($data);
    }

    public function update($news, $data){
        $mainService = new MainService();

        if (!empty(request()->file('image_file'))) {
            if (!empty($news->image)) Storage::delete('/public/news_img/' . $article->image);
            $data += ['image' => $mainService->saveImage(Request::file('image_file'), 'news_img')];
        }
        $news->update($data);
    }
}
