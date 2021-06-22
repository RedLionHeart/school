@extends('layouts.main')
@section('content')
   <div>
       <div>Родительская категория: {{$archive->categoryArchive->title}}</div>
       <div>Заголовок: {{$archive->title}}</div>
       <div>Описание: {!! $archive->content !!}</div>
   </div>

@endsection
