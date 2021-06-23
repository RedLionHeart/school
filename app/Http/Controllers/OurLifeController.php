<?php

namespace App\Http\Controllers;

use App\Models\ArchivePhoto;
use App\Services\MainService;

class OurLifeController extends Controller
{

     public function show(string $slug, MainService $mainService){

        $archive = $mainService->getModelFromSlug($slug, ArchivePhoto::class);

        return view('archive_photo.show')->with('archive', $archive);
    }

}
