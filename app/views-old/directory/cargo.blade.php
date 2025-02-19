@extends('layouts.app')

@section('title')Перевозимые грузы@endsection

@section('content')
@if(count($Cargos))
<div class="d-flex justify-content-between">
    <h1>Перевозимые грузы</h1>
    <div class="btn-group align-self-baseline" role="group" aria-label="Basic checkbox toggle button group">
        <input type="checkbox" class="btn-check" id="btncheck1" autocomplete="off">
        <label class="btn btn-outline-primary btn-sm" for="btncheck1">Активные</label>

        <input type="checkbox" class="btn-check" id="btncheck2" autocomplete="off">
        <label class="btn btn-outline-primary btn-sm" for="btncheck2">Удаленные</label>

    </div>
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Управление</th>
        </tr>
    </thead>
    <tbody>
        @foreach($Cargos as $Cargo)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$Cargo->title}}</td>
            <td><a href="{{ route('directory.cargo-update', $Cargo->id) }}"
                    class="btn btn-outline-primary btn-sm">Изменить</a>
                @if($Cargo->status)
                <!-- Кнопка удаления записи -->
                <!-- Обязательно подключение include('inc.modal-delete') -->
                <!-- data-bs-url - содержит ссылку на удаление -->
                <button type="button" class="btn btn-outline-danger btn-sm btn-del-modal"
                    data-bs-url="{{ route('directory.cargo-delete', $Cargo->id) }}" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop">Удалить</button>
                @else
                <a href="{{ route('directory.cargo-recover', $Cargo->id) }}"
                    class="btn btn-outline-secondary btn-sm">Восстановить</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@include('inc.modal-delete')
@endif

<div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5 pt-5">
    <a class="btn btn-primary btn-lg" href="{{route('directory.cargo-new')}}" role="button">Новый</a>
</div>
@endsection
