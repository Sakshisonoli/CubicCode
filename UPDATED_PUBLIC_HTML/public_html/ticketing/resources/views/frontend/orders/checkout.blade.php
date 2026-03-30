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
                                <p style="font-size: 13px">
                                    <b>Stadium:</b> {{ $ticket->event->event_stadium }}
                                    <br>
                                    <b>Seat Numbers:</b>
                                    @if (is_array($ticket->seat_numbers))
                                        @foreach ($ticket->seat_numbers as $number)
                                            <span class="text-dark">{{ $number }},</span>
                                        @endforeach
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="py-3">
                            <p class="ticket-features"> <b style="font-size: 14px; font-weight: 500;">Features:</b>
                                @php
                                    $features = json_decode($ticket->features, true);
                                @endphp

                                @if (is_array($features))
                                    @foreach ($features as $feature)
                                        <span class="badge bg-light text-dark">{{ $feature }}</span>
                                    @endforeach
                                @endif
                            </p>

                            <p class="ticket-features"> <b style="font-size: 14px; font-weight: 500;">Limitations</b>
                                @php
                                    $limitations = json_decode($ticket->limitations, true);
                                @endphp

                                @if (is_array($limitations))
                                    @foreach ($limitations as $limitation)
                                        <span class="badge bg-light text-dark">{{ $limitation }}</span>
                                    @endforeach
                                @endif
                            </p>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-6 mt-3">

                <div class="card mt-3">
                    <div class="card-body">
                        <h6 class="fw-bold">Order summary</h6>

                        <div class="row">
                            <div class="col-lg-6">
                                <span>Ticket price:</span>
                            </div>
                            <div class="col-lg-6">
                                <div class="float-end">
                                    <span> {{ $ticket->number_of_tickets }} </span> x <span>INR
                                        {{ number_format($ticket->min_price) }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-lg-6">
                                <span>Handling and booking fee:</span>
                            </div>
                            <div class="col-lg-6">

                                <div class="float-end">
                                    <span> {{ $ticket->number_of_tickets }} </span> x <span>INR
                                        {{ number_format($chargeAmt) }}</span>
                                </div>

                            </div>
                        </div>

                        {{-- <div class="row mt-2">
                            <div class="col-lg-6">
                                <h6 class="fw-bold">Total price:</h6>
                            </div>
                            <div class="col-lg-6">
                                <div class="float-end">
                                    <h6 class="fw-bold text-success">INR
                                        {{ number_format($ticket->total_max_price) }}</h6>
                                </div>

                            </div>
                        </div> --}}
                        <hr>
                        <div class="row mt-3">
                            <div class="col-lg-12">

                                {{-- <h6>Please confirm how many tickets you would like to purchase</h6> --}}
                                <h6>The number of tickets you are purchasing</h6>

                                <form method="POST" action="{{ route('checkoutTickets', ['id' => $ticket->id]) }}">
                                    @csrf

                                    {{-- <input type="hidden" name="ticket_id" value="{{ $ticket->id }}"> --}}

                                    <div class="row">
                                        <div class="col-lg-8">
                                            <label for="selected_qty">Ticket quantity:</label>
                                        </div>

                                        <div class="col-lg-4">
                                            {{-- <select class="form-select" name="selected_qty" required>
                                                @for ($i = 1; $i <= $ticket->number_of_tickets; $i++)
                                                    <option value="{{ $i }}">{{ $i }}
                                                    </option>
                                                @endfor
                                            </select> --}}
                                            <input type="hidden" name="selected_qty"
                                                value="{{ $ticket->number_of_tickets }}">

                                            <div class="float-end">
                                                <span> {{ $ticket->number_of_tickets }}
                                            </div>
                                        </div>
                                    </div>


                                    <button type="submit" class="btn btn-primary w-100 mt-3">Proceed to
                                        checkout</button>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
