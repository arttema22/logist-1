@extends('layouts.app')

@section('title')
{{__('refilling.edit')}}
@endsection

@section('content')
<div class="container px-4 py-5">
    <h1>
        {{__('refilling.edit'). " - " .$Refilling->date}}
    </h1>

    @include('inc.banner-autorefilling')

    @include('inc.error-msg')
    <form method="post" action="{{route('refilling.update', $Refilling->id)}}">
        @csrf
        <div class="form-floating mb-3">
            <input type="date" name="date-car-refueling" id="date-car-refueling" class="form-control form-control-lg"
                value="{{$Refilling->date}}">
            <label for="date-car-refueling">
                {{__('refilling.date')}}
            </label>
        </div>
        <!-- Список пользователей -->
        @cannot('is-driver')
        <select name="driver-id" id="driver-id" class="form-select form-select-lg mb-3" aria-label="Водитель">
            <option value="0">{{__('refilling.driver')}}</option>
            @foreach($Users as $User)
            <option value="{{$User->id}}" @if ($Refilling->driver->id == $User->id)
                selected
                @endif
                >{{$User->profile->FullName}}</option>
            @endforeach
        </select>
        @endcan
        <!-- Список пользователей конец -->
        <!-- Список АЗС -->
        <select name="petrol-stations-id" id="petrol-stations-id" class="form-select form-select-lg mb-3"
            aria-label="Название АЗС">
            @foreach($PetrolStations as $PetrolStation)
            <option value="{{$PetrolStation->id}}" @if ($Refilling->petrolStation->id == $PetrolStation->id)
                selected
                @endif
                >{{$PetrolStation->title}}</option>
            @endforeach
        </select>
        <!-- Список АЗС конец -->

        <div class="form-floating mb-3">
            <input type="number" step="any" name="num-liters-car-refueling" id="num-liters-car-refueling"
                class="form-control form-control-lg" value="{{$Refilling->num_liters_car_refueling}}">
            <label for="num-liters-car-refueling">{{__('refilling.quantity')}}</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" step="any" name="price-car-refueling" id="price-car-refueling"
                class="form-control form-control-lg" value="{{$Refilling->price_car_refueling}}">
            <label for="price-car-refueling">{{__('refilling.fuel_price')}}</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" name="cost-car-refueling" id="cost-car-refueling" class="form-control form-control-lg"
                value="{{$Refilling->cost_car_refueling}}" disabled>
            <label for="cost-car-refueling">{{__('refilling.cost')}}</label>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary btn-lg">{{__('ui.save')}}</button>
            <a class="btn btn-outline-secondary btn-lg" href="{{route('refilling.list')}}"
                role="button">{{__('ui.cancel')}}</a>
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('input[name=num-liters-car-refueling]').on('input keyup', function() {
            num_lters = $('input[name=num-liters-car-refueling]').val();
            price_1l = $('input[name=price-car-refueling]').val();
            $('input[name=cost-car-refueling]').val(num_lters * price_1l);
        });
        $('input[name=price-car-refueling]').on('input keyup', function() {
                num_lters = $('input[name=num-liters-car-refueling]').val();
                price_1l = $('input[name=price-car-refueling]').val();
                $('input[name=cost-car-refueling]').val(num_lters * price_1l);
                });
    });
</script>
@endsection
