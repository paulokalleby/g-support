<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>
       @yield('title')
    </title>

    <link href="{{ url('images/static/icone.ico') }}" rel="icon" type="image/ico">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="{{ asset('/vendor/fontawersome/css/all.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/argon.min.css?v=1.2.1') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/custom.css') }}" rel="stylesheet" type="text/css" />

    @stack('component-styles')

    @livewireStyles

    <script defer src="/js/alpine.min.js"></script>

</head>

<body>

    @auth
        @livewire('navegation.side-bar')
    @endauth

    <div class="main-content" id="app">

        @auth
            @livewire('navegation.nav-bar')

            <div class="header bg-gradient-primary pb-6">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="row align-items-center py-3">
                            <div class="col-12">
                                <nav aria-label="breadcrumb" class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    @yield('breadcrumb')
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endauth

        <div>
            {{ $slot }}
        </div>

    </div>

    <script src="{{ asset('/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/vendor/js-cookie/js.cookie.js') }}"></script>
    <script src="{{ asset('/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('/js/argon.min.js?v=1.2.1') }}"></script>
    <script src="{{ asset('/js/demo.min.js') }}"></script>
    <script src="{{ asset('/vendor/sweetalert/sweetalert2@11.js') }}"></script>
    
    <x-livewire-alert::scripts />

    @stack('component-scripts')

    @livewireScripts

</body>

</html>
