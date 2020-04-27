<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Admin\Login;
use App\Http\Controllers\Admin\Subscribers;

class ApiController extends Controller
{
    /**
     * method to take inputs for the login
     */
    public function loginAppUser(Request $request) {
        $email = $request->email;
        if(!empty($email)) {
            echo "Email = ".$email; exit;
            $cLogin = new Login();
            $doLogin = $cLogin->index($request);
            return $doLogin;
        }
    }

    /**
     * method to take inputs for the subscription
     */
    public function subscribeAppUser(Request $request) {
        $email = $request->email;
        if(!empty($email)) {
            echo "Email = ".$email;
            $cSubscribers = new Subscribers();
            $addSubscribers = $cSubscribers->add_contact($request);
            return $addSubscribers;
        }
        /*$rules = ['email'=>'required'];
        $validator = Validator::make($request->all(),$rules);
        if($validator->passes()) {
            $checkExistingUser = UsersModel::checkEmailExist($email);
            if($checkExistingUser > 0) {
                return Response::json(['error'=>true,'msg'=>'Contact is already subscribed.']);
            } else {
                return Response::json(['error'=>false,'msg'=>$request->email.' Contact subscribed successfully.']);
            }
        } else {
            return Response::json(['error'=>true,'msg'=>'Required fields are missing.']);
        }*/
    }
}
