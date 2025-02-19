@extends('layouts.app')

@section('title')Типы грузовиков@endsection

@section('content')
<h1 class="mt-5">Типы грузовиков</h1>
@if(count($TypeTrucks))
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Доп. услуги</th>
            <th scope="col">Управление</th>
        </tr>
    </thead>
    <tbody>
        @foreach($TypeTrucks as $TypeTruck)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$TypeTruck->title}}</td>
            <td>@if($TypeTruck->is_service)
                Да
                @endif
            </td>
            <td><a href="{{ route('directory.type-trucks-update', $TypeTruck->id) }}" class="btn btn-outline-primary btn-sm">Изменить</a>
                @if($TypeTruck->status)
                <!-- Кнопка удаления записи -->
                <!-- Обязательно подключение include('inc.modal-delete') -->
                <!-- data-bs-url - содержит ссылку на удаление -->
                <button type="button" class="btn btn-outline-danger btn-sm btn-del-modal"
                        data-bs-url="{{ route('directory.type-trucks-delete', $TypeTruck->id) }}"
                        data-bs-toggle="modal" data-bs-target="#staticBackdrop">Удалить</button>
                @else
                <a href="{{ route('directory.type-trucks-recover', $TypeTruck->id) }}" class="btn btn-outline-secondary btn-sm">Восстановить</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@include('inc.modal-delete')
@endif

<div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5 pt-5">
    <a class="btn btn-primary btn-lg" href="{{route('directory.type-trucks-new')}}" role="button">Новый</a>
</div>
@endsection