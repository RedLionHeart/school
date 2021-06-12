<?php

namespace App\Http\Controllers\Article;

use App\Http\Requests\Article\StoreRequest;

class StoreController extends BaseController
{
   public function __invoke(StoreRequest $request)
   {

       $data = $request ->validated();

       $this->service->store($data);

       return redirect()->route('admin.article.index');
   }
}
