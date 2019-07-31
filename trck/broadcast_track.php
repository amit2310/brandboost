<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

include 'email_functions.php';
$siteURL = 'http://brandboostx.com';

$aLocationData = getLocationData();
$allowDuplicateEntry = true;
$aTrackData = array(
    'ip_address' => $aLocationData['ip_address'],
    'platform' => $aLocationData['platform'],
    'platform_device' => $aLocationData['platform_device'],
    'browser' => $aLocationData['name'],
    'useragent' => $aLocationData['userAgent'],
    'country' => $aLocationData['country'],
    'countryCode' => $aLocationData['countryCode'],
    'region' => $aLocationData['region'],
    'city' => $aLocationData['city'],
    'longitude' => $aLocationData['longitude'],
    'latitude' => $aLocationData['latitude'],
    'created_at' => date("Y-m-d H:i:s")
);



$inviterID = strip_tags(trim($_REQUEST['inid']));
$broadcastID = strip_tags(trim($_REQUEST['autoid']));
$subscriberID = strip_tags(trim($_REQUEST['subid']));
$clientID = strip_tags(trim($_REQUEST['clid']));
$bbType = strip_tags(trim($_REQUEST['bbtype']));
$moduleName = strip_tags(trim($_REQUEST['modname']));
$sendingMethod = strip_tags(trim($_REQUEST['sm']));
$sendingMethod = (!empty($sendingMethod)) ? $sendingMethod : 'normal';
$aTrackData['sending_method'] = $sendingMethod;
$additionalParams = '';
$redirectURL = '';

if ($clientID > 0) {
    $additionalParams .= '&clid=' . $clientID;
}
if ($subscriberID > 0) {
    $additionalParams .= '&subid=' . $subscriberID;
}

if ($inviterID > 0) {
    $additionalParams .= '&invid=' . $inviterID;
}



$additionalParams = ($additionalParams) ? $additionalParams : '';
$redirectURL = base64UrlDecode($_REQUEST['click_redirect']) . '?q=1' . $additionalParams;



if (!empty($_REQUEST['click_redirect'])) {
    //Track Click 


    $messageID = !(empty($_REQUEST['msgid'])) ? base64UrlDecode($_REQUEST['msgid']) : '';
    $aMsgDetails = getBroadcastMessageIDDetails($messageID);
    if (empty($aMsgDetails)) {
        header("Location: {$siteURL}/expired");
        exit;
    } else {
        //check expiry
        $msgSentTime = strtotime($aMsgDetails['created']);

        if (!empty($expiryUnit) && $expiryUnit != 'never') {
            //check time based expiry
            $bExpired = checkIfLinkExpired($expiryUnit, $expiryValue, $msgSentTime);
            if ($bExpired == true) {
                header("Location: {$siteURL}/expired");
                exit;
            }
        }
    }
    $aTrackData['message_id'] = $messageID;
    $aTrackData['broadcast_id'] = $broadcastID;
    $aTrackData['client_id'] = $clientID;
    $aTrackData['subscriber_id'] = $subscriberID;
    $aTrackData['inviter_id'] = $inviterID;
    $aTrackData['url'] = $redirectURL;
    
    $insertID = saveTrackingData('tbl_broadcast_emails_tracking_logs_click', $aTrackData);
    //echo $redirectURL;
    //die;
    header("Location: $redirectURL");
    exit;
} else if (!empty($_REQUEST['open_track'])) {
    //Track Open 
    $sendingMethod = !(empty($_REQUEST['sm'])) ? $_REQUEST['sm'] : 'normal';
    $aTrackData['sending_method'] = $sendingMethod;
    $messageID = !(empty($_REQUEST['msgid'])) ? base64UrlDecode($_REQUEST['msgid']) : '';
    $aTrackData['message_id'] = $messageID;
    $insertID = saveTrackingData('tbl_broadcast_emails_tracking_logs_open', $aTrackData);
    //Track Log
} else {
    // Do nothing for now
}
?>