@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')
<!-- Content area -->
<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->

    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-3">
                <h3><i class="icon-star-half"></i> NPS Widgets Setup</h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="active"><a href="#right-icon-tab0" data-toggle="tab">Configuration</a></li>
                    <li><a href="#right-icon-tab1" data-toggle="tab">Integration</a></li>
                </ul>
            </div>

        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->


    <div class="tab-content">
        <!--===========TAB 1===========-->
        <div class="tab-pane active" id="right-icon-tab0">
            @include('admin.modules.nps.widget-tabs.nps-setup')
        </div>

        <!--===========TAB 2===========-->
        <div class="tab-pane" id="right-icon-tab1">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Marketing campaigns -->
                    <div class="panel panel-flat">
                        @include('admin.modules.nps.widget-tabs.nps-integration')
                    </div>
                </div>
            </div>
        </div>
    </div>            


    <!-- /dashboard content -->

</div>
<!-- /content area -->
@endsection