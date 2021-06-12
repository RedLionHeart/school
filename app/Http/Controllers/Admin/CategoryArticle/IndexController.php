<?php

namespace App\Http\Controllers\Admin\CategoryArticle;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\CategoryArticle;
use App\Models\News;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
   public function __invoke()
   {
       $all_news = News::latest()->paginate(10);
       $user = Auth::user();
       $articles = Article::latest()->paginate(10);
       $categories_articles = CategoryArticle::latest()->paginate(10);

       return view('admin.category_articles.index', compact(['all_news','user', 'articles','categories_articles']));
   }
}
