<?php
if (!empty($oCampaignLists)) {
    foreach ($oCampaignLists as $oRec) {
        ?>
        <button class="btn btn-xs btn_white_table addtag"><img src="<?php echo base_url(); ?>assets/images/blue_line.png"> <?php echo $oRec->list_name; ?></button>
        <?php
    }
}
?>

<?php
if (!empty($oCampaignTags)) {
    //pre($oCampaignTags);
    foreach($oCampaignTags as $oRec){
        $aSelectedTags[] = $oRec->tag_id;
    }
    foreach ($aTags as $oTag) {
        if(in_array($oTag->tagid, $aSelectedTags)):
        ?>
        <button class="btn btn-xs btn_white_table addtag"><img src="<?php echo base_url(); ?>assets/images/blue_hash.png"> <?php echo $oTag->tag_name; ?></button>
            <?php
            endif;
        }
    }
?>

<?php
if (!empty($oCampaignSegments)) {
    foreach ($oCampaignSegments as $oRec) {
        ?>
        <button class="btn btn-xs btn_white_table addtag"><img src="<?php echo base_url();?>assets/images/blue_filter.png"> <?php echo $oRec->segment_name;?></button>
        <?php
    }
}
?>

        
<?php
if (!empty($oCampaignContacts)) {
    
        ?>
        <button class="btn btn-xs btn_white_table addtag"><img src="<?php echo base_url();?>assets/images/user_icon_10.png"> <?php echo count($oCampaignContacts);?> Contacts</button>
        <?php
    
}
?>
        
<?php if($bSummary != true):?>
<button class="btn btn-xs btn_white_table addtag circle viewBroadcastImportOptionSmartPopup" broadcast-id="<?php echo $broadcastID;?>"><img class="plusicon" src="<?php echo base_url();?>assets/images/blue_plus.png"/></button>        
<?php endif; ?>


