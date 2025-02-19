@extends('layouts.app')

@section('title')Новый пользователь@endsection

@section('content')
<div class="container px-4 py-5">
    <h1 class="mt-5">Новый пользователь</h1>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="post" action="{{ route('user.store') }}">
        @csrf
        <div class="form-floating mb-3">
            <input name="last-name" type="text" class="form-control form-control-lg" id="last-name"
                value="{{old('last-name')}}" placeholder="Фамилия">
            <label for="last-name">Фамилия</label>
        </div>
        <div class="form-floating mb-3">
            <input name="first-name" type="text" class="form-control form-control-lg" id="first-name"
                value="{{old('first-name')}}" placeholder="Имя">
            <label for="first-name">Имя</label>
        </div>
        <div class="form-floating mb-3">
            <input name="sec-name" type="text" class="form-control form-control-lg" id="sec-name"
                value="{{old('sec-name')}}" placeholder="Отчество">
            <label for="sec-name">Отчество</label>
        </div>
        <div class="form-floating mb-3">
            <input name="saldo" type="number" step="any" class="form-control form-control-lg" id="saldo"
                value="{{old('saldo')}}" placeholder="Начальное сальдо">
            <label for="saldo">Начальное сальдо</label>
        </div>
        <div class="form-floating mb-3">
            <input name="phone" type="text" class="form-control form-control-lg" id="phone" value="{{old('phone')}}"
                placeholder="Телефон">
            <label for="phone">Телефон</label>
        </div>
        @foreach($Roles as $Role)
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" id="role-radios{{$Role->id}}"
                value="{{$Role->id}}">
            <label class="form-check-label" for="role{{$Role->id}}">
                {{$Role->title}}
            </label>
        </div>
        @endforeach
        <div class="form-floating mb-3">
            <input name="name" type="text" class="form-control form-control-lg" id="name" value="{{old('name')}}"
                placeholder="Имя для входа">
            <label for="name">Имя для входа</label>
        </div>
        <div class="form-floating mb-3">
            <input name="email" type="email" class="form-control form-control-lg" id="email" value="{{old('email')}}"
                placeholder="email">
            <label for="email">email</label>
        </div>
        <div class="form-floating mb-3">
            <input name="password" type="password" class="form-control form-control-lg" id="password"
                placeholder="Пароль">
            <label for="password">Пароль</label>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary btn-lg">Сохранить</button>
            <a class="btn btn-outline-secondary btn-lg" href="{{route('user.list')}}" role="button">Отмена</a>
        </div>
    </form>
</div>
@endsection
