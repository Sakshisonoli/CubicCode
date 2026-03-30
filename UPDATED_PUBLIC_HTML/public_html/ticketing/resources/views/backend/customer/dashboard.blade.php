@extends('backend.customer.layouts.main')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('customer_dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
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

        @if (session('error'))
            <script>
                Swal.fire("{{ session('error') }}");
            </script>
        @endif

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-xxl-3 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">Orders</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart-check"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6> {{ number_format($totalOrders) }} </h6>
                                            <span class="text-muted small pt-2 ps-1">
                                                <a href="{{ route('orders') }}">View All Orders</a>
                                            </span>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Sales Card -->

                        <!-- Revenue Card -->
                        <div class="col-xxl-3 col-md-6">
                            <div class="card info-card revenue-card">

                                <div class="card-body">
                                    <h5 class="card-title">Listings</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-card-list"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ number_format($totalListing) }}</h6>
                                            <span class="text-muted small pt-2 ps-1">
                                                <a href="{{ route('listings') }}">View All Listings</a>
                                            </span>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->

                        <!-- Customers Card -->
                        <div class="col-xxl-3 col-xl-12">

                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">Sales</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-bar-chart"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ number_format($totalSales) }}</h6>
                                            <span class="text-muted small pt-2 ps-1">
                                                <a href="{{ route('sales') }}">View All Sales</a>
                                            </span>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div><!-- End Customers Card -->

                        <!-- Customers Card -->
                        <div class="col-xxl-3 col-xl-12">

                            <div class="card info-card revenue-card">

                                <div class="card-body">
                                    <h5 class="card-title">Payment Received</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-rupee"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ number_format($totalReceived) }}</h6>

                                            <span class="text-muted small pt-2 ps-1">
                                                <a href="{{ route('payments') }}">Payment Status</a>
                                            </span>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div><!-- End Customers Card -->

                        <!-- Reports -->
                        {{-- <div class="col-12">
                            <div class="card">

                                Payment Info

                            </div>
                        </div> --}}
                        <!-- End Reports -->

                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->


            </div>
        </section>

    </main><!-- End #main -->
@endsection
