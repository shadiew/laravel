<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LandingController extends Controller
{
    public function index()
    {
        return view('/content/landing', [
            // 'breadcrumbs' => $breadcrumbs,
            // 'user' => $user,
            // 'totalOrder' => $totalOrder,
            // 'totalDeposit' => $totalDeposit
        ]);
    }

    public function send(Request $request)
    {
        $this->validate($request, [
            'subject'     =>  'required',
            'email'  =>  'required|email',
            'message' =>  'required'
        ]);

        // dd($request);

        $data = array(
            'email'      =>  $request->email,
            'subject'   =>   $request->subject,
            'message'   =>   $request->message
        );

        Mail::to('tokofollowerdotcom@gmail.com')->send(new ContactMail($data));
        return back()->with('success', 'Terima kasih sudah menghubungi kami!');
    }
}
