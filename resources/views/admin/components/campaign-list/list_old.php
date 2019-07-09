<?php
if (!empty($oData)) {
    foreach ($oData as $oRow) {
        if (!($oRow->deleted || $oRow->delete_status || $oRow->status=='3' || $oRow->status == 'archive')) {
            if ($moduleName == 'onsite' || $moduleName == 'offsite') {
                $campaignName = $oRow->brand_title;
                $moduleUnitID = $oRow->id;
            }else if ($moduleName == 'nps' || $moduleName == 'referral') {
                $campaignName = $oRow->title;
                $moduleUnitID = $oRow->hashcode;
            } else {
                $campaignName = $oRow->title;
                $moduleUnitID = $oRow->id;
            }
            ?>
            <li>
                <div class="media-left">
                    <div class="checkbox">
                        <label class="custmo_checkbox pull-left mt-5 ">
                            <input type="checkbox" name="aCampaign[<?php echo $moduleName; ?>][]" value="<?php echo $moduleUnitID;?>">
                            <span class="custmo_checkmark"></span>

                        </label>
                    </div>
                </div>
                <div class="media-left">
                    <a href="javascript:void(0);" class="text-default">
                        <span>
                            <?php echo ($campaignName) ? $campaignName : '[No Data]'; ?>
                        </span>
                    </a>
                </div>
            </li>
            <?php
        }
    }
}
?>