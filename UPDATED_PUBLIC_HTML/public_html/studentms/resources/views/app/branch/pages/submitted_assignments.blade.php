@extends('app.branch.layouts.main')

@section('content')
<div class="content-body">
    <!-- row -->
    <div class="page-titles">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="javascript:void(0)">Submitted Assignments</a>
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
                            <th>Student</th>
                            <th>Project Name</th>
                            <th>Description</th>
                            <th>Link</th>
                            <th>Batch</th>
                            <th>Assignment PDF</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if ($submittedAsssignments)

                            @foreach ($submittedAsssignments as $assignment)
                                <tr>
                                    <td class="text-black">{{$loop->index +1}}</td>
                                    <td>
                                        {{$assignment->student->name}} <br> <b>S.ID</b> {{$assignment->student_id}}
                                    </td>
                                    <td>{{$assignment->project_name}}</td>
                                    <td>{{$assignment->desciption}}</td>
                                    <td>
                                        <a class="btn btn-primary light btn-sm" target="_blank" href="{{$assignment->project_note}}">Click to Open</a>
                                    </td>
                                    <td>
                                        "<b>{{$assignment->student->batch->batch_name}}</b>" Batch
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
@endsection
