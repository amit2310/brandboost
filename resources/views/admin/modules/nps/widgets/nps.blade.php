<div id="bbnpspopup" style="display:none;">
	<div class="bb-loaded">&nbsp;</div>
	<div class="nps_bb_bot_widget" id="nps_bb_bot_widget">
		<a class="bb_nps_widget_close" href="JavaScript:Void(0);"><i class="fa fa-times-circle"></i></a>
		<div class="bb_nps_product_icon" style="display:{{ $oNPS->display_logo == '1' ? 'block' : 'none' }};"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/{{ $oNPS->brand_logo }}" onerror="this.src='{{ base_url('assets/images/default_table_img2.png') }}'"></div>
		<h3 class="bb_nps_heading" style="color:{{ $oNPS->web_text_color == '' ? '#000000' : $oNPS->web_text_color }};">{{ $oNPS->question }}</h3>
		<p class="bb_nps_text" style="display:{{ $oNPS->display_intro == 1 ? 'block' : 'none' }}; color:{{ $oNPS->web_int_text_color == '' ? '#000000' : $oNPS->web_int_text_color }};">{{ $oNPS->description }}</p>
		
		<div class="nps_bb_footer_box">
			<ul class="bb_nps_ratings" id="bb_nps_ratings">
				<li class="nps_rating_lists">Not Likely</li>
				@for ($i = 0; $i <= 10; $i++)
					<li class="nps_rating_lists"><a href="javascript:void(0);" class="bb_nps_rating bbsurveybtn nps_rating_numbers" rating_value="{{ $i }}" btn_color="{{ $oNPS->web_button_color == '' ? '#FFFFFF' : $oNPS->web_button_color }}" btn_text_color="{{ $oNPS->web_button_text_color == '' ? '#000000' : $oNPS->web_button_text_color }}" over_btn_color="{{ $oNPS->web_button_over_color == '' ? '#000000' : $oNPS->web_button_over_color }}" over_btn_text_color="{{ $oNPS->web_button_over_text_color == '' ? '#FFFFFF' : $oNPS->web_button_over_text_color }}" style="background:{{ $oNPS->web_button_color == '' ? '#FFF' : $oNPS->web_button_color }}; color:{{ $oNPS->web_button_text_color == '' ? '#000000' : $oNPS->web_button_text_color }};">{{ $i }}</a></li>
				@endfor
				<li class="nps_rating_lists">Very Likely</li>
			</ul>
			<p class="nps_poweredby">Powered by Brandboost.io</p>
		</div>
		
		<div class="bb_forms nps_bb_form_box">
			<div class="bb_overlay" style="display:none;"><img src="{{ base_url() }}/assets/images/widget_load.gif" width="60" height="60"></div>
			<div class="bb_nps_form">
				<div class="bb-hidden bb_txt_danger">Something went wrong.</div>
				<input type="hidden" name="bb-account-id" id="bb-account-id" value="{{ $oNPS->hashcode }}" >
				<input type="hidden" name="bb-score-val" id="bb-score-val" value="" >
				<div class="">
					<input name="bbnpsname" id="bbnpsname" placeholder="Your Name" class="bb_nps_input" required="" type="{{ $oNPS->display_name == 1 ? 'text' : 'hidden' }}" value="{{ $oSubscriber == '' ? '' : $oSubscriber->firstname . ' ' . $oSubscriber->firstname }}">
				</div>
				
				<div class="">
					<input name="bbnpsemail" id="bbnpsemail" placeholder="Your Email" class="bb_nps_input" required="" type="{{ $oNPS->display_email == 1 ? 'text' : 'hidden' }}" value="{{ $oSubscriber == '' ? '' : $oSubscriber->email }}">
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
	<div class="bb_nps_success_box" id="bb_nps_success_box">
		<a class="bb_nps_widget_close bb_nps_widget_close2" href="javaScript:void(0);"><i class="fa fa-times-circle"></i></a>
		<h3>Thank you for your feedback</h3>
		<h4>Would you be willing to share your positive comments?</h4>
		<p>Powered by: <a target="_blank" href="{{ base_url() }}">Brandboost.io</a></p>
	</div>
</div>