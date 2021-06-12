@extends('layouts.main')
@section('content')

    <form class="mt-3 w-100" action="{{route('article.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="font-weight-bold" for="title">Название статьи *</label>
            <input type="text" class="form-control" name="title" id="title" required value="{{old('title')}}">
        </div>
        {{--<div class="form-group">
            <label class="font-weight-bold" for="slug">Slug(url)</label>
            <input type="text" class="form-control" name="slug" id="slug" value="{{old('slug')}}">
        </div>--}}
        <div class="form-group">
            <label class="font-weight-bold" for="content">Описание статьи</label>
            <textarea type="text" class="form-control tinymce" name="content" id="content" cols="10" style="min-height: 300px">{{old('content')}}</textarea>
        </div>
        {{--<div class="form-group">
            <label class="font-weight-bold" for="image">Картинка</label>
            <input type="text" class="form-control" name="image" id="image" value="{{old('image')}}">
        </div>--}}
        <div class="form-group">
            <label class="font-weight-bold" for="category">Категория</label>
            <select class="form-control" name="category_id" id="category">
                @foreach($categories as $category)
                    <option value="{{$category->id}}" disabled="">{{$category->title}}</option>
                    @foreach($category->subcategories as $cat)
                        <option value="{{$cat->id}}">&mdash; {{$cat->title}}</option>
                    @endforeach
                @endforeach
            </select>
        </div>
        <div class="form-group row">
            <div class="col-3">
                <img class="mw-100" src="/images/upload-1.png" alt="Загрузить картинку" id="image_container">
            </div>
            <div class="col-9">
                <label class="font-weight-bold" for="image">Изображение обложки</label>
                <input type="file" class="form-control-file" id="image" name="image_file" onchange="readURL(this)">
            </div>
        </div>
        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary">Создать</button>
        </div>
    </form>

@endsection
