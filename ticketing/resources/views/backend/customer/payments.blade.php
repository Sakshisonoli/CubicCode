@extends('backend.customer.layouts.main')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Payments</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('customer_dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Payments</li>
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

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Sell</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-music-player"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>₹ {{ number_format($totalSell) }}</h6>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Sales Card -->

                        <!-- Revenue Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">

                                <div class="card-body">
                                    <h5 class="card-title">Sell Tickets</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-receipt"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6> {{ number_format($totalTickets) }}</h6>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->

                        <!-- Customers Card -->
                        <div class="col-xxl-4 col-xl-12">

                            <div class="card info-card customers-card">

                                <div class="card-body">
                                    <h5 class="card-title">Total Received </h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>₹ {{ number_format($totalPaid) }} </h6>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div><!-- End Customers Card -->


                    </div>
                </div>



            </div>
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body pt-2">

                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>
                                            No.
                                        </th>
                                        <th>
                                            Event Name
                                        </th>
                                        <th>Tickets</th>
                                        <th>Seat</th>
                                        <th>Ticket Price</th>
                                        <th>Payment Status</th>
                                        <th>Paid Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($paidTickets)
                                        @foreach ($paidTickets as $ticket)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td> {{ $ticket->event->event_name }} </td>
                                                <td> {{ $ticket->number_of_tickets }} </td>
                                                <td> {{ $ticket->seat->seat_level }} </td>
                                                <td>₹ {{ number_format($ticket->total_min_price) }} </td>
                                                <td>
                                                    @if ($ticket->paid_status == null)
                                                        <a href="{{ route('sendPaymentRequest', ['id' => $ticket->id]) }}"
                                                            class="btn btn-outline-primary btn-sm">Send
                                                            Request</a>
                                                    @elseif ($ticket->paid_status === 'processing')
                                                        <span class="badge bg-info"><i class="bi bi-arrow-repeat"></i>
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
                                                <td>
                                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d', $ticket->paid_date)->format('F j, Y') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
