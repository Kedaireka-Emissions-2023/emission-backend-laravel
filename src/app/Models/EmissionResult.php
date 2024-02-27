<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmissionResult extends Model
{
    use HasFactory;

    protected $table = 'result_emissions';
    protected $fillable = [
        'id',
        'emissions_id',
        'result',
        'failure_mode',
        'effect',
        'cause',
        'possible_action',
        'ref_protocol',
    ];

    // Disable created_at and updated_at
    public $timestamps = false;

    public function emission(): BelongsTo
    {
        return $this->belongsTo(Emission::class, 'emissions_id', 'id');
    }
}
