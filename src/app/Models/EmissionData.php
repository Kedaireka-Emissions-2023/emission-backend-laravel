<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmissionData extends Model
{
    use HasFactory;

    protected $table = 'emission_data';
    protected $fillable = [
        'NO2',
        'NO',
        'SO2',
        'CO2',
        'CO',
        'PM2_5',
        'PM10',
        'time',
        'date',
        'emission_id',
        'altitude',
        'latitude',
        'longitude',
    ];

    public $timestamps = false;

    public function emission()
    {
        return $this->belongsTo(Emission::class, 'emission_id', 'id');
    }
}
