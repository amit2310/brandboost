<div class="content">
    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-7">
                <h3><i class="icon-star-half"></i> &nbsp; Manage Default Templates</h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="active"><a href="#right-icon-tab1" data-toggle="tab">Onsite Brandboost</a></li>
                    <li class=""><a href="#right-icon-tab2" data-toggle="tab">Offsite Brandboost</a></li>
                    <li class=""><a href="#right-icon-tab3" data-toggle="tab">Email</a></li>
                    <li class=""><a href="#right-icon-tab4" data-toggle="tab">Referral</a></li>
                    <li class=""><a href="#right-icon-tab5" data-toggle="tab">NPS</a></li>

                </ul>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-5 text-right btn_area">
                <button type="button" class="btn light_btn" data-toggle="modal" data-target="#addWorkflowTemplateModal"><i class="icon-arrow-up16"></i><span> &nbsp;  Add Template</span> </button>


            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->

    <div class="tab-content">
        <?php $this->load->view("admin/workflow/list_templates"); ?>
    </div>
</div>

<div id="addWorkflowTemplateModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="frmAddWorkflowTemplate" id="frmAddWorkflowTemplate" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Add Default Template</h5>
                </div>

                <div class="modal-body">
                    <p>App:</p>
                    <select class="form-control" required="required" name="moduleName">
                        <option value="">Select</option>
                        <option value="onsite">Onsite Brandboost</option>
                        <option value="offsite">Offsite Brandboost</option>
                        <option value="automation">Email</option>
                        <option value="referral">Referral</option>
                        <option value="nps">NPS</option>
                    </select>
                    
                    <p>Type:</p>
                    <select class="form-control" required="required" name="template_type">
                        <option value="">Select</option>
                        <option value="email">Email</option>
                        <option value="sms">SMS</option>
                    </select>          


                    <p>Title:</p>
                    <input class="form-control" id="templateName" name="template_name" placeholder="Enter Title of the Template" type="text" required>
                    <p>Subject:</p>
                    <input class="form-control" id="templateSubject" name="template_subject" placeholder="Enter Subject for the Template" type="text" required>
                </div>

                <div class="modal-footer p40">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn dark_btn">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        $('#frmAddWorkflowTemplate').on('submit', function (e) {
            var formdata = $("#frmAddWorkflowTemplate").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/workflow/addWorkflowTemplate'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        //Display tag list
                        //alertMessageAndRedirect("Template Added successfully", window.location.href);
                        window.location.href='';
                    }
                }
            });
            return false;
        });

    });
</script>

