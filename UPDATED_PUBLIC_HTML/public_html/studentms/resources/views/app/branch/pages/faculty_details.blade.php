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
                                    <h4 class="text-primary mb-4">Faculty Information</h4>
                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Faculty ID <span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7"><span>{{ $facultyInfo->id }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Faculty Name <span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7"><span>{{ $facultyInfo->name }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Email <span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7"><span>{{ $facultyInfo->email }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Mobile Number<span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7">
                                            <span>{{ $facultyInfo->phone }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Address<span class="pull-end">:</span></h5>
                                        </div>
                                        <div class="col-sm-9 col-7"><span>{{ $facultyInfo->address }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Adhar Number <span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7"><span>{{ $facultyInfo->adhar_number }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Birth Date <span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7">
                                            <span>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $facultyInfo->birth_date)->format('F j, Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Gender<span class="pull-end">:</span></h5>
                                        </div>
                                        <div class="col-sm-9 col-7"><span>
                                                {{ $facultyInfo->gender }}</span>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Nationality <span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7">
                                            <span>
                                                {{ $facultyInfo->nationality }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Marital Status <span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7">
                                            <span>
                                                {{ $facultyInfo->marital_status }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Education <span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7">
                                            <span>
                                                {{ $facultyInfo->education }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Experience <span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7">
                                            <span>
                                                {{ $facultyInfo->experience }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Work Status <span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7">
                                            <span>
                                                {{ $facultyInfo->work_status }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-5">
                                            <h5 class="f-w-500">Status <span class="pull-end">:</span>
                                            </h5>
                                        </div>
                                        <div class="col-sm-9 col-7">
                                            <span>
                                                {{ $facultyInfo->status }}
                                            </span>
                                        </div>
                                    </div>


                                </div>

                                <div class="profile-about-me">
                                    <div class="pt-4 border-bottom-1 pb-3">
                                        <h4 class="text-primary">Note:</h4>
                                        <p class="mb-2">{{ $facultyInfo->note }}</p>
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
