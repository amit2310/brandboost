<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\SmsChatModel;
use App\Models\Admin\SubscriberModel;
use Illuminate\Support\Facades\Input;
use Session;
class SmsChat extends Controller {

    /**
     * smschat module index function
     * @return type
     */


    public function index(Request $request) {
        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Live Chat" class="sidebar-control active hidden-xs ">Live Chat</a></li>
                      </ul>';
        $oUser = getLoggedUser();
        $favouriteUserData = SmsChatModel::getSMSFavouriteByUserId($oUser->id);
        $oContacts = SubscriberModel::getGlobalSubscribers($oUser->id);
        $data = array('title' => 'Chat System', 'pagename' => $breadcrumb, 'usersdata' => $oContacts, 'favouriteUserData' => $favouriteUserData, 'loginUserData' => $oUser, 'totalSubscriber' => count($oContacts));
        return view('admin.sms_chat.index', $data);
    }


    /**
     * this function is used to return the sms threads
     * @return type
     */


    public function showSmsThreads() {
        $oUser = getLoggedUser($redirect = false);
        if (empty($oUser)) {
            return;
            exit();
        }
        $response = array();
        $userId = Input::post("userId");
        $SubscriberPhone = trim(numberForamt(Input::post("SubscriberPhone")));
        $usersdata = getUserbyPhone($SubscriberPhone);
        $usersdata = $usersdata[0];
        $userDataDetail = getUserDetail($usersdata->user_id);
        $offsetValue = Input::post("offsetValue") > 0 ? 0 : Input::post("offsetValue");
        $userDetail = getSubscribersInfo($userId);
        $isLoggedInTeam = Session::get("team_user_id");
        if ($isLoggedInTeam) {
            $hasweb_access = getMemberchatpermission($isLoggedInTeam);
            if ($hasweb_access > 0 && $hasweb_access->sms_chat == 1) {
                if ($hasweb_access->bb_number != "") {
                    $Twilionumber = numberForamt($hasweb_access->bb_number);
                } else {
                    $Twilionumber = numberForamt(getClientTwilioAccount($oUser->id));
                }
            } else {
                $Twilionumber = numberForamt(getClientTwilioAccount($oUser->id));
            }
        } else {
            $Twilionumber = numberForamt(getClientTwilioAccount($oUser->id));
        }
        $chatThreadsData = SmsChatModel::getSMSThreadsByPhoneNo($Twilionumber, $SubscriberPhone, $offsetValue);
        if (count($chatThreadsData) > 0) {
            foreach ($chatThreadsData as $chatData) {
                $teamMeberName = "";
                if (!empty($chatData->team_id)) {
                    $teamMeberName = smsteam_member_name($chatData->team_id);
                }
                if ($chatData->msg != '' && $chatData->module_name != 'nps') {
                    $fileView = '<div class="media-content">' . $chatData->msg . '</div>';
                    $fileext = explode('.', $chatData->msg);
                    $fileext = end($fileext);
                    $mmsFile = explode('/Media/', $chatData->msg);
                    if ($fileext == 'png' || $fileext == 'jpg' || $fileext == 'jpeg' || $fileext == 'gif') {
                        $fileView = "<div class='mrdia-file'><a href='" . $chatData->msg . "' target='_blank' class='previewImage'><img src='" . $chatData->msg . "' /></a></div>";
                    } else if ($fileext == 'doc' || $fileext == 'docx' || $fileext == 'odt' || $fileext == 'csv' || $fileext == 'pdf') {
                        $fileView = "<div class='media-content'><a href='" . $chatData->msg . "' target='_blank'>Download '" . $fileext . "' File</a></div>";
                    } else if (count($mmsFile) > 1) {
                        $fileView = "<div class='mrdia-file'><a href='" . $chatData->msg . "' target='_blank' class='previewImage'><img src='" . $chatData->msg . "' /></a></div>";
                    }
                    if ($chatData->media_type == 'video') {
                        $media = explode('.', $chatData->media_url_show);
                        if (!empty($chatData->media_url_show)) {
                            $fileView = "<video class='media_file' controls><source src='" . $chatData->media_url_show . "' type='video/" . end($media) . "'></video>";
                        } else {
                            $fileView = $chatData->msg;
                        }
                    }
                    if (trim($chatData->to) == trim($SubscriberPhone)) {
?>

                        <li class="media reversed" style="margin-top: 10px;">
                           <div class="media-body"> <span class="media-annotation user_icon"><span class="circle_green_status status-mark"></span><!--<img src="images/face2.jpg" class="img-circle img-xxs" alt="">--> 
                        <?php echo showUserAvtar($oUser->avatar, $oUser->firstname, $oUser->lastname, 28, 28, 11); ?></span>
                        <?php echo $fileView; ?>
                        <?php if (!empty($teamMeberName)) { ?>
                        <span style="padding: 0;display: block;font-size: 10px;" class="text-muted text-size-small">Sent by <?php echo $teamMeberName; ?></span>
                        <span style="padding: 0;display: block;font-size: 8px; margin-top: 1px;" class="txt_grey text-size-small">On <?php echo date("H:i:s", strtotime($chatData->created)); ?> - <?php echo date('F d Y', strtotime($chatData->created)); ?></span>

                               <?php
                        } ?>

                            </div>
                        </li>
                    <?php
                    } else {
?>
                        <li class="media" style="margin-top: 10px;">
                            <div class="media-body myclass"> <span class="media-annotation user_icon"><span class="circle_green_status status-mark"></span>
                        <?php echo showUserAvtar($userDataDetail->avatar, $usersdata->firstname, $usersdata->lastname, 28, 28, 11); ?></span>
                        <?php echo $fileView; ?>
                        <?php if (!empty($teamMeberName)) { ?>
                        <span style="padding: 0;display: block;font-size: 10px;" class="text-muted text-size-small">Sent by <?php echo $teamMeberName; ?></span>
                        <span style="padding: 0;display: block;font-size: 8px; margin-top: 1px;" class="txt_grey text-size-small">On <?php echo date("H:i:s", strtotime($chatData->created)); ?> - <?php echo date('F d Y', strtotime($chatData->created)); ?></span>

                               <?php
                        } ?>
                            </div>
                        </li>

                        <?php
                    }
                }
            }
        }
    }


    /**
     * this function is used to return Subscriber information
     * @return type
     */


    public function getSubsinfo() {
        $userId = Input::get("userId");
        $SubscriberPhone = Input::get("SubscriberPhone");
        if (empty($userId)) {
            $usersdata = getUserbyPhone($SubscriberPhone);
            $usersdata = $usersdata[0];
            $userId = $usersdata->id;
        }
        $userDetail = getSubscribersInfo($userId);
        $userData = $userDetail[0];
        $userDataDetail = getUserDetail($userData->user_id);
        $avatar = "";
        if (!empty($userDataDetail->avatar)) {
            $avatar = $userDataDetail->avatar;
        }
        $avatar = showUserAvtar($avatar, $userData->firstname, $userData->lastname, 88, 88, 21);
        $arr = array();
        $arr[0]['email'] = $userData->email;
        $arr[1]['name'] = $userData->firstname . ' ' . $userData->lastname;
        $arr[2]['phone'] = $userData->phone;
        $arr[3]['avatar'] = $avatar;
        $arr[4]['avatar_url'] = $avatar;
        $arr[5]['em_sub_id'] = Input::get("userId");
        $arr[6]['city'] = $userData->cityName;
        $arr[7]['code'] = $userData->country_code;
        $arr[8]['gender'] = $userData->gender;
        $arr[9]['avfinder'] = $avatar;
        echo json_encode($arr);
    }


    /**
     * this function is used to return sms notes
     * @return type
     */


    public function listingNotes() {
        $SubscriberPhone = numberForamt(Input::post("NotesTo"));
        $notes_from = numberForamt(Input::post("notes_from"));
        $mSubscriber = new SubscriberModel();
        $oNotes = $mSubscriber->visitornotes($SubscriberPhone);
        foreach ($oNotes as $NotesData) {
            $fileext = end(explode('.', $NotesData->message));
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
                            <?php echo showUserAvtar($loginUserData->avatar, $loginUserData->firstname, $loginUserData->lastname, 28, 28, 11); ?>                               </span>
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
     * this function is used send message through twilio
     * @return type
     */


    public function sendMsg() {
        $response = array();
        $isLoggedInTeam = Session::get("team_user_id");
        $msgSendUserId = Input::post("userId");
        $phoneNo = Input::post("phoneNo");
        $messageContent = Input::post("messageContent");
        $moduleName = Input::post("moduleName");
        $smstoken = Input::post("smstoken");
        $media_type = Input::get("media_type");
        $videoUrl = Input::get("videoUrl");
        $oUser = getLoggedUser();
        $aTwilioAc = getTwilioAccountCustom($oUser->id);
        $sid = $aTwilioAc->account_sid;
        $token = $aTwilioAc->account_token;
        $hasweb_access = getMemberchatpermission($isLoggedInTeam);
        $media_url_show = '';
        
        if ($isLoggedInTeam) {
            $hasweb_access = getMemberchatpermission($isLoggedInTeam);
            if ($hasweb_access > 0 && $hasweb_access->sms_chat == 1) {
                if ($hasweb_access->bb_number != "") {
                    $from = numberForamt($hasweb_access->bb_number);
                } else {
                    $from = numberForamt(getClientTwilioAccount($oUser->id));
                }
            } else {
                $from = numberForamt(getClientTwilioAccount($oUser->id));
            }
        } else {
            $from = numberForamt(getClientTwilioAccount($oUser->id));
        }

        if (!empty($videoUrl)) {
            $randNum = rand(8, 14);
            $rand_string = random_strings($randNum);
            $media_url_show = $messageContent;
            $sData = array('token' => $smstoken, 'rand_string' => $rand_string, 'url' => $messageContent, 'sms_flow' => 'outgoing', 'created' => date("Y-m-d H:i:s"));
            $lastInsertId = $this->smsChat->addSmsMedia($sData);
            $videoUrlShow = 'http://brandboost.io/media/' . $rand_string;
            $messageContent = 'Please click to access media ' . $videoUrlShow;
            $aSmsData = array('sid' => $sid, 'token' => $token, 'to' => $phoneNo, 'from' => $from, 'msg' => $messageContent);
        } else {
            $aSmsData = array('sid' => $sid, 'token' => $token, 'to' => $phoneNo, 'from' => $from, 'msg' => $messageContent);
        }
        $response = sendClinetSMS($aSmsData);
        $aUsage = array('client_id' => $loginUserData->id, 'usage_type' => 'sms', 'direction' => 'outbound', 'content' => $messageContent, 'spend_to' => $phoneNo, 'spend_from' => $from, 'module_name' => 'sms chat', 'module_unit_id' => '');
        $charCount = strlen($messageContent);
        $totatMessageCount = ceil($charCount / 160);
        if ($totatMessageCount > 1) {
            for ($i = 0;$i < $totatMessageCount;$i++) {
                $aUsage['segment'] = $i + 1;
                updateCreditUsage($aUsage);
            }
        } else {
            $aUsage['segment'] = 1;
            updateCreditUsage($aUsage);
        }
        $phoneNo = numberForamt($phoneNo);
        $from = numberForamt($from);
        $sData = array('to' => $phoneNo, 'from' => $from, 'twilio_token' => $token, 'token' => $smstoken, 'msg' => $messageContent, 'media_type' => $media_type, 'module_name' => $moduleName, 'created' => date("Y-m-d H:i:s"), 'team_id' => $isLoggedInTeam, 'media_url_show' => $media_url_show);
        $smsChat = new SmsChatModel();
         $smsChat->addSmsChatData($sData);
        if ($response) return true;
        else return false;
    }
}
