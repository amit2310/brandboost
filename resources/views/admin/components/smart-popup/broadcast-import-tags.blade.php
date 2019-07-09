<?php
if (!empty($oCampaignTags)) {
    foreach ($oCampaignTags as $oRec) {
        $aSelectedTags[] = $oRec->tag_id;
    }
}
?>
<style>
    .box .table > tbody > tr > td {
        padding: 15px 15px 15px 15px !important;
    }
    .dataTables_paginate{margin-bottom: 0px!important}
</style>
<div class="col-md-12"> <a style="left: 30px; top: 15px;" class="reviews smart-broadcast-import-back slide-toggle bkg_grey_light" ><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_arrow_right.png"/></i></a>
    <h5 style="padding-left: 60px;" class="panel-title">Add from Tags <span id="totalTagCount"><?php echo count($aSelectedTags); ?></span></h5>
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
                        <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_list_small.png"></i>Tag Name</th>
                        <th class="text-right"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_name.png"></i>Group Name</th>
                        <th class="text-right"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_name.png"></i>Contacts</th>
                        <th class="text-right"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_created.png"></i>Created</th>
                        
                    </tr>
                </thead>
                <tbody>

                    <?php
                        foreach ($aTags as $aTag):
                            $tagID = $aTag->tagid;
                            $oTagSubscribers = $this->mSubscriber->getTagSubscribers($tagID);
                            ?>
                        <tr>
                            <td style="display: none;"><?php echo date('m/d/Y', strtotime($aTag->tag_created)); ?></td>
                            <td style="display: none;"><?php echo $aTag->tagid; ?></td>
                            <td>
                                <div class="media-left brig pr10">
                                    <label class="custmo_checkbox ">
                                        <input type="checkbox" name="checkRows[]" class="addTagToCampaign" value="<?php echo $aTag->tagid; ?>" <?php if (in_array($aTag->tagid, $aSelectedTags)): ?>checked="checked"<?php endif; ?>>
                                        <span class="custmo_checkmark sblue"></span> 
                                    </label>
                                </div>
                                <div class="media-left media-middle pl10"> 
                                    <a class="icons s24" href="#"><img src="<?php echo base_url(); ?>assets/images/icon_list.png" class="img-circle img-xs" alt=""></a>
                                </div>
                                <div class="media-left">
                                    <div class=""><a href="javascript:void(0);" class="text-default text-semibold"><?php echo $aTag->tag_name; ?></a> </div>
                                </div>
                            </td>
                            <td class="text-right">
                                <div class="media-left text-right pull-right">
                                    <div class=""><a href="#" class="txt_grey"><?php echo $aTag->group_name; ?></a> </div>
                                </div>
                            </td>
                            
                            <td class="text-right">
                                <div class="media-left text-right pull-right">
                                    <div class=""><a href="#" class="txt_grey"><?php echo count($oTagSubscribers); ?></a> </div>
                                </div>
                            </td>
                            <td class="text-right">
                                <div class="media-left text-right pull-right">
                                    <div class=""><a href="#" class="txt_grey"><?php echo dataFormat($aTag->tag_created); ?> <span class="txt_grey"><?php echo date('h:i A', strtotime($aTag->tag_created)); ?></span></a> </div>
                                </div>
                            </td>
                            
                        </tr>

                    <?php endforeach; ?>    


                </tbody>
            </table>
        </div>
    </div>
</div>

