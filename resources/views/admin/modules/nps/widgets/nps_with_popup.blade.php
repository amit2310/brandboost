<div id="bbnpspopup" style="display:none;">
	<div class="bb-loaded">&nbsp;</div>
	<div class="bb_nps_widget">
		<div class="bbratingbox">
			<div class="bb_nps_main_box">
				<div class="bb_nps_product_icon" style="display:{{ $oNPS->display_logo == '1' ? 'block' : 'none' }};"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/{{ $oNPS->brand_logo }}" onerror="this.src='{{ base_url('assets/images/default_table_img2.png') }}'"></div>
				<h5 class="bb_nps_heading" style="color:{{ $oNPS->web_text_color == '' ? '#000000' : $oNPS->web_text_color }};">{{ $oNPS->question }}</h5>
				<p class="bb_nps_text" style="display:{{ $oNPS->display_intro == 1 ? 'block' : 'none' }}; color:{{ $oNPS->web_int_text_color == '' ? '#000000' : $oNPS->web_int_text_color }};">{{ $oNPS->description }}</p>
			</div>
			<div class="bb_nps_footer_box">
				<ul class="bb_nps_ratings" id="bb_nps_ratings">
					@for ($i = 0; $i <= 10; $i++)
						<li><a href="javascript:void(0);" class="bb_nps_rating bbsurveybtn" rating_value="{{ $i }}" btn_color="{{ $oNPS->web_button_color == '' ? '#636363' : $oNPS->web_button_color }}" btn_text_color="{{ $oNPS->web_button_text_color == '' ? '#FFFFFF' : $oNPS->web_button_text_color }}" over_btn_color="{{ $oNPS->web_button_over_color == '' ? '#dfdfdf' : $oNPS->web_button_over_color }}" over_btn_text_color="{{ $oNPS->web_button_over_text_color == '' ? '#636363' : $oNPS->web_button_over_text_color }}" style="background:{{ $oNPS->web_button_color == '' ? '#636363' : $oNPS->web_button_color }}; color:{{ $oNPS->web_button_text_color == '' ? '#FFFFFF' : $oNPS->web_button_text_color }};">{{ $i }}</a></li>
					@endfor
				</ul>
			</div>
		</div>
		
		<div class="bb_forms" style="display:none;">
			<div class="bb_overlay"><img src="{{ base_url() }}/assets/images/widget_load.gif" width="60" height="60"></div>
			<div class="bb_nps_main_box">
				<div class="bb_nps_product_icon"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/{{ $oNPS->brand_logo }}" onerror="this.src='{{ base_url('assets/images/default_table_img2.png') }}'"></div>
				<div class="bb-hidden bb_txt_success">Thank you for your feedback!</div>
				<div class="bb-hidden bb_txt_danger">Something went wrong.</div>
				<div class="bb_nps_form">
					<input type="hidden" name="bb-account-id" id="bb-account-id" value="{{ $oNPS->hashcode }}" >
					<input type="hidden" name="bb-score-val" id="bb-score-val" value="" >
					<div class="">
						<input name="bbnpsname" id="bbnpsname" placeholder="Your Name" class="bb_nps_input" required="" type="text" value="{{ $oSubscriber == '' ? '' : $oSubscriber->firstname . ' ' . $oSubscriber->firstname }}">
					</div>
					<div class="">
						<input name="bbnpsemail" id="bbnpsemail" placeholder="Your Email" class="bb_nps_input" required="" type="text" value="{{ $oSubscriber == '' ? '' : $oSubscriber->email }}">
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