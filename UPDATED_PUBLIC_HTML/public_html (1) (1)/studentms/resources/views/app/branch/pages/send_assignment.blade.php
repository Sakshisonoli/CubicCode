@extends('app.branch.layouts.main')

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
                <div class="tbl-caption">
                  <div>
                      <a class="btn btn-primary btn-sm" data-bs-toggle="offcanvas"
                          href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Send Assignment</a>
                  </div>
              </div>
              <div class="table-responsive">
                <table id="empoloyees-tblwrapper" class="table">
                  <thead>
                    <tr>
                      <th>No. </th>
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
                            <td>
                                <b>{{$assignment->project_name}}</b>
                            </td>

                            <td>{{$assignment->project_description}}</td>
                            <td>{{$assignment->project_doc}}</td>
                            <td>
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $assignment->start_date)->format('F j, Y') }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::createFromFormat('Y-d-m', $assignment->end_date)->format('F j, Y') }}
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
      </div>
    </div>

    {{-- OffCanvas Popup --}}
    <div class="offcanvas offcanvas-end customeoff" tabindex="-1" id="offcanvasExample">
      <div class="offcanvas-header">
          <h4 class="modal-title" id="#gridSystemModal">Send Assignment</h4>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
              <i class="fa-solid fa-xmark"></i>
          </button>

      </div>
      <hr>
      <div class="offcanvas-body">
          <div class="container-fluid">

              <form action="{{route('branch_sending_assignment')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="col-xl-12 mb-3">
                        <label for="batch_id" class="form-label">Send To<span class="text-danger">*</span></label>
                        <select class="default-select wide form-control" name="batch_id" id="batch_id"
                        required>
                            <option selected disabled>Please select batch
                            </option>
                            @if ($batches)
                                <option value="toAll">All Batches</option>
                                @foreach ($batches as $batch)
                                    <option value="{{ $batch->id }}"> B.ID:
                                        {{ $batch->id }} -
                                        "{{ $batch->batch_name }}" {{ $batch->course->course_name}}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                      <div class="col-xl-12 mb-3">
                          <label for="project_name" class="form-label">Subject<span class="text-danger">*</span></label>
                          <input type="text" name="project_name" class="form-control"
                              placeholder="Enter Project Name">
                      </div>
                      <div class="col-xl-12 mb-3">
                          <label class="form-label" for="project_description">Project Description<span class="text-danger">*</span></label>
                          <textarea name="project_description" rows="6" class="form-control" placeholder="Enter the project description" required></textarea>
                      </div>
                      <input type="hidden" name="branch_id" value="{{ auth()->user()->id }}">
                      <div class="col-xl-12 mb-3">
                        <label for="project_doc" class="form-label">Doc Link</label>
                        <input type="text" name="project_doc" class="form-control"
                            placeholder="Enter Project Document Or Blog Link">
                      </div>

                      <div class="col-xl-6 mb-3">
                        <label for="start_date" class="form-label">Start Date<span class="text-danger">*</span></label>
                        <input type="date" name="start_date" class="form-control">
                      </div>
                      <div class="col-xl-6 mb-3">
                        <label for="end_date" class="form-label">End Date<span class="text-danger">*</span></label>
                        <input type="date" name="end_date" class="form-control">
                      </div>
                      <div class="col-xl-6 mb-3">
                        <label for="points" class="form-label">Project Points</label>
                        <input type="number" name="points" class="form-control" placeholder="Enter Project Points">
                      </div>
                </div>
                  <div>

                      <button type="submit" class="btn btn-primary me-1">Send Assignment</button>
                  </div>
              </form>
          </div>
      </div>
    </div>
</div>
@endsection
