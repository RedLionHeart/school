<?php

namespace App\Http\Controllers;

use App\Http\Requests\Album\StoreRequest;
use App\Http\Requests\Album\UpdateRequest;
use App\Models\Album;
use App\Models\ArchivePhoto;
use App\Models\PhotosAlbum;
use App\Services\Album\Service;
use App\Services\MainService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function create(){

        $categories = ArchivePhoto::all();

        return view('album.create')->with('categories', $categories);
    }

    public function store(StoreRequest $request)
    {
        $data = $request ->validated();

        $this->service->store($data);

        return redirect()->route('admin.album.index');
    }

    public function show(string $archive, string $slug, MainService $mainService){

        $album = $mainService->getModelFromSlug($slug, Album::class);

        return view('album.show')->with('album', $album);
    }

    public function edit(Album $album){
        $categories = ArchivePhoto::all();
        $photos = PhotosAlbum::where('album_id', $album->id)->get();

        return view('album.edit')->with('album', $album)->with('categories',$categories)->with('photos', $photos);
    }

    public function update(UpdateRequest $request, Album $album){

        $data = $request->validated();

        $this->service->update($album, $data);

        return redirect()->route('admin.album.index');
    }

    public function storeImage(Request $request){
        $mainService = new MainService();

        if($request->hasFile('photo_files')){
            $files = $request -> file('photo_files');

            foreach ($files as $file){
                PhotosAlbum::create(['album_id'=>$request->input('album_id'), 'path'=>$mainService->saveImage($file, 'photos_albums', $file->getClientOriginalName())]);
            }
        }
    }

    public function fetchImage($album_id){
        $images = PhotosAlbum::where('album_id', $album_id)->get(['id', 'path']);

        return response()->json(array('success' => true, 'images' => $images));
    }

    public function destroy(Album $album){
        $album -> delete();
        $album -> deleteConnectingPhotos();

        return redirect()->route('admin.album.index');
    }
}
