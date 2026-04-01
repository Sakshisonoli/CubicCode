<?php

namespace App\Http\Controllers;

use App\Models\Activities;
use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\Inquiry;
use App\Models\Fees;
use App\Models\Attendance;
use App\Models\Notification;
use App\Models\Submission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Dotenv\Validator;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use PDF;

class BranchController extends Controller
{
    public function branchDashboard(){

        $branchId = auth()->user()->id;
        $totalStudents = Student::where('branch_id', $branchId)->count();
        $totalFees = Fees::where('branch_id', $branchId)->sum('amount_paid');
        $pendingFees = Fees::where('branch_id', $branchId)
                        ->where('ins_status', 'due')
                        ->sum('amount_due');
        //Fees::where('branch_id', $branchId)->sum('amount_due');
        $totalInquiries = Inquiry::where('branch_id', $branchId)->count();

        $lastFourMonthsStartDate = Carbon::now()->subMonths(3)->startOfMonth();
        $lastFourMonthsData = [];
        for ($i = 0; $i < 4; $i++) {
            $currentMonthStartDate = $lastFourMonthsStartDate->copy()->addMonths($i);
            $currentMonthEndDate = $currentMonthStartDate->copy()->endOfMonth();

            // Fetch investment and payout data for each month
            $admissions = Student::whereBetween('admission_date', [$currentMonthStartDate, $currentMonthEndDate])->count();
            $inquiries = Inquiry::whereBetween('enquiry_date', [$currentMonthStartDate, $currentMonthEndDate])->count();

            // Store the data in an array
            $lastFourMonthsData[] = [
                'admissions' => $admissions,
                'inquiries' => $inquiries,
            ];
        }

        $lastSixMonthsFees = [];
        $currentMonth = Carbon::now()->startOfMonth();
        for ($i = 0; $i < 6; $i++) {
            $lastSixMonthsFees[$currentMonth->format('M Y')] = Fees::where('branch_id', $branchId)
                ->whereYear('installment_date', $currentMonth->year)
                ->whereMonth('installment_date', $currentMonth->month)
                ->sum('amount_paid');
            $currentMonth->subMonth();
        }

        return view('app.branch.pages.dashboard', compact('totalStudents', 'totalFees', 'pendingFees', 'totalInquiries', 'lastFourMonthsData', 'lastSixMonthsFees'));
    }

    public function branchFaculties(){

        $branchId = auth()->user()->id;
        $faculties = Faculty::where('branch_id', $branchId)->get();

        return view('app.branch.pages.faculties', compact('faculties'));
    }

    public function addBranchFaculty(){

        return view('app.branch.pages.add_faculty');
    }

    public function storeBranchFaculty(Request $request){

        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'nullable',
            'gender' => 'required',
            'adhar_number' => 'nullable',
            'birth_date' => 'nullable',
            'nationality' => 'required',
            'marital_status' => 'nullable',
            'education' => 'nullable',
            'experience' => 'required',
            'work_status' => 'required',
            'branch_id' => 'required',
            'note' => 'nullable',
        ]);

        $requestFaculty = $request->except(['_token']);

        $password = substr(str_replace(' ', '', $request->name), 0, 4) . '@' .
        substr(preg_replace('/[^0-9]/', '', $request->phone), 0, 4);

        $requestFaculty['password'] = Hash::make($password);
        $requestFaculty['status'] = 'active';
        $faculty = Faculty::create($requestFaculty);

        $admin = auth()->user();
        Activities::create([
            'admin_id' => $admin->id,
            'action' =>  'Added a new faculty called ' . $faculty->name,
            'faculty_affected' => $faculty->id,
        ]);

        return redirect()->back()->with('success', 'Faculty added successfully!');
    }

    public function branchStudents(){

        $branchId = auth()->user()->id;
        $students = Student::where('join_status', 'enrolled')->where('branch_id', $branchId)->get();

        foreach($students as $student){

            $totalClasses = Attendance::where('student_id', $student->id)->count();
            $totalPresesnt = Attendance::where('student_id', $student->id)->where('status', 'present')->count();

            if($totalClasses > 0){
                $attendancePercentage = ($totalPresesnt / $totalClasses) * 100;
                // return round($attendancePercentage, 2);
                $student->total_attendance = round($attendancePercentage, 2);
            } else {
                $student->total_attendance = 0;
            }

        }

        return view('app.branch.pages.students', compact('students'));
    }

    public function addBranchStudent(){

        $branchId = auth()->user()->id;
        $batches = Batch::where('branch_id', $branchId)->get();
        $courses = Course::all();

        return view('app.branch.pages.add_student', compact('batches', 'courses'));
    }

    public function storeBranchStudent(Request $request){

        $this->validate($request, [
            'name' => 'required|string|min:3|max:80',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'nullable',
            'gender' => 'required',
            'birth_date' => 'required',
            'nationality' => 'required',
            'admission_date' => 'required',
            'course_id' => 'required',
            'branch_id' => 'required',
            'batch_id' => 'nullable',
            'payment_type' => 'required',
            'note' => 'nullable'
        ]);

        if (Student::where('email', $request->input('email'))->exists()) {
            return redirect()->back()->with('error', 'This email already exists in the student database!');
        }

        $requestStudent = $request->except(['_token']);

        // Generating default password
        $password = substr(str_replace(' ', '', $request->name), 0, 4) . '@' .
        substr(preg_replace('/[^0-9]/', '', $request->phone), 0, 4);

        if($request->input('course_id')){
            $course = Course::findOrFail($request->input('course_id'));
            $courseName = $course->course_name;
        }
        else{
            $courseName = null;
        }

        $requestStudent['join_status'] = 'enrolled';
        $requestStudent['status'] = 'active';
        $requestStudent['password'] = Hash::make($password);
        $requestStudent['enrolled_course'] = $courseName;
        $student = Student::create($requestStudent);

        $fees = new Fees();
        $fees->student_name = $student->name;
        $fees->student_id = $student->id;
        $fees->course_id = $student->course_id;
        $fees->payment_type = $request->input('payment_mode');
        $fees->payment_mode = $request->input('payment_type');
        $fees->course_amount = $request->input('course_amount');
        $fees->branch_id = $request->input('branch_id');
        $fees->paid_to_branch = auth()->user()->branch_name;

        if(!$request->input('amount_paid')){
            $fees->amount_due = null;
            $fees->amount_paid = $request->input('course_amount');
            $fees->ins_status = 'clear';
        } else{
            $fees->amount_due = $request->input('course_amount') - $request->input('amount_paid');
            $fees->amount_paid = $request->input('amount_paid');
            $fees->ins_status = 'due';
            $fees->next_installment_amount = $request->input('course_amount') - $request->input('amount_paid');
            $fees->next_installment_date = Carbon::parse($request->input('admission_date'))->addDays(30);
        }
        $fees->total_installments = $request->input('total_installments');
        $fees->installment_date = $student->admission_date;
        $fees->payment_status = $request->input('payment_status');
        $fees->save();

        if($request->input('inquiry_id')){
            $findData = Inquiry::findOrFail($request->input('inquiry_id'));
            $findData->forceDelete();

            return redirect()->route('branch_inquiries')->with('success', 'Lead admission completed successfully!');
        }

        $admin = auth()->user();
        Activities::create([
            'admin_id' => $admin->id,
            'action' =>  'A new student has been admitted and his/her name is ' . $student->name,
            'student_affected' => $student->id,
        ]);


        return redirect()->back()->with('success', 'Student admission is successful!');
    }

    public function branchBatches(){

        $branchId = auth()->user()->id;
        $batches = Batch::where('branch_id', $branchId)->get();

        return view('app.branch.pages.batches', compact('batches'));
    }

    public function createBranchBatch(){

        $branchId = auth()->user()->id;
        $courses = Course::all();
        $faculties = Faculty::where('branch_id', $branchId)->get();

        return view('app.branch.pages.create_batch', compact('courses', 'faculties'));
    }

    public function branchStoreBatch(Request $request){

        $this->validate($request, [
            'branch_id' => 'required',
            'course_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'nullable',
            'batch_time' => 'required',
            'faculty_id' => 'nullable',
        ]);

        $requestBatch = $request->except(['_token']);

        if($request->input('course_id')){
            $course = Course::findOrFail($request->input('course_id'));
            $courseName = $course->course_name;
        }
        else{
            $courseName = null;
        }

        $requestBatch['course_name'] = $courseName;
        $requestBatch['total_students'] = 0;
        $batch = Batch::create($requestBatch);

        $admin = auth()->user();
        Activities::create([
            'admin_id' => $admin->id,
            'action' =>  'New batch added and the batch name is  ' . $batch->batch_name,
        ]);

        return redirect()->back()->with('success', 'Batch added successfully!');
    }

    public function branchFacultyDetails(Request $request, $id){

        $facultyInfo = Faculty::findOrFail($id);
        return view('app.branch.pages.faculty_details', compact('facultyInfo'));
    }

    public function editBranchFaculty(Request $request, $id){

        $facultyInfo = Faculty::findOrFail($id);
        return view('app.branch.pages.edit_faculty', compact('facultyInfo'));
    }

    public function updateFacultyInfo(Request $request, $id){

        $this->validate($request, [
            'name' => 'required|min:3|max:50|string',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'nullable',
            'gender' => 'required',
            'adhar_number' => 'nullable',
            'birth_date' => 'nullable',
            'nationality' => 'required',
            'marital_status' => 'nullable',
            'education' => 'nullable',
            'experience' => 'required',
            'work_status' => 'required',
            'note' => 'nullable',
        ]);

        $requestUpdates = $request->except(['_token']);

        $faculty = Faculty::findOrFail($id);
        $faculty->update($requestUpdates);

        $admin = auth()->user();
        Activities::create([
            'admin_id' => $admin->id,
            'action' =>  'Faculty details updated and faculty name is ' . $faculty->name,
            'faculty_affected' => $faculty->id,
        ]);

        return redirect()->back()->with('success', 'Faculty information successfully updated!');
    }

    public function updateBranchBatch(Request $request, $id){

        $this->validate($request, [
            'batch_name' => 'required',
            'batch_time' => 'required',
            'start_date' => 'required',
            'end_date' => 'nullable',
            'faculty_id' => 'nullable|numeric',
            'course_id' => 'nullable|numeric'
        ]);

        $batch = Batch::findOrFail($id);
        $batch->batch_name = $request->input('batch_name');
        $batch->batch_time = $request->input('batch_time');
        $batch->start_date = $request->input('start_date');
        $batch->end_date = $request->input('end_date');
        $batch->faculty_id = $request->input('faculty_id');
        $batch->course_id = $request->input('course_id');
        $batch->save();

        $admin = auth()->user();
        Activities::create([
            'admin_id' => $admin->id,
            'action' =>  'Batch details updated and the batch name is ' . $batch->batch_name,
        ]);

        return redirect()->back()->with('success', 'Batch details updated successfully!');
    }

    public function editBranchStudent(Request $request, $id){

        $studentData = Student::findOrFail($id);

        return view('app.branch.pages.edit_student', compact('studentData'));
    }

    public function updateBranchStudent(Request $request, $id){

        $this->validate($request, [
            'name' => 'required|string|min:3|max:80',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'nullable',
            'birth_date' => 'required',
            'adhar_number' => 'nullable',
            'status' => 'required',
            'join_status' => 'required',
            'note' => 'nullable'
        ]);

        $requestUpdates = $request->except(['_token']);

        $updates = Student::findOrFail($id);
        $updates->update($requestUpdates);

        $admin = auth()->user();
        Activities::create([
            'admin_id' => $admin->id,
            'action' =>  'Student details updated and the student name is ' . $updates->name,
            'student_affected' => $updates->id,
        ]);

        return redirect()->back()->with('success', 'Student data updated successfully!');
    }

    public function studentCourseDetails(Request $request, $id){

        $studentData = Student::findOrFail($id);
        $courseFees = Fees::where('student_id', $id)->first();
        return view('app.branch.pages.student_course_details', compact('studentData', 'courseFees'));
    }

    public function studentPaymentsDetails(Request $request, $id){

        $studentData = Student::findOrFail($id);
        $dueAmountData = Fees::where('student_id', $id)->orderBy('created_at', 'desc')->first();
        $courseFees = Fees::where('student_id', $id)->first();

        return view('app.branch.pages.payment_details', compact('studentData', 'dueAmountData', 'courseFees'));
    }

    public function branchInstallmentPayment(Request $request, $id){

        $this->validate($request, [
            'amount_due' => 'required',
            'installment_date' => 'required',
            'amount_paid' => 'required',
            'payment_mode' => 'required',
            // 'next_installment_date' => 'nullable',
            // 'next_installment_amount' => 'nullable'
        ]);

        $requestPayment = $request->except(['_token']);
        $studentData = Student::findOrFail($id);

        $prevFees = Fees::findOrFail($request->input('fees_id'));
        $prevFees->ins_status = 'paid';
        $prevFees->save();

        $requestPayment['student_id'] = $id;
        $requestPayment['student_name'] = $studentData->name;
        $requestPayment['course_id'] = $studentData->course_id;
        $requestPayment['payment_type'] = 'Installment';
        $requestPayment['payment_status'] = 'paid';
        $requestPayment['branch_id'] = $studentData->branch_id;
        $requestPayment['paid_to_branch'] = auth()->user()->branch_name;

        if($request->input('amount_paid') < $request->input('amount_due')){
            $requestPayment['amount_due'] = $request->input('amount_due') - $request->input('amount_paid');
            $requestPayment['ins_status'] = 'due';
        }else{
            $requestPayment['amount_due'] = null;
            $requestPayment['ins_status'] = 'clear';
        }
        Fees::create($requestPayment);

        $admin = auth()->user();
        Activities::create([
            'admin_id' => $admin->id,
            'action' => $studentData->name . "'s" . ' installment paid',
            'student_affected' => $studentData->id,
        ]);

        return redirect()->back()->with('success', 'Installment successfully paid!');
    }

    public function branchFeesPaidStudents()
    {
        $id = auth()->user()->id;
        $students = Fees::where('branch_id', $id)
            ->where(function ($query) {
                $query->where('ins_status', 'clear')
                ->orWhere('ins_status', 'due');
            })->get();

        foreach ($students as $student) {
            $data = Fees::where('branch_id', $id)
                ->where('student_id', $student->student_id)
                ->get();
            $student->total_paid = $data->sum('amount_paid');

            $lastUpdate = Fees::where('branch_id', $id)
            ->where('student_id', $student->student_id)
                ->orderBy('created_at', 'desc')
                ->first();

            if ($lastUpdate) {
                $student->due_fees = $lastUpdate->amount_due ?? 0;
            } else {
                $student->due_fees = 0;
            }
        }

        $totalCourseAmt = Fees::where('branch_id', $id)->sum('course_amount');
        $totalPaidFees = Fees::where('branch_id', $id)->sum('amount_paid');
        $totalDueFees = Fees::where('branch_id', $id)
            ->where('ins_status', 'due')
            ->sum('amount_due');
        $totalEnrolled = Student::where('branch_id', $id)
            ->where('status', 'active')
            ->count();

        return view('app.branch.pages.fees_paid_students', compact('students', 'totalCourseAmt', 'totalPaidFees', 'totalDueFees', 'totalEnrolled'));
    }


    // public function branchFeesPaidStudents(){

    //     $id = auth()->user()->id;
    //     $students = Fees::where('branch_id', $id)->where('ins_status', 'clear')->orWhere('ins_status', 'due')->get();

    //     foreach($students as $student){
    //         $data = Fees::where('branch_id', $id)->where('student_id', $student->student_id)->get();
    //         $student->total_paid = $data->sum('amount_paid');
    //         $lastUpdate = Fees::where('branch_id', $id)->where('student_id', $student->student_id)->orderBy('created_at', 'desc')->first();

    //         if ($lastUpdate->amount_due === null) {
    //             $student->due_fees = $lastUpdate->amount_due;
    //         } else {
    //             $student->due_fees = 0;
    //         }
    //     }

    //     $totalCourseAmt = Fees::where('branch_id', $id)->sum('course_amount');
    //     $totalPaidFees = Fees::where('branch_id', $id)->sum('amount_paid');
    //     $totalDueFees = Fees::where('branch_id', $id)->where('ins_status', 'due')->sum('amount_due');
    //     $totalEnrolled = Student::where('branch_id', $id)->where('status', 'active')->count();

    //     return view('app.branch.pages.fees_paid_students', compact('students', 'totalCourseAmt', 'totalPaidFees', 'totalDueFees', 'totalEnrolled'));
    // }

    public function branchFeesDueStudents(){

        $id = auth()->user()->id;
        $students = fees::where('branch_id', $id)->where('ins_status', 'due')->get();

        foreach($students as $student){
            $data = Fees::where('student_id', $student->student_id)->get();
            $student->total_paid = $data->sum('amount_paid');
        }

        return view('app.branch.pages.fees_due_students', compact('students'));
    }

    public function branchStudentInquiries(){

        $id = auth()->user()->id;
        $inquiries = Inquiry::where('branch_id', $id)->get();
        $courses = Course::all();

        return view('app.branch.pages.inquiries', compact('inquiries', 'courses'));
    }

    public function storeBranchInquiry(Request $request){

        $this->validate($request, [
            'name' => 'required|string|min:3|max:80',
            'email' => 'required|email',
            'phone' => 'required',
            'gender' => 'required',
            'address' => 'nullable',
            'course_enquiry' => 'required',
            'enquiry_date' => 'required',
            'followup_status' => 'required',
            'followup_date' => 'required',
            'interest_level' => 'required',
            'branch_id' => 'required',
            'note' => 'nullable'
        ]);

        $requestInquiry = $request->except(['_token']);

        $requestInquiry['status'] = 'active';
        $lead = Inquiry::create($requestInquiry);

        $admin = auth()->user();
        Activities::create([
            'admin_id' => $admin->id,
            'action' => 'The branch added the lead and the lead name is ' . $lead->name,
        ]);

        return redirect()->back()->with('success', 'Inquiry successfully added!');
    }

    public function branchInquiryToAdmission(Request $request, $id){

        $inquiryData = Inquiry::findOrFail($id);
        $branchId = auth()->user()->id;
        $batches = Batch::where('branch_id', $branchId)->get();
        $courses = Course::all();

        return view('app.branch.pages.inquiry_to_admission', compact('courses', 'batches', 'inquiryData'));
    }

    public function attendanceBatches(){

        $branchId = auth()->user()->id;
        $batches = Batch::where('branch_id', $branchId)->get();

        return view('app.branch.pages.attendance_batches', compact('batches'));
    }

    public function branchBatchDetails(Request $request, $id){

        $branchId = auth()->user()->id;
        $details = Batch::findOrFail($id);
        $students = Student::where('branch_id', $branchId)->where('batch_id', '!=', $details->id)->orWhere('batch_id', null)->get();
        $courses = Course::all();

        return view('app.branch.pages.batch_details', compact('details', 'students', 'courses'));
    }

    public function branchChangeStudentBatch(Request $request){

        $sid = $request->input('sid');
        $student = Student::findOrFail($sid);
        $student->batch_id = $request->input('batch_id');
        $student->save();

        $admin = auth()->user();
        Activities::create([
            'admin_id' => $admin->id,
            'action' => $student->name . "'s" . ' batch changed',
        ]);
        return redirect()->back()->with('success', 'Student added successfully!');
    }

    public function batchStudentsAttendance(Request $request, $id){

        $batchId = $id;
        $batchStudents = Student::where('batch_id', $id)->get();

        foreach($batchStudents as $student){

            $totalClasses = Attendance::where('student_id', $student->id)->count();
            $totalPresesnt = Attendance::where('student_id', $student->id)->where('status', 'present')->count();

            if($totalClasses > 0){
                $attendancePercentage = ($totalPresesnt / $totalClasses) * 100;
                // return round($attendancePercentage, 2);
                $student->total_attendance = round($attendancePercentage, 2);
            } else {
                $student->total_attendance = 0;
            }

        }

        return view('app.branch.pages.attendance', compact('batchStudents', 'batchId'));

    }

    public function branchMarkAttendance(Request $request){

        $this->validate($request, [
            'batch_id' => 'required',
            'date' => 'required'
        ]);

        $batchId = $request->input('batch_id');
        $branchId = auth()->user()->id;
        $attendancedate = $request->input('date');

        $existingData = Attendance::where('batch_id', $batchId)->whereDate('date', $attendancedate)->first();
        if($existingData){
            return redirect()->back()->with('error', 'Attendance of this batch is already given');
        }
        elseif($attendancedate > now()){
            return redirect()->back()->with('error', 'We cannot provide future attendance');
        }

        $attendanceData = $request->except(['_token', 'batch_id']);

        foreach ($attendanceData as $key => $value) {
            // Extract student ID from the input field name
            if (strpos($key, 'attendance_') === 0) {
                $studentId = substr($key, strlen('attendance_'));
            } else {
                continue; // Skip if the key doesn't start with 'attendance_'
            }

            // Extract student name and comment from the input data
            $studentName = $request->input('sname_' . $studentId);
            $comment = $request->input('comment_' . $studentId);

            // Store the attendance record in the database
            Attendance::create([
                'student_id' => $studentId,
                'batch_id' => $batchId,
                'date' => $attendancedate,
                'status' => $value,
                'student_name' => $studentName,
                'branch_id' => $branchId,
                'comment' => $comment,
            ]);
        }

        $batch = Batch::findOrFail($batchId);

        $admin = auth()->user();
        Activities::create([
            'admin_id' => $admin->id,
            'action' => $batch->batch_name . ' Batch added ' . $attendancedate . ' attendance',
        ]);

        return redirect()->route('branch_attendance_batches')->with('success', 'Attendance updated successfully!');
    }

    public function branchSingleStudentAttendance(Request $request, $id){

        $attendanceRecords = Attendance::where('student_id', $id)->get();
        $student = Student::findOrFail($id);

        return view('app.branch.pages.student_attendance', compact('attendanceRecords', 'student'));
    }

    public function branchInquiryDetails($id){

        $details = Inquiry::findOrFail($id);
        return view('app.branch.pages.inquiry-details', compact('details'));
    }

    public function branchHeadOfficeNotifications(){

        $branchId = auth()->user()->id;
        $sentMsgs = Notification::where('branch_id', $branchId)->where('type', 'sent')
            ->where('admin_id',  null)->where('subject', 'toAdmin')->orderBy('created_at', 'desc')->get();
        $receivedMsgs = Notification::where('branch_id', $branchId)->where('type', 'received')->where('student_id', null)
            ->orWhere('branch_id', null)->where('subject', 'toAdmin')->orderBy('created_at', 'desc')->get();

        return view('app.branch.pages.head_office_notifications', compact('sentMsgs', 'receivedMsgs'));
    }

    public function branchStudentsNotifications(){

        $branchId = auth()->user()->id;
        $students = Student::where('branch_id', $branchId)->get();

        $sentMsgs = Notification::where('branch_id', $branchId)->where('type', 'sent')
            ->where('admin_id',  null)->where('subject', 'toStudent')->orderBy('created_at', 'desc')->get();

        $receivedMsgs = Notification::where('branch_id', $branchId)->where('type', 'received')
            ->where('subject', 'fromStudent')->orderBy('created_at', 'desc')->get();

        return view('app.branch.pages.students_notifications', compact('students', 'sentMsgs', 'receivedMsgs'));
    }

    public function branchSendMsgToAdmin(Request $request){

        $this->validate($request, [
            'title' => 'nullable',
            'message' => 'required',
            'branch_id' => 'required',
            'subject' => 'required',
        ]);

        $requestMsg = $request->except(['_token']);
        $requestMsg['type'] = 'sent';
        Notification::create($requestMsg);

        return redirect()->back()->with('success', 'Notifications have been successfully sent to the Head Office!');
    }

    public function branchSendMsgToStudent(Request $request){

        $this->validate($request, [
            'student_id' => 'required',
            'title' => 'nullable',
            'message' => 'required',
            'branch_id' => 'required',
            'subject' => 'required',
        ]);

        $requestMsg = $request->except(['_token']);

        if($request->input('student_id') == 'all'){
            $studentId = null;
        } else {
            $studentId = $request->input('student_id');
        }

        $requestMsg['student_id'] = $studentId;
        $requestMsg['type'] = 'sent';
        Notification::create($requestMsg);

        return redirect()->back()->with('success', 'Notifications have been sent successfully!');
    }

    public function sendAssignment(){

        $branchId = auth()->user()->id;
        $batches = Batch::where('branch_id', $branchId)->get();
        $sentAssignments = Assignment::where('branch_id', $branchId)->get();

        return view('app.branch.pages.send_assignment', compact('batches', 'sentAssignments'));
    }

    public function sendingAssignment(Request $request){

        $this->validate($request, [
            'batch_id' => 'required',
            'project_name' => 'required',
            'project_description' => 'required',
            'branch_id' => 'required',
            'project_doc' => 'nullable',
            'start_date' => 'required',
            'end_date' => 'required',
            'points' => 'nullable',
        ]);

        $requestAssignment = $request->except(['_token']);

        if($request->input('batch_id') == 'toAll'){
            $sendTo = $request->input('batch_id');
            $batchId = null;
        }else{
            $batchId = $request->input('batch_id');
            $sendTo = 'toOne';
        }

        $requestAssignment['send_to'] = $sendTo;
        $requestAssignment['batch_id'] = $batchId;
        Assignment::create($requestAssignment);

        return redirect()->back()->with('success', 'Assignment sent successfully!');
    }

    public function submittedAssignment(){

        $branchId = auth()->user()->id;
        $submittedAsssignments = Submission::where('branch_id', $branchId)->get();

        return view('app.branch.pages.submitted_assignments', compact('submittedAsssignments'));
    }

    public function branchSettings(){

        $branchId = auth()->user()->id;
        $data = User::findOrFail($branchId);

        return view('app.branch.pages.settings', compact('data'));
    }

    public function branchUpdatePersonalInfo(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'id_proof' => 'required'
        ]);

        $requestData = $request->except(['_token']);

        $id = auth()->user()->id;
        $owner = User::findOrFail($id);
        $owner->update($requestData);

        Activities::create([
            'admin_id' => $id,
            'action' => 'Updated own information',
        ]);

        return redirect()->back()->with('success', 'Details successfully updated!');
    }

    public function branchUpdatePassword(Request $request){

        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'password_confirmation' => 'required|same:new_password',
        ]);

        $user = auth()->user();

        if(!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect');
        }
        $owner = User::findOrFail($user->id);
        $requestPass['password'] = Hash::make($request->input('new_password'));
        $owner->update($requestPass);

        Activities::create([
            'admin_id' => $user->id,
            'action' => 'Changed own password',
        ]);

        return redirect()->back()->with('success', 'Password changed successfully!');
    }

    public function deleteLead($id)
    {

        $lead = Inquiry::findOrFail($id);

        $admin = auth()->user();
        Activities::create([
            'admin_id' => $admin->id,
            'action' => 'A lead is deleted and that leads name is ' . $lead->name,
        ]);

        $lead->delete();

        return redirect()->back()->with('success', 'Lead deleted successfully!');
    }

    public function branchEditInquiry($id)
    {

        $inquiryData = Inquiry::findOrFail($id);
        $courses = Course::all();

        return view('app.branch.pages.inquiry_edit', compact('inquiryData', 'courses'));
    }

    public function updateBranchInquiry(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required|string|min:4',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'enquiry_date' => 'required|date',
            'course_enquiry' => 'required',
            'gender' => 'required',
            'followup_status' => 'required',
            'interest_level' => 'required',
            'followup_date' => 'required|date',
            'note' => 'nullable',
        ]);

        $updates = $request->except('_token');

        $lead = Inquiry::findOrFail($id);
        $lead->update($updates);

        $admin = auth()->user();
        Activities::create([
            'admin_id' => $admin->id,
            'action' => 'The lead data is updated and the lead name is ' . $lead->name,
        ]);

        return redirect()->back()->with('success', 'Lead updated successfully!');
    }

    public function branchDeleteBatch($id)
    {

        $batchStudents = Student::where('batch_id', $id)->get();
        foreach ($batchStudents as $student) {
            $student->batch_id = null;
            $student->save();
        }

        $batch = Batch::findOrFail($id);

        if ($batch->student->count() > 0) {
            return redirect()->back()->with('error', 'Please shift the students of this batch to another batch!');
        }

        $batch->delete();

        return redirect()->back()->with('success', 'Batch deleted successfully!');
    }

    public function exportLeadsCsv()
    {

        $branchId = auth()->user()->id;
        $leads = Inquiry::where('branch_id', $branchId)->get();

        if ($leads->count() < 1) {
            return redirect()->back()->with('error', 'Data not found!');
        }

        // Prepare data with custom structure (adjust column names and accessors as needed)
        $data = $leads->map(function ($lead) {
            return [
                'Name' => $lead->name,
                'Email' => $lead->email,
                'Mobile No.' => $lead->address,
                'Gender' => $lead->gender,
                'Inquiry Date' => $lead->enquiry_date,
                'Inquiry Course' => $lead->course_enquiry,
                'Interest Level' => $lead->interest_level,
                'Followup Status' => $lead->followup_status,
                'Followup Date' => $lead->followup_date,
                'Note' => $lead->note,
            ];
        })->toArray();

        return $this->createCsvResponse($data);
    }

    private function createCsvResponse($data)
    {

        $filename = 'cleancode-leads.csv';
        // Open file for writing
        $csv = fopen($filename, 'w');

        // Write custom headers in desired order
        fputcsv($csv, array_keys($data[0]));

        // write data to csv
        foreach ($data as $row) {
            fputcsv($csv, $row);
        }

        fclose($csv);

        return response()->download($filename,  'cleancode-leads.csv', [
            'Content-Type' => 'text/csv'
        ]);
    }



    public function getStudentClearBill($id)
    {

        $studentData = Fees::where('student_id', $id)->where('ins_status', 'clear')->first();

        if (!$studentData) {
            return redirect()->back()->with('error', 'Payment is not clear yet');
        }

        $paidAmt = $studentData->amount_paid;
        $dueAmt = $studentData->amount_due;

        $gstPercentage = 18 / 100;
        $tax = $paidAmt * $gstPercentage;
        $taxableAmt = $paidAmt - $tax;
        $cgst = $tax / 2;
        $sgst = $tax / 2;

        $pdf = PDF::loadView('invoices.student_invoice_admin', [
            'studentData' => $studentData,
            'paidAmt' => $paidAmt,
            'dueAmt' => $dueAmt,
            'tax' => $tax,
            'taxableAmt' => $taxableAmt,
            'cgst' => $cgst,
            'sgst' => $sgst
        ]);

        $pdf->setPaper('A4', 'letter');
        $filename = 'student_invoice_' . $id . '.pdf';

        return $pdf->download($filename);
    }

    public function getStudentDueBill($id)
    {

        $studentData = Fees::where('student_id', $id)->where('ins_status', 'due')->first();

        if (!$studentData) {
            return redirect()->back()->with('error', 'Due payment not found Please check clear or previous payment');
        }

        $paidAmt = $studentData->amount_paid;
        $dueAmt = $studentData->amount_due;

        $gstPercentage = 18 / 100;
        $tax = $paidAmt * $gstPercentage;
        $taxableAmt = $paidAmt - $tax;
        $cgst = $tax / 2;
        $sgst = $tax / 2;

        $pdf = PDF::loadView('invoices.student_invoice_admin', [
            'studentData' => $studentData,
            'paidAmt' => $paidAmt,
            'dueAmt' => $dueAmt,
            'tax' => $tax,
            'taxableAmt' => $taxableAmt,
            'cgst' => $cgst,
            'sgst' => $sgst
        ]);

        $pdf->setPaper('A4', 'letter');
        $filename = 'student_invoice_' . $id . '.pdf';

        return $pdf->download($filename);
    }

    public function getStudentPaidBill($id)
    {

        $studentData = Fees::where('student_id', $id)->where('ins_status', 'paid')->first();

        if (!$studentData) {
            return redirect()->back()->with('error', 'Prev payment not found Please check clear or due payment');
        }

        $paidAmt = $studentData->amount_paid;
        $dueAmt = $studentData->amount_due;

        $gstPercentage = 18 / 100;
        $tax = $paidAmt * $gstPercentage;
        $taxableAmt = $paidAmt - $tax;
        $cgst = $tax / 2;
        $sgst = $tax / 2;

        $pdf = PDF::loadView('invoices.student_invoice_admin', [
            'studentData' => $studentData,
            'paidAmt' => $paidAmt,
            'dueAmt' => $dueAmt,
            'tax' => $tax,
            'taxableAmt' => $taxableAmt,
            'cgst' => $cgst,
            'sgst' => $sgst
        ]);

        $pdf->setPaper('A4', 'letter');
        $filename = 'student_invoice_' . $id . '.pdf';

        return $pdf->download($filename);
    }

    public function getOwnBranchBill(Request $request)
    {

        $selectedMonth = $request->input('month');
        $selectedYear = $request->input('year');

        $id = auth()->user()->id;

        $branchData = User::findOrFail($id);

        $partner = Fees::where('branch_id', $id)->whereYear('installment_date', $selectedYear)
            ->whereMonth('installment_date', $selectedMonth)
            ->get();

        $totalPaid = $partner->sum('amount_paid');
        $totalDue = Fees::where('branch_id', $id)->whereYear('installment_date', $selectedYear)
            ->whereMonth('installment_date', $selectedMonth)->where('ins_status', 'due')->sum('amount_due');

        $gstPercentage = 18 / 100;
        $tax = $totalPaid * $gstPercentage;
        $taxableAmt = $totalPaid - $tax;
        $cgst = $tax / 2;
        $sgst = $tax / 2;

        $pdf = PDF::loadView('invoices.partner_invoice_admin', [
            'branchData' => $branchData,
            'totalPaid' => $totalPaid,
            'totalDue' => $totalDue,
            'tax' => $tax,
            'taxableAmt' => $taxableAmt,
            'cgst' => $cgst,
            'sgst' => $sgst
        ]);

        $pdf->setPaper('A4', 'letter');
        $filename = 'channel_partner_invoice_' . $id . '.pdf';

        return $pdf->download($filename);
    }

    public function branchMonthlyStatements()
    {

        $branchId = auth()->user()->id;

        $dates = Fees::where('branch_id', $branchId)->pluck('installment_date')->unique();
        $monthsData = [];

        foreach ($dates as $date) {
            $date = Carbon::parse($date);
            $data = Fees::where('branch_id', $branchId)->where('installment_date', $date)->get();

            $monthCollection = $data->sum('amount_paid');
            $tech_comm = 20.82 / 100;
            $totalTechFees = ($monthCollection * $tech_comm);

            // Store data for each date separately
            $monthsData[$date->format('Y-m')] = [
                'month_collection' => $monthCollection,
                'tech_fees' => $totalTechFees,
                'branch_fees' => $monthCollection - $totalTechFees
            ];
        }

        return view('app.branch.pages.monthly-statements', compact('monthsData'));
    }

    public function cleancodeCourses()
    {

        $courses = Course::all();
        return view('app.branch.pages.courses', compact('courses'));
    }


}
