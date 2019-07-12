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

        $data = array(
        	'title' => 'Chat System',
            'pagename' => $breadcrumb,
            'usersdata' => $oContacts,
            'favouriteUserData' => $favouriteUserData,
            'loginUserData' => $oUser,
            'totalSubscriber' => count($oContacts)
        );

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

        
        if($isLoggedInTeam)
        {
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
       }
       else
       {
            $Twilionumber = numberForamt(getClientTwilioAccount($oUser->id));

       }



        $chatThreadsData = SmsChatModel::getSMSThreadsByPhoneNo($Twilionumber, $SubscriberPhone, $offsetValue);

        if (count($chatThreadsData) > 0) {
            foreach ($chatThreadsData as $chatData) {
               
               $teamMeberName="";
               if(!empty($chatData->team_id))
               { 
                  $teamMeberName =  smsteam_member_name($chatData->team_id);
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
                        <?php if(!empty($teamMeberName)) {?>
                        <span style="padding: 0;display: block;font-size: 10px;" class="text-muted text-size-small">Sent by <?php echo $teamMeberName; ?></span>
                        <span style="padding: 0;display: block;font-size: 8px; margin-top: 1px;" class="txt_grey text-size-small">On <?php echo date("H:i:s",strtotime($chatData->created)); ?> - <?php echo date('F d Y', strtotime($chatData->created)); ?></span>

                               <?php }  ?>

                            </div>
                        </li>
                    <?php } else {
                        ?>
                        <li class="media" style="margin-top: 10px;">
                            <div class="media-body myclass"> <span class="media-annotation user_icon"><span class="circle_green_status status-mark"></span>
                        <?php echo showUserAvtar($userDataDetail->avatar, $usersdata->firstname, $usersdata->lastname, 28, 28, 11); ?></span>
                        <?php echo $fileView; ?>
                        <?php if(!empty($teamMeberName)) {?>
                        <span style="padding: 0;display: block;font-size: 10px;" class="text-muted text-size-small">Sent by <?php echo $teamMeberName; ?></span>
                        <span style="padding: 0;display: block;font-size: 8px; margin-top: 1px;" class="txt_grey text-size-small">On <?php echo date("H:i:s",strtotime($chatData->created)); ?> - <?php echo date('F d Y', strtotime($chatData->created)); ?></span>

                               <?php }  ?>
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
        if(!empty($userDataDetail->avatar))
        {
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


}
