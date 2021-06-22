<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\ArchivePhoto;
use App\Models\Article;
use App\Models\CategoryArticle;
use App\Models\CategoryLife;
use App\Models\News;
use Illuminate\Support\Facades\Auth;

class CategoryLifeController extends Controller
{
   public function index()
   {
       $all_news = News::latest()->paginate(10);
       $user = Auth::user();
       $articles = Article::latest()->paginate(10);
       $categories_articles = CategoryArticle::latest()->paginate(10);
       $archives_photo = ArchivePhoto::latest()->paginate(10);
       $albums = Album::latest()->paginate(10);
       $categories_life = CategoryLife::latest()->paginate(10);

       return view('admin.category_life.index')
           ->with('all_news', $all_news)
           ->with('articles', $articles)
           ->with('categories_articles', $categories_articles)
           ->with('archives_photo', $archives_photo)
           ->with('user', $user)
           ->with('albums', $albums)
           ->with('categories_life', $categories_life);
   }
}
