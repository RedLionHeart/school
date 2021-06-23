<?php

namespace App\Http\Controllers;


use App\Http\Requests\VideosAlbum\StoreRequest;
use App\Http\Requests\VideosAlbum\UpdateRequest;
use App\Models\ArchiveVideo;
use App\Models\VideosAlbum;

class VideosAlbumController extends Controller
{

    public function create(){

        $categories = ArchiveVideo::all();

        return view('videos.create')->with('categories', $categories);
    }

    public function store(StoreRequest $request)
    {
        $data = $request ->validated();

        VideosAlbum::create($data);

        return redirect()->route('admin.videos.index');
    }


    public function edit(VideosAlbum $video){
        $categories = ArchiveVideo::all();

        return view('videos.edit', compact(['video', 'categories']));
    }

    public function update(UpdateRequest $request, VideosAlbum $video){
        $data = $request->validated();

        $video->update($data);

        return redirect()->route('admin.videos.index');
    }

    public function destroy(VideosAlbum $video){
        $video->delete();

        return redirect()->route('admin.videos.index');
    }
}
