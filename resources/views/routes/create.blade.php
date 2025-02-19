@extends('layouts.app')

@section('title')Новый маршрут@endsection

@section('content')
<div class="container px-4 py-5">
    <h1>Новый маршрут</h1>
    @include('inc.error-msg')
    <form method="post" action="{{ route('routes.store') }}">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col">
                    <!-- Дата маршрута -->
                    <div class="form-floating mb-3">
                        <input type="date" name="date-route" id="date-route" placeholder="Дата маршрута"
                            class="form-control form-control-lg" value="{{ date('Y-m-d') }}">
                        <label for="date-route">Дата маршрута</label>
                    </div>
                    <!-- Дата маршрута конец -->

                    <!-- Список водителей -->
                    @cannot('is-driver')
                    <div class="form-floating mb-3">
                        @if (count($Users))
                        <select name="driver-id" id="driver-id" class="form-select form-select-lg mb-3">
                            <option value="0" selected>Водитель</option>
                            @foreach ($Users as $User)
                            <option value="{{ $User->id }}">{{ $User->profile->FullName }}</option>
                            @endforeach
                        </select>
                        <label for="driver-id">Водитель</label>
                        @else
                        <div class="alert alert-danger" role="alert">
                            В системе нет водителей. Для начала работы необходимо <a href="user.user-new"
                                class="alert-link">завести водителя</a>.
                        </div>
                        @endif
                    </div>
                    @endcan
                    <!-- Список водителей конец -->

                    <!-- Список типов авто -->
                    <div class="form-floating mb-3">
                        @if (count($TypeTrucks))
                        <select name="type-truck" id="type-truck" class="form-select form-select-lg mb-3">
                            <option value="0" selected>Тип автомобиля</option>
                            @foreach ($TypeTrucks as $TypeTruck)
                            <!-- если типу разрешено оказывать услуги, то
                                        присваиваем отрицательное значение для дальнейшей обработки
                                        -->
                            <?php
                                        if ($TypeTruck->is_service == 1) {
                                            $val = gmp_neg($TypeTruck->id);
                                        } else {
                                            $val = $TypeTruck->id;
                                        }
                                        ?>
                            <option value="{{ $val }}">{{ $TypeTruck->title }}</option>
                            @endforeach
                        </select>
                        <label for="type-truck">Тип</label>
                        @else
                        <div class="alert alert-danger" role="alert">
                            В системе нет типов грузовиков. Для начала работы необходимо <a
                                href="{{ route('directory.type-trucks-new') }}" class="alert-link">заполнить
                                типы
                                грузовиков</a>.
                        </div>
                        @endif
                    </div>
                    <!-- Список типов авто конец -->

                    <!-- Список грузов -->
                    <div class="form-floating mb-3">
                        @if (count($Cargo))
                        <select name="cargo" id="cargo" class="form-select form-select-lg mb-3">
                            <option value="0" selected>Груз</option>
                            @foreach ($Cargo as $Cargo)
                            <option value="{{ $Cargo->id }}">{{ $Cargo->title }}</option>
                            @endforeach
                        </select>
                        <label for="cargo">Груз</label>
                        @else
                        <div class="alert alert-danger" role="alert">
                            В системе нет грузов. Для начала работы необходимо <a
                                href="{{ route('directory.cargo-new') }}" class="alert-link">заполнить
                                перевозимые
                                грузы</a>.
                        </div>
                        @endif
                    </div>
                    <!-- Список грузов конец -->

                    <!-- Список плательщиков -->
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between">
                            <p>Плательщик</p>
                            <div class="form-check form-switch">
                                <input name="collapse-new-payer" class="form-check-input" type="checkbox" role="switch"
                                    data-bs-toggle="collapse" href=".collapse-payer" id="flexSwitchCheckPayer"
                                    aria-controls="collapsePayer">
                                <label class="form-check-label" for="flexSwitchCheckPayer">новый</label>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="collapse collapse-payer show" id="collapsePayer">
                                <div class="form-floating mb-3">
                                    @if (count($Payers))
                                    <select name="payer" id="payer" class="form-select form-select-lg mb-3">
                                        <option value="0" selected>выбрать</option>
                                        @foreach ($Payers as $Payer)
                                        <option value="{{ $Payer->id }}">{{ $Payer->title }}</option>
                                        @endforeach
                                    </select>
                                    <label for="payer">Плательщик</label>
                                    @else
                                    <div class="alert alert-danger" role="alert">
                                        В системе нет плательщиков. Для начала работы необходимо <a
                                            href="{{ route('directory.payers-new') }}" class="alert-link">заполнить
                                            список
                                            плательщиков</a>.
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="collapse collapse-payer" id="collapsePayer">
                                <div class="form-floating mb-3">
                                    <input type="text" name="new-payer" id="new-payer" placeholder="Название"
                                        class="form-control form-control-lg" value="{{ old('new-payer') }}">
                                    <label for="new-payer">Название</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Список плательщиков конец -->

                    {{-- Маршруты --}}
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between">
                            <p>Маршрут</p>
                            <div class="form-check form-switch">
                                <input name="collapse-new-route" class="form-check-input" type="checkbox" role="switch"
                                    data-bs-toggle="collapse" href=".collapse-route" id="flexSwitchCheckRoute"
                                    aria-controls="collapseRoute">
                                <label class="form-check-label" for="flexSwitchCheckRoute">новый</label>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Стандартный маршрут -->
                            <div class="collapse collapse-route show" id="collapseRoute">
                                <div class="form-floating mb-3">
                                    @if (count($RoutesBilling))
                                    <select name="route-billing" id="route-billing"
                                        class="form-select form-select-lg mb-3">
                                        <option value="0" selected>выбрать</option>
                                        @foreach ($RoutesBilling as $RouteBilling)
                                        <option value="{{ $RouteBilling->id }}">{{ $RouteBilling->start }} -
                                            {{ $RouteBilling->finish }} ({{ $RouteBilling->length }} км.)
                                        </option>
                                        @endforeach
                                    </select>
                                    <label for="route-billing">Стандартный маршрут</label>
                                    @else
                                    <div class="alert alert-danger" role="alert">
                                        В системе нет стандартных маршрутов. Для начала работы необходимо <a
                                            href="{{ route('billing.route-create') }}" class="alert-link">заполнить
                                            список маршрутов</a>.
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <!-- Стандартный маршрут конец -->
                            <div class="collapse collapse-route" id="collapseRoute">
                                <!--Пункт погрузки -->
                                <div class="form-floating mb-3">
                                    <input type="text" name="address-loading" id="address-loading"
                                        placeholder="Пункт погрузки" class="form-control form-control-lg"
                                        value="{{ old('address-loading') }}">
                                    <label for="route-length">Пункт погрузки</label>
                                </div>
                                <!-- Пункт погрузки конец -->

                                <!-- Пункт разгрузки -->
                                <div class="form-floating mb-3">
                                    <input type="text" name="address-unloading" id="address-unloading"
                                        placeholder="Пункт разгрузки" class="form-control form-control-lg"
                                        value="{{ old('address-unloading') }}">
                                    <label for="route-length">Пункт разгрузки</label>
                                </div>
                                <!-- Пункт разгрузки конец -->

                                <!-- Длина маршрута -->
                                <div class="form-floating mb-3">
                                    <input type="number" min="1" max="5000" name="route-length" id="route-length"
                                        placeholder="Длина маршрута" class="form-control form-control-lg"
                                        value="{{ old('route-length') }}">
                                    <label for="route-length">Длина маршрута</label>
                                </div>
                                <!-- Длина маршрута конец -->
                            </div>
                        </div>
                    </div>
                    {{-- Маршруты --}}

                    <!-- Количество рейсов -->
                    <div class="form-floating mb-3">
                        <input type="number" min="1" max="10" name="number-trips" id="number-trips"
                            placeholder="Количество рейсов" class="form-control form-control-lg" value="1">
                        <label for="number-trips">Количество рейсов</label>
                    </div>
                    <!-- Количество рейсов конец -->

                    <!-- Непредвиденные расходы -->
                    <div class="form-floating mb-3">
                        <input type="number" step="any" name="unexpected-expenses" id="unexpected-expenses"
                            placeholder="Непредвиденные расходы" class="form-control form-control-lg"
                            value="{{ old('unexpected-expenses') }}">
                        <label for="unexpected-expenses">Непредвиденные расходы</label>
                    </div>
                    <!-- Непредвиденные расходы конец -->

                    <!-- Комментарий -->
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
                        <label for="comment" class="form-label">Комментарий</label>
                    </div>
                    <!-- Комментарий конец -->
                </div>
            </div>

            <!-- Дополнительные услуги -->
            <div class="additional-servis" style="display: none">
                <div class="card mb-3">
                    <div class="card-header">
                        <h4>Дополнительные услуги</h4>
                    </div>
                    <div class="card-body services-list">
                    </div>
                    <div class="card-footer d-grid">
                        <a class="btn btn-success service-add">Добавить услугу</a>
                    </div>
                </div>
            </div>
            <!-- Дополнительные услуги конец -->
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary btn-lg">Сохранить</button>
            <a class="btn btn-outline-secondary btn-lg" href="{{ route('routes.list') }}" role="button">Отмена</a>
        </div>
    </form>
</div>

<script>
    // Скрипты для страницы нового маршрута
        // 1. добавляются select2 для нужных полей
        // 2. обработчик типа авто
        // 3. добавление блока инпутов для новой услуги
        // 4. удаление строки с услугой

    $(document).ready(function() {
            $('#driver-id').select2({ theme: "bootstrap-5" });
            $('#type-truck').select2({ theme: "bootstrap-5" });
            $('#cargo').select2({ theme: "bootstrap-5" });
            $('#payer').select2({ theme: "bootstrap-5" });
            $('#route-billing').select2({ theme: "bootstrap-5" });

            // срабатывает при выборе типа авто
            $("#type-truck").change(function() {
                if (this.value < 0) { $(".additional-servis").css({ 'display' : 'block' }); } else {
                    $(".additional-servis").css({ 'display' : 'none' }); } });


            // добавление строки с услугой
            $('.service-add').click(function() {
            $('.services-list').append(
                '<div class="row">' +
                    '<div class="col-md-4">' +
                        '<div class="form-floating">' +
                            '<select name="service_id[]" id="service-id[]" class="form-select mb-3" aria-label="Услуга" required>' +
                                '<option value="0" selected>выбрать</option>' +
                                '@foreach ($Services as $Service)' +
                                '<option value="{{ $Service->id }}">{{ $Service->title }}</option>' +
                                '@endforeach' +
                            '</select>' +
                            '<label for="service-id[]">Услуга</label>' +
                        '</div>' +
                    '</div>' +
                    '<div class="col-md-2">' +
                        '<div class="form-floating mb-3">' +
                            '<input type="number" min="1" max="8" name="number_operations[]" id="number-operations[]" placeholder="Количество" class="form-control" value=1>' +
                            '<label for="number-operations[]">Количество</label>' +
                        '</div>' +
                    '</div>' +
                    '<div class="col-md-4">' +
                        '<div class="form-floating mb-3">' +
                            '<textarea class="form-control" name="service_comment[]" id="service-comment[]" rows="3"></textarea>' +
                            '<label for="service-comment[]" class="form-label">Комментарий</label>' +
                        '</div>' +
                    '</div>' +
                    '<div class="col-md-1">' +
                        '<div class="form-floating mb-3 d-grid">' +
                            '<button type="button" class="btn btn-danger remove-service"> Удалить</button>' +
                        '</div>' +
                    '</div>' +
                '</div>'
                )
            });

            // Удаление строки услуги
            $(document).on('click', '.remove-service', function(e) {
                e.preventDefault();
                let row_item = $(this).parent().parent().parent();
                $(row_item).remove();
            });
        });
</script>
@endsection