<?php
if ($activeTab == 'Design Template Edit') {
    $activeDesign = 'active';
    $backButtonTab = 'Choose Template';
    $nextButtonTab = 'Settings';
} else if ($activeTab == 'Settings') {
    $activeSetting = 'active';
    $backButtonTab = 'Design Template Edit';
    $nextButtonTab = 'Campaign Summary';
} else if ($activeTab == 'Campaign Summary') {
    $activeSummary = 'active';
    $backButtonTab = 'Settings';
    $nextButtonTab = '';
} else if ($activeTab == 'Choose Template') {
    $activeChoose = 'active';
    $backButtonTab = 'Review Contacts';
    $nextButtonTab = 'Design Template Edit';
} else if ($activeTab == 'Select List') {
    $activeSelect = 'active';
    $backButtonTab = '';
    $nextButtonTab = 'Review Contacts';
} else if ($activeTab == 'Review Contacts') {
    $activeReviewContacts = 'active';
    $backButtonTab = 'Select List';
    $nextButtonTab = 'Choose Template';
} else if ($activeTab == 'Report') {
    $activeReport = 'active';
} else {
    $activeSelect = 'active';
    $backButtonTab = '';
    $nextButtonTab = 'Choose Template';
}
?>
<style>
    .content-wrapper:before{height:210px!important;}
    .content-wrapper{font-size: 92%;}

</style>
<!-- Content area -->
<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->

    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-5">
                <h3 class="mt30"><img src="<?php echo base_url() ?>assets/images/menu_icons/<?php echo (strtolower($oBroadcast->campaign_type) == 'sms') ? 'Sms_Light.svg' : 'Email_Light.svg'; ?>"><?php echo $oBroadcast->title; ?></h3>

            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-7 text-right btn_area">

<!--                <button type="button" class="btn light_btn importModuleContact contactShow <?php echo $clientClass; ?>" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $moduleUnitID ?>" data-redirect="<?php echo base_url(); ?>admin/brandboost/onsite_setup/<?php echo $moduleUnitID; ?>"><i class="icon-arrow-up16"></i><span> &nbsp;  Import Contacts</span> </button>
                <a class="btn light_btn ml10 contactShow <?php echo $clientClass; ?>" href="<?php echo base_url() ?>admin/subscriber/exportSubscriberCSV?module_name=<?php echo $moduleName; ?>&module_account_id=<?php echo $moduleUnitID; ?>"><i class="icon-arrow-down16"></i><span> &nbsp;  Export Contacts</span> </a>
                <button type="button" class="btn dark_btn dropdown-toggle ml10 addModuleContact" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $moduleUnitID ?>"><i class="icon-plus3"></i><span> &nbsp;  Add Contact</span> </button>  -->
                <?php if ($bExpired == false): ?>
                    <button type="button" style="padding: 7px 15px!important;" class="btn dark_btn launchCampaign" broadcastId = "<?php echo $broadcast_id; ?>" status="draft" current_state="<?php echo $activeTab; ?>"><i class="icon-plus3"></i><span> &nbsp;  Save as Draft</span> </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php $this->load->view("admin/broadcast/partials/setup_menu"); ?>

    <?php if ($bExpired == false): ?>
        <?php $this->load->view("admin/broadcast/tabs/target_audience", array('activeSelect' => $activeSelect)); ?>
    <?php endif; ?>
    <?php $this->load->view("admin/broadcast/tabs/review_audience", array('activeReviewContacts' => $activeReviewContacts)); ?>

    <?php if ($bExpired == false): ?>
        <?php $this->load->view("admin/broadcast/tabs/choose_template", array('activeChoose' => $activeChoose)); ?>

        <?php
        if (strtolower($oBroadcast->campaign_type) == 'email') {

            $this->load->view("admin/broadcast/tabs/template_design_beta", array('activeDesign' => $activeDesign));
        } else {

            $this->load->view("admin/broadcast/tabs/template_design_sms", array('activeDesign' => $activeDesign));
        }
        ?>
        <?php $this->load->view("admin/broadcast/tabs/settings", array('activeSetting' => $activeSetting)); ?>
    <?php endif; ?>
    <?php $this->load->view("admin/broadcast/tabs/campaign_summary", array('activeSummary' => $activeSummary, 'broadcast_id' => $broadcast_id)); ?>
    <?php $this->load->view("admin/broadcast/tabs/report", array('activeReport' => $activeReport, 'broadcast_id' => $broadcast_id)); ?>






    <div class="row">
        <div class="col-md-6">

            <?php if ($bExpired == false): ?>
                <button class="btn btn_white bkg_white h52 txt_dark minw_140 shadow br5 continueButton" <?php if ($activeSelect): ?>style="display:none;"<?php endif; ?> id="backButton" tab="<?php echo $backButtonTab; ?>"><i class="icon-arrow-left12 mr20"></i> Back</button>
            <?php endif; ?>
            &nbsp;
        </div>
        <div class="col-md-6 text-right">

            <?php if ($bExpired == false): ?>
                <button  class="btn dark_btn <?php echo (strtolower($oBroadcast->campaign_type) == 'email') ? 'bkg_sblue2' : 'bkg_green'; ?> h52 minw_160" id="continueButton" tab="<?php echo $nextButtonTab; ?>" <?php if ($activeTab == 'Campaign Summary'): ?>style="display:none;"<?php endif; ?>>Next step <i class="icon-arrow-right13 ml20"></i></button>
            <?php endif; ?>

            <button class="btn btn_white bkg_white h52 txt_dark minw_140 shadow br5 mr10 previewDefaultCampaign" id="showBroadcastPreview" campaign_id="<?php echo $oBroadcast->id; ?>" <?php if ($activeTab != 'Campaign Summary'): ?>style="display:none;"<?php endif; ?>>Preview</button>
            <?php if ($bExpired == false): ?>
                <button class="btn btn_white bkg_white h52 txt_dark minw_160 shadow br5 mr10 launchCampaign" id="saveDraftBroadcast" broadcastId = "<?php echo $broadcast_id; ?>" status="draft" current_state="<?php echo $activeTab; ?>" <?php if ($activeTab != 'Campaign Summary'): ?>style="display:none;"<?php endif; ?>>Save as Draft</button> 
                <button class="btn dark_btn <?php echo (strtolower($oBroadcast->campaign_type) == 'email') ? 'bkg_sblue2' : 'bkg_green'; ?> h52 minw_160 launchCampaign" id="runBroadcast" broadcastId = "<?php echo $broadcast_id; ?>" status="active" <?php if ($activeTab != 'Campaign Summary'): ?>style="display:none;"<?php endif; ?>>Run Broadcast <i class="icon-arrow-right13 ml10"></i></button>
            <?php endif; ?>

            <!--<?php if ($bExpired == false): ?>
                        <button  class="btn dark_btn <?php echo (strtolower($oBroadcast->campaign_type) == 'email') ? 'bkg_sblue2' : 'bkg_green'; ?> h52 minw_160 continueButton" id="continueButton" tab="<?php echo $nextButtonTab; ?>">Next step <i class="icon-arrow-right13 ml20"></i></button>
            <?php endif; ?>-->


        </div>
    </div>





</div>

<div id="AddNewListToBroadcast" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="frmaddNewListModal" id="frmaddNewListModal" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><img src="<?php echo base_url(); ?>assets/css/menu_icons/Email_Color.svg"/> Create a new list &nbsp; <i class="icon-info22 fsize12 txt_grey"></i></h5>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Please Enter Title below:</label>
                                <input class="form-control" id="title" name="title" placeholder="Enter Title" type="text" required>

                            </div>

                            <div class="form-group mb0">
                                <label>Please Enter Description:</label>
                                <input class="form-control h52" type="text" id="listDescription" name="listDescription" value="" placeholder="Enter list description"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn dark_btn bkg_sblue fsize14 h52">Continue</button>
                    <button data-toggle="modal" data-dismiss="modal" type="button" class="btn btn-link fsize14 txt_blue h52">Cancel</button>

                </div>
            </form>
        </div>
    </div>
</div>
<div id="workflow_template_stripo_modal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-tags"></i>&nbsp; Preview Template</h5>
            </div>
            <div class="modal-body template_edit">
                <form method="post" class="form-horizontal" action="javascript:void();">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="workflowPreviewTemplateContainer"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="wfSendTestEmail" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><img src="<?php echo base_url(); ?>assets/css/menu_icons/Email_Color.svg"/> &nbsp;Send Test Email <i class="icon-info22 fsize12 txt_grey"></i></h5>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input class="form-control" id="wfTextPopupSendTestEmail" placeholder="Email" type="text" required>                          

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="wf_test_email_campaign_id" />
                <button type="button" id="wfBtnPopupSendTestEmail" class="btn dark_btn bkg_sblue fsize14">Send Email</button>
            </div>

        </div>
    </div>
</div>


<div id="wfSendTestSMS" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><img src="<?php echo base_url(); ?>assets/css/menu_icons/Sms_Color.svg"/> &nbsp;Send Test SMS <i class="icon-info22 fsize12 txt_grey"></i></h5>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input class="form-control" id="wfTextPopupSendTestSMS" placeholder="Phone Number" type="text" value="<?php echo $oUser->mobile; ?>" required>                          
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="wf_test_sms_campaign_id" />
                <button type="button" id="wfBtnPopupSendTestSMS" class="btn dark_btn bkg_sblue fsize14">Send SMS</button>
            </div>

        </div>
    </div>
</div>

<div id="emaileditorinfo" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><img src="<?php echo base_url(); ?>assets/css/menu_icons/Email_Color.svg"/> &nbsp;How to use this editor <i class="icon-info22 fsize12 txt_grey"></i></h5>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <b>Brandboost Email Builder</b> We will revert back to you very soon with detailed document and help videos
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark_btn bkg_sblue fsize14">Close</button>
            </div>

        </div>
    </div>
</div>

<div id="processingBroadcast" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title">Processing broadcast <i class="icon-info22 fsize12 txt_grey"></i></h5>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-2 text-center">
                        <i class="fa fa-refresh mt20 <?php if (strtolower($oBroadcast->campaign_type) == 'email'): ?>txt_blue<?php else:?>txt_green<?php endif; ?>" style="font-size:88px;"></i>                       
                            
                    </div>
                    <div class="col-md-10">
                        
                        <h3>We are processing your campaign</h3>
                        <p>We are gathering all the details and processing your campaign. You can leave this page any time. If we need extra input from you, we will let you know</p>
                            
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark_btn bkg_sblue fsize14">Close</button>
            </div>

        </div>
    </div>
</div>

<div id="smseditorinfo" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><img src="<?php echo base_url(); ?>assets/css/menu_icons/Sms_Color.svg"/> &nbsp;How to use this sms editor <i class="icon-info22 fsize12 txt_grey"></i></h5>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <b>Brandboost SMS Editor</b> We will revert back to you very soon with detailed document and help videos
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark_btn bkg_sblue fsize14">Close</button>
            </div>

        </div>
    </div>
</div>

<script>

    $(document).ready(function () {

        $(document).on("click", "#wfBtnPopupSendTestEmail", function () {
            var email = $("#wfTextPopupSendTestEmail").val();
            var campaignId = $("#wf_test_email_campaign_id").val();
            var moduleName = '<?php echo $moduleName; ?>';
            $('.overlaynew').show();
            $.ajax({
                url: '/admin/workflow/sendTestEmailworkflowCampaign',
                type: "POST",
                data: {'moduleName': moduleName, campaignId: campaignId, email: email},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        displayMessagePopup('success', 'Success', 'Test email sent successfully'); //javascript notification msg (edited) 
                        $("#wfSendTestEmail").modal("hide");
                        $('.overlaynew').hide();
                    }
                }
            });
        });

        $(document).on("click", "#wfBtnPopupSendTestSMS", function () {
            var number = $("#wfTextPopupSendTestSMS").val();
            var campaignId = $("#wf_test_sms_campaign_id").val();
            var moduleName = '<?php echo $moduleName; ?>';
            $('.overlaynew').show();
            $.ajax({
                url: '/admin/workflow/sendTestSMSworkflowCampaign',
                type: "POST",
                data: {'moduleName': moduleName, campaignId: campaignId, number: number},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        displayMessagePopup("success", "Success", "Test SMS sent successfully!");
                        $("#wfSendTestSMS").modal("hide");
                        $('.overlaynew').hide();
                    }
                }
            });
        });

        $(document).on("click", ".previewDefaultTemplate", function (e) {
            var templateID = $(this).attr('template_id');
            var moduleName = $(this).attr('modulename');
            var source = $(this).attr('source');
            if (templateID != '' && moduleName != '') {
                $('.overlaynew').show();
                $.ajax({
                    url: '<?php echo base_url('admin/workflow/loadStripoTemplatePreview'); ?>',
                    type: "POST",
                    data: {moduleName: moduleName, template_id: templateID, source: source},
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            $('.overlaynew').hide();
                            $("#workflowPreviewTemplateContainer").html(data.content);
                            $("#workflow_template_stripo_modal").modal();
                        } else if (data.status == 'error') {
                            $('.overlaynew').hide();

                        }

                    }
                });

            }
        });


        $(document).on("click", ".previewDefaultCampaign", function (e) {
            var campaignID = $(this).attr('campaign_id');
            if (campaignID != '') {
                $('.overlaynew').show();
                $.ajax({
                    url: '<?php echo base_url('admin/broadcast/previewBroadcastCampaign'); ?>',
                    type: "POST",
                    data: {campaign_id: campaignID},
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            $('.overlaynew').hide();
                            $("#workflowPreviewTemplateContainer").html(data.content);
                            $("#workflow_template_stripo_modal").modal();
                        } else if (data.status == 'error') {
                            $('.overlaynew').hide();

                        }

                    }
                });

            }
        });
        $('#frmaddNewListModal').on('submit', function () {
            $('.overlaynew').show();
            var formdata = $("#frmaddNewListModal").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/lists/addList'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        $('#Createnewlist').modal('hide');
                        //alertMessageAndRedirect(data.msg, window.location.href);
                        window.location.href = '<?php echo base_url(); ?>admin/lists/getListContacts?list_id=' + data.list_id;
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                        $("#addListValidation").html(data.msg).show();
                        setTimeout(function () {
                            $("#addListValidation").html("").hide();
                        }, 5000);
                    }
                }
            });
            return false;
        });

        $("button.moBile").click(function () {
            $(".temp_left_option.right").addClass("smaller");
            $("button.moBile").removeClass("bl_cust_btn ");
            $("button.deSktop").addClass("bl_cust_btn ");
        });

        $("button.deSktop").click(function () {
            $(".temp_left_option.right").removeClass("smaller");
            $("button.moBile").addClass("bl_cust_btn ");
            $("button.deSktop").removeClass("bl_cust_btn ");
        });


        $(document).on('click', '.continueButton', function () {
            var elem = (this);
            var tab = $(this).attr('tab');
            if (tab == 'Settings') {
<?php if (strtolower($oBroadcast->campaign_type) == 'email'): ?>
                    //                $('#loadstripotemplate').contents().find('#saveStripoChanges').trigger("click");
                    $('#loadstripotemplate').contents().find('#saveStripoChangesSilent').trigger("click");
<?php endif; ?>

<?php if (strtolower($oBroadcast->campaign_type) == 'sms'): ?>
                    $("#saveStripoChanges").trigger("click");
<?php endif; ?>

            }
            //$('.overlaynew').show();
            $.ajax({
                url: '<?php echo base_url('admin/broadcast/setTab'); ?>',
                type: "POST",
                data: {tab: tab, bid: '<?php echo $oBroadcast->broadcast_id; ?>'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        //$('.overlaynew').hide();
                        if (data.totalContacts == 0 && tab == 'Review Contacts') {
                            $(".viewBroadcastImportOptionSmartPopup").trigger("click", "promptToChooseContacts");
                            $("#validateAddedContacts").show();

                        } else {
                            showNextTab(elem, tab);

                            if (tab == 'Settings') {
                                /*setTimeout(function () {
                                 window.location.href = '';
                                 
                                 }, 2000);*/
                            } else {
                                //window.location.href = '';
                            }

                        }


                    } else if (data.status == 'error') {
                        //$('.overlaynew').hide();

                    }

                }
            });
            return false;
        });


        function showNextTab(elem, currentTab) {
            var nextTab;
            var backTab;
            var selector;
            $("#runBroadcast").hide();
            $("#saveDraftBroadcast").hide();
            $("#showBroadcastPreview").hide();
            $("#backButton").show();
            $("#continueButton").show();
            if (currentTab == 'Select List') {
                nextTab = 'Review Contacts';
                backTab = '';
                selector = 'broadcastTargetAudience';
            } else if (currentTab == 'Review Contacts') {
                nextTab = 'Choose Template';
                backTab = 'Select List';
                selector = 'broadcastReviewAudience';
            } else if (currentTab == 'Choose Template') {
                nextTab = 'Design Template Edit';
                backTab = 'Review Contacts';
                selector = 'broadcastSelectTemplate';
            } else if (currentTab == 'Design Template Edit') {
                nextTab = 'Settings';
                backTab = 'Choose Template';
                selector = 'broadcastDesignTemplate';
            } else if (currentTab == 'Settings') {
                nextTab = 'Campaign Summary';
                backTab = 'Design Template Edit';
                selector = 'broadcastConfiguration';
            } else if (currentTab == 'Campaign Summary') {
                nextTab = '';
                backTab = 'Settings';
                selector = 'broadcastSummary';
            }
            $(".continueButton").removeClass("active");
            $(elem).addClass("active");
            $(".broadcastTab").hide();
            $("#" + selector).show();
            if (currentTab == 'Select List') {
                $("#backButton").hide();

            }
            $("#continueButton").attr('tab', nextTab);
            $("#backButton").attr('tab', backTab);
            if (currentTab == 'Campaign Summary') {
                $("#runBroadcast").show();
                $("#saveDraftBroadcast").show();
                $("#showBroadcastPreview").show();
                $("#continueButton").hide();
            }


        }

        $(document).on("click", "#backButton, #continueButton", function () {
            var tab = $(this).attr('tab');
            if (tab == 'Select List') {
                $("a.continueButton:contains('Add Contacts')").trigger("click");
            } else if (tab == 'Review Contacts') {
                $("a.continueButton:contains('Review Contacts')").trigger("click");
            } else if (tab == 'Choose Template') {
                $("a.continueButton:contains('Email Template')").trigger("click");
                $("a.continueButton:contains('SMS Template')").trigger("click");
            } else if (tab == 'Design Template Edit') {
                //Apply Validaion
                if (!$("input[name='selectedTemplate']:checked").val()) {
                    displayMessagePopup('error', 'Template required', 'Please choose any template!'); //javascript notification msg (edited) 
                    return false;
                }

                $("a.continueButton:contains('Email Editor')").trigger("click");
                $("a.continueButton:contains('SMS Editor')").trigger("click");
            } else if (tab == 'Settings') {
                $("a.continueButton:contains('Configuration')").trigger("click");
            } else if (tab == 'Campaign Summary') {
                $("a.continueButton:contains('Summary')").trigger("click");
            }

        });

        $(document).on('click', '.broadcastBackButton', function () {
            var tab = $(this).attr('tab');
            $('.overlaynew').show();
            $.ajax({
                url: '<?php echo base_url('admin/broadcast/setTab'); ?>',
                type: "POST",
                data: {tab: tab},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = '';

                    } else if (data.status == 'error') {
                        $('.overlaynew').hide();

                    }

                }
            });
            return false;
        });

        $(document).on('click', '.sameTab', function () {
            $('#right-icon-tab2').hide();
            $('#right-icon-tab3').hide();
            $('#right-icon-tab5').hide();
            var tab = $(this).attr('tab');
            if (tab == 'Design Template Edit') {
                var numberOfChecked = $('.updateList:checkbox:checked').length;
                if (numberOfChecked < 1) {
                    alertMessage('Please select list item.');
                    $('.nav-tabs [href="#right-icon-tab1"]').click();
                    return false;
                } else {
                    $('#right-icon-tab2').show();
                }
            }

            if (tab == 'Settings') {
                var numberOfChecked = $('.updateList:checkbox:checked').length;
                if (numberOfChecked < 1) {
                    alertMessage('Please select list item.');
                    $('.nav-tabs [href="#right-icon-tab1"]').trigger('click');
                    return false;
                } else {
                    $('#right-icon-tab5').show();
                }

                var emailtemplate = $('#emailtemplate').val();
                if (emailtemplate == '') {
                    alertMessage('Please enter email content.');
                    $('.nav-tabs [href="#right-icon-tab2"]').trigger('click');
                    return false;
                } else {
                    $('#right-icon-tab5').show();
                }
            }

            if (tab == 'Campaign Summary') {
                var numberOfChecked = $('.updateList:checkbox:checked').length;
                if (numberOfChecked < 1) {
                    alertMessage('Please select list item.');
                    $('.nav-tabs [href="#right-icon-tab1"]').trigger('click');
                    return false;
                } else {
                    $('#right-icon-tab3').show();
                }

                var emailtemplate = $('#emailtemplate').val();
                if (emailtemplate == '') {
                    alertMessage('Please enter email content.');
                    $('.nav-tabs [href="#right-icon-tab2"]').trigger('click');
                    return false;
                } else {
                    $('#right-icon-tab3').show();
                }

                var emailSubject = $('#email_subject').val();
                if (emailSubject == '') {
                    alertMessage('Please enter email subject.');
                    $('.nav-tabs [href="#right-icon-tab5"]').trigger('click');
                    return false;
                } else {
                    $('#right-icon-tab3').show();
                }
            }

            $.ajax({
                url: '<?php echo base_url('admin/broadcast/setTab'); ?>',
                type: "POST",
                data: {tab: tab},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        //$('.overlaynew').hide();
                        //window.location.href = '';

                    } else if (data.status == 'error') {
                        //$('.overlaynew').hide();

                    }

                }
            });
            return false;
        });

        function loadImportedProperties(broadcastId) {
            $('.overlaynew').show();
            $.ajax({
                url: '<?php echo base_url('admin/broadcast/getImportedProperties'); ?>',
                type: "POST",
                data: {broadcastId: broadcastId},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        $("#importPropertyButtons").html(data.content);
                    }
                }
            });
        }

        function loadExcludedProperties(broadcastId) {
            $('.overlaynew').show();
            $.ajax({
                url: '<?php echo base_url('admin/broadcast/getExportedProperties'); ?>',
                type: "POST",
                data: {broadcastId: broadcastId},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        $("#excludePropertyButtons").html(data.content);
                    }
                }
            });
        }

        $(document).on("click", ".deleteAudience", function () {
            var subscriber_id = $(this).attr('subscriber_id');
            var broadcast_id = $(this).attr('broadcast_id');
            swal({
                title: "Are you sure? You want to delete this record!",
                text: "You will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel pls!",
                closeOnConfirm: true,
                closeOnCancel: true
            },
                    function (isConfirm) {
                        if (isConfirm) {
                            $('.overlaynew').show();
                            $.ajax({
                                url: '<?php echo base_url('admin/broadcast/deleteBroadcastAudience'); ?>',
                                type: "POST",
                                data: {subscriber_id: subscriber_id, broadcast_id: broadcast_id},
                                dataType: "json",
                                success: function (data) {
                                    if (data.status == 'success') {
                                        displayMessagePopup('success', '', 'Selected contact deleted from this campaign');
                                        //window.location.href = '';
                                        loadImportedProperties('<?php echo $oBroadcast->broadcast_id; ?>');
                                        loadBroadcastAudience('<?php echo $oBroadcast->broadcast_id; ?>', 'broadcastAudience2');

                                    }
                                }
                            });
                        }
                    });
        });


        $(document).on('click', '.deleteBulkBoradcastAudience', function () {
            var broadcast_id = $(this).attr('broadcast_id');
            var val = [];
            $('.addToBroadcast:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {
                swal({
                    title: "Are you sure? You want to delete this record!",
                    text: "You will not be able to recover this record!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#EF5350",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                        function (isConfirm) {
                            if (isConfirm) {
                                $('.overlaynew').show();
                                console.log(val);
                                $.ajax({
                                    url: '<?php echo base_url('admin/broadcast/deleteBroadcastBulkAudience'); ?>',
                                    type: "POST",
                                    data: {audience_array: val, broadcast_id: broadcast_id},
                                    dataType: "json",
                                    success: function (data) {
                                        if (data.status == 'success') {
                                            $('.overlaynew').hide();
                                            displayMessagePopup('success', '', 'Selected contact deleted from this campaign');
                                            //window.location.href = window.location.href;
                                            loadImportedProperties('<?php echo $oBroadcast->broadcast_id; ?>');
                                            loadBroadcastAudience('<?php echo $oBroadcast->broadcast_id; ?>', 'broadcastAudience2');
                                        }
                                    }
                                });
                            }
                        });
            }
        });



        $(document).on('change', ".addToCampaign", function () {
            $('.overlaynew').show();
            var contactId = $(this).val();
            var actionValue = ''
            if ($(this).is(":checked") === true) {
                actionValue = 'addRecord';
            } else {
                actionValue = 'deleteRecord';
            }
            var listID = $(this).val();
            $.ajax({
                url: '<?php echo base_url('admin/broadcast/addContactToCampaign'); ?>',
                type: "POST",
                data: {automation_id: '<?php echo $oBroadcast->broadcast_id; ?>', actionValue: actionValue, contactId: contactId},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#totalContactCount").text(data.total_contacts);
                        $('.overlaynew').hide();
                        loadImportedProperties('<?php echo $oBroadcast->broadcast_id; ?>');
                        loadBroadcastAudience('<?php echo $oBroadcast->broadcast_id; ?>', 'broadcastAudience2');
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                    }

                }
            });
            return false;

        });

        $(document).on('change', '.updateList', function () {
            $('.overlaynew').show();
            var actionValue = ''
            if ($(this).is(":checked") === true) {
                actionValue = 'addRecord';
            } else {
                actionValue = 'deleteRecord';
            }
            var listID = $(this).val();
            $.ajax({
                url: '<?php echo base_url('admin/broadcast/updateAutomationListsRecord'); ?>',
                type: "POST",
                data: {automation_id: '<?php echo $oBroadcast->broadcast_id; ?>', actionValue: actionValue, selectedLists: listID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#totalListCount").text(data.total_lists);
                        $("#totalListContactCount").text(data.total_contacts);
                        $("#totalListDuplicateCount").text(data.duplicate_contacts);
                        $('.overlaynew').hide();
                        loadImportedProperties('<?php echo $oBroadcast->broadcast_id; ?>');
                        loadBroadcastAudience('<?php echo $oBroadcast->broadcast_id; ?>', 'broadcastAudience2');
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                    }

                }
            });
            return false;
        });

        $(document).on('change', ".addSegmentToCampaign", function () {
            $('.overlaynew').show();
            var segmentId = $(this).val();
            var actionValue = ''
            if ($(this).is(":checked") === true) {
                actionValue = 'addRecord';
            } else {
                actionValue = 'deleteRecord';
            }
            $.ajax({
                url: '<?php echo base_url('admin/broadcast/addSegmentToCampaign'); ?>',
                type: "POST",
                data: {automation_id: '<?php echo $oBroadcast->broadcast_id; ?>', actionValue: actionValue, segmentId: segmentId},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#totalSegmentCount").text(data.total_segments);
                        $('.overlaynew').hide();
                        loadImportedProperties('<?php echo $oBroadcast->broadcast_id; ?>');
                        loadBroadcastAudience('<?php echo $oBroadcast->broadcast_id; ?>', 'broadcastAudience2');
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                    }

                }
            });
            return false;

        });

        $(document).on('change', ".addTagToCampaign", function () {
            $('.overlaynew').show();
            var tagId = $(this).val();
            var actionValue = ''
            if ($(this).is(":checked") === true) {
                actionValue = 'addRecord';
            } else {
                actionValue = 'deleteRecord';
            }
            $.ajax({
                url: '<?php echo base_url('admin/broadcast/addTagToCampaign'); ?>',
                type: "POST",
                data: {automation_id: '<?php echo $oBroadcast->broadcast_id; ?>', actionValue: actionValue, tagId: tagId},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#totalTagCount").text(data.total_tags);
                        $('.overlaynew').hide();
                        loadImportedProperties('<?php echo $oBroadcast->broadcast_id; ?>');
                        loadBroadcastAudience('<?php echo $oBroadcast->broadcast_id; ?>', 'broadcastAudience2');
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                    }

                }
            });
            return false;

        });

        $(document).on('change', ".addToExcludeCampaign", function () {
            $('.overlaynew').show();
            var contactId = $(this).val();
            var actionValue = ''
            if ($(this).is(":checked") === true) {
                actionValue = 'addRecord';
            } else {
                actionValue = 'deleteRecord';
            }
            var listID = $(this).val();
            $.ajax({
                url: '<?php echo base_url('admin/broadcast/addContactToExcludeCampaign'); ?>',
                type: "POST",
                data: {automation_id: '<?php echo $oBroadcast->broadcast_id; ?>', actionValue: actionValue, contactId: contactId},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#totalContactCount").text(data.total_contacts);
                        $('.overlaynew').hide();
                        loadExcludedProperties('<?php echo $oBroadcast->broadcast_id; ?>');
                        loadBroadcastAudience('<?php echo $oBroadcast->broadcast_id; ?>', 'broadcastAudience2');
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                    }

                }
            });
            return false;

        });


        $(document).on('change', '.updateExcludeList', function () {
            $('.overlaynew').show();
            var actionValue = ''
            if ($(this).is(":checked") === true) {
                actionValue = 'addRecord';
            } else {
                actionValue = 'deleteRecord';
            }
            var listID = $(this).val();
            $.ajax({
                url: '<?php echo base_url('admin/broadcast/updateAutomationListsExcludedRecord'); ?>',
                type: "POST",
                data: {automation_id: '<?php echo $oBroadcast->broadcast_id; ?>', actionValue: actionValue, selectedLists: listID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#totalListCount").text(data.total_lists);
                        $("#totalListContactCount").text(data.total_contacts);
                        $("#totalListDuplicateCount").text(data.duplicate_contacts);
                        $('.overlaynew').hide();
                        loadExcludedProperties('<?php echo $oBroadcast->broadcast_id; ?>');
                        loadBroadcastAudience('<?php echo $oBroadcast->broadcast_id; ?>', 'broadcastAudience2');
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                    }

                }
            });
            return false;
        });

        $(document).on('change', ".addExcludeSegmentToCampaign", function () {
            $('.overlaynew').show();
            var segmentId = $(this).val();
            var actionValue = ''
            if ($(this).is(":checked") === true) {
                actionValue = 'addRecord';
            } else {
                actionValue = 'deleteRecord';
            }
            $.ajax({
                url: '<?php echo base_url('admin/broadcast/addExcludeSegmentToCampaign'); ?>',
                type: "POST",
                data: {automation_id: '<?php echo $oBroadcast->broadcast_id; ?>', actionValue: actionValue, segmentId: segmentId},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#totalSegmentCount").text(data.total_segments);
                        $('.overlaynew').hide();
                        loadExcludedProperties('<?php echo $oBroadcast->broadcast_id; ?>');
                        loadBroadcastAudience('<?php echo $oBroadcast->broadcast_id; ?>', 'broadcastAudience2');
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                    }

                }
            });
            return false;

        });


        $(document).on('change', ".addExcludedTagToCampaign", function () {
            $('.overlaynew').show();
            var tagId = $(this).val();
            var actionValue = ''
            if ($(this).is(":checked") === true) {
                actionValue = 'addRecord';
            } else {
                actionValue = 'deleteRecord';
            }
            $.ajax({
                url: '<?php echo base_url('admin/broadcast/addExcludedTagToCampaign'); ?>',
                type: "POST",
                data: {automation_id: '<?php echo $oBroadcast->broadcast_id; ?>', actionValue: actionValue, tagId: tagId},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#totalTagCount").text(data.total_tags);
                        $('.overlaynew').hide();
                        loadExcludedProperties('<?php echo $oBroadcast->broadcast_id; ?>');
                        loadBroadcastAudience('<?php echo $oBroadcast->broadcast_id; ?>', 'broadcastAudience2');
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                    }

                }
            });
            return false;

        });



        function loadBroadcastAudience(broadcastId, tblid) {
            $('.overlaynew').show();
            $.ajax({
                url: '<?php echo base_url('admin/broadcast/getBroadcastAudience'); ?>',
                type: "POST",
                data: {broadcastId: broadcastId},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#liveBroadcastAudience").html(data.content);
                        $("#totalBroadcastAudience").text(data.total_audience);
                        //$("#tblBroadcastTemplate").dataTable().destroy();
                        var tableId = tblid;
                        custom_data_table(tableId);
                        var reviewAudience = data.content.replace("broadcastAudience2", "editBroadcastAudience2");
                        $("#totalBroadcastReviewAudience").text(data.total_audience);
                        $("#liveReviewAudience").html(reviewAudience);
                        custom_data_table('editBroadcastAudience2');
                        $('.dataTables_filter input').addClass('search_item');
                        $('.overlaynew').hide();

                    }
                }
            });
        }


    });

</script>