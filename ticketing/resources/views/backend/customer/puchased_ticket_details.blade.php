@extends('backend.customer.layouts.main')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Ticket Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('customer_dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Ticket Details</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->


        @if (session('success'))
            <script>
                Swal.fire(
                    "Done!",
                    "{{ session('success') }}",
                    "success"
                );
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire("{{ session('error') }}");
            </script>
        @endif

        <section class="section profile">
            <div class="row">

                <div class="col-xl-12">

                    <div class="card">
                        <div class="card-body pt-3">

                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                    {{-- <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Order Id</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $ticket->order->order_id }}
                                        </div>
                                    </div> --}}

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Event Name</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $ticket->event->event_name }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Artist Name</div>
                                        <div class="col-lg-9 col-md-8">{{ $ticket->event->artist_name }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Event Date</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{-- @if ($ticket->event->event_date)
                                        {{ $$ticket->event->event_date }}
                                    @endif --}}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Event Time</div>
                                        <div class="col-lg-9 col-md-8">{{ $ticket->event->event_time }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Seat</div>
                                        <div class="col-lg-9 col-md-8">{{ $ticket->seat->seat_type }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Number Of Ticktes</div>
                                        <div class="col-lg-9 col-md-8">{{ $ticket->number_of_tickets }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Ticket Price</div>
                                        <div class="col-lg-9 col-md-8">₹ {{ number_format($ticket->min_price) }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Ticket Total Price</div>
                                        <div class="col-lg-9 col-md-8">₹ {{ number_format($ticket->total_min_price) }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Ticket Total Price</div>
                                        <div class="col-lg-9 col-md-8">

                                            <a href="{{ asset('tickets/' . $ticket->ticket_image1) }}">
                                                <iframe src="{{ asset('tickets/' . $ticket->ticket_image1) }}"
                                                    frameborder="0"></iframe>
                                            </a>

                                            <a href="{{ asset('tickets/' . $ticket->ticket_image1) }}" target="_blank"
                                                class="btn btn-link">View Ticket</a>

                                            <a href="{{ asset('tickets/' . $ticket->ticket_image1) }}"
                                                class="btn btn-outline-primary" download>Download</a>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
