<div class="panel panel-flat wfSwitchMenu" id="wfChooseContactMenu" style="display:none;">
    <div class="panel-heading">
        <h6 class="panel-title pull-left"><a style="color: #5e729d!important;" class="backtoMenu" href="javascript:void(0);"> <i class=""><img width="20" src="<?php echo base_url(); ?>assets/images/back_icon.png"/></i> &nbsp; Back</a></h6>
        <h6 class="panel-title pull-right">Choose Contacts</h6>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body p20 pt0 bkg_white">
        <div class="row">
            <div class="col-md-12">
                <h6 class="panel-title mt17"><img class="hicon" src="<?php echo base_url(); ?>assets/images/icon_import.png"/> Add Contacts</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="p20 taggroup" id="importPropertyButtons">
                    <?php echo $aContactSelectionData['sImportButtons']; ?>
                    <!--<button class="btn btn-xs btn_white_table addtag"><img src="<?php echo base_url(); ?>assets/images/blue_line.png"> Perfect Contact List <span class="rmtag">x</span></button>
                    <button class="btn btn-xs btn_white_table addtag"><img src="<?php echo base_url(); ?>assets/images/blue_hash.png"> Awesome Tag <span class="rmtag">x</span></button>
                    <button class="btn btn-xs btn_white_table addtag"><img src="<?php echo base_url(); ?>assets/images/blue_line.png"> Review List <span class="rmtag">x</span></button>
                    <button class="btn btn-xs btn_white_table addtag circle viewImportOptions" broadcast-id="194"><img class="plusicon" src="<?php echo base_url(); ?>assets/images/blue_plus.png"></button>-->
                </div>
            </div>

        </div>


    </div>

    <div class="panel-body p20 pt0 bkg_white">
        <div class="row">
            <div class="col-md-12">
                <h6 class="panel-title mt17"><img class="hicon" src="<?php echo base_url(); ?>assets/images/icon_cross.png"/> Exclude Contacts</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="p20 taggroup" id="excludePropertyButtons">
                    <?php echo $aContactSelectionData['sExcludButtons']; ?>

                    <!--<button class="btn btn-xs btn_white_table remove"><img src="<?php echo base_url(); ?>assets/images/red_hash.png"> Awesome Tag <span class="rmtag">x</span></button>
                    <button class="btn btn-xs btn_white_table remove"><img src="<?php echo base_url(); ?>assets/images/red_list.png"> Perfect Contact List <span class="rmtag">x</span></button>
                    <button class="btn btn-xs btn_white_table remove circle viewExcludeOptions" broadcast-id="194"><img class="plusicon" src="<?php echo base_url(); ?>assets/images/red_plus.png"></button>-->
                </div>
            </div>

        </div>

    </div>
    
    <div class="panel-body p20 pt0 bkg_white">
        <div class="row">
            <div class="col-md-12">
                <h6 class="panel-title mt17"><a href="javascript:void(0);" class="viewCampaignContacts"><img class="hicon" src="<?php echo base_url(); ?>assets/images/icon_list_small.png"/> Selected Contact List</a></h6>
            </div>
        </div>
        

    </div>
</div> 