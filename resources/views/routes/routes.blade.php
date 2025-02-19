@extends('layouts.app')

@section('title')Маршруты@endsection

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
                        <div class="col-md-2">{{$Route->date}}</div>
                        @cannot('is-driver')
                        <div class="col-md-4">{{$Route->driver->profile->FullName}}</div>
                        @endcan
                        <div class="col-md-4">{{$Route->address_loading}} - {{$Route->address_unloading}}</div>
                        <div class="col-md-2">{{$Route->summ_route}} руб.</div>
                    </div>
                </div>
            </button>
        </h2>
        <div id="flush-collapse{{$Route->id}}" class="accordion-collapse collapse"
            aria-labelledby="flush-heading{{$Route->id}}" data-bs-parent="#accordionFlushRoutes">
            <div class="accordion-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <p>Маршрут: {{$Route->address_loading}} - {{$Route->address_unloading}}
                            ({{$Route->route_length}}
                            км.)</p>
                        <div>
                            {{-- <a href="{{ route('routes.edit', $Route->id) }}"
                                class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></a> --}}

                            <!-- Кнопка удаления записи -->
                            <!-- Обязательно подключение include('inc.modal-delete') -->
                            <!-- data-bs-url - содержит ссылку на удаление -->
                            <button type="button" class="btn btn-outline-danger btn-sm btn-del-modal"
                                data-bs-url="{{ route('routes.destroy', $Route->id) }}" data-bs-type="маршрута"
                                data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i
                                    class="bi bi-trash"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Подробности</h5>
                        <p class="card-text">
                            Рейсов: {{$Route->number_trips}} Груз: {{$Route->cargo->title}}
                            Автомобиль: {{$Route->typeTruck->title}} Плательщик: {{$Route->payer->title}}<br>
                            Стоимость: {{$Route->price_route}} руб. Расходы: {{$Route->unexpected_expenses}}
                            <b>Начислено:
                                {{$Route->summ_route}} руб.</b><br>
                            {{$Route->comment}}
                        </p>
                        @if(count($Route->services))
                        <h5 class="card-title">Дополнительные услуги</h5>
                        @foreach($Route->services as $Service)
                        <p class="card-text">
                            {{$Service->service->title}}
                            {{$Service->price}} * {{$Service->number_operations}} = {{$Service->sum}}<br>
                            {{$Service->comment}}
                        </p>
                        @endforeach
                        <p class="card-text"><b>Начислено за услуги: {{$Route->services->sum('sum')}} руб.</b></p>
                        @endif
                    </div>
                    <div class="card-footer text-muted">
                        <small>
                            Создан: {{$Route->created_at}}
                            Изменен: {{$Route->updated_at}}
                            Владелец: {{$Route->owner->profile->FullName}}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        {{$Routes->withQueryString()->links()}}
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            </ul>
            <a class="btn btn-primary btn-lg" href="{{route('routes.create')}}" role="button">Новый маршрут</a>
        </div>
    </div>
</nav>
@include('inc.modal-delete')
@else
@include('inc.list-empty')
@endif
@endsection
