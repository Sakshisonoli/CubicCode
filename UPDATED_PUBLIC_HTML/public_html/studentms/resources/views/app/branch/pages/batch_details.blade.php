@extends('app.branch.layouts.main')

@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li>
                    <h5 class="bc-title">Batch Details</h5>
                </li>
            </ol>
        </div>

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
                <div class="col-xl-3">
                    <div class="card h-auto">
                        <div class="card-body">
                            <div class="c-profile text-center">

                                <h3>{{ $details->branch->branch_name }} Batch</h3>
                            </div>
                            <div class="c-details">
                                <ul>
                                    <li>
                                        <span>Batch ID</span>
                                        <p>{{ $details->id }}</p>
                                    </li>
                                    <li>
                                        <span>Batch Name</span>
                                        <p>{{ $details->batch_name }}</p>
                                    </li>
                                    <li>
                                        <span>Batch Timing</span>
                                        <p>{{ $details->batch_time }}</p>
                                    </li>
                                    <li>
                                        <span>Course Name</span>
                                        <p>{{ $details->course_name }}</p>
                                    </li>
                                    @if ($details->faculty)
                                        <li>
                                            <span>Faculty</span>
                                            <p>{{ $details->faculty->name }}</p>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-xl-9">

                    <div class="card h-auto">
                        <div class="card-header py-3">
                            <h4 class="heading mb-0">Batch Students</h4>
                            <div class="tbl-caption">
                                <div>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal1">
                                        + Add Student
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive active-projects style-1">
                                <table id="empoloyees-tblwrapper" class="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Student ID</th>
                                            <th>Name</th>
                                            <th>Enrolled Course</th>
                                            <th>Admission Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($details->student->count() > 0)
                                            @foreach ($details->student as $student)
                                                <tr>
                                                    <td><span>{{ $loop->index + 1 }}</span></td>
                                                    <td><span>{{ $student->id }}</span></td>
                                                    <td>
                                                        <span>{{ $student->name }}</span>
                                                    </td>
                                                    <td><span>{{ $student->enrolled_course }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $student->admission_date)->format('F j, Y') }}</span>
                                                    </td>
                                                    <td>
                                                        @if ($student->status === 'active')
                                                            <span class="badge badge-primary light border-0">Active</span>
                                                        @else
                                                            <span class="badge badge-danger light border-0">Inactive</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modals --}}
            <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-center">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel1">Add existing students to this batch
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('branch_change_batch') }}" method="POST">
                                @csrf
                                <div class="row mb-4">
                                    <div class="col-xl-12">
                                        <label class="form-label mt-3" for="sid">Select
                                            Student
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div>
                                            <select class="default-select wide form-control" name="sid" id="sid"
                                                required>
                                                <option selected disabled>Please select Student
                                                </option>
                                                @if ($students)
                                                    @foreach ($students as $student)
                                                        <option value="{{ $student->id }}"> S.ID:
                                                            {{ $student->id }} -
                                                            {{ $student->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <input type="hidden" name="batch_id" id="batch_id" value="{{ $details->id }}">
                                        <div class="mt-4">
                                            <button type="button" class="btn btn-danger light"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Add
                                                Student</button>
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
@endsection
