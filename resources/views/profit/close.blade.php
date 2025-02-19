@extends('layouts.app')

@section('title')Данные для расчета@endsection

@section('content')
@include('inc.error-msg')
<section class="py-5 text-center container">
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            @if (Request::path() === 'profit/close-all')
            <form method="post" action="{{route('profit.store-all')}}">
                <h1 class="fw-light">Закрытие периода</h1>
                @else
                <form method="post" action="{{route('profit.store', $User->id)}}">
                    <h1 class="fw-light">Закрытие периода для {{$User->profile->FullName}}</h1>
                    @endif
                    @csrf
                    <p class="lead text-muted">Внимание! Процедура закрытия периода необратима. Все маршруты, заправки и
                        выплаты попавшие в закрываемый период, не будут доступны для редактирования в дальнейшем.</p>
                    {{-- Дата закрытия --}}
                    <div class="form-floating mb-3">
                        <input type="date" name="date-close" id="date-close" placeholder="Дата закрытия"
                            class="form-control form-control-lg" value="{{ date(config('app.date_format_to_db')) }}">
                        <label for="date-close">Дата закрытия</label>
                    </div>
                    {{-- Период выплат --}}
                    <div class="form-floating mb-3">
                        <select name="period-title" id="period-title" class="form-select form-select-lg mb-3"
                            aria-label="Пертод">
                            <option value=0>Выбрать период</option>
                            <option value="Январь">Январь</option>
                            <option value="Февраль">Февраль</option>
                            <option value="Март">Март</option>
                            <option value="Апрель">Апрель</option>
                            <option value="Май">Май</option>
                            <option value="Июнь">Июнь</option>
                            <option value="Июль">Июль</option>
                            <option value="Август">Август</option>
                            <option value="Сентябрь">Сентябрь</option>
                            <option value="Октябрь">Октябрь</option>
                            <option value="Ноябрь">Ноябрь</option>
                            <option value="Декабрь">Декабрь</option>
                        </select>
                    </div>
                    {{-- Период выплат --}}

                    <!-- Комментарий -->
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
                        <label for="comment" class="form-label">Комментарий</label>
                    </div>
                    <!-- Комментарий конец -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <button type="submit" class="btn btn-danger btn-lg">Закрыть</button>
                        <a class="btn btn-outline-secondary btn-lg" href="{{route('profit.list')}}"
                            role="button">Отмена</a>
                    </div>
                </form>
        </div>
    </div>
</section>

@endsection
