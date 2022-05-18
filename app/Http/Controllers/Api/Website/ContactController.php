<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(ContactRequest $request)
    {
        Mail::to("contact@lavisco.lk")->send(new ContactMail($request));

        return Mail::failures() != 0 ? "Email has been sent successfully." : "Oops! There was some error sending the email.";
    }
}
