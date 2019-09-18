@extends('layouts.main_template')

@section('title')
{{ $title }}
@endsection

@section('contents')

@php
$disableRemaining = false;
$rewards = '';
$emailWorkflow = '';
$campaign = '';
$reviews = '';
$integrationClass = '';
$setTab = !(empty($setTab)) ? $setTab : '';
$selectedTab = !(empty($selectedTab)) ? $selectedTab : '';
$bCustomizeTab = !empty($bCustomizeTab) ? $bCustomizeTab : '';
$bWidgetTab = !empty($bWidgetTab) ? $bWidgetTab : '';
$bWorkflowTab = !empty($bWorkflowTab) ? $bWorkflowTab : '';
$bPeopleTab = !empty($bPeopleTab) ? $bPeopleTab : '';
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
    $rs = 'active';
}
@endphp

<style>
    #uploadedbrandlogo .dropzone .dz-preview:hover .dz-image img { filter:none !important;-webkit-filter:!important;}
</style>
<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-7">
                <h3><img style="width: 19px;" src="/assets/images/nps_icon.png">{{ $title }} {{ (!empty($oNPS)) ? ': ' . $oNPS->title : '' }}</h3>

                <ul class="nav nav-tabs nav-tabs-bottom" id="nav-tabs-bottom">
                    @if (empty($oNPS->platform))
                        <li class="@if ($defalutTab == 'platform') {{'active'}} @php $disableRemaining = true; @endphp @endif">
                            <a href="#right-icon-tab1" data-toggle="tab">Source</a>
                        </li>
                    @endif
                    <li class="@if ($defalutTab == 'customize') {{'active'}} @php $disableRemaining = true @endphp @endif">
                        <a href="@if ($disableRemaining == false || $defalutTab == 'customize') @php $bCustomizeTab = true @endphp#right-icon-tab2 @else javascript:void(0); @endif" data-toggle="tab">Configuration</a></li>


                    @if ($oNPS->platform != 'web' && $oNPS->platform != 'link')
                        <li class="@if ($defalutTab == 'workflow'){{'active'}} @php $disableRemaining = true;@endphp @endif">
                            <a href="@if ($disableRemaining == false || $defalutTab == 'workflow') @php $bWorkflowTab = true; @endphp#right-icon-tab3 @else javascript:void(0); @endif" data-toggle="tab">Workflow</a>
                        </li>


                        <li class="@php
                        if ($defalutTab == 'people') {
                            echo 'active';
                            $disableRemaining = true;
                        }
                        @endphp"><a href="@php
                                if ($disableRemaining == false || $defalutTab == 'people') {
                                    $bPeopleTab = true;
                                    @endphp #right-icon-tab4 @php } else { @endphp javascript:void(0); @php } @endphp " data-toggle="tab">Contacts</a>
                        </li>

                    @endif

                    @if ($oNPS->platform == 'link')
                        <li class="@if ($defalutTab == 'widgets') {{'active'}} @php $disableRemaining = true; @endphp @endif">
                            <a href="@if ($disableRemaining == false || $defalutTab == 'widgets') @php $bWidgetTab = true @endphp#right-icon-tab6 @else javascript:void(0); @endif" data-toggle="tab">Setup Link</a>
                        </li>
                    @endif

                    @if ($oNPS->platform == 'web')
                        <li class="@if ($defalutTab == 'widgets') {{'active'}} @php $disableRemaining = true; @endphp @endif">
                            <a href="@if ($disableRemaining == false || $defalutTab == 'widgets') @php $bWidgetTab = true; @endphp#right-icon-tab6 @else javascript:void(0) @endif" data-toggle="tab">Widget</a>
                        </li>
                    @endif

                    <li class="@if ($defalutTab == 'score') {{'active'}} @php $disableRemaining = true; @endphp @endif">
                        <a href="@if ($disableRemaining == false || $defalutTab == 'widgets') @php $bScoreTab = true; @endphp #right-icon-tab5 @else javascript:void(0) @endif" data-toggle="tab">Scores</a>
                    </li>
                </ul>


            </div>
            <!--=============Button Area Right Side==============-->

			<div class="col-md-5 text-right btn_area">

				<button type="button" style="padding: 7px 15px!important;" class="btn dark_btn publishNPSCampaignStatus" status="draft"><i class="icon-plus3"></i><span> &nbsp;  Save as Draft</span> </button>

				<button type="button" style="padding: 7px 15px!important;" class="btn dark_btn publishNPSCampaignStatus" status="active"><i class="icon-plus3"></i><span> &nbsp;  Publish</span> </button>

			</div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->

    <div class="tab-content">
        <!--########################TAB 1 ##########################-->
        @if (empty($oNPS->platform))
            @include('admin.modules.nps.nps-tabs.choose-platform', array('userID' => $userID, 'defalutTab' => $defalutTab, 'programID' => $programID))
        @endif

		<!--########################TAB 2 ##########################-->
        @if ($bCustomizeTab == true)
            @include('admin.modules.nps.nps-tabs.customization', array('userID' => $userID, 'defalutTab' => $defalutTab, 'programID' => $programID, 'oNPS' => $oNPS))
        @endif

        <!--########################TAB 3 ##########################-->
        @if ($bWidgetTab == true)
            @include('admin.modules.nps.nps-tabs.widget_code', array('userID' => $userID, 'defalutTab' => $defalutTab, 'programID' => $programID, 'oNPS' => $oNPS))
        @endif

        <!--########################TAB 4 ##########################-->
        @if ($bWorkflowTab == true)
            @include('admin.modules.nps.nps-tabs.reward-workflow-beta', array('emailWorkflow' => $emailWorkflow, 'oEvents' => $oEvents))
        @endif

        <!--########################TAB 5 ##########################-->
        @if ($bPeopleTab == true)
            @include('admin.modules.nps.nps-tabs.contacts', array('userID' => $userID, 'defalutTab' => $defalutTab, 'programID' => $programID, 'oNPS' => $oNPS, 'oContacts' => $oContacts))
        @endif

        <!--########################TAB 6 ##########################-->
        @include('admin.modules.nps.nps-tabs.score', array('userID' => $userID, 'defalutTab' => $defalutTab, 'programID' => $programID, 'oNPS' => $oNPS, 'oFeedbacks' => $oFeedbacks))
    </div>
</div>

@include('admin.modals.workflow2.workflow-popup', array('oDefaultTemplates' => $oDefaultTemplates))

<div id="addSubscriber" class="modal fade">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-user"></i>&nbsp; Contacts</h5>
            </div>
            <div class="modal-body">
                <div class="panel-body">

                    <form name="frmInviteCustomer" id="frmInviteCustomer" method="post" action="" >
                        @csrf
                        <input type="hidden" name="userid" value="{{$userID}}" />
                        <input type="hidden" name="bbaid" value="{{$oNPS->hashcode}}" />
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
                                    <input name="phone" id="phone" value="" class="form-control" type="text">
                                </div>
                            </div>

                            <button class="btn btn-success pull-right" id="btnInvite" type="submit">
                                Invite Advocates
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="importCSV" class="modal fade">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-user"></i>&nbsp; Invite via Import</h5>
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    <form name="frmInviteBulkCustomer" id="frmInviteBulkCustomer"  method="post" action="" enctype="multipart/form-data" >
                        @csrf
                        <input type="hidden" name="userid" value="{{$userID}}" />
                        <input type="hidden" name="bbaid" value="{{$oNPS->hashcode}}" />

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
                            Import People
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(document).on("click", ".logo_img", function () {
            $(".dz-remove").trigger("click");
            $("#myDropzone_logo_img").trigger("click");
            $("#uploadedbrandlogo").hide();
            $("#uploadbrandlogo").show();
        });

        $(document).on("click", ".dz-remove", function () {
            $("#uploadedbrandlogo").hide();
            $("#uploadbrandlogo").show();
            $('input[name="brand_logo"]').val('');
        });


        $("#frmInviteCustomer").submit(function () {
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $('#btnInvite').prop("disabled", true);
            $.ajax({
                url: "{{ base_url('admin/modules/nps/registerInvite') }}",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    $('.overlaynew').hide();
                    if (data.status == 'success') {
                        window.location.href = window.location.href;
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
                url: "{{ base_url('admin/modules/nps/importInviteCSV') }}",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = window.location.href;
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
            return false;
        });


        $("#publishNPSCampaign").click(function () {
            $.ajax({
                url: "{{ base_url('admin/modules/nps/publishNPSCampaign') }}",
                type: "POST",
                data: {_token: '{{csrf_token()}}', 'npsId': "{{ $oNPS->id }}"},
                dataType: "html",
                success: function (data) {
                    window.location.href = "{{ base_url('admin/modules/nps/') }}";
                }, error: function () {
                    alertMessage('Error: Some thing wrong!');
                }
            });
        });


        $(document).on('click', '.publishNPSCampaignStatus', function () {
            var status = $(this).attr('status');
            $.ajax({
                url: "{{ base_url('admin/modules/nps/publishNPSCampaignStatus') }}",
                type: "POST",
                data: {_token: '{{csrf_token()}}', 'npsId': "{{ $oNPS->id }}", 'status': status},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        if (status == 1) {
                            displayMessagePopup();
                        } else {
                            displayMessagePopup();
                        }
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        });
    });
</script>
@endsection
