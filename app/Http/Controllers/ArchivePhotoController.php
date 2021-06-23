<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArchivePhoto\StoreRequest;
use App\Http\Requests\ArchivePhoto\UpdateRequest;
use App\Models\ArchivePhoto;
use App\Models\CategoryLife;
use App\Services\ArchivePhoto\Service;
use App\Services\MainService;

class ArchivePhotoController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function create(){

        $categories = CategoryLife::doesntHave('archivePhoto')->get();

        return view('archive_photo.create')->with('categories', $categories);
    }

    public function store(StoreRequest $request)
    {
        $data = $request ->validated();

        $this->service->store($data);

        return redirect()->route('admin.archive_photo.index');
    }

    public function show(string $slug, MainService $mainService){

        $archive = $mainService->getModelFromSlug($slug, ArchivePhoto::class);

        return view('archive_photo.show')->with('archive', $archive);
    }

    public function edit(ArchivePhoto $archive){
        $categories = CategoryLife::doesntHave('archivePhoto')->get();

        return view('archive_photo.edit', compact(['archive', 'categories']));
    }

    public function update(UpdateRequest $request, ArchivePhoto $archive){
        $data = $request->validated();

        $this->service->update($archive, $data);

        return redirect()->route('admin.archive_photo.index');
    }

    public function destroy(ArchivePhoto $archive){
        $archive->delete();

        return redirect()->route('admin.archive_photo.index');
    }
}
