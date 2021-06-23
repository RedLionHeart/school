<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArchiveVideo\StoreRequest;
use App\Http\Requests\ArchiveVideo\UpdateRequest;
use App\Models\ArchivePhoto;
use App\Models\ArchiveVideo;
use App\Models\CategoryLife;
use App\Services\ArchiveVideo\Service;
use App\Services\MainService;

class ArchiveVideoController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
    public function create(){

        $categories = CategoryLife::doesntHave('archiveVideo')->get();

        return view('archive_video.create')->with('categories', $categories);
    }

    public function store(StoreRequest $request)
    {
        $data = $request ->validated();

        $this->service->store($data);

        return redirect()->route('admin.archive_video.index');
    }

    public function show(string $slug, MainService $mainService){

        $video_archive = $mainService->getModelFromSlug($slug, ArchiveVideo::class);

        return view('archive_video.show')->with('video_archive', $video_archive);
    }

    public function edit(ArchiveVideo $archive){
        $categories = CategoryLife::doesntHave('archiveVideo')->get();

        return view('archive_video.edit', compact(['archive', 'categories']));
    }

    public function update(UpdateRequest $request, ArchiveVideo $archive){
        $data = $request->validated();

        $this->service->update($archive, $data);

        return redirect()->route('admin.archive_video.index');
    }

    public function destroy(ArchiveVideo $archive){
        $archive->delete();

        return redirect()->route('admin.archive_photo.index');
    }
}
