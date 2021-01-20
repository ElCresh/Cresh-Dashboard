<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UnifiController extends Controller
{
    static private function openConnection(){
        return new \UniFi_API\Client(env('UNIFI_USERNAME'), env('UNIFI_PASSWORD'), env('UNIFI_URI'), env('UNIFI_SITE_ID'), env('UNIFI_VERSION'), env('UNIFI_VERIFY_SSL'));
    }

    static function isAvailabile(){
        $login = false;

        $unifi_connection = self::openConnection();
        try{
            $login = $unifi_connection->login();
        }catch(\ErrorException $ex){
            // Nothing to do
        }
        
        return $login;
    }

    static function getUnifiAlerts(){
        $alarms = array();

        $unifi_connection = self::openConnection();
        try{
            $login = $unifi_connection->login();

            if($login){
                $alarms = array_reverse($unifi_connection->list_alarms());
            }
        }catch(\ErrorException $ex){
            // Nothing to do
        }
        
        return $alarms;
    }

    static function getUnifiDevices(){
        $devices = array();

        $unifi_connection = self::openConnection();
        try{
            $login = $unifi_connection->login();

            if($login){
                $devices = $unifi_connection->list_devices();
            }
        }catch(\ErrorException $ex){
            // Nothing to do
        }
        
        return $devices;
    }
}
