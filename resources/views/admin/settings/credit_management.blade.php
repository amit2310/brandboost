@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')
<div class="content">
    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-7">
                <h3><i class="icon-star-half"></i> &nbsp;<?php echo $title; ?></h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="<?php if (empty($seletedTab)): ?>active<?php endif; ?>"><a href="#right-icon-tab0" data-toggle="tab">Credit Properties</a></li>
                    <li class="<?php if ($seletedTab == 'history'): ?>active<?php endif; ?>"><a href="#right-icon-tab1" data-toggle="tab"> Credit History</a></li>
                </ul>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-5 text-right btn_area">
<!--                <button type="button" class="btn light_btn" data-toggle="modal" data-target="#addSystemNotificationTemplate"><i class="icon-arrow-up16"></i><span> &nbsp;  Add System Notification</span> </button>
                <button type="button" class="btn light_btn" data-toggle="modal" data-target="#addEmailNotificationTemplate"><i class="icon-arrow-up16"></i><span> &nbsp;  Add Email Notification</span> </button>-->
            </div>

        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->

    <div class="tab-content">
        @include("admin.settings.credit-tabs/manage-credit")
        @include("admin.settings.credit-tabs.credit-history")

    </div>    

</div>
@endsection


