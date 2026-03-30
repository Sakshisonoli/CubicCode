@extends('frontend.layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mt-3">
                <div class="card mt-3">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-6">
                                <img src="{{ asset('events/' . $ticket->event->event_photo) }}"
                                    class="card-img-top event-s-image" alt="Queues">
                            </div>

                            <div class="col-lg-6 p-3">
                                <h4 class="card-title fs-3 fw-bold"> {{ $ticket->event->event_name }} </h4>
                                <p class="fw-medium fs-5">
                                    {{ $ticket->event->artist_name }}
                                </p>

                                <span style="font-size: 16px">
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d', $ticket->event->event_date)->format('F j, Y') }}
                                </span>
                                {{-- <p style="font-size: 13px">
                                    <b>Stadium:</b> {{ $ticket->event->event_stadium }}
                                    <br>
                                    <b>Seat Numbers:</b>
                                    @if (is_array($ticket->seat_numbers))
                                        @foreach ($ticket->seat_numbers as $number)
                                            <span class="text-dark">{{ $number }},</span>
                                        @endforeach
                                    @endif
                                </p> --}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-6 mt-3">

                <div class="card mt-3">
                    <div class="card-body">
                        <h6 class="fw-bold">Your Order</h6>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6">
                                <span>The number of tickets you selected</span>
                            </div>
                            <div class="col-lg-6">
                                <div class="float-end">
                                    <span> {{ $qty }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-lg-6">
                                <span>Ticket price:</span>
                            </div>
                            <div class="col-lg-6">
                                <div class="float-end">
                                    <span> {{ $qty }} </span> x <span>INR
                                        {{ number_format($price) }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-lg-6">
                                <span>Handling and booking fee:</span>
                            </div>
                            <div class="col-lg-6">

                                <div class="float-end">
                                    <span> {{ $qty }} </span> x <span>INR
                                        {{ number_format($charge) }}</span>
                                </div>

                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-lg-6">
                                <h6 class="fw-bold">Total price:</h6>
                            </div>
                            <div class="col-lg-6">
                                <div class="float-end">
                                    <h6 class="fw-bold text-success">INR
                                        {{ number_format($totalPrice) }}</h6>
                                </div>

                            </div>
                        </div>

                        @auth
                            <div class="row mt-2">
                                <div class="col-lg-12">
                                    <button class="btn btn-primary w-100 buy-now" type="button" role="button"
                                        data-ticket-id="{{ $ticket->id }}" data-price="{{ $totalPrice }}"
                                        data-quantity="{{ $qty }}">
                                        Pay Now
                                    </button>
                                </div>
                            </div>
                        @endauth


                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).on('click', '.buy-now', function() {
            const ticketId = $(this).data('ticket-id');
            const price = $(this).data('price');
            const quantity = $(this).data('quantity');
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
                    price: price,
                    quantity: quantity
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
@endsection
