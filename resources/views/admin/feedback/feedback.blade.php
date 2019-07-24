@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')
<?php list($canRead, $canWrite) = fetchPermissions('Feedbacks'); ?>
<?php
$aData['allTab'] = '';
$aData['postiveTab'] = '';
$aData['neutralTab'] = '';
$aData['negativeTag'] = '';


if ($selected_tab == 'all') {
    $allTab = 'active';
    $aData['allTab'] = $allTab;
} else if ($selected_tab == 'positive') {
    $postiveTab = 'active';
    $aData['postiveTab'] = $postiveTab;
} else if ($selected_tab == 'neutral') {
    $neutralTab = 'active';
    $aData['neutralTab'] = $neutralTab;
} else if ($selected_tab == 'negative') {
    $negativeTag = 'active';
    $aData['negativeTag'] = $negativeTag;
} else {
    $allTab = 'active';
    $aData['allTab'] = $allTab;
}
?>

<?php
if (!empty($result)) {
    foreach ($result as $record) {
        if ($record->category == 'Positive') {
            $oPositive[] = $record;
        } else if ($record->category == 'Neutral') {
            $oNuetral[] = $record;
        } else if ($record->category == 'Negative') {
            $oNegative[] = $record;
        }
    }
}
?>

<!-- Content area -->
<div class="content">
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-9">
                <h3><img src="/assets/images/offsite_icon_19.png" style="width: 16px;"> &nbsp; Offsite Brand Boost Feedback</h3>
               
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="active all"><a style="javascript:void();" class="filterByColumn" fil="">All</a></li>
                    <li><a style="javascript:void();" class="filterByColumn" fil="positive">Positive</a></li>
                    <li><a style="javascript:void();" class="filterByColumn" fil="neutral">Neutral</a></li>
                    <li><a style="javascript:void();" class="filterByColumn" fil="negative">Negative</a></li>
                </ul>

            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-3 text-right btn_area">
                <div class="btn-group">
                    <button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-calendar2"></i>&nbsp; &nbsp; Filter Contacts &nbsp; &nbsp; <span class="caret"></span>
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
            </div>
        </div>
    </div>


    <div class="tab-content">
        <?php list($canRead, $canWrite) = fetchPermissions('Feedbacks'); ?>
        <!-- Dashboard content -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Marketing campaigns -->
                <div class="panel panel-flat">
                    <!-- ****** Load Smart Popup ***** -->
                    <?php if (!empty($result)): ?>
                        <?php @include('admin.components.smart-popup.smart-feedback-widget'); //, array('bgClass' => 'bkg_red') ?>
                    <?php endif; ?>


                    <!-- ****** end ********-->
                    <?php //if ($this->uri->segment(2) != 'brandboost') { ?>
                        <div class="panel-heading">
                            <h6 class="panel-title"><?php echo count($result); ?> Off Site Brand Boost Feedback</h6>
                            <div class="heading-elements">
                                <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                    <input class="form-control input-sm cus_search" tableid="offsiteFeedback" placeholder="Search by name" type="text">
                                    <div class="form-control-feedback">
                                        <i class="icon-search4"></i>
                                    </div>
                                </div>
                                <div class="table_action_tool">
                                    <a href="javascript:void();"><i class="icon-calendar2"></i></a>
                                    <a href="javascript:void();"><i class="icon-download4"></i></a>
                                    <a href="javascript:void();"><i class="icon-upload4"></i></a>
                                    <a href="javascript:void();" class="editDataList"><i class="icon-pencil4"></i></a>
                                    <a href="javascript:void();" style="display: none;" id="deleteButtonBrandboostFeedbacks" class="custom_action_box"><i class="icon-trash position-left"></i></a>
                                </div>

                            </div>
                        </div>
                    <?php //} ?>
                    <div class="table-responsive">
						@include('admin.feedback.partial.feedback-list-table');
                    </div>
                </div>
            </div>
        </div>
        <!-- /dashboard content -->


    </div>

</div>

<?php //$this->load->view("admin/modals/modules/offsite/feedback_modal"); ?>
@include('admin.modals.modules.offsite.feedback_modal');
<script src="<?php echo base_url(); ?>assets/js/modules/offsite/feedback.js" type="text/javascript"></script>
@endsection

