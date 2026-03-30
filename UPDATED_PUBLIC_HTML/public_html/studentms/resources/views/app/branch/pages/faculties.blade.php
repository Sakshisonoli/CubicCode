@extends('app.branch.layouts.main')

@section('content')
    <div class="content-body">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li>
                    <h5 class="bc-title">Faculties</h5>
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
                                        <a class="btn btn-primary btn-sm" href="{{ route('branch_add_faculty') }}">+ Add New
                                            Faculty</a>
                                    </div>
                                </div>

                                <div class="table-responsive p-4">
                                    <table id="empoloyees-tblwrapper" class="table">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Faculty ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile Number</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if ($faculties)
                                                @foreach ($faculties as $faculty)
                                                    <tr>
                                                        <td> {{ $loop->index +1 }} </td>
                                                        <td><span>{{ $faculty->id }}</span></td>
                                                        <td>
                                                            <div class="products">

                                                                <div>
                                                                    <h6>{{ $faculty->name }}</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><span>{{ $faculty->email }}</span></td>
                                                        <td><span>{{ $faculty->phone }}</span></td>
                                                        <td>
                                                            <a href="{{ route('branch_faculty_details', ['id' => $faculty->id]) }}"
                                                                class="btn btn-success shadow btn-xs sharp me-2"><i
                                                                    class="fa fa-eye"></i>
                                                            </a>
                                                            <a href="{{ route('branch_edit_faculty', ['id' => $faculty->id]) }}"
                                                                class="btn btn-primary shadow btn-xs sharp me-2"><i
                                                                    class="fa fa-edit"></i>
                                                            </a>

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
