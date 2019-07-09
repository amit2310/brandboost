<tbody>
<?php
if (!empty($oData)) {
    foreach ($oData as $oRow) {
        if (!($oRow->deleted || $oRow->delete_status || $oRow->status == '3' || $oRow->status == 'archive')) {
            if ($moduleName == 'onsite') {
                $campaignName = $oRow->brand_title;
                $moduleUnitID = $oRow->id;
                $ratings = getCampaignReviewRA($oRow->id);
                $brandImgArray = unserialize($oRow->brand_img);
                $brand_img = $brandImgArray[0]['media_url'];

                if (empty($brand_img)) {
                    $imgSrc = base_url('assets/images/default_table_img2.png');
                } else {
                    $imgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brand_img;
                }
            }else if ($moduleName == 'offsite') {
                $campaignName = $oRow->brand_title;
                $moduleUnitID = $oRow->id;
                $ratings = getCampaignReviewRA($oRow->id);
                $brandImgArray = unserialize($oRow->brand_img);
                $brand_img = $brandImgArray[0]['media_url'];

                if (empty($brand_img)) {
                    $imgSrc = base_url('assets/images/default_table_img2.png');
                } else {
                    $imgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brand_img;
                }
            } else if ($moduleName == 'nps') {
                $campaignName = $oRow->title;
                $moduleUnitID = $oRow->hashcode;
                $imgSrc = base_url('assets/images/default_table_img2.png');
                
            }else if ($moduleName == 'referral') {
                $campaignName = $oRow->title;
                $moduleUnitID = $oRow->hashcode;
                $imgSrc = base_url('assets/images/default_table_img2.png');
                
            }else {
                $campaignName = $oRow->title;
                $moduleUnitID = $oRow->id;
            }
            ?>
            <tr>
                <td>
                    <div class="media-left">
                        <label class="custmo_checkbox">
                            <input type="checkbox" name="aCampaign[<?php echo $moduleName; ?>][]" value="<?php echo $moduleUnitID; ?>">
                            <span class="custmo_checkmark blue"></span>
                        </label>
                    </div>
                    <div class="media-left">
                        <img class="br5" width="24" height="24" src="<?php echo $imgSrc; ?>"/>
                    </div>
                    <div class="media-left">
                        <a href="#" class="text-default text-semibold bbot"><?php echo ($campaignName) ? $campaignName : '[No Data]'; ?></a>
                    </div>
                </td>
                <td>
                    <div class="media-left pl10 pr10 brig blef" style="min-width:81px;">
                        <?php if (!empty($ratings) && ($ratings !='nan') && ($ratings>0)): ?>
                            <span class="pt-1 pull-left mr10">
                                <?php echo number_format($ratings,1); ?>
                            </span>
                            <?php if ($ratings >= 4) { ?>
                                <img width="20" src="<?php echo base_url("assets/images/smiley_green_26.png");?>"/>
                            <?php } else if ($ratings == 3) { ?>
                                <img width="20" src="<?php echo base_url("assets/images/smiley_grey_26.png");?>"/>
                            <?php } else if ($ratings < 3) { ?>
                                <img width="20" src="<?php echo base_url("assets/images/smiley_red_26.png");?>"/>
                            <?php } ?>
                        <?php else: ?>
                            <?php echo displayNoData();?>
                        <?php endif; ?>
                    </div>
                </td>
                <td class="text-right"><?php echo dataFormat($oRow->created); ?></td>
            </tr>

            <?php
        }
    }
}
?>
</tbody>