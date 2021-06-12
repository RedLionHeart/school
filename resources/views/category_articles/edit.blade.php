@extends('layouts.main')
@section('content')

    <form class="mt-3 w-100" action="{{route('category_articles.update', $category->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="form-group">
            <label class="font-weight-bold" for="title">Название категории *</label>
            <input type="text" class="form-control" name="title" id="title" required value="{{$category->title}}">
        </div>
        {{--<div class="form-group">
            <label class="font-weight-bold" for="slug">Slug(url) *</label>
            <input type="text" class="form-control" name="slug" id="slug" required value="{{$category->slug}}">
        </div>
--}}
        <div class="form-group">
            <label class="font-weight-bold" for="parent">Родительская категория</label>
            <select class="form-control" name="parent_id" id="parent">
                <option disabled="" selected>Не выбрано</option>
                @foreach($categories as $cat)
                    <option
                        {{$cat->id === $category-> parent_id ? 'selected' : ''}}
                        value="{{$cat->id}}">{{$cat->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary">Обновить</button>
        </div>
    </form>

@endsection
