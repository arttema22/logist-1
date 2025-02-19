<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Description of SalaryFilter
 *
 * @author arttema
 */
class RoutesFilter extends AbstractFilter
{

    public const DRIVER_ID = 'driver-id';
    public const TYPE_TRUCK_ID = 'type-truck-id';

    protected function getCallbacks(): array
    {
        return [
            self::DRIVER_ID => [$this, 'driverId'],
            self::TYPE_TRUCK_ID => [$this, 'typeTruckId'],
        ];
    }

    public function driverId(Builder $builder, $value)
    {
        $builder->where('driver_id', $value);
    }

    public function typeTruckId(Builder $builder, $value)
    {
        $builder->where('dir_type_trucks_id', $value);
    }
}
