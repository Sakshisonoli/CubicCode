@extends('frontend.layouts.main')

@section('content')
    <div class="">
        <div class="container">
            <div class="card py-4">
                <div class="card-body">
                    <h2 class="card-title">Refund and Cancellation Policy</h2>

                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house-door"></i></a></li>

                            <li class="breadcrumb-item active">Refund and Cancellation Policy</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="p-5">
            <h6>
                <b>Take look at</b>
            </h6>
            <h2>
                1. General Policy
            </h2>

            <li> <b>All Sales Are Final:</b> Once a ticket is purchased through QUEUES, it is non-refundable under any
                circumstances, except as outlined in the “Event Cancellation” or “Event Postponement” sections below.</li>
            <li> <b>Reselling Your Tickets:</b> If you can’t attend an event, you have the option to resell your ticket
                securely on QUEUES.</li>

            <br>
            <hr>
            <br>

            <h2>2. Event Cancellation</h2>

            <li>
                <b> Full Refunds for Event Cancellations: </b>If an event is officially canceled by the organizer, QUEUES
                will issue
                a 100% refund of the ticket purchase price to the buyer. Refunds will be automatically credited to the
                original payment method within 7–10 business days.
            </li>

            <br>
            <hr><br>

            <h2>3. Event Postponement</h2>
            <li> <b>If Previous Tickets Are Valid:</b> In the event of a reschedule where the organizer confirms that the
                original
                tickets remain valid, no refunds will be provided. Buyers can still use their tickets for the rescheduled
                event.</li>
            <li> <b>If Previous Tickets Are Invalid:</b> If the organizer states that previously issued tickets are not
                valid for the rescheduled event, QUEUES will issue a full refund to the original payment method.</li>

            <br>
            <hr><br>

            <h2>4. Buyer-Initiated Cancellations</h2>
            <p>Buyers cannot cancel or request refunds for purchased tickets. However, they may relist their ticket for
                resale on QUEUES.</p>

            <br>
            <hr><br>

            <h2>5. Seller-Initiated Cancellations</h2>

            <p>If a buyer receives an invalid or fraudulent ticket, they may report it under the QueuesCare Policy. QUEUES
                will investigate and, if validated, provide a refund or replacement ticket at no additional cost to the
                buyer.</p>

            <br>
            <hr><br>

            <h2>6. Invalid Tickets</h2>
            <p>If a buyer receives an invalid or fraudulent ticket, they may report it under the QueuesCare Policy. QUEUES
                will investigate and, if validated, provide a refund or replacement ticket at no additional cost to the
                buyer.</p>

            <br>
            <hr><br>

            <h2>7. Disputes and Resolutions</h2>
            <p>Disputes must be reported within 48 hours of the event, with relevant proof. QUEUES will review each case and
                take appropriate action based on the QueuesCare Policy.</p>
        </div>
    </div>
@endsection
