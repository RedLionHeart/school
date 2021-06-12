@extends('layouts.main')
@section('content')
   <div>
       <div>{{$news->id}}.{{$news->title}}</div>
       <div>{!! $news->content !!}</div>
   </div>

@endsection
