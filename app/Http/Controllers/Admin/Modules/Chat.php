<?php
namespace App\Http\Controllers\Admin\Modules;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\UsersModel;
use App\Models\Admin\BrandboostModel;
use App\Models\Admin\Modules\ChatsModel;
use App\Models\Admin\Modules\NpsModel;
use App\Models\Admin\SubscriberModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Filesystem\Filesystem;
use Session;

class Chat extends Controller {
	
	/**
	* Used to get chat data list
	* @return type
	*/
    public function index() {

        $aUser = getLoggedUser();
        $userRole = $aUser->user_role;
        $userID = $aUser->id;
        $bActiveSubsription = UsersModel::isActiveSubscription();
        $oPrograms = ChatsModel::getChatLists($userID, $userRole);

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs">Widgets </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Chat Widgets" class="sidebar-control active hidden-xs ">Chat Widgets</a></li>
                    </ul>';

        $aData = array(
            'title' => 'Chat Module',
            'pagename' => $breadcrumb,
            'oPrograms' => $oPrograms,
            'bActiveSubsription' => $bActiveSubsription
        );
		
		return view('admin.modules.chat.index', $aData);
    }
	
	/**
	* Used to get chat data list
	* @return type
	*/
    public function addChat(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $title = $request->title;
        //$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        //$hashcode = '';
		/*for ($i = 0; $i < 20; $i++) {
            $hashcode .= $characters[rand(0, 61)];
        }*/
		$str=rand(); 
		$hashcode = sha1($str); 
        $hashcode = $hashcode . date('Ymdhis');
        $aData = array(
            'hashcode' => $hashcode,
            'user_id' => $userID,
            'title' => $title,
            'status' => 'draft',
            'created' => date("Y-m-d H:i:s")
        );
        $insertID = ChatsModel::addChat($aData);

        if ($insertID) {
            $response = array('status' => 'success', 'id' => $insertID, 'msg' => "Success");

            //Send notification only to admin
            $notificationData = array(
                'event_type' => 'configured_new_chat',
                'event_id' => 0,
                'link' => base_url().'admin/modules/chat/setup/'.$insertID,
                'message' => 'Created new chat.',
                'user_id' => $userID,
                'status' => 1,
                'created' => date("Y-m-d H:i:s")
            );
			
            $eventName = 'sys_chat_configured';
			
            add_notifications($notificationData, $eventName, $userID);
        }
        echo json_encode($response);
        exit;
    }

	/**
	* Used to get setup configuration data
	* @param type $chatID
	* @return type
	*/
    public function setup($chatID, Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        $bActiveSubsription = UsersModel::isActiveSubscription();
        $selectedTab = $request->t;

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a href="'.base_url('admin/modules/chat/').'" class="sidebar-control hidden-xs">Chat </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Setup" class="sidebar-control active hidden-xs ">Setup</a></li>
                    </ul>';

        //NPS related account details
        $oChat = ChatsModel::getChat($userID, $chatID);
        
       if (!empty($oChat)) {
            // Do nothing for now
            $programID = $oChat->id;
            $defaultTab = !empty($selectedTab) ? $selectedTab : 'customize';
        }
        $defaultTab = !empty($selectedTab) ? $selectedTab : 'customize';
        //List of Advocates related data 
        $hashCode = $oChat->hashcode;

        $bActiveSubsription = UsersModel::isActiveSubscription();
        $aData = array(
            'bActiveSubsription' => $bActiveSubsription,
            'title' => 'Survery Setup',
            'pagename' => $breadcrumb,
            'defalutTab' => $defaultTab,
            'programID' => $programID,
            //'campaignTemplates' => $campaignTemplates,
            'oChat' => $oChat,
            'userID' => $userID,
            'userData' => $aUser,
            'user_role' => $user_role
        );

		return view('admin.modules.chat.set-up', $aData);
    }
	
	/**
	* Used to get setup configuration data
	* @param type $chatID
	* @return type
	*/
	public function publishChatCampaign(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $chatId = $request->chatId;
        $aData = array(
            'status' => 'active',
        );
        if ($chatId > 0) {
            $bUpdateID = ChatsModel::updateChat($aData, $userID, $chatId);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'id' => $bUpdateID, 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }
	
	/**
	* Used to update customize chat settings
	* @return type
	*/
	public function updateChatCustomize(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $chatID = $request->chat_id;
        $title = $request->title;
        $description = $request->description;
        $domain = $request->domain;

        $logo_show = $request->logo_show;
        $title_show = $request->title_show;
        $subtitle_show = $request->subtitle_show;
        $atttachment_show = $request->atttachment_show;
        $smilie_show = $request->smilie_show;
        $trigger_time = $request->trigger_time;
        $trigger_message = $request->trigger_message;
		$gift_message = $request->gift_message;
        $allow_gift_message = $request->allow_gift_message;
        $desktop_visiable = $request->desktop_visiable;
        $mobile_visiable = $request->mobile_visiable;

        $aData = array(
            'updated' => date("Y-m-d H:i:s")
        );

        if (!empty($title)) {
            $aData['title'] = $title;
        }
        if (!empty($description)) {
            $aData['description'] = $description;
        }
        if(!empty($domain)) {
            $aData['domain'] = $domain;
        }
        if(!empty($logo_show)) {
            $aData['logo_show'] = 1;
        }
        else {
             $aData['logo_show'] = 0;
        }
        if(!empty($title_show)) {
            $aData['title_show'] = 1;
        }
        else {
            $aData['title_show'] = 0;
        }
        if(!empty($subtitle_show)) {
            $aData['subtitle_show'] = 1;
        }
        else {
            $aData['subtitle_show'] = 0;
        }
        if(!empty($atttachment_show)) {
            $aData['atttachment_show'] = 1;
        }
        else {
            $aData['atttachment_show'] = 0;
        }
        if(!empty($smilie_show)) {
            $aData['smilie_show'] = 1;
        }
        else {
            $aData['smilie_show'] = 0;
        }
        if(!empty($desktop_visiable)) {
            $aData['desktop_visiable'] = 1;
        }
        else {
            $aData['desktop_visiable'] = 0;
        }
        if(!empty($mobile_visiable)) {
            $aData['mobile_visiable'] = 1;
        }
        else {
            $aData['mobile_visiable'] = 0;
        }
		
		if(!empty($allow_gift_message)) {
            $aData['allow_gift_message'] = 1;
        }
        else {
            $aData['allow_gift_message'] = 0;
        }

        $aData['gift_message'] = $gift_message;
        $aData['trigger_time'] = $trigger_time;
        $aData['trigger_message'] = $trigger_message;

        
        if ($chatID > 0) {
            $bUpdateID = ChatsModel::updateChat($aData, $userID, $chatID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'id' => $bUpdateID, 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }
	
	/**
	* Used to update chat status
	* @return type
	*/
    public function changeStatus(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $chatID = $request->chatID;
        $status = $request->status;
        $aData = array(
            'status' => $status,
        );
        if ($chatID > 0) {
            $bUpdateID = ChatsModel::updateChat($aData, $userID, $chatID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'id' => $bUpdateID, 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }
	
	/**
	* Used to update chat design page data
	* @return type
	*/
    public function updateChatDesign(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $chatID = $request->chat_id;
        $chat_logo = $request->chat_logo;
        $company_info_switch = $request->company_info_switch;
        $company_title = $request->company_title;
        $company_description = $request->company_description;
        $position = $request->position;

        $solid_color = $request->solid_color;
        $color_orientation = $request->color_orientation;
        $main_colors = $request->main_colors;
        $custom_colors1 = $request->custom_colors1;
        $custom_colors2 = $request->custom_colors2;
        $main_color_switch = $request->main_color_switch != '' ? '1' : '0';
        $custom_color_switch = $request->custom_color_switch != '' ? '1' : '0';
        $solid_color_switch = $request->solid_color_switch != '' ? '1' : '0';

        $chat_icon = $request->chat_icon;
        $branding = $request->branding != '' ? '1' : '0';
        $notification = $request->notification != '' ? '1' : '0';


        $aData = array(
            'updated' => date("Y-m-d H:i:s")
        );

        if(!empty($chat_logo)) {
            $aData['chat_logo'] = $chat_logo;
        }
       
        if(!empty($company_title)) {
            $aData['company_title'] = $company_title;
        }
        if(!empty($company_description)) {
            $aData['company_description'] = $company_description;
        }
        $aData['position'] = $position;
        $aData['header_color'] = $main_colors;
        $aData['header_solid_color'] = $solid_color;
        $aData['header_custom_color1'] = $custom_colors1;
        $aData['header_custom_color2'] = $custom_colors2;
        $aData['header_color_solid'] = $solid_color_switch;
        $aData['header_color_fix'] = $main_color_switch;
        $aData['header_color_custom'] = $custom_color_switch;
        $aData['chat_icon'] = trim($chat_icon);
        $aData['branding'] = $branding;
        $aData['color_orientation'] = $color_orientation;
        $aData['notification'] = $notification;

        if ($chatID > 0) {
            $bUpdateID = ChatsModel::updateChat($aData, $userID, $chatID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'id' => $bUpdateID, 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }
		
	/**
	* Used to update chat preferences page data
	* @return type
	*/
    public function updateChatPreferences(Request $request) {

        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $chatID = $request->chat_id;
        $contactDetails = $request->contact_details_config;
        $messages = serialize($request->messages);
        $time = serialize($request->time);
        $automated_message = $request->automated_message != '' ? '1' : '0';
        //pre($post);
        $aData['automated_message'] = $automated_message;
        $aData['messages'] = $messages;
        $aData['time'] = $time;
        $aData['contact_details_config'] = $contactDetails == 'on' ? 1 : 0;

        if ($chatID > 0) {
            $bUpdateID = ChatsModel::updateChat($aData, $userID, $chatID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'id' => $bUpdateID, 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }

	/**
	* Used to update chat preferences page data
	* @return type
	*/
    public function getChat(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $chatID = $request->chat_id;
        $oChat = ChatsModel::getChat($userID, $chatID);
        if (!empty($oChat)) {
            $response = array('status' => 'success', 'id' => $oChat->id, 'title' => $oChat->title);
        } else {
            $response = array('status' => 'error', 'msg' => 'Not found');
        }

        echo json_encode($response);
        exit;
    }
	
	/**
	* Used to update chat page data
	* @return type
	*/
    public function updateChat(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $chatID = $request->chat_id;
        $title = $request->title;
        $aData = array(
            'title' => $title,
            'updated' => date("Y-m-d H:i:s")
        );
        if ($chatID > 0) {
            $bUpdateID = ChatsModel::updateChat($aData, $userID, $chatID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'id' => $bUpdateID, 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }
	
	/**
	* Used to update chat archive status
	* @return type
	*/
    public function moveToArchiveChat(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $chatID = $request->chat_id;
        $aData = array(
            'status' => 'archive',
            'updated' => date("Y-m-d H:i:s")
        );

        if ($chatID > 0) {
            $bUpdateID = ChatsModel::updateChat($aData, $userID, $chatID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }

	/**
	* Used to delete chat data
	* @return type
	*/
    public function deleteChat(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $chatID = $request->chat_id;
        if ($chatID > 0) {
            $bDeleted = ChatsModel::deleteChat($userID, $chatID);
            if ($bDeleted) {
                $response = array('status' => 'success', 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }

	/**
	* Used to delete bulk chat data
	* @return type
	*/
    public function bulkDeleteChat(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $chatIDs = $request->bulk_chat_id;
        if (!empty($chatIDs)) {
            foreach ($chatIDs as $chatID) {
                $bDeleted = ChatsModel::deleteChat($userID, $chatID);
            }
        }
        if ($bDeleted) {
            $response = array('status' => 'success', 'msg' => "Success");
        }
        echo json_encode($response);
        exit;
    }

	/**
	* Used to update bulk chat archive data
	* @return type
	*/
    public function bulkArchiveChat(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $chatIDs = $request->bulk_chat_id;
        $aData = array(
            'status' => 'archive',
            'updated' => date("Y-m-d H:i:s")
        );

        if (!empty($chatIDs)) {
            foreach ($chatIDs as $chatID) {
                $bUpdateID = ChatsModel::updateChat($aData, $userID, $chatID);
            }
        }

        if ($bUpdateID) {
            $response = array('status' => 'success', 'msg' => "Success");
        }
        echo json_encode($response);
        exit;
    }


}