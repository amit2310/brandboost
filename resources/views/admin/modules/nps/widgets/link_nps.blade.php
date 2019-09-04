<html>
    <head>
        <title>Survey: @php if(!empty($oNPS->title)){ echo $oNPS->title; } else { echo ''; } @endphp</title>
		<style>
		body {background:#d5e0f2;font-size: 14px!important;	font-family: 'Inter UI';font-style: normal;	font-weight: 400;letter-spacing: 0;}
		</style>
		<script 
			type='text/javascript' 
			id='bbscriptloader' 
			data-key='{{ $accountID }}' 
			data-widgets='nps' 
			async='{{ base64_decode($sub_id) }}' 
			src='{{ base_url() }}assets/js/nps_widgets.js' > 
		</script> 
	</head>
	<body>
	</body>
</html>	