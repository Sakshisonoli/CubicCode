<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Channel Partner Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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
            /* text-align: center; */
        }

        img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .s-number {
            position: absolute;
            top: 18.5%;
            left: 79.4%;
            transform: translate(-50%, -50%);
            color: #292929;
            font-family: 'Montserrat', sans-serif !important;
            font-size: 14.5px;
            font-weight: 300;
        }

        .i-date {
            position: absolute;
            top: 20.6%;
            left: 70%;
            transform: translate(-50%, -50%);
            color: #292929;
            font-family: 'Montserrat', sans-serif !important;
            font-size: 13px;
            font-weight: 300;
        }

        .s-name {
            position: absolute;
            top: 31%;
            left: 12.6%;
            transform: translate(-50%, -50%);
            color: #000;
            font-family: 'Montserrat', sans-serif !important;
            font-size: 16px;
        }

        .mobile-no {
            position: absolute;
            top: 33.5%;
            left: 14%;
            transform: translate(-50%, -50%);
            color: #252525;
            font-family: 'Montserrat', sans-serif !important;
            font-size: 12px;
        }

        .course-name {
            position: absolute;
            width: 260px;
            top: 45.7%;
            left: 30.8%;
            transform: translate(-50%, -50%);
            color: #000000;
            font-family: 'Montserrat', sans-serif !important;
            font-size: 13px;
            font-weight: 400;
            line-height: 18px;
        }

        .sac {
            position: absolute;
            top: 45.6%;
            left: 58%;
            transform: translate(-50%, -50%);
            color: #000000;
            font-family: 'Montserrat', sans-serif !important;
            font-size: 13px;
            font-weight: 400;
            line-height: 18px;
        }

        .rate {
            position: absolute;
            top: 45.6%;
            left: 67%;
            transform: translate(-50%, -50%);
            color: #000000;
            font-family: 'Montserrat', sans-serif !important;
            font-size: 13px;
            font-weight: 400;
            line-height: 18px;
        }

        .tax {
            position: absolute;
            top: 45.6%;
            left: 77%;
            transform: translate(-50%, -50%);
            color: #000000;
            font-family: 'Montserrat', sans-serif !important;
            font-size: 13px;
            font-weight: 400;
            line-height: 18px;
        }

        .amount {
            position: absolute;
            top: 45.6%;
            right: 5%;
            transform: translate(-50%, -50%);
            color: #000000;
            font-family: 'Montserrat', sans-serif !important;
            font-size: 13px;
            font-weight: 400;
            line-height: 18px;
        }

        .total-amt {
            position: absolute;
            top: 55.3%;
            right: 1%;
            transform: translate(-50%, -50%);
            color: #000000;
            font-family: 'Montserrat', sans-serif !important;
            font-size: 14px;
            font-weight: 500;
            line-height: 18px;
        }

        .taxable-amt {
            position: absolute;
            top: 59.1%;
            right: 5%;
            transform: translate(-50%, -50%);
            color: #000000;
            font-family: 'Montserrat', sans-serif !important;
            font-size: 12px;
            font-weight: 400;
            line-height: 18px;
        }

        .cgst {
            position: absolute;
            top: 61.3%;
            right: 5.2%;
            transform: translate(-50%, -50%);
            color: #000000;
            font-family: 'Montserrat', sans-serif !important;
            font-size: 12px;
            font-weight: 400;
            line-height: 18px;
        }

        .sgst {
            position: absolute;
            top: 63.1%;
            right: 5.2%;
            transform: translate(-50%, -50%);
            color: #000000;
            font-family: 'Montserrat', sans-serif !important;
            font-size: 12px;
            font-weight: 400;
            line-height: 18px;
        }

        .total {
            position: absolute;
            top: 65.6%;
            right: 2.5%;
            transform: translate(-50%, -50%);
            color: #000000;
            font-family: 'Montserrat', sans-serif !important;
            font-size: 14px;
            font-weight: 500;
            line-height: 18px;
        }

        .received-amt {
            position: absolute;
            top: 68.5%;
            right: 5.2%;
            transform: translate(-50%, -50%);
            color: #000000;
            font-family: 'Montserrat', sans-serif !important;
            font-size: 11.5px;
            font-weight: 400;
            line-height: 18px;
        }

        .next-ins-amt {
            position: absolute;
            top: 71%;
            right: 5.2%;
            transform: translate(-50%, -50%);
            color: #000000;
            font-family: 'Montserrat', sans-serif !important;
            font-size: 11.5px;
            font-weight: 400;
            line-height: 18px;
        }
    </style>

</head>
<body>
    <div class="certificate">
        <img src="assets/channelpartnerinvoice.jpg" alt="Partner Invoice">
        <div class="s-number">
             {{ $branchData->id }}
        </div>
        <div class="i-date">
            {{ \Carbon\Carbon::now()->format('F j, Y') }}
       </div>
        <div class="s-name">
            <strong> {{ $branchData->branch_name }} </strong>
        </div>
        <div class="mobile-no">
            <strong>Mobile: </strong> {{ $branchData->phone }}
        </div>

        <div class="course-name">
            CHANNEL PARTNER ONBOARDING
        </div>

        <div class="sac">
            1
       </div>

       <div class="rate">
            {{ number_format($taxableAmt) }}
       </div>

        <div class="tax">
            {{ number_format($tax) }}
        </div>

        <div class="amount">
            {{ number_format($totalPaid) }}
        </div>

        <div class="total-amt">
            <b> Rs. {{ number_format($totalPaid) }} </b>
        </div>

        <div class="taxable-amt">
            {{ number_format($taxableAmt) }}
        </div>

        <div class="cgst">
            {{ number_format($cgst) }}
       </div>

       <div class="sgst">
            {{ number_format($sgst) }}
       </div>

       <div class="total">
             <b> {{ number_format($totalPaid) }} </b>
       </div>

       <div class="received-amt">
             {{ number_format($totalPaid) }}
       </div>

       <div class="next-ins-amt">
            {{ number_format($totalDue) }}
       </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
