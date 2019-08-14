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
				<div class="p20 bbot" id="npsScriptCode">
<pre class="prettyprint" id="prettyprint">
&lt;script 
type="text/javascript" 
id="bbscriptloader" 
data-key="<?php echo $widgetData->hashcode; ?>" 
data-widgets="referral" 
async="" 
src="<?php echo base_url('assets/js/ref_widgets.js'); ?>"&gt;
&lt;/script&gt;
</pre>
					<div style="display: none;" class="prettyprintDiv">&lt;script type="text/javascript" id="bbscriptloader" data-key="<?php echo $widgetData->hashcode; ?>" data-widgets="referral" async="" src="<?php echo base_url('assets/js/ref_widgets.js'); ?>"&gt; &lt;/script&gt;</div>
				</div>
				<div class="p20 text-right">
					<button class="btn btn-xs btn_white_table pl10 pr10" onclick="copyToClipboard('.prettyprintDiv')">Copy Code</button>
				</div>
				
			</div>
		</div>
	</div>
</div>

<div class="row pull-right">
	<div class="col-md-12">
		<a href="javascript:void(0);" class="btn dark_btn mt30" onclick="publishReferralWidget('<?php echo $widgetData->id; ?>');">Publish</a>
	</div>
</div>

<script>
function publishReferralWidget(widgetId){
	$.ajax({
		url: "<?php echo base_url(); ?>admin/modules/referral/publishReferralWidget",
		method: "POST",
		data: {'widget_id' : widgetId, _token: '{{csrf_token()}}'},
		dataType: "json",
		success: function (data)
		{
			if (data.status == "success")
			{
				window.location.href = '<?php echo base_url('admin/modules/referral/widgets'); ?>';
			} else {
				displayMessagePopup('error');
			}
		}
	});
}
</script>

