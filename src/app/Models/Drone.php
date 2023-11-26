<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Drone extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'serial_number',
        'weight_no_payload',
        'cruise_speed',
        'climb_max_rate',
        'volume_payload_size',
        'wing_material',
        'fuselage_material',
        'filesave_system',
        'max_takeoff_weight',
        'max_flight_range',
        'max_speed',
        'max_cruise_head',
        'operational_payload_weight',
        'proximity_sensor',
        'precision_landinig_mechanism',
        'operation_system',
        'communication_system',
        'description',
        'image',
        'cert_emergency_procedure',
        'cert_insurance_doc',
        'cert_equipment_list',
        'cert_drone_photo',
        'cert_drone_certificate',
        'expiration_date',
        'created_at',
        'updated_at',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'pilots', 'drones_id', 'users_id')
                    ->as('pilots');
    }

    public function emissions(): HasMany
    {
        return $this->hasMany(Emission::class, 'drones_id', 'id');
    }
}
