<!DOCTYPE html>
<html lang="{{ session('locale') }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="id" content="{{ auth()->check() ? auth()->id() : '' }}">


    <title>Localkod - Online Chat App</title>
    <meta name="description" content="Web ve Mobil Projelerinizde Localkod yanınızda ! Projelerinizde %100 güvenli ve özgür bir yazılım için bizi tercih edebilirsiniz." />
    <meta name="author" content="Localkod" />

    <link rel="shortcut icon" href="{{ asset('backend/images/favicon.png') }}">

    @yield('css')

    <link href="{{ asset('backend/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    <link href="{{ asset('backend/css/sweetalert.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/css/toastify.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/css/custom.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body data-topbar="dark" data-layout="horizontal">

    <div id="layout-wrapper">

        @include('components.include-sections.header')

        @include('components.include-sections.navbar')


        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    @yield('content')

                </div>
            </div>

            @yield('modal')

            @include('components.include-sections.footer')
        </div>

    </div>


    @include('components.include-sections.right-bar')

    <div class="rightbar-overlay"></div>


    <script src="{{ asset('backend/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/libs/jquery-validation/jquery.validate.min.js') }}"></script>

    <script src="{{ asset('backend/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('backend/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('backend/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ asset('backend/js/ckeditor/ckeditor.js') }}"></script>

    <script src="{{ asset('backend/js/app.js') }}"></script>
    <script src="{{ asset('backend/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('backend/js/toastify.min.js') }}"></script>

    @vite('resources/js/app.js')

    @yield('js')

    @include('components.alerts.all-alert')

    @include('components.modals.wait')
</body>

</html>
