@extends('layouts.app')

@section('title'){{$DistanceBilling->typeTruck->title}} - изменение тарифа@endsection

@section('content')
<div class="container px-4 py-5">
    <h1 class="mt-5">{{$DistanceBilling->typeTruck->title}} - изменение тарифа</h1>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="post" action="{{route('billing.distance-update', $DistanceBilling->id)}}">
        @csrf
        <!-- Длина маршрута -->
        <div class="form-floating mb-3">
            <input type="number" name="up-15-km" id="up-15-km" placeholder="До 15 км" class="form-control form-control-lg" value="{{$DistanceBilling->up_15_km}}">
            <label for="up-15-km">До 15 км</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" name="up-30-km" id="up-30-km" placeholder="До 30 км" class="form-control form-control-lg" value="{{$DistanceBilling->up_30_km}}">
            <label for="up-30-km">До 30 км</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" name="up-60-km" id="up-60-km" placeholder="До 60 км" class="form-control form-control-lg" value="{{$DistanceBilling->up_60_km}}">
            <label for="up-60-km">До 60 км</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" name="more-60-km" id="more-60-km" placeholder="Свыше 60 км" class="form-control form-control-lg" value="{{$DistanceBilling->more_60_km}}">
            <label for="more-60-km">Свыше 60 км</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" name="more-300-km" id="more-300-km" placeholder="Свыше 300 км" class="form-control form-control-lg" value="{{$DistanceBilling->more_300_km}}">
            <label for="more-300-km">Свыше 300 км</label>
        </div>
        <!-- Длина маршрута конец -->

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary btn-lg">Сохранить</button>
            <a class="btn btn-outline-secondary btn-lg" href="{{route('billing.distance')}}" role="button">Отмена</a>
        </div>
    </form>
</div>
@endsection