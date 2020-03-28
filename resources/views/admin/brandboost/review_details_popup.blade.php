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
    .step_star ul > li.star > i.fa {

        font-size: 20px!important;
    }
</style>
<div style="border-top: none; border-bottom: 1px solid #eee!important;" class="panel-footer panel-footer-condensed">
    <div class="heading-elements not-collapsible"> <span class="heading-text text-semibold"> <i class="icon-history position-left"></i> <span class="reviewTime">{{ date('F d, Y h:i A', strtotime($reviewData->created)) }} ({{ timeAgo($reviewData->created) }})</span> </span>
        <button style="padding: 7px 0 0 0;" class="btn btn-link pull-right" data-dismiss="modal"><i class="icon-cross"></i></button>
    </div>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-3">
            <div style="padding:15px 15px 5px;  margin:20px 0;">
                <div><img src="{{ base_url() }}/assets/images/default_user_img.png" style="width:100%"></div>

            </div>
        </div>
        <div class="col-md-9 htext">
            <div class="cust_details mb30">
                <div class="row">
                    <div class="col-md-12 inner">
                        <h3><i class="fa fa-info-circle"></i>&nbsp; Customer Information <small class="text-success-400 mt-5 pull-right"><i class="fa text-success-400 fa-check"></i> Verified Purchase</small></h3>
                        <p><strong><i class="fa fa-angle-double-right"></i> &nbsp; Refrence: </strong> <span>N/A</span></p>
                        <p><strong><i class="fa fa-angle-double-right"></i> &nbsp; Name: </strong> <span>{{ $reviewData->firstname }} {{ $reviewData->lastname }}</span></p>
                        <p><strong><i class="fa fa-angle-double-right"></i> &nbsp; Email: </strong> <span>{{ $reviewData->email }}</span></p>
                        <p><strong><i class="fa fa-angle-double-right"></i> &nbsp; Mobile: </strong> <span>{{ ($reviewData->mobile == '') ? 'N/A' : $reviewData->mobile }}</span></p>
                        <p><strong><i class="fa fa-angle-double-right"></i> &nbsp; Date: </strong> <span>{{ date('F d, Y', strtotime($reviewData->user_joining_date)) }}</span></p>
                        <p><strong><i class="fa fa-angle-double-right"></i> &nbsp; Merchant: </strong> <span>Example retail merchant</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="tabbable col-md-12">
            <ul class="nav nav-tabs nav-tabs-bottom text-semibold">
                <li class="active"><a href="#review-tab" data-toggle="tab" aria-expanded="true"><i class="icon-file-text position-left"></i> Review</a></li>
                <li class=""><a href="#note-tab" data-toggle="tab" aria-expanded="false"><i class="icon-price-tags position-left"></i> Notes ({{ count($reviewNotesData) }})</a></li>
                <li class=""><a href="#applytag" data-toggle="tab" aria-expanded="false"><i class="icon-price-tag2 position-left"></i> Apply Tags </a></li>
                <li class=""><a href="#Images" data-toggle="tab" aria-expanded="false"><i class="icon-image4 position-left"></i> Images</a></li>
                <li class=""><a href="#Videos" data-toggle="tab" aria-expanded="false"><i class="icon-video-camera2 position-left"></i> Videos</a></li>
            </ul>
            <div class="tab-content">
                <!--Tab 1-->
                <div class="tab-pane active" id="review-tab">
                    <div class="col-lg-12">
                        <h5 style="border: none; margin: 0!important;" contenteditable="true" id="edit" review_id="{{ $reviewData->id }}" class="blog-title mb0 text-semibold editReviewTitle">{{ $reviewData->review_title }}</h5>

                        <div style="margin-bottom: 7px!important;" class="form-group row">
                            <div class="col-lg-4">
                                <div class="step_star" style="padding: 0px 0; margin: 0 0 0 -4px;">
                                    <ul style="margin:0px; padding: 0;" id="stars_video">
                                        <li class="star selected" title="Poor" data-value="1">
                                            @php
                                            $starInt = 1;
                                            for ($i = 1; $i <= 5; $i++) {
                                                if ($starInt <= $reviewData->ratings) {
                                                    echo '<i class="fa yellow fa-star"></i>';
                                                } else {
                                                    echo '<i class="fa fa-star-o"></i>';
                                                }

                                                $starInt++;
                                            }
                                            @endphp
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <label style="margin: 0; padding: 0;" class="control-label col-lg-8">{{ number_format($reviewData->ratings, 1) }} Out of 5 Stars ({{ ($reviewCommentCount > 0) ? $reviewCommentCount . ' Comments' : '0 Comment' }})</label>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <ul class="list-inline list-inline-separate mb-15">
                                    <li>
                                        @foreach ($reviewTags as $tagData) 
                                            <span class="label bg-success animated">{{ $tagData->tag_name }} <i class="removetxt" tag_id="{{ $tagData->id }}" review_id="{{ $tagData->review_id }}">&nbsp; (x)</i></span> 
                                        @endforeach
                                        <span class="label bg-success addtag applyInsightTags" action_name="review-tag" reviewid="{{ $tagData->review_id }}">+ Add Tag</span>
                                    </li>
                                </ul>

                            </div>
                        </div>
                        <p class="mb0">{{ $reviewData->comment_text }}</p>
                    </div>

                    <div class="col-lg-12">
                        <hr>
                    </div>

                    <div class="col-lg-12">
                        <button type="button" class="btn bg-blue-600 pull-right btnapplytag applyInsightTags" action_name="review-tag" reviewid="{{ base64_url_encode($reviewData->id) }}">Add Insight Tags</button>
                        <a href="{{ base_url('admin/brandboost/reviewdetails/' . $reviewData->id) }}" target="_blank"><button style="margin-right: 15px;" type="button" class="btn bg-blue-600 pull-right blank"> View Review </button></a>
                    </div>
                </div>
                <!--Tab 2-->
                <div class="tab-pane" id="note-tab">
                    <div class="col-md-12 inner mb-15">
                        @foreach ($reviewNotesData as $key => $noteData)
                            <p class="reviewnotes"><strong><i class="fa fa-angle-double-right"></i> &nbsp; {{ $noteData->notes }}</strong><br> <em>By {{ $noteData->firstname }} {{ $noteData->lastname }}<br>On {{ date('F d, Y h:i A', strtotime($noteData->created)) }} ({{ timeAgo($noteData->created) }})</em></p>
                        @endforeach
                    </div>

                    <form method="post" class="form-horizontal" id="frmSaveNote" action="javascript:void();">
                        <div class="col-md-12 mb-15">
                            <textarea class="form-control" name="notes" style="padding: 20px; height: 75px;" placeholder="Add Note"></textarea>
                        </div>
                        <div class="col-md-12 text-right ">
                            <input type="hidden" name="reviewid" id="reviewid" value="{{ $reviewData->id }}">
                            <input type="hidden" name="cid" id="cid" value="{{ $reviewData->user_id }}">
                            <input type="hidden" name="bid" id="bid" value="{{ $reviewData->bbId }}">
                            <button data-toggle="modal" data-target="#addnotes" type="button" id="saveReviewNotesPopup" class="btn bg-blue-600"> Add Notes &nbsp; <i class="fa fa-angle-double-right"></i> </button>
                        </div>
                    </form>
                </div>
                <!--Tab 3-->
                <div class="tab-pane" id="applytag">
                    <div class="row mb-15">
                        <div class="col-md-12">
                            <div style="box-shadow: none;" class="panel panel-flat">
                                <div class="panel-heading"><span><i class="icon-info22"></i> &nbsp; Name:</span> Test 1</div>
                                <div class="panel-body">
                                    <span class="label bg-success applytags"> Tag 1</span>
                                    <span class="label bg-success applytags"> Tag 2</span>
                                    <span class="label bg-success applytags"> Tag 3</span>
                                    <span class="label bg-success applytags"> Tag 4</span>
                                    <span class="label bg-success applytags"> Tag 5</span>
                                    <span class="label bg-success applytags"> Tag 6</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div style="box-shadow: none;" class="panel panel-flat">
                                <div class="panel-heading"><span><i class="icon-info22"></i> &nbsp; Name:</span> Test 2</div>
                                <div class="panel-body">
                                    <span class="label bg-success applytags"> Tag 1</span>
                                    <span class="label bg-success applytags"> Tag 2</span>
                                    <span class="label bg-success applytags"> Tag 3</span>
                                    <span class="label bg-success applytags"> Tag 4</span>
                                    <span class="label bg-success applytags"> Tag 5</span>
                                    <span class="label bg-success applytags"> Tag 6</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Tab 4-->
                <div class="tab-pane" id="Images">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                @php
                                $mediaArray = unserialize($reviewData->media_url);
                                if (!empty($mediaArray)) {
                                    foreach ($mediaArray as $key => $data) {
                                        if ($key == 0) {
                                            @endphp
                                            <div class="col-xs-12 col-md-12"> <a href="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/{{ $data['media_url'] }}" class="thumbnail2"> <img class="big" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/{{ $data['media_url'] }}" alt="" height="100px" width="100px"> </a> </div>
                                        @php } @endphp
                                        <div class="col-xs-6 col-md-4"> <a href="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/{{ $data['media_url'] }}" class="thumbnail2"> <img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/{{ $data['media_url'] }}" alt="" class=" small" height="100px" width="100px"> </a> </div>
                                        @php
                                    }
                                } else {
                                    @endphp
                                    <div class="col-xs-12 col-md-12"> <a href="{{ base_url('assets/images/No_Image_Available.png') }}" class="thumbnail2"> <img class="mb0 big" src="{{ base_url('assets/images/No_Image_Available.png') }}" alt=""> </a> </div>
                                @endphp 
                            </div>
                        </div>
                    </div> 
                </div>
                <!--Tab 5-->
                <div class="tab-pane" id="Videos">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="embed-responsive embed-responsive-16by9 mb-20">
                                <iframe class="embed-responsive-item videobox" src="https://www.youtube.com/embed/lVKTP_rr5DM"></iframe>
                            </div>

                            <div class="viddetails">
                                <p><span>File Name : </span>ReviewVideo.mp4</p>
                                <p><span>File Format :</span> MP4</p>
                                <p><span>File Size : </span>128 MB</p>
                                <p><span>Uploaded :</span> May 26th, 2018 at 2:10 AM</p>
                                <p><span>Download Video:</span> <a style="text-decoration: underline;" href="#">Download Video</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--Tab content end-->
        </div>
    </div>
</div>

<script>
    $(function () {
        $('.thumbnail2').viewbox();
    });

    $(document).ready(function () {

        $(document).on("click", ".removetxt", function () {
            var reviewID = $(this).attr("review_id");
            var tagID = $(this).attr("tag_id");
            var elem = $(this);
            $.ajax({
                url: '{{ base_url('admin/tags/removeTag') }}',
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

        $(document).on('click', '.editNote', function () {
            var noteId = $(this).attr('noteid');
            $.ajax({
                url: "{{ base_url('reviews/getReviewNoteById') }}",
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

        $(document).on('keyup', '.editReviewTitle', function () {
            var reviewId = $(this).attr('review_id');
            var reviewTitle = $(this).html();
            $.ajax({
                url: "{{ base_url('admin/reviews/saveReviewTitle') }}",
                type: "POST",
                data: {review_id: reviewId, review_title: reviewTitle},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        var reviewData = data.result[0];
                        $('.editReviewTitle').val(reviewData.review_title);
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
                    url: "{{ base_url('/reviews/deleteReviewNote') }}",
                    type: "POST",
                    data: {noteid: noteId, _token: '{{csrf_token()}}'},
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            alertMessageAndRedirect('Your note has been delete successfully.', window.location.href);
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

    });
</script>   