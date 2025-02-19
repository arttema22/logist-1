@extends('layouts.app')

@section('title')Данные для расчета@endsection

@section('content')
@include('inc.filter-profit')

@if (count($Salaries) or count($Routes) or count($Refillings))
<form action="{{ route('profit.store') }}" method="post">
    @csrf
    <!-- Карточка с начислениями -->
    @if (count($Salaries))
    <h4>Начисления</h4>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-primary">
                <tr>
                    <th scope="col" style="width: 1%">#</th>
                    <th scope="col" style="width: 5%">Дата</th>
                    @cannot('is-driver')
                    <th scope="col">Водитель</th>
                    @endcan
                    <th scope="col" style="width: 60%"></th>
                    <th scope="col" style="width: 10%">Сумма</th>
                    @cannot('is-driver')
                    <th scope="col" style="width: 1%">Согласие</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($Salaries as $Salary)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $Salary->date }}</td>
                    @cannot('is-driver')
                    <td>{{ $Salary->driver->profile->full_name }}</td>
                    @endcan
                    <td>{{ $Salary->comment }}</td>
                    <td>
                        <h6>{{ $Salary->salary }} руб.</h6>
                    </td>
                    @cannot('is-driver')
                    <td>
                        <input class="form-check-input" type="checkbox" name="salary[{{ $Salary->id }}]" value="{{ $Salary->id }}" checked>
                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    @can('is-driver')
                    <td colspan="3">
                        @else
                    <td colspan="4">
                        @endcan
                        Всего начислений: {{ $Salaries->count() }}
                    </td>
                    <td>
                        <h6>{{ $Salaries->sum('salary') }} руб.</h6>
                    </td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
    @else
    <h4 class="mt-5">Начислений нет <a href="{{ route('salary.create') }}" class="btn btn-link">Новое начисление</a>
    </h4>
    @endif

    <!-- Карточка с маршрутами -->
    @if (count($Routes))
    <h4>Маршруты</h4>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-primary">
                <tr>
                    <th scope="col" style="width: 1%">#</th>
                    <th scope="col" style="width: 5%">Дата</th>
                    @cannot('is-driver')
                    <th scope="col">Водитель</th>
                    @endcan
                    <th scope="col" style="width: 60%"></th>
                    <th scope="col" style="width: 10%">Сумма</th>
                    @cannot('is-driver')
                    <th scope="col" style="width: 1%">Согласие</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($Routes as $Route)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $Route->date }}</td>
                    @cannot('is-driver')
                    <td>{{ $Route->driver->profile->full_name }}</td>
                    @endcan
                    <td>
                        {{ $Route->address_loading }} - {{ $Route->address_unloading }} ({{$Route->route_length}} км.)
                        @if (count($Route->services))
                        @foreach ($Route->services as $Service)
                        <br>{{ $Service->service->title }}: {{ $Service->price }} x {{ $Service->number_operations }} =
                        {{ $Service->sum }} руб. ({{ $Service->comment }})
                        @endforeach
                        @endif
                    </td>
                    <td>
                        <h6>{{ $Route->summ_route }} руб.</h6>
                        <h6>{{ $Route->services->sum('sum') }} руб.</h6>
                    </td>
                    @cannot('is-driver')
                    <td>
                        <input class="form-check-input" type="checkbox" name="route[{{ $Route->id }}]" value="{{ $Route->id }}" checked>
                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    @can('is-driver')
                    <td colspan="3">
                        @else
                    <td colspan="4">
                        @endcan
                        Всего за маршруты: {{ $Routes->count() }}
                    </td>
                    <td>
                        <h6>{{ $Routes->sum('summ_route') }} руб.</h6>
                    </td>
                    <td></td>
                <tr>
                    @can('is-driver')
                    <td colspan="3">
                        @else
                    <td colspan="4">
                        @endcan
                        Всего за услуги: {{ $Route->services->where('status', 1)->count() }}
                    </td>
                    <td>
                        <h6>{{ $Route->services->where('status', 1)->sum('sum') }} руб.</h6>
                    </td>
                    <td></td>
                </tr>
                </tr>
            </tfoot>
        </table>
    </div>
    @else
    <h4 class="mt-5">Маршрутов нет <a href="{{ route('routes.create') }}" class="btn btn-link">Новый
            маршрут</a>
    </h4>
    @endif

    <!-- Карточка с заправками -->
    @if (count($Refillings))
    <h4>Заправки</h4>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-primary">
                <tr>
                    <th scope="col" style="width: 1%">#</th>
                    <th scope="col" style="width: 5%">Дата</th>
                    @cannot('is-driver')
                    <th scope="col">Водитель</th>
                    @endcan
                    <th scope="col" style="width: 60%"></th>
                    <th scope="col" style="width: 10%">Сумма</th>
                    @cannot('is-driver')
                    <th scope="col" style="width: 1%">Согласие</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($Refillings as $Refilling)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $Refilling->date }}</td>
                    @cannot('is-driver')
                    <td>{{ $Refilling->driver->profile->full_name }}</td>
                    @endcan
                    <td>{{ $Refilling->num_liters_car_refueling }} л. {{ $Refilling->price_car_refueling }} руб.</td>

                    <td>
                        <h6>{{ $Refilling->cost_car_refueling }} руб.</h6>
                    </td>
                    @cannot('is-driver')
                    <td>
                        <input class="form-check-input" type="checkbox" name="refilling[{{ $Refilling->id }}]" value="{{ $Refilling->id }}" checked>
                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    @can('is-driver')
                    <td colspan="3">
                        @else
                    <td colspan="4">
                        @endcan
                        Всего начислений: {{ $Refillings->count() }}
                    </td>
                    <td>
                        <h6>{{ $Refillings->sum('cost_car_refueling') }} руб.</h6>
                    </td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
    @else
    <h4 class="mt-5">Заправок нет <a href="{{ route('refilling.create') }}" class="btn btn-link">Новая
            заправка</a></h4>
    @endif
    @cannot('is-driver')
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <input type="submit" class="btn btn-primary btn-lg" value="Произвести расчет">
    </div>
    @endcan
</form>
@else
<h1 class="mt-5">Нет данных для расчетов</h1>
<p>Для производства рассчетов необходимо создать хоть одну запись.</p>
<div class="container px-4 py-5" id="hanging-icons">
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
        <div class="col d-flex align-items-start">
            <div>
                <h2>Маршруты</h2>
                <p>Сервис работы с маршрутами. Не забывайте подать данные.</p>
                <a href="{{ route('routes.list') }}" class="btn btn-primary">Перейти</a>
                <a href="{{ route('routes.create') }}" class="btn btn-outline-primary">Новый маршрут</a>
            </div>
        </div>
        <div class="col d-flex align-items-start">
            <div>
                <h2>Заправки</h2>
                <p>Сервис работы с заправками автомобиля. Не забывайте подать данные.</p>
                <a href="{{ route('refilling.list') }}" class="btn btn-primary">Перейти</a>
                <a href="{{ route('refilling.create') }}" class="btn btn-outline-primary">Новая заправка</a>
            </div>
        </div>
        @cannot('is-driver')
        <div class="col d-flex align-items-start">
            <div>
                <h2>Начисления</h2>
                <p>Сервис работы с начислениями зарплаты.</p>
                <a href="{{ route('salary.list') }}" class="btn btn-primary">Перейти</a>
                <a href="{{ route('salary.create') }}" class="btn btn-outline-primary">Новое начисление</a>
            </div>
        </div>
        @endcan
    </div>
</div>
@endif
@endsection
