@php
    $aUser = getLoggedUser();
    $userID = $aUser->id;
    $bHaveStaticTemplates = '';
    $selected_template = (isset($selected_template)) ? $selected_template : '';
    $method = (isset($method)) ? $method : '';
    $moduleUnitID = !empty($moduleUnitID) ? $moduleUnitID : '';
@endphp
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

    /*    .datatable-footer{background: none!important; border:none!important; box-shadow: none; padding:10px 0 0 0 !important}
        .dataTables_paginate{margin-bottom: 5px!important}*/
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
                                <i class=""><img src="{{ base_url() }}assets/images/icon_search.png" width="14"></i>
                            </div>
                        </div>
                        <div class="table_action_tool">
                            <a href="#" class="brig pr-15">Filter &nbsp; <i class=""><img
                                        style="width: 11px!important; height: 10px!important"
                                        src="{{ base_url() }}assets/images/icon_filter.png"></i></a>
                            <a href="#"><i class=""><img src="{{ base_url() }}assets/images/icon_calender.png"></i></a>
                            <a href="#"><i class=""><img src="{{ base_url() }}assets/images/icon_download.png"></i></a>
                            <a href="#"><i class=""><img src="{{ base_url() }}assets/images/icon_upload.png"></i></a>
                            <a href="#"><i class=""><img src="{{ base_url() }}assets/images/icon_edit.png"></i></a>
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
                    <li><a class="displayEmailTemplates" selected_template="" action="my" href="javascript:void(0);">My
                            Templates</a></li>
                    <hr>
                    @if (in_array($moduleName, array('brandboost', 'onsite', 'offsite', 'nps', 'referral')))
                        @foreach ($oCategories as $oCategory)
                            @if ($oCategory->status == '2')
                                @php $bHaveStaticTemplates = true @endphp
                                @if ($moduleName == 'brandboost' && $brandboostData->review_type == 'onsite' && $oCategory->module_name == 'onsite')
                                    <li><a class="displayEmailTemplates" selected_template="" action="category"
                                           category_id="{{ $oCategory->id }}"
                                           href="javascript:void(0);">{{ $oCategory->category_name }}</a></li>
                                @elseif ($moduleName == 'brandboost' && $brandboostData->review_type == 'offsite' && $oCategory->module_name == 'offsite')
                                    <li><a class="displayEmailTemplates" selected_template="" action="category"
                                           category_id="{{ $oCategory->id }}"
                                           href="javascript:void(0);">{{ $oCategory->category_name }}</a></li>
                                @elseif ($oCategory->module_name == $moduleName)
                                    <li><a class="displayEmailTemplates" selected_template="" action="category"
                                           category_id="{{ $oCategory->id }}"
                                           href="javascript:void(0);">{{ $oCategory->category_name }}</a></li>
                                @endif
                            @endif
                        @endforeach
                    @endif
                    @if ($bHaveStaticTemplates == true)
                        <hr>
                    @endif

                    <li><a class="active displayEmailTemplates" selected_template="" action="all"
                           href="javascript:void(0);">All Templates</a></li>
                    @foreach ($oCategories as $oCategory)
                        @if ($oCategory->status == '1')
                            <li><a class="displayEmailTemplates" selected_template="" action="category"
                                   category_id="{{ $oCategory->id }}"
                                   href="javascript:void(0);">{{ $oCategory->category_name }}</a></li>
                        @endif
                    @endforeach

                    <hr>
                    <li><a class="displayEmailTemplates" selected_template="" action="category" category_id="5"
                           href="javascript:void(0);">Plain Text</a></li>

                </ul>
            </div>
        </div>
        <div class="col-md-10 mb20 emailtempsec" id="categorized_email_template_list">
            <div class="top"></div>
            <table class="table" id="tblEmailTemplate" style="background: none!important; width: 100%!important;">
                <thead class="hidden">
                <tr style="display: none;">
                    <th style="display: none;"></th>
                    <th style="display: none;"></th>

                    <th><i class="icon-image2"></i>Template Name</th>
                    <th style="display: none;"></th>
                </tr>
                </thead>
                <tbody>

                @if (!empty($selected_template) && ($selected_template > 0))
                    @foreach ($oTemplates as $oTemplate)
                        @if ($oTemplate->id == $selected_template)
                            @if (($oTemplate->status == '1' ) && (strtolower($oTemplate->template_type) == 'email'))
                                <tr class="template_row">
                                    <td style="display: none;"></td>
                                    <td style="display: none;">{{ $oTemplate->id }}99999999</td>

                                    <td>
                                        <div class="white_box template_preview ">
                                            <label class="custmo_checkbox">
                                                <input type="radio" class="continueChooseTemplateButton"
                                                       template_id="{{ $oTemplate->id }}" name="selectedTemplate"
                                                       value="{{ $oTemplate->id }}" id="templateID_{{ $oTemplate->id }}"
                                                       @if ($oTemplate->id == $selected_template)
                                                       checked="checked"
                                                    @endif
                                                >
                                                <span class="custmo_checkmark sblue"></span>
                                            </label>
                                            <label for="templateID_{{ $oTemplate->id }}" class="m0">
                                                @if ($method == 'manage')
                                                    <div class="temp_more_opt">
                                                        <a class="table_more dropdown-toggle"
                                                           data-toggle="dropdown"
                                                           aria-expanded="false">
                                                            <img
                                                                src="{{ base_url() }}assets/images/more.svg"
                                                                style="width: 12px;height: 12px;">
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-right more_act"
                                                            style="width: 146px; min-width: 146px;">
                                                            <li>
                                                                <a href="javascript:void(0);"
                                                                   template_id="{{ $oTemplate->id }}"
                                                                   class="cloneTemplate"
                                                                   template_type="email"><i class="icon-pencil"></i>
                                                                    Clone
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);"
                                                                   template_id="{{ $oTemplate->id }}"
                                                                   class="previewEmailTemplate"><i
                                                                        class="icon-file-locked"></i> Preview
                                                                </a>
                                                            </li>
                                                            @if ($oTemplate->user_id == $userID)
                                                                <li>
                                                                    <a href="{{ base_url() }}admin/templates/edit/{{ $oTemplate->id }}"><i
                                                                            class="icon-pencil"></i> Edit</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                       template_id="{{ $oTemplate->id }}"
                                                                       class="deleteTemplate"
                                                                       source="{{ $source }}"><i class="icon-trash"></i>
                                                                        Delete</a>
                                                                </li>
                                                            @endif

                                                        </ul>

                                                    </div>
                                                @endif
                                                <div
                                                    style="width:165px;height:155px;overflow:hidden;background:#f9f9f9;">
                                                    @if (!empty($oTemplate->thumbnail))
                                                        <img style="height:auto!important;"
                                                             src="{{ $oTemplate->thumbnail }}"/>
                                                    @else
                                                        <img src="{{ base_url() }}assets/images/temp_prev9.png"/>
                                                    @endif
                                                </div>
                                                <a class="email_preview_button previewEmailTemplate small"
                                                   href="javascript:void(0);" template_id="{{ $oTemplate->id }}"><i
                                                        class="icon-eye8"></i></a>
                                                <div class="content_bx">
                                                    @if ($oTemplate->user_id == $aUser->id)
                                                        <p><a href="javascript:void(0);" class="editName"
                                                              id="editName_{{ $oTemplate->id }}"
                                                              template_id="{{ $oTemplate->id }}"
                                                              title="click to edit template name">{{ $oTemplate->template_name }}</a>
                                                        </p>
                                                        <input type="text" id="editNameTxt_{{ $oTemplate->id }}"
                                                               class="form-control editNameTxt"
                                                               value="{{ $oTemplate->template_name }}"
                                                               template_id="{{ $oTemplate->id }}"
                                                               style="margin-top:-9px;display:none;"/>

                                                    @else
                                                        <p>{{ $oTemplate->template_name }}</p>
                                                    @endif

                                                </div>
                                            </label>
                                        </div>
                                    </td>
                                    <td style="display: none;">&nbsp;

                                    </td>
                                </tr>
                            @endif
                        @endif
                    @endforeach
                @endif
                @php
                    $imgArr = array('template_prev1.png', 'template_prev2.png', 'template_prev3.png', 'template_prev4.png', 'template_prev5.png', 'template_prev6.png', 'template_prev7.png', 'template_prev8.png');
                @endphp
                @foreach ($oTemplates as $oTemplate)
                    @if (($oTemplate->id != $selected_template) && ($oTemplate->status == '1') && ($oTemplate->category_status != '2') && (strtolower($oTemplate->template_type) == 'email'))
                        <tr class="template_row">
                            <td style="display: none;"></td>
                            <td style="display: none;">{{ $oTemplate->id }}</td>

                            <td>
                                <div class="white_box template_preview ">
                                    <label class="custmo_checkbox">
                                        <input type="radio" class="continueChooseTemplateButton"
                                               template_id="{{ $oTemplate->id }}" name="selectedTemplate"
                                               value="{{ $oTemplate->id }}" id="templateID_{{ $oTemplate->id }}"
                                               @if ($oTemplate->id == $selected_template)
                                               checked="checked"
                                            @endif
                                        >
                                        <span class="custmo_checkmark sblue"></span>
                                    </label>
                                    <label for="templateID_{{ $oTemplate->id }}" class="m0">
                                        @if ($method == 'manage')
                                            <div class="temp_more_opt"><a class="table_more dropdown-toggle"
                                                                          data-toggle="dropdown"
                                                                          aria-expanded="false"><img
                                                        src="{{ base_url() }}assets/images/more.svg"
                                                        style="width: 12px;height: 12px;"></a>
                                                <ul class="dropdown-menu dropdown-menu-right more_act"
                                                    style="width: 146px; min-width: 146px;">
                                                    <li><a href="javascript:void(0);" template_id="{{ $oTemplate->id }}"
                                                           class="cloneTemplate" template_type="email"><i
                                                                class="icon-pencil"></i> Clone</a></li>
                                                    <li><a href="javascript:void(0);" template_id="{{ $oTemplate->id }}"
                                                           class="previewEmailTemplate"><i class="icon-file-locked"></i>
                                                            Preview</a></li>
                                                    @if ($oTemplate->user_id == $userID)
                                                        <li>
                                                            <a href="{{ base_url() }}admin/templates/edit/{{ $oTemplate->id }}"><i
                                                                    class="icon-pencil"></i> Edit</a></li>
                                                        <li><a href="javascript:void(0);"
                                                               template_id="{{ $oTemplate->id }}"
                                                               class="deleteTemplate" source="{{ $source }}"><i
                                                                    class="icon-trash"></i> Delete</a></li>
                                                    @endif

                                                </ul>
                                            </div>
                                        @endif
                                        <div style="width:165px;height:155px;overflow:hidden;background:#f9f9f9;">
                                            @if (!empty($oTemplate->thumbnail))
                                                <img style="height:auto!important;" src="{{ $oTemplate->thumbnail }}"/>
                                            @else
                                                <img src="{{ base_url() }}assets/images/temp_prev9.png"/>
                                            @endif
                                        </div>
                                        <a class="email_preview_button previewEmailTemplate small"
                                           href="javascript:void(0);" template_id="{{ $oTemplate->id }}"><i
                                                class="icon-eye8"></i></a>
                                        <div class="content_bx">
                                            @if ($oTemplate->user_id == $aUser->id)
                                                <p><a href="javascript:void(0);" class="editName"
                                                      id="editName_{{ $oTemplate->id }}"
                                                      template_id="{{ $oTemplate->id }}"
                                                      title="click to edit template name">{{ $oTemplate->template_name }}</a>
                                                </p>
                                                <input type="text" id="editNameTxt_{{ $oTemplate->id }}"
                                                       class="form-control editNameTxt"
                                                       value="{{ $oTemplate->template_name }}"
                                                       template_id="{{ $oTemplate->id }}"
                                                       style="margin-top:-9px;display:none;"/>

                                            @else
                                                <p>{{ $oTemplate->template_name }}</p>
                                            @endif

                                        </div>
                                    </label>
                                </div>
                            </td>
                            <td style="display: none;">&nbsp;

                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>

        </div>

    </div>

</div>
@include('admin.modals.templates.email-templates-popup')

<script>
    $(document).ready(function () {
        // Setup - add a text input to each footer cell

        var tableId = 'tblEmailTemplate';
        custom_data_table(tableId);


    });


    $(document).ready(function () {
        $(document).on("click", ".previewEmailTemplate", function (e) {
            var templateID = $(this).attr('template_id');
            var source = $(this).attr('source');
            var moduleName = '{{ $moduleName }}';
            var moduleUnitId = '{{ $moduleUnitID }}';
            if (templateID != '') {
                $('.overlaynew').show();
                $.ajax({
                    url: "{{ base_url('admin/templates/loadTemplatePreview') }}",
                    type: "POST",
                    data: {
                        _token: '{{csrf_token()}}',
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
            var selected_template = '{{ $selected_template }}';
            $('.overlaynew').show();
            $.ajax({
                url: "{{ base_url('admin/templates/getCategorizedTemplates') }}",
                type: "POST",
                data: {
                    _token: '{{csrf_token()}}',
                    categoryid: categoryid,
                    action: action,
                    campaign_type: campaign_type,
                    method: '{{ $method }}',
                    selected_template: selected_template
                },
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        $("#categorized_email_template_list").html(data.content);
                        var tableId = 'tblEmailTemplate';
                        custom_data_table(tableId);


                    } else if (data.status == 'error') {
                        $('.overlaynew').hide();

                    }

                }
            });
        });


    });
</script>
