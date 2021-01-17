<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpsReading extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'winpower_id',
        'device_id',
        'status',
        'voltage_in',
        'frequency_in',
        'voltage_out',
        'frequency_out',
        'current_load_percentage',
        'battery_capacity_percentage',
    ];
}
