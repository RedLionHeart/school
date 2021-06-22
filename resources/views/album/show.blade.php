@extends('layouts.main')
@section('content')
   <div>
       <div>Архив: {{$album->archive->title}}</div>
       <div>Заголовок: {{$album->title}}</div>
       <img class="card-img w-100" style="max-height:300px;object-fit: cover;"
            src="{{ asset('/storage/albums_preview/' .  $album->preview) }}" alt="{{$album->title}}">
       <div>Описание: {!! $album->description !!}</div>
   </div>

@endsection
