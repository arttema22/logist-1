@extends('layouts.app')

@section('title')Панель@endsection

@section('content')
<div class="container py-4" id="hanging-icons">
    <div class="row g-4 py-4 row-cols-1 row-cols-lg-2">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h5>Маршруты <span class="badge rounded-pill text-bg-success">{{$RoutesActive}} /
                            {{$RoutesAll}}</span></h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Сервис работы с маршрутами.</p>
                    <a href="{{route('routes.create')}}" class="btn btn-primary">Новый маршрут</a>
                    <a href="{{route('routes.list')}}" class="btn btn-outline-primary">Список</a>
                    <a href="{{route('routes.archive')}}" class="card-link">Архив</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h5>Заправки <span class="badge rounded-pill text-bg-success">{{$RefillingsActive}} /
                            {{$RefillingsAll}}</span></h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Сервис работы с заправками автомобиля.</p>
                    <a href="{{route('refilling.create')}}" class="btn btn-primary">Новая заправка</a>
                    <a href="{{route('refilling.list')}}" class="btn btn-outline-primary">Список</a>
                    <a href="{{route('refilling.archive')}}" class="card-link">Архив</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h5>Выплаты <span class="badge rounded-pill text-bg-success">{{$SalaryActive}} /
                            {{$SalaryAll}}</span></h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Сервис работы с выплатами.</p>
                    <a href="{{route('salary.create')}}" class="btn btn-primary">Новая выплата</a>
                    <a href="{{route('salary.list')}}" class="btn btn-outline-primary">Список</a>
                    <a href="{{route('salary.archive')}}" class="card-link">Архив</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h5>Расчеты</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Сервис расчетов и сверок.</p>
                    <a href="{{route('profit.list')}}" class="btn btn-outline-primary">Текщие</a>
                    <a href="{{route('profit.archive')}}" class="btn btn-outline-primary">Общая сверка</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
