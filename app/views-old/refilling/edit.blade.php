@extends('layouts.app')

@section('title')Изменение заправки@endsection

@section('content')
<div class="container px-4 py-5">
    <h1>Изменение заправки</h1>
    @include('inc.error-msg')
    <form method="post" action="{{route('refilling.update', $Refilling->id)}}">
        @csrf
        <div class="form-floating mb-3">
            <input type="date" name="date-car-refueling" id="date-car-refueling" placeholder="Дата заправки"
                class="form-control form-control-lg" value="{{$Refilling->dateEdit}}">
            <label for="date-car-refueling">Дата заправки</label>
        </div>
        <!-- Список пользователей -->
        @cannot('is-driver')
        <select name="driver-id" id="driver-id" class="form-select form-select-lg mb-3" aria-label="Водитель">
            <option value="0">Водитель</option>
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
            <input type="number" min="10" max="500" name="num-liters-car-refueling" id="num-liters-car-refueling"
                placeholder="Количество литров" class="form-control form-control-lg"
                value="{{$Refilling->num_liters_car_refueling}}">
            <label for="num-liters-car-refueling">Количество литров</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" step="any" name="price-car-refueling" id="price-car-refueling"
                placeholder="Цена за 1 литр" class="form-control form-control-lg"
                value="{{$Refilling->price_car_refueling}}">
            <label for="price-car-refueling">Цена за 1 литр</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" name="cost-car-refueling" id="cost-car-refueling" placeholder="Стоимость заправки"
                class="form-control form-control-lg" value="{{$Refilling->cost_car_refueling}}" disabled>
            <label for="cost-car-refueling">Стоимость заправки</label>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary btn-lg">Сохранить</button>
            <a class="btn btn-outline-secondary btn-lg" href="{{route('refilling.list')}}" role="button">Отмена</a>
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
