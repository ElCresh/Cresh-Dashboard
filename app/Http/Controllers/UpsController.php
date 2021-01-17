<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UpsController extends Controller
{
    static function getUpsReading($id){
        $client = new \GuzzleHttp\Client(['http_errors' => false, 'verify' => false]);

        $api_get_user = $client->request(
            'GET',
            'https://10.0.0.2:8888/' . $id . '/json'
        );

        if ($api_get_user->getBody()) {
            $ups_data = json_decode((string) $api_get_user->getBody());
        }else{
            $ups_data = new \stdClass;
        }

        return $ups_data;
    }

    static function getUpsList(){
        $client = new \GuzzleHttp\Client(['http_errors' => false, 'verify' => false]);

        $api_get_user = $client->request(
            'GET',
            'https://10.0.0.2:8888/listJson'
        );

        if ($api_get_user->getBody()) {
            $ups_list = json_decode((string) $api_get_user->getBody());
        }else{
            $ups_list = new \stdClass;
        }

        return $ups_list;
    }
}
