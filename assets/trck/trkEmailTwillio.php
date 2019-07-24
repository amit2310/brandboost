<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
include 'functions.php';
//$a = $_POST;
$a = file_get_contents("php://input");
if (!empty($a)) {
    $urlResponse = urldecode($a);
    parse_str($urlResponse, $aParams);
}

$subscriberID = strip_tags($_REQUEST['bb_subscriber_id']);
$bbEventID = strip_tags($_REQUEST['bb_event_id']);
$brandboostID = strip_tags($_REQUEST['bb_id']);
$campaignID = strip_tags($_REQUEST['bb_campaign_id']);

$created = date("Y-m-d H:i:s");

$aData = array(
    'event_name' => $aParams['SmsStatus'],
    'to_number' => $aParams['To'],
    'from_number' => $aParams['From'],
    'subscriber_id' => $subscriberID,
    'brandboost_id' => $brandboostID,
    'event_id' => $bbEventID,
    'campaign_id' => $campaignID,
    'account_sid' => $aParams['AccountSid'],
    'created' => $created
);
saveTrackingData('tbl_track_twillio', $aData);
?>