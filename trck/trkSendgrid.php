<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
include 'functions.php';
//$a = $_POST;
$a = file_get_contents("php://input");
//$aData = array(
//    'content' => 'check-1' . json_encode($a),
//    'qs' => $a
//);
//saveTrackingData('test', $aData);
try {
    if (!empty($a)) {
        $aResponse = json_decode($a);
        if (!empty($aResponse)) {
            foreach ($aResponse as $oResponseData) {
                $eventName = $oResponseData->event;

                if (!empty($eventName)) {
                    $subscriberID = isset($oResponseData->bb_subscriber_id) ? $oResponseData->bb_subscriber_id : '';
                    $bbEventID = isset($oResponseData->bb_event_id) ? $oResponseData->bb_event_id : '';
                    $brandboostID = isset($oResponseData->bb_id) ? $oResponseData->bb_id : '';
                    $broadcastID = isset($oResponseData->bb_broadcast_id) ? $oResponseData->bb_broadcast_id : '';
                    $settingsID = isset($oResponseData->bb_settings_id) ? $oResponseData->bb_settings_id : '';
                    $npsID = isset($oResponseData->bb_nps_id) ? $oResponseData->bb_nps_id : '';
                    $referralID = isset($oResponseData->bb_referral_id) ? $oResponseData->bb_referral_id : '';
                    $accountID = isset($oResponseData->bb_account_id) ? $oResponseData->bb_account_id : '';
                    $campaignID = isset($oResponseData->bb_campaign_id) ? $oResponseData->bb_campaign_id : '';
                    $emailAddress = isset($oResponseData->email) ? $oResponseData->email : '';
                    $ip = isset($oResponseData->ip) ? $oResponseData->ip : '';
                    $clickURL = isset($oResponseData->url) ? $oResponseData->url : '';
                    $bounceResone = isset($oResponseData->reason) ? $oResponseData->reason : '';
                    $eventTime = isset($oResponseData->timestamp) ? $oResponseData->timestamp : '';
                    $moduleName = isset($oResponseData->bb_module_name) ? $oResponseData->bb_module_name : '';
                    $sendingMethod = isset($oResponseData->bb_sending_method) ? $oResponseData->bb_sending_method : '';
                    $sendingMethod = ($sendingMethod) ? $sendingMethod : 'normal';
                    $automationID = isset($oResponseData->bb_automation_id) ? $oResponseData->bb_automation_id : 0;

                    $created = date("Y-m-d H:i:s");

                    $aData = array(
                        'event_name' => $eventName,
                        'email' => $emailAddress,
                        'subscriber_id' => $subscriberID,
                        'event_id' => $bbEventID,
                        'campaign_id' => $campaignID,
                        'click_url' => $clickURL,
                        'ip' => $ip,
                        'status' => $bounceResone,
                        'event_time' => $eventTime,
                        'created' => $created
                    );
                    if ($moduleName == 'email' || $moduleName == 'automation') {
                        $aData['automation_id'] = $automationID;
                        $query = saveTrackingData('tbl_automations_emails_tracking_sendgrid', $aData);
//                        $aData = array(
//                            'content' => 'Query: ' . $query,
//                            'qs' => $a
//                        );
//                        saveTrackingData('test', $aData);
                    } else if ($moduleName == 'email_broadcast' || $moduleName == 'sms_broadcast') {
                        $aData['broadcast_id'] = $broadcastID;
                        $aData['sending_method'] = $sendingMethod;
                        saveTrackingData('tbl_broadcast_emails_tracking_sendgrid', $aData);
                    } else if ($moduleName == 'referral') {
                        $aData['referral_id'] = $referralID;
                        saveTrackingData('tbl_referral_automations_tracking_sendgrid', $aData);
                    } else if ($moduleName == 'nps') {
                        $aData['nps_id'] = $npsID;
                        saveTrackingData('tbl_nps_automations_tracking_sendgrid', $aData);
                    } else {
                        $aData['brandboost_id'] = $brandboostID;
                        saveTrackingData('tbl_track_sendgrid', $aData);
                    }
                }
            }
        }
    } else {
        echo "Invalid Request";
        $aData = array(
            'content' => 'Invalid Request',
            'qs' => $a
        );
        saveTrackingData('test', $aData);
    }
} catch (Exception $ex) {
    $aData = array(
        'content' => 'Error : ' . $ex->getMessage(),
        'qs' => $a
    );
    saveTrackingData('test', $aData);
}
?>