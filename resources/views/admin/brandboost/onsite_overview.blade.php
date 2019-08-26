@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')

<script src = "https://code.highcharts.com/highcharts.js"></script>


<!-- /theme JS files -->
<style>
.highcharts-tick{stroke:none!important}
.highcharts-legend, .highcharts-credits{display: none!important;}
.highcharts-container, .highcharts-container svg {width: 100% !important;}
</style>

<?php
$iActiveCount = $iArchiveCount = 0;

if (!empty($aBrandbosts)) {
	foreach ($aBrandbosts as $oCount) {
		if($oCount->status == 3) {
			$iArchiveCount++;
		}else{
			$iActiveCount++;
		}
	}
}
?>
	
  <div class="content">
  
  <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
	<div class="page_header">
	  <div class="row">
	  <!--=============Headings & Tabs menu==============-->
		<div class="col-md-5">
		  <h3><i class="icon-star-half"></i> &nbsp; On Site Overviews</h3>
		  <ul class="nav nav-tabs nav-tabs-bottom">
			<li class="active"><a href="#right-icon-tab0" data-toggle="tab">Live Now</a></li>
			<li><a href="#right-icon-tab1" data-toggle="tab">Today</a></li>
			<li><a href="#right-icon-tab2" data-toggle="tab">Last Week</a></li>
			<li><a href="#right-icon-tab3" data-toggle="tab">Last Month</a></li>
			<li><a href="#right-icon-tab4" data-toggle="tab">Last Year</a></li>
		  </ul>
		</div>
		<!--=============Button Area Right Side==============-->
		<div class="col-md-7 text-right btn_area">
			<div class="btn-group">
                	<button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                    	<i class="icon-calendar2"></i>&nbsp; &nbsp; Filter campaign&nbsp; &nbsp; <span class="caret"></span>
                	</button>
					<div class="dropdown-menu dropdown-content width-320 dropdown-menu-right">
					  <div class="dropdown-content-heading"> Filter
						<ul class="icons-list">
						  <li><a href="#"><i class="icon-more"></i></a> </li>
						</ul>
					  </div>
					  <div class="">
						<div class="panel-group panel-group-control panel-group-control-right content-group-lg filter_campaign" id="accordion-control-right">
  <div class="panel panel-white">
    <div class="panel-heading sidebarheadings active">
      <h6 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group1"><i class="icon-star-empty3"></i>&nbsp;Campaign Type</a> </h6>
    </div>
    <div id="accordion-control-right-group1" class="panel-collapse collapse">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12"> 
Most startups fail. But many of those failures are preventable. The Lean Startup is a new approach being adopted across the globe, changing the way companies are built and new products are launched.
 </div>
        </div>
      </div>
    </div>
  </div>
  <div class="panel panel-white">
    <div class="panel-heading sidebarheadings">
      <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group2"><i class="icon-arrow-up-left2"></i>&nbsp; Source</a> </h6>
    </div>
    <div id="accordion-control-right-group2" class="panel-collapse collapse">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12"> Conetent Goes here... </div>
        </div>
      </div>
    </div>
  </div>
  <div class="panel panel-white">
    <div class="panel-heading sidebarheadings">
      <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group73"><i class="icon-star-full2"></i>&nbsp; Rating</a> </h6>
    </div>
    <div id="accordion-control-right-group73" class="panel-collapse collapse">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12"> Conetent Goes here... </div>
        </div>
      </div>
    </div>
  </div>
  <div class="panel panel-white">
    <div class="panel-heading sidebarheadings">
      <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group74"><i class="icon-calendar"></i>&nbsp; Date Created</a> </h6>
    </div>
    <div id="accordion-control-right-group74" class="panel-collapse collapse">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12"> Conetent Goes here... </div>
        </div>
      </div>
    </div>
  </div>
  <div class="panel panel-white">
    <div class="panel-heading sidebarheadings">
      <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group83"><i class="icon-thumbs-up2"></i>&nbsp; Reviews</a> </h6>
    </div>
    <div id="accordion-control-right-group83" class="panel-collapse collapse in">
      <div class="panel-body">
        <div class="row mb20">
          <div class="col-xs-6">
          <div class="checkbox">
          <label>
			<input type="checkbox"  class="control-primary" checked="checked">
			Total Reviews
			</label>
			</div>
          </div>
          <div class="col-xs-6">
          <input class="form-control input-sm" type="text" name="" value="20" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" />
          </div>
          
        </div>
        <div class="row mb20">
          <div class="col-xs-6">
          <div class="checkbox">
          <label>
			<input type="checkbox"  class="control-primary" checked="checked">
			Positive
			</label>
			</div>
          </div>
          <div class="col-xs-6">
          <input class="form-control input-sm" type="text" name="" value="20" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" />
          </div>
          
        </div>
        <div class="row mb20">
          <div class="col-xs-6">
          <div class="checkbox">
          <label>
			<input type="checkbox"  class="control-primary">
			Neutral
			</label>
			</div>
          </div>
          <div class="col-xs-6">
          <input class="form-control input-sm" type="text" name="" value="20" disabled /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" disabled />
          </div>
          
        </div>
        <div class="row">
          <div class="col-xs-6">
          <div class="checkbox">
          <label>
			<input type="checkbox"  class="control-primary" checked="checked">
			Negative
			</label>
			</div>
          </div>
          <div class="col-xs-6">
          <input class="form-control input-sm" type="text" name="" value="0" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="10" />
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>
									  </div>
									  <div class="dropdown-content-footer">
									  	<button type="button" class="btn dark_btn dropdown-toggle" style="display: inline-block;"><i class="icon-filter4"></i><span> &nbsp;  Filter</span> </button>
									  	&nbsp; &nbsp;
									  	<a style="display: inline-block;" href="#">Clear All</a>
									  </div>
									</div>
								</div>
						  <!-- &nbsp; &nbsp; &nbsp; -->
						  <!-- <button type="button" class="btn dark_btn dropdown-toggle" id="newcampaign"><i class="icon-plus3"></i><span> &nbsp;  Add On Site Brand Boost</span> </button> -->
						  
						</div>
					  </div>
					</div>
				  <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->

					<!--&&&&&&&&&&&& TABBED CONTENT &&&&&&&&&&-->
					<?php if (!empty($aBrandbosts)): ?>
					<div class="tab-content"> 
					  <!--===========TAB 1===========-->
					  <div class="tab-pane active" id="right-icon-tab0">
						<div class="row">
						  <div class="col-md-3">
							<div class="panel panel-flat review_ratings">
							  <div class="panel-heading">
								<h6 class="panel-title">Review Ratings</h6>
								<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
							  </div>
							  <div class="panel-body p0">
							  <div class="pt20 pb20 pl40 pr40 bbot">
							  	<h1><i class="icon-star-full2"></i> 4.2 <sup><i class="icon-arrow-up5"></i> &nbsp; +15%</sup></h1>
							  </div>
							  <div class="p40 ratings">
								<div class="row inner">
									<div class="col-xs-6">
										<i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> 
									</div>
									<div class="col-xs-6 text-right"><p>24% <span>5</span></p></div>
								<div class="col-xs-12">
									<div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
										<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40" style="width:40%"></div>
									</div>
									</div>
								</div>
								<div class="row inner">
									<div class="col-xs-6">
										<i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> 
									</div>
									<div class="col-xs-6 text-right"><p>61% <span>17</span></p></div>
								<div class="col-xs-12">
									<div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
										<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="70" style="width:70%"></div>
									</div>
									</div>
								</div>
								<div class="row inner">
									<div class="col-xs-6">
										<i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> 
									</div>
									<div class="col-xs-6 text-right"><p>3% <span>1</span></p></div>
								<div class="col-xs-12">
									<div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
										<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="10" style="width:20%"></div>
									</div>
									</div>
								</div>
								<div class="row inner">
									<div class="col-xs-6">
										<i class="icon-star-full2"></i> <i class="icon-star-full2"></i>  
									</div>
									<div class="col-xs-6 text-right"><p>0% <span>0</span></p></div>
								<div class="col-xs-12">
									<div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
										<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="10" style="width:10%"></div>
									</div>
									</div>
								</div>
								<div class="row inner mb0">
									<div class="col-xs-6">
										<i class="icon-star-full2"></i>   
									</div>
									<div class="col-xs-6 text-right"><p>0% <span>0</span></p></div>
								<div class="col-xs-12">
									<div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
										<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="10" style="width:10%"></div>
									</div>
									</div>
								</div>
								
								
								</div>
							  </div>
							</div>
						  </div>
						  
						  <div class="col-md-6">
							<div class="panel panel-flat">
							  <div class="panel-heading">
								<h6 class="panel-title">Daily Visits</h6>
								<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
							  </div>
							  <div class="panel-body min_h230 p0">
							  <div class="p20 pb0 topchart_value mb30"a>
							  	<div class="row">
							  		<div class="col-xs-2">
							  		<img class="" src="/assets/images/purple_star.png" width="43">
							  		</div>
							  		<div class="col-xs-4">
							  		<h1 class="m0 lh25">21.5% </h1>
							  		<p><span style="border: none;" class="label bkg_purple ml0 ">5.9%</span></p>
							  		</div>
							  	</div>
							  </div>
							  
							   <div id="linechart_a" style="min-width: 300px; height: 295px;"></div>
								
							  </div>
							</div>
						  </div>
						  
						  <div class="col-md-3">
							<div class="panel panel-flat">
							  <div class="panel-heading">
								<h6 class="panel-title">NPS Score</h6>
								<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
							  </div>
							
							  <div class="panel-body p0 pb10" >
							  	<div class="semi_circle_smiley"><img class="" src="/assets/images/smiley_green.png" width="43"></div>
								<div id = "semi_circle_chart2" class="br5 bkg_gradient" style = "width: 100%; height: 190px;"></div>
							  </div>
							</div>
							<div class="panel panel-flat">
							  <div class="panel-heading">
								<h6 class="panel-title">Negative Reviews<a class="heading-elements-toggle"><i class="icon-more"></i></a><a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
								<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
							  </div>
							  <div class="panel-body p30">
							  <div class="row">
							  	<div class="col-xs-6">
							  		<div class="topchart_value">
							  	<div class="row">
							  		<div class="col-xs-5">
							  		<img class="" src="/assets/images/smiley_red.png" width="43">
							  		</div>
							  		<div class="col-xs-7">
							  		<h1 class="m0 lh25">31</h1>
							  		<p><span style="border: none;" class="label bkg_red ml0 ">15.9%</span></p>
							  		</div>
							  	</div>
							  </div>
							  	</div>
							  	<div class="col-xs-6">
							  		<img src="/assets/images/graph5_1.png">
							  	</div>
							  </div>
								
							  </div>
							</div>
						  </div>					</div>
						
						<div class="row">
						  <div class="col-md-12">
							<div style="margin: 0;" class="panel panel-flat">
								
							  <div class="panel-heading">
								<h6 class="panel-title">On Site Campaigns</h6>
								<div class="heading-elements">
								<div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
									<input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
									<div class="form-control-feedback">
										<i class="icon-search4"></i>
									</div>
								</div>
								<div class="table_action_tool">
									<a href="#"><i class="icon-calendar52"></i></a>
									<a href="#"><i class="icon-arrow-down16"></i></a>
									<a href="#"><i class="icon-arrow-up16"></i></a>
									<a style="cursor: pointer;" class="editDataList"><i class="icon-pencil"></i></a>
									<a style="cursor: pointer; display: none;" id="deleteButtonBrandboostOnline" class="custom_action_box"><i class="icon-trash"></i></a>
									<!-- <a style="cursor: pointer;" id="archiveButtonBrandboostOnline" class="custom_action_box"><i class="icon-gear"></i></a> -->

									
								</div>
													
								</div>
							  </div>
							  <div class="panel-body p0">
<table class="table datatable-basic">
	<thead>
		<tr>
			<th style="display: none;"></th>
			<th style="display: none;"></th>
			<th style="display: none;" class="nosort editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
			<th><i class="icon-stack-star"></i>Name</th>
			<th><i class="icon-star-full2"></i>Rating</th>
			<th><i class="icon-calendar"></i>Created</th>
			<th><i class="icon-user"></i>&nbsp;</th>
			<th><i class="icon-graph"></i>Total</th>
			<th><i class="fa fa-smile-o fsize12"></i>&nbsp;</th>
			<th><i class="fa fa-smile-o fsize12"></i>&nbsp;</th>
			<th><i class="fa fa-smile-o fsize12"></i>&nbsp;</th>
			<th><i class="icon-alarm-check"></i>Last review</th>
			<th class="text-center"><i class="fa fa-dot-circle-o fsize12"></i>Status</th>
			<!-- <th>&nbsp;</th> -->

			
		</tr>
	</thead>
	<tbody>

<!--=======================-->
	<?php
        $inc = 1;
        $aUser = getLoggedUser();
        $currentUserId = $aUser->id;
        foreach ($aBrandbosts as $data) {
            if ($data->status == 1 or $data->status == 0 or $data->status == 2) {
            	
                $list_id = $data->id;
                $aReviews = \App\Models\ReviewsModel::getCampaignReviews($list_id);
                $user_id = $data->user_id;
                $revCount = \App\Models\ReviewsModel::getCampReviews($data->id);
				$revCount = count($revCount);
                //$revRA = getCampaignReviewRA($data->id);
				$revRA = '';
                $allSubscribers = \App\Models\Admin\ListsModel::getAllSubscribersList($data->id);
                //$siteRevCount = getCampaignSiteReviewCount($data->id);
				$siteRevCount = '';
                //$siteRevRA = getCampaignSiteReviewRA($data->id);
				$siteRevRA = '';
				
				if($data->brand_img == '' || $data->brand_img == 'b:0;'){
					$imgSrc = base_url('assets/images/default_table_img2.png');
				}else{
					/*$brandImgArray = unserialize($data->brand_img);
					$brand_img = $brandImgArray[0]['media_url'];
					
					if (empty($brand_img)) {
						$imgSrc = base_url('assets/images/default_table_img2.png');
						} else {
						$imgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brand_img;
					}*/
					$imgSrc = base_url('assets/images/default_table_img2.png');
				}
	?>

		<tr id="append-<?php echo $data->id; ?>" class="selectedClass">
			<td style="display: none;"><?php echo date('m/d/Y', strtotime($data->created)); ?></td>
			<td style="display: none;"><?php echo $data->id; ?></td>
			<td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" id="chk<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" ><span class="custmo_checkmark"></span></label></td>
			

			<td>
				<div class="media-left media-middle"> 
					<a href="<?php echo base_url('admin/brandboost/onsite_setup/'.$data->id);?>" brandID="<?php echo $data->id; ?>" b_title="<?php echo $data->brand_title; ?>" class="text-default text-semibold"><img src="<?php echo $imgSrc; ?>" class="img-circle img-xs br5" alt=""></a> </div>
				<div class="media-left">
					<div class=""><a href="<?php echo base_url('admin/brandboost/onsite_setup/'.$data->id);?>" brandID="<?php echo $data->id; ?>" b_title="<?php echo $data->brand_title; ?>" class="text-default text-semibold"><?php echo $data->brand_title; ?></a>
					</div>
					<div class="text-muted text-size-small"><?php echo setStringLimit($data->brand_desc); ?></div>
				</div>
			</td>

			<td>
			
				<?php 

				if ($revRA >= 4) {
		            $smilyImage = '<div class="media-left media-middle"> <a href="'.base_url('admin/brandboost/reviews/' . $data->id).'" target="_blank"><img src="' . base_url('assets/images/smiley_green.png') . '" class="img-circle img-xs" alt=""></a> </div><div class="media-left"><div class=""><a href="'.base_url('admin/brandboost/reviews/' . $data->id).'" target="_blank" class="text-default text-semibold">' . number_format($revRA, 1) . '</a> </div><div class="text-muted text-size-small">Positive</div></div>';
		        } else if ($revRA > 2 && $revRA < 4) {
		            $smilyImage = '<div class="media-left media-middle"> <a href="'.base_url('admin/brandboost/reviews/' . $data->id).'" target="_blank"><img src="' . base_url('assets/images/smiley_grey2.png') . '" class="img-circle img-xs" alt=""></a> </div><div class="media-left"><div class=""><a href="'.base_url('admin/brandboost/reviews/' . $data->id).'" target="_blank" class="text-default text-semibold">' . number_format($revRA, 1) . '</a> </div><div class="text-muted text-size-small">Neutral</div></div>';
		        } else if($revRA >= 1) {
		            $smilyImage = '<div class="media-left media-middle"> <a href="'.base_url('admin/brandboost/reviews/' . $data->id).'" target="_blank"><img src="' . base_url('assets/images/smiley_red.png') . '" class="img-circle img-xs" alt=""></a> </div><div class="media-left"><div class=""><a href="'.base_url('admin/brandboost/reviews/' . $data->id).'" target="_blank" class="text-default text-semibold">' . number_format($revRA, 1) . '</a> </div><div class="text-muted text-size-small">Negative</div></div>';
		        }
		        else {
			        $smilyImage = 'N/A';
			    }
		        echo $smilyImage;
				?>
				
				
			</td>
			<td>
				<div class="media-left">
					<div class=""><a href="#" class="text-default text-semibold"><?php echo date('d M Y', strtotime($data->created)); ?></a>
					</div>
					<div class="text-muted text-size-small"><?php echo date('h:iA', strtotime($data->created)); ?></div>
				</div>
			</td>

			<td>
				<?php if (sizeof($allSubscribers) > 0) { ?>
					<a href="<?php echo base_url('admin/brandboost/stats/onsite/' . $data->id . '?t=contact'); ?>" target="_blank" class="text-default text-semibold"><?php echo sizeof($allSubscribers); ?></a>
					<div data-toggle="tooltip" title="Total contacts <?php echo sizeof($allSubscribers); ?>" data-placement="top" class="progress">
						<div class="progress-bar progress-bar-grey" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%"></div>
					</div>
					
                    <?php
						} else {
                        $allSubscribers = 0;
                        //echo '<span style="color:#999999">No Data</span>';
					?>
					<a href="<?php echo base_url('admin/brandboost/stats/onsite/' . $data->id . '?t=contact'); ?>" target="_blank" class="text-default text-semibold"><?php echo $allSubscribers; ?></a>
					<div data-toggle="tooltip" title="Total contacts <?php echo $allSubscribers; ?>" data-placement="top" class="progress">
						<div style="color:#999999!important;" class="progress-bar progress-bar-violet" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%"></div>
					</div>
					<?php }
				?>

			</td>

			<?php
				$reviewRequests = \App\Models\Admin\BrandboostModel::getReviewRequest($data->id, '');
				
				//$getSendRequest = count($reviewRequests);
				$getSendRequest = 1;
				//$getSendRequestSms = getSendRequest($data->id, 'sms');
				$getSendRequestSms = 1;
				//$getSendRequestEmail = getSendRequest($data->id, 'email');
				$getSendRequestEmail = 1;
				$getSendRequestEmailPersentage = $getSendRequestEmail * 100 / $getSendRequest;
				$getSendRequestSmsPersentage = $getSendRequestSms * 100 / $getSendRequest;
				
				$reviewResponse = \App\Models\Admin\BrandboostModel::getReviewRequestResponse($data->id);
				$getResCount = count($reviewResponse);
				$getResCount = 1;
				
				$positiveRating = 0;
				$neturalRating = 0;
				$negativeRating = 0;
				$positiveGraph = 0;
				$neturalGraph = 0;
				$negativeGraph = 0;
				
				foreach($reviewResponse as $reviewData){
					if($reviewData->ratings != ''){
						if($reviewData->ratings == 5){
							$positiveRating++;
						}else if($reviewData->ratings >= 3 && $reviewData->ratings < 5){
							$neturalRating++;
						}else{
							$negativeRating++;
						}
					}
				}
				
				$positiveGraph = $positiveRating * 100 / $getResCount; 
				$neturalGraph = $neturalRating * 100 / $getResCount; 
				$negativeGraph = $negativeRating * 100 / $getResCount; 
				$totalGraph = $getResCount * 100 / $getSendRequest; 
				$totalGraph = $totalGraph > 100 ? 100 : $totalGraph;
				
				
			?>
			<td>
				<a style="cursor: pointer;" target="_blank" class="text-default text-semibold"><?php echo $getResCount; ?></a>
				<div data-toggle="tooltip" title="Total Requests <?php echo $getResCount; ?>" data-placement="top" class="progress">
					<div class="progress-bar progress-bar-violet" role="progressbar" aria-valuenow="100" aria-valuemin="100" aria-valuemax="100" style="width:<?php echo $totalGraph; ?>%"></div>
				</div>
			</td>
			<td>
				<a style='cursor:pointer;' class="text-default text-semibold"><?php echo $positiveRating; ?></a>
				<div data-toggle="tooltip" title="<?php echo $positiveRating; ?> out of <?php echo $getResCount; ?> Responses" data-placement="top" class="progress">
					<div class="progress-bar progress-bar-green2" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $positiveGraph; ?>%"></div>
				</div>
			</td>
			<td>
				<a style='cursor:pointer;' class="text-default text-semibold"><?php echo $neturalRating; ?></a>
				<div data-toggle="tooltip" title="<?php echo $neturalRating; ?> out of <?php echo $getResCount; ?> Response" data-placement="top" class="progress">
					<div class="progress-bar progress-bar-black" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $neturalGraph; ?>%"></div>
				</div>
			</td>
			<td>
				<a style='cursor:pointer;' class="text-default text-semibold"><?php echo $negativeRating; ?></a>
				<div data-toggle="tooltip" title="<?php echo $negativeRating; ?> out of <?php echo $getResCount; ?> Response" data-placement="top" class="progress">
					<div class="progress-bar progress-bar-red" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $negativeGraph; ?>%"></div>
				</div>
			</td>

			<td>
				<?php 
				if(!empty($aReviews)) {
					if(!empty($aReviews[0]->avatar)) {
						$avatarImage =  'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/'.$aReviews[0]->avatar;
					}
					else {
						$avatarImage = base_url('assets/images/userp.png');
					}
					
            		?>
            		<div class="media-left media-middle"> <a href="#"><img src="<?php echo $avatarImage; ?>" class="img-circle img-xs" alt=""></a> </div>
					<div class="media-left">
						<div class=""><a href="#" class="text-default text-semibold"><?php //echo number_format($aReviews[0]->ratings, 1); ?> <i class="fa fa-smile-o"></i></a> </div>
						<div class="text-muted text-size-small"><?php //echo $aReviews[0]->firstname.' '.$aReviews[0]->lastname; ?> </div>
					</div><?php
            	}
            	else {
            		echo 'N/A';
            	}
				?>
			</td>

			<!-- <td><a href="<?php echo base_url(); ?>admin/brandboost/statistics/<?php echo $data->id; ?>" target="_blank"><img src="/assets/images/table_graph.png" class="" alt=""></a>
			</td>
 			-->

			<td class="text-center">
				<label class="custom-form-switch">
					<?php 
					if ($data->status == 1) { ?>
						<input class="field changeStatus"  brandID="<?php echo $data->id; ?>" status="2" type="checkbox" checked="checked" >
					<?php }
					else {
						?><input class="field changeStatus"  brandID="<?php echo $data->id; ?>" status="1" type="checkbox" ><?php
					}?>
					
					<span class="toggle"></span>
				</label>
				
				<?php
					if ($user_role != '2') {
						if ($currentUserId == $user_id || $user_role == 1) {
						?>
						
						<div class="tdropdown">
							<a class="ml30 dropdown-toggle" data-toggle="dropdown" style="cursor: pointer;"><img src="/assets/images/more.svg"/></a>
							<!-- <button type="button" class="btn btn-xs btn_white_table ml20 dropdown-toggle" data-toggle="dropdown"><i class="icon-more2 txt_blue"></i></button> -->
							<ul class="dropdown-menu dropdown-menu-right width-200">
								
                                <?php if ($data->status == 1) { ?>
									<li><a href="javascript:void(0);" class="changeStatusCampaign" brandID="<?php echo $data->id; ?>" status="2"><i class="icon-file-stats"></i> Pause</a></li>
								<?php } ?>
								<?php if ($data->status == 2) { ?>
									<li><a href="javascript:void(0);" class="changeStatusCampaign" brandID="<?php echo $data->id; ?>" status="1"><i class="icon-file-stats"></i> Start</a></li>
								<?php } ?>
								<li><a href="<?php echo base_url('admin/brandboost/onsite_setup/'.$data->id);?>" brandID="<?php echo $data->id; ?>" b_title="<?php echo $data->brand_title; ?>" class="text-default text-semibold"><i class="icon-pencil"></i>  Edit</a></li>
								<li><a href="<?php echo base_url('admin/brandboost/brand_configuration/'.$data->id);?>" class="text-default text-semibold"><i class="icon-pencil"></i> Brand Configuration</a></li>
								<li><a href="javascript:void(0);" class="deleteCampaign" brandID="<?php echo $data->id; ?>"><i class="icon-trash"></i> Delete</a></li>
								<li><a href="javascript:void(0);" class="archiveCampaign" brandID="<?php echo $data->id; ?>"><i class="icon-file-text2"></i> Move to Archive</a></li>

								<li><a href="javascript:void(0);" class="viewECode" brandID="<?php echo $data->id; ?>"><i class="icon-file-locked"></i> Get Embedded Code</a></li>
								<li><a href="<?php echo base_url('admin/brandboost/stats/onsite/' . $data->id . '?t=contact'); ?>" target="_blank"><i class="icon-gear"></i> Contacts</a></li>
								<li><a href="http://pleasereviewmehere.com/campaign/<?php echo strtolower(str_replace(" ", "-", $data->brand_title)) . '-' . $data->id; ?>" target="_blank"><i class="icon-menu"></i>Campaign Page</a></li>  
							</ul>
						</div>
						
						
						<?php
							} else {
                            echo '-';
						}
					}
				?>
			</td>
		</tr>

		<?php
			$inc++;
		}
	}
?>
<!-- smiley_red smiley_grey2 -->

<!--=======================-->

	</tbody>
</table>
							  </div>
							</div>
						  </div>
						</div>
						
					  </div>
					  <!--===========TAB 2===========-->
					  <div class="tab-pane" id="right-icon-tab1">
						TAB 2
					  </div>
					   <!--===========TAB 3===========-->
					  <div class="tab-pane" id="right-icon-tab2">
						TAB 3
					  </div>
					</div>
					<!--================================= CONTENT AFTER TAB===============================-->
					
					
					
				  </div>
				
		<?php else: ?>
	<div class="row">
		<div class="col-md-12">
			<div style="margin: 200px 0px 0;" class="text-center">
				<!--<h5 class="mb-20" >Create Your First Offsite Brand Boost.</h5>-->
				
				<h5 class="mb-20">
					Looks Like You Don’t Have Any Brand Boosts Yet <img src="<?php echo site_url('assets/images/smiley.png'); ?>"> <br>
					Lets Create Your First Onsite Brand Boost.
				</h5>
				<?php if ($canWrite): ?>
				<button id="addBrandboost" class="btn bl_cust_btn mb-10 btn-default addBrandboost" type="button"><i class="icon-make-group position-left"></i> ADD ONSITE BRAND BOOST</button>
				<?php endif; ?>
				
			</div>
		</div>
	</div>
	<?php endif; ?>
		
		
<div id="viewEModel" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Embedded Widget Code</h5>
			</div>
            <div class="modal-body">
                <div class="col-md-12" id="embeddedCode" style="border:1px #ccc solid; padding:10px; margin:0 5px 10px;"></div>
			</div>
            <hr>
            <div class="modal-footer">
                <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
			</div>
		</div>
	</div>
</div>


<!-- addBrandboost -->
<div id="addBrandboostModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="frmAddOnsiteBrandboost" id="frmAddOnsiteBrandboost" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Add Onsite Brand Boost</h5>
				</div>
				
                <div class="modal-body">
                    <h6 class="text-semibold">Step 1: Where Would You Like To Boost Your Brand? </h6>
                    <p>Please Enter Title below:</p>
                    <input class="form-control" id="campaignName" name="campaignName" placeholder="Enter Title" type="text" required>
				</div>
				
                <div class="modal-footer p40">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn dark_btn">Continue</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /addBrandboost -->
		
		<!--=====================================Create new campaign================================-->	
<div id="addPeopleList" class="modal fade">
    <div style="max-width: 440px;ss" class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Create new campaign</h5>
                </div>
                <div class="modal-body">
                   <div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label class="control-label">Campaign name</label>
      <div class="">
        <input placeholder="Enter campaign name" name="firstname" id="firstname" class="form-control" type="text" required>
      </div>
    </div>
    </div>
    <div class="col-md-12">
    <div class="form-group mb0">
      <label class="control-label">Campaign description</label>
      <div class="">
        <textarea placeholder="Enter campaign description"  class="form-control" value="" type="text" required> </textarea>
      </div>
    </div>
    </div>
   

    
  </div>
                </div>
                <div class="modal-footer p40">
                    <input type="hidden" name="listId" id="list_id" value="">
                    <button class="btn btn-link text-muted" data-dismiss="modal">Cancel </button>
                    <button data-toggle="modal" id="nextpopup" type="button" class="btn dark_btn bkg_purple">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--=====================================Add List Modal Popup End================================-->

<script>
	
	$(document).ready(function(){
        $(".reviews").click(function(){
            $(".box").animate({
                width: "toggle"
            });
        });
		
		$("#newcampaign").click(function(){
            $(".box").animate({
                width: "toggle"
            });
        });

        $(document).on("change", ".changeStatus", function () {
        	
            var brandboostID = $(this).attr('brandID');
            var status = $(this).attr('status');
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/updateOnsiteStatus'); ?>',
                type: "POST",
                data: {'brandboostID': brandboostID, 'status': status, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        //window.location.href = '<?php echo base_url('admin/brandboost/onsite'); ?>';
						} else {
                        alertMessage('Error: Some thing wrong!');
					}
				}
			});
		});

		
    });
	
	
	// top navigation fixed on scroll and side bar collasped
	
		$( window ).scroll( function () {
			var sc = $( window ).scrollTop();
			if ( sc > 100 ) {
				$( "#header-sroll" ).addClass( "small-header" );
			} else {
				$( "#header-sroll" ).removeClass( "small-header" );
			}
		} );

		function smallMenu() {
			if ( $( window ).width() < 1600 ) {
				$( 'body' ).addClass( 'sidebar-xs' );
			} else {
				$( 'body' ).removeClass( 'sidebar-xs' );
			}
		}

		$( document ).ready( function () {
			smallMenu();

			window.onresize = function () {
				smallMenu();
			};
		} );
	
	
	
	//Semi Circle chart js -- Highcharts js plugins
	
	
         $(document).ready(function() {
            var chart = {
               plotBackgroundColor: false,
               plotBorderWidth: 0,
               plotShadow: false
            };
            var title = {
               text: '83 <br> <span style="border: none;" class="label bkg_green ml0 ">15.9%</span>',
               align: 'center',
               verticalAlign: 'middle',
               y: 50	  
            };  
			 
			  var title2 = {
               text: '52 <br> <span style="border: none;" class="label bkg_green ml0 ">22.9%</span>',
               align: 'center',
               verticalAlign: 'middle',
               y: 50	  
            }; 
			 
			 
            var tooltip = {
               pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            };
            var plotOptions = {
               pie: {
                  dataLabels: {
                     enabled: false,
                     distance: -5550,
                     
                     style: {
                        fontWeight: 'bold',
                        color: 'white',
                        textShadow: '0px 1px 2px black'
                     }
                  },
                  startAngle: -90,
                  endAngle: 90,
                  center: ['50%', '75%']
               }
            };
            var series = [{
               type: 'pie',
               name: 'NPS',
			   colors: ['#fd6c81', '#facfd7', '#8bbc21', '#910000'],
               innerSize: '85%',
               data: [
                  ['A',   83],
                  ['B',    17],
                
                  {
                     name: 'Others',
                     y: 0,
                     dataLabels: {
                        enabled: false
                     }
                  }
               ]
            }];  
			 
			 
			 var series2 = [{
               type: 'pie',
               name: 'NPS',
			   colors: ['#5ad491', '#c8eedb', '#8bbc21', '#910000'],
               innerSize: '90%',
               data: [
                  ['A',   80],
                  ['B',    20],
                
                  {
                     name: 'Others',
                     y: 0,
                     dataLabels: {
                        enabled: false
                     }
                  }
               ]
            }]; 
			 
			 
      
            var json = {};   
            json.chart = chart; 
            json.title = title;     
            json.tooltip = tooltip;  
            json.series = series;
            json.plotOptions = plotOptions;
            $('#semi_circle_chart').highcharts(json); 
			 
			 
			var json2 = {};   
            json2.chart = chart; 
            json2.title = title2;     
            json2.tooltip = tooltip;  
            json2.series = series2;
            json2.plotOptions = plotOptions;
            $('#semi_circle_chart2').highcharts(json2); 
			 
			 
			 
			 
			
         });
		
		
		
		
		
		
		
		
Highcharts.chart('linechart_a', {
    chart: {
        type: 'column',
		backgroundColor:'rgba(0, 0, 0, 0)',
    },
    title: {
        text: null
    },
    subtitle: {
        text: null
    },
    xAxis: {
        type: 'category',
        labels: {
           
            style: {
                fontSize: '11px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: null
        }
    },
    legend: {
        enabled: false
    },
	
	plotOptions: {
        column: {
            pointPadding: 0.20,
            borderWidth: 0,
			borderRadius: 5
        }
    },
	
	colors: ['#9b83ff', '#cae4d1'],
    tooltip: {
        pointFormat: 'Time in 2017: <b>{point.y:.1f} millions</b>'
    },
    series: [{
        name: 'Time',
        data: [
            ['1', 14.2],
            ['2', 3.8],
            ['3', 2.9],
            ['4', 16.7],
            ['5', 9.1],
            ['6', 18.7],
            ['7', 15.4],
			['8', 14.2],
            ['12', 3.8],
            ['13', 2.9],
            ['14', 16.7],
            ['15', 9.1],
            ['11', 18.7],
            ['17', 15.4]
        ],
       
    }]
});	
	
	
      </script>

      <script type="text/javascript">
	
    $(document).ready(function () {
		
        $('#checkAll').change(function () {
			
            if (false == $(this).prop("checked")) {
				
                $(".checkRows").prop('checked', false);
                $(".selectedClass").removeClass('success');
                $('.custom_action_box').hide();
				} else {
				
                $(".checkRows").prop('checked', true);
                $(".selectedClass").addClass('success');
                $('.custom_action_box').show();
			}
			
		});
		
        $(document).on('click', '.checkRows', function () {
            var inc = 0;
			
			
            var rowId = $(this).val();
			
            if (false == $(this).prop("checked")) {
                $('#append-' + rowId).removeClass('success');
				} else {
                $('#append-' + rowId).addClass('success');
			}
			
            $('.checkRows:checkbox:checked').each(function (i) {
                inc++;
			});
            if (inc == 0) {
				
                $('.custom_action_box').hide();
				} else {
                $('.custom_action_box').show();
			}
			
            var numberOfChecked = $('.checkRows:checkbox:checked').length;
            var totalCheckboxes = $('.checkRows:checkbox').length;
            if (totalCheckboxes > numberOfChecked) {
                $('#checkAll').prop('checked', false);
			}
			
		});
		
        $(document).on('click', '#deleteButtonBrandboostOnline', function () {
			
            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
			});
            if (val.length === 0) {
                alert('Please select a row.')
				} else {
				
                var elem = $(this);
                swal({
                    title: "Are you sure? You want to delete this record!",
                    text: "You will not be able to recover this record!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#EF5350",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: true,
                    closeOnCancel: true
				},
				function (isConfirm) {
					if (isConfirm) {
						$('.overlaynew').show();
						$.ajax({
							url: '<?php echo base_url('admin/brandboost/delete_multipal_brandboost'); ?>',
							type: "POST",
							data: {multi_brandboost_id: val, _token: '{{csrf_token()}}'},
							dataType: "json",
							success: function (data) {
								if (data.status == 'success') {
									$('.overlaynew').hide();
									window.location.href = '';
								}
							}
						});
					}
				});
			}
			
		});
		
        $('#checkAllA').change(function () {
			
            if (false == $(this).prop("checked")) {
				
                $(".checkRowsA").prop('checked', false);
                $(".selectedClassA").removeClass('success');
                $('.custom_action_boxA').hide();
				} else {
				
                $(".checkRowsA").prop('checked', true);
                $(".selectedClassA").addClass('success');
                $('.custom_action_boxA').show();
			}
			
		});
		
        $(document).on('click', '.checkRowsA', function () {
            var inc = 0;
			
			
            var rowId = $(this).val();
			
            if (false == $(this).prop("checked")) {
                $('#append-' + rowId).removeClass('success');
				} else {
                $('#append-' + rowId).addClass('success');
			}
			
            $('.checkRowsA:checkbox:checked').each(function (i) {
                inc++;
			});
            if (inc == 0) {
				
                $('.custom_action_boxA').hide();
				} else {
                $('.custom_action_boxA').show();
			}
			
            var numberOfChecked = $('.checkRowsA:checkbox:checked').length;
            var totalCheckboxes = $('.checkRowsA:checkbox').length;
            if (totalCheckboxes > numberOfChecked) {
                $('#checkAllA').prop('checked', false);
			}
			
		});
		
        $(document).on('click', '#deleteButtonBrandboostOnlineA', function () {
			
            var val = [];
            $('.checkRowsA:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
			});
            if (val.length === 0) {
                alert('Please select a row.')
				} else {
				
                var elem = $(this);
                swal({
                    title: "Are you sure? You want to delete this record!",
                    text: "You will not be able to recover this record!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#EF5350",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: true,
                    closeOnCancel: true
				},
				function (isConfirm) {
					if (isConfirm) {
						$('.overlaynew').show();
						$.ajax({
							url: '<?php echo base_url('admin/brandboost/delete_multipal_brandboost'); ?>',
							type: "POST",
							data: {multi_brandboost_id: val, _token: '{{csrf_token()}}'},
							dataType: "json",
							success: function (data) {
								if (data.status == 'success') {
									$('.overlaynew').hide();
									window.location.href = '';
								}
							}
						});
					}
				});
			}
			
		});
		
		
        $(document).on('click', '#archiveButtonBrandboostOnline', function () {
			
            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
			});
            if (val.length === 0) {
                alert('Please select a row.')
				} else {
				
                var elem = $(this);
                swal({
                    title: "Are you sure? You want to move to archive this record!",
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#EF5350",
                    confirmButtonText: "Yes, move to archive it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: true,
                    closeOnCancel: true
				},
				function (isConfirm) {
					if (isConfirm) {
						$('.overlaynew').show();
						$.ajax({
							url: '<?php echo base_url('admin/brandboost/archive_multipal_brandboost'); ?>',
							type: "POST",
							data: {multi_brandboost_id: val, _token: '{{csrf_token()}}'},
							dataType: "json",
							success: function (data) {
								if (data.status == 'success') {
									$('.overlaynew').hide();
									window.location.href = '';
								}
							}
						});
					}
				});
			}
			
		});
		
        $(document).on('click', '.archiveCampaign', function () {
            var brandID = $(this).attr('brandID');
            var val = [brandID];
			
            if (val.length === 0) {
                alert('Please select a row.')
				} else {
				
                var elem = $(this);
                swal({
                    title: "Are you sure? You want to move to archive this record!",
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#EF5350",
                    confirmButtonText: "Yes, move to archive it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: true,
                    closeOnCancel: true
				},
				function (isConfirm) {
					if (isConfirm) {
						$('.overlaynew').show();
						$.ajax({
							url: '<?php echo base_url('admin/brandboost/archive_multipal_brandboost'); ?>',
							type: "POST",
							data: {multi_brandboost_id: val, _token: '{{csrf_token()}}'},
							dataType: "json",
							success: function (data) {
								if (data.status == 'success') {
									$('.overlaynew').hide();
									window.location.href = '';
								}
							}
						});
					}
				});
			}
		});
		
        $('#addBrandboost').click(function () {
            $('#addBrandboostModal').modal();
		});
		
        $('#frmAddOnsiteBrandboost').on('submit', function (e) {
            var campaignName = $('#campaignName').val();
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/addOnsite'); ?>',
                type: "POST",
                data: {'campaignName': campaignName, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = 'admin/brandboost/onsite_setup/' + data.brandboostID;
						} else {
                        alertMessage('Error: Some thing wrong!');
					}
				}
			});
		});
		
		
        $(document).on("click", ".changeStatusCampaign", function () {
            var brandboostID = $(this).attr('brandID');
            var status = $(this).attr('status');
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/updateOnsiteStatus'); ?>',
                type: "POST",
                data: {'brandboostID': brandboostID, 'status': status, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = '';
						} else {
                        alertMessage('Error: Some thing wrong!');
					}
				}
			});
		});
		
        $(document).on('click', '.deleteCampaign', function () {
            var elem = $(this);
            swal({
                title: "Are you sure? You want to delete this record!",
                text: "You will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel pls!",
                closeOnConfirm: true,
                closeOnCancel: true
			},
			function (isConfirm) {
				if (isConfirm) {
					$('.overlaynew').show();
					var brandID = $(elem).attr('brandID');
					$.ajax({
						url: '<?php echo base_url('admin/brandboost/delete_brandboost'); ?>',
						type: "POST",
						data: {brandboost_id: brandID, _token: '{{csrf_token()}}'},
						dataType: "json",
						success: function (data) {
							if (data.status == 'success') {
								$('.overlaynew').hide();
								window.location.href = '';
							}
						}
					});
				}
			});
		});
		
        $(document).on('click', '.viewECode', function () {
            var brandID = $(this).attr('brandID');
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/getBBECode'); ?>',
                type: "POST",
                data: {brandboost_id: brandID, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        var embeddedCode = data.result;
                        $('#embeddedCode').html(embeddedCode);
                        $("#viewEModel").modal();
					}
				}
			});
		});
		
        $(document).on('click', '.editArchiveDataList', function () {
            $('.editArchiveAction').toggle();
		});
		
        $(document).on('click', '.editDataList', function () {
            $('.editAction').toggle();
		});
		
        $('[data-toggle="tooltip"]').tooltip();
		
	});
	
	
	
	
</script>
@endsection