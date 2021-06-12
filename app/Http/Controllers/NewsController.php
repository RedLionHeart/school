<?php

namespace App\Http\Controllers;

use App\Models\News;

class NewsController extends Controller
{
    public function index(){
        $all_news = News::all();

        return view('news.index', compact('all_news'));
    }

    public function create(){
        return view('news.create');
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'slug' => 'string',
        ]);

        News::create($data);

        return redirect()->route('news.index');
    }

    public function show(News $news){
        return view('news.show', compact('news'));
    }

    public function edit(News $news){
        return view('news.edit', compact('news'));
    }

    public function update(News $news){
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'slug' => 'string',
        ]);

        $news->update($data);

        return redirect()->route('news.index');
    }

    public function destroy(News $news){
        $news->delete();

        return redirect()->route('news.index');
    }
}
