@extends('layouts.app')

@section('title')
{{__('refilling.new')}}
@endsection

@section('content')
<div class="container px-4 py-5">
    <h1>
        {{__('refilling.new')}}
    </h1>

    @include('inc.banner-autorefilling')

    @include('inc.error-msg')
    <form method="post" action="{{route('refilling.store')}}">
        @csrf
        <div class="form-floating mb-3">
            <input type="date" name="date-car-refueling" id="date-car-refueling" class="form-control form-control-lg"
                value="{{ date('Y-m-d') }}">
            <label for="date-car-refueling">
                {{__('refilling.date')}}
            </label>
        </div>
        <!-- Список пользователей -->
        @cannot('is-driver')
        @if(count($Users))
        <select name="driver-id" id="driver-id" class="form-select form-select-lg mb-3" aria-label="Водитель">
            <option value="0" selected>
                {{__('refilling.driver')}}
            </option>
            @foreach($Users as $User)
            <option value="{{$User->id}}">{{$User->profile->FullName}}</option>
            @endforeach
        </select>
        @else
        <div class="alert alert-danger" role="alert">
            В системе нет пользователя. Для начала работы необходимо <a href="#" class="alert-link">завести
                пользователя</a>.
        </div>
        @endif
        @endcan
        <!-- Список пользователей конец -->
        <!-- Список АЗС -->
        @if(count($PetrolStations))
        <select name="petrol-stations-id" id="petrol-stations-id" class="form-select form-select-lg mb-3"
            aria-label="Название АЗС">
            @foreach($PetrolStations as $PetrolStation)
            <option value="{{$PetrolStation->id}}">{{$PetrolStation->title}}</option>
            @endforeach
        </select>
        @else
        <div class="alert alert-danger" role="alert">
            В системе нет АЗС. Для начала работы необходимо <a href="{{route('directory.petrol-stations-new')}}"
                class="alert-link">завести АЗС</a>.
        </div>
        @endif
        <!-- Список АЗС конец -->

        <div class="form-floating mb-3">
            <input type="number" step="any" name="num-liters-car-refueling" id="num-liters-car-refueling"
                placeholder="Количество литров" class="form-control form-control-lg"
                value="{{old('num-liters-car-refueling')}}">
            <label for="num-liters-car-refueling">
                {{__('refilling.quantity')}}
            </label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" step="any" name="price-car-refueling" id="price-car-refueling"
                placeholder="Цена за 1 литр" class="form-control form-control-lg"
                value="{{old('price-car-refueling')}}">
            <label for="price-car-refueling">
                {{__('refilling.fuel_price')}}
            </label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" name="cost-car-refueling" id="cost-car-refueling" placeholder="Стоимость заправки"
                class="form-control form-control-lg" value="0" disabled>
            <label for="cost-car-refueling">
                {{__('refilling.cost')}}
            </label>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary btn-lg">
                {{__('ui.save')}}
            </button>
            <a class="btn btn-outline-secondary btn-lg" href="{{route('refilling.list')}}" role="button">
                {{__('ui.cancel')}}
            </a>
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
