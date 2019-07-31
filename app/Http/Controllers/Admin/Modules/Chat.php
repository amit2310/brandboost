<?php
namespace App\Http\Controllers\Admin\Modules;
//require 'aws/aws-autoloader.php';
//use Aws\S3\S3Client;
//use Aws\Exception\AwsException;

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

    public function addChat() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $title = strip_tags($post['title']);
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $hashcode = '';
        for ($i = 0; $i < 20; $i++) {
            $hashcode .= $characters[rand(0, strlen($characters))];
        }
        $hashcode = $hashcode . date('Ymdhis');
        $aData = array(
            'hashcode' => $hashcode,
            'user_id' => $userID,
            'title' => $title,
            'status' => 'draft',
            'created' => date("Y-m-d H:i:s")
        );
        $insertID = $this->mChat->addChat($aData);

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

    public function setup($chatID) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $selectedTab = $this->input->get('t');

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a href="'.base_url('admin/modules/chat/').'" class="sidebar-control hidden-xs">Chat </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Setup" class="sidebar-control active hidden-xs ">Setup</a></li>
                    </ul>';

        //NPS related account details
        $oChat = $this->mChat->getChat($userID, $chatID);
        
       if (!empty($oChat)) {
            // Do nothing for now
            $programID = $oChat->id;
            $defaultTab = !empty($selectedTab) ? $selectedTab : 'customize';
            $oContacts = $this->mNPS->getMyUsers($oNPS->hashcode);
        }
        $defaultTab = !empty($selectedTab) ? $selectedTab : 'customize';
        //List of Advocates related data 
        $hashCode = $oChat->hashcode;

        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $aData = array(
            'bActiveSubsription' => $bActiveSubsription,
            'title' => 'Survery Setup',
            'pagename' => $breadcrumb,
            'defalutTab' => $defaultTab,
            'programID' => $programID,
            'campaignTemplates' => $campaignTemplates,
            'oChat' => $oChat,
            'userID' => $userID,
            'userData' => $aUser,
            'user_role' => $user_role
        );

        //$this->template->load('admin/admin_template_new', 'admin/modules/chat/setup-beta', $aData);
        $this->template->load('admin/admin_template_new', 'admin/modules/chat/set-up', $aData);
    }

    public function updateChatDesign() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $chatID = $post['chat_id'];
        $chat_logo = $post['chat_logo'];
        $company_info_switch = $post['company_info_switch'];
        $company_title = $post['company_title'];
        $company_description = $post['company_description'];
        $position = $post['position'];

        $solid_color = $post['solid_color'];
        $color_orientation = $post['color_orientation'];
        $main_colors = $post['main_colors'];
        $custom_colors1 = $post['custom_colors1'];
        $custom_colors2 = $post['custom_colors2'];
        //$company_info_switch = $post['company_info_switch'] != '' ? '1' : '0';
        $main_color_switch = $post['main_color_switch'] != '' ? '1' : '0';
        $custom_color_switch = $post['custom_color_switch'] != '' ? '1' : '0';
        $solid_color_switch = $post['solid_color_switch'] != '' ? '1' : '0';

        $chat_icon = $post['chat_icon'];
        $branding = $post['branding'] != '' ? '1' : '0';
        $notification = $post['notification'] != '' ? '1' : '0';


        $aData = array(
            'updated' => date("Y-m-d H:i:s")
        );

        if(!empty($chat_logo)) {
            $aData['chat_logo'] = $chat_logo;
        }
       /* if(!empty($company_info_switch)) {
            $aData['company_info'] = 1;
        }
        else {
            $aData['company_info'] = 0;
        }*/
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
            /*$eventData = $this->mNPS->getNPSEventsByNPSIdEventType($npsID, 'invite-email');
            $eventId = $eventData[0]->id;
            $this->mNPS->updateCampaignByEventId($cData, $eventId);*/
            $bUpdateID = $this->mChat->updateChat($aData, $userID, $chatID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'id' => $bUpdateID, 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }

    public function updateChatPreferences() {

        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $chatID = $post['chat_id'];
        $contactDetails = $post['contact_details_config'];
        $messages = serialize($post['messages']);
        $time = serialize($post['time']);
        $automated_message = $post['automated_message'] != '' ? '1' : '0';
        //pre($post);
        $aData['automated_message'] = $automated_message;
        $aData['messages'] = $messages;
        $aData['time'] = $time;
        $aData['contact_details_config'] = $contactDetails == 'on' ? 1 : 0;

        if ($chatID > 0) {
            $bUpdateID = $this->mChat->updateChat($aData, $userID, $chatID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'id' => $bUpdateID, 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }

    public function updateChatCustomize() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $chatID = $post['chat_id'];
        $title = $post['title'];
        $description = $post['description'];
        $domain = $post['domain'];

        $logo_show = $post['logo_show'];
        $title_show = $post['title_show'];
        $subtitle_show = $post['subtitle_show'];
        $atttachment_show = $post['atttachment_show'];
        $smilie_show = $post['smilie_show'];
        $trigger_time = $post['trigger_time'];
        $trigger_message = $post['trigger_message'];
		$gift_message = $post['gift_message'];
        $allow_gift_message = $post['allow_gift_message'];
        $desktop_visiable = $post['desktop_visiable'];
        $mobile_visiable = $post['mobile_visiable'];

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
            /*$eventData = $this->mNPS->getNPSEventsByNPSIdEventType($npsID, 'invite-email');
            $eventId = $eventData[0]->id;
            $this->mNPS->updateCampaignByEventId($cData, $eventId);*/
            $bUpdateID = $this->mChat->updateChat($aData, $userID, $chatID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'id' => $bUpdateID, 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }

    public function publishChatCampaign() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $chatId = strip_tags($post['chatId']);
        $aData = array(
            'status' => 'active',
        );
        if ($chatId > 0) {
            $bUpdateID = $this->mChat->updateChat($aData, $userID, $chatId);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'id' => $bUpdateID, 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }

    public function changeStatus() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $chatID = strip_tags($post['chatID']);
        $status = strip_tags($post['status']);
        $aData = array(
            'status' => $status,
        );
        if ($chatID > 0) {
            $bUpdateID = $this->mChat->updateChat($aData, $userID, $chatID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'id' => $bUpdateID, 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }

    public function getChat() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $chatID = strip_tags($post['chat_id']);
        $oChat = $this->mChat->getChat($userID, $chatID);
        if (!empty($oChat)) {
            $response = array('status' => 'success', 'id' => $oChat->id, 'title' => $oChat->title);
        } else {
            $response = array('status' => 'error', 'msg' => 'Not found');
        }

        echo json_encode($response);
        exit;
    }

    public function updateChat() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $chatID = strip_tags($post['chat_id']);
        $title = strip_tags($post['title']);
        $aData = array(
            'title' => $title,
            'updated' => date("Y-m-d H:i:s")
        );
        if ($chatID > 0) {
            $bUpdateID = $this->mChat->updateChat($aData, $userID, $chatID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'id' => $bUpdateID, 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }

    public function moveToArchiveChat() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $chatID = strip_tags($post['chat_id']);
        $aData = array(
            'status' => 'archive',
            'updated' => date("Y-m-d H:i:s")
        );

        if ($chatID > 0) {
            $bUpdateID = $this->mChat->updateChat($aData, $userID, $chatID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }

    public function deleteChat() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $chatID = strip_tags($post['chat_id']);
        if ($chatID > 0) {
            $bDeleted = $this->mChat->deleteChat($userID, $chatID);
            if ($bDeleted) {
                $response = array('status' => 'success', 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }

    public function bulkDeleteChat() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $chatIDs = $post['bulk_chat_id'];
        if (!empty($chatIDs)) {
            foreach ($chatIDs as $chatID) {
                $bDeleted = $this->mChat->deleteChat($userID, $chatID);
            }
        }
        if ($bDeleted) {
            $response = array('status' => 'success', 'msg' => "Success");
        }
        echo json_encode($response);
        exit;
    }

    public function bulkArchiveChat() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $chatIDs = $post['bulk_chat_id'];
        $aData = array(
            'status' => 'archive',
            'updated' => date("Y-m-d H:i:s")
        );

        if (!empty($chatIDs)) {
            foreach ($chatIDs as $chatID) {
                $bUpdateID = $this->mChat->updateChat($aData, $userID, $chatID);
            }
        }

        if ($bUpdateID) {
            $response = array('status' => 'success', 'msg' => "Success");
        }
        echo json_encode($response);
        exit;
    }


}