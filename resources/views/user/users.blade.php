@extends('layouts.app')

@section('title')
    Пользователи
@endsection

@section('content')
    @if (count($Users))
        <h1 class="mt-5">Пользователи</h1>
        <table class="table table-hover">
            <thead class="table-primary">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Имя Фамилия</th>
                    <th scope="col">Телефон</th>
                    <th scope="col">Почта</th>
                    <th scope="col">Роль</th>
                    <th scope="col">Управление</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Users as $User)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $User->profile->FullName }} - {{ $User->name }}</td>
                        <td><a href="tel:{{ $User->profile->phone }}">{{ $User->profile->phone }}</a></td>
                        <td><a href="mailto:{{ $User->email }}">{{ $User->email }}</a></td>
                        <td><span class="badge bg-primary">{{ $User->roles->title }}</span></td>
                        <td><a href="{{ route('user.edit', $User->id) }}"
                                class="btn btn-outline-primary btn-sm">Изменить</a>
                            @if ($User->status)
                                <!-- Кнопка удаления записи -->
                                <!-- Обязательно подключение include('inc.modal-delete') -->
                                <!-- data-bs-url - содержит ссылку на удаление -->
                                <button type="button" class="btn btn-outline-danger btn-sm btn-del-modal"
                                    data-bs-url="{{ route('user.destroy', $User->id) }}" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">Удалить</button>
                            @else
                                <a href="{{ route('user.recover', $User->id) }}"
                                    class="btn btn-outline-secondary btn-sm">Восстановить</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @include('inc.modal-delete')
    @endif
    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5 pt-5">
        <a class="btn btn-primary btn-lg" href="{{ route('user.create') }}" role="button">Новый</a>
    </div>
@endsection
