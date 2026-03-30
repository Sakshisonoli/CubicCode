<?php

namespace App\Http\Controllers;

use App\Models\Activities;
use App\Models\Assignment;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\Inquiry;
use App\Models\Fees;
use App\Models\Notification;
use App\Models\Submission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Dotenv\Validator;
use Carbon\Carbon;
use PDF;

class AdminController extends Controller
{

    public function adminDashboard(){

        $totalStudents = Student::all()->count();
        $totalFees = Fees::all()->sum('amount_paid');
        $pendingFees = Fees::all()->sum('amount_due');
        $totalInquiries = Inquiry::all()->count();

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
            $lastSixMonthsFees[$currentMonth->format('M Y')] = Fees::whereYear('installment_date', $currentMonth->year)
                ->whereMonth('installment_date', $currentMonth->month)
                ->sum('amount_paid');
            $currentMonth->subMonth();
        }

        return view('app.admin.pages.dashboard', compact('totalStudents', 'totalFees', 'pendingFees', 'totalInquiries', 'lastFourMonthsData', 'lastSixMonthsFees'));
    }

    public function channelPartners(){

        $partners = User::where('role_position', 'branch')->get();
        return view('app.admin.pages.channel_partners', compact('partners'));
    }

    public function addChannelPartnerForm(){
        return view('app.admin.pages.add_channel_partner');
    }

    public function storeChannelPartner(Request $request){

        $this->validate($request, [
            'name' => 'required|string|min:2|max:50',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]+$/',
                // The regex enforces the following criteria:
                // At least one uppercase letter
                // At least one lowercase letter
                // At least one digit
                // At least one special character ($@$!%*?&)
            ],
            'branch_name' => 'required',
            'location' => 'nullable',
            'id_proof' => 'nullable',
            'gst_num' => 'nullable',
        ]);

        $requestPartner = $request->except(['_token']);

        $requestPartner['password'] = Hash::make($request->input('password'));
        $requestPartner['status'] = 'active';
        $requestPartner['role_position'] = 'branch';
        $requestPartner['admin_role'] = 'super';

        $branch = User::create($requestPartner);

        $admin = auth()->user();
        Activities::create([
            'admin_id' => $admin->id,
            'action' =>  'A new channel partner has been added and his/her name is ' . $branch->name,
        ]);

        return redirect()->back()->with('success', 'Channel partner successfully added!');

    }

    public function editChannelPartner(Request $request, $id){

        $partnerData = User::findOrFail($id);

        return view('app.admin.pages.edit_channel_partner', compact('partnerData'));
    }

    public function updatePartner(Request $request, $id){

        $this->validate($request, [
            'name' => 'required|string|min:3|max:60',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'branch_name' => 'required',
            'location' => 'required',
            'id_proof' => 'nullable'
        ]);

        $requestUpdates = $request->except(['_token']);

        $partner = User::findOrFail($id);
        $partner->update($requestUpdates);

        $admin = auth()->user();
        Activities::create([
            'admin_id' => $admin->id,
            'action' =>  'Channel partner information has been updated and his/her name is ' . $partner->name,
        ]);

        return redirect()->back()->with('success', 'Channel partner updated successfully!');
    }

    public function updatePartnerPassword(Request $request, $id){

        $this->validate($request, [
            'password' => 'required|confirmed'
        ]);

        $partner = User::findOrFail($id);
        $partner->password = Hash::make($request->input('password'));
        $partner->save();

        $admin = auth()->user();
        Activities::create([
            'admin_id' => $admin->id,
            'action' =>  'Channel partner password has been updated and his/her name is ' . $partner->name,
        ]);

        return redirect()->back()->with('success', 'Partner password successfully updated!');
    }

    public function batches(){

        $batches = Batch::all();
        return view('app.admin.pages.batches', compact('batches'));
    }

    public function createNewBatch(){

        $branches = User::all()->unique('branch_name');
        $courses = Course::all();
        $faculties = Faculty::all();

        return view('app.admin.pages.create_new_batch', compact('branches', 'courses', 'faculties'));
    }

    public function storeBatch(Request $request){

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
            'action' =>  'Create a new batch and batch name is ' . $batch->batch_name . ' and time is ' . $batch->batch_time,
        ]);

        return redirect()->back()->with('success', 'Batch added successfully!');
    }

    public function students(Request $request, $id){

        $students = Student::where('join_status', 'enrolled')->where('branch_id', $id)->get();
        $branchName = User::findOrFail($id);

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

        return view('app.admin.pages.students', compact('students', 'branchName'));
    }

    public function branchStudents(){

        $branches = User::where('role_position', 'branch')->get();

        return view('app.admin.pages.branch_students', compact('branches'));
    }

    public function addStudents(){

        $courses = Course::all();
        $branches = User::all()->unique('branch_name');

        return view('app.admin.pages.add_new_student', compact('courses', 'branches'));
    }

    public function getBatches(Request $request, $branchId){

        $batches = Batch::where('branch_id', $branchId)->get();
        return response()->json($batches);
    }

    public function storeStudent(Request $request){

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
            'profile' => 'nullable',
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

        // $lastId = Student::max('id');
        // $studentId = 'CC001111' . ($lastId + 1);

        $requestStudent['join_status'] = 'enrolled';
        $requestStudent['status'] = 'active';
        $requestStudent['password'] = Hash::make($password);
        $requestStudent['enrolled_course'] = $courseName;
        $student = Student::create($requestStudent);

        $batch = Batch::findOrFail($request->input('batch_id'));
        $batch->total_students = + 1;
        $batch->save();

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

            $admin = auth()->user();
            Activities::create([
                'admin_id' => $admin->id,
                'action' =>  'A new student is admitted from the lead table and his/her name is ' . $student->name,
                'student_affected' => $student->id,
            ]);

            return redirect()->route('student_inquiries')->with('success', 'Inquiry admission successful!');
        }

        $admin = auth()->user();
        Activities::create([
            'admin_id' => $admin->id,
            'action' =>  'A new student has been admitted and his/her name is ' . $student->name,
            'student_affected' => $student->id,
        ]);

        return redirect()->back()->with('success', 'Student admission is successful!');
    }

    public function studentInquiries(){

        $inquiries = Inquiry::all();
        $courses = Course::all();
        $branches = User::where('role_position', 'branch')->get();

        return view('app.admin.pages.enquiries', compact('inquiries', 'courses', 'branches'));
    }

    public function storeInquiry(Request $request){

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
        $lead =  Inquiry::create($requestInquiry);

        $admin = auth()->user();
        Activities::create([
            'admin_id' => $admin->id,
            'action' =>  'A new Lead has been added and his/her name is ' . $lead->name,
        ]);

        return redirect()->back()->with('success', 'Inquiry successfully added!');
    }

    public function faculties(){

        $faculties = Faculty::all();
        return view('app.admin.pages.faculties', compact('faculties'));
    }

    public function addFaculty(){

        $branches = User::all()->unique('branch_name');
        return view('app.admin.pages.add_faculty', compact('branches'));
    }

    public function storeFaculty(Request $request){

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

    public function courses(){

        $courses = Course::all();
        return view('app.admin.pages.courses', compact('courses'));
    }

    public function storeCourse(Request $request){

        $this->validate($request, [
            'course_name' => 'required',
            'duration' => 'required',
            'fees' => 'required',
            'teaching_mode' => 'required',
            'doc_link' => 'nullable',
            'max_fees' => 'nullable',
            'tech_fees_payable' => 'nullable',
            'tech_fees_percentage' => 'nullable',
            'note' => 'nullable'
        ]);

        $requestCourse = $request->except(['_token']);
        $requestCourse['status'] = 'active';
        $course =  Course::create($requestCourse);

        $admin = auth()->user();
        Activities::create([
            'admin_id' => $admin->id,
            'action' =>  'A new course is added and the course name is ' . $course->name,
        ]);

        return redirect()->back()->with('success', 'Course added successfully!');
    }

    public function editStudent(Request $request, $id){

        $studentData = Student::findOrFail($id);

        return view('app.admin.pages.edit_student', compact('studentData'));
    }

    public function updateStudent(Request $request, $id){

        $this->validate($request, [
            'name' => 'required|string|min:3|max:80',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'nullable',
            'birth_date' => 'required',
            'adhar_number' => 'nullable',
            'status' => 'required',
            'join_status' => 'required',
            'gender' => 'required',
            'note' => 'nullable'
        ]);

        $requestUpdates = $request->except(['_token']);

        $updates = Student::findOrFail($id);
        $updates->update($requestUpdates);

        $admin = auth()->user();
        Activities::create([
            'admin_id' => $admin->id,
            'action' =>  'Student details updated and the student name is ' . $updates->name,
        ]);

        return redirect()->back()->with('success', 'Student data updated successfully!');
    }

    public function duePayments(Request $request, $id){

        $studentData = Student::findOrFail($id);
        $dueAmountData = Fees::where('student_id', $id)->orderBy('created_at', 'desc')->first();
        $courseFees = Fees::where('student_id', $id)->first();

        return view('app.admin.pages.due_payments', compact('studentData', 'dueAmountData', 'courseFees'));
    }

    public function courseDetails(Request $request, $id){

        $studentData = Student::findOrFail($id);
        $courseFees = Fees::where('student_id', $id)->first();
        return view('app.admin.pages.course_details', compact('studentData', 'courseFees'));
    }

    public function installmentPayment(Request $request, $id){

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

    public function updatePaymentDetails(Request $request, $id)
    {

        $this->validate($request, [
            'installment_date' => 'required',
            'amount_paid' => 'required',
            'amount_due' => 'nullable',
            'next_installment_date' => 'nullable',
            'next_installment_amount' => 'nullable'
        ]);

        $requestUpdates = $request->except(['_token']);

        $fees = Fees::findOrFail($id);

        if ($request->input('amount_due')) {
            $requestUpdates['amount_due'] = $request->input('amount_due') - $request->input('amount_paid');
            $requestUpdates['ins_status'] = 'due';
            $requestUpdates['payment_type'] = 'Installments';
        }

        $fees->update($requestUpdates);

        return redirect()->back()->with('success', 'Payment details successfully updated!');
    }

    public function alumni(){

        $alumni = Student::where('join_status', 'alumni')->get();
        return view('app.admin.pages.alumni', compact('alumni'));
    }

    public function batchDetails(Request $request, $id){

        $details = Batch::findOrFail($id);
        $students = Student::where('batch_id', '!=', $details->id)->get();
        $courses = Course::all();

        return view('app.admin.pages.batch_details', compact('details', 'students', 'courses'));
    }

    public function updateStudentBatch(Request $request){

        $sid = $request->input('sid');
        $student = Student::findOrFail($sid);
        $student->batch_id = $request->input('batch_id');
        $student->save();

        $admin = auth()->user();
        Activities::create([
            'admin_id' => $admin->id,
            'action' => $student->name . "'s" . ' batch changed',
            'student_affected' => $student->id,
        ]);

        return redirect()->back()->with('success', 'Student added successfully!');
    }

    public function updateBatchDetails(Request $request, $id){

        $batch = Batch::findOrFail($id);
        $batch->batch_name = $request->input('batch_name');
        $batch->batch_time = $request->input('batch_time');
        $batch->faculty_id = $request->input('faculty_id');
        $batch->save();

        $admin = auth()->user();
        Activities::create([
            'admin_id' => $admin->id,
            'action' => 'Batch details updated and the batch name is ' . $batch->batch_name,
        ]);

        return redirect()->back()->with('success', 'Batch details updated successfully!');
    }

    public function studentsFees(){

        $totalCourseAmt = Fees::all()->sum('course_amount');
        $totalPaidFees = Fees::all()->sum('amount_paid');
        $totalDueFees = $totalCourseAmt - $totalPaidFees;
        $totalEnrolled = Student::where('join_status', 'enrolled')->count();
        $branches = User::where('role_position', 'branch')->get();

        return view('app.admin.pages.students_fees', compact('totalPaidFees', 'totalCourseAmt', 'totalDueFees', 'totalEnrolled', 'branches'));
    }

    public function feesPaidStudents(Request $request, $id){

        $students = fees::where('branch_id', $id)->where('ins_status', 'clear')->get();
        $branchName = User::findOrFail($id);

        return view('app.admin.pages.fees_paid_students', compact('students', 'branchName'));
    }

    public function feesPendingStudents(Request $request, $id){

        $students = fees::where('branch_id', $id)->where('ins_status', 'due')->get();
        $branchName = User::findOrFail($id);

        return view('app.admin.pages.fees_pending_students', compact('students', 'branchName'));
    }

    public function inquiryToAdmission(Request $request, $id){

        $inquiryData = Inquiry::findOrFail($id);
        $courses = Course::all();
        $branches = User::all()->unique('branch_name');

        return view('app.admin.pages.inquiry_to_admission', compact('courses', 'branches', 'inquiryData'));
    }

    public function branchNotifications(){

        $adminId = auth()->user()->id;
        $notifications = Notification::where('type', 'sent')->where('subject', 'toAdmin')->orderBy('created_at', 'desc')->get();
        $branches = User::where('role_position', 'branch')->where('status', 'active')->get();
        $sentNotifications = Notification::where('admin_id',  $adminId)->orWhere('branch_id', null)->where('type', 'sent')->where('admin_id',  null)->where('subject', 'toStudent')->orderBy('created_at', 'desc')->get();

        return view('app.admin.pages.branch_notifications', compact('notifications', 'branches', 'sentNotifications'));
    }

    public function sendNotificationToBranches(Request $request){

        $this->validate($request, [
            'branch_id' => 'required',
            'title' => 'nullable',
            'message' => 'required',
            'admin_id' => 'required',
            'subject' => 'required',
        ]);

        $requestNotification = $request->except(['_token']);

        if($request->input('branch_id') == 'all'){
            $branchId = null;
        } else {
            $branchId = $request->input('branch_id');
        }

        $requestNotification['branch_id'] = $branchId;
        $requestNotification['type'] = 'received';
        Notification::create($requestNotification);

        return redirect()->back()->with('success', 'Notification have been sent successfully!');
    }

    public function studentNotifications(){

        $adminId = auth()->user()->id;
        $notifications = Notification::where('type', 'received')->where('subject', 'fromStudent')->orderBy('created_at', 'desc')->get();
        $students = Student::where('join_status', 'enrolled')->get();

        $sentNotifications = Notification::where('subject', 'toStudent')->orderBy('created_at', 'desc')->get();

        return view('app.admin.pages.students_notifications', compact('notifications', 'students', 'sentNotifications'));
    }

    public function sendNotificationToStudent(Request $request){

        $this->validate($request, [
            'student_id' => 'required',
            'title' => 'nullable',
            'message' => 'required',
            'admin_id' => 'required',
            'subject' => 'required',
        ]);

        $requestNotification = $request->except(['_token']);

        if($request->input('student_id') == 'all'){
            $studentId = null;
        } else {
            $studentId = $request->input('student_id');
        }

        $requestNotification['student_id'] = $studentId;
        $requestNotification['type'] = 'sent';
        Notification::create($requestNotification);

        return redirect()->back()->with('success', 'Notifications have been sent successfully!');

    }

    public function branchBatches($id){

        $batches = Batch::where('branch_id', $id)->get();
        return view('app.admin.pages.branch_batches', compact('batches'));
    }

    public function branchFaculties($id){

        $faculties = Faculty::where('branch_id', $id)->get();
        return view('app.admin.pages.branch_faculties', compact('faculties'));
    }

    public function facultyInfo($id){

        $facultyInfo = Faculty::findOrFail($id);
        return view('app.admin.pages.faculty_info', compact('facultyInfo'));
    }

    public function editFaculty($id){

        $facultyInfo = Faculty::findOrFail($id);
        return view('app.admin.pages.faculty_edit', compact('facultyInfo'));
    }

    public function updateFaculty(Request $request, $id){

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

        return redirect()->back()->with('success', 'Faculty information successfully updated!');
    }

    public function branchInquiries($id){

        $branchId = $id;
        $inquiries = Inquiry::where('branch_id', $id)->get();
        $courses = Course::all();
        $branches = User::where('role_position', 'branch')->get();

        return view('app.admin.pages.branch_inquiries', compact('inquiries', 'branchId', 'courses', 'branches'));
    }

    public function assignments(){

        $sentAssignments = Assignment::all();
        $submittedAsssignments = Submission::all();

        return view('app.admin.pages.assignments', compact('sentAssignments', 'submittedAsssignments'));
    }

    public function viewAttendance($id){

        $attendanceRecords = Attendance::where('student_id', $id)->get();
        $student = Student::findOrFail($id);

        return view('app.admin.pages.student_attendance', compact('attendanceRecords', 'student'));
    }

    public function inquiryDetails($id){

        $details = Inquiry::findOrFail($id);

        return view('app.admin.pages.inquiry_details', compact('details'));
    }

    public function updateCourse(Request $request, $id){

        $this->validate($request, [
            'course_name' => 'required',
            'duration' => 'required',
            'fees' => 'required',
            'teaching_mode' => 'required',
            'doc_link' => 'nullable',
            'max_fees' => 'nullable',
            'tech_fees_payable' => 'nullable',
            'tech_fees_percentage' => 'nullable',
            'note' => 'nullable'
        ]);

        $requestUpdates = $request->except(['_token']);
        $course = Course::findOrFail($id);
        $course->update($requestUpdates);

        $admin = auth()->user();
        Activities::create([
            'admin_id' => $admin->id,
            'action' => 'The course details are updated and the course name is ' . $course->course_name,
        ]);

        return redirect()->back()->with('success', 'Course updated successfully!');
    }

    public function deleteCourse($id){

        $findCourse = Course::findOrFail($id);

        $admin = auth()->user();
        Activities::create([
            'admin_id' => $admin->id,
            'action' => 'Deleted the course and the course name was Python ' . $findCourse->course_name,
        ]);

        $findCourse->delete();

        return redirect()->back()->with('success', 'Course deleted successfully!');
    }

    public function adminSettings(){

        $id = auth()->user()->id;
        $adminData = User::findOrFail($id);

        return view('app.admin.pages.admin_settings', compact('adminData'));
    }

    public function updateAdminInfo(Request $request, $id){

        $this->validate($request, [
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'phone' => 'required',
            'branch_name' => 'required',
            'location' => 'nullable',
            'id_proof' => 'nullable'
        ]);

        $requestUpdates = $request->except(['_token']);

        $admin = User::findOrFail($id);
        $admin->update($requestUpdates);

        $admin = auth()->user();
        Activities::create([
            'admin_id' => $admin->id,
            'action' => 'Updated own Information',
        ]);

        return redirect()->back()->with('success', 'Data updated successfully!');
    }

    public function changeAdminPassword(Request $request, $id){

        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'password_confirmation' => 'required|same:new_password',
        ]);

        $user = User::findOrFail($id);

        if(!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect');
        }
        $owner = User::findOrFail($user->id);
        $requestPass['password'] = Hash::make($request->input('new_password'));
        $owner->update($requestPass);

        $admin = auth()->user();
        Activities::create([
            'admin_id' => $admin->id,
            'action' => 'Updated own password',
        ]);

        return redirect()->back()->with('success', 'Password changed successfully!');
    }

    public function editBranchInquiry($id)
    {

        $inquiryData = Inquiry::findOrFail($id);
        $courses = Course::all();

        return view('app.admin.pages.edit_inquiry', compact('inquiryData', 'courses'));
    }

    public function updateInquiry(Request $request, $id)
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

    public function deleteBranchLead($id)
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

    public function exportBranchLeadsCsv($id)
    {

        $leads = Inquiry::where('branch_id', $id)->get();

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

    public function exportLeads()
    {

        $leads = Inquiry::all();

        if ($leads->count() < 1) {
            return redirect()->back()->with('error', 'Data not found!');
        }

        // Prepare data with custom structure (adjust column names and accessors as needed)
        $data = $leads->map(function ($lead) {
            return [
                'Name' => $lead->name,
                'Email' => $lead->email,
                'Mobile No.' => $lead->phone,
                'Gender' => $lead->gender,
                'Inquiry Date' => $lead->enquiry_date,
                'Inquiry Course' => $lead->course_enquiry,
                'Interest Level' => $lead->interest_level,
                'Followup Status' => $lead->followup_status,
                'Followup Date' => $lead->followup_date,
                'Note' => $lead->note,
            ];
        })->toArray();

        return $this->createLeadsCsvResponse($data);
    }

    private function createLeadsCsvResponse($data)
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

    public function deleteBatch($id)
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

    public function adminsActivities()
    {

        $activities = Activities::orderBy('created_at', 'desc')->get();
        return view('app.admin.pages.activities', compact('activities'));
    }

    public function adminsRoom()
    {

        $admins = User::where('role_position', 'admin')->get();
        return view('app.admin.pages.admins_room', compact('admins'));
    }

    public function addNewAdmin(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string|min:3|max:40',
            'email' => 'required|email',
            'phone' => 'required',
            'admin_role' => 'required',
            'branch_name' => 'required',
            'location' => 'required',
            'role_position' => 'required',
            'status' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        $requestData = $request->except(['_token']);

        $requestData['password'] = Hash::make($request->input('password'));
        $newhandler = User::create($requestData);

        Activities::create([
            'admin_id' => auth()->user()->id,
            'action' => 'A new admin has been added and his/her name is ' . $newhandler->name,
        ]);

        return redirect()->back()->with('success', 'A new admin has been successfully added!');
    }

    public function deleteAdmin($id)
    {

        $findAdmin = User::findOrFail($id);

        $admin = auth()->user();
        Activities::create([
            'admin_id' => $admin->id,
            'action' => 'Admin deleted and Admin name was ' . $findAdmin->name,
        ]);
        $findAdmin->delete();

        return redirect()->back()->with('success', 'Admin successfully deleted!');
    }

    public function deleteStudent($id)
    {

        $student = Student::findOrFail($id);
        Activities::create([
            'admin_id' => auth()->user()->id,
            'action' => 'The student and all student data has been deleted and student name is ' . $student->name,
            'student_affected' => $student->id,
        ]);
        $student->delete();

        return redirect()->back()->with('success', 'The student and all their data has been deleted!');
    }

    public function paidUnpaidAllStudents($id)
    {

        // $students = Fees::where('branch_id', $id)->where('ins_status', 'clear')->orWhere('ins_status', 'due')->get();

        // foreach ($students as $student) {
        //     $branchStudent = Fees::where('student_id', $student->student_id)->get();

        //     $student->paid_fees = $branchStudent->sum('amount_paid');
        //     $lastUpdate = Fees::where('student_id', $student->student_id)->orderBy('created_at', 'desc')->first();

        //     if ($lastUpdate->amount_due !== null) {
        //         $student->due_fees = $lastUpdate->amount_due;
        //     } else {
        //         $student->due_fees = 0;
        //     }
        // }

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

        return view('app.admin.pages.paid_unpaid_students', compact('students'));
    }

    public function monthlyStatements(Request $request)
    {

        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');

        $selectedMonth = $request->input('month', $currentMonth);
        $selectedYear = $request->input('year', $currentYear);

        $branches = User::where('role_position', 'branch')->get();
        foreach ($branches as $branch) {

            $collection = Fees::where('branch_id', $branch->id)->whereYear('installment_date', $selectedYear)
                ->whereMonth('installment_date', $selectedMonth)
                ->get();

            $monthCollection = $collection->sum('amount_paid');
            $tech_comm = 20.82 / 100;
            $totalTechFees = ($monthCollection * $tech_comm);

            $branch->month_collection = $monthCollection;
            $branch->tech_fees = $totalTechFees;
            $branch->branch_fees = $monthCollection - $totalTechFees;
            $branch->fees_status = Fees::where('branch_id', $branch->id)->whereYear('installment_date', $selectedYear)
                ->whereMonth('installment_date', $selectedMonth)->first();
        }

        return view('app.admin.pages.branch_monthly_statements', compact('branches', 'selectedMonth', 'selectedYear'));
    }

    public function exportMonthlyCollection(Request $request)
    {

        $selectedMonth = $request->input('month');
        $selectedYear = $request->input('year');

        $branches = User::where('role_position', 'branch')->get();

        // Prepare data with custom structure (adjust column names and accessors as needed)
        $data = $branches->map(function ($branch) use ($selectedMonth, $selectedYear) {

            $collection = Fees::where('branch_id', $branch->id)
                ->whereYear('installment_date', $selectedYear)
                ->whereMonth('installment_date', $selectedMonth)
                ->get();

            $monthCollection = $collection->sum('amount_paid');
            $tech_comm = 20.82 / 100;
            $totalTechFees = $monthCollection * $tech_comm;
            $branchFees = $monthCollection - $totalTechFees;

            return [
                'Branch ID' => $branch->id,
                'Branch Name' => $branch->branch_name,
                'Total Collection' => $monthCollection,
                'Technical Fees' => $totalTechFees,
                'Branch Fees' => $branchFees,
            ];
        })->toArray();


        return $this->createMonthlyCollectionCsvResponse($data);
    }

    private function createMonthlyCollectionCsvResponse($data)
    {

        $filename = 'monthly-collection.csv';
        // Open file for writing
        $csv = fopen($filename, 'w');

        // Write custom headers in desired order
        fputcsv($csv, array_keys($data[0]));

        // write data to csv
        foreach ($data as $row) {
            fputcsv($csv, $row);
        }

        fclose($csv);

        return response()->download($filename,  'monthly-collection.csv', [
            'Content-Type' => 'text/csv'
        ]);
    }

    public function getStudentBill($id)
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

    public function getStudentSecondBill($id)
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

    public function getStudentThirdBill($id)
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

    public function getPartnerBill(Request $request, $id)
    {

        $selectedMonth = $request->input('month');
        $selectedYear = $request->input('year');

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

    public function importLeads(Request $request)
    {

        $request->validate([
            'csv_file' => 'required|mimes:csv,txt',
        ]);

        if ($request->hasFile('csv_file')) {
            $file = $request->file('csv_file');
            $path = $file->getRealPath();

            $data = array_map('str_getcsv', file($path));
            $header = array_shift($data);

            $leads = [];
            foreach ($data as $row) {

                $enquiryDate = Carbon::createFromFormat('d-m-Y', $row[4])->format('Y-m-d');
                $followupDate = Carbon::createFromFormat('d-m-Y', $row[8])->format('Y-m-d');

                $leads[] = [
                    'name' => $row[0],
                    'email' => $row[1],
                    'phone' => $row[2],
                    'gender' => $row[3],
                    'enquiry_date' => $enquiryDate,
                    'course_enquiry' => $row[5],
                    'interest_level' => $row[6],
                    'followup_status' => $row[7],
                    'followup_date' => $followupDate,
                    'note' => $row[9],
                ];
            }

            Inquiry::insert($leads);

            return redirect()->back()->with('success', 'Leads imported successfully!');
        } else {
            return redirect()->back()->with('error', 'Please upload a valid CSV file.');
        }
    }

    public function dailyCollection()
    {

        $currentDate = Carbon::now()->format('Y-m-d');

        $totalCourseAmt = Fees::whereDate('installment_date', $currentDate)->sum('course_amount');
        $totalPaidFees = Fees::whereDate('installment_date', $currentDate)->sum('amount_paid');
        $totalDueFees = $totalCourseAmt - $totalPaidFees;
        $totalEnrolled = Student::whereDate('admission_date', $currentDate)->where('join_status', 'enrolled')->count();
        $branches = User::where('role_position', 'branch')->get();

        foreach ($branches as $branch) {
            $branch->students = Student::where('branch_id', $branch->id)->whereDate('admission_date', $currentDate)->where('join_status', 'enrolled')->count();
            $branch->sfees = Fees::where('branch_id', $branch->id)->whereDate('installment_date', $currentDate)->sum('course_amount');
            $branch->pfees = Fees::where('branch_id', $branch->id)->whereDate('installment_date', $currentDate)->sum('amount_paid');
        }

        return view('app.admin.pages.daily_collections', compact('totalCourseAmt', 'totalPaidFees', 'totalDueFees', 'totalEnrolled', 'branches'));
    }

    public function updatePaidStatus(Request $request, $id)
    {
        $month = $request->input('month');
        $year = $request->input('year');
        $note = $request->input('note'); // 'paid' or 'unpaid'

        $fees = Fees::where('branch_id', $id)
            ->whereYear('installment_date', $year)
            ->whereMonth('installment_date', $month)
            ->get();

        foreach ($fees as $fee) {
            $fee->note = $note;
            $fee->save();
        }

        return redirect()->back()->with('success', 'Payment status successfully updated!');
    }

    public function deleteFaculty($id)
    {

        $faculty = Faculty::findOrFail($id);
        $facultyBatches = Batch::where('faculty_id', $id)->get();

        foreach ($facultyBatches as $batch) {
            $batch->faculty_id = null;
            $batch->save();
        }

        $admin = auth()->user();
        Activities::create([
            'admin_id' => $admin->id,
            'action' => 'Deleted the Faculty and the faculty name was ' . $faculty->name,
        ]);

        $faculty->delete();

        return redirect()->back()->with('success', 'Faculty deleted successfully');
    }

    public function deletePartner($id){

        $partner = User::findOrFail($id);

        $admin = auth()->user();
        Activities::create([
            'admin_id' => $admin->id,
            'action' => 'A partner is deleted and that partner name is ' . $partner->name,
        ]);
        $partner->delete();

        return redirect()->back()->with('success', 'Partner deleted successfully!');
    }


}
