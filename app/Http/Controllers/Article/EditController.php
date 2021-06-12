<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\CategoryArticle;

class EditController extends BaseController
{
   public function __invoke(Article $article)
   {
       $categories = CategoryArticle::main()->get();

       return view('article.edit', compact(['article', 'categories']));
   }
}
