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
                $events = UpsController::getUpsLastEvents($ups->id);
            @endphp
            
            <div class="col-md-6 col-lg-4">
                <x-ups-reading :ups-reading="$ups_reading" :events="$events"/>
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