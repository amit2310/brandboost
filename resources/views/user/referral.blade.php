@extends('layouts.user_template') 

@section('title')
<?php //echo $title; ?>
@endsection

@section('contents')

  <div class="content_area">
    <div class="row">
      <div class="col-md-12">
        <div class="white_box profile_sec mb20">
         <div class="backbtn">
			  	<a href="#"><img src="<?php echo base_url(); ?>assets/profile_images/back_40.png"></a>
			  </div>
         
          <div class="p25 bbot text-center">
            <h3>My Referrals</h3>
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
          	<!-- <div class="col-xs-6">
          		<a class="pull-right txt_grey fsize12" href="#"><i><img style="vertical-align: top; margin-top: 4px" src="<?php echo base_url(); ?>assets/profile_images/edit_icon.png" width="12"></i> &nbsp; Edit</a>
          	</div> -->
          </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
			<?php //pre($referralData);
            if(!empty($referralData)) {
            ?>
			<table id="referralTable" style="width: 100%;">

            <thead>
              <tr>
                <th style="display: none;"></th>
                <th class="nosort" style="display: none;"></th>
              </tr>
            </thead>
            <tbody>
			<?php foreach($referralData as $value) {
                   
                    $createdAt = date('d M Y', strtotime($value->created));
                    $created_time = date('h:i A', strtotime($value->created));
                    ?>
			<tr>
			  <td style="display: none;"><?php echo $value->id; ?></td>
			  <td>
    		<ul class="nps_feedback ref">
    			<li>
    			<div class="pull-left">
    			    <div class="media-left"><img src="<?php echo base_url(); ?>assets/profile_images/user_placeholder.png"/></div>
    				<div class="media-left"><p class="txt_dark"><?php echo $value->title; ?></p></div>	
    			</div>
    			<div class="pull-right">
    			    <div class="media-left text-left pr40 w100"><p><strong><img class="email" src="<?php echo base_url(); ?>assets/profile_images/email_icon16.png"/><?php echo ucfirst($value->source_type); ?></strong></p> </div>
    				<div class="media-left text-left pr30 w100"><p><strong><?php echo $value->status == 1 ? '<i class="icon-circle2 txt_green"></i>active' : '<i class="icon-circle2 txt_red"></i>inactive'; ?></strong></p></div>
    				<div class="media-left text-left pr30 w100"><p><strong><?php echo $createdAt; ?></strong></p></div>
    				<div class="media-left p0">
    				<div class="tdropdown"> <a class="table_more dropdown-toggle" data-toggle="dropdown"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a>
						<ul style="right: 0;" class="dropdown-menu dropdown-menu-right status">
						  <li>
							<?php if($value->status != 1){ ?>
							<a href="javascript:void(0);" class="changeStatus" data-status="1" data-id="<?php echo $value->id; ?>"><i class="icon-primitive-dot txt_green"></i> Active</a> 
							<?php }else{ ?>
							<a href="javascript:void(0);" class="changeStatus" data-status="0" data-id="<?php echo $value->id; ?>"><i class="icon-primitive-dot txt_red"></i> Inactive</a> 
							<?php } ?>
						  </li>
						  <li><a href="<?php echo base_url(); ?>user/referral/reports/<?php echo $value->id; ?>"><i class="icon-primitive-dot txt_grey"></i> Report</a> </li>
						</ul>
					  </div>
					</div>
    			</div>
    				<div class="clearfix"></div>
    			</li>
    		</ul>
			</td>
          </tr>
			<?php } ?>
	  </tbody>
      </table>
			<?php }
            else {
                ?>
            <ul class="nps_feedback">
                <li><center>No Feedback Found</center></li>
            </ul>
                <?php

            } ?>
		</div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	var tableId = 'referralTable';
	var tableBase = custom_user_data_table(tableId, 0, 'desc');

	$('.changeStatus').click(function(){
		var status = $(this).attr('data-status');
		var referralId = $(this).attr('data-id');
		$('.overlaynew').show();
		$.ajax({
			url: '<?php echo base_url('user/referral/updateReferralUser'); ?>',
			type: "POST",
			data: {'referral_id': referralId, 'status': status},
			dataType: "json",
			success: function (data) {
				if (data.status == 'success') {
					$('.overlaynew').hide();
					window.location.href = window.location.href;
				}else{
					$('.overlaynew').hide();
				}
			}
		});
	});
});
</script>

@endsection