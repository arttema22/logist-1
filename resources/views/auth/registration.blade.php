@extends('layouts.auth')

@section('title')Регистрация@endsection

@section('content')
<form method="post" action="{{ route('user.registration') }}" class="form-signin">
    @csrf
    <img class="mb-4" src="img/logo-rle.png" alt="" width="72">
    <h1 class="h3 mb-3 fw-normal">Пожалуйста зарегистрируйтесь</h1>
    <div class="form-floating">
        <input name="last-name" type="text" class="form-control" id="last-name" value="{{old('last-name')}}"
            placeholder="Фамилия">
        <label for="last-name">Фамилия</label>
        @error('last-name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-floating">
        <input name="first-name" type="text" class="form-control" id="first-name" value="{{old('first-name')}}"
            placeholder="Имя">
        <label for="first-name">Имя</label>
        @error('first-name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-floating">
        <input name="sec-name" type="text" class="form-control" id="sec-name" value="{{old('sec-name')}}"
            placeholder="Отчество">
        <label for="sec-name">Отчество</label>
        @error('sec-name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-floating">
        <input name="name" type="text" class="form-control" id="name" value="{{old('name')}}" placeholder="Ваше имя">
        <label for="name">Ваше имя</label>
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-floating">
        <input name="saldo" type="number" step="any" class="form-control" id="saldo" value="{{old('saldo')}}"
            placeholder="Начальное сальдо">
        <label for="saldo">Начальное сальдо</label>
        @error('saldo')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-floating">
        <input name="email" type="email" class="form-control" id="email" value="{{old('email')}}"
            placeholder="Ваш email">
        <label for="email">Ваш email</label>
        @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-floating">
        <input name="password" type="password" class="form-control" id="password" placeholder="Пароль">
        <label for="password">Пароль</label>
        @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Зарегистрироваться</button>
    <p class="mt-5 mb-3 text-muted"><a href="{{ route('user.login') }}">Вход</a></p>
</form>
@endsection
