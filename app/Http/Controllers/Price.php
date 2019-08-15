<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\MembershipModel;

class Price extends Controller {

    public function index() {
        $aMembership = MembershipModel::getActiveMembership();
        return view('price', array('membership_data' => $aMembership));
    }

}
