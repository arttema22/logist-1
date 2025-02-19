@extends('layouts.app')

@section('title')Архив выплат@endsection

@section('content')
<link rel="stylesheet" href="/css/tablesort.css">
<script src='/js/tablesort.min.js'></script>
@include('inc.filter-salary')
@if (count($Salaries))
<div class="table-responsive">
    <table class="table table-hover" id="sort-table">
        <thead class="table-primary">
            <tr>
                <th scope="col" style="width: 1%">#</th>
                <th scope="col" style="width: 1%">Дата</th>
                @cannot('is-driver')
                <th scope="col">Водитель</th>
                @endcan
                <th scope="col">Сумма</th>
                <th scope="col" style="width: 1%">Инфо</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Salaries as $Salary)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $Salary->date }}</td>
                @cannot('is-driver')
                <td>{{ $Salary->driver->profile->FullName }}</td>
                @endcan
                <td>{{ $Salary->salary }} руб.</td>
                <td>
                    <a href="#" tabindex="0" class="btn btn-outline-info btn-sm" role="button" data-toggle="popover"
                        data-bs-trigger="focus" data-bs-title="Информация" data-bs-content="{{ $Salary->comment }}
                        Создана: {{ $Salary->created_at }}
                        Изменена: {{ $Salary->updated_at }}
                        Владелец: {{ $Salary->owner->profile->FullName }}"><i class="bi bi-info"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        {{ $Salaries->withQueryString()->links() }}
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            </ul>
            <a class="btn btn-primary btn-lg" href="{{ route('salary.create') }}" role="button">Новая выплата</a>
        </div>
    </div>
</nav>
<script>
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover({
            placement : 'left'
        });
    });
    // new Tablesort(document.getElementById('sort-table'));
</script>

@else
@include('inc.archive-empty')
@endif
@endsection
