@extends('layouts.main_template') 

@section('title')
{{ $title }}
@endsection

@section('contents')
<style>
.gallery_slider_widget { width: 950px; margin: 0px auto; font-family: 'Inter UI'; font-style: normal; font-weight: 400;	bottom: 35px; box-sizing: border-box; }
.gallery_slider_widget h2{ font-family: InterUI;  font-size: 15px;  font-weight: 500; line-height: 0.67;font-family: 'Inter UI'; margin-bottom: 20px; margin-left: 6px;}
.gallery_slider_widget h2 span{ margin-left: 15px; color: #5e5e7c; font-weight: normal;}
.gallery_slider_widget .top_header {width: 100%;}
.gallery_slider_widget .arrow {position: relative;top: 72px;right: 0;left: 0;width: 100%;z-index:9;}
.gallery_slider_widget .middle .box_1 {max-width: 180px; width: 100%;float: left; padding: 5px; border-radius: 5px; box-sizing: border-box; border-radius: 2.8px; background: #ffffff; margin: 0 2px; max-height: 180px; position:relative;}

.img_overlay{position:absolute; width:100%; height:100%; text-align:center; line-height:100%; top:0px; left:0px; background:rgba(0, 0, 0, 0.5); color:#FFF; font-size:16px; padding-top:48%; box-sizing:border-box; display:none; cursor:pointer;}
.gallery_slider_widget .middle .box_1:hover .img_overlay{display:block;}
.gallery_slider_widget .middle .box_1 img{width: 100%;}
.gallery_slider_widget .arrow .left_arrow {background: #fff;width: 42px;height: 42px;border-radius: 100%;display: inline-block;box-shadow: 0 2px 1px 0 rgba(0, 36, 128, 0.11), 0 0 1px 0 rgba(0, 0, 0, 0.05);line-height: 42px; position: absolute; left: -15px; text-align: center;}
.gallery_slider_widget .arrow .right_arrow {background: #fff;width: 42px;height: 42px;border-radius: 100%;display: inline-block;box-shadow: 0 2px 1px 0 rgba(0, 36, 128, 0.11), 0 0 1px 0 rgba(0, 0, 0, 0.05);    line-height: 42px; position: absolute; right: -15px; text-align: center;}

.gallery_slider_widget .footer_div{margin-top: 20px;display: inline-block; width: 100%;box-sizing: border-box;}
.gallery_slider_widget .footer_div .left{float: left;}
.gallery_slider_widget .footer_div .left img{float: left; margin-left: 4px;}
.gallery_slider_widget .footer_div .left p{float: left;font-size: 14px;font-weight: bold; color: #1e1e40; margin: 0 10px 0 10px; padding: 0;}
.gallery_slider_widget .footer_div .left span{float: left;font-weight: normal; color: #525378;}
.gallery_slider_widget .footer_div .right{float: right;margin-right: 6px;color: #8787a5;}
.gallery_slider_widget .footer_div .right img{float: left; margin-right: 5px; margin-top: 3px;}

.gallery_slider_widget.slides3{width: 552px;}
.gallery_slider_widget.slides4{width: 736px;}
.gallery_slider_widget.slides5{width: 920px;}
.gallery_slider_widget.slides6{width: 1104px;}
.gallery_slider_widget.slides7{width: 1288px;}

.gallery_slider_widget.slides3.imgSizeSmall{width: 492px;}
.gallery_slider_widget.slides3.imgSizeSmall .middle .box_1 {max-width: 160px; max-height: 160px;}

.gallery_slider_widget.slides4.imgSizeSmall{width: 656px;}
.gallery_slider_widget.slides4.imgSizeSmall .middle .box_1 {max-width: 160px; max-height: 160px;}

.gallery_slider_widget.slides5.imgSizeSmall{width: 820px;}
.gallery_slider_widget.slides5.imgSizeSmall .middle .box_1 {max-width: 160px; max-height: 160px;}

.gallery_slider_widget.slides6.imgSizeSmall{width: 984px;}
.gallery_slider_widget.slides6.imgSizeSmall .middle .box_1 {max-width: 160px; max-height: 160px;}

.gallery_slider_widget.slides7.imgSizeSmall{width: 1148px;}
.gallery_slider_widget.slides7.imgSizeSmall .middle .box_1 {max-width: 160px; max-height: 160px;}


.gallery_slider_widget.slides3.imgSizeLarge{width: 612px;}
.gallery_slider_widget.slides3.imgSizeLarge .middle .box_1 {max-width: 200px; max-height: 200px;}

.gallery_slider_widget.slides4.imgSizeLarge{width: 816px;}
.gallery_slider_widget.slides4.imgSizeLarge .middle .box_1 {max-width: 200px; max-height: 200px;}

.gallery_slider_widget.slides5.imgSizeLarge{width: 1020px;}
.gallery_slider_widget.slides5.imgSizeLarge .middle .box_1 {max-width: 200px; max-height: 200px;}

.gallery_slider_widget.slides6.imgSizeLarge{width: 1224px;}
.gallery_slider_widget.slides6.imgSizeLarge .middle .box_1 {max-width: 200px; max-height: 200px;}

.gallery_slider_widget.slides7.imgSizeLarge{width: 1428px;}
.gallery_slider_widget.slides7.imgSizeLarge .middle .box_1 {max-width: 200px; max-height: 200px;}

.gallery_slider_widget.imgSizeSmall .arrow {top: 62px;}
.gallery_slider_widget.imgSizeLarge .arrow {top: 82px;}

.gallery_slider_widget.imgSizeSmall .middle .box_1 img{height:149px;}
.gallery_slider_widget.imgSizeMedium .middle .box_1 img{height:169px;}
.gallery_slider_widget.imgSizeLarge .middle .box_1 img{height:189px;}

.borderBoxShadow{box-shadow:2px 1px 6px 1px #666666!important;}

</style>
<div class="content">		  
<!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
<div class="page_header">
  <div class="row">
  <!--=============Headings & Tabs menu==============-->
	<div class="col-md-7">
	  <h3><img src="{{ base_url() }}assets/images/gallery_icon.png" style="width: 16px;"> Gallery</h3>
	  <ul class="nav nav-tabs nav-tabs-bottom">
		<li class="active all"><a style="javascript:void();" id="activeCampaign" class="filterByColumn" fil="Publish">All</a></li>
		<li><a style="javascript:void();" class="filterByColumn" fil="Archive">Archive</a></li>
	  </ul>
	</div>
	<!--=============Button Area Right Side==============-->
	<div class="col-md-5 text-right btn_area">
	  <button type="button" class="btn dark_btn ml10" data-toggle="modal" data-target="#addGallery"><i class="icon-plus3 "></i><span> &nbsp;  Add Gallery</span> </button>
	</div>
  </div>
</div>
<!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->

<!--&&&&&&&&&&&& TABBED CONTENT &&&&&&&&&&-->
<div class="tab-content"> 
  <!--===========TAB 1=====Configuration======-->
	<div class="row">
	  <div class="col-md-12">
		<div style="margin: 0;" class="panel panel-flat">
		  <div class="panel-heading">
			<h6 class="panel-title">Galleries</h6>
			<div class="heading-elements">
				<div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
					<input class="form-control input-sm cus_search" tableid="mediaGalleryDataList" placeholder="Search by name" type="text">
					<div class="form-control-feedback">
						<i class=""><img src="{{ base_url() }}assets/images/icon_search.png" width="14"></i>
					</div>
				</div>
				<div class="table_action_tool">
					<a href="#" class="brig pr-15">Updated just now &nbsp; <i class=""><img src="{{ base_url() }}assets/images/icon_refresh.png"/></i></a>
					<a href="javascript:void(0)"><i class=""><img src="{{ base_url() }}assets/images/icon_calender.png"/></i></a>
					<a href="javascript:void(0)" id="deleteMediaWidget" class="custom_action_box" style="display:none;">
						<i class="icon-trash position-left"></i>
					</a>
					<a href="javascript:void(0)" id="archiveButtonMediaWidget" class="custom_action_box" style="display:none;"><i class="icon-gear position-left"></i></a>
					<a href="javascript:void(0)" class="editDataList"><i class=""><img src="{{ base_url() }}assets/images/icon_edit.png"/></i></a>
				</div>			
			</div>
		  </div>
			<div class="panel-body p0">
				<table class="table" id="mediaGalleryDataList">
					<thead>
						<tr>
							<th style="display: none;"></th>
							<th style="display: none;"></th>
							<th style="display: none;" class="nosort editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
							<th><i class=""><img src="{{ base_url() }}assets/images/icon_name.png"></i>Name</th>
							<th><i class=""><img src="{{ base_url() }}assets/images/icon_device.png"></i>Media</th>
							<th><i class=""><img src="{{ base_url() }}assets/images/icon_clock.png"></i>Type</th>
							<th><i class=""><img src="{{ base_url() }}assets/images/icon_id.png"></i>Created</th>
							<th><i class=""><img src="{{ base_url() }}assets/images/icon_id.png"></i>Created By</th>
							<th><i class=""><img src="{{ base_url() }}assets/images/icon_action.png"></i>Action</th>
							<th>&nbsp;</th>
							<th style="display: none;"></th>
						</tr>
					</thead>
					<tbody>
						@php 
						foreach ($allGallery as $galleryData){
							$galleryData = \App\Models\Admin\MediaModel::getGalleryData($galleryData->id);			
							$reviewsIdArray = unserialize($galleryData->reviews_id);
							$reviewsData = \App\Models\ReviewsModel::getAllReviewsByUserId($userId);
							$reviewList = '';
							/*foreach ($reviewsData as $review) {
								if (in_array($review->id, $reviewsIdArray))
								{
									if($review->review_title != ''){
										$reviewList .= '<button class="btn btn-xs btn_white_table pr10">'.$review->review_title.'</button>';
									}
								}
							}
							
							if(count($reviewsIdArray) > 0){
								$reviewCount = '<div class="media-left pl30 blef">
													&nbsp;
												</div>
												<div class="media-left pr30 brig">
													<div class="tdropdown">
														<a href="javascript:void(0);" class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown" aria-expanded="false">'.count($reviewsIdArray).' Media</a>
														<ul style="right: 0px!important;" class="dropdown-menu dropdown-menu-right tagss">
															'.$reviewList.'
															<button class="btn btn-xs plus_icon addMedia" data-id="'.$galleryData->id.'"><i class="icon-plus3"></i></button>
														</ul>
													</div>
												</div>';
							}else{
								$reviewCount = '<div class="media-left pl30 blef">
													&nbsp;
												</div>
												<div class="media-left pr30 brig">
													<div class="tdropdown">
														<a href="javascript:void(0);" class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown" aria-expanded="false">0 Media</a>
														
														<ul style="right: 0px!important;" class="dropdown-menu dropdown-menu-right tagss">
															<button class="btn btn-xs plus_icon addMedia" data-id="'.$galleryData->id.'"><i class="icon-plus3"></i></button>
														</ul>
													</div>
												</div>';
							}*/
							
							$reviewCount = '';
							
							if($galleryData->team_id != ''){
								$createdByData = getTeamMemberById($galleryData->team_id);
							}else{
								$createdByData = getUserDetailsByUserID($galleryData->user_id);
							}
						@endphp
						<tr id="append-{{ $galleryData->id }}" class="selectedClass">
							<td style="display: none;">{{ date('m/d/Y', strtotime($galleryData->created)) }}</td>
							<td style="display: none;">{{ $galleryData->id }}</td>
							<td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" id="chk{{ $galleryData->id }}" value="{{ $galleryData->id }}" ><span class="custmo_checkmark"></span></label></td>
							<td>
								<div class="media-left media-middle"> <a class="icons" href="{{ base_url() }}admin/mediagallery/setup/{{ $galleryData->id }}"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/{{ $galleryData->gallery_logo }}" onerror="this.src='{{ base_url('assets/images/wakerslogo.png') }}'" class="img-circle br5 img-xs" alt=""></a> </div>
								<div class="media-left">
									<div class=""><a href="{{ base_url() }}admin/mediagallery/setup/{{ $galleryData->id }}" class="text-default text-semibold">{{ $galleryData->name }}</a> </div>
								</div>
							</td>
							<td id="reviewsListCount_{{ $galleryData->id }}">
								{{ $reviewCount }}
							</td>
							<td><a href="javascript:void(0);" class="getGalleryImage text-muted" gallery-type="{{ $galleryData->gallery_type }}" gallery-id="{{ $galleryData->id }}">{{ $galleryData->gallery_type < 3 ? 'Grid' : $galleryData->gallery_type. ' Images' }}</a></td>
							<td>
								<div class="media-left">
									<div class="pt-5">
										<a href="javascript:void(0);" class="text-default text-semibold">
											{{ dataFormat($galleryData->created) }}
										</a>
									</div>
									<div class="text-muted text-size-small">{{ date('h:i A', strtotime($galleryData->created)) }}</div>
								</div>
							</td>
							<td>
								<div class="media-left media-middle"> {!! showUserAvtar($createdByData->avatar, $createdByData->firstname, $createdByData->lastname) !!}</div>
								<div class="media-left">
									<div class="pt-5"><a href="javascript:void();" class="text-default text-semibold bbot">{{ $createdByData->firstname . ' ' . $createdByData->lastname }}</a><img class="flags" src="{{ base_url() }}assets/images/flags/{{ strtolower($createdByData->userCountry) }}.png" onerror="this.src='{{ base_url('assets/images/flags/us.png') }}'"/> </div>
									<div class="text-muted text-size-small">{{ $createdByData->email }}</div>
								</div>
							</td>
							<td>
								<div class="tdropdown open">
									@if ($galleryData->status == '1')
										<i class="icon-primitive-dot txt_green fsize16"></i> 
									@else if ($galleryData->status == '2')
										<i class="icon-primitive-dot txt_red fsize16"></i> 
									@else
										<i class="icon-primitive-dot txt_red fsize16"></i> 
									@endif

									<a class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										@if ($galleryData->status == '1')
											{{ 'Active' }}
										@else if ($galleryData->status == '2')
											{{ 'Archive' }}
										@else
											{{ 'Inactive' }}
										@endif
									</a>
									<ul class="dropdown-menu dropdown-menu-right status" style="right: 0;">
										@if ($galleryData->status == '1')
											<li><a href="javascript:void(0);" class="updateStatus" gallery-id="{{ $galleryData->id }}" data-status="0"><i class="icon-primitive-dot txt_red"></i> Inactive</a> </li>
											<li><a href="javascript:void(0);" class="updateStatus" gallery-id="{{ $galleryData->id }}" data-status="2"><i class="icon-primitive-dot txt_red"></i> Archive</a> </li>
										@else if ($galleryData->status == '2')
											<li><a href="javascript:void(0);" class="updateStatus" gallery-id="{{ $galleryData->id }}" data-status="1"><i class="icon-primitive-dot txt_green"></i> Active</a> </li>
											<li><a href="javascript:void(0);" class="updateStatus" gallery-id="{{ $galleryData->id }}" data-status="0"><i class="icon-primitive-dot txt_red"></i> Inactive</a> </li>
										@else
											<li><a href="javascript:void(0);" class="updateStatus" gallery-id="{{ $galleryData->id }}" data-status="1"><i class="icon-primitive-dot txt_green"></i> Active</a> </li>
											<li><a href="javascript:void(0);" class="updateStatus" gallery-id="{{ $galleryData->id }}" data-status="2"><i class="icon-primitive-dot txt_red"></i> Archive</a> </li>
										@endif
									</ul>
								</div>
							</td>
							<td>
								<div class="media-left pull-right text-right">
									<div class="tdropdown ml10"> 
										<a class="table_more dropdown-toggle" data-toggle="dropdown"><img src="{{ base_url() }}assets/images/more.svg"></a>
										<ul style="right: 0;" class="dropdown-menu dropdown-menu-right status">
											@if ($galleryData->status == '1')
												<li><a href="javascript:void(0);" class="updateStatus" gallery-id="{{ $galleryData->id }}" data-status="0"><i class="icon-primitive-dot txt_red"></i> Inactive</a> </li>
												<li><a href="javascript:void(0);" class="updateStatus" gallery-id="{{ $galleryData->id }}" data-status="2"><i class="icon-primitive-dot txt_red"></i> Archive</a> </li>
											@else if ($galleryData->status == '2')
												<li><a href="javascript:void(0);" class="updateStatus" gallery-id="{{ $galleryData->id }}" data-status="1"><i class="icon-primitive-dot txt_green"></i> Active</a> </li>
												<li><a href="javascript:void(0);" class="updateStatus" gallery-id="{{ $galleryData->id }}" data-status="0"><i class="icon-primitive-dot txt_red"></i> Inactive</a> </li>
											@else
												<li><a href="javascript:void(0);" class="updateStatus" gallery-id="{{ $galleryData->id }}" data-status="1"><i class="icon-primitive-dot txt_green"></i> Active</a> </li>
												<li><a href="javascript:void(0);" class="updateStatus" gallery-id="{{ $galleryData->id }}" data-status="2"><i class="icon-primitive-dot txt_red"></i> Archive</a> </li>
											@endif
											
											<li><a href="javascript:void(0);" class="editGallery" gallery-id="{{ $galleryData->id }}" gallery-name="{{ $galleryData->name }}"><i class="icon-pencil"></i> Edit</a> </li>
											<li><a class="deleteGallery" gallery-id="{{ $galleryData->id }}" href="javascript:void(0);"><i class="icon-trash"></i> Delete</a></li>
										</ul>
									</div>
								</div>
							</td>
							<td style="display: none;">{{ $galleryData->status == 2 ? 'archive' : 'publish' }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	  </div>
	</div>

</div>
<!--================================= CONTENT AFTER TAB===============================-->
</div>


<div id="showGalleryImages" class="modal fade in">
    <div class="modal-dialog" style="width:1200px;">
        <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h5 class="modal-title"><img src="/assets/images/menu_icons/List_Color.svg"/> Gallery Images &nbsp; <i class="icon-info22 fsize12 txt_grey"></i></h5>
			</div>
			<div class="modal-body" id="mediaGalleryPreview">
				<div class="gallery_slider_widget"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link h52" data-dismiss="modal">Close</button>
			</div>
        </div>
    </div>
</div>

<div id="editGalleryModel" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="frmUpdateGallery" name="frmUpdateGallery">
				@csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><img src="/assets/images/menu_icons/List_Color.svg"/> Edit Contact List &nbsp; <i class="icon-info22 fsize12 txt_grey"></i></h5>
                </div>
                <div class="modal-body" style="padding-bottom:0px;">
                    <p>List Name:</p>
                    <input class="form-control h52" id="editGalleryName" name="editGalleryName" placeholder="Enter Gallery Name" type="text" required>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="editGalleryId" id="editGalleryId" value="" />
                    <button type="submit" class="btn btn-primary h52">Update</button>
                    <button type="button" class="btn btn-link h52" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- add New List -->
<div id="addGallery" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="frmAddGallery" id="frmAddGallery" action="javascript:void();">
				@csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><img src="{{ base_url() }}assets/css/menu_icons/Email_Color.svg"/> Create Gallery &nbsp; <i class="icon-info22 fsize12 txt_grey"></i></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Gallery Name</label>
                                <input class="form-control" id="title" name="title" placeholder="Enter Title" type="text" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn dark_btn bkg_sblue fsize14 h52">Continue</button>
                    <button data-toggle="modal" data-dismiss="modal" type="button" class="btn btn-link fsize14 txt_blue h52">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /add New List -->

<!-- add New List -->
<div id="selectReviews" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" name="frmSelectReviews" id="frmSelectReviews" action="javascript:void();">
				@csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><img src="{{ base_url() }}assets/css/menu_icons/Email_Color.svg"/> Select Media &nbsp; <i class="icon-info22 fsize12 txt_grey"></i></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" id="reviewsDataList"></div>
                    </div>
                </div>
                <div class="modal-footer">
					<input type="hidden" name="galleryId" id="galleryIdValue" value="">
                    <button type="submit" class="btn dark_btn bkg_sblue fsize14 h52">Save</button>
                    <button data-toggle="modal" data-dismiss="modal" type="button" class="btn btn-link fsize14 txt_blue h52">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /add New List -->

<script>
	var sliderBoxCount = 6;
	var slideIndex = 0;
	function showSlides(n=1) {
		var i;
		var slides = document.getElementsByClassName("sliderImage");
		if(n > 0){
			if(slides.length > sliderBoxCount + slideIndex){
				slides[slideIndex].style.display = "none";
				slides[sliderBoxCount + slideIndex].style.display = "block";
				slideIndex++;
				document.getElementsByClassName("right_arrow")[0].style.backgroundColor = '#fff';
				document.getElementsByClassName("left_arrow")[0].style.backgroundColor = '#fff';
				if(slides.length == sliderBoxCount + slideIndex){
					document.getElementsByClassName("right_arrow")[0].style.backgroundColor = '#eee';
				}
			}else{
				document.getElementsByClassName("right_arrow")[0].style.backgroundColor = '#eee';
			}
		}else{
			if((slides.length >= sliderBoxCount + slideIndex) && (slideIndex > 0)){
				--slideIndex;
				slides[slideIndex].style.display = "block";
				slides[sliderBoxCount + slideIndex].style.display = "none";
				document.getElementsByClassName("right_arrow")[0].style.backgroundColor = '#fff';
				document.getElementsByClassName("left_arrow")[0].style.backgroundColor = '#fff';
				
				if(sliderBoxCount == sliderBoxCount + slideIndex){
					document.getElementsByClassName("left_arrow")[0].style.backgroundColor = '#eee';
				}
			}else{
				document.getElementsByClassName("left_arrow")[0].style.backgroundColor = '#eee';
			}
		}
	}

	$(document).ready(function () { 
		
		// Setup - add a text input to each footer cell
	   $('#mediaGalleryDataList thead tr').clone(true).appendTo('#mediaGalleryDataList thead');        
	   $('#mediaGalleryDataList thead tr:eq(1) th').each(function (i) {            
			if (i === 10) {
				var title = $(this).text();
				$(this).html('<input type="text" id="filterByStatus" value="" placeholder="Search ' + title + '" />');                
				$('input', this).on('keyup change', function () {
				if (tableBase.column(i).search() !== this.value) {
						tableBase
						.column(i)
						.search(this.value, $('#colStatus').prop('checked', true))
						.draw();
					}
				});
			}
	   });
		
		var tableId = 'mediaGalleryDataList';
		var tableBase = custom_data_table(tableId);
		
		$(document).on('click', '.filterByColumn', function () {            
			$('.nav-tabs').each(function (i) {
			   $(this).children().removeClass('active');
			});

			$(this).parent().addClass('active');
			var fil = $(this).attr('fil');
			$('#filterByStatus').val(fil);
			$('#filterByStatus').keyup();        
		});
		
		setTimeout(function () {
			$('#activeCampaign').trigger('click');
		}, 100);
		
		$(document).on('click', '.editDataList', function () {
			$('.editAction').toggle();
		});
		
		$(document).on('click', '.getGalleryImage', function (e) {
			$('.overlaynew').show();
			var galleryId = $(this).attr('gallery-id');
			sliderBoxCount = $(this).attr('gallery-type');
			e.preventDefault();		
			$.ajax({
				url: "{{ base_url() }}/admin/mediagallery/getGalleryImages",
				method: "POST",
				data: {'gallery_id': galleryId, _token: '{{csrf_token()}}'},
				dataType: "json",
				success: function (data)
				{
					$('.overlaynew').hide();
					if (data.status == "success")
					{
						$('#mediaGalleryPreview .gallery_slider_widget').html('<div class="slides'+sliderBoxCount+'">'+ data.sliderView +'</div>');
						slideIndex = 0;
						$('#showGalleryImages').modal();
					} else {
						displayMessagePopup('error');
					}
				}
			});
		});
		
		$(document).on('click', '.reviewArrowBH a', function(e){
			var bd = $(this).attr("bb_direction");
			if (bd == 'right') {
				showSlides(1)
			} else if (bd == 'left') {
				showSlides(-1)
			}
		});
		
		$('.addMedia').click(function(){
			var galleryId = $(this).attr('data-id');
			$('#galleryIdValue').val(galleryId);
			$(".overlaynew").show();
			$.ajax({
				url: "{{ base_url('admin/mediagallery/getReviewsList') }}",
				type: "POST",
				data: {'gallery_id': galleryId, _token: '{{csrf_token()}}'},
				dataType: "json",
				success: function (data) {
					if (data.status == 'success') {
						$(".overlaynew").hide();
						$('#selectReviews').modal();
						$('#reviewsDataList').html(data.content);
					} else {
						alertMessage('Error: Some thing wrong!');
					}
				}
			});
		});
			
		$(document).on('change', '#checkAll', function () {
			if (false == $(this).prop("checked")) {
				$(".checkRows").prop('checked', false);
				$(".selectedClass").removeClass('success');
				$('.custom_action_box').hide();
			} else {
				$(".checkRows").prop('checked', true);
				$(".selectedClass").addClass('success');
				$('.custom_action_box').show();
			}
		});
		
		$(document).on('click', '.checkRows', function () {
			var inc = 0;
			var rowId = $(this).val();
			
			if (false == $(this).prop("checked")) {
				$('#append-' + rowId).removeClass('success');
			} else {
				$('#append-' + rowId).addClass('success');
			}

			$('.checkRows:checkbox:checked').each(function (i) {
				inc++;
			});
			
			if (inc == 0) {
				$('.custom_action_box').hide();
			} else {
				$('.custom_action_box').show();
			}

			var numberOfChecked = $('.checkRows:checkbox:checked').length;
			var totalCheckboxes = $('.checkRows:checkbox').length;
			if (totalCheckboxes > numberOfChecked) {
				$('#checkAll').prop('checked', false);
			}

			if (totalCheckboxes == numberOfChecked) {
				$('#checkAll').prop('checked', true);
			}
		});
				
		$('#frmAddGallery').on('submit', function () {
			$('.overlaynew').show();
			var formdata = $("#frmAddGallery").serialize();
			$.ajax({
				url: "{{ base_url('admin/mediagallery/addList') }}",
				type: "POST",
				data: formdata,
				dataType: "json",
				success: function (data) {
					if (data.status == 'success') {
						$('.overlaynew').hide();
						$('#addGallery').modal('hide');
						window.location.href = '{{ base_url() }}admin/mediagallery/setup/'+data.gallery_id;
					} else {
						
					}
				}
			});
			return false;
		});

		$('#frmSelectReviews').on('submit', function () {
			$('.overlaynew').show();
			var formdata = $("#frmSelectReviews").serialize();
			var galleryId = $('#galleryIdValue').val();
			$.ajax({
				url: "{{ base_url('admin/mediagallery/saveReviewsList') }}",
				type: "POST",
				data: formdata,
				dataType: "json",
				success: function (data) {
					if (data.status == 'success') {
						$('.overlaynew').hide();
						$('#selectReviews').modal('hide');
						$('#reviewsListCount_'+galleryId).html(data.reviewCount);
					} else {
						$('.overlaynew').hide();
						alertMessage('Error: Some thing wrong!');
					}
				}
			});
			return false;
		});

		$(document).on('click', '.editGallery', function(){
			var galleryId = $(this).attr('gallery-id');
			var galleryName = $(this).attr('gallery-name');
			$('#editGalleryName').val(galleryName);
			$('#editGalleryId').val(galleryId);
			$('#editGalleryModel').modal();		
		});	

		$(document).on("click", ".updateStatus", function () {
			var galleryId = $(this).attr('gallery-id');
			var status = $(this).attr('data-status');
			$(".overlaynew").show();
			$.ajax({
				url: "{{ base_url('admin/mediagallery/updateStatus') }}",
				type: "POST",
				data: {'gallery_id': galleryId, status: status, _token: '{{csrf_token()}}'},
				dataType: "json",
				success: function (data) {
					if (data.status == 'success') {
						$(".overlaynew").hide();
						displayMessagePopup('success', '', data.msg); 
						window.location.href = window.location.href;
					} else {
						alertMessage('Error: Some thing wrong!');
					}
				}
			});
		});

		$('#frmUpdateGallery').on('submit', function () {
			$('.overlaynew').show();
			var formdata = $("#frmUpdateGallery").serialize();
			var editGalleryId = $('#editGalleryId').val();
			$.ajax({
				url: "{{ base_url('admin/mediagallery/updateGallery') }}",
				type: "POST",
				data: formdata,
				dataType: "json",
				success: function (data) {
					if (data.status == 'success') {
						$('.overlaynew').hide();
						$("#editGalleryModel").modal('hide');
						window.location.href = "{{ base_url() }}admin/mediagallery/setup/"+editGalleryId;
					}else{
						$('.overlaynew').hide();
						alertMessage('Error: Some thing wrong!');
					}
				}
			});
			return false;
		});
		
		$(document).on('click', '.deleteGallery', function () {
			var elem = $(this);
			deleteConfirmationPopup(
			"This record will deleted immediately.<br>You can't undo this action.",
			function () {
				$('.overlaynew').show();
				var galleryId = $(elem).attr('gallery-id');
				$.ajax({
					url: "{{ base_url('admin/mediagallery/deleteGallery') }}",
					type: "POST",
					data: {gallery_id: galleryId, _token: '{{csrf_token()}}'},
					dataType: "json",
					success: function (data) {
						if (data.status == 'success') {
							$('.overlaynew').hide();
							window.location.href = window.location.href;
						}
					}
				});
			});
		});
	});
</script>
@endsection