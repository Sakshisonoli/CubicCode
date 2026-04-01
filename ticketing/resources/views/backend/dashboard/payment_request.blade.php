@extends('backend.dashboard.layouts.main')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Payment Requests</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Payment Requests</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

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
                                        <th>Owner</th>
                                        <th>Event Name</th>
                                        <th>Ticket Price</th>
                                        <th>Tickets</th>
                                        <th>Total Price</th>
                                        <th>Seat</th>
                                        <th>Payment Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($tickets)
                                        @foreach ($tickets as $ticket)
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
                                                        <span class="badge bg-info"><i class="bi bi-arrow-repeat"></i>
                                                            Processing</span>
                                                    @elseif ($ticket->paid_status === 'requested')
                                                        <span class="badge bg-danger"><i
                                                                class="bi bi-exclamation-circle"></i>
                                                            Requested
                                                        </span>
                                                    @elseif ($ticket->paid_status === 'approved')
                                                        <span class="badge bg-primary"><i
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
                                                    <div class="btn-group">
                                                        {{-- <button type="button" class="btn btn-danger btn-sm">Danger</button> --}}
                                                        <button type="button"
                                                            class="btn btn-link text-dark rounded dropdown-toggle dropdown-toggle-split"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <span class="visually-hidden">Toggle Dropdown</span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('paymentProcessing', ['id' => $ticket->id]) }}">Processing</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('paymentApproved', ['id' => $ticket->id]) }}">Approved</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('paymentPaid', ['id' => $ticket->id]) }}">Paid</a>
                                                            </li>
                                                        </ul>
                                                    </div>
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
