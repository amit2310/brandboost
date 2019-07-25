<?php
$aSelectedSegments = array();
if (!empty($oCampaignSegments)) {
    foreach ($oCampaignSegments as $oRec) {
        $aSelectedSegments[] = $oRec->segment_id;
    }
}
?>
<style>
    .box .table > tbody > tr > td {
        padding: 15px 15px 15px 15px !important;
    }
    .dataTables_paginate{margin-bottom: 0px!important}
</style>
<div class="col-md-12"> <a style="left: 30px; top: 15px;" class="reviews smart-broadcast-export-back slide-toggle bkg_grey_light" ><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_arrow_right.png"/></i></a>
    <h5 style="padding-left: 60px;" class="panel-title">Exclude from segments <span id="totalSegmentCount"> <?php echo count($aSelectedSegments); ?> </span></h5>
    <div style="margin-top: -13px;" class="heading-elements">
        <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
            <input class="form-control input-sm cus_search" tableID="listSmartContacts" placeholder="Search by name" type="text">
            <div class="form-control-feedback"> <i class=""><img src="<?php echo base_url(); ?>assets/images/icon_search.png" width="14"></i> </div>
        </div>
        <div class="table_action_tool"> <a href="javascript:void(0);" class="brig pr-15">Updated just now &nbsp; <i class=""><img src="<?php echo base_url(); ?>assets/images/icon_refresh.png"></i></a> <a href="javascript:void(0);"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_calender.png"></i></a> <a href="javascript:void(0);"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_download.png"></i></a> <a href="javascript:void(0);"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_upload.png"></i></a> <a href="javascript:void(0);"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_edit.png"></i></a> </div>
    </div>
</div>

<div class="col-md-12">
    <div class="panel panel-flat">
        <div class="p0 bkg_white bbot">
            <table class="table" id="listSmartContacts">
                <thead>
                    <tr>
                        <th style="display: none;"></th>
                        <th style="display: none;"></th>
                        <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_list_small.png"></i>Segment Name</th>
                        <th class="text-right"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_name.png"></i>Contacts</th>
                        <th class="text-right"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_created.png"></i>Created</th>
                        <th class="text-right"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_action.png"></i>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $aUser = getLoggedUser();
                    $userID = $aUser->id;
                    foreach ($oSegments as $oSegment):
                        $oSubscribers = $mBroadcast->getSegmentSubscribers($oSegment->id, $userID);
                        ?>
                        <tr>
                            <td style="display: none;"><?php echo date('m/d/Y', strtotime($oSegment->created)); ?></td>
                            <td style="display: none;"><?php echo $oSegment->id; ?></td>
                            <td>
                                <div class="media-left brig pr10">
                                    <label class="custmo_checkbox ">
                                        <input type="checkbox" class="addExcludeSegmentToCampaign" name="checkRows[]" value="<?php echo $oSegment->id; ?>" <?php if (in_array($oSegment->id, $aSelectedSegments)): ?> checked="checked"<?php endif; ?>>
                                        <span class="custmo_checkmark sblue"></span> 
                                    </label>
                                </div>
                                <div class="media-left media-middle pl10"> 
                                    <a class="icons s24" href="#"><img src="<?php echo base_url(); ?>assets/images/icon_list.png" class="img-circle img-xs" alt=""></a>
                                </div>
                                <div class="media-left">
                                    <div class=""><a href="javascript:void(0);" class="text-default text-semibold"><?php echo $oSegment->segment_name; ?></a> </div>
                                </div>
                            </td>
                            <td class="text-right">
                                <div class="media-left text-right pull-right">
                                    <div class=""><a href="#" class="txt_grey"><?php echo count($oSubscribers); ?></a> </div>
                                </div>
                            </td>
                            <td class="text-right">
                                <div class="media-left text-right pull-right">
                                    <div class=""><a href="#" class="txt_grey"><?php echo dataFormat($oSegment->created); ?> <span class="txt_grey"><?php echo date('h:i A', strtotime($oSegment->created)); ?></span></a> </div>
                                </div>
                            </td>
                            <td class="text-right">
                                <div class="media-left pull-right">
                                    <div class="tdropdown ml10"> <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a>
                                        <ul class="dropdown-menu dropdown-menu-right more_act">
                                            <a href="#" class="dropdown_close">X</a>

                                            <li><a href="javascript:void(0);" segment_id="<?php echo $oSegment->id; ?>" class="syncContacts"><i class="icon-arrow-down16"></i> Sync Lastest Contacts</a> </li>
                                            <li><a href="javascript:void(0);" segment_id="<?php echo $oSegment->id; ?>" class="deleteSegment"><i class="icon-bin"></i> Delete</a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    <?php endforeach; ?>    


                </tbody>
            </table>
        </div>
    </div>
</div>

