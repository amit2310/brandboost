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
	<script type="text/javascript" src="http://www.chartjs.org/dist/2.7.2/Chart.bundle.js"></script>
	
	<style>
	#canvas3{height: 230px !important;}
	</style>
	
	  <div class="content">
	  
	  <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
		<div class="page_header">
		  <div class="row">
		  <!--=============Headings & Tabs menu==============-->
			<div class="col-md-7">
			  <h3 class="mt20"><img style="width: 18px;" src="<?php echo base_url(); ?>assets/images/refferal_icon.png"> <?php echo $oSettings->title; ?> Report</h3>
			  
			</div>
		  </div>
		</div>
	  <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->
	  
	  
	    <!--&&&&&&&&&&&& TABBED CONTENT START &&&&&&&&&&-->
		 <div class="tab-content"> 
		  <!--===========TAB 1===========-->
		  <div class="tab-pane active" id="right-icon-tab0">
		  
		  	<!--====Top Section Graph====-->
			<div class="row">
				<div class="col-md-3">
				<div class="panel panel-flat">
				  <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
				  <div class="p20">
				  	<img width="44" class="br100 mb10" src="<?php echo base_url(); ?>assets/images/ro_icon1.png"/>
				  	<h1 class="txt_dark fsize28 fw700"><?php echo count($firstname); ?></h1>
				  	<p class="fsize14 txt_dgrey mb0">Visits</p>
				  </div>
				  <div class="btop p20">
				  	<p class="fsize12 m0"><span class="txt_green"><i class="fa fa-arrow-up"></i> 0.00%</span></p>
				  </div>
				  </div>
				</div>
			  </div>
			  <div class="col-md-3">
				<div class="panel panel-flat">
				  <div class="panel-body p20 pb0 br5 bkg_white text-center ref_stats_sec">
				  <div class="p20">
				  	<img width="44" class="br100 mb10" src="<?php echo base_url(); ?>assets/images/ro_icon1.png"/>
				  	<h1 class="txt_dark fsize28 fw700"><?php echo count($referralSaleTrackData); ?></h1>
				  	<p class="fsize14 txt_dgrey mb0">Sales</p>
				  </div>
				  <div class="btop p20">
				  	<p class="fsize12 m0"><span class="txt_green"><i class="fa fa-arrow-up"></i> 0.00%</span></p>
				  </div>
				  </div>
				</div>
			  </div>
			  <div class="col-md-3">
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
			  <div class="col-md-3">
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
                                    <div class="table_action_tool">
                                        <a href="#"><i class="icon-calendar52"></i></a>
                                        <!-- <a href="#"><i class="icon-arrow-down16"></i></a>
                                        <a href="#"><i class="icon-arrow-up16"></i></a>
                                        <a style="cursor: pointer;" class="editDataList"><i class="icon-pencil"></i></a> -->
                                        <a style="cursor: pointer; display: none;" id="deleteBulkReferral" class="custom_action_box"><i class="icon-trash position-left"></i></a>
                                        <a style="cursor: pointer; display: none;" id="archiveBulkReferral" class="custom_action_box"><i class="icon-gear position-left"></i> </a>
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
                                <th class="col-md-2 text-center">Applied Tags</th>
                                <th class="col-md-2 text-center">Action</th>
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
                                    <td class="media_review text-center">
                                        <span class="label bg-success viewtags">View Tags
                                            <?php if (count($oTags) > 0) { ?>
                                                <div class="tagspop">
                                                    <?php
                                                    foreach ($oTags as $tagsData) {
                                                        echo '<span class="label bg-success heading-text">' . $tagsData->tag_name . '</span>';
                                                    }
                                                    ?>
                                                </div>
                                            <?php } ?>
                                        </span>

                                        <a href="javascript:void(0);" class="applyInsightTags" action_name="referral-tag" saleid="<?php echo $data->id; ?>" ><span class="label bg-success addtag heading-text">+ Add Tag</span></a>


                                    </td>
                                    <td>
                                        <a href="<?php echo base_url("admin/modules/referral/saledetails/".$data->id);?>" target="_blank">Details</a>
                                    </td>


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
	
	<script>

		window.chartColors2 = {
	skyblue: 'rgb(35, 131, 152)'
};
		
		var config = {
			type: 'line',
			data: {
				labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31"],
				datasets: [{
					label: 'On Site Reviews Report',
					backgroundColor: window.chartColors2.skyblue,
					borderColor: window.chartColors2.skyblue,
					data: [0, 0, 0, 0, 0, 0, 0, 0],
					fill: false,
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					//stext: 'Chart.js Line Chart'
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: false,
							labelString: 'Month'
						}
					}],
					yAxes: [{
						display: false,
						scaleLabel: {
							display: false,
							labelString: 'Value'
						}
					}]
				}
			}
		};
		


		window.onload = function() {
			var ctx = document.getElementById('canvas3').getContext('2d');
			window.myLine = new Chart(ctx, config);
		};
		

	</script>
