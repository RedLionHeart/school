<?php

namespace App\Http\Controllers\CategoryArticle;

use App\Models\CategoryArticle;

class CreateController extends BaseController
{
   public function __invoke()
   {
       $categories = CategoryArticle::main()->get();

       return view('category_articles.create', compact('categories'));
   }
}
