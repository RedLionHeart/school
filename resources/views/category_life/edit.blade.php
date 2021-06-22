@extends('layouts.main')
@section('content')

    <form class="mt-3 w-100" action="{{route('category_life.update', $category->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="form-group">
            <label class="font-weight-bold" for="title">Название раздела *</label>
            <input type="text" class="form-control" name="title" id="title" required value="{{$category->title}}">
        </div>
        <div class="form-group row">
            @if(!empty($category->image))
                <img class="mw-100" style="max-height: 500px;max-width:500px;" src="{{ asset('/storage/category_life/' .  $category->image) }}" alt="{{$category->title}}" id="image_container">
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
