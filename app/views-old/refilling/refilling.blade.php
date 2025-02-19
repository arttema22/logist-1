@extends('layouts.app')

@section('title')Заправки@endsection

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
        <p class="card-text">{{$Refilling->date}} - {{$Refilling->cost_car_refueling}} руб. <a href="#" tabindex="0"
                class="btn btn-outline-info btn-sm" role="button" data-toggle="popover" data-bs-trigger="focus"
                data-bs-title="Информация" data-bs-content="Создана: {{$Refilling->created_at}}
                                        Изменена: {{$Refilling->updated_at}}
                                        Владелец: {{$Refilling->owner->profile->FullName}}"><i class="bi bi-info"></i>
            </a></p>
        <p class="card-text">АЗС - {{$Refilling->petrolStation->title}} 1 литр - {{$Refilling->price_car_refueling}}
            руб. Заправлено {{$Refilling->num_liters_car_refueling}} л.</p>
    </div>
    <div class="card-footer text-muted text-end">
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
<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <a class="btn btn-primary btn-lg" href="{{route('refilling.create')}}" role="button">Новая заправка</a>
</div>
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
