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
    <div class="container my-5">
        <div class="position-relative p-5 text-center text-muted bg-body border border-dashed rounded-5">
            <h1 class="text-body-emphasis">Sell your tickets</h1>
            <p class="col-lg-6 mx-auto mb-4">
                Queues is the market for tickets to live events
            </p>
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
    </div>

    <div class="container">
        <section class="section">
            <h2 class="title">Newly added events</h2>
            <div class="row align-items-top">

                @if ($allEvents->count() > 0)
                    @foreach ($allEvents as $event)
                        <div class="col-lg-3 my-2">
                            <a class="text-decoration-none" href="{{ route('sell_ticket_form', ['id' => $event->id]) }}">
                                <div class="card">
                                    <img src="{{ asset('events/' . $event->event_photo) }}"
                                        class="card-img-top event-s-image" alt="Queues">
                                    <div class="card-body">
                                        <h5 class="card-title"> {{ $event->event_name }} </h5>
                                        <p class="text-secondary">{{ $event->artist_name }}, <span>
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $event->event_date)->format('F j, Y') }}
                                            </span> </p>
                                        {{-- <p class="card-text">
                                        {{ \Illuminate\Support\Str::limit($event->description, 50) }}
                                    </p> --}}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </section>
    </div>


@endsection
