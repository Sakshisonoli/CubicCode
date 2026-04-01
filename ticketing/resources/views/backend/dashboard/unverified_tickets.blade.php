@extends('backend.dashboard.layouts.main')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Unverified Tickets</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Unverified Tickets</li>
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

                                        <th>
                                            Tickets
                                        </th>
                                        <th>
                                            Event Name
                                        </th>
                                        <th>Seat</th>
                                        <th>Sell Type</th>
                                        <th>
                                            Status
                                        </th>
                                        <th>
                                            Price Per Ticket
                                        </th>
                                        <th>
                                            Ticket Owner
                                        </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($tickets)
                                        @foreach ($tickets as $ticket)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>
                                                    <a href="{{ route('ticket_info', ['id' => $ticket->id]) }}">
                                                        {{ $ticket->number_of_tickets }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('ticket_info', ['id' => $ticket->id]) }}">
                                                        {{ $ticket->event->event_name }}
                                                    </a>
                                                </td>
                                                <td> {{ $ticket->seat->seat_level }} </td>
                                                <th> {{ $ticket->sell_type }} </th>
                                                <td>
                                                    @if ($ticket->status === 'Verified')
                                                        <span class="badge bg-success"><i
                                                                class="bi bi-check-circle me-1"></i>
                                                            Verified</span>
                                                    @elseif ($ticket->status === 'Unverified')
                                                        <span class="badge bg-warning text-dark"><i
                                                                class="bi bi-exclamation-triangle me-1"></i>
                                                            Unverified</span>
                                                    @elseif ($ticket->status === 'Cancel')
                                                        <span class="badge bg-danger"><i
                                                                class="bi bi-exclamation-octagon me-1"></i>
                                                            Cancel</span>
                                                    @elseif ($ticket->status === 'Soldout')
                                                        <span class="badge bg-success"><i
                                                                class="bi bi-check-circle me-1"></i>
                                                            Sold Out</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ number_format($ticket->min_price) }}
                                                </td>
                                                <td>
                                                    {{ $ticket->owner->name }}
                                                </td>

                                                <td>
                                                    <a href="{{ route('delete_ticket', ['id' => $ticket->id]) }}"
                                                        onclick="return confirm('Are you sure you want to delete this ticket?');"
                                                        class="btn-link text-danger"><i class="bi bi-trash"></i></a>
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
