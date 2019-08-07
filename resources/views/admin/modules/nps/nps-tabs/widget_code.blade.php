<div class="tab-pane <?php echo ($defalutTab == 'widgets') ? 'active' : ''; ?>" id="right-icon-tab6">
	<?php if($oNPS->platform != 'link'){ ?>
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
						<p>
							<span class="txt_dark">Descriptions List</span><br>
							<small class="text-muted text-size-small">Copy and paste this code snippet into your site</small>
						</p>
						<p>
						<small class="text-muted text-size-small">You can add this snippet anywhere in the <code> &lt;head&gt; and &lt;body&gt; tags </code> section.</small></p>
						<p><small class="text-muted text-size-small">The snippet loads in the background, so it does not impact the performance of your site. (edited)</small></p>
					</div>
				</div>
			</div>
			
			<div class="col-md-3">
				<div style="margin: 0;" class="panel panel-flat">
					<div class="panel-heading">
						<h6 class="panel-title">Widget embedded code</h6>
					</div>
					<div class="panel-body min_h270 p0">
						<div class="p20 bbot">
<pre class="prettyprint">&lt;script 
type='text/javascript' 
id='bbscriptloader' 
data-key='<?php echo $oNPS->hashcode; ?>' 
data-widgets='nps' async='' 
src='<?php echo base_url(); ?>assets/js/nps_widgets.js' &gt; 
&lt;/script&gt;
</pre>
							<div style="display: none;" class="prettyprintDiv">&lt;script type='text/javascript' id='bbscriptloader' data-key='<?php echo $oNPS->hashcode; ?>' data-widgets='nps' async='' src='<?php echo base_url(); ?>assets/js/nps_widgets.js' &gt; &lt;/script&gt;</div>
							
							</div>
							<div class="p20 text-right">
								<button class="btn btn-xs btn_white_table pl10 pr10" id="btnCopyWidget" onclick="copyToClipboard('.prettyprintDiv')">Copy Code</button>
							</div>
							
							</div>
						</div>
					</div>
				</div>
				<?php }else{  ?>
				<div class="row">
					<div class="col-md-3">
						<div style="margin: 0;" class="panel panel-flat">
							<div class="panel-heading">
								<h6 class="panel-title">How to setup link survey</h6>
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
								<p><span class="txt_dark">Descriptions List</span><br><br><small class="text-muted text-size-small">Copy the link url and share with your friends to start your survey. </small></p>
							</div>
						</div>
					</div>
					
					<div class="col-md-3">
						<div style="margin: 0;" class="panel panel-flat">
							<div class="panel-heading">
								<h6 class="panel-title">Link URL code</h6>
							</div>
							<div class="panel-body min_h270 p0">
								<div class="p20 bbot">
                                                                    <div class="prettyprint" style="word-wrap:break-word;">
									<?php echo base_url('/survey/'); ?><?php echo $oNPS->hashcode; ?>
									</div>
									<div style="display: none;" class="prettyprintURL"><?php echo base_url('/survey/'); ?><?php echo $oNPS->hashcode; ?></div>
									
								</div>
								<div class="p20 text-right">
									<button class="btn btn-xs btn_white_table pl10 pr10" id="btnCopyWidget" onclick="copyToClipboard('.prettyprintURL')">Copy Code</button>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
			
			<div class="row pull-right">
				<div class="col-md-12">
					<a href="javascript:void(0);" id="publishNPSCampaign" class="btn dark_btn mt30">Publish</a>
				</div>
			</div>
		</div>
		
		<script>
			
			function copyToClipboard(element) {
				var $temp = $("<input>");
				$("body").append($temp);
				var widgetScript = String($(element).text());
				$temp.val(widgetScript).select();
				document.execCommand("copy");
				$temp.remove();
			}
		</script>													