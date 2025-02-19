<nav class="navbar">
    <div class="container-fluid">
        <h1>Данные для расчета</h1>
        @cannot('is-driver')
        <form class="d-flex" method="get">
            <input type="date" name="date-profit" id="date-profit" placeholder="Дата"
                class="form-control form-control-lg me-1">
            <select name="driver-id" id="driver-id" class="form-select me-2" aria-label="Водитель">
                <option value="0">Водитель</option>
                @foreach ($User_list as $User)
                <option value="{{ $User->id }}" @if (isset($_GET['driver-id'])) @if ($_GET['driver-id']==$User->id)
                    selected @endif
                    @endif>{{ $User->profile->FullName }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary me-2"><i class="bi bi-filter"></i></button>
            <a class="btn btn-outline-primary" href="{{ route('profit.list') }}"><i class="bi bi-arrow-repeat"></i></a>
        </form>
        @endcan
    </div>
</nav>
