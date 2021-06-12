@extends('layouts.admin')

@section('breadcrumbs')
    @component('includes.admin.breadcrumbs')
        @slot('title') Блог @endslot
        @slot('parent') Главная @endslot
        @slot('active') Статьи @endslot
    @endcomponent
@endsection

@section('content')
    <div class="container">
        <a href="{{route('article.create')}}" class="btn btn-success my-3">Создать статью</a>
        @foreach($articles as $article)
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-3">
                        <img class="card-img w-100" style="max-height:300px;object-fit: cover;"
                             src="{{ asset('/storage/articles_img/' .  $article->image) }}" alt="{{$article->title}}">
                    </div>
                    <div class="col-md-9 d-flex py-3 pr-3">
                        <div class="col-md-9">
                            <div class="card-text">
                                <span class="badge bg-primary">{{$article->category->parent->title}}</span> ->
                                <span class="badge bg-primary">{{$article->category->title}}</span>
                            </div>
                            <h4 class="card-title mt-3">{{$article->title}}</h4>
                            <p class="card-text">{{Str::limit(strip_tags($article->content), 50)}}</p>
                            <p class="card-text"><small class="text-muted">Дата создания: {{ date('d.m.Y', strtotime($article->created_at)) }}</small></p>
                        </div>
                        <div class="container col-md-3">
                            <div class="row no-gutters">
                                <form class="col-12" onsubmit="return confirm('Удалить?');" action="{{ route('article.destroy', $article->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger mb-2 col-12">Удалить</button>
                                </form>
                                <a href="{{route('article.edit', $article->id)}}" class="btn btn-warning mb-2 col-12">Редактировать</a>
                                <a href="{{route('article.show', $article->slug)}}" class="btn btn-success col-12" target="_blank">Посмотреть</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div>
            {{$articles->links()}}
        </div>
    </div>
@endsection
