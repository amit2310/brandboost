@extends('layouts.main_template')

@section('title')
{{ $title }}
@endsection

@section('contents')

@php
	list($canRead, $canWrite) = fetchPermissions('Feedbacks');
	$feedbackBrand = $result->brand_title;
	$feedbackTitle = $result->title;
	$feedbackDescription = $result->feedback;
	if (empty($feedbackTags)) {
		$feedbackTags = \App\Models\Admin\TagsModel::getTagsDataByFeedbackID($result->id);
	}
@endphp

<script type="text/javascript" src="{{ base_url('assets/js/viewbox.min.js') }}"></script>
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
<style type="text/css">
    .loadMoreRecord {text-align: center; padding: 20px; margin: 0; border-top: 1px solid #eee;}
</style>

<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-7">
                <h3 class="mt30"><img style="width: 18px;" src="{{ base_url() }}assets/images/review_icon.png"/> Feedback Details</h3>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-5 text-right btn_area">
            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->


    <!--================================= CONTENT AFTER TAB===============================-->
    <div class="row">
        <!--------------LEFT----------->
        <div class="col-md-3">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Tags</h6>
                    <div class="heading-elements">
                        <div class="table_action_tool">
                            <a href="#"><img src="{{ base_url() }}assets/images/more.svg"></a>
                        </div>
                    </div>
                </div>
                <div class="panel-body p0" >
                    <div class="profile_sec">
                        <div class="p25">
                            @if (!empty($feedbackTags))
                                @foreach ($feedbackTags as $oTag)
                                    <button class="btn btn-xs btn_white_table">{{ $oTag->tag_name }}</button>
                                @endforeach
                            @endif

							@if (empty($feedbackTags))
								<span><i>No Tags found</i></span>&nbsp;
							@endif

                            <button class="btn btn-xs plus_icon applyInsightTags" feedback_id="{{ base64_url_encode($result->id) }}" action_name="feedback-tag"><i class="icon-plus3"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!------------CENTER------------->
        <div class="col-md-6">
            <!--=========Top Comments===========-->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Feedback{{ $feedbackBrand != '' ? ' : ' . $feedbackBrand : '' }}</h6>
                    <div class="heading-elements">
                        <div class="table_action_tool">
                            <a href="#"><img src="{{ base_url() }}assets/images/more.svg"></a>
                        </div>
                    </div>
                </div>
                <div class="panel-body p30 br0">
                    <strong>{{ $feedbackTitle }}</strong>
                    <p class="fsize13 mb20 lh25 txt_grey2">{{ $feedbackDescription }}</p>

                    @php
						$avatarImage = base_url() . "assets/images/userp.png";
                    @endif

                    <div class="media-left media-middle pr10"> <a class="icons" href="javascript:void(0);"><img style="width: 18px;" src="{{ $avatarImage }}" class="img-circle" alt=""></a> </div>
                    <div class="media-left">
                        <div class="text-muted">by {{ $result->firstname . " " . $result->lastname }}   <span class="ml20"><i class="icon-checkmark3 fsize12 txt_green"></i>&nbsp; Verified Purchase</span></div>
                    </div>
                </div>
                <div class="panel-footer p20 pl30 pr30 ">
                    <p class="mb0 fsize13">
                        <span class="ml20"></span>
                    </p>
                </div>
            </div>
            <!--=========Latest Comments===========-->
            @if (!empty($oAnswers))
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Latest Answers {{ count($oAnswers) > 0 ? '(' . count($oAnswers) . ')' : 0 }}</h6>
                        <div class="heading-elements">
                            <div class="table_action_tool">
                                <a href="#"><img src="{{ base_url() }}assets/images/more.svg"></a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body p0">
                        <div class="comment_sec">
                            <ul class="addMoreComment">
								@php
                                if (!empty($oAnswers)) {

                                    foreach ($oAnswers as $oAnswer) {
                                        $defaultAvatar = base_url() . "assets/images/userp.png";
                                        $avtarImage = $oAnswer->avatar == 'avatar_image.png' ? $defaultAvatar : 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $oAnswer->avatar;
                                        @endphp
                                        <li class="bbot">
                                            <div class="media-left"><img onerror="this.src='{{ $defaultAvatar }}'" width="36" src="{{ $avtarImage }}"/></div>
                                            <div class="media-left pr0 w100">
                                                <p class="fsize14 txt_grey2 lh14 mb-15 ">{{ $oAnswer->firstname . ' ' . $oAnswer->lastname }} <span class="dot">.</span> {{ timeAgo($oAnswer->created) }} <span class="dot">.</span>

                                                    @if ($oAnswer->status == '1')
                                                        <span class="txt_green"><i class="icon-checkmark3 fsize12 txt_green" answer_id="{{ base64_url_encode($oAnswer->id) }}"></i> Approve</span>
                                                    @endif

                                                    @if ($oAnswer->status == 0)
                                                        <span class="txt_red"><i class="icon-checkmark3 fsize12 txt_red" answer_id="{{ base64_url_encode($oAnswer->id) }}"></i> Disapproved</span>
                                                   @endif

                                                    @if ($oAnswer->status == '2')
                                                        <span class="media-annotation"> <span class="label bkg_grey txt_white br5 chg_status addtag" style="cursor: pointer;" change_status="1" answer_id="{{ base64_url_encode($oAnswer->id) }}"> Approve</span> </span>
                                                        <span class="media-annotation dotted"> <span class="label bkg_red txt_white br5 chg_status addtag" style="cursor: pointer;" change_status="0" answer_id="{{ base64_url_encode($oAnswer->id) }}"> Disapprove</span> </span>
                                                    @endif
                                                </p>

                                                <p class="fsize13 mb10 lh23 txt_grey2">
													{!! ($oAnswer->answer) ? nl2br(base64_decode($oAnswer->answer)) : displayNoData() !!}</p>

                                                <div class="button_sec">
                                                    <a class="btn comment_btn p7" href="javascript:void(0);"><i class="icon-thumbs-up2 txt_green"></i></a>
                                                    <a class="btn comment_btn p7" href="javascript:void(0);"><i class="icon-thumbs-down2 txt_red"></i></a>

                                                    <a  href="javascript:void(0);" class="btn comment_btn txt_purple editAnswer" answer_id="{{ base64_url_encode($oAnswer->id) }}">Edit</a>
                                                    <a  href="javascript:void(0);" class="btn comment_btn txt_purple deleteAnswer" answer_id="{{ base64_url_encode($oAnswer->id) }}">Delete</a>
                                                </div>
                                            </div>
                                        </li>
                                        @php
                                    }
                                }
                                @endphp
                            </ul>

                            @if ($totalComment > 5)
                                <input type="hidden" id="numOfComment" value="5">
                                <div class="loadMoreRecord"><a style="cursor: pointer;" id='loadMoreComment' revId="{{ $reviewData->id }}">Load more</a><img class="loaderImage hidden" height="20px" width="20px" src="{{ base_url() }}assets/images/widget_load.gif"></div>
							@endif
                        </div>
                    </div>
                </div>
            @endif
            <!--=========Add Comment===========-->
            @php
				$oFeedback = \App\Models\FeedbackModel::getFeedbackInfo($result->id);
            @endphp

            <form name="frmSendFeedbackReply" id="frmSendFeedbackReply" method="post" action="javascript:void();">
                <input type="hidden" name="fbtime" value="{{ date('M d, Y h:i A', strtotime($oFeedback->created)) }} ({{ timeAgo($oFeedback->created) }})" />
                <input type="hidden" name="fid" value="{{ $oFeedback->id }}" />
                <input type="hidden" name="bid" value="{{ $oFeedback->brandboost_id }}" />
                <input type="hidden" name="cid" value="{{ $oFeedback->client_id }}" />
                <input type="hidden" name="sid" value="{{ $oFeedback->subscriber_id }}" />
                <input type="hidden" name="authorname" value="{{ $oFeedback->subscriber_id }}" />
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Reply Feedback</h6>
                        <div class="heading-elements">
                            <div class="table_action_tool">
                                <a href="#"><img src="{{ base_url() }}assets/images/more.svg"></a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body br0">
                        <textarea name="feedbackReply" id="feedbackReply" required class="form-control addnote" placeholder="Start typing to leave your feedback reply..."></textarea>
                    </div>
                    <div class="panel-footer p20 text-right">
                        <a style="cursor: pointer;"><i class="icon-hash text-muted"></i></a> &nbsp; &nbsp; <a style="cursor: pointer;"><i class="icon-reset text-muted"></i></a>
                        <input type="hidden" id="question_id" name="question_id" value="{{ base64_url_encode($result->id) }}">
                        <button class="btn dark_btn btn-xs ml20" id="sendFeedbackEmail" title="Send SMS" career_medium="sms" type="button" > Send SMS </button>
                        <button class="btn dark_btn btn-xs ml20" id="sendFeedbackSMS" title="Send Email" career_medium="email"  type="button" > Send Email </button>
                    </div>
                </div>
            </form>
        </div>

        <!------------RIGHT------------->
        <div class="col-md-3">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Info</h6>
                    <div class="heading-elements">
                        <script src="{{ base_url() }}assets/js/modules/smart-popup/reviews.js" type="text/javascript"></script>
                        <div class="table_action_tool">
                            <a href="#"><img src="{{ base_url() }}assets/images/more.svg"></a>
                        </div>
                    </div>
                </div>
                <div class="panel-body p0" >
                    <div class="interactions p25">
                        <ul>
                            <li><small>Ref</small> <strong>{!! displayNoData() !!}</strong></li>
                            <li><small>Name</small> <strong>{{ $result->firstname . ' ' . $result->lastname }}  </strong></li>
                            <li><small>Email</small> <strong>{{ $result->email }}</strong></li>
                            <li><small>Phone</small> <strong>{!! ($result->phone) ? $result->phone : displayNoData() !!}</strong></li>
                        </ul>
                    </div>
                    <div class="profile_headings">Feedback Notes <a class="pull-right plus_icon" href="#"><i class="icon-plus3"></i></a></div>
                    @if (!empty($oNotes))
                        @foreach ($oNotes as $oNote)
                            <div class="p25 bbot">
                                <p class="fsize12">{{ $oNote->notes }}</p>
                                <p><small class="text-muted">On {{ date('F d, Y h:i A', strtotime($oNote->created)) }} <br>by {{ $oNote->firstname . ' ' . $oNote->lastname }}</small></p>
                                <div class="text-right">
                                    <a href="javascript:void(0)" class="editNote" noteid="{{ $oNote->id }}"> <span class="label addtag bkg_grey txt_white br5"> Modify</span></a>
                                    <a href="javascript:void(0)" class="deleteNote" noteid="{{ $oNote->id }}"> <span class="label addtag bkg_red txt_white br5"> Delete</span></a>
                                </div>
                            </div>
                        @endforeach
                    @else
						<div class="p25 bbot"><i>No Notes Available</i></div>
                    @endif
                    <div class="p25 btop">
                        <button class="btn dark_btn btn-xs mr20" data-toggle="modal" data-target="#feedbackPopup">Add Note</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--================================= CONTENT AFTER TAB===============================-->
</div>


<div id="editNoteSection" class="modal fade" style="z-index:99999;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal" id="updateNote" action="javascript:void();">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Update Notes</h5>
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

<div id="FeedbackTagListModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" name="frmFeedbackTagListModal" id="frmFeedbackTagListModal" action="javascript:void();">
				@csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Apply Tags</h5>
                </div>

                <div class="modal-body" id="tagEntireList">

                </div>

                <div class="modal-footer">
                    <input type="hidden" name="feedback_id" id="tag_feedback_id" />
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn dark_btn">Apply Tag</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="feedbackPopup" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-tags"></i>&nbsp; Add Feedback Notes</h5>
            </div>
            <div class="modal-body">
                <div class="row">

                    <form method="post" class="form-horizontal" id="frmSaveNote" action="javascript:void();">
                        @csrf
                        <div class="col-md-12 mb-15">
                            <textarea class="form-control" id="add_feedback_popup" name="notes" style="padding: 20px; height: 75px;" placeholder="Add Note"></textarea>
                        </div>
                        <div class="col-md-12 text-right ">
                            <input type="hidden" name="fbtime" value="{{ date('M d, Y h:i A', strtotime($result->created)) }} ({{ timeAgo($oFeedback->created) }})" />
                            <input type="hidden" name="fid" value="{{ $result->id }}" />
                            <input type="hidden" name="bid" value="{{ $result->brandboost_id }}" />
                            <input type="hidden" name="cid" value="{{ $result->client_id }}" />
                            <input type="hidden" name="sid" value="{{ $result->subscriber_id }}" />
                            <input type="hidden" name="authorname" value="{{ $result->subscriber_id }}" />
                            <button data-toggle="modal" data-target="#addnotes" type="button" id="saveFeedbackNote" class="btn dark_btn"> Add Notes &nbsp; <i class="fa fa-angle-double-right"></i> </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {

        $(function () {
            $('.thumbnail2').viewbox();
        });

        $(document).on("click", ".displayFeedback", function () {
            $("#feedbackPopup").modal("show");
        });

        $(document).on("click", "#saveFeedbackNote", function () {
            var formdata = $("#frmSaveNote").serialize();
            $('.overlaynew').show();
            $.ajax({
                url: "{{ base_url('/admin/feedback/saveFeedbackNotes') }}",
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

        $(document).on("click", ".applyInsightTags", function () {
            var review_id = $(this).attr("reviewid");
            var feedback_id = $(this).attr("feedback_id");
            var action_name = $(this).attr("action_name");
            $.ajax({
                url: "{{ base_url('admin/tags/listAllTags') }}",
                type: "POST",
                data: {review_id: review_id, feedback_id: feedback_id, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        $("#tagEntireList").html(data.list_tags);
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


        $("#frmFeedbackTagListModal").submit(function () {
            $('.overlaynew').show();
            var formdata = $("#frmFeedbackTagListModal").serialize();
            $.ajax({
                url: "{{ base_url('admin/tags/applyFeedbackTag') }}",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#FeedbackTagListModal").modal("hide");
                        $('.overlaynew').hide();
                        window.location.href = '';
                    }
                }
            });
            return false;
        });


        $(document).on('click', '.editNote', function () {
            $('.overlaynew').show();
            var noteId = $(this).attr('noteid');
            $.ajax({
                url: "{{ base_url('admin/feedback/getFeedbackNotes') }}",
                type: "POST",
                data: {noteid: noteId,_token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        var noteData = data.result;
                        $('#edit_note_content').val(noteData.notes);
                        $('#edit_noteid').val(noteId);
                        $("#editNoteSection").modal();
                        $('.overlaynew').hide();
                    }
                }
            });
        });


        $("#updateNote").submit(function () {
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            formData.append('_token','{{csrf_token()}}');
            $.ajax({
                url: "{{ base_url('admin/feedback/updateFeedbackNote') }}",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#editNoteSection").modal('hide');
                        $('.overlaynew').hide();
                        window.location.href = '';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });

        $(document).on('click', '.deleteNote', function () {
            var noteId = $(this).attr('noteid');
            swal({
                title: "Are you sure? You want to delete this record!",
                text: "You will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel pls!",
                closeOnConfirm: true,
                closeOnCancel: true
            },
			function (isConfirm) {
				if (isConfirm) {
					$('.overlaynew').show();
					$.ajax({
						url: "{{ base_url('admin/feedback/deleteFeedbackNote') }}",
						type: "POST",
						data: {noteid: noteId,_token: '{{csrf_token()}}'},
						dataType: "json",
						success: function (data) {
							if (data.status == 'success') {
								$('.overlaynew').hide();
								window.location.href = '';
							} else {
								$('.overlaynew').hide();
								alertMessage('Error: Some thing wrong!');
							}
						},
						error: function () {
							$('.overlaynew').hide();
							alertMessage('Error: Some thing wrong!');
						}
					});
				}
			});
        });


        $(document).on("click", "#sendFeedbackEmail, #sendFeedbackSMS", function () {
            var career = $(this).attr("career_medium");
            var alertMsg = 'One credit will be deducted for sending this email/sms!';
            if (career == 'sms') {
                alertMsg = 'One credit will be deducted for sending this sms!';
            } else {
                alertMsg = 'One credit will be deducted for sending this email!';
            }

            swal({
                title: "Are you sure?",
                text: alertMsg,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "Yes, send it!",
                cancelButtonText: "No, cancel pls!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
			function (isConfirm) {
				if (isConfirm) {
					var formdata = $("#frmSendFeedbackReply").serialize();
					$('.overlaynew').show();
					$.ajax({
						url: "{{ base_url('/admin/feedback/replyFeedback') }}",
						type: "POST",
						data: formdata + "&career=" + career,
						dataType: "json",
						success: function (response) {
							$('.overlaynew').hide();
							if (response.status == "success") {
								swal({
									title: "Success!",
									text: response.message,
									confirmButtonColor: "#66BB6A",
									type: "success"
								});
							} else {
								swal({
									title: "ERROR!",
									text: response.message,
									confirmButtonColor: "#2196F3",
									type: "error"
								});
							}
						},
						error: function (response) {
							$('.overlaynew').hide();
							swal({
								title: "ERROR!",
								text: response.message,
								confirmButtonColor: "#2196F3",
								type: "error"
							});
						}
					});
				} else {
					swal({
						title: "Cancelled",
						text: "",
						confirmButtonColor: "#2196F3",
						type: "error"
					});
				}
			});
        });
    });
</script>
@endsection
