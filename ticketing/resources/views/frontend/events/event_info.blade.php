@extends('frontend.layouts.main')

@section('content')
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

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <div>
                    <div class="form-outline" data-mdb-input-init>
                        <input type="search" id="form1" class="form-control hpx_search_h" placeholder="Search Event"
                            aria-label="Search" />
                    </div>

                    <div style="position: relative;">
                        <div id="search-results" class="mt-3 text-start hpx_home_search d-none"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>

    <main class="container pt-2 mt-4">
        <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
            <div class="col-lg-6 px-0">
                <h1 class="text-left text-capitalize" style="font-size: 28px; text-align: left !important;">
                    {{ $event->event_name }} Tickets
                </h1>
                <p class="event-data-l my-3">
                    {{ \Carbon\Carbon::createFromFormat('Y-m-d', $event->event_date)->format('F j, Y') }} |
                    {{ $event->event_time }}
                </p>
            </div>
        </div>

        <div class="row g-5">

            <div class="col-md-6">
                <div class="position-sticky" style="top: 2rem;">
                    <div>
                        <img width="100%" src="/stadiums/{{ $event->stadium->image1 }}" alt="">
                    </div>
                </div>
            </div>

            <div class="col-md-6">

                @if ($tickets->count() > 0)
                    @foreach ($tickets as $ticket)
                        @if ($ticket->status === 'Verified')
                            <div class="card w-90 mb-3 shadow">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h5 class="card-title">{{ $ticket->seat->seat_type }}</h5>
                                            <p class="card-text ticket-items">
                                                <span>Row {{ $ticket->seat->row }} </span>
                                                <br>
                                                <span>{{ $ticket->number_of_tickets }} Tickets
                                                    {{ $ticket->sell_type }}</span>

                                            <p style="font-size: 12px;"> <b>Seat Numbers:</b>
                                                @if (is_array($ticket->seat_numbers))
                                                    @foreach ($ticket->seat_numbers as $number)
                                                        <span class="text-dark">{{ $number }},</span>
                                                    @endforeach
                                                @endif
                                            </p>
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
                                        <div class="col-lg-6">
                                            <h5 class="card-title text-right">INR {{ number_format($ticket->max_price) }}
                                                <sup>Per Ticket</sup>
                                            </h5>


                                            @guest
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-primary w-100"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                            Buy Now
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">

                                                                        <h1 style="text-transform: capitalize; font-size: 24px;"
                                                                            class="modal-title fs-5 py-3">Please
                                                                            login or create an account to buy this ticket.</h1>

                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body py-4 my-4">

                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <a href="{{ route('login') }}"
                                                                                    class="btn btn-sm btn-outline-primary w-100">Login</a>
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <a href="{{ route('register') }}"
                                                                                    class="btn btn-sm btn-primary w-100">Create
                                                                                    Account</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endguest

                                            @auth
                                                {{-- <div class="row">
                                                <div class="col-lg-6">
                                                    <button class="btn btn-primary w-100 buy-now" type="button" role="button"
                                                        data-ticket-id="{{ $ticket->id }}"
                                                        data-price="{{ $ticket->max_price }}">
                                                        Buy Now
                                                    </button>
                                                </div>
                                            </div> --}}

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <a href="{{ route('checkout', ['id' => $ticket->id]) }}"
                                                            class="btn btn-primary w-100">
                                                            Buy Now
                                                        </a>
                                                    </div>
                                                </div>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <p>Opps! Tickets Not Found</p>
                @endif

            </div>
        </div>

    </main>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).on('click', '.buy-now', function() {
        const ticketId = $(this).data('ticket-id');
        const price = $(this).data('price');
        const url = '{{ route('order.create') }}';

        $.ajax({
            url: url,
            type: 'POST',
            contentType: 'application/json',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: JSON.stringify({
                ticket_id: ticketId,
                price: price
            }),
            success: function(response) {
                if (response.success && response.redirectUrl) {
                    // Redirect the user straight to PhonePe
                    window.location.href = response.redirectUrl;
                } else {
                    console.error('Order creation error:', response);
                    alert(response.error || 'Failed to initiate payment. Please try again.');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', status, error, xhr.responseText);
                alert('Payment initiation failed. Please try again.');
            }
        });
    });
</script>
