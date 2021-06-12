@extends('layouts.main')
@section('content')

    <form class="mt-3 w-100" action="{{route('article.update', $article->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="form-group">
            <label class="font-weight-bold" for="title">Название новости *</label>
            <input type="text" class="form-control" name="title" id="title" required value="{{$article->title}}">
        </div>
        {{--<div class="form-group">
            <label class="font-weight-bold" for="slug">Slug(url) *</label>
            <input type="text" class="form-control" name="slug" id="slug" required value="{{$article->slug}}">
        </div>--}}
        <div class="form-group">
            <label class="font-weight-bold" for="content">Описание новости</label>
            <textarea type="text" class="form-control tinymce" name="content" id="content" cols="10" style="min-height: 300px">{{$article->content}}</textarea>
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="category">Категория</label>
            <select class="form-control" name="category_id" id="category">
                @foreach($categories as $category)
                    <option value="{{$category->id}}" disabled>{{$category->title}}</option>
                    @foreach($category->subcategories as $cat)
                        <option
                            {{$cat->id === $article->category->id ? 'selected' : ''}}
                            value="{{$cat->id}}">&mdash; {{$cat->title}}</option>
                    @endforeach
                @endforeach
            </select>
        </div>
        <div class="form-group row">
            @if(!empty($article->image))
                <img class="mw-100" style="max-height: 500px;max-width:500px;" src="{{ asset('/storage/articles_img/' .  $article->image) }}" alt="{{$article->title}}" id="image_container">
            @else
                <img class="mw-100" src="/images/upload-1.png" alt="Загрузить картинку" id="image_container">
            @endif
            <div class="col-3">

            </div>
            <div class="col-9">
                <label class="font-weight-bold" for="image">Изображение обложки</label>
                <input type="file" class="form-control-file" id="image" name="image_file" onchange="readURL(this)">
            </div>
        </div>


        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary">Обновить</button>
        </div>
    </form>

@endsection
