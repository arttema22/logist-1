<nav class="navbar">
    <div class="container-fluid">
        @if(Request::path() === 'routes')
        <h1>Маршруты</h1>
        @else
        <h1>Архив маршрутов</h1>
        @endif

        @cannot('is-driver')
        <form class="d-flex" method="get">
            <select name="type-truck-id" id="type-truck-id" class="form-select me-2" aria-label="Тип авто">
                <option value="0">Тип авто</option>
                @foreach($TypeTrucks as $Type)
                <option value="{{$Type->id}}" @if(isset($_GET['type-truck-id'])) @if($_GET['type-truck-id']==$Type->id)
                    selected
                    @endif @endif>{{$Type->title}}</option>
                @endforeach
            </select>
            <select name="driver-id" id="driver-id" class="form-select me-2" aria-label="Водитель">
                <option value="0">Водитель</option>
                @foreach($Users as $User)
                <option value="{{$User->id}}" @if(isset($_GET['driver-id'])) @if($_GET['driver-id']==$User->id) selected
                    @endif @endif>{{$User->profile->FullName}}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary me-2"><i class="bi bi-filter"></i></button>
            @if(Request::path() === 'routes')
            <a class="btn btn-outline-primary" href="{{route('routes.list')}}"><i class="bi bi-arrow-repeat"></i></a>
            @else
            <a class="btn btn-outline-primary" href="{{route('routes.archive')}}"><i class="bi bi-arrow-repeat"></i></a>
            @endif
        </form>
        @endcan
    </div>
</nav>
