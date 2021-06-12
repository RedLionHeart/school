<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\News;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
   public function __invoke()
   {
       //$this -> authorize('view', auth()->user());
       $all_news = News::latest()->paginate(10);
       $user = Auth::user();
       $articles = Article::latest()->paginate(10);

       return view('admin.news.index', compact(['all_news','user', 'articles']));
   }
}
