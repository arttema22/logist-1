@extends('layouts.app')

@section('title')
Изменить пользователя
@endsection

@section('content')
<div class="container px-4 py-5">
    <h1 class="mt-5">Изменить пользователя</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="post" action="{{ route('user.update', $User->id) }}">
        @csrf
        <div class="form-floating mb-3">
            <input name="last-name" type="text" class="form-control form-control-lg" id="last-name"
                value="{{ $User->profile->last_name }}" placeholder="Фамилия">
            <label for="last-name">Фамилия</label>
        </div>
        <div class="form-floating mb-3">
            <input name="first-name" type="text" class="form-control form-control-lg" id="first-name"
                value="{{ $User->profile->first_name }}" placeholder="Имя">
            <label for="first-name">Имя</label>
        </div>
        <div class="form-floating mb-3">
            <input name="sec-name" type="text" class="form-control form-control-lg" id="sec-name"
                value="{{ $User->profile->sec_name }}" placeholder="Отчество">
            <label for="sec-name">Отчество</label>
        </div>
        <div class="form-floating mb-3">
            <input name="phone" type="text" class="form-control form-control-lg" id="phone"
                value="{{ $User->profile->phone }}" placeholder="Телефон">
            <label for="phone">Телефон</label>
        </div>
        @cannot('is-driver')
        @foreach ($Roles as $Role)
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" id="role-radios{{ $Role->id }}"
                value="{{ $Role->id }}" @if ($User->role_id == $Role->id) checked @endif>
            <label class="form-check-label" for="role{{ $Role->id }}">
                {{ $Role->title }}
            </label>
        </div>
        @endforeach
        @endcan
        <div class="form-floating mb-3">
            <input name="name" type="text" class="form-control form-control-lg" id="name" value="{{ $User->name }}"
                placeholder="Имя">
            <label for="name">Имя</label>
        </div>
        <div class="form-floating mb-3">
            <input name="email" type="email" class="form-control form-control-lg" id="email" value="{{ $User->email }}"
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
            @can('is-driver')
            <a class="btn btn-outline-secondary btn-lg" href="{{ route('home') }}" role="button">Отмена</a>
            @else
            <a class="btn btn-outline-secondary btn-lg" href="{{ route('user.list') }}" role="button">Отмена</a>
            @endcan
        </div>
    </form>
</div>
@endsection
