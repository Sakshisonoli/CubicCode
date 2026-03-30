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
                                <div class="tbl-caption">
                                    <div>
                                        <a class="btn btn-primary btn-sm" href="{{ route('branch_create_batch') }}">+ Create
                                            Batch</a>

                                    </div>
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
                                                            <span>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $batch->start_date)->format('F j, Y') }}</span>
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
                                                            <a href="{{ route('branch_batch_details', ['id' => $batch->id]) }}"
                                                                class="btn btn-success shadow btn-xs sharp me-2"><i
                                                                    class="fa fa-eye"></i>
                                                            </a>

                                                            <button type="button"
                                                                class="modal-btn btn btn-primary shadow btn-xs sharp me-2"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal3{{ $loop->index }}">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                                <span></span>
                                                            </button>

                                                            <a href="{{ route('branch_delete_batch', ['id' => $batch->id]) }}"
                                                                class="btn btn-danger shadow btn-xs sharp me-2"><i
                                                                    class="fa fa-trash"></i></a>
                                                        </td>
                                                        {{-- Batch edit modal --}}
                                                        <div class="modal fade" id="exampleModal3{{ $loop->index }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel3"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-center">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5"
                                                                            id="exampleModalLabel1">Edit Batch
                                                                        </h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form
                                                                            action="{{ route('branch_update_batch', ['id' => $batch->id]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <div class="row mb-4">
                                                                                <div class="col-xl-12">

                                                                                    <div class="row">
                                                                                        <div class="col-xl-6">
                                                                                            <label
                                                                                                class="form-label mt-3">Batch
                                                                                                Name</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text"
                                                                                                    name="batch_name"
                                                                                                    class="form-control"
                                                                                                    id="batch_name"
                                                                                                    value="{{ $batch->batch_name }}">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-xl-6">
                                                                                            <label
                                                                                                class="form-label mt-3">Batch
                                                                                                Timing</label>
                                                                                            <div class="input-group">
                                                                                                <input type="text"
                                                                                                    name="batch_time"
                                                                                                    class="form-control"
                                                                                                    id="batch_time"
                                                                                                    value="{{ $batch->batch_time }}">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-xl-6">
                                                                                            <label
                                                                                                class="form-label mt-3">Batch
                                                                                                Start Date</label>
                                                                                            <div class="input-group">
                                                                                                <input type="date"
                                                                                                    name="start_date"
                                                                                                    class="form-control"
                                                                                                    id="start_date"
                                                                                                    value="{{ $batch->start_date }}">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-xl-6">
                                                                                            <label
                                                                                                class="form-label mt-3">Batch
                                                                                                End Date</label>
                                                                                            <div class="input-group">
                                                                                                <input type="date"
                                                                                                    name="end_date"
                                                                                                    class="form-control"
                                                                                                    id="end_date"
                                                                                                    value="{{ $batch->end_date }}">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-xl-6">
                                                                                            <label
                                                                                                class="form-label mt-3">Faculty
                                                                                                ID</label>
                                                                                            <div class="input-group">
                                                                                                <input type="number"
                                                                                                    name="faculty_id"
                                                                                                    class="form-control"
                                                                                                    id="faculty_id"
                                                                                                    value="{{ $batch->faculty_id }}">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-xl-6">
                                                                                            <label
                                                                                                class="form-label mt-3">Course
                                                                                                ID</label>
                                                                                            <div class="input-group">
                                                                                                <input type="number"
                                                                                                    name="course_id"
                                                                                                    class="form-control"
                                                                                                    id="course_id"
                                                                                                    value="{{ $batch->course_id }}">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="mt-4">
                                                                                        <button type="button"
                                                                                            class="btn btn-danger light"
                                                                                            data-bs-dismiss="modal">Close</button>
                                                                                        <button type="submit"
                                                                                            class="btn btn-primary">Update
                                                                                            Details</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
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
            </div>

        </div>
    </div>
@endsection
