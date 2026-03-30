@extends('backend.dashboard.layouts.main')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Payment Records</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Payment Records</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Sell</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-music-player"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>₹ {{ number_format($totalSell) }}</h6>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Sales Card -->

                        <!-- Revenue Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">

                                <div class="card-body">
                                    <h5 class="card-title">Sell Tickets</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-receipt"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6> {{ number_format($totalTickets) }}</h6>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->

                        <!-- Customers Card -->
                        <div class="col-xxl-4 col-xl-12">

                            <div class="card info-card customers-card">

                                <div class="card-body">
                                    <h5 class="card-title">Pending Payment </h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>₹ {{ number_format($totalPending) }} </h6>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div><!-- End Customers Card -->

                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Pending Tickets</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-music-player"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6> {{ number_format($totalPendingTickets) }}</h6>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Paid</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-music-player"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6> {{ number_format($totalPaid) }}</h6>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">


                                <div class="card-body">
                                    <h5 class="card-title">Payment Records</h5>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Total Sell</th>
                                                <th scope="col">Total Tickets</th>
                                                <th scope="col">Total Paid</th>
                                                {{-- <th scope="col">Status</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if ($customers)
                                                @foreach ($customers as $customer)
                                                    @if ($customer->total_sell > 1)
                                                        <tr>
                                                            <th scope="row"> {{ $loop->index + 1 }} </th>
                                                            <td> {{ $customer->name }} </td>
                                                            <td>₹ {{ number_format($customer->total_sell) }} </td>
                                                            <td> {{ number_format($customer->total_sell_tickets) }} </td>
                                                            <td> {{ number_format($customer->total_paid) }} </td>
                                                            {{-- <td><span class="badge bg-success">Approved</span></td> --}}
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div><!-- End Recent Sales -->

                    </div>
                </div><!-- End Left side columns -->



            </div><!-- End Right side columns -->

            </div>
        </section>

    </main>
@endsection
