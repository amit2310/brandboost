<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

require_once 'vendor/autoload.php'; // Loads the library

use Twilio\Rest\Client;

include 'functions.php';

//$from = '+919717658547';
//$to = '+15097400384';
//getLatestActivity($from, $to);
//die;
$msg = "hello";
$to = '+15097400384';
if (!empty($to)) {
    $oTwilioDetails = getTwilioAccount($to);
    if (!empty($oTwilioDetails)) {
        $clientID = $oTwilioDetails['user_id'];
        if (strpos($msg, 'https://api.twilio.com') !== false) {
            $type = 'mms';
        } else {
            $type = 'sms';
        }
    }
}

echo "Client ID is " . $clientID;
if ($clientID > 0) {
    $aUsage = array(
        'client_id' => $clientID,
        'usage_type' => 'sms',
        'direction' => 'inbound',
        'content' => $msg,
        'spend_to' => $to
    );
    updateCreditUsage($aUsage);
    die('done');
}
die;


try {
    mail('rahul.ratnam2@gmail.com', 'Response: Twilio Data 1', json_encode($_REQUEST));
    if ((!empty($_REQUEST['Body'])) || (!empty($_REQUEST['MediaUrl0']))) {
        mail('rahul.ratnam2@gmail.com', 'Response: Twilio Data 2', json_encode($_REQUEST));
        $from = phone_display_custom($_REQUEST['From']);
        $to = phone_display_custom($_REQUEST['To']);
        $msg = $_REQUEST['Body'];
        $numMedia = $_REQUEST['NumMedia'];
        if ($numMedia > 0) {
            for ($i = 0; $i < $numMedia; $i++) {
                $msg .= stripslashes($_REQUEST['MediaUrl' . $i]) . ' ';
            }
        }
        //Get latest activity

        if (!empty($to) && !empty($from)) {

            $oLatestActivity = getLatestActivity($from, $to);
            //if (!empty($oLatestActivity)) {
            $moduleName = $oLatestActivity['module_name'];
            $subcriberID = $oLatestActivity['subscriber_id'];
            $eventID = $oLatestActivity['event_id'];
            $broadcastID = $oLatestActivity['broadcast_id'];
            $automationID = $oLatestActivity['automation_id'];

            $npsID = $oLatestActivity['nps_id'];
            $npsStep = $oLatestActivity['nps_step'];
            $npsScoreID = $oLatestActivity['nps_score_id'];
            $referralID = $oLatestActivity['referral_id'];
            $brandboostID = $oLatestActivity['brandboost_id'];

            $aStoreSMS = array(
                'to' => db_in($to),
                'from' => db_in($from),
                'msg' => db_in($msg),
                'module_name' => db_in($moduleName),
                'event_id' => db_in($eventID),
                'broadcast_id' => db_in($broadcastID),
                'automation_id' => db_in($automationID),
                'nps_id' => db_in($npsID),
                'nps_step' => db_in($npsStep),
                'nps_score_id' => db_in($npsScoreID),
                'referral_id' => db_in($referralID),
                'brandboost_id' => db_in($brandboostID),
                'created' => date("Y-m-d H:i:s")
                    //'created' => date("Y-m-d H:i:s", strtotime('+5 hours')) //earlier it was hosted on pleasereviewmehere.com site
            );
            //Now process module wise data
            if (!empty($to)) {
                $oTwilioDetails = getTwilioAccount($to);
                if (!empty($oTwilioDetails)) {
                    $clientID = $oTwilioDetails['user_id'];
                    if (strpos($msg, 'https://api.twilio.com') !== false) {
                        $type = 'mms';
                    } else {
                        $type = 'sms';
                    }
                }
            }
            if ($moduleName == 'nps') {
                //Get Client Twilio Account Details so that we can reply back to client

                if (!empty($oTwilioDetails)) {
                    $sid = $oTwilioDetails['account_sid'];
                    $token = $oTwilioDetails['account_token'];
                    //Reply back if necessary
                    if (!empty($npsStep)) {

                        if ($npsStep == 1) {
                            //Got NPS score
                            // if NPS score valid, then ask for the feedback otherwise inform them for wrong input
                            if (in_array($msg, array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10))) {
                                //Validated, now ask for the feedback
                                $replyMsg = 'Please type your feedback and let us know why do you want to rate this?';
                                $aStoreSMS['nps_step'] = 2;
                                //Store result in the database
                                if ($npsID > 0) {
                                    $aNPS = getNPSInfo($npsID);
                                    if (!empty($aNPS)) {
                                        $refKey = db_out($aNPS['hashcode']);
                                        $storeURL = $aNPS['store_url'];
                                        //Track visit
                                        $aLocationData = getLocationData();
                                        $aTrackData = array(
                                            'refkey' => $refKey,
                                            'score' => $msg,
                                            'subscriber_id' => $subcriberID,
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
                                                //'created_at' => date("Y-m-d H:i:s", strtotime('+5 hours'))
                                        );
                                        $insertID = saveTrackingData('tbl_nps_score', $aTrackData);
                                        $aStoreSMS['nps_score_id'] = $insertID;
                                        //Charge for incoming sms/mms
                                        if ($clientID > 0) {
                                            $aUsage = array(
                                                'client_id' => $clientID,
                                                'usage_type' => $type,
                                                'direction' => 'inbound'
                                            );
                                            updateCreditUsage($aUsage);
                                        }
                                    }
                                }
                            } else {
                                $replyMsg = 'Please enter valid score ranging from 0-10';
                                $aStoreSMS['nps_step'] = 1;
                            }
                        } else if ($npsStep == 2) {
                            //Store feedback in the NPS module
                            $replyMsg = 'Thank you for leaving your feedback';
                            $aStoreSMS['module_name'] = 'chat';

                            //Store result in the database
                            if ($npsScoreID > 0) {
                                $aFeedbackData = array(
                                    'title' => 'Ratings through SMS',
                                    'feedback' => $msg,
                                    'updated_at' => date("Y-m-d H:i:s", strtotime('+5 hours'))
                                );
                                $bUpdated = updateSurveyFeedback($aFeedbackData, $npsScoreID);
                            }
                        }

                        //Now sendout the message
                        $client = new Client($sid, $token);
                        $client->messages->create(
                                $from, array(
                            'from' => $to,
                            'body' => $replyMsg,
                        ));
                        saveTrackingData('tbl_chat_sms_thread', $aStoreSMS);
                        if ($clientID > 0) {
                            $aUsage = array(
                                'client_id' => $clientID,
                                'usage_type' => 'sms',
                                'direction' => 'outbound'
                            );
                            updateCreditUsage($aUsage);
                        }
                    }
                }
            } else {
                //Send message straight to the chat module
                $aStoreSMS['to'] = $to;
                $aStoreSMS['from'] = $from;

                $tokenResponse = getSmsToken($from, $to);

                $aStoreSMS['msg'] = $msg;
                $aStoreSMS['token'] = $tokenResponse['token'];

                saveTrackingData('tbl_chat_sms_thread', $aStoreSMS);
                if ($clientID > 0) {
                    $aUsage = array(
                        'client_id' => $clientID,
                        'usage_type' => $type,
                        'direction' => 'inbound'
                    );
                    updateCreditUsage($aUsage);
                }

                $usersdata = getUserbyPhoneCustom($aStoreSMS['from']);
                $avatarbox = showUserAvtarCustom($usersdata['avatar'], $usersdata['firstname'], $usersdata['lastname'], 28, 28, 11);


                $url = 'http://brandboost.io:3000/sendSocketMessage';

                $data = array(
                    'to' => $aStoreSMS['to'],
                    'from' => $aStoreSMS['from'],
                    'msg' => $msg,
                    'avatar' => $avatarbox
                );

                $params = '';
                foreach ($data as $key => $value)
                    $params .= $key . '=' . $value . '&';

                $params = trim($params, '&');

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, $url); //Remote Location URL
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Return data instead printing directly in Browser
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 7); //Timeout after 7 seconds
                curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
                curl_setopt($ch, CURLOPT_HEADER, 0);

                //We add these 2 lines to create POST request
                curl_setopt($ch, CURLOPT_POST, count($data)); //number of parameters sent
                curl_setopt($ch, CURLOPT_POSTFIELDS, $params); //parameters data

                $result = curl_exec($ch);
                curl_close($ch);
            }


            //}
        }
    }
} catch (Exception $ex) {
    $errorMsg = $ex->getMessages();
    mail('umair@nethues.com', 'Error: Twilio Data', $errorMsg);
}

echo "All set";
?>