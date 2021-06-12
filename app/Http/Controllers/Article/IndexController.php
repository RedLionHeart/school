<?php

namespace App\Http\Controllers\Article;

use App\Models\Article;

class IndexController extends BaseController
{
   public function __invoke()
   {

       $articles = Article::latest()->paginate(10);

       return view('article.index', compact('articles'));
   }
}
