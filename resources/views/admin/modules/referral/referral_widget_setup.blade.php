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
                <h3><i class="icon-star-half"></i> Referral Widgets Setup</h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="active"><a href="#right-icon-tab_setup" data-toggle="tab">Configuration</a></li>
                    <li><a href="#right-icon-tab_integration" data-toggle="tab">Integration</a></li>
				</ul>
			</div>
            
		</div>
	</div>
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->
	
	
    <div class="tab-content">
		<!--===========TAB 1===========-->
		<div class="tab-pane active" id="right-icon-tab_setup">
			@include('admin.modules.referral.widget-tabs.referral-setup')
		</div>
		
		<!--===========TAB 2===========-->
		<div class="tab-pane" id="right-icon-tab_integration">
			@include('admin.modules.referral.widget-tabs.referral-integration')
		</div>
	</div>            
	
	
    <!-- /dashboard content -->
	
</div>
<!-- /content area -->
<script>
function copyToClipboard(element) {
	console.log(element);
	var $temp = $("<input>");
	$("body").append($temp);
	var widgetScript = String($(element).text());
	$temp.val(widgetScript).select();
	document.execCommand("copy");
	$temp.remove();
}
</script>
@endsection