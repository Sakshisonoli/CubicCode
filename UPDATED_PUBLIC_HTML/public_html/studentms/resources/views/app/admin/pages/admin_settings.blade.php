@extends('app.admin.layouts.main')

@section('content')
<div class="content-body">
    <!-- row -->
    <div class="page-titles">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="javascript:void(0)">Admin Settings</a>
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

          <div class="card h-auto">
            <div class="card-body ai-tabs-1 py-2">
              <ul
                class="nav nav-tabs align-items-end"
                id="myTab"
                role="tablist"
              >
                <li class="nav-item" role="presentation">
                  <button
                    class="nav-link"
                    id="create-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#create-tab-pane"
                    type="button"
                    role="tab"
                    aria-controls="create-tab-pane"
                    aria-selected="true"
                  >
                    Edit Personal Information
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button
                    class="nav-link active"
                    id="jobs-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#jobs-tab-pane"
                    type="button"
                    role="tab"
                    aria-controls="jobs-tab-pane"
                    aria-selected="false"
                  >  Change Password
                  </button>
                </li>
              </ul>
            </div>
          </div>

          {{-- Fisrt Tab --}}
          <div class="tab-content" id="myTabContent">
            <div
              class="tab-pane fade"
              id="create-tab-pane"
              role="tabpanel"
              aria-labelledby="create-tab"
              tabindex="0"
            >
                <div class="card profile-card card-bx m-b30">
                    <div class="card-body p-0">
                        <form class="profile-form" action="{{ route('update_admin_info', ['id' => $adminData->id]) }}"
                            method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4 m-b30">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $adminData->name }}">
                                    </div>
                                    <div class="col-sm-4 m-b30">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ $adminData->email }}">
                                    </div>
                                    <div class="col-sm-4 m-b30">
                                        <label class="form-label">Mobile Number</label>
                                        <input type="number" class="form-control" name="phone"
                                            value="{{ $adminData->phone }}">
                                    </div>
                                    <div class="col-sm-4 m-b30">
                                        <label class="form-label">Branch Name</label>
                                        <input type="text" class="form-control" name="branch_name"
                                            value="{{ $adminData->branch_name }}">
                                    </div>
                                    <div class="col-sm-4 m-b30">
                                        <label class="form-label">City Name</label>
                                        <input type="text" class="form-control" name="location"
                                            value="{{ $adminData->location }}">
                                    </div>
                                    <div class="col-sm-4 m-b30">
                                        <label class="form-label">Adhar Card Number</label>
                                        <input type="text" class="form-control" name="id_proof"
                                            value="{{ $adminData->id_proof }}">
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">UPDATE</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>



            {{-- Second Tab --}}
            <div class="tab-pane fade show active" id="jobs-tab-pane" role="tabpanel" aria-labelledby="jobs-tab" tabindex="0">
              <div class="card profile-card card-bx m-b30">
                <div class="card-body p-0">
                    <form class="profile-form"
                    action="{{ route('change_admin_pass', ['id' => $adminData->id]) }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 m-b30">
                                <label class="form-label">Current Password</label>
                                <input type="password" class="form-control" name="current_password" id="current_password"
                                    placeholder="Enter your current password">
                            </div>
                            <div class="col-sm-4 m-b30">
                                <label class="form-label">New Password</label>
                                <input type="password" class="form-control" name="new_password" id="new_password"
                                    placeholder="Enter new password min 6 characters">
                            </div>
                            <div class="col-sm-4 m-b30">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation"
                                    id="password_confirmation" placeholder="Confirm password">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">UPDATE PASSWORD</button>
                    </div>
                </form>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
</div>
@endsection
