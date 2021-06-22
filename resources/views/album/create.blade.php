@extends('layouts.main')
@section('content')
    <form id="main-content-form" class="mt-3 w-100" action="{{route('album.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="font-weight-bold" for="title">Название альбома *</label>
            <input type="text" class="form-control" name="title" id="title" required value="{{old('title')}}">
        </div>

        <div class="form-group">
            <label class="font-weight-bold" for="content">Описание альбома</label>
            <textarea type="text" class="form-control tinymce" name="description" id="content" cols="10" style="min-height: 300px">{{old('description')}}</textarea>
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="category">Архив</label>
            <select class="form-control" name="archive_id" id="category">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group row">
            <div class="col-3">
                <img class="mw-100" src="/images/upload-1.png" alt="Загрузить картинку" id="image_container">
            </div>
            <div class="col-9">
                <label class="font-weight-bold" for="image">Изображение обложки</label>
                <input type="file" class="form-control-file" id="image" name="image_file" onchange="readURL(this)">
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @error('fileMulti')
        {{$message}}
        @enderror
        <label class="multi-upload-label">
            Нажмите чтобы загрузить файлы
            <input type="file" id="fileMulti" name="fileMulti[]" multiple size="4096" />
        </label>

        <div id="output" class="row mt-3"></div>
        <div class="form-group mt-4">
            <button type="submit" form="main-content-form" class="btn btn-primary">Создать альбом</button>
        </div>

    </form>

    <script>
        //let store = [];
        const outputContainer = document.getElementById('output');
        function handleFileSelect(evt) {

            outputContainer.innerHTML = '';
            var file = evt.target.files; // FileList object

            /*const filesInput = Object.keys(evt.target.files).map((i) => evt.target.files[i]);

            store = store.concat(filesInput);
            console.log(store);
            let formData = new FormData();
            for (let i = 0; i < store.length; i++) {
                formData.append(store[i].name, store[i])
            }*/

            // Loop through the FileList and render image files as thumbnails.
            for (var i = 0, f; f = file[i]; i++) {
                // Only process image files.
                if (!f.type.match('image.*')) {
                    alert("Загружайте только картинки....");
                }
                if(f.size > 4096000){
                    alert('Файл слишком большой, максимальный размер 4 Мб');
                    continue;
                }
                var reader = new FileReader();
                // Closure to capture the file information.
                reader.onload = (function (theFile) {
                    return function (e) {
                        // Render thumbnail.
                        var div = document.createElement('div');
                        div.classList.add('col-3', 'thumb-container');
                        div.innerHTML = `
                        <img class="thumb col-12" title="${escape(theFile.name)}" src="${e.target.result}"/>
                        <button class="mt-2 btn btn-danger remove_image">Удалить</button>
                        `;
                        outputContainer.insertBefore(div, null);
                    };
                })(f);
                // Read in the image file as a data URL.
                reader.readAsDataURL(f);
            }
        }

        document.getElementById('fileMulti').addEventListener('change', handleFileSelect, false);

        window.onload = function(){
            $(document).on('click', '.remove_image', function(){

            });
        }

    </script>
    <style>
        .tab-container{
            width: 100%;
            padding: 1.5rem;
            margin: 1rem -15px 0;
        }
        .thumb{
            height: 200px;
            object-fit: cover;
        }
        .thumb-container{
            text-align: center;
            margin-bottom: .5rem;
        }
        .multi-upload-label{
            cursor: pointer;
            outline: 2px dashed #5d5d5d;
            outline-offset: -12px;
            background-color: #e0f2f7;
            color: #1f3c44;
            width: 100%;
            height: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-weight: bold;
        }
        .multi-upload-label input{
            display: none;
        }
    </style>

@endsection
