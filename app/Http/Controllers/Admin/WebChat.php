<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\SmsChatModel;
use App\Models\Admin\WebChatModel;
use App\Models\Admin\SubscriberModel;
use Illuminate\Support\Facades\Input;
use App\Models\Admin\TagsModel;
use App\Models\Admin\TeamModel;
use Response;

use Session;
class WebChat extends Controller {
    /**
     *
     * Index controller
     */
    public function index() {
        $oUser = getLoggedUser();
        $aBreadcrumb = array(
            'Home' => '#/',
            'Chat' => '#/chat/dashboard',
            'Web Chat' => ''
        );
        $oContacts = SubscriberModel::getGlobalSubscribers($oUser->id, false);
        $mWebChat = new WebChatModel();
        $favoriteChatData = $mWebChat->getFavouriteUsers($oUser->id);
        $isLoggedInTeam = Session::get("team_user_id");
        if(!empty($isLoggedInTeam)){
            $hasweb_access = getMemberchatpermission($isLoggedInTeam);
            if ($hasweb_access->bb_number != "") {
                $twilioNumber = $hasweb_access->bb_number;
            } else {
                $twilioNumber = getClientTwilioAccount($oUser->id);
            }
            $aTeamInfo = TeamModel::getTeamMember($isLoggedInTeam, $oUser->id);
            $teamMemberId = $aTeamInfo->id;
        }else{
            $twilioNumber = getClientTwilioAccount($oUser->id);
        }

        //Assigned Chat
        $id = (!empty($teamMemberId)) ? $teamMemberId : $oUser->id;
        $assignedChat = $mWebChat->getTeamAssignData($id, true);
        if($assignedChat->isNotEmpty()){
            foreach($assignedChat as $oUserChat){
                $lastMessage = $this->getLastChatMessage($oUserChat->room);
                $oUserChat->lastMessageInfo = $lastMessage;
                $oUserChat->unreadCount = $mWebChat->getUnreadCount($oUserChat->room, $oUserChat->user);
            }
        }
        $assignedChatData = $assignedChat;
        $loggedYou = $id;

        //Unassigned Chat
        $unassignedChat = $mWebChat->getTeamAssignData(0);
        if($unassignedChat->isNotEmpty()){
            foreach($unassignedChat as $oUserChat){
                $lastMessage = $this->getLastChatMessage($oUserChat->room);
                $oUserChat->lastMessageInfo = $lastMessage;
                $oUserChat->unreadCount = $mWebChat->getUnreadCount($oUserChat->room, $oUserChat->user);
            }
        }
        $unassignedChatData = $unassignedChat;


        //Active Web Chat
        $allChat = activeOnlyweb($loggedYou);
        if($allChat->isNotEmpty()){
            foreach($allChat as $oUserChat){
                $lastMessage = $this->getLastChatMessage($oUserChat->room);
                $oUserChat->lastMessageInfo = $lastMessage;
                $oUserChat->unreadCount = $mWebChat->getUnreadCount($oUserChat->room, $oUserChat->user);
            }
        }

        //Get All Team members
        $teamMembers = getAllteam($oUser->id);

        $aData = [
            'title' => 'Web Chat',
            'breadcrumb' => $aBreadcrumb,
            'usersdata' => $oContacts,
            'favouriteUserData' => $favoriteChatData,
            'loginUserData' => $oUser,
            'twilioNumber' => $twilioNumber,
            'totalSubscriber' => count($oContacts),
            'unassignedChat' => $unassignedChat,
            'assignedChat' => $assignedChat,
            'assignedChatData' => $assignedChatData,
            'unassignedChatData' => $unassignedChatData,
            'allChat' => $allChat,
            'loggedYou' => $loggedYou,
            'teamMembers' => $teamMembers,
        ];
        //return view('admin.web_chat.index', $data);
        return $aData;
    }

    /**
     * Used to get Sorted Web Chat Contact list
     * @param Request $request
     * @return array
     */
    public function sortWebChatContactList(Request $request){
        $oUser = getLoggedUser();
        $sortType = $request->sort;
        if($sortType == 'new'){
            $sortVal = 'desc';
        }else if($sortType == 'old'){
            $sortVal = 'asc';
        }else if($sortType == 'wait'){
            $sortVal = 'desc';
        }
        $mWebChat = new WebChatModel();
        $isLoggedInTeam = Session::get("team_user_id");
        if(!empty($isLoggedInTeam)){
            $aTeamInfo = TeamModel::getTeamMember($isLoggedInTeam, $oUser->id);
            $teamMemberId = $aTeamInfo->id;
        }
        //Assigned Chat
        $id = (!empty($teamMemberId)) ? $teamMemberId : $oUser->id;
        $allChat = $mWebChat->sortWebChat($id, 'last_chat_time', $sortVal);
        if($allChat->isNotEmpty()){
            foreach($allChat as $oUserChat){
                $lastMessage = $this->getLastChatMessage($oUserChat->room);
                $oUserChat->lastMessageInfo = $lastMessage;
            }
        }
        $aData = [
            'allChat' => $allChat
        ];
        return $aData;
    }
    /**
     * This function is used to get userinformation based on the client/user id
     * @return type
     */
    public function getUserinfo(Request $request) {
        $chatUserid = $request->chatUserid;
        $token = $request->room;
        if (strlen($chatUserid) > 10 && $chatUserid != '' && $token != '') {
            $userDetail = getSubscriberDetails($chatUserid);
            $assignto = assignto($token);
            $taglist = getTagsByReviewID($chatUserid);
            $userId_encode = base64_url_encode($chatUserid);
            $user_name_ex = explode(" ", $userDetail[0]->user_name);
            $avatar = showUserAvtar('', $user_name_ex[0], $user_name_ex[1], 84, 84, 24);
            $avatarSmall = showUserAvtar('', $user_name_ex[0], $user_name_ex[1], 40, 40, 13);
            $email = !empty($userDetail[0]->email) ? $userDetail[0]->email : 'Add Email';
            $aData = [
                'email' => $email,
                'name' => ucwords($user_name_ex[0] . ' ' . $user_name_ex[1]),
                'firstname' => ucwords($user_name_ex[0]),
                'lastname' => ucwords($user_name_ex[1]),
                'phone' => $userDetail[0]->phone != '' ? $userDetail[0]->phone : 'Add Phone',
                'avatar' => $avatar,
                'avatarSmall' =>$avatarSmall,
                'avatar_url' => '',
                'chatUserid' => $chatUserid,
                'city' => '',
                'code' => '',
                'gender' => '',
                'avfinder' => '',
                'userId_encode' => $userId_encode,
                'taglist' => $taglist,
                'assign_to' => $assignto,
                'assign_team_member' => $userDetail[0]->assign_team_member
            ];
            return $aData;

        }
    }
    public function getUserinfoOld(Request $request) {
        $chatUserid = $request->chatUserid;
        $token = $request->token;
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
    public function listingNotes(Request $request) {
        $oUser = getLoggedUser();
        $chatUserid = $request->NotesTo;
        $WebChatObj = new WebChatModel();
        $oNotes = $WebChatObj->getWebNotes($chatUserid);
        foreach ($oNotes as $oNote) {
            $oNote->assignTo = assignto($oNote->room);
            $oNote->avatar = $oUser->avatar;
            $oNote->firstname = $oUser->firstname;
            $oNote->lastname = $oUser->lastname;
        }
        return $oNotes;
    }

    public function listingNotesOld(Request $request) {
        $oUser = getLoggedUser();
        $chatUserid = $request->NotesTo;
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
                               Added By <?php echo assignto($NotesData->room) . ' ' . date('F d Y', strtotime($NotesData->created));
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
    public function getMessages(Request $request) {
        $oUser = getLoggedUser();
        $token = $request->room;
        $offset = $request->offset;
        $limit = 10000;
        $WebChatObj = new WebChatModel();
        $result = $WebChatObj->getwebchatMessages($token);
        //pre($result);die;
        if (count((array)$result) > 0) {
            foreach ($result as $get_value) {

                $uFrom = $get_value->user_form;
                $uTo = $get_value->user_to;
                $avatarHtml = '';
                $avatar = "";
                if (strlen($get_value->user_form) > 10) {
                    $avatar = "";
                    $firstname = 'New';
                    $lastname = 'User';

                    $supportUser = getSupportUser($get_value->user_form);
                    if (!empty($supportUser[0]->user_name)) {

                        $supportUserName = explode(" ", $supportUser[0]->user_name);
                        $firstname = $supportUserName[0];
                        $lastname = $supportUserName[1];
                        $avatarHtml = showUserAvtar("", $supportUserName[0], $supportUserName[1], 40, 40, 13);
                    } else {
                        $avatarHtml = showUserAvtar("", "A", "", 40, 40, 13);
                    }

                    $get_value->user_form = (string)$uFrom;
                } else {
                    $oUserDetails = getAllUser($get_value->user_form);
                    $avatar = $oUserDetails[0]->avatar;
                    $avatar = !empty($avatar) ? $avatar : '';
                    $firstname = !empty($oUserDetails[0]->firstname) ? $oUserDetails[0]->firstname : '';
                    $lastname = !empty($oUserDetails[0]->lastname) ? $oUserDetails[0]->lastname : '';
                    $avatarHtml = showUserAvtar($avatar, $firstname, $lastname, 36, 36, 13);

                    $get_value->user_to = (string)$uTo;
                }
                $get_value->created = timeAgo($get_value->created);
                $get_value->avatarImage = $avatarHtml;
                //$get_value->avatarImage = $avatar;
                $get_value->blankAvatar = $avatarHtml;
                $get_value->hasAvatar = $avatar ? true : false;
                $get_value->avatar = $avatar;
                $get_value->firstname = $firstname;
                $get_value->lastname = $lastname;
            }
        }
        //pre($result); die;
        if ($result) {
            $response = array('status' => 'ok', 'res' => $result);
        } else {
            $response = array('status' => 'error');
        }
        //echo json_encode($response,true);
        return Response::json(array(
                    'status' => 'ok',
                    'res'   => $result
                ));

        exit;
    }


     /**
    * This function is used to add the web notes
    * @return type
    */

    public function addWebNotes(Request $request)
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

        $msg = $request->msg;
        $chatuserid = $request->chatTo;
        $room = $request->room;
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
    public function readMessages(Request $request) {

        $webChatModel = new WebChatModel();
        $from_user = $request->currentUser;
        $to_user = $request->userID;
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
    public function changeLoginStatus(Request $request) {

        $webChatModel = new WebChatModel();
        $userId = $request->userId;
        $status = $request->status;

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

    public function addChatMsg(Request $request) {

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

        $room = $request->room;
        $msg = $request->msg;
        $to_user = $request->chatTo;
        $from_user = $request->currentUser;
        $notes = $request->notes;
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
            if(!empty($getSupportUser)) {
                if($getSupportUser->assign_team_member == 0) {
                    $webChatModel->assignChat($room, $isLoggedInTeam);
                    $hasAssign = 1;
                }
            }

            $chatRow =  $webChatModel->getassignChat($room);

            if(empty($chatRow)){
                $chatRow =  $webChatModel->getassignChatUser($room);
            }

            $teamName = !empty($chatRow->teamName)? $chatRow->teamName : '';
            $teamId = !empty($chatRow->teamId)? $chatRow->teamId : '';
            $response = array('status' => 'ok','isLoggedInTeam'=>$teamName, 'teamId' => $teamId, 'hasAssign' => $hasAssign);
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

    public function updateSupportuser(Request $request) {

        $chatUserid  = $request->em_id;
        $webChatModel = new WebChatModel();
        if(!empty($chatUserid)) {
                $getValue = $request->getValue;
                $getName = $request->getName;
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


    public function listAllTagsWebchat(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        if (empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $TagsObj = new TagsModel();
        $reviewID = base64_url_decode($request->review_id);
        $feedbackID = base64_url_decode($request->feedback_id);
        $questionID = base64_url_decode($request->question_id);

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


    public function applyWebTag(Request $request) {


        $aUser = getLoggedUser();
        $userID = $aUser->id;
        if (empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $TagsObj = new TagsModel();
        $reviewID = base64_url_decode($request->review_id);
        $aTagID = $request->applytag;
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

    public function getWebTaglist(Request $request) {
        $userId = $request->userId;
        $taglist = getTagsByReviewID($userId);
        $arr = array();
        $arr[0]['taglist'] = $taglist;
        echo json_encode($arr);
    }


       /**
     * this function is used delete the tags for webchat users
     * @return type boolean
     */


     public function deleteTagFromWeb(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $TagsObj = new TagsModel();
        $grpid =  $request->grpid;
        $tag_id = $request->tag_id;
        $review_id = $request->review_id;

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
     * this function is used reassing the chat to the team member
     * @return type boolean
     */


      public function reassignChat(Request $request) {

        $webChatModel = new WebChatModel();
        $room = $request->room;
        $assign_to = $request->assign_to;
        $chatDetails = $webChatModel->getChatRoomDetails($room, $assign_to);
        echo json_encode($chatDetails);
    }


      /**
     * this function is used to show unassing chat list for Big web chat
     * @return type boolean
     */

      public function showUntabAjax() {


        $count = 0;
        $flag = 0;
        $unassignedchatlist = getTeamUnAssignDataHelper();
        foreach ($unassignedchatlist as $key => $value) {
            $token = "";
            $token = $value->room;
            $userid = $value->user;
            $userMessage = "";
            $chatName = explode(" ", $value->user_name);
            $chatMessageRes = getLastMessage($token);
            $getlastmessage = $chatMessageRes->message;

            $fileext = explode('.', $getlastmessage);
            $fileext = end($fileext);
            if ($fileext == 'png' || $fileext == 'jpg' || $fileext == 'jpeg' || $fileext == 'gif') {
                $userMessage = "File Attachment";
            } else if (strpos($getlastmessage, '/Media/') !== false) {
                $userMessage = "File Attachment";
            } else if (strpos($getlastmessage, 'amazonaws') !== false) {
                $userMessage = "File Attachment";
            } else {
                $userMessage = setStringLimit($getlastmessage, 80);
            }
            ?>
            <div class="tk_<?php echo $token; ?> activityShow <?php echo $count; ?> media chatbox_new bkg_white <?php
            if ($count == 1) {
                echo 'bbot';
            }
            ?>" style="<?php
                 if ($count > 7) {
                     echo "display:block";
                 } if ($count == 1) {
                     echo 'box-shadow:0 2px 4px 0 rgba(1, 21, 64, 0.06)!important; border-radius:0 0 5px 5px';
                 } if ($count == 2) {
                     echo 'border-radius:5px 5px 5px 5px';
                 }
                 ?>">
                <a href="javascript:void(0);" class="media-link <?php
                if ($count != 1) {
                    echo 'bbot';
                }
                ?> getChatDetails WebBoxList <?php echo $count == 0 ? '' : ''; ?>" userId="<?php echo $value->user; ?>" RwebId="<?php echo $token; ?>" >
                    <div class="media-left"><?php echo showUserAvtar('', $chatName[0], $chatName[1], 28, 28, 12); ?>
                        <!-- <i class="fa fa-star-o star_icon"></i> -->
                        <i class="fa star_icon <?php echo $value->favourite == 1 ? 'fa-star yellow' : 'fa-star-o'; ?> favouriteUser" userId="<?php echo $value->id; ?>"></i>
                    </div>

                    <div class="media-body">
                        <span class="fsize12 txt_dark"><?php echo $chatName[0]; ?> <?php echo $chatName[1]; ?></span>
                        <span class="slider-phone contacts txt_dark" style="margin:0px; color: #6a7995!important;font-weight:bold; font-size:12px!important"><?php echo $userMessage; ?></span>

                    </div>
                    <div class="media-right" style="width: 90px"><span class="date_time txt_grey fsize11"><time class="autoTimeUpdate autoTime_<?php echo $userid; ?>"  datetime="<?php echo usaDate($chatMessageRes->created); ?>" title="<?php echo usaDate($chatMessageRes->created); ?>"><?php //echo chatTimeAgo($chatMessageRes->created);     ?></time>

                            <span class="read_status_<?php echo $userid; ?>">
                                <?php
                                $readStatus = $chatMessageRes->read_status;
                                if ($readStatus == 1 || $chatMessageRes->user_to == $userid) {
                                    ?><i class="fa fa-circle txt_green fsize7"></i><?php
                                } else {
                                    ?><i class="fa fa-circle txt_red fsize7"></i><?php
                                }
                                ?>
                            </span>

                        </span></div>

                </a>
            </div>

            <?php
            $count++;
        }
        ?>
        <script>
            $(document).ready(function () {
                $(".autoTimeUpdate").timeago();
            });
        </script>
        <?php
    }


        /**
        * this function is used to show unassing chat list for Small web chat
        * @return type boolean
        */


     public function showUntabAjaxSmallbox() {

        $count = 0;
        $flag = 0;
        $unassignedchatlist = getTeamUnAssignDataHelper();
        foreach ($unassignedchatlist as $key => $value) {
            $token = "";
            $userid = "";
            $chatMessage = "";
            $created = "";
            $first_name = "";
            $last_name = "";
            $nameDetails = explode(" ", $value->user_name);
            $first_name = $nameDetails[0];
            $last_name = $nameDetails[1];

            $token = $value->room;
            $userid = $value->user;
            $chatMessageRes = getLastMessage($token);
            $chatMessage = $chatMessageRes->message;
            $created = $chatMessageRes->created;

            $fileext = explode('.', $chatMessage);
            $fileext = end($fileext);
            if ($fileext == 'png' || $fileext == 'jpg' || $fileext == 'jpeg' || $fileext == 'gif') {
                $userMessage = "File Attachment";
            } else if (strpos($chatMessage, '/Media/') !== false) {
                $userMessage = "File Attachment";
            } else if (strpos($chatMessage, 'amazonaws') !== false) {
                $userMessage = "File Attachment";
            } else {
                $userMessage = setStringLimit($chatMessage, 30);
            }
            $Usrvalue = getSupportUser($userid);
            $Usrvalue = $Usrvalue[0];

            // $favUser = $this->smsChat->getSMSFavouriteUser($loginUserData->id,$incid[0]->id);
            ?>
            <div RwebId="<?php echo $token; ?>"  token="<?php echo $token; ?>" class="sidebar-user-box all_user_chat tk_<?php echo $token; ?>" assign_to="<?php echo assignto($token); ?>" incWid="" id="sidebar-user-box-<?php echo $userid; ?>" user_id="<?php echo $userid; ?>" >
                <div class="avatarImage"><?php echo showUserAvtar($usersdata->avatar, $first_name, $last_name, 28, 28, 11); ?>

                </div>
                <span style="display:none" id="fav_star_<?php echo $userID; ?>"></span>
                <span class="slider-username contacts"><?php echo $first_name . ' ' . $last_name; ?> &nbsp; <i class="fa  star_icon <?php echo $value->favourite == 1 ? 'fa-star yellow' : 'fa-star-o'; ?> favouriteUser" userId="<?php echo $value->id; ?>"></i></span>

                <span id="Small_assign_<?php echo $userid; ?>" class="slider-phone contacts"><span style="float: left; width: 100%; font-weight:300!important; color: #6a7995 !important; font-size: 12px; margin-bottom: 3px; ">
                        <?php if (assignto($token) != "") { ?>Assigned to:&nbsp <?php
                            echo assignto($token);
                        }
                        ?></span></span>


                <span id="Small_assign_message_<?php echo $userid; ?>" class="slider-phone contacts txt_dark" style="margin:0px;color: #09204f !important; font-weight:300;padding-left:40px; font-size:12px!important"><?php echo $userMessage; ?></span>


                <span style="display: none;" class="slider-email contacts"></span>

                <span style="display: none;" class="slider-mobile contacts"></span>
                <span style="display: none;" class="slider-image img">
                    <?php
                    if (empty($loginUserData->avatar)) {
                        echo $currentUserImg = '/assets/images/default_avt.jpeg';
                    } else {
                        echo $currentUserImg = "https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/" . $loginUserData->avatar;
                    }
                    ?></span>

                <span class="user_status"><time class="autoTimeUpdate autoTime_<?php echo $userid; ?>"
                                                datetime="<?php echo usaDate($chatMessageRes->created); ?>" title="<?php echo usaDate($chatMessageRes->created); ?>"><?php //echo chatTimeAgo($value->created);    ?></time></span>
                    <?php if ($is_pending == 8) { ?>
                    <i style="float:right" class="pr_<?php echo $value->token; ?> fa fa-circle txt_red fsize9"></i>
                <?php }
                ?>

                <!--box hover chat details -->
                <div class="user_details p0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="header_sec"> <i class="icon-info22 txt_blue"></i><?php echo $first_name . ' ' . $last_name; ?></div>
                            <div class="sidebar_info p20 text-center">
                                <?php echo showUserAvtar($usersdata->avatar, $first_name, $last_name, 60, 60, 21); ?>
                                <h3 class="mb0"><?php echo $first_name . ' ' . $last_name; ?></h3>

                            </div>

                            <div class="p20 pt0 pb10">
                                <div class="interactions p0 pt10 pb10 btop">
                                    <ul>

                                        <li><span style="width: 62px; float: left;"><i class="fa fa-envelope"></i> Email: </span><span class="userAdd">
                                                <strong class="em"><?php echo $Usrvalue->email; ?></strong></span> <input type="text" class="uAddText support_email" style="display:none;" name="support_email"> </li>
                                        <li><span style="width: 62px; float: left;"><i class="fa fa-phone"></i> Phone: </span><span class="userAdd">
                                                <strong class="em"><?php echo $Usrvalue->phone; ?></strong></span> <input type="text" class="uAddText support_email" style="display:none;" name="support_email"> </li>

                                    </ul>
                                </div>
                                <div class="p0 user_tags">
                                    <p class="usertags_headings">Tags</p>
                                    <button class="btn btn-xs btn_white_table">added review</button>
                                    <button class="btn btn-xs btn_white_table">male 25+</button>
                                    <button class="btn btn-xs btn_white_table">Referral</button>
                                    <button class="btn btn-xs btn_white_table">Media</button>
                                    <button class="btn btn-xs btn_white_table">+</button>
                                </div>
                            </div>
                            <div class="p20 footer_txt btop"><a href="#">Open Profile &gt; </a></div>
                        </div>
                    </div>
                </div>
            </div>


            <?php
        }
        ?>
        <script>
            $(document).ready(function () {
                $(".autoTimeUpdate").timeago();
            });
        </script>
        <?php
    }


        /**
        * this function is used to show chat which are assing to the current user in the Big web chat
        * @return type boolean
        */

     public function showYoutabAjax() {
        $count = 0;
        $flag = 0;
        $oUser = getLoggedUser();
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

        $Youchatlist = getTeamAssignDataHelper($loggedYou);
        foreach ($Youchatlist as $key => $value) {
            $token = "";
            $userid = "";
            $token = $value->room;
            $userid = $value->user;
            $userMessage = "";
            $chatName = explode(" ", $value->user_name);
            $chatMessageRes = getLastMessage($token);
            $getlastmessage = $chatMessageRes->message;

            $fileext = explode('.', $getlastmessage);
            $fileext = end($fileext);
            if ($fileext == 'png' || $fileext == 'jpg' || $fileext == 'jpeg' || $fileext == 'gif') {
                $userMessage = "File Attachment";
            } else if (strpos($getlastmessage, '/Media/') !== false) {
                $userMessage = "File Attachment";
            } else if (strpos($getlastmessage, 'amazonaws') !== false) {
                $userMessage = "File Attachment";
            } else {
                $userMessage = setStringLimit($getlastmessage, 80);
            }
            ?>
            <div class="tk_<?php echo $token; ?> activityShow <?php echo $count; ?> media chatbox_new bkg_white <?php if ($count == 1) { echo 'bbot';}?>"
            style="<?php
                 if ($count > 7) {
                     echo "display:block";
                 } if ($count == 1) {
                     echo 'box-shadow:0 2px 4px 0 rgba(1, 21, 64, 0.06)!important; border-radius:0 0 5px 5px';
                 } if ($count == 2) {
                     echo 'border-radius:5px 5px 5px 5px';
                 }
                 ?>">
                <a href="javascript:void(0);" class="media-link <?php
                if ($count != 1) {
                    echo 'bbot';
                }
                ?> getChatDetails WebBoxList <?php echo $count == 0 ? '' : ''; ?>" userId="<?php echo $value->user; ?>"assign_to="<?php echo assignto($token); ?>" RwebId="<?php echo $token; ?>">
                    <div class="media-left"><?php echo showUserAvtar('', $chatName[0], $chatName[1], 28, 28, 12); ?>
                        <!-- <i class="fa fa-star-o star_icon"></i> -->
                        <i class="fa star_icon <?php echo $value->favourite == 1 ? 'fa-star yellow' : 'fa-star-o'; ?> favouriteUser" userId="<?php echo $value->id; ?>"></i>
                    </div>

                    <div class="media-body">
                        <span class="slider-teamname fsize12 txt_dark"><?php echo $chatName[0]; ?> <?php echo $chatName[1]; ?></span>

                        <span style="color: #6a7995!important; font-size: 12px!important; font-weight: 300!important " id="Big_assign_<?php echo $userid; ?>" class="fsize12 assign_to"><span style="float: left; color: #6a7995!important; font-size: 12px!important; font-weight: 300!important  ">
                                <?php if (assignto($token) != "") { ?>Assigned to:&nbsp </span><?php
                                echo assignto($token);
                            }
                            ?></span>

                        <span id="b_assign_<?php echo $userid; ?>" class="slider-phone contacts txt_dark" style="margin:0px;font-weight:bold; font-size:12px!important"><?php echo $userMessage; ?></span>

                    </div>
                        <div class="media-right" style="width: 100px"><span class="date_time txt_grey fsize11"><time class="autoTimeUpdate autoTime_<?php echo $userid; ?>"
                        datetime="<?php echo usaDate($chatMessageRes->created); ?>" title="<?php echo usaDate($chatMessageRes->created); ?>"><?php //echo chatTimeAgo($chatMessageRes->created);   ?></time>


                            <span class="read_status_<?php echo $userid; ?>">
                                <?php
                                $readStatus = $chatMessageRes->read_status;
                                if ($readStatus == 1 || $chatMessageRes->user_to == $userid) {
                                    ?><i class="fa fa-circle txt_green fsize7"></i><?php
                                } else {
                                    ?><i class="fa fa-circle txt_red fsize7"></i><?php
                                }
                                ?>
                            </span>

                        </span></div>

                </a>
            </div>
            <?php
            $count++;
        }
        ?>
        <script>
            $(document).ready(function () {
                $(".autoTimeUpdate").timeago();
            });
        </script>
        <?php
    }



      /**
        * this function is used to show chat which are assing to the current user in the Small web chat
        * @return type boolean
        */


      public function showYoutabAjaxSmallbox() {


       $oUser = getLoggedUser();
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



        $Youchatlist = getTeamAssignDataHelper($loggedYou);

        foreach ($Youchatlist as $key => $value) {
            $token = "";
            $userid = "";
            $chatMessage = "";
            $created = "";
            $first_name = "";
            $last_name = "";
            $nameDetails = explode(" ", $value->user_name);
            $first_name = $nameDetails[0];
            $last_name = $nameDetails[1];

            $token = $value->room;
            $userid = $value->user;
            $chatMessageRes = getLastMessage($token);
            $chatMessage = $chatMessageRes->message;
            $created = $chatMessageRes->created;

            $fileext = explode('.', $chatMessage);
            $fileext = end($fileext);
            if ($fileext == 'png' || $fileext == 'jpg' || $fileext == 'jpeg' || $fileext == 'gif') {
                $userMessage = "File Attachment";
            } else if (strpos($chatMessage, '/Media/') !== false) {
                $userMessage = "File Attachment";
            } else if (strpos($chatMessage, 'amazonaws') !== false) {
                $userMessage = "File Attachment";
            } else {
                $userMessage = setStringLimit($chatMessage, 30);
            }
            $Usrvalue = getSupportUser($userid);
            $Usrvalue = $Usrvalue[0];

            // $favUser = $this->smsChat->getSMSFavouriteUser($loginUserData->id,$incid[0]->id);
            ?>
            <div RwebId="<?php echo $token; ?>" token="<?php echo $token; ?>" class="sidebar-user-box all_user_chat tk_<?php echo $token; ?>" assign_to="<?php echo assignto($token); ?>" id="sidebar-user-box-<?php echo $userid; ?>" user_id="<?php echo $userid; ?>" >
                <div class="avatarImage"><?php echo showUserAvtar('', $first_name, $last_name, 28, 28, 11); ?>

                </div>
                <span style="display:none" id="fav_star_<?php echo $userid; ?>"></span>
                <span class="slider-username contacts"><?php echo $first_name . ' ' . $last_name; ?> &nbsp; <i class="fa  star_icon <?php echo $value->favourite == 1 ? 'fa-star yellow' : 'fa-star-o'; ?> favouriteUser" userId="<?php echo $value->id; ?>"></i></span>




                <span id="Small_assign_<?php echo $userid; ?>" class="slider-phone contacts"><span style="float: left; width: 100%; font-weight:300!important; color: #6a7995 !important; font-size: 12px; margin-bottom: 3px; ">
                        <?php if (assignto($token) != "") { ?>Assigned to:&nbsp <?php
                            echo assignto($token);
                        }
                        ?></span></span>


                <span id="Small_You_assign_message_<?php echo $userid; ?>" class="slider-phone contacts txt_dark" style="margin:0px;color: #09204f !important; font-weight:300;padding-left:40px; font-size:12px!important"><?php echo $userMessage; ?></span>



                <span style="display: none;" class="slider-email contacts"></span>

                <span style="display: none;" class="slider-mobile contacts"></span>
                <span style="display: none;" class="slider-image img">
                    <?php
                    if (empty($oUser->avatar)) {
                        echo $currentUserImg = '/assets/images/default_avt.jpeg';
                    } else {
                        echo $currentUserImg = "https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/" . $oUser->avatar;
                    }
                    ?></span>

                <span class="user_status"><time class="autoTimeUpdate autoTime_<?php echo $userid; ?>"
                                                datetime="<?php echo usaDate($chatMessageRes->created); ?>" title="<?php echo usaDate($chatMessageRes->created); ?>"><?php //echo chatTimeAgo($value->created);     ?></time></span>


                <!--box hover chat details -->
                <div class="user_details p0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="header_sec"> <i class="icon-info22 txt_blue"></i><?php echo $first_name . ' ' . $last_name; ?></div>
                            <div class="sidebar_info p20 text-center">
                                <?php echo showUserAvtar('', $first_name, $last_name, 60, 60, 21); ?>
                                <h3 class="mb0"><?php echo $first_name . ' ' . $last_name; ?></h3>

                            </div>

                            <div class="p20 pt0 pb10">
                                <div class="interactions p0 pt10 pb10 btop">
                                    <ul>

                                        <li><span style="width: 62px; float: left;"><i class="fa fa-envelope"></i> Email: </span><span class="userAdd">
                                                <strong class="em"><?php echo $Usrvalue->email; ?></strong></span> <input type="text" class="uAddText support_email" style="display:none;" name="support_email"> </li>
                                        <li><span style="width: 62px; float: left;"><i class="fa fa-phone"></i> Phone: </span><span class="userAdd">
                                                <strong class="em"><?php echo $Usrvalue->phone; ?></strong></span> <input type="text" class="uAddText support_email" style="display:none;" name="support_email"> </li>

                                    </ul>
                                </div>
                                <div class="p0 user_tags">
                                    <p class="usertags_headings">Tags</p>
                                    <button class="btn btn-xs btn_white_table">added review</button>
                                    <button class="btn btn-xs btn_white_table">male 25+</button>
                                    <button class="btn btn-xs btn_white_table">Referral</button>
                                    <button class="btn btn-xs btn_white_table">Media</button>
                                    <button class="btn btn-xs btn_white_table">+</button>
                                </div>
                            </div>
                            <div class="p20 footer_txt btop"><a href="#">Open Profile &gt; </a></div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
        ?>

        <script>
            $(document).ready(function () {
                $(".autoTimeUpdate").timeago();
            });
        </script>

        <?php
    }


    /**
     * this function is used for set chat box
     * @return type object
     */

    public function setChatboxstatus(Request $request)
    {
        $webChatModel = new WebChatModel();
        $user_id =  $request->currentUser;
        $subscriber_id =  $request->userID;
        $type =  $request->type;
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
    public function removeBoxStatus(Request $request)
    {
        $webChatModel = new WebChatModel();
        $user_id =  $request->currentUser;
        $subscriber_id =  $request->userID;
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

    /**
     * this function is used for display chat third party widget
     * @return type object
     */
    public function display_chat_widget($widgetType, $userAccountID){

        $webChatModel = new WebChatModel();
        $teamModel = new TeamModel();
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        if (!empty($userAccountID) && !empty($widgetType)) {
            $content = '';
            if ($widgetType == 'chat') {
                $widgetSettings = $webChatModel->getWidgetSettings($userAccountID);
                $teamsData = $teamModel->getTeamMembers($widgetSettings->user_id);
                $userDataDetail = getUserDetail($widgetSettings->user_id);
                $widgetData = array(
                    'userAccountID' => $userAccountID,
                    'widgetSettings' => $widgetSettings,
                    'userDataDetail' => $userDataDetail,
                    'teamsData' => $teamsData
                );

                $importViewHtml =  View("admin.chat_widget.embed_chat", $widgetData);
                $content = $importViewHtml->render();

            }

            $aData = array('content' => $content);
            echo json_encode($aData);
            exit;
        }

    }


    /**
     * this function is used for get user message
     * @return type object
     */
    public function getUserMessages(Request $request) {

        $response = '';
        $webChatModel = new WebChatModel();
        $token = $request->room;
        $offset = $request->offset;
        $result = $webChatModel->getAllMessages($token);
        $currentUserData = $webChatModel->getUserMessages($token);
        foreach ($result as $get_value) {
            $get_value->created = timeAgo($get_value->created);
        }
        if ($result) {
            $response = array('status' => 'ok','currentUsername' => $currentUserData->user_name, 'current_user_id' => $currentUserData->user, 'res' => $result);
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }

    /**
     * this function is used for add support user
     * @return type object
     */

    public function supportUser(Request $request) {

        $webChatModel = new WebChatModel();
        $room = $request->room;
        $userID = $request->userID;
        $currentUser = $request->currentUser;
        $support_name = $request->support_name;
        $email = $request->email;
        $aLocationData = getLocationData();

        $aData = array(
            'room' => $room,
            'supp_user' => $userID,
            'user' => $currentUser,
            'user_name' => $support_name,
            'email' => $email,
            'ip_address' => $aLocationData['ip_address'],
            'platform' => $aLocationData['platform'],
            'platform_device' => $aLocationData['platform_device'],
            'browser' => $aLocationData['name'],
            'useragent' => $aLocationData['userAgent'],
            'country' => $aLocationData['country'],
            'countryCode' => $aLocationData['countryCode'],
            'region' => $aLocationData['region'],
            'city' => $aLocationData['city'],
            'longitude' => $aLocationData['longitude'],
            'latitude' => $aLocationData['latitude'],
            'status' => '0',
            'created' => date('Y-m-d H:i:s')
        );
        $result = $webChatModel->addSupportUser($aData);
        if ($result) {
            $response = array('status' => 'ok');
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;

    }


    /**
     * this function is used for read chat message
     * @return type object
     */
    public function readChatMsg(Request $request) {

        $webChatModel = new WebChatModel();
        $to_user = $request->chatTo;
        $from_user = $request->chatFrom;
        $aData = array(
            'read_status' => '1'
        );

        $result = $webChatModel->readChatMsg($to_user, $from_user, $aData);
    }

     /**
     * this function is used to add favourite webchatuser
     * @return type object
     */

    public function favouriteUser(Request $request) {
        $userId = $request->userId;
        $status = $request->status;
        $webChatModel = new WebChatModel();
        $aData = array(
            'favourite' => $status
        );
        $result = $webChatModel->favouriteUser($userId, $aData);

        if ($result) {
            $response = array('status' => 'ok');
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;

    }


    /**
     * this function is used to make the list after searching in the small webchat
     * @return type list
     */


    public function smallwfilter(Request $request) {
        $searchvalue = $request->searchVal;
        $loginUserData = getLoggedUser();
        $activechatlist = smallwfilterInput($loginUserData->id, $searchvalue);


        $count = 0;
        $flag = 0;

        foreach ($activechatlist as $key => $value) {
            $token = "";
            $userid = "";
            $chatMessage = "";
            $created = "";
            $first_name = "";
            $last_name = "";
            $user_to="";
            $user_name="";
            $token = $value->token;
            $user_to = getTeamByroom($token);
            $value = getSupportUser($user_to);
            if($value->count()>0)
            {
            $value = $value[0];
            $user_name = $value->user_name;
            $nameDetails = explode(" ", $user_name);
            $first_name = $nameDetails[0];
            $last_name = $nameDetails[1];
            $first_name = $first_name!="" ? $first_name : '';
            $last_name = $last_name!="" ? $last_name : '';

            $userid = $value->user;
            $chatMessageRes = getLastMessage($token);
            $chatMessage = $chatMessageRes->message;
            $created = $chatMessageRes->created;

            $fileext = explode('.', $chatMessage);
             $fileext = end($fileext);
            if ($fileext == 'png' || $fileext == 'jpg' || $fileext == 'jpeg' || $fileext == 'gif') {
                $userMessage = "File Attachment";
            } else if (strpos($chatMessage, '/Media/') !== false) {
                $userMessage = "File Attachment";
            } else if (strpos($chatMessage, 'amazonaws') !== false) {
                $userMessage = "File Attachment";
            } else {
                $userMessage = setStringLimit($chatMessage, 30);
            }

            // $favUser = $this->smsChat->getSMSFavouriteUser($loginUserData->id,$incid[0]->id);
            ?>
            <div RwebId="<?php echo $token ?>" token="<?php echo $token; ?>" class="sidebar-user-box all_user_chat tk_<?php echo $token; ?>" incWid="" id="sidebar-user-box-<?php echo $userid; ?>" user_id="<?php echo $userid; ?>" >
                <div class="avatarImage"><?php echo showUserAvtar('', $first_name, $last_name, 28, 28, 11); ?></div>

                <span class="slider-username contacts"><?php echo $first_name . ' ' . $last_name; ?> </span>
                <span class="slider-phone contacts txt_dark" style="margin:0px;color: #6a7995!important; font-weight:bold;padding-left:40px; font-size:12px!important"><?php echo $userMessage; ?></span>

                 <span id="" class="slider-phone contacts"><span style="float: left; width: 100%; font-weight:300!important; color: #6a7995 !important; font-size: 12px; margin-bottom: 3px; ">
            <?php if(assignto($token)!=""){ ?>Assigned to:&nbsp <?php echo assignto($token); } ?> </span></span>


                <span style="display: none;" class="slider-email contacts"></span>

                <span style="display: none;" class="slider-mobile contacts"></span>
                <span style="display: none;" class="slider-image img">
                    <?php
                    if (empty($loginUserData->avatar)) {
                        echo $currentUserImg = '/assets/images/default_avt.jpeg';
                    } else {
                        echo $currentUserImg = "https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/" . $loginUserData->avatar;
                    }
                    ?></span>

                <span class="user_status"><time class="autoTimeUpdate autoTime_<?php echo $userid; ?>"
                                                datetime="<?php echo usaDate($created); ?>" title="<?php echo usaDate($created); ?>"><?php //echo chatTimeAgo($chatMessageRes->created);    ?></time></span>

                <!--box hover chat details -->
                <div class="user_details p0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="header_sec"> <i class="icon-info22 txt_blue"></i><?php echo $first_name . ' ' .$last_name; ?></div>
                            <div class="sidebar_info p20 text-center">
                                <?php echo showUserAvtar('', $first_name, $last_name, 60, 60, 21); ?>
                                <h3 class="mb0"><?php echo $first_name . ' ' . $last_name; ?></h3>


                            </div>
                            <div class="p20 pt0 pb10">
                                <div class="interactions p0 pt10 pb10 btop">
                                    <ul>

        <li><span style="width: 62px; float: left;"><i class="fa fa-envelope"></i> Email: </span><span class="userAdd">
        <strong class="em"><?php echo $value->email; ?></strong></span> <input type="text" class="uAddText support_email" style="display:none;" name="support_email"> </li>
        <li><span style="width: 62px; float: left;"><i class="fa fa-phone"></i> Phone: </span><span class="userAdd">
        <strong class="em"><?php echo $value->phone; ?></strong></span> <input type="text" class="uAddText support_email" style="display:none;" name="support_email"> </li>

        </ul>
                                </div>
                                <div class="p0 user_tags">
                                    <p class="usertags_headings">Tags</p>
                                    <button class="btn btn-xs btn_white_table">added review</button>
                                    <button class="btn btn-xs btn_white_table">male 25+</button>
                                    <button class="btn btn-xs btn_white_table">Referral</button>
                                    <button class="btn btn-xs btn_white_table">Media</button>
                                    <button class="btn btn-xs btn_white_table">+</button>
                                </div>
                            </div>
                            <div class="p20 footer_txt btop"><a href="#">Open Profile &gt; </a></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        <script>
            $(document).ready(function () {
                $(".autoTimeUpdate").timeago();
            });
        </script>
        <?php
    }
}


    /**
     * this function is used to make the list after searching in the big webchat
     * @return type list
     */


     public function bigwfilter(Request $request) {

        $count = 0;
        $flag = 0;
        $userMessage = "";
        $searchvalue = $request->searchVal;
        $loginUserData = getLoggedUser();
        $activechatlist = smallwfilterInput($loginUserData->id, $searchvalue);

        foreach ($activechatlist as $key => $value) {
            $token = "";
            $userid = "";
            $chatMessage = "";
            $created = "";
            $first_name = "";
            $last_name = "";

            $value->user_to = getTeamByroom($value->token);
            $value = getSupportUser($value->user_to);
            if($value->count()>0)
            {
            $value = $value[0];
            $nameDetails = explode(" ", $value->user_name);
            $first_name = $nameDetails[0];
            $last_name = $nameDetails[1];

            $token = $value->room;
            $userid = $value->user;
            $chatMessageRes = getLastMessage($token);
            $chatMessage = $chatMessageRes->message;
            $created = $chatMessageRes->created;

            $fileext = explode('.', $chatMessage);
             $fileext = end($fileext);
            if ($fileext == 'png' || $fileext == 'jpg' || $fileext == 'jpeg' || $fileext == 'gif') {
                $userMessage = "File Attachment";
            } else if (strpos($chatMessage, '/Media/') !== false) {
                $userMessage = "File Attachment";
            } else if (strpos($chatMessage, 'amazonaws') !== false) {
                $userMessage = "File Attachment";
            } else {
                $userMessage = setStringLimit($chatMessage, 30);
            }
            ?>
            <div class="activityShow<?php echo $count; ?> media chatbox_new bkg_white <?php
            if ($count == 1) {
                echo 'mb10';
            }
            ?>" style="<?php
                 if ($count > 7) {
                     echo "display:block";
                 }
                 if ($count == 1) {
                     echo 'box-shadow:0 2px 4px 0 rgba(1, 21, 64, 0.06)!important; border-radius:0 0 5px 5px';
                 }
                 if ($count == 2) {
                     echo 'border-radius:5px 5px 5px 5px';
                 }
                 ?>">
                <a href="javascript:void(0);" class="media-link <?php
                if ($count != 1) {
                    echo 'bbot';
                }
                ?> tk_<?php echo $token; ?> getChatDetails WebBoxList <?php echo $count == 0 ? 'activechat' : ''; ?>" userId="<?php echo $userid; ?>"
                   assign_to="<?php echo assignto($token); ?>" RwebId="<?php echo $token; ?>" token="<?php echo $token; ?>"<?php }
                ?> >
                    <div class="media-left"><?php echo showUserAvtar('', $first_name, $last_name, 28, 28, 12); ?>

                    </div>

                    <div class="media-body">
                        <span class="fsize12 txt_dark"><?php echo $first_name; ?> <?php echo $last_name; ?></span>

                        <span id="Big_assign_message_<?php echo $userid; ?>" class="slider-phone contacts txt_dark" style="margin:0px;color: #6a7995!important; font-weight:bold; font-size:12px!important"><?php echo $userMessage; ?></span>

                        <span id="Big_assign_<?php echo $userid; ?>" class="fsize12 txt_dark assign_to"><span style="float: left; font-weight:bold; ">
                                <?php if (assignto($token) != "") { ?>Assigned to:&nbsp </span><?php
                                echo assignto($token);
                            }
                            ?></span>


                    </div>
                    <div class="media-right" style="width: 100px"><span class="date_time txt_grey fsize11"><time class="autoTimeUpdate autoTime_<?php echo $userid; ?>" datetime="<?php echo usaDate($created); ?>" ></time>

                        </span></div>

                </a>
            </div>

            <?php
            $count++;
        }
        ?>
        <script>
            $(document).ready(function () {
                $(".autoTimeUpdate").timeago();
            });
        </script>
        <?php
    }




    /**
    * This function is used for chat stats/overview
    * @param type
    * @return type
    */

    public function overview() {

        $loginUserData = getLoggedUser();
        $smsChat = new SmsChatModel();
        $getChatThread = $smsChat->getWebChatThread($loginUserData->id);
        $supportChat = $smsChat->supportChat($loginUserData->id);
        $supportChatGroupByDate = $smsChat->supportChatGroupByDate($loginUserData->id);
        $supportChatCurrent = $smsChat->supportChatCurrent($loginUserData->id);
        $supportChatGroupByCountry = $smsChat->supportChatGroupByCountry($loginUserData->id);
        $supportChatCompleted = $smsChat->supportChatCompleted($loginUserData->id);
        $getWebChatCurrentThread = $smsChat->getWebChatCurrentThread($loginUserData->id);

        $lastfifteendayschat = array();
        for ($i = 0; $i < 15; $i++) {
            $showShowData = array();
            $currentDate = date("Y-m-d", strtotime("-" . $i . " day"));
            $supportChatByDate = $smsChat->supportChatByDate($loginUserData->id, $currentDate);
            // $lastfifteendayschat[$currentDate] = $supportChatByDate;
            $showShowData = array(date('M d', strtotime($currentDate)), $supportChatByDate);
            $lastfifteendayschat[] = $showShowData;
        }

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Chat Overview" class="sidebar-control active hidden-xs ">Chat Overview</a></li>
                    </ul>';

        return view('admin.chat_app.chat_overview', array('title' => 'Chat Overview', 'pagename' => $breadcrumb, 'getChatThread' => $getChatThread, 'getWebChatCurrentThread' => $getWebChatCurrentThread, 'supportChat' => $supportChat, 'supportChatGroupByDate' => $supportChatGroupByDate, 'supportChatCurrent' => $supportChatCurrent, 'supportChatGroupByCountry' => $supportChatGroupByCountry, 'supportChatCompleted' => $supportChatCompleted, 'lastfifteendayschat' => $lastfifteendayschat));
    }

    /**
     * Used to get last message of chat contacts
     * @param $token
     * @return array
     */
    public function getLastChatMessage($token){
        $oMsg = getLastMessage($token);
        $sMessage = $oMsg->message;
        $created = usaDate($oMsg->created);
        $fileext = explode('.', $sMessage);
        $fileext = end($fileext);
        if ($fileext == 'png' || $fileext == 'jpg' || $fileext == 'jpeg' || $fileext == 'gif') {
            $userMessage = "File Attachment";
        }
        else if (strpos($sMessage, '/Media/') !== false) {
            $userMessage="File Attachment";
        }
        else if (strpos($sMessage, 'amazonaws') !== false) {
            $userMessage="File Attachment";
        }
        else {
            $userMessage = setStringLimit($sMessage, 80);
        }
        return ['lastMessage'=>$userMessage, 'messageTime' => $created];
    }

    /**
     * Get list of shortcusts available for the chat
     * @return \App\Models\Admin\type
     */
    public function listShortcuts() {
        $oUser = getLoggedUser();
        $shortCuts = SubscriberModel::getchatshortcutlisting($oUser->id);
        return $shortCuts;
    }

    /**
     * This function used to get the list of unread message belonging to a chat conversation
     * @param $Request
     * @param $request
     * @return mixed
     */
    public function getUnreadMsgs(Request $request){
        $roomId = $request->room;
        $userId = $request->userid;
        $mChatModel =  new WebChatModel();
        $unreadCount = $mChatModel->getUnreadCount($roomId, $userId);
        return $unreadCount;
    }

    /**
     * Update read status of a conversation
     * @param $Request
     * @param $request
     * @return mixed
     */
    public function markRead(Request $request){
            $roomId = $request->room;
            $userId = $request->userid;
            $mChatModel =  new WebChatModel();
            $result = $mChatModel->updateReadStatus($roomId, $userId);
            return $result;
    }

    /**
     * This function used to send email from chat module
     * @param Request $request
     * @return bool
     */
    public function sendEmail(Request $request){
        $oUser = getLoggedUser();
        $isLoggedInTeam = Session::get("team_user_id");
        $toAddress = $request->email;
        $fromAddress = $oUser->email;
        $msg = $request->messageContent;
        $plainText = convertHtmlToPlain($msg);
        $subject = "Brandboost: you got new email";
        $aSendgridData = getSendgridAccount($oUser->id);
        $user = $aSendgridData->sg_username;
        $password = $aSendgridData->sg_password;
        $host = 'smtp.sendgrid.net';
        $port = '2525';
        $type = 'html';
        $url = 'https://api.sendgrid.com/';
        $params = array(
            'api_user' => $user,
            'api_key' => $password,
            'to' => $toAddress,
            'subject' => ($subject) ? $subject : config('bbconfig.blank_subject'),
            'html' => $msg,
            'text' => $plainText,
            'from' => $fromAddress
        );

        $request = $url . 'api/mail.send.json';
        $session = curl_init($request);
        curl_setopt($session, CURLOPT_POST, true);
        curl_setopt($session, CURLOPT_POSTFIELDS, $params);
        curl_setopt($session, CURLOPT_HEADER, false);
        curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($session);
        //Store Data into the database
        $aData = [
            'from' => $fromAddress,
            'to' => $toAddress,
            'msg' => $msg,
            'team_id' => $isLoggedInTeam ? $isLoggedInTeam : '',
            'created' => date("Y-m-d H:i:s")
        ];
        $mChatModel =  new WebChatModel();
        $mChatModel->saveEmailChat($aData);
        /*$aUsage = array(
            'client_id' => $oUser->id,
            'usage_type' => 'email',
            'content' => $msg,
            'spend_to' => $toAddress,
            'spend_from' => '',
            'module_name' => 'chat',
            'module_unit_id' => ''
        );
        updateCreditUsage($aUsage);
        //Todoo: Save Email Data into the database if required*/
        return ['status' =>'ok'];

    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function showEmailThread(Request $request){
        $oUser = getLoggedUser();
        $fromAddress = $oUser->email;
        $to = $request->to;
        $mWebChat = new WebChatModel();
        $aData = $mWebChat->getEmailThread($fromAddress, $to);
        return $aData;

    }

    /**
     * This function used to get Chat room info
     * @param Request $request
     * @return \App\Models\Admin\type
     */
    public function getThreadInfo(Request $request){
        $tokenId = $request->room;
        $mWebChat = new WebChatModel();
        $oData = $mWebChat->checkTeamAssign($tokenId);
        return ['room'=>$oData];
    }




}
