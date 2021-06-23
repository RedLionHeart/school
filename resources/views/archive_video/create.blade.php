@extends('layouts.main')
@section('content')

    <form class="mt-3 w-100" action="{{route('archive_video.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="font-weight-bold" for="title">Заголовок страницы видео *</label>
            <input type="text" class="form-control" name="title" id="title" required value="{{old('title')}}">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="content">Описание страницы видео</label>
            <textarea type="text" class="form-control tinymce" name="description" id="content" cols="10" style="min-height: 300px">{{old('description')}}</textarea>
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="category">Раздел</label>
            <select class="form-control" name="category_id" id="category">
                @foreach($categories as $category)
                    <option value="{{$category->id}}" {{old('category_id') == $category->id ? 'selected' : ''}}>{{$category->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary">Создать</button>
        </div>
    </form>

@endsection
