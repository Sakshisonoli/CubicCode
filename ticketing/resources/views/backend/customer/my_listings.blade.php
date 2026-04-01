@extends('backend.customer.layouts.main')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Listings</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('customer_dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">listings</li>
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

        <section class="section">
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
                                        <th>Event Name</th>
                                        <th>Tickets</th>
                                        <th>Total Tickets Price</th>
                                        <th>Seat</th>
                                        <th>Sell Type</th>
                                        <th>
                                            Status
                                        </th>
                                        <th>
                                            Price Per Ticket
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($tickets)
                                        @foreach ($tickets as $ticket)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td> {{ $ticket->event->event_name }} </td>
                                                <td> {{ $ticket->number_of_tickets }} </td>
                                                <td>₹ {{ number_format($ticket->total_min_price) }} </td>
                                                <td> {{ $ticket->seat->seat_level }} </td>
                                                <th> {{ $ticket->sell_type }} </th>
                                                <td>

                                                    @if ($ticket->status === 'Verified')
                                                        <span class="badge bg-primary"><i
                                                                class="bi bi-check-circle me-1"></i>
                                                            Verified</span>
                                                    @elseif ($ticket->status === 'Unverified')
                                                        <span class="badge bg-danger"><i class="bi bi-emoji-frown me-1"></i>
                                                            Unverified</span>
                                                    @elseif ($ticket->status === 'partially_sold')
                                                        <span class="badge bg-warning"><i
                                                                class="bi bi-check-circle me-1"></i>
                                                            Partially Sold</span>
                                                    @elseif ($ticket->status === 'sold')
                                                        <span class="badge bg-success"><i
                                                                class="bi bi-check-circle me-1"></i>
                                                            Sold</span>
                                                    @endif

                                                </td>
                                                <td>
                                                    {{ number_format($ticket->min_price) }}
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

    </main>

    <!-- End #main -->
@endsection
