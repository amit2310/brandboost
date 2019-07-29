<style>
	.box .col-md-2.review_source_new {	max-width: 100%;	width: 210px; margin-bottom: 10px;}
	.box .col-md-2.review_source_new .inner	{ border: 1px solid #f4f6fa; min-height: auto;}
	.box .col-md-2.review_source_new .inner .text_sec{padding: 15px 0 0;}
	.box .col-md-2.review_source_new .inner .text_sec img{width: 10px; height: 10px; vertical-align: top;margin-top: 3px;}
</style>
<?php
	//$widgetType = $widgetData->widget_type;
?>

<div class="box smart-widget-type-box" style="width: 680px; z-index:11;">
    <div style="width: 680px;overflow: hidden; height: 100%;">
        <div style="height: 100%; overflow-y:auto; overflow-x: hidden;">
			
            <div class="row" style="height: 100%;">
                <div class="col-md-12">
                    <a style="left: 35px; top: 15px;" class="reviews smart-widget-type slide-toggle bkg_grey_light" ><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_arrow_left.png"/></i></a> 
                    <h5 style="padding-left: 75px;" class="panel-title">Choose Template</h5>
				</div>
				<div class="col-md-12">
                	<div class="p30 pt0 pb0">
						<div class="bbot pb20 pt20">
							<h3 class="m0 fsize20 txt_dark">Choose Template</h3>
							<p class="m0 fsize14 txt_grey fw300">Choose type of brand page you want to create</p>
						</div>
					</div>
				</div>
                <div class="col-md-12">
					<div class="row p30">
						<div class="col-md-2 review_source_new bwwCWBox">
						<label for="active_soruce1">
						<div class="inner"> <span class="custmo_checkbox checkboxs">
						<input type="radio" <?php if($brandData->template_style==1){ ?> checked="checked" <?php } ?> class="template_select" value="1" name="template_type" id="active_soruce1">
						<span class="custmo_checkmark red_tr "></span> </span>
						<figure><img src="/assets/images/brand_page1_icon.png"></figure>
						<a class="bot_txt active" href="#">Info & Media</a> </div>
						</label>
						</div>
						<div class="col-md-2 review_source_new bfwCWBox">
						<label for="active_soruce2">
						<div class="inner"> <span class="custmo_checkbox checkboxs">
						<input type="radio" <?php if($brandData->template_style==2){ ?> checked="checked" <?php } ?> class="template_select" value="2" name="template_type"  id="active_soruce2">
						<span class="custmo_checkmark red_tr "></span> </span>
						<figure><img src="/assets/images/brand_page2_icon.png"></figure>
						<a class="bot_txt" href="#">Info & Reviews</a> </div>
						</label>
						</div>
						
						<div class="col-md-2 review_source_new vpwCWBox">
							<label for="active_soruce3">
							<div class="inner"> <span class="custmo_checkbox checkboxs">
							<input type="radio" <?php if($brandData->template_style==3){ ?> checked="checked" <?php } ?> class="template_select" value="3" name="template_type"  id="active_soruce3">
							<span class="custmo_checkmark red_tr "></span> </span>
							<figure><img src="/assets/images/brand_page3_icon.png"></figure>
							<a class="bot_txt" href="#">Info & Media 2</a> </div>
							</label>
						</div>
						
					</div>
				</div>
				
				<div class="col-md-12">
                	<div class="p30 pt0 pb0">
                	<div class="btop pb20 pt20">
                		<button style="min-width:120px;" type="button" class="btn white_btn h52 smart-widget-type-template">Close</button>
                		</div>
                	</div>
                </div>
			</div>
		</div>					
	</div>
</div>   

<script>
    $(document).ready(function () {
        $(".smart-widget-type-template").click(function () {
            $(".smart-widget-type-box").animate({
                width: "toggle"
			});
			
		
		});
	});
    
</script>