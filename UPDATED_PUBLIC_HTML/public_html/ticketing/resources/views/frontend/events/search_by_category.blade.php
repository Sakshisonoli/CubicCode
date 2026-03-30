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

    <div class="container my-4 py-4">
        <section class="section">
            <h2 class="title"> See Result </h2>
            <div class="row align-items-top">

                @if ($events->count() > 0)
                    @foreach ($events as $event)
                        <div class="col-lg-3 my-2">
                            <a class="text-decoration-none" href="{{ route('event_details', ['id' => $event->id]) }}">
                                <div class="card">
                                    <img src="{{ asset('events/' . $event->event_photo) }}" class="card-img-top event-s-image"
                                        alt="Queues">
                                    <div class="card-body">
                                        <h5 class="card-title"> {{ $event->event_name }} </h5>
                                        <p class="text-secondary">{{ $event->artist_name }}, <span>
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $event->event_date)->format('F j, Y') }}
                                            </span> </p>

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
