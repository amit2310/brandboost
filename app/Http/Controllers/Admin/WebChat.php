<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\SmsChatModel;
use App\Models\Admin\WebChatModel;
use App\Models\Admin\SubscriberModel;
use Illuminate\Support\Facades\Input;
use App\Models\Admin\TagsModel;

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
            $taglist = getTagsByReviewID($chatUserid);
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
            $arr[3]['avatar'] = $avatar;
            $arr[4]['avatar_url'] = '';
            $arr[5]['chatUserid'] = $chatUserid;
            $arr[6]['city'] = '';
            $arr[7]['code'] = '';
            $arr[8]['gender'] = '';
            $arr[9]['avfinder'] = '';
            $arr[10]['userId_encode'] = $userId_encode;
            $arr[11]['taglist'] = $taglist;
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

    /**
     * This function used to update the status from unread to read
     * @return type
     */
    public function readMessages() {

        $webChatModel = new WebChatModel();
        $from_user = Input::post("currentUser");
        $to_user = Input::post("userID");
        $aData = array(
            'read_status' => '1'
        );
        $result = $webChatModel->readChatMsg($to_user, $from_user, $aData);

        if ($result) {
            $response = array('status' => 'ok');
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit();
       
    }

    /**
     * this function is used login or not
     * @return type boolean
     */
    public function changeLoginStatus() {

        $webChatModel = new WebChatModel();
        $userId = Input::post("userId");
        $status = Input::post("status");

        $aData = array('login_status' => $status, 'last_login' => date("Y-m-d H:i:s"));
        $result = $webChatModel->lastLoginDetail($userId, $aData);
        if ($result) {
            $response = array('status' => 'ok');
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;

    }

    /**
     * this function is used to save chat message
     * @return type boolean
     */

    public function addChatMsg() {

        $webChatModel = new WebChatModel();
        if(Session::get("team_user_id")) {
            $isLoggedInTeam = Session::get("team_user_id");
        }
        else if(Session::get("customer_user_id")) {
            $isLoggedInTeam = Session::get("customer_user_id");
        }
        else {
            $isLoggedInTeam = '0';
        }

        $room = Input::post('room');
        $msg = Input::post('msg');
        $to_user = Input::post('chatTo');
        $from_user = Input::post('currentUser');
        $notes = Input::post('notes');
        if($notes == "")
        {
            $notes=0;
        }

        $aData = array(
            'token' => $room,
            'user_to' => $to_user,
            'user_form' => $from_user,
            'message' => $msg,
            'read_status' => '0',
            'team_member_id' => $isLoggedInTeam,
            'notes'=>$notes,
            'created' => date('Y-m-d H:i:s')
        );
        $result = $webChatModel->addChatMsg($aData);
        $webChatModel->updateChat($room);

        if ($result) {
            $hasAssign = 0;
            $getSupportUser = $webChatModel->checkTeamAssign($room);
            if($getSupportUser->assign_team_member == 0) {
                $webChatModel->assignChat($room, $isLoggedInTeam);
                $hasAssign = 1;   
            }

            $chatRow =  $webChatModel->getassignChat($room);
            
            if(empty($chatRow)){

                $chatRow =  $webChatModel->getassignChatUser($room);
            }
            $response = array('status' => 'ok','isLoggedInTeam'=>$chatRow->teamName, 'teamId' => $chatRow->teamId, 'hasAssign' => $hasAssign);
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        
        exit();

    }


     /**
     * this function is used to update the chat user contact information
     * @return type boolean
     */

    public function updateSupportuser() {

        $chatUserid  = Input::post("em_id");
        $webChatModel = new WebChatModel();
        if(!empty($chatUserid)) {
                $getValue = Input::post("getValue");
                $getName = Input::post("getName");
                if($getName == 'support_name') {
                    $aData = array('user_name' => $getValue);
                }
                else if($getName == 'support_email') {
                    $aData = array('email' => $getValue);
                }
                else if($getName == 'support_phone') {
                    $aData = array('phone' => $getValue);
                }
                $result = $webChatModel->updateSupportuser($chatUserid, $aData);
                if($result){
                    $response = array('status' => 'ok');
                }
                else {
                    $response = array('status' => 'error');
                }
                          
        }
        else{
            $response = array('status' => 'error');
        }
        
        echo json_encode($response);
        exit;
    }



   /**
     * this function is used to get all the tags related to the webchat user
     * @return type boolean
     */


    public function listAllTagsWebchat() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        if (empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $TagsObj = new TagsModel();
        $reviewID = base64_url_decode(strip_tags(Input::post("review_id")));
        $feedbackID = base64_url_decode(strip_tags(Input::post("feedback_id"))); 
        $questionID = base64_url_decode(strip_tags(Input::post("question_id")));  
        
        if ($reviewID > 0) {
            $aAppliedTags = $TagsObj->getTagsDataByReviewID($reviewID);
        }
        if ($feedbackID > 0) {
            $aAppliedTags = $TagsObj->getTagsDataByFeedbackID($feedbackID);
        }
        
        if($questionID>0){
            $aAppliedTags = $TagsObj->getTagsDataByQuestionID($questionID);
        }
        $aTag = $TagsObj->getClientTags($userID);

        $sTags =  view("admin.tags.mytags_Web",array('oTags' => $aTag, 'aAppliedTags' => $aAppliedTags))->render();
        $response = array('status' => 'success', 'list_tags' => $sTags);
        echo json_encode($response);
        exit;

    }

  

   /**
     * this function is used to add the tags for the webchat
     * @return type boolean
     */


    public function applyWebTag() {
        

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        if (empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
       
        $TagsObj = new TagsModel();
        $reviewID = base64_url_decode(strip_tags(Input::post("review_id"))); 
        $aTagID = Input::post("applytag");
        $aInput = array(
            'aTagIDs' => $aTagID,
            'review_id' => $reviewID
        );

        $bAdded = $TagsObj->addReviewTag($aInput);

        if ($bAdded) {
            
        $oTags = $TagsObj->getTagsDataByReviewID($reviewID);
        
        $sTagDropdown = view("admin.tags.tag_dropdown", array('oTags' => $oTags, 'fieldName'=> 'reviewid', 'fieldValue'=> base64_url_encode($reviewID), 'actionName'=> 'review-tag', 'actionClass'=> 'applyInsightTagsReviews'));
            
            $response = array('status' => 'success', 'msg' => 'Tag added successfully!', 'refreshTags' => $sTagDropdown, 'id'=>$reviewID);
            echo json_encode($response);
            exit;
        } else {
            $response = array('status' => 'error', 'msg' => 'Something went wrong!');
            echo json_encode($response);
            exit;
        }

    }


    /**
     * this function will return taglist
     * @return type boolean
     */

    public function getWebTaglist() {
        $userId = Input::post("userId");
        $taglist = getTagsByReviewID($userId);
        $arr = array();
        $arr[0]['taglist'] = $taglist;
        echo json_encode($arr);
    }


       /**
     * this function is used delete the tags for webchat users
     * @return type boolean
     */


     public function deleteTagFromWeb() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $TagsObj = new TagsModel();
        $grpid =  Input::post("grpid");
        $tag_id = Input::post("tag_id");
        $review_id = Input::post("review_id");

        if (empty($review_id) || empty($tag_id)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
       
        if (!empty($review_id) && !empty($tag_id)) {
            $bDeleted = $TagsObj->deleteTagGroupEntityWebchat($review_id,$tag_id);
            if ($bDeleted) {
                $response = array('status' => 'success', 'msg' => 'Tag group deleted successfully!');
                echo json_encode($response);
                exit;
            } else {
                $response = array('status' => 'error', 'msg' => 'Something went wrong!');
                echo json_encode($response);
                exit;
            }
        }
    }


    /**
     * this function is used for set chat box
     * @return type object
     */

    public function setChatboxstatus()
    {
        $webChatModel = new WebChatModel();
        $user_id =  Input::post("currentUser");
        $subscriber_id =  Input::post("userID");
        $type =  Input::post("type");
        $aData = array(
            'user_id' => $user_id,
            'subscriber_id' => $subscriber_id,
            'status' => '1',
            'type' => $type
             
        );
        $result = $webChatModel->updateChatboxstatus($aData);
        
        if ($result) {
            $response = array('status' => 'ok');
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
       

    }

    /**
     * this function is used for remove chat box
     * @return type object
     */
    public function removeBoxStatus()
    {
        $webChatModel = new WebChatModel();
        $user_id =  Input::post("currentUser");
        $subscriber_id =  Input::post("userID");
        $aData = array(
            'user_id' => $user_id,
            'subscriber_id' => $subscriber_id
        );
        $result = $webChatModel->removeActiveBoxStatus($aData);
       
        if ($result) {
            $response = array('status' => 'ok', 'res' => $result);
        } else {
            $response = array('status' => 'error');
        }
     
        echo json_encode($response);
        exit;
        
    }


}
