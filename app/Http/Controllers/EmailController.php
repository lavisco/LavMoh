<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
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

    public function sendWelcomeEmail()
    {
        /** 
         * Store a receiver email address to a variable.
         */
        //$receiverEmailAddress = "islammohorima@gmail.com";

        /**
         * Import the Mail class at the top of this page.
         * Call the to() method for passing the 
         * receiver email address.
         * Call the send() method to include the
         * WelcomeMail class that contains the email template.
         */

        Mail::to('islammohrima@gmail.com')->send(new WelcomeMail());

        //return new WelcomeMail();

        /**
         * Check if the email has been sent successfully, or not.
         * Return the appropriate message.
         */
        
        if (Mail::failures() != 0) {
            return "Email has been sent successfully.";
        }
        return "Oops! There was some error sending the email.";
    }
}
