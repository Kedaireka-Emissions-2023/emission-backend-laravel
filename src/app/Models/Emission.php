<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;
use Spatie\SchemalessAttributes\SchemalessAttributesTrait;

use App\Models\Drone;
use App\Models\Vessel;
use App\Models\Port;
use App\Models\User;

class Emission extends Model
{
    use HasFactory, SchemalessAttributesTrait;
    protected $fillable = [
        'id',
        'checking_id',
        'drone_id',
        'vessel_id',
        'port_id',
        'checking_id',
        'preparation',
        'date',
        'time',
        'duration_apx',
        'status',
        'levels',
        'lkh_th',
        'osha_th',
        'who_th',
        'link',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'preparation' => SchemalessAttributes::class,
    ];

    protected $schemalessAttributes = [
        'preparation',
    ];

    public function drone()
    {
        return $this->belongsTo(Drone::class, 'drone_id', 'id');
    }

    public function vessel()
    {
        return $this->belongsTo(Vessel::class, 'vessel_id', 'id');
    }

    public function port()
    {
        return $this->belongsTo(Port::class, 'port_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'emission_user');
    }

    public function emissionData(): HasMany
    {
        return $this->hasMany(EmissionData::class, 'emission_id', 'id');
    }
}
