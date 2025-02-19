@extends('layouts.app')

@section('title')Тарифы по расстоянию@endsection

@section('content')
<h1 class="mt-5">Тарифы по расстоянию</h1>
@if(count($DistanceBilling))
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Тип</th>
            <th scope="col">до 15 км.</th>
            <th scope="col">до 30 км.</th>
            <th scope="col">до 60 км.</th>
            <th scope="col">свыше 60 км.</th>
            <th scope="col">свыше 300 км.</th>
            <th scope="col">Управление</th>
        </tr>
    </thead>
    <tbody>
        @foreach($DistanceBilling as $DistBill)
        <tr>
            <td>{{$DistBill->typeTruck->title}}</td>
            <td>{{$DistBill->up_15_km}}</td>
            <td>{{$DistBill->up_30_km}}</td>
            <td>{{$DistBill->up_60_km}}</td>
            <td>{{$DistBill->more_60_km}}</td>
            <td>{{$DistBill->more_300_km}}</td>
            <td><a href="{{ route('billing.distance-edit', $DistBill->id) }}" class="btn btn-outline-primary btn-sm">Изменить</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

@endsection