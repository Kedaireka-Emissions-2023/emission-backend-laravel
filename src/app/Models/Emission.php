<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;
use Spatie\SchemalessAttributes\SchemalessAttributesTrait;

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
        'pilot',
        'preparation',
        'date',
        'time',
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
        'pilot' => SchemalessAttributes::class,
        'preparation' => SchemalessAttributes::class,
    ];

    protected $schemalessAttributes = [
        'pilot',
        'preparation',
    ];

    public function drone(): BelongsTo
    {
        return $this->belongsTo(Drone::class, 'drone_id', 'id');
    }

    public function vessel(): BelongsTo
    {
        return $this->belongsTo(Vessel::class, 'vessel_id', 'id');
    }

    public function port(): BelongsTo
    {
        return $this->belongsTo(Port::class, 'port_id', 'id');
    }
}
