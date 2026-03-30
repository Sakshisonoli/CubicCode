@extends('app.student.layouts.main')

@section('content')
    <div class="content-body">
        <!-- row -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 wid-100">
                    <div class="row">
                        <div class="col-xl-3 col-sm-6">
                            <div class="card box-hover">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-box icon-box-lg bg-success-light rounded-circle">
                                            <svg width="46" height="46" viewBox="0 0 46 46" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M22.9715 29.3168C15.7197 29.3168 9.52686 30.4132 9.52686 34.8043C9.52686 39.1953 15.6804 40.331 22.9715 40.331C30.2233 40.331 36.4144 39.2328 36.4144 34.8435C36.4144 30.4543 30.2626 29.3168 22.9715 29.3168Z"
                                                    stroke="#3AC977" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M22.9714 23.0537C27.7304 23.0537 31.5875 19.1948 31.5875 14.4359C31.5875 9.67694 27.7304 5.81979 22.9714 5.81979C18.2125 5.81979 14.3536 9.67694 14.3536 14.4359C14.3375 19.1787 18.1696 23.0377 22.9107 23.0537H22.9714Z"
                                                    stroke="#3AC977" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        <div class="total-projects ms-3">
                                            <h3 class="text-success count">
                                                @if ($pendingFees->amount_due !== null)
                                                    {{ number_format($pendingFees->amount_due) }}
                                                @else
                                                    0
                                                @endif
                                            </h3>
                                            <span>Pending Fees</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-12 w-100">
                    <div class="card h-auto">
                        <div class="card-body p-0">
                            <div class="table-responsive active-projects style-1">
                                <div class="tbl-caption">
                                    <div>
                                        <h4>Notifications</h4>
                                    </div>
                                    <div>
                                        <a href="{{route('student_notifications')}}" class="btn btn-primary btn-sm">View All Notifications</a>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No. </th>
                                                <th>Subject</th>
                                                <th>Message</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if ($notifications)

                                                @foreach ($notifications as $notification)
                                                    <tr>
                                                    <td class="text-black">{{$loop->index +1}}</td>
                                                    <td>{{$notification->title}}</td>

                                                    <td>{{$notification->message}}</td>
                                                    <td>{{$notification->created_at->diffForHumans()}}</td>
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

                <div class="col-xl-12 w-100">
                    <div class="card h-auto">
                        <div class="card-body p-0">
                            <div class="table-responsive active-projects style-1">
                                <div class="tbl-caption">
                                    <div>
                                        <h4>Assignments</h4>
                                    </div>
                                    <div>
                                        <a href="{{route('student_assignments')}}" class="btn btn-primary btn-sm">View All Assignments</a>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No. </th>
                                                <th>Project Name</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if ($assignments)

                                                @foreach ($assignments as $assignment)
                                                <tr>
                                                    <td class="text-black">{{$loop->index +1}}</td>
                                                    <td>
                                                        <b>{{$assignment->project_name}}</b>
                                                    </td>
                                                    <td>
                                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $assignment->start_date)->format('F j, Y') }}
                                                    </td>
                                                    <td>
                                                        {{ \Carbon\Carbon::createFromFormat('Y-d-m', $assignment->end_date)->format('F j, Y') }}
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal1{{$loop->index}}">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                        <a class="btn btn-primary btn-sm" data-bs-toggle="offcanvas"
                                                            href="#offcanvasExample{{$loop->index}}" role="button" aria-controls="offcanvasExample{{$loop->index}}">Submit</a>

                                                    </td>

                                                    <div class="offcanvas offcanvas-end customeoff" tabindex="-1" id="offcanvasExample{{$loop->index}}">
                                                        <div class="offcanvas-header">
                                                            <h4 class="modal-title" id="#gridSystemModal">Submit Assignment</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
                                                                <i class="fa-solid fa-xmark"></i>
                                                            </button>

                                                        </div>
                                                        <hr>
                                                        <div class="offcanvas-body">
                                                            <div class="container-fluid">
                                                                <form action="{{route('student_submit_assignment')}}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <input type="hidden" name="assignment_id" value="{{$assignment->id}}">
                                                                        <input type="hidden" name="branch_id" value="{{ auth()->guard('student')->user()->branch_id }}">
                                                                        <input type="hidden" name="student_id" value="{{ auth()->guard('student')->user()->id }}">

                                                                        <div class="col-xl-12 mb-3">
                                                                            <label for="project_name" class="form-label">Project Name<span class="text-danger">*</span></label>
                                                                            <input type="text" name="project_name" class="form-control"
                                                                                placeholder="Enter Project Name" value="{{$assignment->project_name}}">
                                                                        </div>
                                                                        <div class="col-xl-12 mb-3">
                                                                            <label class="form-label" for="desciption">Write Description<span class="text-danger">*</span></label>
                                                                            <textarea name="desciption" rows="6" class="form-control" placeholder="Enter the project description" required></textarea>
                                                                        </div>
                                                                        <div class="col-xl-6 mb-3">
                                                                            <label for="file" class="form-label">Please select your project pdf</label>
                                                                            <input type="file" name="file" class="form-control">
                                                                        </div>
                                                                        <div class="col-xl-12 mb-3">
                                                                            <label for="project_note" class="form-label">Project Name<span class="text-danger">*</span></label>
                                                                            <input type="text" name="project_note" class="form-control"
                                                                                placeholder="Enter Project URL, GitHub Link, Or Doc Link">
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <button type="submit" class="btn btn-primary me-1">Submit Assignment</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    {{-- Modals --}}
                                                    <div class="modal fade" id="exampleModal1{{$loop->index}}" tabindex="-1" aria-labelledby="exampleModalLabel1"
                                                    aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-center modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel1">Assignment Details</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="profile-personal-info">

                                                                        <div class="row mb-2">
                                                                            <div class="col-sm-5 col-5">
                                                                                <h5 class="f-w-500">Project Name <span class="pull-end">:</span>
                                                                                </h5>
                                                                            </div>
                                                                            <div class="col-sm-7 col-7"><span>{{$assignment->project_name}}</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mb-2">
                                                                            <div class="col-sm-5 col-5">
                                                                                <h5 class="f-w-500">Project Description <span class="pull-end">:</span>
                                                                                </h5>
                                                                            </div>
                                                                            <div class="col-sm-7 col-7"><span> {{$assignment->project_description}} </span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mb-2">
                                                                            <div class="col-sm-5 col-5">
                                                                                <h5 class="f-w-500">Project Doc Link<span class="pull-end">:</span>
                                                                                </h5>
                                                                            </div>
                                                                            <div class="col-sm-7 col-7"><span> <a href="{{$assignment->project_doc}}" target="_blank" rel="noopener noreferrer"> {{$assignment->project_doc}} </a></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mb-2">
                                                                            <div class="col-sm-5 col-5">
                                                                                <h5 class="f-w-500">Project Points<span class="pull-end">:</span>
                                                                                </h5>
                                                                            </div>
                                                                            <div class="col-sm-7 col-7">
                                                                                <span>  {{$assignment->points}} </span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mb-2">
                                                                            <div class="col-sm-5 col-5">
                                                                                <h5 class="f-w-500">Project Start Date <span class="pull-end">:</span></h5>
                                                                            </div>
                                                                            <div class="col-sm-7 col-7"><span>
                                                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $assignment->start_date)->format('F j, Y') }}
                                                                            </span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mb-2">
                                                                            <div class="col-sm-5 col-5">
                                                                                <h5 class="f-w-500">Project End Date <span class="pull-end">:</span>
                                                                                </h5>
                                                                            </div>
                                                                            <div class="col-sm-7 col-7"><span>
                                                                                {{ \Carbon\Carbon::createFromFormat('Y-d-m', $assignment->end_date)->format('F j, Y') }}
                                                                            </span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mb-2">
                                                                            <div class="col-sm-5 col-5">
                                                                                <h5 class="f-w-500">Project Status<span class="pull-end">:</span>
                                                                                </h5>
                                                                            </div>
                                                                            <div class="col-sm-7 col-7"><span class="text-warning"> {{$assignment->status}} </span>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
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


                <div class="col-xl-12 w-100">
                    <div class="h-auto">
                        <div class="p-0">
                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Attendance</h4>
                                        </div>
                                        <div class="card-body">
                                            <div>
                                                <canvas id="clientDistributionChart" width="400" height="400"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-8">
                                    <div class="pt-4 pb-4">
                                        <div class="row">

                                            @foreach ($student->fees as $fees)
                                                @if ($fees->ins_status === 'clear')
                                                    <div class="col-xl-2 py-2">
                                                        <a href="{{ route('clear_bill') }}" class="btn btn-success btn-sm w-100">Clear Bill</a>
                                                    </div>
                                                @elseif ($fees->ins_status === 'due')
                                                    <div class="col-xl-2 py-2">
                                                        <a href="{{ route('due_bill') }}" class="btn btn-danger btn-sm w-100">Due Bill</a>
                                                    </div>
                                                @else
                                                    <div class="col-xl-2 py-2">
                                                        <a href="{{ route('prev_bill') }}" class="btn btn-primary btn-sm w-100">Prev Bill</a>
                                                    </div>
                                                @endif

                                            @endforeach

                                        </div>
                                    </div>

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
                                                        @if ($student->fees->count() > 0)
                                                            @foreach ($student->fees as $fees)
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
                                </div>
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-body p-0">
                                            <div class="table-responsive active-projects style-1 attendance-tbl">
                                                <div class="tbl-caption">
                                                    <h4 class="heading mb-0">Attendance Month-Wise</h4>
                                                </div>
                                                <div class="dataTables_wrapper no-footer p-4">

                                                    <div id="calendar"></div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var present = {{ $totalPresent }};
            var absent = {{ $totalAbsent }};

            var ctx = document.getElementById('clientDistributionChart').getContext('2d');
            var clientDistributionChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Present Classes', 'Absent Classes'],
                    datasets: [{
                        data: [present, absent],
                        backgroundColor: ['#32C8F5', '#0069C8'],
                    }],
                },
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: {!! json_encode($formattedAttendanceData) !!}
            });

            calendar.render();
        });
    </script>

@endsection
