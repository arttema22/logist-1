<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Routes;
use Illuminate\Database\Eloquent\SoftDeletes;

class DirCargo extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * Получить маршруты, связанные с грузом.
     */
    public function routes()
    {
        return $this->hasMany(Routes::class, 'cargo_id', 'id');
    }
}
