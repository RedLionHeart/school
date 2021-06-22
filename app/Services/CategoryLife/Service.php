<?php


namespace App\Services\CategoryLife;

use App\Models\CategoryLife;
use App\Services\MainService;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class Service
{
    public function store($data){
        $mainService = new MainService();

        if (!empty(request()->file('image_file')))
            $data += ['image' => $mainService->saveImage(Request::file('image_file'), 'category_life')];

        CategoryLife::create($data);
    }

    public function update($category, $data){
        $mainService = new MainService();

        if (!empty(request()->file('image_file'))) {
            if (!empty($category->image)) Storage::delete('/public/category_life/' . $category->image);
            $data += ['image' => $mainService->saveImage(Request::file('image_file'), 'category_life')];
        }

        $category->update($data);
    }
}
