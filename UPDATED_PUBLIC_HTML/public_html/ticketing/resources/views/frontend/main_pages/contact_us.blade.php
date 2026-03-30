@extends('frontend.layouts.main')

@section('content')
    <div class="">
        <div class="container">
            <div class="card py-4">
                <div class="card-body">
                    <h2 class="card-title">Contact Us</h2>

                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house-door"></i></a></li>

                            <li class="breadcrumb-item active">Contact Us</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="p-5">

            <div class="row">
                <div class="col-lg-6 py-2">
                    <div class="card text-center shadow p-3">

                        <div class="card-body">
                            <i style="font-size: 35px;" class="bi bi-phone"></i>
                            <h5 class="card-title">Phone</h5>
                            <p class="card-text">
                                <a class="text-decoration-none text-black" href="tel:+91 7385700733">+91 7385700733</a>
                                <br><br>
                                <br>
                            </p>
                            <a href="mailto:support@queues.store" class="btn btn-outline-primary btn-sm">Email us now</a>
                        </div>

                    </div>
                </div>

                <div class="col-lg-6 py-2">
                    <div class="card text-center shadow p-3">

                        <div class="card-body">
                            <i style="font-size: 35px;" class="bi bi-envelope-at"></i>
                            <h5 class="card-title">Email</h5>
                            <p class="card-text">
                                <a class="text-decoration-none text-black"
                                    href="mailto:owner@queues.store">owner@queues.store</a>
                                <br>
                                <a class="text-decoration-none text-black"
                                    href="mailto:support@queues.store">support@queues.store</a>

                                <br><br>
                            </p>
                            <a href="mailto:support@queues.store" class="btn btn-outline-primary btn-sm">Email us now</a>
                        </div>

                    </div>
                </div>

                {{-- <div class="col-lg-4">
                    <div class="card text-center shadow p-3">

                        <div class="card-body">
                            <i style="font-size: 35px;" class="bi bi-geo"></i>
                            <h5 class="card-title">Address</h5>
                            <p class="card-text">
                                Behind Bk No.738, Room No. 7, Near Balkan Ji Bari, Ulhasnagar, Ulhasnagar-2, Thane, Kalyan,
                                Maharashtra, India, 421002
                            </p>
                            <a href="mailto:support@queues.store" class="btn btn-outline-primary btn-sm">Email us now</a>
                        </div>

                    </div>
                </div> --}}
            </div>

        </div>
    </div>
@endsection
