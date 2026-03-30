@extends('app.admin.layouts.main')

@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li>
                    <h5 class="bc-title">Students Total Fees</h5>
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
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive active-projects style-1">
                            <div class="table-responsive">
                                <table id="empoloyees-tblwrapper" class="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Student ID</th>
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Fees Paid</th>
                                            <th>Due Fees</th>
                                            <th>Payments & Bill</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if ($students)
                                            @foreach ($students as $student)
                                                <tr>
                                                    <td> {{ $loop->index + 1 }} </td>
                                                    <td><span>{{ $student->student_id }}</span></td>
                                                    <td>
                                                        <div>
                                                            <h6>{{ $student->student_name }}</h6>
                                                        </div>
                                                    </td>
                                                    <td><span>{{ $student->course->course_name }}</span></td>
                                                    <td>
                                                        <span class="text-success"><b>₹</b>
                                                            {{ number_format($student->total_paid) }}</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-danger"><b>₹</b>
                                                            {{ number_format($student->due_fees) }}</span>
                                                    </td>
                                                    <td>

                                                        <a href="{{ route('payment_details', ['id' => $student->student_id]) }}"
                                                            class="btn light btn-primary btn-xxs me-2"><i
                                                                class="fa fa-eye"></i></a>

                                                        <div
                                                            class="dropdown bootstrap-select default-select status-select dropup">

                                                            <button type="button" tabindex="-1"
                                                                class="btn dropdown-toggle btn-light"
                                                                data-bs-toggle="dropdown" role="combobox"
                                                                aria-owns="bs-select-4" aria-haspopup="listbox"
                                                                aria-expanded="false" title="High">
                                                                <div class="filter-option">
                                                                    <div class="filter-option-inner">
                                                                        <div class="filter-option-inner-inner">
                                                                            Invoices
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                            <div class="dropdown-menu"
                                                                style="max-height: 301.425px; overflow: hidden; min-height: 0px;">
                                                                <div class="inner show"
                                                                    style="max-height: 287.425px; overflow-y: auto; min-height: 0px;">
                                                                    <ul class="dropdown-menu inner show" role="presentation"
                                                                        style="margin-top: 0px; margin-bottom: 0px;">

                                                                        @if ($student->due_fees > 0)
                                                                            <li>
                                                                                <a role="option"
                                                                                    href="{{ route('get_student_second_bill', ['id' => $student->student_id]) }}"
                                                                                    class="dropdown-item">
                                                                                    <span class="text">
                                                                                        Due
                                                                                    </span>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a role="option"
                                                                                    href="{{ route('get_student_third_bill', ['id' => $student->student_id]) }}"
                                                                                    class="dropdown-item">
                                                                                    <span class="text">
                                                                                        Prev Paid
                                                                                    </span>
                                                                                </a>
                                                                            </li>
                                                                        @else
                                                                            <li>
                                                                                <a role="option"
                                                                                    href="{{ route('get_student_bill', ['id' => $student->student_id]) }}"
                                                                                    class="dropdown-item">
                                                                                    <span class="text">
                                                                                        Clear
                                                                                    </span>
                                                                                </a>
                                                                            </li>
                                                                        @endif

                                                                    </ul>
                                                                </div>
                                                            </div>
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
@endsection
