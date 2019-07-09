<style>
    .enlarge {
        cursor: pointer;
    }
    .media-expand{
        display:block;
        margin-bottom: 15px;
        width:100%;
        padding-right:0px;

    }

    .media-expand img{
        width:100% !important;
        height: auto !important;

    }

    .smartStickyFooter{
        position: absolute;
        bottom: 72px;
        width: 100%;
        background: #fff;
        border-top: 1px solid #eee;
        padding: 0px;
    } 
    .smartStickyFooter textarea {
        height: 50px!important;
    }

    .thumbnail .thumb img {border-radius: 5px 5px 0 0; height: 220px;}
    .caption-overflow.smallovfl {
        color: #333;
        width: 135px;
        line-height: 95px;
        margin-left: 10px;
    }
    .caption-overflow.smallovfl a {    display: block;    height: 44px;    text-align: center; color: #fff; }
    .caption-overflow.smallovfl a i{font-size: 18px;}
    .small_media_icon:hover .caption-overflow.smallovfl{ visibility: visible!important; opacity: 1!important; background: rgba(0,0,0,0.4); border-radius: 5px;}
    .smart_img_gallery .image_pagination li a video {
        width: 33.6px!important;
        height: 27.8px!important;
        border-radius: 4px;
        opacity: 0.7;
    }


</style>
<?php
if (!empty($getMyLists)) {
    foreach ($getMyLists as $key => $value) {
        $aSelectedLists[] = $value->id;
    }
}
$aUInfo = $userData;
//pre($aUInfo);
$cb_contact_id = $aUInfo->cb_contact_id;
$userId = $aUInfo->id;

$avatar = $aUInfo->avatar;
$firstname = $aUInfo->firstname;
$lastname = $aUInfo->lastname;
$userRole = $aUInfo->user_role;

if ($userRole == '1') {

    $roleName = 'Administrator';
} else if ($userRole == '2') {

    $roleName = 'User';
} else if ($userRole == '3') {

    $roleName = 'Customer';
} else {

    $roleName = '';
}
$username = $firstname . ' ' . $lastname;
if (!empty($avatar) && $avatar != 'avatar_image.png') {
    $srcUserImg = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $avatar;
} else {
    $srcUserImg = '/profile_images/avatar_image.png';
}

$address = $aUInfo->address;
$city = $aUInfo->cityName;
$state = $aUInfo->stateName;
$country = $aUInfo->country_code;
if (empty($country)) {
    $country = 'us';
}
$email = $aUInfo->email;
$mobile = $aUInfo->phone;
$gender = $aUInfo->gender;

if (!empty($aUInfo->user_id)) {
    $getNotification = $this->mSetting->getNotificationSettings($aUInfo->user_id);
    $getUser = $this->mUser->getAllUsers($aUInfo->user_id);
    $getUser = $getUser[0];
} else {
    $getNotification = '';
    $getUser = '';
}
$oTags = $this->mTags->getSubscriberTags($aUInfo->id);
?>

<div class="smartpopup-container">
    <div class="col-md-5 pr0 brig" style="height: 100%;">
        <div class="p0" style="min-height: 500px;">
            <div class="profile_sec">
                <div class="p0 pt20 pb20 text-center">
                    <div class="profile_pic">
                        <?php echo showUserAvtar($avatar, $firstname, $lastname, 84, 84, 24); ?>
                        <div class="profile_flags"><img src="<?php echo base_url(); ?>assets/images/flags/<?php echo strtolower($country); ?>.png" onerror="this.src='<?php echo base_url('assets/images/flags/us.png'); ?>'"></div>
                    </div>
                    <h3><?php echo $username; ?></h3>
                    <p class="text-size-small text-muted mb0"><?php echo $state != '' ? ucfirst($state) . ' ,' : displayNoData() . ' ,'; ?> <?php echo strtoupper($country); ?></p>
                </div>



                <div class="profile_headings">Info <a href="javascript:void(0);" class="pull-right"><i class="fa fsize15 txt_grey fa-angle-down"></i></a></div>


                <div class="interactions p20">
                    <ul>
                        <li><i class="fa fa-envelope"></i><strong><?php echo $email != '' ? $email : displayNoData(); ?></strong></li>
                        <li><i class="fa fa-phone"></i><strong><?php echo $mobile != '' ? mobileNoFormat($mobile) : displayNoData(); ?></strong></li>
                        <li><i class="fa fa-user"></i><strong><?php
                                if ($gender == 'male') {
                                    echo 'Male';
                                } else if ($gender == 'female') {
                                    echo 'Female';
                                } else {
                                    echo displayNoData();
                                }
                                ?></strong></li>
                        <li><i class="fa fa-clock-o"></i><strong><?php echo date("hA"); ?>, <?php echo date_default_timezone_get(); ?></strong></li>
                        <li><i class="fa fa-align-left"></i><strong>Opt-Out of All</strong></li>

                    </ul>
                </div>


                <div class="profile_headings">Lists <a href="javascript:void(0);" class="pull-right"><i class="fa fsize15 txt_grey fa-angle-down"></i></a></div>

                <div class="p20">
                    <?php
                    if (!empty($getMyLists)) {
                        foreach ($getMyLists as $key => $value) {
                            ?><button class="btn btn-xs btn_white_table"><?php echo $value->list_name; ?></button><?php
                        }
                        ?>
                        <button style="margin: 0 10px 15px 0!important;" class="btn btn-xs plus_icon mt0" data-toggle="modal" data-target="#chooselistModal"><i class="icon-plus3"></i></button>
                        <?php
                    } else {
                        echo displayNoData();
                    }
                    ?>
                </div>

                <div class="profile_headings">Tags <a href="javascript:void(0);" class="pull-right"><i class="fa fsize15 txt_grey fa-angle-down"></i></a></div>

                <div class="p20">
                    <?php
//pre($oTags);
                    if (!empty($oTags)) {
                        foreach ($oTags as $value) {

                            if (!empty($value->tag_name)) {
                                ?><button class="btn btn-xs btn_white_table"><?php echo $value->tag_name; ?></button><?php
                            }
                        }
                        ?>
                        <button style="margin: 0 10px 15px 0!important;" class="btn btn-xs plus_icon mt0 applyInsightTags" data-subscriber-id="<?php echo $contactId; ?>"><i class="icon-plus3"></i></button>
                        <?php
                    } else {
                        echo displayNoData();
                    }
                    ?>
                </div>

                <div class="profile_headings">Involved Campaigns <a class="pull-right plus_icon" href="javascript:void(0);"><i class="icon-plus3"></i></a></div>

                <div class="brig">
                    <?php
//pre($oTags);
                    if (!empty($oInvolvedBrandboost)) {
                        foreach ($oInvolvedBrandboost as $oBoost) {
                            if ($oBoost->review_type == 'onsite') {
                                $oOnsite[] = $oBoost;
                            }

                            if ($oBoost->review_type == 'offsite') {
                                $oOffsite[] = $oBoost;
                            }
                        }

                        if (!empty($oOnsite)) {
                            ?>
                            <div class="profile_headings">On Site Review Campaigns <a href="javascript:void(0);" class="pull-right"><i class="fa fsize15 txt_grey fa-angle-down"></i></a></div>

                            <div class="p20">
                                <?php
                                foreach ($oOnsite as $oRec) {

                                    if (!empty($oRec->brand_title)) {
                                        ?><button class="btn btn-xs btn_white_table"><?php echo $oRec->brand_title; ?></button><?php
                                    }
                                }
                                ?>
                            </div>
                            <?php
                        }

                        if (!empty($oOffsite)) {
                            ?>
                            <div class="profile_headings">Off Site Review Campaigns <a href="javascript:void(0);" class="pull-right"><i class="fa fsize15 txt_grey fa-angle-down"></i></a></div>

                            <div class="p20">
                                <?php
                                foreach ($oOffsite as $oRec) {

                                    if (!empty($oRec->brand_title)) {
                                        ?><button class="btn btn-xs btn_white_table"><?php echo $oRec->brand_title; ?></button><?php
                                    }
                                }
                                ?>
                            </div>
                            <?php
                        }

                        if (!empty($oInvolvedNPS)) {
                            ?>
                            <div class="profile_headings">NPS Campaigns <a href="javascript:void(0);" class="pull-right"><i class="fa fsize15 txt_grey fa-angle-down"></i></a></div>

                            <div class="p20">
                                <?php
                                foreach ($oInvolvedNPS as $oRec) {

                                    if (!empty($oRec->title)) {
                                        ?><button class="btn btn-xs btn_white_table"><?php echo $oRec->title; ?></button><?php
                                    }
                                }
                                ?>
                            </div>
                            <?php
                        }

                        if (!empty($oInvolvedReferral)) {
                            ?>
                            <div class="profile_headings">Referral Campaigns <a href="javascript:void(0);" class="pull-right"><i class="fa fsize15 txt_grey fa-angle-down"></i></a></div>

                            <div class="p20">
                                <?php
                                foreach ($oInvolvedReferral as $oRec) {

                                    if (!empty($oRec->title)) {
                                        ?><button class="btn btn-xs btn_white_table"><?php echo $oRec->title; ?></button><?php
                                    }
                                }
                                ?>
                            </div>
                            <?php
                        }
                    } else { ?>
                        <div class="text-center mt20"><?php echo displayNoData(); ?></div> 
                    <?php }
                    ?>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-7 pl0" style="height: 100%;">
        <div class="bbot">
            <input type="hidden" name="subscriberid" id="subscriberid" value="<?php echo $contactId; ?>">
            <textarea style="height: 100px;" class="form-control addnote p20" id="notes2" placeholder="Start typing to leave a note..."></textarea>
            <div class="p20 btop pl30">
                <button class="btn dark_btn bkg_blue mr20 addNoteButton2" style="color:#5d7df3!important;">Add Note</button>
                <a href="javascript:void(0);"><i class=""><img width="10" src="<?php echo base_url(); ?>assets/images/icon_hash.png"/></i></a> &nbsp; &nbsp; <a href="javascript:void(0);"><i class=""><img width="10" src="<?php echo base_url(); ?>assets/images/icon_atrate.png"/></i></a>
            </div>
        </div>

        <ul class="nav nav-tabs nav-tabs-bottom smarttablist">
            <li class="active"><a href="#ActivityLog" data-toggle="tab">Activity Log</a></li>
            <li><a href="#NewNote" class="contactNewNote" data-toggle="tab">Notes</a></li>
            <li><a href="#Email" data-toggle="tab">Email</a></li>
            <li><a href="#SMS" data-toggle="tab">SMS</a></li>
            <li><a href="#ChatPanel" data-toggle="tab">Chat</a></li>

        </ul>

        <div class="tab-content bbot">
            <div class="tab-pane active" id="ActivityLog">
                <div class="pt0 p10"  style="min-height:500px;">
                    <?php if (!empty($userActivities)) { ?>
                        <table class="table new activity">
                            <tbody>
                                <?php
                                $activityInc = 1;
                                foreach ($userActivities as $key => $value) {
                                    //pre($value->event_type);

                                    if ($activityInc > 10) {
                                        $display = 'display:none;';
                                    } else {
                                        $display = '';
                                    }

                                    if ($value->event_type == 'add_subscriber') {
                                        $icon = '<img src="' . base_url("assets/css/menu_icons/People_Color.svg") . '" class="img-circle img-xs" />';
                                    } else if ($value->event_type == 'module_email' || $value->event_type == 'manage_email_automation') {
                                        $icon = '<img src="' . base_url("assets/images/icon_round_email.png") . '" class="img-circle img-xs" />';
                                    } else if ($value->event_type == 'brandboost_onsite_offsite' || $value->event_type == 'manual_review_request') {
                                        $icon = '<img src="' . base_url("assets/css/menu_icons/OffSiteBoost_Color.svg") . '" class="img-circle img-xs" />';
                                    } else if ($value->event_type == 'brandboost_offsite') {
                                        $icon = '<img src="' . base_url("assets/css/menu_icons/OnSiteBoost_Color.svg") . '" class="img-circle img-xs" />';
                                    } else if ($value->event_type == 'brandboost_onsite') {
                                        $icon = '<img src="' . base_url("assets/css/menu_icons/OffSiteBoost_Color.svg") . '" class="img-circle img-xs" />';
                                    } else if ($value->event_type == 'import_subscribers') {
                                        $icon = '<i class="icon-arrow-up16"></i>';
                                    } else if ($value->event_type == 'export_subscribers') {
                                        $icon = '<i class="icon-arrow-down16"></i>';
                                    } else if ($value->event_type == 'manage_automation_lists' || $value->event_type == 'manage_lists') {
                                        $icon = '<i class="icon-indent-increase2"></i>';
                                    } else if ($value->event_type == 'upgraded_membership' || $value->event_type == 'upgraded_topup_membership' || $value->event_type == 'buy-addons-credit-pack' || $value->event_type == 'profile_update') {
                                        $icon = '<img src="' . base_url("assets/images/icon_round_forward.png") . '" class="img-circle img-xs" />';
                                    } else if ($value->event_type == 'brandboost_onsite_widget') {
                                        $icon = '<img src="' . base_url("assets/css/menu_icons/Website_Color.svg") . '" class="img-circle img-xs" />';
                                    } else {
                                        $icon = '<i class="icon-star-full2 txt_purple"></i>';
                                    }
                                    ?>
                                    <tr class="activityShow" style="<?php echo $display; ?>">
                                        <td>
                                            <div class="media-left media-middle"> <a class="icons s28" style="cursor: pointer;"><?php echo $icon; ?></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><!-- Email <span class="text-muted">sent in </span> New Product Campaign --><?php echo $value->activity_message; ?></a></div>
                                                <span class="text-muted text-size-small"><?php echo date('d M Y ', strtotime($value->activity_created)); ?> &nbsp; <?php echo date('h:i A ', strtotime($value->activity_created)); ?></span>

                                            </div>
                                        </td>
        
                                    </tr>
                                    <?php
                                    $activityInc++;
                                }
                                ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <div class="text-center mt20"><?php echo displayNoData(); ?></div>
                    <?php } ?>

                    <?php if (count($userActivities) > 10) { ?>
                        <div class="loadMoreRecord loadMoreRecordActivity text-center"><a style="cursor: pointer;" class="loadMoreActivity" >Load more</a><img class="loaderImage hidden" src="<?php echo base_url(); ?>assets/images/widget_load.gif" width="20px" height="20px"></div>
                    <?php } ?>
                </div>					
            </div>

            <div class="tab-pane" id="NewNote">
                <div class="pt10 p10" id="contact-notes-container" style="min-height:500px;">
                    <?php $this->load->view("admin/contacts/partial/smart-notes-block"); ?>
                </div>
            </div>
            <div class="tab-pane" id="Email">
                <div class="pt0 p10" style="min-height:500px;">
                    <?php
//pre($result);
                    $emailCount = 0;
                    if (!empty($result)) {
                        ?>    
                        <table class="table new">
                            <tbody>
                                <?php
//pre($result);
                                $emailCount = 0;
                                if (!empty($result)) {
                                    $emailInc = 1;
                                    foreach ($result as $key => $value) {
                                        //pre($value);
                                        if ($value['type'] == 'Email') {
                                            $icon = '<img src="' . base_url("assets/images/icon_round_email.png") . '" class="img-circle img-xs" />';

                                            if ($emailInc > 10) {
                                                $display = 'display:none;';
                                            } else {
                                                $display = '';
                                            }
                                            ?>
                                            <tr class="emailsShow" style="<?php echo $display; ?>">
                                                <td>
                                                    <div class="media-left media-middle"> <span class="icons"><?php echo $icon; ?></span> </div>
                                                    <div class="media-left">
                                                        <div class="pt-5"><span class="text-default text-semibold"><?php echo $value['title'] . ' - ' . $value['name'] . ''; ?></span></div>
                                                        <span class="text-muted text-size-small"><?php echo date('d M Y ', strtotime($value['created'])); ?> &nbsp; <?php echo date('h:i A ', strtotime($value['created'])); ?></span>

                                                    </div>
                                                </td>
                                                    
                                            </tr>
                                            <?php
                                            $emailInc++;
                                            $emailCount++;
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>

                        <?php if ($emailInc > 10) { ?>
                            <div class="loadMoreRecord loadMoreRecordEmail"><a style="cursor: pointer;" class="loadMoreEmail" >Load more</a><img class="loaderImage hidden" src="<?php echo base_url(); ?>assets/images/widget_load.gif" width="20px" height="20px"></div>
                        <?php } ?>
                        <?php
                        if (empty($emailCount)) {
                            ?>
                            <div class="text-center mt20"><?php echo displayNoData(); ?></div>
                        <?php }
                        ?>
                    <?php } else { ?>
                        <div class="text-center mt20"><?php echo displayNoData(); ?></div>
                    <?php } ?>    
                </div>
            </div>
            <div class="tab-pane" id="SMS">
                <div class="pt0 p10"  style="min-height:500px;">
                    <?php
                    $smsCount = 0;
                    if (!empty($result)) {
                        ?>
                        <table class="table new">
                            <tbody>
                                <?php
                                $smsCount = 0;
                                if (!empty($result)) {
                                    $smsInc = 1;
                                    foreach ($result as $key => $value) {

                                        if ($value['type'] == 'SMS') {

                                            if ($smsInc > 10) {
                                                $display = 'display:none;';
                                            } else {
                                                $display = '';
                                            }

                                            $icon = '<img src="' . base_url("assets/css/menu_icons/Sms_Color.svg") . '" class="img-circle img-xs" />';
                                            ?>
                                            <tr class="smsShow" style="<?php echo $display; ?>">
                                                <td>
                                                    <div class="media-left media-middle"> <span class="icons"><?php echo $icon; ?></span> </div>
                                                    <div class="media-left">
                                                        <div class="pt-5"><span class="text-default text-semibold"><?php echo $value['title'] . ' - ' . $value['name'] . ''; ?></span></div>

                                                    </div>
                                                </td>
                                                <td class="text-right"><span class="text-muted text-size-small"><?php echo date('d M Y ', strtotime($value['created'])); ?> &nbsp; <?php echo date('h:i A ', strtotime($value['created'])); ?></span></td>
                                            </tr>
                                            <?php
                                            $smsInc++;
                                            $smsCount++;
                                        }
                                    }
                                } else {
                                    
                                }
                                ?>
                            </tbody>
                        </table>

                        <?php if ($smsInc > 10) { ?>
                            <div class="loadMoreRecord loadMoreRecordSms"><a style="cursor: pointer;" class="loadMoreSms" >Load more</a><img class="loaderImage hidden" src="<?php echo base_url(); ?>assets/images/widget_load.gif" width="20px" height="20px"></div>
                        <?php } ?>
                        <?php
                        if (empty($smsCount)) {
                            ?>
                            <div class="text-center mt20"><?php echo displayNoData(); ?></div>
                        <?php }
                        ?>
                    <?php } else { ?>
                        <div class="text-center mt20"><?php echo displayNoData(); ?></div>
                    <?php } ?>
                </div>
            </div>
            <div class="tab-pane" id="ChatPanel">
                <div class="pt0 p10"  style="min-height:500px;">
                    <div class="text-center mt20"><?php echo displayNoData(); ?></div>

                </div>
            </div>

        </div>

    </div>
</div>    
<div id="chooselistModal" class="modal fade">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Choose Lists</h5>
            </div>
            <form method="post" name="frmAddCotactToLists" id="frmAddCotactToLists" action="javascript:void();">
                <div class="modal-body p0" style="height:500px;overflow:auto;padding-bottom:17px !important; ">
                    <ul class="contactaddlist contact">
                        <?php
                        if (!empty($oLists)):
                            $newolists = array();

                            foreach ($oLists as $key => $value) {
                                $newolists[$value->id][] = $value;
                            }

                            foreach ($newolists as $oList):
                                $totalElement = count($oList);
                                $oList = $oList[0];
                                if (!empty($oList->l_list_id)) {
                                    $totAll = $totalElement;
                                } else {
                                    $totAll = 0;
                                }
                                ?>
                                <li>
                                    <label>
                                        <div class="media-left">
                                            <div class="checkbox">
                                                <label class="custmo_checkbox pull-left mt-5 ">
                                                    <input type="hidden" name="allList[]" value="<?php echo $oList->id; ?>" />
                                                    <input type="checkbox" name="listid[]" <?php if (in_array($oList->id, $aSelectedLists)): ?> checked="checked"<?php endif; ?> value="<?php echo $oList->id; ?>">
                                                    <span class="custmo_checkmark"></span>

                                                </label>
                                            </div>
                                        </div>
                                        <div class="media-left media-middle"> <a class="icons" href="#"><img src="<?php echo base_url("assets/css/menu_icons/OffSiteBoost_Color.svg"); ?>" class="img-circle img-xs" alt=""></a> </div>
                                        <div class="media-left"> <a href="#" class="text-default"><span><?php echo $oList->list_name; ?></span> </a> </div>
                                    </label>
                                </li>    

                            <?php endforeach; ?>
                        <?php endif; ?>


                    </ul>
                </div>
                <div class="modal-footer botfooter">
                    <input type="hidden" name="subscriber_id" value="<?php echo $contactId; ?>" />
                    <button class="btn btn-link text-muted" data-dismiss="modal">Skip </button>
                    <button type="submit" class="btn dark_btn bkg_blue">Send</button>
                </div>
            </form>
        </div>



    </div>
</div>


