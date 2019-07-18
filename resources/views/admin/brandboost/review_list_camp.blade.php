@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')
<?php list($canRead, $canWrite) = fetchPermissions('Reviews'); ?>

<div class="content">
	
    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-7">
                <h3><img style="width: 18px;" src="<?php echo base_url(); ?>assets/images/review_icon2.png"/> Reviews</h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="active all"><a style="javascript:void();" class="filterByColumn" fil="">All</a></li>
                    <li><a style="javascript:void();" class="filterByColumn" fil="approved">Approved</a></li>
                    <li><a style="javascript:void();" class="filterByColumn" fil="pending">Pending</a></li>
				</ul>
			</div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-5 text-right btn_area">
                <button type="button" class="btn light_btn ml10"><i class="icon-download4"></i><span> &nbsp;  Import Reviews</span> </button>
                <button type="button" class="btn light_btn ml10"><i class="icon-upload4"></i><span> &nbsp;  Export Reviews</span> </button>
                <button type="button" class="btn dark_btn ml10"><i class="icon-plus3 txt_purple"></i><span> &nbsp;  Add Review</span> </button>
				
			</div>
		</div>
	</div>
    <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->
	
	
	
    <!--&&&&&&&&&&&& TABBED CONTENT &&&&&&&&&&-->
    <div class="tab-content"> 
        <!--===========TAB 1===========-->
        <div class="tab-pane active" id="right-icon-tab0">
            <div class="row">
                <div class="col-md-12">
                    <div style="margin: 0!important;" class="panel panel-flat">
						
						
                        <?php if (!empty($aReviews)): ?>
						<?php //$this->load->view("admin/components/smart-popup/smart-review-widget"); ?>
						@include('admin.components.smart-popup.smart-review-widget')
                        <?php endif; ?>
						
                        <div class="panel-heading"> 
                            <span class="pull-left">
                                <h6 class="panel-title"><?php
                                    if (!empty($aReviews)) {
                                        echo count($aReviews);
									}
								?> Reviews</h6>
							</span>
                            <div class="heading_links pull-left">
                                <a class="top_links top_links_clk btn btn-xs btn_white_table" startRate="" style="cursor: pointer;">All</a>
                                <a class="top_links top_links_clk" startRate="positive" style="cursor: pointer;">Positive</a> 
                                <a class="top_links top_links_clk" startRate="neutral" style="cursor: pointer;">Neutral</a> 
                                <a class="top_links top_links_clk" startRate="negative" style="cursor: pointer;">Negative</a> 
                                <a class="top_links top_links_clk link" startRate="commentLink" style="cursor: pointer;">With comments only</a>
                                <button type="button" class="btn btn-xs  plus_icon"><i class="icon-plus3"></i></button>
							</div>
							
                            <div class="heading-elements">
                                <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                    <input class="form-control input-sm cus_search" tableid="onsiteReview" placeholder="Search by name" type="text">
                                    <div class="form-control-feedback">
                                        <i class="icon-search4"></i>
									</div>
								</div>
                                <div class="table_action_tool">
                                    <a href="javascript:void();"><i class="icon-calendar2"></i></a>
                                    <!-- <a href="javascript:void();"><i class="icon-download4"></i></a>
									<a href="javascript:void();"><i class="icon-upload4"></i></a> -->
                                    <a href="javascript:void();" class="editDataReview"><i class="icon-pencil4"></i></a>
                                    <a href="javascript:void();" style="display: none;" id="deleteButtonReviewList" class="custom_action_box"><i class="icon-trash position-left"></i></a>
								</div>
								
							</div>
						</div>
						
                        <div class="panel-body p0">
                            <?php //$this->load->view("admin/brandboost/partial/review_table"); ?>
							@include('admin.brandboost.partial.review_table')
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		
		
	</div>
    <!--================================= CONTENT AFTER TAB===============================-->
	
	
	
</div>



<!--=====================================Create new campaign================================-->	
<div id="addPeopleList" class="modal fade">
    <div style="max-width: 440px;ss" class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Create new campaign</h5>
				</div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Campaign name</label>
                                <div class="">
                                    <input placeholder="Enter campaign name" name="firstname" id="firstname" class="form-control" type="text" required>
								</div>
							</div>
						</div>
                        <div class="col-md-12">
                            <div class="form-group mb0">
                                <label class="control-label">Campaign description</label>
                                <div class="">
                                    <textarea placeholder="Enter campaign description"  class="form-control" value="" type="text" required> </textarea>
								</div>
							</div>
						</div>
						
						
						
					</div>
				</div>
                <div class="modal-footer p40">
                    <input type="hidden" name="listId" id="list_id" value="">
                    <button class="btn btn-link text-muted" data-dismiss="modal">Cancel </button>
                    <button data-toggle="modal" id="nextpopup" type="button" class="btn dark_btn bkg_purple">Create</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--=====================================Add List Modal Popup End================================-->

<!--=====================================Create new campaign================================-->	
<div id="addPeopleList" class="modal fade">
    <div style="max-width: 440px;ss" class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Create new campaign</h5>
				</div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Campaign name</label>
                                <div class="">
                                    <input placeholder="Enter campaign name" name="firstname" id="firstname" class="form-control" type="text" required>
								</div>
							</div>
						</div>
                        <div class="col-md-12">
                            <div class="form-group mb0">
                                <label class="control-label">Campaign description</label>
                                <div class="">
                                    <textarea placeholder="Enter campaign description"  class="form-control" value="" type="text" required> </textarea>
								</div>
							</div>
						</div>
						
						
						
					</div>
				</div>
                <div class="modal-footer p40">
                    <input type="hidden" name="listId" id="list_id" value="">
                    <button class="btn btn-link text-muted" data-dismiss="modal">Cancel </button>
                    <button data-toggle="modal" id="nextpopup" type="button" class="btn dark_btn bkg_purple">Create</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--=====================================Add List Modal Popup End================================-->

<!-- =======================edit users popup========================= -->





<div id="showVideoPopup" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
			
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Video</h5>
			</div>
            <div class="modal-body">
				
                <div id="divVideo" class="form-group">
                    <video width="100%" height="auto" controls>
                        <source src="" type="video/mp4">
					</video>
				</div>
				
			</div>
            <div class="modal-footer">
                <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                <a id="downloadVideo" class="btn btn-primary" href="" download><i class="icon-download"></i>&nbsp;&nbsp; Download Video</a>
			</div>
			
		</div>
	</div>
</div>


<div id="reviewPopup" class="modal fade">
    <div class="modal-dialog">
        <div class="">
            <div class="col-md-12">
                <div class="panel">
                    <div style="border-top: none; border-bottom: 1px solid #eee!important;" class="panel-footer panel-footer-condensed">
                        <div class="heading-elements not-collapsible">
                            <span class="heading-text text-semibold">
                                <i class="icon-history position-left"></i>
                                <span class="reviewTime"></span>
							</span>
                            <button class="btn btn-link pull-right" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
						</div>
					</div>
                    <div class="panel-body" id="reviewContent"></div>
				</div>
			</div>
		</div>
	</div>
</div>


<div id="previewReviewReply" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body" id="previewReviewReplyContent"></div>
                    <div class="panel-footer panel-footer-condensed">
                        <div class="heading-elements not-collapsible">
                            <button class="btn btn-link pull-right" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>





<!-- <div id="ReviewTagListModal" class="modal fade" style="z-index:9999;">
    <div class="modal-dialog modal-lg">
	<div class="modal-content">
	<div style="border-top: none; border-bottom: 1px solid #eee!important;" class="panel-footer panel-footer-condensed">
	<div class="heading-elements not-collapsible">
	<span class="heading-text text-semibold">
	<i class="fa fa-tag position-left"></i>
	<span class="reviewTime">Apply Tags</span>
	</span>
	<button class="btn btn-link pull-right" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
	</div>
	</div>
	
	
	<form method="post" name="frmReviewTagListModal" id="frmReviewTagListModal" action="javascript:void();">
	
	
	
	<div class="modal-body" id="tagEntireList">
	
	</div>
	
	<div class="modal-footer modalFooterBtn">
	<input type="hidden" name="review_id" id="tag_review_id" />
	<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
	<button type="submit" class="btn btn-primary">Apply Tag</button>
	</div>
	</form>
	</div>
    </div>
</div> -->



<!-- newreviewpopup -->
<div id="newreviewpopup" class="modal fade newreviewpopup2">
    <div class="modal-dialog">
        <div class="modal-content" id="reviewPopupBox"> 
			
		</div>
	</div>
</div>
<!-- /newreviewpopup -->

<div id="commentpopup" class="modal fade">
</div>


<script>
	
    // top navigation fixed on scroll and side bar collasped
	
    $(window).scroll(function () {
        var sc = $(window).scrollTop();
        if (sc > 100) {
            $("#header-sroll").addClass("small-header");
			} else {
            $("#header-sroll").removeClass("small-header");
		}
	});
	
    function smallMenu() {
        if ($(window).width() < 1600) {
            $('body').addClass('sidebar-xs');
			} else {
            $('body').removeClass('sidebar-xs');
		}
	}
	
    $(document).ready(function () {
        smallMenu();
		
        window.onresize = function () {
            smallMenu();
		};
	});
	
	
</script>
@endsection


