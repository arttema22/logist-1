@extends('layouts.app')

@section('title')Новый адрес@endsection

@section('content')
<div class="container px-4 py-5">
    <h1 class="mt-5">Новый адрес</h1>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="post" action="{{route('directory.address-new-save')}}">
        @csrf
        <div class="form-floating mb-3">
            <input type="text" name="title" id="floatingInput" placeholder="Название" class="form-control form-control-lg" value="{{old('title')}}">
            <label for="floatingInput">Название</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" name="address" id="floatingInput" placeholder="Адрес" class="form-control form-control-lg" value="{{old('address')}}">
            <label for="floatingInput">Адрес</label>
        </div>
        <div class="form-check mb-3">
            <input type="checkbox" name="loading-point" id="flexCheckLp" placeholder="Точка погрузки" class="form-check-input" value="0">
            <label for="flexCheckLp">Точка погрузки</label>
        </div> 
        <div class="form-check mb-3">
            <input type="checkbox" name="unloading-point" id="flexCheckUp" placeholder="Точка разгрузки" class="form-check-input" value="0">
            <label for="flexCheckUp">Точка разгрузки</label>
        </div>        
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary btn-lg">Сохранить</button>
            <a class="btn btn-outline-secondary btn-lg" href="{{route('directory.address')}}" role="button">Отмена</a>
        </div>
    </form>
</div>
@endsection