@extends('backend.dashboard.layouts.main')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Add New Seat</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Concerts</li>
                    <li class="breadcrumb-item active">Add Seat</li>
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

                    <!-- Floating Labels Form -->
                    <form method="POST" action="{{ route('submit_seat') }}" enctype="multipart/form-data" class="row g-3">
                        @csrf
                        <input type="hidden" name="stadium_id" value="{{ $id }}">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="seat_level" name="seat_level"
                                    placeholder="Seat Level">
                                <label for="seat_level">Seat Level</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="row" name="row"
                                    placeholder="Seat Name">
                                <label for="row">Seat Name</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="number" name="number"
                                    placeholder="Seat Number">
                                <label for="number">Seat Number</label>
                            </div>
                        </div>


                        <div class="col-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="seat_type" name="seat_type"
                                    placeholder="Seat Type">
                                <label for="seat_type">Seat Type</label>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                    <!-- End floating Labels Form -->

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
