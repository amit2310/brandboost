<template>

    <div class="content" id="masterContainer">

        <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
        <div class="page_header">
            <div class="row">
                <!--=============Headings & Tabs menu==============-->
                <div class="col-md-7">
                    <h3><img src="/assets/images/onsite_icons.png"> &nbsp; On Site Questions</h3>
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="active all"><a style="javascript:void();" class="filterByColumn" fil="">All</a></li>
                        <li><a style="javascript:void();" class="filterByColumn" fil="1">Approved</a></li>
                        <li><a style="cursor:pointer" class="filterByColumn" fil="0">Dispproved</a></li>
                        <li><a style="javascript:void();" class="filterByColumn" fil="2">Pending</a></li>

                    </ul>
                </div>
                <!--=============Button Area Right Side==============-->
                <div class="col-md-5 text-right btn_area">
                    <div class="btn-group">
                        <button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-calendar2"></i>&nbsp; &nbsp; Filter reviews&nbsp; &nbsp; <span class="caret"></span>
                        </button>
                        <div class="dropdown-menu dropdown-content width-320 dropdown-menu-right">
                            <div class="dropdown-content-heading"> Filter
                                <ul class="icons-list">
                                    <li><a href="#"><i class="icon-more"></i></a> </li>
                                </ul>
                            </div>
                            <div class="">
                                <div class="panel-group panel-group-control panel-group-control-right content-group-lg filter_campaign" id="accordion-control-right">
                                    <div class="panel panel-white">
                                        <div class="panel-heading sidebarheadings active">
                                            <h6 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group1"><i class="icon-star-empty3"></i>&nbsp;Campaign Type</a> </h6>
                                        </div>
                                        <div id="accordion-control-right-group1" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        Most startups fail. But many of those failures are preventable. The Lean Startup is a new approach being adopted across the globe, changing the way companies are built and new products are launched.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-white">
                                        <div class="panel-heading sidebarheadings">
                                            <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group2"><i class="icon-arrow-up-left2"></i>&nbsp; Source</a> </h6>
                                        </div>
                                        <div id="accordion-control-right-group2" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12"> Conetent Goes here... </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-white">
                                        <div class="panel-heading sidebarheadings">
                                            <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group73"><i class="icon-star-full2"></i>&nbsp; Rating</a> </h6>
                                        </div>
                                        <div id="accordion-control-right-group73" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12"> Conetent Goes here... </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-white">
                                        <div class="panel-heading sidebarheadings">
                                            <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group74"><i class="icon-calendar"></i>&nbsp; Date Created</a> </h6>
                                        </div>
                                        <div id="accordion-control-right-group74" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12"> Conetent Goes here... </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-white">
                                        <div class="panel-heading sidebarheadings">
                                            <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group83"><i class="icon-thumbs-up2"></i>&nbsp; Reviews</a> </h6>
                                        </div>
                                        <div id="accordion-control-right-group83" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                <div class="row mb20">
                                                    <div class="col-xs-6">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox"  class="control-primary" checked="checked">
                                                                Total Reviews
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <input class="form-control input-sm" type="text" name="" value="20" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" />
                                                    </div>

                                                </div>
                                                <div class="row mb20">
                                                    <div class="col-xs-6">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox"  class="control-primary" checked="checked">
                                                                Positive
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <input class="form-control input-sm" type="text" name="" value="20" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" />
                                                    </div>

                                                </div>
                                                <div class="row mb20">
                                                    <div class="col-xs-6">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox"  class="control-primary">
                                                                Neutral
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <input class="form-control input-sm" type="text" name="" value="20" disabled /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" disabled />
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox"  class="control-primary" checked="checked">
                                                                Negative
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <input class="form-control input-sm" type="text" name="" value="0" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="10" />
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-content-footer">
                                <button type="button" class="btn dark_btn dropdown-toggle" style="display: inline-block;"><i class="icon-filter4"></i><span> &nbsp;  Filter</span> </button>
                                &nbsp; &nbsp;
                                <a style="display: inline-block;" href="#">Clear All</a>
                            </div>
                        </div>
                    </div>
                    <a  class="btn dark_btn dropdown-toggle ml20" href="/admin/questions/add"><i class="icon-plus3"></i><span> &nbsp;  New question</span> </a>


                </div>
            </div>
        </div>

        <!--&&&&&&&&&&&& TABBED CONTENT &&&&&&&&&&-->
        <div class="tab-content">
            <!--===========TAB 1===========-->
            <div class="tab-pane active" id="right-icon-tab0">
                <div class="row">
                    <div class="col-md-12">
                        <div style="margin: 0;" class="panel panel-flat">
                            <!-- ****** Load Smart Popup ***** -->
                            <!--@if (!empty($oQuestions))
                            @include('admin.components.smart-popup.smart-question-widget')
                            @endif-->

                            <div class = "panel-heading">
                                <span class = "pull-left">
                                    <h6 class = "panel-title">
                                            {{ oQuestions.length }}
                                        Questions
                                    </h6>
                                </span>

                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" tableID="onsiteQuestion" placeholder="Search by name" type="text">
                                        <div class="form-control-feedback"> <i class="icon-search4"></i> </div>
                                    </div>

                                    <div class="table_action_tool">
                                        <a href="javascript:void();"><i class="icon-calendar2"></i></a>
                                        <a href="javascript:void();" class="editDataQuestion"><i class="icon-pencil4"></i></a>
                                        <a href="javascript:void();" style="display: none;" id="deleteButtonQuestionList" class="custom_action_box"><i class="icon-trash position-left"></i></a>
                                    </div>

                                </div>
                            </div>

                            <div class="panel-body p0">

                                <!-- Table data -->
                                <table v-if="oQuestions" class="table datatable-basic-new" id="onsiteQuestion">
                                    <thead>
                                    <tr>
                                        <th style="display: none;"></th>
                                        <th style="display: none;"></th>
                                        <th style="display: none;" class="nosort editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="control-primary" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
                                        <th><i class=""><img src="assets/images/icon_name.png"></i>Contact</th>
                                        <th><i class=""><img src="assets/images/icon_source.png"></i>Question</th>
                                        <th><i class=""><img src="assets/images/icon_campaign.png"></i>Campaign</th>
                                        <th><i class=""><img src="assets/images/icon_clock.png"></i>Created</th>
                                        <th class="text-right pull-right"><i class=""><img src="assets/images/icon_status.png"></i>Status</th>
                                        <th class="text-center nosort sorting_disabled"><i class="fa fa-dot-circle-o"></i>Action</th>
                                        <th style="display: none;">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <!--================================================-->
                                    <tr v-for="oQuestion in oQuestions" :key="oQuestion.id">
                                        <td style="display: none;">{{ oQuestion.created }}</td>
                                        <td style="display: none;">{{ oQuestion.id }}</td>
                                        <td style="width: 40px!important; display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" :id="`chk${oQuestion.id}`" :value="`${oQuestion.id}`" ><span class="custmo_checkmark"></span></label></td>
                                        <td class="viewQuestionSmartPopup" :questionid="`${oQuestion.id}`">
                                            <div class="media-left media-middle">
                                                <user-avatar
                                                    :avatar="oQuestion.avatar"
                                                    :firstname="oQuestion.firstname"
                                                    :lastname="oQuestion.lastname"
                                                ></user-avatar>
                                            </div>
                                            <div class="media-left">
                                                <div class="pt-5">
                                                    <span v-if="oQuestion.firstname">
                                                        <a href="#" class="text-default text-semibold bbot">
                                                            {{ oQuestion.firstname }} {{ oQuestion.lastname }}
                                                        </a>
                                                        <img v-if="oQuestion.country_code" class="flags" :src="`/assets/images/flags/${oQuestion.country_code.toLowerCase()}.png`" />
                                                        <img v-else class="flags" src="/assets/images/flags/us.png" />
                                                    </span>
                                                    <span v-else>{{ displayNoData() }}</span>
                                                </div>

                                                <div v-if="oQuestion.email" class="text-muted text-size-small">{{ oQuestion.email }}</div>
                                                <div v-else class="text-muted text-size-small">{{ displayNoData() }}</div>
                                            </div>
                                        </td>
                                        <td class="viewQuestionSmartPopup text-left" :questionid="`${oQuestion.id}`"><div class="media-left text-right" style="width:250px;">
                                            <div class="pt-5">
                                                <span v-if="oQuestion.question_title">
                                                    <a :href="`/admin/questions/details/${oQuestion.id}`" class="text-default text-semibold bbot">{{ oQuestion.question_title.substring(0,25) }}</a>
                                                </span>

                                                <span v-else>{{ displayNoData() }}</span>
                                            </div>

                                            <div v-if="oQuestion.question" class="text-muted text-size-small">{{ oQuestion.question.substring(0,25) }}</div>
                                            <div v-else class="text-muted text-size-small">{{ displayNoData() }}</div>
                                        </div>
                                        </td>
                                        <td  class="text-left"><div class="media-left text-right" style="width:200px;">
                                            <div class="pt-5">
                                                <a v-if="oQuestion.review_type == 'offsite'" :href="`/admin/brandboost/offsite_setup/${oQuestion.campaign_id}`" class="text-default text-semibold bbot">
                                                    <span v-if="oQuestion.brand_title">{{ oQuestion.brand_title.substring(0,20) }}</span>
                                                    <span v-else>{{ displayNoData() }}</span>
                                                </a>
                                                <a v-else :href="`/admin/brandboost/onsite_setup/${oQuestion.campaign_id}`" class="text-default text-semibold bbot">
                                                    <span v-if="oQuestion.brand_title">{{ oQuestion.brand_title.substring(0,20) }}</span>
                                                    <span v-else>{{ displayNoData() }}</span>
                                                </a>
                                            </div>

                                            <div v-if="oQuestion.brand_desc" class="text-muted text-size-small">{{ oQuestion.brand_desc.substring(0,30) }}</div>
                                            <div v-else class="text-muted text-size-small">{{ displayNoData() }}</div>
                                        </div>
                                        </td>
                                        <td  class="text-left viewQuestionSmartPopup" :questionid="`${oQuestion.id}`"><div class="media-left text-right" style="width:180px;">
                                            <div class="pt-5"><a href="#" class="text-default text-semibold dark">{{ oQuestion.created }}</a></div>
                                            <div class="text-muted text-size-small">{{ oQuestion.created }}</div>
                                        </div>
                                        </td>

                                        <td class="text-right">

                                            <div class="tdropdown ml10">

                                                <i v-if="oQuestion.status == 0" class="icon-primitive-dot txt_red fsize16"></i>

                                                <i v-else-if="oQuestion.status == 2" class="icon-primitive-dot txt_grey fsize16"></i>

                                                <i v-else class="icon-primitive-dot txt_green fsize16"></i>


                                                <a class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown">
                                                    <span v-if="oQuestion.status == 0">Inactive</span>

                                                    <span v-else-if="oQuestion.status == 2">Pending</span>

                                                    <span v-else>Active</span>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-right status">

                                                    <li v-if="oQuestion.status == 1"><a :question_id='`${oQuestion.id}`' change_status = '0' class='chg_status red'><i class='icon-primitive-dot txt_red'></i> Inactive</a></li>

                                                    <li v-else-if="oQuestion.status == 2"><a :question_id='`${oQuestion.id}`' change_status = '1' class='chg_status green'><i class='icon-primitive-dot txt_green'></i> Active</a></li>
                                                    <li v-else-if="oQuestion.status == 2"><a :question_id='`${oQuestion.id}`' change_status = '0' class='chg_status red'><i class='icon-primitive-dot txt_red'></i> Inactive</a></li>

                                                    <li v-else><a :question_id='`${oQuestion.id}`' change_status = '1' class='chg_status green'><i class='icon-primitive-dot txt_green'></i> Active</a></li>

                                                </ul>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="tdropdown">
                                                <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="/assets/images/more.svg"></a>
                                                <ul class="dropdown-menu dropdown-menu-right more_act">
                                                    <a href="javascript:void();" class="dropdown_close">X</a>

                                                    <!-- if ($canWrite) { -->

                                                    <li v-if="oQuestion.status == 1"><a :question_id='`${oQuestion.id}`' change_status = '0' class='chg_status red'><i class='icon-file-locked'></i> Inactive</a></li>

                                                    <li v-else-if="oQuestion.status == 2"><a :question_id='`${oQuestion.id}`' change_status = '1' class='chg_status green'><i class='icon-file-locked'></i> Active</a></li>
                                                    <li v-else-if="oQuestion.status == 2"><a :question_id='`${oQuestion.id}`' change_status = '0' class='chg_status red'><i class='icon-file-locked'></i> Inactive</a></li>

                                                    <li v-else><a :question_id='`${oQuestion.id}`' change_status = '1' class='chg_status green'><i class='icon-file-locked'></i> Active</a></li>

                                                    <li><a href="javascript:void(0);" class="displayReview" action_name="review-tag" tab_type="note" :reviewid="`${oQuestion.id}`" :review_time="`${oQuestion.created}`" ><i class="icon-file-locked"></i> Add Notes</a></li>

                                                    <!-- } -->

                                                    <li><a target="_blank" :href="`/admin/questions/details/${oQuestion.id}`"><i class="icon-file-locked"></i> View Answer</a></li>

                                                    <li><a href="javascript:void(0);" class="deleteQuestion" :queationid="`${oQuestion.id}`" ><i class="icon-trash"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td style="display: none;">{{ oQuestion.status }}</td>
                                    </tr>
                                    </tbody>
                                </table>

                                <table v-else class="table datatable-basic">
                                    <thead>
                                    <tr>
                                        <th><i class=""><img src="assets/images/icon_name.png"></i>Contact</th>
                                        <th><i class=""><img src="assets/images/icon_source.png"></i>Question</th>
                                        <th><i class=""><img src="assets/images/icon_campaign.png"></i>Campaign</th>
                                        <th><i class=""><img src="assets/images/icon_clock.png"></i>Created</th>
                                        <th class="text-right pull-right"><i class=""><img src="assets/images/icon_status.png"></i>Status</th>
                                        <th class="text-center nosort sorting_disabled"><i class="fa fa-dot-circle-o"></i>Action</th>

                                    </tr>
                                    </thead>

                                    <tbody>
                                    <td style="display: none"></td>
                                    <td style="display: none"></td>
                                    <td colspan="10">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div style="margin: 20px 0px 0;" class="text-center">
                                                    <h5 class="mb-20 mt40">
                                                        Looks Like You Don’t Have Any Question Yet <img src="/assets/images/smiley.png"> <br>
                                                        Lets Create Your First Question.
                                                    </h5>

                                                    <!-- @if ($canWrite) -->
                                                    <button v-if="bActiveSubsription == false" title="No Active Subscription" class="btn bl_cust_btn btn-default dark_btn ml20 pDisplayNoActiveSubscription mb40" type="button" ><i class="icon-plus3"></i> Add Question</button>
                                                    <button v-else id="addQuestion" class="btn bl_cust_btn btn-default dark_btn ml20 mb40" type="button" ><i class="icon-plus3"></i> Add Question</button>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="display: none"></td>
                                    <td style="display: none"></td>
                                    <td style="display: none"></td>
                                    </tbody>
                                </table>

                                <!-- End Table data -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--================================= CONTENT AFTER TAB===============================-->

        <div id="QuestionTagListModal" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="post" name="frmQuestionTagListModal" id="frmQuestionTagListModal" action="javascript:void();">
                        @csrf
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title">Apply Tags</h5>
                        </div>
                        <div class="modal-body" id="tagEntireList"></div>
                        <div class="modal-footer modalFooterBtn">
                            <input type="hidden" name="question_id" id="tag_question_id" />
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
    import UserAvatar from '@/components/helpers/UserAvatar';

    export default {
        title: 'Onsite questions - Brand Boost',
        props : ['pageColor'],
        components: {UserAvatar},
        data() {
            return {
                oQuestions: {},
                bActiveSubsription: {}
            }
        },
        mounted() {
            this.$parent.pageColor = this.pageColor;
            axios.get('/admin/questions/')
                .then(response => {
                    //console.log(response.data);

                    this.oQuestions = response.data.oQuestions;
                    this.bActiveSubsription = response.data.bActiveSubsription;
                    console.log(this.oQuestions);
                });
            console.log('Component mounted')
        }
    }


    /* Customized scripts */
    $(document).ready(function () {

        $('#checkAll').change(function () {
            if (false == $(this).prop("checked")) {
                $(".checkRows").prop('checked', false);
                $(".selectedClass").removeClass('success');
                $('.custom_action_box').hide();
            } else {
                $(".checkRows").prop('checked', true);
                $(".selectedClass").addClass('success');
                $('.custom_action_box').show();
            }
        });


        $(document).on('click', '.checkRows', function () {
            var inc = 0;
            var rowId = $(this).val();
            if (false == $(this).prop("checked")) {
                $('#append-' + rowId).removeClass('success');
            } else {
                $('#append-' + rowId).addClass('success');
            }

            $('.checkRows:checkbox:checked').each(function (i) {
                inc++;
            });
            if (inc == 0) {

                $('.custom_action_box').hide();
            } else {
                $('.custom_action_box').show();
            }

            var numberOfChecked = $('.checkRows:checkbox:checked').length;
            var totalCheckboxes = $('.checkRows:checkbox').length;
            if (totalCheckboxes > numberOfChecked) {
                $('#checkAll').prop('checked', false);
            }
        });


        $(document).on('click', '#deleteButtonQuestionList', function () {
            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {
                deleteConfirmationPopup(
                    "This question will deleted immediately.<br>You can't undo this action.",
                    function() {
                        $('.overlaynew').show();
                        $.ajax({
                            url: "/admin/questions/deleteMultipalQuestion",
                            type: "POST",
                            data: {multiQuestionid: val, _token: '{{csrf_token()}}'},
                            dataType: "json",
                            success: function (data) {
                                if (data.status == 'success') {
                                    location.reload();
                                } else {
                                    alert("Having some error.");
                                }
                            },
                            error: function (error) {
                                console.log(error);
                            }
                        });
                    });
            }
        });


        $(document).on('click', '.deleteQuestion', function () {
            var questionID = $(this).attr('queationid');
            deleteConfirmationPopup(
                "This question will deleted immediately.<br>You can't undo this action.",
                function() {
                    $('.overlaynew').show();
                    $.ajax({
                        url: "/admin/questions/deleteQuestion",
                        type: "POST",
                        data: {questionID: questionID, _token: '{{csrf_token()}}'},
                        dataType: "json",
                        success: function (data) {
                            if (data.status == 'success') {
                                location.reload();
                            } else {
                                alert("Having some error.");
                            }
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                });
        });


        $(document).on('click', '.chg_status', function () {
            $('.overlaynew').show();
            var status = $(this).attr('change_status');
            var question_id = $(this).attr('question_id');
            $.ajax({
                url: "/admin/questions/update_question_status",
                type: "POST",
                data: {status: status, question_id: question_id, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = '';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });


        $('#onsiteQuestion thead tr').clone(true).appendTo('#onsiteQuestion thead');
        var tableId = 'onsiteQuestion';
        var tableBase = custom_data_table(tableId);
        $('table thead tr:eq(1)').hide();
        $('#onsiteQuestion thead tr:eq(1) th').each(function (i) {
            if (i === 9) {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterBy" placeholder="Search ' + title + '" />');

                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() != this.value) {
                        tableBase
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });
            }
        });


        $(document).on('click', '.filterByColumn', function () {
            $('.nav-tabs').each(function (i) {
                $(this).children().removeClass('active');
            });
            $(this).parent().addClass('active');
            var fil = $(this).attr('fil');
            $('#filterBy').val(fil);
            $('#filterBy').keyup();
            if (fil.length == 0) {
                $('.heading_links').each(function (i) {
                    $(this).children('a').removeClass('btn btn-xs ml20 btn-default');
                });
                $('#startRate').val('');
                $('#startRate').keyup();
                $('.heading_links a:eq(0)').addClass('btn btn-xs ml20 btn-default');
                tableBase.draw();
            }
        });


        $(document).on('click', '.top_links_clk', function () {
            $('.heading_links').each(function (i) {
                $(this).children('a').removeClass('btn btn-xs ml20 btn-default');
            });
            $(this).addClass('btn btn-xs ml20 btn-default');
            var typ = $(this).attr('startRate');

            if (typ != 'commentLink') {
                $('#startRate').val(typ);
                $('#startRate').keyup();

                if (typ.length == 0) {
                    $('.nav-tabs').each(function (i) {
                        $(this).children().removeClass('active');
                    });
                    $('#filterBy').val('');
                    $('#filterBy').keyup();
                    $('ul.nav-tabs li.all').addClass('active');
                    tableBase.draw();
                }
            } else {
                $('#startRate').val('');
                $('#startRate').keyup();
                tableBase.draw();
            }
        });


        $(document).on("click", ".applyInsightTags", function () {
            var question_id = $(this).attr("question_id");
            var action_name = $(this).attr("action_name");
            $.ajax({
                url: "/admin/tags/listAllTags",
                type: "POST",
                data: {question_id: question_id, _token: '{{csrf_token()}}'},
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
                        $("#tagEntireList").html(dataString);
                        $("#tag_question_id").val(question_id);
                        if (action_name == 'review-tag') {
                            $("#ReviewTagListModal").modal("show");
                        } else if (action_name == 'feedback-tag') {
                            $("#FeedbackTagListModal").modal("show");
                        } else if (action_name == 'question-tag') {
                            $("#QuestionTagListModal").modal("show");
                        }
                    }
                }
            });
        });


        $("#frmQuestionTagListModal").submit(function () {
            var formdata = $("#frmQuestionTagListModal").serialize();
            formdata += '&_token={{csrf_token()}}';
            $.ajax({
                url: "/admin/tags/applyQuestionTag",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#question_tag_" + data.id).html(data.refreshTags);
                        $("#QuestionTagListModal").modal("hide");
                    }
                }
            });
            return false;
        });


        $(document).on('click', '.editDataQuestion', function () {
            $('.editAction').toggle();
        });

        $(document).on('click', '#addQuestion', function(){
            window.location.href = "/admin/questions/add";
        });
    });
</script>
<style scoped>
    .odd { display: none!important; }
</style>
