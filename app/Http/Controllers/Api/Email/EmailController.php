<?php

namespace App\Http\Controllers\Api\Email;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Mail\PasswordResetMail;
use App\Mail\ProductListingConfirmMail;
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
        $this->middleware('auth:api');
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
    * Sends email informing seller a new order has been placed.
    */

    public function sendOrderMail()
    {
        Mail::to('mohorimaislamtamanna@gmail.com')->send(new OrderMail());

        return Mail::failures() != 0 ? "Email has been sent successfully." : "Oops! There was some error sending the email.";
    }
}
