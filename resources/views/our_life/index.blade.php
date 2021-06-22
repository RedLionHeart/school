@foreach($categories_life as $category)
    <div class="card">
        <h3 class="card-title">{{$category->title}}</h3>
        <div>
            <a href="{{$category->archivePhoto->slug}}" class="card-text">{{$category->archivePhoto->title}}</a>
        </div>
        <div>
            <a href="{{$category->archiveVideo->slug}}" class="card-text">{{$category->archiveVideo->title}}</a>
        </div>
    </div>
@endforeach
