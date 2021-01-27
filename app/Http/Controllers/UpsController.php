<?php

namespace App\Http\Controllers;

use App\Models\Ups;
use App\Models\UpsEvent;
use App\Models\UpsReading;

use App\Tables\UpsReadingsTable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UpsController extends Controller
{
    function list(){
        return view('ups/list', ['upses' => Ups::get()]);
    }

    function history($id){
        $ups = Ups::findOrFail($id);

        $chats = array();
        

        foreach($ups->getReadings() as $reading){
            $charts['timeline'][] = $reading->created_at;
            $charts['datas']['voltage_in'][] = $reading->voltage_in;
            $charts['datas']['voltage_out'][] = $reading->voltage_out;
            $charts['datas']['frequency_in'][] = $reading->frequency_in;
            $charts['datas']['frequency_out'][] = $reading->frequency_out;
            $charts['datas']['current_load_percentage'][] = $reading->current_load_percentage;
            $charts['datas']['battery_capacity_percentage'][] = $reading->battery_capacity_percentage;
        }

        return view('ups/history', ['ups' => $ups, 'charts' => $charts, 'upsReadingsTable' => (new UpsReadingsTable($ups))->setup()]);
    }

    static function isAvailabile(){
        $isAvailable = false;

        try{
            $client = new \GuzzleHttp\Client(['http_errors' => false, 'verify' => false]);

            $api_get_user = $client->request(
                'GET',
                env('UPS_IP') . '/' . $id . '/json'
            );

            if ($api_get_user->getBody()) {
                $isAvailabile = true;
            }
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
        } catch(\GuzzleHttp\Exception\RequestException $e) { }
        
        return $isAvailabile;
    }

    static function getUpsReading($id){
        $ups_reading = new \stdClass;

        try{
            $client = new \GuzzleHttp\Client(['http_errors' => false, 'verify' => false]);

            $api_get_user = $client->request(
                'GET',
                env('UPS_IP') . '/' . $id . '/json'
            );

            if ($api_get_user->getBody()) {
                $ups_data = json_decode((string) $api_get_user->getBody());
                $ups_reading = UpsReading::make([
                    'winpower_id' => $id,
                    'device_id' => $ups_data->key,
                    'status' => $ups_data->status,
                    'voltage_in' => str_replace('V','',$ups_data->inVolt),
                    'frequency_in' => str_replace('Hz','',($ups_data->inFreq != '') ? $ups_data->inFreq : 0),
                    'voltage_out' => str_replace('V','',$ups_data->outVolt),
                    'frequency_out' => str_replace('Hz','',$ups_data->outFreq),
                    'current_load_percentage' => $ups_data->loadPercentMax,
                    'battery_capacity_percentage' => str_replace('%','',$ups_data->batCapacity),
                ]);
            }
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
        } catch(\GuzzleHttp\Exception\RequestException $e) { }

        return $ups_reading;
    }

    static function getUpsLastEvents($id){
        $events = array();

        try{
            $client = new \GuzzleHttp\Client(['http_errors' => false, 'verify' => false]);

            $api_get_user = $client->request(
                'GET',
                env('UPS_IP') . '/' . $id . '/json'
            );

            if ($api_get_user->getBody()) {
                $ups_data = json_decode((string) $api_get_user->getBody());

                if($ups_data->lastEvent2 != ''){
                    $ups_event = self::parseUpsEventString($ups_data->lastEvent2);
                    $ups_event->winpower_id = $id;
                    $ups_event->device_id = $ups_data->key;
                    $events[] = $ups_event;
                }

                if($ups_data->lastEvent1 != ''){
                    $ups_event = self::parseUpsEventString($ups_data->lastEvent1);
                    $ups_event->winpower_id = $id;
                    $ups_event->device_id = $ups_data->key;
                    $events[] = $ups_event;
                }
            }
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
        } catch(\GuzzleHttp\Exception\RequestException $e) { }

        return $events;
    }

    private static function parseUpsEventString($event_string){
        $splitted_event = explode(' ',$event_string,3);
        $date_time_event = $splitted_event[0] . ' ' . $splitted_event[1];
        $description_event = $splitted_event[2];

        $ups_event = UpsEvent::make([
            'date_time' => $date_time_event,
            'description' => $description_event,
        ]);

        return $ups_event;
    }

    static function getUpsList(){
        $ups_list = new \stdClass;

        try{
            $client = new \GuzzleHttp\Client(['http_errors' => false, 'verify' => false]);
    
            $api_get_user = $client->request(
                'GET',
                env('UPS_IP') . '/listJson'
            );
    
            if ($api_get_user->getBody()) {
                $ups_list = json_decode((string) $api_get_user->getBody());
            }
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
        } catch(\GuzzleHttp\Exception\RequestException $e) { }

        return $ups_list;
    }

    static function scheduledRecording(){
        $upses = self::getUpsList();

        foreach($upses as $ups){
            $ups_reading = self::getUpsReading($ups->id);

            // Checking if data is valid by verifying device id
            if($ups_reading->device_id != ''){
                $ups_reading->save();
            }

            // Checking if Ups exist in upses db list
            $isUpsExisting = Ups::where('winpower_id',$ups->id)->where('device_id',$ups_reading->device_id)->first();
            if(!$isUpsExisting){
                Ups::create([
                    'winpower_id' => $ups->id,
                    'device_id' => $ups_reading->device_id,
                ]);
            }

            $ups_events = self::getUpsLastEvents($ups->id);

            foreach($ups_events as $event){
                // Beforse saving event in database a check of duplicated event
                // is needed bacuse WinPower return last two events at any codition
                // so event can be duplicated

                $isEventExisting = UpsEvent::where('date_time',$event->date_time)->where('description',$event->description)->first();

                if(!$isEventExisting && $event->description != ''){
                    $event->save();
                }
            }
        }
    }
}
