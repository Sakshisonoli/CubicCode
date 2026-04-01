@extends('app.admin.layouts.main')

@section('content')
    <div class="content-body">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li>
                    <h5 class="bc-title"> {{ $branchName->branch_name }} Fees Pending Students</h5>
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
                                        <a class="btn btn-primary btn-sm" href="{{ route('add_student') }}">+ Add
                                            Student</a>

                                    </div>
                                </div>

                                <div class="table-responsive p-4">
                                    <table id="empoloyees-tblwrapper" class="table">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Student ID</th>
                                                <th>Name</th>
                                                <th>Mobile Number</th>
                                                <th>Enrolled Course</th>
                                                <th>Due Fees</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if ($students)
                                                @foreach ($students as $student)
                                                    <tr>
                                                        <td> {{ $loop->index +1 }} </td>
                                                        <td><span>{{ $student->student_id }}</span></td>
                                                        <td>
                                                            <div class="products">

                                                                <div>
                                                                    <h6>{{ $student->student_name }}</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><span>{{ $student->student->phone }}</span></td>
                                                        <td>
                                                            <span>{{ $student->student->enrolled_course }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="text-danger"><b>₹</b>
                                                                {{ number_format($student->amount_due) }}</span>
                                                        </td>
                                                        <td>
                                                            <div>

                                                                <a href="{{ route('payment_details', ['id' => $student->student_id]) }}"
                                                                    class="btn light btn-primary btn-xxs"><i
                                                                        class="fa fa-eye"></i> Payment Details</a>
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
@endsection
