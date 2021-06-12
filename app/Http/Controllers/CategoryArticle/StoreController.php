<?php

namespace App\Http\Controllers\CategoryArticle;

use App\Http\Requests\CategoryArticle\StoreRequest;

class StoreController extends BaseController
{
   public function __invoke(StoreRequest $request)
   {
       $data = $request ->validated();

       $this->service->store($data);

       return redirect()->route('admin.category_articles.index');
   }
}
