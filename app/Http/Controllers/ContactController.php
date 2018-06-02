<?php

namespace App\Http\Controllers;

use App\CurriculumVitae;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    protected function contact(request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $data = array();
        $data['name'] = $request->name;
        $data['surname'] = $request->surname;
        $data['email'] = $request->email;

        $data['messages'] = $request->message;

        if (isset($_POST['submit'])) {
            $secret = '6Lfb2iIUAAAAAE8lZxIpGxoKamfyLFa4ugY57c2e';
            $response = $_POST['g-recaptcha-response'];
            $remoteip = $_SERVER['REMOTE_ADDR'];

            $url = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip");
            $result = json_decode($url, TRUE);
            if ($result['success'] == 1) {

                Mail::send('emails/mail', $data, function($message) {
                    $message->from('info@worldsport.co.za', 'Worldsport');
                    $message->to('info@worldsport.co.za')->subject('Info Request');
                });

                return redirect('/contact-us')->with('message', 'Thank you, your message has been sent!');
            }else{
                return redirect('/contact-us')->with('message', 'Please complete recapcha.');
            }
        }
    }

    protected function careers()
    {

        return view('careers');
    }
}
