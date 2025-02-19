<?php

namespace App\Models;

use App\Models\Routes;
use App\Models\DirTariff;
use App\Models\RouteBilling;
use App\Models\DistanceBilling;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DirTypeTrucks extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * Получить тариф по расстоянию, связанный с типом авто.
     */
    public function distanceBilling()
    {
        return $this->hasOne(DistanceBilling::class, 'type_truck_id', 'id');
    }

    /**
     * Получить тарифы по маршрутам, связанные с типом авто.
     */
    public function routeBilling()
    {
        return $this->hasMany(RouteBilling::class, 'type_truck_id', 'id');
    }

    /**
     * Получить маршруты, связанные с типом авто.
     */
    public function routes()
    {
        return $this->hasMany(Routes::class, 'dir_type_trucks_id', 'id');
    }
}
