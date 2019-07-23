<?php

if (!empty($oAutomationLists)) {
    foreach ($oAutomationLists as $oAutomationList) {
        $aListIDs[] = $oAutomationList->list_id;
    }
}
?>
<div id="broadcastTargetAudience" class="broadcastTab" <?php if ($activeTab != 'Select List'): ?> style="display:none;"<?php endif; ?>>
    <div style="width: 100%; max-width: 1100px; margin: 0 auto;<?php if (!empty($activeTab) || !empty($oBroadcast->audience_type)): ?>display:none;<?php endif; ?>" id="audienceSelectionContainer" >
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="text-center pt40 pb30">
                    <p class="fsize16 fw500 txt_dark">Select contacts for this broadcast</p>
                    <p class="fsize14 fw300 txt_grey">Choose how you want to import contacts into the broadcast.</p>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <label for="temp1" class="m0">
                    <div class="broadcast_select_contact">
                        <label class="custmo_checkbox">
                            <input type="radio" id="temp1" value="lists" class="choose_audience" name="audience_type" <?php if ($oBroadcast->audience_type == 'lists'): ?>checked="checked"<?php endif; ?>>
                            <span class="custmo_checkmark blue_tr"></span>
                        </label>
                        <div class="img_box">
                            <img src="<?php echo base_url(); ?>assets/images/contact_list_act.png"/>
                        </div>
                        <p class="fsize14 txt_dark fw500">Contact List</p>
                        <p class="fsize12 txt_grey fw300">Select one or more of the pre-prepared contact lists. You can create a new list of contacts in the “People” module.</p>
                    </div>
                </label>
            </div>
            <div class="col-md-4 text-center">
                <label for="temp2" class="m0">
                    <div class="broadcast_select_contact">
                        <label class="custmo_checkbox">
                            <input type="radio" id="temp2" value="tags" class="choose_audience" name="audience_type" <?php if ($oBroadcast->audience_type == 'tags'): ?>checked="checked"<?php endif; ?>>
                            <span class="custmo_checkmark blue_tr"></span>
                        </label>
                        <div class="img_box">
                            <img src="<?php echo base_url(); ?>assets/images/tags_grey.png"/>
                        </div>
                        <p class="fsize14 txt_dark fw500">Tags</p>
                        <p class="fsize12 txt_grey fw300">Select all contacts that match a specific tag or group of tags.</p>
                    </div>
                </label>
            </div>
            <div class="col-md-4 text-center">
                <label for="temp3" class="m0">
                    <div class="broadcast_select_contact">
                        <label class="custmo_checkbox">
                            <input type="radio" id="temp3" value="contacts" class="choose_audience" name="audience_type" <?php if ($oBroadcast->audience_type == 'contacts'): ?>checked="checked"<?php endif; ?>>
                            <span class="custmo_checkmark blue_tr"></span>
                        </label>
                        <div class="img_box">
                            <img src="<?php echo base_url(); ?>assets/images/contact_list2_inactive.png"/>
                        </div>
                        <p class="fsize14 txt_dark fw500">Contacts</p>
                        <p class="fsize12 txt_grey fw300">Choose from all available contacts. The list of contacts will be created automatically based on this broadcast.</p>
                    </div>
                </label>
            </div>


        </div>



    </div>
    <?php //$this->load->view("admin/components/smart-popup/smart-contact-widget"); ?>
    
    <?php $this->load->view("admin/components/smart-popup/smart-broadcast-audience-widget"); ?>
    
    <?php $this->load->view("admin/broadcast/partials/contact_selection"); ?>

    <?php //$this->load->view("admin/broadcast/partials/list_selection"); ?>

    <?php //$this->load->view("admin/broadcast/partials/contact_selection"); ?>

    <?php //$this->load->view("admin/broadcast/partials/tag_selection"); ?>

</div>

<div id="editlistModel" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="frmeditlistModel" name="frmeditlistModel">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Edit Contact List</h5>
                </div>
                <div class="modal-body" style="padding-bottom:0px;">
                    <p>List Title:</p>
                    <input class="form-control" id="edit_title" name="title" placeholder="Enter List Name" type="text" required><br>
                    <div id="editlistValidation" style="color:#FF0000;display:none;"></div>
                </div>
                <div class="modal-body" style="padding-top:0px;">
                    <p>List Description:</p>
                    <textarea class="form-control" id="edit_description" name="edit_description"></textarea>
                </div>
                <hr>
                <div class="modal-footer">
                    <input type="hidden" name="list_id" id="hidlistid" value="" />
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- addBrandboost -->
<div id="addListModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="frmaddListModal" id="frmaddListModal" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Add Team Role</h5>
                </div>

                <div class="modal-body">
                    <p>List Name:</p>
                    <input class="form-control" id="title" name="title" placeholder="Enter List Name" type="text" required><br>
                    <div id="addListValidation" style="color:#FF0000;display:none;"></div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /addBrandboost -->

<div id="addSubscriber" class="modal fade">
    <div class="modal-dialog">

        <div class="modal-content">
            <form method="post" class="form-horizontal" id="addSubscriberData" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Add Subscriber</h5>
                </div>
                <div class="modal-body">

                    <div class="alert-danger" style="margin-bottom:10px;"><?php echo $this->session->userdata('error_message'); ?>
                        <?php echo validation_errors(); ?></div>

                    <div class="col-md-12">

                        <div class="form-group">
                            <label class="control-label">First Name</label>
                            <div class="">
                                <input name="firstname" id="firstname" class="form-control" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Last Name</label>
                            <div class="">
                                <input name="lastname" id="lastname" class="form-control" value="" type="text" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <div class="">
                                <input name="email" id="email" value="" class="form-control" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Phone</label>
                            <div class="">
                                <input name="phone" id="phone" value="" class="form-control" type="text" required>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="listId" id="sub_list_id" value="">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" id="updateButton" class="btn btn-primary"><i class="icon-check"></i> Add</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="importCSV" class="modal modalpopup fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal" action="<?php echo base_url() ?>admin/lists/importListCSV" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Import Contacts CSV</h5>
                </div>
                <div class="modal-body">

                    <div class="alert-danger" style="margin-bottom:10px;"><?php echo $this->session->userdata('error_message'); ?>
                        <?php echo validation_errors(); ?></div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Import CSV</label>
                        <div class="col-lg-9">
                            <input type="file" name="userfile" style="margin-top:3px;" accept=".csv, application/vnd.ms-excel" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="list_id" id="import_list_id" value="">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Import</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function () {


        $(".selectAudience").click(function () {
            resetAudienceContainers();
        });

        function resetAudienceContainers() {
            $("#audienceSelectionContainer").show();
            $("#listSection").hide();
            $("#tagSection").hide();
            $("#contactSection").hide();
            $(".contactSection").hide();
        }

        $(".choose_audience").change(function () {
            var audience_type = $(this).val();
            $('.overlaynew').show();
            $.ajax({
                url: '<?php echo base_url('admin/broadcast/updateBroadcastData'); ?>',
                type: "POST",
                data: {broadcast_id: '<?php echo $oBroadcast->broadcast_id; ?>', audience_type: audience_type},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        resetAudienceContainers();
                        $("#audienceSelectionContainer").hide();
                        $(".contactSection").show();
                        /*if (audience_type == 'lists') {
                            $("#listSection").show();
                        } else if (audience_type == 'tags') {
                            $("#tagSection").show();
                        } else if (audience_type == 'contacts') {
                            $("#contactSection").show();
                        } else {

                        }*/

                    } else if (data.status == 'error') {
                        $('.overlaynew').hide();

                    }

                }
            });
        });

        $(".importContact").click(function () {
            var listID = $(this).attr("list_id");
            $("#import_list_id").val(listID);
            $("#importCSV").modal();
        });

        $(".addContact").click(function () {
            var listID = $(this).attr("list_id");
            $("#sub_list_id").val(listID);
            $("#addSubscriber").modal();
        });

        $('#addList').click(function () {
            $('#addListModal').modal();
        });

        $(document).on('click', '.continueListButton', function () {
            var numberOfChecked = $('.updateList:checkbox:checked').length;
            if (numberOfChecked < 1) {
                alertMessage('Please select list item.');
            } else {
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
            }
            return false;
        });

        $('#frmaddListModal').on('submit', function () {
            $('.overlaynew').show();
            var formdata = $("#frmaddListModal").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/lists/addList'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        $('#addListModal').modal('hide');
                        window.location.href = window.location.href;
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
        
        
               
        $(document).on('click', '.syncContacts', function () {
            var segmentID = $(this).attr('segment_id');
            $('.overlaynew').show();
            $.ajax({
                url: '<?php echo base_url('admin/broadcast/syncSegment'); ?>',
                type: "POST",
                data: {segmentID: segmentID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        displayMessagePopup('sccess', '', 'Segment contacts have been synced successfully!');
                        //window.location.href = '';
                    } else {
                        $('.overlaynew').hide();
                        displayMessagePopup('error', '', 'Some thing wrong!');
                    }
                }, error: function () {
                    $('.overlaynew').hide();
                    displayMessagePopup('error', '', 'Some thing wrong!');
                }
            });
        });

        $(document).on('click', '.deleteSegment', function () {
            var elem = $(this);

            deleteConfirmationPopup(
                    "This record will deleted immediately.<br>You can't undo this action.",
                    function () {
                        $('.overlaynew').show();
                        var segmentID = $(elem).attr('segment_id');
                        $.ajax({
                            url: '<?php echo base_url('admin/broadcast/deleteSegment'); ?>',
                            type: "POST",
                            data: {segmentID: segmentID},
                            dataType: "json",
                            success: function (data) {
                                if (data.status == 'success') {
                                    $('.overlaynew').hide();
                                    window.location.href = window.location.href;
                                }
                            }
                        });
                    });

        });


        
        
        

        $(document).on("click", ".editlist", function () {
            var listID = $(this).attr('list_id');
            $.ajax({
                url: '<?php echo base_url('admin/lists/getList'); ?>',
                type: "POST",
                data: {'list_id': listID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#edit_title").val(data.title);
                        $("#edit_description").val(data.description);
                        $("#hidlistid").val(listID);
                        $("#editlistModel").modal();
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        });

        $('#frmeditlistModel').on('submit', function () {
            $('.overlaynew').show();
            var formdata = $("#frmeditlistModel").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/lists/updateList'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        $("#editlistModel").modal('hide');
                        window.location.href = window.location.href;
                    } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                        $("#editlistValidation").html(data.msg).show();
                        setTimeout(function () {
                            $("#editlistValidation").html("").hide();
                        }, 5000);
                    }
                }
            });
            return false;
        });


        $("#addSubscriberData").submit(function () {
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo base_url('admin/lists/addListSusbscriber'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#addSubscriber").modal('hide');
                        window.location.href = window.location.href;
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });

        $(document).on('click', '.deletelist', function () {
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
                            var listID = $(elem).attr('list_id');
                            $.ajax({
                                url: '<?php echo base_url('admin/lists/deleteLists'); ?>',
                                type: "POST",
                                data: {list_id: listID},
                                dataType: "json",
                                success: function (data) {
                                    if (data.status == 'success') {
                                        $('.overlaynew').hide();
                                        window.location.href = window.location.href;
                                    }
                                }
                            });
                        }
                    });
        });


    });

</script>
