<?php

namespace App\Http\Controllers\Api\Email;

use App\Http\Controllers\Controller;
use App\Mail\BuyerOrderDeliveredMail;
use App\Mail\BuyerOrderProductionMail;
use App\Mail\BuyerOrderShippedMail;
use App\Mail\OrderMail;
use App\Mail\PasswordResetMail;
use App\Mail\ProductListingConfirmMail;
use App\Mail\SellerNewOrderMail;
use App\Mail\SellerOrderDeliveredMail;
use App\Mail\SellerOrderDispatchMail;
use App\Mail\SellerWelcomeMail;
use App\Mail\StoreActiveApplicationMail;
use App\Mail\StoreActiveMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles all outgoing emails.
    |
    */

    public function __construct()
    {
        $this->middleware('auth:api')->except('sendSellerWelcomeMail');
    }

    /** 
    * Sends welcome email to seller after registration.
    */

    public function sendSellerWelcomeMail($email)
    {
        Mail::to($email)->send(new SellerWelcomeMail($email));

        return Mail::failures() != 0 ? "Email has been sent successfully." : "Oops! There was some error sending the email.";
    }

    /** 
    * Sends email to seller after they submit store activation form.
    */

    public function sendStoreActiveApplicationMail()
    {
        Mail::to(auth()->user()->email)->send(new StoreActiveApplicationMail());

        return Mail::failures() != 0 ? "Email has been sent successfully." : "Oops! There was some error sending the email.";
    }

    /** 
    * Sends email informing seller that their store status is active.
    */

    public function sendStoreActiveMail($email)
    {
        Mail::to($email)->send(new StoreActiveMail());

        return Mail::failures() != 0 ? "Email has been sent successfully." : "Oops! There was some error sending the email.";
    }

    /** 
    * Sends email to seller that a new product has been listed.
    */

    public function sendProductListingConfirmedMail()
    {
        Mail::to(auth()->user()->email)->send(new ProductListingConfirmMail());

        return Mail::failures() != 0 ? "Email has been sent successfully." : "Oops! There was some error sending the email.";
    }

    /** 
    * Sends email informing seller that their password has been changed.
    */

    public function sendPasswordResetMail()
    {
        Mail::to(auth()->user()->email)->send(new PasswordResetMail());

        return Mail::failures() != 0 ? "Email has been sent successfully." : "Oops! There was some error sending the email.";
    }

    /** 
    * Sends email informing buyer a new order has been placed.
    */

    public function sendBuyerOrderMail($order)
    {
        Mail::to($order->email)->send(new OrderMail($order));

        return Mail::failures() != 0 ? "Email has been sent successfully." : "Oops! There was some error sending the email.";
    }

    /** 
    * Sends email informing buyer an order has been delivered.
    */

    public function sendBuyerOrderDeliveredMail($order)
    {
        Mail::to($order->email)->send(new BuyerOrderDeliveredMail($order));

        return Mail::failures() != 0 ? "Email has been sent successfully." : "Oops! There was some error sending the email.";
    }

    /** 
    * Sends email informing buyer an order is being prepared.
    */

    public function sendBuyerOrderProductionMail($order)
    {
        Mail::to($order->email)->send(new BuyerOrderProductionMail($order));

        return Mail::failures() != 0 ? "Email has been sent successfully." : "Oops! There was some error sending the email.";
    }

    /** 
    * Sends email informing buyer an order has been shipped.
    */

    public function sendBuyerOrderShippedMail($order)
    {
        Mail::to($order->email)->send(new BuyerOrderShippedMail($order));

        return Mail::failures() != 0 ? "Email has been sent successfully." : "Oops! There was some error sending the email.";
    }

    /** 
    * Sends email informing seller a new order has been placed.
    */

    public function sendSellerOrderMail($email, $order)
    {
        Mail::to($email)->send(new SellerNewOrderMail($order));

        return Mail::failures() != 0 ? "Email has been sent successfully." : "Oops! There was some error sending the email.";
    }
    /** 
    * Sends email informing seller an order has been delivered.
    */

    public function sendSellerOrderDeliveredMail($email, $order)
    {
        Mail::to($email)->send(new SellerOrderDeliveredMail($order));

        return Mail::failures() != 0 ? "Email has been sent successfully." : "Oops! There was some error sending the email.";
    }
    /** 
    * Sends email informing seller an order has been dispatched.
    */

    public function sendSellerOrderDispatchMail($email, $order)
    {
        Mail::to($email)->send(new SellerOrderDispatchMail($order));

        return Mail::failures() != 0 ? "Email has been sent successfully." : "Oops! There was some error sending the email.";
    }


}
