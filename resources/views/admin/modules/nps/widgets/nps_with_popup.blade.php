<?php //pre($oSubscriber); exit; ?>
<div id="bbnpspopup" style="display:none;">
	<div class="bb-loaded">&nbsp;</div>
	<div class="bb_nps_widget">
		<div class="bbratingbox">
			<div class="bb_nps_main_box">
				<div class="bb_nps_product_icon" style="display:<?php echo $oNPS->display_logo == '1' ? 'block' : 'none'; ?>;"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $oNPS->brand_logo; ?>" onerror="this.src='<?php echo base_url('assets/images/default_table_img2.png'); ?>'"></div>
				<h5 class="bb_nps_heading" style="color:<?php echo $oNPS->web_text_color == '' ? '#000000' : $oNPS->web_text_color; ?>;"><?php echo $oNPS->question; ?></h5>
				<p class="bb_nps_text" style="display:<?php echo $oNPS->display_intro == 1 ? 'block' : 'none'; ?>; color:<?php echo $oNPS->web_int_text_color == '' ? '#000000' : $oNPS->web_int_text_color; ?>;"><?php echo $oNPS->description; ?></p>
			</div>
			<div class="bb_nps_footer_box">
				<ul class="bb_nps_ratings" id="bb_nps_ratings">
					<?php for ($i = 0; $i <= 10; $i++): ?>
					<li><a href="javascript:void(0);" class="bb_nps_rating bbsurveybtn" rating_value="<?php echo $i; ?>" btn_color="<?php echo $oNPS->web_button_color == '' ? '#636363' : $oNPS->web_button_color; ?>" btn_text_color="<?php echo $oNPS->web_button_text_color == '' ? '#FFFFFF' : $oNPS->web_button_text_color; ?>" over_btn_color="<?php echo $oNPS->web_button_over_color == '' ? '#dfdfdf' : $oNPS->web_button_over_color; ?>" over_btn_text_color="<?php echo $oNPS->web_button_over_text_color == '' ? '#636363' : $oNPS->web_button_over_text_color; ?>" style="background:<?php echo $oNPS->web_button_color == '' ? '#636363' : $oNPS->web_button_color; ?>; color:<?php echo $oNPS->web_button_text_color == '' ? '#FFFFFF' : $oNPS->web_button_text_color; ?>;"><?php echo $i; ?></a></li>
					<?php endfor; ?>
				</ul>
			</div>
		</div>
		
		<div class="bb_forms" style="display:none;">
			<div class="bb_overlay"><img src="<?php echo base_url(); ?>/assets/images/widget_load.gif" width="60" height="60"></div>
			<div class="bb_nps_main_box">
				<div class="bb_nps_product_icon"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $oNPS->brand_logo; ?>" onerror="this.src='<?php echo base_url('assets/images/default_table_img2.png'); ?>'"></div>
				<div class="bb-hidden bb_txt_success">Thank you for your feedback!</div>
				<div class="bb-hidden bb_txt_danger">Something went wrong.</div>
				<div class="bb_nps_form">
					<input type="hidden" name="bb-account-id" id="bb-account-id" value="<?php echo $oNPS->hashcode; ?>" >
					<input type="hidden" name="bb-score-val" id="bb-score-val" value="" >
					<div class="">
						<input name="bbnpsname" id="bbnpsname" placeholder="Your Name" class="bb_nps_input" required="" type="text" value="<?php echo $oSubscriber == '' ? '' : $oSubscriber->firstname . ' ' . $oSubscriber->firstname; ?>">
					</div>
					<div class="">
						<input name="bbnpsemail" id="bbnpsemail" placeholder="Your Email" class="bb_nps_input" required="" type="text" value="<?php echo $oSubscriber == '' ? '' : $oSubscriber->email; ?>">
					</div>
					<div class="">
						<input name="feedbackTitle" id="bbnpstitle" placeholder="Title" class="bb_nps_input" required="" type="text">
					</div>
					<div class="">
						<textarea name="feedbackDesc" id="bbnpsdesc" class="bb_nps_textarea bb_nps_input" placeholder="Write brief details here"></textarea>
					</div>
					<div class="bb_nps_submit">
						<input class="bbnpssubmit bb_nps_submit_a" name="bbnpssubmit" id="bbnpssubmit" value="Submit" type="button">
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>	