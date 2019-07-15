<?php
$iActiveCount = $iArchiveCount = 0;
$subscribersData = $oCampaignSubscribers;
?>

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
        $CI = & get_instance();
        $CI->load->model("admin/Users_model", "mUser");
        if (count($subscribersData) > 0) {
            foreach ($subscribersData as $oContact) {
                $userData = '';
                if ($oContact->status != '2') {

                    if (!empty($oContact->user_id)) {
                        $userData = $CI->mUser->getUserInfo($oContact->user_id);
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