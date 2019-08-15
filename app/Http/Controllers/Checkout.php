<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\MembershipModel;
use App\Models\Admin\UsersModel;
use App\Models\ProductsModel;
use Cookie;
use Session;

class Checkout extends Controller {

    public function buy(Request $request) {
        $plan_id = $request->plan_id;
        if (empty($plan_id)) {
            Session::flash('error_msg', "<strong>Plesae select your plan</strong>");
            redirect('price');
            exit;
        }
        
        //Instantiate product Model to get access to properties and method 
        $mProduct = new ProductsModel();

        if ($plan_id == 'decline') {
            $errMessage = $request->msg;
            $orderFormData = Session::get('orderFormData');
            if (empty($orderFormData)) {
                redirect('price');
            }
            $plan_id = $orderFormData['planid'];
            $aMembership = $mProduct->getCBPlanInfo($plan_id);
            return view('decline', array('membership_data' => $aMembership['data'], 'plan' => $aMembership['subs_cycle'], 'plan_id' => $plan_id, 'errMessage' => $errMessage));
        } else {
            $aMembership = $mProduct->getCBPlanInfo($plan_id);
            if (empty($aMembership)) {
                Session::flash('error_msg', "<strong>Selected plan is not valide or expired</strong>");
                redirect('price');
                exit;
            }
            $loggedUserID = Session::get('user_user_id');
            if ($loggedUserID > 0) {
                //$aUser = $this->mUser->getUserInfo($loggedUserID);
                Session::flash('error_msg', "<strong>You are logged in already</strong>");
                redirect('admin/login');
                exit;
            }
            return view('checkout', array('membership_data' => $aMembership['data'], 'plan' => $aMembership['subs_cycle'], 'plan_id' => $plan_id));
        }
    }

}
