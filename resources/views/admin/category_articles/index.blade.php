@extends('layouts.admin')

@section('breadcrumbs')
    @component('includes.admin.breadcrumbs')
        @slot('title') Блог @endslot
        @slot('parent') Главная @endslot
        @slot('active') Категории @endslot
    @endcomponent
@endsection

@section('content')
    <div class="container">
        <a href="{{route('category_articles.create')}}" class="btn btn-success my-3">Создать категорию</a>
        @foreach($categories_articles as $category)
            <div class="card mb-3">
                <div class="row g-0 p-3">
                    <div class="col-md-7">
                        <h4 class="card-title mt-3">{{$category->title}}</h4>
                        @if(isset($category->parent))
                        <p class="card-text mt-2"><span class="font-weight-bold">Родительская категория:</span> {{$category->parent->title}}</p>
                        @endif
                        <p class="card-text"><small class="text-muted">Дата создания: {{ date('d.m.Y', strtotime($category->created_at)) }}</small></p>
                    </div>
                    <div class="col-md-5 d-flex align-items-center">
                        <form class="col-6" onsubmit="return confirm('Удалить?');" action="{{ route('category_articles.destroy', $category->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger mb-2 col-12">Удалить</button>
                        </form>
                        <a href="{{route('category_articles.edit', $category->id)}}" class="btn btn-warning mb-2 col-6">Редактировать</a>
                    </div>
                </div>
            </div>
        @endforeach

        <div>
            {{$categories_articles->links()}}
        </div>
    </div>
@endsection
