@extends('layouts.page_templates.dashboard')

@section('content')
    @php
        use \App\Http\Controllers\UpsController;

        $upses = UpsController::getUpsList();
    @endphp

    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Work in progress!</strong> This is a very unstable project! Please be careful.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="row">
        @foreach ($upses as $ups)
            @php
                $ups_reading = UpsController::getUpsReading($ups->id);
            @endphp
            
            <div class="col-md-6 col-lg-4">
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
                            @php
                                $events = UpsController::getUpsLastEvents($ups->id);
                            @endphp
                            @foreach ($events as $event)
                                =[{{ $event->date_time }}]= <br />
                                {{ $event->description }} <br />
                            @endforeach
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
            <div class="card card-blog">
                <div class="card-header card-header-image">
                    <a href="#pablo">
                        <img class="img" src="https://images.unsplash.com/photo-1511439817358-bee8e21790b5?auto=format&fit=crop&w=750&q=80&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D" rel="nofollow">
                        <div class="card-title">
                            This Summer Will be Awesome
                        </div>
                    </a>
                </div>
                <div class="card-body">
                    <h6 class="card-category text-info">Fashion</h6>
                    <p class="card-description">
                        Don&apos;t be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens&#x2019; bed design but the back is...
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endsection