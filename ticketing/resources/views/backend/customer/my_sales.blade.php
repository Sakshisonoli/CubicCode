@extends('backend.customer.layouts.main')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Sales</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('customer_dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Sales</li>
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
                                        <th>Ticket Price</th>
                                        <th>Tickets</th>
                                        <th>Total Price</th>
                                        <th>Seat</th>
                                        <th>Sale Status</th>
                                        <th>Payment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($soldTickets)
                                        @foreach ($soldTickets as $ticket)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td> {{ $ticket->event->event_name }} </td>
                                                <td> ₹ {{ number_format($ticket->min_price) }} </td>
                                                <td> {{ $ticket->number_of_tickets }} </td>
                                                <td> ₹ {{ number_format($ticket->total_min_price) }} </td>
                                                <td> {{ $ticket->seat->seat_level }} </td>
                                                <td>
                                                    @if ($ticket->status === 'sold')
                                                        <span class="badge bg-success"><i
                                                                class="bi bi-check-circle me-1"></i>
                                                            Sold</span>
                                                    @else
                                                        <span class="badge bg-danger"><i class="bi bi-emoji-frown me-1"></i>
                                                            Pending</span>
                                                    @endif
                                                </td>
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
