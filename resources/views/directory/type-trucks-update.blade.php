@extends('layouts.app')

@section('title')Изменить тип грузовика@endsection

@section('content')
<div class="container px-4 py-5">
    <h1 class="mt-5">Изменить тип грузовика</h1>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="post" action="{{route('directory.type-trucks-update-save', $TypeTrucks->id)}}">
        @csrf
        <div class="form-floating mb-3">
            <input type="text" name="title" id="floatingInput" placeholder="Название" class="form-control form-control-lg" value="{{$TypeTrucks->title}}">
            <label for="floatingInput">Название</label>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is-service" id="is-service" placeholder="Разрешено оказание дополнительных услуг" class="form-check-input" value="{{$TypeTrucks->is_service}}" @if ($TypeTrucks->is_service) checked @endif>
            <label for="is-service">Разрешено оказание дополнительных услуг</label>
        </div> 
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary btn-lg">Сохранить</button>
            <a class="btn btn-outline-secondary btn-lg" href="{{route('directory.type-trucks')}}" role="button">Отмена</a>
        </div>
    </form>
</div>
@endsection