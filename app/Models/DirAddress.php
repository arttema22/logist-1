<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Routes;

class DirAddress extends Model {

    use HasFactory;

    /**
     * Получить маршруты, связанные с пунктом погрузки.
     */
    //public function routesLoading() {
    //    return $this->hasMany(Routes::class, 'address_loading_id', 'id');
    //}

    /**
     * Получить маршруты, связанные с пунктом разгрузки.
     */
    //public function routesUnloading() {
    //    return $this->hasMany(Routes::class, 'address_unloading_id', 'id');
    //}

}
