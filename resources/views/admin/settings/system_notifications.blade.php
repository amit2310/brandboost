<div class="content">
    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-7">
                <h3><i class="icon-star-half"></i> &nbsp;<?php echo $title; ?></h3>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-5 text-right btn_area">
                <button type="button" class="btn light_btn" data-toggle="modal" data-target="#addSystemNotificationTemplate"><i class="icon-arrow-up16"></i><span> &nbsp;  Add System Notification</span> </button>
                <button type="button" class="btn light_btn" data-toggle="modal" data-target="#addSystemNotificationTemplate"><i class="icon-arrow-up16"></i><span> &nbsp;  Add Email Notification</span> </button>


            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->

    <div class="tab-content">
        <div class="row">
            <div class="col-md-12">
                <div style="margin: 0;" class="panel panel-flat">
                    <div class="panel-heading"> <span class="pull-left">
                            <h6 class="panel-title"><?php echo count($oTemplates); ?> Templates</h6>
                        </span>
                        <div class="heading-elements">
                            <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                <div class="form-control-feedback"> <i class="icon-search4"></i> </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body p0">
                        <table class="table datatable-basic datatable-sorting">
                            <thead>
                                <tr>
                                    <th style="display:none;"></th>
                                    <th style="display:none;"></th>
                                    <th><i class="icon-user"></i> Title</th>
                                    <th><i class="icon-user"></i> Event Name</th>
                                    <th width="300"><i class="icon-iphone"></i> Language</th>
                                    <th width="300"><i class="icon-iphone"></i> Admin Language</th>
                                    <th><i class="icon-calendar"></i> Created</th>
                                    <th class="text-center"><i class="fa fa-dot-circle-o"></i> Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <!--=======================-->
                                <?php foreach ($oTemplates as $oTemplate) { ?>
                                    <tr>
                                        <td style="display:none;"></td>
                                        <td style="display:none;"></td>
                                        <td>
                                            <?php echo $oTemplate->title; ?>
                                        </td>
                                        
                                        <td>
                                            <?php echo $oTemplate->template_tag; ?>
                                        </td>

                                        <td>
                                            <?php echo $oTemplate->tag_language; ?>
                                        </td>

                                        <td>
                                            <?php echo $oTemplate->tag_language_admin; ?>
                                        </td>

                                        <td>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><?php echo date('d M Y', strtotime($oTemplate->created)); ?></a></div>
                                                <div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oTemplate->created)); ?></div>
                                            </div>

                                        </td>
                                        <td style="text-align: center;">
                                            <a class="btn green_cust_btn editSystemNotificationTemplate"  template_id="<?php echo $oTemplate->id; ?>"><i class="fa fa-eye"></i></a>
                                            <?php if($oTemplate->write_permission == true):?>
                                            <a class="btn red deleteSystemNotificationTemplate" template_id="<?php echo $oTemplate->id; ?>"><i class="fa fa-trash"></i></a>
                                            <?php else: ?>
                                            <a href="javascript:void(0)" title="Deleting this template not allowed" class="btn red"><i class="fa fa-trash" style="color:#ccc;"></i></a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="addSystemNotificationTemplate" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="frmAddSysTemplate" id="frmAddSysTemplate" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Add System Notification Template</h5>
                </div>

                <div class="modal-body">
                    <p>Title:
                    <input class="form-control" name="title" placeholder="Enter Title for the notification" type="text" required></p>
                    <p>Event Name:
                    <input class="form-control" name="template_tag" placeholder="Enter Event Name" type="text" required></p>
                    <p>Language:
                    <textarea class="form-control" name="tag_language" placeholder="Enter Language for the tag" required=""></textarea></p>
                    <p>Admin Language:
                    <textarea class="form-control" name="tag_language_admin" placeholder="Enter Language for admin for the same tag" required=""></textarea></p>
                    <p>Icon
                        <input type="radio" id="icon-envelop" name="icon" value="icon-envelop" style="margin-left:10px;" checked="checked" /> <label for="icon-envelop"><i class="icon-envelop fsize20"></i></label>
                        <input type="radio" id="icon-stack-text" name="icon" value="icon-stack-text" style="margin-left:10px;"  /> <label for="icon-stack-text"><i class="icon-stack-text fsize20"></i></label>
                        <input type="radio" id="icon-enter2" name="icon" value="icon-enter2" style="margin-left:10px;"  /> <label for="icon-enter2"><i class="icon-enter2 fsize20"></i> </label>
                        <input type="radio" id="icon-loop3" name="icon" value="icon-loop3" style="margin-left:10px;"  /> <label for="icon-loop3"><i class="icon-loop3 fsize20"></i> </label>
                        <input type="radio" id="icon-radio-checked2" name="icon" value="icon-radio-checked2" style="margin-left:10px;"  /> <label for="icon-radio-checked2 fsize20"><i class="icon-radio-checked2"></i></label>
                        
                        
                    </p>    

                </div>

                <div class="modal-footer p40">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn dark_btn">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="editSystemNotificationTemplate" class="modal fade">
    <div style="max-width: 760px;" class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" name="frmEditSysTemplate" id="frmEditSysTemplate" action="javascript:void();">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-tags"></i>&nbsp; Edit System Notification Template</h5>
            </div>
            <div class="modal-body">
                <p>Title:
                    <input class="form-control" name="title" id="sys_template_title" placeholder="Enter Title for the notification" type="text" required></p>
                <p>Event Name:
                <input class="form-control" id="sys_template_tag" name="template_tag" placeholder="Enter Event Name" type="text" readonly="readonly" style="background:#ccc;" required></p>
                <p>User Notification:
                <textarea class="form-control" id="sys_tag_language" name="tag_language" placeholder="Enter Language for the tag" required=""></textarea>
                <p>Admin Notification:
                <textarea class="form-control" id="sys_tag_language_admin" name="tag_language_admin" placeholder="Enter Language for admin for the same tag" required=""></textarea></p>
                <p>Icon
                    <input type="radio" id="icon-envelop" name="edit_icon" value="icon-envelop" checked="checked" style="margin-left:10px;" /> <label for="icon-envelop"><i class="icon-envelop fsize20"></i></label>
                        <input type="radio" id="icon-stack-text" name="edit_icon" value="icon-stack-text" style="margin-left:10px;"  /> <label for="icon-stack-text"><i class="icon-stack-text fsize20"></i></label>
                        <input type="radio" id="icon-enter2" name="edit_icon" value="icon-enter2" style="margin-left:10px;"  /> <label for="icon-enter2"><i class="icon-enter2 fsize20"></i> </label>
                        <input type="radio" id="icon-loop3" name="edit_icon" value="icon-loop3" style="margin-left:10px;"  /> <label for="icon-loop3"><i class="icon-loop3 fsize20"></i> </label>
                        <input type="radio" id="icon-radio-checked2" name="edit_icon" value="icon-radio-checked2" style="margin-left:10px;"  /> <label for="icon-radio-checked2 fsize20"><i class="icon-radio-checked2"></i></label>
                        
                        
                    </p>

            </div>
            <div class="modal-footer p40">
                <input type="hidden" name="template_id" id="sys_template_id" />
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="submit" class="btn dark_btn">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        $('#frmAddSysTemplate').on('submit', function (e) {
            var formdata = $("#frmAddSysTemplate").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/settings/saveSystemNotificationTemplate'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        //Display tag list
                        window.location.href='';
                    }
                }
            });
            return false;
        });
        
        
        $(document).on("click", ".editSystemNotificationTemplate", function (e) {
        var templateId = $(this).attr('template_id');
        $.ajax({
            url: '<?php echo base_url("admin/settings/getSystemNotificationTemplate");?>',
            type: "POST",
            data: {templateId: templateId},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $("#sys_template_title").val(data.datarow.title);
                    $('#sys_template_tag').val(data.datarow.template_tag);
                    $('#sys_tag_language').html(data.datarow.tag_language);
                    $('#sys_tag_language_admin').html(data.datarow.tag_language_admin);
                    $('#sys_template_id').val(templateId);
                    $("input[name='edit_icon'][value='"+data.datarow.icon+"']").prop('checked', true);
                    $('#editSystemNotificationTemplate').modal();
                } else {
                    alertMessage('Error: Some thing wrong!');
                }
            }, error() {
                alertMessage('Error: Some thing wrong!');
            }
        });

        return false;

    });
    
    $('#frmEditSysTemplate').on('submit', function (e) {
            var formdata = $("#frmEditSysTemplate").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/settings/updateSystemNotificationTemplate'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = '';
                    }
                }
            });
            return false;
        });
        
        $(document).on('click', '.deleteSystemNotificationTemplate', function () {
        var elem = $(this);
        swal({
            title: "Are you sure? You want to delete this template!",
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
                        var templateID = $(elem).attr('template_id');
                        $.ajax({
                            url: '<?php echo base_url('admin/settings/deleteSystemNotificationTemplate'); ?>',
                            type: "POST",
                            data: {templateID: templateID},
                            dataType: "json",
                            success: function (data) {
                                if (data.status == 'success') {
                                    $('.overlaynew').hide();
                                    window.location.href = '';
                                }
                            }
                        });
                    }
                });
    });
    
    

    });
</script>

