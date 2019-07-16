<?php
$iActiveCount = $iArchiveCount = 0;
$subscribersData = $aContactSelectionData['oCampaignSubscribers'];
if (!empty($subscribersData)) {
    foreach ($subscribersData as $oCount) {
        if ($oCount->status == 2) {
            $iArchiveCount++;
        } else {
            $iActiveCount++;
        }
    }
}
?>

<div class="panel panel-flat wfSwitchMenu" id="wfCampaignContactList" style="display:none;">
    <div class="panel-heading">
        <h6 class="panel-title pull-left"><a style="color: #5e729d!important;" class="wfBacktoChooseMenu" href="javascript:void(0);"> <i class=""><img width="20" src="<?php echo base_url(); ?>assets/images/back_icon.png"/></i> &nbsp; Back</a></h6>
        <h6 class="panel-title pull-right">Campaign Contacts</h6>
        <div class="clearfix"></div>
    </div>

    <div class="panel-body pt0 bkg_white" style="padding:0;">
        <div class="col-md-12">

            <div class="p20 bbot">
                <h3 class="fsize20 fw500 txt_dark m0" id="totalLiveWorkflowAudience"><?php echo count($subscribersData);?> Contacts</h3>
            </div>
            <div class="alert alert-danger" id="validateAddedContacts" style="display:none;">You did not add any contacts yet</div>



            <div class="p0" id="liveWorkflowAudience">

                <table class="table" id="workflowFilteredAudience">
                    <thead>
                        <tr>
                            <th style="display: none;"></th>
                            <th style="display: none;"></th>
                            <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_name.png"></i>Contact Name</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($subscribersData) > 0) {
                            foreach ($subscribersData as $oContact) {
                                $userData = '';
                                if ($oContact->status != '2') {

                                    if ($oContact->user_id > 0) {
                                        $userData = $this->mUser->getUserInfo($oContact->user_id);
                                    }
                                    ?>
                                    <tr role="row">
                                        <td style="display: none;"><?php echo date('m/d/Y', strtotime($oContact->created)); ?></td>
                                        <td style="display: none;" class="sorting_1"><?php echo $oContact->subscriber_id; ?></td>
                                        <td>
                                            <div class="media-left media-middle"> <?php echo showUserAvtar($userData->avatar, $oContact->firstname, $oContact->lastname); ?> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="javascript:void(0);" class="text-default text-semibold bbot"><?php echo $oContact->firstname; ?> <?php echo $oContact->lastname; ?> </a> <img class="flags" src="<?php echo base_url(); ?>assets/images/flags/<?php echo strtolower($oContact->country_code); ?>.png" onerror="this.src='<?php echo base_url(); ?>assets/images/flags/us.png'"></div>
                                                <div class="text-muted text-size-small"><?php echo $oContact->email; ?></div>
                                            </div>
                                        </td>

                                    </tr>

                                    <?php
                                }
                            }
                        }
                        ?>    

                        
                    </tbody>
                </table>

            </div>


        </div>
    </div>


</div>
<script>
    var tableId = 'workflowFilteredAudience';
    custom_data_table(tableId);
</script>