@extends('layouts.page_templates.dashboard')

@section('content')
    <div class="card card-nav-tabs card-plain">
        <div class="card-header card-header-danger">
            <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <ul class="nav nav-tabs" data-tabs="tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="#readings" data-toggle="tab"><i class="material-icons">format_list_bulleted</i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#events" data-toggle="tab"><i class="material-icons">warning</i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#voltage_graph" data-toggle="tab">V</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#frequency_graph" data-toggle="tab">Hz</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#load_graph" data-toggle="tab"><i class="material-icons">power_input</i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#battery_charge_graph" data-toggle="tab"><i class="material-icons">battery_charging_full</i></a>
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
        <div class="tab-pane active" id="voltage_graph"></div>
        <div class="tab-pane active" id="frequency_graph"></div>
        <div class="tab-pane active" id="load_graph"></div>
        <div class="tab-pane active" id="battery_charge_graph"></div>
    </div>
    <script>
        var vin_data = {
            type: "scatter",
            mode: "lines",
            name: "Vin",
            x: @json($charts['timeline']),
            y: @json($charts['datas']['voltage_in']),
            line: {color: 'lightgreen'}
        }

        var vout_data = {
            type: "scatter",
            mode: "lines",
            name: "Vout",
            x: @json($charts['timeline']),
            y: @json($charts['datas']['voltage_out']),
            line: {color: 'darkgreen'}
        }

        var voltage_data = [vin_data,vout_data, { title: { text: 'Voltage' } }];

        Plotly.newPlot('voltage_graph', voltage_data);
        $('#voltage_graph').removeClass('active');

        var fin_data = {
            type: "scatter",
            mode: "lines",
            name: "Fin",
            x: @json($charts['timeline']),
            y: @json($charts['datas']['frequency_in']),
            line: {color: 'lightgreen'}
        }

        var fout_data = {
            type: "scatter",
            mode: "lines",
            name: "Fout",
            x: @json($charts['timeline']),
            y: @json($charts['datas']['frequency_out']),
            line: {color: 'darkgreen'}
        }

        var frequency_data = [fin_data,fout_data];

        Plotly.newPlot('frequency_graph', frequency_data, { title: { text: 'Frequency' } });
        $('#frequency_graph').removeClass('active');

        var current_load_data = {
            type: "scatter",
            name: "% load",
            x: @json($charts['timeline']),
            y: @json($charts['datas']['current_load_percentage']),
            mode: "lines",
            line: {color: 'purple'}
        }

        Plotly.newPlot('load_graph', [current_load_data], { title: { text: 'Battery load' } });
        $('#load_graph').removeClass('active');

        var battery_charge_data = {
            type: "scatter",
            name: "% battery",
            x: @json($charts['timeline']),
            y: @json($charts['datas']['battery_capacity_percentage']),
            mode: "lines",
            line: {color: 'red'}
        }

        var layout = 

        Plotly.newPlot('battery_charge_graph', [battery_charge_data], { title: { text: 'Battery charge' } });
        $('#battery_charge_graph').removeClass('active');
    </script>
@endsection