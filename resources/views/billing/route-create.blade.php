@extends('layouts.app')

@section('title')
Новый тарифный маршрут
@endsection

@section('content')
<div class="container px-4 py-5">
    <h1 class="mt-5">Новый тарифный маршрут</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="post" action="{{ route('billing.route-store') }}">
        @csrf
        <!-- Начало маршрута -->
        <div class="form-floating mb-3">
            <input type="text" name="start" id="start" placeholder="Начало маршрута"
                class="form-control form-control-lg" value="{{ old('start') }}">
            <label for="start">Начало маршрута</label>
        </div>
        <!-- Начало маршрута конец -->

        <!-- Конец маршрута -->
        <div class="form-floating mb-3">
            <input type="text" name="finish" id="finish" placeholder="Конец маршрута"
                class="form-control form-control-lg" value="{{ old('finish') }}">
            <label for="finish">Конец маршрута</label>
        </div>
        <!-- Конец маршрута конец -->

        <!-- Тип тарифа -->
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between">
                <p>Тип тарифа</p>
                <div class="form-check form-switch">
                    <input name="collapse-new-type" class="form-check-input" type="checkbox" role="switch"
                        data-bs-toggle="collapse" href=".collapse-type" id="flexSwitchCheckType"
                        aria-controls="collapseType">
                    <label class="form-check-label" for="flexSwitchCheckType">цена</label>
                </div>
            </div>
            <div class="card-body">
                <div class="collapse collapse-type show" id="collapseType">
                    <div class="form-floating mb-3">
                        <input type="number" step="any" name="length" id="length" placeholder="Расстояние"
                            class="form-control form-control-lg" value="{{ old('length') }}">
                        <label for="length">Расстояние</label>
                    </div>
                </div>
                <div class="collapse collapse-type" id="collapseType">
                    <div class="form-floating mb-3">
                        <input type="number" step="any" name="price" id="price" placeholder="Цена"
                            class="form-control form-control-lg" value="{{ old('price') }}">
                        <label for="price">Цена</label>
                    </div>
                </div>
            </div>
        </div>
        <!-- Тип тарифа конец -->

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary btn-lg">Сохранить</button>
            <a class="btn btn-outline-secondary btn-lg" href="{{ route('billing.route') }}" role="button">Отмена</a>
        </div>
    </form>
</div>
@endsection
