@extends('app.admin.layouts.main')

@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li>
                    <h5 class="bc-title">Students Total Fees</h5>
                </li>
            </ol>

        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-sm-6">
                    <div class="card box-hover">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-box icon-box-lg bg-success-light rounded-circle">
                                    <svg width="46" height="46" viewBox="0 0 46 46" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.9715 29.3168C15.7197 29.3168 9.52686 30.4132 9.52686 34.8043C9.52686 39.1953 15.6804 40.331 22.9715 40.331C30.2233 40.331 36.4144 39.2328 36.4144 34.8435C36.4144 30.4543 30.2626 29.3168 22.9715 29.3168Z"
                                            stroke="#3AC977" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.9714 23.0537C27.7304 23.0537 31.5875 19.1948 31.5875 14.4359C31.5875 9.67694 27.7304 5.81979 22.9714 5.81979C18.2125 5.81979 14.3536 9.67694 14.3536 14.4359C14.3375 19.1787 18.1696 23.0377 22.9107 23.0537H22.9714Z"
                                            stroke="#3AC977" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="total-projects ms-3">
                                    <h3 class="text-success count">{{ number_format($totalCourseAmt) }}</h3>
                                    <span>Total Sell Courses Fees</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card box-hover">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-box icon-box-lg bg-primary-light rounded-circle">
                                    <svg width="46" height="46" viewBox="0 0 46 46" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M32.8961 26.5849C34.1612 26.5849 35.223 27.629 35.0296 28.8783C33.8947 36.2283 27.6026 41.6855 20.0138 41.6855C11.6178 41.6855 4.8125 34.8803 4.8125 26.4862C4.8125 19.5704 10.0664 13.1283 15.9816 11.6717C17.2526 11.3579 18.5553 12.252 18.5553 13.5605C18.5553 22.4263 18.8533 24.7197 20.5368 25.9671C22.2204 27.2145 24.2 26.5849 32.8961 26.5849Z"
                                            stroke="var(--primary)" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M41.1733 19.2019C41.2739 13.5059 34.2772 4.32428 25.7509 4.48217C25.0877 4.49402 24.5568 5.04665 24.5272 5.70783C24.3121 10.3914 24.6022 16.4605 24.764 19.2118C24.8134 20.0684 25.4864 20.7414 26.341 20.7907C29.1693 20.9526 35.4594 21.1736 40.0759 20.4749C40.7035 20.3802 41.1634 19.8355 41.1733 19.2019Z"
                                            stroke="var(--primary)" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>

                                </div>
                                <div class="total-projects ms-3">
                                    <h3 class="text-primary count">{{ number_format($totalPaidFees) }}</h3>
                                    <span>Total Paid Fees</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card box-hover">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-box icon-box-lg bg-danger-light rounded-circle">
                                    <i style="font-size: 28px !important;" class="bi bi-clipboard2-minus text-danger"></i>
                                </div>
                                <div class="total-projects ms-3">
                                    <h3 class="text-danger count">{{ number_format($totalDueFees) }}</h3>
                                    <span>Total Due Fees</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card box-hover">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="icon-box icon-box-lg bg-purple-light rounded-circle">
                                    <i style="font-size: 30px !important;" class="bi bi-mortarboard text-purple"></i>
                                </div>
                                <div class="total-projects ms-3">
                                    <h3 class="text-purple count">{{ number_format($totalEnrolled) }}</h3>
                                    <span>Total Enrolled Students</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive active-projects style-1">
                            <div class="table-responsive">
                                <table id="empoloyees-tblwrapper" class="table">
                                    <thead>
                                        <tr>
                                            <th>Branch ID</th>
                                            <th>Branch Name</th>
                                            <th>Branch Owner</th>
                                            <th>Students</th>
                                            <th>Sell Courses Fees</th>
                                            <th>Paid Fees</th>
                                            <th>Due Fees</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if ($branches)
                                            @foreach ($branches as $branch)
                                                <tr>
                                                    <td><span>{{ $branch->id }}</span></td>
                                                    <td>
                                                        <div class="products">

                                                            <div>
                                                                <h6>{{ $branch->branch_name }}</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $branch->name }}</td>
                                                    <td>
                                                        <span
                                                            class="text-primary text-bold">{{ $branch->students }}</span>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            <b>₹</b>
                                                            {{ number_format($branch->sfees) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            <b>₹</b> {{ number_format($branch->pfees) }}
                                                        </span>
                                                    </td>

                                                    <td>
                                                        <span>
                                                            <b>₹</b>
                                                            {{ number_format($branch->sfees - $branch->pfees) }}
                                                        </span>
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
