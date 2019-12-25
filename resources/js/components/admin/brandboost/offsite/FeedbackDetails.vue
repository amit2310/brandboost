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

    </div>

</template>

<script>
    import UserAvatar from '../../../helpers/UserAvatar';
    import Pagination from '../../../helpers/Pagination';
    let tkn = $('meta[name="_token"]').attr('content');

    export default {
        props : ['pageColor', 'title'],
        components: {UserAvatar, Pagination},
        data(){
            return {
                successMsg : '',
                errorMsg: '',
                loading: true,
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                count : 0,
                feedbacks : '',
                allData: {},
                current_page: 1,
                breadcrumb: '',
                feedbackTags: ''
            }
        },
        mounted() {
            this.$parent.pageColor = this.pageColor;
            this.loadPaginatedData();
        },
        methods: {
            navigateToCampaignDetails: function(campaign_id){
                window.location.href='#/reviews/offsite/setup/'+campaign_id;
            },
            navigateToFeedbackDetails: function(id){
                window.location.href='#/feedback/details/'+id;
            },
            loadPaginatedData : function(){
                axios.get('/admin/feedback/listall?page='+this.current_page)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.allData = response.data.allData;
                        this.feedbacks = response.data.result;
                        this.count = response.data.totalResults;
                        this.feedbackTags = response.data.feedbackTags;
                        this.loading = false;
                        console.log(this.feedbacks)
                    });
            },
            showPaginationData: function(p){
                this.loading=true;
                this.current_page = p;
                this.loadPaginatedData();
            },
            navigatePagination: function(p){
                this.loading=true;
                this.current_page = p;
                this.loadPaginatedData();
            },
            changeStatus: function(fid, status) {
                if(confirm('Are you sure you want to change the status of this item?')){
                    //Do axios
                    axios.post('/admin/feedback/updateFeedbackStatus', {
                        fid:fid,
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
            deleteItem: function(subscriberid,trackinglogid) {
                if(confirm('Are you sure you want to delete this item?')){
                    //Do axios
                    axios.post('/admin/brandboost/deleteRRrecord', {
                        subscriberId:subscriberid,
                        recordId:trackinglogid,
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
                        //window.location.href = '';
                    }
                }
            });
            return false;
        });

    });
</script>

<style>

</style>
