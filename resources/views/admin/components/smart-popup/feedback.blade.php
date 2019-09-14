<style>
    .enlarge {
        cursor: pointer;
    }

    .media-expand {
        display: block;
        margin-bottom: 15px;
        width: 100%;
        padding-right: 0px;

    }

    .media-expand img {
        width: 100% !important;
        height: auto !important;

    }

    .smartStickyFooter {
        position: absolute;
        bottom: 72px;
        width: 100%;
        background: #fff;
        border-top: 1px solid #eee;
        padding: 0px;
        left: 10px;
    }

    .smartStickyFooter textarea {
        height: 50px !important;
    }

    .thumbnail .thumb img {
        border-radius: 5px 5px 0 0;
        height: 220px;
    }

    .caption-overflow.smallovfl {
        color: #333;
        width: 135px;
        line-height: 95px;
        margin-left: 10px;
    }

    .caption-overflow.smallovfl a {
        display: block;
        height: 44px;
        text-align: center;
        color: #fff;
    }

    .caption-overflow.smallovfl a i {
        font-size: 18px;
    }

    .small_media_icon:hover .caption-overflow.smallovfl {
        visibility: visible !important;
        opacity: 1 !important;
        background: rgba(0, 0, 0, 0.4);
        border-radius: 5px;
    }

    .smart_img_gallery .image_pagination li a video {
        width: 33.6px !important;
        height: 27.8px !important;
        border-radius: 4px;
        opacity: 0.7;
    }


</style>

@php
    $mediaArray = unserialize($result->media_url);
    $feedbackDescription = $result->feedback;

@endphp
<input type="hidden" name="smartpopup_feedback_id" id="smartpopup_feedback_id" value="{{$result->id}}"/>

<div class="smartpopup-container">
    <div class="p20 pl30">
        <div class="col-md-12">
            <div class="smart_img_gallery p20">

                @php
                    $subscriberID = \App\Models\Admin\UsersModel::checkIfSubscriber(array('email' => $result->email));
                    if ($subscriberID > 0) {
                        $oSubscriber = \App\Models\Admin\SubscriberModel::getGlobalSubscriberInfo($subscriberID);
                    }

                    $mediaArray = unserialize($result->media_url);
                    $totalMedia = count($mediaArray);
                    if (!empty($mediaArray)) {
                        if ($mediaArray[0]['media_type'] == 'image') {
                            $mediaSource = "https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/" . $mediaArray[0]['media_url'];
                            $primaryMedia = '<img class="bb_img_enlagre" src="' . $mediaSource . '"><div class="caption-overflow smallovfl"><a class="preview_img_src" href="' . $mediaSource . '" data-popup="lightbox"><i class="icon-eye"></i></a></div>';
                        } else if ($mediaArray[0]['media_type'] == 'video') {
                            $mediaSource = "https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/" . $mediaArray[0]['media_url'];
                            $primaryMedia = '<video class="media br5 " height="100%" width="100%"><source id="bb_video_enlarge" src="' . $mediaSource . '" type="video/mp4"></video><div class="caption-overflow smallovfl"><a class="preview_video_src" style="cursor: pointer;" filepath="' . $mediaSource . '" fileext="mp4"><i class="icon-eye"></i></a></div>';
                        }
                    }
                @endphp

                <div class="big_img @if ($totalMedia <= 1) mr20 @endif small_media_icon">
                    @if ($primaryMedia)
                        {!! $primaryMedia !!}
                    @else
                        {!! showUserAvtar($result->avatar, $result->firstname, $result->lastname, 95, 95, 22)!!}
                    @endif
                </div>

                @if ($totalMedia > 1)
                    <ul class="image_pagination">
                        @php
                            $i = 0;
                            foreach ($mediaArray as $media) {
                                $i++;
                                if ($i <= 3) {
                                    $media_url = $media['media_url'];
                                    $mediaSrc = "https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/" . $media_url;
                                    $ext = pathinfo($mediaSrc, PATHINFO_EXTENSION);
                        @endphp
                        @if ($media['media_type'] == 'image')
                            <li><a class="bb_active" href="javascript:void(0);"><img class="loadMainImageMedia"
                                                                                     src="{{$mediaSrc}}" width="37"
                                                                                     height="29"></a></li>
                        @elseif ($media['media_type'] == 'video')
                            <li><a class="bb_active loadMainVideoMedia" data-ext="{{$ext}}" data-src="{{$mediaSrc}}"
                                   href="javascript:void(0);">
                                    <video class="media br5" height="29" width="37">
                                        <source src="{{$mediaSrc}}" type="video/{{$ext}}">
                                    </video>
                                </a></li>
                        @endif
                        @php
                            }
                        }
                        @endphp

                    </ul>
                @else

                <!--<ul class="image_pagination">
                            <li><a class="bb_active" href="#"><img src="{{base_url("assets/images/media_img4.jpg")}}" width="37" height="29"></a></li>
                            <li><a href="#"><img src="{{base_url("assets/images/media_img5.jpg")}}" width="37" height="29"></a></li>
                            <li><a href="#"><img src="{{base_url("assets/images/media_img6.jpg")}}" width="37" height="29"></a></li>
                        </ul> -->
                @endif
                <div class="interactions p0 pull-left">
                    <ul>
                        <li><i class="icon-user"></i><strong>{{$result->firstname . " " . $result->lastname}}</strong>
                        </li>
                        <li><i class="icon-envelop2"></i><strong>{{$result->email}}</strong></li>
                        <li>
                            <i class="icon-iphone"></i><strong>{!! $result->phone == '' ? displayNoData() : (isset($oSubscriber->phone) ? mobileNoFormat($oSubscriber->phone) : displayNoData()) !!}</strong>
                        </li>
                        <li><i class="icon-calendar"></i><strong>{{dataFormat($result->created)}}</strong></li>
                    </ul>
                </div>

                @if ($totalMedia > 3)
                    <div class="clearfix"></div>
                    <div class="pull-left">
                        <a href="{{base_url("admin/feedback/details/{$result->id}")}}"> <span
                                class="label bkg_grey txt_white br5"> View more</span></a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <ul class="nav nav-tabs nav-tabs-bottom">
        <li class="@if (empty($selectedTab) || $selectedTab == 'undefined' || $selectedTab == 'feedback') active @endif">
            <a href="#smartFeedbackTab" data-toggle="tab">Feedback</a></li>
        <li class="@if ($selectedTab == 'notes') active @endif"><a href="#smartNotesTab" data-toggle="tab">Notes</a>
        </li>
    </ul>
    <div class="tab-content">
        <div
            class="tab-pane @if (empty($selectedTab) || $selectedTab == 'undefined' || $selectedTab == 'feedback') active @endif"
            id="smartFeedbackTab">
            <div class="smart_container" style="min-height:497px;">
                <div class="bbot p30">
                    <p class="mb20 txt_grey2 fsize13 lh24">{!! $feedbackDescription != '' ? $feedbackDescription : displayNoData() !!}</p>
                    <p class="mb0 fsize13">
                        @if ($result->category == 'Positive')
                            <img class="mr10" src="{{base_url()}}assets/images/smiley_green.png" width="26">
                        @elseif ($result->category == 'Neutral')
                            <img class="mr10" src="{{base_url()}}assets/images/smiley_grey2.png" width="26">
                        @else
                            <img class="mr10" src="{{base_url()}}assets/images/smiley_red.png" width="26">
                        @endif
                        <span>{{$result->category}}</span>
                    </p>
                </div>

                @if (count($oCommentsData) > 0)
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Latest
                                Comments {{count($oCommentsData) > 0 ? '(' . count($oCommentsData) . ')' : ''}}</h6>
                            <div class="heading-elements">
                                <div class="table_action_tool">
                                    <a href="#"><img src="{{base_url()}}assets/images/more.svg"></a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body p0" style="box-shadow:none !important;">
                            <div class="comment_sec smart_container">
                                <ul class="addMoreComment">
                                    @php
                                        //pre($reviewID);
                                        if (!empty($oCommentsData)) {
                                            $i = 0;
                                            foreach ($oCommentsData as $commentData) {
                                                $i++;
                                                if($i<=5){

                                    @endphp
                                    <li class="bbot">

                                        <div
                                            class="media-left">{!! showUserAvtar($commentData->avatar, $commentData->firstname, $commentData->lastname)!!}</div>

                                        <div class="media-left pr0 w100">

                                            <p class="fsize14 txt_grey2 lh14 mb-15 ">{{$commentData->firstname . ' ' . $commentData->lastname}}
                                                <span class="dot">.</span> {!! timeAgo($commentData->created) !!} <span
                                                    class="dot">.</span>

                                                @if ($commentData->status == '1')
                                                    <span class="txt_green"><i
                                                            class="icon-checkmark3 fsize12 txt_green"></i> Approve</span>
                                                @endif
                                                @if ($commentData->status == 0)

                                                    <span class="txt_red"><i
                                                            class="icon-checkmark3 fsize12 txt_red"></i> Disapproved</span>

                                                @endif
                                                @if ($commentData->status == '2')
                                                    <span class="media-annotation"> <span
                                                            class="label bkg_grey txt_white br5 chg_smart_status addtag"
                                                            style="cursor: pointer;" change_status="1"
                                                            comment_id="{{$commentData->id}}"> Approve</span> </span>
                                                    <span class="media-annotation dotted"> <span
                                                            class="label bkg_red txt_white br5 chg_smart_status addtag"
                                                            change_status="0" comment_id="{{$commentData->id}}"> Disapprove</span> </span>
                                                @endif
                                            </p>

                                            <p class="fsize13 mb10 lh23 txt_grey2">
                                                {!! $commentData->content != '' ? $commentData->content : 'N/A' !!}</p>

                                            <div class="button_sec text-right">
                                                <a href="javascript:void(0);"
                                                   class="btn comment_btn txt_purple deleteSmartComment"
                                                   commentid="{{$commentData->id}}">Delete</a>
                                            </div>


                                        </div>
                                    </li>
                                    @php
                                        }
                                    }
                                }
                                    @endphp

                                </ul>

                                @if (count($oCommentsData) > 5)
                                    <input type="hidden" id="numOfComment" value="5">
                                    <div class="loadMoreRecord text-center"><a style="cursor: pointer;"
                                                                               id='loadSmartMoreComment'>Load
                                            more</a><img class="loaderImage hidden" height="20px" width="20px"
                                                         src="{{base_url()}}assets/images/widget_load.gif"></div>
                                @endif
                            </div>
                        </div>

                    </div>
                @endif


            </div>

            <form method="post" class="form-horizontal" id="addSmartComment" action="javascript:void(0);">
                @csrf
                <div class="smartStickyFooter">
                    <div class="box_heading bbot ">
                        <p class="fsize14 fw500 m0">Reply Feedback</p>
                    </div>
                    <div class="p20">
                        <textarea name="comment_content" id="comment_content" required class="form-control p0 addnote"
                                  placeholder="Start typing to leave a reply..."></textarea>
                    </div>
                </div>
                <div class="box_footer_btn">
                    <div class="p30">
                        <input type="hidden" name="fid" id="feedbackId" value="{{$result->id}}">
                        <button type="submit" class="btn dark_btn mr20 bkg_red">Reply Feedback</button>
                        <a href="mailto:{{$result->email}}" class="btn dark_btn mr20 bkg_red">Send Email</a>
                        @if (!empty($oSubscriber->phone))
                            <button type="button" class="btn dark_btn mr20 bkg_red open-smart-sms-chat"
                                    @if ($subscriberID > 0) smart-subs-id="{{$subscriberID}}" @endif>Send SMS
                            </button>
                        @endif
                    </div>
                </div>
            </form>


        </div>
        <div class="tab-pane @if ($selectedTab == 'notes') active @endif" id="smartNotesTab">
            <div class="p30">
                @if (!empty($oNotes))
                    @foreach ($oNotes as $noteData)
                        <p class="mb20 pb20 txt_grey2 fsize13 lh24 bbot">
                            {!! $noteData->notes !!}
                            <span class="pull-right">
                                <a href="javascript:void(0)" class="editSmartNote" noteid="{{$noteData->id}}"
                                   feedbackid="{{$result->id}}"> <span class="label addtag bkg_grey txt_white br5"> Modify</span></a>
                                <a href="javascript:void(0)" class="deleteSmartNote" noteid="{{$noteData->id}}"
                                   feedbackid="{{$result->id}}"> <span class="label addtag bkg_red txt_white br5"> Delete</span></a>
                            </span>
                            <br>
                            <small class="text-muted">On {{date('F d, Y h:i A', strtotime($noteData->created))}}
                                by {{$noteData->firstname . ' ' . $noteData->lastname}}</small>
                        </p>

                    @endforeach
                @else
                    <p class="mb20 txt_grey2 fsize13 lh24"> {!! displayNoData() !!}  </p>
                @endif

            </div>


            <form method="post" class="form-horizontal" id="frmSmartSaveNote">
                @csrf
                <div class="smartStickyFooter">
                    <div class="box_heading bbot ">
                        <p class="fsize14 fw500 m0">Add Notes</p>
                    </div>
                    <div class="p20">
                        <textarea name="notes" id="notes" required class="form-control p0 addnote"
                                  placeholder="Start typing to add note..."></textarea>
                    </div>
                </div>

                <div class="box_footer_btn">
                    <div class="p30">
                        <input type="hidden" name="fid" value="{{$result->id}}"/>
                        <input type="hidden" name="bid" value="{{$result->brandboost_id}}"/>
                        <input type="hidden" name="cid" value="{{$result->client_id}}"/>
                        <input type="hidden" name="sid" value="{{$result->subscriber_id}}"/>
                        <button type="submit" class="btn dark_btn mr20 bkg_red">Save Note</button>
                        <a href="mailto:{{$result->email}}" class="btn dark_btn mr20 bkg_red">Send Email</a>
                        @if (!empty($oSubscriber->phone))
                            <button type="button" class="btn dark_btn mr20 bkg_red open-smart-sms-chat"
                                    @if ($subscriberID > 0) smart-subs-id="{{$subscriberID}}" @endif>Send SMS
                            </button>
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
            var feedbackID = $("#smartpopup_feedback_id").val();
            $.ajax({
                url: '/admin/feedback/addFeedbackcomment',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        //window.location.href = '';
                        $('.overlaynew').hide();
                        loadSmartPopup(feedbackID, 'feedback');
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });

        $(".loadMainImageMedia").click(function () {
            var mediasource = $(this).attr('src');
            $('.big_img').empty();
            $('.big_img').html('<img class="bb_img_enlagre" src="' + mediasource + '"><div class="caption-overflow smallovfl"><a class="preview_img_src" href="' + mediasource + '" data-popup="lightbox"><i class="icon-eye"></i></a></div>');

        });

        $(".loadMainVideoMedia").click(function () {
            var mediasource = $(this).attr('data-src');
            var mediaExtension = $(this).attr('data-ext');
            $('.big_img').empty();
            $('.big_img').html('<video class="media br5 " height="100%" width="100%"><source id="bb_video_enlarge" src="' + mediasource + '" type="video/mp4"></video><div class="caption-overflow smallovfl"><a class="preview_video_src" style="cursor: pointer;" filepath="' + mediasource + '" fileext="' + mediaExtension + '"><i class="icon-eye"></i></a></div>');

        });
    });


</script>
