@extends('backend.dashboard.layouts.main')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Bidings</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Bidings</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">


                <div class="col-lg-12">



                    <div class="card">
                        <div class="card-body pt-4">

                            <!-- List group with custom content -->
                            <ol class="list-group list-group-numbered">

                                @if ($events)
                                    @foreach ($events as $event)
                                        @if ($event->Biding->count() > 0)
                                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                                <div class="ms-2 me-auto">
                                                    <div class="">
                                                        <a
                                                            href="{{ route('event_bids', ['id' => $event->id]) }}">{{ $event->event_name }}</a>
                                                    </div>
                                                    <span style="font-size: 14px">
                                                        {{ $event->event_stadium }} |
                                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $event->event_date)->format('F j, Y') }}
                                                    </span>
                                                </div>
                                                <span
                                                    class="badge bg-primary rounded-pill">{{ $event->Biding->count() }}</span>
                                            </li>
                                        @endif
                                    @endforeach
                                @endif

                            </ol><!-- End with custom content -->

                        </div>
                    </div>


                </div>

            </div>
        </section>

    </main><!-- End #main -->
@endsection
