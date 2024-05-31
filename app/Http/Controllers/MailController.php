<?php

namespace App\Http\Controllers;

use App\Mail\AccountCredentialMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send(){

        $details = [
            'nama' => 'Ahmad Rifai',
            'email' => 'ahmmd.riffai@gmail.com',
            'password' => '38jfdsdk'
        ];

        Mail::to('ahmmd.riffai@gmail.com')->send(new AccountCredentialMail($details));

        dd("Email sudah terkirim.");
    }
}
