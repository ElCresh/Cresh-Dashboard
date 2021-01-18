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

    public function getIcon(){
        switch($this->status){
            case 'AC Fail':
                $icon = 'battery_charging_full';
                break;
            case 'AVR':
                $icon = 'battery_alert';
                break;
            case 'Normal':
                $icon = 'battery_std';
                break;
            default:
                $icon = 'battery_unknown';
        }

        return $icon;
    }

    public function getColor(){
        switch($this->status){
            case 'AC Fail':
                $color = 'danger';
                break;
            case 'AVR':
                $color = 'warning';
                break;
            case 'Normal':
                $color = 'success';
                break;
            default:
                $color = 'secondary';
        }

        return $color;
    }

    public function getCreatedAtAttribute($value){
        if($value == ''){
            $value = 'updated now';
        }

        return $value;
    }
}
