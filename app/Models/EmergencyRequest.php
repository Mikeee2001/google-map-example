<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyRequest extends Model
{
    use HasFactory;

    protected $table = 'emergency_requests';

      protected $fillable = [
        'latitude',
        'longitude',
        'status',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
