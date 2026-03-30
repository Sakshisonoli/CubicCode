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

                            <div class="py-2">
                                <a href="{{ route('add_stadium') }}" class="btn btn-outline-primary btn-sm"> <i
                                        class="bi bi-plus-square me-1"></i> Add New
                                    Stadium</a>
                            </div>

                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>
                                            No.
                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        <th>Location</th>
                                        <th>Image1</th>
                                        <th>Image2</th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($stadiums)
                                        @foreach ($stadiums as $stadium)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $stadium->stadium_name }}</td>
                                                <td>{{ $stadium->location }}</td>
                                                <td>
                                                    <a target="_blank" href="{{ asset('stadiums/' . $stadium->image1) }}"
                                                        data-lightbox="stadium-{{ $stadium->id }}"
                                                        data-title="{{ $stadium->stadium_name }} - Image 1">
                                                        <img width="100px" height="100px"
                                                            src="{{ asset('stadiums/' . $stadium->image1) }}"
                                                            class="img-fluid rounded-start" alt="Image 1">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a target="_blank" href="{{ asset('stadiums/' . $stadium->image2) }}"
                                                        data-lightbox="stadium-{{ $stadium->id }}"
                                                        data-title="{{ $stadium->stadium_name }} - Image 2">
                                                        <img width="100px" height="100px"
                                                            src="{{ asset('stadiums/' . $stadium->image2) }}"
                                                            class="img-fluid rounded-start object-fit-cover" alt="Image 2">
                                                    </a>
                                                </td>
                                                <td>

                                                    {{-- <a href="" class="btn btn-success btn-sm"><i
                                                            class="bi bi-pencil-square"></i></a> --}}

                                                    <a href="{{ route('add_seat', ['id' => $stadium->id]) }}"
                                                        class="btn btn-primary btn-sm"><i class="bi bi-plus"></i><i
                                                            class="bi bi-layout-wtf"></i></a>

                                                    <a href="{{ route('seats', ['id' => $stadium->id]) }}"
                                                        class="btn btn-info btn-sm"><i class="bi bi-layout-wtf"></i></a>

                                                    <a href="{{ route('delete_stadium', ['id' => $stadium->id]) }}"
                                                        onclick="return confirm('Are you sure you want to delete this stadium?');"
                                                        class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
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
