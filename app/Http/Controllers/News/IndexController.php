<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News;

class IndexController extends BaseController
{
   public function __invoke()
   {
       $all_news = News::latest()->paginate(10);

       return view('news.index', compact('all_news'));
   }
}
