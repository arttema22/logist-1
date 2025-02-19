<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Refilling;

class DirPetrolStations extends Model {

    use HasFactory;

    /**
     * Получить данные о заправках на АЗС.
     */
    public function listRefilling() {
        return $this->hasMany(Refilling::class, 'petrol_stations_id', 'id');
    }

}
