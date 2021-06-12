<?php

namespace App\Http\Controllers\CategoryArticle;

use App\Models\CategoryArticle;

class EditController extends BaseController
{
   public function __invoke(CategoryArticle $category)
   {

       $categories = CategoryArticle::mainWithoutCurrent($category->id)->get();

       return view('category_articles.edit', compact('category', 'categories'));
   }
}
