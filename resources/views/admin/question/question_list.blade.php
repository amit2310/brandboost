@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')

<?php list($canRead, $canWrite) = fetchPermissions('Questions'); ?>


<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-7">
                <h3><img src="/assets/images/onsite_icons.png"> &nbsp; On Site Questions</h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <!-- <li class="active all"><a style="cursor:pointer" class="filterByColumn" fil="">All</a></li>
                    <li><a style="cursor:pointer" class="filterByColumn" fil="1">Approved</a></li>
                    <li><a style="cursor:pointer" class="filterByColumn" fil="0">Dispproved</a></li>
                    <li><a style="cursor:pointer" class="filterByColumn" fil="2">Pending</a></li> -->

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
                <a  class="btn dark_btn dropdown-toggle ml20" href="<?php echo base_url() ?>admin/questions/add"><i class="icon-plus3"></i><span> &nbsp;  New question</span> </a>


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
                        <?php if (!empty($oQuestions)): ?>
							@include('admin.components.smart-popup.smart-question-widget')
                        <?php endif; ?>
                        <div class = "panel-heading"> <span class = "pull-left">
                                <h6 class = "panel-title"><?php
                                    if (!empty($oQuestions)) {
                                        echo count($oQuestions);
                                    }
                                    ?> Questions</h6>
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
                            <?php if (!empty($oQuestions)) { ?>
                            <table class="table datatable-basic-new" id="onsiteQuestion">
                                <thead>
                                    <tr>
                                        <th style="display: none;"></th>
                                        <th style="display: none;"></th>
                                        <th style="display: none;" class="nosort editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="control-primary" id="checkAll" ><span class="custmo_checkmark"></span></label></th>  
                                        <th><i class=""><img src="assets/images/icon_name.png"></i>Contact</th>
                                        <th><i class=""><img src="assets/images/icon_source.png"></i>Question</th>
                                        <th><i class=""><img src="assets/images/icon_campaign.png"></i>Campaign</th>
                                        <th><i class=""><img src="assets/images/icon_clock.png"></i>Created</th>
<!--                                        <th><i class="icon-hash"></i>Tags</th>-->
                                        <th class="text-right pull-right"><i class=""><img src="assets/images/icon_status.png"></i>Status</th>
                                        <th class="text-center nosort sorting_disabled"><i class="fa fa-dot-circle-o"></i>Action</th>
                                        <th style="display: none;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!--================================================-->
                                    <?php
                                    
                                        $inc = 1;
                                        foreach ($oQuestions as $oQuestion) {

                                            //$iAnswerCount = getAnswerCount($oQuestion->id);
                                            //$oTags = $this->mTags->getTagsDataByQuestionID($oQuestion->id);
                                            
                                            $defaultAvatar = base_url('profile_images/avatar_image.png');
                                            if (!empty($oQuestion->avatar)) {
                                                $avatarImage = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $oQuestion->avatar;
                                            } else {
                                                $avatarImage = $defaultAvatar;
                                            }


                                            $aAnsData = \App\Models\Admin\QuestionModel::getAllAnswer($oQuestion->id);

                                            $approved = 0;
                                            $pending = 0;
                                            $disApproved = 0;
                                            if (!empty($aAnsData)) {

                                                foreach ($aAnsData as $oAns) {

                                                    if ($oAns->status == 1) {
                                                        $approved = $approved + 1;
                                                    } else if ($oAns->status == 2) {
                                                        $pending = $pending + 1;
                                                    } else {
                                                        $disApproved = $disApproved + 1;
                                                    }
                                                }
                                            }
                                            
                                            ?>
                                            <tr>
                                                <td style="display: none;"><?php echo date('m/d/Y', strtotime($oQuestion->created)); ?></td>
                                                <td style="display: none;"><?php echo $oQuestion->id; ?></td>
                                                <td style="width: 40px!important; display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" id="chk<?php echo $oQuestion->id; ?>" value="<?php echo $oQuestion->id; ?>" ><span class="custmo_checkmark"></span></label></td>
                                                <td class="viewQuestionSmartPopup" questionid="<?php echo $oQuestion->id; ?>"><div class="media-left media-middle"> <?php echo showUserAvtar($oQuestion->avatar, $oQuestion->firstname, $oQuestion->lastname); ?> </div>
                                                    <div class="media-left">
                                                        <div class="pt-5"><a href="#" class="text-default text-semibold bbot"><span><?php echo (!empty($oQuestion->firstname)) ? $oQuestion->firstname . ' ' . $oQuestion->lastname : displayNoData(); ?></span></a><img class="flags" src="<?php echo (empty($oQuestion->country_code)) ? base_url('assets/images/flags/us.png') : base_url('assets/images/flags/' . strtolower($oQuestion->country_code) . '.png'); ?>" /></div>
                                                        <div class="text-muted text-size-small"><?php echo (!empty($oQuestion->email)) ? $oQuestion->email : displayNoData(); ?></div>
                                                    </div>
                                                </td>
                                                <td class="viewQuestionSmartPopup text-left" questionid="<?php echo $oQuestion->id; ?>"><div class="media-left text-right" style="width:250px;">
                                                        <div class="pt-5"><a href="javascript:void();<?php //echo site_url('admin/questions/details/' . $oQuestion->id); ?>" class="text-default text-semibold bbot"><span><?php echo (!empty($oQuestion->question_title)) ? setStringLimit($oQuestion->question_title, '25') : displayNoData(); ?></span> </a></div>
                                                        <div class="text-muted text-size-small"><?php echo (!empty($oQuestion->question)) ? setStringLimit($oQuestion->question, '40') : displayNoData(); ?></div>
                                                    </div>
                                                </td>
                                                <td  class="text-left"><div class="media-left text-right" style="width:200px;">
                                                        <div class="pt-5"><a href="<?php echo ($oQuestion->review_type == 'offsite') ? base_url('admin/brandboost/offsite_setup/' . $oQuestion->campaign_id) : base_url('admin/brandboost/onsite_setup/' . $oQuestion->campaign_id); ?>" class="text-default text-semibold bbot"><span><?php echo (!empty($oQuestion->brand_title)) ? setStringLimit($oQuestion->brand_title, '20') : displayNoData(); ?></span> </a></div>
                                                        <div class="text-muted text-size-small"><?php echo (!empty($oQuestion->brand_desc)) ? setStringLimit($oQuestion->brand_desc, '30') : displayNoData(); ?></div>
                                                    </div>
                                                </td>
                                                <td  class="text-left" class="viewQuestionSmartPopup" questionid="<?php echo $oQuestion->id; ?>"><div class="media-left text-right" style="width:180px;">
                                                        <div class="pt-5"><a href="#" class="text-default text-semibold dark"><?php echo dataFormat($oQuestion->created); ?></a></div>
                                                        <div class="text-muted text-size-small"><?php echo date('h:iA', strtotime($oQuestion->created)); ?></div>
                                                    </div>
                                                </td>
        
                                                <td class="text-right">

                                                    <div class="tdropdown ml10">
                                                        <?php
                                                        if ($oQuestion->status == 0) {
                                                            echo '<i class="icon-primitive-dot txt_red fsize16"></i> ';
                                                        } else if ($oQuestion->status == 2) {
                                                            echo '<i class="icon-primitive-dot txt_grey fsize16"></i> ';
                                                        } else {
                                                            echo '<i class="icon-primitive-dot txt_green fsize16"></i> ';
                                                        }
                                                        ?>
                                                        <a class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown">
                                                            <?php
                                                            if ($oQuestion->status == 0) {
                                                                echo 'Inactive';
                                                            } else if ($oQuestion->status == 2) {
                                                                echo 'Pending';
                                                            } else {
                                                                echo 'Active';
                                                            }
                                                            ?>

                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-right status">
                                                            <?php
                                                            if ($oQuestion->status == 1) {
                                                                echo "<li><a question_id='" . $oQuestion->id . "' change_status = '0' class='chg_status red'><i class='icon-primitive-dot txt_red'></i> Inactive</a></li>";
                                                            } else if ($oQuestion->status == 2) {
                                                                echo "<li><a question_id='" . $oQuestion->id . "' change_status = '1' class='chg_status green'><i class='icon-primitive-dot txt_green'></i> Active</a></li>";
                                                                echo "<li><a question_id='" . $oQuestion->id . "' change_status = '0' class='chg_status red'><i class='icon-primitive-dot txt_red'></i> Inactive</a></li>";
                                                            } else {
                                                                echo "<li><a question_id='" . $oQuestion->id . "' change_status = '1' class='chg_status green'><i class='icon-primitive-dot txt_green'></i> Active</a></li>";
                                                            }
                                                            ?>
                                                        </ul>


                                                    </div>

                                                </td>
                                                <td class="text-center"> 
                                                    <div class="tdropdown">
                                                        <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a>
                                                        <ul class="dropdown-menu dropdown-menu-right more_act">
                                                            <a href="javascript:void();" class="dropdown_close">X</a>
                                                            <?php
                                                            if ($canWrite) {

                                                                if ($oQuestion->status == 1) {
                                                                    echo "<li><a question_id='" . $oQuestion->id . "' change_status = '0' class='chg_status red'><i class='icon-file-locked'></i> Inactive</a></li>";
                                                                } else if ($oQuestion->status == 2) {
                                                                    echo "<li><a question_id='" . $oQuestion->id . "' change_status = '1' class='chg_status green'><i class='icon-file-locked'></i> Active</a></li>";
                                                                    echo "<li><a question_id='" . $oQuestion->id . "' change_status = '0' class='chg_status red'><i class='icon-file-locked'></i> Inactive</a></li>";
                                                                } else {
                                                                    echo "<li><a question_id='" . $oQuestion->id . "' change_status = '1' class='chg_status green'><i class='icon-file-locked'></i> Active</a></li>";
                                                                }
                                                                //echo '<li><a href="javascript:void(0);" class="applyInsightTags" action_name="review-tag" reviewid="' . $oQuestion->id . '" ><i class="icon-file-locked"></i> Apply Tags</a></li>';
                                                                echo '<li><a href="javascript:void(0);" class="displayReview" action_name="review-tag" tab_type="note" reviewid="' . $oQuestion->id . '" review_time="' . date("M d, Y h:i A", strtotime($oQuestion->created)) . '(' . timeAgo($oQuestion->created) . ')" ><i class="icon-file-locked"></i> Add Notes</a></li>';
                                                            }
                                                            echo '<li><a target="_blank" href="' . base_url('admin/questions/details/' . $oQuestion->id) . '"><i class="icon-file-locked"></i> View Answer</a></li>';
                                                            if ($canWrite) {

                                                                echo '<li><a href="javascript:void(0);" class="deleteQuestion" queationid="' . $oQuestion->id . '" ><i class="icon-trash"></i> Delete</a></li>';
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td style="display: none;"><?php echo $oQuestion->status; ?></td>
                                            </tr>
                                            <?php
                                            $inc++;
                                        }
                                   
                                    ?>

                                </tbody>
                            </table>
                            <?php  }
                            else {

                                ?><table class="table datatable-basic">
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
                                                            Looks Like You Don’t Have Any Question Yet <img src="<?php echo base_url('assets/images/smiley.png'); ?>"> <br>
                                                            Lets Create Your First Question.
                                                        </h5>

                                                        <?php if ($canWrite): ?>
                                                            <button <?php if ($bActiveSubsription == false) { ?> title="No Active Subscription" class="btn bl_cust_btn btn-default dark_btn ml20 pDisplayNoActiveSubscription mb40" <?php } else { ?> id="addQuestion" class="btn bl_cust_btn btn-default dark_btn ml20 mb40" <?php } ?> type="button" ><i class="icon-plus3"></i> Add Question</button>
                                                        <?php endif; ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="display: none"></td>
                                        <td style="display: none"></td>
                                        <td style="display: none"></td>
                                    </tbody>
                                </table><?php 
                            }?>

                            <!-- End Table data -->



                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
    <!--================================= CONTENT AFTER TAB===============================-->



</div>


<div id="QuestionTagListModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" name="frmQuestionTagListModal" id="frmQuestionTagListModal" action="javascript:void();">
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



<script>
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
                        url: "<?php echo base_url('admin/questions/deleteMultipalQuestion'); ?>",
                        type: "POST",
                        data: {multiQuestionid: val},
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
                    url: "<?php echo base_url('admin/questions/deleteQuestion'); ?>",
                    type: "POST",
                    data: {questionID: questionID},
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
                url: '<?php echo base_url('admin/questions/update_question_status'); ?>',
                type: "POST",
                data: {status: status, question_id: question_id},
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

            console.log(i);
            if (i === 9) {
                //console.log(i);
                var title = $(this).text();
                $(this).html('<input type="text" id="filterBy" placeholder="Search ' + title + '" />');

                $('input', this).on('keyup change', function () {
                    console.log(tableBase.column(i).search(), this.value);
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
                url: '<?php echo base_url('admin/tags/listAllTags'); ?>',
                type: "POST",
                data: {question_id: question_id},
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
            $.ajax({
                url: '<?php echo base_url('admin/tags/applyQuestionTag'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#question_tag_" + data.id).html(data.refreshTags);
                        $("#QuestionTagListModal").modal("hide");
                        //window.location.href = '';
                    }
                }
            });
            return false;
        });

        $(document).on('click', '.editDataQuestion', function () {
            $('.editAction').toggle();
        });

        $(document).on('click', '#addQuestion', function(){

            window.location.href = "<?php echo base_url(); ?>admin/questions/add";
        });


    });
</script>
@endsection