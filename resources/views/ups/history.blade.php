@extends('layouts.page_templates.dashboard')

@section('content')
    <div class="row">
        @foreach ($ups->getReadings() as $ups_reading)
            <div class="col-md-6 col-lg-4 col-xxl-2">
                <x-ups-reading :ups-reading="$ups_reading" :events="$ups->getRecentEvent()"/>
            </div>
        @endforeach
    </div>
@endsection