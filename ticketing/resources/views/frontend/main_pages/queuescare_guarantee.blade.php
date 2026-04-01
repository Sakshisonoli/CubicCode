@extends('frontend.layouts.main')

@section('content')
    <div class="">
        <div class="container">
            <div class="card py-4">
                <div class="card-body">
                    <h2 class="card-title">Queues Care Guarantee</h2>

                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house-door"></i></a></li>

                            <li class="breadcrumb-item active">Queues Care Guarantee</li>
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
                How It Works for Buyers:
            </h2>
            <br>
            <h5>
                If you suspect your ticket is fake or invalid, follow these steps:
            </h5>
            <li>
                Report the Issue: Notify QUEUES within 48 hours of the event.
            </li>
            <br>

            <h5>Provide Evidence: Submit clear proof, such as:</h5>
            <li>A written statement from the venue management confirming the ticket is invalid, fake, or already used.</li>
            <li>A video documenting the venue’s denial of entry, along with details of the ticket in question.</li>
            <li>Verification Process: QUEUES will review the evidence, investigate the claim, and make a determination.</li>
            <br>

            <h5>If the ticket is confirmed to be fake:</h5>
            <li>You’ll receive a full refund or, where possible, a replacement ticket at no additional cost.</li>
            <br>

            <hr>
            <br>

            <h2>How It Works for Sellers:</h2>
            <li> <b>Opportunity to Respond:</b> If a claim is made against your ticket, QUEUES will notify you immediately.
                You’ll
                be given a chance to submit proof of the ticket’s legitimacy, such as purchase receipts or other supporting
                documents.</li>
            <li> <b>Resolution:</b> If the ticket is verified as legitimate, the claim will be dismissed, and no penalties
                will
                apply. If the ticket is confirmed to be fake or invalid, QUEUES reserves the right to charge you the market
                value of the replacement ticket to ensure the buyer is compensated</li>

            <br>
            <hr>
            <br>

            <h2>Why We Collect Seller Credit Card Details:</h2>
            <p>To maintain trust and accountability, sellers must provide credit card details when listing tickets. This
                ensures that if a fraudulent ticket is sold, replacement costs can be recovered promptly. Sellers are
                charged only in cases where a claim is validated, and they fail to resolve the issue.</p>

            <br>
            <hr>
            <br>

            <h2>Important Notes:</h2>
            <p>All claims must be supported with sufficient evidence. Sellers found repeatedly listing fake or invalid
                tickets may face account suspension and permanent bans.
                <br>
                The QueuesCare Guarantee ensures that every ticket transaction is secure, transparent, and fair—for both
                buyers and sellers. With QUEUES, you can trade tickets with confidence!
            </p>
        </div>
    </div>
@endsection
