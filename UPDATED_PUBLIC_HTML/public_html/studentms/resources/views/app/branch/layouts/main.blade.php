<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Institute Management Application">
    <meta property="og:title" content="Institute Management Application">
    <meta property="og:description" content="Institute Management Application">
    <meta property="og:image" content="social-image.png">
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>Institute Management Application</title>
    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">

    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/css/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    {{-- <link rel="stylesheet" href="../../cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css"> --}}
    <link href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/jvmap/jquery-jvectormap.css" rel="stylesheet') }}">
    {{-- <link href="../../cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css" rel="stylesheet"> --}}
    <link href="{{ asset('assets/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}"
        rel="stylesheet">

    <!-- tagify-css -->
    <link href="{{ asset('assets/vendor/tagify/dist/tagify.css') }}" rel="stylesheet">

    <!-- Style css -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    {{-- Chart CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body data-typography="poppins" data-theme-version="light" data-layout="vertical" data-nav-headerbg="black"
    data-headerbg="color_1">


    @include('app.branch.layouts.header')

    @yield('content')

    @include('app.branch.layouts.footer')



</body>

</html>
