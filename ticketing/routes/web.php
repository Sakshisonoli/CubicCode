<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Mail\TestMail;
use App\Http\Controllers\OtpController;


Route::post('/order/payment/verify', [App\Http\Controllers\OrderController::class, 'verifyPayment'])->name('order.payment');
Route::get('/order/success', [App\Http\Controllers\OrderController::class, 'success'])->name('order.success');

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

Route::get('/send-test-email', function () {
    Mail::to('hrushikeshwd@gmail.com')->send(new TestMail());
    return 'Email sent!';
});

Route::get('/verify-otp', [AuthController::class, 'showOtpScreen'])->name('otp.verify.screen');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('otp.verify.submit');
Route::post('/resend-otp', [AuthController::class, 'resendOtp'])->name('otp.resend');

Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot.password');
Route::post('/send-otp', [AuthController::class, 'sendOtp'])->name('send.otp');

Route::get('/verify-reset-otp', [AuthController::class, 'showOtpVerificationForm'])->name('verify.reset.otp');
Route::post('/verify-reset-otp', [AuthController::class, 'verifyResetOtp'])->name('verify.reset.otp.submit');

Route::get('/reset-password', [AuthController::class, 'showResetForm'])->name('reset.password');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset.password.submit');



// Route::post('/verify-msg91-jwt', [OtpController::class, 'verifyMsg91JWT'])->name('verify.msg91.jwt');
// Route::get('/otp-login', [OtpController::class, 'showOtpLoginForm'])->name('otp.login');

Route::get('/', [HomeController::class, 'homePage'])->name('home');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/submitAdmin', [AuthController::class, 'adminStore'])->name('submit_admin');
Route::post('/authentication', [AuthController::class, 'authentication'])->name('authentication');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/selltickets', [HomeController::class, 'sellTickets'])->name('sell_tickets');
Route::get('/search-events', [HomeController::class, 'searchEvents'])->name('search_events');
Route::get('/selltickets/event/{id}', [HomeController::class, 'eventTickets'])->name('event_tickets');
Route::get('/sellticket/event/{id}', [HomeController::class, 'sellTicketForm'])->name('sell_ticket_form');
Route::post('/submit-ticket', [HomeController::class, 'submitTicket'])->name('submit_ticket');
Route::get('/event-details/{id}', [HomeController::class, 'eventDetails'])->name('event_details');
Route::get('/explore-events', [HomeController::class, 'exploreEvents'])->name('explore_events');
Route::get('/bidings/{id}', [HomeController::class, 'bidingPage'])->name('biding_page');
Route::post('/bid-now', [HomeController::class, 'bidNow'])->name('bid_now');
Route::get('/events/{category}', [HomeController::class, 'searchCategory'])->name('search_category');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/event-tickets/{artist}', [HomeController::class, 'selectedEventTickets'])->name('selected_event_tickets');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/queues-care-and-guarantee', [HomeController::class, 'careGuarantee'])->name('care_guarantee');
Route::get('/terms-and-conditions', [HomeController::class, 'termsAndContions'])->name('terms_and_conditions');
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy_policy');
Route::get('/refund-policy', [HomeController::class, 'refundPolicy'])->name('refund_policy');

Route::get('/checkout/queues-product=/{id}', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/checkoutTickets/{id}', [OrderController::class, 'checkoutTickets'])->name('checkoutTickets');
// Route::post('/checkout/payment/queues-product/{id}');

Route::post('/create-order', [OrderController::class, 'createOrder'])->name('order.create');
Route::get('/phonepe/verify', [OrderController::class, 'verifyPayment'])->name('order.verify');
Route::get('/order/success', [OrderController::class, 'orderSuccess'])->name('order.success');
Route::get('/order/failed', [OrderController::class, 'orderFailed'])->name('order.failed');


// Route::match(['post', 'options'], '/order/process-payment', [OrderController::class, 'processPayment'])->name('order.process-payment');


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function(){

    Route::get('/dashoard', [AdminController::class, 'adminDashboard'])->name('admin_dashboard');
    Route::get('/all-concerts', [AdminController::class, 'allConcerts'])->name('all_concerts');
    Route::get('/add-new-concert', [AdminController::class, 'addNewConcert'])->name('add_new_concert');
    Route::get('/active-tickets', [AdminController::class, 'activeTickets'])->name('active_tickets');
    Route::get('/unverified-tickets', [AdminController::class, 'unverifiedTickets'])->name('unverified_tickets');
    Route::get('/sold-tickets', [AdminController::class, 'soldTickets'])->name('sold_tickets');
    Route::get('/customers', [AdminController::class, 'customers'])->name('customers');
    Route::get('/bidings', [AdminController::class, 'bidings'])->name('bidings');
    Route::get('/payment-records', [AdminController::class, 'paymentRecords'])->name('payment_records');
    Route::get('/payment-requests', [AdminController::class, 'paymentRequests'])->name('payment_requests');
    Route::get('/add-stadium', [AdminController::class, 'addStadium'])->name('add_stadium');
    Route::get('/stadiums', [AdminController::class, 'stadiums'])->name('stadiums');
    Route::get('/add-seat/{id}', [AdminController::class, 'addSeat'])->name('add_seat');
    Route::get('/seats/{id}', [AdminController::class, 'seats'])->name('seats');
    Route::get('/ticket-info/{id}', [AdminController::class, 'ticketInfo'])->name('ticket_info');
    Route::get('/view-event/{id}', [AdminController::class, 'viewEvent'])->name('view_event');
    Route::get('/customer-profile/{id}', [AdminController::class, 'customerProfile'])->name('customer_profile');
    Route::get('/event-bids/{id}', [AdminController::class, 'eventBids'])->name('event_bids');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin_settings');
    Route::get('/charges', [AdminController::class, 'charges'])->name('charges');

    Route::post('/create-event', [AdminController::class, 'createEvent'])->name('create_event');
    Route::post('/submit-stadium', [AdminController::class, 'submitStadium'])->name('submit_stadium');
    Route::post('/submit-seat', [AdminController::class, 'submitSeat'])->name('submit_seat');
    Route::post('/update-ticket-status/{id}', [AdminController::class, 'updateTicketStatus'])->name('update_ticket_status');
    Route::post('/update-bid-status/{id}', [AdminController::class, 'updateBidingStatus'])->name('update_biding_status');
    Route::post('/update-event-details/{id}', [AdminController::class, 'updateEventDetails'])->name('update_event_details');
    Route::post('/update-customer-status/{id}', [AdminController::class, 'updateCustomerStatus'])->name('update_customer_status');
    Route::post('/update-admin/{id}', [AdminController::class, 'updateAdmin'])->name('update_admin');
    Route::post('/update-password/{id}', [AdminController::class, 'updatePassword'])->name('update_password');
    Route::post('/add-charges', [AdminController::class, 'addCharges'])->name('add_charges');
    Route::get('/delete-charges/{id}', [AdminController::class, 'deleteCharges'])->name('delete_charges');
    Route::patch('/bid-status/{id}', [AdminController::class, 'bidStatus'])->name('bid_status');
    Route::get('/deleteEvent/{id}', [AdminController::class, 'deleteEvent'])->name('delete_event');
    Route::get('/deleteStadium/{id}', [AdminController::class, 'deleteStadium'])->name('delete_stadium');
    Route::get('/deleteSeat/{id}', [AdminController::class, 'deleteSeat'])->name('delete_seat');
    Route::get('/deleteTicket/{id}', [AdminController::class, 'deleteTicket'])->name('delete_ticket');
    Route::get('/deleteCustomer/{id}', [AdminController::class, 'deleteCustomer'])->name('delete_customer');
    Route::get('/paymentProcessing/{id}', [AdminController::class, 'paymentProcessing'])->name('paymentProcessing');
    Route::get('/paymentApproved/{id}', [AdminController::class, 'paymentApproved'])->name('paymentApproved');
    Route::get('/paymentPaid/{id}', [AdminController::class, 'paymentPaid'])->name('paymentPaid');

});

Route::middleware(['auth', 'customer'])->prefix('profile')->group(function(){

    Route::get('/profile', [CustomerController::class, 'CustomerDashboard'])->name('customer_dashboard');
    Route::get('/orders', [CustomerController::class, 'orders'])->name('orders');
    Route::get('/listings', [CustomerController::class, 'listings'])->name('listings');
    Route::get('/sales', [CustomerController::class, 'sales'])->name('sales');
    Route::get('/payments', [CustomerController::class, 'payments'])->name('payments');
    Route::get('/settings', [CustomerController::class, 'settings'])->name('settings');
    Route::get('/support', [CustomerController::class, 'support'])->name('support');
    Route::get('/my-bids', [CustomerController::class, 'myBids'])->name('my_bids');
    Route::get('/ticket-details/{id}', [CustomerController::class, 'ticketDetails'])->name('ticketDetails');

    Route::post('/update-info/{id}', [CustomerController::class, 'updateInfo'])->name('update_info');
    Route::post('/add-info', [CustomerController::class, 'addInfo'])->name('add_info');
    Route::get('/send-payment-request/{id}', [CustomerController::class, 'sendPaymentRequest'])->name('sendPaymentRequest');
});
