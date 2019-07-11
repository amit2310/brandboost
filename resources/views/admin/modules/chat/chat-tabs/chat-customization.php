<link href="<?php echo base_url(); ?>assets/dropzone-master/dist/dropzone.css" type="text/css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/dropzone-master/dist/dropzone.js"></script>
<div class="tab-pane <?php echo ($defalutTab == 'customize')? 'active': '';?>" id="right-icon-tab3">

<style type="text/css">
    .dropzone .dz-default.dz-message:before { content: ''!important; }
    .dropzone {min-height:40px;}
    .dropzone .dz-default.dz-message{ top: 0%!important; height:40px;  margin-top:0px;}
    .dropzone .dz-default.dz-message span {    font-size: 13px;    margin-top: -10px;}
    .product_icon img{ width: 50px; height: 50px; border-radius: 100px;}
    .dropzone .dz-default.dz-message:before {font-size: 80px; top: 48px; width: 0px; height: 0px; margin-left: -32px;}</style>

	<?php //pre($oChat); ?>
	<div class="row">
	  <div class="col-md-3">
		<div style="margin: 0;" class="panel panel-flat">
		  <div class="panel-heading">
			<h6 class="panel-title">Configurations</h6>
			<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
		  </div>
		  <div class="panel-body p0">
			<div class="profile_sec">
                <form method="post" name="frmSubmit" id="frmSubmit" action="javascript:void(0);"  enctype="multipart/form-data">
				<div class="profile_headings">Components <a class="pull-right plus_icon" href="#"><i class="icon-plus3"></i></a></div>
				<div class="interactions configurations p25">
				<ul class="chatwidgetsettings">
					<li><small class="wauto">Logo</small> 
						<span class="pull-right">
							<label class="custom-form-switch mr0 pull-right">
								<input class="field" type="checkbox" name="logo_show" <?php echo $oChat->logo_show == 1? 'checked':''; ?>>
								<span class="toggle blue"></span>
							</label>
						 </span>
				    </li>
					<li><small class="wauto">Title</small> 
					<span class="pull-right">
							<label class="custom-form-switch mr0 pull-right">
								<input class="field" type="checkbox" name="title_show" <?php echo $oChat->title_show == 1? 'checked':''; ?>>
								<span class="toggle blue"></span>
							 </label>
						 </span>
					</li>
					<li><small class="wauto">Sub Title</small> 
					<span class="pull-right">
						<label class="custom-form-switch mr0 pull-right">
							<input class="field" type="checkbox" name="subtitle_show" <?php echo $oChat->subtitle_show == 1? 'checked':''; ?>>
							<span class="toggle blue"></span>
						 </label>
					</span>
					</li>
					<li><small class="wauto">Attachment</small> 
					<span class="pull-right">
						<label class="custom-form-switch mr0 pull-right">
							<input class="field" type="checkbox" name="atttachment_show" <?php echo $oChat->atttachment_show == 1? 'checked':''; ?>>
							<span class="toggle blue"></span>
						 </label>
					</span>
					</li>
					<li><small class="wauto">Smilie</small> 
					
					<span class="pull-right">
						<label class="custom-form-switch mr0 pull-right">
							<input class="field" type="checkbox" name="smilie_show" <?php echo $oChat->smilie_show == 1? 'checked':''; ?>>
							<span class="toggle blue"></span>
						</label>
					</span>
					
					</li>
					<!-- <li><small class="wauto">Chat status</small> 
					<span class="pull-right">
							<label class="custom-form-switch mr0 pull-right">
								<input class="field" type="checkbox" <?php echo $oChat->logo_show == 1? 'checked':''; ?>>
								<span class="toggle blue"></span>
							</label>
						 </span>
					</li> -->
					<div class="clearfix"></div>
				</ul>
			</div>
			
				
				<div class="profile_headings">Chat Details <a class="pull-right plus_icon" href="#"><i class="icon-plus3"></i></a></div>
				
				<div class="configurations p25">
					<div class="form-group">
					  <label class="control-label">Domain</label>
					  <div class="input-group">
					    <span class="input-group-addon">@</span>
						<input name="domain" id="domain" class="form-control" placeholder="www.google.com" value="<?php echo $oChat->domain; ?>" type="text">
					  </div>
					</div>
					
					<div class="form-group">
					  <label class="control-label">Title</label>
					  <div class="">
						<input name="title" placeholder="New Chat Title" id="title" class="form-control" value="<?php echo $oChat->title; ?>" required="" type="text">
					  </div>
					</div>
					<div class="form-group">
					  <label class="control-label">Description</label>
					  <div class="">
						<textarea class="form-control" name="description" id="description"><?php echo $oChat->title; ?></textarea>
					  </div>
					</div>
                                   

					<div class="form-group">
					  <label class="control-label">Chat Logo</label>
					  <div class="input-group">
						<span class="input-group-addon"><i class="icon-upload7"></i></span>
						<div class="dropzone" id="myDropzone_logo_img"></div>
                        <input style="display: none;" type="text" name="chat_logo" id="chat_logo" value="<?php echo (!empty($oChat->chat_logo)) ? $oChat->chat_logo : ''; ?>" >
					  </div>
					</div>
					
				</div>
				
				
				
				<input type="hidden" name="chat_id" value="<?php echo $oChat->id; ?>" />
				<div class="p25 text-center btop">
					<button type="submit" class="btn dark_btn w100 bkg_blue" >Save</button>
				</div>
				
				</form>
			</div>
		  </div>
		</div>
	  </div>
	  <div class="col-md-9">
		<div style="margin: 0;" class="panel panel-flat">
		  <div class="panel-heading">
			<h6 class="panel-title pull-left display-inline-block">Preview</h6> &nbsp; &nbsp; 
				<h6 class="panel-title display-inline-block"><a href="#"><i class="icon-rotate-ccw3"></i>&nbsp; Undo</a></h6> &nbsp; &nbsp; 
				<h6 class="panel-title display-inline-block"><a href="#"><i class="icon-rotate-cw3"></i>&nbsp; Redo</a></h6>
				
				<div class="heading-elements">
				<h6 class="panel-title display-inline-block"><a class="active" href="#"><i class="icon-display"></i>&nbsp; Desktop </a></h6>
				<h6 class="panel-title display-inline-block"><a href="#"><i class="icon-ipad"></i>&nbsp; Tablet</a></h6>
				<h6 class="panel-title display-inline-block"><a href="#"><i class="icon-iphone"></i>&nbsp; Mobile</a></h6>
				</div>
			
		  </div>
		  <div class="panel-body p20">
			<div class="widget_sec">
			<!--========review_widget================-->
			<div class="chat_widget_bot_right chatbox">
				<div class="white_box">
					<p>Trevor from Grin</p>
					<p><span>Hi! Do you know about our new offer for startups & small business? </span></p>
					<div class="image_icon">
						<img src="/assets/images/face3.jpg"/>
					</div>
				</div>
				<div class="white_box">
					<p>Trevor from Grin</p>
					<p><span>💥 We give you 3 month free trial!</span></p>
				</div>
				<div class="mb-15">
					<input type="text" name="" class="form-control" placeholder="Type a message here...">
				</div>
				<div>
					<div class="chat_action_icon_white pull-right">
						<div class="iconbox">X</div>
						<div class="badge chat badge-danger">2</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<!--========review_widget end================-->
			
			<img class="w100" src="/assets/images/config_bkg.png"/>
				
			</div>
		  </div>
		</div>
	  </div>
	</div>
  </div>