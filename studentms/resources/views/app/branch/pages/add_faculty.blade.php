@extends('app.branch.layouts.main')

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

        @if (session('error'))
            <script>
                Swal.fire("{{ session('error') }}");
            </script>
        @endif

        {{-- @if (session('errors'))
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <div class="container-fluid">

            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Faculty Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="needs-validation" action="{{ route('branch_store_faculty') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="name">Faculty Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" name="name" class="form-control" id="name"
                                                        placeholder="Enter faculty full name" required>
                                                    <div class="invalid-feedback">
                                                        Please enter faculty name.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="email">Faculty Email
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="email" name="email" class="form-control" id="email"
                                                        placeholder="Enter faculty email id" required>
                                                    <div class="invalid-feedback">
                                                        Please enter faculty email id.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="phone">Faculty Mobile Number
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" name="phone" class="form-control" id="phone"
                                                        placeholder="Enter faculty mobile number" required>
                                                    <div class="invalid-feedback">
                                                        Please enter faculty mobile number.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="address">Faculty Address

                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" name="address" class="form-control" id="address"
                                                        placeholder="Enter student valid address">
                                                    <div class="invalid-feedback">
                                                        Please enter student valid address.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="adhar_number">Gender
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <div class="mb-3 mb-0">
                                                        <div class="form-check custom-checkbox form-check-inline">
                                                            <input type="radio" class="form-check-input" id="gender"
                                                                name="gender" value="male">
                                                            <label class="form-check-label" for="gender">Male</label>
                                                        </div>
                                                        <div class="form-check custom-checkbox form-check-inline">
                                                            <input type="radio" class="form-check-input" id="gender"
                                                                name="gender" value="female">
                                                            <label class="form-check-label" for="gender">Female</label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="adhar_number">Faculty Adhar
                                                    Number

                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" name="adhar_number" class="form-control"
                                                        id="adhar_number" placeholder="Enter faculty valid adhar number">
                                                    <div class="invalid-feedback">
                                                        Please enter faculty valid adhar number.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="birth_date">Faculty DOB
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="date" name="birth_date" class="form-control"
                                                        id="birth_date" required>
                                                    <div class="invalid-feedback">
                                                        Please enter faculty DOB.
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


                                        <div class="col-xl-6">

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="marital_status">Faculty
                                                    Marital Status

                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" name="marital_status" class="form-control"
                                                        id="marital_status" placeholder="Enter faculty marital status">
                                                    <div class="invalid-feedback">
                                                        Please enter faculty marital status.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="education">Faculty
                                                    Education

                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" name="education" class="form-control"
                                                        id="education" placeholder="Enter faculty higher education">
                                                    <div class="invalid-feedback">
                                                        Please enter faculty higher education.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="experience">Faculty Experience
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <select class="default-select wide form-control" name="experience"
                                                        id="experience" required>
                                                        <option selected disabled>Please select experience
                                                        </option>
                                                        <option value="0-1 Year">0-1 Year</option>
                                                        <option value="1-2 Years">1-2 Years</option>
                                                        <option value="2-3 Years">2-3 Years</option>
                                                        <option value="3-4 Years">3-4 Years</option>
                                                        <option value="5-6 Years">5-6 Years</option>
                                                        <option value="7-8 Years">7-8 Years</option>
                                                        <option value="9-10 Years">9-10 Years</option>
                                                        <option value="10-11 Years">10-11 Years</option>
                                                        <option value="12+ Years">12+ Years</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please select a one.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="work_status">Faculty Work
                                                    Status
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <select class="default-select wide form-control" name="work_status"
                                                        id="work_status">
                                                        <option selected disabled>Please select work status
                                                        </option>
                                                        <option value="Full Time">Full Time</option>
                                                        <option value="Part Time">Part Time</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please select a one.
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" name="branch_id" id="branch_id"
                                                value="{{ auth()->user()->id }}">


                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="note">Note

                                                </label>
                                                <div class="col-lg-6">
                                                    <textarea name="note" id="note" class="form-control"></textarea>
                                                    <div class="invalid-feedback">
                                                        Please enter Note.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <div class="col-lg-8 ms-auto">
                                                    <button type="submit" class="btn btn-primary">Add Faculty</button>
                                                </div>
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
@endsection
