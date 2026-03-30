@extends('app.admin.layouts.main')

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
                <div class="col-xl-3 col-lg-4">
                    <div class="clearfix">
                        <div class="card card-bx profile-card author-profile m-b30">
                            <div class="card-body">
                                <div class="p-5">
                                    <div class="author-profile">

                                        <div class="author-info">
                                            <h5 class="title">{{ $studentData->name }}</h5>
                                            <span>{{ $studentData->email }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="info-list">
                                    <ul>
                                        <li><a href="javascript:void(0);">Enrolled
                                                Course</a><span>{{ $studentData->enrolled_course }}</span></li>
                                        <li><a href="javascript:void(0);">Admission
                                                Date</a><span>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $studentData->admission_date)->format('F j, Y') }}</span></li>
                                        <li><a href="javascript:void(0);">Gender</a><span>{{ $studentData->gender }}</span>
                                        </li>
                                        <li><a
                                                href="javascript:void(0);">Nationality</a><span>{{ $studentData->nationality }}</span>
                                        </li>
                                        <li><a href="javascript:void(0);">Branch
                                                Name</a><span>{{ $studentData->branch->branch_name }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xl-9 col-lg-8">

                    @if (auth()->user()->admin_role === 'super')

                        <div class="card profile-card card-bx m-b30">

                            <form class="profile-form" action="{{ route('update_student', ['id' => $studentData->id]) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 m-b30">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                value="{{ $studentData->name }}">
                                        </div>
                                        <div class="col-sm-6 m-b30">
                                            <label class="form-label">Email</label>
                                            <input type="text" name="email" id="email"
                                                value="{{ $studentData->email }}" class="form-control">
                                        </div>
                                        <div class="col-sm-6 m-b30">
                                            <label class="form-label">Mobile Number</label>
                                            <input type="text" class="form-control" name="phone" id="phone"
                                                value="{{ $studentData->phone }}">
                                        </div>
                                        <div class="col-sm-6 m-b30">
                                            <label class="form-label">Adress</label>
                                            <input type="text" class="form-control" name="address" id="address"
                                                value="{{ $studentData->address }}">
                                        </div>

                                        <div class="col-sm-6 m-b30">
                                            <label class="form-label">Birth Date</label>
                                            <input type="date" class="form-control" name="birth_date" id="birth_date"
                                                value="{{ $studentData->birth_date }}">
                                        </div>

                                        <div class="col-sm-6 m-b30">
                                            <label class="form-label">Adhar Number</label>
                                            <input type="text" class="form-control" name="adhar_number" id="adhar_number"
                                                value="{{ $studentData->adhar_number }}">
                                        </div>

                                        <div class="col-sm-6 m-b30">
                                            <label class="form-label">Student Status</label>
                                            <div class="mb-3 mb-0">
                                                <div class="form-check custom-checkbox form-check-inline">
                                                    <input type="radio" class="form-check-input" id="status" name="status"
                                                        value="active"
                                                        @if ($studentData->status === 'active') {{ 'checked' }} @endif>
                                                    <label class="form-check-label" for="active">Active</label>
                                                </div>
                                                <div class="form-check custom-checkbox form-check-inline">
                                                    <input type="radio" class="form-check-input" id="status" name="status"
                                                        value="inactive"
                                                        @if ($studentData->status === 'inactive') {{ 'checked' }} @endif>
                                                    <label class="form-check-label" for="inactive">Inactive</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 m-b30">
                                            <label class="form-label">Student Status</label>
                                            <div class="mb-3 mb-0">
                                                <div class="form-check custom-checkbox form-check-inline">
                                                    <input type="radio" class="form-check-input" id="join_status"
                                                        name="join_status" value="enrolled"
                                                        @if ($studentData->join_status === 'enrolled') {{ 'checked' }} @endif>
                                                    <label class="form-check-label" for="enrolled">Student</label>
                                                </div>
                                                <div class="form-check custom-checkbox form-check-inline">
                                                    <input type="radio" class="form-check-input" id="join_status"
                                                        name="join_status" value="alumni"
                                                        @if ($studentData->join_status === 'alumni') {{ 'checked' }} @endif>
                                                    <label class="form-check-label" for="alumni">Alumni</label>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-sm-6 m-b30">
                                            <label class="form-label">Gender</label>
                                            <div class="mb-3 mb-0">
                                                <div class="form-check custom-checkbox form-check-inline">
                                                    <input type="radio" class="form-check-input" id="gender"
                                                        name="gender" value="male"
                                                        @if ($studentData->gender === 'male') {{ 'checked' }} @endif>
                                                    <label class="form-check-label" for="male">Male</label>
                                                </div>
                                                <div class="form-check custom-checkbox form-check-inline">
                                                    <input type="radio" class="form-check-input" id="join_status"
                                                        name="gender" value="female"
                                                        @if ($studentData->gender === 'female') {{ 'checked' }} @endif>
                                                    <label class="form-check-label" for="female">Female</label>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-sm-6 m-b30">
                                            <label class="form-label">Note</label>
                                            <textarea name="note" id="note" class="form-control">{{ $studentData->note }}</textarea>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">UPDATE</button>
                                </div>
                            </form>
                        </div>
                    @else

                        <div class="card m-5 p-5">
                            <marquee direction="left">
                                <p style="font-size: 14px;" class="text-danger">You do not have access to edit information, please contact super admin to edit information.</p>
                            </marquee>
                        </div>

                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
