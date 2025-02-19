@extends('layouts.app')

@section('title')Тарифы по маршруту@endsection

@section('content')
<nav class="navbar">
    <div class="container-fluid">
        <h1>Тарифы по маршруту</h1>
        @cannot('is-driver')
        <form class="d-flex" method="get">
            <input type="text" name="start" id="start" class="form-control form-control-lg me-1">
            <button type="submit" class="btn btn-primary me-2"><i class="bi bi-filter"></i></button>
            <a class="btn btn-outline-primary" href="{{route('billing.route')}}"><i class="bi bi-arrow-repeat"></i></a>
        </form>
        @endcan
    </div>
</nav>
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        {{$RouteBilling->withQueryString()->links()}}
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            </ul>
            <a class="btn btn-success" href="{{route('billing.route-create')}}" role="button"><i
                    class="bi bi-plus"></i></a>
        </div>
    </div>
</nav>

<div class="accordion accordion-flush" id="accordionFlushRoutes">

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse" aria-expanded="false" aria-controls="flush-collapse">
                Последние 20 записей
            </button>
        </h2>
        <div id="flush-collapse" class="accordion-collapse collapse" aria-labelledby="flush-heading"
            data-bs-parent="#accordionFlushRoutes">
            <div class="accordion-body">
                <table class="table table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col" style="width: 10%">Дата</th>
                            <th scope="col" style="width: 30%">Начало маршрута</th>
                            <th scope="col" style="width: 30%">Конец маршрута</th>
                            <th scope="col" style="width: 10%">Расстояние</th>
                            <th scope="col" style="width: 10%">Цена</th>
                            <th scope="col" style="width: 10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($LastRoutes as $LastRoute)
                        <tr>
                            <td>{{$LastRoute->created_at}}</td>
                            <td>{{$LastRoute->start }}</td>
                            <td>{{$LastRoute->finish }}</td>
                            <td>{{$LastRoute->length }}</td>
                            <td>{{$LastRoute->price }}</td>
                            <td>
                                <a href="{{ route('billing.route-edit', $LastRoute->id) }}"
                                    class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-pencil"></i></a>
                                <!-- Кнопка удаления записи -->
                                <!-- Обязательно подключение include('inc.modal-delete') -->
                                <!-- data-bs-url - содержит ссылку на удаление -->
                                <button type="button" class="btn btn-outline-danger btn-sm btn-del-modal"
                                    data-bs-url="{{ route('billing.route-destroy', $LastRoute->id) }}"
                                    data-bs-type="тарифного маршрута" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@if (count($RouteBilling))
<table class="table table-hover">
    <thead class="table-primary">
        <tr>
            <th scope="col" style="width: 35%">Начало маршрута</th>
            <th scope="col" style="width: 35%">Конец маршрута</th>
            <th scope="col" style="width: 10%">Расстояние</th>
            <th scope="col" style="width: 10%">Цена</th>
            <th scope="col" style="width: 10%"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($RouteBilling as $RouteBill)
        <tr>
            <td>{{ $RouteBill->start }}</td>
            <td>{{ $RouteBill->finish }}</td>
            <td>{{ $RouteBill->length }}</td>
            <td>{{ $RouteBill->price }}</td>
            <td>
                <a href="{{ route('billing.route-edit', $RouteBill->id) }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-pencil"></i></a>
                <!-- Кнопка удаления записи -->
                <!-- Обязательно подключение include('inc.modal-delete') -->
                <!-- data-bs-url - содержит ссылку на удаление -->
                <button type="button" class="btn btn-outline-danger btn-sm btn-del-modal"
                    data-bs-url="{{ route('billing.route-destroy', $RouteBill->id) }}" data-bs-type="тарифного маршрута"
                    data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bi bi-trash"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@include('inc.modal-delete')
@endif
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        {{$RouteBilling->withQueryString()->links()}}
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            </ul>
            <a class="btn btn-success" href="{{route('billing.route-create')}}" role="button"><i
                    class="bi bi-plus"></i></a>
        </div>
    </div>
</nav>
@endsection
