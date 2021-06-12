<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News;

class DestroyController extends BaseController
{
   public function __invoke(News $news)
   {
       $news->delete();

       return redirect()->route('news.index');
   }
}
