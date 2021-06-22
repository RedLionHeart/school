@extends('layouts.admin')

@section('breadcrumbs')
    @component('includes.admin.breadcrumbs')
        @slot('title') Разделы нашей жизни @endslot
        @slot('parent') Главная @endslot
        @slot('active') Разделы @endslot
    @endcomponent
@endsection

@section('content')
    <div class="container">
        <a href="{{route('category_life.create')}}" class="btn btn-success my-3">Создать раздел</a>
        @foreach($categories_life as $category_life)
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-3">
                        <img class="card-img w-100" style="max-height:300px;object-fit: cover;"
                             src="{{ asset('/storage/category_life/' .  $category_life->image) }}" alt="{{$category_life->title}}">
                    </div>
                    <div class="col-md-9 d-flex py-3 pr-3">
                        <div class="col-md-9">
                            <h4 class="card-title mt-3">{{$category_life->title}}</h4>
                            <p class="card-text"><small class="text-muted">Дата создания: {{ date('d.m.Y', strtotime($category_life->created_at)) }}</small></p>
                        </div>
                        <div class="container col-md-3">
                            <div class="row no-gutters">
                                <form class="col-12" onsubmit="return confirm('Удалить? Буду удалены все связанные фото и видео альбомы.');" action="{{ route('category_life.destroy', $category_life->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger mb-2 col-12">Удалить</button>
                                </form>
                                <a href="{{route('category_life.edit', $category_life->id)}}" class="btn btn-warning mb-2 col-12">Редактировать</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div>
            {{$categories_life->links()}}
        </div>
    </div>
@endsection
