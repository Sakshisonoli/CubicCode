@extends('app.branch.layouts.main')

@section('content')
    <div class="content-body">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li>
                    <h5 class="bc-title"> Attendance</h5>
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
                                <div class="tbl-caption">
                                    <div>
                                        <h4><b>Student Name: </b> {{ $student->name }}</h4>
                                    </div>
                                    <div>
                                        <h4><b>Student ID: </b> {{ $student->id }}</h4>
                                    </div>
                                </div>
                                <div class="table-responsive p-4">
                                    <table id="empoloyees-tblwrapper" class="table">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Date</th>
                                                <th>Attendance Status</th>
                                                <th>Comment</th>
                                                <th>Batch</th>
                                                <th>Batch Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if ($attendanceRecords)
                                                @foreach ($attendanceRecords as $record)
                                                    <tr>
                                                        <td><span>{{ $loop->index + 1 }}</span></td>
                                                        <td>
                                                            <div class="products">

                                                                <div>
                                                                    <h6>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $record->date)->format('F j, Y') }}
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if ($record->status == 'present')
                                                                <span class="badge badge-success border-0 me-1">
                                                                    Present
                                                                </span>
                                                            @else
                                                                <span class="badge badge-danger border-0 me-1">
                                                                    Absent
                                                                </span>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            @if ($record->comment)
                                                                <span>{{ $record->comment }}</span></td>
                                                            @else
                                                                -
                                                            @endif

                                                        <td>
                                                            <span>
                                                                <b>{{ $record->batch->batch_name }}</b>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span>{{ $record->batch->batch_time }}</span>
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
