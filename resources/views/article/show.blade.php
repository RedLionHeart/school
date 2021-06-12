@extends('layouts.main')
@section('content')
   <div>
       <div>{{$article->id}}.{{$article->title}}</div>
       <div>{!! $article->content !!}</div>
   </div>

@endsection
