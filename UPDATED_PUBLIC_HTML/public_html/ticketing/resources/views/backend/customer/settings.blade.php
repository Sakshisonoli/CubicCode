@extends('backend.customer.layouts.main')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Settings</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('customer_dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Settings</li>
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

        <section class="section profile">
            <div class="row">

                <div class="col-xl-12">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Payments Options</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">
                                        Add/Update Bank Details
                                    </button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                    <h5 class="card-title">Bank Details</h5>

                                    @if ($cData->info)
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Bank Name</div>
                                            <div class="col-lg-9 col-md-8">
                                                {{ $cData->info->banck_name }}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Account Holder Name</div>
                                            <div class="col-lg-9 col-md-8">{{ $cData->info->ac_holder_name }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Account Number</div>
                                            <div class="col-lg-9 col-md-8">{{ $cData->info->acc_number }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Bank Branch</div>
                                            <div class="col-lg-9 col-md-8">{{ $cData->info->bank_branch }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">IFSC Code</div>
                                            <div class="col-lg-9 col-md-8">{{ $cData->info->ifsc_code }}</div>
                                        </div>

                                        <h5 class="card-title">Personal Details</h5>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Address</div>
                                            <div class="col-lg-9 col-md-8">
                                                {{ $cData->info->address }}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">City</div>
                                            <div class="col-lg-9 col-md-8">{{ $cData->info->city }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">State</div>
                                            <div class="col-lg-9 col-md-8">{{ $cData->info->state }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Post Code</div>
                                            <div class="col-lg-9 col-md-8">{{ $cData->info->post_code }}</div>
                                        </div>
                                    @else
                                        <p class="text-bold">Please add your payment details for a smooth payment process.
                                        </p>
                                    @endif


                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                @if ($cData->info)
                                    <h5 class="card-title">Update Bank Details</h5>
                                    <form action="{{ route('update_info', ['id' => $cData->id]) }}" method="POST">
                                        @csrf

                                        <div class="row mb-3">
                                            <label for="banck_name" class="col-md-4 col-lg-3 col-form-label">Bank
                                                Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="banck_name" type="text" class="form-control" id="banck_name"
                                                    value="{{ $cData->info->banck_name }}" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="ac_holder_name" class="col-md-4 col-lg-3 col-form-label">Account
                                                Holder
                                                Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="ac_holder_name" type="text" class="form-control"
                                                    id="ac_holder_name" value="{{ $cData->info->ac_holder_name }}"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="acc_number" class="col-md-4 col-lg-3 col-form-label">Account
                                                Number</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="acc_number" type="text" class="form-control" id="acc_number"
                                                    value="{{ $cData->info->acc_number }}" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="bank_branch" class="col-md-4 col-lg-3 col-form-label">Bank
                                                Branch</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="bank_branch" type="text" class="form-control"
                                                    id="bank_branch" value="{{ $cData->info->bank_branch }}" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="ifsc_code" class="col-md-4 col-lg-3 col-form-label">IFSC
                                                Code</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="ifsc_code" type="text" class="form-control"
                                                    id="ifsc_code" value="{{ $cData->info->ifsc_code }}" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="address" type="text" class="form-control" id="address"
                                                    value="{{ $cData->info->address }}" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="city" class="col-md-4 col-lg-3 col-form-label">City</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="city" type="text" class="form-control" id="city"
                                                    value="{{ $cData->info->city }}" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="state" class="col-md-4 col-lg-3 col-form-label">State</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="state" type="text" class="form-control" id="state"
                                                    value="{{ $cData->info->state }}" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="post_code" class="col-md-4 col-lg-3 col-form-label">State</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="post_code" type="text" class="form-control"
                                                    id="post_code" value="{{ $cData->info->post_code }}" required>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                @else
                                    <h5 class="card-title">Add Your Bank Details</h5>
                                    <form action="{{ route('add_info') }}" method="POST">
                                        @csrf

                                        <div class="row mb-3">
                                            <label for="banck_name" class="col-md-4 col-lg-3 col-form-label">Bank
                                                Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="banck_name" type="text" class="form-control"
                                                    id="banck_name" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="ac_holder_name" class="col-md-4 col-lg-3 col-form-label">Account
                                                Holder
                                                Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="ac_holder_name" type="text" class="form-control"
                                                    id="ac_holder_name" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="acc_number" class="col-md-4 col-lg-3 col-form-label">Account
                                                Number</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="acc_number" type="text" class="form-control"
                                                    id="acc_number" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="bank_branch" class="col-md-4 col-lg-3 col-form-label">Bank
                                                Branch</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="bank_branch" type="text" class="form-control"
                                                    id="bank_branch" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="ifsc_code" class="col-md-4 col-lg-3 col-form-label">IFSC
                                                Code</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="ifsc_code" type="text" class="form-control"
                                                    id="ifsc_code" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="address" type="text" class="form-control" id="address"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="city" class="col-md-4 col-lg-3 col-form-label">City</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="city" type="text" class="form-control" id="city"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="state" class="col-md-4 col-lg-3 col-form-label">State</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="state" type="text" class="form-control" id="state"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="post_code" class="col-md-4 col-lg-3 col-form-label">Pin
                                                Code</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="post_code" type="text" class="form-control"
                                                    id="post_code" required>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Add Details</button>
                                        </div>
                                    </form>
                                @endif



                            </div>

                            <div class="tab-pane fade change-status pt-3" id="change-status">

                                <!-- Profile Edit Form -->
                                {{-- <form method="POST" action="{{ route('update_ticket_status', ['id' => $ticket->id]) }}">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="Job" class="col-md-4 col-lg-3 col-form-label">Ticket
                                            Action</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="gridRadios1" value="Verified">
                                                <label class="form-check-label" for="gridRadios1">
                                                    Verified
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="gridRadios2" value="Unverified">
                                                <label class="form-check-label" for="gridRadios2">
                                                    Unverified
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="gridRadios3" value="Soldout">
                                                <label class="form-check-label" for="gridRadios3">
                                                    Sold out
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="gridRadios4" value="Cancel">
                                                <label class="form-check-label" for="gridRadios4">
                                                    Cancel
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form> --}}
                                <!-- End Profile Edit Form -->

                            </div>



                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
            </div>
        </section>

    </main>
@endsection
