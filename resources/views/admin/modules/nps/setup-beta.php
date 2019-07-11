<?php
$disableRemaining = false;
$rewards = '';
$emailWorkflow = '';
$campaign = '';
$reviews = '';
$integrationClass = '';
if ($setTab == 'Review Sources' || $selectedTab == 'Review Sources') {
    $rs = 'active';
} else if ($setTab == 'Campaign Preferences' || $selectedTab == 'Campaign Preferences') {
    $camp = 'active';
} else if (trim($setTab) == 'Rewards & Gifts' || $selectedTab == 'Rewards & Gifts') {
    $rewards = 'active';
} else if (trim($setTab) == 'Configure Widgets' || $selectedTab == 'Configure Widgets') {
    $setupClass = 'active';
} else if (trim($setTab) == 'Email Workflow' || $selectedTab == 'Email Workflow') {
    $emailWorkflow = 'active';
} else if (trim($setTab) == 'Clients' || $selectedTab == 'Clients') {
    $campaign = 'active';
} else if (trim($setTab) == 'Reviews' || $selectedTab == 'Reviews') {
    $reviews = 'active';
} else if (trim($setTab) == 'Integration' || $selectedTab == 'Integration') {
    $integrationClass = 'active';
} else if (trim($setTab) == 'Image' || $selectedTab == 'Image') {
    $imageClass = 'active';
} else if (trim($setTab) == 'Video' || $selectedTab == 'Video') {
    $videoClass = 'active';
} else {
    $rs = 'active';
}
?>
<style>
    #uploadedbrandlogo .dropzone .dz-preview:hover .dz-image img { filter:none !important;-webkit-filter:!important;}
</style>
<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-7">
                <h3><img style="width: 19px;" src="/assets/images/nps_icon.png"><?php echo $title; ?> <?php echo (!empty($oNPS)) ? ': ' . $oNPS->title : ''; ?></h3>

                <ul class="nav nav-tabs nav-tabs-bottom" id="nav-tabs-bottom">
                    <?php if (empty($oNPS->platform)): ?>  
                        <li class="<?php
                        if ($defalutTab == 'platform') {
                            echo 'active';
                            $disableRemaining = true;
                        }
                        ?>"><a href="#right-icon-tab1" data-toggle="tab">Source</a></li>
                        <?php endif; ?>
                    <li class="<?php
                    if ($defalutTab == 'customize') {
                        echo 'active';
                        $disableRemaining = true;
                    }
                    ?>"><a href="<?php
                            if ($disableRemaining == false || $defalutTab == 'customize') {
                                $bCustomizeTab = true;
                                ?>#right-icon-tab2<?php } else { ?>javascript:void(0);<?php } ?>" data-toggle="tab">Configuration</a></li>


                    <?php if ($oNPS->platform != 'web' && $oNPS->platform != 'link'): ?>
                        <li class="<?php
                        if ($defalutTab == 'workflow') {
                            echo 'active';
                            $disableRemaining = true;
                        }
                        ?>"><a href="<?php
                                if ($disableRemaining == false || $defalutTab == 'workflow') {
                                    $bWorkflowTab = true;
                                    ?>#right-icon-tab3<?php } else { ?>javascript:void(0);<?php } ?>" data-toggle="tab">Workflow</a>
                        </li>


                        <li class="<?php
                        if ($defalutTab == 'people') {
                            echo 'active';
                            $disableRemaining = true;
                        }
                        ?>"><a href="<?php
                                if ($disableRemaining == false || $defalutTab == 'people') {
                                    $bPeopleTab = true;
                                    ?>#right-icon-tab4<?php } else { ?>javascript:void(0);<?php } ?>" data-toggle="tab">Contacts</a>
                        </li>

                    <?php endif; ?>

                    <?php if ($oNPS->platform == 'link'): ?>

                        <li class="<?php
                        if ($defalutTab == 'widgets') {
                            echo 'active';
                            $disableRemaining = true;
                        }
                        ?>"><a href="<?php
                                if ($disableRemaining == false || $defalutTab == 'widgets') {
                                    $bWidgetTab = true;
                                    ?>#right-icon-tab6<?php } else { ?>javascript:void(0);<?php } ?>" data-toggle="tab">Setup Link</a>
                        </li>
                    <?php endif; ?>    

                    <?php if ($oNPS->platform == 'web'): ?>

                        <li class="<?php
                        if ($defalutTab == 'widgets') {
                            echo 'active';
                            $disableRemaining = true;
                        }
                        ?>"><a href="<?php
                                if ($disableRemaining == false || $defalutTab == 'widgets') {
                                    $bWidgetTab = true;
                                    ?>#right-icon-tab6<?php } else { ?>javascript:void(0);<?php } ?>" data-toggle="tab">Widget</a>
                        </li>
                    <?php endif; ?>
                        
                    <li class="<?php
                    if ($defalutTab == 'score') {
                        echo 'active';
                        $disableRemaining = true;
                    }
                    ?>"><a href="<?php
                            if ($disableRemaining == false || $defalutTab == 'widgets') {
                                $bScoreTab = true;
                                ?>#right-icon-tab5<?php } else { ?>javascript:void(0);<?php } ?>" data-toggle="tab">Scores</a>
                    </li>    



                </ul>


            </div>
            <!--=============Button Area Right Side==============-->
            <?php //if ($oNPS->platform != 'web'): ?>
                <div class="col-md-5 text-right btn_area">

                    <button type="button" style="padding: 7px 15px!important;" class="btn dark_btn publishNPSCampaignStatus" status="draft"><i class="icon-plus3"></i><span> &nbsp;  Save as Draft</span> </button>

                    <button type="button" style="padding: 7px 15px!important;" class="btn dark_btn publishNPSCampaignStatus" status="active"><i class="icon-plus3"></i><span> &nbsp;  Publish</span> </button>

          <!-- <button type="button" class="btn light_btn bl_cust_btn btn-default importModuleContact" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $oNPS->hashcode; ?>" data-redirect="<?php echo base_url(); ?>admin/modules/nps/setup/<?php echo $oNPS->id; ?>"><i class="icon-arrow-up16"></i><span> &nbsp;  Import Contact</span> </button> 

          <a  href="<?php echo base_url() ?>admin/subscriber/exportSubscriberCSV?module_name=<?php echo $moduleName; ?>&module_account_id=<?php echo $oNPS->hashcode; ?>" title="Export" class="btn light_btn ml10 bl_cust_btn btn-default"><i class="icon-arrow-down16"></i><span> &nbsp;  Export Contact</span> </a>

          <button type="button" class="btn dark_btn dropdown-toggle ml10 bl_cust_btn btn-default addModuleContact" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $oNPS->hashcode; ?>"><i class="icon-plus3 txt_green"></i><span> &nbsp;  Invite Contact</span> </button> -->

                </div>
            <?php //endif; ?>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->

    <div class="tab-content">
        <!--########################TAB 1 ##########################-->
        <?php if (empty($oNPS->platform)): ?>  
            <?php $this->load->view("admin/modules/nps/nps-tabs/choose-platform", array('userID' => $userID, 'defalutTab' => $defalutTab, 'programID' => $programID, 'oAccountSettings' => $oAccountSettings)); ?>
        <?php endif; ?>
        <!--########################TAB 2 ##########################-->
        <?php if ($bCustomizeTab == true): ?>
            <?php $this->load->view("admin/modules/nps/nps-tabs/customization", array('userID' => $userID, 'defalutTab' => $defalutTab, 'programID' => $programID, 'oNPS' => $oNPS)); ?>
        <?php endif; ?>
        <!--########################TAB 3 ##########################-->
        <?php if ($bWidgetTab == true): ?>
            <?php $this->load->view("admin/modules/nps/nps-tabs/widget_code", array('userID' => $userID, 'defalutTab' => $defalutTab, 'programID' => $programID, 'oNPS' => $oNPS)); ?>
        <?php endif; ?>
        <!--########################TAB 4 ##########################-->
        <?php if ($bWorkflowTab == true): ?>
            <?php //$this->load->view("admin/modules/nps/nps-tabs/reward-workflow", array('userID' => $userID, 'defalutTab' => $defalutTab, 'programID' => $programID, 'oNPS' => $oNPS)); ?>
            <?php $this->load->view("admin/modules/nps/nps-tabs/reward-workflow-beta", array('emailWorkflow' => $emailWorkflow, 'subscribersData' => $subscribersData, 'oEvents' => $oEvents)); ?>
        <?php endif; ?>
        <!--########################TAB 5 ##########################--> 
        <?php if ($bPeopleTab == true): ?>
            <?php $this->load->view("admin/modules/nps/nps-tabs/contacts", array('userID' => $userID, 'defalutTab' => $defalutTab, 'programID' => $programID, 'oNPS' => $oNPS, 'oContacts' => $oContacts)); ?>
        <?php endif; ?>
        <!--########################TAB 6 ##########################--> 
        <?php //if ($bScoreTab == true):  ?>
        <?php $this->load->view("admin/modules/nps/nps-tabs/score", array('userID' => $userID, 'defalutTab' => $defalutTab, 'programID' => $programID, 'oNPS' => $oNPS, 'oFeedbacks' => $oFeedbacks)); ?>
        <?php //endif; ?>
    </div>
</div>

<?php //$this->load->view("admin/modals/workflow/workflow-popup", array('oDefaultTemplates' => $oDefaultTemplates));  ?>
<?php $this->load->view("admin/modals/workflow2/workflow-popup", array('oDefaultTemplates' => $oDefaultTemplates)); ?>

<div id="addSubscriber" class="modal fade">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-user"></i>&nbsp; Contacts</h5>
            </div>
            <div class="modal-body">
                <div class="panel-body">

                    <form name="frmInviteCustomer" id="frmInviteCustomer" method="post" action="" >
                        <input type="hidden" name="userid" value="<?php echo $userID; ?>" />
                        <input type="hidden" name="bbaid" value="<?php echo $oNPS->hashcode; ?>" />
                        <div class="col-md-12">

                            <div class="form-group">
                                <label class="control-label">First Name</label>
                                <div class="">
                                    <input name="firstname" id="firstname" class="form-control" type="text" required="">
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="control-label">Last Name</label>
                                <div class="">
                                    <input name="lastname" id="lastname" class="form-control" value="" type="text" required="">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <div class="">
                                    <input name="email" id="email" value="" class="form-control" type="text" required="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Phone</label>
                                <div class="">
                                    <input name="phone" id="phone" value="" class="form-control" type="text">
                                </div>
                            </div>

                            <button class="btn btn-success pull-right" id="btnInvite" type="submit">
                                Invite Advocates
                            </button>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<div id="importCSV" class="modal fade">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-user"></i>&nbsp; Invite via Import</h5>
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    <form name="frmInviteBulkCustomer" id="frmInviteBulkCustomer"  method="post" action="" enctype="multipart/form-data" >
                        <input type="hidden" name="userid" value="<?php echo $userID; ?>" />
                        <input type="hidden" name="bbaid" value="<?php echo $oNPS->hashcode; ?>" />

                        <div class="col-md-8">
                            <strong> Upload a CSV file with customer contact details </strong> <br>
                            -Column 1 should be EMAIL<br>
                            -Column 2 should be FIRST_NAME<br>
                            Column 3 should be LAST_NAME<br>
                            Column 4 should be PHONE<br>                            

                        </div>

                        <div class="col-md-4">
                            <div class="fileupload">
                                <input type="file" name="userfile" id="ctrBrowse" accept=".csv, application/vnd.ms-excel" style="position:relative;top:50px;" />
                            </div>

                        </div>

                        <div class="clearfix"></div>

                        <button class="btn btn-success pull-right" id="btnBulkInvite" type="submit">
                            Import People
                        </button>



                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {


        $(document).on("click", ".logo_img", function () {
            $(".dz-remove").trigger("click");
            $("#myDropzone_logo_img").trigger("click");
            $("#uploadedbrandlogo").hide();
            $("#uploadbrandlogo").show();

        });

        $(document).on("click", ".dz-remove", function () {
            $("#uploadedbrandlogo").hide();
            $("#uploadbrandlogo").show();
            $('input[name="brand_logo"]').val('');

        });


        $("#frmInviteCustomer").submit(function () {

            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $('#btnInvite').prop("disabled", true);
            $.ajax({
                url: '<?php echo base_url('admin/modules/nps/registerInvite'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    $('.overlaynew').hide();
                    if (data.status == 'success') {

                        //alertMessageAndRedirect('User has been invited successfully.', window.location.href);
                        window.location.href = window.location.href;
                    } else {

                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
            return false;
        });

        $("#frmInviteBulkCustomer").submit(function () {

            $('.overlaynew').show();

            var formData = new FormData($(this)[0]);


            $.ajax({
                url: '<?php echo base_url('admin/modules/nps/importInviteCSV'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {

                        //alertMessageAndRedirect('Users has been invited successfully.', window.location.href);
                        window.location.href = window.location.href;

                    } else {

                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
            return false;
        });

        $("#publishNPSCampaign").click(function () {
            $.ajax({
                url: '<?php echo base_url('admin/modules/nps/publishNPSCampaign'); ?>',
                type: "POST",
                data: {'npsId': '<?php echo $oNPS->id; ?>'},
                dataType: "html",
                success: function (data) {
                    window.location.href = '<?php echo base_url("/admin/modules/nps/") ?>';
                }, error: function () {
                    alertMessage('Error: Some thing wrong!');
                }
            });
        });

        $(document).on('click', '.publishNPSCampaignStatus', function () {

            var status = $(this).attr('status');
            $.ajax({
                url: '<?php echo base_url('admin/modules/nps/publishNPSCampaignStatus'); ?>',
                type: "POST",
                data: {'npsId': '<?php echo $oNPS->id; ?>', 'status': status},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        //window.location.href = '<?php echo base_url('admin/brandboost/onsite'); ?>';
                        if (status == 1) {

                            displayMessagePopup();
                        } else {
                            displayMessagePopup();
                        }

                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });

        });

    });
</script>	




