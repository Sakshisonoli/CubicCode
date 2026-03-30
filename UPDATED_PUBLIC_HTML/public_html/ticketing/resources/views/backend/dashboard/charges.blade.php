@extends('backend.dashboard.layouts.main')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Charges</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Charges</li>
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
                        <div class="card-body pt-2">

                            <!-- Vertically centered Modal -->
                            <button type="button" class="btn btn-primary btn-sm mb-3 mt-2" data-bs-toggle="modal"
                                data-bs-target="#verticalycentered">
                                Add Charges
                            </button>
                            <div class="modal fade" id="verticalycentered" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Ticket Charges</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('add_charges') }}" method="POST" class="row g-3">
                                                @csrf

                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="number" class="form-control" id="min_amt"
                                                            name="min_amt" placeholder="Minimum Price">
                                                        <label for="min_amt">Minimum Price</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="number" class="form-control" id="max_amt"
                                                            name="max_amt" placeholder="Maximum Price">
                                                        <label for="max_amt">Maximum Price</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-floating">
                                                        <input type="number" class="form-control" id="charges"
                                                            name="charges" placeholder="Charges">
                                                        <label for="charges">Charges</label>
                                                    </div>
                                                </div>

                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                                </div>
                                            </form>
                                        </div>
                                        {{-- <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div> --}}
                                    </div>
                                </div>
                            </div><!-- End Vertically centered Modal-->


                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>
                                            No.
                                        </th>
                                        <th>Ticket Price</th>
                                        <th>Convenience Charges</th>
                                        {{-- <th>Count</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($charges)
                                        @foreach ($charges as $charge)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>
                                                    {{ number_format($charge->min_amt) }} <b>To</b>
                                                    {{ number_format($charge->max_amt) }}
                                                </td>
                                                <td>
                                                    {{ number_format($charge->charges) }}
                                                </td>
                                                {{-- <td>0</td> --}}
                                                <td>
                                                    <a href="{{ route('delete_charges', ['id' => $charge->id]) }}"
                                                        class="btn btn-link"><i class="bi bi-trash text-danger"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
    <!-- End #main -->
@endsection
