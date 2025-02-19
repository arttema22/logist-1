@extends('layouts.app')

@section('title')Выплаты@endsection

@section('content')
@include('inc.filter-salary')
@if (count($Salaries))
@foreach ($Salaries as $Salary)
<div class="card mb-3">
    @cannot('is-driver')
    <div class="card-header">
        {{ $Salary->driver->profile->FullName }}
    </div>
    @endcan
    <div class="card-body">
        <p class="card-text">{{ $Salary->date }} - {{ $Salary->salary }} руб.
            <a href="#" tabindex="0" class="btn btn-outline-info btn-sm" role="button" data-toggle="popover"
                data-bs-trigger="focus" data-bs-title="Информация" data-bs-content="Создана: {{ $Salary->created_at }}
                                Изменена: {{ $Salary->updated_at }}
                                Владелец: {{ $Salary->owner->profile->FullName }}"><i class="bi bi-info"></i>
            </a>
        </p>
        <p class="card-text">{{ $Salary->comment }}</p>
    </div>
    <div class="card-footer text-muted text-end">
        <a href="{{ route('salary.edit', $Salary->id) }}" class="btn btn-outline-primary btn-sm"><i
                class="bi bi-pencil"></i></a>
        <!-- Кнопка удаления записи -->
        <!-- Обязательно подключение include('inc.modal-delete') -->
        <!-- data-bs-url - содержит ссылку на удаление -->
        <button type="button" class="btn btn-outline-danger btn-sm btn-del-modal"
            data-bs-url="{{ route('salary.destroy', $Salary->id) }}" data-bs-type="начисления" data-bs-toggle="modal"
            data-bs-target="#staticBackdrop"><i class="bi bi-trash"></i></button>

    </div>
</div>
@endforeach
<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <a class="btn btn-primary btn-lg" href="{{ route('salary.create') }}" role="button">Новая выплата</a>
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
