<?php


namespace App\Services\ArchiveVideo;

use App\Models\ArchiveVideo;
use App\Services\MainService;

class Service
{
    public function store($data){
        $mainService = new MainService();
        $data += ['slug' => $mainService->makeSlug($data['title'], 'archive_videos')];

        ArchiveVideo::create($data);
    }

    public function update($archive, $data){
        $archive->update($data);
    }
}
