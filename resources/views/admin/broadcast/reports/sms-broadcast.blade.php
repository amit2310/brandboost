<script src = "https://code.highcharts.com/highcharts.js"></script>


<style>
    .highcharts-tick{stroke:none!important}
    .highcharts-legend, .highcharts-credits{display: none!important;}
    .highcharts-container, .highcharts-container svg {width: 100% !important;}

    #amit {	margin: 0 auto;	height: 250px;}
    #canvas3{height: 181px !important;}


    /*.highcharts-root tspan{font-weight: bold;font-size: 26px;}	
    .highcharts-root .bkg_green {font-size: 12px; font-weight: normal !important;}*/



</style>
<div class="content">
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-7 mt20">
                <h3><img style="width: 16px;" src="<?php echo base_url(); ?>assets/images/analysis_icon.png"> Broadcast Report</h3>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-5 text-right btn_area">
                <div class="btn-group">
                    <button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-calendar2"></i>&nbsp; &nbsp; Filter reports &nbsp; &nbsp; <span class="caret"></span>
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
    <?php
    if (!empty($aBroadcastStats)) {
        
        $iSentMax = 0;
        $iDeliveredMax = 0;
        
        
        foreach ($aBroadcastStats as $oCampaignStats) {
            //pre($oCampaignStats);
            //die;
            $aStats = $oCampaignStats['statsData'];
            $sent = $aStats['sent']['UniqueCount'];
            $delivered = $aStats['delivered']['UniqueCount'];
            $undelivered = $aStats['undelivered']['UniqueCount'];
            $queued = $aStats['queued']['UniqueCount'];
            $failed = $aStats['failed']['UniqueCount'];
                       
            if($sent>$iSentMax){
                $iSentMax = $sent;
                $sentWinner = $oCampaignStats['variationData']->id;
                
            }
            
            if($delivered>$iDeliveredMax){
                $iDeliveredMax = $delivered;
                $deliverWinner = $oCampaignStats['variationData']->id;
                
            }

            $grandSent = $grandSent + $sent;
            $grandDelivered = $grandDelivered + $delivered;
            $grandQueued = $grandQueued + $queued;
            $grandFailed = $grandFailed + $failed;
            $grandUndelivered = $grandUndelivered + $undelivered;
        }
        
        $grandDeliveredRate = number_format((($grandDelivered*100)/$grandSent),2);
        $grandQueuedRate = number_format((($grandQueued*100)/$grandSent),2);
        $grandFailedRate = number_format((($grandFailed*100)/$grandSent),2);
        $grandUndeliveredRate = number_format((($grandUndelivered*100)/$grandSent),2);
    }
    
    $grandDeliveredRate = ($grandDeliveredRate>0) ? $grandDeliveredRate : '0';
    $grandQueuedRate = ($grandQueuedRate>0) ? $grandQueuedRate : '0';
    $grandFailedRate = ($grandFailedRate>0) ? $grandFailedRate : '0';
    
    $aSequence = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
    
    ?>
    <div class="tab-content"> 
        <!--===========TAB 1===========-->
        <div class="tab-pane active" id="right-icon-tab0">
            <div class="row">
                <div class="col-md-3">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Total Sent</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>
                        <div class="panel-body p0 pb10 min_h270" >
                            <div class="semi_circle_smiley"><img src="<?php echo base_url(); ?>assets/images/icon_sms_44.png"/></div>
                            <div id = "semi_circle_chart" class="br5" style = "width: 100%; height: 240px; "></div>
                        </div>
                    </div>


                </div>




                <div class="col-md-3">


                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Total Delivered</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>
                        <div class="panel-body p0 pb10 min_h270" >
                            <div class="semi_circle_smiley"><img src="<?php echo base_url(); ?>assets/images/click_green.png"/></div>
                            <div id = "semi_circle_chart2" class="br5 bkg_gradient" style = "width: 100%; height: 240px;"></div>
                        </div>
                    </div>
                </div>


                <div class="col-md-3">


                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Total Queue</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>
                        <div class="panel-body p0 pb10 min_h270" >
                            <div class="semi_circle_smiley"><img src="<?php echo base_url(); ?>assets/images/click_green.png"/></div>
                            <div id = "semi_circle_chart3" class="br5 bkg_gradient" style = "width: 100%; height: 240px;"></div>
                        </div>
                    </div>
                </div>


                <div class="col-md-3">


                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Total Undelivered</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>
                        <div class="panel-body p0 pb10 min_h270" >
                            <div class="semi_circle_smiley"><img src="<?php echo base_url(); ?>assets/images/click_green.png"/></div>
                            <div id = "semi_circle_chart4" class="br5 bkg_gradient" style = "width: 100%; height: 240px;"></div>
                        </div>
                    </div>
                </div>



            </div>



            <!--====Table====-->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">All Variations</h6>
                            <div class="heading-elements">

                            </div>
                        </div>
                        <div class="panel-body p0">
                            <table class="table datatable-basic">
                                <thead>
                                    <tr>
                                        <th><i class="icon-calendar"></i>Campaign/Variation Name</th>
                                        <?php if ($sendingMethod == 'split'): ?>
                                        <th class="text-center"><i class="fa fa-smile-o"></i>Traffic</th>
                                        <?php endif; ?>
                                        <th class="text-center"><i class="fa fa-smile-o"></i>Sent</th>
                                        <th class="text-center"><i class="fa fa-smile-o"></i>Delivered</th>
                                        <th class="text-center"><i class="fa fa-smile-o"></i>Queued</th>
                                        <th class="text-center"><i class="fa fa-smile-o"></i>Undelivered</th>
                                        <th class="text-center"><i class="fa fa-smile-o"></i>Failed</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>

                                    <!--================================================-->
                                    <?php
                                    if (!empty($aBroadcastStats)) {
                                        $i=-1;
                                        foreach ($aBroadcastStats as $oCampaignStats) {
                                            //pre($oCampaignStats);
                                            //die;
                                            $aStats = $oCampaignStats['statsData'];
                                            $totalSent = $aStats['sent']['UniqueCount'];
                                            $totalDelivered = $aStats['delivered']['UniqueCount'];
                                            $totalUnDelivered = $aStats['undelivered']['UniqueCount'];
                                            $totalQueue = $aStats['queued']['UniqueCount'];
                                            $totalFailed = $aStats['failed']['UniqueCount'];
                                            $i++;
                                            
                                            ?>

                                            <tr>
                                                <td>
                                                    <div class="media-left media-middle"> 
                                                        <a class="icons br5" href="#"><img src="<?php echo base_url();?>assets/images/icon_sms_24.png" class="img-circle img-xs br5" alt=""></a>
                                                    </div>
                                                    <div class="media-left">
                                                        <div class="pt-5"><a href="#" class="text-default txt_dgrey text-semibold">
                                                            <?php if ($sendingMethod == 'split'): ?>
                                                                    <?php echo ($oCampaignStats['variationData']->variation_name) ? $oCampaignStats['variationData']->variation_name : 'Variation '. $aSequence[$i]; ?>
                                                                <?php else: ?>
                                                                    <?php echo ($oBroadcast->title) ? $oBroadcast->title : 'Unnamed Campaign'; ?>
                                                                <?php endif; ?>
                                                            </a> </div>
                                                    </div>
                                                </td>

                                                <?php if ($sendingMethod == 'split'): ?>
                                                <td class="text-center"><span class="txt_dgrey"><?php echo $oCampaignStats['variationData']->split_load; ?>%</span></td>
                                                <?php endif; ?>
                                                <td class="text-center"><span class="<?php echo ($oCampaignStats['variationData']->id == $sentWinner && $sendingMethod == 'split') ? 'txt_green': 'txt_dgrey'?>"><?php echo $totalSent; ?></span></td>
                                                <td class="text-center"><span class="<?php echo ($oCampaignStats['variationData']->id == $deliverWinner && $sendingMethod == 'split') ? 'txt_green': 'txt_dgrey'?>"><?php echo $totalDelivered; ?></span></td>
                                                <td class="text-center"><span class="txt_dgrey"><?php echo $totalQueue; ?></span></td>
                                                <td class="text-center"><span class="txt_dgrey"><?php echo $totalUnDelivered; ?></span></td>
                                                <td class="text-center"><span class="txt_dgrey"><?php echo $totalFailed;?></span></td>
                                                

                                            </tr>
                                            <?php
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
</div>    




<script>
//Semi Circle chart js -- Highcharts js plugins


    $(document).ready(function () {
        var chart = {
            plotBackgroundColor: false,
            plotBorderWidth: 0,
            plotShadow: false
        };
        var title = {
            text: '<?php echo $grandSent;?> <br> <span style="border: none;" class="label bkg_green ml0 ">100%</span>',
            align: 'center',
            verticalAlign: 'middle',
            y: 50
        };
        
        var title2 = {
            text: '<?php echo $grandDelivered;?> <br> <span style="border: none;" class="label bkg_green ml0 "><?php echo $grandDeliveredRate;?>%</span>',
            align: 'center',
            verticalAlign: 'middle',
            y: 50
        };
        
        var title3 = {
            text: '<?php echo $grandQueued;?> <br> <span style="border: none;" class="label bkg_green ml0 "><?php echo $grandQueuedRate;?>%</span>',
            align: 'center',
            verticalAlign: 'middle',
            y: 50
        };
        
        var title4 = {
            text: '<?php echo $grandUndelivered;?> <br> <span style="border: none;" class="label bkg_green ml0 "><?php echo $grandUndeliveredRate;?>%</span>',
            align: 'center',
            verticalAlign: 'middle',
            y: 50
        };


        var tooltip = {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        };
        var plotOptions = {
            pie: {
                dataLabels: {
                    enabled: false,
                    distance: -5550,

                    style: {
                        fontWeight: 'bold',
                        color: 'white',
                        textShadow: '0px 1px 2px black'
                    }
                },
                startAngle: -90,
                endAngle: 90,
                center: ['50%', '75%']
            }
        };
        var series = [{
                type: 'pie',
                name: 'Share',
                colors: ['#4ebc86', '#90EE90', '#228B22', '#008000'],
                innerSize: '85%',
                data: [
                    ['Sent', <?php echo ($sent>0) ? '100' : '0';?>],
                    ['Not Sent', <?php echo ($sent>0) ? '0' : '100';?>],

                    {
                        name: 'Others',
                        y: 0,
                        dataLabels: {
                            enabled: false
                        }
                    }
                ]
            }];


        var series2 = [{
                type: 'pie',
                name: 'Share',
                colors: ['#4ebc86', '#90EE90', '#228B22', '#008000'],
                innerSize: '85%',
                data: [
                    ['Delivered', <?php echo $grandDeliveredRate;?>],
                    ['Not Delivered', <?php echo (100 - ($grandDeliveredRate));?>],

                    {
                        name: 'Others',
                        y: 0,
                        dataLabels: {
                            enabled: false
                        }
                    }
                ]
            }];

        var series3 = [{
                type: 'pie',
                name: 'Share',
                colors: ['#4ebc86', '#90EE90', '#228B22', '#008000'],
                innerSize: '85%',
                data: [
                    ['{series.name}', <?php echo $grandQueuedRate;?>],
                    ['Not Queued', <?php echo (100 - ($grandQueuedRate));?>],

                    {
                        name: 'Others',
                        y: 0,
                        dataLabels: {
                            enabled: false
                        }
                    }
                ]
            }];

        var series4 = [{
                type: 'pie',
                name: 'Share',
                colors: ['#4ebc86', '#90EE90', '#228B22', '#008000'],
                innerSize: '85%',
                data: [
                    ['Undelivered', <?php echo $grandUndeliveredRate;?>],
                    ['Non Undelivered', <?php echo (100 - ($grandUndeliveredRate));?>],

                    {
                        name: 'Others',
                        y: 0,
                        dataLabels: {
                            enabled: false
                        }
                    }
                ]
            }];


        var json = {};
        json.chart = chart;
        json.title = title;
        json.tooltip = tooltip;
        json.series = series;
        json.plotOptions = plotOptions;
        $('#semi_circle_chart').highcharts(json);


        var json2 = {};
        json2.chart = chart;
        json2.title = title2;
        json2.tooltip = tooltip;
        json2.series = series2;
        json2.plotOptions = plotOptions;
        $('#semi_circle_chart2').highcharts(json2);

        var json3 = {};
        json3.chart = chart;
        json3.title = title3;
        json3.tooltip = tooltip;
        json3.series = series3;
        json3.plotOptions = plotOptions;
        $('#semi_circle_chart3').highcharts(json3);


        var json4 = {};
        json4.chart = chart;
        json4.title = title4;
        json4.tooltip = tooltip;
        json4.series = series4;
        json4.plotOptions = plotOptions;
        $('#semi_circle_chart4').highcharts(json4);





    });
</script>
