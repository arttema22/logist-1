@extends('layouts.app')

@section('title')Общая сверка@endsection

@section('content')
@include('inc.filter-profit')
<nav class="navbar">
    <div class="container-fluid">
        @cannot('is-driver')
        {{-- <a class="btn btn-outline-success btn-sm" href="{{ route('profit.export-all') }}">Экспорт всех</a> --}}
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
                        <th>Период</th>
                        <th>Сальдо начальное</th>
                        <th>Выплачено</th>
                        <th>Начислено</th>
                        <th>Сумма за период</th>
                        {{-- <th>Сальдо конечное</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $User->profit->where('status', 1)->sortBy('date') as $Profit )
                    <tr>
                        <td>{{$Profit->title}}</td>
                        <td>{{$Profit->saldo_start}}</td>
                        <td>@if ($Profit->sum_salary != 0){{$Profit->sum_salary}}@endif</td>
                        <td>@if ($Profit->sum_accrual != 0){{$Profit->sum_accrual}}@endif</td>
                        <td>@if ($Profit->sum_amount){{$Profit->sum_amount}}@endif</td>
                        {{-- <td>{{$Profit->saldo_end}}</td> --}}
                    </tr>
                    @endforeach
                    <tr class="table-info">
                        @php
                        $_monthsList = array(
                        "1"=>"Январь","2"=>"Февраль","3"=>"Март",
                        "4"=>"Апрель","5"=>"Май", "6"=>"Июнь",
                        "7"=>"Июль","8"=>"Август","9"=>"Сентябрь",
                        "10"=>"Октябрь","11"=>"Ноябрь","12"=>"Декабрь");

                        $month = $_monthsList[date("n")];
                        echo '<td>'. $month .'</td>';
                        $sumRefilling = $User->driverRefilling->where('status', 1)->sum('cost_car_refueling');
                        $sumRoute = $User->driverRoute->where('status', 1)->sum('summ_route');
                        $sumService = $User->driverService->where('status', 1)->sum('sum');

                        $saldoStart = $User->profit->last()->saldo_end;
                        echo '<td>'.$saldoStart.'</td>';

                        $sumSalary = $User->driverSalary->where('status', 1)->sum('salary');
                        echo '<td>'.$sumSalary.'</td>';

                        $sumService = $User->driverService->where('status', 1)->sum('sum');

                        if ($sumService != 0) {
                        $sumAccrual = $sumRoute + $sumService;
                        } else {
                        $sumAccrual = $sumRoute - $sumRefilling;
                        }

                        echo '<td>'.$sumAccrual.'</td>';

                        $sumAmount = $sumAccrual - $sumSalary;
                        echo '<td>'.$sumAmount.'</td>';

                        $saldoEnd = $saldoStart + $sumAmount;
                        // echo '<td>'.$saldoEnd.'</td>';

                        @endphp
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Итого:</th>
                        <th></th>
                        <th>
                            {{-- {{$User->profit->where('status', 1)->where('date','<=', $dateProfit)->
                                sum('sum_salary')+$sumSalary}} --}}
                        </th>
                        <th>
                            {{-- {{$User->profit->where('status', 1)->where('date','<=', $dateProfit)->
                                sum('sum_accrual')+$sumAccrual}} --}}
                        </th>
                        <th>
                            {{-- {{$User->profit->where('status', 1)->sortBy('date')->last()->saldo_end;}} // --}}
                            {{$saldoEnd}}
                            {{-- //
                            {{ ($User->profit->where('status', 1)->where('date','<=', $dateProfit)->
                                sum('sum_accrual')+$sumAccrual) - ($User->profit->where('status', 1)->where('date','<=',
                                    $dateProfit)->
                                    sum('sum_salary')+$sumSalary) }} --}}
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="card-footer navbar">
        <i></i>
        <a class="btn btn-outline-success btn-sm" href="{{ route('profit.export-archive', [$User->id]) }}"
            role="button">Экспорт</a>
    </div>
</div>
@endforeach
@endsection
