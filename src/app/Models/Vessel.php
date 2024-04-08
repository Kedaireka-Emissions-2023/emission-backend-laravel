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
        'serial_number',
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
        'main_eng_total',
        'main_eng_power',
        'aux_eng_total',
        'aux_power',
        'main_eng_fuel',
        'aux_eng_fuel',
        'main_eng',
        'aux_eng',
        'created_at',
        'updated_at',
    ];

    public function emissions(): HasMany
    {
        return $this->hasMany(Emission::class, 'vessel_id', 'id');
    }
}
