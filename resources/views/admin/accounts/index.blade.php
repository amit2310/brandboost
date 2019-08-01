@extends('layouts.main_template') 

@section('title')
<?php //echo $title;
 ?>
@endsection

@section('contents')

<?php
if (!empty($oTeam)) {
    foreach ($oTeam as $oTeamMember) {
        $aTeamMember[$oTeamMember->id] = $oTeamMember;
        if (!empty($oTeamMember->bb_number)) {
            $aTeamIDs[$oTeamMember->id] = phone_display_custom_helper($oTeamMember->bb_number);
        }
    }
}

if(!empty($oUser->subscriber_id)) {
    $subscriber_id = $oUser->subscriber_id;
}
else {
    $subscriber_id = '';
}

if(!empty($oUser->country_code)) {
    $country_code = $oUser->country_code;
}
else {
    $country_code = '';
}

if ($oUser->avatar == '') {
    $profileImage = '<a class="icons fl_letters s32" href="' . base_url() . 'admin/contacts/profile/' . $subscriber_id . '">' . ucfirst(substr($oUser->firstname, 0, 1)) . '' . ucfirst(substr($oUser->lastname, 0, 1)) . '</a>';
} else {
    $profileImage = '<a class="icons s32" href="' . base_url() . 'admin/contacts/profile/' . $subscriber_id . '"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $oUser->avatar . '" onerror="this.src=\'/assets/images/userp.png\'" class="img-circle img-xs" alt=""></a>';
}


?>
<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-3">
                <h3><i class="icon-vcard"></i> &nbsp; <?php echo $title; ?></h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="all active"><a style="javascript:void();" id="activeCampaign" class="filterByColumn" fil="">All</a></li>
                    <li class=""><a style="javascript:void();" class="filterByColumn" fil="email">Email</a></li>
                    <li class=""><a style="javascript:void();" class="filterByColumn" fil="sms">SMS</a></li>
                    <li class=""><a style="javascript:void();" class="filterByColumn" fil="mms">MMS</a></li>

                </ul>


            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-9 text-right btn_area">



            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->

    <div class="tab-content"> 
        <div class="tab-pane active">

            <!-- Dashboard content -->
            <div class="row">
                <div class="col-lg-12">

                    <!-- Marketing campaigns -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">

                            <h6 class="panel-title"><?php echo $title; ?></h6>
                            <div class="heading-elements">
                                <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                    <input class="form-control input-sm cus_search" tableid="allusagecredits" placeholder="Search by name" type="text">
                                    <div class="form-control-feedback">
                                        <i class="icon-search4"></i>
                                    </div>
                                </div>&nbsp; &nbsp;                                
                            </div>
                        </div>


                        <div class="panel-body p0">
                                <!-- <input name="min" id="min" type="hidden">
                            <input name="max" id="max" type="hidden"> -->
                            <table class="table" id="allusagecredits">
                                <thead>
                                    <tr><!-- sorting sortingAction -->
                                        <th style="display: none;"></th>
                                        <th style="display: none;"></th>
                                        <th>Usage Type</th>
                                        <th>Direction</th>
                                        <th>Sent To</th>
                                        <th>User Group</th>
                                        <th>User Details</th>
                                        <th>Module Name</th>
                                        <th>Credit Deducted</th>
                                        <th>Closing Credits</th>
                                        <th>Transaction Date</th>
                                        <th>View Details</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($oUsages)) {
                                        foreach ($oUsages AS $oUsage) {
                                            $direction = ucfirst($oUsage->direction);
                                            $usageType = (strtolower($oUsage->usage_type) == 'sms' || strtolower($oUsage->usage_type) == 'mms') ? phoneNoFormat($oUsage->spend_to) : $oUsage->spend_to;
                                            ?>
                                            <tr role="row">
                                                <td style="display: none;"><?php echo $oUsage->id ?></td>
                                                <td style="display: none;"><?php echo date('m/d/Y', strtotime($oUsage->created)); ?></td>
                                                <td><?php echo ucfirst($oUsage->usage_type); ?></td>
                                                <td><?php echo ($direction) ? $direction: displayNoData(); ?></td>
                                                <td><?php echo ($usageType) ? $usageType : displayNoData(); ?></td>
                                                <td><?php echo (in_array(phone_display_custom_helper($oUsage->spend_to), $aTeamIDs) || in_array(phone_display_custom_helper($oUsage->spend_from), $aTeamIDs)) ? "Team Member" : "Client"; ?></td>

                                                <?php
                                                if (in_array(phone_display_custom_helper($oUsage->spend_to), $aTeamIDs) || in_array(phone_display_custom_helper($oUsage->spend_from), $aTeamIDs)) {
                                                    if (in_array(phone_display_custom_helper($oUsage->spend_to), $aTeamIDs)) {
                                                        $teamID = array_search(phone_display_custom_helper($oUsage->spend_to), $aTeamIDs);
                                                    } else {
                                                        $teamID = array_search(phone_display_custom_helper($oUsage->spend_from), $aTeamIDs);
                                                    }

                                                    $oTeamInfo = $aTeamMember[$teamID];

                                                    if(!empty($oTeamInfo->subscriber_id)) {
                                                        $subscriber_id = $oTeamInfo->subscriber_id;
                                                    }
                                                    else {
                                                        $subscriber_id = '';
                                                    }

                                                    if(!empty($oTeamInfo->country_code)) {
                                                        $country_code = $oTeamInfo->country_code;
                                                    }
                                                    else {
                                                        $country_code = '';
                                                    }
                                                  
                                                    if ($oTeamInfo->avatar == '') {
                                                        $profileImageTeam = '<a class="icons fl_letters s32" href="' . base_url() . 'admin/contacts/profile/' . $subscriber_id . '">' . ucfirst(substr($oTeamInfo->firstname, 0, 1)) . '' . ucfirst(substr($oTeamInfo->lastname, 0, 1)) . '</a>';
                                                    } else {
                                                        $profileImageTeam = '<a class="icons s32" href="' . base_url() . 'admin/contacts/profile/' . $subscriber_id . '"><img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $oTeamInfo->avatar . '" onerror="this.src=\'/assets/images/userp.png\'" class="img-circle img-xs" alt=""></a>';
                                                    }
                                                    ?>
                                                    <td>											
                                                        <div class="media-left media-middle"> <?php echo $profileImageTeam; ?> </div>
                                                        <div class="media-left">
                                                            <div class="pt-5"><a href="<?php echo base_url(); ?>admin/contacts/profile/<?php echo $subscriber_id; ?>" class="text-default text-semibold bbot"><?php echo $oTeamInfo->firstname; ?> <?php echo $oTeamInfo->lastname; ?></a> <img class="flags" src="<?php echo base_url(); ?>assets/images/flags/<?php echo strtolower($country_code); ?>.png" onerror="this.src='<?php echo base_url('assets/images/flags/us.png'); ?>'"/></div>
                                                            <div class="text-muted text-size-small"><?php echo $oTeamInfo->email; ?></div>
                                                        </div>
                                                    </td>
                                                <?php } else { ?>
                                                    <td>											
                                                        <div class="media-left media-middle"> <?php echo $profileImage; ?> </div>
                                                        <div class="media-left">
                                                            <div class="pt-5"><a href="<?php echo base_url(); ?>admin/contacts/profile/<?php echo $subscriber_id; ?>" class="text-default text-semibold bbot"><?php echo $oUser->firstname; ?> <?php echo $oUser->lastname; ?></a> <img class="flags" src="<?php echo base_url(); ?>assets/images/flags/<?php echo strtolower($country_code); ?>.png" onerror="this.src='<?php echo base_url('assets/images/flags/us.png'); ?>'"/></div>
                                                            <div class="text-muted text-size-small"><?php echo $oUser->email; ?></div>
                                                        </div>
                                                    </td>
                                                <?php } ?>
                                                <td><?php echo ($oUsage->module_name) ? ucwords($oUsage->module_name) : displayNoData(); ?></td>    
                                                <td><?php echo ($oUsage->balance_deducted) ? $oUsage->balance_deducted : 0; ?></td>
                                                <td><?php echo ($oUsage->closing_balance) ? $oUsage->closing_balance : displayNoData(); ?></td>
                                                <td><?php echo dataFormat($oUsage->created); ?></td>
                                                <td><a href="javascript:void(0);" class="viewUsageDetails" usage_id="<?php echo $oUsage->id; ?>">View Details</a></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>


</div>

<div id="viewUsageDetails" class="modal fade">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;View Usage Details</h5>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3"><strong>Type: </strong><span id="usagetype"></span></div>
                    <div class="col-md-3"><strong>Sent To: </strong><span id="spentto"></span></div>
                    <div class="col-md-3"><strong>Used Credits: </strong><span id="chargedcredits"></span></div>
                    <div class="col-md-3"><strong>Date: </strong><span id="chargedate"></span></div>
                </div>
                <div class="row mt20 pt20">
                    <div class="col-md-3"><strong>Module Name: </strong><span id="usagemodulename"></span></div>
                    <div class="col-md-8"><strong>Campaign Name: </strong><span id="usagecampaignname"></span></div>
                </div>
                <hr>

                <div id="usage-container" style="padding:20px;margin-top:20px;font-style: italic; position: relative;min-height: 400px;word-wrap:break-word;">

                </div>

            </div>

            <div class="modal-footer">

                <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>

            </div>

        </div>
    </div>
</div>
<!-- /content area -->
<script>
    $(document).ready(function () {


        $('#allusagecredits thead tr').clone(true).appendTo('#allusagecredits thead');
        $('#allusagecredits thead tr:eq(1) th').each(function (i) {
            //console.log(i);

            if (i === 2) {
                var title = $(this).text().toLowerCase();
                $(this).html('<input type="text" id="filterByStatus" value="" placeholder="Search ' + title + '" />');
                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() !== this.value) {
                        tableBase
                                .column(i)
                                .search(this.value, $('#colStatus').prop('checked', true))
                                .draw();
                    }
                });
            }


        });

        var tableId = 'allusagecredits';
        var tableBase = custom_data_table(tableId);

        $(document).on('click', '.filterByColumn', function () {

            $('.nav-tabs').each(function (i) {
                $(this).children().removeClass('active');
            });
            $(this).parent().addClass('active');
            var fil = $(this).attr('fil');
            $('#filterByStatus').val(fil);
            $('#filterByStatus').keyup();
        });
        $(document).on("click", ".viewUsageDetails", function () {
            $('.overlaynew').show();
            var id = $(this).attr('usage_id');
            $.ajax({
                url: '<?php echo base_url('admin/accounts/usageInfo'); ?>',
                type: "POST",
                data: {id: id, _token: "<?php echo csrf_token(); ?>"},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {

                        if(data.mediaType == 'image')
                        {
                             
                            $("#usage-container").html('<img src="'+data.content+'" alt="Image" height="auto" width="100%"> ');
                        }
                        else if(data.usagetype == "Mms") {

                            var newMessage = data.content;
                            var fileext = (/[.]/.exec(newMessage)) ? /[^.]+$/.exec(newMessage) : undefined;
                            if(typeof fileext != 'undefined' && fileext !== null){
                                if(fileext[0] == 'png' || fileext[0] == 'jpg' || fileext[0] == 'jpeg' || fileext[0] == 'gif') 
                                {
                                newMessage = "<a href='"+newMessage+"' class='previewImage' target='_blank'><img src='"+newMessage+"' height='auto' width='100%' /></a>";
                                }
                                else if(fileext[0] == 'doc' || fileext[0] == 'docx' || fileext[0] == 'odt' || fileext[0] == 'csv' || fileext[0] == 'pdf') {
                                newMessage = "<a href='"+newMessage+"' target='_blank'>Download '"+fileext[0].toUpperCase()+"' File</a>";
                                }
                                else if(fileext[0] == 'mp4' || newMessage.indexOf('/Media/') != -1) {
                                    newMessage = "<video width='100%' height='auto' controls><source src='"+newMessage+"' type='video/"+fileext[0]+"'></video>";
                                }

                                $("#usage-container").html(newMessage);
                            }
                        }
                        else {
                            $("#usage-container").html(data.content);
                        }

                        
                        $("#usagetype").html(data.usagetype);
                        $("#spentto").html(data.spentto);
                        $("#chargedcredits").html(data.chargedcredits);
                        $("#chargedate").html(data.chargedate);
                        $("#usagemodulename").html(data.usagemodulename);
                        $("#usagecampaignname").html(data.usagecampaignLink);
                        $("#viewUsageDetails").modal("show");
                        $('.overlaynew').hide();
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });
    });
</script>

@endsection

