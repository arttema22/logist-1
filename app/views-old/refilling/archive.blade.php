@extends('layouts.app')

@section('title')Архив заправок@endsection

@section('content')
<link rel="stylesheet" href="/css/tablesort.css">
<script src='/js/tablesort.min.js'></script>
@include('inc.filter-refilling')
@if(count($Refillings))

<div class="table-responsive">
    <table class="table table-hover" id="sort-table">
        <thead class="table-primary">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Дата заправки</th>
                @cannot('is-driver')
                <th scope="col">Водитель</th>
                @endcan
                <th scope="col">АЗС</th>
                <th scope="col">Кол-во</th>
                <th scope="col">Цена 1л</th>
                <th scope="col">Стоимость</th>
                <th scope="col" style="width: 1%">Инфо</th>
            </tr>
        </thead>
        <tbody>
            @foreach($Refillings as $Refilling)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$Refilling->date}}</td>
                @cannot('is-driver')
                <td>{{$Refilling->driver->profile->FullName}}</td>
                @endcan
                <td>{{$Refilling->petrolStation->title}}</td>
                <td>{{$Refilling->num_liters_car_refueling}}</td>
                <td>{{$Refilling->price_car_refueling}}</td>
                <td>
                    <h6>{{$Refilling->cost_car_refueling}} руб.</h6>
                </td>
                <td>
                    <a href="#" tabindex="0" class="btn btn-outline-info btn-sm" role="button" data-toggle="popover"
                        data-bs-trigger="focus" data-bs-title="Информация" data-bs-content="{{ $Refilling->comment }}
                                            Создана: {{ $Refilling->created_at }}
                                            Изменена: {{ $Refilling->updated_at }}
                                            Владелец: {{ $Refilling->owner->profile->FullName }}"><i
                            class="bi bi-info"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        {{$Refillings->withQueryString()->links()}}
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            </ul>
            <a class="btn btn-primary btn-lg" href="{{route('refilling.create')}}" role="button">Новая заправка</a>
        </div>
    </div>
</nav>
<script>
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover({
            placement : 'left'
        });
    });
    // new Tablesort(document.getElementById('sort-table'));
</script>
@else
@include('inc.archive-empty')
@endif
@endsection
