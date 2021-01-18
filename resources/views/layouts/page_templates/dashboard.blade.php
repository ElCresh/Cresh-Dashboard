@php
    $route_name = Route::currentRouteName();
@endphp

<!doctype html>
<html lang="en">
    <head>
        <title>{{ config('app.name') }}</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />

        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

        <!-- Material Dashboard CSS -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body>
        <div class="wrapper">
            <div class="sidebar" data-color="orange" data-background-color="red" data-image="">
                <div class="logo"><a href="/" class="simple-text logo-normal">
                    {{ config('app.name') }}
                </a></div>
                <div class="sidebar-wrapper">
                    <ul class="nav">
                        <li class="nav-item {{ ($route_name == 'home' ? 'active' : '') }}">
                            <a class="nav-link" href="/">
                                <i class="material-icons">dashboard</i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item {{ str_contains($route_name,'ups') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('ups.list') }}">
                                <i class="material-icons">battery_charging_full</i>
                                <p>UPS</p>
                            </a>
                        </li>
                        <li class="nav-item active-pro ">
                            <a class="nav-link" href="http://andreacrescentini.com" target="_blank">
                                <i class="material-icons">alternate_email</i>
                                <p>Andrea Crescentini</p>
                            </a>
                        </li>
                    </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar sticky-top navbar-expand-lg navbar-transparent">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <a class="navbar-brand" href="javascript:;">Dashboard</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end">
                        {{-- Noting here --}}
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="container">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>

        <!--   Core JS Files   -->
        <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
        <script>
            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();
            $('.main-panel').perfectScrollbar('destroy');
            $('.main-panel').perfectScrollbar('update');
        </script>
    </body>
</html>