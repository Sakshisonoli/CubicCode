@extends('app.admin.layouts.main')

@section('content')
    <div class="content-body">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li>
                    <h5 class="bc-title">Courses</h5>
                </li>

            </ol>

        </div>
        <div class="container-fluid">

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

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive active-projects style-1">
                                <div class="tbl-caption">
                                    @if (auth()->user()->admin_role === 'super')
                                        <a class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" href="#offcanvasExample"
                                        role="button" aria-controls="offcanvasExample">+ Add
                                        New Course</a>
                                    @endif

                                    <div>
                                        <input type="text" id="searchInput" placeholder="Search course">
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="courses-table" class="table table-bordered table-striped verticle-middle table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">Course ID</th>
                                                <th scope="col">Course Name</th>
                                                <th scope="col">Duration</th>
                                                <th scope="col">Fees</th>
                                                <th scope="col">Doc Link</th>
                                                <th scope="col">Teaching Mode</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if ($courses)
                                                @foreach ($courses as $course)
                                                    <tr>
                                                        <td>{{ $course->id }}</td>
                                                        <td><b>{{ $course->course_name }}</b></td>
                                                        <td>
                                                            {{ $course->duration }}
                                                        </td>
                                                        <td><span class="badge badge-primary light"> <b>₹</b>
                                                                {{ number_format($course->fees) }} </span>
                                                        </td>
                                                        <td><a href="{{ $course->doc_link }}" target="_blank"
                                                                rel="noopener noreferrer"> <span
                                                                    class="badge light badge-success">Click here to
                                                                    open</span></a>
                                                        </td>
                                                        <td>
                                                            {{ $course->teaching_mode }}
                                                        </td>

                                                        <td>
                                                            @if ($course->status == 'active')
                                                                <span class="badge badge-primary">Active</span>
                                                            @else
                                                                <span class="badge badge-danger">Inactive</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="d-flex">

                                                                <button type="button" class="btn btn-success shadow btn-xs sharp me-1" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal1{{$loop->index}}">
                                                                <i class="fa fa-eye"></i>
                                                                </button>

                                                                @if (auth()->user()->admin_role === 'super')
                                                                    <button type="button" class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal2{{$loop->index}}">
                                                                    <i class="fa fa-pencil"></i>
                                                                    </button>

                                                                    <a href="{{route('delete_course', ['id' => $course->id])}}"
                                                                        class="btn btn-danger shadow btn-xs sharp"><i
                                                                            class="fa fa-trash"></i></a>
                                                                @endif

                                                            </div>
                                                        </td>

                                                        {{-- Modal view details --}}
                                                        <div class="modal fade" id="exampleModal1{{$loop->index}}" tabindex="-1" aria-labelledby="exampleModalLabel1"
                                                            aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-center modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel1"> Course Details </h1>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="profile-personal-info">

                                                                                <div class="row mb-2">
                                                                                    <div class="col-sm-5 col-5">
                                                                                        <h5 class="f-w-500">Course Name <span class="pull-end">:</span>
                                                                                        </h5>
                                                                                    </div>
                                                                                    <div class="col-sm-7 col-7"><span>{{ $course->course_name }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row mb-2">
                                                                                    <div class="col-sm-5 col-5">
                                                                                        <h5 class="f-w-500">Course Duration <span class="pull-end">:</span>
                                                                                        </h5>
                                                                                    </div>
                                                                                    <div class="col-sm-7 col-7"><span> {{ $course->duration }} </span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row mb-2">
                                                                                    <div class="col-sm-5 col-5">
                                                                                        <h5 class="f-w-500">Course Selling Fees<span class="pull-end">:</span>
                                                                                        </h5>
                                                                                    </div>
                                                                                    <div class="col-sm-7 col-7"><span><b>₹ </b>{{ number_format($course->fees) }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row mb-2">
                                                                                    <div class="col-sm-5 col-5">
                                                                                        <h5 class="f-w-500">Course Maximum Selling Fees<span class="pull-end">:</span>
                                                                                        </h5>
                                                                                    </div>
                                                                                    <div class="col-sm-7 col-7">
                                                                                        <span>  <b>₹ </b>{{ number_format($course->max_fees) }} </span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row mb-2">
                                                                                    <div class="col-sm-5 col-5">
                                                                                        <h5 class="f-w-500">Document Link <span class="pull-end">:</span></h5>
                                                                                    </div>
                                                                                    <div class="col-sm-7 col-7"><span>
                                                                                        {{ $course->doc_link }}
                                                                                    </span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row mb-2">
                                                                                    <div class="col-sm-5 col-5">
                                                                                        <h5 class="f-w-500">Teaching Mode <span class="pull-end">:</span>
                                                                                        </h5>
                                                                                    </div>
                                                                                    <div class="col-sm-7 col-7"><span>
                                                                                        {{ $course->teaching_mode }}
                                                                                    </span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row mb-2">
                                                                                    <div class="col-sm-5 col-5">
                                                                                        <h5 class="f-w-500">Technical Fees Payable <span class="pull-end">:</span>
                                                                                        </h5>
                                                                                    </div>
                                                                                    <div class="col-sm-7 col-7"><span>
                                                                                        <b>₹ </b>{{ number_format($course->tech_fees_payable) }}
                                                                                    </span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row mb-2">
                                                                                    <div class="col-sm-5 col-5">
                                                                                        <h5 class="f-w-500">Technical Fees In Percentage <span class="pull-end">:</span>
                                                                                        </h5>
                                                                                    </div>
                                                                                    <div class="col-sm-7 col-7"><span>
                                                                                        {{ $course->tech_fees_percentage }}
                                                                                    </span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row mb-2">
                                                                                    <div class="col-sm-5 col-5">
                                                                                        <h5 class="f-w-500">Course Status<span class="pull-end">:</span>
                                                                                        </h5>
                                                                                    </div>
                                                                                    <div class="col-sm-7 col-7"><span class="text-warning"> {{ $course->status }} </span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row mb-2">
                                                                                    <div class="col-sm-5 col-5">
                                                                                        <h5 class="f-w-500">Note<span class="pull-end">:</span>
                                                                                        </h5>
                                                                                    </div>
                                                                                    <div class="col-sm-7 col-7"><span> {{ $course->note }} </span>
                                                                                    </div>
                                                                                </div>

                                                                            </div>

                                                                        </div>

                                                                    </div>
                                                                </div>
                                                        </div>

                                                        {{-- Modal edit details --}}
                                                        <div class="modal fade" id="exampleModal2{{$loop->index}}" tabindex="-1" aria-labelledby="exampleModalLabel2"
                                                            aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-center">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel1"> Edit Course Details </h1>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{ route('course_update', ['id' => $course->id]) }}" method="POST">
                                                                                @csrf
                                                                                <div class="row mb-4">
                                                                                    <div class="col-xl-12">

                                                                                        <div class="row">
                                                                                            <div class="col-xl-12">
                                                                                                <label class="form-label mt-3">Course Name</label>
                                                                                                <div class="input-group">
                                                                                                    <input type="text" name="course_name" class="form-control"
                                                                                                        id="course_name" value="{{ $course->course_name }}">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-xl-6">
                                                                                                <label class="form-label mt-3">Course Duration</label>
                                                                                                <div class="input-group">
                                                                                                    <input type="text" name="duration" class="form-control"
                                                                                                        id="duration" value="{{ $course->duration }}">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-xl-6">
                                                                                                <label class="form-label mt-3">Course Selling Fees</label>
                                                                                                <div class="input-group">
                                                                                                    <input type="number" name="fees" class="form-control"
                                                                                                        id="fees" value="{{ $course->fees }}">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-xl-6">
                                                                                                <label class="form-label mt-3">Course Maximum Selling Fees</label>
                                                                                                <div class="input-group">
                                                                                                    <input type="number" name="max_fees" class="form-control"
                                                                                                        id="max_fees" value="{{ $course->max_fees }}">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-xl-6">
                                                                                                <label class="form-label mt-3">Course Doc Link</label>
                                                                                                <div class="input-group">
                                                                                                    <input type="text" name="doc_link" class="form-control"
                                                                                                        id="doc_link" value="{{ $course->doc_link }}">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-xl-6">
                                                                                                <label class="form-label mt-3">Course Teaching Mode</label>
                                                                                                <div class="input-group">
                                                                                                    <input type="text" name="teaching_mode" class="form-control"
                                                                                                        id="teaching_mode" value="{{ $course->teaching_mode }}">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-xl-6">
                                                                                                <label class="form-label mt-3">Technical Fees Payable</label>
                                                                                                <div class="input-group">
                                                                                                    <input type="text" name="tech_fees_payable" class="form-control"
                                                                                                        id="tech_fees_payable" value="{{ $course->tech_fees_payable }}">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-xl-6">
                                                                                                <label class="form-label mt-3">Technical Fees In Percentage</label>
                                                                                                <div class="input-group">
                                                                                                    <input type="text" name="tech_fees_percentage" class="form-control"
                                                                                                        id="tech_fees_percentage" value="{{ $course->tech_fees_percentage }}">
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-xl-6">
                                                                                                <label class="form-label mt-3">Status</label>
                                                                                                <div class="mb-3 mb-0">
                                                                                                    <div class="form-check custom-checkbox form-check-inline">
                                                                                                        <input type="radio" class="form-check-input" id="status" name="status"
                                                                                                            value="active"
                                                                                                            @if ($course->status === 'active') {{ 'checked' }} @endif>
                                                                                                        <label class="form-check-label" for="active">Active</label>
                                                                                                    </div>
                                                                                                    <div class="form-check custom-checkbox form-check-inline">
                                                                                                        <input type="radio" class="form-check-input" id="status" name="status"
                                                                                                            value="inactive"
                                                                                                            @if ($course->status === 'inactive') {{ 'checked' }} @endif>
                                                                                                        <label class="form-check-label" for="inactive">Inactive</label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="mt-4">
                                                                                            <button type="button" class="btn btn-danger light"
                                                                                                data-bs-dismiss="modal">Close</button>
                                                                                            <button type="submit" class="btn btn-primary">Update Details</button>
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


        {{-- OffCanvas Popup --}}
        <div class="offcanvas offcanvas-end customeoff" tabindex="-1" id="offcanvasExample">
            <div class="offcanvas-header">
                <h4 class="modal-title" id="#gridSystemModal">Add New Course</h4>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>

            </div>
            <hr>
            <div class="offcanvas-body">
                <div class="container-fluid">

                    <form action="{{ route('store_course') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12 mb-3">
                                <label for="course_name" class="form-label">Course Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="course_name" class="form-control" id="course_name"
                                    placeholder="Enter course name">
                            </div>

                            <div class="col-xl-6 mb-3">
                                <label for="duration" class="form-label">Course Duration<span
                                        class="text-danger">*</span></label>
                                <input type="text" name="duration" class="form-control" id="duration"
                                    placeholder="Enter course duration">
                            </div>

                            <div class="col-xl-6 mb-3">
                                <label for="fees" class="form-label">Course Selling Fees<span
                                        class="text-danger">*</span></label>
                                <input type="number" name="fees" class="form-control" id="fees"
                                    placeholder="Enter course fees">
                            </div>

                            <div class="col-xl-6 mb-3">
                                <label for="teaching_mode" class="form-label">Course Teaching Mode<span
                                        class="text-danger">*</span></label>
                                <input type="text" name="teaching_mode" class="form-control" id="teaching_mode"
                                    placeholder="Enter course mode">
                            </div>

                            <div class="col-xl-6 mb-3">
                                <label for="doc_link" class="form-label">Course Document Link</label>
                                <input type="text" name="doc_link" class="form-control" id="doc_link"
                                    placeholder="Enter course doc link">
                            </div>

                            <div class="col-xl-6 mb-3">
                                <label for="max_fees" class="form-label">Course Maximum Selling Fees</label>
                                <input type="number" name="max_fees" class="form-control" id="max_fees"
                                    placeholder="Enter course fees">
                            </div>

                            <div class="col-xl-6 mb-3">
                                <label for="tech_fees_payable" class="form-label">Technical Fees Payable</label>
                                <input type="number" name="tech_fees_payable" class="form-control" id="tech_fees_payable"
                                    placeholder="Enter Technical Fees Payable">
                            </div>

                            <div class="col-xl-6 mb-3">
                                <label for="tech_fees_percentage" class="form-label">Technical Fees In Percentage %</label>
                                <input type="text" name="tech_fees_percentage" class="form-control" id="tech_fees_percentage"
                                    placeholder="Enter Technical Fees In Percentage">
                            </div>

                            <div class="col-xl-12 mb-3">
                                <label class="form-label" for="note">Note</label>
                                <textarea id="note" name="note" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary me-1">Add Course</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>



    <script>
        const searchInput = document.getElementById('searchInput');
        const table = document.getElementById('courses-table');

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
