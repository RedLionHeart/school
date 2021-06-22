<?php


namespace App\Services\Album;

use App\Models\Album;
use App\Services\MainService;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class Service
{
    public function store($data){
        $mainService = new MainService();

        if (!empty(request()->file('image_file')))
            $data += ['preview' => $mainService->saveImage(Request::file('image_file'), 'albums_preview')];

        $data += ['slug' => $mainService->makeSlug($data['title'], 'albums')];

        $album = Album::create($data);

        if(!empty(request()->hasFile('fileMulti'))){
            $photos = request()->file('fileMulti');

            foreach ($photos as $photo){
                $name = time().'-'.$photo->getClientOriginalName();
                $name = str_replace(' ', '-', $name);
                $mainService->saveImage($photo, 'photos_albums', $name);
                $album->photos()->create(['album_id'=>$album->id, 'path' => $name]);
            }
        }

    }

    public function update($album, $data){
        $mainService = new MainService();

        if (!empty(request()->file('image_file'))) {
            if (!empty($album->preview)) Storage::delete('/public/albums_preview/' . $album->preview);
            $data += ['preview' => $mainService->saveImage(Request::file('image_file'), 'albums_preview')];
        }
        $album->update($data);
    }
}
