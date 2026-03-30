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

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- row -->
            <div class="container-fluid">
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card profile-card card-bx m-b30">
                            <div class="card-header">
                                <h6 class="title">Personal Information</h6>
                            </div>
                            <form class="profile-form" action="{{ route('update_partner', ['id' => $partnerData->id]) }}"
                                method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4 m-b30">
                                            <label class="form-label">Partner Name</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $partnerData->name }}">
                                        </div>
                                        <div class="col-sm-4 m-b30">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ $partnerData->email }}">
                                        </div>
                                        <div class="col-sm-4 m-b30">
                                            <label class="form-label">Mobile Number</label>
                                            <input type="number" class="form-control" name="phone"
                                                value="{{ $partnerData->phone }}">
                                        </div>
                                        <div class="col-sm-4 m-b30">
                                            <label class="form-label">Branch Name</label>
                                            <input type="text" class="form-control" name="branch_name"
                                                value="{{ $partnerData->branch_name }}" readonly>
                                        </div>
                                        <div class="col-sm-4 m-b30">
                                            <label class="form-label">City Name</label>
                                            <input type="text" class="form-control" name="location"
                                                value="{{ $partnerData->location }}" readonly>
                                        </div>
                                        <div class="col-sm-4 m-b30">
                                            <label class="form-label">Adhar Card Number</label>
                                            <input type="text" class="form-control" name="id_proof"
                                                value="{{ $partnerData->id_proof }}">
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">UPDATE INFORMATION</button>
                                </div>
                            </form>
                        </div>
                    </div>



                    <div class="col-xl-12 col-lg-12">
                        <div class="card profile-card card-bx m-b30">
                            <div class="card-header">
                                <h6 class="title">Change Password</h6>
                            </div>
                            <form class="profile-form"
                                action="{{ route('update_partner_password', ['id' => $partnerData->id]) }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-sm-6 m-b30">
                                            <label class="form-label">New Password</label>
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="Enter new password">
                                        </div>
                                        <div class="col-sm-6 m-b30">
                                            <label class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control" name="password_confirmation"
                                                id="password_confirmation" placeholder="Confirm password">
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">UPDATE PASSWORD</button>
                                    {{-- <a href="#!" class="btn-link">Forgot your password?</a> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        @include('errors.pagenotfound_error')
    @endif

@endsection
