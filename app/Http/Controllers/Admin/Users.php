<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Admin\UsersModel;


class Users extends Controller
{
	/**
     * Update user record
     * @return type 
     */
    public function updateUserData() {

        $fieldName = Input::post("fieldName");
        $userId = Input::post("userId");
        $aData = array(
            $fieldName => 0
        );
        $mUser = new UsersModel();
        $result = $mUser->updateUsers($aData, $userId);
        if ($result) {
            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }
}
