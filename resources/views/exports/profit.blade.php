<table>
    <tr>
        <td colspan="7">Акт сверки (учётный) № {{$User->profit->last()->id}}</td>
    </tr>
    <tr>
        <td colspan="7">взаимных расчетов за период: с {{$User->profit->last()->created_at}} по {{ date('d.m.Y')}}</td>
    </tr>
    <tr>
        <td colspan="7">между ООО "РегионЛесЭкспорт" и {{ $User->profile->fullName }}</td>
    </tr>
    <tr>
        <td colspan="7">
            Мы, нижеподписавшиеся, Директор ООО "РегионЛесЭкспорт" А.В.Клишевич с одной стороны, и {{
            $User->profile->fullName }} с другой стороны,
            составили настоящий акт сверки в том, что состояние взаимных расчетов по данным учета следующее:
        </td>
    </tr>
</table>
<table>
    <tr>
        <td>Дата</td>
        <td>Документ</td>
        <td>Выплаты</td>
        <td>Заправки</td>
        <td>Маршруты</td>
        <td>Услуги</td>
        <td></td>
    </tr>
    <tr>
        <td>Сальдо начальное</td>
        <td>{{ $User->profit->last()->comment }}</td>
        <td>{{ $User->profit->last()->sum_salary }}</td>
        <td>{{ $User->profit->last()->sum_refuelings }}</td>
        <td>{{ $User->profit->last()->sum_routes }}</td>
        <td>{{ $User->profit->last()->sum_services }}</td>
        <td>{{ $User->profit->last()->saldo_end }}</td>
    </tr>
    @foreach ( $User->driverSalary->where('status', 1) as $Salary )
    <tr>
        <td>{{ $Salary->date }}</td>
        <td>Выплата. {{ $Salary->comment }}</td>
        <td>{{ $Salary->salary }}</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    @endforeach
    @foreach ( $User->driverRefilling->where('status', 1) as $Refilling )
    <tr>
        <td>{{ $Refilling->date }}</td>
        <td>
            Заправка. {{ $Refilling->petrolStation->title }}. Заправлено
            {{ $Refilling->num_liters_car_refueling }} л. по
            {{ $Refilling->price_car_refueling }} руб.
        </td>
        <td></td>
        <td>{{ $Refilling->cost_car_refueling }}</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    @endforeach
    @foreach ( $User->driverRoute->where('status', 1) as $Route )
    <tr>
        <td>{{ $Route->date }}</td>
        <td>
            Маршрут. {{ $Route->address_loading }} -
            {{ $Route->address_unloading }}
            {{ $Route->route_lengtd }}.
            Транспорт - {{ $Route->typeTruck->title }}.
            Груз - {{ $Route->cargo->title }}.
            Плательщик - {{ $Route->payer->title }}.
            Количество рейсов - {{ $Route->number_trips }}.
            Стоимость - {{ $Route->price_route }} руб.
            Непредвиденные расходы - {{ $Route->unexpected_expenses }} руб.
            {{ $Route->comment }}<br>
        </td>
        <td></td>
        <td></td>
        <td>{{ $Route->summ_route }}</td>
        <td></td>
        <td></td>
    </tr>
    @foreach ( $Route->services->where('status', 1) as $Service )
    <tr>
        <td></td>
        <td>
            {{ $Service->service->title }}.
            Количество - {{ $Service->number_operations }} по цена
            {{ $Service->price }} руб.
            {{ $Service->comment }}
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td>{{ $Service->sum }}</td>
        <td></td>
    </tr>
    @endforeach
    @endforeach
    <tr>
        <td colspan="2">Обороты за период</td>
        <td>{{ $User->driverSalary->where('status', 1)->sum('salary') }}</td>
        <td>{{ $User->driverRefilling->where('status', 1)->sum('cost_car_refueling') }}</td>
        <td>{{ $User->driverRoute->where('status', 1)->sum('summ_route') }}</td>
        <td>{{ $User->driverService->where('status', 1)->sum('sum') }}</td>
        <td>
            {{ $User->profit->last()->saldo_end + $User->driverRoute->where('status', 1)->sum('summ_route')
            - $User->driverRefilling->where('status', 1)->sum('cost_car_refueling') -
            $User->driverSalary->where('status', 1)->sum('salary')
            }}
        </td>
    </tr>
    <tr>
        <td colspan="6">Сальдо конечное</td>
        <td>
            {{ $User->profit->last()->saldo_end + $User->driverRoute->where('status', 1)->sum('summ_route')
            - $User->driverRefilling->where('status', 1)->sum('cost_car_refueling') -
            $User->driverSalary->where('status', 1)->sum('salary')
            }}
        </td>
    </tr>
</table>
<table>
    <tr>
        <td colspan="7">ООО "РегионЛесЭкспорт"</td>
    </tr>
    <tr>
        <td colspan="3">({{ $User->profile->fullName }})</td>
        <td colspan="4">(Клишевич А.В.)</td>
    </tr>
</table>
