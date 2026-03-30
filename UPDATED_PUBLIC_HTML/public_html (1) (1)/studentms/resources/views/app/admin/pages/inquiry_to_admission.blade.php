@extends('app.admin.layouts.main')

@section('content')
    <div class="content-body">

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

        <div class="container-fluid">

            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Student Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="needs-validation" action="{{ route('store_student') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="inquiry_id" value="{{ $inquiryData->id }}">
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="name">Student Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" name="name" class="form-control" id="name"
                                                        placeholder="Enter student full name"
                                                        value="{{ $inquiryData->name }}" required>
                                                    <div class="invalid-feedback">
                                                        Please enter student name.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="email">Student Email
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="email" name="email" class="form-control" id="email"
                                                        placeholder="Enter student email id"
                                                        value="{{ $inquiryData->email }}" required>
                                                    <div class="invalid-feedback">
                                                        Please enter student email id.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="phone">Student Mobile Number
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" name="phone" class="form-control" id="phone"
                                                        placeholder="Enter student mobile number"
                                                        value="{{ $inquiryData->phone }}" required>
                                                    <div class="invalid-feedback">
                                                        Please enter student mobile number.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="address">Student Address

                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" name="address" class="form-control" id="address"
                                                        placeholder="Enter student valid address"
                                                        value="{{ $inquiryData->address }}">
                                                    <div class="invalid-feedback">
                                                        Please enter student valid address.
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="adhar_number">Gender
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <div class="mb-3 mb-0">
                                                        <div class="form-check custom-checkbox form-check-inline">
                                                            <input type="radio" class="form-check-input" id="gender"
                                                                @if ($inquiryData->gender === 'male') {{ 'checked' }} @endif
                                                                name="gender" value="male">
                                                            <label class="form-check-label" for="gender">Male</label>
                                                        </div>
                                                        <div class="form-check custom-checkbox form-check-inline">
                                                            <input type="radio" class="form-check-input" id="gender"
                                                                @if ($inquiryData->gender === 'female') {{ 'checked' }} @endif
                                                                name="gender" value="female">
                                                            <label class="form-check-label" for="gender">Female</label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="adhar_number">Student Adhar
                                                    Number

                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" name="adhar_number" class="form-control"
                                                        id="adhar_number" placeholder="Enter student valid adhar number">
                                                    <div class="invalid-feedback">
                                                        Please enter student valid adhar number.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="birth_date">Student DOB
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="date" name="birth_date" class="form-control"
                                                        id="birth_date" required>
                                                    <div class="invalid-feedback">
                                                        Please enter student DOB.
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="nationality">Nationality
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <select class="default-select wide form-control" name="nationality"
                                                        id="nationality" required>
                                                        <option selected value="indian">Indian</option>
                                                        <option value="Foreign National">Foreign National</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please select a one.
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>


                                    <hr>


                                    <div class="row pt-4">
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="admission_date">Admission Date
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="date" name="admission_date" class="form-control"
                                                        id="admission_date" required>
                                                    <div class="invalid-feedback">
                                                        Please admission date.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="course_id">Enrolled Course
                                                    Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <select class="default-select wide form-control" name="course_id"
                                                        id="course_id">
                                                        <option selected disabled>Please select course
                                                        </option>
                                                        @if ($courses)
                                                            @foreach ($courses as $course)
                                                                <option value="{{ $course->id }}">
                                                                    {{ $course->course_name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please select a one.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="branch_id">Branch Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <select class="default-select wide form-control" name="branch_id"
                                                        id="branch_id" required>
                                                        <option selected disabled>Please select branch
                                                        </option>
                                                        @if ($branches)
                                                            @foreach ($branches as $branch)
                                                                <option value="{{ $branch->id }}">
                                                                    {{ $branch->branch_name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please select a one.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="batch_id">Branch Batches

                                                </label>
                                                <div class="col-lg-6">
                                                    <select class="wide form-control" name="batch_id" id="batch_id">
                                                        <option selected disabled>Please select batch
                                                        </option>

                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please select a one.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="profile">Legal Doc Drive Link

                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" name="profile" class="form-control" id="profile"
                                                        placeholder="Enter Legal Doc Drive Link">
                                                    <div class="invalid-feedback">
                                                        Please enter student valid Document.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="payment_type">Payment Mode
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <select class="default-select wide form-control" name="payment_type"
                                                        id="payment_type" required>
                                                        <option selected disabled>Please select mode</option>
                                                        <option value="Cash">In Cash</option>
                                                        <option value="UPI">UPI</option>
                                                        <option value="Cheque">Cheque</option>
                                                        <option value="Bank Transfer">Bank Transfer</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please select a one.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="note">Note

                                                </label>
                                                <div class="col-lg-6">
                                                    <textarea name="note" id="note" class="form-control"></textarea>
                                                    <div class="invalid-feedback">
                                                        Please enter note.
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>


                                    <hr>

                                    <div class="row pt-4">
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="payment_mode">Payment Options
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <div class="mb-3 mb-0">
                                                        <div class="form-check custom-checkbox form-check-inline">
                                                            <input type="radio" class="form-check-input" id="lumpsum"
                                                                name="payment_mode" value="Lumpsum">
                                                            <label class="form-check-label"
                                                                for="payment_mode">Lumpsum</label>
                                                        </div>
                                                        <div class="form-check custom-checkbox form-check-inline">
                                                            <input type="radio" class="form-check-input"
                                                                id="installments" name="payment_mode"
                                                                value="Installments">
                                                            <label class="form-check-label"
                                                                for="payment_mode">Installments</label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="course_amount">Course Amount
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="number" name="course_amount" class="form-control"
                                                        id="course_amount" placeholder="Enter selected course amount">
                                                    <div class="invalid-feedback">
                                                        Please enter selected course amount.
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-xl-6">


                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="payment_status">Payment Staus
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <div class="mb-3 mb-0">
                                                        <div class="form-check custom-checkbox form-check-inline">
                                                            <input type="radio" class="form-check-input"
                                                                id="payment_status" name="payment_status" value="paid"
                                                                checked>
                                                            <label class="form-check-label"
                                                                for="payment_status">Paid</label>
                                                        </div>
                                                        <div class="form-check custom-checkbox form-check-inline">
                                                            <input type="radio" class="form-check-input"
                                                                id="payment_status" name="payment_status" value="unpaid">
                                                            <label class="form-check-label"
                                                                for="payment_status">Unpaid</label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                    <hr>

                                    <div class="installment-field">
                                        <div class="row pt-4">
                                            <div class="col-xl-6">
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="total_installments">No. Of
                                                        Installments
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="default-select wide form-control"
                                                            name="total_installments" id="total_installments">
                                                            <option selected disabled>Please select Installments</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please select a one.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label" for="amount_paid">Paid Amount
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="number" name="amount_paid" class="form-control"
                                                            id="amount_paid" placeholder="Enter Paid Amount">
                                                        <div class="invalid-feedback">
                                                            Please enter paid amount.
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-xl-6">
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label"
                                                        for="next_installment_date">Next
                                                        Installment Date
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="date" name="next_installment_date"
                                                            class="form-control" id="next_installment_date">
                                                        <div class="invalid-feedback">
                                                            Please select next installment date.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label"
                                                        for="next_installment_amount">Next
                                                        Installment Amount
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" name="next_installment_amount"
                                                            class="form-control" id="next_installment_amount">
                                                        <div class="invalid-feedback">
                                                            Please select next installment amount.
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer mt-2">
                                        <div class="mb-2 mt-2 row">
                                            <div class="col-lg-12">
                                                <button type="submit" class="btn btn-primary">Add Student</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Include jQuery first -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Function to fetch batches based on branch ID
        function fetchBatches(branchId) {
            // Make an AJAX call to fetch the batches
            $.ajax({
                url: '{{ route('get_batch', ['branchId' => ':branchId']) }}'.replace(':branchId',
                    branchId), // Correct URL format for AJAX call
                type: 'GET',
                success: function(response) {
                    console.log('Success - Response:', response);
                    // Populate batch dropdown with received data
                    populateBatchDropdown(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error - Status:', textStatus);
                    console.error('Error - Response:', jqXHR.responseText);
                }
            });
        }

        function populateBatchDropdown(batches) {
            console.log('Received batches:', batches); // Log received batches
            var batchDropdown = document.getElementById('batch_id');
            // console.log(batchDropdown);
            batchDropdown.innerHTML = ''; // Clear existing options
            batchDropdown.innerHTML += '<option selected disabled>Please select batch</option>';
            // Construct HTML for options and append them
            batches.forEach(function(batch) {
                batchDropdown.innerHTML += '<option value="' + batch.id + '">' + batch.batch_name + '</option>';
            });
        }


        // Listen for change event on branch dropdown
        $('#branch_id').change(function() {
            var branchId = $(this).val();
            if (branchId) {
                fetchBatches(branchId); // Fetch batches when branch is selected
            } else {
                $('#batch_id').empty().append('<option selected disabled>Please select batch</option>');
            }
        });
    </script>

    <script>
        // Function to show or hide installment related fields based on the selected payment option
        function toggleInstallmentFields() {
            var paymentOption = document.querySelector('input[name="payment_mode"]:checked').value;
            var installmentFields = document.querySelectorAll('.installment-field');

            if (paymentOption === 'Lumpsum') {
                installmentFields.forEach(function(field) {
                    field.style.display = 'none';
                });
            } else {
                installmentFields.forEach(function(field) {
                    field.style.display = 'block';
                });
            }
        }

        // Add event listener to the radio buttons
        var paymentOptions = document.querySelectorAll('input[name="payment_mode"]');
        paymentOptions.forEach(function(option) {
            option.addEventListener('change', toggleInstallmentFields);
        });

        // Initially hide installment related fields
        toggleInstallmentFields();
    </script>






@endsection
