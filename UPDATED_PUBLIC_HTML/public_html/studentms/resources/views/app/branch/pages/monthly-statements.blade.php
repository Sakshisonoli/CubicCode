@extends('app.branch.layouts.main')

@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li>
                    <h5 class="bc-title text-success">Payment Statements</h5>
                </li>
            </ol>
        </div>
        <div class="container-fluid">
            <div class="row">

                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive active-projects style-1">
                            <div class="tbl-caption">
                                <div>
                                    <div class="basic-form">
                                        <form action="{{ route('branch_own_bill') }}" method="POST">
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
                                                    <button type="submit" class="btn btn-primary mb-2">Download</button>
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
                                            <th>Date</th>
                                            <th>Month Collection</th>
                                            <th>Technical Fees</th>
                                            <th>Branch Fees</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if ($monthsData)
                                            @foreach ($monthsData as $month => $data)
                                                <tr>
                                                    <td> {{$loop->index + 1}} </td>
                                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m', $month)->format('F , Y') }}</td>
                                                    <td>
                                                        <span> <b>₹</b> {{ number_format($data['month_collection']) }} </span>
                                                    </td>
                                                    <td>
                                                        <span> <b>₹</b> {{ number_format($data['tech_fees']) }} </span>
                                                    </td>
                                                    <td>
                                                        <span class="text-success"> <b>₹</b> {{ number_format($data['branch_fees']) }} </span>
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
