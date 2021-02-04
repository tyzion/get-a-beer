<?php

namespace App\Http\Controllers;

use App\Mail\ContactReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $name = $request->input('name');
        $surname = $request->input('surname');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $message = $request->input('message');

        $form = compact(['name', 'surname', 'phone', 'email', 'message']);
        $emailAdmin = 'Tiziano@outlook.tizio';
        $contactMail = new ContactReceived($form);
        Mail::to($emailAdmin)->send($contactMail);
        return redirect(route('contacts.thankyou'));
    }
    
    public function thankyou()
    {
        return view('contacts.thankyou');
    }
}
