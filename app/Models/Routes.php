<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\User;
use App\Models\DirTypeTrucks;
use App\Models\DirCargo;
use App\Models\DirPayers;
use App\Models\DirAddress;
use App\Models\Services;
use App\Models\Traits\Filterable;

class Routes extends Model
{

    use HasFactory;
    use Filterable;

    /**
     * Получить данные о дополнительных услугах.
     */
    public function services()
    {
        return $this->hasMany(Services::class, 'route_id', 'id');
    }

    /**
     * Получить данные о создателе записи о марщруте.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    /**
     * Получить данные о водителе.
     */
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id', 'id');
    }

    /**
     * Получить данные о типе автомобиля.
     */
    public function typeTruck()
    {
        return $this->belongsTo(DirTypeTrucks::class, 'dir_type_trucks_id', 'id');
    }

    /**
     * Получить данные о грузе.
     */
    public function cargo()
    {
        return $this->belongsTo(DirCargo::class, 'cargo_id', 'id');
    }

    /**
     * Получить данные о плательщике.
     */
    public function payer()
    {
        return $this->belongsTo(DirPayers::class, 'payer_id', 'id');
    }

    /**
     * Получить данные о пункте погрузки.
     */
    //public function addressLoading() {
    //    return $this->belongsTo(DirAddress::class, 'address_loading_id', 'id');
    //}

    /**
     * Получить данные о пункте разгрузки.
     */
    //public function addressUnloading() {
    //    return $this->belongsTo(DirAddress::class, 'address_unloading_id', 'id');
    //}

    /**
     * Аксессор
     * Преобразует дату из базы в нужный формат.
     * Формат лежит в config\app
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromTimestamp(strtotime($value))
            ->format(config('app.date_format'));
    }
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::createFromTimestamp(strtotime($value))
            ->format(config('app.date_format'));
    }

    public function getDeletedAtAttribute($value)
    {
        return Carbon::createFromTimestamp(strtotime($value))
            ->format(config('app.date_format'));
    }
}
