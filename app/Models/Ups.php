<?php

namespace App\Models;

use App\Models\UpsEvent;
use App\Models\UpsReading;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ups extends Model
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
    ];

    public function getReadings(){
        return UpsReading::where('winpower_id',$this->winpower_id)->where('device_id', $this->device_id)->orderBy('created_at','DESC')->get();
    }

    public function getLastReading(){
        return UpsReading::where('winpower_id',$this->winpower_id)->where('device_id', $this->device_id)->orderBy('created_at','DESC')->first();
    }

    public function getRecentEvent(){
        return UpsEvent::where('winpower_id',$this->winpower_id)->where('device_id', $this->device_id)->orderBy('created_at','DESC')->limit(2)->get();
    }
}
