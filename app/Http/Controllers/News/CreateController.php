<?php

namespace App\Http\Controllers\News;

class CreateController extends BaseController
{
   public function __invoke()
   {
       return view('news.create');
   }
}
