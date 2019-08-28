@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')

<?php
error_reporting(0);
$feedbackResponseData = new stdClass();

if(count($feedbackResponse) > 0){
	$feedbackResponseData = $feedbackResponse;
}else{
	$feedbackResponseData = array();
}

if(count($bbProductsData) > 0){
	$productsData = $bbProductsData;
}else{
	$productsData = new stdClass();
}

list($canRead, $canWrite) = fetchPermissions('Onsite Campaign');
list($canReadCon, $canWriteCon) = fetchPermissions('Contacts');

$rewards = '';
$emailWorkflow = '';
$campaign = '';
$reviews = '';
$integrationClass = '';
$rs = '';
$camp = '';
$setupClass = '';
$imageClass = '';
$videoClass = '';

/*if($_GET['type'] == 'media') {
    $setTab = 'Image';
}*/

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
    $camp = 'active';
}
?>
<div class="content">
	<!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
	<div class="page_header">
	  <div class="row">
	  <!--=============Headings & Tabs menu==============-->
		<div class="col-md-7">
		  <h3><img src="{{ base_url() }}assets/images/onsite_icons.png"> On Site Campaign: <?php echo ucfirst($brandboostData->brand_title); ?></h3>
		  <ul class="nav nav-tabs nav-tabs-bottom">
            <li class="<?php echo $camp; ?>"><a href="#right-icon-tab11" class="tabChange" tabName="Campaign Preferences" data-toggle="tab">Preferences</a></li>
            <li class="<?php echo $emailWorkflow; ?>"><a href="#right-icon-tab3" class="tabChange" tabName="Email Workflow" data-toggle="tab">Email Workflow</a></li>
            <li class="<?php echo $campaign; ?>"><a href="#right-icon-tab4" class="tabChange" tabName="Clients" data-toggle="tab">Contacts</a></li>
            <li class="<?php echo $reviews; ?>"><a href="#right-icon-tab6" class="tabChange" tabName="Reviews" data-toggle="tab">Reviews</a></li>
			<li class="<?php echo $imageClass; ?>"><a href="#right-icon-tab9" class="tabChange changeMedia" tabName="Image" data-toggle="tab">Media</a></li>
		  </ul>
		</div>
		<!--=============Button Area Right Side==============-->
		<div class="col-md-5 text-right btn_area">

        <?php 
        if(!empty($reviews) && $reviews == 'active') {
            $reviewClass = '';
        } else {
            $reviewClass = 'hidden';
        }

        if( !empty($campaign) && $campaign == 'active') {
            $clientClass = '';
        } else {
            $clientClass = 'hidden';
        }
        ?>

        <button type="button" style="padding: 7px 15px!important;" class="btn dark_btn onSiteCampaignStatus" status="2"><i class="icon-plus3"></i><span> &nbsp;  Save as Draft</span> </button>

        <button type="button" style="padding: 7px 15px!important;" class="btn dark_btn onSiteCampaignStatus" status="1"><i class="icon-plus3"></i><span> &nbsp;  Publish</span> </button>

        <a class="btn light_btn ml10 reviewShow <?php echo $reviewClass; ?>" href="{{ base_url() }}admin/brandboost/addreview/<?php echo $brandboostID; ?>"><i class="icon-plus3"></i><span> &nbsp;  Add Manual Review</span> </a>



    
	<!--	<button type="button" class="btn light_btn importModuleContact contactShow <?php echo $clientClass; ?>" data-modulename="<?php echo $moduleName;?>" data-moduleaccountid="<?php echo $moduleUnitID ?>" data-redirect="<?php echo base_url();?>admin/brandboost/onsite_setup/<?php echo $moduleUnitID; ?>"><i class="icon-arrow-up16"></i><span> &nbsp;  Import Contacts</span> </button>
		<a class="btn light_btn ml10 contactShow <?php echo $clientClass; ?>" href="{{ base_url() }}admin/subscriber/exportSubscriberCSV?module_name=<?php echo $moduleName;?>&module_account_id=<?php echo $moduleUnitID; ?>"><i class="icon-arrow-down16"></i><span> &nbsp;  Export Contacts</span> </a>
        <button type="button" class="btn dark_btn dropdown-toggle ml10 addModuleContact" data-modulename="<?php echo $moduleName;?>" data-moduleaccountid="<?php echo $moduleUnitID ?>"><i class="icon-plus3"></i><span> &nbsp;  Add Contact</span> </button>  
	-->	  
		</div>
	  </div>
	</div>
  <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->
  
	<div class="tab-content">

        <!--########################TAB 1 ##########################--> 
		@include('admin.brandboost.campaign-tabs.onsite.onsite-reviews', array('reviews' => $reviews, 'aReviews' => $aReviews, 'brandboostData' => $brandboostData))
        <!--########################TAB 2 ##########################--> 
		@include('admin.brandboost.campaign-tabs.onsite.onsite-subscribers', array('campaign' => $campaign))
        <!--########################TAB 3 ##########################-->
		@include('admin.brandboost.campaign-tabs.onsite.onsite-preferences', array('camp' => $camp, 'feedbackResponseData' => $feedbackResponseData, 'brandboostData' => $brandboostData, 'bbProductsData' => $productsData))
        <!--########################TAB 4 ##########################-->
		@include('admin.brandboost.campaign-tabs.onsite.onsite-workflow-campaign-beta', array('emailWorkflow' => $emailWorkflow, 'subscribersData' => $subscribersData, 'oEvents' => $oEvents))
        <!--########################TAB 5 ##########################--> 
		@include('admin.brandboost.campaign-tabs.onsite.onsite-image', array('aReviews' => $aReviews, 'imageClass' => $imageClass))
	</div>
    
</div>	

@include('admin.brandboost.campaign-tabs.onsite.onsite-popup')
<?php //$this->load->view("admin/modals/workflow2/workflow-popup", array('oDefaultTemplates' => $oDefaultTemplates)); @include('admin.modals.workflow2.workflow-popup', array('oDefaultTemplates' => $oDefaultTemplates)) ?>
<?php 
 $oDefaultTemplates = !(empty($oDefaultTemplates)) ? $oDefaultTemplates : array();
?>
@include('admin.modals.workflow2.workflow-popup', ['oDefaultTemplates' => $oDefaultTemplates])


<script type="text/javascript">

    $(document).ready(function () {

        $(document).on('change', '.autoSave', function() {
            $('.saveOnsiteButton').trigger('click');
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

        $(document).on("click", "#campaignUserStepBug", function () {
            alertMessage('There should be atleast one email or sms in each container');
        });

        $(document).on("click", "#sendPreviewEmail", function () {
            var email = $("#email").val();
            var emailtemplate = $(".emailPreviewContent").html();
            $('.overlaynew').show();
            $.ajax({
                url: '<?php echo base_url('admin/emailtemplate/send_email_template'); ?>',
                type: "POST",
                data: {email: email, emailtemplate: emailtemplate, bb_id: '<?php echo $brandboostData->id; ?>', _token: '{{csrf_token()}}'},
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
                data: {phoneNo: phoneNo, smstemplate: smstemplate, bb_id: '<?php echo $brandboostData->id; ?>', _token: '{{csrf_token()}}'},
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

        $(document).on('click', '.onSiteCampaignStatus', function() {

            var status = $(this).attr('status');
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/publishOnsiteStatusBB'); ?>',
                type: "POST",
                data: {'brandboostID': '<?php echo $brandboostData->id; ?>', 'status':status, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        //window.location.href = '<?php echo base_url('admin/brandboost/onsite'); ?>';
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
                    data: {'action': 'publishCampaign', 'brandboostID': '<?php echo $brandboostData->id; ?>', 'status':'1', _token: '{{csrf_token()}}'},
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
                    data: {'action': 'publishCampaign', 'brandboostID': '<?php echo $brandboostData->id; ?>', 'status':'0', _token: '{{csrf_token()}}'},
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

        $(document).on("click", "#publishCampaign", function () {
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/publishOnsiteBB'); ?>',
                type: "POST",
                data: {'action': 'publishCampaign', 'brandboostID': '<?php echo $brandboostData->id; ?>', _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = '<?php echo base_url('admin/brandboost/onsite'); ?>';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        });

        $(document).on('click', '.tabChange', function() {
            var tabName = $(this).attr('tabName');
            if (tabName == 'Reviews') {
                $('.reviewShow').removeClass('hidden');
            }
            else {
                $('.reviewShow').addClass('hidden');
            }
            if (tabName == 'Clients') {
                $('.contactShow').removeClass('hidden');
            }
            else {
                $('.contactShow').addClass('hidden');
            }
            changeTabWithoutReload(tabName);
        });


        $("#addOnsiteStepList").submit(function (e) {

            e.preventDefault();
            var email = $("#from_email").val();
            var fromName = $("#from_name").val();
            if ($.trim(fromName) == '') {
                $("#from_name").focus();
                $("#from_name").next('.errorMsg').html('<p style="color:red">Please enter from name.</p>');
                return false;
            } else {
                $("#from_name").next('.errorMsg').html('');
            }


            var bValid = validateEmail(email);
            if (bValid == false) {
                $("#from_email").focus();
                //alertMessage('Please enter valid email address');
                $("#from_email").next('.errorMsg').html('<p style="color:red">Please enter valid email address.</p>');
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
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/saveOnsitePreferences'); ?>',
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
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
            return false;
        });


        $("#frmFeedbackTagListModal").submit(function () {
            var formdata = $("#frmFeedbackTagListModal").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/tags/applyFeedbackTag'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {

                        //Display tag list
                        alertMessageAndRedirect("Selected tags applied successfully!", window.location.href);
                    }
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
                data: {camp_id: camp_id, camp_temp_src: camp_temp_src, _token: '{{csrf_token()}}'},
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

        $("#nav-tabs-bottom li").on('click', function () {

            var getActiveText = $(this).text();
            $.ajax({
                url: "<?php echo base_url('/admin/brandboost/setTab'); ?>",
                type: "POST",
                data: {getActiveText: getActiveText, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (response) {
                    if (response.status == 'error') {
                        window.location.href = "/admin/brandboost/onsite/";
                    }
                },
                error: function (response) {
                    alertMessage("Something went wrong");
                }
            });
        });

        var fromPreviewEmail = '';
        $(document).on("click", ".emailPreviewButton", function () {
            fromPreviewEmail = $(this).attr('from_email');
            $(".emailPreviewContent").html($('#previewContent_' + $(this).attr('email_preview')).html());
            $("#emailPreviewPopup").modal();
        });

        $(document).on("click", ".smsPreviewButton", function () {
            $(".smsPreviewContent").html($('#previewContent_' + $(this).attr('email_preview')).html());
            $("#smsPreviewPopupPrimary").modal("show");
        });

        $(document).on("click", ".previewSms", function () {
            $('.overlaynew').show();
            var templateContent = $("#template_content").val();
            $.ajax({
                url: '<?php echo base_url('admin/emailtemplate/emailPreviewTemplate'); ?>',
                type: "POST",
                data: {emailtemplate: templateContent, _token: '{{csrf_token()}}'},
                dataType: "html",
                success: function (data) {
                    if (data) {
                        $('.overlaynew').hide();
                        $('.smsPreviewContent').html(data);
                        $("#previewSmsPopup").modal("show");
                    } else {
                        $('.overlaynew').hide();
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
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

        $(document).on("click", ".cancle_popup", function () {
            $('.close').trigger('click');
        });

        $(document).on("click", ".previewEmail", function () {
            $('.overlaynew').show();
            var templateContent = $("#template_content").val();
            $.ajax({
                url: '<?php echo base_url('admin/emailtemplate/emailPreviewTemplate'); ?>',
                type: "POST",
                data: {emailtemplate: templateContent, _token: '{{csrf_token()}}'},
                dataType: "html",
                success: function (data) {
                    if (data) {
                        $('.overlaynew').hide();
                        $('.emailPreviewContent').html(data);
                        $("#previewEmailPopup").modal();
                    } else {
                        $('.overlaynew').hide();
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        });

        $("#updateCampaignData").submit(function () {

            $('.padding_class').show();
            move();
            var templateName = $("#template_name").val();
            var templateSubject = $("#template_subject").val();
            var fromName = $("#from_name").val();
            var fromEmail = $("#from_email").val();
            var replyTo = $("#reply_to").val();
            var templateContent = $("#template_content").val();
            var templateId = $("#template_id").val();
            var campaignId = $("#campaign_id").val();
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/update_campaign'); ?>',
                type: "POST",
                data: {template_name: templateName, template_subject: templateSubject, from_name: fromName, from_email: fromEmail, reply_to: replyTo, template_content: templateContent, template_id: templateId, campaign_id: campaignId, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        setTimeout(function () {
                            window.location.href = '<?php echo base_url('admin/brandboost/offsite_step_2'); ?>';
                        }, 1000);
                    } else {
                        alert('Error: Some thing wrong!');
                        setTimeout(function () {
                            window.location.href = window.location.href;
                        }, 1000);
                    }
                }
            });
        });


        $(document).on("click", ".previewEmail", function () {
            $('.overlaynew').show();
            var templateContent = $("#template_content").val();
            $.ajax({
                url: '<?php echo base_url('admin/emailtemplate/emailPreviewTemplate'); ?>',
                type: "POST",
                data: {emailtemplate: templateContent, _token: '{{csrf_token()}}'},
                dataType: "html",
                success: function (data) {
                    if (data) {
                        $('.overlaynew').hide();
                        $('.emailPreviewContent').html(data);
                        $("#previewEmailPopup").modal();
                    } else {
                        $('.overlaynew').hide();
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        });

        $("#updateCampaignData").submit(function () {

            $('.padding_class').show();
            $('.overlaynew').show();
            move();
            var formdata = $("#updateCampaignData").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/update_campaign'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        setTimeout(function () {
                            $('.overlaynew').hide();
                            window.location.href = '<?php echo base_url('admin/brandboost/offsite_step_2'); ?>';
                        }, 1000);
                    } else {
                        alert('Error: Some thing wrong!');
                    }
                }
            });
        });


        $(".viewstats").click(function () {
            var campaignID = $(this).attr("campaign_id");
            $('.overlaynew').show();
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/getSendgridStats'); ?>',
                type: "POST",
                data: {'type': 'campaign', 'id': campaignID, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.emailstatsdata').html(data.content);
                        $('.overlaynew').hide();
                        $("#emailstats-modal").modal("show");
                    } else {
                        alert('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });

      
    });

    function changeTabWithoutReload(getActiveText) {
        $.ajax({
            url: "<?php echo base_url('/admin/brandboost/setTab'); ?>",
            type: "POST",
            data: {getActiveText: getActiveText, _token: '{{csrf_token()}}'},
            dataType: "json",
            success: function (response) {
                //window.location.href = window.location.href;
            },
            error: function (response) {
                alertMessage("Something went wrong");
            }
        });
    }

    function move() {
        var elem = document.getElementById("myBar");
        var width = 1;
        var id = setInterval(frame, 10);
        function frame() {
            if (width >= 100) {
                clearInterval(id);
            } else {
                width++;
                elem.style.width = width + '%';
            }
        }
    }

    function validateEmail(emailField) {
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (filter.test(emailField)) {
            return true;
        } else {
            return false;
        }
    }

    function add_campaign(campaignType, eventID, eventype = 'main') {
        $('.overlaynew').show();
        $.ajax({
            url: '<?php echo base_url('admin/brandboost/create_campaign'); ?>',
            type: "POST",
            data: {'campaign_type': campaignType, 'event_id': eventID, 'event_type': eventype, 'brandboost_type': 'onsite', _token: '{{csrf_token()}}'},
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

    function delete_campaign(eventID) {
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
                            url: '<?php echo base_url('admin/brandboost/delete_event'); ?>',
                            type: "POST",
                            data: {'event_id': eventID, _token: '{{csrf_token()}}'},
                            dataType: "json",
                            success: function (data) {
                                //console.log(data);
                                if (data.status == 'success') {
                                    setTimeout(function () {
                                        window.location.href = window.location.href;
                                    }, 1000);
                                } else {
                                    alertMessage('Error: Some thing wrong!');
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
                data: {'event_id': eventID, _token: '{{csrf_token()}}'},
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

</script>
@endsection