<?php
$totalEmailSent = $totalSmsSent = 0;
if (!empty($oTotalReferralSent)) {

foreach ($oTotalReferralSent as $sentCount) {

	if ($sentCount->campaign_type == 'email') {
		$totalEmailSent = ($sentCount->totalCount) ? $sentCount->totalCount : 0;
	}

	if ($sentCount->campaign_type == 'sms') {
		$totalSmsSent = ($sentCount->totalCount) ? $sentCount->totalCount : 0;
	}
}
}
$totalDelivered = $totalOpened = $totalProcessed = $totalClicked = 0;
if (!empty($oTotalReferralTwillio)) {
foreach ($oTotalReferralTwillio as $twilliRec) {
	if ($twilliRec->event_name == 'delivered') {
		$totalDelivered = $twilliRec->totalCount;
	} else if ($twilliRec->event_name == 'open') {
		$totalOpened = $twilliRec->totalCount;
	} else if ($twilliRec->event_name == 'processed') {
		$totalProcessed = $twilliRec->totalCount;
	} else if ($twilliRec->event_name == 'clicked') {
		$totalClicked = $twilliRec->totalCount;
	}
}
}
?>
	<style>
	.fsize28{font-size:22px!important;}
	</style>
	  <div class="content_area">
    <div class="row">
      <div class="col-md-12">
        <div class="white_box profile_sec mb20">
         <div class="backbtn">
			  	<a href="#"><img src="<?php echo base_url(); ?>assets/profile_images/back_40.png"></a>
			  </div>
         
          <div class="p25 bbot text-center">
            <h3>Referral Reports</h3>
            <p>Basic information that you use in BrandBoost services.</p>
          </div>
          
          <div class="p20">
          <div class="row">
          	<div class="col-xs-6">
          		<div class="tdropdown ml0"> <a style="margin:0!important;" class="dropdown-toggle fsize12 txt_grey" data-toggle="dropdown" aria-expanded="false"> Sort by date <i class="icon-arrow-down22"></i></a>
					<ul style="left: 0px!important; margin-top: 15px; left: auto;" class="dropdown-menu dropdown-menu-left chat_dropdown">
					  <li><strong><a class="active" href="#"><img class="small" src="<?php echo base_url(); ?>assets/images/cd_icon1.png"> All (1) </a></strong></li>
					  <li><strong><a href="#"><img class="small" src="<?php echo base_url(); ?>assets/images/cd_icon3.png">Active (1) </a></strong></li>
					  <li><strong><a href="#"><img class="small" src="<?php echo base_url(); ?>assets/images/cd_icon2.png">Inactive (0) </a></strong></li>
					</ul>
				  </div>
          	</div>
          </div>
          </div>
        </div>
      </div>
    </div>
	  
		  	<!--====Top Section Graph====-->
			<div class="row">
				<div class="col-md-6">
				<div class="panel panel-flat">
				  <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
				  <div class="p20">
				  	<img width="44" class="br100 mb10" src="<?php echo base_url(); ?>assets/images/ro_icon1.png"/>
				  	<h1 class="txt_dark fsize28 fw700"><?php echo $totalEmailSent; ?></h1>
				  	<p class="fsize14 txt_dgrey mb0">Referral email sent</p>
				  </div>
				  <div class="btop p20">
				  	<p class="fsize12 m0"><span class="txt_green"><i class="fa fa-arrow-up"></i> 0.00%</span></p>
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
				  	<p class="fsize14 txt_dgrey mb0">Referral sms sent</p>
				  </div>
				  <div class="btop p20">
				  	<p class="fsize12 m0"><span class="txt_green"><i class="fa fa-arrow-up"></i> 0.00%</span></p>
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
				  	<p class="fsize14 txt_dgrey mb0">Opens</p>
				  </div>
				  <div class="btop p20">
				  	<p class="fsize12 m0"><span class="txt_green"><i class="fa fa-arrow-up"></i> 0.00%</span></p>
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
				  	<p class="fsize14 txt_dgrey mb0">Clicks</p>
				  </div>
				  <div class="btop p20">
				  	<p class="fsize12 m0"><span class="txt_green"><i class="fa fa-arrow-up"></i> 0.00%</span></p>
				  </div>
				  </div>
				</div>
			  </div>
			</div>
			<!--====Stats====-->
			
			
			<div class="row">
				<div class="col-md-6">
				<div class="panel panel-flat">
				  <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
				  <div class="p20">
				  	<img width="44" class="br100 mb10" src="<?php echo base_url(); ?>assets/images/ro_icon3.png"/>
				  	<h1 class="txt_dark fsize28 fw700"><?php echo (count($oRefVisits)) ? count($oRefVisits) : 0; ?></h1>
				  	<p class="fsize14 txt_dgrey mb0">Referral Link(Landing Page) Visits</p>
				  </div>
				  <div class="btop p20">
				  	<p class="fsize12 m0"><span class="txt_green"><i class="fa fa-arrow-up"></i> 0.00%</span></p>
				  </div>
				  </div>
				</div>
			  </div>
			  <div class="col-md-6">
				<div class="panel panel-flat">
				  <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
				  <div class="p20">
				  	<img width="44" class="br100 mb10" src="<?php echo base_url(); ?>assets/images/ro_icon4.png"/>
				  	<h1 class="txt_dark fsize28 fw700">$<?php echo ($referredAmount) ? $referredAmount : 0; ?></h1>
				  	<p class="fsize14 txt_dgrey mb0">Purchases by referred customer</p>
				  </div>
				  <div class="btop p20">
				  	<p class="fsize12 m0"><span class="txt_green"><i class="fa fa-arrow-up"></i> 0.00%</span></p>
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
				  	<h1 class="txt_dark fsize28 fw700"><?php echo (count($oUntrackedPurchased)) ? count($oUntrackedPurchased) : 0; ?></h1>
				  	<p class="fsize14 txt_dgrey mb0">Total Untracked Sales</p>
				  </div>
				  <div class="btop p20">
				  	<p class="fsize12 m0"><span class="txt_green"><i class="fa fa-arrow-up"></i> 0.00%</span></p>
				  </div>
				  </div>
				</div>
			  </div>
			  <div class="col-md-6">
				<div class="panel panel-flat">
				  <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
				  <div class="p20">
				  	<img width="44" class="br100 mb10" src="<?php echo base_url(); ?>assets/images/ro_icon4.png"/>
				  	<h1 class="txt_dark fsize28 fw700">$<?php echo ($untrackedAmount) ? $untrackedAmount : 0; ?></h1>
				  	<p class="fsize14 txt_dgrey mb0">Total Untracked Sales Amount</p>
				  </div>
				  <div class="btop p20">
				  	<p class="fsize12 m0"><span class="txt_green"><i class="fa fa-arrow-up"></i> 0.00%</span></p>
				  </div>
				  </div>
				</div>
			  </div>
			</div>
			<!--====Table====-->
			
			<div class="row">
			  <div class="col-md-12">
				<div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Referral Report</h6>
                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" tableId="allContact" placeholder="Search by name" type="text">
                                        <div class="form-control-feedback">
                                            <i class="icon-search4"></i>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="panel-body p0">
                               <table class="table" id="allContact">
                        <thead>
                            <tr>
                                <th class="col-md-3">Referred Friend</th>
                                <th class="col-md-3">Referrer</th>
                                <th class="col-md-1">Amount</th>
                                <th class="col-md-2">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $inc = 1;
                            foreach ($oRefPurchased as $data) {
                                $oTags = $this->mReferral->getTagsBySaleID($data->id);
                                //pre($data);
                                //$profileImg = $data->avatar == '' ? base_url('/profile_images/avatar_image.png') : base_url('profile_images/' . $data->avatar);
                                ?>
                                <tr>
                                    <td>            
                                        <div style="vertical-align: top!important;" class="media-left media-middle">
                                            <a href="#">
                                                <img src="http://brandboost.io/admin_new/images/userp.png" class="img-circle img-xs" alt="">
                                            </a>
                                        </div>
                                        <div class="media-left">
                                            <a href="javascript:void()" class="text-default text-semibold"><?php echo $data->firstname; ?> <?php echo $data->lastname; ?></a>
                                            <div class="text-muted text-size-small"><?php echo $data->email; ?></div>
                                            <div class="text-muted text-size-small"><?php echo $data->phone == '' ? '<span style="color:#999999">Phone Unavailable</span>' : $data->phone; ?></div>
                                        </div>
                                    </td>

                                    <td>
                                        <div style="vertical-align: top!important;" class="media-left media-middle">
                                            <a href="#">
                                                <img src="http://brandboost.io/admin_new/images/userp.png" class="img-circle img-xs" alt="">
                                            </a>
                                        </div>
                                        <div class="media-left">
                                            <a href="javascript:void()" class="text-default text-semibold"><?php echo $data->aff_firstname; ?> <?php echo $data->aff_lastname; ?></a>
                                            <div class="text-muted text-size-small"><?php echo $data->aff_email; ?></div>
                                            <div class="text-muted text-size-small"><?php echo $data->aff_mobile == '' ? '<span style="color:#999999">Phone Unavailable</span>' : $data->aff_mobile; ?></div>
                                        </div>
                                    </td>

                                    <td><?php echo $data->currency; ?><?php echo $data->amount; ?></td>
                                    <td><h6 class="text-semibold"><?php echo date('M d, Y', strtotime($data->created)); ?><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($data->created)) . ' (' . timeAgo($data->created) . ')'; ?></div></h6></td>
                                    
                                </tr>
                                <?php
                                $inc++;
                            }
                            ?>
                        </tbody>
                    </table>
                            </div>
                        </div>
			  </div>
			</div>
		
		 <!--&&&&&&&&&&&& TABBED CONTENT  END &&&&&&&&&&-->

	  </div>

<script type="text/javascript">
$(document).ready(function () {
	var tableId = 'allContact';
	var tableBase = custom_data_table(tableId); 
});
</script>
