@extends('frontend.layouts.main')

@section('content')
    <div class="">
        <div class="container">
            <div class="card py-4">
                <div class="card-body">
                    <h2 class="card-title">Terms and Conditions</h2>

                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house-door"></i></a></li>

                            <li class="breadcrumb-item active">Terms and Conditions</li>
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
                1. Introduction
            </h2>
            <p>Welcome to Queues! By using our platform to buy or sell tickets, you agree to comply with the following terms
                and conditions. If you disagree, please refrain from using our services. Queues reserves the right to amend
                these terms at any time without prior notice. Continued use of the platform constitutes acceptance of the
                revised terms.</p>

            <br>
            <hr>
            <br>

            <h2>2. Nature of Service</h2>
            <li>
                Queues acts solely as an intermediary connecting buyers and sellers for ticket resale.
            </li>
            <li>Queues does not directly sell tickets or guarantee ticket prices, availability, or authenticity beyond
                seller-provided information.
            </li>
            <li>Queues is not liable for any disputes arising from third-party event organizers</li>

            <br>
            <hr><br>

            <h2>3. Buyer Responsibilities</h2>
            <li>Verify ticket details (date, time, venue, validity) before purchase. Stay informed about event updates,
                reschedules, or cancellations by contacting event organizers.</li>
            <li>
                Ensure sufficient funds are available in your account to honor bids.
            </li>
            <li>
                Provide accurate and truthful information during registration and transactions.
            </li>
            <li>Buyers must not misuse the QueuesCare Policy by submitting false claims or fabricated evidence.</li>

            <br>
            <hr><br>

            <h2>4. Seller Responsibilities
            </h2>
            <li>Ensure all tickets listed are authentic, valid, and transferable to buyers.</li>
            <li>Do not engage in black marketing, unlawful ticket resale, or fraudulent activities.</li>
            <li>Provide accurate event details and ticket descriptions.</li>
            <li>Cooperate with Queues in case of disputes or verification processes.</li>

            <br>
            <hr>
            <br>

            <h2>5. Bidding and Transaction Rules</h2>

            <h5>For Buyers:</h5>

            <li>Placing a bid creates a payment mandate that holds the bid amount until the seller accepts or the bid is
                canceled.</li>
            <li>Buyers can cancel bids anytime before seller acceptance; canceled mandates will not result in charges.</li>
            <li>Accepted bids automatically deduct the agreed amount from the buyer’s payment method.</li>
            <br>

            <h5>For Sellers:</h5>
            <li>Sellers are contractually obligated to fulfill transactions once they accept a bid. Failure to provide
                tickets after bid acceptance may result in penalties, including deductions from the seller’s credit card to
                cover replacement costs or buyer refunds.</li>

            <br>
            <hr><br>

            <h2>6. QueuesCare Policy</h2>
            <p>Queues offers a QueuesCare Policy to protect buyers and sellers:</p>

            <h5>Buyers:</h5>
            <li> <b>Refund for Event Cancellations:</b> Full refund if the event is officially canceled by the organizer.
                Rescheduled events are not covered.</li>
            <li> <b>Invalid Tickets:</b> Buyers must report invalid tickets within 48 hours after the event, providing proof
                such as
                denial of entry or communication with the seller. Upon successful verification, Queues may offer a refund or
                replacement.</li>

            <br>
            <h5>Sellers:</h5>
            <li>Sellers must adhere to the QueuesCare Policy to ensure buyers receive valid tickets.</li>
            <li>Sellers who fail to resolve disputes may face penalties, including account suspension or financial
                restitution.</li>

            <br>
            <hr><br>

            <h2>7. Prohibited Activities</h2>
            <li>Misuse of the platform for black marketing, inflated pricing, or fraudulent transactions.</li>
            <li>Creating fake accounts or listings to manipulate the marketplace.</li>
            <li>Submitting false claims under the QueuesCare Policy.</li>
            <li>Engaging in abusive or harassing behavior toward Queues staff or other users.</li>


            <br>
            <hr><br>

            <h2>8. Legal Compliance</h2>
            <li>All users must comply with applicable Indian laws regarding ticket resale.</li>
            <li>Violation of laws may result in account termination and legal action.</li>

            <br>
            <hr><br>

            <h2>9. Limitation of Liability
            </h2>
            <li>Queues’ liability is limited to cases covered under the QueuesCare Policy.</li>
            <li>Users acknowledge purchases are made at their own risk unless explicitly covered by this policy.</li>
            <li>Queues is not liable for emotional or psychological harm resulting from disputes or transactions</li>

            <br>
            <hr><br>

            <h2>10. Enforcement</h2>
            <li>Queues reserves the right to suspend or terminate accounts found violating these terms.</li>
            <li>Users agree to cooperate with Queues during investigations into disputes or claims.</li>

        </div>
    </div>
@endsection
