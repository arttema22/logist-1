<?php

namespace App\Models\Refilling;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class FuelSupplier extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'contract_id',
        'number',
        'inn',
        'kpp',
        'date',
        'balance',
    ];

    /**
     * Аксессор
     * Преобразует дату из базы в нужный формат.
     * Формат лежит в config\app
     */
    public function getDateAttribute($value)
    {
        return Carbon::createFromTimestamp(strtotime($value))
            ->format(config('app.date_format'));
    }
}
