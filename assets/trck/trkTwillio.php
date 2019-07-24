<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
require_once '/var/www/html/assets/trck/vendor/autoload.php'; // Loads the library
use Twilio\Rest\Client;
include '/var/www/html/assets/trck/functions.php';

$from = phone_display_custom($_REQUEST['From']);
$to = phone_display_custom($_REQUEST['To']);


/*echo '<pre>';
print_r($_REQUEST);
echo $_REQUEST['From']='+17049075791';
echo $_REQUEST['To'] = '+15097400384';
$_REQUEST['Body']='Hey';
//$from = '7049075791';
//$to = '5097400384';
//getLatestActivity($from, $to);
//die;
*/

try {
    if (!empty($to) && !empty($from)) {
            
           $msg = $_REQUEST['Body'];

          if(!empty($_REQUEST['Body']))
          {
           $charCount = strlen($msg);
          }
          else
          {
            $charCount = strlen('Not Available');

          }


        $numMedia = $_REQUEST['NumMedia'];
        if ($numMedia > 0) {
            for ($i = 0; $i < $numMedia; $i++) {
                $msg .= stripslashes($_REQUEST['MediaUrl' . $i]) . ' ';
            }
        }
        //Get latest activity
       
        if (!empty($to) && !empty($from)) {


            $oLatestActivity = getLatestActivity($from, $to);

            
            
            $moduleName =  $oLatestActivity['module_name']!='' ? $oLatestActivity['module_name'] : '0';
            $subcriberID =  $oLatestActivity['subscriber_id']!='' ? $oLatestActivity['subscriber_id'] : '0';
            $eventID = $oLatestActivity['event_id']!='' ? $oLatestActivity['event_id'] : '0';
            $broadcastID = $oLatestActivity['broadcast_id']!='' ? $oLatestActivity['broadcast_id'] : '0';
            $automationID = $oLatestActivity['automation_id']!='' ? $oLatestActivity['automation_id'] : '0';
            $npsID =  $oLatestActivity['nps_id']!='' ? $oLatestActivity['nps_id'] : '0';
            $npsStep =  $oLatestActivity['nps_step']!='' ? $oLatestActivity['nps_step'] : '0';
            $npsScoreID = $oLatestActivity['nps_score_id']!='' ? $oLatestActivity['nps_score_id'] : '0';
            $referralID =  $oLatestActivity['referral_id']!='' ? $oLatestActivity['referral_id'] : '0';
            $brandboostID =  $oLatestActivity['brandboost_id']!='' ? $oLatestActivity['brandboost_id'] : '0';


 
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
                            if (in_array($msg, array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10))) {
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
                                        $totatMessageCount = ceil($charCount / 160);
                                        if ($clientID > 0) {
                                            $aUsage = array(
                                                'client_id' => $clientID,
                                                'usage_type' => $type,
                                                'direction' => 'inbound',
                                                'content' => $msg,
                                                'spend_to' => $to,
                                                'spend_from' => $from,
                                                'module_name' => '',
                                                'module_unit_id' => ''
                                            );
                                            if ($totatMessageCount > 1) {
                                                for ($i = 0; $i < $totatMessageCount; $i++) {
                                                    $aUsage['segment'] = $i + 1;
                                                    updateCreditUsage($aUsage);
                                                }
                                            } else {
                                                $aUsage['segment'] = 1;
                                                updateCreditUsage($aUsage);
                                            }
                                        }//client id
                                    }//nps
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
                        }//npsstep2
                        //Now sendout the message
                        $client = new Client($sid, $token);
                        $client->messages->create(
                                $from, array(
                            'from' => $to,
                            'body' => $replyMsg,
                        ));
                        saveTrackingData('tbl_chat_sms_thread', $aStoreSMS);
                        $charCount = strlen($replyMsg);
                        $totatMessageCount = ceil($charCount / 160);
                        if ($clientID > 0) {
                            $aUsage = array(
                                'client_id' => $clientID,
                                'usage_type' => 'sms',
                                'direction' => 'outbound',
                                'content' => $replyMsg,
                                'spend_to' => $from,
                                'spend_from' => $to,
                                'module_name' => 'nps',
                                'module_unit_id' => $npsID
                            );
                            if ($totatMessageCount > 1) {
                                for ($i = 0; $i < $totatMessageCount; $i++) {
                                    $aUsage['segment'] = $i + 1;
                                    updateCreditUsage($aUsage);
                                }
                            } else {
                                $aUsage['segment'] = 1;
                                updateCreditUsage($aUsage);
                            }//
                        }//client id
                    }
                }
            } else {
              
                //Send message straight to the chat module
                $aStoreSMS['to'] = $to;
                $aStoreSMS['from'] = $from;

                $aToken = $to + $from;
                if ($to > $from) {
                    $sToken = $to - $from;
                } else {
                    $sToken = $from - $to;
                }
                $tokenResponse = $aToken . 'n' . $sToken;


                //$tokenResponse = getSmsToken($from, $to);
                $msgExplode = explode('/', $msg);

                $mm_id = $msgExplode[7];
                $msg_sid = $msgExplode[9];
                $showVideo = '';

                if (!empty($mm_id) || !empty($msg_sid)) {
                    $sid = $oTwilioDetails['account_sid'];
                    $token = $oTwilioDetails['account_token'];
                    $client = new Client($sid, $token);
                    $media = $client->messages($mm_id)
                            ->media($msg_sid)
                            ->fetch();
                    $contentExplode = explode('/', $media->contentType);
                    if ($contentExplode[0] == 'video') {
                        $media_type = 'video';

                        $randNum = rand(8, 14);
                        $rand_string = random_strings($randNum);
                        $media_url_show = $msg;

                        $sData = array(
                            'token' => $tokenResponse,
                            'rand_string' => $rand_string,
                            'url' => $msg,
                            'sms_flow' => 'incoming',
                            'created' => date("Y-m-d H:i:s")
                        );
                        $lastInsertId = addSmsMedia($sData);
                        $msg = '<a href="http://brandboost.io/media/' . $rand_string . '" target="_blank"><img src="http://brandboost.io/assets/images/play_button.png"></a>';
                        $showVideo = 'show';
                    } else if ($contentExplode[0] == 'image') {
                        $media_type = 'image';
                    } else {
                        $media_type = '';
                    }
                }




                $aStoreSMS['msg'] = $msg;
                $aStoreSMS['token'] = $tokenResponse;
                $aStoreSMS['response'] = json_encode($_REQUEST);
                $aStoreSMS['media_type'] = $media_type;

             
                saveTrackingData('tbl_chat_sms_thread', $aStoreSMS);
                $totatMessageCount = ceil($charCount / 160);
                if ($clientID > 0) {
                    $aUsage = array(
                        'client_id' => $clientID,
                        'usage_type' => $type,
                        'direction' => 'inbound',
                        'content' => $msg,
                        'spend_to' => $to,
                        'spend_from' => $from,
                        'module_name' => 'sms chat',
                        'module_unit_id' => ''
                    );
                    if ($totatMessageCount > 1) {
                        for ($i = 0; $i < $totatMessageCount; $i++) {
                            $aUsage['segment'] = $i + 1;
                            updateCreditUsage($aUsage);
                        }
                    } else {
                        $aUsage['segment'] = 1;
                        updateCreditUsage($aUsage);
                    }
                }

                $usersdata = getUserbyPhoneCustom($aStoreSMS['from']);
                $avatarbox = showUserAvtarCustom($usersdata['avatar'], $usersdata['firstname'], $usersdata['lastname'], 28, 28, 11);


                $url = 'http://brandboostx.com:3000/sendSocketMessage';

                $data = array(
                    'to' => $aStoreSMS['to'],
                    'from' => $aStoreSMS['from'],
                    'msg' => $msg,
                    'media_type' => $media_type,
                    'avatar' => $avatarbox,
                    'showVideo' => $showVideo
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
    $errorMsg = $ex->getMessage();
    echo "<pre>";
    print_r($errorMsg);
    echo "</pre>";
    mail('umair@nethues.com', 'Error: Twilio Data', $errorMsg);
}

//echo "All set";
?>