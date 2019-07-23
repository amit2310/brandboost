<style>
    .variation_container{
        border-bottom: 1px solid #f4f6fa!important;
    }
</style>
<div class="split_container" id="split_container">
    <?php
    if (!empty($oVariations)) {
        $k = 0;
        $bDefault = false;
        foreach ($oVariations as $oVariation) {
            $k++;
            $bDefault = false;
            if($k == 1){
                $bDefault=true;
                foreach($oTemplates as $oTemplate){
                    
                    if($oVariation->template_source == $oTemplate->id){
                        $aDefaultVariationTemplate = $oTemplate;
                        break;
                    }
                }
            }
            ?>

            <div class="variation_container" id="variation_container_<?php echo $oVariation->id; ?>">
                <div class="p20">
                    <div class="row">
                        <div class="col-md-11">
                            <div class="form-group">
                                <label>Variation Name</label>
                                <input class="form-control h52 updateVariation" type="text" name="variation_name" value="<?php echo $oVariation->variation_name; ?>" variation_id="<?php echo $oVariation->id;?>" name="variation_name" placeholder="Enter title for the variation" required="required">
                            </div>
                        </div>
                        <div class="col-md-1 text-right" style="top:30px!important;">
                            <?php if($bDefault == false):?>
                            <button class="btn dark_btn bkg_red btnDeleteVariation"  variation-id="<?php echo $oVariation->id; ?>">X</button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Choose Template</label>
                                <select class="form-control h52 updateVariation" name="variation_template" variation_id="<?php echo $oVariation->id;?>" placeholder="" required="required" <?php if($bDefault):?>disabled="disabled"<?php endif;?>>
                                    <?php if($bDefault == true):?>
                                    <option><?php echo $oTemplate->template_name;?></option>
                                    <?php endif; ?>
                                    <option value="">Choose Template</option>
                                    <?php
                                    if (!empty($oUserTemplates)) {

                                        foreach ($oUserTemplates as $oTemplate):?>
                                            <?php if($oTemplate->user_id == $userData->id):?>
                                                <option value="<?php echo $oTemplate->id;?>" <?php if($oVariation->template_source == $oTemplate->id){ echo 'selected="selected"';} ?>  ><?php echo $oTemplate->template_name;?></option>
                                            <?php endif; ?>
                                        <?php
                                            endforeach;
                                    }
                                    ?>
                                </select>

                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Split Load(%)</label>
                                <input class="form-control h52 updateVariation" name="variation_load" variation_id="<?php echo $oVariation->id;?>" required="required" type="number" value="<?php echo $oVariation->split_load;?>" placeholder="e.g. 20%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>

    
</div>    

<div class="row mt20">
    <div class="col-md-12 text-center">
        <button class="btn dark_btn <?php echo (strtolower($campaignType) == 'email') ? 'bkg_sblue2' : 'bkg_green';?>" name="btnAddMoreVariations" broadcast_id="<?php echo $oBroadcast->broadcast_id; ?>" id="btnAddMoreVariations">Add More Variations</button>
    </div>
</div>