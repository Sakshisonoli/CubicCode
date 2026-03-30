<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Support\Str;
use App\Models\Charges;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketSold;
use App\Mail\OrderConfirmation;

class OrderController extends Controller
{
    protected $phonepe;

    public function __construct()
    {
        $this->phonepe = new \App\Services\PhonePeService();
    }

    public function createOrder(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['error' => 'Invalid Request'], 400);
        }

        $validated = $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
        ]);

        $ticket = Ticket::find($request->ticket_id);
        if (!$ticket) {
            return response()->json(['error' => 'Ticket not found'], 404);
        }

        // if ($ticket->max_price != $request->price) {
        //     return response()->json(['error' => 'Invalid ticket price'], 400);
        // }

        try {
            // $amount = $ticket->max_price;
            $amount = $request->price;
            $orderId = 'ORDER_' . time() . '_' . Str::random(6);

            $order = Order::create([
                'order_id' => $orderId,
                'customer_id' => auth()->id(),
                'ticket_id' => $request->ticket_id,
                'ticket_price' => $amount,
                'no_of_tickets' => $request->quantity,
                'total_price' => $amount * $request->quantity,
                'mode' => 'online',
                'status' => 'pending',
            ]);

            $redirectUrl = route('order.verify', ['merchantId' => $orderId]);

            $paymentUrl = $this->phonepe->generatePaymentRequest($orderId, $amount, $redirectUrl);

            return response()->json([
                'success' => true,
                'redirectUrl' => $paymentUrl
            ]);

        } catch (\Exception $e) {
            \Log::error('PhonePe Payment Error', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Payment failed: ' . $e->getMessage()], 500);
        }
    }

    public function verifyPayment(Request $request)
    {
        $orderId = $request->query('merchantId');
        $paymentStatus = $this->phonepe->checkPaymentStatus($orderId);
        if($paymentStatus['state'] == "COMPLETED"){
            $order = Order::where('order_id', $orderId)->first();
            if ($order) {
                $order->status = 'completed';
                $order->save();

                $ticket = Ticket::find($order->ticket_id);
                $ticket->purchaser_id = $order->customer_id;
                $ticket->status = 'sold';
                $ticket->save();

                $email = $ticket->owner->email;
                $name = $ticket->owner->name;
                $eventName = $ticket->event->event_name;
                $buyerName = $order->customer->name;
                $deliveryType = $ticket->delivery_type;
                $totalPrice = $order->total_price;
                $seat = $ticket->seat->seat_level;
                $buyerEmail = $order->customer->email;

                Mail::to($email)->send(new TicketSold($name, $eventName, $buyerName, $deliveryType));
                Mail::to($buyerEmail)->send(new OrderConfirmation($name, $eventName, $deliveryType, $totalPrice, $seat));

                return redirect()->route('order.success')->with('success', 'Payment completed successfully!');
            }
        }

        return redirect()->route('order.failed')->with('error', 'Payment verification failed.');
    }

    // public function verifyPayment(Request $request)
    // {
    //     $orderId = $request->query('merchantId');
    //     $order = Order::where('order_id', $orderId)->first();
    //     if ($order) {
    //         $order->status = 'completed';
    //         $order->save();

    //         $ticket = Ticket::find($order->ticket_id);
    //         $ticket->purchaser_id = $order->customer_id;
    //         $ticket->status = 'sold';
    //         $ticket->save();

    //         $email = $ticket->owner->email;
    //         $name = $ticket->owner->name;
    //         $eventName = $ticket->event->event_name;
    //         $buyerName = $order->customer->name;
    //         $deliveryType = $ticket->delivery_type;
    //         $totalPrice = $order->total_price;
    //         $seat = $ticket->seat->seat_level;
    //         $buyerEmail = $order->customer->email;

    //         Mail::to($email)->send(new TicketSold($name, $eventName, $buyerName, $deliveryType));
    //         Mail::to($buyerEmail)->send(new OrderConfirmation($name, $eventName, $deliveryType, $totalPrice, $seat));

    //         return redirect()->route('order.success')->with('success', 'Payment completed successfully!');
    //     }

    //     return redirect()->route('order.failed')->with('error', 'Payment verification failed.');
    // }

    public function orderSuccess()
    {
        return view('frontend.orders.success');
    }

    public function orderFailed()
    {
        return view('frontend.orders.failed');
    }


    public function checkout($id){

        $ticket = Ticket::findOrFail($id);

        $charges = Charges::all();

        foreach ($charges as $charge) {
            if ($ticket->min_price >= $charge->min_amt && $ticket->min_price <= $charge->max_amt) {

                $chargeAmt = $charge->charges;
                break;
            }
        }

        return view('frontend.orders.checkout', compact('ticket', 'chargeAmt'));
    }

    public function checkoutTickets(Request $request, $id){

        $validated = $request->validate([
            'selected_qty' => 'required',
        ]);

        $ticket = Ticket::findOrFail($id);
        if (!$ticket) {
            return response()->json(['error' => 'Ticket not found'], 404);
        }

        $qty = $request->selected_qty;
        $price = $ticket->min_price;
        $charge = $ticket->max_price - $ticket->min_price;
        $totalPrice = $qty * $ticket->max_price;

        return view('frontend.orders.checkout_order', compact('ticket', 'qty', 'price', 'charge', 'totalPrice'));
    }
}
