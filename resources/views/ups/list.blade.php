@extends('layouts.page_templates.dashboard')

@section('content')
    <div class="row">
        @foreach ($upses as $ups)
            @php
                $ups_reading = $ups->getLastReading();
            @endphp
            <a class="col-md-6 col-lg-4" href="{{ route('ups.history', ['id' => $ups->id]) }}">
                <x-ups-reading :ups-reading="$ups->getLastReading()" :events="$ups->getRecentEvent()"/>
            </a>
        @endforeach
    </div>
@endsection