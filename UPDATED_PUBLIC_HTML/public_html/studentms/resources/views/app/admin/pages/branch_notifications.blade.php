@extends('app.admin.layouts.main')

@section('content')
<div class="content-body">
    <!-- row -->
    <div class="page-titles">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="javascript:void(0)">Branch Notifications</a>
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
                    aria-selected="false"
                  >  Received
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
                  <div class="tbl-caption">
                    @if (auth()->user()->admin_role === 'super')
                        <div>
                            <a class="btn btn-primary btn-sm" data-bs-toggle="offcanvas"
                                href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Send Notification</a>
                        </div>
                    @endif
                </div>
                <div class="table-responsive">
                  <table id="empoloyees-tblwrapper" class="table">
                    <thead>
                      <tr>
                        <th>No. </th>
                        <th>Sent To</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Time</th>
                      </tr>
                    </thead>
                    <tbody>

                      @if ($sentNotifications)

                        @foreach ($sentNotifications as $notification)
                            <tr>
                                <td class="text-black">{{$loop->index +1}}</td>
                                <td>
                                    @if ($notification->branch_id == null)
                                        <span class="text-warning">All Branches</span>
                                    @else
                                        <span class="text-warning">{{$notification->branch->branch_name}}</span>
                                    @endif
                                </td>
                                <td>{{$notification->title}}</td>
                                <td>{{$notification->message}}</td>
                                <td>{{$notification->created_at->diffForHumans()}}</td>
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
            <div class="tab-pane fade show active" id="jobs-tab-pane" role="tabpanel" aria-labelledby="jobs-tab" tabindex="0">
              <div class="card">
                <div class="card-body p-0">
                  <div class="table-responsive active-projects style-1">
                    <table id="empoloyees-tblwrapper" class="table">
                      <thead>
                        <tr>
                            <th>No. </th>
                            <th>Received From</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Time</th>
                        </tr>
                      </thead>
                      <tbody>

                        @if ($notifications)

                            @foreach ($notifications as $notification)
                                <tr>
                                    <td class="text-black">{{$loop->index +1}}</td>
                                    <td>
                                        <span class="text-warning">{{$notification->branch->branch_name}}</span>
                                    </td>
                                    <td>{{$notification->title}}</td>
                                    <td>{{$notification->message}}</td>
                                    <td>{{$notification->created_at->diffForHumans()}}</td>

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

    {{-- OffCanvas Popup --}}
    <div class="offcanvas offcanvas-end customeoff" tabindex="-1" id="offcanvasExample">
      <div class="offcanvas-header">
          <h4 class="modal-title" id="#gridSystemModal">Send Notification</h4>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
              <i class="fa-solid fa-xmark"></i>
          </button>

      </div>
      <hr>
      <div class="offcanvas-body">
          <div class="container-fluid">

              <form action="{{route('send_notification_to_branches')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="col-xl-12 mb-3">
                        <label for="branch_id" class="form-label">Notification To<span class="text-danger">*</span></label>
                        <select class="default-select wide form-control" name="branch_id" id="branch_id"
                        required>
                            <option selected disabled>Please select Branch
                            </option>
                            @if ($branches)
                                <option value="all">To All Branches</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}"> B.ID:
                                        {{ $branch->id }} -
                                        {{ $branch->branch_name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                      <div class="col-xl-12 mb-3">
                          <label for="title" class="form-label">Subject </label>
                          <input type="text" name="title" class="form-control" id="title"
                              placeholder="Enter notification subject">
                      </div>
                      <div class="col-xl-12 mb-3">
                          <label class="form-label" for="note">Message<span class="text-danger">*</span></label>
                          <textarea id="message" name="message" rows="5" class="form-control" placeholder="Enter the message you want to send" required></textarea>
                      </div>

                      <input type="hidden" name="admin_id" value="{{ auth()->user()->id }}">
                      <input type="hidden" name="subject" value="toBranch">
                  </div>
                  <div>
                      <button class="btn btn-danger light ms-1">Cancel</button>
                      <button type="submit" class="btn btn-primary me-1">Send Notification</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
@endsection
