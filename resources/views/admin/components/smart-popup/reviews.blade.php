<style>
    .enlarge {
        cursor: pointer;
    }
    .media-expand{
        display:block;
        margin-bottom: 15px;
        width:100%;
        padding-right:0px;

    }

    .media-expand img{
        width:100% !important;
        height: auto !important;

    }

    .smartStickyFooter{
        position: absolute;
        bottom: 72px;
        width: 100%;
        background: #fff;
        border-top: 1px solid #eee;
        padding: 0px;
        left:10px;
    }
    .smartStickyFooter textarea {
        height: 50px!important;
    }


    .thumbnail .thumb img {border-radius: 5px 5px 0 0; height: 220px;}
    .caption-overflow.smallovfl {
        color: #333;
        width: 135px;
        line-height: 95px;
        margin-left: 10px;
    }
    .caption-overflow.smallovfl a {    display: block;    height: 44px;    text-align: center; color: #fff; }
    .caption-overflow.smallovfl a i{font-size: 18px;}
    .small_media_icon:hover .caption-overflow.smallovfl{ visibility: visible !important;

    opacity: 1 !important;

    background: rgba(0,0,0,0.4);

    border-radius: 5px;

    width: 100%;

    left: 0px;

    margin: 0;}
    .smart_img_gallery .image_pagination li a video {
    width: 33.6px!important;
    height: 27.8px!important;
    border-radius: 4px;
    opacity: 0.7;
}
</style>

@php
	$reviewTags = getTagsByReviewID($reviewData->id);
	$mediaArray = unserialize($reviewData->media_url);
@endphp

<input type="hidden" name="smartpopup_review_id" id="smartpopup_review_id" value="{{ $reviewData->id }}" />

<div class="smartpopup-container">
	<div class="p20 pl30">
        <div class="col-md-12">
                <div class="p20">
                    @php
						$subscriberID = $mUser->checkIfSubscriber(array('email' => $reviewData->email));

						if (!empty($subscriberID)) {
							$oSubscriber = $mSubscriber->getGlobalSubscriberInfo($subscriberID->id);

						}

						$mediaArray = unserialize($reviewData->media_url);
						$totalMedia = count($mediaArray);
						if (!empty($mediaArray)) {
							if ($mediaArray[0]['media_type'] == 'image') {
								$mediaSource = "https://s3-us-west-2.amazonaws.com/brandboost.io/" . $mediaArray[0]['media_url'];
								$primaryMedia = '<div class="big_img"><a class="preview_img_src" href="' . $mediaSource . '" data-popup="lightbox"><img class="bb_img_enlagre" src="' . $mediaSource . '"><div class="caption-overflow smallovfl"><i class="icon-eye"></i></div></a></div>';
							} else if ($mediaArray[0]['media_type'] == 'video') {
								$mediaSource = "https://s3-us-west-2.amazonaws.com/brandboost.io/" . $mediaArray[0]['media_url'];
								$primaryMedia = '<video class="media br5 " height="100%" width="100%" controls><source id="bb_video_enlarge" src="' . $mediaSource . '" type="video/mp4"></video><div class="caption-overflow smallovfl"><a class="preview_video_src" style="cursor: pointer;" filepath="' . $mediaSource . '" fileext="mp4"><i class="icon-eye"></i></a></div>';
							}
						}
                    @endphp

                    <div class="big_img @if ($totalMedia <= 1) mr20 @endif small_media_icon col-md-3" style="padding-top:15px;">
                       {!! showUserAvtar($reviewData->avatar, $reviewData->firstname, $reviewData->lastname, 95, 95, 22) !!}
                    </div>

                    <div class="interactions p0 pull-left">
                        <ul>
                            <li><i class="icon-user"></i><strong>{{ $reviewData->firstname . " " . $reviewData->lastname }}</strong></li>
                            <li><i class="icon-envelop2"></i><strong>{{ $reviewData->email }}</strong></li>
                            <li><i class="icon-iphone"></i><strong>{!! $reviewData->phone == '' ? displayNoData() : mobileNoFormat($oSubscriber->phone) !!}</strong></li>
                            <li><i class="icon-calendar"></i><strong>{{ dataFormat($reviewData->created) }}</strong></li>
                        </ul>
                    </div>

                    @if ($totalMedia > 3)
						<div class="clearfix"></div>
                        <div class="pull-left">
                            <a href="{{ base_url() }}admin/brandboost/reviewdetails/{{ $reviewData->id }}"> <span class="label bkg_grey txt_white br5"> View more</span></a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

<ul class="nav nav-tabs nav-tabs-bottom">
    <li class="@if (empty($selectedTab) || $selectedTab == 'undefined' || $selectedTab == 'review') active @endif"><a href="#smartReviewTab" data-toggle="tab">Review</a></li>
    <li class="@if ($selectedTab == 'notes') active @endif"><a href="#smartNotesTab" data-toggle="tab">Notes</a></li>
</ul>

<div class="tab-content">
    <div class="tab-pane @if (empty($selectedTab) || $selectedTab == 'undefined' || $selectedTab == 'review') active @endif" id="smartReviewTab">
        <div class="smart_container" style="min-height:497px;">
            <div class="bbot p30">
				<p class="mb10 fsize16 lh24">{{ $reviewData->review_title }}</p>
                <p class="mb20 txt_grey2 fsize13 lh24">{{ $reviewData->comment_text != '' ? $reviewData->comment_text : '[No Data]' }}</p>
				<div class="smart_img_gallery">
				@if ($totalMedia > 1)
					<ul class="image_pagination">
						@php
						$i = 0;
						foreach ($mediaArray as $media) {
							$i++;
							if ($i <= 3) {
								$media_url = $media['media_url'];
								$mediaSrc = "https://s3-us-west-2.amazonaws.com/brandboost.io/" . $media_url;
								$ext = pathinfo($mediaSrc, PATHINFO_EXTENSION);
								@endphp

								@if ($media['media_type'] == 'image')
									<li><a class="bb_active" href="javascript:void(0);"><img class="loadMainImageMedia" src="{{ $mediaSrc }}" width="37" height="29"></a></li>
								@elseif ($media['media_type'] == 'video')
									<li><a class="bb_active loadMainVideoMedia" data-ext="{{ $ext }}" data-src="{{ $mediaSrc }}" href="javascript:void(0);"><video class="media br5" height="29" width="37" controls><source src="{{ $mediaSrc }}" type="video/{{ $ext }}"></video></a></li>
								@endif
							@php
							}
						}
						@endphp
					</ul>
				@else
					{!! $primaryMedia !!}
				@endif

					<div class="clearfix"></div>
				</div>

                <p class="mb0 fsize13 mt20">
                    @if ($reviewData->ratings >= 4)
						<img class="mr10" src="{{ base_url() }}assets/images/smiley_green.png" width="26">
					@elseif ($reviewData->ratings >= 3)
						<img class="mr10" src="{{ base_url() }}assets/images/smiley_grey2.png" width="26">
					@else
						<img class="mr10" src="{{ base_url() }}assets/images/smiley_red.png" width="26">
					@endif

                    <span>
                        @for ($i = 1; $i <= 5; $i++)
							@if ($i <= $reviewData->ratings)
								<i class="icon-star-full2 fsize12 txt_yellow"></i>
							@else
								<i class="icon-star-full2 fsize12 txt_grey"></i>
							@endif
                        @endfor
                    </span>
                    <span class="ml20">{{ $reviewData->ratings > 0 ? number_format($reviewData->ratings, 1) : 'Unknown' }} Out of 5 Stars</span>
                </p>
            </div>

            @if ($totalComment > 0)
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Latest Comments {{ $totalComment > 0 ? '(' . $totalComment . ')' : '' }}</h6>
                        <div class="heading-elements">
                            <div class="table_action_tool">
                                <a href="#"><img src="{{ base_url() }}assets/images/more.svg"></a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body p0" style="box-shadow:none !important;">
                        <div class="comment_sec smart_container">
                            <ul class="addMoreComment">
                                @php
                                if (!empty($reviewCommentsData)) {
                                    foreach ($reviewCommentsData as $commentData) {
                                        $likeData = $mReviews->getCommentLSByCommentID($commentData->id, 1);
                                        $disLikeData = $mReviews->getCommentLSByCommentID($commentData->id, 0);
                                        $childComments = $mReviews->getReviewAllChildComments($reviewID, $commentData->id);
                                        @endphp
                                        <li class="bbot">
                                            <div class="media-left">
												{!! showUserAvtar($commentData->avatar, $commentData->firstname, $commentData->lastname) !!}
											</div>

                                            <div class="media-left pr0 w100">
                                                <p class="fsize14 txt_grey2 lh14 mb-15 ">
													{{ $commentData->firstname . ' ' . $commentData->lastname }}
													<span class="dot">.</span> {{ timeAgo($commentData->created) }}
													<span class="dot">.</span>

                                                    @if ($commentData->status == '1')
														<span class="txt_green"><i class="icon-checkmark3 fsize12 txt_green"></i> Approve</span>
                                                    @endif

                                                    @if ($commentData->status == 0)
														<span class="txt_red"><i class="icon-checkmark3 fsize12 txt_red"></i> Disapproved</span>
                                                    @endif

                                                    @if ($commentData->status == '2')
                                                        <span class="media-annotation"> <span class="label bkg_grey txt_white br5 chg_smart_status addtag" style="cursor: pointer;" change_status="1" comment_id="{{ $commentData->id }}"> Approve</span> </span>
                                                        <span class="media-annotation dotted"> <span class="label bkg_red txt_white br5 chg_smart_status addtag" change_status="0" comment_id="{{ $commentData->id }}"> Disapprove</span> </span>
                                                    @endif
                                                </p>

                                                <p class="fsize13 mb10 lh23 txt_grey2">
                                                    {{ $commentData->content != '' ? $commentData->content : 'N/A' }}
												</p>

                                                <div class="button_sec">
                                                    <button class="btn btn-link pl0 txt_green">{{ count($likeData) }}</button>
                                                    <a class="btn comment_btn p7" href="javascript:void(0);" onclick="saveSmartCommentLikeStatus('{{ $commentData->id }}', '1', '{{ $reviewData->id }}')"><i class="icon-thumbs-up2 txt_green"></i></a>
                                                    <button class="btn btn-link pl0 txt_red">{{ count($disLikeData) }}</button>
                                                    <a class="btn comment_btn p7" href="javascript:void(0);" onclick="saveSmartCommentLikeStatus('{{ $commentData->id }}', '0', '{{ $reviewData->id }}')"><i class="icon-thumbs-down2 txt_red"></i></a>
                                                    <a style="cursor: pointer;" class="btn comment_btn txt_purple replySmartCommentAction">Reply</a>
                                                    <a  href="javascript:void(0);" class="btn comment_btn txt_purple editSmartComment" commentid="{{ $commentData->id }}">Edit</a>
                                                    <a  href="javascript:void(0);" class="btn comment_btn txt_purple deleteSmartComment" commentid="{{ $commentData->id }}">Delete</a>
                                                </div>

                                                <div class="replyCommentBox" style="display:none;">
                                                    <form method="post" class="form-horizontal" action="javascript:void();">
                                                        <div class="mt10 mb10">
                                                            <textarea name="comment_content" class="form-control comment_content" style="padding: 15px; height: 75px; border:1px solid #eee" placeholder="Comment Reply..." required></textarea>
                                                        </div>
                                                        <div class="text-right">
                                                            <input name="reviweId" class="reviweId" value="{{ $commentData->review_id }}" type="hidden">
                                                            <input name="parent_comment_id" class="parent_comment_id" value="{{ $commentData->id }}" type="hidden">
                                                            <button style="width: 128px;" type="button" class="btn dark_btn addSmartReplyComment"> Reply</button>
                                                        </div>
                                                    </form>
                                                </div>

                                                @php
                                                if (!empty($childComments)) {
                                                    foreach ($childComments as $childComment) {

                                                        $likeChildData = $mReviews->getCommentLSByCommentID($childComment->id, 1);
                                                        $disLikeChildData = $mReviews->getCommentLSByCommentID($childComment->id, 0);
                                                        @endphp
                                                        <div class="reply_sec mt30">
                                                            <div class="media-left">
                                                                {!! showUserAvtar($childComment->avatar, $childComment->firstname, $childComment->lastname) !!}
                                                            </div>
                                                            <div class="media-left pr0">
                                                                <p class="fsize14 txt_grey2 lh14 mb10 ">{{ $childComment->firstname . ' ' . $childComment->lastname }} <span class="dot">.</span> {{ timeAgo($childComment->created) }} </p>
                                                                <p class="fsize13 mb10 lh23 txt_grey2">
                                                                    {{ $childComment->content != '' ? $childComment->content : 'N/A' }}
                                                                </p>
                                                                <div class="button_sec">
                                                                    <button class="btn btn-link pl0 txt_green">{{ count($likeChildData) }}</button>
                                                                    <a href="javascript:void(0);" onclick="saveSmartCommentLikeStatus('{{ $childComment->id }}', '1', '{{ $reviewData->id }}')" class="btn comment_btn p7"><i class="icon-thumbs-up2 txt_green"></i></a>
                                                                    <button class="btn btn-link pl0 txt_red">{{ count($disLikeChildData) }}</button>
                                                                    <a href="javascript:void(0);" onclick="saveSmartCommentLikeStatus('{{ $childComment->id }}', '0', '{{ $reviewData->id }}')" class="btn comment_btn p7"><i class="icon-thumbs-down2 txt_red"></i></a>
                                                                    <a href="javascript:void(0);" commentid="{{ $childComment->id }}" class="btn comment_btn txt_purple editSmartComment">Edit</a>
                                                                    <a href="javascript:void(0);" commentid="{{ $childComment->id }}" class="btn comment_btn txt_purple deleteSmartComment">Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @php
                                                    }
                                                }
                                                @endphp
                                            </div>
                                        </li>
                                        @php
                                    }
                                }
                                @endphp
                            </ul>

                            @if ($totalComment > 5)
								<input type="hidden" id="numOfComment" value="5">
                                <div class="loadMoreRecord text-center"><a style="cursor: pointer;" id='loadSmartMoreComment' revId="{{ $reviewData->id }}">Load more</a><img class="loaderImage hidden" height="20px" width="20px" src="{{ base_url() }}assets/images/widget_load.gif"></div>
							@endif
                        </div>
                    </div>
                </div>
			@endif
        </div>

        <form method="post" class="form-horizontal" id="addSmartComment" action="javascript:void();">
            @csrf
            <div class="smartStickyFooter">
                <div class="box_heading bbot ">
                    <p class="fsize14 fw500 m0">Add Comment</p>
                </div>
                <div class="p20">
                    <textarea name="comment_content" id="comment_content" required class="form-control p0 addnote" placeholder="Start typing to leave a reply..."></textarea>
                </div>
            </div>
            <div class="box_footer_btn">
                <div class="p30">
                <input type="hidden" name="reviweId" id="reviweId" value="{{ $reviewData->id }}">
                <button type="submit" class="btn dark_btn mr20 bkg_purple">Add Comment</button>
                <a href="mailto:{{ $reviewData->email }}" class="btn dark_btn mr20 bkg_purple">Send Email</a>

				@if(!empty($oSubscriber->phone))
					<button type="button" class="btn dark_btn mr20 bkg_purple open-smart-sms-chat" @if ($subscriberID > 0) smart-subs-id="{{ $subscriberID }}" @endif >Send SMS</button>
                @endif

                </div>
            </div>
        </form>
    </div>

    <div class="tab-pane @if ($selectedTab == 'notes') active @endif" id="smartNotesTab">
        <div class="p30">
			@if (!empty($reviewNotesData))
				@foreach ($reviewNotesData as $key => $noteData)
					<p class="mb20 pb20 txt_grey2 fsize13 lh24 bbot">
						{{ $noteData->notes }}
						<span class="pull-right">
							<a href="javascript:void(0)" class="editSmartNote" noteid="{{ $noteData->id }}" questionid="{{ $oQuestion->id }}"> <span class="label addtag bkg_grey txt_white br5"> Modify</span></a>
							<a href="javascript:void(0)" class="deleteSmartNote" noteid="{{ $noteData->id }}" questionid="{{ $oQuestion->id }}"> <span class="label addtag bkg_red txt_white br5"> Delete</span></a>
						</span>
						<br>
						<small class="text-muted">On {{ date('F d, Y h:i A', strtotime($noteData->created)) }} by {{ $noteData->firstname . ' ' . $noteData->lastname }}</small>
					</p>
				@endforeach
			@else
				<p class="mb20 txt_grey2 fsize13 lh24">{!! displayNoData() !!}</p>
			@endif
        </div>

        <form method="post" class="form-horizontal" id="frmSmartSaveNote">
            @csrf
            <div class="smartStickyFooter">
                <div class="box_heading bbot ">
                    <p class="fsize14 fw500 m0">Add Notes</p>
                </div>
                <div class="p20">
                    <textarea name="notes" id="notes" required class="form-control p0 addnote" placeholder="Start typing to add note..."></textarea>
                </div>
            </div>

            <div class="box_footer_btn">
                <div class="p30">
                <input type="hidden" name="reviewid" id="reviewid" value="{{ $reviewData->id }}">
                <input type="hidden" name="cid" id="cid" value="{{ $reviewData->user_id }}">
                <input type="hidden" name="bid" id="bid" value="{{ $reviewData->bbId }}">
                <button type="submit" class="btn dark_btn mr20 bkg_purple">Save Note </button>
                <a href="mailto:{{ $reviewData->email }}" class="btn dark_btn mr20 bkg_purple">Send Email</a>
                @if(!empty($oSubscriber->phone))
					<button type="button" class="btn dark_btn mr20 bkg_purple open-smart-sms-chat" @if ($subscriberID > 0) smart-subs-id="{{ $subscriberID }}" @endif>Send SMS</button>
                @endif
                </div>
            </div>
        </form>
    </div>
</div>
</div>

<script>

    $(document).ready(function () {
        $(".open-smart-sms-chat").click(function () {
            var subsID = $(this).attr("smart-subs-id");
            if (subsID > 0) {
                $("#sidebar-user-box-sms-" + subsID).trigger("click");
            }
        });

        $(".enlarge").click(function () {
            $(this).toggleClass('media-expand');
        });

        $("#addSmartComment").submit(function () {
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            var reviewID = $("#smartpopup_review_id").val();
            $.ajax({
                url: '/admin/comments/add_comment',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        loadSmartPopup(reviewID, 'review');
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });

        $(".loadMainImageMedia").click(function(){
            var mediasource = $(this).attr('src');
            $('.big_img').empty();
            $('.big_img').html('<img class="bb_img_enlagre" src="'+mediasource+'"><div class="caption-overflow smallovfl"><a class="preview_img_src" href="'+mediasource+'" data-popup="lightbox"><i class="icon-eye"></i></a></div>');

        });

        $(".loadMainVideoMedia").click(function(){
            var mediasource = $(this).attr('data-src');
            var mediaExtension = $(this).attr('data-ext');
            $('.big_img').empty();
            $('.big_img').html('<video class="media br5 " height="100%" width="100%" controls><source id="bb_video_enlarge" src="'+ mediasource+'" type="video/mp4"></video><div class="caption-overflow smallovfl"><a class="preview_video_src" style="cursor: pointer;" filepath="'+mediasource+'" fileext="'+mediaExtension+'"><i class="icon-eye"></i></a></div>');

        });
    });
</script>
