@extends('layouts.app')

@section('title')Новый грузовик@endsection

@section('content')
<div class="container px-4 py-5">
    <h1 class="mt-5">Новый грузовик</h1>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="post" action="{{route('trucks.new-save')}}">
        @csrf
        <!-- Список пользователей -->
        @if(count($users))
        <select name="users-id" id="floatingInput" class="form-select form-select-lg mb-3" aria-label="Водитель">
            <option value="0" selected>Водитель</option>
            @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
        @else
        <div class="alert alert-danger" role="alert">
            В системе нет пользователя. Для начала работы необходимо <a href="#" class="alert-link">завести пользователя</a>.
        </div>
        @endif
        <!-- Список пользователей конец -->

        <!-- Список типов авто -->
        @if(count($typetrucks))
        <select name="type-trucks-id" id="floatingInput" class="form-select form-select-lg mb-3" aria-label="Тип грузовика">
            <option value="0" selected>Тип грузовика</option>
            @foreach($typetrucks as $typetruck)
            <option value="{{$typetruck->id}}">{{$typetruck->title}}</option>
            @endforeach
        </select>
        @else
        <div class="alert alert-danger" role="alert">
            В системе нет типов грузовиков. Для начала работы необходимо <a href="#" class="alert-link">завести тип автомобиля</a>.
        </div>
        @endif
        <!-- Список типов авто конец -->
        <div class="form-floating mb-3">
            <input type="text" name="truck-number" id="floatingInput" placeholder="Гос. номер" class="form-control form-control-lg" value="{{old('truck-number')}}">
            <label for="floatingInput">Гос. номер</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" name="truck-owner" id="floatingInput" placeholder="Владелец" class="form-control form-control-lg" value="{{old('truck-owner')}}">
            <label for="floatingInput">Владелец</label>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary btn-lg">Сохранить</button>
            <a class="btn btn-outline-secondary btn-lg" href="{{route('trucks.list')}}" role="button">Отмена</a>
        </div>
    </form>
</div>
@endsection