<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DirTypeTrucks;
use Illuminate\Database\Eloquent\SoftDeletes;

class DistanceBilling extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * Получить тип авто, связанный с тарифом.
     */
    public function typeTruck()
    {
        return $this->belongsTo(DirTypeTrucks::class, 'type_truck_id', 'id');
    }
}
