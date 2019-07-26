@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')
<?php list($canRead, $canWrite) = fetchPermissions('Offsite Campaign'); ?>
<?php
$feedbackResponseData = $feedbackResponse;
$offsiteDetail = $getOffsite[0];
$offsite_ids = $offsiteDetail->offsite_ids;
$offsites_links = $offsiteDetail->offsites_links;
$offsite_ids = unserialize($offsite_ids);
$offsites_links = unserialize($offsites_links);
list($canReadCon, $canWriteCon) = fetchPermissions('Contacts');

$rewards = '';
$emailWorkflow = '';
$campaign = '';
$clients = '';
$reviews = '';
$sources = '';
$camp = '';


if($selectedTab == 'contacts'){
    $campaign = 'active';
}else if ($setTab == 'Campaign Preferences') {
    $camp = 'active';
} else if (trim($setTab) == 'Rewards & Gifts') {
    $rewards = 'active';
} else if (trim($setTab) == 'Email Workflow') {
    $emailWorkflow = 'active';
} else if (trim($setTab) == 'Campaign Clients') {
    $campaign = 'active';
} else if (trim($setTab) == 'Requires Attention') {
    $clients = 'active';
} else if (trim($setTab) == 'Review Sources') {
    $sources = 'active';
} else if (trim($setTab) == 'Reviews') {
    $reviews = 'active';
}
else {
    $sources = 'active';
}

?>

<!-- /theme JS files -->
<div class="content">
    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
	<div class="page_header">
	  <div class="row">
	  <!--=============Headings & Tabs menu==============-->
		<div class="col-md-7" >
		  <h3><img src="/assets/images/offsite_icon_19.png" style="width: 16px;"> &nbsp; Offsite Brandboost Campaign : <?php echo $getOffsite[0]->brand_title; ?></h3>
		  <ul class="nav nav-tabs nav-tabs-bottom" >
			<li class="<?php echo $sources; ?>"><a href="#right-icon-tab0" class="continueStepOffsite" targetName="Review Sources" data-brandid="<?php echo $brandboostID;?>" data-toggle="tab">Source</a></li>

			<li class="<?php echo $camp; ?>"><a href="#right-icon-tab1" class="continueStepOffsite" targetName="Campaign Preferences" data-brandid="<?php echo $brandboostID;?>" data-toggle="tab">Preferences</a></li>

			<li class="<?php echo $emailWorkflow; ?>"><a href="#right-icon-tab3" class="continueStepOffsite" targetName="Email Workflow" data-brandid="<?php echo $brandboostID;?>" data-toggle="tab">Email Workflow</a></li>

			<!-- <li class="<?php echo $reviews; ?>"><a href="#right-icon-tab6" data-toggle="tab">Reviews</a></li> -->

			<li class="<?php echo $clients; ?>"><a href="#right-icon-tab5" class="continueStepOffsite" targetName="Requires Attention" data-brandid="<?php echo $brandboostID;?>" data-toggle="tab">Requires Attention</a></li>

			<li class="<?php echo $campaign; ?>"><a href="#right-icon-tab4" class="continueStepOffsite" targetName="Campaign Clients" data-brandid="<?php echo $brandboostID;?>" data-toggle="tab">Contacts</a></li>
			
		  </ul>
		</div>
		<!--=============Button Area Right Side==============-->
		<div class="col-md-5 text-right btn_area">

            <button type="button" style="padding: 7px 15px!important;" class="btn dark_btn onSiteCampaignStatus" status="2"><i class="icon-plus3"></i><span> &nbsp;  Save as Draft</span> </button>

            <button type="button" style="padding: 7px 15px!important;" class="btn dark_btn onSiteCampaignStatus" status="1"><i class="icon-plus3"></i><span> &nbsp;  Publish</span> </button>
		</div>
	  </div>
	</div>
  <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->

	<div class="tab-content"> 
		<!--########################TAB 0 ##########################-->
		<?php //$this->load->view("admin/brandboost/campaign-tabs/offsite/offsite-review-sources", array('brandboostID' => $brandboostID, 'sources' => $sources, 'offsites_links' => $offsites_links, 'offSiteData' => $offSiteData, 'offsite_ids' => $offsite_ids)); ?>
		@include('admin.brandboost.campaign-tabs.offsite.offsite-review-sources', array('brandboostID' => $brandboostID, 'sources' => $sources, 'offsites_links' => $offsites_links, 'offSiteData' => $offSiteData, 'offsite_ids' => $offsite_ids))
		<!--########################TAB 1 ##########################-->
		<?php //$this->load->view("admin/brandboost/campaign-tabs/offsite/offsite-preferences", array('brandboostID' => $brandboostID, 'camp' => $camp, 'offsites_links' => $offsites_links, 'feedbackResponseData' => $feedbackResponseData)); ?>
		@include('admin.brandboost.campaign-tabs.offsite.offsite-preferences', array('brandboostID' => $brandboostID, 'camp' => $camp, 'offsites_links' => $offsites_links, 'feedbackResponseData' => $feedbackResponseData))
		<!--########################TAB 2 ##########################-->
        <?php //$this->load->view("admin/brandboost/campaign-tabs/offsite/offsite-workflow-campaign-beta", array('emailWorkflow' => $emailWorkflow, 'subscribersData' => $subscribersData, 'oEvents' => $oEvents)); ?>
		@include('admin.brandboost.campaign-tabs.offsite.offsite-workflow-campaign-beta', array('emailWorkflow' => $emailWorkflow, 'subscribersData' => $subscribersData, 'oEvents' => $oEvents))
		<!--########################TAB 3 ##########################--> 
		<?php //$this->load->view("admin/brandboost/campaign-tabs/offsite/offsite-subscribers", array('brandboostID' => $brandboostID, 'campaign' => $campaign)); ?>
		@include('admin.brandboost.campaign-tabs.offsite.offsite-subscribers', array('brandboostID' => $brandboostID, 'campaign' => $campaign))
		<!--########################TAB 4 ##########################--> 
		<?php //$this->load->view("admin/brandboost/campaign-tabs/offsite/offsite-feedback", array('brandboostID' => $brandboostID, 'clients' => $clients)); ?>
		@include('admin.brandboost.campaign-tabs.offsite.offsite-feedback', array('brandboostID' => $brandboostID, 'clients' => $clients))
	</div>
</div>


<?php //$this->load->view("admin/brandboost/campaign-tabs/offsite/offsite-popup"); ?>
@include('admin.brandboost.campaign-tabs.offsite.offsite-popup')

<?php //$this->load->view("admin/modals/workflow2/workflow-popup", array('oDefaultTemplates' => $oDefaultTemplates)); ?>

@include('admin.modals.workflow2.workflow-popup')

<script>

    function add_campaign(campaignType, eventID, eventype = 'main') {
        $('.overlaynew').show();
        $.ajax({
            url: '<?php echo base_url('admin/brandboost/create_campaign'); ?>',
            type: "POST",
            data: {'campaign_type': campaignType, 'event_id': eventID, 'event_type': eventype, 'brandboost_type': 'offsite'},
            dataType: "json",
            success: function (data) {
                //console.log(data);
                if (data.status == 'success') {
                    setTimeout(function () {
                        $('.overlaynew').hide();
                        window.location.href = window.location.href;
                    }, 1000);
                } else {
                    alert('Error: Some thing wrong!');
                    $('.overlaynew').hide();
                    setTimeout(function () {
                        window.location.href = window.location.href;
                    }, 1000);
                }
            }
        });
    }

    function delete_campaign(campaignID) {
        swal({
            title: "Are you sure? You want to delete this campaign!",
            text: "You will not be able to recover this campaign!",
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
				$.ajax({
					url: '<?php echo base_url('admin/brandboost/delete_campaign'); ?>',
					type: "POST",
					data: {'campaign_id': campaignID},
					dataType: "json",
					success: function (data) {
						//console.log(data);
						if (data.status == 'success') {
							setTimeout(function () {
								window.location.href = window.location.href;
							}, 1000);
						} else {
							alert('Error: Some thing wrong!');
							setTimeout(function () {
								window.location.href = window.location.href;
							}, 1000);
						}
					}
				});
			}
		});
    }

    function delete_event(eventID) {
        var conf = confirm("Are you sure? You want to delete this event!");
        if (conf == true) {
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/delete_event'); ?>',
                type: "POST",
                data: {'event_id': eventID},
                dataType: "json",
                success: function (data) {
                    //console.log(data);
                    if (data.status == 'success') {
                        alert('Event has been deleted successfully.');
                        setTimeout(function () {
                            window.location.href = window.location.href;
                        }, 1000);
                    } else {
                        alert('Error: Some thing wrong!');
                        setTimeout(function () {
                            window.location.href = window.location.href;
                        }, 1000);
                    }
                }
            });
        }
    }

    $(document).ready(function () {


        $(document).on("click", "#publishCampaign", function () {
            var brandboostID = $(this).attr('data-brandid');
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/publishOnsiteBB'); ?>',
                type: "POST",
                data: {action: 'publishCampaign', 'brandboostID' : brandboostID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = '<?php echo base_url('admin/brandboost/offsite'); ?>';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        });


        $(document).on("click", "#sendPreviewEmailBox", function () {
            $('.showEmailBox').show();
            $('#cancelPreviewEmailBox').show();
            $(this).hide();
        });

        $(document).on("click", "#cancelPreviewEmailBox", function () {
            $('.showEmailBox').hide();
            $('#sendPreviewEmailBox').show();
            $(this).hide();
        });

        $(document).on("click", "#sendPreviewSMSBox", function () {
            $('.showSMSBox').show();
            $('#cancelPreviewSMSBox').show();
            $(this).hide();
        });

        $(document).on("click", "#cancelPreviewSMSBox", function () {
            $('.showSMSBox').hide();
            $('#sendPreviewSMSBox').show();
            $(this).hide();
        });

        $(document).on("click", "#sendPreviewEmail", function () {
            var email = $("#email").val();
            var emailtemplate = $(".emailPreviewContent").html();

            $('.overlaynew').show();
            $.ajax({
                url: '<?php echo base_url('admin/emailtemplate/send_email_template'); ?>',
                type: "POST",
                data: {email: email, emailtemplate: emailtemplate, bb_id: ''},
                dataType: "json",
                success: function (data) {
                    $('.overlaynew').hide();
                    $("#emailPreviewPopup").modal('hide');
                    if (data.status == 'success') {
                        alertMessage('Previwe email has been sent successfully in your email account. Please check.');
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        });

        $(document).on("click", "#sendPreviewSMS", function () {
            var phoneNo = $("#phoneNo").val();
            var smstemplate = $(".smsPreviewContent").html();

            $('.overlaynew').show();
            $.ajax({
                url: '<?php echo base_url('admin/emailtemplate/send_sms_template'); ?>',
                type: "POST",
                data: {phoneNo: phoneNo, smstemplate: smstemplate, bb_id: ''},
                dataType: "json",
                success: function (data) {
                    $('.overlaynew').hide();
                    $("#smsPreviewPopup").modal('hide');
                    if (data.status == 'success') {
                        alertMessage('Previwe sms has been sent successfully in your phone#. Please check.');
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                },
                error: function () {
                    $('.overlaynew').hide();
                    alertMessage('Error: Some thing wrong!');
                }
            });
        });


        $(document).on("click", "#publishFeedback", function () {

            $.ajax({
                url: '<?php echo base_url('admin/brandboost/updateStatus'); ?>',
                type: "POST",
                data: {},
                dataType: "json",
                success: function (data) {
                    //console.log(data);
                    if (data.status == 'success') {
                        window.location.href = '<?php echo base_url('admin/brandboost/offsite'); ?>';
                    } else {

                    }
                }
            });

        });

        /*$(document).on("click", "#campaignUserStep", function () {
            $('.tabbable a[href="#right-icon-tab4"]').click();
        });*/

        $(document).on("click", "#campaignUserStepBug", function () {
            alertMessage('There should be atleast one email or sms in each container');
        });


        var fromPreviewEmail = '';
        $(document).on("click", ".emailPreviewButton", function () {
            fromPreviewEmail = $(this).attr('from_email');
            $(".emailPreviewContent").html($('#previewContent_' + $(this).attr('email_preview')).html());
            $("#emailPreviewPopup").modal();
        });

        $(document).on("click", ".smsPreviewButton", function () {
            $(".smsPreviewContent").html($('#previewContent_' + $(this).attr('email_preview')).html());
            $("#smsPreviewPopup").modal();
        });


        $(document).on('click', '.onSiteCampaignStatus', function() {

            var status = $(this).attr('status');
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/publishOnsiteStatusBB'); ?>',
                type: "POST",
                data: {'brandboostID': '<?php echo $brandboostData->id; ?>', 'status':status},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        if(status == 1) {
                            
                            displayMessagePopup();
                        }
                        else {
                             displayMessagePopup();
                        }
                        
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
            
        });


        $(document).on('click', '#publishOnsiteCampaign', function() {
            if($(this).prop("checked") == true) {
                $.ajax({
                    url: '<?php echo base_url('admin/brandboost/publishOnsiteStatusBB'); ?>',
                    type: "POST",
                    data: {'action': 'publishCampaign', 'brandboostID': '<?php echo $brandboostData->id; ?>', 'status':'1'},
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            //window.location.href = '<?php echo base_url('admin/brandboost/onsite'); ?>';
                        } else {
                            alertMessage('Error: Some thing wrong!');
                        }
                    }
                });
            }
            else {

                $.ajax({
                    url: '<?php echo base_url('admin/brandboost/publishOnsiteStatusBB'); ?>',
                    type: "POST",
                    data: {'action': 'publishCampaign', 'brandboostID': '<?php echo $brandboostData->id; ?>', 'status':'0'},
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            //window.location.href = '<?php echo base_url('admin/brandboost/onsite'); ?>';
                        } else {
                            alertMessage('Error: Some thing wrong!');
                        }
                    }
                });

            }
        });

        $(document).on('change', '.autoSave', function() {
            $('.saveOffsiteButton').trigger('click');
        });
        
       
        $("#addOffstepList").submit(function (e) {

            e.preventDefault();

            //check if entered URL is valid
            var bvalid;
            var linkIdVal = '';
            $(".linkurlC").each(function () {
                var textURL = $(this).val();
                linkIdVal = $(this).attr('linkid');
                if (ValidURL(textURL) == false) {
                    $(this).focus();
                    bvalid = false;
                    return false;
                }
            });

            var email = $("#from_email").val();
            var fromName = $("#from_name").val();

            if (fromName == '') {
                $("#from_name").focus();
                $("#from_name").next('.errorMsg').html('<p style="color:red;">Please enter from name.</p>');
                return false;
            } else {
                $("#from_name").next('.errorMsg').html('');
            }

            var bValid = validateEmail(email);
            if (bValid == false) {
                $("#from_email").focus();
                $("#from_email").next('.errorMsg').html('<p style="color:red;">Please enter valid email address.</p>');
                return false;
            } else {
                $("#from_email").next('.errorMsg').html('');
            }

            if ($.trim($("input[name='review_expire_link']:checked").val()) == 'custom') {
                if ($("#txtInteger").val() == '' || $("#txtInteger").val() == null) {
                    alertMessage('Exprire value should be greater than zero.');
                    return false;
                }
            }

            var formData = new FormData($(this)[0]);
            var edit_campaignName = $('#edit_campaignName').val();
            formData.append('edit_campaignName', edit_campaignName);
            
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/add_offsite_url'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        displayMessagePopup();
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        });

        $("#addRewardsBrandboost").submit(function () {

            $('.tabbable a[href="#right-icon-tab3"]').click();

        });

        $('.eventFrmUpdate').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: '<?php echo base_url('admin/brandboost/update_event'); ?>',
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    //console.log(data);
                    if (data.status == 'success') {
                    } else {
                        alert('Error: Some thing wrong!');
                    }
                }
            });
            return false;
        });

        $('#create_event').click(function () {
            $('.overlaynew').show();
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/addReminder'); ?>',
                type: "POST",
                data: {action: 'createEvent'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        setTimeout(function () {
                            $('.overlaynew').hide();
                            window.location.href = window.location.href;
                        }, 1000);
                    } else {
                        $('.overlaynew').hide();
                        alert('Error: Some thing wrong!');
                        setTimeout(function () {
                            window.location.href = window.location.href;
                        }, 1000);
                    }
                }
            });
        });

    });
    function validateEmail(emailField) {
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (filter.test(emailField)) {
            return true;
        } else {
            return false;
        }
    }

    function ValidURL(str) {
        var pattern = new RegExp(/^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/, 'i'); // fragment locater

        if (!pattern.test(str)) {
            return false;
        }
    }
</script>	

<script type="text/javascript">

    $(document).ready(function () {

        $(".numaric_only").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                            // Allow: home, end, left, right, down, up
                                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                        // let it happen, don't do anything
                        return;
                    }
                    // Ensure that it is a number and stop the keypress
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                        e.preventDefault();
                    }
                });

        $("#nav-tabs-bottom li").on('click', function () {

            var getActiveText = $(this).text();

            $.ajax({
                url: "<?php echo base_url('/admin/brandboost/setTab'); ?>",
                type: "POST",
                data: {getActiveText: getActiveText, brandboostID:'<?php echo $brandboostID;?>'},
                dataType: "json",
                success: function (response) {
                    if (response.status == 'error') {
                        window.location.href = "/admin/brandboost/offsite_setup/<?php echo $brandboostID;?>";
                    }
                },
                error: function (response) {
                    //alert("Something went wrong");
                }
            });


        });



        $(document).on('click', '.edit_email_template', function () {

            var camp_id = $(this).attr('camp_id');
            var camp_temp_src = $(this).attr('camp_temp_src');
            $('.overlaynew').show();
            $.ajax({
                url: "<?php echo base_url('/admin/brandboost/email_template_popup'); ?>",
                type: "POST",
                data: {camp_id: camp_id, camp_temp_src: camp_temp_src},
                dataType: "html",
                success: function (response) {
                    $('.overlaynew').hide();
                    $('#modal_large').modal();
                    $('#modal_large').html(response);

                },
                error: function (response) {
                    alertMessage("Something went wrong");
                }
            });
            return false;

        });

        $(document).on('click', '.edit_sms_template', function () {

            var camp_id = $(this).attr('camp_id');
            var camp_temp_src = $(this).attr('camp_temp_src');
            $.ajax({
                url: "<?php echo base_url('/admin/brandboost/sms_template_popup'); ?>",
                type: "POST",
                data: {camp_id: camp_id, camp_temp_src: camp_temp_src},
                dataType: "html",
                success: function (response) {

                    $('#modal_large').modal();
                    $('#modal_large').html(response);

                },
                error: function (response) {
                    alertMessage("Something went wrong");
                }
            });
            return false;

        });
    });


    var sort_type_element = 'ASC';
    var sort_by_element = 'id';
    var offsiteLimit = '5';
    var selected_list = $('#selected_list').val();

    function load_user_data(page, sortby, sort_type, search_value, selected_list, offsite_limit)
    {
        var selected_list = $("#selected_list_n").val();
        var selected_list_new = $("#selected_list_new").val();
        $.ajax({
            url: "<?php echo base_url(); ?>ajax_pagination/offsite_step_pagination_edit/" + page,
            data: {sortby: sortby, sort_type: sort_type, search_value: search_value, selected_list: selected_list, offsite_limit: offsite_limit, selected_list_new: selected_list_new},
            method: "GET",
            dataType: "json",
            success: function (data)
            {
                $('#offsite_list_detail').html(data.offsite_list_detail);
                $('#pagination_link_show').html(data.pagination_link);
            }
        });
    }


    $(document).ready(function () {



        $(document).on('click', '#socialIcon', function () {

            var selected_list = $('#selected_list').val();
            var offsiteLimit = $('#offsiteLimit').val();

            load_user_data(1, sort_by_element, sort_type_element, '', selected_list, offsiteLimit);
            $('#socialIconPopup').modal();
        });

        $(document).on('click', '#socialIconE', function () {

            $('#socialIconPopupE').modal();
        });

        $(document).on('change', '#offsiteLimit', function () {

            var offsiteLimit = $(this).val();
            var selected_list = $('#selected_list').val();
            var search_value = $('#offsite_search').val();
            load_user_data(1, sort_by_element, sort_type_element, search_value, selected_list, offsiteLimit);
        });

        $(document).on("click", ".pagination li a", function (event) {
            event.preventDefault();
            var page = $(this).data("ci-pagination-page");
            var search_value = $('#offsite_search').val();
            var selected_list = $('#selected_list').val();
            var offsiteLimit = $('#offsiteLimit').val();
            load_user_data(page, sort_by_element, sort_type_element, search_value, selected_list, offsiteLimit);
        });

        $('#offsite_search').keyup(function () {

            var search_value = $('#offsite_search').val();
            var selected_list = $('#selected_list').val();
            var offsiteLimit = $('#offsiteLimit').val();
            var page = 1;
            load_user_data(page, sort_by_element, sort_type_element, search_value, selected_list, offsiteLimit);

        });

        $(document).on('click', '.offsite_selected_r', function () {

            var offsiteId = $(this).attr('offsiteId');
            var offsiteSelected = $(this).attr('offsiteSelected');

            deleteConfirmationPopup(
            "This Source will deleted immediately.<br>You can't undo this action.", 
            function() {
                           // $('ul.media-list #socialIcon'+offsiteId).hide();
                         // $('.overlaynew').show();
                            if (offsiteSelected == 0) {
                                $(this).attr('offsiteSelected', '1');
                                $('#review_steps' + offsiteId).addClass('selected');
                                $(this).removeClass('bg-blue');
                                $(this).addClass('red_cust_btn');
                                $(this).html('<i class="icon-minus2 text-size-base"></i>');

                                var selected_list = $('#selected_list_r').val();
                                $('#selected_list_r').val(selected_list + ',' + offsiteId);
                                $('#selected_list').val(selected_list + ',' + offsiteId);
                                $('#selected_list_n').val(selected_list + ',' + offsiteId);

                            } else {
                                //$('#socialIcon' + offsiteId).hide();
                                //$('#linkUrl'+offsiteId).val('');
                                $('.totalIcon').attr("id", "socialIcon");
                                $(this).attr('offsiteSelected', '0');
                                $('#review_steps' + offsiteId).removeClass('selected');
                                $(this).removeClass('red_cust_btn');
                                $(this).addClass('bg-blue');
                                $(this).html('<i class="icon-plus2 text-size-base"></i>');

                                var selected_list = $('#selected_list_r').val();
                                var offstepIds = selected_list.split(",");
                                offstepIds = $.grep(offstepIds, function (value) {
                                    return value != offsiteId;
                                });
                                offstepIds = offstepIds.join();
                                $('#selected_list_r').val(offstepIds);
                                $('#selected_list').val(offstepIds);
                                $('#selected_list_n').val(offstepIds);

                            }

                            var selected_list = $('#selected_list_r').val();
                            $.ajax({
                                url: '<?php echo base_url('admin/brandboost/add_offsite_resources'); ?>',
                                type: "POST",
                                data: {selected_list: selected_list, offsiteId:offsiteId, brandboostID: '<?php echo $brandboostID; ?>'},
                                dataType: "json",
                                success: function (data) {
                                    if (data.status == 'success') {
                                         window.location.href='';
                                        //alert('del');
                                        // $('.overlaynew').hide();
                                        //alert(offsiteI d);
                                        
                                        //window.location.href='';
                                        //$('.tabbable a[href="#right-icon-tab2"]').click();
                                        //alert('done')
                                    } else {
                                        alertMessage('Error: Some thing wrong!');
                                    }
                                }
                            });

                        
                    });

            return false;
        });
		


        /*$(document).on('click', '.getReview', function () {
            var siteID = $(this).attr('site_id');
            var bbID = $(this).attr('bbID');
            var siteAPIId = $('.siteURLId_' + siteID).val();
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/addOffsiteReviews'); ?>',
                type: "POST",
                data: {'site_id': siteID, 'site_api_id': siteAPIId},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {

                    }
                }
            });
        });*/

        /*$(document).on('click', '.linkurlC', function () {

            var getSocialId = $(this).attr('linkid');
            var getUrl = $('#linkUrl' + getSocialId).val();
            var bbID = $(this).attr('bbID');
            //console.log(getUrl);
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/addOffsiteUrl'); ?>',
                type: "POST",
                data: {'getSocialId': getSocialId, 'getUrl': getUrl, 'bbID': bbID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {

                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        });*/

        $(document).on('click', '.offsiteUrlSave', function () {

            var getSocialId = $(this).val();

            var getUrl = $('#linkUrl' + getSocialId).val();
            if (getUrl == '')
            {
                //$('#linkUrl'+getSocialId).focus();
                alertMessage('Field should not be blank.');
                return false;
            }
            //$(this).addClass('btn-ladda btn-ladda-progress');

            $.ajax({
                url: '<?php echo base_url('admin/brandboost/addOffsiteUrl'); ?>',
                type: "POST",
                data: {'getSocialId': getSocialId, 'getUrl': getUrl},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {

                        //alertMessage('Save successfully.');

                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });

        });

        $(document).on('click', '.offsite_selected_popup', function () {

            var offsiteId = $(this).attr('offsiteId');
            var offsiteSelected = $(this).attr('offsiteSelected');

            if (offsiteSelected == 0) {
                $(this).attr('offsiteSelected', '1');
                $('#review_steps' + offsiteId).addClass('selected');
                $(this).removeClass('bg-blue');
                $(this).addClass('red_cust_btn');
                $(this).html('<i class="icon-minus2 text-size-base"></i>');

                var selected_list = $('#selected_list').val();
                $('#selected_list').val(selected_list + ',' + offsiteId);
                var selected_list_new = $('#selected_list_new').val();
                $('#selected_list_new').val(selected_list_new + ',' + offsiteId);
            } else {
                $(this).attr('offsiteSelected', '0');
                $('#review_steps' + offsiteId).removeClass('selected');
                $(this).removeClass('red_cust_btn');
                $(this).addClass('bg-blue');
                $(this).html('<i class="icon-plus2 text-size-base"></i>');

                var selected_list = $('#selected_list').val();
                var selected_list_new = $('#selected_list_new').val();
                var offstepIds = selected_list.split(",");
                offstepIds = $.grep(offstepIds, function (value) {
                    return value != offsiteId;
                });
                offstepIds = offstepIds.join();
                $('#selected_list').val(offstepIds);
                $('#selected_list_new').val(offstepIds);
            }

        });

        $(document).on('click', '.continueStepOffsite', function () {

            //$('.overlaynew').show();

				$.ajax({
                    url: "<?php echo base_url('admin/brandboost/campaignPreferences'); ?>",
                    data: {brandboostID: '<?php echo $brandboostData->id; ?>'},
                    method: "POST",
                    dataType: "json",
                    success: function (data)
                    {
                        if(data.status == 'success') {
                            $('.overlaynew').show();
                            $('.media-list').html(data.socialList);
                            $('.overlaynew').hide();
                            $('#selected_list_r').val(data.selectedList);
						}
                        else {
                            $('.overlaynew').hide();
						}
					}
				});
			
            var targetName = $(this).attr('targetName');
            var brandboostID = $(this).attr('data-brandid');
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/continueStepOffsite'); ?>',
                type: "POST",
                data: {'targetName': targetName, 'brandboostID': brandboostID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        //$('.overlaynew').hide();
						if(data.public == 1){
							window.location.href = '<?php echo base_url('admin/brandboost/offsite/');?>';
						}else{
                                //window.location.href = '<?php echo base_url('admin/brandboost/offsite_setup/');?>'+brandboostID;
						}
                    } else {
                        //$('.overlaynew').hide();
                        alertMessage('Error: Some thing wrong!');
                        setTimeout(function () {
                            window.location.href = window.location.href;
                        }, 1000);
                    }
                }
            });
        });

        $(document).on('click', '.saveReviewSource', function () {

            var offstepIds = [];
            var selected_list = $('#selected_list').val();
			 var offstepIds = selected_list.split(",");
            var brandboostID = $(this).attr('data-brandid');
            //$('.overlaynew').show();

            if (offstepIds.length > 0) {

                $.ajax({
                    url: '<?php echo base_url('admin/brandboost/add_offsite_edit'); ?>',
                    type: "POST",
                    data: {'offstepIds': offstepIds, brandboostID:brandboostID},
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            //$('.overlaynew').hide();
                            //window.location.href = '<?php echo base_url('admin/brandboost/offsite_setup/');?>'+brandboostID;
                        } else {
                            //$('.overlaynew').hide();
                            alertMessage('Error: Some thing wrong!');
                            /*setTimeout(function () {
                                window.location.href = window.location.href;
                            }, 1000);*/
                        }
                    }
                });
            } else {
                alertMessage('Please select atleast one of them.')
            }
        });
		
	
		

        $(document).on('click', '.previewButton', function () {

            var textname = $(this).attr('siteUrl');
            var textId = $(this).attr('siteId');
            var texturl = $('#linkUrl' + textId).val();
            window.open(textname + texturl, '_blank');
        });
		 $(document).on('click', '.previewButtonOthers', function () {

            var textname = $(this).attr('siteUrl');
            var textId = $(this).attr('siteId');
            var texturl = $('#linkUrl' + textId).val();
            window.open(texturl, '_blank');
        });
		
    });

</script>
@endsection