<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Carbon\Carbon;
use App\Models\ReviseData;

class Revise extends Model {

    use HasFactory;

    /**
     * Получить данные о владельце.
     */
    public function owner() {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    /**
     * Получить данные о водителе.
     */
    public function driver() {
        return $this->belongsTo(User::class, 'driver_id', 'id');
    }

    /**
     * Получить данные о сверках с водителем.
     */
    public function reviseData() {
        return $this->hasMany(ReviseData::class, 'revise_id', 'id');
    }

    /**
     * Аксессор
     * Преобразует дату из базы в нужный формат.
     * Формат лежит в config\app
     */
    public function getDateStartAttribute($value) {
        return Carbon::parse($value)->format(config('app.date_format'));
    }

    public function getDateEndAttribute($value) {
        return Carbon::parse($value)->format(config('app.date_format'));
    }

}
