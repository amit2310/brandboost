<style>
	.box .col-md-2.review_source_new {	max-width: 100%;	width: 210px; margin-bottom: 10px;}
	.box .col-md-2.review_source_new .inner	{ border: 1px solid #f4f6fa; min-height: auto;}
	.box .col-md-2.review_source_new .inner .text_sec{padding: 15px 0 0;}
	.box .col-md-2.review_source_new .inner .text_sec img{width: 10px; height: 10px; vertical-align: top;margin-top: 3px;}
</style>
<?php
	//pre($galleryData);
	$widgetType = $galleryData->gallery_design_type;
?>
<div class="box smart-widget-type-box" style="width: 680px; z-index:11;">
    <div style="width: 680px;overflow: hidden; height: 100%;">
        <div style="height: 100%; overflow-y:auto; overflow-x: hidden;">
			
            <div class="row" style="height: 100%;">
                <div class="col-md-12">
                    <a style="left: 35px; top: 15px;" class="reviews smart-widget-type slide-toggle bkg_grey_light" ><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_arrow_left.png"/></i></a> 
                    <h5 style="padding-left: 75px;" class="panel-title">Choose Gallery Widget Design</h5>
				</div>
				<div class="col-md-12">
                	<div class="p30 pt0 pb0">
						<div class="bbot pb20 pt20">
							<h3 class="m0 fsize20 txt_dark">Choose Gallery Widget Design</h3>
							<p class="m0 fsize14 txt_grey fw300">Choose type of item you want to create</p>
						</div>
					</div>
				</div>
                <div class="col-md-12">
					<div class="row p30">
						<div class="col-md-2 review_source_new onerowCWBox" current-class="onerow">
							<label for="radiocheck_sp_1">
								<div class="inner <?php echo $widgetType == 'onerow' ? 'active' : ''; ?>">
									<span class="custmo_checkbox checkboxs">
										<input id="radiocheck_sp_1" type="radio" name="widgetDesignType" class="selectwidget1" widget-id="onerow" <?php echo $widgetType == 'onerow' ? 'checked="checked"' : ''; ?>>
										<span class="custmo_checkmark purple"></span>
									</span>
									<figure><img src="<?php echo base_url(); ?>assets/images/media_inline_4.png"/></figure>
									<div class="text_sec">
										<p><strong>Single Row Gallery</strong></p>
									</div>
								</div>
							</label>
						</div>
						
						<div class="col-md-2 review_source_new squareCWBox" current-class="square">
							<label for="radiocheck_sp_2">
								<div class="inner <?php echo $widgetType == 'square' ? 'active' : ''; ?>">
									<span class="custmo_checkbox checkboxs">
										<input id="radiocheck_sp_2" type="radio" name="widgetDesignType" class="selectwidget1" widget-id="square" <?php echo $widgetType == 'square' ? 'checked="checked"' : ''; ?>>
										<span class="custmo_checkmark purple"></span>
									</span>
									<figure><img src="<?php echo base_url(); ?>assets/images/media_square_4.png"/></figure>
									<div class="text_sec">
										<p><strong>Square Gallery</strong></p>
									</div>
								</div>
							</label>
						</div>
						
						<div class="col-md-2 review_source_new horizontalCWBox" current-class="horizontal">
							<label for="radiocheck_sp_3">
								<div class="inner <?php echo $widgetType == 'horizontal' ? 'active' : ''; ?>">
									<span class="custmo_checkbox checkboxs">
										<input id="radiocheck_sp_3" type="radio" name="widgetDesignType" class="selectwidget1" widget-id="horizontal" <?php echo $widgetType == 'horizontal' ? 'checked="checked"' : ''; ?>>
										<span class="custmo_checkmark purple"></span>
									</span>
									<figure><img src="<?php echo base_url(); ?>assets/images/media_square_6.png"/></figure>
									<div class="text_sec">
										<p><strong>Horizontal Gallery</strong></p>
									</div>
								</div>
							</label>
						</div>
						
						<div class="col-md-2 review_source_new verticalCWBox" current-class="vertical">
							<label for="radiocheck_sp_4">
								<div class="inner <?php echo $widgetType == 'vertical' ? 'active' : ''; ?>">
									<span class="custmo_checkbox checkboxs">
										<input id="radiocheck_sp_4" type="radio" name="widgetDesignType" class="selectwidget1" widget-id="vertical" <?php echo $widgetType == 'vertical' ? 'checked="checked"' : ''; ?>>
										<span class="custmo_checkmark purple"></span>
									</span>
									
									<figure><img src="<?php echo base_url(); ?>assets/images/media_square_6_vert.png"/></figure>
									<div class="text_sec">
										<p><strong>Vertical Gallery</strong></p>
									</div>
								</div>
							</label>
						</div>
						
					</div>
				</div>
				
				<div class="col-md-12">
                	<div class="p30 pt0 pb0">
                	<div class="btop pb20 pt20">
                		<button type="button" class="btn dark_btn h52 bkg_purple mr20 chooseWidget smart-widget-type">Save Widget</button>
                		<button style="min-width:120px;" type="button" class="btn white_btn h52 smart-widget-type">Close</button>
                		</div>
                	</div>
                </div>
			</div>
		</div>					
	</div>
</div>

<script>
    $(document).ready(function () {
        $(".smart-widget-type").click(function () {
            $(".smart-widget-type-box").animate({
                width: "toggle"
			});
		});
	});
    
</script>