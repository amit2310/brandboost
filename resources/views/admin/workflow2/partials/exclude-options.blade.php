<div class="panel panel-flat wfSwitchMenu" id="wfExcludeOptionMenu" style="display:none;">
    <div class="panel-heading">
        <h6 class="panel-title pull-left"><a style="color: #5e729d!important;" class="wfBacktoChooseMenu" href="javascript:void(0);"> <i class=""><img width="20" src="<?php echo base_url(); ?>assets/images/back_icon.png"/></i> &nbsp; Back</a></h6>
        <h6 class="panel-title pull-right">Exclude Contacts</h6>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body pt0 bkg_white" style="padding:0;">
        <div class="col-md-12">

            <div class="p20 bbot">
                <h3 class="fsize20 fw500 txt_dark m0">Exclude Contacts</h3>
                <p class="txt_grey m0 fw300">Choose how do you want to exclude contacts</p>

            </div>
            <div class="alert alert-danger" id="validateAddedContacts" style="display:none;">You did not add any contacts yet</div>


            <div class="p10">

                <div class="contact_box">
                    <div class="media-left pr10"> <a class="loadAudience icons s32" href="javascript:void(0);" audience-type="contacts" action-type="exclude"><img class="img-circle img-xs" src="<?php echo base_url(); ?>assets/images/red_contact_32.png"></a> </div>
                    <div class="media-left p0"><p class="txt_dark"><a href="javascript:void(0);" class="loadAudience txt_dark" audience-type="contacts" action-type="exclude"><strong>Contacts</strong></a></p>
                        <p class="fsize12 fw300 txt_grey m0">Choose from all available contacts. The list of contacts will be created automatically based on this automation.</p>
                    </div>
                </div>
                <div class="contact_box">
                    <div class="media-left pr10"> <a class="loadAudience icons s32" href="javascript:void(0);" audience-type="lists" action-type="exclude"><img class="img-circle img-xs" src="<?php echo base_url(); ?>assets/images/red_list_32.png"></a> </div>
                    <div class="media-left p0"><p class="txt_dark"><a href="javascript:void(0);" class="loadAudience txt_dark" audience-type="lists" action-type="exclude"><strong>List</strong></a></p>
                        <p class="fsize12 fw300 txt_grey m0">Select one or more of the pre-prepared contact lists. You can create a new list of contacts in the “People” module.</p>
                    </div>
                </div>
                <div class="contact_box">
                    <div class="media-left pr10"> <a class="loadAudience icons s32" href="javascript:void(0);" audience-type="segments" action-type="exclude"><img class="img-circle img-xs" src="<?php echo base_url(); ?>assets/images/red_segment_32.png"></a> </div>
                    <div class="media-left p0"><p class="txt_dark"><a href="javascript:void(0);" class="loadAudience txt_dark" audience-type="segments" action-type="exclude"><strong>Segment</strong></a></p>
                        <p class="fsize12 fw300 txt_grey m0">Select one or more of the pre-prepared contact segments. You can create a new segment of contacts in the "People" module.</p>
                    </div>
                </div>
                <div class="contact_box">
                    <div class="media-left pr10"> <a class="loadAudience icons s32" href="javascript:void(0);" audience-type="tags" action-type="exclude"><img class="img-circle img-xs" src="<?php echo base_url(); ?>assets/images/red_tags_32.png"></a> </div>
                    <div class="media-left p0"><p class="txt_dark"><a href="javascript:void(0);" class="loadAudience txt_dark" audience-type="tags" action-type="exclude"><strong>Tags</strong></a></p>
                        <p class="fsize12 fw300 txt_grey m0">Select all contacts that match a specific tag or group of tags.</p>
                    </div>
                </div>

            </div>

        </div>
    </div>


</div> 