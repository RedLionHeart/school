<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\News;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
   public function __invoke()
   {
       $this -> authorize('view', auth()->user());

       $all_users = User::paginate(10);
       $all_news = News::paginate(10);
       $user = Auth::user();
       $articles = Article::latest()->paginate(10);

       return view('admin.user.index', compact(['all_users', 'user', 'all_news', 'articles']));
   }
}
