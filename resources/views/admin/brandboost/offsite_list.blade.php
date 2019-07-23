@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')
<?php
list($canRead, $canWrite) = fetchPermissions('Offsite Campaign');
$iArchiveCount = $iActiveCount = 0;
if (!empty($aBrandbosts)) {
    foreach ($aBrandbosts as $oRec) {
        if ($oRec->status == 3) {
            $iArchiveCount++;
        } else {
            $iActiveCount++;
        }
    }
}
?>

<!-- Content area -->
<div class="content">
    <!-- Dashboard content -->


    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->

            <?php
            if ($viewstats == true) {
                ?>
                <div class="col-md-5">
                    <h3><img src="/assets/images/offsite_icon_19.png" style="width: 16px;"> &nbsp; Off Site Overview</h3>
                </div>
                <?php
            } else {
                ?>
                <div class="col-md-5">
                    <h3><img src="/assets/images/offsite_icon_19.png" style="width: 16px;"> &nbsp; Off Site Review Campaigns</h3>
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="active all"><a style="javascript:void();" id="activeCampaign" class="filterByColumn" fil="1|0|2">Active Campaigns</a></li>
                        <li><a style="javascript:void();" class="filterByColumn" fil="3">Archive</a></li>
                    </ul>
                </div>
                <?php
            }
            ?>


            <!--=============Button Area Right Side==============-->
            <div class="col-md-7 text-right btn_area">
                <div class="btn-group">
                    <button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-calendar2"></i>&nbsp; &nbsp; Filter campaign&nbsp; &nbsp; <span class="caret"></span>
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
                                                <div class="col-md-12"> Content Goes here... </div>
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
                                                <div class="col-md-12"> Content Goes here... </div>
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
                                                <div class="col-md-12"> Content Goes here... </div>
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
                &nbsp; &nbsp; &nbsp;
                <?php if ($user_role != 1 && $canWrite): ?>
                    <button type="button"  <?php if ($bActiveSubsription == false) { ?> title="No Active Subscription" class="btn dark_btn pDisplayNoActiveSubscription" <?php } else { ?> id="addBrandboost" class="btn dark_btn addBrandboost" <?php } ?> data-toggle="modal"><i class="icon-plus3"></i><span> &nbsp;  Add Off Site Review Campaign</span> </button>
                <?php endif; ?>

            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->
    <?php if (!empty($aBrandbosts)): ?>
        <!--&&&&&&&&&&&& TABBED CONTENT &&&&&&&&&&-->
        <div class="tab-content"> 
            <!--===========TAB 1===========-->
            <div class="tab-pane active" id="right-icon-tab0">

                <?php
                if ($viewstats == true) {
					@include('admin.brandboost.campaign-tabs.offsite.overview_stats');
                }
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <span class="pull-left">
                                    <h6 class="panel-title"><?php echo $iActiveCount; ?> Off Site Review Campaigns</h6>
                                </span>
                                <div class="heading_links pull-left">
                                    <a class="top_links btn btn-xs btn_white_table ml20 top_links_all">All</a>
                                    <a class="top_links top_links_Status" getValue="1" style="cursor: pointer;">Active</a>
                                    <a class="top_links top_links_Status" getValue="0" style="cursor: pointer;">Inactive</a> 
                                    <a class="top_links top_links_positive" getValue="positive" style="cursor: pointer;">Positive</a> 
                                    <a class="top_links top_links_neutral" getValue="neutral" style="cursor: pointer;">Neutral</a> 
                                    <a class="top_links top_links_negative" getValue="negative" style="cursor: pointer;">Negative</a> 
                                    <a class="top_links top_links_added_today"  getValue="today" style="cursor: pointer;">Added Today</a>
                                </div>
                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" tableID="offsiteBrandboostCampaign" placeholder="Search by name" type="text">
                                        <div class="form-control-feedback">
                                            <i class="icon-search4"></i>
                                        </div>
                                    </div>
                                    <div class="table_action_tool">
                                        <a href="javascript:void(0);"><i class="icon-calendar52"></i></a>
                                        <a href="javascript:void(0);" class="editDataList"><i class="icon-pencil"></i></a>
                                        <a href="javascript:void(0);" style="display: none;" id="deleteMultipleOffsiteBB" class="custom_action_box"><i class="icon-trash position-left"></i></a>
                                        <a href="javascript:void(0);" style="display: none;" id="archiveMultipleOffsiteBB" class="custom_action_box"><i class="icon-gear position-left"></i></a>
                                    </div>				
                                </div>

                            </div>
                            <div class="panel-body p0">
                                <table class="table datatable-basic-new" id="offsiteBrandboostCampaign">
                                    <thead>
                                        <tr>
                                            <th style="display: none;"></th>
                                            <th style="display: none;"></th>
                                            <th style="display: none;" class="nosort editAction" style="width:30px;"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="control-primary" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
                                            <th><i class="icon-stack-star"></i>Name</th>
                                            <th><i class="icon-star-full2"></i>Source</th>
                                            <th><i class="icon-calendar"></i>Created</th>
                                            <th><i class="icon-user"></i> Contacts</th>
                                            <th><i class=""><img src="<?php echo base_url(); ?>assets/images/emoji_smile.png"/></i> Positive</th>
                                            <th><i class=""><img src="<?php echo base_url(); ?>assets/images/emoji_smile2.png"/></i> Neutral</th>
                                            <th><i class=""><img src="<?php echo base_url(); ?>assets/images/emoji_smile3.png"/></i> Negative</th>
                                            <th><i class=""><img src="<?php echo base_url(); ?>assets/images/clock.png"/></i>Last feedback</th>
    <!--                                            <th><i class="icon-statistics"></i>Statistic</th>-->
                                            <th class="text-center"><i class="fa fa-dot-circle-o fsize12"></i>Status</th>
                                            <th style="display: none;">status</th>
                                            <th style="display: none;">status</th>
                                            <th style="display: none;">Positive</th>
                                            <th style="display: none;">Neutral</th>
                                            <th style="display: none;">Negative</th>
                                            <th style="display: none;">Today</th>
                                            <th><i class="icon-calendar"></i>Last Incoming Lead</th>
                                            <?php if ($user_role != '2') { ?>
                                                <th class="text-center nosort"><i class="fa fa-dot-circle-o"></i> Action</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $recent = strtotime('-24 hours');
                                        foreach ($aBrandbosts as $data) {
                                            //if ($data->status == 1 or $data->status == 0 or $data->status == 2)
                                            if (1) {
                                                $list_id = $data->id;
                                                $offsite_ids = $data->offsite_ids;
                                                $offsite_ids = unserialize($offsite_ids);
                                                $user_id = $data->user_id;
                                                /*$allSubscribers = $this->rLists->getAllSubscribersList($data->id);

                                                $subs = '';
                                                if (!empty($allSubscribers)) {
                                                    $newContacts = 0;
                                                    $subs = $allSubscribers[0];
                                                    foreach ($allSubscribers as $oSubs) {
                                                        if (strtotime($oSubs->created) > $recent) {
                                                            $newContacts++;
                                                        }
                                                        if ($oSubs->status == 2) {
                                                            $iArchiveCount++;
                                                        } else {
                                                            $iActiveContactCount++;
                                                        }
                                                    }
                                                }*/

                                                if (!empty($subs->s_created)) {
                                                    $lastListTime = timeAgo($subs->s_created);
                                                } else {
                                                    $lastListTime = '<div class="media-left">
                                                              <div class="">
                                                                <span class="text-muted text-size-small">[No Data]</span>                                                          </div>
                                                            </div>';
                                                }

                                                $revCount = $positive = $neutral = $negative = 0;
                                                $revCount = getCampaignFeedbackCount($data->id);
												$revCount = 1;
                                                $revCount = !empty($revCount) ? $revCount : 0;
                                                $feedbackCount = \App\Models\Admin\BrandboostModel::getFeedbackCount($data->id);
                                                $positive = $negative = $neutral = $positivePercentage = $neutralPercentage = $negativePercentage = 0;
                                                $positiveRating = 0;
                                                $neturalRating = 0;
                                                $negativeRating = 0;
                                                $positiveGraph = 0;
                                                $neturalGraph = 0;
                                                $negativeGraph = 0;
                                                if (!empty($feedbackCount)) {
                                                    foreach ($feedbackCount as $countUnit) {
                                                        if ($countUnit->category == 'Positive') {
                                                            $positive = $countUnit->total_count;
                                                        } else if ($countUnit->category == 'Neutral') {
                                                            $neutral = $countUnit->total_count;
                                                        } else if ($countUnit->category == 'Negative') {
                                                            $negative = $countUnit->total_count;
                                                        }
                                                    }

                                                    $positiveRating = $positive;
                                                    $neturalRating = $neutral;
                                                    $negativeRating = $negative;

                                                    $totalFeedback = $positive + $neutral + $negative;
                                                    $positivePercentage = number_format(($positive * 100) / $totalFeedback, 2);
                                                    $neutralPercentage = number_format(($neutral * 100) / $totalFeedback, 2);
                                                    $negativePercentage = number_format(($negative * 100) / $totalFeedback, 2);
                                                }

                                                $positiveGraph = $positive * 100 / $revCount;
                                                $neturalGraph = $neutral * 100 / $revCount;
                                                $negativeGraph = $negative * 100 / $revCount;



                                                $offsiteTitle = $data->brand_title;
                                                $offsiteTitle = (!empty($offsiteTitle)) ? $offsiteTitle : 'NA';

                                                if (strlen($offsiteTitle) > 30) {
                                                    $offsiteTitle = substr($offsiteTitle, 0, 29) . '...';
                                                }

                                                $feedbackData = \App\Models\FeedbackModel::getCampFeedbackData($data->id);

                                                if ($data->id == '173') {
                                                    //pre($feedbackCount);
                                                    //die;
                                                }

                                                //$subscriberData = \App\Models\FeedbackModel::getSubscriberInfo($feedbackData->subscriber_id);

                                                $newPositive = $newNegative = $newNeutral = 0;

                                                $aPositiveSubscribers = $aNeutralSubscribers = $aNegativeSubscribers = array();
												if(!$feedbackData->isEmpty()){
													foreach ($feedbackData as $oFeedback) {

														if ($oFeedback->category != '') {
															if ($oFeedback->category == 'Positive' && !in_array($oFeedback->subscriber_id, $aPositiveSubscribers)) {
																if (strtotime($oFeedback->created) > $recent) {
																	$newPositive++;
																}
																$positiveRating++;
																$aPositiveSubscribers[] = $oFeedback->subscriber_id;
															} else if ($oFeedback->category == 'Neutral' && !in_array($oFeedback->subscriber_id, $aNeutralSubscribers)) {
																if (strtotime($oFeedback->created) > $recent) {
																	$newNeutral++;
																}
																$neturalRating++;
																$aNeutralSubscribers[] = $oFeedback->subscriber_id;
															} else {
																if (!in_array($oFeedback->subscriber_id, $aNegativeSubscribers))
																	if (strtotime($oFeedback->created) > $recent) {
																		$newNegative++;
																	}
																$negativeRating++;
																$aNegativeSubscribers[] = $oFeedback->subscriber_id;
															}
														}
													}
												}
                                                ?>

                                                <!--=======================-->
                                                <tr id="append-<?php echo $data->id; ?>" class="selectedClass">
                                                    <td style="display: none;"><?php echo date('m/d/Y', strtotime($data->created)); ?></td>
                                                    <td style="display: none;"><?php echo $data->id; ?></td>
                                                    <td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" value="<?php echo $data->id; ?>" id="chk<?php echo $data->id; ?>" ><span class="custmo_checkmark"></span></label></td>
                                                    <td>
                                                        <div class="media-left media-middle"> <a href="<?php echo base_url('admin/brandboost/offsite_setup/' . $data->id); ?>" class="icons square" brandID="<?php echo $data->id; ?>" b_title="<?php echo $data->brand_title; ?>"><i class="icon-indent-decrease2 txt_blue"></i></a></div>
                                                        <div class="media-left">
                                                            <div class=""><a href="<?php echo base_url('admin/brandboost/offsite_setup/' . $data->id); ?>" class="text-default text-semibold" brandID="<?php echo $data->id; ?>" b_title="<?php echo $data->brand_title; ?>"><?php echo $offsiteTitle; ?></a>
                                                            </div>
                                                            <div class="text-muted text-size-small"> <?php echo setStringLimit($data->brand_desc, 28); ?></div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <?php
                                                        $bbReviewSourcesImages = '';
                                                        foreach ($offsite_ids as $value) {
                                                            if (!empty($value) && $value > 0) {
                                                                $getData = getOffsite($value);
                                                                if (!empty($getData->image)) {
                                                                    if (file_exists("uploads/" . $getData->image)) {
                                                                        $bbReviewSourcesImages = '<img src="/uploads/' . $getData->image . '" /> &nbsp';
                                                                    } else {
                                                                        $bbReviewSourcesImages = '<img src="' . base_url("assets/images/icon_hand.png") . '" /> &nbsp';
                                                                    }
                                                                }
                                                            }
                                                        }

                                                        if (empty($bbReviewSourcesImages)) {
                                                            $bbReviewSourcesImages = '<img src="' . base_url("assets/images/icon_hand.png") . '" /> &nbsp';
                                                        }

                                                        $sourceName = strtolower($getData->name);

                                                        if ($sourceName == 'yelp') {
                                                            $sourceClass = 'txt_red';
                                                        } else if ($sourceName == 'yahoo') {
                                                            $sourceClass = 'txt_purple';
                                                        } else if ($sourceName == 'facebook') {
                                                            $sourceClass = 'txt_dblue';
                                                        } else {
                                                            $sourceClass = 'txt_blue';
                                                        }

                                                        $sourceName = !empty($sourceName) ? $sourceName : 'NA';


                                                        //echo $bbReviewSourcesImages;
                                                        ?>
                                                        <?php
                                                        if (empty($sourceName) || $sourceName == 'NA') {
                                                            echo displayNoData(true);
                                                        } else {
                                                            ?>
                                                            <div class="media-left media-middle"> <a class="icons" href="#"><i class="icon-<?php echo $sourceName . ' ' . $sourceClass; ?>"></i></a> </div>
                                                            <div class="media-left">
                                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><?php echo $sourceName; ?></a></div>
                                                                <div class="text-muted text-size-small">View</div>
                                                            </div>
                                                        <?php } ?>


                                                    </td>

                                                    <td>
                                                        <div class="media-left">
                                                            <div class=""><a href="#" class="text-default text-semibold"><?php echo dataFormat($data->created); ?></a>
                                                            </div>
                                                            <div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($data->created)); ?></div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div data-toggle="tooltip" title="Total contacts <?php echo sizeof($allSubscribers); ?>" data-placement="top">
                                                            <a href="<?php echo base_url('admin/brandboost/offsite_setup/' . $data->id . '?t=contacts'); ?>"  class="text-default text-semibold"><?php echo sizeof($allSubscribers); ?><?php if ($newContacts > 0): ?><?php echo '<span style="color:#FF0000;"> (' . $newContacts . ' new)</span>'; ?><?php endif; ?></a>
                                                        </div>
                                                    </td>


                                                    <td>
                                                        <?php
                                                        $positiveGraph = ceil($positiveGraph);
                                                        $addPC = '';
                                                        if ($positiveGraph > 50) {
                                                            $addPC = 'over50';
                                                        }
                                                        ?>
                                                        <div class="media-left">
                                                            <div class="progress-circle <?php echo $addPC; ?> green cp<?php echo $positiveGraph; ?> <?php if ($positiveGraph > 0): ?>createSegment<?php endif; ?>" segment-type="total-positive" campaign-id="<?php echo $data->id; ?>" campaign-type="email" title="click to create segment">
                                                                <div class="left-half-clipper">
                                                                    <div class="first50-bar"></div>
                                                                    <div class="value-bar"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="media-left">
                                                            <div data-toggle="tooltip" title="<?php echo $positiveRating; ?> out of <?php echo $revCount; ?> Responses" data-placement="top">
                                                                <?php
                                                                if ($positiveRating > 0) {
                                                                    ?>
                                                                    <a href="<?php echo base_url(); ?>admin/feedback/listall/<?php echo $list_id; ?>/?t=positive" class="text-default text-semibold"><?php echo $positiveRating; ?></a>
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
                                                        $neturalGraph = ceil($neturalGraph);
                                                        $addNUC = '';
                                                        if ($neturalGraph > 50) {
                                                            $addNUC = 'over50';
                                                        }
                                                        ?>
                                                        <div class="media-left">
                                                            <div class="progress-circle <?php echo $addNUC; ?> grey cp<?php echo $neturalGraph; ?> <?php if ($neturalGraph > 0): ?>createSegment<?php endif; ?>" segment-type="total-neutral" campaign-id="<?php echo $data->id; ?>" campaign-type="email" title="click to create segment">
                                                                <div class="left-half-clipper">
                                                                    <div class="first50-bar"></div>
                                                                    <div class="value-bar"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="media-left">
                                                            <div data-toggle="tooltip" title="<?php echo $neturalRating; ?> out of <?php echo $revCount; ?> Response" data-placement="top">
                                                                <?php if ($neturalRating > 0) {
                                                                    ?><a  href="<?php echo base_url(); ?>admin/feedback/listall/<?php echo $list_id; ?>/?t=neutral" class="text-default text-semibold">
                                                                        <?php echo $neturalRating; ?></a><?php
                                                                } else {
                                                                    ?><a href="javascript:void(0);" class="text-default text-semibold"><?php echo $neturalRating; ?></a><?php }
                                                                ?>
                                                                    <?php if ($newNeutral > 0): ?>   
                                                                        <?php echo '<span style="color:#FF0000;"> (' . $newNeutral . ' new)</span>'; ?>    
                                                                    <?php endif; ?>
                                                            </div>
                                                        </div>

                                                    </td>
                                                    <td>

                                                        <?php
                                                        $negativeGraph = ceil($negativeGraph);
                                                        $addNEC = '';
                                                        if ($negativeGraph > 50) {
                                                            $addNEC = 'over50';
                                                        }
                                                        ?>
                                                        <div class="media-left">
                                                            <div class="progress-circle <?php echo $addNEC; ?> red cp<?php echo $negativeGraph; ?> <?php if ($negativeGraph > 0): ?>createSegment<?php endif; ?>" segment-type="total-negative" campaign-id="<?php echo $data->id; ?>" campaign-type="email" title="click to create segment">
                                                                <div class="left-half-clipper">
                                                                    <div class="first50-bar"></div>
                                                                    <div class="value-bar"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="media-left">
                                                            <div data-toggle="tooltip" title="<?php echo $negativeRating; ?> out of <?php echo $revCount; ?> Response" data-placement="top">
                                                                <?php if ($negativeRating > 0) {
                                                                    ?><a  href="<?php echo base_url(); ?>admin/feedback/listall/<?php echo $list_id; ?>/?t=negative" class="text-default text-semibold">
                                                                        <?php echo $negativeRating; ?></a><?php
                                                                } else {
                                                                    ?><a href="javascript:void(0);" class="text-default text-semibold"><?php echo $negativeRating; ?></a><?php }
                                                                ?>
                                                                    <?php if ($newNegative > 0): ?>  
                                                                        <?php echo '<span style="color:#FF0000;"> (' . $newNegative . ' new)</span>'; ?>    
                                                                    <?php endif; ?>    
                                                            </div> 
                                                        </div> 

                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($feedbackData->category == 'Positive') {
                                                            $ratingValue = '5.0';
                                                            $icon = ' <i class="fa fa-smile-o"></i></a>';
                                                            $imageIcon = '<a href="#"><img src="http://brandboost.io/assets/images/userp.png" class="img-circle img-xs" alt=""></a>';
                                                        } else if ($feedbackData->category == 'Neutral') {
                                                            $ratingValue = '3.0';
                                                            $icon = ' <i class="fa fa-smile-o"></i></a>';
                                                            $imageIcon = '<a href="#"><img src="http://brandboost.io/assets/images/userp.png" class="img-circle img-xs" alt=""></a>';
                                                        } else if ($feedbackData->category == 'Negative') {
                                                            $ratingValue = '1.0';
                                                            $icon = ' <i class="fa fa-smile-o"></i></a>';
                                                            $imageIcon = '<a href="#"><img src="http://brandboost.io/assets/images/userp.png" class="img-circle img-xs" alt=""></a>';
                                                        } else {
                                                            $ratingValue = 'N/A';
                                                            $icon = '';
                                                            $imageIcon = '';
                                                        }
                                                        ?>
                                                        <?php if ($revCount < 1) { ?>
                                                            <?php echo displayNoData(true); ?>
                                                        <?php } else { ?>
                                                            <div class="media-left media-middle"> <img src="<?php echo smilyRating($ratingValue); ?>" class="img-circle" width="26" alt=""> </div>
                                                            <div class="media-left">
                                                                <div class=""><a href="#" class="text-default text-semibold"><?php echo number_format($ratingValue, 1); ?> </a> </div>
                                                                <div class="text-muted text-size-small"><?php echo ($subscriberData->firstname) ? $subscriberData->firstname : displayNoData(); ?></div>
                                                            </div>
                                                        <?php } ?>
                                                    </td>





                                                                                                <!--                                                    <td><a href="<?php echo base_url(); ?>admin/brandboost/statistics/<?php echo $data->id; ?>" target="_blank"><img src="<?php echo base_url("assets/images/table_graph.png"); ?>" class="" alt=""></a>
                                                                                                                                                    </td>-->

                                                    <td>
                                                        <div class="tdropdown">
                                                            <?php
                                                            if ($data->status == 0) {
                                                                echo '<i class="icon-primitive-dot txt_red fsize16"></i> ';
                                                            } else if ($data->status == 2) {
                                                                echo '<i class="icon-primitive-dot txt_grey fsize16"></i> ';
                                                            } else if ($data->status == 3) {
                                                                echo '<i class="icon-primitive-dot txt_red fsize16"></i> ';
                                                            } else {
                                                                echo '<i class="icon-primitive-dot txt_green fsize16"></i> ';
                                                            }
                                                            ?>
                                                            <a class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown">
                                                                <?php
                                                                if ($data->status == 0) {
                                                                    echo 'Inactive';
                                                                } else if ($data->status == 2) {
                                                                    echo 'Pending';
                                                                } else if ($data->status == 3) {
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

                                                    <td style="display: none;"><?php echo $data->status; ?></td>
                                                    <td style="display: none;"><?php echo $data->status; ?></td>
                                                    <td style="display: none;"><?php echo $positive > 0 ? 'positive' : ''; ?></td>
                                                    <td style="display: none;"><?php echo $neutral > 0 ? 'neutral' : ''; ?></td>
                                                    <td style="display: none;"><?php echo $negative > 0 ? 'negative' : ''; ?></td>
                                                    <td style="display: none;"><?php
                                                        echo date('d M y', strtotime($data->created)) === date('d M y') ? 'today' : '';
                                                        ?></td>


                                                    <td><?php echo $lastListTime; ?></td>
                                                    <td class="text-center">
                                                        <div class="tdropdown ml10"> <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a>

                                                            <?php
                                                            if ($user_role != '2') {
                                                                if ($currentUserId == $user_id || $user_role == 1) {
                                                                    ?>
                                                                    <ul class="dropdown-menu dropdown-menu-right more_act">

                                                                        <?php if ($canWrite): ?>
                                                                            <?php if ($data->status == 1) { ?>
                                                                                <li><a href="javascript:void(0);" class="changeStatusCampaign" brandID="<?php echo $data->id; ?>" status="2"><i class="icon-file-stats"></i> Pause</a></li>
                                                                            <?php } ?>
                                                                            <?php if ($data->status == 2) { ?>
                                                                                <li><a href="javascript:void(0);" class="changeStatusCampaign" brandID="<?php echo $data->id; ?>" status="1"><i class="icon-file-stats"></i> Start</a></li>
                                                                            <?php } ?>
                                                                            <li><a href="<?php echo base_url('admin/brandboost/offsite_setup/' . $data->id); ?>" brandID="<?php echo $data->id; ?>" b_title="<?php echo $data->brand_title; ?>"><i class="icon-gear"></i> Edit</a></li>
                                                                            <li><a href="javascript:void(0);" class="deleteCampaign" brandID="<?php echo $data->id; ?>"><i class="icon-file-locked"></i> Delete</a></li>
                                                                            <li><a href="javascript:void(0);" class="archiveCampaign" brandID="<?php echo $data->id; ?>"><i class="icon-file-text2"></i> Move to Archive</a></li>
                                                                            <li><a href="<?php echo base_url(); ?>admin/brandboost/statistics/<?php echo $data->id; ?>" class="" brandID="<?php echo $data->id; ?>"><i class="icon-file-text2"></i> Statistics</a></li>
                                                                        <?php endif; ?>
                                                                        <li><a href="<?php echo base_url('admin/brandboost/subscribers/' . $list_id); ?>"><i class="icon-gear"></i> Subscribers</a></li>

                                                                    </ul>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </div>


                                                    </td>

                                                </tr>       
                                                <!--=======================-->
                                                <?php
                                                $inc++;
                                            }
                                        }
                                        ?>	
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!--===========TAB 3===========-->


    <?php else: ?>

        <div class="tab-content"> 
            <!--===========TAB 1===========-->
            <div class="tab-pane active" id="right-icon-tab0">

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title"><?php echo $iActiveCount; ?> Off Site Review Campaigns</h6>
                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                        <div class="form-control-feedback"> <i class="icon-search4"></i> </div>
                                    </div>
                                       
                                    <button type="button" class="btn btn-xs btn-default editDataList"><i class="icon-pencil position-left"></i> Edit</button>
                                    <button id="deleteMultipleOffsiteBB" class="btn btn-xs custom_action_box"><i class="icon-trash position-left"></i> Delete</button>
                                    <button id="archiveMultipleOffsiteBB" class="btn btn-xs custom_action_box"><i class="icon-gear position-left"></i> Archive</button>
                                </div>
                            </div>
                            <div class="panel-body p0">
                                <table class="table datatable-basic">
                                    <thead>
                                        <tr>
                                            <th style="display: none;"></th>
                                            <th style="display: none;"></th>
                                            <th><i class="icon-stack-star"></i>Name</th>
                                            <th><i class="icon-star-full2"></i>Source</th>
                                            <th><i class="icon-calendar"></i>Created</th>
                                            <th><i class="icon-graph"></i>Total</th>
                                            <th><i class="fa fa-smile-o fsize12"></i>&nbsp;</th>
                                            <th><i class="fa fa-smile-o fsize12"></i>&nbsp;</th>
                                            <th><i class="fa fa-smile-o fsize12"></i>&nbsp;</th>
                                            <th><i class="icon-alarm-check"></i>Last review</th>
                                            <th><i class="icon-statistics"></i>Statistic</th>
                                            <th class="text-center"><i class="fa fa-dot-circle-o fsize12"></i>Status</th>
                                            <th class="text-center nosort"><i class="fa fa-dot-circle-o"></i> Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="13">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div style="margin: 20px 0px 0;" class="text-center">

                                                            <h5 class="mb-20 mt40">
                                                                Looks Like You Don’t Have Any Off Site Review Campaign Yet <img src="<?php echo site_url('assets/images/smiley.png'); ?>"> <br>
                                                                Lets Create Your First Off Site Review Campaign.
                                                            </h5>
                                                            <?php if ($canWrite): ?>
                                                                <button type="button"  <?php if ($bActiveSubsription == false) { ?> title="No Active Subscription" class="btn dark_btn pDisplayNoActiveSubscription mb40" <?php } else { ?> id="addBrandboost" class="btn dark_btn addBrandboost mb40" <?php } ?> data-toggle="modal"><i class="icon-plus3"></i><span> &nbsp;  Add Off Site Review Campaign</span> </button>
                                                            <?php endif; ?>

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
<!--================================= CONTENT AFTER TAB===============================-->

<!-- addBrandboost -->
<div id="addBrandboostModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="frmAddOffsiteBrandboost" id="frmAddOffsiteBrandboost" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><img src="/new_pages/assets/css/menu_icons/OnSiteBoost_Color.svg"/> Add Off Site Review Campaign &nbsp; <i class="icon-info22 fsize12 txt_grey"></i></h5>
                </div>
                <div class="modal-body">
                    <h6 class="text-semibold">Step 1: Where Would You Like To Boost Your Brand? </h6>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Please Enter Title below:</label>
                                <input class="form-control" id="campaignName" name="campaignName" placeholder="Enter Title" type="text" required>
                            </div>

                            <div class="form-group mb0">
                                <label>Please Enter Description</label>
                                <input class="form-control h52" type="text" id="campaignDescription" name="campaignDescription" value="" placeholder="Enter list description"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-toggle="modal"  type="submit" class="btn dark_btn bkg_sblue fsize14 h52">Continue</button>
                    <button data-toggle="modal" data-dismiss="modal" type="button" class="btn btn-link fsize14 txt_blue h52">Cancel</button>

                </div>
            </form>
        </div>
    </div>
</div>
<!-- /addBrandboost -->



<!-- editBrandboost -->
<div id="editBrandboostModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="frmUpdateOffsiteBrandboost" id="frmUpdateOffsiteBrandboost" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Update Off Site Review Campaign</h5>
                </div>

                <div class="modal-body">
                    <h6 class="text-semibold">Step 1: Where Would You Like To Boost Your Brand? </h6>
                    <p>Please Enter Title below:</p>
                    <input class="form-control" id="edit_campaignName" name="edit_campaignName" placeholder="Enter Titles" type="text" required>
                    <input type="hidden" value="" id="edit_brandboostID" name="edit_brandboostID">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Continue</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /editBrandboost -->
<?php $this->load->view("admin/modals/segments/segments-popup"); ?>
<script src="<?php echo base_url(); ?>assets/js/modules/segments/segments.js" type="text/javascript"></script>

<script type="text/javascript">

    $(document).ready(function () {
        // Setup - add a text input to each footer cell
        $('#offsiteBrandboostCampaign thead tr').clone(true).appendTo('#offsiteBrandboostCampaign thead');

        $('#offsiteBrandboostCampaign thead tr:eq(1) th').each(function (i) {


            if (i === 12) {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterByStatus" value="1|0|2" placeholder="Search ' + title + '" /><input type="checkbox" class="" id="colStatus">');

                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() !== this.value) {
                        tableBase
                                .column(i)
                                .search(this.value, $('#colStatus').prop('checked', true))
                                .draw();
                    }
                });
            }

            if (i === 13) {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterStatus" value="" placeholder="Search ' + title + '" /><input type="checkbox" class="" id="colStatusActive">');

                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() !== this.value) {
                        tableBase
                                .column(i)
                                .search(this.value, $('#colStatusActive').prop('checked', true))
                                .draw();
                    }
                });
            }

            if (i === 14) {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterPositive" value="" placeholder="Search ' + title + '" />');

                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() !== this.value) {
                        tableBase
                                .column(i)
                                .search(this.value)
                                .draw();
                    }
                });
            }

            if (i === 15) {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterNeutral" value="" placeholder="Search ' + title + '" />');

                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() !== this.value) {
                        tableBase
                                .column(i)
                                .search(this.value)
                                .draw();
                    }
                });
            }

            if (i === 16) {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterNegative" value="" placeholder="Search ' + title + '" />');

                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() !== this.value) {
                        tableBase
                                .column(i)
                                .search(this.value)
                                .draw();
                    }
                });
            }

            if (i === 17) {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterAddedToday" value="" placeholder="Search ' + title + '" />');

                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() !== this.value) {
                        tableBase
                                .column(i)
                                .search(this.value)
                                .draw();
                    }
                });
            }

        });

        setTimeout(function () {
            $('#activeCampaign').trigger('click');
        }, 3000);


        $(document).on('click', '.filterByColumn', function () {

            $('.nav-tabs').each(function (i) {
                $(this).children().removeClass('active');
            });
            $(this).parent().addClass('active');
            var fil = $(this).attr('fil');
            $('#filterByStatus').val(fil);
            $('#filterByStatus').keyup();

        });

        $(document).on('click', '.top_links_Status', function () {

            /*$('.heading_links').each(function (i) {
             $(this).children('a').removeClass('btn btn-xs btn_white_table');
             });*/

            var getStatus = $('#filterStatus').val();
            var statusArr = [];
            if ($(this).hasClass('btn_white_table')) {
                var findStatus = $(this).attr('getValue');
                statusArr = getStatus.split("|");
                var index = statusArr.indexOf(findStatus);
                if (index > -1) {
                    statusArr.splice(index, 1);
                }
                $(this).removeClass('btn btn-xs btn_white_table');
            } else {

                var findStatus = $(this).attr('getValue');
                if (getStatus == '') {
                    statusArr.push(findStatus);
                } else {
                    statusArr = getStatus.split("|");
                    statusArr.push(findStatus);
                }

                $(this).addClass('btn btn-xs btn_white_table');
            }

            var newStatusArray = statusArr.join('|');
            $('#filterStatus').val(newStatusArray);
            $('#filterStatus').keyup();

            $('.top_links_all').removeClass('btn btn-xs btn_white_table');

        });

        $(document).on('click', '.top_links_all', function () {

            $('.heading_links').each(function (i) {
                $(this).children('a').removeClass('btn btn-xs btn_white_table');
            });
            $(this).addClass('btn btn-xs btn_white_table');
            //var findStatus = $(this).attr('getValue');

            $('#filterStatus').val('');
            $('#filterStatus').keyup();

            $('#filterPositive').val('');
            $('#filterPositive').keyup();

            $('#filterNeutral').val('');
            $('#filterNeutral').keyup();

            $('#filterNegative').val('');
            $('#filterNegative').keyup();

            $('#filterAddedToday').val('');
            $('#filterAddedToday').keyup();

        });


        $(document).on('click', '.top_links_positive', function () {

            /*$('.heading_links').each(function (i) {
             $(this).children('a').removeClass('btn btn-xs btn_white_table');
             });*/

            if ($(this).hasClass('btn_white_table')) {
                var findValue = '';
                $(this).removeClass('btn btn-xs btn_white_table');
            } else {
                var findValue = $(this).attr('getValue');
                $(this).addClass('btn btn-xs btn_white_table');
            }

            $('#filterPositive').val(findValue);
            $('#filterPositive').keyup();
            $('.top_links_all').removeClass('btn btn-xs btn_white_table');
        });

        $(document).on('click', '.top_links_neutral', function () {

            /*$('.heading_links').each(function (i) {
             $(this).children('a').removeClass('btn btn-xs btn_white_table');
             });*/

            if ($(this).hasClass('btn_white_table')) {
                var findValue = '';
                $(this).removeClass('btn btn-xs btn_white_table');
            } else {
                var findValue = $(this).attr('getValue');
                $(this).addClass('btn btn-xs btn_white_table');
            }

            $('#filterNeutral').val(findValue);
            $('#filterNeutral').keyup();
            $('.top_links_all').removeClass('btn btn-xs btn_white_table');
        });

        $(document).on('click', '.top_links_negative', function () {

            /*$('.heading_links').each(function (i) {
             $(this).children('a').removeClass('btn btn-xs btn_white_table');
             });*/

            if ($(this).hasClass('btn_white_table')) {
                var findValue = '';
                $(this).removeClass('btn btn-xs btn_white_table');
            } else {
                var findValue = $(this).attr('getValue');
                $(this).addClass('btn btn-xs btn_white_table');
            }

            $('#filterNegative').val(findValue);
            $('#filterNegative').keyup();
            $('.top_links_all').removeClass('btn btn-xs btn_white_table');
        });

        $(document).on('click', '.top_links_added_today', function () {

            /*$('.heading_links').each(function (i) {
             $(this).children('a').removeClass('btn btn-xs btn_white_table');
             });*/

            if ($(this).hasClass('btn_white_table')) {
                var findValue = '';
                $(this).removeClass('btn btn-xs btn_white_table');
            } else {
                var findValue = $(this).attr('getValue');
                $(this).addClass('btn btn-xs btn_white_table');
            }

            $('#filterAddedToday').val(findValue);
            $('#filterAddedToday').keyup();
            $('.top_links_all').removeClass('btn btn-xs btn_white_table');
        });

        var tableId = 'offsiteBrandboostCampaign';
        var tableBase = custom_data_table(tableId);


        $('table thead tr:eq(1)').hide();

    });





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

        $(document).on('click', '#deleteMultipleOffsiteBB', function () {
            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                var elem = $(this);
                swal({
                    title: "Are you sure? You want to delete this record!",
                    text: "You will not be able to recover this record!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#EF5350",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                        function (isConfirm) {
                            if (isConfirm) {
                                $('.overlaynew').show();
                                $.ajax({
                                    url: '<?php echo base_url('admin/brandboost/delete_multipal_brandboost'); ?>',
                                    type: "POST",
                                    data: {multi_brandboost_id: val},
                                    dataType: "json",
                                    success: function (data) {
                                        if (data.status == 'success') {
                                            $('.overlaynew').hide();
                                            window.location.href = '';
                                        }
                                    }
                                });
                            }
                        });
            }
        });

        $(document).on('click', '#archiveMultipleOffsiteBB', function () {
            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                var elem = $(this);
                swal({
                    title: "Are you sure? You want to move to archive this record!",
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#EF5350",
                    confirmButtonText: "Yes, move to archive it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                        function (isConfirm) {
                            if (isConfirm) {
                                $('.overlaynew').show();
                                $.ajax({
                                    url: '<?php echo base_url('admin/brandboost/archive_multipal_brandboost'); ?>',
                                    type: "POST",
                                    data: {multi_brandboost_id: val},
                                    dataType: "json",
                                    success: function (data) {
                                        if (data.status == 'success') {
                                            $('.overlaynew').hide();
                                            window.location.href = '';
                                        }
                                    }
                                });
                            }
                        });
            }
        });

        $(document).on('click', '#deleteMultipleArchiveOfflineBB', function () {
            var val = [];
            $('.checkRowsArchive:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                var elem = $(this);
                swal({
                    title: "Are you sure? You want to delete this record!",
                    text: "You will not be able to recover this record!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#EF5350",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                        function (isConfirm) {
                            if (isConfirm) {
                                $('.overlaynew').show();
                                $.ajax({
                                    url: '<?php echo base_url('admin/brandboost/delete_multipal_brandboost'); ?>',
                                    type: "POST",
                                    data: {multi_brandboost_id: val},
                                    dataType: "json",
                                    success: function (data) {
                                        if (data.status == 'success') {
                                            $('.overlaynew').hide();
                                            window.location.href = '';
                                        }
                                    }
                                });
                            }
                        });
            }
        });

        $(document).on('click', '.archiveCampaign', function () {
            var brandID = $(this).attr('brandID');
            var val = [brandID];

            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                var elem = $(this);
                swal({
                    title: "Are you sure? You want to move to archive this record!",
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#EF5350",
                    confirmButtonText: "Yes, move to archive it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                        function (isConfirm) {
                            if (isConfirm) {
                                $('.overlaynew').show();
                                $.ajax({
                                    url: '<?php echo base_url('admin/brandboost/archive_multipal_brandboost'); ?>',
                                    type: "POST",
                                    data: {multi_brandboost_id: val},
                                    dataType: "json",
                                    success: function (data) {
                                        if (data.status == 'success') {
                                            $('.overlaynew').hide();
                                            window.location.href = '';
                                        }
                                    }
                                });
                            }
                        });
            }
        });

        $(document).on("click", ".changeStatusCampaign", function () {
            var brandboostID = $(this).attr('brandID');
            var status = $(this).attr('status');
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/updateOnsiteStatus'); ?>',
                type: "POST",
                data: {'brandboostID': brandboostID, 'status': status},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = '<?php echo base_url('admin/brandboost/offsite'); ?>';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        });

        $('#frmAddOffsiteBrandboost').on('submit', function (e) {
            $('.overlaynew').show();
            var campaignName = $('#campaignName').val();
            var campaignDescription = $('#campaignDescription').val();
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/addOffsite'); ?>',
                type: "POST",
                data: {'campaignName': campaignName, 'campaignDescription': campaignDescription},
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {
                        window.location.href = '<?php echo base_url('admin/brandboost/offsite_setup/'); ?>' + data.brandboostID;
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        });

        $('#frmUpdateOffsiteBrandboost').on('submit', function (e) {
            var campaignName = $('#edit_campaignName').val();
            var brandboostID = $('#edit_brandboostID').val();
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/update_offsite_step1'); ?>',
                type: "POST",
                data: {'campaignName': campaignName, 'brandboostID': brandboostID},
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {
                        window.location.href = '<?php echo base_url('admin/brandboost/offsite_step_1/' + brandboostID); ?>';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        });
    });

    $(document).ready(function () {
        $(document).on('click', '.addBrandboost', function () {
            $('#addBrandboostModal').modal();
        });

        $(document).on('click', '.deleteCampaign', function () {
            var elem = $(this);

            deleteConfirmationPopup(
                    "This campaign will deleted immediately.<br>You can't undo this action.",
                    function () {
                        $('.overlaynew').show();
                        var brandID = $(elem).attr('brandID');
                        $.ajax({
                            url: '<?php echo base_url('admin/brandboost/delete_brandboost'); ?>',
                            type: "POST",
                            data: {brandboost_id: brandID},
                            dataType: "json",
                            success: function (data) {
                                if (data.status == 'success') {
                                    $('.overlaynew').hide();
                                    window.location.href = '';
                                }
                            }
                        });
                    });

        });

        $(document).on('click', '.editArchiveDataList', function () {
            $('.editArchiveAction').toggle();
        });

        $(document).on('click', '.editDataList', function () {
            $('.editAction').toggle();
        });
    });
</script>
@endsection