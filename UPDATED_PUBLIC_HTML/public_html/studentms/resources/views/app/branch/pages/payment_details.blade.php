@extends('app.branch.layouts.main')

@section('content')
    <div class="content-body">

        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">

                    @if (session('success'))
                        <script>
                            Swal.fire(
                                "Done!",
                                "{{ session('success') }}",
                                "success"
                            );
                        </script>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <ul class="nav nav-tabs style-1 mb-4" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="{{ route('branch_student_cdetails', ['id' => $studentData->id]) }}"
                                class="nav-link border-s-1">Course Details</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="javascript::void();" class="nav-link active">Payment
                                Details</a>
                        </li>

                    </ul>
                    <div class="card h-auto">
                        <div class="card-body p-0">
                            <div class="table-responsive active-projects style-1">
                                <div class="tbl-caption">

                                    @if ($dueAmountData->amount_due > 0)
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal1">
                                            + Pay Installment
                                        </button>
                                    @endif

                                    <h4>Course Amount: <b>₹ {{ number_format($courseFees->course_amount) }}</b></h4>

                                </div>
                                <table id="empoloyees-tblwrapper" class="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Payment Date</th>
                                            <th>Paid Amount</th>
                                            <th>Due Amount</th>
                                            <th>Payment Mode</th>
                                            <th>Next Pay Date</th>
                                            <th>Next Pay Amount</th>
                                            <th>Payment Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if ($studentData->fees->count() > 0)
                                            @foreach ($studentData->fees as $payment)
                                                <tr>
                                                    <td class="text-black">{{ $loop->index + 1 }}</td>
                                                    <td>
                                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $payment->installment_date)->format('F j, Y') }}
                                                    </td>
                                                    <td><b>₹ </b> {{ number_format($payment->amount_paid) }}</td>
                                                    <td> <span class="text-danger"> <b>₹
                                                            </b>{{ number_format($payment->amount_due) }}</span>
                                                    </td>
                                                    <td>{{ $payment->payment_mode }}</td>
                                                    <td>
                                                        @if ($payment->next_installment_date)
                                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $payment->next_installment_date)->format('F j, Y') }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span class="text-primary">
                                                            <b>₹ </b>{{ number_format($payment->next_installment_amount) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if ($payment->payment_type == 'Lumpsum')
                                                            <span class="badge badge-success">Lumpsum</span>
                                                        @else
                                                            <span class="badge badge-primary">Installment</span>
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


    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel1">Installment Payment</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('branch_installment_payment', ['id' => $dueAmountData->student_id]) }}"
                        method="POST">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-xl-12">
                                <input type="hidden" name="fees_id" value="{{ $dueAmountData->id }}">
                                <label class="form-label">Due Amount<span class="text-danger">*</span></label>
                                <input type="text" name="amount_due" id="amount_due" class="form-control"
                                    value="{{ $dueAmountData->amount_due }}" readonly>

                                <label class="form-label mt-3">Installment date<span class="text-danger">*</span></label>
                                <input class="form-control" type="date" id="installment_date" name="installment_date"
                                    required>

                                <label class="form-label mt-3">Installment Amount<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="amount_paid" name="amount_paid"
                                    placeholder="Enter paid amount" required>

                                <label class="form-label mt-3" for="payment_mode">Payment Mode
                                    <span class="text-danger">*</span>
                                </label>
                                <div>
                                    <select class="default-select wide form-control" name="payment_mode" id="payment_mode"
                                        required>
                                        <option selected disabled>Please select mode</option>
                                        <option value="Cash">In Cash</option>
                                        <option value="UPI">UPI</option>
                                        <option value="Cheque">Cheque</option>
                                        <option value="Bank Transfer">Bank Transfer</option>
                                    </select>
                                </div>

                                {{-- <div class="row">
                                    <div class="col-xl-6">
                                        <label class="form-label mt-3">Next Pay Date</label>
                                        <div class="input-group">
                                            <input type="date" name="next_installment_date" class="form-control"
                                                id="next_installment_date">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <label class="form-label mt-3">Next Pay Amount</label>
                                        <div class="input-group">
                                            <input type="text" name="next_installment_amount" class="form-control"
                                                id="next_installment_amount" placeholder="Enter next installment amount">
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">Submit Payment</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

    <style>
        button.dt-button.buttons-excel.buttons-html5.btn.btn-sm.border-0 {
            display: none;
        }
    </style>
@endsection
