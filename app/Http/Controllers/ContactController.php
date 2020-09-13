<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendContactMailJob;
use App\User;
use App;

class ContactController extends Controller
{

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function index()
    {
        
        return view('contact');
    }

    public function sendMessage(Request $request)
    {
        //email will be sent to admin and managers
        $users = User::whereIn('role', ['admin', 'manager'])->get();
    
        $this->validate($request, [
            'firstname' => 'required',
            'familyname' => 'required',
            'email' => 'required',
            'message' => 'required',
            'captcha' => 'required|captcha'
        ]);
        $details = [
            'title' => 'Message posté sur le site de Denentzat par ' . $request->firstname . ' ' . $request->familyname,
            'body' => $request->message,
            'reply_to' => $request->email
        ];
        foreach ($users as $user) {
            $details['user'] = $user;
            $job = (new SendContactMailJob($details));
            dispatch($job);
        }

        return redirect('contact')->with('success', 'Votre message a été posté. Merci de nous contacter. Nous vous répondrons, le cas échéant, dans les meilleurs délais. !');
    }
}
