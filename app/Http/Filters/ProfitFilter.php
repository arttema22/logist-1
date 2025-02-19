<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Description of ProfitFilter
 *
 * @author arttema
 */
class ProfitFilter extends AbstractFilter
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
        $builder->where('id', $value);
    }
}
