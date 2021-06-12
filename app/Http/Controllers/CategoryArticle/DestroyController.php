<?php

namespace App\Http\Controllers\CategoryArticle;

use App\Models\CategoryArticle;

class DestroyController extends BaseController
{
   public function __invoke(CategoryArticle $category)
   {
       $category->delete();

       return redirect()->route('admin.category_articles.index');
   }
}
