<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Confirmation</title>
</head>

<body>
    <p>Hi {{ $name }},</p>
    <p>
        You’ve successfully purchased a ticket to {{ $eventName }}!
    </p>
    <ul>
        <li> <b>Seat:</b> {{ $seat }} </li>
        <li> <b>Price:</b> {{ number_format($totalPrice) }} </li>
        <li> <b>Delivery:</b> {{ $deliveryType }} </li>
        {{-- <li> <b>ETA:</b> </li> --}}
    </ul>

    <p>
        Enjoy the show!
        <br>
        || Team Queues || <br>
        <a href="https://queues.store/" target="_blank">https://queues.store/</a>
    </p>
</body>

</html>
