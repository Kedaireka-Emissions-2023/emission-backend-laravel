<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Port extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'operator_address',
        'office_address',
        'longitude',
        'latitude',
        'created_at',
        'updated_at',
    ];

    public function vessels(): HasMany
    {
        return $this->hasMany(Vessel::class, 'ports_id', 'id');
    }
}
