<!-- Content area -->
<div class="content">
    <div class="has-detached-left">
		<!-- Dashboard content -->
		<div class="row">
			<div class="col-lg-12">
				<!-- Marketing campaigns -->
				<div class="panel panel-flat">
					<div class="panel-heading">
						<div class="row">
							<div class="col-lg-12">
								<h6 class="panel-title">Feedback Thread</h6>
								
								<div class="heading-elements">
									<span class="label bg-success heading-text"><?php echo count($thread_data); ?> Messages</span>
									<ul class="icons-list">
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i> <span class="caret"></span></a>
											<ul class="dropdown-menu dropdown-menu-right">
												<li><a href="#"><i class="icon-sync"></i> Update data</a></li>
												<li><a href="#"><i class="icon-list-unordered"></i> Detailed log</a></li>
												<li><a href="#"><i class="icon-pie5"></i> Statistics</a></li>
												<li class="divider"></li>
												<li><a href="#"><i class="icon-cross3"></i> Clear list</a></li>
											</ul>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div style="margin-top:15px;"><p class="content-group">WYSIHTML55 takes a textarea and transforms it into a rich text editor. The textarea acts as a fallback for unsupported browsers (eg. IE &lt; 8). Make sure the textarea element has an <code>id</code>, so we can later access it easily from javascript. The resulting rich text editor will much behave and look like the textarea since behavior (placeholder, autofocus, ...) and css styles will be copied over.</p></div>
					</div>
					<div class="panel-body">
						<!-- Inner Side bar -->
						<div class="sidebar-detached">
							<div class="sidebar sidebar-default">
								<div class="sidebar-content">
									
									<!-- Actions -->
									<div class="sidebar-category">
										<div class="category-title">
											<span>Actions</span>
											<ul class="icons-list">
												<li><a href="#" data-action="collapse"></a></li>
											</ul>
										</div>
										
										<div class="category-content">
											<a href="#" class="btn bg-indigo-400 btn-block">Compose mail</a>
										</div>
									</div>
									<!-- /actions -->
									
									
									<!-- Sub navigation -->
									<div class="sidebar-category">
										<div class="category-title">
											<span>Navigation</span>
											<ul class="icons-list">
												<li><a href="#" data-action="collapse"></a></li>
											</ul>
										</div>
										
										<div class="category-content no-padding">
											<ul class="navigation navigation-alt navigation-accordion no-padding-bottom">
												<li class="navigation-header">Folders</li>
												<li class="active"><a href="#"><i class="icon-drawer-in"></i> Inbox <span class="badge badge-success">32</span></a></li>
												<li><a href="#"><i class="icon-drawer3"></i> Drafts</a></li>
												<li><a href="#"><i class="icon-drawer-out"></i> Sent mail</a></li>
												<li><a href="#"><i class="icon-stars"></i> Starred</a></li>
												<li class="navigation-divider"></li>
												<li><a href="#"><i class="icon-spam"></i> Spam <span class="badge badge-danger">99+</span></a></li>
												<li><a href="#"><i class="icon-bin"></i> Trash</a></li>
												<li class="navigation-header">Labels</li>
												<li><a href="#"><span class="status-mark border-primary position-left"></span> Facebook</a></li>
												<li><a href="#"><span class="status-mark border-success position-left"></span> Spotify</a></li>
												<li><a href="#"><span class="status-mark border-indigo position-left"></span> Twitter</a></li>
												<li><a href="#"><span class="status-mark border-danger position-left"></span> Dribbble</a></li>
											</ul>
										</div>
									</div>
									<!-- /sub navigation -->
									
								</div>
							</div>
						</div>
						
						<!-- Content Area -->
						<div class="container-detached">
							<div class="content-detached">
								
								<!-- Single line -->
								<div class="panel panel-white">
									<div class="panel-heading">
										<h6 class="panel-title">Email Messages</h6>
										
										<div class="heading-elements not-collapsible">
											<span class="label bg-blue heading-text">0 new today</span>
										</div>
									</div>
									
									<div class="panel-toolbar panel-toolbar-inbox">
										<div class="navbar navbar-default">
											<ul class="nav navbar-nav visible-xs-block no-border">
												<li>
													<a class="text-center collapsed" data-toggle="collapse" data-target="#inbox-toolbar-toggle-single">
														<i class="icon-circle-down2"></i>
													</a>
												</li>
											</ul>
											
											<div class="navbar-collapse collapse" id="inbox-toolbar-toggle-single">
												<div style="border: 1px solid #DDDDDD; padding: 7px; margin-left: -6px; width: 35px; margin-top: 5px; border-radius: 3px; position: absolute; left: 16px;">
													<input type="checkbox" class="styled selectCheck" name="checkAll[]" id="checkAll">
												</div>
												<div class="btn-group navbar-btn">
													<!-- <button type="button" class="btn btn-default btn-icon btn-checkbox-all">
														<input type="checkbox" class="styled selectCheck" name="checkAll[]" id="checkAll">
													</button> -->
													
													<button type="button" class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="margin-left:24px;">
														<span class="caret"></span>
													</button>
													
													<ul class="dropdown-menu">
														<li><a href="#">Select all</a></li>
														<li><a href="#">Select read</a></li>
														<li><a href="#">Select unread</a></li>
														<li class="divider"></li>
														<li><a href="#">Clear selection</a></li>
													</ul>
												</div>
												
												<div class="btn-group navbar-btn">
													<button type="button" class="btn btn-default"><i class="icon-pencil7"></i> <span class="hidden-xs position-right">Compose</span></button>
													<button type="button" class="btn btn-default deleteEmailFeedback"><i class="icon-bin"></i> <span class="hidden-xs position-right">Delete</span></button>
													<button type="button" class="btn btn-default"><i class="icon-spam"></i> <span class="hidden-xs position-right">Spam</span></button>
												</div>
												
												<div class="navbar-right">
													<p class="navbar-text"><span class="text-semibold">1 - <?php echo count($thread_data); ?></span> of <span class="text-semibold"><?php echo count($thread_data); ?></span></p>
													
													<div class="btn-group navbar-left navbar-btn">
														<button type="button" class="btn btn-default btn-icon disabled"><i class="icon-arrow-left12"></i></button>
														<button type="button" class="btn btn-default btn-icon"><i class="icon-arrow-right13"></i></button>
													</div>
													
													<div class="btn-group navbar-btn">
														<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
															<i class="icon-cog3"></i>
															<span class="caret"></span>
														</button>
														
														<ul class="dropdown-menu dropdown-menu-right">
															<li><a href="#">Action</a></li>
															<li><a href="#">Another action</a></li>
															<li><a href="#">Something else here</a></li>
															<li><a href="#">One more line</a></li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="table-responsive">
										<table class="table table-inbox">
											<tbody data-link="row" class="rowlink">
												
												<?php if(!empty($thread_data)): ?>
												<?php foreach($thread_data AS $oRow): ?>
												
												
												<tr class="unread">
													<td class="table-inbox-checkbox rowlink-skip">
														<input type="checkbox" name="checkRows[]" value="<?php echo $oRow->id; ?>" class="styled checkRows">
													</td>
													<td class="table-inbox-star rowlink-skip">
														<a href="mail_read.html">
															<i class="icon-star-empty3 text-muted"></i>
														</a>
													</td>
													<td class="table-inbox-image">
														<span class="btn bg-warning-400 btn-rounded btn-icon btn-xs">
															<span class="letter-icon"><?php echo substr($oRow->fname,0,1);?></span>
														</span>
														
													</td>
													<td class="table-inbox-name">
														<a href="#">
															<div class="letter-icon-title text-default"><a href="<?php echo base_url('/admin/feedback/view/'.$oRow->brandboost_id.'/'.$oRow->client_id.'/'.$oRow->subscriber_id); ?>" target="_blank"><?php echo $oRow->fname. ' '. $oRow->lname . ' ('. $oRow->total_messages.')';?></a></div>
														</a>
													</td>
													<td class="table-inbox-message">
														<span class="table-inbox-subject"><?php echo substr($oRow->feedback, 0, 50);?></span>
														<span class="table-inbox-preview">To the London docks, you may have seen a crippled beggar (or KEDGER, as the sailors say) holding a painted board before him, representing the tragic scene in which he lost his leg</span>
													</td>
													<td class="table-inbox-attachment">
														<i class="icon-attachment text-muted"></i>
													</td>
													<td class="table-inbox-time">
														11:09 pm
													</td>
												</tr>
												<?php endforeach; ?>
												<?php endif; ?>
												
												
												
											</tbody>
										</table>
									</div>
								</div>
								<!-- /single line -->
								
								
								
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<!-- /marketing campaigns -->
			</div>
		</div>
		<!-- /dashboard content -->
		
	</div>
</div>
<!-- /content area -->

<div id="feedbackPopup" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <h5 class="text-semibold no-margin-top">
                            <a href="javascript:void(0);" class="feedbackCamapign"></a>
						</h5>
                        <div class="feedbackContent"></div>
					</div>
					
                    <div class="panel-footer panel-footer-condensed">
                        <div class="heading-elements not-collapsible">
                            <span class="heading-text text-semibold">
                                <i class="icon-history position-left"></i>
                                <span class="feedbackTime"></span>
							</span>
                            <span class="heading-text pull-right label feedbackCategory">
								
							</span>
                            <button class="btn btn-link pull-right" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
    $(document).ready(function () {
		$('#checkAll').change(function () {
            if (false == $(this).prop("checked")) {
				$(".checkRows").each(function(){
					$(this).parent().removeClass('checked');
					$(this).prop('checked', false);
					$(this).parents('tr').removeClass('warning');
				});
			}
            else {
                $(".checkRows").each(function(){
					$(this).parent().addClass('checked');
					$(this).parents('tr').addClass('warning');
					$(this).prop('checked', true);
				});
			}
		});
		
        
        $(document).on('click', '.checkRows', function () {            		
            var numberOfChecked = $('.checkRows:checkbox:checked').length;
            var totalCheckboxes = $('.checkRows:checkbox').length;
            if(totalCheckboxes == numberOfChecked){
                $('#checkAll').prop('checked', true);
				$('#checkAll').parent().addClass('checked');
				}else{
				$('#checkAll').prop('checked', false);
				$('#checkAll').parent().removeClass('checked');
			}
		});
		
		
        $('.showFeedback').click(function () {
            var fbTitle = $(this).attr('fb_title');
            var fbContent = $(this).attr('fb_content');
            var fbTime = $(this).attr('fb_time');
            var fbCategory = $(this).attr('fb_category');
			
            $('.feedbackCamapign').html(fbTitle);
            $('.feedbackContent').html(fbContent);
            $('.feedbackTime').html(fbTime);
            $('.feedbackCategory').html(fbCategory);
			
            var className = '';
            if (fbCategory == 'Positive') {
                className = 'bg-success';
				} else if (fbCategory == 'Neutral') {
                className = 'bg-blue';
				} else if (fbCategory == 'Negative') {
                className = 'bg-danger';
			}
			
            $('.feedbackCategory').removeClass('bg-success');
            $('.feedbackCategory').removeClass('bg-blue');
            $('.feedbackCategory').removeClass('bg-danger');
			
            $('.feedbackCategory').addClass(className);
			
            $('#feedbackPopup').modal();
		});
		
		$('.deleteEmailFeedback').click(function(){
			var conf = confirm("Are you sure? You want to delete this feedback!");
			if(conf == true){
				var selectedCountry = new Array();
				var n = jQuery(".checkRows:checked").length;
				if (n > 0){
					jQuery(".checkRows:checked").each(function(){
						selectedCountry.push($(this).val());
						$.ajax({
							url: '<?php echo base_url('admin/feedback/deleteFeedback'); ?>',
							type: "POST",
							data: {'email_feedback_id':selectedCountry},
							dataType: "json",
							success: function (data) {
								if(data.status == 'success'){
									alertMessageAndRedirect('Feedback threads have been deleted successfully.', window.location.href);
								}else{
									alertMessage('Error: Some thing wrong!');
								}
							}
						});
					});
				}else{
					alertMessage('Please select atleast one record.');
				}
			}
		});
	});
</script>


