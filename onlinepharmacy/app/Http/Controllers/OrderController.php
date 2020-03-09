<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'shipping_fullname' => 'required',
            'shipping_address' => 'required',
            'shipping_city' => 'required',
            'shipping_phone' => 'required','digits_between:0,9',
            'payment_method' => 'required',
        ]);

        $order = new Order();

        $order->order_number = uniqid('OrderNumber-');

        $order->shipping_fullname = $request->input('shipping_fullname');
        $order->shipping_address = $request->input('shipping_address');
        $order->shipping_city = $request->input('shipping_city');
        $order->shipping_phone = $request->input('shipping_phone');

        //billing information dose not have default values
        //so i assign same shipping information details for billing information
        //there is no form fields for billing.

        if(!$request->has('billing_fullname')) {

            //if request dose not have billing_fullname ,those releted information
            //filled by default or shipping informaion , in that case billing and shipping details
            //become same.

            $order->billing_fullname = $request->input('shipping_fullname');
            $order->billing_address = $request->input('shipping_address');
            $order->billing_city = $request->input('shipping_city');
            $order->billing_phone = $request->input('shipping_phone');

        }else {
            $order->billing_fullname = $request->input('billing_fullname');
            $order->billing_address = $request->input('billing_address');
            $order->billing_city = $request->input('billing_city');
            $order->billing_phone = $request->input('billing_phone');

        }

        $order->grand_total = \Cart::session(auth()->id())->getTotal();
        $order->item_count = \Cart::session(auth()->id())->getContent()->count();

        $order->user_id = auth()->id();

        if (request('payment_method') == 'paypal') {
            $order->payment_method = 'paypal';
        }

        $order->save();

        //save order items

        $cartItems = \Cart::session(auth()->id())->getContent();

        foreach($cartItems as $item) {
            $order->items()->attach($item->id, ['price'=> $item->price, 'quantity'=> $item->quantity]);
        }


        //payment
        if(request('payment_method') == 'paypal') {
                //redirect to paypal
            return redirect()->route('paypal.checkout', $order->id);

        }

        //empty cart
        \Cart::session(auth()->id())->clear();
        //send email to customer

        return redirect()->route('home')->withMessage('Order has been placed');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
