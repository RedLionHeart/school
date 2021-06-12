<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\News;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
   public function __invoke()
   {
       $all_news = News::latest()->paginate(10);
       $last_three_news = News::latest()->take(3)->get();
       $user = Auth::user();
       $articles = Article::latest()->paginate(10);
       $last_three_articles = Article::latest()->take(3)->get();

       return view('admin.index', compact(['all_news','user','last_three_news', 'articles', 'last_three_articles']));
   }
}
