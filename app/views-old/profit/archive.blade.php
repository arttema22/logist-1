@extends('layouts.app')

@section('title')Общая сверка@endsection

@section('content')
<nav class="navbar">
    <div class="container-fluid">
        <h1>Общая сверка</h1>
        @cannot('is-driver')
        <a class="btn btn-outline-success btn-sm" href="{{ route('profit.export-all') }}">Экспорт всех</a>
        @endcan
    </div>
</nav>

@foreach ( $Users as $User)
<div class="card mb-3">
    <div class="card-header navbar">
        <h5>{{ $User->profile->fullName }}</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Дата</th>
                        <th>Сальдо начальное</th>
                        <th>Выплаты</th>
                        <th>Заправки</th>
                        <th>Маршруты</th>
                        <th>Услуги</th>
                        <th>Сальдо конечное</th>
                        <th>Комментарий</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $User->profit as $Profit )
                    <tr>
                        <td>{{$Profit->date}}</td>
                        <td>{{$Profit->saldo_start}}</td>
                        <td>{{$Profit->sum_salary}}</td>
                        <td>{{$Profit->sum_refuelings}}</td>
                        <td>{{$Profit->sum_routes}}</td>
                        <td>{{$Profit->sum_services}}</td>
                        <td>{{$Profit->saldo_end}}</td>
                        <td>{{$Profit->comment}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer navbar">
        <i></i>
        <a class="btn btn-outline-success btn-sm" href="{{ route('profit.export-archive', $User->id) }}"
            role="button">Экспорт</a>
    </div>
</div>
@endforeach
@endsection
