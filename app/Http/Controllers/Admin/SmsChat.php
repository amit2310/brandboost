<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\SmsChatModel;
use App\Models\Admin\SubscriberModel;

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
        $post = $this->input->post();
        $userId = $post['userId'];
        $SubscriberPhone = trim($post['SubscriberPhone']);
        $usersdata = getUserbyPhone($SubscriberPhone);
        $usersdata = $usersdata[0];
        $userDataDetail = getUserDetail($usersdata->user_id);

        $offsetValue = $post['offsetValue'] > 0 ? 0 : $post['offsetValue'];
        $userDetail = getSubscribersInfo($userId);

        $isLoggedInTeam = Session::get("team_user_id");

        
        if($isLoggedInTeam)
        {
            $hasweb_access = getMemberchatpermission($isLoggedInTeam);
            if ($hasweb_access > 0 && $hasweb_access->sms_chat == 1) {
            if ($hasweb_access->bb_number != "") {
             $Twilionumber = $hasweb_access->bb_number;
            } else {
            $Twilionumber = getClientTwilioAccount($oUser->id);
            }
            } else {
            $Twilionumber = getClientTwilioAccount($oUser->id);
            }
       }
       else
       {
            $Twilionumber = getClientTwilioAccount($oUser->id);

       }



        $aTwilioAc->contact_no = $this->phone_display_custom($aTwilioAc->contact_no);


        $chatThreadsData = $this->smsChat->getSMSThreadsByPhoneNo($aTwilioAc->contact_no, $SubscriberPhone, $offsetValue);

        if (count($chatThreadsData) > 0) {
            foreach ($chatThreadsData as $chatData) {
               
               $teamMeberName="";
               if(!empty($chatData->team_id))
               { 
                  $teamMeberName =  smsteam_member_name($chatData->team_id);
               }
                if ($chatData->msg != '' && $chatData->module_name != 'nps') {
                    $fileView = '<div class="media-content">' . $chatData->msg . '</div>';

                    $fileext = end(explode('.', $chatData->msg));
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
                        <?php echo showUserAvtar($loginUserData->avatar, $loginUserData->firstname, $loginUserData->lastname, 28, 28, 11); ?></span>
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


}
