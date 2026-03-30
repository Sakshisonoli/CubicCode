@extends('app.branch.layouts.main')

@section('content')
    <div class="content-body">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li>
                    <h5 class="bc-title">Fees Pending Students</h5>
                </li>
            </ol>

        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive active-projects style-1">
                               <div class="table-responsive p-4">
                                    <table id="empoloyees-tblwrapper" class="table">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Student ID</th>
                                                <th>Name</th>
                                                <th>Total Paid Fees</th>
                                                <th>Due Fees</th>
                                                <th>Payments & Bill</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if ($students)
                                                @foreach ($students as $student)
                                                    <tr>
                                                        <td> {{ $loop->index +1 }} </td>
                                                        <td><span>{{ $student->student_id }}</span></td>
                                                        <td>
                                                            <div class="products">
                                                                <div>
                                                                    <a class="btn-link" href="{{route('branch_student_cdetails', ['id' => $student->student_id])}}">{{ $student->student_name }}</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="text-warning"><b>₹</b> {{ number_format($student->total_paid) }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="text-danger"><b>₹</b>
                                                                {{ number_format($student->amount_due) }}</span>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('branch_student_pdetails', ['id' => $student->student_id]) }}"
                                                                class="btn light btn-primary btn-xxs me-2"><i
                                                                    class="fa fa-eye"></i></a>

                                                            <div class="dropdown bootstrap-select default-select status-select dropup">

                                                                <button type="button" tabindex="-1" class="btn dropdown-toggle btn-light" data-bs-toggle="dropdown" role="combobox" aria-owns="bs-select-4" aria-haspopup="listbox" aria-expanded="false" title="High">
                                                                  <div class="filter-option">
                                                                      <div class="filter-option-inner">
                                                                          <div class="filter-option-inner-inner">
                                                                              Invoices
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                </button>
                                                                  <div class="dropdown-menu" style="max-height: 301.425px; overflow: hidden; min-height: 0px;">
                                                                      <div class="inner show" role="listbox" id="bs-select-4" tabindex="-1" aria-activedescendant="bs-select-4-0" style="max-height: 287.425px; overflow-y: auto; min-height: 0px;">
                                                                          <ul class="dropdown-menu inner show" role="presentation" style="margin-top: 0px; margin-bottom: 0px;">
                                                                              {{-- <li class="selected">
                                                                                  <a role="option" href="{{ route('branch_student_clear_bill', ['id' => $student->student_id]) }}" class="dropdown-item active selected" id="bs-select-4-0" tabindex="0" aria-setsize="3" aria-posinset="1" aria-selected="true">
                                                                                      <span class="text">
                                                                                          Clear
                                                                                      </span>
                                                                                  </a>
                                                                              </li> --}}
                                                                              <li>
                                                                                  <a role="option" href="{{ route('branch_student_due_bill', ['id' => $student->student_id]) }}" class="dropdown-item" id="bs-select-4-1" tabindex="0" aria-setsize="3" aria-posinset="2">
                                                                                      <span class="text">
                                                                                          Due
                                                                                      </span>
                                                                                  </a>
                                                                              </li>
                                                                              <li>
                                                                                  <a role="option" href="{{ route('branch_student_paid_bill', ['id' => $student->student_id]) }}" class="dropdown-item" id="bs-select-4-2" tabindex="0" aria-setsize="3" aria-posinset="3">
                                                                                      <span class="text">
                                                                                          Prev Paid
                                                                                      </span>
                                                                                  </a>
                                                                              </li>
                                                                          </ul>
                                                                      </div>
                                                                  </div>
                                                              </div>
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
