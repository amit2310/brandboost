@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')
<?php
$iActiveCount = $iArchiveCount = 0;

if (!empty($oPrograms)) {
    foreach ($oPrograms as $oCount) {
        if ($oCount->status == 'archive') {
            $iArchiveCount++;
        } else {
            $iActiveCount++;
        }
    }
}
?>
<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-7">
                <h3><img style="width: 16px;" src="/assets/images/refferal_icon.png"> Referral Programs</h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="active"><a style="javascript:void();" id="activeCampaign" class="filterByColumn" fil="active">Active Campaigns</a></li>
                    <li><a style="javascript:void();" class="filterByColumn" fil="archive">Archive</a></li>
                </ul>

            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-5 text-right btn_area">
                <div class="btn-group">
                    <button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-calendar2"></i>&nbsp; &nbsp; Filter Programs &nbsp; &nbsp; <span class="caret"></span>
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
                <?php //if (!empty($oPrograms) && $user_role != 1): ?>
                <button <?php if ($bActiveSubsription == false) { ?> title="No Active Subscription" class="btn dark_btn ml20 pDisplayNoActiveSubscription" <?php } else { ?> id="addReferral" <?php } ?> type="button" class="btn dark_btn ml20"><i class="icon-plus3 txt_teal"></i> &nbsp; New Program</button>
                <?php //endif; ?>
            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->


    <!--&&&&&&&&&&&& TABBED CONTENT START &&&&&&&&&&-->
    <?php if (!empty($oPrograms)): ?>
        <div class="tab-content"> 
            <!--===========TAB 1===========-->
            <div class="tab-pane active" id="right-icon-tab0">
                <!--====Table====-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title"><?php echo $iActiveCount; ?> Referral Programs</h6>
                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" tableId="referralList" placeholder="Search by name" type="text">
                                        <div class="form-control-feedback">
                                            <i class="icon-search4"></i>
                                        </div>
                                    </div>
                                    <div class="table_action_tool">
                                        <a href="#"><i class="icon-calendar52"></i></a>
                                        <a style="cursor: pointer;" class="editDataList"><i class="icon-pencil"></i></a>
                                        <a style="cursor: pointer; display: none;" id="deleteBulkReferral" class="custom_action_box"><i class="icon-trash position-left"></i></a>
                                        <a style="cursor: pointer; display: none;" id="archiveBulkReferral" class="custom_action_box"><i class="icon-gear position-left"></i> </a>
                                    </div>

                                </div>
                            </div>
                            <div class="panel-body p0">
                                <table class="table datatable-basic-new" id="referralList">
                                    <thead>
                                        <tr>
                                            <th style="display: none;"></th>
                                            <th style="display: none;"></th>
                                            <th style="display: none;" class="nosort editAction" style="width:30px;"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="control-primary" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
                                            <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_date.png"/></i> Programs</th>
                                            <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_people.png"/></i> Advocated</th>
                                            <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_click.png"/></i> </th>
                                            <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_display.png"/></i> </th>
                                            <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_refresh2.png"/></i> </th>
                                            <th><i class="icon-calendar"></i>Last Incoming Lead</th>
                                            <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_date.png"/></i> Created</th>
                                            <th><i class="icon-diff-modified"></i>Status</th>
                                            <th class="text-center nosort sorting_disabled"><i class="fa fa-dot-circle-o"></i>Action</th>
                                            <th style="display: none;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <!--================================================-->
                                        <?php
										$newPositive = 0;
                                        foreach ($oPrograms as $oProgram):
                                            $oContacts = \App\Models\Admin\Modules\ReferralModel::getMyAdvocates($oProgram->hashcode);
                                            $lastContactList = end($oContacts);

                                            if (!empty($lastContactList->created)) {
                                                $lastListTime = timeAgo($lastContactList->created);
                                            } else {
                                                $lastListTime = '<div class="media-left">
                                                          <div class="">
                                                            <span class="text-muted text-size-small">[No Data]</span>                                                          </div>
                                                        </div>';
                                            }

                                            $oTotalReferralSent = \App\Models\Admin\Modules\ReferralModel::getStatsTotalSent($oProgram->id);
                                            $oTotalReferralTwillio = \App\Models\Admin\Modules\ReferralModel::getSendgridStats($oProgram->id);

                                            $totalEmailSent = $totalSmsSent = 0;
                                            if (!empty($oTotalReferralSent)) {

                                                foreach ($oTotalReferralSent as $sentCount) {

                                                    if ($sentCount->campaign_type == 'email') {
                                                        $totalEmailSent = ($sentCount->totalCount) ? $sentCount->totalCount : 0;
                                                    }

                                                    if ($sentCount->campaign_type == 'sms') {
                                                        $totalSmsSent = ($sentCount->totalCount) ? $sentCount->totalCount : 0;
                                                    }
                                                }
                                            }
                                            $totalDelivered = $totalOpened = $totalProcessed = $totalClicked = 1;
                                            if (!empty($oTotalReferralTwillio)) {
                                                foreach ($oTotalReferralTwillio as $twilliRec) {
                                                    if ($twilliRec->event_name == 'delivered') {
                                                        $totalDelivered =  $totalDelivered + $twilliRec->totalCount;
                                                    } else if ($twilliRec->event_name == 'open') {
                                                        $totalOpened = $totalOpened + $twilliRec->totalCount;
                                                    } else if ($twilliRec->event_name == 'processed') {
                                                        $totalProcessed = $totalProcessed + $twilliRec->totalCount;
                                                    } else if ($twilliRec->event_name == 'click') {
                                                        $totalClicked = $totalClicked + $twilliRec->totalCount;
                                                    }
                                                }
                                            }
                                            ?>
                                            <tr id="append-<?php echo $oProgram->id; ?>" class="selectedClass">
                                                <td style="display: none;"><?php echo date('m/d/Y', strtotime($oProgram->created)); ?></td>
                                                <td style="display: none;"><?php echo $oProgram->id; ?></td>
                                                <td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]"  id="chk<?php echo $oProgram->id; ?>" class="checkRows" value="<?php echo $oProgram->id; ?>" ><span class="custmo_checkmark"></span></label></td>

                                                <td><div class="media-left media-middle"> <img width="24" src="<?php echo base_url(); ?>assets/images/referal_ov_icon.png"/> </div>
                                                    <div class="media-left">
                                                        <div class=""><a href="<?php echo base_url() ?>admin/modules/referral/setup/<?php echo $oProgram->id; ?>" class="text-default text-semibold bbot"><?php echo $oProgram->title; ?></a></div>
                                                    </div></td>


                                                <td><div style="width: 117px;" class="media-left text-right pr40 brig"><a href="<?php echo base_url(); ?>admin/modules/referral/advocates/<?php echo $oProgram->id; ?>" class="text-default text-semibold"><?php echo count($oContacts) > 0 ? count($oContacts) : 0; ?></a></div></td>
                                                <td>
                                                    <?php
                                                    if ($totalEmailSent > 0) {
                                                        $positiveGraph = 100;
                                                        $positiveRating = $totalEmailSent;
                                                    } else {
                                                        $positiveGraph = 0;
                                                        $positiveRating = 0;
                                                    }

                                                    $addPC = '';
                                                    if ($positiveGraph > 50) {
                                                        $addPC = 'over50';
                                                    }
                                                    ?>
                                                    <div class="media-left">
                                                        <div class="progress-circle <?php echo $addPC; ?> teal cp<?php echo $positiveGraph; ?> <?php if ($positiveGraph > 0): ?>createSegment<?php endif; ?>" segment-type="total-sent" campaign-id="<?php echo $oProgram->id; ?>" campaign-type="email" title="click to create segment">
                                                            <div class="left-half-clipper">
                                                                <div class="first50-bar"></div>
                                                                <div class="value-bar"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="media-left">
                                                        <div data-toggle="tooltip" title="<?php echo $positiveRating; ?> email send" data-placement="top">
                                                            <?php
                                                            if ($positiveRating > 0) {
                                                                ?>
                                                                <a href="javascript:void(0);" class="text-default text-semibold"><?php echo $positiveRating; ?></a>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <a href="javascript:void(0);" class="text-default text-semibold"><?php echo $positiveRating; ?></a>
                                                            <?php }
                                                            ?>
                                                            <?php if ($newPositive > 0): ?>    
                                                                <?php echo '<span style="color:#FF0000;"> (' . $newPositive . ' new)</span>'; ?>    
                                                            <?php endif; ?>    

                                                        </div>
                                                    </div>

                                                </td>
                                                <td>
                                                    <?php
                                                    if ($totalOpened > 0) {
                                                        $positiveGraph = 100;
                                                        $positiveRating = $totalOpened;
                                                    } else {
                                                        $positiveGraph = 0;
                                                        $positiveRating = 0;
                                                    }

                                                    $addPC = '';
                                                    if ($positiveGraph > 50) {
                                                        $addPC = 'over50';
                                                    }
                                                    ?>
                                                    <div class="media-left">
                                                        <div class="progress-circle <?php echo $addPC; ?> dark_green cp<?php echo $positiveGraph; ?> <?php if ($positiveGraph > 0): ?>createSegment<?php endif; ?>" segment-type="total-open" campaign-id="<?php echo $oProgram->id; ?>" campaign-type="email" title="click to create segment">
                                                            <div class="left-half-clipper">
                                                                <div class="first50-bar"></div>
                                                                <div class="value-bar"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="media-left">
                                                        <div data-toggle="tooltip" title="<?php echo $positiveRating; ?> email open" data-placement="top">
                                                            <?php
                                                            if ($positiveRating > 0) {
                                                                ?>
                                                                <a href="javascript:void(0);" class="text-default text-semibold"><?php echo $positiveRating; ?></a>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <a href="javascript:void(0);" class="text-default text-semibold"><?php echo $positiveRating; ?></a>
                                                            <?php }
                                                            ?>
                                                            <?php if ($newPositive > 0): ?>    
                                                                <?php echo '<span style="color:#FF0000;"> (' . $newPositive . ' new)</span>'; ?>    
                                                            <?php endif; ?>    

                                                        </div>
                                                    </div>


                                                </td>
                                                <td>
                                                    <?php
                                                    $totPerClick = ceil($totalClicked * 100 / $totalOpened);

                                                    $addPC = '';
                                                    if ($totPerClick > 50) {
                                                        $addPC = 'over50';
                                                    }
                                                    ?>
                                                    <div class="media-left">
                                                        <div class="progress-circle <?php echo $addPC; ?> green cp<?php echo $totPerClick; ?> <?php if ($totPerClick > 0): ?>createSegment<?php endif; ?>" segment-type="total-click" campaign-id="<?php echo $oProgram->id; ?>" campaign-type="email" title="click to create segment">
                                                            <div class="left-half-clipper">
                                                                <div class="first50-bar"></div>
                                                                <div class="value-bar"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="media-left">
                                                        <div data-toggle="tooltip" title="<?php echo $totalClicked; ?> email clicked" data-placement="top">
                                                            <?php
                                                            if ($totalClicked > 0) {
                                                                ?>
                                                                <a href="javascript:void(0);" class="text-default text-semibold"><?php echo $totalClicked; ?></a>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <a href="javascript:void(0);" class="text-default text-semibold"><?php echo $totalClicked; ?></a>
                                                            <?php }
                                                            ?>
                                                        </div>
                                                    </div>

                                                </td>
                                                <td><?php echo $lastListTime; ?> </td>
												<td>														
                                                    <div class="media-left">
                                                        <div class=""><span class="text-default text-semibold"><?php echo dataFormat($oProgram->created); ?></span></div>
                                                        <div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oProgram->created)); ?></div>
                                                    </div>
                                                </td>
                                                <td>

                                                    <div class="tdropdown">
                                                        <?php
                                                        if ($oProgram->status == "draft") {
                                                            echo '<i class="icon-primitive-dot txt_red fsize16"></i> ';
                                                        } else if ($oProgram->status == 'archive') {
                                                            echo '<i class="icon-primitive-dot txt_red fsize16"></i> ';
                                                        } else {
                                                            echo '<i class="icon-primitive-dot txt_green fsize16"></i> ';
                                                        }
                                                        ?>
                                                        <a class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown">
                                                            <?php
                                                            if ($oProgram->status == "draft") {
                                                                echo 'Inactive';
                                                            } else if ($oProgram->status == "archive") {
                                                                echo 'Archive';
                                                            } else {
                                                                echo 'Active';
                                                            }
                                                            ?>

                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-right status">

                                                        </ul>
                                                    </div>
                                                </td>

                                                <td class="text-center">

                                                    
                                                        <div class="tdropdown ml10"> <a class="table_more dropdown-toggle" data-toggle="dropdown"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a>
                                                            <ul style="right: 0;" class="dropdown-menu dropdown-menu-right status">
                                                                <li><a target="_blank" href="<?php echo base_url('admin/modules/referral/reports/' . $oProgram->id); ?>"><i class="icon-file-stats"></i> Reports</a></li>
                                                                <?php if ($oProgram->status == 'active') { ?>
                                                                    <li><a ref_id="<?php echo $oProgram->id; ?>" change_status = 'draft' class='chg_status'><i class='icon-gear'></i>Inactive</a></li>
                                                                <?php } else { ?>
                                                                    <li><a ref_id="<?php echo $oProgram->id; ?>" change_status = 'active' class='chg_status'><i class='icon-gear'></i>Active</a></li>
                                                                <?php } ?>
                                                                <li><a href="javascript:void(0);" ref_id="<?php echo $oProgram->id; ?>" class="editReferral"><i class="icon-pencil"></i> Edit</a></li>
                                                                <?php if ($oProgram->status != 'archive') {
                                                                    ?><li><a href="javascript:void(0);" ref_id="<?php echo $oProgram->id; ?>" class="moveToArchiveReferral"><i class="icon-file-stats"></i> Move To Archive</a></li><?php }
                                                                ?>

                                                                <li><a href="javascript:void(0);" ref_id="<?php echo $oProgram->id; ?>" class="deleteReferral"><i class="icon-trash"></i> Delete</a></li>
                                                                <li><a target="_blank" href="<?php echo base_url('admin/modules/referral/stats/' . $oProgram->id); ?>"><i class="icon-file-stats"></i>Stats</a></li>
                                                            </ul>
                                                        </div>
                                                </td>
                                                <td style="display: none;"><?php
                                                    if ($oProgram->status == 'archive') {
                                                        echo 'archive';
                                                    } else {
                                                        echo 'active';
                                                    }
                                                    ?></td>
                                            </tr>
                                            <?php
                                        endforeach;
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!--===========TAB 2===========-->
           

<?php else: ?>

        <div class="tab-content"> 
            <!--===========TAB 1===========-->
            <div class="tab-pane active" id="right-icon-tab0">
                <!--====Table====-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title"><?php echo $iActiveCount; ?> Referral Programs</h6>
                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                        <div class="form-control-feedback">
                                            <i class="icon-search4"></i>
                                        </div>
                                    </div>
                                    <div class="table_action_tool">
                                        <a href="#"><i class="icon-calendar52"></i></a>
                                        <a href="#"><i class="icon-arrow-down16"></i></a>
                                        <a href="#"><i class="icon-arrow-up16"></i></a>
                                        <a style="cursor: pointer;" class="editDataList"><i class="icon-pencil"></i></a>
                                        <a style="cursor: pointer; display: none;" id="deleteBulkReferral" class="custom_action_box"><i class="icon-trash position-left"></i></a>
                                        <a style="cursor: pointer; display: none;" id="archiveBulkReferral" class="custom_action_box"><i class="icon-gear position-left"></i> </a>
                                    </div>

                                </div>
                            </div>
                            <div class="panel-body p0">
                                <table class="table datatable-basic">
                                    <thead>
                                        <tr>
                                            <th style="display: none;"></th>
                                            <th style="display: none;"></th>
                                            <th><i class="icon-user"></i>Programs</th>
                                            <th><i class="icon-calendar"></i>Advocates</th>
                                            <th><i class="icon-user"></i>Clicks</th>
                                            <th><i class="icon-envelop"></i>Visits</th>
                                            <th><i class="icon-iphone"></i>Actions</th>
                                            <th><i class="icon-warning2"></i>Top Advocate</th>
                                            <th><i class="icon-warning2"></i>Created</th>
                                            <th><i class="icon-warning2"></i>Stats</th>
                                            <th><i class="fa fa-dot-circle-o"></i> Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div style="margin: 20px 0px 0;" class="text-center">
                                                            <h5 class="mb-20 mt40">
                                                                Looks Like You Don’t Have Created Any Referral Program Yet <img src="<?php echo base_url('assets/images/smiley.png'); ?>"> <br>
                                                                Lets Create a Referral Program.
                                                            </h5>
                                           
                                                            <button <?php if ($bActiveSubsription == false) { ?> title="No Active Subscription" class="btn dark_btn ml20 pDisplayNoActiveSubscription mb40" <?php } else { ?> id="addReferral" <?php } ?> type="button" class="btn dark_btn ml20 mb40"><i class="icon-plus3 txt_teal"></i> &nbsp; New Program</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php endif; ?> 

</div>


<div id="editReferralModel" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="frmeditReferralModel" name="frmeditReferralModel">
				{{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i>&nbsp;&nbsp;Edit Referral Program</h5>
                </div>

                <div id="refTitleEdit">
                    <div class="modal-body">
                        <p>Referral Program Name:</p>
                        <input class="form-control" id="edit_title" name="title" placeholder="Enter Referral Program Name" type="text" required="required"><br>
                        <div id="editReferralValidation" style="color:#FF0000;display:none;"></div>
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="ref_id" id="hidrefid" value="" />
                        <button data-toggle="modal" type="submit" class="btn dark_btn bkg_sblue fsize14 h52">Create</button>
                        <button data-toggle="modal" data-dismiss="modal" type="button" class="btn btn-link fsize14 txt_blue h52">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- add New Survey -->
<div id="addReferralModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="frmaddReferralModal" id="frmaddReferralModal" action="javascript:void();">
				{{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i>&nbsp;&nbsp;Add New Referral Program</h5>
                </div>

                <div id="refTitle">
                    <div class="modal-body">
                        <p>Referral Name:</p>
                        <input class="form-control" id="title" name="title" placeholder="Enter Referral Program Name" type="text" required="required"><br>
                        <div id="addReferralValidation" style="color:#FF0000;display:none;"></div>
                    </div>

                    <div class="modal-footer">
                        <button data-toggle="modal" type="submit" class="btn dark_btn bkg_sblue fsize14 h52">Create</button>
                        <button data-toggle="modal" data-dismiss="modal" type="button" class="btn btn-link fsize14 txt_blue h52">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.modals.segments.segments-popup')
<script src="<?php echo base_url(); ?>assets/js/modules/segments/segments.js" type="text/javascript"></script>
<script type="text/javascript">


    $(document).ready(function () {
		var tableId = 'referralWidgetList';
		var tableBase = custom_data_table(tableId); 
		
        // Setup - add a text input to each footer cell
        $('#referralList thead tr').clone(true).appendTo('#referralList thead');

        $('#referralList thead tr:eq(1) th').each(function (i) {

            //console.log(i);
            if (i === 12) {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterByStatus" value="" placeholder="Search ' + title + '" /><input type="checkbox" class="" id="colStatus">');

                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() !== this.value) {
                        tableBase
						.column(i)
						.search(this.value, $('#colStatus').prop('checked', true))
						.draw();
                    }
                });
            }
        });

        setTimeout(function () {
            $('#activeCampaign').trigger('click');
        }, 1000);


        $(document).on('click', '.filterByColumn', function () {

            $('.nav-tabs').each(function (i) {
                $(this).children().removeClass('active');
            });
            $(this).parent().addClass('active');
            var fil = $(this).attr('fil');
            $('#filterByStatus').val(fil);
            $('#filterByStatus').keyup();

        });

        // Basic datatable
        var tableBase = $('#referralList')
                .on('order.dt', function () {
                    eventFired();
                })
                .on('search.dt', function () {
                    eventFired();
                })
                .on('page.dt', function () {
                    eventFired();
                })
                .DataTable({
                    'order': [1, "desc"],
                    'aoColumnDefs': [
                        {
                            'bSortable': false,
                            'aTargets': ['nosort']
                        }

                    ],
                    "dom": '<"top"f>rt<"datatable-footer"pil><"clear">',
                    "language": {
                        "info": '<span><span class="text-muted ml10">Showing results</span><span class="txt_black ml10"> _START_ - _END_ of _TOTAL_</span></span>',
                        "lengthMenu": 'View <a style="cursor: pointer;" id="_5" >5</a><a style="cursor: pointer;" id="_10" >10</a><a style="cursor: pointer;" id="_20" >20</a><a style="cursor: pointer;" id="_40" >40</a><a style="cursor: pointer;" id="all" >All</a>'
                    },
                    "orderCellsTop": true,
                    "fixedHeader": true

                });


        /* Custom filtering function which will search data in column four between two values */
        $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {

                    //console.log($('.link').hasClass('btn'));
                    if ($('.link').hasClass('btn')) {
                        //console.log(data[8]);
                        var comment = parseInt(data[8], 0);
                        if (comment > 0) {
                            return true;
                        }
                        return false;
                    } else {
                        return true;
                    }

                }
        );

        $('table#referralList thead tr:eq(1)').hide();


        $('#_10').addClass('current');

        $(document).on('click', '#all', function () {

            $('#all').removeClass('current');
            $('#_5').removeClass('current');
            $('#_10').removeClass('current');
            $('#_20').removeClass('current');
            $('#_40').removeClass('current');

            $(this).addClass('current');
            tableBase.page.len(-1).draw();
        });

        $(document).on('click', '#_5', function () {

            $('#all').removeClass('current');
            $('#_5').removeClass('current');
            $('#_10').removeClass('current');
            $('#_20').removeClass('current');
            $('#_40').removeClass('current');

            $(this).addClass('current');
            tableBase.page.len(5).draw();
        });

        $(document).on('click', '#_10', function () {

            $('#all').removeClass('current');
            $('#_5').removeClass('current');
            $('#_10').removeClass('current');
            $('#_20').removeClass('current');
            $('#_40').removeClass('current');

            $(this).addClass('current');
            tableBase.page.len(10).draw();
        });

        $(document).on('click', '#_20', function () {

            $('#all').removeClass('current');
            $('#_5').removeClass('current');
            $('#_10').removeClass('current');
            $('#_20').removeClass('current');
            $('#_40').removeClass('current');

            $(this).addClass('current');
            tableBase.page.len(20).draw();
        });

        $(document).on('click', '#_40', function () {

            $('#all').removeClass('current');
            $('#_5').removeClass('current');
            $('#_10').removeClass('current');
            $('#_20').removeClass('current');
            $('#_40').removeClass('current');

            $(this).addClass('current');
            tableBase.page.len(40).draw();
        });


    });

    $(document).ready(function () {

        $(document).on('change', '#checkAll', function () {
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

            if (totalCheckboxes == numberOfChecked) {
                $('#checkAll').prop('checked', true);
            }
        });

        $(document).on('change', '#checkAllArchive', function () {
            if (false == $(this).prop("checked")) {
                $(".checkRowsArchive").prop('checked', false);
                $(".selectedClass").removeClass('success');
                $('.custom_action_box_archive').hide();
            } else {
                $(".checkRowsArchive").prop('checked', true);
                $(".selectedClass").addClass('success');
                $('.custom_action_box_archive').show();
            }
        });

        $(document).on('click', '.checkRowsArchive', function () {
            var inc = 0;
            var rowId = $(this).val();
            if (false == $(this).prop("checked")) {
                $('#append-' + rowId).removeClass('success');
            } else {
                $('#append-' + rowId).addClass('success');
            }

            $('.checkRowsArchive:checkbox:checked').each(function (i) {
                inc++;
            });

            if (inc == 0) {
                $('.custom_action_box_archive').hide();
            } else {
                $('.custom_action_box_archive').show();
            }

            var numberOfChecked = $('.checkRowsArchive:checkbox:checked').length;
            var totalCheckboxes = $('.checkRowsArchive:checkbox').length;
            if (totalCheckboxes > numberOfChecked) {
                $('#checkAllArchive').prop('checked', false);
            }

            if (totalCheckboxes == numberOfChecked) {
                $('#checkAllArchive').prop('checked', true);
            }
        });

        $(document).on('click', '#deleteBulkReferral', function () {
            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                deleteConfirmationPopup(
				"This list will deleted immediately.<br>You can't undo this action.",
				function () {

					$('.overlaynew').show();
					$.ajax({
						url: "<?php echo base_url('admin/modules/referral/bulkDeleteReferrals'); ?>",
						type: "POST",
						data: {bulk_referral_id: val, _token: '{{csrf_token()}}'},
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

        

        $(document).on('click', '#archiveBulkReferral', function () {
            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                archiveConfirmationPopup(
				"This list will move to archive immediately.<br>You can't undo this action.",
				function () {

					$('.overlaynew').show();
					$.ajax({
						url: "<?php echo base_url('admin/modules/referral/bulkArchiveReferrals'); ?>",
						type: "POST",
						data: {bulk_referral_id: val, _token: '{{csrf_token()}}'},
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

        $('#addReferral').click(function () {
            $('#addReferralModal').modal();
        });

        $('#frmaddReferralModal').on('submit', function () {

            $('.overlaynew').show();
            var formdata = $("#frmaddReferralModal").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/modules/referral/addReferral'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = '<?php echo base_url('admin/modules/referral/setup/'); ?>' + data.id;
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                        $("#addReferralValidation").html(data.msg).show();
                        setTimeout(function () {
                            $("#addReferralValidation").html("").hide();
                        }, 5000);
                    }

                }
            });
            return false;
        });

        $(document).on("click", ".editReferral", function () {
            $('.overlaynew').show();
            var ref_id = $(this).attr('ref_id');
            $.ajax({
                url: '<?php echo base_url('admin/modules/referral/getReferral'); ?>',
                type: "POST",
                data: {'ref_id': ref_id, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#edit_title").val(data.title);
                        $("#hidrefid").val(ref_id);
                        $('.overlaynew').hide();
                        $("#editReferralModel").modal();
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });

        $(document).on("click", ".moveToArchiveReferral", function () {

            var ref_id = $(this).attr('ref_id');
            archiveConfirmationPopup(
			"This list will move to archive immediately.<br>You can't undo this action.",
			function () {

				$('.overlaynew').show();

				$.ajax({
					url: '<?php echo base_url('admin/modules/referral/moveToArchiveReferral'); ?>',
					type: "POST",
					data: {'ref_id': ref_id, _token: '{{csrf_token()}}'},
					dataType: "json",
					success: function (data) {
						if (data.status == 'success') {
							window.location.href = window.location.href;
						} else {
							alertMessage('Error: Some thing wrong!');
							$('.overlaynew').hide();
						}
					}
				});
			});
        });

        $('#frmeditReferralModel').on('submit', function () {
            $('.overlaynew').show();
            var formdata = $("#frmeditReferralModel").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/modules/referral/updateReferral'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = '<?php echo base_url('admin/modules/referral/setup/'); ?>' + data.id;
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                        $("#editReferralValidation").html(data.msg).show();
                        setTimeout(function () {
                            $("#editReferralValidation").html("").hide();
                        }, 5000);
                    }
                }
            });
            return false;
        });

        $(document).on('click', '.deleteReferral', function () {
            var elem = $(this);

            deleteConfirmationPopup(
			"This campaign will deleted immediately.<br>You can't undo this action.",
			function () {
				$('.overlaynew').show();
				var ref_id = $(elem).attr('ref_id');
				$.ajax({
					url: '<?php echo base_url('admin/modules/referral/deleteReferral'); ?>',
					type: "POST",
					data: {ref_id: ref_id, _token: '{{csrf_token()}}'},
					dataType: "json",
					success: function (data) {
						if (data.status == 'success') {
							$('.overlaynew').hide();
							window.location.href = window.location.href;
						}
					}
				});
			});
        });

        $(document).on('click', '.chg_status', function () {
            var refID = $(this).attr('ref_id');
            var status = $(this).attr('change_status');
            $.ajax({
                url: '<?php echo base_url('admin/modules/referral/changeStatus'); ?>',
                type: "POST",
                data: {'refID': refID, 'status': status, _token: '{{csrf_token()}}'},
                dataType: "html",
                success: function (data) {
                    window.location.href = '<?php echo base_url("/admin/modules/referral/") ?>';
                }, error: function () {
                    alertMessage('Error: Some thing wrong!');
                    $('.overlaynew').hide();
                }
            });
        });

        $(document).on('change', '.chgStatus', function () {
            var refID = $(this).attr('ref_id');
            var status = $(this).attr('change_status');
            $.ajax({
                url: '<?php echo base_url('admin/modules/referral/changeStatus'); ?>',
                type: "POST",
                data: {'refID': refID, 'status': status, _token: '{{csrf_token()}}'},
                dataType: "html",
                success: function (data) {
                    //window.location.href = '<?php echo base_url("/admin/modules/referral/") ?>';
                }, error: function () {
                    alertMessage('Error: Some thing wrong!');
                    $('.overlaynew').hide();
                }
            });
            if (status == 'active') {
                $(this).attr('change_status', 'draft');
            } else {
                $(this).attr('change_status', 'active');
            }

        });

    });

    $(document).on('click', '.editArchiveDataList', function () {
        $('.editArchiveAction').toggle();
    });

    $(document).on('click', '.editDataList', function () {
        $('.editAction').toggle();
    });


    // top navigation fixed on scroll and side bar collasped

    $(window).scroll(function () {
        var sc = $(window).scrollTop();
        if (sc > 100) {
            $("#header-sroll").addClass("small-header");
        } else {
            $("#header-sroll").removeClass("small-header");
        }
    });

    function smallMenu() {
        if ($(window).width() < 1600) {
            $('body').addClass('sidebar-xs');
        } else {
            $('body').removeClass('sidebar-xs');
        }
    }

    $(document).ready(function () {
        smallMenu();

        window.onresize = function () {
            smallMenu();
        };
    });

</script>
@endsection

