@extends('layouts.admin')

@section('breadcrumbs')
    @component('includes.admin.breadcrumbs')
        @slot('title') Видео @endslot
        @slot('parent') Главная @endslot
        @slot('active') Видео @endslot
    @endcomponent
@endsection

@section('content')
    <div class="container">
        <a href="{{route('video.create')}}" class="btn btn-success my-3">Создать видео</a>
        @foreach($videos as $video)
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-5">
                        <div class="ratio ratio-16x9 iframe_data" data-link="{{$video->link}}"></div>
                    </div>
                    <div class="col-md-7 d-flex py-3 pr-3">
                        <div class="col-md-9">
                            <div class="card-text">
                                <span class="badge bg-primary">{{$video->archive->title}}</span>
                            </div>
                            <h4 class="card-title mt-3">{{$video->title}}</h4>
                            <p class="card-text"><small class="text-muted">Дата создания: {{ date('d.m.Y', strtotime($video->created_at)) }}</small></p>
                        </div>
                        <div class="container col-md-3">
                            <div class="row no-gutters">
                                <form class="col-12" onsubmit="return confirm('Удалить?');" action="{{ route('video.destroy', $video->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger mb-2 col-12">Удалить</button>
                                </form>
                                <a href="{{route('video.edit', $video->id)}}" class="btn btn-warning mb-2 col-12">Редактировать</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div>
            {{$videos->links()}}
        </div>
    </div>
    <script>
        renderIframeContainers();
        function renderIframeContainers() {
            const links = document.querySelectorAll('.iframe_data');

            links.forEach(function (item) {
                item.appendChild(createIframe(item.dataset.link));
            });
        }

        function createIframe(video) {
            let iframe = document.createElement('iframe');
            iframe.width = '100%';
            iframe.height = '256px';
            iframe.style.display = 'block';

            iframe.src = 'https://www.youtube.com/embed/' + getIdVideo(video) + '?feature=oembed';

            return iframe;
        }
        function getIdVideo(url) {
            const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
            const match = url.match(regExp);

            return (match && match[2].length === 11)
                ? match[2]
                : null;
        }
    </script>
@endsection
