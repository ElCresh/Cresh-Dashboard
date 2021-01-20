@extends('layouts.page_templates.dashboard')

@section('content')
    <div class="card card-nav-tabs card-plain">
        <div class="card-header card-header-danger">
            <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <ul class="nav nav-tabs" data-tabs="tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="#readings" data-toggle="tab">Readings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#events" data-toggle="tab">Events</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="readings">
            {{ $upsReadingsTable }}
        </div>
        <div class="tab-pane" id="events">
            <div class="row">
                @foreach ($ups->getEvents() as $event)
                    <div class="col-md-6 col-lg-4 col-xxl-2">
                        <x-ups-event :ups-event="$event" />
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection