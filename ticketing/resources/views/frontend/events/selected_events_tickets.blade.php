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
    <main class="container pt-2 mt-4">
        <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
            <div class="col-lg-6 px-0">
                <h2> {{ $artist }}
                    Tickets</h2>
                {{-- <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and
                    efficiently about what’s most interesting in this post’s contents.</p> --}}
            </div>
        </div>

        <div class="row g-5">
            <div class="col-md-8">

                @if ($events)
                    @foreach ($events as $event)
                        <div class="card w-90 mb-3 shadow">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-lg-8">
                                        <h5 class="card-title">{{ $event->event_stadium }}, {{ $event->event_location }}
                                        </h5>
                                        <p class="card-text">
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $event->event_date)->format('F j, Y') }}
                                            |
                                            {{ $event->event_time }}
                                        </p>
                                    </div>
                                    <div class="col-lg-4">
                                        <div style="text-align: end;">
                                            <a href="{{ route('event_details', ['id' => $event->id]) }}"
                                                class="btn btn-primary">See Tickets</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                @endif

            </div>

            <div class="col-md-4">
                <div class="position-sticky" style="top: 2rem;">
                    <div class="p-4 mb-3 bg-body-tertiary rounded">
                        <h4 class="fst-italic">About</h4>
                        <p class="mb-0">Customize this section to tell your visitors a little bit about your
                            publication, writers, content, or something else entirely. Totally up to you.</p>
                    </div>

                </div>
            </div>
        </div>

    </main>
@endsection
