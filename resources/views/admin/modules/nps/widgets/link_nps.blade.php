<html>
    <head>
        <title>Survey: <?php echo $oNPS->title; ?></title>
		<style>
		body {background:#d5e0f2;font-size: 14px!important;	font-family: 'Inter UI';font-style: normal;	font-weight: 400;letter-spacing: 0;}
		</style>
		<script 
			type='text/javascript' 
			id='bbscriptloader' 
			data-key='<?php echo $accountID; ?>' 
			data-widgets='nps' 
			async='<?php echo base64_decode($sub_id); ?>' 
			src='<?php echo base_url(); ?>assets/js/nps_widgets.js' > 
		</script> 
	</head>
	<body>
	</body>
</html>	