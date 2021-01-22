@extends('layouts.page_templates.dashboard')

@section('content')
    @php
        use \App\Http\Controllers\UpsController;
        use \App\Http\Controllers\UnifiController;
    @endphp

    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Work in progress!</strong> This is a very unstable project! Please be careful.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="row">
        @foreach (UpsController::getUpsList() as $ups)
            @php
                $ups_reading = UpsController::getUpsReading($ups->id);
                $events = UpsController::getUpsLastEvents($ups->id);
            @endphp
            
            <div class="col-md-6 col-lg-4">
                <x-ups-reading :ups-reading="$ups_reading" :events="$events" :showLastEvents="true"/>
            </div>
        @endforeach
        @if(UnifiController::isAvailabile())
            @foreach (UnifiController::getUnifiDevices() as $device)
                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-header card-header-icon card-header-success">
                            <div class="card-icon">
                                <i class="material-icons">network_check</i>
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">
                                {{ isset($device->name) ? $device->name : '' }} [{{ $device->mac}}]
                                {!! ($device->adopted == 1 ? '<i class="material-icons text-success">verified</i>' : '<i class="material-icons text-warning">new_releases</i>') !!}
                                {!! ($device->model_in_lts != '' ? '<span class="badge badge-pill badge-warning">LTS</span>' : "") !!}
                                {!! ($device->model_in_eol != '' ? '<span class="badge badge-pill badge-danger">EOL</span>' : "") !!}
                            </h4>

                            <div class="">
                                <h5>Details</h5>
                                <b>Type:</b> {{ $device->type }} <br />
                                <b>Model:</b> {{ $device->model }} <br />
                                <b>Uptime:</b> {{ $device->uptime }} <br />
                            </div>

                            <div class="mt-2">
                                <h5>Network</h5>
                                <pre>
                                    @php
                                        print_r($device->config_network);
                                    @endphp
                                </pre>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">access_time</i> updated now
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header card-header-icon card-header-success">
                        <div class="card-icon">
                            <i class="material-icons">notification_important</i>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">UniFi Alarms</h4>

                        @foreach (UnifiController::getUnifiAlerts() as $alarm)
                            <p>
                                <strong>{{ \Carbon\Carbon::parse($alarm->handled_time)->format('Y-m-d H:i:s')  }} => {{ isset($alarm->ap_name) ? $alarm->ap_name : '' }} [{{ isset($alarm->ap) ? $alarm->ap : '' }}]</strong> <br />
                                {{ $alarm->msg }}
                            </p>
                        @endforeach
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> updated now
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    @endsection