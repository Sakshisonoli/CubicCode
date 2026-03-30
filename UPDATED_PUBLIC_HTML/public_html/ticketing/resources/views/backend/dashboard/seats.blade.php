@extends('backend.dashboard.layouts.main')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Stadiums</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Stadiums</li>
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

                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>
                                            No.
                                        </th>
                                        <th>Seat Level</th>
                                        <th>Seat Name</th>
                                        <th>Seat Number</th>
                                        <th>
                                            Seat Type
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($seats)
                                        @foreach ($seats as $seat)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $seat->seat_level }}</td>
                                                <td>{{ $seat->row }}</td>
                                                <td> {{ $seat->number }} </td>
                                                <td> {{ $seat->seat_type }} </td>
                                                <td>
                                                    <a href="{{ route('delete_seat', ['id' => $seat->id]) }}"
                                                        class="btn btn-danger"><i class="bi bi-trash btn-sm"></i></a>
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

    </main><!-- End #main -->

@endsection
