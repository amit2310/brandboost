<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SmsChat extends Controller
{
    public function index(Request $request) {

        return view('admin.sms_chat.index');
   }
}
