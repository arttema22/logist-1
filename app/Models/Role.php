<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model {

    use HasFactory;

    /**
     * Пользователи, которые принадлежат данной роли.
     */
    public function users() {
        return $this->hasMany(User::class, 'role_id', 'id');
    }

}
