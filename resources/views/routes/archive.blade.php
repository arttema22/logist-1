@extends('layouts.app')

@section('title')Архивные маршруты@endsection

@section('content')
@include('inc.filter-route')
@if(count($Routes))
<div class="accordion accordion-flush" id="accordionFlushRoutes">
    @foreach($Routes as $Route)
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading{{$Route->id}}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse{{$Route->id}}" aria-expanded="false"
                aria-controls="flush-collapse{{$Route->id}}">
                <div class="container">
                    <div class="row">
                        <div class="col-2">{{$Route->date}}</div>
                        @cannot('is-driver')
                        <div class="col-4">{{$Route->driver->profile->FullName}}</div>
                        @endcan
                        <div class="col-4">{{$Route->address_loading}} - {{$Route->address_unloading}}</div>
                        <div class="col-2">{{$Route->summ_route}} руб.</div>
                    </div>
                </div>
            </button>
        </h2>
        <div id="flush-collapse{{$Route->id}}" class="accordion-collapse collapse"
            aria-labelledby="flush-heading{{$Route->id}}" data-bs-parent="#accordionFlushRoutes">
            <div class="accordion-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="sort-table">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">Маршрут</th>
                                <th scope="col">Рейсов</th>
                                <th scope="col">Груз</th>
                                <th scope="col">Авто</th>
                                <th scope="col">Плательщик</th>
                                <th scope="col">Стоимость</th>
                                <th scope="col">Расходы</th>
                                <th scope="col">Начислено</th>
                                <th scope="col">Комментарий</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> {{$Route->address_loading}} - {{$Route->address_unloading}}
                                    {{$Route->route_length}} км.
                                </td>
                                <td>{{$Route->number_trips}}</td>
                                <td>{{$Route->cargo->title}}</td>
                                <td>{{$Route->typeTruck->title}}</td>
                                <td>{{$Route->payer->title}}</td>
                                <td>{{$Route->price_route}} руб.</td>
                                <td>{{$Route->unexpected_expenses}} руб.</td>
                                <td>{{$Route->summ_route}} руб.</td>
                                <td>{{$Route->comment}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @if(count($Route->services))
                <div class="table-responsive">
                    <table class="table table-hover caption-top">
                        <caption>Дополнительные услуги</caption>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Наименование</th>
                                <th scope="col">Цена</th>
                                <th scope="col">Количество</th>
                                <th scope="col">Сумма</th>
                                <th scope="col">Комментарий</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Route->services as $Service)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$Service->service->title}}</td>
                                <td>{{$Service->price}} руб.</td>
                                <td>{{$Service->number_operations}}</td>
                                <td>{{$Service->sum}}</td>
                                <td>{{$Service->comment}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
                <small class="text-muted">
                    Информация о записи:
                    Создана: {{$Route->created_at}}
                    Изменена: {{$Route->updated_at}}
                    Владелец: {{$Route->owner->profile->FullName}}
                </small>
            </div>
        </div>
    </div>
    @endforeach
</div>
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        {{$Routes->withQueryString()->links()}}
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            </ul>
            <a class="btn btn-primary btn-lg" href="{{route('routes.create')}}" role="button">Новый маршрут</a>
        </div>
    </div>
</nav>
@else
@include('inc.archive-empty')
@endif
@endsection
