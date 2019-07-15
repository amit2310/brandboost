<?php
if (!empty($oCampaignLists)) {
    foreach ($oCampaignLists as $oRec) {
        ?>
        <button class="btn btn-xs btn_white_table remove loadAudience" audience-type="lists" action-type="exclude"><img src="<?php echo base_url(); ?>assets/images/red_list.png"> <?php echo $oRec->list_name; ?></button>
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
        <button class="btn btn-xs btn_white_table remove loadAudience" audience-type="tags" action-type="exclude"><img src="<?php echo base_url(); ?>assets/images/red_hash.png"> <?php echo $oTag->tag_name; ?></button>
            <?php
            endif;
        }
    }
?>

<?php
if (!empty($oCampaignSegments)) {
    foreach ($oCampaignSegments as $oRec) {
        ?>
        <button class="btn btn-xs btn_white_table remove loadAudience" audience-type="segments" action-type="exclude"><img src="<?php echo base_url();?>assets/images/filter_red_10.png"> <?php echo $oRec->segment_name;?></button>
        <?php
    }
}
?>

        
<?php
if (!empty($oCampaignContacts)) {
    
        ?>
        <button class="btn btn-xs btn_white_table remove loadAudience" audience-type="contacts" action-type="exclude"><img src="<?php echo base_url();?>assets/images/user_red_10.png"> <?php echo count($oCampaignContacts);?> Contacts</button>
        <?php
    
}
?> 
        
<?php if($bSummaryExclude != true):?>        
<button class="btn btn-xs btn_white_table remove circle viewExcludeOptions" moduleUnitID="<?php echo $moduleUnitID;?>"><img class="plusicon" src="<?php echo base_url();?>assets/images/red_plus.png"/></button>        
<?php endif; ?>



