<?php list($canRead, $canWrite) = fetchPermissions('Onsite Campaign'); ?>
<div class="tab-pane <?php echo $integrationClass; ?>" id="right-icon-tab5">
	<div class="row">
		<div class="col-md-3">
			<div style="margin: 0;" class="panel panel-flat">
				<div class="panel-heading">
					<h6 class="panel-title">How to add widget</h6>
				</div>
				<div class="panel-body p0">
					<div class="embed-responsive embed-responsive-16by9">
						<iframe class="embed-responsive-item br0"  src="https://www.youtube.com/embed/2H_Jsgh2Z3Y?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-md-6">
			<div style="margin: 0;" class="panel panel-flat">
				<div class="panel-heading">
					<h6 class="panel-title">You’re All Set!</h6>
				</div>
				<div class="panel-body min_h270 p20">
					<p><span class="txt_dark">Descriptions List</span><br><small class="text-muted text-size-small">So strongly and metaphysically did I conceive of my situati.</small></p>
					<p><span class="txt_dark">Euismod</span><br><small class="text-muted text-size-small">In the tumultuous business of cutting-in and attending to a whale, there.</small></p>
					<p><span class="txt_dark">Descriptions List</span><br><small class="text-muted text-size-small">So strongly and metaphysically did I conceive of my situati.</small></p>
					<p><span class="txt_dark">Euismod</span><br><small class="text-muted text-size-small">In the tumultuous business of cutting-in and attending to a whale, there.</small></p>
					
				</div>
			</div>
		</div>
		
		<div class="col-md-3">
			<div style="margin: 0;" class="panel panel-flat">
				<div class="panel-heading">
					<h6 class="panel-title">How to add widget</h6>
				</div>
				<div class="panel-body min_h270 p0">
					<div class="p20 bbot">
						<pre class="prettyprint">
							<?php echo htmlentities('<script type="text/javascript" id="bbscriptloader" data-key="'.$campaign_key.'" data-widgets="'.$sWidget.'" async="" src="'.base_url('assets/js/widgets.js').'"></script>'); ?>
						</pre>
					</div>
					<div class="p20 text-right">
						<button class="btn btn-xs btn_white_table pl10 pr10">Copy Code</button>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12 text-right">
			<?php if($canWrite == TRUE): ?>
			<button <?php if ($bActiveSubsription == false) { ?> class="btn dark_btn mt20 pDisplayNoActiveSubscription" title="No Active Subscription" type="button" <?php } else { ?> type="submit" class="btn dark_btn mt20" <?php } ?> id="continueImageTab"> Continue <i class=" icon-arrow-right13 text-size-base position-right"></i></button>
			<?php endif; ?>	
		</div>
	</div>
		
</div>