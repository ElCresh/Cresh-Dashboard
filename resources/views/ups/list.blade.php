@extends('layouts.page_templates.dashboard')

@section('content')
    <div class="row">
        @foreach ($upses as $ups)
            @php
                $ups_reading = $ups->getLastReading();
            @endphp
            <a class="col-md-6" href="{{ route('ups.history', ['id' => $ups->id]) }}">
                <div class="card">
                    <div class="card-header card-header-icon card-header-success">
                        <div class="card-icon">
                            <i class="material-icons">battery_charging_full</i>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">{{ $ups_reading->device_id }}</h4>
                        <div class="">
                            <h5>Info</h5>
                            <b>Status:</b> {{ $ups_reading->status }} <br />
                        </div>

                        <div class="mt-2">
                            <h5>Input</h5>
                            <b>In. volt.:</b> {{ $ups_reading->voltage_in }} V<br />
                            <b>In. freq.:</b> {{ $ups_reading->frequency_in }} Hz <br />
                        </div>

                        <div class="mt-2">
                            <h5>Output</h5>
                            <b>Out. volt.:</b> {{ $ups_reading->voltage_out }} V <br />
                            <b>Out. freq.:</b> {{ $ups_reading->frequency_out }} Hz <br />
                            <b>Current load:</b> {{ $ups_reading->current_load_percentage }}% <br />
                        </div>

                        <div class="mt-2">
                            <h5>Battery</h5>
                            <b>Batt. capacity:</b> {{ $ups_reading->battery_capacity_percentage }}% <br />
                        </div>

                        <div class="mt-2">
                            <h5>Last events</h5>
                            @foreach ($ups->getRecentEvent() as $event)
                                [{{ $event->date_time }}] {{ $event->description }} <br />
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> updated now
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endsection