@extends('layouts.admin')

@section('breadcrumbs')
    @component('includes.admin.breadcrumbs')
        @slot('title') Видео архивы @endslot
        @slot('parent') Главная @endslot
        @slot('active') Видео архив @endslot
    @endcomponent
@endsection

@section('content')
    <div class="container">
        <a href="{{route('archive_video.create')}}" class="btn btn-success my-3">Создать видео архив</a>
        @foreach($archives_video as $archive)
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-12 d-flex py-3 pr-3">
                        <div class="col-md-9">
                            <div class="card-text">
                                <span class="badge bg-primary">{{$archive->categoryArchive->title}}</span>
                            </div>
                            <h4 class="card-title mt-3">{{$archive->title}}</h4>
                            <p class="card-text">{{Str::limit(strip_tags($archive->description), 50)}}</p>
                            <p class="card-text"><small class="text-muted">Дата создания: {{ date('d.m.Y', strtotime($archive->created_at)) }}</small></p>
                        </div>
                        <div class="container col-md-3">
                            <div class="row no-gutters">
                                <form class="col-12" onsubmit="return confirm('Удалить?');" action="{{ route('archive_video.destroy', $archive->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger mb-2 col-12">Удалить</button>
                                </form>
                                <a href="{{route('archive_video.edit', $archive->id)}}" class="btn btn-warning mb-2 col-12">Редактировать</a>
                                <a href="{{route('archive_video.show', $archive->slug)}}" class="btn btn-success col-12" target="_blank">Посмотреть</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div>
            {{$archives_photo->links()}}
        </div>
    </div>
@endsection
