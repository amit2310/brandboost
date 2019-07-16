<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
include 'functions.php';
//$a = $_POST;
$a = file_get_contents("php://input");
if (!empty($a)) {
    $aResponse = json_decode($a);
    if (!empty($aResponse)) {
        foreach ($aResponse as $oResponseData) {
            $eventName = $oResponseData->event;

            if (!empty($eventName)) {
                $subscriberID = $oResponseData->bb_subscriber_id;
                $bbEventID = $oResponseData->bb_event_id;
                $brandboostID = $oResponseData->bb_id;
                $broadcastID = $oResponseData->bb_broadcast_id;
                $settingsID = $oResponseData->bb_settings_id;
                $npsID = $oResponseData->bb_nps_id;
                $referralID = $oResponseData->bb_referral_id;
                $accountID = $oResponseData->bb_account_id;
                $campaignID = $oResponseData->bb_campaign_id;
                $emailAddress = $oResponseData->email;
                $ip = $oResponseData->ip;
                $clickURL = $oResponseData->url;
                $bounceResone = $oResponseData->reason;
                $eventTime = $oResponseData->timestamp;
                $moduleName = $oResponseData->bb_module_name;
                $sendingMethod = $oResponseData->bb_sending_method;
                $sendingMethod = ($sendingMethod) ? $sendingMethod : 'normal';

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
                if ($moduleName == 'email') {
                    $aData['automation_id'] = $automationID;
                    saveTrackingData('tbl_automations_emails_tracking_sendgrid', $aData);
                }else if ($moduleName == 'email_broadcast' || $moduleName == 'sms_broadcast') {
                    $aData['broadcast_id'] = $broadcastID;
                    $aData['sending_method'] = $sendingMethod;
                    saveTrackingData('tbl_broadcast_emails_tracking_sendgrid', $aData);
                }else if ($moduleName == 'referral') {
                    $aData['referral_id'] = $referralID; 
                    saveTrackingData('tbl_referral_automations_tracking_sendgrid', $aData);
                }else if ($moduleName == 'nps') {
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
}
?>