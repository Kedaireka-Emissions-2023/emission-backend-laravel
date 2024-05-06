<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmissionUser extends Model
{
    use HasFactory;

    protected $table = 'emission_user';

    protected $fillable = [
        'id',
        'emission_id',
        'user_id',
    ];

    public $timestamps = false;

    public function emission()
    {
        return $this->belongsTo(Emission::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
