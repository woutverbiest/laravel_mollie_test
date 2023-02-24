<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;

class OrderController extends Controller
{
    public function pay(Request $request){
        $validated = $request->validate([
            'amount' => 'required|integer|between:10,100'
        ]);

        // user is redirected with errors if request not valid
        //dd($validated);

        $order = Order::create([
            'amount' => strval(number_format((float)$validated['amount'], 2, '.', ''))//Convert input to the correct format
        ]);

        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => $order->amount,
            ],
            "description" => "Order #".$order->id,
            "redirectUrl" => env('NGROK') . "/order/" . $order->id,
            "webhookUrl" => env('NGROK') . "webhook_mollie",
            "metadata" => [
                "order_id" => $order->id,
            ],
        ]);

        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function webhook(Request $request){
        $paymentId = $request->input('id');
        $payment = Mollie::api()->payments->get($paymentId);

        // $orderId = $payment->metadata->order_id;
    
        $order = Order::find(1);

        $order->mollie_id = $paymentId;
        $order->status = $payment->status;
        $order->save();

    }

    public function getOrder(Request $request, string $id){

        // $paymentId = $request->input('id');
        // $payment = Mollie::api()->payments->get('tr_gUCzoTpt6p');

        // dd($payment);

        $order = Order::find($id);

        return view('order', ['order' => $order]);
    }
}
