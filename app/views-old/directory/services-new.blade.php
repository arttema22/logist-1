@extends('layouts.app')

@section('title')Новая услуга@endsection

@section('content')
<div class="container px-4 py-5">
    <h1 class="mt-5">Новая услуга</h1>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="post" action="{{route('directory.services-new-save')}}">
        @csrf
        <div class="form-floating mb-3">
            <input type="text" name="title" id="title" placeholder="Название" class="form-control form-control-lg" value="{{old('title')}}">
            <label for="title">Название</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" step="any" name="price" id="price" placeholder="Стоимость" class="form-control form-control-lg" value="{{old('price')}}">
            <label for="price">Стоимость</label>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary btn-lg">Сохранить</button>
            <a class="btn btn-outline-secondary btn-lg" href="{{route('directory.services')}}" role="button">Отмена</a>
        </div>
    </form>
</div>
@endsection