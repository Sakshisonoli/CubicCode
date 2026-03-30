@extends('app.branch.layouts.main')


@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">

                <li>
                    <h5 class="bc-title">Attendance</h5>
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

            </div>
        </div>

        <div class="container-fluid pt-0 ps-0 pe-lg-4 pe-0">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card dz-card" id="accordion-five">
                        <!-- tab-content -->
                        <div class="tab-content" id="myTabContent-4">
                            <div class="tab-pane fade show active" id="leftPosition" role="tabpanel"
                                aria-labelledby="home-tab-4">

                                <div class="card">
                                    <form action="{{ route('branch_mark_attendance') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-header py-3">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <label for="date">Attendance Date</label>
                                                    <input type="date" class="form-control" name="date" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <input type="hidden" name="batch_id" value="{{ $batchId }}">
                                                <table id="example5" class="display table" style="min-width: 845px">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                Attendance
                                                            </th>
                                                            <th>Student ID</th>
                                                            <th>Student Name</th>
                                                            <th>Comment</th>
                                                            <th>Total Attendance %</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($batchStudents)
                                                            @foreach ($batchStudents as $student)
                                                                <tr>
                                                                    <td>
                                                                        <div class="mb-3 mb-0">
                                                                            <div
                                                                                class="form-check custom-checkbox checkbox-success form-check-inline">
                                                                                <input type="radio"
                                                                                    class="form-check-input"
                                                                                    id="attendance_{{ $student->id }}"
                                                                                    name="attendance_{{ $student->id }}"
                                                                                    value="present" required>
                                                                                <label class="form-check-label"
                                                                                    for="attendance_{{ $student->id }}">Present</label>
                                                                            </div>
                                                                            <div
                                                                                class="form-check custom-checkbox checkbox-danger form-check-inline">
                                                                                <input type="radio"
                                                                                    class="form-check-input"
                                                                                    id="attendance_{{ $student->id }}"
                                                                                    name="attendance_{{ $student->id }}"
                                                                                    value="absent" required>
                                                                                <label class="form-check-label"
                                                                                    for="attendance_{{ $student->id }}">Absent</label>
                                                                            </div>

                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        {{ $student->id }}
                                                                        <input type="hidden"
                                                                            name="sid_{{ $student->id }}"
                                                                            value="{{ $student->id }}">
                                                                    </td>

                                                                    <td>
                                                                        <a class="btn-link"
                                                                            href="{{ route('branch_single_student_attendance', ['id' => $student->id]) }}">{{ $student->name }}</a>

                                                                        <input type="hidden"
                                                                            name="sname_{{ $student->id }}"
                                                                            value="{{ $student->name }}">
                                                                    </td>
                                                                    <td>
                                                                        <textarea class="form-txtarea form-control" name="comment_{{ $student->id }}" rows="2" id="comment"></textarea>
                                                                    </td>
                                                                    <td>
                                                                        <spna class="text-warning">
                                                                            {{ $student->total_attendance }} <b>%</b>
                                                                        </spna>
                                                                    </td>

                                                                </tr>
                                                            @endforeach
                                                        @endif

                                                    </tbody>
                                                </table>
                                                <button type="submit" class="btn btn-primary">Submit Attendance</button>
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



    </div>
@endsection
