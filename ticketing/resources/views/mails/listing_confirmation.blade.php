<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket Listing Confirmation</title>
</head>

<body>
    <p>Hi {{ $name }},</p>
    <p>
        Your ticket listing for {{ $eventName }} is now live!
    </p>
    <ul>
        <li> <b>Size:</b> {{ $seat }}</li>
        <li> <b>Price:</b> ₹ {{ number_format($price) }}</li>
        <li> <b>Event Date:</b> {{ \Carbon\Carbon::createFromFormat('Y-m-d', $eventDate)->format('F j, Y') }}</li>
    </ul>

    <p>
        You’ll get an email when a buyer is interested.
    </p>

    <p>
        Thanks for using Queues,
        <br>
        || Team Queues || <br>
        <a href="https://queues.store/" target="_blank">https://queues.store/</a>
    </p>
</body>

</html>
