@extends('layouts.app')

@section('title')Панель@endsection

@section('content')

<div class="container px-4 py-5" id="hanging-icons">
    <h2 class="pb-2 border-bottom">Сервисы</h2>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-2">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h5>Маршруты</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Сервис работы с маршрутами. Не забывайте подать данные.</p>
                    <a href="{{route('routes.create')}}" class="card-link">Новый маршрут</a>
                    <a href="{{route('routes.list')}}" class="card-link">Список</a>
                    <a href="{{route('routes.archive')}}" class="card-link">Архив</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h5>Заправки</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Сервис работы с заправками автомобиля. Не забывайте подать данные.</p>
                    <a href="{{route('refilling.create')}}" class="card-link">Новая заправка</a>
                    <a href="{{route('refilling.list')}}" class="card-link">Список</a>
                    <a href="{{route('refilling.archive')}}" class="card-link">Архив</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h5>Выплаты</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Сервис работы с выплатами.</p>
                    <a href="{{route('salary.create')}}" class="card-link">Новая выплата</a>
                    <a href="{{route('salary.list')}}" class="card-link">Список</a>
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
                    <p class="card-text">Сервис работы с начислениями зарплаты.</p>
                    <a href="{{route('profit.list')}}" class="card-link">Список</a>
                    <a href="{{route('profit.archive')}}" class="card-link">Архив</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
