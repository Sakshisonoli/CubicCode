@extends('backend.dashboard.layouts.main')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Ticket Information</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Ticket Information</li>
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

        <section class="section profile">
            <div class="row">

                <div class="col-xl-12">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Information</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#change-status">Change
                                        Status
                                    </button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#biding-status">Biding
                                        Status
                                    </button>
                                </li>


                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                    <h5 class="card-title">Ticket Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Ticket Status</div>
                                        <div class="col-lg-9 col-md-8">
                                            @if ($ticket->status === 'Verified')
                                                <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>
                                                    Verified</span>
                                            @elseif ($ticket->status === 'Unverified')
                                                <span class="badge bg-warning text-dark"><i
                                                        class="bi bi-exclamation-triangle me-1"></i>
                                                    Unverified</span>
                                            @elseif ($ticket->status === 'Cancel')
                                                <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i>
                                                    Cancel</span>
                                            @elseif ($ticket->status === 'Soldout')
                                                <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>
                                                    Sold Out</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Biding Status</div>
                                        <div class="col-lg-9 col-md-8">
                                            @if ($ticket->biding_status === 'On')
                                                <span class="badge bg-success"><i class="bi bi-toggle-on me-1"></i>
                                                    On</span>
                                            @else
                                                <span class="badge bg-danger"><i class="bi bi-toggle-off me-1"></i>
                                                    Off</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Event Name</div>
                                        <div class="col-lg-9 col-md-8">{{ $ticket->event->event_name }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Seat Type</div>
                                        <div class="col-lg-9 col-md-8">{{ $ticket->seat->seat_type }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Seat Row</div>
                                        <div class="col-lg-9 col-md-8">{{ $ticket->seat->row }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Seat Number</div>
                                        <div class="col-lg-9 col-md-8">{{ $ticket->seat->number }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Ticket Price, Per Ticket</div>
                                        <div class="col-lg-9 col-md-8 text-success">{{ number_format($ticket->min_price) }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Number Of Tickets</div>
                                        <div class="col-lg-9 col-md-8">{{ $ticket->number_of_tickets }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Seat Numbers</div>
                                        <div class="col-lg-9 col-md-8">
                                            @if (is_array($ticket->seat_numbers))
                                                @foreach ($ticket->seat_numbers as $number)
                                                    <span class="text-dark">{{ $number }},</span>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Total Ticket Price</div>
                                        <div class="col-lg-9 col-md-8 text-success">{{ number_format($ticket->max_price) }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Ticket Sell Type</div>
                                        <div class="col-lg-9 col-md-8">{{ $ticket->sell_type }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Ticket Features</div>
                                        <div class="col-lg-9 col-md-8">
                                            @php
                                                $features = json_decode($ticket->features, true);
                                            @endphp

                                            @if (is_array($features))
                                                <ul>
                                                    @foreach ($features as $feature)
                                                        <li>{{ $feature }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <span>No features available.</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Ticket Limitations</div>
                                        <div class="col-lg-9 col-md-8">
                                            @php
                                                $limitations = json_decode($ticket->limitations, true);
                                            @endphp

                                            @if (is_array($limitations))
                                                <ul>
                                                    @foreach ($limitations as $limitation)
                                                        <li>{{ $limitation }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <span>No Limitations available.</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Ticket Owner</div>
                                        <div class="col-lg-9 col-md-8">{{ $ticket->owner->name }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">About Owner</div>
                                        <div class="col-lg-9 col-md-8">{{ $ticket->about_you }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Ticket Format/Type</div>
                                        <div class="col-lg-9 col-md-8">{{ $ticket->listing_type }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Delivery Type</div>
                                        <div class="col-lg-9 col-md-8">{{ $ticket->delivery_type }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">About Ticket</div>
                                        <div class="col-lg-9 col-md-8">{{ $ticket->about_ticket }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Ticket PDF</div>
                                        <div class="col-lg-12 col-md-8 mt-2">

                                            @if ($ticket->ticket_image1)
                                                <iframe src="/tickets/{{ $ticket->ticket_image1 }}" frameborder="0"
                                                    width="100%" height="600px"></iframe>
                                            @endif


                                        </div>
                                    </div>

                                </div>


                                <div class="tab-pane fade change-status pt-3" id="change-status">

                                    <!-- Profile Edit Form -->
                                    <form method="POST"
                                        action="{{ route('update_ticket_status', ['id' => $ticket->id]) }}">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="Job" class="col-md-4 col-lg-3 col-form-label">Ticket
                                                Action</label>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="gridRadios1" value="Verified">
                                                    <label class="form-check-label" for="gridRadios1">
                                                        Verified
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="gridRadios2" value="Unverified">
                                                    <label class="form-check-label" for="gridRadios2">
                                                        Unverified
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="gridRadios3" value="Soldout">
                                                    <label class="form-check-label" for="gridRadios3">
                                                        Sold out
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="gridRadios4" value="Cancel">
                                                    <label class="form-check-label" for="gridRadios4">
                                                        Cancel
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                    <!-- End Profile Edit Form -->

                                </div>

                                <div class="tab-pane fade biding-status pt-3" id="biding-status">

                                    <!-- Profile Edit Form -->
                                    <form method="POST"
                                        action="{{ route('update_biding_status', ['id' => $ticket->id]) }}">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="Job" class="col-md-4 col-lg-3 col-form-label">
                                                Change Biding Status
                                            </label>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="biding_status"
                                                        id="on" value="On">
                                                    <label class="form-check-label" for="on">
                                                        On
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="biding_status"
                                                        id="off" value="Off">
                                                    <label class="form-check-label" for="off">
                                                        Off
                                                    </label>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                    <!-- End Profile Edit Form -->

                                </div>


                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection
