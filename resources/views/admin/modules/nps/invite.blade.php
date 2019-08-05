<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/uploaders/dropzone.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/uploader_dropzone.js"></script>
<!-- Content area -->
<div class="content">

    <!-- Dashboard content -->
    <div class="row">
        <div class="col-lg-12">
            <!-- Marketing campaigns -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h3 class="panel-title">Invite One Advocate</h3>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>

                        </ul>
                    </div>
                </div>
                <div class="panel-body">

                    <form name="frmInviteCustomer" id="frmInviteCustomer" method="post" action="" >
                        <input type="hidden" name="userid" value="<?php echo $userID; ?>" />
                        <input type="hidden" name="bbaid" value="<?php echo $oSettings->hashcode; ?>" />
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
                                    <input name="phone" id="phone" value="" class="form-control" type="text" required="">
                                </div>
                            </div>

                            <button class="btn btn-success pull-right" id="btnInvite" type="submit">
                                Invite Advocates
                            </button>

                        </div>
                    </form>

                </div>

                <div class="panel-heading">
                    <h3 class="panel-title">Invite Bulk advocates</h3>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>

                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <form name="frmInviteBulkCustomer" id="frmInviteBulkCustomer"  method="post" action="" enctype="multipart/form-data" >
                        <input type="hidden" name="userid" value="<?php echo $userID; ?>" />
                        <input type="hidden" name="bbaid" value="<?php echo $oSettings->hashcode; ?>" />

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
                            Import Advocates
                        </button>



                    </form>
                </div>



            </div>
            <!-- <div align="right" id="pagination_link"></div> -->
        </div>
    </div>


</div>
<!-- /content area -->







<script>
    $(document).ready(function () {

        $("#frmInviteCustomer").submit(function () {

            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $('#btnInvite').prop("disabled", true);
            $.ajax({
                url: '<?php echo base_url('admin/modules/referral/registerInvite'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    $('.overlaynew').hide();
                    if (data.status == 'success') {

                        alertMessageAndRedirect('Advocated has been invited successfully.', window.location.href);

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
                url: '<?php echo base_url('admin/modules/referral/importInviteCSV'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {

                        alertMessageAndRedirect('Advocated has been invited successfully.', window.location.href);

                    } else {

                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
            return false;
        });










    });
</script>		
