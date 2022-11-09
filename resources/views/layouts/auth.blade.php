<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/images/favicon.png') }}">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    @livewireStyles
</head>
<body class="h-100">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">

                                @yield('content')
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script src="{{ asset('admin/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('admin/js/quixnav-init.js') }}"></script>
    <script src="{{ asset('admin/js/custom.min.js') }}"></script>
    @livewireScripts
</body>
</html>
