@extends('backend.dashboard.layouts.main')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        @if (session('success'))
            <script>
                Swal.fire(
                    "Done!",
                    "{{ session('success') }}",
                    "success"
                );
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
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">
                                        Overview
                                    </button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">
                                        Edit Event
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title">{{ $details->event_name }}</h5>
                                    <p class="small fst-italic">
                                        {{ $details->description }}
                                    </p>

                                    {{-- <h5 class="card-title">Profile Details</h5> --}}

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Event Status</div>
                                        <div class="col-lg-9 col-md-8">

                                            @if ($details->status === 'active')
                                                <span class="badge bg-success"><i class="bi bi-toggle-on me-1"></i>
                                                    Active</span>
                                            @else
                                                <span class="badge bg-danger"><i class="bi bi-toggle-off me-1"></i>
                                                    Inactive</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Feature Event</div>
                                        <div class="col-lg-9 col-md-8">

                                            @if ($details->addition === 'On')
                                                <span class="badge bg-success"><i class="bi bi-toggle-on me-1"></i>
                                                    On</span>
                                            @else
                                                <span class="badge bg-danger"><i class="bi bi-toggle-off me-1"></i>
                                                    Off</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Artist Name</div>
                                        <div class="col-lg-9 col-md-8">{{ $details->artist_name }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Event Date</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $details->event_date)->format('F j, Y') }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Event Time</div>
                                        <div class="col-lg-9 col-md-8">{{ $details->event_time }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Event Location</div>
                                        <div class="col-lg-9 col-md-8">{{ $details->event_location }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Event Stadium</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $details->event_stadium }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Event Category</div>
                                        <div class="col-lg-9 col-md-8">{{ $details->category }}</div>
                                    </div>


                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                    <!-- Profile Edit Form -->
                                    <form action="{{ route('update_event_details', ['id' => $details->id]) }}"
                                        method="POST">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Event
                                                Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="event_name" type="text" class="form-control" id="event_name"
                                                    value="{{ $details->event_name }}" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="about"
                                                class="col-md-4 col-lg-3 col-form-label">Description</label>
                                            <div class="col-md-8 col-lg-9">
                                                <textarea name="description" class="form-control" id="description" style="height: 100px">{{ $details->description }}</textarea>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="artist_name" class="col-md-4 col-lg-3 col-form-label">Artist
                                                Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="artist_name" type="text" class="form-control"
                                                    id="artist_name" value="{{ $details->artist_name }}" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="event_date" class="col-md-4 col-lg-3 col-form-label">Event
                                                Date</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="event_date" type="date" class="form-control" id="event_date"
                                                    value="{{ $details->event_date }}" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="event_time" class="col-md-4 col-lg-3 col-form-label">Event
                                                Time</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="event_time" type="time" class="form-control"
                                                    id="event_time" value="{{ $details->event_time }}" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="category" class="col-md-4 col-lg-3 col-form-label">Event
                                                Category</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="category" type="text" class="form-control"
                                                    id="category" value="{{ $details->category }}" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="addition" class="col-md-4 col-lg-3 col-form-label">
                                                Feature Event
                                            </label>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="addition"
                                                        id="On" value="On">
                                                    <label class="form-check-label" for="On">
                                                        On
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="addition"
                                                        id="Off" value="Off">
                                                    <label class="form-check-label" for="Off">
                                                        Off
                                                    </label>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">
                                                Update Event Details
                                            </button>
                                        </div>
                                    </form>
                                    <!-- End Profile Edit Form -->
                                </div>

                            </div>
                            <!-- End Bordered Tabs -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
