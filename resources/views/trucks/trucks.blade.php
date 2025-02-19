@extends('layouts.app')

@section('title')Список грузовиков@endsection

@section('content')
@if(count($Trucks))
<h1 class="mt-5">Список грузовиков</h1>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Водитель</th>
            <th scope="col">Тип</th>
            <th scope="col">Гос.номер</th>
            <th scope="col">Владелец</th>
            <th scope="col">Управление</th>
        </tr>
    </thead>
    <tbody>
        @foreach($Trucks as $Truck)
        <tr>
            <th scope="row">{{$loop->index+1}}</th>
            <td>{{$Truck->users_id}}</td>
            <td>{{$Truck->type_trucks_id}}</td>
            <td>{{$Truck->truck_number}}</td>
            <td>{{$Truck->truck_owner}}</td>
            <td><a href="{{ route('setup.type-trucks-update', $Truck->id) }}" class="btn btn-outline-primary btn-sm">Изменить</a>
                <!-- Кнопка удаления записи -->
                <!-- Обязательно подключение include('inc.modal-delete') -->
                <!-- data-bs-url - содержит ссылку на удаление -->
                <button type="button" class="btn btn-outline-danger btn-sm btn-del-modal"
                        data-bs-url="{{ route('setup.type-trucks-delete', $Truck->id) }}"
                        data-bs-toggle="modal" data-bs-target="#staticBackdrop">Удалить</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@include('inc.modal-delete')
@endif
<div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5 pt-5">
    <a class="btn btn-primary btn-lg" href="{{route('trucks.new')}}" role="button">Новый</a>
</div>
@endsection