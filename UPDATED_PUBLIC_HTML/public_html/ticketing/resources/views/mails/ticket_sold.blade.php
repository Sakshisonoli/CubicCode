<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket Sold</title>
</head>

<body>
    <p>Hi {{ $name }},</p>
    <p>
        Congrats! You’ve sold your ticket for {{ $eventName }} to {{ $buyerName }}
    </p>
    <ul>
        <li> <b>Delivery Method:</b> {{ $deliveryType }} </li>
    </ul>

    <p>
        Make sure to fulfill the order promptly to ensure a smooth experience.
    </p>

    <p>
        Thanks for using Queues,
        <br>
        || Team Queues || <br>
        <a href="https://queues.store/" target="_blank">https://queues.store/</a>
    </p>
</body>

</html>
