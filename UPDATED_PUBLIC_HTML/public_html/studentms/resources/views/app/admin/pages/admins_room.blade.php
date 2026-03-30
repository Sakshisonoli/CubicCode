@extends('app.admin.layouts.main')

@section('content')
    <div class="content-body">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li>
                    <h5 class="bc-title">Admins Room</h5>
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
                                        <div>
                                            <a class="btn btn-primary btn-sm" data-bs-toggle="offcanvas"
                                                href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                                                + Add Admin
                                            </a>
                                        </div>
                                    @endif

                                </div>

                                <div class="table-responsive p-4">
                                    <table id="empoloyees-tblwrapper" class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Role</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if ($admins)
                                                @foreach ($admins as $admin)
                                                    <tr>
                                                        <td><span>{{ $loop->index + 1 }}</span></td>
                                                        <td>
                                                            <h6>{{ $admin->name }}</h6>
                                                        </td>
                                                        <td><span>{{ $admin->email }}</span></td>
                                                        <td>
                                                            <span>{{ $admin->phone }}</span>
                                                        </td>
                                                        <td>
                                                            @if ($admin->admin_role === 'super')
                                                                <span class="badge badge-primary light">Super Admin</span>
                                                            @else
                                                                <span class="badge badge-warning light">Sub Admin</span>

                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (auth()->user()->admin_role === 'super')

                                                                @if ($admin->admin_role === 'sub')
                                                                    <a href="{{route('delete_admin', ['id' => $admin->id])}}"
                                                                        class="btn btn-danger shadow btn-xs sharp me-2"><i
                                                                        class="fa fa-trash"></i></a>
                                                                @endif

                                                            @endif

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
                <h4 class="modal-title" id="#gridSystemModal">Add New Admin</h4>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>

            </div>
            <hr>
            <div class="offcanvas-body">
                <div class="container-fluid">

                    <form action="{{ route('add_admin') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-6 mb-3">
                                <label for="name" class="form-label"> Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Enter student full name">
                            </div>

                            <div class="col-xl-6 mb-3">
                                <label for="email" class="form-label">Email<span
                                        class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Enter student email">
                            </div>

                            <div class="col-xl-6 mb-3">
                                <label for="phone" class="form-label">Mobile Number<span
                                        class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control" id="phone"
                                    placeholder="Enter student mobile number">
                            </div>

                            <div class="col-xl-6 mb-3">
                                <label class="form-label" for="admin_role">Admin Role<span class="text-danger">*</span></label>
                                <div class="mb-3 mb-0">
                                    <div class="form-check custom-checkbox form-check-inline">
                                        <input type="radio" class="form-check-input" id="admin_role" name="admin_role"
                                            value="super">
                                        <label class="form-check-label" for="admin_role">Super Admin</label>
                                    </div>
                                    <div class="form-check custom-checkbox form-check-inline">
                                        <input type="radio" class="form-check-input" id="admin_role" name="admin_role"
                                            value="sub">
                                        <label class="form-check-label" for="admin_role">Sub Admin</label>
                                    </div>

                                </div>
                            </div>
                            <input type="hidden" name="branch_name" value="Head Office">
                            <input type="hidden" name="location" value="Belgaum">
                            <input type="hidden" name="role_position" value="admin">
                            <input type="hidden" name="status" value="active">

                            <div class="col-xl-6 mb-3">
                                <label for="new_password" class="form-label">Password<span
                                        class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="Enter new password min 6 characters">
                            </div>

                            <div class="col-xl-6 mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password<span
                                        class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                                    placeholder="Confirm password">
                            </div>

                        </div>
                        <div>
                            <button class="btn btn-danger light ms-1">Cancel</button>
                            <button type="submit" class="btn btn-primary me-1">Add Admin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
