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
                        <h3 class="htxt_medium_24 dark_700">Onsite Review Questions</h3>
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
            <div class="container-fluid" v-if="count <= 0">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card_shadow min-h-280">

                            <div class="row mb65">
                                <div class="col-md-6 text-left">
                                    <a class="lh_32 reviews_400 htxt_bold_14" href="#">
                                        <span class="circle-icon-32 float-left bkg_reviews_000 mr10"><img src="assets/images/download-fill-review.svg"></span>
                                        Import campaign questions
                                    </a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="lh_32 htxt_regular_14 dark_200" href="#">
                                        <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"></span>
                                        Learn how to use questions monitoring
                                    </a>
                                </div>
                            </div>

                            <div class="row mb65">
                                <div class="col-md-12 text-center">
                                    <img class="mt40" style="max-width: 250px; " src="assets/images/review_request.svg">
                                    <h3 class="htxt_bold_18 dark_700 mt30">No campaign question so far. But you can change it!</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import campaign question!</h3>
                                    <button class="btn btn-sm bkg_reviews_000 pr20 reviews_400 slidebox">Create campaign question</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="container-fluid" v-else>

                <div class="table_head_action mt-2">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="htxt_medium_16 dark_400">{{ count }} Onsite Questions</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="table_action">
                                <div class="float-right">
                                    <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                        <span><img src="assets/images/date_created.svg"></span>&nbsp; Date Created
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Link 1</a>
                                        <a class="dropdown-item" href="#">Link 2</a>
                                        <a class="dropdown-item" href="#">Link 3</a>
                                    </div>
                                </div>
                                <div class="float-right ml10 mr10">
                                    <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                        <span><img src="assets/images/list_view.svg"></span>&nbsp; List View
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Link 1</a>
                                        <a class="dropdown-item" href="#">Link 2</a>
                                        <a class="dropdown-item" href="#">Link 3</a>
                                    </div>
                                </div>
                                <div class="float-right">
                                    <input class="table_search" type="text" placeholder="Search">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <tr v-for="question in questions">
                                    <!--<td @click="navigateToDetails(question.id)" style="cursor:pointer;">-->
                                    <td class="viewQuestionSmartPopup" :questionid="`${question.id}`" style="cursor:pointer;">
                                        <span class="table-img mr15">
                                           <!-- <span class="fl_name bkg_red_light red_300">vw</span>-->
                                            <user-avatar
                                                :avatar="question.avatar"
                                                :firstname="question.firstname"
                                                :lastname="question.lastname"
                                            ></user-avatar>
                                        </span>
                                        <span class="htxt_medium_14 dark_900">
                                            {{ capitalizeFirstLetter(question.firstname) }} {{ capitalizeFirstLetter(question.lastname) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span><img src="assets/images/mail-line.svg"/></span>&nbsp;{{ question.email }}
                                    </td>
                                    <td @click="navigateToDetails(question.id)" style="cursor:pointer;">
                                        {{ setStringLimit(capitalizeFirstLetter(question.question_title), 25) }}
                                        <span v-if="question.question"><br /><em>( {{ setStringLimit(capitalizeFirstLetter(question.question), 40) }} )</em></span>
                                    </td>
                                    <td @click="navigateToCampaignDetails(campaign_id)" style="cursor:pointer;">
                                        {{ setStringLimit(capitalizeFirstLetter(question.brand_title), 30) }}
                                        <span v-if="question.brand_desc"><br /><em>( {{ setStringLimit(capitalizeFirstLetter(question.brand_desc), 30) }} )</em></span>
                                    </td>
                                    <td>{{ displayDateFormat('M d, h:i A', question.created) }}</td>
                                    <td>
                                        <div class="float-right">
                                            <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false">
                                                <span><img src="assets/images/more-vertical.svg"></span>
                                            </button>
                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(1487px, 98px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a v-if="question.status == '1'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(question.id, '0')"><i class="dripicons-user text-muted mr-2"></i> Inactive</a>
                                                <a v-else class="dropdown-item" href="javascript:void(0);" @click="changeStatus(question.id, '1')"><i class="dripicons-user text-muted mr-2"></i> Active</a>
                                                <a href="javascript:void(0);" class="dropdown-item displayReviewNew" action_name="review-tag" tab_type="note" :reviewid="question.id" :review_time="displayDateFormat('M d, Y h:i A', question.created)"><i class="dripicons-exit text-muted mr-2"></i> Add Notes</a>
                                                <a class="dropdown-item" href="javascript:void(0);" @click="navigateToDetails(question.id)"><i class="dripicons-exit text-muted mr-2"></i> View Answer</a>
                                                <a class="dropdown-item" href="javascript:void(0);" @click="deleteItem(question.id)"><i class="dripicons-exit text-muted mr-2"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <pagination
                    :pagination="allData"
                    @paginate="showPaginationData"
                    :offset="4">
                </pagination>

            </div>
        </div>
        <!--******************
          Content Area End
         **********************-->

        <!-- Smart Popup -->
        <div class="box" style="width: 424px;">
            <div style="width: 424px;overflow: hidden; height: 100%;">
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon js-review-question-slidebox"><i class=""><img src="/assets/images/cross.svg"/></i></a>

                        <div class="p40">
                            <div class="row">
                                <div class="col-md-12"> <img src="/assets/images/sms_temp_icon.svg"/>
                                    <h3 class="htxt_medium_24 dark_800 mt20">Question </h3>
                                    <hr class="mt30 mb30">
                                </div>
                                <div class="col-md-12">

                                    <!--<div id="questionSmartPopup"></div>-->
                                    <input type="hidden" name="smartpopup_question_id" id="smartpopup_question_id" value="" />
                                    <div class="interactions p0 pull-left">
                                        <ul>
                                            <li><i class="icon-user"></i><strong>Full Name</strong></li>
                                            <li><i class="icon-envelop2"></i><strong>Email Address</strong></li>
                                            <li><i class="icon-iphone"></i><strong>Phone Number</strong></li>
                                            <li><i class="icon-calendar"></i><strong>Created Date</strong></li>
                                        </ul>
                                    </div>

                                    <hr class="mt30 mb30"/>

                                </div>
                            </div>

                            <div class="row bottom-position">
                                <div class="col-md-12 mb15">
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="module_name" id="active_module_name" :value="moduleName">
                                    <input type="hidden" name="module_account_id" id="module_account_id"
                                           :value="moduleAccountID">
                                    <button class="btn btn-lg bkg_sms_400 light_000 pr20 min_w_160 fsize16 fw600">Save</button>
                                    <a class="dark_200 fsize16 fw400 ml20" href="#">Close</a> </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
        <!-- /Smart Popup -->

        <div id="reviewPopup" class="modal fade">
            <div class="modal-dialog">
                <div class="">
                    <div class="col-md-12">
                        <div class="panel">
                            <div style="border-top: none; border-bottom: 1px solid #eee!important;" class="panel-footer panel-footer-condensed">
                                <div class="heading-elements not-collapsible">
                                    <button class="btn btn-link pull-right" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                                    <span class="heading-text text-semibold">
                                        <i class="icon-history position-left"></i>
                                        <span class="reviewTime"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="panel-body" id="reviewContent"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- newreviewpopup -->
        <div id="newreviewpopup" class="modal fade newreviewpopup2">
            <div class="modal-dialog">
                <div class="modal-content" id="reviewPopupBox">

                </div>
            </div>
        </div>
        <!-- /newreviewpopup -->

    </div>

</template>

<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';
    let tkn = $('meta[name="_token"]').attr('content');

    export default {
        props : ['pageColor', 'title', 'review_type'],
        components: {UserAvatar, Pagination},
        data() {
            return {
                successMsg : '',

                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                questions : '',
                allData: {},
                current_page: 1,
                breadcrumb: '',
                campaign_id: '',
                count: 0
            }
        },
        mounted() {
            this.$parent.pageColor = this.pageColor;
            this.loadPaginatedData();
            //console.log("Component mounted "+this.$route.params.id)
        },
        methods: {
            navigateToDetails: function(id){
                window.location.href='#/questions/details/'+id;
            },
            navigateToCampaignDetails: function(campaign_id){
                window.location.href='#/reviews/onsite/setup/'+campaign_id+'/1';
            },
            loadPaginatedData: function () {
                axios.get('/admin/questions/view/' + this.$route.params.id+'/?page='+this.current_page)
                    .then(response => {
                        this.showLoading(false);
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.campaign_id = response.data.campaignId;
                        this.allData = response.data.allData;
                        this.questions = response.data.oQuestions;
                        this.count = this.questions.length;
                        //console.log(this.questions);
                    });
            },
            showPaginationData: function (p) {
                this.showLoading(true);
                this.current_page = p;
                this.loadPaginatedData();
            },
            navigatePagination: function (p) {
                this.showLoading(true);
                this.current_page = p;
                this.loadPaginatedData();
            },
            changeStatus: function(id, status) {
                if(confirm('Are you sure you want to change the status of this item?')){
                    //Do axios
                    axios.post('/admin/questions/update_question_status', {
                        question_id:id,
                        status:status,
                        moduleName: this.moduleName,
                        moduleUnitId: this.moduleUnitId,
                        _token: this.csrf_token()
                    })
                        .then(response => {
                            if(response.data.status == 'success'){
                                syncContactSelectionSources();
                                this.showPaginationData(this.current_page);
                            }

                        });
                }
            },
            deleteItem: function(id) {
                if(confirm('Are you sure you want to delete this item?')){
                    //Do axios
                    axios.post('/admin/questions/deleteQuestion', {
                        questionID:id,
                        moduleName: this.moduleName,
                        moduleUnitId: this.moduleUnitId,
                        _token: this.csrf_token()
                    })
                        .then(response => {
                            if(response.data.status == 'success'){
                                syncContactSelectionSources();
                                this.showPaginationData(this.current_page);
                            }

                        });
                }
            }
        }
    }

    /* Normal Script */
    $(document).ready(function () {
        $(document).on('click', '.js-review-question-slidebox', function(){
            $(".box").animate({
                width: "toggle"
            });
        });

        $(document).on("click", ".displayReviewNew", function () {
            var elem = $(this);
            var reviewid = $(this).attr("reviewid");
            var tabtype = $(this).attr('tab_type');
            var reviewTime = $(this).attr('review_time');
            displayReviewPopupNew(reviewid, tabtype, reviewTime);

        });

        function displayReviewPopupNew(reviewid, tabtype, reviewTime) {
            $('.overlaynew').show();
            $.ajax({
                url: '/admin/reviews/displayreview',
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                type: "POST",
                data: {rid: reviewid},
                dataType: "json",
                success: function (response) {
                    if (response.status == "success") {
                        $('.overlaynew').hide();
                        $("#reviewContent").html(response.popup_data);
                        $(".reviewTime").html(reviewTime);
                        $("#reviewPopup").modal("show");
                        if (tabtype == 'note') {
                            $('.tabbable a[href="#note-tab"]').trigger('click');
                        } else {
                            $('.tabbable a[href="#review-tab"]').trigger('click');
                        }
                    }
                },
                error: function (response) {
                    alert(response.message);
                }
            });
        }

        $(document).on("click", "#saveReviewNotes", function () {
            var formdata = $("#frmSaveNote").serialize();
            $('.overlaynew').show();
            $.ajax({
                url: '/admin/reviews/saveReviewNotes',
                type: "POST",
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                data: formdata,
                dataType: "json",
                success: function (response) {
                    if (response.status == "success") {
                        var reviewid = $("input[name='reviewid']").val();
                        var tabtype = 'note';
                        var reviewtime = $("input[name='reviewtime']").val();
                        displayReviewPopupNew(reviewid, tabtype, reviewtime);
                    }
                },
                error: function (response) {
                    alert(response.message);
                }
            });
        });

        $(document).on("click", ".viewQuestionSmartPopup", function () {
            $("#questionSmartPopup").html('<h1 class="text-center" style="margin-top:450px;">Loading....</h1>');
            var questionId = $(this).attr('questionid');
            loadQuestionSmartPopup(questionId);
            document.querySelector('.js-review-question-slidebox').click();
        });
        $(".viewQuestionSmartPopup").first().trigger('click');
    });

    function loadQuestionSmartPopup(questionID, selectedTab) {
        $.ajax({
            url: 'admin/questions/details/' + questionID + '?t=' + selectedTab,
            headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
            type: "POST",
            data: {questionID: questionID, action: 'smart-popup'},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    var questionData = data.content;
                    $("#questionSmartPopup").html(questionData);
                }
            }
        });
    }
</script>
