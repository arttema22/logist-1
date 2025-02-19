<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Revise;

class ReviseData extends Model {

    use HasFactory;

    /**
     * Получить данные о сверке.
     */
    public function revise() {
        return $this->belongsTo(Revise::class, 'revise_id', 'id');
    }

    /**
     * Получить данные о водителе.
     */
    public function driver() {
        return $this->belongsTo(User::class, 'driver_id', 'id');
    }

}
