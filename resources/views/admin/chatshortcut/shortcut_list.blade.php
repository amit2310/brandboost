@extends('layouts.main_template')

@section('title')
    {{ $title }}
@endsection

@section('contents')
    @php list($canRead, $canWrite) = fetchPermissions('Questions') @endphp


    <div class="content">

        <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
        <div class="page_header">
            <div class="row">
                <!--=============Headings & Tabs menu==============-->
                <div class="col-md-7">
                    <h3><img style="width:17px;" src="/assets/images/menu_icons/Chat_Light.svg">&nbsp; Chat Shortcuts
                    </h3>
                    <ul class="nav nav-tabs nav-tabs-bottom">


                        <!-- <li class="active all"><a style="javascript:void();" class="filterByColumn" fil="">All Shortcuts</a></li>
                        <li><a style="javascript:void();" class="filterByColumn" fil="1">Active</a></li>
                        <li><a style="cursor:pointer" class="filterByColumn" fil="0">Archive</a></li> -->


                    </ul>
                </div>
                <!--=============Button Area Right Side==============-->
                <div class="col-md-5 text-right btn_area">

                    <button type="button" class="btn dark_btn ml10" data-toggle="modal"
                            data-target="#addChatShortcutListN"><i
                            class="icon-plus3"></i><span> &nbsp;  Add Shortcut</span></button>


                </div>
            </div>
        </div>

        <!--&&&&&&&&&&&& TABBED CONTENT &&&&&&&&&&-->
        @if (!empty($getChatShortcut))
            <div class="tab-content">
                <!--===========TAB 1===========-->
                <div class="tab-pane active" id="right-icon-tab0">
                    <div class="row">
                        <div class="col-md-12">
                            <div style="margin: 0;" class="panel panel-flat">

                                <div class="panel-heading"> <span class="pull-left">
                                <h6 class="panel-title"> Shortcuts</h6>
                            </span>

                                    <div class="heading-elements">
                                        <div style="display: inline-block; margin: 0;"
                                             class="form-group has-feedback has-feedback-left">
                                            <input class="form-control input-sm cus_search" tableID="chatShortcut"
                                                   placeholder="Search by name" type="text">
                                            <div class="form-control-feedback"><i class="icon-search4"></i></div>
                                        </div>

                                        <div class="table_action_tool">
                                            <a href="javascript:void(0);"><i class="icon-calendar2"></i></a>
                                            <a href="javascript:void(0);" class="editDataQuestion"><i
                                                    class="icon-pencil4"></i></a>
                                            <a href="javascript:void(0);" style="display: none;" id="deleteChatShortcut"
                                               class="custom_action_box"><i class="icon-trash position-left"></i></a>
                                        </div>

                                    </div>
                                </div>

                                <div class="panel-body p0">

                                    <!-- Table data -->

                                    <table class="table datatable-basic-new" id="chatShortcut">
                                        <thead>
                                        <tr>
                                            <th style="display: none;"></th>
                                            <th style="display: none;"></th>
                                            <th style="display: none;" class="nosort editAction"><label
                                                    class="custmo_checkbox pull-left"><input type="checkbox"
                                                                                             name="checkAll[]"
                                                                                             class="control-primary"
                                                                                             id="checkAll"><span
                                                        class="custmo_checkmark"></span></label></th>
                                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_click_10.png"></i>Name
                                            </th>
                                            <th><i class=""><img
                                                        src="{{ base_url() }}assets/images/icon_star_10.png"></i>Conversatation
                                            </th>
                                            <th><i class=""><img
                                                        src="{{ base_url() }}assets/images/icon_created.png"></i>Created
                                            </th>

                                            <th class="text-center nosort sorting_disabled">&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <!--================================================-->
                                        @php
                                            if (!empty($getChatShortcut)) {
                                                $inc = 1;
                                                foreach ($getChatShortcut as $cShortcut) {

                                        @endphp
                                        <tr>
                                            <td style="display: none;">{{ date('m/d/Y', strtotime($cShortcut->created)) }}</td>
                                            <td style="display: none;">{{ $cShortcut->id }}</td>
                                            <td style="width: 40px!important; display: none;" class="editAction"><label
                                                    class="custmo_checkbox pull-left"><input type="checkbox"
                                                                                             name="checkRows[]"
                                                                                             class="checkRows"
                                                                                             id="chk{{ $cShortcut->id }}"
                                                                                             value="{{ $cShortcut->id }}"><span
                                                        class="custmo_checkmark"></span></label></td>

                                            <td>
                                                <div class="media-left">
                                                    <div><a href="javascript:void(0);"
                                                            class="text-default text-semibold">{{ $cShortcut->name }}</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div
                                                    class="text-muted">{!! setStringLimit($cShortcut->conversatation, 111) !!}</div>
                                            </td>


                                            <td>
                                                <div class="media-left">
                                                    <div class="pt-5"><a href="#"
                                                                         class="text-muted">{!! dataFormat($cShortcut->created).' '.date('h:iA', strtotime($cShortcut->created)) !!}</a>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="text-right">
                                                <div class="media-left pt-5 pull-right">
                                                    <div class="tdropdown ml10"><a class="table_more dropdown-toggle"
                                                                                   data-toggle="dropdown"
                                                                                   aria-expanded="false"><img
                                                                src="{{ base_url() }}assets/images/more.svg"></a>
                                                        <ul style="right: 0;"
                                                            class="dropdown-menu dropdown-menu-right status">
                                                            <!-- <li><a href="#"><i class="icon-primitive-dot txt_green"></i> Active</a> </li>
                                                            <li><a href="#"><i class="icon-primitive-dot txt_grey"></i> Disable</a> </li>
                                                            <li><a href="#"><i class="icon-primitive-dot txt_red"></i> Archive</a> </li> -->
                                                            @if ($canWrite)
                                                                <li><a href="javascript:void(0);"
                                                                       class="editChatShortcut"
                                                                       shortcutid="{{ $cShortcut->id }}"><i
                                                                            class="icon-pencil"></i> Edit</a></li>
                                                                <li><a href="javascript:void(0);"
                                                                       class="deleteChatShortcut"
                                                                       shortcutid="{{ $cShortcut->id }}"><i
                                                                            class="icon-trash"></i> Delete</a></li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="media-left pull-right">
                                                    <div class="pt-5"><a href="javascript:void(0);"
                                                                         class="text-semibold txt_dark">
                                                            @if ($cShortcut->status == 0)
                                                                {{ 'Inactive' }}
                                                            @elseif ($cShortcut->status == 2) {
                                                            {{ 'Pending' }}
                                                            @else
                                                                {{ 'Active' }}
                                                            @endif
                                                            &nbsp;<i class="fa fa-circle txt_green"
                                                                     style="font-size: 7px;"></i></a></div>
                                                </div>
                                            </td>


                                        </tr>
                                        @php
                                            $inc++;
                                        }
                                    }
                                        @endphp

                                        </tbody>
                                    </table>


                                    <!-- End Table data -->


                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        @else
            <div class="tab-content">
                <!--===========TAB 1===========-->
                <div class="tab-pane active" id="right-icon-tab0">
                    <div class="row">
                        <div class="col-md-12">
                            <div style="margin: 0;" class="panel panel-flat">

                                <div class="panel-heading"> <span class="pull-left">
                                <h6 class="panel-title"> Shortcuts</h6>
                            </span>

                                    <div class="heading-elements">
                                        <div style="display: inline-block; margin: 0;"
                                             class="form-group has-feedback has-feedback-left">
                                            <input class="form-control input-sm cus_search" tableID="chatShortcut"
                                                   placeholder="Search by name" type="text">
                                            <div class="form-control-feedback"><i class="icon-search4"></i></div>
                                        </div>

                                        <div class="table_action_tool">
                                            <a href="javascript:void(0);"><i class="icon-calendar2"></i></a>
                                            <a href="javascript:void(0);" class="editDataQuestion"><i
                                                    class="icon-pencil4"></i></a>
                                            <a href="javascript:void(0);" style="display: none;" id="deleteChatShortcut"
                                               class="custom_action_box"><i class="icon-trash position-left"></i></a>
                                        </div>

                                    </div>
                                </div>

                                <div class="panel-body p0">

                                    <!-- Table data -->

                                    <table class="table datatable-basic">
                                        <thead>
                                        <tr>
                                            <th style="display: none;"></th>
                                            <th style="display: none;"></th>
                                            <th style="display: none;" class="nosort editAction"><label
                                                    class="custmo_checkbox pull-left"><input type="checkbox"
                                                                                             name="checkAll[]"
                                                                                             class="control-primary"
                                                                                             id="checkAll"><span
                                                        class="custmo_checkmark"></span></label></th>
                                            <th><i class=""><img src="{{ base_url() }}assets/images/icon_click_10.png"></i>Name
                                            </th>
                                            <th><i class=""><img
                                                        src="{{ base_url() }}assets/images/icon_star_10.png"></i>Conversatation
                                            </th>
                                            <th><i class=""><img
                                                        src="{{ base_url() }}assets/images/icon_created.png"></i>Created
                                            </th>

                                            <th class="text-center nosort sorting_disabled">&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <td style="display: none"></td>
                                        <td style="display: none"></td>
                                        <td style="display: none"></td>
                                        <td colspan="10">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div style="margin: 20px 0px 0;" class="text-center">
                                                        <h5 class="mb-20 mt40">
                                                            Looks Like You Don’t Have Any Chat Shortcut Yet <img
                                                                src="{{ site_url('assets/images/smiley.png') }}"> <br>
                                                            Lets Create Your First Chat Shortcut.
                                                        </h5>

                                                        @if ($canWrite)
                                                            <button
                                                                @if ($bActiveSubsription == false)
                                                                title="No Active Subscription"
                                                                class="btn bl_cust_btn btn-default dark_btn ml20 pDisplayNoActiveSubscription mb40"
                                                                @else
                                                                id="addChatshortcut"
                                                                class="btn bl_cust_btn btn-default dark_btn ml20 mb40"
                                                                @endif
                                                                type="button"><i class="icon-plus3"></i> Add Shortcut
                                                            </button>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="display: none"></td>
                                        <td style="display: none"></td>
                                        <td style="display: none"></td>
                                        </tbody>
                                    </table>


                                    <!-- End Table data -->


                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
    @endif
    <!--================================= CONTENT AFTER TAB===============================-->


    </div>


    <!--=====================================Add Chat Shortcut Modal Popup================================-->
    <div id="addChatShortcutListN" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" class="form-horizontal" id="frmShortListModalN">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h5 class="modal-title"><img src="{{ base_url() }}assets/images/menu_icons/Chat_Color.svg"> Add
                            new shortcut &nbsp; <!--<i class="icon-info22 fsize12 txt_grey"></i>--></h5>
                        <p class="fsize12 txt_grey mt10 mb10" style="max-width: 370px;">Create a new shortcut. Give it a
                            ! symbol, and write a message for this shortcut. Then, use conversations to quickly answer
                            to visitors using the shortcut ! symbol. </p>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Shortcut</label>
                                    <div class="">
                                        <input placeholder="!shortname" name="shortname" id="shortname"
                                               class="form-control h52" type="text" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb0">
                                    <label class="control-label">Conversatation</label>
                                    <div class="">
                                        <textarea class="form-control p20" name="conversatation"
                                                  style="resize: none; min-height: 130px;" id="conversatation"
                                                  required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn dark_btn bkg_sblue fsize14 h52"><i class="icon-plus3"></i>
                            &nbsp; Add Shortcut
                        </button>
                        <button data-dismiss="modal" class="close" data-dismiss="modal"
                                class="close btn btn-link fsize14 txt_blue h52">Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--=====================================Add Chat Shortcut Modal Popup End================================-->


    <!--=====================================Update Modal Popup================================-->
    <div id="updateChatShortcutList" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" class="form-horizontal" id="frmUpdateShortListModal">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h5 class="modal-title"><img src="{{ base_url() }}assets/images/menu_icons/Chat_Color.svg">
                            Update shortcut &nbsp; <!--<i class="icon-info22 fsize12 txt_grey"></i>--></h5>
                        <p class="fsize12 txt_grey mt10 mb10" style="max-width: 370px;">Update shortcut. Give it a !
                            symbol, and write a message for this shortcut. Then, use conversations to quickly answer
                            to visitors using the shortcut ! symbol. </p>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Shortcut</label>
                                    <div class="">
                                        <input placeholder="!shortname" name="edit_shortname" id="edit_shortname"
                                               class="form-control h52" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb0">
                                    <label class="control-label">Conversatation</label>
                                    <div class="">
                                        <textarea class="form-control p20" name="edit_conversatation"
                                                  style="resize: none; min-height: 130px;"
                                                  id="edit_conversatation"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="chatshortcut_id" id="chatshortcut_id">
                        <button type="submit" class="btn dark_btn bkg_sblue fsize14 h52"><i class="icon-plus3"></i>
                            &nbsp; Update Shortcut
                        </button>
                        <button type="button" class="close" data-dismiss="modal"
                                class="btn btn-link fsize14 txt_blue h52">Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--=====================================Update Modal Popup End================================-->



    <script>
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

            $(document).on('click', '#deleteChatShortcut', function () {

                var val = [];
                $('.checkRows:checkbox:checked').each(function (i) {
                    val[i] = $(this).val();
                });
                if (val.length === 0) {
                    alert('Please select a row.')
                } else {

                    deleteConfirmationPopup(
                        "This question will deleted immediately.<br>You can't undo this action.",
                        function () {

                            $('.overlaynew').show();
                            $.ajax({
                                url: "{{ base_url('admin/chatshortcut/deleteMultipalChatShortcut') }}",
                                type: "POST",
                                data: {multiChatShortcutid: val, _token: '{{csrf_token()}}'},
                                dataType: "json",
                                success: function (data) {
                                    if (data.status == 'success') {
                                        location.reload();
                                    } else {
                                        alert("Having some error.");
                                    }
                                },
                                error: function (error) {
                                    console.log(error);
                                }
                            });
                        });

                }

            });


            $(document).on('click', '#addChatshortcut', function () {
                $('#addChatShortcutListN').modal();
            });

            $('#chatShortcut thead tr').clone(true).appendTo('#chatShortcut thead');

            var tableId = 'chatShortcut';
            var tableBase = custom_data_table(tableId);

            $('table thead tr:eq(1)').hide();


            $("#frmShortListModalN").submit(function () {
                var formdata = $("#frmShortListModalN").serialize();
                $.ajax({
                    url: "{{ base_url('admin/chatshortcut/addShortCut') }}",
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

            $("#frmUpdateShortListModal").submit(function () {
                var formdata = $("#frmUpdateShortListModal").serialize();
                $.ajax({
                    url: "{{ base_url('admin/chatshortcut/updateShortCut') }}",
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

            $(document).on('click', '.editChatShortcut', function () {
                var shortcutID = $(this).attr('shortcutid');
                $.ajax({
                    url: "{{ base_url('admin/chatshortcut/getChatShortcutById') }}",
                    type: "POST",
                    data: {shortcutID: shortcutID, _token: '{{csrf_token()}}'},
                    dataType: "json",
                    success: function (data) {

                        if (data.status == 'success') {
                            var chatShortcutData = data.result[0];

                            $('#chatshortcut_id').val(chatShortcutData.id);
                            $('#edit_shortname').val(chatShortcutData.name);
                            $('#edit_conversatation').val(chatShortcutData.conversatation);
                            $("#updateChatShortcutList").modal();

                        } else {

                        }
                    }
                });
            });


            $(document).on('click', '.deleteChatShortcut', function () {

                var shortcutId = $(this).attr('shortcutid');

                deleteConfirmationPopup(
                    "This Shortcut will deleted immediately.<br>You can't undo this action.",
                    function () {

                        $('.overlaynew').show();
                        $.ajax({
                            url: "{{ base_url('admin/chatshortcut/deleteChatShortcut') }}",
                            type: "POST",
                            data: {shortcutId: shortcutId, _token: '{{csrf_token()}}'},
                            dataType: "json",
                            success: function (data) {
                                if (data.status == 'success') {
                                    location.reload();
                                } else {
                                    alert("Having some error.");
                                }
                            },
                            error: function (error) {
                                console.log(error);
                            }
                        });
                    });

            });

            $(document).on('click', '.editDataQuestion', function () {
                $('.editAction').toggle();
            });


        });
    </script>
@endsection
