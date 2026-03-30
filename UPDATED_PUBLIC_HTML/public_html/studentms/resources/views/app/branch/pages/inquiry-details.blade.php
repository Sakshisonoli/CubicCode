@extends('app.branch.layouts.main')

@section('content')
    <div class="content-body">

        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card h-auto">
                        <div class="card-body p-0">
                            <div class="p-5">

                                <div class="profile-personal-info">
                                    <h4 class="text-primary mb-4">Lead Details</h4>
                                    {{-- <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Lead No. <span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7"><span>{{ $details->id }}</span>
                                        </div>
                                    </div> --}}
                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Student Name <span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7"><span>{{ $details->name }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Email <span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7"><span>{{ $details->email }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Mobile Number<span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7">
                                            <span>{{ $details->phone }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Address <span class="pull-end">:</span></h5>
                                        </div>
                                        <div class="col-sm-9 col-7"><span>{{ $details->address }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Gender <span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7"><span>{{ $details->gender }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Inquiry Date <span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7"><span class="text-warning">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $details->enquiry_date)->format('F j, Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Inquiry Course <span class="pull-end">:</span></h5>
                                        </div>
                                        <div class="col-sm-9 col-7"><span>{{$details->course_enquiry}}</span>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Education <span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7">
                                            <span>
                                                {{$details->education}}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Status <span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7">
                                            <span class="text-danger">
                                                {{$details->followup_status}}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Next Followup date<span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7">
                                            <span class="text-danger">
                                                {{$details->followup_date}}
                                            </span>
                                        </div>
                                    </div>

                                </div>

                                <div class="profile-about-me">
                                    <div class="pt-4 border-bottom-1 pb-3">
                                        <h4 class="text-primary">Note:</h4>
                                        <p class="mb-2">{{ $details->note }}</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
