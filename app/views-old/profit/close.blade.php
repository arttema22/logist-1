@extends('layouts.app')

@section('title')Данные для расчета@endsection

@section('content')
@include('inc.error-msg')
<section class="py-5 text-center container">
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <form method="post" action="{{route('profit.store')}}">
                @csrf
                <h1 class="fw-light">Закрытие периода</h1>
                <p class="lead text-muted">Внимание! Процедура закрытия периода необратима. Все маршруты, заправки и
                    выплаты
                    попавшие в закрываемый период, не будут доступны для редактирования в дальнейшем.</p>
                <div class="form-floating mb-3">
                    <input type="date" name="date-close" id="date-close" placeholder="Дата закрытия"
                        class="form-control form-control-lg" value="{{ date('Y-m-d') }}">
                    <label for="date-close">Дата закрытия</label>
                </div>
                <!-- Комментарий -->
                <div class="form-floating mb-3">
                    <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
                    <label for="comment" class="form-label">Комментарий</label>
                </div>
                <!-- Комментарий конец -->
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <button type="submit" class="btn btn-danger btn-lg">Закрыть</button>
                    <a class="btn btn-outline-secondary btn-lg" href="{{route('profit.list')}}" role="button">Отмена</a>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
