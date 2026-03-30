@extends('backend.dashboard.layouts.main')

@section('content')
    <main id="main" class="main">

        @if (session('success'))
            <script>
                Swal.fire(
                    "Done!",
                    "{{ session('success') }}",
                    "success"
                );
            </script>
        @endif

        <div class="pagetitle">
            <h1>Concerts, Events, Shows</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">All Concerts, Events ,Shows</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row align-items-top">

                @if ($events->count() > 0)
                    @foreach ($events as $event)
                        <div class="col-lg-4">
                            <!-- Card with an image on top -->
                            <div class="card">
                                <img src="{{ asset('events/' . $event->event_photo) }}" class="card-img-top event-s-image"
                                    alt="Queues">
                                <div class="card-body">
                                    <h5 class="card-title"> <a href="{{ route('view_event', ['id' => $event->id]) }}">
                                            {{ $event->event_name }} </a></h5>
                                    <p class="text-secondary">{{ $event->artist_name }}, <span>
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $event->event_date)->format('F j, Y') }}
                                        </span> </p>
                                    <p class="card-text">{{ \Illuminate\Support\Str::limit($event->description, 100) }}</p>
                                    <span>
                                        {{-- <a href="{{ route('delete_event', ['id' => $event->id]) }}"
                                            class="btn btn-link text-danger text-decoration-none"
                                            style="font-size: 13px">Delete</a> --}}
                                        <a href="{{ route('delete_event', ['id' => $event->id]) }}"
                                            class="btn btn-link text-danger text-decoration-none" style="font-size: 13px"
                                            onclick="return confirm('Are you sure you want to delete this event?');">
                                            Delete
                                        </a>
                                    </span>
                                </div>
                            </div>
                            <!-- End Card with an image on top -->
                        </div>
                    @endforeach
                @endif

            </div>
        </section>

    </main><!-- End #main -->
@endsection
