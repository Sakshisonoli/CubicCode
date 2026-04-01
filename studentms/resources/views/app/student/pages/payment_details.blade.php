@extends('app.student.layouts.main')

@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li>
                    <h5 class="bc-title">Fees and Course Details</h5>
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
                                <h3>About Course</h3>
                            </div>
                            <div class="c-details">
                                <ul>
                                    <li>
                                        <span>Course Name</span>
                                        <p>{{$studentDetails->course->course_name}}</p>
                                    </li>
                                    <li>
                                        <span>Course Fees</span>
                                        <p>{{number_format($studentDetails->course->fees)}}</p>
                                    </li>
                                    <li>
                                        <span>Course Duration</span>
                                        <p>{{$studentDetails->course->duration}}</p>
                                    </li>
                                    <li>
                                        <span>Branch Name</span>
                                        <p>{{$studentDetails->branch->branch_name}}</p>
                                    </li>
                                    <li>
                                        <span>Batch Name</span>
                                        <p>{{$studentDetails->batch->batch_name}}</p>
                                    </li>
                                    <li>
                                        <span>Batch Timing</span>
                                        <p>{{$studentDetails->batch->batch_time}}</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-9">
                    <div class="card h-auto">
                        <div class="card-header py-3">
                            <h3 class="heading mb-0">Paid Payment Details</h3>
                            <h4>Course Amount: <b>₹ {{ number_format($courseAmt->course_amount) }}</b></h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive active-projects style-1">
                                <table id="empoloyees-tblwrapper" class="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Payment Date</th>
                                            <th>Payment Type</th>
                                            <th>Payment Mode</th>
                                            <th>Paid Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($studentDetails->fees->count() > 0)
                                            @foreach ($studentDetails->fees as $fees)
                                                <tr>
                                                    <td><span>{{ $loop->index + 1 }}</span></td>
                                                    <td>
                                                        <span>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $fees->installment_date)->format('F j, Y')  }}</span></td>
                                                    <td>
                                                        <span>{{ $fees->payment_type }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $fees->payment_mode }}</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-primary"> <b>₹</b> {{ number_format($fees->amount_paid) }} </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card h-auto">
                        <div class="card-header py-3">
                            <h3 class="heading mb-0">Installment</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive active-projects style-1">
                                <table id="empoloyees-tblwrapper" class="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Next Payment Date</th>
                                            <th>Next Installment Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($installments)
                                            @foreach ($installments as $installment)
                                                <tr>
                                                    <td><span>{{ $loop->index + 1 }}</span></td>
                                                    <td>
                                                        <span>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $installment->next_installment_date)->format('F j, Y')  }}</span></td>
                                                    <td>
                                                        <span class="text-warning"> <b>₹</b> {{ number_format($installment->next_installment_amount) }}</span>
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
