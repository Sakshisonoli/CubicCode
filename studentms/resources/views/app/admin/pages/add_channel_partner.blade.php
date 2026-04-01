@extends('app.admin.layouts.main')

@section('content')

    @if (auth()->user()->admin_role === 'super')
        <div class="content-body">

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

            <div class="container-fluid">

                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add New Channel Partner</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
                                    <form class="needs-validation" action="{{ route('store_channel_partner') }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="name">Channel
                                                        Partner Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" name="name" class="form-control"
                                                            id="name" placeholder="Enter a Channel Partner Name"
                                                            required>
                                                        <div class="invalid-feedback">
                                                            Please Enter a Channel Partner Name.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="phone">Mobile Number
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" name="phone" class="form-control"
                                                            id="phone" placeholder="Your valid mobile number.."
                                                            required>
                                                        <div class="invalid-feedback">
                                                            Please enter a mobile number.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="email">Email <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="email" name="email" class="form-control"
                                                            id="email" placeholder="Your valid email.." required>
                                                        <div class="invalid-feedback">
                                                            Please enter a Email.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="password">Password
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="password" name="password" class="form-control"
                                                            id="password" placeholder="Choose a safe one.." required>
                                                        <div class="invalid-feedback">
                                                            Please enter a password.
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 py-3">
                                                        <ul>
                                                            <li>
                                                                <b>
                                                                    Please follow these strong password rules to create
                                                                    channel
                                                                    partner passwords
                                                                </b>
                                                            </li>
                                                            <li>
                                                                * At least one uppercase letter

                                                            </li>
                                                            <li>
                                                                * At least one lowercase letter

                                                            </li>
                                                            <li>
                                                                * At least one digit

                                                            </li>
                                                            <li>
                                                                * At least one special character ($@$!%*?&)
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-xl-6">

                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="branch_name">Branch Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" name="branch_name" class="form-control"
                                                            id="branch_name" placeholder="Enter Branch Name..." required>
                                                        <div class="invalid-feedback">
                                                            Please enter Branch Name.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="location">City Name
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" name="location" class="form-control"
                                                            id="location" placeholder="Enter branch city name">
                                                        <div class="invalid-feedback">
                                                            Please enter city name.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="id_proof">Adhar Card
                                                        Number
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" name="id_proof" class="form-control"
                                                            id="id_proof" placeholder="Enter adhar card number">
                                                        <div class="invalid-feedback">
                                                            Please enter adhar card number
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="gst_num">Partner GST Number
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" name="gst_num" class="form-control"
                                                            id="gst_num" placeholder="Enter Partner GST Number">
                                                        <div class="invalid-feedback">
                                                            Please enter partner number
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <div class="col-lg-8 ms-auto">
                                                        <button type="submit" class="btn btn-primary">Add Channel
                                                            Partner</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    @else
        @include('errors.pagenotfound_error')
    @endif

@endsection
