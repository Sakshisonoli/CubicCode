@extends('app.branch.layouts.main')

@section('content')
    <div class="content-body">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li>
                    <h5 class="bc-title">Course Leads</h5>
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
                                    <div>
                                        <a class="btn btn-primary btn-sm" data-bs-toggle="offcanvas"
                                            href="#offcanvasExample" role="button" aria-controls="offcanvasExample">+ Add
                                            Leads</a>

                                        <a class="btn btn-success btn-sm"
                                            href="{{route('branch_export_leads')}}">Export Leads</a>
                                    </div>
                                    <div>
                                        <input type="text" id="searchInput" placeholder="Search lead">
                                    </div>
                                </div>

                                <div class="table-responsive p-4">
                                    <table id="empoloyees-tblwrapper" class="table">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>Mobile Number</th>
                                                <th>Inquiry Course</th>
                                                <th>Inquiry Date</th>
                                                <th>Next Followup Date</th>
                                                <th>Interest</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if ($inquiries)
                                                @foreach ($inquiries as $inquiry)
                                                    <tr>
                                                        <td><span>{{ $loop->index + 1 }}</span></td>
                                                        <td>
                                                            <div class="products">

                                                                <div>
                                                                    <h6>{{ $inquiry->name }}</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><span>{{ $inquiry->phone }}</span></td>
                                                        <td>
                                                            <span>{{ $inquiry->course_enquiry }}</span>
                                                        </td>
                                                        <td>
                                                            @if ($inquiry->enquiry_date)
                                                                <span>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $inquiry->enquiry_date)->format('F j, Y') }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($inquiry->followup_date)
                                                                <span>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $inquiry->followup_date)->format('F j, Y') }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($inquiry->interest_level == 'Cold')
                                                                <span class="badge badge-primary light">Cold</span>
                                                            @elseif ($inquiry->interest_level == 'Warm')
                                                                <span class="badge badge-warning light">Warm</span>
                                                            @else
                                                                <span class="badge badge-danger light">Hot</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{route('branch_inquiry_details', ['id' => $inquiry->id])}}"
                                                                class="btn btn-success shadow btn-xs sharp me-2 tooltip-link-hp" data-tooltip="Details"><i
                                                                    class="fa fa-eye"></i></a>
                                                            <a href="{{ route('branch_inquiry_to_admission', ['id' => $inquiry->id]) }}"
                                                                class="btn btn-primary shadow btn-xs sharp me-2 tooltip-link-hp" data-tooltip="Convert lead to admission"><i
                                                                    class="fa fa-exchange"></i></a>
                                                            <a href="{{route('branch_edit_inquiry', ['id' => $inquiry->id])}}"
                                                                class="btn btn-warning shadow btn-xs sharp me-2 tooltip-link-hp" data-tooltip="Edit"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <a href="{{ route('branch_delete_lead', ['id' => $inquiry->id]) }}"
                                                                class="btn btn-danger shadow btn-xs sharp me-2 tooltip-link-hp" data-tooltip="Delete"><i
                                                                    class="fa fa-trash"></i></a>
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


        {{-- OffCanvas Popup --}}
        <div class="offcanvas offcanvas-end customeoff" tabindex="-1" id="offcanvasExample">
            <div class="offcanvas-header">
                <h4 class="modal-title" id="#gridSystemModal">Add New Lead</h4>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>

            </div>
            <hr>
            <div class="offcanvas-body">
                <div class="container-fluid">

                    <form action="{{ route('branch_store_inquiry') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-6 mb-3">
                                <label for="name" class="form-label">Student Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Enter student full name">
                            </div>

                            <div class="col-xl-6 mb-3">
                                <label for="email" class="form-label">Student Email<span
                                        class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Enter student email">
                            </div>

                            <div class="col-xl-6 mb-3">
                                <label for="phone" class="form-label">Student Mobile Number<span
                                        class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control" id="phone"
                                    placeholder="Enter student mobile number">
                            </div>

                            <div class="col-xl-6 mb-3">
                                <label class="form-label" for="gender">Gender<span class="text-danger">*</span></label>
                                <div class="mb-3 mb-0">
                                    <div class="form-check custom-checkbox form-check-inline">
                                        <input type="radio" class="form-check-input" id="gender" name="gender"
                                            value="male">
                                        <label class="form-check-label" for="gender">Male</label>
                                    </div>
                                    <div class="form-check custom-checkbox form-check-inline">
                                        <input type="radio" class="form-check-input" id="gender" name="gender"
                                            value="female">
                                        <label class="form-check-label" for="gender">Female</label>
                                    </div>

                                </div>
                            </div>

                            <div class="col-xl-6 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" id="address"
                                    placeholder="Enter student address">
                            </div>

                            <div class="col-xl-6 mb-3">
                                <label class="form-label" for="course_enquiry">Inquiry Course Name<span
                                        class="text-danger">*</span></label>
                                <select class="default-select style-1 form-control" name="course_enquiry"
                                    id="course_enquiry">
                                    <option data-display="Select">Please select course</option>
                                    @if ($courses)
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->course_name }}">{{$course->course_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="col-xl-6 mb-3">
                                <label for="enquiry_date" class="form-label">Inquiry Date<span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="enquiry_date" name="enquiry_date">
                            </div>

                            <div class="col-xl-6 mb-3">
                                <label class="form-label" for="followup_status">Lead Status<span
                                        class="text-danger">*</span></label>
                                <select class="default-select style-1 form-control" name="followup_status"
                                    id="followup_status">
                                    <option data-display="Select">Please Lead select</option>
                                    <option value="On Follow Up">On Follow Up</option>
                                    <option value="Cancelled">Cancelled</option>
                                    <option value="Course Join">Course Join</option>
                                </select>
                            </div>

                            <div class="col-xl-6 mb-3">
                                <label for="followup_date" class="form-label">Next Followup Date<span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="followup_date" name="followup_date">
                            </div>

                            <div class="col-xl-6 mb-3">
                                <label class="form-label" for="interest_level">Lead Interest<span
                                        class="text-danger">*</span></label>
                                <select class="default-select style-1 form-control" name="interest_level"
                                    id="interest_level" required>
                                    <option data-display="Select">Please Lead select</option>
                                    <option value="Cold">Cold</option>
                                    <option value="Warm">Warm</option>
                                    <option value="Hot">Hot</option>
                                </select>
                            </div>

                            <input type="hidden" name="branch_id" id="branch_id" value="{{ auth()->user()->id }}">

                            <div class="col-xl-12 mb-3">
                                <label class="form-label" for="note">Note<span class="text-danger">*</span></label>
                                <textarea id="note" name="note" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-danger light ms-1">Cancel</button>
                            <button type="submit" class="btn btn-primary me-1">Submit Enquiry</button>
                        </div>
                    </form>
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
