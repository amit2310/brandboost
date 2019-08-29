@extends('layouts.main_template') 

@section('title')
{{ echo $title }}
@endsection

@section('contents')
@php
	$rs = '';
	$setupClass = '';
	$StatsClass = '';
	$integrationClass = '';
	
	if ($setTab == 'Review Sources' || $selectedTab == 'Review Sources') {
		$rs = 'active';
		} else if ($setTab == 'Configure Widgets' || $selectedTab == 'Configure Widgets') {
		$setupClass = 'active';
		} else if (trim($setTab) == 'Integration' || $selectedTab == 'Integration') {
		$integrationClass = 'active';
		}else if (trim($setTab) == 'Statistics' || $selectedTab == 'Statistics') {
		$StatsClass = 'active';
		} else {
		$rs = 'active';
	}
@endphp
<div class="content">
    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
		@include('admin.components.smart-popup.smart-widget-type')
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-7">
                <h3><img src="{{ base_url() }}assets/images/onsite_icons.png"> On Site Widget Setup</h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="{{ $rs }}"><a href="#right-icon-tab1" data-toggle="tab">Review Widgets</a></li>
                    <li class="{{ $setupClass }}"><a href="#right-icon-tab2" data-toggle="tab">Configuration</a></li>
                    <li class="{{ $integrationClass }}"><a href="#right-icon-tab3" data-toggle="tab">Integration</a></li>
                    <li class="{{ $StatsClass }}"><a href="#right-icon-tab4" data-toggle="tab">Statistics</a></li>
				</ul>
			</div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-5 text-right btn_area">
				
			</div>
		</div>
	</div>
    <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->
	
    <div class="tab-content">
        <!--########################TAB 0 ##########################-->
		@include('admin.brandboost.campaign-tabs.widget.onsite-review-sources', array('rs' => $rs, 'widgetData' => $widgetData))
        <!--########################TAB 1 ##########################-->
		@include('admin.brandboost.campaign-tabs.widget.onsite-setup', array('camp' => $setupClass, 'widgetData' => $widgetData))
        <!--########################TAB 2 ##########################-->
		@include('admin.brandboost.campaign-tabs.widget.onsite-integration', array('campaign_key' => $widgetData->hashcode, 'sWidget' => $widgetData->widget_type, 'integrationClass' => $integrationClass))
        <!--########################TAB 3 ##########################-->
		@include('admin.brandboost.campaign-tabs.widget.onsite-widget-stats', array('campaign_key' => $widgetData->hashcode, 'sWidget' => $widgetData->widget_type, 'StatsClass' => $StatsClass, 'statsType' => 'aggregate'))
		
	</div>
	
</div>
<script type="text/javascript">
	
    $(document).ready(function () {
		
		$(document).on('change', '.autoSaveDesign', function() {
			$('.saveWidgetDesign').trigger('click');
		});
		
		$(document).on('change', '.autoSaveConfig', function() {
			$('.saveWidgetConfig').trigger('click');
		});
		
        $(document).on("click", "#campaignSetupStep", function () {
            $('.overlaynew').show();
            changeTab("Configure Widgets");
            setTimeout(function () {
                $('.overlaynew').hide();
                //$('.tabbable a[href="#right-icon-tab4"]').click();
			}, 1000);
		});
		
		
        $("#nav-tabs-bottom li").on('click', function () {
			
            var getActiveText = $(this).text();
            $.ajax({
                url: "{{ base_url('/admin/brandboost/setTab') }}",
                type: "POST",
                data: {getActiveText: getActiveText, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (response) {
                    if (response.status == 'error') {
                        window.location.href = "/admin/brandboost/onsite/";
					}
				},
                error: function (response) {
                    alertMessage("Something went wrong");
				}
			});
		});
		
        $(document).on('click', '.continueStepOnsite', function () {
            $('.overlaynew').show();
            var targetName = $(this).attr('targetName');
            changeTab(targetName);
		});
	});
	
	
	
    function changeTab(getActiveText) {
        $.ajax({
            url: "{{ base_url('/admin/brandboost/setTab') }}",
            type: "POST",
            data: {getActiveText: getActiveText, _token: '{{csrf_token()}}'},
            dataType: "json",
            success: function (response) {
                window.location.href = window.location.href;
			},
            error: function (response) {
                alertMessage("Something went wrong");
			}
		});
	}
    
    $(document).on("click", "#publishWidget", function () {
		$('.overlaynew').show();
		$.ajax({
			url: "{{ base_url('admin/brandboost/publishOnsiteWidget') }}",
			type: "POST",
			data: {'widgetID': '{{ $widgetData->id }}', _token: '{{csrf_token()}}'},
			dataType: "json",
			success: function (data) {
				if (data.status == 'success') {
					window.location.href = "{{ base_url('admin/brandboost/widgets') }}";
                } else {
					//alertMessage('Error: Some thing wrong!');
					displayMessagePopup('error');
				}
				$('.overlaynew').hide();
			}
		});
	});
</script>
@endsection