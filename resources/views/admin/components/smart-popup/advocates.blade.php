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


$totalDelivered = $totalOpened = $totalProcessed = $totalClicked = $totalSmsSent = 0;
if (!empty($oSendgridStats)) {
foreach ($oSendgridStats as $oSendgrid) {
	if ($oSendgrid->event_name == 'delivered') {
		$totalDelivered = $totalDelivered +  $oSendgrid->totalCount;
	} else if ($oSendgrid->event_name == 'open') {
		$totalOpened = $totalOpened +  $oSendgrid->totalCount;
	} else if ($oSendgrid->event_name == 'processed') {
		$totalProcessed = $totalProcessed + $oSendgrid->totalCount;
	} else if ($oSendgrid->event_name == 'click') {
		$totalClicked = $totalClicked + $oSendgrid->totalCount;
	}
}
}

$iTotalSaleAmount = 0;

if(!empty($oTrackSale)){
    foreach($oTrackSale as $oSale){
        $iTotalSaleAmount = $iTotalSaleAmount + $oSale->amount;
    }
}
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


                <div class="profile_headings">Referral Details <a href="javascript:void(0);" class="pull-right"><i class="fa fsize15 txt_grey fa-angle-down"></i></a></div>

                <div class="interactions p20">
                    <ul>
                        <li><b>Referral Link:</b></li>
                        <li>
                            <?php if (!empty($oRefLink->refkey)): ?>
                                <a href="<?php echo base_url(); ?>ref/t/<?php echo $oRefLink->refkey; ?>"><?php echo base_url(); ?>ref/t/<?php echo $oRefLink->refkey; ?></a>
                            <?php else: ?>
                                <?php echo displayNoData(); ?>
                            <?php endif; ?>    
                        </li>
                        <li><b>Campaign Name:</b></li>
                        <li>
                            <?php if (!empty($oReferral)): ?>
                                <a href="<?php echo base_url(); ?>admin/modules/referral/setup/"<?php echo $oReferral->id; ?>><?php echo $oReferral->title; ?></a>
                            <?php else: ?>
                                <?php echo displayNoData(); ?>
                            <?php endif; ?>    
                        </li>

                        <li><b>Advocate Reward:</b></li>
                        <li>
                            <?php if (!empty($oSettings)): ?>
                                <?php echo $oSettings->advocate_display_msg; ?>
                            <?php else: ?>
                                <?php echo displayNoData(); ?>
                            <?php endif; ?>    
                        </li>


                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-7 pl0" style="height: 100%;">
        <div class="bbot">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-flat">
                        <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
                            <div class="p20">
                                <img width="44" class="br100 mb10" src="<?php echo base_url(); ?>assets/images/ro_icon1.png"/>
                                <h1 class="txt_dark fsize28 fw700"><?php echo $totalProcessed; ?></h1>
                                <p class="fsize14 txt_dgrey mb0">Email Sent</p>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-flat">
                        <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
                            <div class="p20">
                                <img width="44" class="br100 mb10" src="<?php echo base_url(); ?>assets/images/ro_icon1.png"/>
                                <h1 class="txt_dark fsize28 fw700"><?php echo $totalSmsSent; ?></h1>
                                <p class="fsize14 txt_dgrey mb0">Sms Sent</p>
                            </div>
                            
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-6">
                    <div class="panel panel-flat">
                        <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
                            <div class="p20">
                                <img width="44" class="br100 mb10" src="<?php echo base_url(); ?>assets/images/ro_icon2.png"/>
                                <h1 class="txt_dark fsize28 fw700"><?php echo $totalOpened; ?></h1>
                                <p class="fsize14 txt_dgrey mb0">Email Opens</p>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-flat">
                        <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
                            <div class="p20">
                                <img width="44" class="br100 mb10" src="<?php echo base_url(); ?>assets/images/ro_icon2.png"/>
                                <h1 class="txt_dark fsize28 fw700"><?php echo $totalClicked; ?></h1>
                                <p class="fsize14 txt_dgrey mb0">Email Clicks</p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div> 

            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-flat">
                        <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
                            <div class="p20">
                                <img width="44" class="br100 mb10" src="<?php echo base_url(); ?>assets/images/ro_icon3.png"/>
                                <h1 class="txt_dark fsize28 fw700"><?php echo (count($oTrackVisit)) ? count($oTrackVisit) : 0; ?></h1>
                                <p class="fsize14 txt_dgrey mb0">Referral Link Visits</p>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-flat">
                        <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
                            <div class="p20">
                                <img width="44" class="br100 mb10" src="<?php echo base_url(); ?>assets/images/ro_icon4.png"/>
                                <h1 class="txt_dark fsize28 fw700"><?php echo ($oReferredFriends) ? count($oReferredFriends) : 0; ?></h1>
                                <p class="fsize14 txt_dgrey mb0">Referred Friends</p>
                            </div>
                            
                        </div>
                    </div>
                </div>

            </div> 

            <div class="row">

                <div class="col-md-6">
                    <div class="panel panel-flat">
                        <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
                            <div class="p20">
                                <img width="44" class="br100 mb10" src="<?php echo base_url(); ?>assets/images/ro_icon3.png"/>
                                <h1 class="txt_dark fsize28 fw700"><?php echo ($oTrackSale) ? count($oTrackSale) : 0; ?></h1>
                                <p class="fsize14 txt_dgrey mb0">Total Referred Sales</p>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-flat">
                        <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
                            <div class="p20">
                                <img width="44" class="br100 mb10" src="<?php echo base_url(); ?>assets/images/ro_icon4.png"/>
                                <h1 class="txt_dark fsize28 fw700">$<?php echo ($iTotalSaleAmount) ? number_format($iTotalSaleAmount, 2) : 0; ?></h1>
                                <p class="fsize14 txt_dgrey mb0">Total Referred Sales Amount</p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>





    </div>
</div>    



