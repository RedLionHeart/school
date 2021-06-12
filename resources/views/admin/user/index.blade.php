@extends('layouts.admin')

@section('breadcrumbs')
    @component('includes.admin.breadcrumbs')
        @slot('title') Пользователи @endslot
        @slot('parent') Главная @endslot
        @slot('active') Пользователи @endslot
    @endcomponent
@endsection

@section('content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Имя</th>
                <th scope="col">Email</th>
                <th scope="col">Роль пользователя</th>
            </tr>
            </thead>
            <tbody>
            @foreach($all_users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    @if ($user->role === 2)
                        <td>Администратор</td>
                    @elseif ($user->role === 1)
                        <td>Менеджер</td>
                    @else
                        <td>Пользователь</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
            {{$all_users->links()}}
        </div>
    </div>
@endsection
