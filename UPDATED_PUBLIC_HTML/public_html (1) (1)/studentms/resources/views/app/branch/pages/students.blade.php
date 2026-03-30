@extends('app.branch.layouts.main')

@section('content')
    <div class="content-body">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li>
                    <h5 class="bc-title">Students</h5>
                </li>

            </ol>

        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive active-projects style-1">
                                <div class="tbl-caption">
                                    <div>
                                        <a class="btn btn-primary btn-sm" href="{{ route('branch_add_student') }}">+ Add
                                            Student</a>
                                    </div>
                                    <div>
                                        <input type="text" id="searchInput" placeholder="Search students">
                                    </div>
                                </div>

                                <div class="table-responsive p-4">
                                    <table id="empoloyees-tblwrapper" class="table">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Student ID</th>
                                                <th>Name</th>
                                                <th>Enrolled Course</th>
                                                <th>Batch Time</th>
                                                <th>Admission Date</th>
                                                <th>Total Attendance %</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if ($students)
                                                @foreach ($students as $student)
                                                    <tr>
                                                        <td> {{ $loop->index +1 }} </td>
                                                        <td><span>{{ $student->id }}</span></td>
                                                        <td>
                                                            <div class="products">

                                                                <div>
                                                                    <h6>{{ $student->name }}</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span>{{ $student->enrolled_course }}</span>
                                                        </td>
                                                        <td>
                                                            @if ($student->batch)
                                                                <span>{{ $student->batch->batch_time }}</span>
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $student->admission_date)->format('F j, Y') }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="text-warning">{{ $student->total_attendance }}
                                                                <b>%</b> </span>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <a href="{{ route('branch_student_cdetails', ['id' => $student->id]) }}"
                                                                    class="btn btn-secondary shadow btn-xs sharp me-2 tooltip-link-hp" data-tooltip="Details"><i
                                                                        class="fa fa-eye"></i></a>
                                                                <a href="{{ route('branch_student_pdetails', ['id' => $student->id]) }}"
                                                                    class="btn btn-success shadow btn-xs sharp me-2 tooltip-link-hp" data-tooltip="Payment Details"><i
                                                                        class="fa fa-rupee"></i></a>
                                                                <a href="{{ route('branch_edit_student', ['id' => $student->id]) }}"
                                                                    class="btn btn-primary shadow btn-xs sharp me-2 tooltip-link-hp" data-tooltip="Edit"><i
                                                                        class="fa fa-edit"></i></a>
                                                                <a href="{{ route('branch_single_student_attendance', ['id' => $student->id]) }}"
                                                                    class="btn btn-warning shadow btn-xs sharp me-2 tooltip-link-hp" data-tooltip="Attendance"><i
                                                                        class="fa fa-user-check"></i></a>
                                                            </div>
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


    <script>
        const searchInput = document.getElementById('searchInput');
        const table = document.getElementById('empoloyees-tblwrapper');

        function filterTable(searchTerm) {
            const searchTermLower = searchTerm.toLowerCase(); // Make search case-insensitive
            const tableBody = table.getElementsByTagName('tbody')[0]; // Get the table body
            const tableRows = tableBody.getElementsByTagName('tr');

            for (let i = 0; i < tableRows.length; i++) {
                const row = tableRows[i];
                const rowText = row.textContent.toLowerCase(); // Get combined text content of the row

                if (rowText.indexOf(searchTermLower) !== -1) {
                row.style.display = ''; // Show row if it matches the search term
                } else {
                row.style.display = 'none'; // Hide row if it doesn't match
                }
            }
        }

        searchInput.addEventListener('keyup', function() {
            const searchTerm = this.value;
            filterTable(searchTerm);
        });

    </script>

    <style>
        #searchInput {
            height: 25px;
            width: 200px;
            padding: 2px 8px;
            border: 1px solid rgb(0, 125, 227);
            border-radius: 5px;
        }
    </style>

@endsection
