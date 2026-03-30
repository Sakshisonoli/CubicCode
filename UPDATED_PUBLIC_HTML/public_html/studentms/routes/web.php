<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'loginPage'])->name('login');
Route::get('/register', [AuthController::class, 'registerPage'])->name('register');

Route::post('/store', [AuthController::class, 'storeData'])->name('store_data');
Route::post('/authentication', [AuthController::class, 'authentication'])->name('authentication');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function(){

    Route::get('/dashboard', [AdminController::class, 'adminDashboard'])->name('admin_dashboard');
    Route::get('/channel-partners', [AdminController::class, 'channelPartners'])->name('channel_partners');
    Route::get('/channel-partners/add-channel-partner', [AdminController::class, 'addChannelPartnerForm'])->name('add_channel_partner');
    Route::post('/store-channel-partner', [AdminController::class, 'storeChannelPartner'])->name('store_channel_partner');
    Route::get('/channel-partners/edit-partner/{id}', [AdminController::class, 'editChannelPartner'])->name('edit_channel_partner');
    Route::post('/update-partner/{id}', [AdminController::class, 'updatePartner'])->name('update_partner');
    Route::post('/update-partner-password/{id}', [AdminController::class, 'updatePartnerPassword'])->name('update_partner_password');
    Route::get('/batches', [AdminController::class, 'batches'])->name('batches');
    Route::get('/batches/create-new-batch', [AdminController::class, 'createNewBatch'])->name('create_new_batch');
    Route::post('/store-batch', [AdminController::class, 'storeBatch'])->name('store_batch');
    Route::get('/branch-students', [AdminController::class, 'branchStudents'])->name('branchwise_students');
    Route::get('/students/{id}', [AdminController::class, 'students'])->name('students');
    Route::get('/add-student', [AdminController::class, 'addStudents'])->name('add_student');
    Route::get('/students/edit-student/{id}', [AdminController::class, 'editStudent'])->name('edit_student');
    Route::post('/update-student/{id}', [AdminController::class, 'updateStudent'])->name('update_student');
    Route::get('/batch/{branchId}', [AdminController::class, 'getBatches'])->name('get_batch');
    Route::post('/store-student', [AdminController::class, 'storeStudent'])->name('store_student');
    Route::get('/student-inquiries', [AdminController::class, 'studentInquiries'])->name('student_inquiries');
    Route::post('/store-inquiry', [AdminController::class, 'storeInquiry'])->name('store_inquiry');
    Route::get('/faculties', [AdminController::class, 'faculties'])->name('faculties');
    Route::get('/faculties/add-faculty', [AdminController::class, 'addFaculty'])->name('add_faculty');
    Route::post('/store-faculty', [AdminController::class, 'storeFaculty'])->name('store_faculty');
    Route::get('/courses', [AdminController::class, 'courses'])->name('courses');
    Route::post('/store-course', [AdminController::class, 'storeCourse'])->name('store_course');
    Route::get('/student/payment-details/{id}', [AdminController::class, 'duePayments'])->name('payment_details');
    Route::get('/student/course-details/{id}', [AdminController::class, 'courseDetails'])->name('course_details');
    Route::post('/installment-payment/{id}', [AdminController::class, 'installmentPayment'])->name('installment_payment');
    Route::get('/alumni', [AdminController::class, 'alumni'])->name('alumni');
    Route::get('/batches/batch-details/{id}', [AdminController::class, 'batchDetails'])->name('batch_details');
    Route::post('/update-student-batch', [AdminController::class, 'updateStudentBatch'])->name('update_student_batch');
    Route::post('/update-batch-details/{id}', [AdminController::class, 'updateBatchDetails'])->name('update_batch_details');
    Route::get('/fees/students-fees', [AdminController::class, 'studentsFees'])->name('student_fees');
    Route::get('/fees/paid-students/{id}', [AdminController::class, 'feesPaidStudents'])->name('fees_paid_students');
    Route::get('/fees/pending-students/{id}', [AdminController::class, 'feesPendingStudents'])->name('fees_pending_students');
    Route::get('/inquiry-to-admmission/{id}', [AdminController::class, 'inquiryToAdmission'])->name('inquiry_to_admmission');
    Route::get('/notifications/branch-notifications', [AdminController::class, 'branchNotifications'])->name('branch_notifications');
    Route::post('/send-notification-to-branches', [AdminController::class, 'sendNotificationToBranches'])->name('send_notification_to_branches');
    Route::get('/branch/batches/{id}', [AdminController::class, 'branchBatches'])->name('batches_by_branch');
    Route::get('/branch/faculties/{id}', [AdminController::class, 'branchFaculties'])->name('faculties_by_branch');
    Route::get('/faculties/faculty-info/{id}', [AdminController::class, 'facultyInfo'])->name('faculty_info');
    Route::get('/faculties/edit-faculty/{id}', [AdminController::class, 'editFaculty'])->name('edit_faculty');
    Route::post('/update-faculty/{id}', [AdminController::class, 'updateFaculty'])->name('update_faculty');
    Route::get('/branch/inquiries/{id}', [AdminController::class, 'branchInquiries'])->name('inquiries_by_branch');
    Route::get('/assignments', [AdminController::class, 'assignments'])->name('assignments');
    Route::get('/students/view-attendance/{id}', [AdminController::class, 'viewAttendance'])->name('view-attendance');
    Route::get('/notifications/student-notifications', [AdminController::class, 'studentNotifications'])->name('students_notifications');
    Route::post('/send-student-notification', [AdminController::class, 'sendNotificationToStudent'])->name('send_student_notification');
    Route::get('/inquiries/inquiry-details/{id}', [AdminController::class, 'inquiryDetails'])->name('inquiry_details');
    Route::post('/update-course/{id}', [AdminController::class, 'updateCourse'])->name('course_update');
    Route::get('/detele-course/{id}', [AdminController::class, 'deleteCourse'])->name('delete_course');
    Route::get('/admin-settings', [AdminController::class, 'adminSettings'])->name('admin_settings');
    Route::post('/update-admin/{id}', [AdminController::class, 'updateAdminInfo'])->name('update_admin_info');
    Route::post('/change-admin-password/{id}', [AdminController::class, 'changeAdminPassword'])->name('change_admin_pass');
    Route::get('/inquiries/edit-branch-inquiry/{id}', [AdminController::class, 'editBranchInquiry'])->name('edit_branch_inquiry');
    Route::post('/update-inquiry/{id}', [AdminController::class, 'updateInquiry'])->name('update_inquiry');
    Route::get('/delete-lead/{id}', [AdminController::class, 'deleteBranchLead'])->name('delete_lead');
    Route::get('/export-branch-leads/{id}', [AdminController::class, 'exportBranchLeadsCsv'])->name('export_branch_leads_csv');
    Route::get('/export-leads', [AdminController::class, 'exportLeads'])->name('export_leads');
    Route::get('/activities', [AdminController::class, 'adminsActivities'])->name('admin_activities');
    Route::get('/admins-room', [AdminController::class, 'adminsRoom'])->name('admins_room');
    Route::post('/add-admin', [AdminController::class, 'addNewAdmin'])->name('add_admin');
    Route::get('/delete-admin/{id}', [AdminController::class, 'deleteAdmin'])->name('delete_admin');
    Route::get('/delete-student/{id}', [AdminController::class, 'deleteStudent'])->name('delete_student');
    Route::get('/fees/branch-students-fees/{id}', [AdminController::class, 'paidUnpaidAllStudents'])->name('branch_all_students_fees');
    Route::get('/monthly-statments', [AdminController::class, 'monthlyStatements'])->name('monthly_statements');
    Route::post('/export-monthly-comm', [AdminController::class, 'exportMonthlyCollection'])->name('export_monthly_comm');
    Route::get('/student-bill/{id}', [AdminController::class, 'getStudentBill'])->name('get_student_bill');
    Route::get('/student-bill-second/{id}', [AdminController::class, 'getStudentSecondBill'])->name('get_student_second_bill');
    Route::get('/student-bill-third/{id}', [AdminController::class, 'getStudentThirdBill'])->name('get_student_third_bill');
    Route::post('/partner-bill/{id}', [AdminController::class, 'getPartnerBill'])->name('get_partner_bill');
    Route::post('/update-payment-details/{id}', [AdminController::class, 'updatePaymentDetails'])->name('update_payment_details');
    Route::post('/import-leads', [AdminController::class, 'importLeads'])->name('import_leads');
    Route::get('/todays-statement', [AdminController::class, 'dailyCollection'])->name('daily_collection');
    Route::post('/update-paid-status/{id}', [AdminController::class, 'updatePaidStatus'])->name('update_paid_status');
    Route::get('/delete-faculty/{id}', [AdminController::class, 'deleteFaculty'])->name('delete_faculty');
    Route::get('/delete-partner/{id}', [AdminController::class, 'deletePartner'])->name('delete_partner');

});

Route::middleware(['auth', 'branch'])->prefix('branch')->group(function(){

    Route::get('/dashboard', [BranchController::class, 'branchDashboard'])->name('branch_dashboard');
    Route::get('/faculties', [BranchController::class, 'branchFaculties'])->name('branch_faculties');
    Route::get('/faculties/add-faculty', [BranchController::class, 'addBranchFaculty'])->name('branch_add_faculty');
    Route::get('/faculties/edit-faculty-info/{id}', [BranchController::class, 'editBranchFaculty'])->name('branch_edit_faculty');
    Route::post('/update-faculty-info/{id}', [BranchController::class, 'updateFacultyInfo'])->name('update_faculty_info');
    Route::post('/store-branch', [BranchController::class, 'storeBranchFaculty'])->name('branch_store_faculty');
    Route::get('/students', [BranchController::class, 'branchStudents'])->name('branch_students');
    Route::get('/students/add-new-student', [BranchController::class, 'addBranchStudent'])->name('branch_add_student');
    Route::post('/store-branch-student', [BranchController::class, 'storeBranchStudent'])->name('branch_store_student');
    Route::get('/batches', [BranchController::class, 'branchBatches'])->name('branch_batches');
    Route::get('/batches/create-batch', [BranchController::class, 'createBranchBatch'])->name('branch_create_batch');
    Route::post('/store-batch', [BranchController::class, 'branchStoreBatch'])->name('branch_store_batch');
    Route::post('/update-batch/{id}', [BranchController::class, 'updateBranchBatch'])->name('branch_update_batch');
    Route::get('/edit-student/{id}', [BranchController::class, 'editBranchStudent'])->name('branch_edit_student');
    Route::post('/update-branch-student/{id}', [BranchController::class, 'updateBranchStudent'])->name('branch_update_students');
    Route::get('/student-course-details/{id}', [BranchController::class, 'studentCourseDetails'])->name('branch_student_cdetails');
    Route::get('/student-payment-details/{id}', [BranchController::class, 'studentPaymentsDetails'])->name('branch_student_pdetails');
    Route::post('/student-installment-payment/{id}', [BranchController::class, 'branchInstallmentPayment'])->name('branch_installment_payment');
    Route::get('/fees-paid-students', [BranchController::class, 'branchFeesPaidStudents'])->name('branch_fees_paid');
    Route::get('/fees-due-students', [BranchController::class, 'branchFeesDueStudents'])->name('branch_fees_due');
    Route::get('/faculty-details/{id}', [BranchController::class, 'branchFacultyDetails'])->name('branch_faculty_details');
    Route::get('/inquiries', [BranchController::class, 'branchStudentInquiries'])->name('branch_inquiries');
    Route::post('/store-branch-inquiry', [BranchController::class, 'storeBranchInquiry'])->name('branch_store_inquiry');
    Route::get('/branch-inquiry-to-admission/{id}', [BranchController::class, 'branchInquiryToAdmission'])->name('branch_inquiry_to_admission');
    Route::get('/attendance-batches', [BranchController::class, 'attendanceBatches'])->name('branch_attendance_batches');
    Route::get('/batch-details/{id}', [BranchController::class, 'branchBatchDetails'])->name('branch_batch_details');
    Route::post('/change-student-batch', [BranchController::class, 'branchChangeStudentBatch'])->name('branch_change_batch');
    Route::get('/batch-students-attendance/{id}', [BranchController::class, 'batchStudentsAttendance'])->name('branch_students_attendance');
    Route::post('/mark-attendance', [BranchController::class, 'branchMarkAttendance'])->name('branch_mark_attendance');
    Route::get('/single-student-attendance/{id}', [BranchController::class, 'branchSingleStudentAttendance'])->name('branch_single_student_attendance');
    Route::get('/inquiry-details/{id}', [BranchController::class, 'branchInquiryDetails'])->name('branch_inquiry_details');
    Route::get('/head-office-notifications', [BranchController::class, 'branchHeadOfficeNotifications'])->name('branch_head_office_notifications');
    Route::get('/branch-student-notofications', [BranchController::class, 'branchStudentsNotifications'])->name('branch_student_notifications');
    Route::post('/send-msg-to-admin', [BranchController::class, 'branchSendMsgToAdmin'])->name('send_msg_to_admin');
    Route::post('/send-msg-to-student', [BranchController::class, 'branchSendMsgToStudent'])->name('send_msg_to_student');
    Route::get('/send-assignment-to-students', [BranchController::class, 'sendAssignment'])->name('branch_send_assignment');
    Route::post('/sending-assignment', [BranchController::class, 'sendingAssignment'])->name('branch_sending_assignment');
    Route::get('/submitted-assignments', [BranchController::class, 'submittedAssignment'])->name('submitted_assignment');
    Route::get('/setting', [BranchController::class, 'branchSettings'])->name('branch_settings');
    Route::post('/update-personal-info', [BranchController::class, 'branchUpdatePersonalInfo'])->name('branch_update_personal_info');
    Route::post('/update-password', [BranchController::class, 'branchUpdatePassword'])->name('branch_update_password');
    Route::get('/branch-delete-lead/{id}', [BranchController::class, 'deleteLead'])->name('branch_delete_lead');
    Route::get('/inquiry/edit-inquiry/{id}', [BranchController::class, 'branchEditInquiry'])->name('branch_edit_inquiry');
    Route::post('/update-branch-inquiry/{id}', [BranchController::class, 'updateBranchInquiry'])->name('branch_update_inquiry');
    Route::get('/branch-delete-batch/{id}', [BranchController::class, 'branchDeleteBatch'])->name('branch_delete_batch');
    Route::get('/inquiries/export', [BranchController::class, 'exportLeadsCsv'])->name('branch_export_leads');
    Route::get('/student-clear-bill/{id}', [BranchController::class, 'getStudentClearBill'])->name('branch_student_clear_bill');
    Route::get('/student-due-bill/{id}', [BranchController::class, 'getStudentDueBill'])->name('branch_student_due_bill');
    Route::get('/student-paid-bill/{id}', [BranchController::class, 'getStudentPaidBill'])->name('branch_student_paid_bill');
    Route::get('/branch-monthly-statements', [BranchController::class, 'branchMonthlyStatements'])->name('branch_monthly_statements');
    Route::post('/branch-own-bill', [BranchController::class, 'getOwnBranchBill'])->name('branch_own_bill');
    Route::get('/cleancode-courses', [BranchController::class, 'cleancodeCourses'])->name('cleancode_courses');

});


Route::middleware(['student'])->prefix('student')->group(function(){

    Route::get('/dashboard', [StudentController::class, 'studentDashboard'])->name('student_dashborad');
    Route::get('/profile', [StudentController::class, 'studentProfile'])->name('student_profile');
    Route::get('/notifications', [StudentController::class, 'studentNotifications'])->name('student_notifications');
    Route::post('/send-notification', [StudentController::class, 'studentSendNotification'])->name('student_send_notification');
    Route::get('/payment-details', [StudentController::class, 'studentPaymentDetails'])->name('student_payment_details');
    Route::get('/assignments', [StudentController::class, 'studentAssignments'])->name('student_assignments');
    Route::post('/submit-assignment', [StudentController::class, 'studentSubmitAssignment'])->name('student_submit_assignment');
    Route::get('/settings', [StudentController::class, 'studentSettings'])->name('student_settings');
    Route::post('/update-student-info/{id}', [StudentController::class, 'studentUpdateInfo'])->name('student_update_info');
    Route::post('/update-student-password/{id}', [StudentController::class, 'studentUpdatePass'])->name('student_update_pass');
    Route::get('/clear-bill', [StudentController::class, 'getStudentClearBill'])->name('clear_bill');
    Route::get('/due-bill', [StudentController::class, 'getStudentDueBill'])->name('due_bill');
    Route::get('/prev-bill', [StudentController::class, 'getStudentPaidBill'])->name('prev_bill');

});
