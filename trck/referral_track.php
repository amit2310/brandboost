<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
include 'referral_functions.php';
$siteURL = 'http://brandboost.io';

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

/*echo "<pre>";
print_r($_REQUEST);
echo "</pre>";
die;*/

$inviterID = strip_tags(trim($_REQUEST['inid']));
$settingsID = strip_tags(trim($_REQUEST['setid']));
$referralID = strip_tags(trim($_REQUEST['refid']));
$accountID = strip_tags(trim($_REQUEST['accid']));
$subscriberID = strip_tags(trim($_REQUEST['subid']));
$clientID = strip_tags(trim($_REQUEST['clid']));
$bbType = strip_tags(trim($_REQUEST['bbtype']));
$moduleName = strip_tags(trim($_REQUEST['modname']));

$additionalParams = '';
$redirectURL = '';

if ($clientID > 0) {
    $additionalParams .= '&clid=' . $clientID;
}
if ($subscriberID > 0) {
    $additionalParams .= '&subid=' . $subscriberID;
}

if ($settingsID > 0) {
    $additionalParams .= '&setid=' . $settingsID;
}

if ($referralID > 0) {
    $additionalParams .= '&refid=' . $referralID;
}

if ($accountID > 0) {
    $additionalParams .= '&accid=' . $accountID;
}

if ($inviterID > 0) {
    $additionalParams .= '&invid=' . $inviterID;
}

$additionalParams = ($additionalParams) ? $additionalParams : '';
$redirectURL = base64UrlDecode($_REQUEST['click_redirect']) . '?q=1' . $additionalParams;



if (!empty($_REQUEST['click_redirect'])) {
    //Track Click 

    /* if ($subscriberID > 0 && $bbType=='onsite') {
      $redirectURL = $redirectURL . '/' . $subscriberID;
      } */
    $messageID = !(empty($_REQUEST['msgid'])) ? base64UrlDecode($_REQUEST['msgid']) : '';
    $aMsgDetails = getMessageIDDetails($messageID);
    if (empty($aMsgDetails)) {
        header("Location: {$siteURL}/expired");
        exit;
    } else {
        //check expiry
        $msgSentTime = strtotime($aMsgDetails['created']);

        if ($aReviewLinkExpiry == 'yes' && $bbType == 'onsite') {
            //check if review given
            $bReviewGiven = checkIfReviewGiven($brandboostID, $subscriberID);
            if ($bReviewGiven == true) {
                header("Location: {$siteURL}/expired");
                exit;
            }
        }

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
    $aTrackData['referral_id'] = $referralID;
    $aTrackData['client_id'] = $clientID;
    $aTrackData['subscriber_id'] = $subscriberID;
    $aTrackData['inviter_id'] = $inviterID;
    $aTrackData['url'] = $redirectURL;
    $insertID = saveTrackingData('tbl_referral_automations_tracking_logs_click', $aTrackData);
    //echo $redirectURL;
    //die;
    header("Location: $redirectURL");
    exit;
} else if (!empty($_REQUEST['open_track'])) {
    //Track Open 
    $messageID = !(empty($_REQUEST['msgid'])) ? base64UrlDecode($_REQUEST['msgid']) : '';
    $aTrackData['message_id'] = $messageID;
    $insertID = saveTrackingData('tbl_referral_automations_tracking_logs_open', $aTrackData);
    //Track Log
} else {
    // Do nothing for now
}
?>