@extends('backend.dashboard.layouts.main')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Sold Tickets</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Sold Tickets</li>
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
                                        <th>Tickets</th>
                                        <th>Ticket Price</th>
                                        <th>Event Name</th>
                                        <th>Seat</th>
                                        <th>
                                            Status
                                        </th>
                                        <th>Owner</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($tickets)
                                        @foreach ($tickets as $ticket)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td> {{ $ticket->number_of_tickets }} </td>
                                                <td>₹ {{ number_format($ticket->total_max_price) }} </td>
                                                <td> {{ $ticket->event->event_name }} </td>
                                                <td> {{ $ticket->seat->seat_level }} </td>
                                                <td> {{ $ticket->status }} </td>
                                                <td>
                                                    {{ $ticket->owner->name }}
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
