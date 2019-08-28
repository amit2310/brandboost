<form method="post" name="frmSubmit" id="frmSubmitPreferences" action="javascript:void(0);"  enctype="multipart/form-data">
	@csrf
	<input type="hidden" name="chat_id" value="<?php echo $oChat->id; ?>" />
	<div class="row">
		<div class="col-md-3">
			<div style="margin: 0;" class="panel panel-flat">
				<div class="panel-heading">
					<h6 class="panel-title">Availability</h6>
					<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
				</div>
				<div class="panel-body p0">
					<div class="p25 bbot">
						<div>
							<span class="fsize12 text-muted pull-left">Set working hours</span>
							<label class="custom-form-switch mr0 pull-right">
								<input class="field" type="checkbox" checked>
								<span class="toggle blue"></span>
							</label>
							<div class="clearfix"></div>	
						</div>
					</div>
					
					<div class="configurations bbot p25">
						
						<div class="form-group">
							<label class="control-label">Review Request "Form" Name</label>
							<div class="">
								<input name="firstname" placeholder="Mr Anderson" id="firstname" class="form-control" type="text">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label">Review Request "Form" Email</label>
							<div class="">
								<input name="firstname" placeholder="umair@nethues.com" id="firstname" class="form-control" type="text">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">SMS Sender Name</label>
							<div class="">
								<input name="firstname" placeholder="Mr Anderson" id="firstname" class="form-control" type="text">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Review Request Language </label>
							<div class="">
								<select class="form-control">
									<option>English (USA)</option>
								</select>
							</div>
						</div>
					</div>
					
					<div class="p25 bbot">
						<!--<div class="form-group mb0">
							<label class="radio-inline">
							<input type="radio" name="radio-inline-left" class="styled" checked="checked">
							Happy Ratings
							</label>
							<label class="radio-inline">
							<input type="radio" name="radio-inline-left" class="styled">
							Star Ratings
							</label>
						</div>-->
						
						<div class="">
							<label class="custmo_radiobox pull-left mr-20">
								<input type="radio" name="rad13" checked>
								<span class="custmo_radiomark"></span>
							Happy Ratings</a>
						</label>
						
						
						
						<label class="custmo_radiobox pull-left">
							<input type="radio" name="rad13" >
							<span class="custmo_radiomark"></span>
						Star Ratings</a>
					</label>
					<div class="clearfix"></div>
				</div>
			</div>
			
			<div class="p25">
				<a class="mr10" href="#"><img src="/assets/images/yello_smile1.png"></a>
				<a class="mr10" href="#"><img src="/assets/images/yello_smile2.png"></a>
				<a class="mr10" href="#"><img src="/assets/images/yello_smile3.png"></a>
				<a class="mr10" href="#"><img src="/assets/images/yello_smile4.png"></a>
				<a class="mr10" href="#"><img src="/assets/images/yello_smile5.png"></a>
			</div>
		</div>
	</div>
</div>

<div class="col-md-6">
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h6 class="panel-title">Automation</h6>
			<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
		</div>
		<div class="panel-body p0">
	   		<div class="p25 bbot">
				<span class="fsize12 text-muted pull-left">Activite automated messages</span>
				<label class="custom-form-switch ml30">
					<input name="automated_message" class="field" type="checkbox" <?php echo $oChat->automated_message == '1'?'checked' : ''; ?>>
					<span class="toggle blue"></span>
				</label>
				<div class="clearfix"></div>	
			</div>
			<?php //pre($oChat); ?>
			<div class="p0">
				<div class="">
					<div class="panel-group panel-group-control panel-group-control-right content-group-lg filter_campaign" id="accordion-control-right">
						
						<div class="panel panel-white">
							<div class="panel-heading sidebarheadings smallaccordion active">
								<h6 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group1"><i class=" icon-bubble-lines3"></i>&nbsp;Greeting</a> </h6>
							</div>
							<div id="accordion-control-right-group1" class="panel-collapse collapse in">
								<div class="panel-body p25">
									<div class="row">
										<div class="col-md-12">
											<?php 
												$showMessages = unserialize($oChat->messages);
												$showTime = unserialize($oChat->time); 
												if(!empty($showMessages)) {
													foreach ($showMessages as $key => $value) {
													?>
													<span class="showMsg">
														<div class="form-group">
															<label>Message</label>
															<textarea class="form-control" name="messages[]" placeholder="Hi! We are ready to help you. Ask us anything or share your feedback."><?php echo $value; ?></textarea>
														</div>
														<div class="form-group">
															<div style="max-width: 170px;" class="input-group pull-left">
																<span class="input-group-addon"><i class="icon-alarm"></i></span>
																<input class="form-control" placeholder="Wait for 5 Sec" name="time[]" type="text" value="<?php echo $showTime[$key]; ?>">
															</div>
															<?php if($key != '0') { ?>
																<button type="button" class="btn white_btn ml20 h40 p10 removeMessage" ><i class="icon-minus3"></i></button>
															<?php } ?>
															<?php 
																if(end($showMessages) == $value) {
																	?><button type="button" class="btn white_btn ml20 h40 p10 addMoreMessage" ><i class="icon-plus3"></i></button><?php
																}
																else {
																	?><button type="button" style="display: none;" class="btn white_btn ml20 h40 p10 addMoreMessage" ><i class="icon-plus3"></i></button><?php
																} ?>
																<div class="clearfix"></div>
														</div>
														<div class="clearfix"></div>
													</span>
													<?php
													}
													
												}
												else {
												?>
												<span class="showMsg">
													<div class="form-group">
														<label>Message</label>
														<textarea class="form-control" name="messages[]" placeholder="Hi! We are ready to help you. Ask us anything or share your feedback."></textarea>
													</div>
													<div class="form-group">
														<div style="max-width: 170px;" class="input-group pull-left">
															<span class="input-group-addon"><i class="icon-alarm"></i></span>
															<input class="form-control" placeholder="Wait for 5 Sec" name="time[]" type="text">
														</div>
														<button type="button" class="btn white_btn ml20 h40 p10 addMoreMessage" ><i class="icon-plus3"></i></button>
														<div class="clearfix"></div>
													</div>
													<div class="clearfix"></div>
												</span>
												
												<?php
												}
											?>
											
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="panel panel-white">
							<div class="panel-heading sidebarheadings smallaccordion">
								<h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group2"><i class="icon-alarm"></i>&nbsp; After 120 sec.</a> </h6>
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
							<div class="panel-heading sidebarheadings smallaccordion">
								<h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group73"><i class="icon-arrow-up-left2"></i>&nbsp; Open "About Us" page</a> </h6>
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
							<div class="panel-heading sidebarheadings smallaccordion">
								<h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group74"><i class="icon-user"></i>&nbsp; Previous visits: 3</a> </h6>
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
							<div class="panel-heading sidebarheadings smallaccordion">
								<h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group83"><i class="icon-arrow-up-left2"></i>&nbsp; Click button</a> </h6>
							</div>
							<div id="accordion-control-right-group83" class="panel-collapse collapse">
								<div class="panel-body">
									sdhtjrg
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
		</div>
	</div>
</div>

<div class="col-md-3">
	<div style="margin: 0;" class="panel panel-flat">
		<div class="panel-heading">
			<h6 class="panel-title">Inbound conversations</h6>
			<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
		</div>
		<div class="panel-body p0">
			<div class="p25 bbot">
				<span class="fsize12 text-muted pull-left">New Chat Button</span>
				<label class="custom-form-switch mr0 pull-right">
					<input class="field" type="checkbox" name="chatButton" checked>
					<span class="toggle blue"></span>
				</label>
				<div class="clearfix"></div>	
			</div>
			
			<div class="p25 bbot">
				<span class="fsize12 text-muted pull-left">Show Contact Details</span>
				<label class="custom-form-switch mr0 pull-right">
					<input class="field" type="checkbox" name="contact_details_config" <?php echo $oChat->contact_details_config == '1' ? 'checked' : ''; ?>>
					<span class="toggle blue"></span>
				</label>
				<div class="clearfix"></div>	
			</div>
			
			<!-- 
			<div class="p25 configurations  bbot">
				<div class="form-group mb0">
					<label class="control-label mb20">Automatically expire link after user leaves review?</label>
					<div class="clearfix"></div>
					
					<div class="">
						<label class="custmo_radiobox pull-left mr-20">
							<input type="radio" name="rad1" checked>
							<span class="custmo_radiomark"></span>
							Yes
						</label>
						<label class="custmo_radiobox pull-left">
							<input type="radio" name="rad1" >
							<span class="custmo_radiomark"></span>
							No
						</label>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			
			<div class="p25 configurations ">
				<div class="form-group mb0">
					<label class="control-label mb20">Automatically expire link </label>
					<div class="clearfix"></div>
					
					<label class="custmo_radiobox mb20">
						<input type="radio" name="rad2" checked>
						<span class="custmo_radiomark"></span>
						Never Expire
					</label>
					
					
					<label class="custmo_radiobox">
						<input type="radio" name="rad2" >
						<span class="custmo_radiomark"></span>
						Expire After
					</label>
					<div class="clearfix"></div>
				</div>
			</div>
			-->
		</div>
	</div>
</div>

</div>
<div class="row pull-right">
	<div class="col-md-12">
        <button  type="submit" class="btn dark_btn mt30" >Save</button>
	</div>
</div>
</form>
