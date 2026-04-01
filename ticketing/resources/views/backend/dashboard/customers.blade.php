@extends('backend.dashboard.layouts.main')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Customers</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Customers</li>
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

                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>
                                            No.
                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($customers)
                                        @foreach ($customers as $customer)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>
                                                    <a
                                                        href="{{ route('customer_profile', ['id' => $customer->id]) }}">{{ $customer->name }}</a>
                                                </td>
                                                <td>{{ $customer->email }}</td>
                                                <td>{{ $customer->phone }}</td>
                                                <td>
                                                    @if ($customer->status === 'active')
                                                        <span class="badge bg-success"><i class="bi bi-toggle-on me-1"></i>
                                                            Active</span>
                                                    @else
                                                        <span class="badge bg-danger"><i class="bi bi-toggle-off me-1"></i>
                                                            Inactive</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <a href="{{ route('delete_customer', ['id' => $customer->id]) }}"
                                                        onclick="return confirm('Are you sure you want to delete this ticket?');"
                                                        class="btn-link text-danger"><i class="bi bi-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
