<?php
namespace App\Http\Controllers\Admin;
use App\Models\Admin\ShortchatModel;
use App\Models\Admin\UsersModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class Chatshortcut extends Controller {

    
    public function index() {
       
        $aUser = getLoggedUser();
        $userID = $aUser->id;
         $mShortchat = new ShortchatModel();
         $mUser  = new UsersModel();
        $getChatShortcut = $mShortchat->getChatShortcut($userID);

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Chat Shortcut" class="sidebar-control active hidden-xs ">Chat Shortcut</a></li>
                      </ul>';
       
        $bActiveSubsription = $mUser->isActiveSubscription();              
        $data = array(
            'title' => 'Chat Shortcut',
            'pagename' => $breadcrumb,
            'bActiveSubsription' => $bActiveSubsription,
            'getChatShortcut' => $getChatShortcut
        );

        return view ('admin.chatshortcut.shortcut_list', $data);
    }

    public function addShortCut() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $post = Input::post();
        if (empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $shortname = $post['shortname'];
        $conversatation = $post['conversatation'];

        $aInput = array(
            'name' => $shortname,
            'conversatation' => $conversatation,
            'status' => 1,
            'created' => date("Y-m-d H:i:s"),
            'user_id' => $userID
        );
        $mShortchat  = new ShortchatModel();
        $bAdded = $mShortchat->addShortCut($aInput);

        if ($bAdded) {
            $response = array('status' => 'success', 'msg' => 'Short tag added successfully!');
        } else {
            $response = array('status' => 'error', 'msg' => 'Something went wrong!');
        }

        echo json_encode($response);
        exit;
    }

    public function updateShortCut() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $post = Input::post();
        if (empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $shortname = $post['edit_shortname'];
        $conversatation = $post['edit_conversatation'];
        $chatshortcutId = $post['chatshortcut_id'];

        $aInput = array(
            'name' => $shortname,
            'conversatation' => $conversatation
        );

       $mShortchat  = new ShortchatModel();
        $bAdded = $mShortchat->updateShortCut($aInput, $chatshortcutId, $userID);

        if ($bAdded) {
            $response = array('status' => 'success', 'msg' => 'Short tag added successfully!');
        } else {
            $response = array('status' => 'error', 'msg' => 'Something went wrong!');
        }

        echo json_encode($response);
        exit;
    }

    public function getChatShortcutById() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;   
        $response = array();
        $response['status'] = 'error';
        $post = array();
        if (Input::post()) {
            $post = Input::post();
            $mShortchat  = new ShortchatModel();
            $cShortcut = $mShortchat->getChatShortcutID($post['shortcutID'], $userID);
            if ($cShortcut) {
                $response['status'] = 'success';
                $response['result'] = $cShortcut;
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function deleteChatShortcut() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;   
        $response = array();
        $response['status'] = 'error';
        $post = array();
        if (Input::post()) {
            $post = Input::post();
            $mShortchat  = new ShortchatModel();
            $cShortcut = $mShortchat->deleteChatShortcut($post['shortcutId'], $userID);
            $response['status'] = 'success';
            $response['result'] = $cShortcut;
           
            echo json_encode($response);
            exit;
        }
    }

    public function deleteMultipalChatShortcut() {
        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;   
        $post = Input::post();
        $multiChatShortcutid = $post['multiChatShortcutid'];
        $mShortchat  = new ShortchatModel();
        foreach ($multiChatShortcutid as $shortcutId) {

            $result = $mShortchat->deleteChatShortcut($shortcutId, $userID);
        }
        if ($result) {
            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }




   
}
            