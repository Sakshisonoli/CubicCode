<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="certificate" />

    <meta name="author" content="Themefisher" />

    <title>Cleancode Certification</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon-32x32.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600&family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">


    <!-- Mobile Specific Meta-->
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css" />

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css" />

    <!-- Custom Stylesheet -->
    <style>
        html {
            scroll-behavior: smooth;
        }

        * {
            box-sizing: border-box;
        }
    </style>

</head>

<body id="body">

    <section class="section-banner d-flex align-items-center">
        <div class="container">

            <div class="banner-content text-center">
                <img src="assets/images/logo.png" class="text-center" width="250" /> <br> <br>

                <h2 class="mt-1">Download Your Certificate</h2>
                <span class="mb-5"><b> Kindly enter your certificate ID to download your
                        certificate</b></span>

                <form action="{{ url('/get-certificate') }}" method="post" class="sub-form mt-4 mb-3">
                    @csrf

                    <input type="email" class="form-control" name="email" id="email" required>
                    <button type="submit" class="btn btn-secondary btn-rounded mt-3">Get Certificate</button>

                </form>
            </div>
        </div>
    </section>


    <!-- Bootstrap 4.3 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwIQh7LGryQdDDi-A603lR8NqiF3R_ycA"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>
