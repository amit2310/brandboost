<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\SmsChatModel;
use App\Models\Admin\WebChatModel;
use App\Models\Admin\SubscriberModel;
use Session;

class WebChat extends Controller
{

	 /**
     * 
     * Index controller
     */
    public function index() {
       
        $oUser = getLoggedUser();

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Live Chat" class="sidebar-control active hidden-xs ">Live Chat</a></li>
                      </ul>';

        $oContacts = SubscriberModel::getGlobalSubscribers($oUser->id);
        $favouriteUserData = SmsChatModel::getSMSFavouriteByUserId($oUser->id);
        $webChatModel = new WebChatModel();
        $isLoggedInTeam = Session::get("team_user_id");
        if(!empty($isLoggedInTeam)) {
            $assignedChat = $webChatModel->getTeamAssign($isLoggedInTeam);
            $assignedChatData = $webChatModel->getTeamAssignData($isLoggedInTeam);
            $loggedYou = $isLoggedInTeam;
        }
        else {

        	$assignedChat = $webChatModel->getTeamAssign($oUser->id);
        	$assignedChatData = $webChatModel->getTeamAssignData($oUser->id);
            $loggedYou = $oUser->id;
        }
        
        $unassignedChat = $webChatModel->getTeamAssign(0);
        $unassignedChatData = $webChatModel->getTeamAssignData(0);
        
		

        $data = array(
            'title' => 'Chat System',
            'pagename' => $breadcrumb,
            'usersdata' => $oContacts,
            'favouriteUserData' => $favouriteUserData,
            'loginUserData' => $oUser,
            'totalSubscriber' => count($oContacts),
            'unassignedChat'=> $unassignedChat,
            'assignedChat' => $assignedChat,
            'assignedChatData' => $assignedChatData,
            'unassignedChatData' => $unassignedChatData,
            'loggedYou' => $loggedYou
        );

        return view('admin.web_chat.index', $data);
    }

    public function getUserinfo() {

        echo 'testing';
        die();
        $post = $this->input->post();
        $userId = $post['userId'];
        $token = $post['token'];
        $userDataDetail = getUserDetail($userId);
        $incid = getincIdByuserId($userDataDetail->id);
        $sbscriberTableDetails = getSubscriberDetails($incid[0]->id);
        $assignto = assignto($token);

        if (strlen($userId) > 10) {
            $userDetail = getSupportUser($userId);
            $taglist = getTagsByReviewID($userId);
            $userId_encode = base64_url_encode($userId);
            $user_name_ex = explode(" ", $userDetail[0]->user_name);
            $avatar = showUserAvtar($userDataDetail->avatar, $user_name_ex[0], $user_name_ex[1], 84, 84, 24);
            $arr = array();
            $arr[0]['email'] = $userDetail[0]->email != '' ? $userDetail[0]->email : 'Add Email';
            $arr[1]['name'] = $user_name_ex[0] . ' ' . $user_name_ex[1];
            $arr[2]['phone'] = $userDetail[0]->phone != '' ? $userDetail[0]->phone : 'Add Phone';
            $arr[3]['avatar'] = $avatar;
            $arr[4]['avatar_url'] = $userDataDetail->avatar;
            $arr[5]['incId'] = $post['incId'];
            $arr[6]['city'] = $userDetail->cityName;
            $arr[7]['code'] = $userDetail->country_code;
            $arr[8]['gender'] = $userDetail->gender;
            $arr[9]['avfinder'] = $userDataDetail->avatar;
            $arr[10]['userId_encode'] = $userId_encode;
            $arr[11]['taglist'] = $taglist;
            $arr[12]['assign_to'] = $assignto;
            $arr[13]['assign_team_member'] = $userDetail[0]->assign_team_member;
        } else {

            $avatar = showUserAvtar($userDataDetail->avatar, $userDetail->firstname, $userDetail->lastname, 28, 28, 11);
            $arr = array();
            $arr[0]['email'] = $sbscriberTableDetails->email;
            $arr[1]['name'] = $sbscriberTableDetails->firstname . ' ' . $sbscriberTableDetails->lastname;
            $arr[2]['phone'] = $sbscriberTableDetails->phone;
            $arr[3]['avatar'] = $avatar;
            $arr[4]['avatar_url'] = $userDataDetail->avatar;
            $arr[5]['incId'] = $post['incId'];
            $arr[6]['city'] = $sbscriberTableDetails->cityName;
            $arr[7]['code'] = $sbscriberTableDetails->country_code;
            $arr[8]['gender'] = $sbscriberTableDetails->gender;
            $arr[9]['avfinder'] = $userDataDetail->avatar;
        }



        echo json_encode($arr);
    }
}
