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
            <div class="col-md-7">
                <h3><i class="icon-star-half"></i> &nbsp;{{ $title }}</h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="@if (empty($seletedTab)) active @endif "><a href="#right-icon-tab0" data-toggle="tab">Credit Properties</a></li>
                    <li class="@if ($seletedTab == 'history') active @endif "><a href="#right-icon-tab1" data-toggle="tab"> Credit History</a></li>
                </ul>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-5 text-right btn_area"> </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->
    <div class="tab-content">
        @include("admin.settings.credit-tabs/manage-credit")
        @include("admin.settings.credit-tabs.credit-history")
    </div>    
</div>
@endsection


