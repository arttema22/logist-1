<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DirDistance extends Model
{
    use HasFactory;

    public function typetruck(): BelongsToMany
    {
        return $this->belongsToMany(DirTypeTrucks::class)->withPivot('price');
    }
}
