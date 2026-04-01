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
                            <h6 class="title">Faculty Information</h6>
                        </div>
                        <form class="profile-form" action="{{ route('update_faculty_info', ['id' => $facultyInfo->id]) }}"
                            method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4 m-b30">
                                        <label class="form-label">Partner Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $facultyInfo->name }}">
                                    </div>
                                    <div class="col-sm-4 m-b30">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ $facultyInfo->email }}">
                                    </div>
                                    <div class="col-sm-4 m-b30">
                                        <label class="form-label">Mobile Number</label>
                                        <input type="number" class="form-control" name="phone"
                                            value="{{ $facultyInfo->phone }}">
                                    </div>
                                    <div class="col-sm-4 m-b30">
                                        <label class="form-label">Address</label>
                                        <input type="text" class="form-control" name="address"
                                            value="{{ $facultyInfo->address }}">
                                    </div>
                                    <div class="col-sm-4 m-b30">
                                        <label class="form-label">Adhar Number</label>
                                        <input type="text" class="form-control" name="adhar_number"
                                            value="{{ $facultyInfo->adhar_number }}">
                                    </div>
                                    <div class="col-sm-4 m-b30">
                                        <label class="form-label">Birth Date</label>
                                        <input type="date" class="form-control" name="birth_date"
                                            value="{{ $facultyInfo->birth_date }}">
                                    </div>
                                    <div class="col-sm-4 m-b30">
                                        <label class="form-label">Gender</label>
                                        <input type="text" class="form-control" name="gender"
                                            value="{{ $facultyInfo->gender }}">
                                    </div>
                                    <div class="col-sm-4 m-b30">
                                        <label class="form-label">Nationality</label>
                                        <input type="text" class="form-control" name="nationality"
                                            value="{{ $facultyInfo->nationality }}">
                                    </div>
                                    <div class="col-sm-4 m-b30">
                                        <label class="form-label">Marital Status</label>
                                        <input type="text" class="form-control" name="marital_status"
                                            value="{{ $facultyInfo->marital_status }}">
                                    </div>
                                    <div class="col-sm-4 m-b30">
                                        <label class="form-label">Education</label>
                                        <input type="text" class="form-control" name="education"
                                            value="{{ $facultyInfo->education }}">
                                    </div>
                                    <div class="col-sm-4 m-b30">
                                        <label class="form-label">Experience</label>
                                        <input type="text" class="form-control" name="experience"
                                            value="{{ $facultyInfo->experience }}">
                                    </div>
                                    <div class="col-sm-4 m-b30">
                                        <label class="form-label">Work Status</label>
                                        <input type="text" class="form-control" name="work_status"
                                            value="{{ $facultyInfo->work_status }}">
                                    </div>
                                    <div class="col-sm-12 m-b30">
                                        <label class="form-label">Note</label>
                                        <textarea name="note" id="note" class="form-control">{{ $facultyInfo->note }}</textarea>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">UPDATE INFORMATION</button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
