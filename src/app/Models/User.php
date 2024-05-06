<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'port_id',
        'full_name',
        'email',
        'email_recovery',
        'password',
        'role',

        'company_name',
        'phone_number',
        'company_address',
        'nik',
        'status',

        'ktp',
        'certificate',
        'exp_certificate',

        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function drones(): BelongsToMany
    {
        return $this->belongsToMany(Drone::class, 'pilots', 'user_id', 'drone_id')
            ->as('pilots');
    }

    public function emissions()
    {
        return $this->belongsToMany(Emission::class, 'emission_user');
    }

    public function port()
    {
        return $this->belongsTo(Port::class);
    }

}
