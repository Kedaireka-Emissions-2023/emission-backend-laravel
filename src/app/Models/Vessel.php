<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vessel extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'imo_number',
        'name',
        'type',
        'status',
        'dwt',
        'gt',
        'voyage_route_from',
        'voyage_route_to',
        'vessel_speed',
        'berth',
        'draft',
        'length',
        'width',
        'main_eng',
        'main_eng_power',
        'main_eng_fuel',
        'aux_eng',
        'aux_power',
        'aux_eng_fuel',
        'created_at',
        'updated_at',
        'port_id',
    ];

    public function emissions(): HasMany
    {
        return $this->hasMany(Emission::class, 'vessel_id', 'id');
    }

    public function port(): BelongsTo
    {
        return $this->belongsTo(Port::class, 'port_id', 'id');
    }
}
