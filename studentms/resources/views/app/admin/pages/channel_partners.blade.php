@extends('app.admin.layouts.main')

@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li>
                    <h5 class="bc-title">Channel Partners</h5>
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
                                            <a class="btn btn-primary btn-sm" href="{{ route('add_channel_partner') }}">+
                                                Add
                                                Channel Partner</a>
                                        </div>
                                    @endif

                                    <div>
                                        <input type="text" id="searchInput" placeholder="Search partner">
                                    </div>
                                </div>

                                <div class="table-responsive p-4">
                                    <table id="empoloyees-tblwrapper" class="table">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Partner ID</th>
                                                <th>Partner Name</th>
                                                <th>Email ID</th>
                                                <th>Mobile Number</th>
                                                <th>Branch Name</th>
                                                <th>City Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if ($partners)
                                                @foreach ($partners as $partner)
                                                    <tr>
                                                        <td> {{ $loop->index + 1 }} </td>
                                                        <td><span>{{ $partner->id }}</span></td>
                                                        <td>
                                                            <div class="products">

                                                                <div>
                                                                    <h6>{{ $partner->name }}</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><span class="text-primary">{{ $partner->email }}</span></td>
                                                        <td><span>{{ $partner->phone }}</span></td>
                                                        <td>
                                                            <span>{{ $partner->branch_name }}</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ $partner->location }}</span>
                                                        </td>

                                                        <td>
                                                            @if ($partner->status === 'active')
                                                                <span
                                                                    class="badge badge-success light border-0">Active</span>
                                                            @else
                                                                <span
                                                                    class="badge badge-danger light border-0">Inactive</span>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                <a href="{{ route('inquiries_by_branch', ['id' => $partner->id]) }}"
                                                                    class="btn btn-primary shadow btn-xs sharp me-2 tooltip-link-hp"
                                                                    data-tooltip="Leads"><i
                                                                        class="fa fa-question-circle"></i></a>

                                                                <a href="{{ route('students', ['id' => $partner->id]) }}"
                                                                    class="btn btn-success shadow btn-xs sharp me-2 tooltip-link-hp"
                                                                    data-tooltip="Enrolled Students"><i
                                                                        class="fa fa-graduation-cap"></i></a>

                                                                <a href="{{ route('batches_by_branch', ['id' => $partner->id]) }}"
                                                                    class="btn btn-info shadow btn-xs sharp me-2 tooltip-link-hp"
                                                                    data-tooltip="Batches"><i
                                                                        class="fa fa-th-large"></i></a>

                                                                <a href="{{ route('faculties_by_branch', ['id' => $partner->id]) }}"
                                                                    class="btn btn-primary shadow btn-xs sharp me-2 tooltip-link-hp"
                                                                    data-tooltip="Faculties"><i class="fa fa-users"></i></a>

                                                                @if (auth()->user()->admin_role === 'super')
                                                                    <a href="{{ route('edit_channel_partner', ['id' => $partner->id]) }}"
                                                                        class="btn btn-dark shadow btn-xs sharp me-2 tooltip-link-hp"
                                                                        data-tooltip="Edit"><i class="fa fa-pencil"></i></a>

                                                                    <a href="{{ route('delete_partner', ['id' => $partner->id]) }}"
                                                                        class="btn btn-danger shadow btn-xs sharp me-2 tooltip-link-hp"
                                                                        data-tooltip="Delete"><i
                                                                            class="fa fa-trash"></i></a>
                                                                @endif

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
