<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status'
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
        'password' => 'hashed',
    ];

    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class);
    // }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user')->withTimestamps();
    }

    public function hasRole($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    // public function shifts()
    // {
    //     return $this->hasMany(Shift::class);
    // }

    // app/Models/Shift.php
    // public function schedules()
    // {
    //     return $this->hasMany(Schedule::class);
    // }

    public function getWorkdayNamesAttribute()
    {
        return $this->schedules->pluck('shift.days')->flatMap(function ($dayIds) {
            // $dayIds is an array of workday IDs
            return Workdays::whereIn('id', $dayIds)->pluck('name');
        })->implode(', ');
    }

    public function attendances()
    {
        return $this->hasMany(Attendances::class);
    }

    public function schedule()
    {
        return $this->hasOne(Schedule::class);
    }

}
