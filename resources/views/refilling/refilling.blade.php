@extends('layouts.app')

@section('title'){{__('refilling.refillings')}}Заправки@endsection

@section('content')
@include('inc.filter-refilling')

@if(count($Refillings))
@foreach ($Refillings as $Refilling)
<div class="card mb-3">
    @cannot('is-driver')
    <div class="card-header">
        {{ $Refilling->driver->profile->FullName }}
    </div>
    @endcan
    <div class="card-body">
        <p class="card-text">{{$Refilling->date}} - {{$Refilling->cost_car_refueling}} руб.
            {{$Refilling->petrolStation->title}} 1 литр - {{$Refilling->price_car_refueling}}
            руб. Заправлено {{$Refilling->num_liters_car_refueling}} л.
        </p>
    </div>
    <div class="card-footer text-muted text-end">
        {{__('ui.created')}}: {{$Refilling->created_at}}
        {{__('ui.updated')}}: {{$Refilling->updated_at}}
        {{__('ui.owner')}}: {{$Refilling->owner->profile->FullName}}
        <a href="{{ route('refilling.edit', $Refilling->id) }}" class="btn btn-outline-primary btn-sm"><i
                class="bi bi-pencil"></i></a>
        <!-- Кнопка удаления записи -->
        <!-- Обязательно подключение include('inc.modal-delete') -->
        <!-- data-bs-url - содержит ссылку на удаление -->
        <button type="button" class="btn btn-outline-danger btn-sm btn-del-modal"
            data-bs-url="{{ route('refilling.destroy', $Refilling->id) }}" data-bs-type="заправки"
            data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bi bi-trash"></i></button>
    </div>
</div>
@endforeach
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
@include('inc.modal-delete')
<script>
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover({
            placement : 'left'
        });
    });
</script>
@else
@include('inc.list-empty')
@endif
@endsection