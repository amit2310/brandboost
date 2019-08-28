@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')
<?php

if ($selected_tab == 'contact') {
    $contactStatus = 'active';
    $aData['contactStatus'] = $contactStatus;
} else if ($selected_tab == 'request') {
    $requestStatus = 'active';
    $aData['requestStatus'] = $requestStatus;
} else if ($selected_tab == 'response') {
    $responseStatus = 'active';
    $aData['responseStatus'] = $responseStatus;
} else if ($selected_tab == 'pending') {
    $pendinngStatus = 'active';
    $aData['pendinngStatus'] = $pendinngStatus;
} else {
    $contactStatus = 'active';
    $aData['contactStatus'] = $contactStatus;
}

?>
<div class="content">
    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-6">
                <h3><i class="icon-vcard"></i> &nbsp; Onsite Brand Boost Campaign : <?php echo ucfirst($aData['oBrandboost'][0]->brand_title); ?></h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="<?php echo $contactStatus; ?>"><a href="#right-icon-tab1" data-toggle="tab"> Contacts</a></li>
                    <li class="<?php echo $requestStatus; ?>"><a href="#right-icon-tab2" data-toggle="tab"> Review Requests</a></li>
                    <li class="<?php echo $responseStatus; ?>"><a href="#right-icon-tab3" data-toggle="tab"> Responses</a></li>
                    <li class="<?php echo $pendinngStatus; ?>"><a href="#right-icon-tab4" data-toggle="tab"> Pending</a></li>
                </ul>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-6 text-right btn_area">
                <button type="button" class="btn light_btn importModuleContact" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $moduleUnitID ?>" data-redirect="<?php echo base_url(); ?>admin/brandboost/stats/onsite/<?php echo $moduleUnitID; ?>?t=contact"><i class="icon-arrow-up16"></i><span> &nbsp;  Import Contact</span> </button>
                <a class="btn light_btn ml10" href="{{ base_url() }}admin/subscriber/exportSubscriberCSV?module_name=<?php echo $moduleName; ?>&module_account_id=<?php echo $moduleUnitID; ?>"><i class="icon-arrow-down16"></i><span> &nbsp;  Export Contact</span> </a>
                <button type="button" class="btn dark_btn dropdown-toggle ml10 addModuleContact" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $moduleUnitID ?>"><i class="icon-plus3"></i><span> &nbsp;  Add Contact</span> </button>  
            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->

    <div class="tab-content">
        <!--########################TAB 1 ##########################-->
        @include("admin.brandboost.stats.stats-tabs.onsite-contacts", $aData)
        <!--########################TAB 2 ##########################-->
        @include("admin.brandboost.stats.stats-tabs.onsite-request", $aData)
        <!--########################TAB 3 ##########################-->
        @include("admin.brandboost.stats.stats-tabs.onsite-response", $aData)
        <!--########################TAB 4 ##########################-->
        @include("admin.brandboost.stats.stats-tabs.onsite-pending", $aData)
    </div>

</div>

<script type="text/javascript">

    $(document).ready(function () {

        $('#checkAll').change(function () {
            if (false == $(this).prop("checked")) {
                $(".checkRows").prop('checked', false);
                $(".selectedClass").removeClass('success');
                $('.custom_action_box').hide();
            } else {
                $(".checkRows").prop('checked', true);
                $(".selectedClass").addClass('success');
                $('.custom_action_box').show();
            }
        });

        $(document).on('click', '.checkRows', function () {
            var inc = 0;
            var rowId = $(this).val();

            if (false == $(this).prop("checked")) {
                $('#append-' + rowId).removeClass('success');
            } else {
                $('#append-' + rowId).addClass('success');
            }

            $('.checkRows:checkbox:checked').each(function (i) {
                inc++;
            });
            if (inc == 0) {

                $('.custom_action_box').hide();
            } else {
                $('.custom_action_box').show();
            }

            var numberOfChecked = $('.checkRows:checkbox:checked').length;
            var totalCheckboxes = $('.checkRows:checkbox').length;
            if (totalCheckboxes > numberOfChecked) {
                $('#checkAll').prop('checked', false);
            }
        });

        $(document).on('click', '#deleteButtonOnsiteContact', function () {

            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                var elem = $(this);
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
                                    url: '<?php echo base_url('admin/brandboost/delete_multipal_subscriber'); ?>',
                                    type: "POST",
                                    data: {multiSubscriberId: val},
                                    dataType: "json",
                                    success: function (data) {
                                        if (data.status == 'success') {
                                            window.location.href = '';
                                        } else {
                                            alertMessage('Error: Some thing wrong!');
                                            $('.overlaynew').hide();
                                        }
                                    }
                                });
                            }
                        });
            }
        });

        /*----------------------------------------*/

        $('#checkAll-request').change(function () {

            if (false == $(this).prop("checked")) {
                $(".checkRows-request").prop('checked', false);
                $(".selectedClass").removeClass('success');
                $('.custom_action_box_request').hide();
            } else {
                $(".checkRows-request").prop('checked', true);
                $(".selectedClass").addClass('success');
                $('.custom_action_box_request').show();
            }
        });

        $(document).on('click', '.checkRows-request', function () {
            var inc = 0;
            var rowId = $(this).val();
            if (false == $(this).prop("checked")) {
                $('#append-request-' + rowId).removeClass('success');
            } else {
                $('#append-request-' + rowId).addClass('success');
            }

            $('.checkRows-request:checkbox:checked').each(function (i) {
                inc++;
            });

            if (inc == 0) {
                $('.custom_action_box_request').hide();
            } else {
                $('.custom_action_box_request').show();
            }

            var numberOfChecked = $('.checkRows-request:checkbox:checked').length;
            var totalCheckboxes = $('.checkRows-request:checkbox').length;
            if (totalCheckboxes > numberOfChecked) {
                $('#checkAll-request').prop('checked', false);
            }
        });

        $(document).on('click', '#deleteCampaignRequest', function () {

            var val = [];
            $('.checkRows-request:checkbox:checked').each(function (i) {
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
                                $.ajax({
                                    url: '<?php echo base_url('admin/brandboost/deleteReviewRequest'); ?>',
                                    type: "POST",
                                    data: {multipal_id: val},
                                    dataType: "json",
                                    success: function (data) {
                                        if (data.status == 'success') {
                                            window.location.href = window.location.href
                                        } else {
                                            alertMessage('Error: Some thing wrong!');
                                            $('.overlaynew').hide();
                                        }
                                    }
                                });
                            }
                        });
            }
        });

        /*----------------------------------------*/


        /*-----------------response-----------------------*/

        $('#checkAll-response').change(function () {

            if (false == $(this).prop("checked")) {
                $(".checkRows-response").prop('checked', false);
                $(".selectedClass").removeClass('success');
                $('.custom_action_box_response').hide();
            } else {
                $(".checkRows-response").prop('checked', true);
                $(".selectedClass").addClass('success');
                $('.custom_action_box_response').show();
            }
        });

        $(document).on('click', '.checkRows-response', function () {
            var inc = 0;
            var rowId = $(this).val();
            if (false == $(this).prop("checked")) {
                $('#append-response-' + rowId).removeClass('success');
            } else {
                $('#append-response-' + rowId).addClass('success');
            }

            $('.checkRows-response:checkbox:checked').each(function (i) {
                inc++;
            });

            if (inc == 0) {
                $('.custom_action_box_response').hide();
            } else {
                $('.custom_action_box_response').show();
            }

            var numberOfChecked = $('.checkRows-response:checkbox:checked').length;
            var totalCheckboxes = $('.checkRows-response:checkbox').length;
            if (totalCheckboxes > numberOfChecked) {
                $('#checkAll-response').prop('checked', false);
            }
        });

        $(document).on('click', '#deleteCampaignResponse', function () {

            var val = [];
            $('.checkRows-response:checkbox:checked').each(function (i) {
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
                                $.ajax({
                                    url: '<?php echo base_url('admin/brandboost/deleteCampaignResponse'); ?>',
                                    type: "POST",
                                    data: {multipal_id: val},
                                    dataType: "json",
                                    success: function (data) {
                                        if (data.status == 'success') {
                                            window.location.href = window.location.href
                                        } else {
                                            alertMessage('Error: Some thing wrong!');
                                            $('.overlaynew').hide();
                                        }
                                    }
                                });
                            }
                        });
            }
        });

        /*----------------------------------------*/

        /*-----------------pending-----------------------*/

        $('#checkAll-pending').change(function () {

            if (false == $(this).prop("checked")) {
                $(".checkRows-pending").prop('checked', false);
                $(".selectedClass").removeClass('success');
                $('.custom_action_box_pending').hide();
            } else {
                $(".checkRows-pending").prop('checked', true);
                $(".selectedClass").addClass('success');
                $('.custom_action_box_pending').show();
            }
        });

        $(document).on('click', '.checkRows-pending', function () {
            var inc = 0;
            var rowId = $(this).val();
            if (false == $(this).prop("checked")) {
                $('#append-pending-' + rowId).removeClass('success');
            } else {
                $('#append-pending-' + rowId).addClass('success');
            }

            $('.checkRows-pending:checkbox:checked').each(function (i) {
                inc++;
            });

            if (inc == 0) {
                $('.custom_action_box_pending').hide();
            } else {
                $('.custom_action_box_pending').show();
            }

            var numberOfChecked = $('.checkRows-pending:checkbox:checked').length;
            var totalCheckboxes = $('.checkRows-pending:checkbox').length;
            if (totalCheckboxes > numberOfChecked) {
                $('#checkAll-pending').prop('checked', false);
            }
        });

        $(document).on('click', '#deleteCampaignPending', function () {
            var val = [];
            $('.checkRows-pending:checkbox:checked').each(function (i) {
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
                                $.ajax({
                                    url: '<?php echo base_url('admin/brandboost/deleteCampaignResponse'); ?>',
                                    type: "POST",
                                    data: {multipal_id: val},
                                    dataType: "json",
                                    success: function (data) {
                                        if (data.status == 'success') {
                                            window.location.href = window.location.href
                                        } else {
                                            alertMessage('Error: Some thing wrong!');
                                            $('.overlaynew').hide();
                                        }
                                    }
                                });
                            }
                        });
            }
        });

        /*----------------------------------------*/

        $(document).on('click', '.campaignResponseDel', function () {
            var campaignResponseDel = $(this).attr('campaign_response_id');
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
                                url: '<?php echo base_url('admin/brandboost/campaignResponseDel'); ?>',
                                type: "POST",
                                data: {campaign_response_id: campaignResponseDel},
                                dataType: "json",
                                success: function (data) {
                                    if (data.status == 'success') {
                                        window.location.href = window.location.href
                                    } else {
                                        alertMessage('Error: Some thing wrong!');
                                        $('.overlaynew').hide();
                                    }
                                }
                            });
                        }
                    });
        });

        $("#addSubscriberData").submit(function () {
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/add_subscriber'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = '';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });

        $(document).on('click', '.editSubscriber', function () {
            var subscriberID = $(this).attr('subscriberid');
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/getSubscriberById'); ?>',
                type: "POST",
                data: {subscriberID: subscriberID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        var subData = data.result[0];
                        $('#edit_firstname').val(subData.firstname);
                        $('#edit_lastname').val(subData.lastname);
                        $('#edit_email').val(subData.email);
                        $('#edit_phone').val(subData.phone);
                        $('#edit_subscriberID').val(subData.id);
                        $("#editSubscriberModal").modal();
                    }
                }
            });
        });

        $("#updateSubscriberData").submit(function () {
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/update_subscriber'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = '';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });

        $(document).on('click', '.deleteSubscriber', function () {
            var subscriberID = $(this).attr('subscriberid');
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
                                url: '<?php echo base_url('admin/brandboost/delete_subscriber'); ?>',
                                type: "POST",
                                data: {subscriberId: subscriberID},
                                dataType: "json",
                                success: function (data) {
                                    if (data.status == 'success') {

                                        window.location.href = '';
                                    } else {

                                        alertMessage('Error: Some thing wrong!');
                                        $('.overlaynew').hide();
                                    }
                                }
                            });
                        } else {
                            $('.overlaynew').hide();
                        }
                    });
        });

        $(document).on('click', '.unSubscribeUAC', function () {
            $('.overlaynew').show();
            var subscriberEmail = $(this).attr('subscriberemail');
            var subscriberid = $(this).attr('subscriberid');

            $.ajax({
                url: '<?php echo base_url('admin/brandboost/unsubscriber_user'); ?>',
                type: "POST",
                data: {subscriber_email: subscriberEmail, subscriberid: subscriberid},
                dataType: "json",
                success: function (data) {
                    $('.overlaynew').hide();
                    if (data.status == 'success') {
                        window.location.href = '';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        });

        $(document).on('click', '.chg_status', function () {
            $('.overlaynew').show();
            var status = $(this).attr('change_status');
            var subscriberId = $(this).attr('subscriberId');

            $.ajax({
                url: '<?php echo base_url('admin/brandboost/update_subscriber_status'); ?>',
                type: "POST",
                data: {status: status, subscriber_id: subscriberId},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = '';
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



