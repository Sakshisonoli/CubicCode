@extends('backend.dashboard.layouts.main')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">


                                <div class="card-body">
                                    <h5 class="card-title">Events</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-music-player"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ number_format($events) }}</h6>
                                            <span class="text-muted small pt-2 ps-1">
                                                <a href="">View All Events</a>
                                            </span>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Sales Card -->

                        <!-- Revenue Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">



                                <div class="card-body">
                                    <h5 class="card-title">Tickets</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-receipt"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ number_format($tickets) }}</h6>
                                            <span class="text-muted small pt-2 ps-1">
                                                <a href="">View All Tickets</a>
                                            </span>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->

                        <!-- Customers Card -->
                        <div class="col-xxl-4 col-xl-12">

                            <div class="card info-card customers-card">

                                <div class="card-body">
                                    <h5 class="card-title">Customers </h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ number_format($customers) }}</h6>
                                            <span class="text-muted small pt-2 ps-1">
                                                <a href="">View All Customers</a>
                                            </span>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div><!-- End Customers Card -->



                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">


                                <div class="card-body">
                                    <h5 class="card-title">Payment Requests <span>| Today</span></h5>

                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th>
                                                    No.
                                                </th>
                                                <th>Owner</th>
                                                <th>Event Name</th>
                                                <th>Ticket Price</th>
                                                <th>Tickets</th>
                                                <th>Total Price</th>
                                                <th>Seat</th>
                                                <th>Payment Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($ticketsReq)
                                                @foreach ($ticketsReq as $ticket)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td> {{ $ticket->owner->name }} </td>
                                                        <td> {{ $ticket->event->event_name }} </td>
                                                        <td> ₹ {{ number_format($ticket->min_price) }} </td>
                                                        <td> {{ $ticket->number_of_tickets }} </td>
                                                        <td> ₹ {{ number_format($ticket->total_min_price) }} </td>
                                                        <td> {{ $ticket->seat->seat_level }} </td>

                                                        <td>
                                                            @if ($ticket->paid_status == null)
                                                                <a href="{{ route('sendPaymentRequest', ['id' => $ticket->id]) }}"
                                                                    class="btn btn-outline-primary btn-sm">Send
                                                                    Request</a>
                                                            @elseif ($ticket->paid_status === 'processing')
                                                                <span class="badge bg-info"><i
                                                                        class="bi bi-arrow-repeat"></i>
                                                                    Processing</span>
                                                            @elseif ($ticket->paid_status === 'requested')
                                                                <span class="badge bg-danger"><i
                                                                        class="bi bi-exclamation-circle"></i>
                                                                    Requested
                                                                </span>
                                                            @elseif ($ticket->paid_status === 'approved')
                                                                <span class="badge bg-success"><i
                                                                        class="bi bi-check-circle me-1"></i>
                                                                    Approved
                                                                </span>
                                                            @elseif ($ticket->paid_status === 'paid')
                                                                <span class="badge bg-success"><i
                                                                        class="bi bi-check-circle me-1"></i>
                                                                    Paid
                                                                </span>
                                                            @endif
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div><!-- End Recent Sales -->

                    </div>
                </div><!-- End Left side columns -->



            </div><!-- End Right side columns -->

            </div>
        </section>

    </main>
@endsection
