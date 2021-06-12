<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-header">Разделы</li>
        <li class="nav-item">
            <a href="{{route('admin.news.index')}}" class="nav-link">
                <i class="nav-icon far fa-newspaper"></i>
                <p>
                    Новости
                    <span class="badge badge-info right">{{$all_news->total()}}</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Блог
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('admin.article.index')}}" class="nav-link">
                        <i class="far fa-newspaper nav-icon"></i>
                        <p>Статьи<span class="badge badge-info right">{{$articles->total()}}</span></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.category_articles.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Категории</p>
                    </a>
                </li>
            </ul>
        </li>
        @can('view', auth()->user())
        <li class="nav-item">
            <a href="{{route('admin.user.index')}}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Пользователи
                </p>
            </a>
        </li>
        @endcan
    </ul>
</nav>
<!-- /.sidebar-menu -->
