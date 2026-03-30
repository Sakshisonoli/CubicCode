<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stadium;
use App\Models\Event;
use App\Models\User;
use App\Models\Seat;
use App\Models\Ticket;
use App\Models\Biding;
use App\Models\Charges;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\ListingConfirmation;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function adminDashboard(){

        $events = Event::all()->count();
        $tickets = Ticket::all()->count();
        $customers = User::where('role', 'customer')->count();

        $ticketsReq = Ticket::where('paid_status', 'requested')
            ->orWhere('paid_status', 'processing')
            ->orWhere('paid_status', 'approved')
            ->orWhere('paid_status', 'paid')
            ->orderBy('id', 'desc')->get();

        return view('backend.dashboard.dashboard', compact('events', 'tickets', 'customers', 'ticketsReq'));
    }

    public function allConcerts(){

        $events = Event::all();

        return view('backend.dashboard.all_concerts', compact('events'));
    }

    public function addNewConcert(){

        $stadiums = Stadium::all();

        return view('backend.dashboard.add_new_concert', compact('stadiums'));
    }

    public function activeTickets(){

        $tickets = Ticket::where('status', 'Verified')->get();

        return view('backend.dashboard.active_tickets', compact('tickets'));
    }

    public function unverifiedTickets(){

        $tickets = Ticket::where('status', 'Unverified')->get();

        return view('backend.dashboard.unverified_tickets', compact('tickets'));
    }

    public function soldTickets(){

        $tickets = Ticket::where('status', 'sold')->get();

        return view('backend.dashboard.sold_tickets', compact('tickets'));
    }

    public function customers(){

        $customers = User::where('role', 'customer')->get();

        return view('backend.dashboard.customers', compact('customers'));
    }

    public function bidings(){

        $events = Event::where('status', 'active')->get();

        return view('backend.dashboard.bidings', compact('events'));
    }

    public function eventBids($id){

        $bids = Biding::where('event_id', $id)->get();

        return view('backend.dashboard.view_bidings', compact('bids'));
    }

    public function paymentRecords(){

        $totalSell = Order::where('status', 'completed')->sum('total_price');
        $totalTickets = Order::where('status', 'completed')->sum('no_of_tickets');
        $totalPending = Order::where('status', 'pending')->sum('total_price');
        $totalPendingTickets = Order::where('status', 'pending')->sum('no_of_tickets');
        $customers = User::where('role', 'customer')->get();
        $totalPaid = Ticket::where('paid_status', 'paid')->sum('total_max_price');

        foreach($customers as $customer){
            if($customer->order){
                $customer->total_sell = Order::where('customer_id', $customer->id)->where('status', 'completed')->sum('total_price');
                $customer->total_sell_tickets = Order::where('customer_id', $customer->id)->where('status', 'completed')->sum('no_of_tickets');
                $customer->total_paid = Ticket::where('owner_id', $customer->id)->where('paid_status', 'paid')->sum('total_min_price');
            }
        }

        return view('backend.dashboard.payment_records', compact('totalSell', 'totalTickets', 'totalPending', 'totalPendingTickets', 'customers', 'totalPaid'));
    }

    public function paymentRequests(){

        $tickets = Ticket::where('paid_status', 'requested')
            ->orWhere('paid_status', 'processing')
            ->orWhere('paid_status', 'approved')
            ->orWhere('paid_status', 'paid')
            ->orderBy('id', 'desc')->get();

        return view('backend.dashboard.payment_request', compact('tickets'));
    }

    public function addStadium(){

        return view('backend.dashboard.add_new_stadium');
    }

    public function stadiums(){

        $stadiums = Stadium::all();

        return view('backend.dashboard.stadiums', compact('stadiums'));
    }

    public function addSeat($id){

        $stadiumId = $id;

        return view('backend.dashboard.add_seat', compact('id'));
    }

    public function seats($id){

        $seats = Seat::where('stadium_id', $id)->get();

        return view('backend.dashboard.seats', compact('seats'));
    }

    public function createEvent(Request $request){

        $this->validate($request, [
            'event_name' => 'required|string',
            'artist_name' => 'required|string|max:80',
            'description' => 'required',
            'event_date' => 'date',
            'event_time' => 'required',
            'stadium_id' => 'required',
            'category' => 'required',
            'event_photo' => 'required|mimes:jpeg,png,jpg,webp',
        ]);

        $requestEvent = $request->except(['_token', 'event_photo']);

        if ($request->hasFile('event_photo')) {
            $eventPhoto = $request->file('event_photo');
            $eventPhotoPath = 'queues_event' . rand() . '.' . $eventPhoto->getClientOriginalExtension();
            $eventPhoto->move(public_path('events/'), $eventPhotoPath);
            $requestEvent['event_photo'] = $eventPhotoPath;
        } else {
            $requestEvent['event_photo'] = null;
        }

        $eId = $request->input('stadium_id');
        $stadium = Stadium::findOrFail($eId);
        $requestEvent['event_location'] = $stadium->location;
        $requestEvent['event_stadium'] = $stadium->stadium_name;
        $requestEvent['status'] = 'active';

        Event::create($requestEvent);

        return redirect()->back()->with('success', 'The countdown begins! Event successfully created.');
    }

    public function submitStadium(Request $request){

        $this->validate($request, [
            'stadium_name' => 'required|string|max:85',
            'location' => 'required',
            'image1' => 'nullable|mimes:jpeg,png,jpg,webp',
            'image2' => 'nullable|mimes:jpeg,png,jpg,webp',
        ]);

        $requestData = $request->except(['_token', 'image1', 'image2']);

        if ($request->hasFile('image1')) {
            $image1 = $request->file('image1');
            $image1Path = 'queues_' . rand() . '.' . $image1->getClientOriginalExtension();
            $image1->move(public_path('stadiums/'), $image1Path);
            $requestData['image1'] = $image1Path;
        } else {
            $requestData['image1'] = null;
        }

        if ($request->hasFile('image2')) {
            $image2 = $request->file('image2');
            $image2Path = 'queues_' . rand() . '.' . $image2->getClientOriginalExtension();
            $image2->move(public_path('stadiums/'), $image2Path);
            $requestData['image2'] = $image2Path;
        } else {
            $requestData['image2'] = null;
        }

        Stadium::create($requestData);

        return redirect()->back()->with('success', 'The stage is set! Stadium successfully added.');
    }

    public function submitSeat(Request $request){

        $this->validate($request, [
            'stadium_id' => 'required',
            'seat_level' => 'nullable',
            'row' => 'required',
            'number' => 'nullable',
            'seat_type' => 'required',
        ]);

        $requestSeat = $request->except(['_token']);

        Seat::create($requestSeat);

        return redirect()->back()->with('success', 'Seat successfully assigned.');
    }

    public function ticketInfo($id){

        $ticket = Ticket::findOrFail($id);

        return view('backend.dashboard.ticket_info', compact('ticket'));
    }

    public function updateTicketStatus(Request $request, $id){

        $ticket = Ticket::findOrFail($id);
        $ticket->status = $request->input('status');
        $ticket->save();

        if ($request->input('status') === 'Verified') {
            $email = $ticket->owner->email;
            $name = $ticket->owner->name;
            $eventName = $ticket->event->event_name;
            $seat = $ticket->seat->seat_level;
            // $tickets = $ticket->number_of_tickets;
            $price = $ticket->total_max_price;
            $eventDate = $ticket->event->event_date;

            Mail::to($email)->send(new ListingConfirmation($name, $eventName, $seat, $price, $eventDate));
        }

        return redirect()->back()->with('success', 'Ticket status successfully updated.');
    }

    public function updateBidingStatus(Request $request, $id){

        $ticket = Ticket::findOrFail($id);
        $ticket->biding_status = $request->input('biding_status');
        $ticket->save();

        return redirect()->back()->with('success', 'Biding status updated successfully');
    }

    public function viewEvent($id){

        $details = Event::findOrFail($id);

        return view('backend.dashboard.event_page', compact('details'));
    }

    public function updateEventDetails(Request $request, $id){

        $this->validate($request, [
            'event_name' => 'required',
            'description' => 'nullable',
            'artist_name' => 'required',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'category' => 'required',
            'addition' => 'nullable',
        ]);

        $requestUpdates = $request->except(['_token']);

        $event = Event::findOrFail($id);
        $event->update($requestUpdates);

        return redirect()->back()->with('success', 'Event details updated successfully');
    }

    public function customerProfile($id){

        $customer = User::findOrFail($id);

        return view('backend.dashboard.customer_profile', compact('customer'));
    }

    public function updateCustomerStatus(Request $request, $id){

        $customer = User::findOrFail($id);
        $customer->status = $request->input('status');
        $customer->update();

        return redirect()->back()->with('success', 'Status updated successfully!');
    }

    public function settings(){

        return view('backend.dashboard.settings');
    }

    public function updateAdmin(Request $request, $id){

        $admin = User::findOrFail($id);
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->phone = $request->input('phone');
        $admin->update();

        return redirect()->back()->with('success', 'Data updated succssfully!');
    }

    public function updatePassword(Request $request, $id){

        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
    }

    public function charges(){

        $charges = Charges::all();

        return view('backend.dashboard.charges', compact('charges'));
    }

    public function addCharges(Request $request){

        $this->validate($request, [
            'min_amt' => 'required',
            'max_amt' => 'required',
            'charges' => 'required',
        ]);

        $requestCharges = $request->except(['_token']);

        $requestCharges['status'] = 'active';
        Charges::create($requestCharges);

        return redirect()->back()->with('success', 'Charges added successfully!');
    }

    public function deleteCharges($id){

        $charge = Charges::findOrFail($id);
        $charge->delete();

        return redirect()->back()->with('success', 'Charges deleted successfully!');
    }

    public function bidStatus(Request $request, $id){

        $bid = Biding::findOrFail($id);
        if($bid){
            $bid->status = 'own';
            $bid->save();

            Biding::where('ticket_id', $bid->ticket_id)
            ->where('id', '!=', $bid->id)
            ->update(['status' => 'lost']);
        }

        return redirect()->back()->with('success', 'Bid status updated successfully!');
    }

    public function deleteEvent($id){

        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->back()->with('success', 'Event successfully deleted!');
    }

    public function deleteStadium($id){

        $stadium = Stadium::findOrFail($id);
        $stadium->delete();

        return redirect()->back()->with('success', 'Stadium successfully deleted!');
    }

    public function deleteSeat($id){

        $seat = Seat::findOrFail($id);
        $seat->delete();

        return redirect()->back()->with('success', 'Seat successfully deleted!');
    }

    public function deleteTicket($id){

        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->back()->with('success', 'Ticket successfully deleted!');
    }

    public function deleteCustomer($id){

        $customer = User::findOrFail($id);
        $customer->delete();

        return redirect()->back()->with('success', 'Customer successfully deleted!');
    }

    public function paymentApproved($id){

        $ticket = Ticket::findOrFail($id);
        $ticket->paid_status = 'approved';
        $ticket->save();

        return redirect()->back()->with('success', 'Payment status updated successfully!');
    }

    public function paymentProcessing($id){

        $ticket = Ticket::findOrFail($id);
        $ticket->paid_status = 'processing';
        $ticket->save();

        return redirect()->back()->with('success', 'Payment status updated successfully!');
    }

    public function paymentPaid($id){

        $ticket = Ticket::findOrFail($id);
        $ticket->paid_status = 'paid';
        $ticket->paid_date = Carbon::now();
        $ticket->save();

        return redirect()->back()->with('success', 'Payment status updated successfully!');
    }

}
