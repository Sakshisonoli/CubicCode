<html>

<head>
    <title>Certificate</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,400;0,500;0,600;0,700;0,800;0,900;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,600;1,700&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            font-family: 'Montserrat', sans-serif !important;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Montserrat', sans-serif !important;
        }

        .certificate {
            position: relative;
            width: 100vw;
            height: 100vh;
            text-align: center;
            background-image: url('assets/certificate.jpg')
        }

        /* img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        } */

        .participant-name {
            position: absolute;
            top: 29%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #0a67b9;
            font-family: 'Montserrat', sans-serif !important;
            font-size: 40px;
            font-weight: 900;
        }

        .participant-course-name {
            position: absolute;
            top: 43%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #0a67b9;
            font-family: 'Montserrat', sans-serif !important;
            font-size: 32px;
            font-weight: 900;
        }

        .participant-certificate-id {
            position: absolute;
            top: 70%;
            left: 56%;
            transform: translate(-50%, -50%);
            color: #0a67b9;
            font-family: 'Montserrat', sans-serif !important;
            font-size: 19px;
            font-weight: 600;
        }
    </style>

</head>

<body>

    <div class="certificate">
        {{-- <img src="{{ url('assets/certificate.jpg') }}" alt="certificate" /> --}}
        <div style="font-family: 'Montserrat', sans-serif !important;" class="participant-name">
            {{ $participant->name }}
        </div>

        <div style="font-family: 'Montserrat', sans-serif !important;" class="participant-course-name">
            {{ $participant->enrolled_course }}
        </div>

        <div style="font-family: 'Montserrat', sans-serif !important;" class="participant-certificate-id">
            {{ $participant->id }}
        </div>
    </div>

</body>

</html>
