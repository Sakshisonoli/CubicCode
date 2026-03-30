@extends('frontend.layouts.main')

@section('content')
    <main class="container pt-2 mt-4">
        <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
            <div class="col-lg-9 px-0">
                <h3 class="">{{ $event->event_name }} Tickets</h3>
                <p class="event-data-l my-3">
                    {{ \Carbon\Carbon::createFromFormat('Y-m-d', $event->event_date)->format('F j, Y') }} |
                    {{ $event->event_time }}
                </p>

                <hr>

                <div class="row">
                    <div class="col-lg-7">
                        <h5 class="card-title">{{ $ticket->seat->seat_type }}</h5>
                        <p class="card-text ticket-items">
                            <span>Row {{ $ticket->seat->row }} </span>
                            <br>
                            <span class="text-danger"> <b> {{ $ticket->number_of_tickets }} Tickets</b>
                                {{ $ticket->sell_type }}</span>
                        </p>
                        <p class="ticket-features">
                            @php
                                $features = json_decode($ticket->features, true);
                            @endphp

                            @if (is_array($features))
                                @foreach ($features as $feature)
                                    <span class="badge bg-light text-dark">{{ $feature }}</span>
                                @endforeach
                            @endif
                        </p>

                    </div>
                    <div class="col-lg-5">
                        <h4 class="card-title text-right">INR {{ number_format($ticket->max_price) }}
                            <sup>Per Ticket</sup>
                        </h4>

                    </div>
                </div>
            </div>
        </div>

        @if (session('error'))
            <script>
                Swal.fire("{{ session('error') }}");
            </script>
        @endif

        @if (session('success'))
            <script>
                Swal.fire(
                    "Done!",
                    "{{ session('success') }}",
                    "success"
                );
            </script>
        @endif

        <div class="row g-5">

            <div class="col-md-6">
                <form method="POST" action="{{ route('bid_now') }}">
                    @csrf

                    @php
                        $cId = auth()->user()->id;
                    @endphp
                    <input type="hidden" name="customer_id" value="{{ $cId }}">
                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                    <input type="hidden" name="event_id" value="{{ $event->id }}">

                    <div class="row mb-3">
                        <label for="bid_amt" class="col-md-4 col-lg-4 col-form-label">
                            Enter your bid amount
                        </label>
                        <div class="col-md-8 col-lg-8">
                            <input name="bid_amt" type="number" class="form-control" id="bid_amt" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="ticket_qty" class="col-md-4 col-lg-4 col-form-label">
                            Enter the number of tickets you want to purchase.
                        </label>
                        <div class="col-md-8 col-lg-8">
                            <input name="ticket_qty" type="number" class="form-control" id="ticket_qty" required>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-100">Bid Now</button>
                    </div>
                </form>
            </div>

            <div class="col-md-6">

                @if ($bidings->count() > 0)
                    @foreach ($bidings as $bid)
                        <div class="card w-90 mb-3 shadow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        {{-- <h5 class="card-title">{{ $bid->customer->name }}</h5> --}}
                                        <p class="card-text ticket-items">
                                            <span>{{ $bid->event->event_name }} </span>
                                            <br>
                                            <span> Bid Timing:
                                                {{ \Carbon\Carbon::parse($bid->bid_time)->format('d M Y, h:i A') }}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-lg-6">
                                        <h5 class="card-title text-right"> <b>Bid Price: </b> INR
                                            {{ number_format($bid->bid_amt) }}
                                            <sup>{{ $bid->ticket_qty }} Ticket</sup>
                                        </h5>
                                        <span class="text-danger text-decoration-underline"> This bid is for <b>
                                                {{ $bid->ticket_qty }}</b>
                                            ticket.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>Place a bid. You are now the first bidder for this ticket. More chances to make this ticket yours</p>
                @endif

            </div>
        </div>

    </main>
@endsection
