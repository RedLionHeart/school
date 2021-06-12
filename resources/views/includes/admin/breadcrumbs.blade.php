<div class="col-sm-6">
    <h1 class="m-0">{{$title}}</h1>
</div><!-- /.col -->

<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">{{$parent}}</a></li>
        @if(isset($active))
            <li class="breadcrumb-item active">{{$active}}</li>
        @endif
    </ol>
</div><!-- /.col -->
