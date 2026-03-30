@extends('app.branch.layouts.main')

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
                                                                {{ number_format($course->fees) }} - <b>₹</b> {{ number_format($course->max_fees) }} </span>
                                                        </td>
                                                        <td><a href="{{ $course->doc_link }}" target="_blank"
                                                                rel="noopener noreferrer"> <span
                                                                    class="badge light badge-success">Click here to
                                                                    open</span></a>
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
