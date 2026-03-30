@extends('app.admin.layouts.main')

@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li>
                    <h5 class="bc-title text-success"> {{ ucfirst(\Carbon\Carbon::createFromFormat('m', $selectedMonth)->format('F')) }}
                        {{ $selectedYear }} Payment Statement</h5>
                </li>
            </ol>
        </div>

        @if (session('success'))
            <script>
                Swal.fire(
                    "Done!",
                    "{{ session('success') }}",
                    "success"
                );
            </script>
        @endif

        <div class="container-fluid">
            <div class="row">

                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive active-projects style-1">
                            <div class="tbl-caption">
                                    <div>
                                        <form action="{{ route('export_monthly_comm') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="month" id="month" value="{{ $selectedMonth }}">
                                            <input type="hidden" name="year" id="year" value="{{ $selectedYear }}">

                                            <button type="submit" class="btn btn-primary btn-sm">Download</button>
                                        </form>
                                    </div>
                                <div>
                                    <div class="basic-form">
                                        <form action="{{route('monthly_statements')}}" method="GET">
                                            @csrf

                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <select class="default-select wide form-control"
                                                    name="month" id="month">
                                                        <option selected disabled>Month</option>
                                                        <option value="1">January</option>
                                                        <option value="2">February</option>
                                                        <option value="3">March</option>
                                                        <option value="4">April</option>
                                                        <option value="5">May</option>
                                                        <option value="6">June</option>
                                                        <option value="7">July</option>
                                                        <option value="8">August</option>
                                                        <option value="9">September</option>
                                                        <option value="10">October</option>
                                                        <option value="11">November</option>
                                                        <option value="12">December</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4 mt-2 mt-sm-0">
                                                    <select class="default-select wide form-control"
                                                    name="year" id="year">
                                                        <option selected disabled>Year</option>
                                                        <option value="2023">2023</option>
                                                        <option value="2024">2024</option>
                                                        <option value="2025">2025</option>
                                                        <option value="2026">2026</option>
                                                        <option value="2027">2027</option>
                                                        <option value="2028">2028</option>
                                                        <option value="2029">2029</option>
                                                        <option value="2030">2030</option>
                                                        <option value="2031">2031</option>
                                                        <option value="2032">2032</option>
                                                        <option value="2033">2033</option>
                                                        <option value="2034">2034</option>
                                                        <option value="2035">2035</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4 mt-2 mt-sm-0">
                                                    <button type="submit" class="btn btn-primary mb-2">Filter</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="empoloyees-tblwrapper" class="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Branch ID</th>
                                            <th>Branch Name</th>
                                            <th>This Month Collection</th>
                                            <th>Technical Fees</th>
                                            <th>Branch Fees</th>
                                            <th>Payments Bill</th>
                                            <th>Paid Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if ($branches)
                                            @foreach ($branches as $branch)
                                                <tr>
                                                    <td> {{ $loop->index +1 }} </td>
                                                    <td><span>{{ $branch->id }}</span></td>
                                                    <td>
                                                        <div>
                                                            <h6>{{ $branch->branch_name }}</h6>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            <b>₹</b>
                                                            {{ number_format($branch->month_collection) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="text-primary text-bold">
                                                            <b>₹</b>
                                                            {{ number_format($branch->tech_fees) }}
                                                        </span>
                                                    </td>

                                                    <td>
                                                        <span>
                                                            <b>₹</b>
                                                            {{ number_format($branch->branch_fees) }}
                                                        </span>
                                                    </td>

                                                    <td>
                                                        <div>
                                                            <form action="{{ route('get_partner_bill', ['id' => $branch->id]) }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="month" id="month" value="{{ $selectedMonth }}">
                                                                <input type="hidden" name="year" id="year" value="{{ $selectedYear }}">

                                                                <button type="submit" class="btn light btn-success btn-xxs me-2"><i
                                                                    class="fa fa-download"></i></button>
                                                            </form>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="d-flex justify-content-evenly">
                                                            <div>
                                                                <form action="{{ route('update_paid_status', ['id' => $branch->id]) }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="month" id="month" value="{{ $selectedMonth }}">
                                                                    <input type="hidden" name="year" id="year" value="{{ $selectedYear }}">
                                                                    <input type="hidden" name="note" id="note{{$branch->id}}" value="{{ $branch->fees_status ? $branch->fees_status->note : '' }}">
                                                                    <div class="form-check form-switch mb-0">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            role="switch" id="flexSwitchCheck{{$branch->id}}" {{ $branch->fees_status && $branch->fees_status->note == 'paid' ? 'checked' : '' }}
                                                                            onchange="document.getElementById('note{{$branch->id}}').value = this.checked ? 'paid' : 'unpaid'; this.form.submit()">
                                                                    </div>
                                                                </form>
                                                            </div>

                                                            <div>
                                                                @if ($branch->fees_status)
                                                                    @if ($branch->fees_status->note == 'paid')
                                                                        <span class="badge badge-success light border-0">Paid</span>
                                                                    @else
                                                                        <span class="badge badge-danger light border-0">Unpaid</span>
                                                                    @endif
                                                                @endif
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
@endsection
