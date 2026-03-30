<!DOCTYPE html>
<html lang="en" class="h-100">

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
    <title>Cleancode Dashboard | Login - Come as a Beginner, Leave as a Professional</title>
    <meta property="og:title" content="Cleancode - Come as a Beginner, Leave as a Professional" />
    <meta property="og:description"
          content="At Cleancode, we operate a series of offline learning centers that offer comprehensive, well-structured, and high-quality technical courses. Our curriculum is designed specifically for beginners who have no previous experience or knowledge in the subject and transform them into professionals in the field. With our dedicated placement team and community support, we are committed to providing our students with a 100% job guarantee." />
    <meta property="og:url" content="https://cubiccode.in" />
    <meta property="og:site_name" content="Cleancode - Curiosity iTech Private Limited." />

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

</head>

<body class="vh-100">


    @yield('content')


    <!-- Required vendors -->
    <script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/deznav-init.js') }}"></script>
    <script src="{{ asset('assets/js/demo.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

</body>

</html>
