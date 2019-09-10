@php
	$aTags = array('REVIEW_URL');
	$brandboost_id="";
	$oid = "";
	$client_id = "";
	$subscriber_id="";
	$firstname = "";
	$lastname="";
	$email="";
	$created="";
	$review_title="";
	$media_url="";
	$mobile="";
	if(!empty($oReview->brandboost_id)) 
	{
		$brandboost_id  = $oReview->brandboost_id;
	}
	if(!empty($oReview->id)) 
	{
		$oid  = $oReview->id;
	}
	if(!empty($oReview->client_id)) 
	{
		$client_id  = $oReview->client_id;
	}
	if(!empty($oReview->subscriber_id)) 
	{
		$subscriber_id  = $oReview->subscriber_id;
	}
	if(!empty($oReview->firstname)) 
	{
		$firstname  = $oReview->firstname;
	}
	if(!empty($oReview->lastname)) 
	{
		$lastname  = $oReview->lastname;
	}
	if(!empty($oReview->email)) 
	{
		$email  = $oReview->email;
	}
	if(!empty($oReview->created)) 
	{
		$created  = $oReview->created;
	}
	if(!empty($oReview->review_title)) 
	{
		$review_title  = $oReview->review_title;
	}
	if(!empty($oReview->media_url)) 
	{
		$media_url  = $oReview->media_url;
	}
	if(!empty($oReview->mobile)) 
	{
		$mobile  = $oReview->mobile;
	}


	if (!empty($media_url)) {
		if (strpos($media_url, '.mp4') !== false) {
			$mediaType = 'video';
		} else {
			$mediaType = 'image';
		}
	} else {
		$mediaType = '';
	}
@endphp

<div class="row">
    <div class="col-md-3">
        <div style="padding:15px 15px 5px;  margin:20px 0;">
            <div><img src="{{ base_url() }}profile_images/avatar_image.png" style="width:100%"></div>
            <div style="color:#666; text-align:center; margin-top:10px;">{{ $firstname . ' ' . $lastname }}</div>
        </div>
    </div>
    <div class="col-md-9 htext" style="font-size:16px; line-height:35px; padding:15px;">
        <div><strong>Name :</strong> {{ $firstname . ' ' . $lastname }}</div>
        <div><strong>Email Address :</strong> {{ $email }}</div>
        <div><strong>Phone Number :</strong> {{ $mobile }} </div>
        <div><strong>Date Of Review :</strong> {{ date("M d, Y (h:i A)", strtotime($created)) }}</div>
    </div>
</div>
<div class="row">
    <div class="tabbable col-md-12">
        <ul class="nav nav-tabs nav-tabs-bottom text-semibold">
            <li class="active"><a href="#review-tab" data-toggle="tab"><i class="icon-file-text position-left"></i> Review</a></li>
            <li><a href="#note-tab" data-toggle="tab"><i class="icon-price-tag2 position-left"></i> Notes ({{ empty(sizeof($oNotes)) ? 0 : sizeof($oNotes) }})</a></li>
        </ul>
        <div class="tab-content"> 
            <div class="tab-pane active" id="review-tab">
                <div class="w100 @if ($oReview->review_type == 'video') text-center @endif">
					{{ (!empty($oReview->comment_text) ? $oReview->comment_text : ($review_title)) }}
                    @if (!empty($aReview->media_url))
						@if ($mediaType == 'video')
                            <video controls class="bb_media_container">
                                <source src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/{{ $oReview->media_url }}" type="video/mp4">
                            </video>
                        @endif
						
                        @if ($mediaType == 'image')
                            <img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/{{ $oReview->media_url }}" class="bb_media_container" />
                        @endif
					@endif
                </div>
                <br>
                <div class="col-lg-12"><button type="button" class="btn bg-blue-600 displayreplysection pull-right">Respond</button><button type="button" class="btn bg-green-600 pull-right btnapplytag applyInsightTags" action_name="review-tag" reviewid="{{ $oReview->id }}" style="margin: 0 10px;">Add Insight Tags</button></div>
                <br>
                <div class="replysection" style="display:none;">
                    <form name="frmSendFeedbackReply" id="frmSendFeedbackReply" method="post">
						@csrf
                        <input type="hidden" name="fbtime" value="{{ date('M d, Y h:i A', strtotime($oReview->created)) }} ({{ timeAgo($oReview->created) }})" />
                        <input type="hidden" name="fid" value="{{ $oid }}" />
                        <input type="hidden" name="bid" value="{{ $brandboost_id }}" />
                        <input type="hidden" name="cid" value="{{ $client_id }}" />
                        <input type="hidden" name="sid" value="{{ $subscriber_id }}" />
                        <input type="hidden" name="authorname" value="{{ $subscriber_id }}" />
                        <div class="form-group">
                            <textarea id="previewReviewReply" class="form-control" placeholder="Reply Feedback" name="previewReply" required></textarea>
                        </div>
                        <div class="text-right col-lg-12">
                            <button class="btn bg-blue-600" id="sendFeedbackEmail" title="Send SMS" career_medium="sms" type="button" > Send SMS <i class=" icon-arrow-right13 text-size-base position-right"></i></button>
                            <button class="btn bg-blue-600" id="sendFeedbackSMS" title="Send Email" career_medium="email"  type="button" > Send Email <i class=" icon-arrow-right13 text-size-base position-right"></i></button>
                            <button class="btn btn-warning previewReview" brandboost_id="{{ $oReview->campaign_id }}" title="Preview" type="button" > Preview <i class="icon-grid-alt text-size-base position-right"></i></button>
                            <button class="btn bg-green-600 btnApplyTag applyInsightTags" action_name="review-tag" reviewid="{{ $oReview->id }}" type="button">+Tags <i class=" icon-arrow-right13 text-size-base position-right"></i></button>
                            <button class="btn btn-danger cancelReviewReply" title="Cancel" type="button" > Cancel <i class="icon-cross text-size-base position-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="tab-pane" id="note-tab">
                <div style="margin: 20px 0!important;" class="table-responsive">
                    <table class="table text-nowrap">
                        <tbody>
                            @if (!empty($oNotes))
                                @foreach ($oNotes AS $oNote)
                                    <tr>
                                        <td>
                                            <div class=""><a href="#" class="text-default text-semibold">{{ $oNote->notes }}</a></div>
                                            <div class="text-muted text-size-small">
                                                <i>{{ $oNote->firstname . ' ' . $oNote->lastname }} - {{ date("M d, Y h:i A", strtotime($oNote->created)) }}({{ timeAgo($oNote->created) }})</i>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
							@else
                                <tr>
                                    <td style="border: none!important; text-align: center;">No Record(s) Found!</td>
                                </tr>
							@endif
                        </tbody>
                    </table>
                </div>
               
                <form name="frmSaveNote" id="frmSaveNote" method="post">
                    @csrf
                    <input type="hidden" name="reviewtime" value="{{ date('M d, Y h:i A', strtotime($oReview->created)) }} ({{ timeAgo($oReview->created) }})" />
                    <input type="hidden" name="reviewid" value="{{ $oReview->id }}" />
                    <input type="hidden" name="bid" value="{{ $oReview->campaign_id }}" />
                    <input type="hidden" name="cid" value="{{ $oReview->user_id }}" />
                    <div class="form-group">
                        <textarea id="add_feedback_popup" class="form-control" placeholder="Add Note" name="notes" required></textarea>
                    </div>
                    <div class="text-right">
                        <button class="btn bg-blue-600" id="saveReviewNotes" title="Add Note" type="button" > Add Note <i class=" icon-arrow-right13 text-size-base position-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var customTag = '';
	@foreach ($aTags as $value)
        customTag += '<button type="button" data-toggle="tooltip" title="Click to insert Tag" data-tag-name="{{ '{' . $value . '}' }}" class="btn btn-default add_btn draggable insert_tag_button">{{ '{' . $value . '}' }}</button>';
	@endforeach
	
    var fileGroup = '<div class="note-btn-group btn-group note-view">' + customTag + '</div>';
    $(fileGroup).appendTo($('.note-toolbar'));

    $('.insert_tag_button').on('click', function () {
        var tagname = $(this).attr('data-tag-name');
    });

    $(document).on("click", ".displayreplysection", function () {
        $(this).hide();
        $(".btnapplytag").hide();
        $(".replysection").show();
    });

    $(document).on("click", ".cancelReviewReply", function () {
        $(".replysection").hide();
        $(".displayreplysection").show();
        $(".btnapplytag").show();
    });

    $(document).on("click", ".previewReview", function () {
        var bbid = $(this).attr("brandboost_id");
        var pcontent = $("#previewReviewReply").val();
        if (pcontent == '') {
            alertMessage('Please enter reply message to check preview.');
        } else {
            $.ajax({
                url: "{{ base_url('/admin/reviews/previewLiveContentReview') }}",
                type: "POST",
                data: {bbid: bbid, pcontent: pcontent, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (response) {
                    if (response.status == "success") {
                        $("#previewReviewReplyContent").html(response.msg);
                        $("#previewReviewReply").modal("show");
                    }
                },
                error: function (response) {
                    alertMessage(response.message);
                }
            });
        }
    });
</script>