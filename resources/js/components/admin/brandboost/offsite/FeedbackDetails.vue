<template>

    <div class="content">

        <!--******************
          Top Heading area
         **********************-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">Feedback Details</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="circle-icon-40"><img src="assets/images/filter_review.svg"/></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!--******************
          Content Area
         **********************-->
        <div class="content-area">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card p40 pt0 pb0">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="fsize12 fw500 dark_200 mt30 mb30">&nbsp;</p>
                                            <h3 class="htxt_bold_18 dark_800">Image &amp; Video</h3>
                                            <p style="max-width: 440px;" class="htxt_regular_14 dark_400 mt15 mb25 lh_22">
                                                <span><i>No Image found</i></span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="fsize12 fw500 dark_200 mt30 mb30">&nbsp;</p>
                                            <h3 class="htxt_bold_18 dark_800">Tags</h3>
                                            <p style="max-width: 440px;" class="htxt_regular_14 dark_400 mt15 mb25 lh_22">

                                                <span v-if="feedbackTags.length <= 0"><i>No Tags found</i></span>
                                                <span v-else>
                                                    <button v-for="feedbackTag in feedbackTags" class="btn btn-xs btn_white_table pr10">{{ feedbackTag.tag_name }}</button>
                                                </span>
                                                <button class="btn btn-xs plus_icon ml10 applyInsightTagsFeedbackNew" :feedback_id="feedbackId" action_name="feedback-tag"><i class="icon-plus3"></i></button>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 left mt0">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="fsize12 fw500 dark_200 mt30 mb30">&nbsp;</p>
                                            <h3 class="htxt_bold_18 dark_800">Feedback: {{ capitalizeFirstLetter(feedback.brand_title) }}</h3>
                                            <p><strong>{{ feedback.title }}</strong></p>
                                            <p><strong>{{ feedback.feedback }}</strong></p>
                                            <div class="text-muted"><span><a class="icons" href="javascript:void(0);"><img style="width: 18px;" src="/assets/images/userp.png" class="img-circle" alt=""></a></span> by {{ feedback.firstname }} {{ feedback.lastname }}   <span class="ml20"><i class="icon-checkmark3 fsize12 txt_green"></i>&nbsp; Verified Purchase</span></div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <!--=========Latest Comments===========-->
                                    <div class="row" v-if="oAnswers.length">
                                        <div class="col-md-12">
                                            <p class="fsize12 fw500 dark_200 mt30 mb30">&nbsp;</p>
                                            <h3 class="htxt_bold_18 dark_800">Latest Answers {{ oAnswers.length > 0 ? '(' + oAnswers.length + ')' : 0 }}</h3>

                                            <div class="text-muted"><span><a class="icons" href="javascript:void(0);"><img style="width: 18px;" src="/assets/images/userp.png" class="img-circle" alt=""></a></span> {{ oAnswers.firstname }} {{ oAnswers.lastname }}   <span class="ml20">{{ displayDateFormat('M d, Y h:i A', oAnswers.created) }}</span></div>
                                            <p>
                                                <span v-if="oAnswers.status == 1" class="txt_green"><i class="icon-checkmark3 fsize12 txt_green" :answer_id="`Base64EncodeUrl(oAnswers.id)`"></i> Approve</span>
                                                <span v-if="oAnswers.status == 0" class="txt_green"><i class="icon-checkmark3 fsize12 txt_red" :answer_id="`Base64EncodeUrl(oAnswers.id)`"></i> Disapproved</span>

                                                <span v-if="oAnswers.status == 2" class="media-annotation"> <span class="label bkg_grey txt_white br5 chg_status addtag" style="cursor: pointer;" change_status="1" :answer_id="`Base64EncodeUrl(oAnswers.id)`"> Approve</span> </span>
                                                <span v-if="oAnswers.status == 2" class="media-annotation dotted"> <span class="label bkg_red txt_white br5 chg_status addtag" style="cursor: pointer;" change_status="0" :answer_id="`Base64EncodeUrl(oAnswers.id)`"> Disapprove</span> </span>
                                            </p>
                                            <p>
                                                {{ (oAnswers.answer) ? nl2br(Base64EncodeUrl(oAnswers.answer)) : '[No Data]' }}
                                            </p>
                                            <div class="button_sec">
                                                <a class="btn comment_btn p7" href="javascript:void(0);"><i class="icon-thumbs-up2 txt_green"></i></a>
                                                <a class="btn comment_btn p7" href="javascript:void(0);"><i class="icon-thumbs-down2 txt_red"></i></a>

                                                <a  href="javascript:void(0);" class="btn comment_btn txt_purple editAnswer" :answer_id="`Base64EncodeUrl(oAnswers.id)`">Edit</a>
                                                <a  href="javascript:void(0);" class="btn comment_btn txt_purple deleteAnswer" :answer_id="`Base64EncodeUrl(oAnswers.id)`">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--=========Latest Comments===========-->

                                    <div class="clearfix"></div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form name="frmSendFeedbackReply" id="frmSendFeedbackReply" method="post" action="javascript:void();">
                                                <input type="hidden" name="fbtime" :value="`displayDateFormat('M d, Y h:i A', feedback.created)`" />
                                                <input type="hidden" name="fid" :value="feedback.id" />
                                                <input type="hidden" name="bid" :value="feedback.brandboost_id" />
                                                <input type="hidden" name="cid" :value="feedback.client_id" />
                                                <input type="hidden" name="sid" :value="feedback.subscriber_id" />
                                                <input type="hidden" name="authorname" :value="feedback.subscriber_id" />
                                                <p class="fsize12 fw500 dark_200 mt30 mb30">&nbsp;</p>
                                                <h3 class="htxt_bold_18 dark_800">Reply Feedback</h3>
                                                <p>
                                                    <textarea name="feedbackReply" id="feedbackReply" required class="form-control addnote" placeholder="Start typing to leave your feedback reply..."></textarea>
                                                </p>
                                                <p>
                                                     <input type="hidden" id="question_id" name="question_id" :value="`Base64EncodeUrl(feedback.id)`">
                                                    <button class="btn dark_btn btn-xs ml20" id="sendFeedbackEmail" title="Send SMS" career_medium="sms" type="button" > Send SMS </button>
                                                    <button class="btn dark_btn btn-xs ml20" id="sendFeedbackSMS" title="Send Email" career_medium="email"  type="button" > Send Email </button>
                                                </p>
                                            <p class="fsize12 fw500 dark_200 mt30 mb30">&nbsp;</p>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="row" v-if="commentData.length">
                                        <div class="col-md-12">
                                            <input type="hidden" id="numOfComment" value="5">
                                            <div class="loadMoreRecord"><a style="cursor: pointer;" id='loadMoreComment' :revId="feedback.id">Load more</a><img class="loaderImage hidden" height="20px" width="20px" src="/assets/images/widget_load.gif"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card p40 pt0 pb0">
                            <div class="row">
                                <div class="col-md-4">
                                    <h3 class="htxt_bold_18 dark_800">Info</h3>
                                    <p style="max-width: 440px;" class="htxt_regular_14 dark_400 mt15 mb25 lh_22">
                                        <ul>
                                            <li><small>Ref</small> <strong>[No Data]</strong></li>
                                            <li><small>Name</small> <strong>{{ feedback.firstname }} {{ feedback.lastname }}  </strong></li>
                                            <li><small>Email</small> <strong>{{ feedback.email }}</strong></li>
                                            <li><small>Phone</small> <strong>{{ (feedback.phone) ? feedback.phone : '[No Data]' }}</strong></li>
                                        </ul>
                                    </p>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-8">
                                    <div class="profile_headings"><h3 class="htxt_bold_18 dark_800">Feedback Notes</h3> <a class="pull-right plus_icon displayFeedback" href="javascript:void(0);"><i class="icon-plus3"></i></a></div>
                                    <div v-if="notesData.length <= 0" class="p25 bbot"><i>No Notes Available</i></div>
                                    <div v-else class="p25 bbot" v-for="notes in notesData">
                                        <p class="fsize12">{{ notes.notes }}</p>
                                        <p><small class="text-muted">On {{ notes.created }} <br />By {{ notes.firstname }} {{ notes.lastname }}</small></p>
                                        <div class="text-right">
                                            <a href="javascript:void(0)" class="editNote" :noteid="notes.id"> <span class="label addtag bkg_grey txt_white br5"> Modify</span></a>
                                            <a href="javascript:void(0)" class="deleteNote" :noteid="notes.id"> <span class="label addtag bkg_red txt_white br5"> Delete</span></a>
                                        </div>
                                    </div>
                                    <div class="p25 btop">
                                        <button class="btn dark_btn btn-xs mr20 displayFeedback" data-toggle="modal" data-target="#feedbackPopup">Add Note</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--******************
          Content Area End
         **********************-->

        <div id="FeedbackTagListModalNew" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="post" name="frmFeedbackTagListModalNew" id="frmFeedbackTagListModalNew" action="javascript:void();">
                        <div class="modal-header">
                            <h5 class="modal-title">Apply Tags</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body" id="tagEntireListFeedback"></div>

                        <div class="modal-footer">
                            <input type="hidden" name="feedback_id" id="tag_feedback_id" />
                            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Apply Tag</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="feedbackPopup" class="modal fade in">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fa fa-tags"></i>&nbsp; Add Feedback Notes</h5>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <form method="post" class="form-horizontal" id="frmSaveNote" action="javascript:void();">
                                <div class="col-md-12 mb-15">
                                    <textarea class="form-control" id="add_feedback_popup" name="notes" style="padding: 20px; height: 75px;" placeholder="Add Note"></textarea>
                                </div>
                                <div class="col-md-12 text-right ">
                                    <input type="hidden" name="fbtime" :value="`displayDateFormat('M d, Y h:i A', feedback.created)`" />
                                    <input type="hidden" name="fid" :value="feedback.id" />
                                    <input type="hidden" name="bid" :value="feedback.brandboost_id" />
                                    <input type="hidden" name="cid" :value="feedback.client_id" />
                                    <input type="hidden" name="sid" :value="feedback.subscriber_id" />
                                    <input type="hidden" name="authorname" :value="feedback.subscriber_id" />
                                    <button data-toggle="modal" data-target="#addnotes" type="button" id="saveFeedbackNote" class="btn dark_btn"> Add Notes &nbsp; <i class="fa fa-angle-double-right"></i> </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    import UserAvatar from '../../../helpers/UserAvatar';
    let tkn = $('meta[name="_token"]').attr('content');

    export default {
        props : ['pageColor', 'title'],
        components: {UserAvatar},
        data(){
            return {
                successMsg : '',
                errorMsg: '',
                loading: true,
                feedbackId: this.$route.params.id,
                moduleName: '',
                breadcrumb: '',
                feedback: '',
                notesData: '',
                feedbackTags: '',
                oAnswers: '',
                notes: '',
                commentData: '',
                selectedTab: '',
                comment_content: '',
                displayActivity: 'commentSection'
            }
        },
        mounted() {
            this.$parent.pageColor = this.pageColor;
            this.loadViewData();
        },
        methods: {
            loadViewData : function(){
                axios.get('/admin/feedback/details/' + this.feedbackId)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.feedback = response.data.result;
                        this.feedbackTags = response.data.feedbackTags;
                        this.selectedTab = response.data.selectedTab;
                        this.commentData = response.data.oCommentsData;
                        this.notesData = response.data.oNotes;
                        this.loading = false;
                    });
            }
        }
    }

    $(document).ready(function () {

        $(document).on("click", ".applyInsightTagsFeedbackNew", function () {
            var review_id = $(this).attr("reviewid");
            var feedback_id = $(this).attr("feedback_id");
            var action_name = $(this).attr("action_name");
            $.ajax({
                url: '/admin/tags/listAllTags',
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                type: "POST",
                data: {feedback_id: feedback_id},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        $("#tagEntireListFeedback").html(data.list_tags);

                        if (action_name == 'review-tag') {
                            $("#tag_review_id").val(review_id);
                            $("#ReviewTagListModalNew").modal("show");
                        } else if (action_name == 'feedback-tag') {
                            $("#tag_feedback_id").val(feedback_id);
                            $("#FeedbackTagListModalNew").modal("show");
                        }
                    }
                }
            });
        });

        $("#frmFeedbackTagListModalNew").submit(function () {
            var formdata = $("#frmFeedbackTagListModalNew").serialize();
            $.ajax({
                url: 'admin/tags/applyFeedbackTag',
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        // $("#FeedbackTagListModalNew").modal("hide");
                        // window.location.href = window.location.href;
                        $("#feedback_tag_" + data.id).html(data.refreshTags);
                        $("#FeedbackTagListModalNew").modal("hide");
                        //opener.location.reload();
                    }
                }
            });
            return false;
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
                            url: '/admin/feedback/replyFeedback',
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

        $(document).on("click", ".displayFeedback", function () {
            $("#feedbackPopup").modal("show");
        });

        $(document).on("click", "#saveFeedbackNote", function () {
            var formdata = $("#frmSaveNote").serialize();
            $('.overlaynew').show();
            $.ajax({
                url: '/admin/feedback/saveFeedbackNotes',
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (response) {
                    if (response.status == "success") {
                        window.location.reload();
                    }
                },
                error: function (response) {
                    alert(response.message);
                }
            });
        });

    });
</script>

<style>

</style>
