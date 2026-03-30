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
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body pt-4">

                            <!-- List group with custom content -->
                            <ol class="list-group list-group-numbered">

                                @if ($bids)
                                    @foreach ($bids as $bid)
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                                <div class="">
                                                    <a href="" data-bs-toggle="modal"
                                                        data-bs-target="#verticalycentered{{ $loop->index }}"> ₹
                                                        {{ number_format($bid->bid_amt) }}</a>
                                                </div>
                                                <span style="font-size: 14px">
                                                    {{ $bid->customer->name }} |
                                                    {{ \Carbon\Carbon::parse($bid->bid_time)->format('d M Y, h:i A') }}
                                                </span>
                                            </div>
                                            @if ($bid->status === 'processing')
                                                <span class="badge bg-warning"><i class="bi bi-arrow-clockwise me-1"></i>
                                                    Processing</span>
                                            @elseif ($bid->status === 'own')
                                                <span class="badge bg-success"><i class="bi bi-trophy me-1"></i>
                                                    Won</span>
                                            @elseif ($bid->status === 'lost')
                                                <span class="badge bg-danger"><i class="bi bi-emoji-frown me-1"></i>
                                                    Lost</span>
                                            @endif
                                        </li>

                                        <div class="modal fade" id="verticalycentered{{ $loop->index }}" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Bid Amount is
                                                            {{ number_format($bid->bid_amt) }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('bid_status', ['id' => $bid->id]) }}"
                                                            method="POST" class="row g-3">
                                                            @csrf
                                                            @method('PATCH')

                                                            <input type="hidden" name="ticket_id" id="ticket_id"
                                                                value="{{ $bid->ticket_id }}">
                                                            <input type="hidden" name="ticket_qty" id="ticket_qty"
                                                                value="{{ $bid->ticket_qty }}">

                                                            <div class="col-md-12">
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        role="switch"
                                                                        id="flexSwitchCheckDefault{{ $bid->id }}"
                                                                        {{ $bid->status == 'own' ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="flexSwitchCheckDefault">Switch this button to
                                                                        update the bid status.</label>
                                                                </div>
                                                            </div>

                                                            <div class="text-center">
                                                                <button type="submit" class="btn btn-primary">Update
                                                                    Bid</button>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
