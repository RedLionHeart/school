<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Document</title>

</head>
<body>
<div class="container">
    <div class="row">
        @yield('content')
    </div>
</div>

<script src="/js/tinymce/tinymce.min.js"></script>
<script src="{{asset('js/app.js')}}"></script>

<script>
    $(document).ready(function () {
        tinymce.init({
            selector: '.tinymce',
            theme: 'modern',
            width: '100%',

            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
            ],
            toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
            toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code | caption",
            image_caption: true,
            image_advtab: true,

            external_filemanager_path: "/filemanager/",
            filemanager_title: "Responsive Filemanager",
            external_plugins: {"filemanager": "/filemanager/plugin.min.js"},
            visualblocks_default_state: true,
            relative_urls: false,
            remove_script_host: false,
            convert_urls: true,

            style_formats_autohide: true,
            style_formats_merge: true,
        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();

            reader.onload = function (e) {
                $('#image_container').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</body>
</html>
