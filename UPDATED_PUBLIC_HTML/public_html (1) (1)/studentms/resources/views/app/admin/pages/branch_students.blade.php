@extends('app.admin.layouts.main')

@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li>
                    <h5 class="bc-title">Branch Students</h5>
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
                                    <div>
                                        <input type="text" id="searchInput" placeholder="Search course">
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="empoloyees-tblwrapper" class="table">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Branch ID</th>
                                                <th>Branch Name</th>
                                                <th>Branch Owner</th>
                                                <th>Mobile Number</th>
                                                <th>City Name</th>
                                                <th>Enrolled Students</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if ($branches)
                                                @foreach ($branches as $branch)
                                                    <tr>
                                                        <td> {{ $loop->index +1 }} </td>
                                                        <td><span>{{ $branch->id }}</span></td>
                                                        <td>
                                                            <div class="products">

                                                                <div>
                                                                    <h6>{{ $branch->branch_name }}</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{ $branch->name }}</td>
                                                        <td><span>{{ $branch->phone }}</span></td>
                                                        <td>
                                                            <span>{{ $branch->location }}</span>
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="text-primary text-bold">{{ $branch->student->count() }}</span>
                                                        </td>

                                                        <td>
                                                            <div class="d-flex justify-content-center">

                                                                <a href="{{ route('students', ['id' => $branch->id]) }}"
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
