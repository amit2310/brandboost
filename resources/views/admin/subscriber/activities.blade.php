<style type="text/css">
    .tab_list{ margin:0px; padding:0px;}
    .tab_list li {
        list-style: none;
        width: 50%;
        float: left;
    }

    .tooltip_table {
        position: relative; cursor: pointer;
    }

    .tooltip_table .tooltiptext {
        display: none;
        width: 224px;
        background-color: #fff;
        color: #333;
        text-align: left;
        border-radius: 3px;
        padding: 10px 15px;
        position: absolute;
        z-index: 1;
        top: -33px;
        border: 1px solid #cccccc;
        left: 113px;
        -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .tooltiptext::before {
        content: "";
        position: absolute;
        top: 40px;
        left: -9px;
        border-style: solid;
        border-width: 6px 6px 0;
        border-color: #ccc transparent;
        display: block;
        width: 0;
        z-index: 0;
        transform: rotate(90deg);
    }

    .tooltiptext::after {
        content: "";
        position: absolute;
        top: 40px;
        left: -7px;
        border-style: solid;
        border-width: 5px 5px 0;
        border-color: #FFFFFF transparent;
        display: block;
        width: 0;
        z-index: 1;
        transform: rotate(90deg);
    }

    .tooltip_table .tooltiptext strong {
        text-transform: uppercase;
        margin-bottom: 10px;
        display: block;
    }

    .tooltip_table:hover .tooltiptext {
        display: block;
    }

    .table > tbody > tr.success > td{background-color:#f3f8fc !important}
    .delete_btn {
        cursor: pointer;
        display: inline-block;
        position: absolute;
        right: 152px;
        z-index: 11;
        margin-top: 22px;
    }

</style>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/datatables_sorting_date_new.js"></script>

<?php
//Get Count 

$iOnsite = $iOffsite = $iAutomation = $iBroadcast = $iReferral = $iNPS = 0;

//Onsite/Offsite Count
if (!empty($oBrandboosts)) {
    foreach ($oBrandboosts as $arr) {
        if ($arr->review_type == 'onsite') {
            $aOnsite[] = $arr;
        }

        if ($arr->review_type == 'offsite') {
            $aOffsite[] = $arr;
        }
    }
}

$iOnsite = count($aOnsite);
$iOffsite = count($aOffsite);

//Automation/Broadcast
if (!empty($oAutomations)) {
    foreach ($oAutomations as $arr) {
        if ($arr->email_type == 'automation') {
            $aAutomation[] = $arr;
        }

        if ($arr->email_type == 'broadcast') {
            $aBroadcast[] = $arr;
        }
    }
}
$iAutomation = count($aAutomation);
$iBroadcast = count($aBroadcast);

//Referral Count
if (!empty($oReferrals)) {
    $iReferral = count($oReferrals);
}

//NPS Count
if (!empty($oNPSs)) {
    $iNPS = count($oNPSs);
}
?>

<!-- Content area -->
<div class="content">
    <div class="row">
        <div class="col-lg-12">

            <!-- Marketing campaigns -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Subscriber Details: <?php echo (!empty($oSubscriber)) ? $oSubscriber->firstname . ' ' . $oSubscriber->lastname : ''; ?></h6>
                    <div class="heading-elements">

                        <button type="button" class="btn btn-link daterange-ranges heading-btn text-semibold">
                            <i class="icon-calendar3 position-left"></i> <span></span> <b class="caret"></b>
                        </button>
                    </div>
                </div>

                <div class="panel-body broadcast">
                    <input name="min" id="min" type="hidden">
                    <input name="max" id="max" type="hidden">
                    <div class="tabbable">
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li class="active"><a href="#right-icon-tab1" data-toggle="tab"><i class="icon-stack2 position-left"></i> Onsite Brandboost (<?php echo $iOnsite; ?>) </a></li>
                            <li class=""><a href="#right-icon-tab2" data-toggle="tab"><i class="icon-stack2 position-left"></i> Offsite Brandboost (<?php echo $iOffsite; ?>)</a></li>
                            <li class=""><a href="#right-icon-tab3" data-toggle="tab"><i class="icon-hammer-wrench position-left"></i> Automation (<?php echo $iAutomation; ?>)</a></li>
                            <li class=""><a href="#right-icon-tab4" data-toggle="tab"><i class="icon-hammer-wrench position-left"></i> Broadcast (<?php echo $iBroadcast; ?>)</a></li>
                            <li class=""><a href="#right-icon-tab5" data-toggle="tab"><i class="icon-browser position-left"></i> Referral Module (<?php echo $iReferral; ?>)</a></li>
                            <li class=""><a href="#right-icon-tab6" data-toggle="tab"><i class="icon-browser position-left"></i> NPS Module (<?php echo $iNPS; ?>)</a></li>
                        </ul>
                        <div class="tab-content campaign">
                            <!-- Onsite Brandboost-->
                            <div class="tab-pane active" id="right-icon-tab1">
                                <div class="table-responsive">
                                    <table class="table text-nowrap datatable-sorting">
                                        <thead>
                                            <tr>
                                                <th style="display: none;"></th>
                                                <th style="display: none;"></th>
                                                <th class="col-md-3">Campaign Name</th>
                                                <th class="col-md-3">Created</th>
                                                <th class="col-md-3">Last Added On</th>
                                                <th class="col-md-3 text-center">Status</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            foreach ($oBrandboosts as $oBrandboost):

                                                if ($oBrandboost->review_type == 'onsite') {
                                                    ?>
                                                    <tr id="append-<?php echo $oBrandboost->id; ?>" class="selectedClass">

                                                        <td style="display: none;"><?php echo date("m/d/Y", strtotime($oBrandboost->created)); ?></td>
                                                        <td style="display: none;"><?php echo $oBrandboost->id; ?></td>

                                                        <td>

                                                            <div class="media-left">
                                                                <div class=""><a href="javascript:void(0);" brandid="<?php echo $oBrandboost->id; ?>" class="editBrandboost"><?php echo $oBrandboost->brand_title; ?></a></div>
                                                            </div>
                                                        </td>
                                                        <td><div class="text-semibold"><?php echo date('F d, Y', strtotime($oBrandboost->created)); ?></div><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oBrandboost->created)) . ' (' . timeAgo($oBrandboost->created) . ')'; ?></div></td>
                                                        <td><div class="text-semibold"><?php echo date('F d, Y', strtotime($oBrandboost->created)); ?></div><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oBrandboost->created)) . ' (' . timeAgo($oBrandboost->created) . ')'; ?></div></td>

                                                        <td class="text-center"><?php echo $oBrandboost->status == '1' ? '<span class="label bg-success">Active</span>' : '<span class="label bg-danger">Inactive</span>'; ?></td>



                                                    </tr>
                                                <?php } endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div> 

                            <!-- Offsite Brandboost-->
                            <div class="tab-pane" id="right-icon-tab2">
                                <div class="table-responsive">

                                    <table class="table text-nowrap datatable-sorting">
                                        <thead>
                                            <tr>
                                                <th style="display: none;"></th>
                                                <th style="display: none;"></th>
                                                <th class="col-md-3">Campaign Name</th>
                                                <th class="col-md-3">Created</th>
                                                <th class="col-md-3">Last Added On</th>
                                                <th class="col-md-3 text-center">Status</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            foreach ($oBrandboosts as $oBrandboost):

                                                if ($oBrandboost->review_type == 'offsite') {
                                                    ?>
                                                    <tr id="append-<?php echo $oBrandboost->id; ?>" class="selectedClass">
                                                        <td style="display: none;"><?php echo date("m/d/Y", strtotime($oBrandboost->created)); ?></td>
                                                        <td style="display: none;"><?php echo $oBrandboost->id; ?></td>
                                                        <td>

                                                            <div class="media-left">
                                                                <div class=""><a href="javascript:void(0);" brandid="<?php echo $oBrandboost->id; ?>" class="editBrandboost"><?php echo $oBrandboost->brand_title; ?></a></div>
                                                            </div>
                                                        </td>
                                                        <td><div class="text-semibold"><?php echo date('F d, Y', strtotime($oBrandboost->created)); ?></div><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oBrandboost->created)) . ' (' . timeAgo($oBrandboost->created) . ')'; ?></div></td>
                                                        <td><div class="text-semibold"><?php echo date('F d, Y', strtotime($oBrandboost->created)); ?></div><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oBrandboost->created)) . ' (' . timeAgo($oBrandboost->created) . ')'; ?></div></td>

                                                        <td class="text-center"><?php echo $oBrandboost->status == '1' ? '<span class="label bg-success">Active</span>' : '<span class="label bg-danger">Inactive</span>'; ?></td>



                                                    </tr>
                                                <?php } endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Automation-->

                            <div class="tab-pane" id="right-icon-tab3">
                                <div class="table-responsive">

                                    <table class="table text-nowrap datatable-sorting">
                                        <thead>
                                            <tr>
                                                <th style="display: none;"></th>
                                                <th style="display: none;"></th>
                                                <th class="col-md-3">Campaign Name</th>
                                                <th class="col-md-3">Created</th>
                                                <th class="col-md-3">Last Added On</th>
                                                <th class="col-md-3 text-center">Status</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            foreach ($oAutomations as $oAutomation):

                                                if ($oAutomation->email_type == 'automation') {
                                                    ?>
                                                    <tr id="append-auto-<?php echo $oAutomation->id; ?>" class="selectedClass">
                                                        <td style="display: none;"><?php echo date("m/d/Y", strtotime($oAutomation->created)); ?></td>
                                                        <td style="display: none;"><?php echo $oAutomation->id; ?></td>
                                                        <td>

                                                            <div class="media-left">
                                                                <div class=""><a href="<?php echo base_url() ?>admin/modules/emails/setupAutiomation/<?php echo $oAutomation->id; ?>" target="_blank"><?php echo $oAutomation->title; ?></a></div>
                                                            </div>
                                                        </td>
                                                        <td><div class="text-semibold"><?php echo date('F d, Y', strtotime($oAutomation->created)); ?></div><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oAutomation->created)) . ' (' . timeAgo($oAutomation->created) . ')'; ?></div></td>
                                                        <td><div class="text-semibold"><?php echo date('F d, Y', strtotime($oAutomation->created)); ?></div><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oAutomation->created)) . ' (' . timeAgo($oAutomation->created) . ')'; ?></div></td>

                                                        <td class="text-center"><?php echo $oAutomation->status == 'active' ? '<span class="label bg-success">' . ucfirst($oAutomation->status) . '</span>' : '<span class="label bg-danger">' . ucfirst($oAutomation->status) . '</span>'; ?></td>



                                                    </tr>
    <?php } endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Broadcast-->
                            <div class="tab-pane" id="right-icon-tab4">
                                <div class="table-responsive">

                                    <table class="table text-nowrap datatable-sorting">
                                        <thead>
                                            <tr>
                                                <th style="display: none;"></th>
                                                <th style="display: none;"></th>
                                                <th class="col-md-3">Campaign Name</th>
                                                <th class="col-md-3">Created</th>
                                                <th class="col-md-3">Last Added On</th>
                                                <th class="col-md-3 text-center">Status</th>

                                            </tr>
                                        </thead>

                                        <tbody>
<?php
foreach ($oAutomations as $oAutomation):


    if ($oAutomation->email_type == 'broadcast') {
        ?>
                                                    <tr id="append-broadcast-<?php echo $oAutomation->id; ?>" class="selectedClass">
                                                        <td style="display: none;"><?php echo date("m/d/Y", strtotime($oAutomation->created)); ?></td>
                                                        <td style="display: none;"><?php echo $oAutomation->id; ?></td>
                                                        <td>

                                                            <div class="media-left">
                                                                <div class=""><a href="<?php echo base_url() ?>admin/modules/emails/setupAutiomation/<?php echo $oAutomation->id; ?>" target="_blank"><?php echo $oAutomation->title; ?></a></div>
                                                            </div>
                                                        </td>
                                                        <td><div class="text-semibold"><?php echo date('F d, Y', strtotime($oAutomation->created)); ?></div><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oAutomation->created)) . ' (' . timeAgo($oAutomation->created) . ')'; ?></div></td>
                                                        <td><div class="text-semibold"><?php echo date('F d, Y', strtotime($oAutomation->created)); ?></div><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oAutomation->created)) . ' (' . timeAgo($oAutomation->created) . ')'; ?></div></td>

                                                        <td class="text-center"><?php echo $oAutomation->status == 'active' ? '<span class="label bg-success">' . ucfirst($oAutomation->status) . '</span>' : '<span class="label bg-danger">' . ucfirst($oAutomation->status) . '</span>'; ?></td>



                                                    </tr>
    <?php } endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <!-- Referral-->
                            <div class="tab-pane" id="right-icon-tab5">
                                <div class="table-responsive">

                                    <table class="table text-nowrap datatable-sorting">
                                        <thead>
                                            <tr>
                                                <th style="display: none;"></th>
                                                <th style="display: none;"></th>
                                                <th class="col-md-3">Referral Name</th>
                                                <th class="col-md-3">Created</th>
                                                <th class="col-md-3">Last Added On</th>
                                                <th class="col-md-3 text-center">Status</th>

                                            </tr>
                                        </thead>

                                        <tbody>
<?php
foreach ($oReferrals as $oReferral):
    ?>
                                                <tr id="append-<?php echo $oReferral->id; ?>" class="selectedClass">
                                                    <td style="display: none;"><?php echo date("m/d/Y", strtotime($oReferral->created)); ?></td>
                                                    <td style="display: none;"><?php echo $oReferral->id; ?></td>
                                                    <td>

                                                        <div class="media-left">
                                                            <div class=""><a href="<?php echo base_url() ?>admin/modules/referral/setup/<?php echo $oReferral->id; ?>" target="_blank"><?php echo $oReferral->title; ?></a></div>
                                                        </div>
                                                    </td>
                                                    <td><div class="text-semibold"><?php echo date('F d, Y', strtotime($oReferral->created)); ?></div><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oReferral->created)) . ' (' . timeAgo($oReferral->created) . ')'; ?></div></td>
                                                    <td><div class="text-semibold"><?php echo date('F d, Y', strtotime($oReferral->created)); ?></div><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oReferral->created)) . ' (' . timeAgo($oReferral->created) . ')'; ?></div></td>

                                                    <td class="text-center"><?php echo $oReferral->status == 'active' ? '<span class="label bg-success">' . ucfirst($oReferral->status) . '</span>' : '<span class="label bg-danger">' . ucfirst($oReferral->status) . '</span>'; ?></td>



                                                </tr>
<?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div> 


                            <!-- NPS-->
                            <div class="tab-pane" id="right-icon-tab6">
                                <div class="table-responsive">

                                    <table class="table text-nowrap datatable-sorting">
                                        <thead>
                                            <tr>
                                                <th style="display: none;"></th>
                                                <th style="display: none;"></th>
                                                <th class="col-md-3">Survey Name</th>
                                                <th class="col-md-3">Platform</th>
                                                <th class="col-md-3">Created</th>
                                                <th class="col-md-3">Last Added On</th>
                                                <th class="col-md-3 text-center">Status</th>

                                            </tr>
                                        </thead>

                                        <tbody>
<?php
foreach ($oNPSs as $oNPS):
    ?>
                                                <tr id="append-<?php echo $oNPS->id; ?>" class="selectedClass">
                                                    <td style="display: none;"><?php echo date("m/d/Y", strtotime($oNPS->created)); ?></td>
                                                    <td style="display: none;"><?php echo $oNPS->id; ?></td>
                                                    <td>

                                                        <div class="media-left">
                                                            <div class=""><a href="<?php echo base_url() ?>admin/modules/nps/setup/<?php echo $oNPS->id; ?>" target="_blank"><?php echo $oNPS->title; ?></a></div>
                                                        </div>
                                                    </td>
                                                    <td><?php echo $oNPS->platform; ?></td>
                                                    <td><div class="text-semibold"><?php echo date('F d, Y', strtotime($oNPS->created)); ?></div><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oNPS->created)) . ' (' . timeAgo($oNPS->created) . ')'; ?></div></td>
                                                    <td><div class="text-semibold"><?php echo date('F d, Y', strtotime($oNPS->created)); ?></div><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oNPS->created)) . ' (' . timeAgo($oNPS->created) . ')'; ?></div></td>

                                                    <td class="text-center"><?php echo $oNPS->status == 'active' ? '<span class="label bg-success">' . $oNPS->status . '</span>' : '<span class="label bg-danger">' . $oNPS->status . '</span>'; ?></td>



                                                </tr>
<?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /content area -->

<div id="editSurveyModel" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="frmeditSurveyModel" name="frmeditSurveyModel">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Edit Survey</h5>
                </div>

                <div id="npsTitleEdit">
                    <div class="modal-body">
                        <p>Survey Name:</p>
                        <input class="form-control" id="edit_title" name="title" placeholder="Enter Survey Name" type="text" required="required"><br>
                        <div id="editSurveyValidation" style="color:#FF0000;display:none;"></div>
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="nps_id" id="hidnpsid" value="" />
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Continue</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- add New Survey -->
<div id="addNPSModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="frmaddNPSModal" id="frmaddNPSModal" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Add New Survey</h5>
                </div>

                <div id="npsTitle">
                    <div class="modal-body">
                        <p>Survey Name:</p>
                        <input class="form-control" id="title" name="title" placeholder="Enter Survey Name" type="text" required="required"><br>
                        <div id="addNPSValidation" style="color:#FF0000;display:none;"></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">

    $(document).ready(function () {

        $(document).on("click", ".editBrandboost", function () {
            var brandboostID = $(this).attr('brandid');
            $.ajax({
                url: '<?php echo base_url('/admin/brandboost/editOnsite') ?>',
                type: "POST",
                data: {'brandboostID': brandboostID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = '<?php echo base_url('/admin/brandboost/setup/onsite'); ?>';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        });

    });




</script>

