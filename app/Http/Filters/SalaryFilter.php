<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Description of SalaryFilter
 *
 * @author arttema
 */
class SalaryFilter extends AbstractFilter
{

    public const DRIVER_ID = 'driver-id';

    protected function getCallbacks(): array
    {
        return [
            self::DRIVER_ID => [$this, 'driverId'],
        ];
    }

    public function driverId(Builder $builder, $value)
    {
        $builder->where('driver_id', $value);
    }
}
