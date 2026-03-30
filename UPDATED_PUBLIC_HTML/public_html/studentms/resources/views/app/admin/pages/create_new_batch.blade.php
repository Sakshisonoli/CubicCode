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

            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Create New Batch</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="needs-validation" action="{{ route('store_batch') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="branch_id">Branch Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <select class="default-select wide form-control" name="branch_id"
                                                        id="branch_id" required>
                                                        <option selected disabled>Please select branch
                                                        </option>
                                                        @if ($branches)
                                                            @foreach ($branches as $branch)
                                                                <option value="{{ $branch->id }}">
                                                                    {{ $branch->branch_name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please select a one.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="course_id">Course Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <select class="default-select wide form-control" name="course_id"
                                                        id="course_id">
                                                        <option selected disabled>Please select course
                                                        </option>
                                                        @if ($courses)
                                                            @foreach ($courses as $course)
                                                                <option value="{{ $course->id }}">
                                                                    {{ $course->course_name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please select a one.
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="start_date">Batch Start Date
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="date" name="start_date" class="form-control"
                                                        id="start_date" required>
                                                    <div class="invalid-feedback">
                                                        Please select end date.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="end_date">Batch End Date

                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="date" name="end_date" class="form-control"
                                                        id="end_date">
                                                    <div class="invalid-feedback">
                                                        Please select end date.
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="batch_name">Batch Name <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" name="batch_name" class="form-control"
                                                        id="batch_name" placeholder="Enter batch name" required>
                                                    <div class="invalid-feedback">
                                                        Please enter batch name.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="batch_time">Batch Time <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" name="batch_time" class="form-control"
                                                        id="batch_time" placeholder="Your batch time" required>
                                                    <div class="invalid-feedback">
                                                        Please enter batch time.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="faculty_id">Faculty Name

                                                </label>
                                                <div class="col-lg-6">
                                                    <select class="default-select wide form-control" name="faculty_id"
                                                        id="faculty_id">
                                                        <option selected disabled>Please select Faculty
                                                        </option>
                                                        @if ($faculties)
                                                            @foreach ($faculties as $faculty)
                                                                <option value="{{ $faculty->id }}">
                                                                    {{ $faculty->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please select a one.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <div class="col-lg-8 ms-auto">
                                                    <button type="submit" class="btn btn-primary">Add Batch</button>
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
@endsection
