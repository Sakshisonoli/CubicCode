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

        @if (session('error'))
            <script>
                Swal.fire("{{ session('error') }}");
            </script>
        @endif

        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card profile-card card-bx m-b30">

                        <form class="profile-form"
                            action="{{ route('update_inquiry', ['id' => $inquiryData->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6 m-b30">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ $inquiryData->name }}">
                                    </div>
                                    <div class="col-sm-6 m-b30">
                                        <label class="form-label">Email</label>
                                        <input type="text" name="email" id="email"
                                            value="{{ $inquiryData->email }}" class="form-control">
                                    </div>
                                    <div class="col-sm-6 m-b30">
                                        <label class="form-label">Mobile Number</label>
                                        <input type="text" class="form-control" name="phone" id="phone"
                                            value="{{ $inquiryData->phone }}">
                                    </div>
                                    <div class="col-sm-6 m-b30">
                                        <label class="form-label">Adress</label>
                                        <input type="text" class="form-control" name="address" id="address"
                                            value="{{ $inquiryData->address }}">
                                    </div>

                                    <div class="col-sm-6 m-b30">
                                        <label class="form-label">Lead Date</label>
                                        <input type="date" class="form-control" name="enquiry_date" id="enquiry_date"
                                            value="{{ $inquiryData->enquiry_date }}">
                                    </div>

                                    <div class="col-sm-6 m-b30">
                                        <label class="form-label" for="course_enquiry">Inquiry Course Name<span
                                            class="text-danger">*</span></label>
                                        <select class="default-select style-1 form-control" name="course_enquiry"
                                            id="course_enquiry">
                                            <option data-display="Select">Please select course</option>
                                            @if ($courses)
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->course_name }}" @if ($course->course_name === $inquiryData->course_enquiry)
                                                        {{'selected'}}
                                                    @endif>{{$course->course_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="col-sm-6 m-b30">
                                        <label class="form-label">Gender<span
                                            class="text-danger">*</span></label>
                                        <div class="mb-3 mb-0">
                                            <div class="form-check custom-checkbox form-check-inline">
                                                <input type="radio" class="form-check-input" id="gender" name="gender"
                                                    value="male"
                                                    @if ($inquiryData->gender === 'male') {{ 'checked' }} @endif>
                                                <label class="form-check-label" for="male">Male</label>
                                            </div>
                                            <div class="form-check custom-checkbox form-check-inline">
                                                <input type="radio" class="form-check-input" id="gender" name="gender"
                                                    value="female"
                                                    @if ($inquiryData->gender === 'female') {{ 'checked' }} @endif>
                                                <label class="form-check-label" for="female">Female</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 m-b30">
                                        <label class="form-label" for="followup_status">Lead Status<span
                                                class="text-danger">*</span></label>
                                        <select class="default-select style-1 form-control" name="followup_status"
                                            id="followup_status">
                                            <option data-display="Select">Please select lead status</option>
                                            <option value="On Follow Up">On Follow Up</option>
                                            <option value="Cancelled">Cancelled</option>
                                            <option value="Course Join">Course Join</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6 m-b30">
                                        <label class="form-label" for="interest_level">Lead Interest<span
                                            class="text-danger">*</span></label>
                                        <select class="default-select style-1 form-control" name="interest_level"
                                            id="interest_level" required>
                                            <option data-display="Select">Please select lead interest</option>
                                            <option value="Cold">Cold</option>
                                            <option value="Warm">Warm</option>
                                            <option value="Hot">Hot</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6 m-b30">
                                        <label class="form-label">Next Followup Date<span
                                            class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="followup_date" name="followup_date" value="{{ $inquiryData->followup_date }}">
                                    </div>

                                    <div class="col-sm-12 m-b30">
                                        <label class="form-label">Note</label>
                                        <textarea name="note" id="note" class="form-control">{{ $inquiryData->note }}</textarea>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">UPDATE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
