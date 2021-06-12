<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Services\MainService;

class ShowController extends BaseController
{
   public function __invoke(string $slug, MainService $mainService)
   {

       $news = $mainService->getModelFromSlug($slug, News::class);

       return view('news.show')->with('news', $news);

   }
}
