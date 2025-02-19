@extends('layouts.auth')

@section('title')Вход@endsection

@section('content')
<style>
    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>
<form method="post" action="{{ route('user.login') }}">
    @csrf
    <img class="mb-4" src="/img/logo-rle.png" alt="" width="72">
    <h1 class="h3 mb-3 fw-normal">Пожалуйста войдите</h1>
    <div class="form-floating">
        <input name="email" type="email" class="form-control" id="email" value="{{old('email')}}"
            placeholder="Ваш email">
        <label for="email">Ваш email</label>
        @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-floating">
        <input name="password" type="password" class="form-control" id="password" placeholder="Password">
        <label for="password">Пароль</label>
        @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Войти</button>
</form>
@endsection