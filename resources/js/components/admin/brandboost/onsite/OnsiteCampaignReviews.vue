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
                        <h3 class="htxt_medium_24 dark_700">Campaign Reviews</h3>
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
            <div class="container-fluid" v-if="reviews.length <= 0">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card_shadow min-h-280">

                            <div class="row mb65">
                                <div class="col-md-6 text-left">
                                    <a class="lh_32 reviews_400 htxt_bold_14" href="#">
                                        <span class="circle-icon-32 float-left bkg_reviews_000 mr10"><img src="assets/images/settings-3-fill-review.svg"></span>
                                        Set up reviews monitoring
                                    </a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="lh_32 htxt_regular_14 dark_200" href="#">
                                        <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="assets/images/question-line.svg"></span>
                                        Learn how to use reviews monitoring
                                    </a>
                                </div>
                            </div>

                            <div class="row mb65">
                                <div class="col-md-12 text-center">
                                    <img class="mt40" style="max-width: 240px; " src="assets/images/review_feed_illustration.svg">
                                    <h3 class="htxt_bold_18 dark_700 mt30">No reviews so far. Connect reviews site!</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">Reviews from 50+ review sites, at your fingertips...</h3>
                                    <button class="btn btn-sm bkg_reviews_000 pr20 reviews_400 slidebox">Monitor reviews site</button>
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
                            <h3 class="htxt_medium_16 dark_400">{{ reviews.length }} &nbsp; Campaign Reviews</h3>
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
                                <tr v-for="review in reviews">
                                    <td @click="navigateToDetails(review.id)" style="cursor:pointer;">
                                        <span class="table-img mr15">
                                           <!-- <span class="fl_name bkg_red_light red_300">vw</span>-->
                                            <user-avatar
                                                :avatar="review.avatar"
                                                :firstname="review.firstname"
                                                :lastname="review.lastname"
                                            ></user-avatar>
                                        </span>
                                        <span class="htxt_medium_14 dark_900">
                                            {{ capitalizeFirstLetter(review.firstname) }} {{ capitalizeFirstLetter(review.lastname) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span><img src="assets/images/mail-line.svg"/></span>&nbsp;{{ review.email }}
                                    </td>
                                    <td @click="navigateToDetails(review.id)" style="cursor:pointer;">
                                        {{ setStringLimit(capitalizeFirstLetter(review.review_title), 25) }}
                                        <br />
                                        <span><em>( {{ review.review_type }} )</em></span>
                                    </td>
                                    <td>{{ displayDateFormat('M d, h:i A', review.created) }}</td>
                                    <td :id="'review_tag_' + review.id">
                                        <button type="button" class="btn btn-xs btn_white_table bluee dropdown-toggle" data-toggle="dropdown"> {{ reviewTags[review.id].length }} Tags <span class="caret"></span> </button>
                                        <ul class="dropdown-menu dropdown-menu-right tagss">
                                            <span v-if="reviewTags[review.id].length" v-for="reviewTag in reviewTags[review.id]">
                                                <button class="btn btn-xs btn_white_table pr10"> {{ reviewTag.tag_name }} </button>
                                            </span>
                                            <button class="btn btn-xs plus_icon ml10 applyInsightTagsReviewsNew" :reviewid="review.id" action_name="review-tag"><i class="icon-plus3"></i></button>
                                        </ul>
                                        <button class="btn btn-xs plus_icon ml10 applyInsightTagsReviewsNew" :reviewid="review.id" action_name="review-tag"><i class="icon-plus3"></i></button>
                                    </td>
                                    <td class="text-right">
                                        <span v-for="rating in review.ratings" class="icons">
                                            <img src="assets/images/star-fill_yellow_16.svg">
                                        </span>
                                        <span v-for="rating in (5 - review.ratings)" class="icons">
                                            <img src="assets/images/star-line.svg">
                                        </span>
                                        <span class="dark_400 fsize14">{{ review.ratings }}/5</span>
                                        <br />
                                        <span v-if="review.ratings >= 4" class="dark_400 fsize14">Positive</span>
                                        <span v-else-if="review.ratings == 3" class="dark_400 fsize14">Neutral</span>
                                        <span v-else-if="review.ratings < 3 && review.ratings > 1" class="dark_400 fsize14">Negative</span>
                                        <span v-else class="dark_400 fsize14">&nbsp;</span>
                                    </td>
                                    <td>
                                        <div class="float-right">
                                            <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false">
                                                <span><img src="assets/images/more-vertical.svg"></span>
                                            </button>
                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(1487px, 98px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a v-if="review.status == '2'" class="dropdown-item" href="javascript:void(0);"><i class="dripicons-user text-muted mr-2"></i> Pending</a>
                                                <a v-if="review.status == '1'" class="dropdown-item" href="javascript:void(0);" @click="changeStatus(review.id, '0')"><i class="dripicons-user text-muted mr-2"></i> Inactive</a>
                                                <a v-else class="dropdown-item" href="javascript:void(0);" @click="changeStatus(review.id, '1')"><i class="dripicons-user text-muted mr-2"></i> Active</a>
                                                <a class="dropdown-item" href="javascript:void(0);" @click="navigateToDetails(review.id)"><i class="dripicons-user text-muted mr-2"></i> View Review</a>
                                                <a v-if="review.review_type == 'text'" class="dropdown-item editReviewNew" :reviewid="review.id" href="javascript:void(0);"><i class="dripicons-user text-muted mr-2"></i> Edit</a>
                                                <a v-else class="dropdown-item editVideoReviewNew" :reviewid="review.id" href="javascript:void(0);"><i class="dripicons-user text-muted mr-2"></i> Edit</a>
                                                <a class="dropdown-item" href="javascript:void(0);" @click="deleteItem(review.id)"><i class="dripicons-exit text-muted mr-2"></i> Delete</a>
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

        <div id="editReviewNew" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" class="form-horizontal" id="updateReviewNew" action="javascript:void(0);">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Update Review</h5>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label col-lg-3">Title</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="edit_review_title" id="edit_review_title" placeholder="Title" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3">Comment</label>
                                <div class="col-lg-9">
                                    <textarea class="form-control" placeholder="Leave Review" name="edit_content" id="edit_content" required ></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3">Rating</label>
                                <div class="col-lg-9">
                                    <div class="step_star_new" style="padding: 5px 0;">

                                        <ul id='stars'>

                                            <li class='star' title='Poor' data-value='1'>

                                                <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                            </li>

                                            <li class='star' title='Fair' data-value='2'>

                                                <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                            </li>

                                            <li class='star' title='Good' data-value='3'>

                                                <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                            </li>

                                            <li class='star' title='Excellent' data-value='4'>

                                                <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                            </li>

                                            <li class='star' title='WOW!!!' data-value='5'>

                                                <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                            </li>

                                        </ul>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" value="0" id="ratingValue" name="ratingValue">
                            <input type="hidden" name="edit_reviewid" id="edit_reviewid" value="">
                            <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                            <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="editVideoReviewNew" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" class="form-horizontal" id="updateVideoReviewNew" action="javascript:void(0);">
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Update Review</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label col-lg-3">Title</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="edit_review_title" id="edit_video_review_title" placeholder="Title" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3">Rating</label>
                                <div class="col-lg-9">
                                    <div class="step_star_new" style="padding: 5px 0;">
                                        <ul id='stars_video'>

                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" value="0" id="ratingValueVideo" name="ratingValueVideo">
                            <input type="hidden" name="edit_video_content" id="edit_video_content" value="">
                            <input type="hidden" name="edit_video_reviewid" id="edit_video_reviewid" value="">
                            <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                            <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="ReviewTagListModalNew" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" name="frmReviewTagListModalNew" id="frmReviewTagListModalNew" action="javascript:void();">
                        <div class="modal-header">
                            <h5 class="modal-title">Apply Tags</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body" id="tagEntireListReview"></div>

                        <div class="modal-footer modalFooterBtn">
                            <input type="hidden" name="review_id" id="tag_review_id" />
                            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn dark_btn">Apply Tag</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    import UserAvatar from '../../../helpers/UserAvatar';
    import Pagination from '../../../helpers/Pagination';
    let tkn = $('meta[name="_token"]').attr('content');

    export default {
        props : ['pageColor', 'title', 'review_type'],
        components: {UserAvatar, Pagination},
        data() {
            return {
                successMsg : '',
                errorMsg: '',
                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                reviews : '',
                allData: {},
                current_page: 1,
                breadcrumb: '',
                campaigns: '',
                reviewTags: ''
            }
        },
        mounted() {
            this.$parent.pageColor = this.pageColor;
            this.loadPaginatedData();
            //console.log("Component mounted "+this.$route.params.id)
        },
        methods: {
            navigateToDetails: function(id){
                window.location.href='#/reviews/onsite/reviews/'+id;
            },
            loadPaginatedData: function () {
                axios.get('/admin/brandboost/reviews/' + this.$route.params.id+'/?page='+this.current_page)
                    .then(response => {
                        this.loading = false;
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.campaigns = response.data.oCampaign;
                        this.reviewTags = response.data.reviewTags;
                        this.allData = response.data.allData;
                        this.reviews = response.data.aReviews;
                        console.log(this.reviewTags);
                    });
            },
            showPaginationData: function (p) {
                this.loading = true;
                this.current_page = p;
                this.loadPaginatedData();
            },
            navigatePagination: function (p) {
                this.loading = true;
                this.current_page = p;
                this.loadPaginatedData();
            },
            changeStatus: function(id, status) {
                if(confirm('Are you sure you want to change the status of this item?')){
                    //Do axios
                    axios.post('/admin/reviews/update_review_status', {
                        review_id:id,
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
                    axios.post('/admin/reviews/deleteReview', {
                        reviewid:id,
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
        $(document).on('click', '.editReviewNew', function () { alert("here"); return false;
            var reviewID = $(this).attr('reviewid');
            $.ajax({
                url: '/admin/reviews/getReviewById',
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                type: "POST",
                data: {reviewid: reviewID},
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {
                        var reviewData = data.result[0];

                        $('#edit_content').val(reviewData.comment_text);
                        $('#edit_review_title').val(reviewData.review_title);
                        $('#edit_reviewid').val(reviewData.id);
                        $('#stars li').each(function (index, value) {
                            $('#ratingValue').val(reviewData.ratings);
                            if (reviewData.ratings > index) {
                                $(this).addClass('selected');
                            } else {
                                $(this).removeClass('selected');
                            }
                        });
                        $("#editReviewNew").modal();

                    } else {

                    }
                }
            });
        });

        $(document).on('click', '.editVideoReviewNew', function () {
            var reviewID = $(this).attr('reviewid');
            $.ajax({
                url: '/admin/reviews/getReviewById',
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                type: "POST",
                data: {reviewid: reviewID},
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {
                        var reviewData = data.result[0];
                        //console.log(reviewData); return false;
                        if(reviewData.comment_video) {
                            $('#edit_video_content').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' + reviewData.comment_video);
                        }
                        $('#edit_video_reviewid').val(reviewData.id);
                        $('#edit_video_review_title').val(reviewData.review_title);
                        var start = '';
                        var startName = ['', 'Poor', 'Fair', 'Good', 'Excellent', 'WOW!!!'];
                        for (var inc = 1; inc <= 5; inc++) {
                            if (inc < reviewData.ratings || inc == reviewData.ratings) {
                                start += "<li class='star txt_yellow' style='display:inline; color: #FFCC00;' title='" + startName[inc] + "' data-value='" + inc + "'><i class='fa fa-star fa-fw' style='margin: 0;'></i></li>";
                            } else {
                                start += "<li class='star txt_grey' style='display:inline;' title='" + startName[inc] + "' data-value='" + inc + "'><i class='fa fa-star-o fa-fw' style='margin: 0;'></i></li>";
                            }
                        }

                        $('#stars_video').html(start);
                        $('#ratingValueVideo').val(reviewData.ratings);
                        $('#stars_video li').each(function (index, value) {
                            if (reviewData.ratings > index) {
                                $(this).addClass('selected');
                            } else {
                                $(this).removeClass('selected');
                            }
                        });

                        $("#editVideoReviewNew").modal();

                    } else {

                    }
                }
            });
        });
        $("#updateReviewNew").submit(function () {

            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '/admin/reviews/update_review',
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {
                        window.location.href = '';
                    } else {
                        alert('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });


        $("#updateVideoReviewNew").submit(function () {

            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '/admin/reviews/update_video_review',
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    //console.log("here "+data.status); return false;
                    if (data.status == 'success') {
                        //window.location.href = '';
                        window.location.reload();
                    } else {
                        alert('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });

        var ratingValueVideo = 0;

        $(document).on('click', '#stars_video li', function () {
            var onStar = parseInt($(this).data('value'), 10);
            var stars = $(this).parent().children('li.star');

            for (var i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
                $(stars[i]).children('i').removeClass('fa-star');
                $(stars[i]).children('i').addClass('fa-star-o');
            }

            for (var i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
                $(stars[i]).children('i').removeClass('fa-star-o');
                $(stars[i]).children('i').addClass('fa-star');
            }

            ratingValueVideo = parseInt($('#stars_video li.selected').last().data('value'), 10);
            $('#ratingValueVideo').val(ratingValueVideo);

        });

        $(document).on("click", ".applyInsightTagsReviewsNew", function () {
            var review_id = $(this).attr("reviewid");
            var feedback_id = $(this).attr("feedback_id");
            var action_name = $(this).attr("action_name");

            $.ajax({
                url: '/admin/tags/listAllTags',
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                type: "POST",
                data: {review_id: review_id},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        var dataString = data.list_tags;
                        if (dataString.search('have any tags yet :-') > 0) {
                            $('.modalFooterBtn').hide();
                        } else {
                            $('.modalFooterBtn').show();
                        }

                        $("#tagEntireListReview").html(dataString);
                        $("#tag_review_id").val(review_id);
                        $("#tag_feedback_id").val(feedback_id);
                        if (action_name == 'review-tag') {
                            $("#ReviewTagListModalNew").modal("show");
                        } else if (action_name == 'feedback-tag') {
                            $("#FeedbackTagListModalNew").modal("show");
                        }
                    }
                }
            });
        });

        $("#frmReviewTagListModalNew").submit(function () {
            var formdata = $("#frmReviewTagListModalNew").serialize();
            $.ajax({
                url: '/admin/tags/applyReviewTag',
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        $("#review_tag_" + data.id).html(data.refreshTags);
                        $("#ReviewTagListModalNew").modal("hide");
                        //window.location.href = '';
                    } else {
                        $('.overlaynew').hide();
                    }
                }
            });
            return false;
        });

    });
</script>
