<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Emission extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'drones_id',
        'vessels_id',
        'name',
        'levels',
        'lkh_th',
        'osha_th',
        'who_th',
        'created_at',
        'updated_at',
    ];

    public function drones(): BelongsTo
    {
        return $this->belongsTo(Drone::class, 'drones_id', 'id');
    }

    public function vessels(): BelongsTo
    {
        return $this->belongsTo(Vessel::class, 'vessels_id', 'id');
    }
}
