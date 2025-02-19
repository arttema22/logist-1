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

class DirTypeTruck extends Model
{
    public function tariffs(): HasMany
    {
        return $this->hasMany(DirTariff::class);
    }
}
