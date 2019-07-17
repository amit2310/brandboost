<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\SmsChatModel;
use App\Models\Admin\WebChatModel;
use App\Models\Admin\SubscriberModel;
use Illuminate\Support\Facades\Input;
use Session;
class WebChat extends Controller {
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
        if (!empty($isLoggedInTeam)) {
            $assignedChat = $webChatModel->getTeamAssign($isLoggedInTeam);
            $assignedChatData = $webChatModel->getTeamAssignData($isLoggedInTeam);
            $loggedYou = $isLoggedInTeam;
        } else {
            $assignedChat = $webChatModel->getTeamAssign($oUser->id);
            $assignedChatData = $webChatModel->getTeamAssignData($oUser->id);
            $loggedYou = $oUser->id;
        }
        $unassignedChat = $webChatModel->getTeamAssign(0);
        $unassignedChatData = $webChatModel->getTeamAssignData(0);
        $data = array('title' => 'Chat System', 'pagename' => $breadcrumb, 'usersdata' => $oContacts, 'favouriteUserData' => $favouriteUserData, 'loginUserData' => $oUser, 'totalSubscriber' => count($oContacts), 'unassignedChat' => $unassignedChat, 'assignedChat' => $assignedChat, 'assignedChatData' => $assignedChatData, 'unassignedChatData' => $unassignedChatData, 'loggedYou' => $loggedYou);
        return view('admin.web_chat.index', $data);
    }
    /**
     * This function is used to get userinformation based on the client/user id
     * @return type
     */
    public function getUserinfo() {
        $chatUserid = Input::post("chatUserid");
        $token = Input::post("token");
        if (strlen($chatUserid) > 10 && $chatUserid != '' && $token != '') {
            $userDetail = getSubscriberDetails($chatUserid);
            $assignto = assignto($token);
            //$taglist = getTagsByReviewID($userId);
            $userId_encode = base64_url_encode($chatUserid);
            $user_name_ex = explode(" ", $userDetail[0]->user_name);
            $avatar = showUserAvtar('', $user_name_ex[0], $user_name_ex[1], 84, 84, 24);
            $arr = array();
            $email = !empty($userDetail[0]->email) ? $userDetail[0]->email : 'Add Email';
            $phone = !empty($userDetail[0]->phone) ? $userDetail[0]->phone : 'Add Phone';
            //$cityName = !empty($userDetail->cityName) ? $userDetail->cityName : '';
            //$country_code = !empty($userDetail->country_code) ? $userDetail->country_code : '';
            //$gender = !empty($userDetail->gender) ? $userDetail->gender : '';
            $arr[0]['email'] = $email;
            $arr[1]['name'] = $user_name_ex[0] . ' ' . $user_name_ex[1];
            $arr[2]['phone'] = $userDetail[0]->phone != '' ? $userDetail[0]->phone : 'Add Phone';
            $arr[3]['avatar'] = '';
            $arr[4]['avatar_url'] = '';
            $arr[5]['chatUserid'] = $chatUserid;
            $arr[6]['city'] = '';
            $arr[7]['code'] = '';
            $arr[8]['gender'] = '';
            $arr[9]['avfinder'] = '';
            $arr[10]['userId_encode'] = $userId_encode;
            $arr[11]['taglist'] = '';
            $arr[12]['assign_to'] = $assignto;
            $arr[13]['assign_team_member'] = $userDetail[0]->assign_team_member;
            return response()->json($arr, 200);
        }
    }
    /**
     * This function is used to get the webchat notes 
     * @return type
     */
    public function listingNotes() {
        $oUser = getLoggedUser();
        $chatUserid = Input::post("NotesTo");
        $WebChatObj = new WebChatModel();
        $oNotes = $WebChatObj->getWebNotes($chatUserid);
        foreach ($oNotes as $NotesData) {
            $fileext = explode('.', $NotesData->message);
            $fileext = end($fileext);
            $mmsFile = explode('/Media/', $NotesData->message);
            if ($fileext == 'png' || $fileext == 'jpg' || $fileext == 'jpeg' || $fileext == 'gif') {
                $NotesData->message = "<div class='mrdia-file'><a href='" . $NotesData->message . "' target='_blank' class='previewImage'><img src='" . $NotesData->message . "' /></a></div>";
            } else if ($fileext == 'doc' || $fileext == 'docx' || $fileext == 'odt' || $fileext == 'csv' || $fileext == 'pdf') {
                $NotesData->message = "<div class='media-content'><a href='" . $NotesData->message . "' target='_blank'>Download '" . $fileext . "' File</a></div>";
            } else if (count($mmsFile) > 1) {
                $NotesData->message = "<div class='mrdia-file'><a href='" . $NotesData->message . "' target='_blank' class='previewImage'><img src='" . $NotesData->message . "' /></a></div>";
            }
?>
                    <li class="media reversed">
                       <div class="media-body">  
                           <span style="display: none;" class="media-annotation user_icon"><span class="circle_green_status status-mark"></span>
                            <?php echo showUserAvtar($oUser->avatar, $oUser->firstname, $oUser->lastname, 28, 28, 11); ?>                               </span>
                           <div class="media-content" style="background-color:#fff9ec!important;"><?php echo $NotesData->message; ?>
                           </div>
                               <span style="padding: 0;display: block;font-size: 10px;position: absolute; right: 0;bottom: -16px;" class="text-muted text-size-small">
                               Added By <?php echo assignto('') . ' ' . date('F d Y', strtotime($NotesData->created));
        } ?>  </span>
                            </div>
                    </li>
<div style="height:10px" class="clearfix"></div>
                <?php
    }

    /**
     * This function used to get all the webchat messages
     * @return type
     */
    public function getMessages() {
        $oUser = getLoggedUser();
        $token = Input::post("room");
        $offset = Input::post("offset");
        $limit = 10000;
        $WebChatObj = new WebChatModel();
        $result = $WebChatObj->getwebchatMessages($token);
        if (count((array)$result) > 0) {
            foreach ($result as $get_value) {
                $avatarHtml = '';
                $avatar = "";
                if (strlen($get_value->user_form) > 10) {
                    $avatar = "";
                    $supportUser = getSupportUser($get_value->user_form);
                    if (!empty($supportUser[0]->user_name)) {
                        $supportUserName = explode(" ", $supportUser[0]->user_name);
                        $avatarHtml = showUserAvtar("", $supportUserName[0], $supportUserName[1], 28, 28, 11);
                    } else {
                        $avatarHtml = showUserAvtar("", "A", "", 28, 28, 11);
                    }
                } else {
                    $oUserDetails = getAllUser($get_value->user_form);
                    $avatar = $oUserDetails[0]->avatar;
                    $avatar = !empty($avatar) ? $avatar : '';
                    $firstname = !empty($oUserDetails[0]->firstname) ? $oUserDetails[0]->firstname : '';
                    $lastname = !empty($oUserDetails[0]->lastname) ? $oUserDetails[0]->lastname : '';
                    $avatarHtml = showUserAvtar($avatar, $firstname, $lastname, 28, 28, 11);
                }
                $get_value->created = timeAgo($get_value->created);
                $get_value->avatarImage = $avatarHtml;
            }
        }
        if ($result) {
            $response = array('status' => 'ok', 'res' => $result);
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }



     /**
    * This function is used to add the web notes 
    * @return type
    */

    public function addWebNotes()
    {

        $aUInfo = getLoggedUser();
        $WebChatObj = new WebChatModel();
        $isLoggedInTeam = Session::get("team_user_id");
        if ($isLoggedInTeam) {
        $aTeamInfo = App\Models\Admin\TeamModel::getTeamMember($isLoggedInTeam, $aUInfo->id);
        $teamMemberName = $aTeamInfo->firstname . ' ' . $aTeamInfo->lastname;
        $teamMemberId = $aTeamInfo->id;
        $loginMember = $teamMemberId;
        } else {
        $teamMemberName = '';
        $teamMemberId = '';
        $loginMember = $aUInfo->id;
        }

        $SmsChatObj = new SmsChatModel();
       
        $msg = Input::post("msg");
        $chatuserid = Input::post("chatTo");
        $room = Input::post("room");
        $team_id = $teamMemberId;
        $client_id = $aUInfo->id;

       

        $aData = array(
            'room' => $room,
            'message' => $msg,
            'user' => $chatuserid,
            'client_id'=>$client_id,
            'team_id'=>$team_id,
            'created' => date("Y-m-d H:i:s")
        );
        
        
        if(!empty($WebChatObj->addWebNotes($aData)))
        {
            $response = array('status'=>'success');
        }
        else
        {
            $response = array('status'=>'error');
        }
        

        echo json_encode($response); 


    }

}
