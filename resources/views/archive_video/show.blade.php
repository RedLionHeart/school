@extends('layouts.main')
@section('content')
   <div>
       <div>Родительская категория: {{$video_archive->categoryArchive->title}}</div>
       <div>Заголовок: {{$video_archive->title}}</div>
       <div>Описание: {!! $video_archive->content !!}</div>
   </div>

@endsection
