<!DOCTYPE html>
<html>
    <head>
        <title>Generate PDF Laravel 8 - phpcodingstuff.com</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    </head>
    <style type="text/css">
        h2{
            text-align: center;
            font-size:22px;
            margin-bottom:50px;
        }
        body{
            background:#f2f2f2;
        }
        .section{
            margin-top:30px;
            padding:50px;
            background:#fff;
        }
        .pdf-btn{
            margin-top:30px;
        }
    </style>   

    <body>
        <h1 class="mt-5">Список начислений</h1>
        @if(count($Profits))
        <div class="card">
            <div class="card-body">
                <div class="accordion accordion-flush" id="accordionFlushRoutes">
                    @foreach($Profits as $Profit)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading{{$Profit->id}}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$Profit->id}}" aria-expanded="false" aria-controls="flush-collapse{{$Profit->id}}">
                                {{$loop->iteration}}  {{$Profit->created_at}} {{$Profit->driver->profile->FullName}} Заправки: {{$Profit->sum_refuelings}}руб. Маршруты: {{$Profit->sum_routes}}руб. Доп. услуги: {{$Profit->sum_services}}руб. Всего: {{$Profit->sum_total}}руб.
                            </button>
                        </h2>
                        <div id="flush-collapse{{$Profit->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$Profit->id}}" data-bs-parent="#accordionFlushRoutes">
                            <div class="accordion-body">
                                <div class="row">
                                    @if(count($Profit->driver->driverRoute->where('profit_id', $Profit->id)))
                                    <div class="col">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Данные о рейсах</h5>
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Дата</th>
                                                            <th scope="col">Цена</th>
                                                            <th scope="col">Количество</th>
                                                            <th scope="col">Итого</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($Profit->driver->driverRoute->where('profit_id', $Profit->id) as $Route)
                                                        <tr>
                                                            <th scope="row">{{$loop->iteration}}</th>
                                                            <td>{{$Route->date_route}}</td>
                                                            <td>{{$Route->price_route}}</td>
                                                            <td>{{$Route->number_trips}}</td>
                                                            <td>{{$Route->summ_route}}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if(count($Profit->driver->driverRefilling->where('profit_id', $Profit->id)))
                                    <div class="col">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Данные о заправках</h5>
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Дата</th>
                                                            <th scope="col">Цена</th>
                                                            <th scope="col">Количество</th>
                                                            <th scope="col">Итого</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($Profit->driver->driverRefilling->where('profit_id', $Profit->id) as $Refilling)
                                                        <tr>
                                                            <th scope="row">{{$loop->iteration}}</th>
                                                            <td>{{$Refilling->date_car_refueling}}</td>
                                                            <td>{{$Refilling->num_liters_car_refueling}}</td>
                                                            <td>{{$Refilling->price_car_refueling}}</td>
                                                            <td>{{$Refilling->cost_car_refueling}}</td>
                                                        </tr>
                                                    <br>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        <div class="text-center pdf-btn">
            <a href="{{ route('profit.pdf.generate') }}" class="btn btn-primary">Generate PDF</a>
        </div>
    </body>
</html>