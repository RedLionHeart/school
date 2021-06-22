@extends('layouts.admin')

@section('breadcrumbs')
    @component('includes.admin.breadcrumbs')
        @slot('title') Альбомы @endslot
        @slot('parent') Главная @endslot
        @slot('active') Альбомы @endslot
    @endcomponent
@endsection

@section('content')
    <div class="container">
        <a href="{{route('album.create')}}" class="btn btn-success my-3">Создать альбом</a>
        @foreach($albums as $album)
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-3">
                        <img class="card-img w-100" style="max-height:300px;object-fit: cover;"
                             src="{{ asset('/storage/albums_preview/' .  $album->preview) }}" alt="{{$album->title}}">
                    </div>
                    <div class="col-md-9 d-flex py-3 pr-3">
                        <div class="col-md-9">
                            <div class="card-text">
                                <span class="badge bg-primary">{{$album->archive->title}}</span>
                            </div>
                            <h4 class="card-title mt-3">{{$album->title}}</h4>
                            <p class="card-text">{{Str::limit(strip_tags($album->description), 50)}}</p>
                            <p class="card-text"><small class="text-muted">Дата создания: {{ date('d.m.Y', strtotime($album->created_at)) }}</small></p>
                        </div>
                        <div class="container col-md-3">
                            <div class="row no-gutters">
                                <form class="col-12" onsubmit="return confirm('Удалить?');" action="{{ route('album.destroy', $album->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger mb-2 col-12">Удалить</button>
                                </form>
                                <a href="{{route('album.edit', $album->id)}}" class="btn btn-warning mb-2 col-12">Редактировать</a>
                                <a href="{{route('album.show', [$album->archive->slug, $album->slug])}}" class="btn btn-success col-12" target="_blank">Посмотреть</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div>
            {{$albums->links()}}
        </div>
    </div>
@endsection
