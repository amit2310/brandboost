<div class="content">
    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-7">
                <h3><i class="icon-star-half"></i> &nbsp; Manage Broadcast Templates</h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <!--                    <li class="active"><a href="#right-icon-tab1" data-toggle="tab">Onsite Brandboost</a></li>
                                        <li class=""><a href="#right-icon-tab2" data-toggle="tab">Offsite Brandboost</a></li>
                                        <li class=""><a href="#right-icon-tab3" data-toggle="tab">Automation</a></li>
                                        <li class=""><a href="#right-icon-tab4" data-toggle="tab">Referral</a></li>
                                        <li class=""><a href="#right-icon-tab5" data-toggle="tab">NPS</a></li>-->

                </ul>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-5 text-right btn_area">
                <button type="button" class="btn light_btn" data-toggle="modal" data-target="#addWorkflowTemplateModal">
                    <i class="icon-arrow-up16"></i><span> &nbsp;  Add Template</span></button>


            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->

    <div class="tab-content">
        @include("admin.workflow2/list_broadcast_templates")
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
                    <div class="form-group" style="display:none;">
                        <label class="control-label">App:</label>
                        <select class="form-control" required="required" name="moduleName">
                            <option value="">Select</option>
                            <option value="onsite">Onsite Brandboost</option>
                            <option value="offsite">Offsite Brandboost</option>
                            <option value="broadcast" selected="">Broadcast</option>
                            <option value="automation">Automation</option>
                            <option value="referral">Referral</option>
                            <option value="nps">NPS</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Type:</label>
                        <select class="form-control" required="required" name="template_type">
                            <option value="">Select</option>
                            <option value="email">Email</option>
                            <option value="sms">SMS</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Categories:</label>
                        <select class="form-control" required="required" name="categoryName">
                            <option value="">Select</option>
                            @foreach($aData['oCategories'] as $oCategory)
                                <option value="{{ $oCategory->id }}">{{ $oCategory->category_name }}</option>
                            @endforeach

                        </select>
                    </div>


                    <div class="form-group">
                        <label class="control-label">Title:</label>
                        <input class="form-control" id="templateName" name="template_name"
                               placeholder="Enter Title of the Template" type="text" required>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Subject:</label>
                        <input class="form-control" id="templateSubject" name="template_subject"
                               placeholder="Enter Subject for the Template" type="text" required>
                    </div>


                    <div id="stripoOnly" style="display:none;">
                        <div class="form-group">
                            <label class="control-label">Strip Html:</label>
                            <textarea class="form-control" id="templateStripoHtml" name="stripo_html"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Stripo CSS:</label>
                            <textarea class="form-control" id="templateStripoCSS" name="stripo_css"></textarea>
                        </div>
                    </div>
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

        $("select[name='moduleName']").change(function () {
            if ($(this).val() == 'automation') {
                if ($("select[name='template_type']").val() == 'email') {
                    $("#stripoOnly").show();
                } else {
                    $("#stripoOnly").hide();
                }
            } else {
                $("#stripoOnly").hide();
            }
        });

        $("select[name='template_type']").change(function () {
            if ($(this).val() == 'email') {
                if ($("select[name='moduleName']").val() == 'automation') {
                    $("#stripoOnly").show();
                } else {
                    $("#stripoOnly").hide();
                }

            } else {
                $("#stripoOnly").hide();
            }
        });

        $('#frmAddWorkflowTemplate').on('submit', function (e) {
            var formdata = $("#frmAddWorkflowTemplate").serialize();
            formdata += '&_token={{csrf_token()}}';
            $.ajax({
                url: "{{ base_url('admin/workflow/addWorkflowTemplate') }}",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        //Display tag list
                        //alertMessageAndRedirect("Template Added successfully", window.location.href);
                        window.location.href = '';
                    }
                }
            });
            return false;
        });

    });
</script>

