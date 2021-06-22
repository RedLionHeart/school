@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/min/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>

    <div class="tab-container">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="pills-main-tab" data-toggle="pill" href="#pills-main" role="tab" aria-controls="pills-main" aria-selected="true">Основной контент</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-images-tab" data-toggle="pill" href="#pills-images" role="tab" aria-controls="pills-images" aria-selected="false">Фотографии альбома</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-main" role="tabpanel" aria-labelledby="pills-main-tab">
                <form id="main-content-form" class="mt-3 w-100" action="{{route('album.update', $album->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label class="font-weight-bold" for="title">Название альбома *</label>
                        <input type="text" class="form-control" name="title" id="title" required value="{{$album->title}}">
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold" for="content">Описание альбома</label>
                        <textarea type="text" class="form-control tinymce" name="description" id="content" cols="10" style="min-height: 300px">{{$album->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="category">Категория</label>
                        <select class="form-control" name="archive_id" id="category">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{$category->id === $album->archive->id ? 'selected' : ''}}>{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        @if(!empty($album->preview))
                            <img class="mw-100" style="max-height: 500px;max-width:500px;" src="{{ asset('/storage/albums_preview/' .  $album->preview) }}" alt="{{$album->title}}" id="image_container">
                        @else
                            <img class="mw-100" src="/images/upload-1.png" alt="Загрузить картинку" id="image_container">
                        @endif
                        <div class="col-3">

                        </div>
                        <div class="col-9">
                            <label class="font-weight-bold" for="image">Изображение обложки</label>
                            <input type="file" class="form-control-file" id="image" name="image_file" onchange="readURL(this)">
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="pills-images" role="tabpanel" aria-labelledby="pills-images-tab">
                <table class="table uploaded-image">
                    <thead>
                    <tr>
                        <th scope="col">Картинка</th>
                        <th scope="col">Название</th>
                        <th scope="col">Действия</th>
                    </tr>
                    </thead>
                    <tbody class="start">
                    @if($photos->isNotEmpty())
                        @foreach($photos as $photo)
                            <tr>
                                <th><img style="max-width:100px;" src="{{ asset('/storage/photos_albums/' .  $photo->path) }}" alt=""></th>
                                <td>{{$photo->path}}</td>
                                <td><button type="submit" data-id="{{$photo->id}}" class="btn btn-danger mb-2 col-12 remove_image">Удалить</button></td>
                            </tr>
                        @endforeach
                    @else
                        <tr><td>Фото не найдено</td></tr>
                    @endif
                    </tbody>
                </table>
                <div class="container">
                    <h2 class="text-center">Загрузите картинки</h2><br/>
                    <form method="post" action="{{route('album_image.store', $album->id)}}" enctype="multipart/form-data"
                          class="dropzone" id="dropzone">
                        @csrf
                        <input type="hidden" name="album_id" value="{{$album->id}}">
                    </form>
                    <div class="form-group text-center">
                        <button type="button" class="btn btn-primary mt-3" id="submit-all">Загрузить фотографии</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group mt-4">
        <button type="submit" form="main-content-form" class="btn btn-primary">Обновить альбом</button>
    </div>


    <script type="text/javascript">
        Dropzone.prototype.defaultOptions.dictDefaultMessage = 'Нажмите или перенесите фото сюда для загрузки';
        Dropzone.options.dropzone =
            {
                uploadMultiple: true,
                autoProcessQueue : false,
                paramName: "photo_files",
                maxFilesize: 10,
                renameFile: function (file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time + file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                init:function(){
                    var submitButton = document.querySelector("#submit-all");
                    myDropzone = this;

                    submitButton.addEventListener('click', function(){
                        myDropzone.processQueue();
                    });
                    this.on("successmultiple", function (files, response) {
                        var _this = this;
                        _this.removeAllFiles();
                        load_images();
                    });
                    this.on("complete", function(){

                    });
                }
            };

        let uploadedImages = document.querySelector('.uploaded-image tbody');
        function load_images()
        {

            $.ajax({
                url:"{{ route('album_image.fetch', $album->id) }}",
                type: 'GET',
                dataType: 'json',
                success:function(data)
                {
                    if(uploadedImages.classList.contains('start')){
                        uploadedImages.classList.remove('start');
                        uploadedImages.innerHTML = '';
                    }
                    data.images.forEach(function (item) {
                let output = `<tr>
                    <th><img style="max-width:100px;" src="{{ asset('/storage/photos_albums/')}}/${item.path}" alt=""></th>
                    <td>${item.path}</td>
                    <td><button type="submit" data-id="${item.id}" class="btn btn-danger mb-2 col-12 remove_image">Удалить</button></td>
                </tr>`;

                $('.uploaded-image tbody').append(output);
                });
                },
                error:function(data){
                    console.log(data);
                }
            });

        }

        window.onload = function(){
            $(document).on('click', '.remove_image', function(){
                var that = $(this);
                var name = that.data('id');
                var token = $("meta[name='csrf-token']").attr("content");

                $.ajax({
                    url:"/album_image/"+name,
                    type: 'DELETE',
                    data:{name : name,
                        "_token": token,},
                    success:function(data){
                        that.closest('tr').remove();
                    },
                    error:function (response) {
                        console.log(response);
                    }
                })
            });
        }

    </script>
    <style>
        .tab-container{
            width: 100%;
            padding: 1.5rem;
            margin: 1rem -15px 0;
        }
    </style>

@endsection
