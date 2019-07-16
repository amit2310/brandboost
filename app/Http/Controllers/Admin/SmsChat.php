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
        $offsetValue = Input::post("offsetValue") > 0 ? 0 : Input::post("offsetValue");
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

                $oUseravatar = !empty($oUser->avatar) ? $oUser->avatar : '';
                $oUserfirstname = !empty($oUser->firstname) ? $oUser->firstname : '';
                $oUserlastname = !empty($oUser->lastname) ? $oUser->lastname : '';
                $useravatar = !empty($usersdata->avatar) ? $usersdata->avatar : '';
                $userfirstname = !empty($usersdata->firstname) ? $usersdata->firstname : '';
                $userlastname = !empty($usersdata->lastname) ? $usersdata->lastname : '';


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
                        <?php echo showUserAvtar($oUseravatar, $oUserfirstname, $oUserlastname, 28, 28, 11); ?></span>
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
                        <?php echo showUserAvtar($useravatar, $userfirstname, $userlastname, 28, 28, 11); ?></span>
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


    public function listingSmsNotes() {
        $oUser = getLoggedUser();
        $SubscriberPhone = numberForamt(Input::post("NotesTo"));
        $notes_from = numberForamt(Input::post("notes_from"));
        $SmsChatObj = new SmsChatModel();
         $oNotes = $SmsChatObj->getSmsNotes($SubscriberPhone);
        foreach ($oNotes as $NotesData) {
            $fileext = explode('.', $NotesData->notes);
            $fileext = end($fileext);
            $mmsFile = explode('/Media/', $NotesData->notes);
            if ($fileext == 'png' || $fileext == 'jpg' || $fileext == 'jpeg' || $fileext == 'gif') {
                $NotesData->notes = "<div class='mrdia-file'><a href='" . $NotesData->notes . "' target='_blank' class='previewImage'><img src='" . $NotesData->notes . "' /></a></div>";
            } else if ($fileext == 'doc' || $fileext == 'docx' || $fileext == 'odt' || $fileext == 'csv' || $fileext == 'pdf') {
                $NotesData->notes = "<div class='media-content'><a href='" . $NotesData->notes . "' target='_blank'>Download '" . $fileext . "' File</a></div>";
            } else if (count($mmsFile) > 1) {
                $NotesData->notes = "<div class='mrdia-file'><a href='" . $NotesData->notes . "' target='_blank' class='previewImage'><img src='" . $NotesData->notes . "' /></a></div>";
            }
?>
                    <li class="media reversed">
                       <div class="media-body">  
                           <span style="display: none;" class="media-annotation user_icon"><span class="circle_green_status status-mark"></span>
                            <?php echo showUserAvtar($oUser->avatar, $oUser->firstname, $oUser->lastname, 28, 28, 11); ?>                               </span>
                           <div class="media-content" style="background-color:#fff9ec!important;"><?php echo $NotesData->notes; ?>
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
     * this function is used send message through twilio
     * @return type
     */


    public function sendMsg() {
        $isLoggedInTeam = Session::get("team_user_id");
        $msgSendUserId = Input::post("userId");
        $phoneNo = Input::post("phoneNo");
        $messageContent = Input::post("messageContent");
        $moduleName = Input::post("moduleName");
        $media_type = Input::get("media_type");
        $videoUrl = Input::get("videoUrl");
        $oUser = getLoggedUser();
        $aTwilioAc = getTwilioAccountCustom($oUser->id);
        $sid = $aTwilioAc->account_sid;
        $token = $aTwilioAc->account_token;
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
        if ($response) {
            $aUsage = array('client_id' => $oUser->id, 'usage_type' => 'sms', 'direction' => 'outbound', 'content' => $messageContent, 'spend_to' => $phoneNo, 'spend_from' => $from, 'module_name' => 'sms chat', 'module_unit_id' => '');
            $charCount = strlen($messageContent);
            $totatMessageCount = ceil($charCount / 160);
            if ($totatMessageCount > 1) {
                for ($i = 0;$i < $totatMessageCount;$i++) {
                    $aUsage['segment'] = $i + 1;
                    //updateCreditUsage($aUsage);
                    
                }
            } else {
                $aUsage['segment'] = 1;
                //updateCreditUsage($aUsage);
                
            }
            $phoneNo = numberForamt($phoneNo);
            $from = numberForamt($from);
            $aToken = $phoneNo + $from;
            if ($phoneNo > $from) {
                $sToken = $phoneNo - $from;
            } else {
                $sToken = $from - $phoneNo;
            }
            $tokenResponse = $aToken . 'n' . $sToken;
            $sData = array('to' => $phoneNo, 'from' => $from, 'twilio_token' => $token, 'token' => $tokenResponse, 'msg' => $messageContent, 'media_type' => $media_type, 'module_name' => $moduleName, 'created' => date("Y-m-d H:i:s"), 'team_id' => $isLoggedInTeam, 'media_url_show' => $media_url_show);
            $smsChat = new SmsChatModel();
            $smsChat->addSmsChatData($sData);
        } else {
            echo 'ERROR!';
        }
    }


    /**
     * this function is used to return subscriber list based on the input provided 
     * @return type
     */


    public function livesearch() {
        $oUser = getLoggedUser($redirect = false);
        if (empty($oUser)) {
            return;
            exit();
        }
         $smsChat = new SmsChatModel();
        $liveThreadsData = $smsChat->getlivesearchData($oUser->id, Input::get("q"));
        if (count((array)$liveThreadsData) > 0) {
            echo '<ul>';
            foreach ($liveThreadsData as $key => $value) {
?>
                <li onclick="showSMSChatData('<?php echo $value->id; ?>', '<?php echo $value->phone; ?>', '<?php echo $value->firstname . ' ' . $value->lastname; ?>')" style="cursor:pointer"><?php echo $value->firstname . ' ' . $value->lastname . '&nbsp (' . $value->phone . ')'; ?></li>
                <?php
            }
            echo '</ul>';
        } else {
            echo '400';
        }
    }


    /**
    * this function is used to filter the sms list based on the input provided in sms chat
     * @return type
     */

    public function getSearchSmsListByinput() {
    
        $count = 0;
        $isLoggedInTeam = Session::get("team_user_id");
        $searchvalue = Input::post("searchVal");
        $oUser = getLoggedUser();
        $activechatlist = searchSmsByinput($oUser->mobile, $searchvalue);

        if ($isLoggedInTeam) {
            $hasweb_access = getMemberchatpermission($isLoggedInTeam);
            if ($hasweb_access > 0 && $hasweb_access->sms_chat == 1) {
                if ($hasweb_access->bb_number != "") {
                    $oUserNumber = numberForamt($hasweb_access->bb_number);
                } else {
                    $oUserNumber = numberForamt(getClientTwilioAccount($oUser->id));
                }
            } else {
                $oUserNumber = numberForamt(getClientTwilioAccount($oUser->id));
            }
        } else {
            $oUserNumber = numberForamt(getClientTwilioAccount($oUser->id));
        }


       

        foreach ($activechatlist as $key => $value) {
            $showRed = 0;
            $phoneNumber = "";
            if ($value->to != '' && $value->from != '') {
                     $value->to = numberForamt($value->to);
                     $value->from =  numberForamt($value->from);
                if (trim($value->to) == trim($oUserNumber)) {
                    $usersdata = getUserbyPhone($value->from);
                    $phoneNumber = $value->from;
                    $usersdata = $usersdata[0];
                    if ($value->read_status == 0) {
                        $showRed = 1;
                    }
                }
                if ($value->from == $oUserNumber) {
                    $usersdata = getUserbyPhone($value->to);
                    $phoneNumber = $value->to;
                    $usersdata = $usersdata[0];
                }

                $userDataDetail = getUserDetail($usersdata->user_id);
                if(!empty($userDataDetail->avatar))
                {
                    $avatar = $userDataDetail->avatar;
                }
                else
                {
                   $avatar=""; 
                }

                //$favUser = $this->smsChat->getSMSFavouriteUser($loginUserData->id, $usersdata->id);
                   $favUser='';
                if (strpos($value->msg, '/Media/') !== false) {
                    $userMessage = "File Attachment";
                } else {
                    $userMessage = setStringLimit($value->msg, 50);
                }
                ?>
                <div id="active_chat_box" class="activityShow <?php echo $count; ?> media chatbox_new bkg_white <?php
                if ($count == 1) {
                    echo 'mb10';
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
                    <a href="javascript:void(0);" class="media-link bbot <?php
                    if ($count != 1) {
                        echo 'bbot';
                    }
                    ?> getChatDetails <?php echo $count == 0 ? 'activechat' : ''; ?>" subscriberId="<?php echo $usersdata->id; ?>" rewId="<?php echo $value->from; ?>" phone_no="<?php echo $usersdata->phone; ?>">

                        <div class="media-left">
                            <?php if ($usersdata->id == '') { ?>
                                <img src="/assets/images/default_avt.jpeg" class="img-circle" alt="" width="28" height="28">
                                <?php
                            } else {

                                if ($usersdata->firstname == 'NA') {
                                    $usersdata->firstname = "";
                                }
                                if ($usersdata->lastname == 'NA') {
                                    $usersdata->lastname = "";
                                }
                                ?>
                                <?php echo showUserAvtar($avatar, $usersdata->firstname, $usersdata->lastname, 28, 28, 12); ?>
                            <?php } ?>
                            <span class="favouriteSMSUser" subscriberId="<?php echo $usersdata->id; ?>"><i class="fa star_icon <?php echo $favUser > 0 ? 'fa-star yellow' : 'fa-star-o'; ?>"></i></span>
                        </div>

                        <div class="media-body"> 
                            <span class="fsize12 txt_dark"><?php echo mobileNoFormat($phoneNumber); ?></span> 
                            <span class="slider-phone contacts txt_dark" style="margin:0px;color: #6a7995!important; font-weight:bold; font-size:12px!important"><?php echo $userMessage; ?></span> 
                            <span class="slider-phone contacts text-size-small txt_blue" style="margin:0px ; display:none"><?php echo $usersdata->phone; ?></span>

                        </div>
                        <div class="media-right" style="width: 100px"><span class="date_time txt_grey fsize11"><time class="autoTimeUpdate autoTime_<?php echo $phoneNumber; ?>"  datetime="<?php echo usaDate($value->created); ?>" title="<?php echo usaDate($value->created); ?>"><?php //echo chatTimeAgo($chatMessageRes->created);     ?></time></span>&nbsp
                            <?php if ($showRed) { ?>
                                <i id="gr_<?php echo $value->token; ?>" class="fa fa-circle txt_red fsize9"></i>
                            <?php } ?>

                        </div>

                    </a> 
                </div>
                <?php
                $count++;
            }
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
    * This function is used to add the sms notes 
    * @return type
    */

    public function addSmsNotes()
    {

        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $SmsChatObj = new SmsChatModel();
       
        $notes = Input::post("notes");
        $subId = Input::post("NotesTo");
       
        $source = 'sms';
        $type = "";
       

        $aData = array(
            'user_id' => $userID,
            'subscriber_id' => $subId,
            'notes' => $notes,
            'source'=>$source,
            'created' => date("Y-m-d H:i:s")
        );
        $SmsChatObj->addSmsNotes($aData);
       

    }

}
