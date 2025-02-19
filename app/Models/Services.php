<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Routes;
use App\Models\DirServices;
use App\Models\Traits\Filterable;

class Services extends Model
{

    use HasFactory;
    use Filterable;

    /**
     * Получить данные о марщруте.
     */
    public function route()
    {
        return $this->belongsTo(Routes::class, 'route_id', 'id');
    }

    /**
     * Получить данные о сервисе.
     */
    public function service()
    {
        return $this->belongsTo(DirServices::class, 'service_id', 'id');
    }

    /**
     * Аксессор
     * Преобразует дату из базы в нужный формат.
     * Формат лежит в config\app
     */
    // public function getDateAttribute($value)
    // {
    //     return Carbon::parse($value)->format(config('app.date_format'));
    // }

    // public function getDateEditAttribute()
    // {
    //     return Carbon::parse($this->date)->format('Y-m-d');
    // }

    /**
     * Аксессор
     * Преобразует дату из базы в нужный формат.
     * Формат лежит в config\app
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format(config('app.date_format'));
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format(config('app.date_format'));
    }
}
