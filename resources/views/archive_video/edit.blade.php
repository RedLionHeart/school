@extends('layouts.main')
@section('content')

    <form class="mt-3 w-100" action="{{route('archive_video.update', $archive->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="form-group">
            <label class="font-weight-bold" for="title">Заголовок страницы видео *</label>
            <input type="text" class="form-control" name="title" id="title" required value="{{$archive->title}}">
        </div>

        <div class="form-group">
            <label class="font-weight-bold" for="content">Описание страницы видео</label>
            <textarea type="text" class="form-control tinymce" name="description" id="content" cols="10" style="min-height: 300px">{{$archive->description}}</textarea>
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="category">Раздел</label>
            <select class="form-control" name="category_id" id="category">
                @foreach($categories as $category)
                    <option value="{{$category->id}}" {{$category->id === $archive->categoryArchive->id ? 'selected' : ''}}>{{$category->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary">Обновить</button>
        </div>
    </form>

@endsection
