<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Description of SalaryFilter
 *
 * @author arttema
 */
class PetrolFilter extends AbstractFilter
{

    public const DRIVER_ID = 'driver-id';
    public const PETROL_STATIONS_ID = 'petrol-id';

    protected function getCallbacks(): array
    {
        return [
            self::DRIVER_ID => [$this, 'driverId'],
            self::PETROL_STATIONS_ID => [$this, 'petrolStationsId'],
        ];
    }

    public function driverId(Builder $builder, $value)
    {
        $builder->where('driver_id', $value);
    }

    public function petrolStationsId(Builder $builder, $value)
    {
        $builder->where('petrol_stations_id', $value);
    }
}
