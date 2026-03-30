@extends('frontend.layouts.main')

@section('content')

    {{-- @if (session('error'))
        <script>
            Swal.fire("{{ session('error') }}");
        </script>
    @endif --}}

    @if (session('success'))
        <script>
            Swal.fire(
                "Done!",
                "{{ session('success') }}",
                "success"
            );
        </script>
    @endif
    <main class="container py-2 my-4">
        <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
            <div class="col-lg-6 px-0">
                <div class="row">
                    <div class="col-lg-3">
                        <img src="{{ asset('events/' . $event->event_photo) }}" class="img-fluid rounded-start event-image"
                            alt="Queues">
                    </div>
                    <div class="col-lg-9">
                        <h5 class="show-name-s"> {{ $event->event_name }}</h5>
                        <p class="text-secondary pt-2">
                            {{ $event->event_stadium }} | {{ $event->event_location }}
                            <br>
                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $event->event_date)->format('F j, Y') }} |
                            {{ $event->event_time }}
                        </p>

                    </div>
                </div>

            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops! Something went wrong.</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row g-5">
            <div class="col-md-8">
                {{-- <h3 class="pb-4 mb-4 fst-italic border-bottom">
                From the Firehose
            </h3> --}}

                <h4 class="mb-3">Enter your ticket details</h4>
                <form class="needs-validation" action="{{ route('submit_ticket') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                    <input type="hidden" name="owner_id" value="{{ auth()->user()->id }}">

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="number_of_tickets" class="form-label">Number of Tickets</label>
                            <input type="number" class="form-control" id="number_of_tickets" name="number_of_tickets">
                            <div class="invalid-feedback">
                                Valid number is required.
                            </div>
                            {{-- <div class="form-text text-danger mt-2">If you would like to sell those tickets together, please
                                add 2 or more ticket numbers, or please add your tickets separately to sell them separately.
                            </div> --}}
                        </div>

                        <div class="col-sm-6">
                            <label for="seat_id" class="form-label">Type of Tickets</label>
                            <select class="form-select" id="seat_id" name="seat_id" required="">
                                <option selected disabled>Choose...</option>

                                @if ($seats)
                                    @foreach ($seats as $seat)
                                        <option value="{{ $seat->id }}"> {{ $seat->seat_type }} </option>
                                    @endforeach
                                @endif

                            </select>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="seat_numbers" class="form-label">Seat Numbers</label>
                            <div id="seat-numbers-container">
                                <div class="input-group mb-2">
                                    <input type="text" name="seat_numbers[]" class="form-control"
                                        placeholder="Enter Seat Number">
                                    <button type="button"
                                        class="btn btn-outline-secondary btn-sm remove-seat-number">Remove</button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-seat-number">+ Add
                                More</button>
                        </div>

                        <div class="col-sm-6">
                            <label for="min_price" class="form-label">Ticket Price (Per Ticket)</label>
                            <input type="number" class="form-control" name="min_price" id="min_price">
                            <div class="invalid-feedback">
                                Valid number is required.
                            </div>
                        </div>


                        <div class="col-12">
                            <label for="email" class="form-label"> Select Ticket Features</label>

                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                        value="Access to VIP Lounge" name="features[]">
                                    <label class="form-check-label" for="inlineCheckbox1">Access to VIP Lounge</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="Aisle Seat"
                                        name="features[]">
                                    <label class="form-check-label" for="inlineCheckbox2">Aisle Seat</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3"
                                        value="Include Parking" name="features[]">
                                    <label class="form-check-label" for="inlineCheckbox3">Include Parking</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox4"
                                        value="Include VIP Pass" name="features[]">
                                    <label class="form-check-label" for="inlineCheckbox4">Include VIP Pass</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox5"
                                        value="Ticket & Meal Package" name="features[]">
                                    <label class="form-check-label" for="inlineCheckbox5">Ticket & Meal
                                        Package</label>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="col-12">
                            <label for="email" class="form-label"> Select Ticket Limitations</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox01"
                                        value="Obstructed view of the stage" name="limitations[]">
                                    <label class="form-check-label" for="inlineCheckbox01">Obstructed view of the
                                        stage
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox02"
                                        value="Alcohol Free Zone" name="limitations[]">
                                    <label class="form-check-label" for="inlineCheckbox02">Alcohol Free Zone</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox03"
                                        value="Limited Legroom" name="limitations[]">
                                    <label class="form-check-label" for="inlineCheckbox03">Limited Legroom</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox04"
                                        value="Side Or Rear View" name="limitations[]">
                                    <label class="form-check-label" for="inlineCheckbox04">Side Or Rear View</label>
                                </div>

                            </div>

                        </div>

                        <hr class="my-4">

                        <div class="col-sm-6">
                            <label for="about_you" class="form-label">About You</label>
                            <select class="form-select" id="about_you" name="about_you" required="">
                                <option selected disabled>Choose...</option>
                                <option value="Event Organiser">Event Organiser</option>
                                <option value="Employed with Queues">Employed with Queues</option>
                                <option value="Neither of Two">Neither of Two</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="listing_type" class="form-label">What Type of Ticket are you Listing</label>
                            <select class="form-select" id="listing_type" name="listing_type" required="">
                                <option selected disabled>Choose...</option>
                                <option value="Paper Tickets">Paper Tickets, Printed tickets, not in electronic format
                                </option>
                                <option value="E-Tickets">E-Ticket, Electronic tickets in PDF format </option>

                            </select>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="delivery_type" class="form-label">I will deliver your ticket</label>
                            <select class="form-select" id="delivery_type" name="delivery_type" required="">
                                <option selected disabled>Choose...</option>
                                <option value="I am ready to ship">I am ready to ship</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="sell_type" class="form-label">Sell Type</label>
                            <select class="form-select" id="sell_type" name="sell_type" required="">
                                <option selected disabled>Choose...</option>
                                {{-- <option value="Individual" disabled>Individual</option> --}}
                                <option value="Together">Together</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="about_ticket" class="form-label">If you are unable to provide seating
                                information, please type reason why:</label>
                            <textarea name="about_ticket" id="about_ticket" class="form-control" width="100%" cols="30" rows="5"></textarea>
                        </div>

                        <div class="col-12">
                            <label for="reason" class="form-label">Why are you selling this ticket?</label>
                            <select class="form-select" id="reason" name="reason" required>
                                <option selected disabled>Choose...</option>
                                <option value="Medical Emergency">Medical Emergency</option>
                                <option value="Out of Town">Out of Town</option>
                                <option value="Other">Other</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="ticket_image1" class="col-sm-5 col-form-label">Upload Ticket PDF</label>
                            <div class="col-sm-12">
                                <input class="form-control" type="file" id="ticket_image1" name="ticket_image1">
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="flexCheckIndeterminate" required>
                                <label class="form-check-label" for="flexCheckIndeterminate">
                                    I agree to the Terms and Conditions and Privacy Policy
                                </label>
                            </div>
                        </div>

                    </div>


                    <br>
                    <button class="w-100 btn btn-primary btn-sm" type="submit">Submit Ticket</button>
                </form>

                <script>
                    document.getElementById('add-seat-number').addEventListener('click', function() {
                        const container = document.getElementById('seat-numbers-container');
                        const div = document.createElement('div');
                        div.classList.add('input-group', 'mb-2');
                        div.innerHTML = `
                            <input type="text" name="seat_numbers[]" class="form-control" placeholder="Enter Seat Number">
                            <button type="button" class="btn btn-outline-secondary btn-sm remove-seat-number">Remove</button>
                        `;
                        container.appendChild(div);
                    });

                    document.addEventListener('click', function(e) {
                        if (e.target && e.target.classList.contains('remove-seat-number')) {
                            e.target.parentElement.remove();
                        }
                    });
                </script>


            </div>


            {{-- Part 2 --}}
            <div class="col-md-4">
                <div class="position-sticky" style="top: 2rem;">
                    <div class="p-4 mb-3 bg-body-tertiary rounded">
                        <h4 class="fst-italic">About {{ $event->event_name }} </h4>
                        <p class="mb-0">
                            {{ $event->description }}
                        </p>
                    </div>

                </div>
            </div>
        </div>

    </main>
@endsection
