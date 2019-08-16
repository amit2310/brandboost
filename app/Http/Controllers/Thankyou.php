<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class Thankyou extends Controller {

    public function index() {
        return view('thankyou');
    }

}
