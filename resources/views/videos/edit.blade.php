@extends('layouts.main')
@section('content')

    <form class="mt-3 w-100" action="{{route('video.update', $video->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="form-group">
            <label class="font-weight-bold" for="title">Заголовок видео *</label>
            <input type="text" class="form-control" name="title" id="title" required value="{{$video->title}}">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="category">Архив видео</label>
            <select class="form-control" name="archive_id" id="category">
                @foreach($categories as $category)
                    <option value="{{$category->id}}" {{$category->id === $video->archive->id ? 'selected' : ''}}>{{$category->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="link">Ссылка на видео</label>
            <input type="text" class="form-control" name="link" id="link" required value="{{$video->link}}">
        </div>
        <div class="iframe-container"></div>
        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary">Обновить</button>
        </div>
    </form>

    <script>
        const link = document.querySelector('#link');
        link.addEventListener('input', insertIframe);
        insertIframe();

        function insertIframe() {
            const link = document.querySelector('#link');
            const container = document.querySelector('.iframe-container');
            container.innerHTML = '';

            let iframe = document.createElement('iframe');
            iframe.width = '100%';
            iframe.height = '360px';

            iframe.src = 'https://www.youtube.com/embed/' + getIdVideo(link.value) + '?feature=oembed';
            container.appendChild(iframe);
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
