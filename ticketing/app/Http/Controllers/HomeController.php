<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stadium;
use App\Models\Event;
use App\Models\User;
use App\Models\Seat;
use App\Models\Ticket;
use App\Models\Biding;
use Carbon\Carbon;
use App\Models\Charges;
use App\Mail\TicketSubmitMail;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function homePage(){

        $events = Event::where('status', 'active')->orderBy('id', 'desc')->take(4)->get();
        // $events = Event::select('event_name', 'artist_name', 'event_photo', 'id')->distinct()->get();
        $comedyShows = Event::where('status', 'active')->where('category', 'Comedy')->orderBy('id', 'desc')->take(4)->get();
        $rockMusics = Event::where('status', 'active')->where('category', 'Rock Music')->orderBy('id', 'desc')->take(4)->get();

        $sliders = Event::where('status', 'active')->where('addition', 'On')->orderBy('id', 'desc')->take(6)->get();

        return view('frontend.main_pages.home', compact('events', 'comedyShows', 'rockMusics', 'sliders'));
    }

    public function about(){
        return view('frontend.main_pages.about_us');
    }

    public function sellTickets(){

        $allEvents = Event::where('status', 'active')->orderBy('id', 'desc')->take(8)->get();

        return view('frontend.events.search_sell_ticket', compact('allEvents'));
    }

    public function searchEvents(Request $request){

        $query = $request->get('query');

        $events = Event::where('event_name', 'LIKE', "%{$query}%")->orWhere('artist_name', 'LIKE', "%{$query}%")
            ->orWhere('event_location', 'LIKE', "%{$query}%")->orWhere('event_stadium', 'LIKE', "%{$query}%")
            ->orWhere('event_date', 'LIKE', "%{$query}%")->select('id', 'event_name', 'event_location', 'event_date', 'event_photo')->get();

        foreach ($events as $event) {
            if ($event->event_photo) {
                $event->event_photo = asset('events/' . $event->event_photo);
            } else {
                $event->event_photo = asset('events/no-image.webp');
            }
        }

        return response()->json($events);
    }

    public function eventTickets($id){

        $event = Event::findOrFail($id);

        return view('frontend.events.event_tickets', compact('event'));
    }

    public function sellTicketForm($id){

        if(!auth()->user()){
            return redirect()->route('login')->with('warning', 'Please login to list your ticket.');
        }

        $event = Event::findOrFail($id);
        $eventStadiumId = $event->stadium->id;
        $seats = Seat::where('stadium_id', $eventStadiumId)->get();

        return view('frontend.events.event_ticket_listing', compact('event', 'seats'));
    }

    public function submitTicket(Request $request){

        $this->validate($request, [
            'number_of_tickets' => 'required|integer|min:1',
            'event_id' => 'required',
            'owner_id' => 'required',
            'seat_id' => 'required',
            'seat_numbers' => 'required|array|min:1',
            'seat_numbers.*' => 'required|string|max:255',
            'min_price' => 'required|numeric|min:50',
            'features' => 'array|nullable',
            'limitations' => 'array|nullable',
            'about_you' => 'required|string',
            'listing_type' => 'required|string',
            'delivery_type' => 'required|string',
            'sell_type' => 'required|string',
            'about_ticket' => 'nullable|string',
            'reason' => 'required|string',
            'ticket_image1' => 'nullable|file|mimes:pdf,png,jpg,jpeg,webp|max:4048',
        ]);

        $requestTicket = $request->except(['_token', 'ticket_image1']);
        $requestTicket['seat_numbers'] = $request->input('seat_numbers');

        if($request->hasFile('ticket_image1')){
            $ticketPDF = $request->file('ticket_image1');

            if ($ticketPDF->getSize() > 4194304) {
                return redirect()->back()->with('error', 'The ticket image size must not exceed 4MB.');
            }

            $ticketPath = 'queues_' . rand() . '.' . $ticketPDF->getClientOriginalExtension();
            $ticketPDF->move(public_path('tickets/'), $ticketPath);
            $requestTicket['ticket_image1'] = $ticketPath;
        } else {
            $requestTicket['ticket_image1'] = null;
        }

        if($request->input('number_of_tickets') > 1 ){
            $requestTicket['total_min_price'] = $request->input('min_price') * $request->input('number_of_tickets');
        }

        $minPrice = $request->input('min_price');
        $charges = Charges::all();

        foreach ($charges as $charge) {
            if ($minPrice >= $charge->min_amt && $minPrice <= $charge->max_amt) {

                $requestTicket['max_price'] = $minPrice + $charge->charges;
                $requestTicket['total_max_price'] = ($minPrice + $charge->charges) * $request->input('number_of_tickets');
                break;
            }
        }

        $requestTicket['features'] = $request->has('features') ? json_encode($request->input('features')) : null;
        $requestTicket['limitations'] = $request->has('limitations') ? json_encode($request->input('limitations')) : null;
        $requestTicket['status'] = 'Unverified';
        Ticket::create($requestTicket);

        $customer = User::findOrFail($request->owner_id);
        $customerName = $customer->name;
        Mail::to($customer->email)->send(new TicketSubmitMail($customerName));

        return redirect()->back()->with('success', 'Your uploaded ticket has been submitted for review. Please check your Listings tab for updates shortly.');
    }

    public function eventDetails($id){

        $event = Event::findOrFail($id);
        $tickets = Ticket::where('event_id', $id)->get();

        return view('frontend.events.event_info', compact('event', 'tickets'));
    }

    public function exploreEvents(){

        $events = Event::where('status', 'active')->orderBy('id', 'desc')->get();

        return view('frontend.events.explore_events', compact('events'));
    }

    public function bidingPage($id){

        if(auth()->user()){
            $ticket = Ticket::findOrFail($id);
            $eId = $ticket->event_id;
            $event = Event::findOrFail($eId);
            $bidings = Biding::where('ticket_id', $id)->orderBy('id', 'desc')->take(4)->get();

            return view('frontend.events.biding_page', compact('event', 'ticket', 'bidings'));
        }
        else{
            return redirect()->route('login')->with('warning', 'Please login to buy or bid on any tickets!!');
        }

    }

    public function bidNow(Request $request){

        $this->validate($request, [
            'customer_id' => 'required',
            'ticket_id' => 'required',
            'event_id' => 'required',
            'bid_amt' => 'required',
            'ticket_qty' => 'required',
        ]);

        $ticket = Ticket::where('id', $request->input('ticket_id'))->first();
        if($ticket->number_of_tickets < $request->input('ticket_qty')){
            return redirect()->back()->with('error', 'Please enter a number of tickets less than or equal to the number of tickets available.');
        }

        $requestBid = $request->except(['_token']);
        $requestBid['bid_time'] = Carbon::now();
        $requestBid['status'] = 'processing';
        Biding::create($requestBid);

        return redirect()->back()->with('success', 'Your bid was sent successfully.');
    }

    public function searchCategory($category){

        $events = Event::where('category', $category)->get();

        return view('frontend.events.search_by_category', compact('events'));
    }

    public function selectedEventTickets($artist){

        $events = Event::where('artist_name', $artist)->where('status', 'active')->get();

        return view('frontend.events.selected_events_tickets', compact('events', 'artist'));
    }

    public function contact(){

        return view('frontend.main_pages.contact_us');
    }

    public function careGuarantee(){

        return view('frontend.main_pages.queuescare_guarantee');
    }

    public function termsAndContions(){

        return view('frontend.main_pages.terms_and_conditions');
    }

    public function privacyPolicy(){

        return view('frontend.main_pages.privacy_policy');
    }

    public function refundPolicy(){

        return view('frontend.main_pages.refund_policy');
    }

}
