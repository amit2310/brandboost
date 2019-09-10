@extends('layouts.main_template') 

@section('title')
	{{ $title }}
@endsection

@section('contents')

<div class="content">
    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-12">
                <h3><img style="width: 18px;" src="{{ base_url() }}assets/images/user_settings_icon.png"> Brand Settings</h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="@if(empty($seletedTab)) active @endif"><a href="#right-icon-tab0" data-toggle="tab">General</a></li>
                    <li class="@if($seletedTab=='prefer') active @endif"><a href="#right-icon-tab1" data-toggle="tab"> Preferences</a></li>
                    <li class="@if($seletedTab=='subs') active @endif"><a href="#right-icon-tab2" data-toggle="tab">Subscription & Credits</a></li>
                    <li class="@if($seletedTab=='billing') active @endif"><a href="#right-icon-tab3" data-toggle="tab">Billing</a></li>
                    <li class="@if($seletedTab=='notify') active @endif"><a href="#right-icon-tab4" data-toggle="tab">Notifications</a></li>
                    <li class="@if($seletedTab=='import') active @endif"><a href="#right-icon-tab5" data-toggle="tab">Import</a></li>
                    <li class="@if($seletedTab=='export') active @endif"><a href="#right-icon-tab6" data-toggle="tab">Export</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->


    <!--&&&&&&&&&&&& TABBED CONTENT START &&&&&&&&&&-->
    <div class="tab-content"> 
        <!--===========TAB 1====General=======-->
        @include('admin.settings.tabs.general')

        <!--===========TAB 2===Preferences========-->
        @include('admin.settings.tabs.preferences')

        <!--===========TAB 3====Subscription & Credits=======-->
        @include('admin.settings.tabs.subscription_credits')

        <!--===========TAB 4====Billing=======-->
        @include('admin.settings.tabs.billing')

        <!--===========TAB 5===========-->
        @include('admin.settings.tabs.notifications')

        <!--===========TAB 6===========-->
        @include('admin.settings.tabs.import')

        <!--===========TAB 7===========-->
        @include('admin.settings.tabs.export')
    </div>
    <!--&&&&&&&&&&&& TABBED CONTENT  END &&&&&&&&&&-->
</div>
<script>
    $(document).ready(function () {
        $("#frmGeneralBusinessInfo, #frmGeneralBusinessInfo2, #frmGeneralBusinessInfo3, #frmGeneralBusinessInfo4").submit(function () {
            var formData = $(this).serialize();
            $.ajax({
                url: "{{ base_url('webchat/settings/updateCompanyFormData') }}",
                type: "POST",
                data: formData,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        alertMessage("Updated Successfully!");
                    }
                }
            });
            return false;
        });
    });

    // top navigation fixed on scroll and side bar collasped

    $(window).scroll(function () {
        var sc = $(window).scrollTop();
        if (sc > 100) {
            $("#header-sroll").addClass("small-header");
        } else {
            $("#header-sroll").removeClass("small-header");
        }
    });

    function smallMenu() {
        if ($(window).width() < 1600) {
            $('body').addClass('sidebar-xs');
        } else {
            $('body').removeClass('sidebar-xs');
        }
    }

    $(document).ready(function () {
        smallMenu();

        window.onresize = function () {
            smallMenu();
        };
    });

</script>

@endsection