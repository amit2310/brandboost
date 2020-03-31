<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\WorkflowModel;
use Illuminate\Http\Request;
use App\Models\Admin\SubscriberModel;
use App\Models\Admin\ManualRequestModel;
use App\Models\Admin\TagsModel;
use App\Models\Admin\ListsModel;
use Cookie;
use Session;
use DB;

class ManualRequest extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->trackServer = 'http://brandboostx.com/trck';
        $this->enableQueue = false;
        $this->defaultSendgridDetails = array(
            'user' => config('bbconfig.sandgriduser'),
            'password' => config('bbconfig.sandgridpass'),
            'host' => 'smtp.sendgrid.net',
            'port' => '2525',
            'type' => 'html'
        );

        $this->defaultTwilioDetails = array(
            'sid' => config('bbconfig.sid'),
            'token' => config('bbconfig.token'),
            'from_number' => '+14695027654'
        );

    }
    /**
     * Used to send manual request email/sms
     * @param Request $request
     */
    public function send(Request $request){
        $requestId = $request->request_id;
        $moduleName = $request->moduleName;
        $mRequest = new ManualRequestModel();
        $aRequestData = $mRequest->getRequestInfo($requestId, $moduleName);
        $aSubscribers = $mRequest->getEligibleSubscribers($requestId, $moduleName);
        if(!empty($aRequestData)){
            $campaignType = $aRequestData->type; //email or sms
            if($campaignType == 'email'){
                $this->sendBulkEmail($aSubscribers, $aRequestData, $moduleName);
            }
            if($campaignType == 'sms'){
                $this->sendBulkSMS($aSubscribers, $aRequestData, $moduleName);
            }
        }
    }

    public function sendBulkEmail($aSubscribers, $aRequestData, $moduleName){
        if(!empty($aSubscribers)){
            $mRequest = new ManualRequestModel();
            $mWorkflow = new WorkflowModel();
            $moduleUnitId = $aRequestData->campaign_id;
            $clientID = $aRequestData->user_id;
            $aSendgridData = $mRequest->getSendgridAccount($clientID);
            $moduleUnitInfo = $mRequest->getModuleUnitInfo($moduleUnitId, $moduleName);
            $aEvent = $mWorkflow->getWorkflowEvents($moduleUnitId, $moduleName);
            $eventID = '0';
            $previousEventID = '0';
            if(!empty($aEvent)){
                $eventID = $aEvent[0]->id;
                $previousEventID = $aEvent[0]->previous_event_id;
            }
            if($eventID>0){
                $aCampaign = $mWorkflow->getEventCampaign($eventID, $moduleName);
                if(!empty($aCampaign)){
                    $campaignID = 0;
                    foreach($aCampaign as $campaign){
                        if(strtolower($aCampaign->campaign_type) == 'email'){
                            $campaignID = $aCampaign->id;
                        }
                    }
                }
            }
            $subject = $aRequestData->subject;
            $preheader = $aRequestData->preheader;
            $greeting = $aRequestData->greeting;
            $introduction = $aRequestData->introduction;
            $fromName = $aRequestData->email_from_name;
            $fromEmail = $aRequestData->email;
            $content = base64_decode($aRequestData->stripo_compiled_html);
            $content = str_replace(array('{GREETING}', '{INTRODUCTION}'), array($greeting, $introduction), $content);
            $messageID = $this->generateMessageId();
            //Okay All set now start sending emails
            foreach($aSubscribers as $oSubscriber){
                $to = $oSubscriber->email;
                $contentParsed = $mRequest->emailTagReplace($content, 'email', $oSubscriber, $moduleUnitInfo, $moduleName);
                $aTrackSetttings = [
                    'user_id' => $oSubscriber->user_id,
                    'campaign_id' => $campaignID,
                    'inviter_id' => $eventID,
                    'email' => $oSubscriber->email,
                    'subscriber_id' => $oSubscriber->id,
                    'client_id' => $clientID
                ];
                if($moduleName == 'brandboost'){
                    $aTrackSetttings['bb_type'] = $moduleUnitInfo->review_type;
                    $aTrackSetttings['brandboost_id'] = $moduleUnitId;
                }
                $msg = $this->prepareHtmlContent($contentParsed, $messageID, $aTrackSetttings);
                $aEmailData = [
                    'campaign_type' => 'email',
                    'to' => $to,
                    'from_entity' => $fromEmail,
                    'from_name' => $fromName,
                    'subject' => $subject,
                    'content' => base64_encode($msg),
                    'campaign_id' => $campaignID,
                    'inviter_id' => $eventID,
                    'preceded_by' => $previousEventID,
                    'message_id' => $messageID,
                    'client_id' => $clientID,
                    'moduleName' => $moduleName,
                    'moduleUnitId' => $moduleUnitId,
                    'subscriber_id' => $oSubscriber->id,
                    'globalSubscriberId' => $oSubscriber->subscriber_id,
                    'sendgrid_username' => $aSendgridData->sg_username,
                    'sendgrid_password' => $aSendgridData->sg_password,
                    'created' => date("Y-m-d H:i:s")
                ];

                if($moduleName == 'brandboost'){
                    $aEmailData['brandboost_id'] = $moduleUnitId;
                }
                $bEmailSent = $this->SG_smtp($aEmailData);
                if($bEmailSent){
                    $aLogData = array(
                        'inviter_id' => $eventID,
                        'subscriber_id' => $oSubscriber->id,
                        'preceded_by' => $previousEventID,
                        'message_id' => $messageID,
                        'campaign_id' => $campaignID,
                        'type' => 'email',
                        'subs_email' => $oSubscriber->email,
                        'subs_phone' => $oSubscriber->phone
                    );
                    $this->saveLog($aLogData);
                    //Update Client Usage
                    $aUsage = array(
                        'client_id' => $clientID,
                        'usage_type' => 'email',
                        'content' => $msg,
                        'spend_to' => $to,
                        'spend_from' => '',
                        'module_name' => $moduleName,
                        'module_unit_id' => $moduleUnitId
                    );
                    updateCreditUsage($aUsage);
                }

            }

        }
    }

    public function sendBulkSMS($aSubscribers, $aRequestData, $moduleName){
        if(!empty($aSubscribers)){

        }
    }

    /**
     * Generates unique email id for each email being sent out
     * @return type
     */
    public function generateMessageId() {
        return time() . rand(100000, 999999) . '.' . uniqid();
    }

    /**
     * Saves sending log
     * @param type $aData
     */
    public function saveLog($aData, $moduleName) {
        //Instantiate Email Model to access its properties and methods
        $mRequest = new ManualRequestModel();

        $timeNow = date("Y-m-d H:i:s");
        $insertID = 0;
        if (!empty($aData)) {
            $aTriggerData = array(
                'inviter_id' => $aData['inviter_id'],
                'subscriber_id' => $aData['subscriber_id'],
                'preceded_by' => $aData['preceded_by'],
                'start_at' => $timeNow,
                'created_at' => $timeNow
            );
            $insertID = $mRequest->saveTriggerData($aTriggerData, $moduleName);
        }

        //Track Log
        $aTrackData = array(
            'type' => $aData['type'],
            'message_id' => $aData['message_id'],
            'subscriber_id' => $aData['subscriber_id'],
            'campaign_id' => $aData['campaign_id'],
            'trigger_id' => $insertID,
            'subs_email' => $aData['subs_email'],
            'subs_phone' => $aData['subs_phone'],
            'status' => 'sent',
            'created' => date("Y-m-d H:i:s"),
        );
        $mRequest->saveSendingLog($aTrackData, $moduleName);
    }

    /**
     * Adds click/open tracking links
     * @param type $sMessage
     * @param type $msgID
     * @param type $aTrackSettings
     * @return type
     */
    public function prepareHtmlContent($sMessage, $msgID, $aTrackSettings) {

        $sMessage = $this->addClickTrackingUrl($sMessage, $msgID, $aTrackSettings);

        $sMessage = $this->addOpenTrackingUrl($sMessage, $msgID, $aTrackSettings);
        return $sMessage;
    }

    /**
     * Used to add click tracking link in all links present in the email
     * @param type $content
     * @param type $msgId
     * @param type $aSettingsData
     * @return type
     */
    public function addClickTrackingUrl($content, $msgId, $aSettingsData = array()) {
        if (preg_match_all('/<a[^>]*href=["\'](?<url>http[^"\']*)["\']/i', $content, $matches)) {
            foreach ($matches[0] as $key => $href) {
                $url = $matches['url'][$key];
                $encodeURL = $this->base64UrlEncode($url);
                if (!empty($aSettingsData)) {
                    $userID = $aSettingsData['user_id'];
                    $subscriberID = $aSettingsData['subscriber_id'];
                    $campignID = $aSettingsData['campaign_id'];
                    $inviterID = $aSettingsData['inviter_id'];
                    $brandboostID = $aSettingsData['brandboost_id'];
                    $clientID = $aSettingsData['client_id'];
                    $bbType = $aSettingsData['bb_type'];
                    $additionalParams = '';
                    if ($userID > 0) {
                        $additionalParams .= '&uid=' . $userID;
                    }
                    if ($campignID > 0) {
                        $additionalParams .= '&caid=' . $campignID;
                    }
                    if ($inviterID > 0) {
                        $additionalParams .= '&inid=' . $inviterID;
                    }
                    if ($brandboostID > 0) {
                        $additionalParams .= '&bbid=' . $brandboostID;
                    }
                    if ($subscriberID > 0) {
                        $additionalParams .= '&subid=' . $subscriberID;
                    }
                    if ($clientID > 0) {
                        $additionalParams .= '&clid=' . $clientID;
                    }
                    if (!empty($bbType)) {
                        $additionalParams .= '&bbtype=' . $bbType;
                    }
                }
                $trackClickUrl = $this->trackServer . '/track.php?click_redirect=' . $encodeURL . '&msgid=' . $this->base64UrlEncode($msgId) . $additionalParams;

                $newHref = str_replace($url, $trackClickUrl, $href);
                $content = str_replace($href, $newHref, $content);
            }
        }
        return $content;
    }

    /**
     * Used to add Open tracking link in all links present in the email
     * @param type $content
     * @param type $msgId
     * @return type
     */
    public function addOpenTrackingUrl($content, $msgId) {
        $trackOpenUrl = $this->trackServer . '/track.php?open_track=true&msgid=' . $this->base64UrlEncode($msgId);
        return $content . '<img src="' . $trackOpenUrl . '" width="0" height="0" alt="" style="visibility:hidden" />';
    }

    /**
     * Utility function to convert url entities into the base64 encode algorithm
     * @param type $val
     * @return type
     */
    public function base64UrlEncode($val) {
        return strtr(base64_encode($val), '+/=', '-_,');
    }

    /**
     * Utility function to convert url entities into the base64 decode algorithm
     * @param type $val
     * @return type
     */
    public function base64UrlDecode($val) {
        return base64_decode(strtr($val, '-_,', '+/='));
    }

    /**
     * Used to send email using sendgrid
     * @param type $aData
     * @return boolean
     */
    public function SG_smtp($aData) {
        //For now use detault sendgrid account
        if ($this->use_default_accounts == true) {
            $aSendgridData = $this->defaultSendgridDetails;
            $user = $aSendgridData['user'];
            $password = $aSendgridData['password'];
            $host = $aSendgridData['host'];
            $port = $aSendgridData['port'];
            $type = $aSendgridData['type'];
        } else {
            $user = $aData['sendgrid_username'];
            $password = $aData['sendgrid_password'];
            $host = 'smtp.sendgrid.net';
            $port = '2525';
            $type = 'html';
        }

        if (empty($aSendgridData)) {
            return false;
        }

        //attach default footer
        $moduleName = base64_url_encode($aData['moduleName']);
        $moduleUnitID = base64_url_encode($aData['moduleUnitId']);
        $subscriberID = base64_url_encode($aData['subscriber_id']);
        $globalSubscriberID = base64_url_encode($aData['globalSubscriberId']);

        $aFooterTags = array('{{MODULENAME}}', '{{MODULEUNITID}}', '{{SUBSCRIBERID}}', '{{GLOBALSUBSCRIBERID}}');
        $aFooterTagValues = array($moduleName, $moduleUnitID, $subscriberID, $globalSubscriberID);
        $footerSrc = getDefaultEmailFooter(); //Helper function

        $footerCompiledCode = str_replace($aFooterTags, $aFooterTagValues, $footerSrc);

        $emailData = base64_decode($aData['content']);

        $emailContent = $emailData . $footerCompiledCode;
        $url = 'https://api.sendgrid.com/';
        $json_string = array(
            'unique_args' => array(
                'bb_subscriber_id' => $aData['subscriber_id'],
                'bb_event_id' => $aData['inviter_id'],
                'bb_id' => $aData['brandboost_id'],
                'bb_campaign_id' => $aData['campaign_id']
            )
        );

        $plainText = convertHtmlToPlain($emailContent); //Helper function
        $params = array(
            'api_user' => $user,
            'api_key' => $password,
            'to' => $aData['to'],
            'subject' => ($aData['subject']) ? $aData['subject'] : $this->config->item('blank_subject'),
            'html' => $emailContent,
            'text' => $plainText,
            'from' => $aData['from_entity'],
            'fromname' => $aData['from_name'],
            'x-smtpapi' => json_encode($json_string)
        );
        $request = $url . 'api/mail.send.json';
        $session = curl_init($request);
        curl_setopt($session, CURLOPT_POST, true);
        curl_setopt($session, CURLOPT_POSTFIELDS, $params);
        curl_setopt($session, CURLOPT_HEADER, false);
        curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($session);
        curl_close($session);
        $result = (array) json_decode($result, True);

        if (isset($result['errors'])) {
            return false;
        } else {
            return true;
        }
    }



}
