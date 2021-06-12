<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\UpdateRequest;
use App\Models\News;

class UpdateController extends BaseController
{
   public function __invoke(UpdateRequest $request, News $news)
   {
       $data = $request->validated();

       $this->service->update($news, $data);

       return redirect()->route('news.index');
   }
}
