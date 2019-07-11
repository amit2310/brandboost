<script type="text/javascript" src="<?php echo site_url('assets/js/viewbox.min.js'); ?>"></script>
<style type="text/css">
	.loadMoreRecord{ text-align: center; padding: 15px 0 0 0; margin: 20px -20px 0; border-top: 1px solid #eee; }
	.thumbnail2 img{border-radius: 4px; max-width: 100%; width: 100%; margin-bottom: 20px; border: 1px dotted #eeeeee; box-shadow: 0 1px 2px 0 rgba(0,0,0,.02),0 6px 18px 0 rgba(0,0,0,.055);}
    .thumbnail2 img.big{height: 210px!important; width: 100%;}
    .thumbnail2 img.small{height: 62px!important; width: 100%;}

    .videobox{border-radius: 0px; border-radius: 4px; box-shadow: 0 1px 2px 0 rgba(0,0,0,.02),0 6px 18px 0 rgba(0,0,0,.055);}
</style>
<style>
    .viewbox-container{
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,.5);
        z-index: 99999;
    }
    .viewbox-body{
        position: absolute;
        top: 50%;
        left: 50%;
        background: #fff;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        border-radius: 10px;
        -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        overflow: auto;
    }
    .viewbox-header{
        margin: 10px;
    }
    .viewbox-content{
        margin: 10px;
        width: 300px;
        height: 300px;
    }
    .viewbox-footer{
        margin: 10px;
    }
    .viewbox-content .viewbox-image{
        width: 100%;
        height: 100%;
    }

    /* buttons */
    .viewbox-button-default{
        cursor: pointer;
        height: 64px;
        width: 64px;
    }
    .viewbox-button-default > svg{
        width: 100%;
        height: 100%;
        background: inherit;
        fill: inherit;
        pointer-events: none;
        transform: translateX(0px);
    }
    .viewbox-button-default{
        fill: #999;
    }
    .viewbox-button-default:hover{
        fill: #fff;
    }

    .viewbox-button-close{
        position:absolute;
        top:10px;
        right: 10px;
        z-index:9;
    }
    .viewbox-button-next,
    .viewbox-button-prev{
        position:absolute;
        top: 50%;
        height: 128px;
        width: 128px;
        margin: -64px 0 0;
        z-index:9;
    }
    .viewbox-button-next{
        right: 10px;
    }
    .viewbox-button-prev{
        left: 10px;
    }

    /* loader */
    .viewbox-container .loader{
        widows: 100%;
        position: absolute;
        left: 50%;
        top: 50%;
        margin:-25px 0 0 -25px;
    }
    .viewbox-container .loader *{
        margin: 0;
        padding: 0;
    }
    .viewbox-container .loader .spinner{
        width: 50px;
        height: 50px;
        position: relative;
        margin: 0 auto;
    }
    .viewbox-container .loader .double-bounce1,
    .viewbox-container .loader .double-bounce2{
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background-color: #999;
        opacity: 0.6;
        position: absolute;
        top: 0;
        left: 0;
        -webkit-animation: sk-bounce 2.0s infinite ease-in-out;
        animation: sk-bounce 2.0s infinite ease-in-out;
    }
    .viewbox-container .loader .double-bounce2 {
        -webkit-animation-delay: -1.0s;
        animation-delay: -1.0s;
    }
    @-webkit-keyframes sk-bounce{
        0%, 100% { -webkit-transform: scale(0.0) }
        50% { -webkit-transform: scale(1.0) }
    }

    @keyframes sk-bounce{
        0%, 100% { 
            transform: scale(0.0);
            -webkit-transform: scale(0.0);
        } 50% { 
            transform: scale(1.0);
            -webkit-transform: scale(1.0);
        }
    }

</style>	

<div class="content">
  
  <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
	<div class="page_header">
	  <div class="row">
	  <!--=============Headings & Tabs menu==============-->
		<div class="col-md-7">
		  <h3><i class="icon-star-half"></i> &nbsp; <?php echo $title; ?></h3>
		</div>
		<!--=============Button Area Right Side==============-->
		<div class="col-md-5 text-right btn_area">
		 <div class="btn-group">
                	<button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                    	<i class="icon-calendar2"></i>&nbsp; &nbsp; Filter reviews&nbsp; &nbsp; <span class="caret"></span>
                	</button>
					<div class="dropdown-menu dropdown-content width-320 dropdown-menu-right">
					  <div class="dropdown-content-heading"> Filter
						<ul class="icons-list">
						  <li><a href="#"><i class="icon-more"></i></a> </li>
						</ul>
					  </div>
					  <div class="">
						<div class="panel-group panel-group-control panel-group-control-right content-group-lg filter_campaign" id="accordion-control-right">
						  <div class="panel panel-white">
							<div class="panel-heading sidebarheadings active">
							  <h6 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group1"><i class="icon-star-empty3"></i>&nbsp;Campaign Type</a> </h6>
							</div>
							<div id="accordion-control-right-group1" class="panel-collapse collapse">
							  <div class="panel-body">
								<div class="row">
								  <div class="col-md-12"> 
						Most startups fail. But many of those failures are preventable. The Lean Startup is a new approach being adopted across the globe, changing the way companies are built and new products are launched.
						 </div>
								</div>
							  </div>
							</div>
						  </div>
						  <div class="panel panel-white">
							<div class="panel-heading sidebarheadings">
							  <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group2"><i class="icon-arrow-up-left2"></i>&nbsp; Source</a> </h6>
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
							<div class="panel-heading sidebarheadings">
							  <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group73"><i class="icon-star-full2"></i>&nbsp; Rating</a> </h6>
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
							<div class="panel-heading sidebarheadings">
							  <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group74"><i class="icon-calendar"></i>&nbsp; Date Created</a> </h6>
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
							<div class="panel-heading sidebarheadings">
							  <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group83"><i class="icon-thumbs-up2"></i>&nbsp; Reviews</a> </h6>
							</div>
							<div id="accordion-control-right-group83" class="panel-collapse collapse in">
							  <div class="panel-body">
								<div class="row mb20">
								  <div class="col-xs-6">
								  <div class="checkbox">
								  <label>
									<input type="checkbox"  class="control-primary" checked="checked">
									Total Reviews
									</label>
									</div>
								  </div>
								  <div class="col-xs-6">
								  <input class="form-control input-sm" type="text" name="" value="20" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" />
								  </div>

								</div>
								<div class="row mb20">
								  <div class="col-xs-6">
								  <div class="checkbox">
								  <label>
									<input type="checkbox"  class="control-primary" checked="checked">
									Positive
									</label>
									</div>
								  </div>
								  <div class="col-xs-6">
								  <input class="form-control input-sm" type="text" name="" value="20" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" />
								  </div>

								</div>
								<div class="row mb20">
								  <div class="col-xs-6">
								  <div class="checkbox">
								  <label>
									<input type="checkbox"  class="control-primary">
									Neutral
									</label>
									</div>
								  </div>
								  <div class="col-xs-6">
								  <input class="form-control input-sm" type="text" name="" value="20" disabled /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" disabled />
								  </div>

								</div>
								<div class="row">
								  <div class="col-xs-6">
								  <div class="checkbox">
								  <label>
									<input type="checkbox"  class="control-primary" checked="checked">
									Negative
									</label>
									</div>
								  </div>
								  <div class="col-xs-6">
								  <input class="form-control input-sm" type="text" name="" value="0" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="10" />
								  </div>

								</div>
							  </div>
							</div>
						  </div>
						</div>
					  </div>
					  <div class="dropdown-content-footer">
					  	<button type="button" class="btn dark_btn dropdown-toggle" style="display: inline-block;"><i class="icon-filter4"></i><span> &nbsp;  Filter</span> </button>
					  	&nbsp; &nbsp;
					  	<a style="display: inline-block;" href="#">Clear All</a>
					  </div>
					</div>
				</div>
		  <button type="button" class="btn dark_btn dropdown-toggle ml10"><i class="icon-plus3"></i><span> &nbsp;  Add Review</span> </button>
		  
		</div>
	  </div>
	</div>
  <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->
  
	
	<!--================================= CONTENT AFTER TAB===============================-->
	<div class="row">
	  	  <!--------------LEFT----------->
		  <div class="col-md-3">
		  

							  <div class="panel panel-flat bx_shadow1">
							  <div class="panel-heading">
								 <ul class="nav nav-tabs nav-tabs-bottom">
									<li class="active"><a href="#Configurations" data-toggle="tab" aria-expanded="false">Images</a></li>
									<li class=""><a href="#Design" data-toggle="tab" aria-expanded="false">Video</a></li>
								  </ul>
							  </div>
							  <div class="panel-body p0">
								  <div class="tab-content"> 
								  <div class="tab-pane active" id="Configurations">
								  	<div class="profile_headings fsize12 fw500">Images <a class="pull-right plus_icon" style="cursor: pointer;"><i class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
								  	<div class="p20">
										<div class="row">
										    <div class="col-md-12">
										    	<?php 
												$mediaArray = unserialize($reviewData->media_url);
											    if (!empty($mediaArray)) {
											        foreach ($mediaArray as $key => $data) :
											        	
											            if ($data['media_type'] == 'image') {
											                if ($key == 0) {
											                    ?>
											                    <div class="col-xs-12 col-md-12"> <a href="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $data['media_url']; ?>" class="thumbnail2"> <img class="big" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $data['media_url']; ?>" alt=""> </a> </div>
											                <?php } ?>
											                <div class="col-xs-6 col-md-4"> <a href="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $data['media_url']; ?>" class="thumbnail2"> <img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $data['media_url']; ?>" alt="" class=" small"> </a> </div>
											                <?php
											            } 
											        endforeach;
											    }  else {
									                ?><div class="col-xs-12 col-md-12"> <a href="<?php echo base_url('assets/images/No_Image_Available.png'); ?>" class="thumbnail2"> <img class="mb0 big" src="<?php echo base_url('assets/images/No_Image_Available.png'); ?>" alt=""> </a> </div><?php
									            }                             
												?>
										    </div>
										</div>
									</div>
								  </div>
									  
									  
								 <div class="tab-pane" id="Design">
								 	<div class="profile_headings fsize12 fw500">Video <a class="pull-right plus_icon" style="cursor: pointer;"><i class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
								  	<div class="p20">
										<div class="row">
										    <div class="col-md-12">
										    	<?php
                                                if (!empty($mediaArray)) {
                                                    foreach ($mediaArray as $key => $data) {
                                                        if ($key == 0) {
                                                            if ($data['media_type'] == 'video') {

                                                                $path = $data['media_url'];
                                                                $ext = pathinfo($path, PATHINFO_EXTENSION);
                                                                ?>
                                                                <div class="embed-responsive embed-responsive-16by9 mb-20">
                                                                    <video width="320" height="240" controls>
                                                                        <source src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $data['media_url']; ?>" type="video/<?php echo $ext; ?>">
                                                                    </video>
                                                                </div>

                                                                <div class="viddetails">
                                                                    <p><span>File Name : </span>ReviewVideo.mp4</p>
                                                                    <p><span>File Format :</span> MP4</p>
                                                                    <p><span>File Size : </span>128 MB</p>
                                                                    <p><span>Uploaded :</span> May 26th, 2018 at 2:10 AM</p>
                                                                    <p><span>Download Video:</span> <a style="text-decoration: underline;" href="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $data['media_url']; ?>" download="video">Download Video</a></p>
                                                                </div>
                                                            <?php
                                                            }
                                                        }
                                                    }
                                                } else {
                                                    ?>
                                                    <div class="embed-responsive embed-responsive-16by9 mb-20">
                                                        <iframe class="embed-responsive-item videobox" src="https://www.youtube.com/embed/lVKTP_rr5DM"></iframe>
                                                    </div>

                                                    <div class="viddetails">
                                                        <p><span>File Name : </span>ReviewVideo.mp4</p>
                                                        <p><span>File Format :</span> MP4</p>
                                                        <p><span>File Size : </span>128 MB</p>
                                                        <p><span>Uploaded :</span> May 26th, 2018 at 2:10 AM</p>
                                                        <p><span>Download Video:</span> <a style="text-decoration: underline;" href="#" >Download Video</a></p>
                                                    </div>
                                                    <?php }
                                                ?>
								  			</div>
								  		</div>
								  	</div>
								  </div>
								</div>
							  </div>
							</div>


	
			
			

			
			
			
		  </div>
		  
		  <!------------CENTER------------->
		  <div class="col-md-6">
			  <div class="panel panel-flat">
			  <div class="panel-heading">
			  	<?php //pre($oScore); ?>
				<h6 class="panel-title">NPS Feedback For <?php echo $oScore->npstitle != ''? $oScore->npstitle: ''; ?></h6>
				<div class="heading-elements"><a style="cursor: pointer;"><i class="icon-more2"></i></a></div>
			  </div>
			  <div class="panel-body br0">
			  <p class="fsize14 mb20"><?php echo $oScore->title != ''? $oScore->title: 'N/A'; ?></p>
			  
			  <?php 
			    if($reviewData->avatar){
			  		$avatarImage = "https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/profile_image_9672_e3abdb9b595bb7fd46f89f7716447f38266ef481.jpg";
				}
				else {
					$avatarImage = base_url()."assets/images/userp.png";
				}
			  ?> 

			  <div class="media-left media-middle"> <a class="icons" style="cursor: pointer;"><img src="<?php echo $avatarImage; ?>" class="img-circle img-xs" alt=""></a> </div>
			  <div class="media-left">
				  <div class="text-muted pt-5">by <?php echo $oScore->firstname." ".$oScore->lastname; ?>   <span class="ml20"><i class="icon-checkmark3 fsize12"></i>&nbsp; Verified Purchase</span></div>
				</div>
			 
			  
				
			  </div>
			  <div class="panel-footer p20 ">
			  <p class="mb0 fsize13"> <?php echo $oScore->feedback != ''? $oScore->feedback: 'N/A'; ?> </p>
			  </div>
			</div>
			
			
		
			
			
		  </div>
		  
		  <!------------RIGHT------------->
		  <div class="col-md-3">
			<div class="panel panel-flat">
			  <div class="panel-heading">
				<h6 class="panel-title">Info</h6>
				<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
			  </div>
			  <div class="panel-body p0" >
				<div class="interactions p25">
					<ul>
						<li><small>Ref</small> <strong>N/A</strong></li>
						<li><small>Name</small> <strong><?php echo $oScore->firstname.' '.$oScore->lastname; ?></strong></li>
						<li><small>Email</small> <strong><?php echo $oScore->email; ?></strong></li>
						<li><small>Phone</small> <strong><?php echo $oScore->mobile == '' ? 'N/A' : $oScore->mobile; ?></strong></li>
						<!-- <li><small>Reviews</small> <strong>3</strong></li>
						<li><small>Notification</small> <strong>On</strong></li>
						<li><small>Id</small> <strong>310282</strong></li>
						<li><small>SMS</small> <strong>On</strong></li>
						<li><small>Emails</small> <strong>Off</strong></li> -->
					</ul>
				</div>
				<div class="profile_headings">NPS Notes <a class="pull-right plus_icon" href="#"><i class="icon-plus3"></i></a></div>
				
				<?php //pre($oNotes); ?>
				<?php foreach ($oNotes as $key => $noteData) { ?>
				 		<div class="p25 bbot">
							<p class="fsize12"><?php echo $noteData->notes; ?></p>
							<p><small class="text-muted">On <?php echo date('F d, Y h:i A', strtotime($noteData->created)); ?> <?php //echo '( '.timeAgo($noteData->created).' )'; ?><br>by <?php echo $noteData->firstname.' '.$noteData->lastname; ?></small></p>
						
	                        <div class="text-right">
	                        	<a href="javascript:void(0)" class="editNote" noteid="<?php echo $noteData->id; ?>"> <span class="label addtag bkg_grey txt_white br5"> Modify</span></a>
	                        	<a href="javascript:void(0)" class="deleteNote" noteid="<?php echo $noteData->id; ?>"> <span class="label addtag bkg_red txt_white br5"> Delete</span></a>

	                            <!-- <ul class="list-inline list-inline-separate text-size-small text-right mt-5">
	                                <li> </li>
	                                <li> </li>
	                            </ul> -->
	                        </div>
                        </div>
                <?php } ?>
				
				<div class="p25 btop">
				<button data-toggle="modal" data-target="#addnotes" type="button" class="btn dark_btn btn-xs mr20">Add Note</button>	 <!-- <button class="btn btn-link btn-xs mr20">View All Notes</button> -->
				</div>
				
				
				
				
				
			  </div>
			</div>
			
			
			
		  </div>
		  
		</div>
		
		
	
	<!--================================= CONTENT AFTER TAB===============================-->
	
	
	
  </div>

  <div id="editComment" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal" id="updateComment" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Update Comment</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-lg-3">Comment</label>
                        <div class="col-lg-9">
                            <textarea class="form-control"  placeholder="Leave Comment" name="edit_content" id="edit_content" required ></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="edit_commentid" id="edit_commentid" value="">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="editNoteSection" class="modal fade" style="z-index:99999;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal" id="updateNote" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Update Comment</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-lg-3">Note</label>
                        <div class="col-lg-9">
                            <textarea class="form-control"  placeholder="Note" name="edit_note_content" id="edit_note_content" required ></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="edit_noteid" id="edit_noteid" value="">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" class="btn dark_btn"><i class="icon-check"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="addnotes" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-tags"></i>&nbsp; NPS Notes</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    
                    <form method="post" class="form-horizontal" id="frmSaveNote" action="javascript:void();">
                        <div class="col-md-12 mb-15">
                            <textarea class="form-control" name="notes" style="padding: 20px; height: 75px;" placeholder="Add Note"></textarea>
                        </div>
                        <div class="col-md-12 text-right ">
                            <input type="hidden" name="scoreid" id="scoreid" value="<?php echo $oScore->id; ?>">
                            <input type="hidden" name="uid" id="uid" value="<?php echo $userID; ?>">
                            <input type="hidden" name="npsid" id="npsid" value="<?php echo $oScore->id; ?>">
                            <button data-toggle="modal" data-target="#addnotes" type="button" id="saveNPSNotes" class="btn dark_btn"> Add Notes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="ReviewTagListModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" name="frmReviewTagListModal" id="frmReviewTagListModal" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Apply Tags</h5>
                </div>
                <div class="modal-body" id="tagEntireList"></div>
                <div class="modal-footer modalFooterBtn">
                    <input type="hidden" name="review_id" id="tag_review_id" />
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Apply Tag</button>
                </div>
            </form>
        </div>
    </div>
</div>

  <script>
   
  	$(function () {
        $('.thumbnail2').viewbox();
    });

    var startingLimit = 0;
    function loadMoreComments(reviewID, startinglimitVal) {
        $('.overlaynew').show();
        $.ajax({
            url: '<?php echo base_url('admin/brandboost/getreviwecomments/'); ?>',
            type: "POST",
            data: {'reviewId': reviewID, 'startinglimitVal': startinglimitVal},
            dataType: "json",
            success: function (data) {
                $('.overlaynew').hide();
                if (data.status == 'success') {
                    $('#commentDataList').append(data.commentList);
                    startingLimit = parseInt(startinglimitVal) + 5;
                    if (data.nunOfComment < 5) {
                        $('.loadMoreBtn').html('<a href="javascript:void(0);">No More Comments Found...</a>');
                    } else {
                        $('.loadMoreBtn a').attr('onclick', 'loadMoreComments(' + reviewID + ', ' + startingLimit + ')');
                    }

                } else {
                    $('.loadMoreBtn').html('<a href="javascript:void(0);">' + data.commentList + '</a>');
                }
            }, error() {
                $('.overlaynew').hide();
            }
        });
        return false;
    }

    function saveCommentLikeStatus(commentID, statusType) {
        $('.overlaynew').show();
        $.ajax({
            url: '<?php echo base_url("admin/reviews/saveCommentLikeStatus/"); ?>',
            type: "POST",
            data: {'commentId': commentID, 'status': statusType},
            dataType: "json",
            success: function (data) {
                $('.overlaynew').hide();
                if (data.status == 'success') {
                    window.location.href = '';
                }
            }, error() {
                $('.overlaynew').hide();
            }
        });
        return false;
    }

    $(document).ready(function () {
        $(document).on("click", ".replyCommentAction", function () {
            $(this).parent().parent().next('.replyCommentBox').toggle('slow');
        });

        $(document).on("click", ".removetxt", function () {
            var reviewID = $(this).attr("review_id");
            var tagID = $(this).attr("tag_id");
            var elem = $(this);
            $.ajax({
                url: '<?php echo base_url('admin/tags/removeTag'); ?>',
                type: "POST",
                data: {review_id: reviewID, tag_id: tagID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $(elem).parent().remove();
                    }
                }
            });
        });

        $(document).on('click', '.chg_status', function () {
            $('.overlaynew').show();
            var status = $(this).attr('change_status');
            var comment_id = $(this).attr('comment_id');
            $.ajax({
                url: '<?php echo base_url('admin/comments/update_comment_status'); ?>',
                type: "POST",
                data: {status: status, comment_id: comment_id},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = '';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });


        $(document).on('click', '.editComment', function () {
            var commentID = $(this).attr('commentid');
            $.ajax({
                url: '<?php echo base_url('admin/comments/getCommentById'); ?>',
                type: "POST",
                data: {commentID: commentID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        var commentData = data.result[0];
                        $('#edit_content').val(commentData.content);
                        $('#edit_commentid').val(commentData.id);
                        $("#editComment").modal();
                    } else {

                    }
                }
            });
        });

        $(document).on('click', '.editNote', function () {
            var noteId = $(this).attr('noteid');
            $.ajax({
                url: '<?php echo base_url('admin/modules/nps/getNPSNoteById'); ?>',
                type: "POST",
                data: {noteid: noteId},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        var noteData = data.result[0];
                        $('#edit_note_content').val(noteData.notes);
                        $('#edit_noteid').val(noteData.id);
                        $("#editNoteSection").modal();
                    } else {

                    }
                }
            });
        });

        $(document).on('click', '.deleteNote', function () {
            $('.overlaynew').show();
            var conf = confirm("Are you sure? You want to delete this note!");
            if (conf == true) {
                var noteId = $(this).attr('noteid');
                $.ajax({
                    url: '<?php echo base_url('admin/modules/nps/deleteNPSNote'); ?>',
                    type: "POST",
                    data: {noteid: noteId},
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            window.location.href = '';
                        } else {
                            alertMessage('Error: Some thing wrong!');
                            $('.overlaynew').hide();
                        }
                    }
                });
            } else {
                $('.overlaynew').hide();
            }
        });

        $("#updateNote").submit(function () {
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo base_url('admin/modules/nps/updatNotes'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#editNoteSection").modal('hide');
                        window.location.href = '';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });


        $(document).on('click', '.addReplyComment', function () {
            var reviewID = $(this).prev().prev().val();
            var parentCommentId = $(this).prev().val();
            var commentContent = $(this).parent().prev().find('.comment_content').val();
            $.ajax({
                url: '<?php echo base_url("admin/comments/add_comment"); ?>',
                type: "POST",
                data: {'reviweId': reviewID, 'parent_comment_id': parentCommentId, 'comment_content': commentContent},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = window.location.href;
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });

        $("#addComment").submit(function () {
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo base_url('admin/comments/add_comment'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = '';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });

        $("#updateComment").submit(function () {
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo base_url('admin/comments/update_comment'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = '';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });

        $(document).on('click', '.deleteComment', function () {
            $('.overlaynew').show();
            var conf = confirm("Are you sure? You want to delete this comment!");
            if (conf == true) {
                var commentId = $(this).attr('commentid');
                $.ajax({
                    url: '<?php echo base_url('admin/comments/deleteComment'); ?>',
                    type: "POST",
                    data: {commentId: commentId},
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            window.location.href = '';
                        } else {
                            alertMessage('Error: Some thing wrong!');
                            $('.overlaynew').hide();
                        }
                    }
                });
            } else {
                $('.overlaynew').hide();
            }
        });

        $(document).on("click", ".applyInsightTags", function () {
            var review_id = $(this).attr("reviewid");
            var feedback_id = $(this).attr("feedback_id");
            var action_name = $(this).attr("action_name");
            $.ajax({
                url: '<?php echo base_url('admin/tags/listAllTags'); ?>',
                type: "POST",
                data: {review_id: review_id},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        var dataString = data.list_tags;
                        if (dataString.search('have any tags yet :-') > 0) {
                            $('.modalFooterBtn').hide();
                        } else {
                            $('.modalFooterBtn').show();
                        }
                        $("#tagEntireList").html(dataString);
                        $("#tag_review_id").val(review_id);
                        $("#tag_feedback_id").val(feedback_id);
                        if (action_name == 'review-tag') {
                            $("#ReviewTagListModal").modal("show");
                        } else if (action_name == 'feedback-tag') {
                            $("#FeedbackTagListModal").modal("show");
                        }
                    }
                }
            });
        });

        $("#frmReviewTagListModal").submit(function () {
            var formdata = $("#frmReviewTagListModal").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/tags/applyReviewTag'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#ReviewTagListModal").modal("hide");
                        window.location.href = window.location.href;
                    }
                }
            });
            return false;
        });

        $(document).on("click", "#saveNPSNotes", function () {
            var formdata = $("#frmSaveNote").serialize();
            $('.overlaynew').show();
            $.ajax({
                url: "<?php echo base_url('/admin/modules/nps/saveNPSNotes'); ?>",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (response) {
                    if (response.status == "success") {
                        window.location.href = window.location.href;
                    }
                },
                error: function (response) {
                    alertMessage(response.message);
                }
            });
        });


        $(document).on('click', '#loadMoreComment', function(){

        	var numOfComment = $('#numOfComment').val();
        	var revId = $(this).attr('revId');

        	$('.loaderImage').removeClass('hidden');
	        $.ajax({
	            url: '<?php echo base_url("admin/brandboost/loadComment"); ?>',
	            type: "POST",
	            data: {'reviewId': revId, 'offset': numOfComment},
	            dataType: "html",
	            success: function (data) {
	           
		           	if(data != '') {
		           		$('.addMoreComment').append(data);
		            	var offset = Number (numOfComment) + 5;
		            	$('#numOfComment').val(offset);
		                $('.loaderImage').addClass('hidden');
		           	}
		           	else {
		           		$('.loadMoreRecord').remove();
		           	}

	            }, error() {
	                $('.loaderImage').addClass('hidden');
	            }
	        });
	        return false;

        });
    });
</script>