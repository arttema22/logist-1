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

    public const START = 'start';

    protected function getCallbacks(): array
    {
        return [
            self::START => [$this, 'start'],
        ];
    }

    public function start(Builder $builder, $value)
    {
        $builder->where('start', 'like', '%{$value}');
    }
}
