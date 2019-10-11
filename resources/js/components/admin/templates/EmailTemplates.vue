<template>
    <div>
        <div id="chooseEmailTemplate">
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="panel panel-flat">
                        <div class="panel-heading br5">
                    <span class="pull-left">
                        <h6 class="panel-title">Select Email Template</h6>
                    </span>
                            <div class="heading-elements">
                                <div style="display: inline-block; margin: 0;"
                                     class="form-group has-feedback has-feedback-left">
                                    <input class="form-control input-sm" placeholder="Search by name" type="text">
                                    <div class="form-control-feedback">
                                        <i class=""><img src="/assets/images/icon_search.png" width="14"></i>
                                    </div>
                                </div>
                                <div class="table_action_tool">
                                    <a href="#" class="brig pr-15">Filter &nbsp; <i class=""><img
                                        style="width: 11px!important; height: 10px!important"
                                        src="/assets/images/icon_filter.png"></i></a>
                                    <a href="#"><i class=""><img src="/assets/images/icon_calender.png"></i></a>
                                    <a href="#"><i class=""><img src="/assets/images/icon_download.png"></i></a>
                                    <a href="#"><i class=""><img src="/assets/images/icon_upload.png"></i></a>
                                    <a href="#"><i class=""><img src="/assets/images/icon_edit.png"></i></a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-2" style="max-width: 187px!important;">
                    <div class="white_box p25 mb20 pt-15 pb-15">
                        <ul class="select_template">
                            <li><a href="javascript:void(0);">Recent Email</a></li>
                            <li><a href="javascript:void(0);">My Email</a></li>
                            <li><a class="displayEmailTemplates" selected_template="" action="my"
                                   href="javascript:void(0);">My
                                Templates</a></li>
                            <hr>
                            <li><a class="active displayEmailTemplates" selected_template="" action="all"
                                   href="javascript:void(0);">All Templates</a></li>
                            <li v-for="category in categories" v-if="category.status =='1'">
                                <a class="displayEmailTemplates" selected_template="" action="category"
                                   :category_id="category.id"
                                   href="javascript:void(0);">{{ category.category_name }}</a></li>
                            <hr>
                            <li><a class="displayEmailTemplates" selected_template="" action="category" category_id="5"
                                   href="javascript:void(0);">Plain Text</a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-10 mb20 emailtempsec" id="categorized_email_template_list">
                    <div class="top"></div>
                    <table class="table" id="tblEmailTemplate"
                           style="background: none!important; width: 100%!important;">
                        <thead class="hidden">
                        <tr style="display: none;">
                            <th style="display: none;"></th>
                            <th style="display: none;"></th>

                            <th><i class="icon-image2"></i>Template Name</th>
                            <th style="display: none;"></th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr class="template_row" v-for="template in templates"
                            v-if="selected_template> 0 && template.id == selected_template && template.status=='1' && template.template_type.toLowerCase() == 'email'">
                            <td style="display: none;"></td>
                            <td style="display: none;">{{ template.id }}99999999</td>

                            <td>
                                <div class="white_box template_preview ">
                                    <label class="custmo_checkbox">
                                        <input type="radio" class="continueChooseTemplateButton"
                                               :template_id="template.id" name="selectedTemplate"
                                               :value="template.id" :id="`templateID_${template.id}`"
                                               :checked="template.id == selected_template"
                                        >
                                        <span class="custmo_checkmark sblue"></span>
                                    </label>
                                    <label :for="`templateID_${template.id}`" class="m0">
                                        <div class="temp_more_opt" v-if="method == 'manage'">
                                            <a class="table_more dropdown-toggle"
                                               data-toggle="dropdown"
                                               aria-expanded="false">
                                                <img
                                                    src="/assets/images/more.svg"
                                                    style="width: 12px;height: 12px;">
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-right more_act"
                                                style="width: 146px; min-width: 146px;">
                                                <li>
                                                    <a href="javascript:void(0);"
                                                       :template_id="template.id"
                                                       class="cloneTemplate"
                                                       template_type="email"><i class="icon-pencil"></i>
                                                        Clone
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);"
                                                       :template_id="template.id"
                                                       class="previewEmailTemplate"><i
                                                        class="icon-file-locked"></i> Preview
                                                    </a>
                                                </li>

                                                <li v-if="template.user_id == userid">
                                                    <a :href="`/admin/templates/edit/${template.id}`"><i
                                                        class="icon-pencil"></i> Edit</a></li>
                                                <li v-if="template.user_id == userid"><a href="javascript:void(0);"
                                                                                         :template_id="template.id"
                                                                                         class="deleteTemplate"
                                                                                         :source="source"><i
                                                    class="icon-trash"></i>
                                                    Delete</a>
                                                </li>


                                            </ul>

                                        </div>

                                        <div
                                            style="width:165px;height:155px;overflow:hidden;background:#f9f9f9;">
                                            <img v-if="template.thumbnail" style="height:auto!important;"
                                                 :src="template.thumbnail"/>
                                            <img v-else src="/assets/images/temp_prev9.png"/>
                                        </div>
                                        <a class="email_preview_button previewEmailTemplate small"
                                           href="javascript:void(0);" :template_id="template.id"><i
                                            class="icon-eye8"></i></a>
                                        <div v-if="template.user_id == userid" class="content_bx">
                                            <p><a href="javascript:void(0);" class="editName"
                                                  :id="`editName_${template.id}`"
                                                  :template_id="template.id"
                                                  title="click to edit template name">{{ template.template_name }}</a>
                                            </p>
                                            <input type="text" id="`editNameTxt_${template.id}`"
                                                   class="form-control editNameTxt"
                                                   :value="template.template_name"
                                                   :template_id="template.id"
                                                   style="margin-top:-9px;display:none;"/>

                                        </div>
                                        <div class="content_bx" v-else>
                                            <p>{{template.template_name}}</p>
                                        </div>
                                    </label>
                                </div>
                            </td>
                            <td style="display: none;">&nbsp;

                            </td>
                        </tr>

                        <tr class="template_row" v-for="template in templates"
                            v-if="template.id != selected_template && template.status=='1' && template.category_status != '2' && template.template_type.toLowerCase() == 'email'">
                            <td style="display: none;"></td>
                            <td style="display: none;">{{template.id}}</td>

                            <td>
                                <div class="white_box template_preview ">
                                    <label class="custmo_checkbox">
                                        <input type="radio" class="continueChooseTemplateButton"
                                               :template_id="template.id" name="selectedTemplate"
                                               :value="template.id" id="`templateID_${template.id}`"
                                               :checked="template.id == selected_template"

                                        >
                                        <span class="custmo_checkmark sblue"></span>
                                    </label>
                                    <label :for="`templateID_${template.id}`" class="m0">

                                        <div v-if="method == 'manage'" class="temp_more_opt"><a
                                            class="table_more dropdown-toggle"
                                            data-toggle="dropdown"
                                            aria-expanded="false"><img
                                            src="/assets/images/more.svg"
                                            style="width: 12px;height: 12px;"></a>
                                            <ul class="dropdown-menu dropdown-menu-right more_act"
                                                style="width: 146px; min-width: 146px;">
                                                <li><a href="javascript:void(0);" :template_id="template.id"
                                                       class="cloneTemplate" template_type="email"><i
                                                    class="icon-pencil"></i> Clone</a></li>
                                                <li><a href="javascript:void(0);" :template_id="template.id"
                                                       class="previewEmailTemplate"><i class="icon-file-locked"></i>
                                                    Preview</a></li>
                                                <li v-if="template.user_id == userid">
                                                    <a :href="`/admin/templates/edit/${template.id}`"><i
                                                        class="icon-pencil"></i> Edit</a></li>
                                                <li v-if="template.user_id == userid"><a href="javascript:void(0);"
                                                                                         :template_id="template.id"
                                                                                         class="deleteTemplate"
                                                                                         :source="source"><i
                                                    class="icon-trash"></i> Delete</a></li>
                                            </ul>
                                        </div>

                                        <div style="width:165px;height:155px;overflow:hidden;background:#f9f9f9;">
                                            <img v-if="template.thumbnail" style="height:auto!important;"
                                                 :src="template.thumbnail"/>
                                            <img v-else src="/assets/images/temp_prev9.png"/>

                                        </div>
                                        <a class="email_preview_button previewEmailTemplate small"
                                           href="javascript:void(0);" :template_id="template.id"><i
                                            class="icon-eye8"></i></a>

                                        <div class="content_bx" v-if="template.user_id == userid">
                                            <p><a href="javascript:void(0);" class="editName"
                                                  :id="`editName_${template.id}`"
                                                  :template_id="template.id"
                                                  title="click to edit template name">{{template.template_name}}</a>
                                            </p>
                                            <input type="text" :id="`editNameTxt_${template.id}`"
                                                   class="form-control editNameTxt"
                                                   :value="template.template_name"
                                                   :template_id="template.id"
                                                   style="margin-top:-9px;display:none;"/>

                                        </div>
                                        <div class="content_bx" v-else>
                                            <p>{{ template.template_name }}</p>
                                        </div>
                                    </label>
                                </div>
                            </td>
                            <td style="display: none;">&nbsp;

                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
        <email-template-popups></email-template-popups>
        <div id="addUserTemplate" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" name="frmAddUserTemplateModal" id="frmAddUserTemplateModal"
                          action="javascript:void(0);">
                        <input type="hidden" name="_token" :value="csrf_token()">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h5 class="modal-title"><img src="/assets/css/menu_icons/Email_Color.svg"/>
                                Add Email Template &nbsp; <i class="icon-info22 fsize12 txt_grey"></i></h5>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Enter Template Name below:</label>
                                        <input class="form-control" id="title" name="templateName"
                                               placeholder="Enter Title" type="text" required>

                                    </div>

                                    <div class="form-group mb0">
                                        <label>Choose Template Category:</label>
                                        <select class="form-control h52" name="templateCategory" required="">
                                            <option>--Select--</option>
                                            <option v-for="category in categories" :value="category.id">{{ category.category_name }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="templateType" value="email"/>
                            <button data-toggle="modal" type="submit" class="btn dark_btn bkg_sblue fsize14 h52">
                                Continue
                            </button>
                            <button data-toggle="modal" data-dismiss="modal" type="button"
                                    class="btn btn-link fsize14 txt_blue h52">Cancel
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import EmailPopup from '../modals/templates/EmailTemplatesPopup.vue';

    export default {
        /*name: 'email-templates',*/
        components: {'email-template-popups': EmailPopup},
        data() {
            return {
                templates: {},
                categories: {},
                method: '',
                selected_template: '',
                userid: '',
                source: '',
            }
        },
        mounted() {
            axios.get('/admin/templates/email')
                .then(response => {
                    this.templates = response.data.oTemplates;
                    this.categories = response.data.oCategories;
                    this.method = response.data.method;
                    this.userid = response.data.userID;
                    let tableId = 'tblEmailTemplate';
                    this.paginate(tableId);
                });

        },
        methods: {},
    };
    let tkn = $('meta[name="_token"]').attr('content');
    var elem = this;
    $(document).ready(function () {
        $(document).on("click", ".previewEmailTemplate", function (e) {
            var templateID = $(this).attr('template_id');
            var source = $(this).attr('source');
            var moduleName = '{{ $moduleName }}';
            var moduleUnitId = '{{ $moduleUnitID }}';

            if (templateID != '') {
                $('.overlaynew').show();
                $.ajax({
                    url: "/admin/templates/loadTemplatePreview",
                    type: "POST",
                    data: {
                        _token: tkn,
                        template_id: templateID,
                        source: source,
                        moduleName: moduleName,
                        moduleUnitId: moduleUnitId
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            $('.overlaynew').hide();
                            $("#emailPreviewContainer").html(data.content);
                            $("#email_template_preview_modal").modal();
                        } else if (data.status == 'error') {
                            $('.overlaynew').hide();

                        }

                    }
                });

            }
        });

        $(document).on('click', '.displayEmailTemplates', function () {
            var categoryid = $(this).attr('category_id');
            var action = $(this).attr('action');
            var campaign_type = 'email';
            $(".select_template li a").removeClass('active');
            $(this).addClass('active');
            var selected_template = this.selected_template;
            $('.overlaynew').show();
            $.ajax({
                url: "/admin/templates/getCategorizedTemplates",
                type: "POST",
                data: {
                    _token: tkn,
                    categoryid: categoryid,
                    action: action,
                    campaign_type: campaign_type,
                    method: 'manage',
                    selected_template: selected_template
                },
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        $("#categorized_email_template_list").html(data.content);
                        let tableId2 = 'tblEmailTemplate';
                        custom_data_table(tableId2);

                    } else if (data.status == 'error') {
                        $('.overlaynew').hide();

                    }

                }
            });
        });


    });

</script>
<style>
    .emailtempsec {
        width: calc(100% - 190px);
    }

    .template_row {
        width: 187px;
        display: inline-block;
    }

    .template_row td {
        padding: 0 !important;
    }

    .heading-elements .form-control.input-sm {
        background: none !important;
        padding: 0 60px 0 11px !important;
    }

    .heading-elements .has-feedback-left .form-control-feedback {
        right: 30px;
    }

    .content-wrapper::before {
        height: 210px !important;
    }

    .temp_more_opt {
        position: absolute;
        width: 24px;
        height: 24px;
        right: 0px;
        top: 0;
        border-radius: 0 5px 0;
        background: #fff;
        box-shadow: 0 1px 1px 0 rgba(1, 21, 64, 0.20);
        z-index: 99;
    }

</style>
