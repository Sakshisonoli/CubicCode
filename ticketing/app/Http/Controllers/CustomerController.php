<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Paymentsinfo;
use App\Models\Biding;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class CustomerController extends Controller
{

   public function CustomerDashboard(){

    $id = auth()->user()->id;
    $totalOrders = Order::where('customer_id', $id)->sum('total_price');
    $totalListing = Ticket::where('owner_id', $id)->sum('total_min_price');
    $totalSales = Ticket::where('owner_id', $id)->where('status', 'sold')->sum('total_min_price');
    $totalReceived = Ticket::where('owner_id', $id)->where('paid_status', 'paid')->sum('total_min_price');

    return view('backend.customer.dashboard', compact('totalOrders', 'totalListing', 'totalSales', 'totalReceived'));
   }

   public function orders(){

    $id = auth()->user()->id;
    $tickets = Order::where('customer_id', $id)->get();

    return view('backend.customer.my_orders', compact('tickets'));
   }

   public function listings(){

    $id = auth()->user()->id;
    $tickets = Ticket::where('owner_id', $id)->orderBy('id', 'desc')->get();

    return view('backend.customer.my_listings', compact('tickets'));
   }

   public function sales(){

    $id = auth()->user()->id;
    $soldTickets = Ticket::where('owner_id', $id)->where('status', 'sold')->orderBy('id', 'desc')->get();

    return view('backend.customer.my_sales', compact('soldTickets'));
   }

   public function payments(){

    $id = auth()->user()->id;
    $totalSell = Order::where('customer_id', $id)->where('status', 'completed')->sum('total_price');
    $totalTickets = Order::where('customer_id', $id)->where('status', 'completed')->sum('no_of_tickets');
    $totalPaid = Ticket::where('owner_id', $id)->where('paid_status', 'paid')->sum('total_min_price');
    $paidTickets = Ticket::where('owner_id', $id)->where('paid_status', 'paid')->orderBy('id', 'desc')->get();

    return view('backend.customer.payments', compact('totalSell', 'totalTickets', 'totalPaid', 'paidTickets'));
   }

   public function settings(){

    $id = auth()->user()->id;
    $cData = User::findOrFail($id);

    return view('backend.customer.settings', compact('cData'));
   }

   public function support(){

    return view('backend.customer.support');
   }

   public function updateInfo(Request $request, $id){

    $this->validate($request, [
        'banck_name' => 'required',
        'ac_holder_name' => 'required',
        'acc_number' => 'required',
        'bank_branch' => 'required',
        'ifsc_code' => 'required',
        'address' => 'required',
        'city' => 'required',
        'state' => 'required',
        'post_code' => 'required',
    ]);

    $requestData = $request->except(['_token']);

    $customer = Paymentsinfo::where('customer_id', $id);
    $customer->update($requestData);

    return redirect()->back()->with('success', 'Details updated successfully.');
   }

   public function myBids(){

    $id = auth()->user()->id;
    $bids = Biding::where('customer_id', $id)->get();

    return view('backend.customer.my_bids', compact('bids'));
   }

   public function addInfo(Request $request){

    $this->validate($request, [
        'banck_name' => 'required',
        'ac_holder_name' => 'required',
        'acc_number' => 'required',
        'bank_branch' => 'required',
        'ifsc_code' => 'required',
        'address' => 'required',
        'city' => 'required',
        'state' => 'required',
        'post_code' => 'required',
    ]);

    $requestData = $request->except(['_token']);

    $id = auth()->user()->id;
    $requestData['customer_id'] = $id;
    Paymentsinfo::create($requestData);

    return redirect()->back()->with('success', 'Payment details added successfully.');
   }


   public function ticketDetails($id){

        $ticket = Ticket::findOrFail($id);

        return view('backend.customer.puchased_ticket_details', compact('ticket'));
   }

   public function sendPaymentRequest($id){

    $ticket = Ticket::findOrFail($id);
    $ticket->paid_status = 'requested';
    $ticket->save();

    return redirect()->back()->with('success', 'Your payment request has been sent successfully!');
   }

}
