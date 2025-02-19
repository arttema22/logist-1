@extends('layouts.app')

@section('title'){{__('refilling.refillings')}}Заправки@endsection

@section('content')

@if(count($FuelSuppliers))
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Организация</th>
                <th>Договор</th>
                <th>Баланс</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($FuelSuppliers as $FuelSupplier)
            <tr>
                <td>
                    {{ $FuelSupplier->name }}<br>
                    <small class="text-muted"><em>ИНН:{{ $FuelSupplier->inn }}/КПП:{{ $FuelSupplier->kpp }}</em></small>
                </td>
                <td>
                    {{ $FuelSupplier->number }}<br>
                    <small class="text-muted"><em>от {{$FuelSupplier->date}}</em></small>
                </td>
                <td>
                    <h5>{{$FuelSupplier->balance}}</h5>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
@include('inc.list-empty')
@endif
@endsection