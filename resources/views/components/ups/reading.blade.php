<div class="card">
    <div class="card-header card-header-icon card-header-{{ $upsReading->getColor() }}">
        <div class="card-icon">
            <i class="material-icons">{{ $upsReading->getIcon() }}</i>
        </div>
    </div>
    <div class="card-body">
        <h4 class="card-title">{{ $upsReading->device_id }}</h4>
        <div class="">
            <h5>Info</h5>
            <b>Status:</b> {{ $upsReading->status }} <br />
        </div>

        <div class="mt-2">
            <h5>Input</h5>
            <b>In. volt.:</b> {{ $upsReading->voltage_in }} V<br />
            <b>In. freq.:</b> {{ $upsReading->frequency_in }} Hz <br />
        </div>

        <div class="mt-2">
            <h5>Output</h5>
            <b>Out. volt.:</b> {{ $upsReading->voltage_out }} V <br />
            <b>Out. freq.:</b> {{ $upsReading->frequency_out }} Hz <br />
            <b>Current load:</b> {{ $upsReading->current_load_percentage }}% <br />
        </div>

        <div class="mt-2">
            <h5>Battery</h5>
            <b>Batt. capacity:</b> {{ $upsReading->battery_capacity_percentage }}% <br />
        </div>

        @if($showLastEvents)
            <div class="mt-2">
                <h5>Last events</h5>
                @foreach ($events as $event)
                    =[{{ $event->date_time }}]= <br />
                    {{ $event->description }} <br />
                @endforeach
            </div>
        @endif
    </div>
    <div class="card-footer">
        <div class="stats">
            <i class="material-icons">access_time</i> {{ $upsReading->created_at }}
        </div>
    </div>
</div>