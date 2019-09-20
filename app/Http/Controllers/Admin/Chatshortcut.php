<?php
namespace App\Http\Controllers\Admin;
use App\Models\Admin\ShortchatModel;
use App\Models\Admin\UsersModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class Chatshortcut extends Controller {



/**
* index call
* @param type $clientID
* @return type
*/

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


    /**
    * This function is used to add chat shortcut
    * @param type
    * @return type
    */

    public function addShortCut(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        if (empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $shortname = $request->shortname;
        $conversatation = $request->conversatation;

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

    /**
    * This function is used to update the chatshortcut
    * @param type
    * @return type
    */

    public function updateShortCut(Request $request) {

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        if (empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $shortname = $request->edit_shortname;
        $conversatation = $request->edit_conversatation;
        $chatshortcutId = $request->chatshortcut_id;

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


   /**
    * This function is used to get the chatshortcut for edit function
    * @param type
    * @return type
    */


    public function getChatShortcutById(Request $request) {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $response = array();
        $response['status'] = 'error';

        if (!empty($request)) {

            $mShortchat  = new ShortchatModel();
            $cShortcut = $mShortchat->getChatShortcutID($request->shortcutID, $userID);
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

    /**
    * This function is used to delete the chatshortcut
    * @param type
    * @return type
    */


    public function deleteChatShortcut(Request $request) {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $response = array();
        $response['status'] = 'error';

        if (!empty($request)) {

            $mShortchat  = new ShortchatModel();
            $cShortcut = $mShortchat->deleteChatShortcut($request->shortcutId, $userID);
            $response['status'] = 'success';
            $response['result'] = $cShortcut;

            echo json_encode($response);
            exit;
        }
    }


    /**
    * This function is used to multile delete function
    * @param type
    * @return type
    */

    public function deleteMultipalChatShortcut(Request $request) {
        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $multiChatShortcutid = $request->multiChatShortcutid;
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
