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
}
