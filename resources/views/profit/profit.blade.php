@extends('layouts.app')

@section('title')Текущие расчеты@endsection

@section('content')
@include('inc.filter-profit')

@foreach ( $Users as $User)
@if (count($User->driverSalary->where('status', 1)->where('date', '<=', $dateProfit)) or count($User->
    driverRefilling->where('status', 1)->where('date', '<=', $dateProfit)) or count($User->driverRoute->where('status',
        1)->where('date', '<=', $dateProfit))) <div class="card mb-3">
            <div class="card-header navbar">
                <h5>{{ $User->profile->fullName }}</h5>
                <i>с {{$User->profit->last()->created_at}} по {{$dateProfit}}</i>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 15%">Дата</th>
                                <th>Документ</th>
                                <th style="width: 15%">Выплаты
                                    <span class="badge text-bg-danger">
                                        {{$User->driverSalary->where('status', 1)->where('date', '<=', $dateProfit)->
                                            count()}}
                                    </span>
                                </th>
                                <th style="width: 15%">Заправки
                                    <span class="badge text-bg-danger">
                                        {{$User->driverRefilling->where('status', 1)->where('date', '<=', $dateProfit)->
                                            count()}}
                                    </span>
                                </th>
                                <th style="width: 15%">Маршруты
                                    <span class="badge text-bg-danger">
                                        {{$User->driverRoute->where('status', 1)->where('date', '<=', $dateProfit)->
                                            count()}}
                                    </span>
                                </th>
                                <th style="width: 10%">Услуги</th>
                                <th style="width: 10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Сальдо начальное</th>
                                <td></td>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>{{ $User->profit->last()->saldo_end }}</th>
                            </tr>
                            @foreach ( $User->driverSalary->where('status', 1)->where('date', '<=', $dateProfit)->
                                sortByDesc('date') as $Salary )
                                <tr class="table-secondary">
                                    <td>{{ $Salary->date }}</td>
                                    <td>{{ $Salary->comment }}</td>
                                    <td>{{ $Salary->salary }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @endforeach

                                @foreach ( $User->driverRefilling->where('status', 1)->where('date', '<=',
                                    $dateProfit)->sortByDesc('date') as $Refilling )
                                    <tr>
                                        <td>{{ $Refilling->date }}</td>
                                        <td>
                                            {{ $Refilling->petrolStation->title }}. Заправлено
                                            {{ $Refilling->num_liters_car_refueling }} л. по
                                            {{ $Refilling->price_car_refueling }} руб.
                                        </td>
                                        <td></td>
                                        <td>{{ $Refilling->cost_car_refueling }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                    @foreach ( $User->driverRoute->where('status', 1)->where('date', '<=',
                                        $dateProfit)->sortByDesc('date') as $Route )
                                        <tr class="table-warning">
                                            <td>{{ $Route->date }}</td>
                                            <td>
                                                @if ($Route->typeTruck->is_service)
                                                @php
                                                $isService = 1;
                                                @endphp
                                                @endif
                                                {{ $Route->address_loading }} -
                                                {{ $Route->address_unloading }}
                                                {{ $Route->route_length }}.
                                                {{ $Route->typeTruck->title }}.
                                                {{ $Route->cargo->title }}.
                                                {{ $Route->payer->title }}.
                                                Рейсов - {{ $Route->number_trips }}.
                                                Стоимость - {{ $Route->price_route }} руб.
                                                Доп. расходы - {{ $Route->unexpected_expenses }} руб.<br>
                                                {{ $Route->comment }}
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td>{{ $Route->summ_route }}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        @foreach ( $Route->services->where('status', 1)->where('date', '<=',
                                            $dateProfit) as $Service ) <tr class="table-warning">
                                            <td></td>
                                            <td>
                                                {{ $Service->service->title }}.
                                                Количество - {{ $Service->number_operations }} по цена
                                                {{ $Service->price }} руб.
                                                {{ $Service->comment }}
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>{{ $Service->sum }}</td>
                                            <td></td>
                                            </tr>
                                            @endforeach
                                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2">Обороты за период</th>
                                <th>{{ $User->driverSalary->where('status', 1)->where('date', '<=', $dateProfit)->
                                        sum('salary')
                                        }}</th>
                                <th>{{ $User->driverRefilling->where('status', 1)->where('date', '<=', $dateProfit)->
                                        sum('cost_car_refueling') }}</th>
                                <th>{{ $User->driverRoute->where('status', 1)->where('date', '<=', $dateProfit)->
                                        sum('summ_route') }}</th>
                                <th>{{ $User->driverService->where('status', 1)->where('date', '<=', $dateProfit)->
                                        sum('sum') }}
                                </th>
                                <th>
                                    @if ($isService)
                                    @php
                                    $sumPeriod = $User->driverRoute->where('status', 1)->where('date', '<=',
                                        $dateProfit)->sum('summ_route') +
                                        $User->driverService->where('status', 1)->where('date', '<=', $dateProfit)->
                                            sum('sum') -
                                            $User->driverSalary->where('status', 1)->where('date', '<=', $dateProfit)->
                                                sum('salary');
                                                @endphp
                                                @else
                                                @php
                                                $sumPeriod =$User->driverRoute->where('status', 1)->where('date', '<=',
                                                    $dateProfit)->sum('summ_route') -
                                                    $User->driverRefilling->where('status', 1)->where('date', '<=',
                                                        $dateProfit)->sum('cost_car_refueling') -
                                                        $User->driverSalary->where('status', 1)->where('date', '<=',
                                                            $dateProfit)->sum('salary');
                                                            @endphp
                                                            @endif
                                                            {{$sumPeriod}}
                                </th>
                            </tr>
                            <tr>
                                <th colspan="6">Сальдо конечное</th>
                                <th>
                                    {{ $User->profit->last()->saldo_end + $sumPeriod }}
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="card-footer navbar">
                @cannot('is-driver')
                <a class="btn btn-danger btn-sm" href="{{ route('profit.close', $User->id) }}" role="button">Закрыть
                    период</a>
                @endcan
                <a class="btn btn-outline-success btn-sm" href="{{ route('profit.export', [$User->id, $dateProfit]) }}"
                    role="button">Экспорт</a>
            </div>
            </div>

            @php
            $isService = 0;
            @endphp

            @endif

            @endforeach

            @cannot('is-driver')
            {{-- <div class="text-end my-1">
                <a class="btn btn-danger btn-sm" href="{{ route('profit.close-all') }}" role="button">Закрыть период для
                    всех</a>
            </div> --}}
            @endcan
            @endsection
