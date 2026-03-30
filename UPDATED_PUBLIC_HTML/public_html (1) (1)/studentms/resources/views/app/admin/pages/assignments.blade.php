@extends('app.admin.layouts.main')

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
                    Sent
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
                    aria-selected="false">
                    Received
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
            <div class="card">
              <div class="card-body p-0">
                <div class="table-responsive active-projects style-1">

                    <div class="table-responsive">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                              <tr>
                                <th>No. </th>
                                <th>Branch</th>
                                <th>Project Name</th>
                                <th>Description</th>
                                <th>Doc Link</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Send To</th>
                                <th>Status</th>
                              </tr>
                            </thead>
                            <tbody>

                              @if ($sentAssignments)

                                  @foreach ($sentAssignments as $assignment)
                                  <tr>
                                      <td class="text-black">{{$loop->index +1}}</td>
                                      <td>{{$assignment->branch->branch_name}}</td>
                                      <td>
                                          <b>{{$assignment->project_name}}</b>
                                      </td>

                                      <td>{{$assignment->project_description}}</td>
                                      <td>{{$assignment->project_doc}}</td>
                                      <td>
                                        @if ($assignment->start_date)
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $assignment->start_date)->format('F j, Y') }}
                                        @endif
                                      </td>
                                      <td>
                                        @if ($assignment->end_date)
                                            {{ \Carbon\Carbon::createFromFormat('Y-d-m', $assignment->end_date)->format('F j, Y') }}
                                        @endif
                                      </td>
                                      <td>
                                          @if ($assignment->batch_id == null)
                                              All Batch
                                          @else
                                             Batch "{{$assignment->batch->batch_name}}"
                                          @endif
                                      </td>
                                      <td>
                                          @if ($assignment->status === 'active')
                                              <span class="badge badge-success">Active</span>
                                          @else
                                              <span class="badge badge-danger">Inactive</span>
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



            {{-- Second Tab --}}
            <div
              class="tab-pane fade show active"
              id="jobs-tab-pane"
              role="tabpanel"
              aria-labelledby="jobs-tab"
              tabindex="0"
            >
              <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="empoloyees-tblwrapper" class="table">
                            <thead>
                                <tr>
                                    <th>No. </th>
                                    <th>Branch</th>
                                    <th>Student</th>
                                    <th>Project Name</th>
                                    <th>Description</th>
                                    <th>Batch</th>
                                    <th>Link</th>
                                    <th>Assignment PDF</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if ($submittedAsssignments)

                                    @foreach ($submittedAsssignments as $assignment)
                                        <tr>
                                            <td class="text-black">{{$loop->index +1}}</td>
                                            <td>{{$assignment->branch->branch_name}}</td>
                                            <td>
                                                {{$assignment->student->name}} <br> <b>S.ID</b> {{$assignment->student_id}}
                                            </td>
                                            <td>{{$assignment->project_name}}</td>
                                            <td>{{$assignment->desciption}}</td>
                                            <td>
                                                "<b>{{$assignment->student->batch->batch_name}}</b>" Batch
                                            </td>
                                            <td>
                                                <a class="btn btn-primary light btn-sm" target="_blank" href="{{$assignment->project_note}}">Click to Open</a>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal1{{$loop->index}}">
                                                    <i class="fa fa-eye"></i> PDF
                                                </button>
                                            </td>
                                            {{-- Modals --}}
                                            <div class="modal fade" id="exampleModal1{{$loop->index}}" tabindex="-1" aria-labelledby="exampleModalLabel1"
                                            aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-center modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel1">Assignment PDF</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="profile-personal-info">
                                                                <iframe class="shadow-lg" src="{{ asset("assignments/$assignment->file") }}" width="100%"
                                                                    height="700px"></iframe>
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
  </div>
@endsection
