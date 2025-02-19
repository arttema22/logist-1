@extends('layouts.app')

@section('title')Адреса погрузки/разгрузки@endsection

@section('content')
<h1 class="mt-5">Адреса погрузки/разгрузки</h1>
@if(count($Addreses))
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Адрес</th>
            <th scope="col">Точка погрузки</th>
            <th scope="col">Точка разгрузки</th>
            <th scope="col">Управление</th>
        </tr>
    </thead>
    <tbody>
        @foreach($Addreses as $Address)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$Address->title}}</td>
            <td>{{$Address->address}}</td>
            <td>
                @if($Address->loading_point)
                Да
                @endif
            </td>
            <td>
                @if($Address->unloading_point)
                Да
                @endif
            </td>
            <td><a href="{{ route('directory.address-update', $Address->id) }}" class="btn btn-outline-primary btn-sm">Изменить</a>
                @if($Address->status)
                <!-- Кнопка удаления записи -->
                <!-- Обязательно подключение include('inc.modal-delete') -->
                <!-- data-bs-url - содержит ссылку на удаление -->
                <button type="button" class="btn btn-outline-danger btn-sm btn-del-modal"
                        data-bs-url="{{ route('directory.address-delete', $Address->id) }}"
                        data-bs-toggle="modal" data-bs-target="#staticBackdrop">Удалить</button>
                @else
                <a href="{{ route('directory.address-recover', $Address->id) }}" class="btn btn-outline-secondary btn-sm">Восстановить</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@include('inc.modal-delete')
@endif

<div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5 pt-5">
    <a class="btn btn-primary btn-lg" href="{{route('directory.address-new')}}" role="button">Новый</a>
</div>
@endsection