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
        'drone_id',
        'vessel_id',
        'name',
        'pilot',
        'preparation',
        'date',
        'result',
        'levels',
        'lkh_th',
        'osha_th',
        'who_th',
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

    public function drones(): BelongsTo
    {
        return $this->belongsTo(Drone::class, 'drone_id', 'id');
    }

    public function vessels(): BelongsTo
    {
        return $this->belongsTo(Vessel::class, 'vessel_id', 'id');
    }
}
