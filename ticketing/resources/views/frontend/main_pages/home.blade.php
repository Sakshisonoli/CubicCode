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

    <div class="container mt-2 mb-2">
        <div class="row pb-3">
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

    <div class="mb-3 pb-4">
        <div class="container home-slider-d1">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach ($sliders as $index => $slider)
                        <button type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"
                            aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}">
                        </button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach ($sliders as $index => $slider)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <a href="{{ route('selected_event_tickets', ['artist' => $slider->artist_name]) }}">
                                <img src="{{ asset('events/' . $slider->event_photo) }}" class="d-block w-100"
                                    alt="Event Image">
                            </a>

                            <div class="carousel-caption d-none d-md-block">
                                <div>
                                    {{-- <h2 class="home-event-title mask">
                                        <a style="text-decoration: none !important; color: #fff;"
                                            href="{{ route('selected_event_tickets', ['artist' => $slider->artist_name]) }}">
                                            {{ $slider->event_name }}</a>
                                    </h2> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <div class="container my-2 pt-3">
        <div class="section">
            <h2 class="title">Newly added events</h2>
            <div class="row align-items-top">

                @if ($events->count() > 0)
                    @foreach ($events as $event)
                        <div class="col-lg-3 my-2">
                            <a class="text-decoration-none" href="{{ route('event_details', ['id' => $event->id]) }}">
                                <div class="card">
                                    <img src="{{ asset('events/' . $event->event_photo) }}"
                                        class="card-img-top event-s-image" alt="Queues">
                                    <div class="card-body">
                                        <h5 class="card-title"> {{ $event->event_name }} </h5>
                                        <p class="text-secondary">{{ $event->artist_name }}
                                            <span>
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $event->event_date)->format('F j, Y') }}
                                            </span>
                                        </p>

                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="container my-3 pt-4">
        <div class="section">
            <div class="row">
                <div class="col-8">
                    <h2 class="title">Comedy Shows</h2>
                </div>
                <div class="col-4 text-end">
                    <a href="{{ route('search_category', ['category' => 'Comedy']) }}"
                        class="btn btn-outline-primary btn-sm">View All <i class="bi bi-arrow-right-circle"></i></a>
                </div>
            </div>

            <div class="row align-items-top">

                @if ($comedyShows->count() > 0)
                    @foreach ($comedyShows as $event)
                        <div class="col-lg-3 my-2">
                            <a class="text-decoration-none" href="{{ route('event_details', ['id' => $event->id]) }}">
                                <div class="card">
                                    <img src="{{ asset('events/' . $event->event_photo) }}"
                                        class="card-img-top event-s-image" alt="Queues">
                                    <div class="card-body">
                                        <h5 class="card-title"> {{ $event->event_name }} </h5>
                                        <p class="text-secondary">{{ $event->artist_name }}
                                            <span>
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $event->event_date)->format('F j, Y') }}
                                            </span>
                                        </p>

                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="container my-3 pt-4">
        <div class="section">

            <div class="row">
                <div class="col-8">
                    <h2 class="title">Rock Musics Shows</h2>
                </div>
                <div class="col-4 text-end">
                    <a href="{{ route('search_category', ['category' => 'Rock Music']) }}"
                        class="btn btn-outline-primary btn-sm">View All <i class="bi bi-arrow-right-circle"></i></a>
                </div>
            </div>

            <div class="row align-items-top">

                @if ($rockMusics->count() > 0)
                    @foreach ($rockMusics as $event)
                        <div class="col-lg-3 my-2">
                            <a class="text-decoration-none" href="{{ route('event_details', ['id' => $event->id]) }}">
                                <div class="card">
                                    <img src="{{ asset('events/' . $event->event_photo) }}"
                                        class="card-img-top event-s-image" alt="Queues">
                                    <div class="card-body">
                                        <h5 class="card-title"> {{ $event->event_name }} </h5>
                                        <p class="text-secondary">{{ $event->artist_name }}
                                            <span>
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $event->event_date)->format('F j, Y') }}
                                            </span>
                                        </p>

                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

@endsection
