<?php

namespace App\Http\Controllers\Article;

use App\Models\Article;
use App\Services\MainService;

class ShowController extends BaseController
{
   public function __invoke(string $slug, MainService $mainService)
   {
       $article = $mainService->getModelFromSlug($slug, Article::class);

       return view('article.show', compact('article'));

   }
}
