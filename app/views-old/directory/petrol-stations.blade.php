@extends('layouts.app')

@section('title')АЗС@endsection

@section('content')
<h1 class="mt-5">Список АЗС</h1>
@if(count($PetStations))
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Управление</th>
        </tr>
    </thead>
    <tbody>
        @foreach($PetStations as $PetStation)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$PetStation->title}}</td>
            <td><a href="{{ route('directory.petrol-stations-update', $PetStation->id) }}" class="btn btn-outline-primary btn-sm">Изменить</a>
                @if($PetStation->status)
                <!-- Кнопка удаления записи -->
                <!-- Обязательно подключение include('inc.modal-delete') -->
                <!-- data-bs-url - содержит ссылку на удаление -->
                <button type="button" class="btn btn-outline-danger btn-sm btn-del-modal"
                        data-bs-url="{{ route('directory.petrol-stations-delete', $PetStation->id) }}"
                        data-bs-toggle="modal" data-bs-target="#staticBackdrop">Удалить</button>
                @else
                <a href="{{ route('directory.petrol-stations-recover', $PetStation->id) }}" class="btn btn-outline-secondary btn-sm">Восстановить</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@include('inc.modal-delete')
@endif

<div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5 pt-5">
    <a class="btn btn-primary btn-lg" href="{{route('directory.petrol-stations-new')}}" role="button">Новый</a>
</div>
@endsection