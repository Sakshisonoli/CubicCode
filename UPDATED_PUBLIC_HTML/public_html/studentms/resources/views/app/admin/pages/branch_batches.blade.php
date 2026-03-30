@extends('app.admin.layouts.main')

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
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive active-projects style-1">
                                <div class="tbl-caption">
                                    @if (auth()->user()->admin_role === 'super')
                                        <div>
                                            <a class="btn btn-primary btn-sm" href="{{ route('create_new_batch') }}">+
                                                Create
                                                Batch</a>
                                        </div>
                                    @endif

                                </div>

                                <div class="table-responsive p-4">
                                    <table id="empoloyees-tblwrapper" class="table">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Batch ID</th>
                                                <th>Batch Name</th>
                                                <th>Batch Time</th>
                                                <th>Course Name</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Total Seats</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if ($batches)
                                                @foreach ($batches as $batch)
                                                    <tr>
                                                        <td> {{ $loop->index + 1 }} </td>
                                                        <td><span>{{ $batch->id }}</span></td>
                                                        <td>
                                                            <div class="products">

                                                                <div>
                                                                    <h6>{{ $batch->batch_name }}</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><span>{{ $batch->batch_time }}</span></td>
                                                        <td><span>{{ $batch->course_name }}</span></td>
                                                        <td>
                                                            @if ($batch->start_date)
                                                                <span>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $batch->start_date)->format('F j, Y') }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($batch->end_date)
                                                                <span>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $batch->end_date)->format('F j, Y') }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span>{{ $batch->student->count() }}</span>
                                                        </td>
                                                        <td>
                                                            <div>

                                                                <a href="{{ route('batch_details', ['id' => $batch->id]) }}"
                                                                    class="btn btn-success shadow btn-xs sharp"><i
                                                                        class="fa fa-eye"></i></a>
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
