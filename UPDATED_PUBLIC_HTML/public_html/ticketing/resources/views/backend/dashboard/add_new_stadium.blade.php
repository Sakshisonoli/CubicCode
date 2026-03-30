@extends('backend.dashboard.layouts.main')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>New Event</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Dashboard</a></li>
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

                    <!-- Floating Labels Form -->
                    <form method="POST" action="{{ route('submit_stadium') }}" enctype="multipart/form-data"
                        class="row g-3">
                        @csrf

                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="stadium_name" name="stadium_name"
                                    placeholder="Name of the Stadium">
                                <label for="stadium_name">Name of the Stadium</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="location" name="location"
                                    placeholder="Stadium Location">
                                <label for="floatingTextarea">Stadium Location</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="image1" class="col-sm-4 col-form-label">Upload Stadium Image1</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" id="image1" name="image1">
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="image2" class="col-sm-4 col-form-label">Upload Stadium Image2</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" id="image2" name="image2">
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
