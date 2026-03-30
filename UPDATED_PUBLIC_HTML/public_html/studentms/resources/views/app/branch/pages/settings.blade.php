@extends('app.branch.layouts.main')

@section('content')
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
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card profile-card card-bx m-b30">
                        <div class="card-header">
                            <h6 class="title">Personal Information</h6>
                        </div>
                        <form class="profile-form"
                            action="{{route('branch_update_personal_info')}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 m-b30">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{$data->name}}">
                                    </div>
                                    <div class="col-sm-3 m-b30">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" id="email"
                                            value="{{$data->email}}" class="form-control">
                                    </div>
                                    <div class="col-sm-3 m-b30">
                                        <label class="form-label">Mobile Number</label>
                                        <input type="text" class="form-control" name="phone" id="phone"
                                            value="{{$data->phone}}">
                                    </div>
                                    <div class="col-sm-3 m-b30">
                                        <label class="form-label">Adhar Number</label>
                                        <input type="text" class="form-control" name="id_proof" id="id_proof"
                                            value="{{$data->id_proof}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">UPDATE</button>
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
                            action="{{route('branch_update_password')}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4 m-b30">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" class="form-control" name="current_password" id="current_password"
                                            placeholder="Enter your current password">
                                    </div>
                                    <div class="col-sm-4 m-b30">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-control" name="new_password" id="new_password"
                                            placeholder="Enter new password min 6 characters">
                                    </div>
                                    <div class="col-sm-4 m-b30">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            id="password_confirmation" placeholder="Confirm password">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">UPDATE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
