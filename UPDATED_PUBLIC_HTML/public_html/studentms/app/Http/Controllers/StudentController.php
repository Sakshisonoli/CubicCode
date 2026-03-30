<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Attendance;
use App\Models\Fees;
use App\Models\Notification;
use App\Models\Student;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PDF;

class StudentController extends Controller
{
    public function studentDashboard(){

        $student = auth()->guard('student')->user();
        $totalPresent = Attendance::where('student_id', $student->id)->where('status', 'present')->count();
        $totalAbsent = Attendance::where('student_id', $student->id)->where('status', 'absent')->count();
        $notifications = Notification::where('subject', 'toStudent')->where('student_id', $student->id)->where('type', 'sent')->orderBy('created_at', 'desc')->take(5)->get();
        $assignments = Assignment::where('student_id', $student->id)->orWhere('batch_id', $student->batch_id)->orWhere('send_to', 'toAll')->orderBy('created_at', 'desc')->take(5)->get();
        $pendingFees = Fees::where('student_id', $student->id)->orderBy('created_at', 'desc')->first();

        $attendanceData = Attendance::where('student_id', $student->id)->get();
        // Format attendance data for FullCalendar
        $formattedAttendanceData = $attendanceData->map(function ($attendance) {
            return [
                'title' => $attendance->status === 'present' ? 'Present' : 'Absent',
                'start' => $attendance->date,
                'color' => $attendance->status === 'present' ? 'green' : 'red'
            ];
        });

        $courseAmt = Fees::where('student_id', $student->id)->first();

        return view('app.student.pages.dashboard', compact('totalPresent', 'totalAbsent', 'formattedAttendanceData', 'notifications', 'assignments', 'pendingFees', 'courseAmt', 'student'));
    }

    public function studentProfile(){

        $studentId = auth()->guard('student')->user()->id;
        $studentDetails = Student::findOrFail($studentId);

        return view('app.student.pages.profile', compact('studentDetails'));
    }

    public function studentNotifications(){

        $studentId = auth()->guard('student')->user()->id;
        $sendNotifications = Notification::where('subject', 'fromStudent')->where('student_id', $studentId)->where('type', 'received')->get();
        // $receivedNotifications = Notification::where('subject', 'toStudent')->where('student_id', $studentId)->orWhere('student_id', null)->where('type', 'sent')->get();

        $receivedNotifications = Notification::where(function($query) use ($studentId) {
            $query->where('subject', 'toStudent')
                  ->where(function($subQuery) use ($studentId) {
                      $subQuery->where('student_id', $studentId)
                               ->orWhere('student_id', null);
                  });
        })->where('type', 'sent')->get();

        return view('app.student.pages.notifications', compact('sendNotifications', 'receivedNotifications'));
    }

    public function studentSendNotification(Request $request){

        $this->validate($request, [
            'title' => 'nullable',
            'message' => 'required',
            'student_id' => 'required',
            'branch_id' => 'required',
            'subject' => 'required'
        ]);

        $requestNotification = $request->except(['_token']);
        $requestNotification['type'] = 'received';
        Notification::create($requestNotification);

        return redirect()->back()->with('success', 'Notifications have been successfully sent to the Branch!');
    }

    public function studentPaymentDetails(){

        $studentId = auth()->guard('student')->user()->id;
        $studentDetails = Student::findOrFail($studentId);
        $courseAmt = Fees::where('student_id', $studentId)->first();
        $installments = Fees::where('student_id', $studentId)->where('next_installment_date', '!=', null)->orderBy('created_at', 'desc')->take(1)->get();

        return view('app.student.pages.payment_details', compact('studentDetails', 'courseAmt', 'installments'));
    }

    public function studentAssignments(){

        $student = auth()->guard('student')->user();
        $assignments = Assignment::where('student_id', $student->id)->orWhere('batch_id', $student->batch_id)->orWhere('send_to', 'toAll')->orderBy('created_at', 'desc')->get();

        return view('app.student.pages.assignments', compact('assignments'));
    }

    public function studentSubmitAssignment(Request $request){

        $this->validate($request, [
            'assignment_id' => 'required',
            'branch_id' => 'required',
            'student_id' => 'required',
            'project_name' => 'required',
            'desciption' => 'required',
            'file' => 'required|mimes:pdf',
            'project_note' => 'nullable'
        ]);

        $requestAssignment = $request->except(['_token']);

        $sid = $request->input('student_id');
        $assignmentPDF = $request->file('file');
        if($assignmentPDF){
            $assignment = $request->file('file');
            $assignmentPath = 'cc' . '_assignment_' . $sid . '.' . $assignment->extension();
            $assignment->move(public_path('assignments/'), $assignmentPath);
        }
        else{
            $assignmentPath = null;
        }

        $requestAssignment['file'] = $assignmentPath;
        Submission::create($requestAssignment);

        return redirect()->back()->with('success', 'Assignment submitted successfully!');
    }

    public function studentSettings(){

        $student = auth()->guard('student')->user();

        return view('app.student.pages.settings', compact('student'));
    }

    public function studentUpdateInfo(Request $request, $id){

        $this->validate($request, [
            'name' => 'required|string|min:5|max:60',
            'birth_date' => 'required|date',
            'email' => 'required|email',
            'phone' => 'required'
        ]);

        $requestUpdates = $request->except(['_token']);

        $student = Student::findOrFail($id);
        $student->update($requestUpdates);

        return redirect()->back()->with('success', 'Data updated successfully!');
    }

    public function studentUpdatePass(Request $request, $id){

        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'password_confirmation' => 'required|same:new_password',
        ]);

        $student = Student::findOrFail($id);

        if(!Hash::check($request->input('current_password'), $student->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect');
        }
        $owner = Student::findOrFail($student->id);
        $requestPass['password'] = Hash::make($request->input('new_password'));
        $owner->update($requestPass);

        return redirect()->back()->with('success', 'Password changed successfully!');
    }


    public function getStudentClearBill(){

        $id = auth()->guard('student')->user()->id;
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

    public function getStudentDueBill(){

        $id = auth()->guard('student')->user()->id;
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

    public function getStudentPaidBill(){

        $id = auth()->guard('student')->user()->id;
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

}
