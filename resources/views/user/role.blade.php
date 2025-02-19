@extends('layouts.app')

@section('title')Роли пользователей@endsection

@section('content')
<h1 class="mt-5">Роли пользователей</h1>
@if(count($Roles))
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Пользователи</th>
            <th scope="col">Управление</th>
        </tr>
    </thead>
    <tbody>
        @foreach($Roles as $Role)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$Role->title}}</td>
            <td>
                @foreach($Role->users as $User)
                <span class="badge bg-primary">{{$User->profile->FullName}}</span>
                @endforeach
            </td>
            <td><a href="{{ route('user.role-update', $Role->id) }}" class="btn btn-outline-primary btn-sm">Изменить</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@include('inc.modal-delete')
@endif

@endsection