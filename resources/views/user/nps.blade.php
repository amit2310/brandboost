
  
  <div class="content_area">
    <div class="row">
      <div class="col-md-12">
        <div class="white_box profile_sec mb20">
         <div class="backbtn">
			  	<a href="<?php echo base_url(); ?>user/profile"><img src="<?php echo base_url(); ?>assets/profile_images/back_40.png"></a>
			  </div>
         
          <div class="p25 bbot text-center">
            <h3>My NPS Feedback</h3>
            <p>Basic information that you use in BrandBoost services.</p>
          </div>
          
          <div class="p20"> 
          <div class="row">
          	<div class="col-xs-6">
          		<div class="tdropdown ml0"> <a style="margin:0!important;" class="dropdown-toggle fsize12 txt_grey" data-toggle="dropdown" aria-expanded="false"> Sort by date <i class="icon-arrow-down22"></i></a>
					<ul style="left: 0px!important; margin-top: 15px; left: auto;" class="dropdown-menu dropdown-menu-left chat_dropdown">
					  <li><strong><a class="active" style="cursor: pointer;"><img class="small" src="<?php echo base_url(); ?>assets/images/cd_icon1.png"> All (1) </a></strong></li>
					  <li><strong><a style="cursor: pointer;"><img class="small" src="<?php echo base_url(); ?>assets/images/cd_icon3.png">Active (1) </a></strong></li>
					  <li><strong><a style="cursor: pointer;"><img class="small" src="<?php echo base_url(); ?>assets/images/cd_icon2.png">Inactive (0) </a></strong></li>
					</ul>
				  </div>
          	</div>
          	<!-- <div class="col-xs-6">
          		<a class="pull-right txt_grey fsize12" style="cursor: pointer;"><i><img style="vertical-align: top; margin-top: 4px" src="<?php echo base_url(); ?>assets/profile_images/edit_icon.png" width="12"></i> &nbsp; Edit</a>
          	</div> -->
          </div>
          
          	
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">

            <?php //pre($oFeedbacks);
            if(!empty($oFeedbacks)) {
            ?>
            <table id="npsTable" style="width: 100%;">

            <thead>
              <tr>
                <th style="display: none;"></th>
                <th class="nosort" style="display: none;"></th>
              </tr>
            </thead>
            <tbody>
          
    		

                <?php foreach($oFeedbacks as $value) {
                    //pre($value);

                    if($value->score > 7) {
                        $sStatus = "Positive";
                        $sImage = 'smiley_green.png';
                    }
                    else if($value->score <= 7 && $value->score >= 4){
                        $sStatus = "Neutral";
                        $sImage = 'smiley_yellow.png';
                    }
                    else {
                        $sStatus = "Negative";
                        $sImage = 'smiley_red.png';
                    }

                    $created_at = date('d M Y', strtotime($value->created_at));
                    $created_time = date('h:i A', strtotime($value->created_at));
					
                    ?>
                    <tr>
                      <td style="display: none;"><?php echo $value->id; ?></td>
                      <td>
                      <ul class="nps_feedback">
    			<li>
    			<div class="pull-left">
    			    <div class="media-left"><img class="mt5" src="<?php echo base_url(); ?>assets/profile_images/<?php echo $sImage; ?>"/></div>
    				<div class="media-left"><p><strong><?php echo $value->score; ?></strong></p> <p><?php echo $sStatus; ?></p></div>	
    			</div>
    			
    			<div class="pull-right">
    			    <div class="media-left text-right pr40"><p><strong><?php echo $value->title != ''?$value->title:'N/A'; ?></strong></p> <p> <?php echo $value->feedback != ''?$value->feedback:'N/A'; ?> </p></div>
    				<div class="media-left text-right pr30"><p><strong><?php echo $created_at; ?></strong></p> <p><?php echo $created_time; ?></p></div>
    				<div class="media-left p0">
    				<div class="tdropdown mt5"> <a class="table_more dropdown-toggle" data-toggle="dropdown"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a>
						<ul style="right: 0;" class="dropdown-menu dropdown-menu-right status">
						  
						  <li><a href="<?php echo base_url(); ?>user/nps/reports/<?php echo $value->id; ?>"><i class="icon-primitive-dot txt_green"></i> Report</a> </li>
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
		var tableId = 'npsTable';
		var tableBase = custom_user_data_table(tableId, 0, 'desc');
    });
  </script>