@extends('layouts.main')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="mt-3 w-100" action="{{route('category_life.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="font-weight-bold" for="title">Название раздела *</label>
            <input type="text" class="form-control" name="title" id="title" required value="{{old('title')}}">
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

        <div id="output" class="row mt-3"></div>
        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary">Создать раздел</button>
        </div>
    </form>

@endsection
