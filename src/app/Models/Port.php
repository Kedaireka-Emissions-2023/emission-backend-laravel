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
        'port_id',
        'name',
        'operator_address',
        'office_address',
        'longitude',
        'latitude',
        'city',
        'phone_number',
        'port_document',
        'created_at',
        'updated_at',
    ];
}
