@extends('backend.customer.layouts.main')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Orders</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('customer_dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Orders</li>
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
                                        <th>
                                            Order Id
                                        </th>
                                        <th>No. Of Tickets</th>
                                        <th>Event Name</th>
                                        <th>Seat</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($tickets)
                                        @foreach ($tickets as $ticket)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td> {{ $ticket->order_id }} </td>
                                                <td> {{ $ticket->no_of_tickets }} </td>
                                                <td> {{ $ticket->ticket->event->event_name }} </td>
                                                <td> {{ $ticket->ticket->seat->seat_level }} </td>
                                                <td>

                                                    @if ($ticket->status === 'completed')
                                                        <span class="badge bg-success"><i
                                                                class="bi bi-check-circle me-1"></i>
                                                            Purchased</span>
                                                    @elseif ($ticket->status === 'pending')
                                                        <span class="badge bg-danger"><i class="bi bi-emoji-frown me-1"></i>
                                                            Pending</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <a href="{{ route('ticketDetails', ['id' => $ticket->ticket_id]) }}"
                                                        class="btn-link btn" style="font-size: 14px">View
                                                        Ticket</a>
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
