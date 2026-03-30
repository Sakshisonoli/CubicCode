@extends('app.student.layouts.main')

@section('content')
<div class="content-body">
    <!-- row -->
    <div class="page-titles">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="javascript:void(0)">Assignments</a>
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

              <div class="table-responsive">
                <table id="empoloyees-tblwrapper" class="table">
                  <thead>
                    <tr>
                      <th>No. </th>
                      <th>Project Name</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    @if ($assignments)

                        @foreach ($assignments as $assignment)
                        <tr>
                            <td class="text-black">{{$loop->index +1}}</td>
                            <td>
                                <b>{{$assignment->project_name}}</b>
                            </td>
                            <td>
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $assignment->start_date)->format('F j, Y') }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::createFromFormat('Y-d-m', $assignment->end_date)->format('F j, Y') }}
                            </td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal1{{$loop->index}}">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <a class="btn btn-primary btn-sm" data-bs-toggle="offcanvas"
                                    href="#offcanvasExample{{$loop->index}}" role="button" aria-controls="offcanvasExample{{$loop->index}}">Submit</a>

                            </td>

                            <div class="offcanvas offcanvas-end customeoff" tabindex="-1" id="offcanvasExample{{$loop->index}}">
                                <div class="offcanvas-header">
                                    <h4 class="modal-title" id="#gridSystemModal">Submit Assignment</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>

                                </div>
                                <hr>
                                <div class="offcanvas-body">
                                    <div class="container-fluid">
                                        <form action="{{route('student_submit_assignment')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <input type="hidden" name="assignment_id" value="{{$assignment->id}}">
                                                <input type="hidden" name="branch_id" value="{{ auth()->guard('student')->user()->branch_id }}">
                                                <input type="hidden" name="student_id" value="{{ auth()->guard('student')->user()->id }}">

                                                <div class="col-xl-12 mb-3">
                                                    <label for="project_name" class="form-label">Project Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="project_name" class="form-control"
                                                        placeholder="Enter Project Name" value="{{$assignment->project_name}}">
                                                </div>
                                                <div class="col-xl-12 mb-3">
                                                    <label class="form-label" for="desciption">Write Description<span class="text-danger">*</span></label>
                                                    <textarea name="desciption" rows="6" class="form-control" placeholder="Enter the project description" required></textarea>
                                                </div>
                                                <div class="col-xl-6 mb-3">
                                                  <label for="file" class="form-label">Please select your project pdf</label>
                                                  <input type="file" name="file" class="form-control">
                                                </div>
                                                <div class="col-xl-12 mb-3">
                                                    <label for="project_note" class="form-label">Project Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="project_note" class="form-control"
                                                        placeholder="Enter Project URL, GitHub Link, Or Doc Link">
                                                </div>
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-primary me-1">Submit Assignment</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            {{-- Modals --}}
                            <div class="modal fade" id="exampleModal1{{$loop->index}}" tabindex="-1" aria-labelledby="exampleModalLabel1"
                            aria-hidden="true">
                                <div class="modal-dialog modal-dialog-center modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel1">Assignment Details</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="profile-personal-info">

                                                <div class="row mb-2">
                                                    <div class="col-sm-5 col-5">
                                                        <h5 class="f-w-500">Project Name <span class="pull-end">:</span>
                                                        </h5>
                                                    </div>
                                                    <div class="col-sm-7 col-7"><span>{{$assignment->project_name}}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-5 col-5">
                                                        <h5 class="f-w-500">Project Description <span class="pull-end">:</span>
                                                        </h5>
                                                    </div>
                                                    <div class="col-sm-7 col-7"><span> {{$assignment->project_description}} </span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-5 col-5">
                                                        <h5 class="f-w-500">Project Doc Link<span class="pull-end">:</span>
                                                        </h5>
                                                    </div>
                                                    <div class="col-sm-7 col-7"><span> <a href="{{$assignment->project_doc}}" target="_blank" rel="noopener noreferrer"> {{$assignment->project_doc}} </a></span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-5 col-5">
                                                        <h5 class="f-w-500">Project Points<span class="pull-end">:</span>
                                                        </h5>
                                                    </div>
                                                    <div class="col-sm-7 col-7">
                                                        <span>  {{$assignment->points}} </span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-5 col-5">
                                                        <h5 class="f-w-500">Project Start Date <span class="pull-end">:</span></h5>
                                                    </div>
                                                    <div class="col-sm-7 col-7"><span>
                                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $assignment->start_date)->format('F j, Y') }}
                                                    </span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-5 col-5">
                                                        <h5 class="f-w-500">Project End Date <span class="pull-end">:</span>
                                                        </h5>
                                                    </div>
                                                    <div class="col-sm-7 col-7"><span>
                                                        {{ \Carbon\Carbon::createFromFormat('Y-d-m', $assignment->end_date)->format('F j, Y') }}
                                                    </span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-sm-5 col-5">
                                                        <h5 class="f-w-500">Project Status<span class="pull-end">:</span>
                                                        </h5>
                                                    </div>
                                                    <div class="col-sm-7 col-7"><span class="text-warning"> {{$assignment->status}} </span>
                                                    </div>
                                                </div>

                                            </div>

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
