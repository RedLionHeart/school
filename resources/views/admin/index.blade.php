@extends('layouts.admin')

@section('breadcrumbs')
    @component('includes.admin.breadcrumbs')
        @slot('title') Главная @endslot
        @slot('parent') Главная @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Последние 3 новости:</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($last_three_news as $news)
                            <tr>
                                <td style="width: 80%;">{{$news->title}}</td>
                                <td>
                                    <a href="{{route('news.edit', $news->id)}}" class="btn btn-warning mb-2"><i class="fa fa-edit"></i></a>
                                </td>
                                <td>
                                    <a href="{{route('news.show', $news->id)}}" class="btn btn-success" target="_blank"><i class="far fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Последние 3 статьи:</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($last_three_articles as $article)
                            <tr>
                                <td style="width: 80%;">{{$article->title}}
                                <p>
                                    <span class="font-weight-bold">Категория:</span>
                                    {{$article->category->title}}
                                </p>
                                </td>
                                <td>
                                    <a href="{{route('article.edit', $article->id)}}" class="btn btn-warning mb-2"><i class="fa fa-edit"></i></a>
                                </td>
                                <td>
                                    <a href="{{route('article.show', $article->id)}}" class="btn btn-success" target="_blank"><i class="far fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
@endsection
