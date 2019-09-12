@php
	list($canRead, $canWrite) = fetchPermissions('Feedbacks') @endphp
	$aTags = array('REVIEW_URL')
@endphp
<h5 class="text-semibold no-margin-top row">
    <div class="col-md-6"><a href="javascript:void(0);">{{ $oFeedback->brand_title }}</a></div>
    <div class="col-md-6"><span class="heading-text pull-right label
		@if ($oFeedback->category == 'Positive')
            {{ 'bg-success' }}
        @elseif ($oFeedback->category == 'Neutral')
            {{ 'bg-blue' }}
        @else if ($oFeedback->category == 'Negative')
            {{ 'bg-danger' }}
        @endif
        ">{{ $oFeedback->category }}</span></div>
</h5>

<div class="row">
    <div class="col-md-3">
        <div style="padding:15px 15px 5px; border:1px solid #dddddd; margin:20px 0;">
            <div><img src="{{ base_url() }}profile_images/avatar_image.png" style="width:100%"></div>
            <div style="color:#666; text-align:center; margin-top:10px;">{{ $oFeedback->firstname . ' ' . $oFeedback->lastname }}</div>
        </div>
    </div>
    <div class="col-md-9" style="font-size:16px; line-height:35px; padding:15px;">
        <div>Name : {{ $oFeedback->firstname . ' ' . $oFeedback->lastname }}</div>
        <div>Email Address : {{ $oFeedback->email }}</div>
        <div>Phone Number : {{ $oFeedback->phone }} </div>
        <div>Date Of Feedback : {{ date("M d, Y (h:i A)", strtotime($oFeedback->created)) }}</div>
    </div>
</div>
<div class="row">
    <div class="tabbable col-md-12">
        <ul class="nav nav-tabs nav-tabs-bottom text-semibold">
            <li class="active"><a href="#feedback-tab" data-toggle="tab">Feedback</a></li>
            <li><a href="#note-tab" data-toggle="tab">Notes ({{ empty(sizeof($oNotes)) ? 0 : sizeof($oNotes) }})</a></li>

        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="feedback-tab">
				{{ $oFeedback->feedback }}
                <br>
                @if($canWrite)
					<div class="col-lg-12"><button type="button" class="btn bg-blue-600 displayreplysection pull-right">Respond</button></div>
                @endif
                <br>
                <div class="replysection" style="display:none;">
                <form name="frmSendFeedbackReply" id="frmSendFeedbackReply" method="post">
                    <input type="hidden" name="fbtime" value="{{ date('M d, Y h:i A', strtotime($oFeedback->created)) }} ({{ timeAgo($oFeedback->created) }})" />
                    <input type="hidden" name="fid" value="{{ $oFeedback->id }}" />
                    <input type="hidden" name="bid" value="{{ $oFeedback->brandboost_id }}" />
                    <input type="hidden" name="cid" value="{{ $oFeedback->client_id }}" />
                    <input type="hidden" name="sid" value="{{ $oFeedback->subscriber_id }}" />
                    <input type="hidden" name="authorname" value="{{ $oFeedback->subscriber_id }}" />
                    <div class="form-group">
                        <textarea id="feedbackReply" class="form-control summernote" placeholder="Reply Feedback" name="feedbackReply" required></textarea>
                    </div>
                    <div class="text-right col-lg-12">
						@if($canWrite)
							<button class="btn bg-blue-600" id="sendFeedbackEmail" title="Send SMS" career_medium="sms" type="button" > Send SMS <i class=" icon-arrow-right13 text-size-base position-right"></i></button>
							<button class="btn bg-blue-600" id="sendFeedbackSMS" title="Send Email" career_medium="email"  type="button" > Send Email <i class=" icon-arrow-right13 text-size-base position-right"></i></button>
							<button class="btn btn-warning previewFeedback" brandboost_id="{{ $oFeedback->brandboost_id }}" title="Preview" type="button" > Preview <i class="icon-grid-alt text-size-base position-right"></i></button>
							<button class="btn btn-danger cancelFeedbackReply" title="Cancel" type="button" > Cancel <i class="icon-cross text-size-base position-right"></i></button>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <div class="tab-pane" id="note-tab">
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <tbody>
                        @if (!empty($oNotes))
                            @foreach ($oNotes AS $oNote)
                                <tr>
                                    <td>
                                        <div class=""><a href="#" class="text-default text-semibold">{{ $oNote->notes }}</a></div>
                                        <div class="text-muted text-size-small">
                                            <i>{{ $oNote->firstname . ' ' . $oNote->lastname }} - {{ date("M d, Y h:i A", strtotime($oNote->created)) }} ({{ timeAgo($oNote->created) }})</i>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td><i>No Record(s) Found!</i></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <br>
            <br>
            <form name="frmSaveNote" id="frmSaveNote" method="post">
                <input type="hidden" name="fbtime" value="{{ date('M d, Y h:i A', strtotime($oFeedback->created)) }} ({{ timeAgo($oFeedback->created) }})" />
                <input type="hidden" name="fid" value="{{ $oFeedback->id }}" />
                <input type="hidden" name="bid" value="{{ $oFeedback->brandboost_id }}" />
                <input type="hidden" name="cid" value="{{ $oFeedback->client_id }}" />
                <input type="hidden" name="sid" value="{{ $oFeedback->subscriber_id }}" />
                <input type="hidden" name="authorname" value="{{ $oFeedback->subscriber_id }}" />
                <div class="form-group">
                    <textarea id="add_feedback_popup" class="form-control" placeholder="Add Note" name="notes" required></textarea>
                </div>
                <div class="text-right">
                    @if($canWrite)
						<button class="btn bg-blue-600" id="saveFeedbackNote" title="Add Note" type="button" > Add Note <i class=" icon-arrow-right13 text-size-base position-right"></i></button>
                    @endif
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
        $("#feedbackReply").val(tagname);
    });

    $(document).on("click", ".displayreplysection", function () {
        $(this).hide();
        $(".replysection").show();
    });

    $(document).on("click", ".cancelFeedbackReply", function(){
        $(".replysection").hide();
        $(".displayreplysection").show();
    });

    $(document).on("click", ".previewFeedback", function(){
        var bbid = $(this).attr("brandboost_id");
        var pcontent = $("#feedbackReply").val();
		if(pcontent == ''){
			alertMessage('Please enter reply message to check preview.');
		}else{
			//$('.overlaynew').show();
			$.ajax({
                url: "{{ base_url('/admin/feedback/previewLiveContent') }}",
                type: "POST",
                data: {bbid: bbid, pcontent:pcontent, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (response) {
                    if (response.status == "success") {
                        //$('.overlaynew').hide();
                        $("#previewFeedbackReplyContent").html(response.msg);
                        $("#previewFeedbackReply").modal("show");
                    }
                },
                error: function (response) {
                    alertMessage(response.message);
                }
            });
		}
    });

</script>
