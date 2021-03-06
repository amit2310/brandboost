@extends('layouts.main_template') 

@section('title')
{{ $title }}
@endsection

@section('contents')
<div class="content">



    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-7">
                <h3 class="mt20"><img src="{{ base_url() }}assets/images/menu_icons/Email_Light.svg"> {{ $oAutomations[0]->title }}</h3>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-5 text-right btn_area">

                <button type="button" class="btn dark_btn ml10 saveAsDraft" automation_id="{{ $oAutomations[0]->id }}">
                    <i class="icon-plus3"></i>
                    <span>&nbsp;Save as Draft</span>                   

                </button>

                <button type="button" class="btn dark_btn ml10 publishAutoEvent" automation_id="{{ $oAutomations[0]->id }}">
                    <i class="icon-plus3"></i>
                    <span>&nbsp;Publish</span>                   

                </button>




            </div>
        </div>
    </div>
    @include('admin.workflow2.tree', ['oEvents' => $oEvents])


</div>
@php
$oDefaultTemplates = !(empty($oDefaultTemplates)) ? $oDefaultTemplates : array();
@endphp
@include('admin.modals.workflow2.workflow-popup', ['oDefaultTemplates' => $oDefaultTemplates])

<script>

    $(document).on("click", ".chooseListModule", function () {
        $("#chooselistModal").modal();
    });

    $('#frmSaveAutomationList').on('submit', function () {
        $('.overlaynew').show();
        var formdata = $("#frmSaveAutomationList").serialize();
        $.ajax({
            url: '/admin/modules/emails/updateAutomationLists',
            type: "POST",
            data: formdata,
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $('.overlaynew').hide();
                    window.location.href = window.location.href;
                }

            }
        });
        return false;
    });

    $('.publishAutoEvent').click(function () {
        $('.overlaynew').show();
        var automationID = $(this).attr('automation_id');
        $.ajax({
            url: "{{ base_url('admin/modules/emails/publishAutomationEvent') }}",
            type: "POST",
            data: {_token: '{{csrf_token()}}', 'automation_id': automationID},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $('.overlaynew').hide();
                    displayMessagePopup('success', 'Success', 'Campaign published successfully!');
                    //window.location.href = "{{ base_url('admin/modules/emails') }}';
                }
            }
        });
    });


    $('.saveAsDraft').click(function () {
        $('.overlaynew').show();
        var automationID = $(this).attr('automation_id');
        $.ajax({
            url: "{{ base_url('admin/modules/emails/publishAsDraft') }}",
            type: "POST",
            data: {_token: '{{csrf_token()}}', 'automation_id': automationID},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $('.overlaynew').hide();
                    displayMessagePopup('success', 'Success', 'Campaign saved a draft!');
                    //window.location.href = "{{ base_url('admin/modules/emails') }}';
                }
            }
        });
    });

</script>
@endsection

