@extends('layouts.admin')

@section('breadcrumbs')
    @component('includes.admin.breadcrumbs')
        @slot('title') Новости @endslot
        @slot('parent') Главная @endslot
        @slot('active') Новости @endslot
    @endcomponent
@endsection

@section('content')
    <div class="container">
        <a href="{{route('news.create')}}" class="btn btn-success my-3">Создать новость</a>
        @foreach($all_news as $news)
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-3">
                        <img class="card-img w-100" style="max-height:300px;object-fit: cover;"
                             src="{{ asset('/storage/news_img/' .  $news->image) }}" alt="{{$news->title}}">
                    </div>
                    <div class="col-md-9 d-flex py-3 pr-3">
                        <div class="col-md-9">
                            <h4 class="card-title">{{$news->title}}</h4>
                            <p class="card-text">{{Str::limit(strip_tags($news->content), 50)}}</p>
                            <p class="card-text"><small class="text-muted">Дата создания: {{ date('d.m.Y', strtotime($news->created_at)) }}</small></p>
                        </div>
                        <div class="container col-md-3">
                            <div class="row no-gutters">
                                <form class="col-12" onsubmit="return confirm('Удалить?');" action="{{ route('news.destroy', $news->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger mb-2 col-12">Удалить</button>
                                </form>
                                <a href="{{route('news.edit', $news->id)}}" class="btn btn-warning mb-2 col-12">Редактировать</a>
                                <a href="{{route('news.show', $news->slug)}}" class="btn btn-success col-12" target="_blank">Посмотреть</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div>
            {{$all_news->links()}}
        </div>
    </div>
@endsection
