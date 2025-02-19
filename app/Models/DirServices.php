<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Services;

class DirServices extends Model {

    use HasFactory;

    /**
     * Получить данные о оказанных дополнительных услугах.
     */
    public function services() {
        return $this->hasMany(Services::class, 'service_id', 'id');
    }

}
