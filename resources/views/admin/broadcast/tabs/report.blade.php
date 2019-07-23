<style>
    .form-control::placeholder {color: #011540 !important;}
    .interactions ul li small{color: #09204f;}
    .email_sec.small .form-group{margin-bottom: 28px;}

    .pickadate.bkg_white{background: url(<?php echo base_url(); ?>assets/images/icon_calender3_blue.png) 95% 16px no-repeat #fff!important}
    .picker{top: -339px;}
    .picker--opened .picker__holder{max-height: 580px;}
    .picker__day--selected, .picker__day--selected:hover, .picker--focused .picker__day--selected {	background-color: #34aaff;	color: #fff;	border-radius: 100px;}
    .picker__day--today::before {	display: none;}
    .picker__day--today {	position: relative;	background-color: #80c7fb;border-radius: 100%;color: #fff!important;}
    .picker__day {	padding: 0;width: 30px;height: 30px;line-height: 30px;}
    .picker__table td {	margin: 0;	padding: 4px 5px;}
    .picker__day--infocus:hover, .picker__day--outfocus:hover {	cursor: pointer;	color: #333333;	background-color: #f5f5f5;border-radius: 100%;}

    .picker__month, .picker__year{font-size: 14px!important; color: #425784!important; font-weight: 400!important;}
    .picker__holder{border-radius: 4px!important;  box-shadow: 0 3px 5px 0 rgba(1, 21, 64, 0.04), 0 10px 20px 0 rgba(1, 21, 64, 0.02)!important;  border: solid 1px #ebeff6!important; padding-top: 0px;}
    .picker__box{padding: 5px 10px!important;}
    /*    .picker__header {	text-align: center;	position: relative;	font-size: 15px;line-height: 1;	padding-top: 15px;	padding-bottom: 15px; border-bottom: 1px solid #eee; border-top: 1px solid #eee;  margin: 110px -10px 0; }*/
    .picker__header {	text-align: center;	position: relative;	font-size: 15px;line-height: 1;	padding-top: 15px;	padding-bottom: 15px; border-bottom: 1px solid #eee; border-top: 1px solid #eee;  margin: 10px -10px 0; }
    .picker__footer{border-top: 1px solid #eee; padding-top: 10px; padding-bottom: 5px; margin: 0 -10px; display: none;}
    .picker__table{margin: 10px 0!important;}

    .select_day{position:absolute; width: 100%; padding: 10px 20px; top: 0; left: 0; box-sizing: border-box; }
    .select_day a{display: block; padding: 5px 0; color: #253b6a; font-size: 14px;}
    .select_day a.active{font-weight: 600;}

    .picktime{position:relative; height: 50px; padding: 10px 20px; box-sizing: border-box; border-top: 1px solid #eee; margin: 0 -10px; }
    .picktime a{display: block; padding: 5px 0; color: #253b6a; font-size: 14px;}
    .picktime a.active{font-weight: 600;}
    .ui-timepicker-standard {top:555px!important;border:none!important;}
    .selecttime.bkg_white {
        background: url(http://dev.brandboost.io/assets/images/icon_calender3_blue.png) 95% 16px no-repeat #fff!important;
    }



</style>
<?php
$colorClass = (strtolower($oBroadcast->campaign_type) == 'email') ? 'sblue' : 'green';
if (!empty($oBroadcast)) {
    $aMainTriggerData = json_decode($oBroadcast->data);
}
$aDeliveryParam = json_decode($oBroadcast->data);
$deliveryDate = $aDeliveryParam->delivery_date;
$deliveryTime = $aDeliveryParam->delivery_time;
?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/pickers/pickadate/picker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/pickers/pickadate/picker.date.js"></script>
<div <?php if ($activeTab != 'Report'): ?> style="display:none;"<?php endif; ?>>
    <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title"><?php echo ($sendingMethod == 'split') ? 'All Variations' : 'Detailed Report'; ?></h6>
                            <div class="heading-elements">

                            </div>
                        </div>
                        <div class="panel-body p0">
                            <table class="table datatable-basic">
                                <thead>
                                    <tr>
                                        <th><i class="icon-calendar"></i><?php echo ($sendingMethod == 'split') ? 'Campaign/Variation Name' : 'Campaign Name' ?></th>
                                        <?php if ($sendingMethod == 'split'): ?>
                                            <th class="text-center"><i class="fa fa-smile-o"></i>Traffic</th>
                                        <?php endif; ?>
                                        <th class="text-center"><i class="fa fa-smile-o"></i>Sent</th>
                                        <th class="text-center"><i class="fa fa-smile-o"></i>Delivered</th>
                                        <th class="text-center"><i class="fa fa-smile-o"></i>Opens</th>
                                        <th class="text-center"><i class="fa fa-smile-o"></i>Clicks</th>
                                        <th class="text-center"><i class="fa fa-smile-o"></i>Bounce</th>
                                        <th class="text-center"><i class="fa fa-smile-o"></i>Dropped</th>


                                    </tr>
                                </thead>
                                <tbody>

                                    <!--================================================-->
                                    <?php
                                    if (!empty($aBroadcastStats)) {
                                        foreach ($aBroadcastStats as $oCampaignStats) {
                                            //pre($oCampaignStats);
                                            //die;
                                            $aStats = $oCampaignStats['statsData'];
                                            $totalSent = $aStats['processed']['UniqueCount'];
                                            $totalDelivered = $aStats['delivered']['UniqueCount'];
                                            $totalOpen = $aStats['open']['UniqueCount'];
                                            $totalClick = $aStats['click']['UniqueCount'];
                                            $totalBounce = $aStats['bounce']['UniqueCount'];
                                            $totalFailed = $aStats['dropped']['UniqueCount'];
                                            ?>

                                            <tr>
                                                <td>
                                                    <div class="media-left media-middle"> 
                                                        <a class="icons br5" href="#"><i class="icon-envelop br5 txt_teal"></i></a>
                                                    </div>
                                                    <div class="media-left">
                                                        <div class="pt-5"><a href="#" class="text-default txt_dgrey text-semibold">
                                                                <?php if ($sendingMethod == 'split'): ?>
                                                                    <?php echo $oCampaignStats['variationData']->variation_name; ?>
                                                                <?php else: ?>
                                                                    <?php echo $oBroadcast->title; ?>
                                                                <?php endif; ?>

                                                            </a> </div>
                                                    </div>
                                                </td>

                                                <?php if ($sendingMethod == 'split'): ?>
                                                    <td class="text-center"><span class="txt_dgrey"><?php echo $oCampaignStats['variationData']->split_load; ?>%</span></td>
                                                <?php endif; ?>
                                                <td class="text-center"><span class="txt_dgrey"><?php echo $totalSent; ?></span></td>
                                                <td class="text-center"><span class="<?php echo ($oCampaignStats['variationData']->id == $deliverWinner && $sendingMethod == 'split') ? 'txt_green' : 'txt_dgrey' ?>"><?php echo $totalDelivered; ?></span></td>
                                                <td class="text-center"><span class="<?php echo ($oCampaignStats['variationData']->id == $openWinner && $sendingMethod == 'split') ? 'txt_green' : 'txt_dgrey' ?>"><?php echo $totalOpen; ?></span></td>
                                                <td class="text-center"><span class="<?php echo ($oCampaignStats['variationData']->id == $clickWinner && $sendingMethod == 'split') ? 'txt_green' : 'txt_dgrey' ?>"><?php echo $totalClick; ?></span></td>


                                                <td class="text-center"><span class="txt_dgrey"><?php echo $totalBounce; ?></span></td>
                                                <td class="text-center"><span class="txt_dgrey"><?php echo $totalFailed; ?></span></td>


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



