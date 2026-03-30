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
                                        <th>Event Name</th>
                                        {{-- <th>
                                            Ticket Name
                                        </th> --}}
                                        <th>No. Of Tickets</th>
                                        <th>Bid Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($bids)
                                        @foreach ($bids as $bid)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td> {{ $bid->event->event_name }} </td>
                                                <td> {{ $bid->ticket->max_price }} </td>
                                                <td> {{ $bid->ticket_qty }} </td>
                                                <td>
                                                    @if ($bid->status === 'processing')
                                                        <span class="badge bg-warning"><i
                                                                class="bi bi-arrow-clockwise me-1"></i>
                                                            Processing</span>
                                                    @elseif ($bid->status === 'own')
                                                        <span class="badge bg-success"><i class="bi bi-trophy me-1"></i>
                                                            Won</span>
                                                    @elseif ($bid->status === 'lost')
                                                        <span class="badge bg-danger"><i class="bi bi-emoji-frown me-1"></i>
                                                            Lost</span>
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
