@extends('layouts.app')

@section('title')Сверки@endsection

@section('content')
<div class="d-flex justify-content-between mt-5 mb-5">
    <h1>Сверки</h1>
    <a href="{{route('revise.store')}}" class="btn btn-primary">Новая сверка</a>
</div>

@if(count($Users))
@foreach($Users as $User)
<div class="card mb-5">
    <div class="card-body">
        {{$User->profile->FullName}}
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Период</th>
                        <th scope="col">Начальный остаток</th>
                        <th scope="col">Начислено</th>
                        <th scope="col">Выплачено</th>
                        <th scope="col">Конечный остаток</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $added = 0;
                    $paid = 0;
                    @endphp
                    @foreach($User->driverRevise as $Revis)
                    @php
                    $added = $added + $Revis->added; 
                    $paid = $paid + $Revis->paid;
                    @endphp
                    <tr>
                        <td>{{$Revis->revise->date_start}} - {{$Revis->revise->date_end}}</td>
                        <td>{{$Revis->balance_start}}</td>
                        <td>{{$Revis->added}}</td>
                        <td>{{$Revis->paid}}</td>
                        <td>{{$Revis->balance_end}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">Итого:</th>
                        <th>{{$added}}</th>
                        <th>{{$paid}}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endforeach
@endif
@endsection