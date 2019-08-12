@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')
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
		$totalDelivered = $totalDelivered +  $twilliRec->totalCount;
	} else if ($twilliRec->event_name == 'open') {
		$totalOpened = $totalOpened +  $twilliRec->totalCount;
	} else if ($twilliRec->event_name == 'processed') {
		$totalProcessed = $totalProcessed + $twilliRec->totalCount;
	} else if ($twilliRec->event_name == 'click') {
		$totalClicked = $totalClicked + $twilliRec->totalCount;
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
				  	<h1 class="txt_dark fsize28 fw700"><?php echo $totalEmailSent; ?></h1>
				  	<p class="fsize14 txt_dgrey mb0">Referral email sent</p>
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
				  	<h1 class="txt_dark fsize28 fw700"><?php echo $totalSmsSent; ?></h1>
				  	<p class="fsize14 txt_dgrey mb0">Referral sms sent</p>
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
			
			
			<div class="row">
				<div class="col-md-3">
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
			  <div class="col-md-3">
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
			  <div class="col-md-3">
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
			  <div class="col-md-3">
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
                                <h6 class="panel-title">Referral Sales Report</h6>
                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" tableId="allContact" placeholder="Search by name" type="text">
                                        <div class="form-control-feedback">
                                            <i class="icon-search4"></i>
                                        </div>
                                    </div>
                                    <div class="table_action_tool">
                                        <a href="#"><i class="icon-calendar52"></i></a>
                                        <a style="cursor: pointer; display: none;" id="deleteBulkReferral" class="custom_action_box"><i class="icon-trash position-left"></i></a>
                                        <a style="cursor: pointer; display: none;" id="archiveBulkReferral" class="custom_action_box"><i class="icon-gear position-left"></i> </a>
                                    </div>

                                </div>
                            </div>
                            <div class="panel-body p0">
                               <table class="table" id="allContact">
                        <thead>
                            <tr>
                            	<th style="display: none;"></th>
                            	<th style="display: none;"></th>
                                <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_name.png"></i> Referred Friend</th>
                                <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_name.png"></i> Referrer</th>
                                <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_status.png"></i>Amount</th>
                                <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_status.png"></i>Invoice ID</th>
                                <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_clock.png"></i>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $inc = 1;
                            foreach ($oRefPurchased as $data) {
                                $oTags = \App\Models\Admin\Modules\ReferralModel::getTagsBySaleID($data->id);
								
                                ?>
                                <tr>
                                	<td style="display: none;"><?php echo $data->id; ?></td>
                                	<td style="display: none;"><?php echo $data->id; ?></td>
                                    

                                    <td>											
                                        <div class="media-left media-middle"> <?php echo showUserAvtar('', $data->firstname, $data->lastname); ?> </div>
                                        <div class="media-left">
                                            <div class="pt-5"><a href="javascript:void(0);" class="text-default text-semibold bbot"><?php echo $data->firstname; ?> <?php echo $data->lastname; ?></a> <img class="flags" src="<?php echo base_url(); ?>assets/images/flags/<?php echo strtolower($data->country_code); ?>.png" onerror="this.src='<?php echo base_url('assets/images/flags/us.png'); ?>'"/></div>
                                            <div class="text-muted text-size-small"><?php echo $data->email; ?></div>
                                        </div>
                                    </td>


                                    <td>											
                                        <div class="media-left media-middle"> <?php echo showUserAvtar('', $data->aff_firstname, $data->aff_lastname); ?> </div>
                                        <div class="media-left">
                                            <div class="pt-5"><a href="javascript:void(0);" class="text-default text-semibold bbot"><?php echo $data->aff_firstname; ?> <?php echo $data->aff_lastname; ?></a> <img class="flags" src="<?php echo base_url(); ?>assets/images/flags/<?php echo strtolower($data->country_code); ?>.png" onerror="this.src='<?php echo base_url('assets/images/flags/us.png'); ?>'"/></div>
                                            <div class="text-muted text-size-small"><?php echo $data->aff_email; ?></div>
                                        </div>
                                    </td>

                                    <td><?php echo $data->currency; ?> <?php echo $data->amount; ?></td>
                                    <td><h6 class="text-semibold"><?php echo $data->invoice_id; ?></h6></td>
                                    <td><h6 class="text-semibold"><?php echo date('M d, Y', strtotime($data->created)); ?><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($data->created)); ?></div></h6></td>
                                    
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
@endsection