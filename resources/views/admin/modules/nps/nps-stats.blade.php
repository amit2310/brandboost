@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')
<!-- Content area -->
<div class="content">
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-3">
                <h3><i class="icon-star-half"></i> &nbsp; NPS Module Stats</h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="active"><a href="#email_tab" data-toggle="tab"> Email Stats</a></li>
                    <li><a href="#sms_tab" data-toggle="tab">SMS Stats</a></li>
                </ul>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-9 text-right btn_area">
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
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->


    <!-- Dashboard content -->
    <?php
    $emailActive = '';
    $smsActive = '';
    if ($type == 'sms') {
        $smsActive = 'active';
    } else {
        $emailActive = 'active';
    }
    ?>

    <div class="tab-content"> 
        <!--===========TAB 1===========-->
        <div class="tab-pane <?php echo $emailActive; ?>" id="email_tab">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Marketing campaigns -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">NPS Email Stats</h6>
                            <div class="heading-elements">
                                <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                    <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                    <div class="form-control-feedback">
                                        <i class="icon-search4"></i>
                                    </div>
                                </div>&nbsp; &nbsp;

                            </div>
                        </div>
                        <?php
                        $isValidated = true;
                        $eventNo = 0;
                        ?>
                        <div class="panel-body p0">
                            <table class="table datatable-basic datatable-sorting">
                                <thead>
                                    <tr>
                                        <th style="display: none;"></th>
                                        <th style="display: none;"></th>
                                        <th><i class="icon-display"></i> Campaign Type</th>
                                        <th><i class="icon-hash"></i> Processed</th>
                                        <th><i class="icon-display"></i> Delivered</th>
                                        <th><i class="icon-atom"></i> Open</th>
                                        <th><i class="icon-atom"></i> Click</th>
                                        <th><i class="icon-user"></i> Unsubscribe</th>
                                        <th><i class="icon-hash"></i> Bounce</th>
                                        <th><i class="fa fa-dot-circle-o"></i> Dropped</th>
                                        <th><i class="fa fa-dot-circle-o"></i> Spam Report</th>
                                        <th><i class="icon-calendar"></i> Created</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                    foreach ($oNPSEvents as $oEvent) {
                                        if ($oEvent->event_type == 'invite-email' || $oEvent->event_type == 'reminder-email') {

                                            $aStats = $mNPS->getNPSSendgridStats('event', $oEvent->id, '');
                                            $aCategorizedStats = $mNPS->getEmailSendgridCategorizedStatsData($aStats);
                                            //pre($aCategorizedStats);
                                            $processed = $aCategorizedStats['processed']['UniqueCount'];
                                            $delivered = $aCategorizedStats['delivered']['UniqueCount'];
                                            $open = $aCategorizedStats['open']['UniqueCount'];
                                            $click = $aCategorizedStats['click']['UniqueCount'];
                                            $unsubscribe = $aCategorizedStats['unsubscribe']['UniqueCount'];
                                            $bounce = $aCategorizedStats['bounce']['UniqueCount'];
                                            $dropped = $aCategorizedStats['dropped']['UniqueCount'];
                                            $spamReport = $aCategorizedStats['spam_report']['UniqueCount'];

                                            $deliveredGraph = $openGraph = $clickGraph = $unsubscribeGraph = $bounceGraph = $droppedGraph = $spamReportGraph = 0;
                                            if ($processed > 0) {
                                                $deliveredGraph = $delivered * 100 / $processed;
                                                $openGraph = $open * 100 / $processed;
                                                $clickGraph = $click * 100 / $processed;
                                                $unsubscribeGraph = $unsubscribe * 100 / $processed;
                                                $bounceGraph = $bounce * 100 / $processed;
                                                $droppedGraph = $dropped * 100 / $processed;
                                                $spamReportGraph = $spamReport * 100 / $processed;
                                            }
                                            ?>
                                            <tr>
                                                <td style="display: none;"><?php echo date('m/d/Y', strtotime($oEvent->created)); ?></td>
                                                <td style="display: none;"><?php echo $oEvent->id; ?></td>
                                                <td>
                                                    <div class="media-left media-middle"> 
                                                        <a class="icons square" href="#"><i class="icon-indent-decrease2 txt_blue"></i></a> 
                                                    </div>
                                                    <div class="media-left">
                                                        <div><a href="#" class="text-default text-semibold"><?php echo $oEvent->event_type == '' ? '<span style="color:#999999">No Data</span>' : setStringLimit($oEvent->event_type); ?></a></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="media-left">
                                                        <div class="pt-5"><a href="#" class="text-default text-semibold"><?php echo date('d M Y', strtotime($oEvent->created)); ?></a></div>
                                                        <div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oEvent->created)); ?></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" target="_blank" class="text-default text-semibold"><?php echo $processed; ?></a>
                                                    <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total <?php echo $processed; ?> Processed Email">
                                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo $processed; ?>" aria-valuemin="0" aria-valuemax="<?php echo $processed; ?>" style="width:<?php echo $processed > 0 ? '100' : 0; ?>%"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" target="_blank" class="text-default text-semibold"><?php echo $delivered; ?></a>
                                                    <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total <?php echo $delivered; ?> Delivered Email">
                                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo $processed; ?>" aria-valuemin="0" aria-valuemax="<?php echo $delivered; ?>" style="width:<?php echo $deliveredGraph; ?>%"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" target="_blank" class="text-default text-semibold"><?php echo $open; ?></a>
                                                    <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total <?php echo $open; ?> Open Email">
                                                        <div class="progress-bar progress-bar-green2" role="progressbar" aria-valuenow="<?php echo $open; ?>" aria-valuemin="0" aria-valuemax="<?php echo $open; ?>" style="width:<?php echo $openGraph; ?>%"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" target="_blank" class="text-default text-semibold"><?php echo $click; ?></a>
                                                    <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total <?php echo $click; ?> Click">
                                                        <div class="progress-bar progress-bar-green2" role="progressbar" aria-valuenow="<?php echo $click; ?>" aria-valuemin="0" aria-valuemax="<?php echo $click; ?>" style="width:<?php echo $clickGraph; ?>%"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" target="_blank" class="text-default text-semibold"><?php echo $unsubscribe; ?></a>
                                                    <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total <?php echo $unsubscribe; ?> Unsubscribe">
                                                        <div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="<?php echo $unsubscribe; ?>" aria-valuemin="0" aria-valuemax="<?php echo $unsubscribe; ?>" style="width:<?php echo $unsubscribeGraph; ?>%"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" target="_blank" class="text-default text-semibold"><?php echo $bounce; ?></a>
                                                    <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total <?php echo $bounce; ?> Bounce Email">
                                                        <div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="<?php echo $bounce; ?>" aria-valuemin="0" aria-valuemax="<?php echo $bounce; ?>" style="width:<?php echo $bounceGraph; ?>%"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" target="_blank" class="text-default text-semibold"><?php echo $dropped; ?></a>
                                                    <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total <?php echo $dropped; ?> Dropped Email">
                                                        <div class="progress-bar progress-bar-red" role="progressbar" aria-valuenow="<?php echo $dropped; ?>" aria-valuemin="0" aria-valuemax="<?php echo $dropped; ?>" style="width:<?php echo $droppedGraph; ?>%"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" target="_blank" class="text-default text-semibold"><?php echo $spamReport; ?></a>
                                                    <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total <?php echo $spamReport; ?> Spam Email">
                                                        <div class="progress-bar progress-bar-red" role="progressbar" aria-valuenow="<?php echo $spamReport; ?>" aria-valuemin="0" aria-valuemax="<?php echo $spamReport; ?>" style="width:<?php echo $spamReportGraph; ?>%"></div>
                                                    </div>
                                                </td> 


                                            </tr><?php
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

        <!--########################TAB 2 ##########################-->
        <div class="tab-pane <?php echo $smsActive; ?>" id="sms_tab">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Marketing campaigns -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">NPS SMS Stats</h6>
                            <div class="heading-elements">
                                <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                    <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                    <div class="form-control-feedback">
                                        <i class="icon-search4"></i>
                                    </div>
                                </div>&nbsp; &nbsp;

                            </div>
                        </div>         
                        <table class="table datatable-basic datatable-sorting">
                            <thead>
                                <tr>

                                    <th style="display: none;"></th>
                                    <th style="display: none;"></th>
                                    <th><i class="icon-hash"></i> Campaign Type</th>
                                    <th><i class="icon-hash"></i> Sent Sms</th>
                                    <th><i class="icon-atom"></i> Delivered Sms</th>
                                    <th><i class="icon-atom"></i> Accepted Sms</th>
                                    <th><i class="fa fa-dot-circle-o"></i> Failed Sms</th>
                                    <th><i class="fa fa-dot-circle-o"></i> Queued Sms</th>
                                    <th><i class="icon-calendar"></i> Created</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                foreach ($oNPSEvents as $oEvent) {
                                    if ($oEvent->event_type == 'invite-sms' || $oEvent->event_type == 'reminder-sms') {
                                        $aStats = $mNPS->getEmailTwilioStats('event', $oEvent->id);
                                        $aCategorizedStatsSms = $mNPS->getEmailTwilioCategorizedStatsData($aStats);
                                        //pre($aStats);
                                        $sentSms = $aCategorizedStatsSms['sent']['UniqueCount'];
                                        $deliveredSms = $aCategorizedStatsSms['delivered']['UniqueCount'];
                                        $acceptedSms = $aCategorizedStatsSms['accepted']['UniqueCount'];
                                        $failedSms = $aCategorizedStatsSms['failed']['UniqueCount'];
                                        $queuedSms = $aCategorizedStatsSms['queued']['UniqueCount'];

                                        $deliveredSmsGraph = $acceptedSmsGraph = $failedSmsGraph = $queuedSmsGraph = 0;
                                        if ($sentSms > 0) {
                                            $deliveredSmsGraph = $deliveredSms * 100 / $sentSms;
                                            $acceptedSmsGraph = $acceptedSms * 100 / $sentSms;
                                            $failedSmsGraph = $failedSms * 100 / $sentSms;
                                            $queuedSmsGraph = $queuedSms * 100 / $sentSms;
                                        }
                                        ?>
                                        <tr>
                                            <td style="display: none;"><?php echo date('m/d/Y', strtotime($oEvent->created)); ?></td>
                                            <td style="display: none;"><?php echo $oEvent->id; ?></td>
                                            <td>
                                                <div class="media-left media-middle"> 
                                                    <a class="icons square" href="#"><i class="icon-indent-decrease2 txt_blue"></i></a> 
                                                </div>
                                                <div class="media-left">
                                                    <div><a href="#" class="text-default text-semibold"><?php echo $oEvent->event_type == '' ? '<span style="color:#999999">No Data</span>' : setStringLimit($oEvent->event_type); ?></a></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="media-left">
                                                    <div class="pt-5"><a href="#" class="text-default text-semibold"><?php echo date('d M Y', strtotime($oEvent->created)); ?></a></div>
                                                    <div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oEvent->created)); ?></div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" target="_blank" class="text-default text-semibold"><?php echo $sentSms; ?></a>
                                                <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total <?php echo $sentSms; ?> Sent SMS">
                                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo $sentSms; ?>" aria-valuemin="0" aria-valuemax="<?php echo $sentSms; ?>" style="width:<?php echo $sentSms > 0 ? '100' : 0; ?>%"></div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" target="_blank" class="text-default text-semibold"><?php echo $deliveredSms; ?></a>
                                                <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total <?php echo $deliveredSms; ?> Delivered SMS">
                                                    <div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="<?php echo $deliveredSms; ?>" aria-valuemin="0" aria-valuemax="<?php echo $deliveredSms; ?>" style="width:<?php echo $deliveredSmsGraph; ?>%"></div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" target="_blank" class="text-default text-semibold"><?php echo $acceptedSms; ?></a>
                                                <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total <?php echo $acceptedSms; ?> Accepted SMS">
                                                    <div class="progress-bar progress-bar-green2" role="progressbar" aria-valuenow="<?php echo $acceptedSms; ?>" aria-valuemin="0" aria-valuemax="<?php echo $acceptedSms; ?>" style="width:<?php echo $acceptedSmsGraph; ?>%"></div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" target="_blank" class="text-default text-semibold"><?php echo $failedSms; ?></a>
                                                <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total <?php echo $failedSms; ?> Failed SMS">
                                                    <div class="progress-bar progress-bar-red" role="progressbar" aria-valuenow="<?php echo $failedSms; ?>" aria-valuemin="0" aria-valuemax="<?php echo $failedSms; ?>" style="width:<?php echo $failedSmsGraph; ?>%"></div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" target="_blank" class="text-default text-semibold"><?php echo $queuedSms; ?></a>
                                                <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total <?php echo $queuedSms; ?> Queued SMS">
                                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo $queuedSms; ?>" aria-valuemin="0" aria-valuemax="<?php echo $queuedSms; ?>" style="width:<?php echo $queuedSmsGraph; ?>%"></div>
                                                </div>
                                            </td>
                                            <?php
                                        }
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!--########################TAB end ##########################--> 
            </div>
        </div>
    </div>
</div>
@endsection