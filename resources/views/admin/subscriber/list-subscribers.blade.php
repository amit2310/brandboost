@extends('layouts.main_template') 

@section('title')
	{{ $title }}
@endsection

@section('contents')

<!-- Content area -->
<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-3">
                <h3><img src="{{ base_url() }}assets/images/people_sec_icon.png"> Contacts</h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="active"><a href="#right-icon-tab0" data-toggle="tab">Active Contacts</a></li>
                    <li><a href="#right-icon-tab1" data-toggle="tab">Archive</a></li>
                </ul>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-9 text-right btn_area">
                <button type="button" class="btn light_btn importModuleContact" data-modulename="{{ $moduleName }}" data-moduleaccountid="{{ $moduleUnitID }}" data-redirect="{{ base_url() }}admin/contacts/mycontacts"><i class="icon-arrow-up16"></i><span> &nbsp;  Import Contacts</span> </button>
                <a class="btn light_btn ml10" href="{{ base_url() }}admin/subscriber/exportSubscriberCSV?module_name={{ $moduleName }}&module_account_id={{  $moduleUnitID }}"><i class="icon-arrow-down16"></i><span> &nbsp;  Export Contacts</span> </a>
                <button type="button" class="btn dark_btn dropdown-toggle ml10 addModuleContact" data-modulename="{{ $moduleName }}" data-moduleaccountid="{{ $moduleUnitID }}"><i class="icon-plus3"></i><span> &nbsp;  Add Contact</span> </button>  
                &nbsp;
            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->

    <div class="tab-content"> 
        <!--===========TAB 1===========-->
        @include('admin.workflow2.workflow_subscribers', array('showArchived' => true));
    </div>
</div>

<!-- /content area -->

@endsection



