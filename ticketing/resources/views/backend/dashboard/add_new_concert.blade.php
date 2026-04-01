@extends('backend.dashboard.layouts.main')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>New Event</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item">Concerts</li>
                    <li class="breadcrumb-item active">Add new</li>
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
            <div class="card">
                <div class="card-body pt-4">
                    {{-- <h5 class="card-title">Floating labels Form</h5> --}}

                    <!-- Floating Labels Form -->
                    <form method="POST" action="{{ route('create_event') }}" enctype="multipart/form-data" class="row g-3">
                        @csrf

                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="event_name" id="event_name"
                                    placeholder="Event Name" required>
                                <label for="event_name">Event Name</label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="artist_name" id="artist_name"
                                    placeholder="Name of the artist" required>
                                <label for="artist_name">Name of the artist</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Event Description" id="description" name="description"
                                    style="height: 100px;" required></textarea>
                                <label for="description">Event Description</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="event_date" name="event_date"
                                        placeholder="Event Date" required>
                                    <label for="event_date">Event Date</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="time" class="form-control" id="event_time" name="event_time"
                                        placeholder="Event Time" required>
                                    <label for="event_time">Event Time</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="stadium_id" name="stadium_id" aria-label="State"
                                        required>
                                        <option disabled selected>Select Stadium</option>
                                        @if ($stadiums->count() > 0)
                                            @foreach ($stadiums as $stadium)
                                                <option value="{{ $stadium->id }}"> {{ $stadium->stadium_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <label for="stadium_id">Event Stadium</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="category" name="category" aria-label="Category"
                                        required>
                                        <option disabled selected>Select Category</option>
                                        <option value="Pop">Pop</option>
                                        <option value="Rock Music">Rock Music</option>
                                        <option value="Football">Football</option>
                                        <option value="Formula 1">Formula 1</option>
                                        <option value="Cricket">Cricket</option>
                                        <option value="Tennis">Tennis</option>
                                        <option value="Rugby">Rugby</option>
                                        <option value="Theatre Ticket">Theatre Ticket</option>
                                        <option value="Comedy">Comedy</option>
                                    </select>
                                    <label for="category">Event Category</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="event_photo" class="col-sm-2 col-form-label">Upload Event Photo</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" id="event_photo" name="event_photo" required>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form><!-- End floating Labels Form -->

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
