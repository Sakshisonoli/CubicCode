@extends('app.branch.layouts.main')

@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li>
                    <h5 class="bc-title">Batches</h5>
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
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive active-projects style-1">
                                <div class="table-responsive p-4">
                                    <table id="empoloyees-tblwrapper" class="table">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Batch ID</th>
                                                <th>Batch Name</th>
                                                <th>Batch Time</th>
                                                <th>Course Name</th>
                                                <th>Total Seats</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if ($batches)
                                                @foreach ($batches as $batch)
                                                    <tr>
                                                        <td> {{ $loop->index +1 }} </td>
                                                        <td><span>{{ $batch->id }}</span></td>
                                                        <td>
                                                            <div class="products">

                                                                <div>
                                                                    <h6>{{ $batch->batch_name }}</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><span>{{ $batch->batch_time }}</span></td>
                                                        <td><span>{{ $batch->course->course_name }}</span></td>

                                                        <td>
                                                            <span>{{ $batch->student->count() }}</span>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('branch_students_attendance', ['id' => $batch->id]) }}"
                                                                class="btn light btn-primary shadow btn-xxs"> Give Attendance
                                                                <i class="fa fa-check" aria-hidden="true"></i>
                                                            </a>
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
            </div>

        </div>
    </div>
@endsection
