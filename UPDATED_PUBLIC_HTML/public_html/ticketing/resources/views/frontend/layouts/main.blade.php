<!doctype html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Queues </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .event-s-image {
            width: 100%;
            height: 190px;
            object-fit: cover;
        }

        h2 {
            font-weight: 700 !important;
        }

        h5 {
            font-size: 16px;
            font-weight: 600 !important;

        }

        .event-data-l {
            font-size: 22px;
            font-weight: 700;
        }

        .ticket-items span {
            font-size: 15px !important;
        }

        .ticket-features span {
            font-size: 12px !important;
            font-weight: 400 !important;
        }

        .event-image {
            border-radius: 10px;
        }

        .show-name-s {
            font-size: 17px;
            font-weight: 700;
        }

        .home-slider-d1 .carousel img,
        .carousel-item {
            border-radius: 25px;
        }

        .home-event-title {
            font-size: 45px;
        }

        .hpx_search_h {
            height: 60px;
            border-radius: 30px;
            box-shadow: 0 0 50px #ececec;
            padding-left: 25px;
        }

        .hpx_home_search {
            position: absolute;
            width: 100%;
            max-height: 300px;
            overflow-y: auto;
            background: #fff;
            border: 1px solid #ccc;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            padding: 20px 25px;
            border-radius: 15px;
        }

        .hpx_home_search a {
            display: block;
            padding: 10px;
            color: #333;
            border-bottom: 1px solid #eee;
            margin: 20px 10px;
        }

        .hpx_home_search a:hover {
            background: #f8f9fa;
            color: #1eab5d;
            /* Light hover effect */
        }


        .hpx_about h6,
        h1 {
            text-align: center;
            text-transform: uppercase;
        }

        .hpx_about_page p {
            text-align: center;
            line-height: 30px;
            font-size: 16px;
        }

        .carousel-item img {
            width: 100%;
            height: 500px;
            object-fit: cover;

        }


        .marquee-container {
            width: 100%;
            overflow: hidden;
            white-space: nowrap;
            background-color: transparent;
        }

        .marquee-text {
            display: inline-block;
            padding-left: 100%;
            font-size: 14px;
            animation: marquee 30s linear infinite;
        }

        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        @media (max-width: 768px) {
            .home-slider-d1 .carousel-caption {
                font-size: 14px;
                bottom: 20px;
            }

            .home-slider-d1 .carousel-item img {
                object-fit: cover;
                height: 200px;

            }
        }
    </style>
</head>

<body>

    @include('frontend.layouts.header')

    @yield('content')

    @include('frontend.layouts.footer')

</body>

</html>