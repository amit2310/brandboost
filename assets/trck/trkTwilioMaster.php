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
$settingsID = strip_tags($_REQUEST['bb_settings_id']);
$referralID = strip_tags($_REQUEST['bb_referral_id']);
$npsID = strip_tags($_REQUEST['bb_nps_id']);
$brandboostID = strip_tags($_REQUEST['bb_id']);
$automationID = strip_tags($_REQUEST['auto_id']);
$broadcastID = strip_tags($_REQUEST['broadcast_id']);
$campaignID = strip_tags($_REQUEST['bb_campaign_id']);
$moduleName = strip_tags($_REQUEST['modname']);
$sendingMethod = strip_tags($_REQUEST['bb_sending_method']);
$sendingMethod = ($sendingMethod) ? $sendingMethod : 'normal';

$created = date("Y-m-d H:i:s", strtotime('+5 hours'));

$aData = array(
    'event_name' => $aParams['SmsStatus'],
    'to_number' => '+' . trim($aParams['To']),
    'from_number' => '+' . trim($aParams['From']),
    'subscriber_id' => $subscriberID,
    'event_id' => $bbEventID,
    'campaign_id' => $campaignID,
    'account_sid' => $aParams['AccountSid'],
    'created' => $created
);
if ($moduleName == 'email') {
    $aData['automation_id'] = $automationID;
    saveTrackingData('tbl_automations_emails_tracking_twillio', $aData);
} else if ($moduleName == 'email_broadcast' || $moduleName == 'sms_broadcast') {
    $aData['broadcast_id'] = $broadcastID;
    $aData['sending_method'] = $sendingMethod;
    saveTrackingData('tbl_broadcast_emails_tracking_twillio', $aData);
} else if ($moduleName == 'referral') {
    $aData['referral_id'] = $referralID;
    saveTrackingData('tbl_referral_automations_tracking_twillio', $aData);
} else if ($moduleName == 'nps') {
    $aData['nps_id'] = $npsID;
    saveTrackingData('tbl_nps_automations_tracking_twillio', $aData);
    $npsStep = 1;
} else {
    $aData['brandboost_id'] = $brandboostID;
    saveTrackingData('tbl_track_twillio', $aData);
}

if ($aParams['SmsStatus'] == 'delivered') {
    $aStoreSMS = array(
        'msg' => db_in($aParams['Body']),
        'to' => db_in('+' . trim($aParams['To'])),
        'from' => db_in('+' . trim($aParams['From'])),
        'module_name' => db_in($moduleName),
        'subscriber_id' => db_in($subscriberID),
        'event_id' => db_in($bbEventID),
        'automation_id' => db_in($automationID),
        'nps_id' => db_in($npsID),
        'nps_step' => $npsStep,
        'referral_id' => db_in($referralID),
        'brandboost_id' => db_in($brandboostID),
        'created' => date("Y-m-d H:i:s", strtotime('+5 hours'))
    );
    saveTrackingData('tbl_chat_sms_thread', $aStoreSMS);
}
?>