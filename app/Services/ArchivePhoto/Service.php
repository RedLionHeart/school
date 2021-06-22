<?php


namespace App\Services\ArchivePhoto;

use App\Models\ArchivePhoto;
use App\Services\MainService;

class Service
{
    public function store($data){
        $mainService = new MainService();
        $data += ['slug' => $mainService->makeSlug($data['title'], 'archive_photos')];

        ArchivePhoto::create($data);
    }

    public function update($archive, $data){
        $archive->update($data);
    }
}
