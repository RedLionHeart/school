<?php

namespace App\Http\Controllers\Article;

use App\Models\CategoryArticle;

class CreateController extends BaseController
{
   public function __invoke()
   {

       $categories = CategoryArticle::main()->get();

       return view('article.create', compact('categories'));
   }
}
