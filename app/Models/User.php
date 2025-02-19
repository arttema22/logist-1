<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use App\Models\Profile;
use App\Models\Profits;
use App\Models\Refilling;
use App\Models\Revise;
use App\Models\ReviseData;
use App\Models\Routes;
use App\Models\Role;
use App\Models\Salary;
use App\Models\Traits\Filterable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Filterable;

    /**
     * Получить роль пользователя.
     */
    public function roles()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    /**
     * Получить профиль пользователя.
     */
    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    /**
     * Получить данные о выплатах водителю.
     */
    public function driverSalary()
    {
        return $this->hasMany(Salary::class, 'driver_id', 'id');
    }

    /**
     * Получить данные о заправках водителя.
     */
    public function driverRefilling()
    {
        return $this->hasMany(Refilling::class, 'driver_id', 'id');
    }

    /**
     * Получить данные о маршрутах водителя.
     */
    public function driverRoute()
    {
        return $this->hasMany(Routes::class, 'driver_id', 'id');
    }

    /**
     * Получить данные об услугах водителя.
     */
    public function driverService()
    {
        return $this->hasMany(Services::class, 'driver_id', 'id');
    }

    /**
     * Получить данные о начислениях водителю.
     */
    public function profit()
    {
        return $this->hasMany(Profits::class, 'driver_id', 'id');
    }

    /**
     * Получить данные о начислениях водителю.
     */
    public function driverRevise()
    {
        return $this->hasMany(ReviseData::class, 'driver_id', 'id');
    }

    /**
     * Получить данные о заправках автора заправок.
     */
    public function ownerRefilling()
    {
        return $this->hasMany(Refilling::class, 'owner_id', 'id');
    }

    /**
     * Получить данные о маршрутах автора маршрутов.
     */
    public function ownerRoute()
    {
        return $this->hasMany(Routes::class, 'owner_id', 'id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
}
