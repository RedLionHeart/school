<?php

namespace App\Http\Controllers\CategoryArticle;

use App\Http\Requests\CategoryArticle\UpdateRequest;
use App\Models\CategoryArticle;

class UpdateController extends BaseController
{
   public function __invoke(UpdateRequest $request, CategoryArticle $category)
   {
       $data = $request->validated();

       $this->service->update($category, $data);

       return redirect()->route('admin.category_articles.index');
   }
}
