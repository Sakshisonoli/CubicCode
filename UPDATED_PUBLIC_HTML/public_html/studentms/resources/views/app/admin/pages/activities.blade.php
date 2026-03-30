@extends('app.admin.layouts.main')

@section('content')

    @if (auth()->user()->admin_role === 'super')

    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li>
                    <h5 class="bc-title">Admins Activities</h5>
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
                                        <input type="text" id="searchInput" placeholder="Search activities">
                                    </div>
                                </div>
                                <div class="table-responsive p-4">
                                    <table id="empoloyees-tblwrapper" class="table">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Admin</th>
                                                <th>Action</th>
                                                <th>Affected ID</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if ($activities)
                                                @foreach ($activities as $activity)
                                                    <tr>
                                                        <td> {{ $loop->index +1 }} </td>
                                                        <td>
                                                            @if ($activity->admin_id)
                                                                <h6>{{ $activity->admin->name }}</h6>
                                                                <span style="font-size: 9px; margin-top: -10 !important;">{{$activity->admin->branch_name}}</span>
                                                            @endif
                                                        </td>
                                                        <td><span class="text-warning">{{ $activity->action }}</span></td>
                                                        <td>
                                                            @if ($activity->student_affected)
                                                                <span>S.ID</span> {{$activity->student_affected}}
                                                            @elseif ($activity->faculty_affected)
                                                                <span>F.ID</span> {{$activity->faculty_affected}}
                                                            @else
                                                                <span> - </span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span>{{ $activity->created_at->diffForHumans() }}</span>
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

    @else

        @include('errors.pagenotfound_error')

    @endif


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
