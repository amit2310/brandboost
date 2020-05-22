<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin\Crons\ManagerModel;
use App\Models\Admin\Crons\BrandboostModel;
use App\Models\Admin\UsersModel;

class SmartBrandboost extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'smart:brandboost';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This cron used to run workflow of review module';
    /**
     * Create a new command instance.
     *
     * @return void
     */
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

        $this->use_default_accounts = false;
        $this->from_email = 'request@brandboost.io';
        $this->from_name = 'Brandboost Team';
        $this->client_from_email = '';
        $this->client_from_name = '';
        $this->testCampaignId = '';
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $this->startWorkflow();
    }

    public function startWorkflow() {
        //Instantiate cron manager model to access its properties and methods
        $mCron = new ManagerModel();

        //Instantiate Email Model to access its properties and methods
        $mInviter = new BrandboostModel();

        //Check Cron Lock
        $bLocked = false;
        $oCron = $mCron->checkCronStatus('smart-reviews');
        if ($oCron->locked == true) {
            die("Currently cron is locked");
        }

        if ($oCron->locked == false) {
            //Lock Cron
            $bLocked = $mCron->lockCron('smart-reviews');
        }

        if ($bLocked == false) {
            die("Currently cron is locked!!");
        }
        $aEventsData = $mInviter->getInviterEvents();
        //Arrange all the events in order
        $aEvents = sortWorkflowEvents($aEventsData);
        if (!empty($aEvents)) {
            foreach ($aEvents as $aEvent) {
                $bActiveSubscription = false;
                $userID = $aEvent->client_id;
                if ($userID > 0) {
                    $bActiveSubscription = UsersModel::isActiveSubscription($userID);
                    if ($bActiveSubscription == true) {
                        $eventType = $aEvent->event_type;
                        switch ($eventType) {
                            case "send-invite":
                            case "main":
                                $this->processMainEvents($aEvent);
                                break;
                            case "followup":
                                $this->processFollowup($aEvent);
                                break;
                        }
                    }
                }
            }
        }
        //Release Cron
        $mCron->releaseCron('smart-reviews');
        echo "Script Ended";
    }

    /**
     * Processes Send Invites(Main Event)
     * @param type $aEvent
     * @param type $aEvent
     */
    public function processMainEvents($aEvent = array()) {
        //Instantiate Email Model to access its properties and methods
        $mInviter = new BrandboostModel();

        if (!empty($aEvent)) {

            $bbID = $aEvent->brandboost_id;
            $inviterID = $aEvent->id;
            $oParams = json_decode($aEvent->data);
            //Get all subscriber and then find eligible subscribers only
            $oSubscribers = $mInviter->getInviterEligibleSubscribers($bbID);
            $aProcessedSubscribers = $mInviter->getTriggeredSubscribers($inviterID);
            $aEligibleSubscriber = array();

            if (!empty($oSubscribers)) {
                foreach ($oSubscribers as $oSubs) {
                    if (!in_array($oSubs->id, $aProcessedSubscribers)) {
                        $aEligibleSubscriber[] = $oSubs;
                    }
                }
            }

            if (!empty($aEligibleSubscriber)) {
                $aFireData = array(
                    'inviter_data' => $aEvent,
                    'subscribers' => $aEligibleSubscriber
                );
                $this->fireAutomation($aFireData);
            }
        }
    }

    public function fireAutomation($aData = array()) {
        $oEvent = $aData['inviter_data'];
        $aSubscribers = $aData['subscribers'];
        if(!empty($oEvent)){
            $oParams = json_decode($oEvent->data);
            $nodeType = $oParams->node_type;
            switch ($nodeType){
                case 'action':
                    $this->processActions($aData);
                    break;
                case 'decision':
                    $this->processDecision($aData);
                    break;
                case 'delay':
                    $this->processDelay($aData);
                    break;
                case 'split':
                    $this->processSplit($aData);
                    break;
                case 'goal':
                    $this->processGoal($aData);
                    break;
                case 'exit':
                    $this->processExit($aData);
                    break;
            }
        }

    }

    public function processActions($aData){
        $oEvent = $aData['inviter_data'];
        $aSubscribers = $aData['subscribers'];
        $oParams = json_decode($oEvent->data);
        $actionName = $oParams->name;
        switch ($actionName){
            case 'field':
                $this->setField($aData);
                break;
            case 'tag':
                $this->applyTag($aData);
                break;
            case 'list':
                $this->addToList($aData);
                break;
            case 'segment':
                $this->addToSegment($aData);
                break;
            case 'status':
                $this->setStatus($aData);
                break;
            case 'webhook':
                $this->executeWebhook($aData);
                break;
            case 'email':
                $this->sendEmailCampaign($aData);
                break;
            case 'sms':
                $this->sendSMSCampaign($aData);
                break;
        }

    }

    public function setField($aData){

    }

    public function applyTag($aData){

    }

    public function addToList($aData){

    }

    public function addToSegment($aData){

    }

    public function setStatus($aData){

    }

    public function executeWebhook($aData){

    }

    public function sendEmailCampaign($aData){

    }

    public function sendSMSCampaign($aData){

    }

    public function processDecision($aData){

    }

    public function processDelay($aData){

    }

    public function processSplit($aData){

    }

    public function processGoal($aData){

    }

    public function processExit($aData){

    }

    /**
     * Default function responsible to initiate the cron
     */
    public function startCampaign() {
        //Instantiate cron manager model to access its properties and methods
        $mCron = new ManagerModel();

        //Instantiate Email Model to access its properties and methods
        $mInviter = new BrandboostModel();

        //Check Cron Lock
        $bLocked = false;
        $oCron = $mCron->checkCronStatus('brandboost');
        if ($oCron->locked == true) {
            die("Currently cron is locked");
        }

        if ($oCron->locked == false) {
            //Lock Cron
            $bLocked = $mCron->lockCron('brandboost');
        }

        if ($bLocked == false) {
            die("Currently cron is locked!!");
        }
        $aEvents = $mInviter->getInviterEvents();
        //pre($aEvents);
        //die;
        if (!empty($aEvents)) {
            foreach ($aEvents as $aEvent) {
                $bActiveSubscription = false;
                //$bbID = $aEvent->brandboost_id;
                $userID = $aEvent->client_id;
                //if ($userID > 0 && $bbID == 126) {
                if ($userID > 0) {
                    $bActiveSubscription = UsersModel::isActiveSubscription($userID);
                    //echo "Subscription status ". $bActiveSubscription;
                    //die;
                    if ($bActiveSubscription == true) {
                        /* if ($bbID != '60') {
                          break;
                          } */
                        $eventType = $aEvent->event_type;
                        //echo "Event Type is ". $eventType;
                        switch ($eventType) {
                            case "send-invite":
                            case "main":
                                $this->processSendInvites($aEvent);
                                break;
                            case "followup":
                                $this->processFollowup($aEvent);
                                break;
                            case "thank-you":
                                //$this->processThankyouInvites($aEvent);
                                break;
                        }
                    }
                }
                //}
            }
        }
        //Release Cron
        $mCron->releaseCron('brandboost');
        echo "Script Ended";
    }

    /**
     * Process Thank you Invites
     * @param type $aEvent
     */
    /*public function processThankyouInvites($aEvent = array()) {
        //Instantiate Email Model to access its properties and methods
        $mInviter = new BrandboostModel();


        if (!empty($aEvent)) {
            $bbID = $aEvent->brandboost_id;
            $inviterID = $aEvent->id;
            $oParams = json_decode($aEvent->data);
            $delayType = $oParams->delay_type; //after or before
            $delayUnit = $oParams->delay_unit; // minute or hour or day or week or year
            $delayValue = $oParams->delay_value;
            //Get all subscriber and then find eligible subscribers only
            $oSubscribers = $mInviter->getThankYouEligibleSubscribers($bbID, $inviterID);
            $timeNow = time();
            $aEligibleSubscriber = array();
            if (!empty($oSubscribers)) {
                foreach ($oSubscribers as $oSubscriber) {
                    $bAlreadySent = $mInviter->checkIfSent($inviterID, $oSubscriber->id);
                    if ($bAlreadySent == false) {
                        $addedTime = strtotime($oSubscriber->review_date);
                        $deliverAt = $this->simplifiedTime($delayType, $delayUnit, $delayValue, $addedTime);
                        if ($deliverAt <= $timeNow) {
                            $aEligibleSubscriber[] = $oSubscriber;
                        }
                    }
                }
            }
            //pre($aEligibleSubscriber);
            if (!empty($aEligibleSubscriber)) {
                $aFireData = array(
                    'inviter_data' => $aEvent,
                    'subscribers' => $aEligibleSubscriber
                );
                $this->fireAutomationCampaign($aFireData);
            }
        }
    }*/

    /**
     * Processes all followup end campaigns
     * @param type $aEvent
     */
    public function processFollowup($aEvent = array()) {
        //Instantiate Email Model to access its properties and methods
        $mInviter = new BrandboostModel();

        if (!empty($aEvent)) {
            $bbID = $aEvent->brandboost_id;
            $inviterID = $aEvent->id;
            $previousEventID = $aEvent->previous_event_id;
            $oParams = json_decode($aEvent->data);
            $delayType = $oParams->delay_type; //after or before
            $delayUnit = $oParams->delay_unit; // minute or hour or day or week or year
            $delayValue = $oParams->delay_value;
            $aBrandboost = $mInviter->getBBInfo($bbID);
            if (!empty($aBrandboost)) {
                $bbType = $aBrandboost->review_type;
            }
            //Get all subscriber and then find eligible subscribers only
            $oSubscribers = $mInviter->getInviterFollowupSubscribers($inviterID, $previousEventID);
            $timeNow = time();
            $aEligibleSubscriber = array();
            if (!empty($oSubscribers)) {
                foreach ($oSubscribers as $oSubscriber) {
                    if ($bbType == 'onsite') {
                        //Onsite Brandboost // check only reviews
                        $ifActionTaken = $mInviter->checkIfReviewGiven($bbID, $oSubscriber->bb_user_id);
                    } else if ($bbType == 'offsite') {
                        //Offsite Brandboost // check feedback only
                        $ifActionTaken = $mInviter->checkIfFeedbackGiven($bbID, $oSubscriber->id);
                    }
                    if ($ifActionTaken == false) {
                        $bAlreadySentReminder = $mInviter->checkIfSent($inviterID, $oSubscriber->id);
                        if ($bAlreadySentReminder == false) {
                            $addedTime = strtotime($oSubscriber->start_at);
                            $deliverAt = $this->simplifiedTime($delayType, $delayUnit, $delayValue, $addedTime);
                            if ($deliverAt <= $timeNow) {
                                $aEligibleSubscriber[] = $oSubscriber;
                            }
                        }
                    }
                }
            }
            //pre($aEligibleSubscriber);
            //die;

            if (!empty($aEligibleSubscriber)) {
                $aFireData = array(
                    'inviter_data' => $aEvent,
                    'subscribers' => $aEligibleSubscriber
                );
                $this->fireAutomationCampaign($aFireData);
            }
        }
    }

    /**
     * Processes Send Invites(Main Event)
     * @param type $aEvent
     * @param type $aEvent
     */
    public function processSendInvites($aEvent = array()) {
        //Instantiate Email Model to access its properties and methods
        $mInviter = new BrandboostModel();

        if (!empty($aEvent)) {

            $bbID = $aEvent->brandboost_id;
            $inviterID = $aEvent->id;
            $oParams = json_decode($aEvent->data);
            $delayType = $oParams->delay_type; //after or before
            $delayUnit = $oParams->delay_unit; // minute or hour or day or week or year
            $delayValue = $oParams->delay_value;
            //Get all subscriber and then find eligible subscribers only
            $oSubscribers = $mInviter->getInviterEligibleSubscribers($bbID);

            $aProcessedSubscribers = $mInviter->getTriggeredSubscribers($inviterID);

            if ($bbID == $this->testCampaignId) {
                echo "<br>Check 1";
                pre($oSubscribers);
                echo "<br>Check 2";
                pre($aProcessedSubscribers);
            }
            //pre($oSubscribers);
            //die;
            $timeNow = time();
            $aEligibleSubscriber = array();
            if (!empty($oSubscribers)) {
                foreach ($oSubscribers as $oSubscriber) {
                    $addedTime = strtotime($oSubscriber->created);
                    $deliverAt = $this->simplifiedTime($delayType, $delayUnit, $delayValue, $addedTime);
                    $endTime = $deliverAt + 1800;
                    if ($bbID == $this->testCampaignId) {
                        echo "<br>=====================Subscriber Details";
                        pre($oSubscriber);
                        echo "<br>Added time is " . date("Y-m-d H:i:s", $addedTime);
                        echo "<br>Deliver time is " . date("Y-m-d H:i:s", $deliverAt);
                        echo "<br>End time is " . date("Y-m-d H:i:s", $endTime);
                        echo "<br>Time Now " . date("Y-m-d H:i:s", $timeNow);
                    }
                    if ($timeNow >= $deliverAt && $oSubscriber->status == 1) {
                        $aEligibleSubscriber[] = $oSubscriber;
                    }
                }
            }

            $aMoreEligibleSubscriber = array();

            if (!empty($aEligibleSubscriber)) {
                foreach ($aEligibleSubscriber as $oSubs) {
                    if (!in_array($oSubs->id, $aProcessedSubscribers)) {
                        $aMoreEligibleSubscriber[] = $oSubs;
                    }
                }
            }

            if ($bbID == $this->testCampaignId) {
                echo "<br>Check 3";
                pre($aMoreEligibleSubscriber);
            }

            if (!empty($aMoreEligibleSubscriber)) {
                $aFireData = array(
                    'inviter_data' => $aEvent,
                    'subscribers' => $aMoreEligibleSubscriber
                );
                //pre($aMoreEligibleSubscriber);
                $this->fireAutomationCampaign($aFireData);
            }
        }
    }

    /**
     * Fires Automation end Campaigns
     * @param type $aData
     */
    public function fireAutomationCampaign($aData = array()) {
        //Instantiate Email Model to access its properties and methods
        $mInviter = new BrandboostModel();

        $oEvent = $aData['inviter_data'];
        $bbID = $oEvent->brandboost_id;
        $inviterID = $oEvent->id;
        $previousEventID = $oEvent->previous_event_id;
        $clientID = $oEvent->client_id;
        $aSubscribers = $aData['subscribers'];
        $aBrandboost = $mInviter->getBBInfo($bbID);
        if (!empty($aBrandboost)) {
            $bbType = $aBrandboost->review_type;
        }
        //Get owner information
        $this->client_from_email = '';
        $this->client_from_name = '';
        $clientEmail = $oEvent->client_email;

        $clientFirstName = $oEvent->client_first_name;
        $clientLastName = $oEvent->client_last_name;

        $fullName = trim($clientFirstName . ' '. $clientLastName);

        if (!empty($clientEmail)) {
            $this->client_from_email = $clientEmail;
        }

        if(!empty($fullName)){
            $this->client_from_name = $fullName;
        }

        $aCampaigns = $mInviter->getAutomationCampaign($inviterID);
        if ($bbID == $this->testCampaignId) {
            echo "<br>Check 4";
            pre($aCampaigns);
        }
        //pre($aCampaigns);
        //die;
        if (!empty($aCampaigns)) {
            foreach ($aCampaigns as $aCampaign) {
                $campaignType = $aCampaign->campaign_type;
                $greeting = $aCampaign->greeting;
                $introduction = $aCampaign->introduction;
                $content = base64_decode($aCampaign->stripo_compiled_html);
                $content = str_replace(array('{GREETING}', '{INTRODUCTION}'), array($greeting, $introduction), $content);
                if ($bbID == $this->testCampaignId) {
                    echo "<br>Check 5";
                    echo "Campaign Type is " . $campaignType;
                }
                if (strtolower($campaignType) == 'email') {
                    if ($bbID == $this->testCampaignId) {
                        echo "<br>Check 6";
                        echo "Campaign Type is " . $campaignType;
                    }
                    $subject = $aCampaign->subject;

                    $defaultFromEmail = (!empty($this->client_from_email)) ? $this->client_from_email : $this->from_email;
                    $defaultFromName = (!empty($this->client_from_name)) ? $this->client_from_name : $this->from_name;
                    $fromEmail = empty($aCampaign->from_email) ? $defaultFromEmail : $aCampaign->from_email;
                    $fromName = empty($aCampaign->from_name) ? $defaultFromName : $aCampaign->from_name;
                    $aEmailData = array(
                        'subject' => $subject,
                        'content' => $content,
                        'from' => $fromEmail,
                        'name' => $fromName,
                        'campaign_id' => $aCampaign->id,
                        'brandboost_id' => $bbID,
                        'inviter_id' => $inviterID,
                        'previous_event_id' => $previousEventID,
                        'client_id' => $clientID,
                        'review_type' => $bbType
                    );
                    // Now Send email
                    $this->sendBulkAutomationEmail($aSubscribers, $aEmailData);
                } else if (strtolower($campaignType) == 'sms') {
                    //$content = $aCampaign->html;
                    $content = str_replace('<br>', "\n", $content);
                    $content = str_replace('<br/>', "\n", $content);
                    $content = str_replace('<br />', "\n", $content);
                    $content = strip_tags(nl2br($content));
                    $fromNumber = $this->defaultTwilioDetails['from_number'];
                    $aSmsData = array(
                        'from_number' => $fromNumber, //We need this from client twillio phone number
                        'content' => $content,
                        'campaign_id' => $aCampaign->id,
                        'brandboost_id' => $bbID,
                        'inviter_id' => $inviterID,
                        'previous_event_id' => $previousEventID,
                        'client_id' => $clientID
                    );
                    $this->sendBulkAutomationSms($aSubscribers, $aSmsData);
                }
            }
        }
    }

    /**
     * Sends Emails in bulk
     * @param type $oSubscribers
     * @param type $aData
     */
    public function sendBulkAutomationEmail($oSubscribers, $aData) {
        //Instantiate Email Model to access its properties and methods
        $mInviter = new BrandboostModel();
        $content = $aData['content'];
        $fromEmail = $aData['from'];
        $fromName = $aData['name'];
        $subject = $aData['subject'];
        $clientID = $aData['client_id'];
        if ($aData['brandboost_id'] == $this->testCampaignId) {
            echo "<br>Check 7";
            pre($oSubscribers);
            echo "<br>Check 8";
            pre($aData);
        }
        if (!empty($oSubscribers)) {
            foreach ($oSubscribers as $oSubscriber) {
                //$userCurrentUsage = $mInviter->getCurrentUsage($clientID);
                //if ($userCurrentUsage->email_balance > 0 || $userCurrentUsage->email_balance_topup > 0) {
                $emailContent = $content;
                $messageID = $this->generateMessageId();
                $to = $oSubscriber->email;
                $aTrackSetttings = array();
                $aTrackSetttings['user_id'] = $oSubscriber->user_id;
                $aTrackSetttings['campaign_id'] = $aData['campaign_id'];
                $aTrackSetttings['inviter_id'] = $aData['inviter_id'];
                $aTrackSetttings['brandboost_id'] = $aData['brandboost_id'];
                $aTrackSetttings['email'] = $oSubscriber->email;
                $aTrackSetttings['subscriber_id'] = $oSubscriber->id;
                $aTrackSetttings['client_id'] = $clientID;
                $aTrackSetttings['bb_type'] = $aData['review_type'];
                //Replace Tags
                $contentReplaced = $mInviter->emailTagReplace($aData['brandboost_id'], $emailContent, 'email', $oSubscriber);
                //echo "Content is ". $content;
                $msg = $this->prepareHtmlContent($contentReplaced, $messageID, $aTrackSetttings);
                //pre($aData);
                //echo $msg;

                $aEmailData = [
                    'campaign_type' => 'email',
                    'to' => $to,
                    'from_entity' => $fromEmail,
                    'from_name' => $fromName,
                    'subject' => $subject,
                    'content' => base64_encode($msg),
                    'brandboost_id' => $aData['brandboost_id'],
                    'campaign_id' => $aData['campaign_id'],
                    'inviter_id' => $aData['inviter_id'],
                    'preceded_by' => $aData['previous_event_id'],
                    'message_id' => $messageID,
                    'client_id' => $clientID,
                    'moduleName' => 'brandboost',
                    'moduleUnitId' => $aData['brandboost_id'],
                    'subscriber_id' => $oSubscriber->id,
                    'globalSubscriberId' => $oSubscriber->subscriber_id,
                    'created' => date("Y-m-d H:i:s")
                ];
                if ($this->enableQueue == true) {
                    //Add email in the queue
                    $mInviter->saveInviterQueue($aEmailData);
                } else {
                    //Send email now
                    //pre($aEmailData);
                    //die;
                    $bCampaignAlreadySent = $mInviter->checkIfCampaignSent($aData['campaign_id'], $oSubscriber->id, 'subs_email', $oSubscriber->email);
                    $bSkipped = false;
                    if ($aData['brandboost_id'] == $this->testCampaignId) {
                        echo "<br>Check 9";
                        echo "<br> Already Sent " . $bCampaignAlreadySent;
                    }
                    if ($bCampaignAlreadySent == true) {
                        if ($aData['brandboost_id'] == $this->testCampaignId) {
                            echo "<br>Check 10";
                            echo "<br> Campaign already sent to " . $to;
                        }
                        $bEmailSent = true;
                        $bSkipped = true;
                    } else {
                        $bEmailSent = $this->SG_smtp($aEmailData);
                    }

                    if ($bEmailSent == true && $bSkipped == false) {
                        //Track Record
                        echo "<br> Email sent successfully";
                        $aLogData = array(
                            'inviter_id' => $aData['inviter_id'],
                            'subscriber_id' => $oSubscriber->id,
                            'preceded_by' => $aData['previous_event_id'],
                            'message_id' => $messageID,
                            'campaign_id' => $aData['campaign_id'],
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
                            'module_name' => 'brandboost',
                            'module_unit_id' => $aData['brandboost_id']
                        );
                        //$mInviter->updateUsage($aUsage);
                        updateCreditUsage($aUsage);
                    }
                }
                //}
            }
        }
    }

    /**
     * Sends Sms in bulk
     * @param type $oSubscribers
     * @param type $aData
     */
    public function sendBulkAutomationSms($oSubscribers, $aData) {
        //Instantiate Email Model to access its properties and methods
        $mInviter = new BrandboostModel();

        $content = $aData['content'];
        $fromNumber = $aData['from_number'];
        $clientID = $aData['client_id'];
        $subject = '';

        if (!empty($oSubscribers)) {
            foreach ($oSubscribers as $oSubscriber) {
                $smsContent = $mInviter->emailTagReplace($aData['brandboost_id'], $content, 'sms', $oSubscriber);
                //$userCurrentUsage = $mInviter->getCurrentUsage($clientID);
                //if ($userCurrentUsage->sms_balance > 0 || $userCurrentUsage->sms_balance_topup > 0) {
                $messageID = $this->generateMessageId();
                $toNumber = $oSubscriber->phone;
                $aSmsData = array(
                    'campaign_type' => 'sms',
                    'to' => $toNumber,
                    'from_entity' => $fromNumber,
                    'subject' => $subject,
                    'content' => $smsContent,
                    'brandboost_id' => $aData['brandboost_id'],
                    'campaign_id' => $aData['campaign_id'],
                    'inviter_id' => $aData['inviter_id'],
                    'subscriber_id' => $oSubscriber->id,
                    'preceded_by' => $aData['previous_event_id'],
                    'message_id' => $messageID,
                    'sending_server_id' => 0,
                    'client_id' => $clientID,
                    'created' => date("Y-m-d H:i:s")
                );
                if ($this->enableQueue == true) {
                    $mInviter->saveInviterQueue($aSmsData);
                } else {
                    //Send SMS now
                    //$bSmsSent = $this->send_Twilio($aSmsData);
                    $bCampaignAlreadySent = $mInviter->checkIfCampaignSent($aData['campaign_id'], $oSubscriber->id, 'subs_phone', $oSubscriber->phone);
                    $bSkipped = false;
                    if ($bCampaignAlreadySent == true) {
                        $bSmsSent = true;
                        $bSkipped = true;
                    } else {
                        $bSmsSent = $this->send_Twilio($aSmsData);
                    }
                    if ($bSmsSent == true && $bSkipped == false) {
                        //Track Record
                        $aLogData = array(
                            'inviter_id' => $aData['inviter_id'],
                            'subscriber_id' => $oSubscriber->id,
                            'preceded_by' => $aData['previous_event_id'],
                            'message_id' => $messageID,
                            'campaign_id' => $aData['campaign_id'],
                            'type' => 'sms',
                            'subs_email' => $oSubscriber->email,
                            'subs_phone' => $oSubscriber->phone
                        );
                        $this->saveLog($aLogData);
                        //Update Client Usage
                        $aUsage = array(
                            'client_id' => $clientID,
                            'usage_type' => 'sms',
                            'direction' => 'outbound',
                            'content' => $smsContent,
                            'spend_to' => $toNumber,
                            'spend_from' => $fromNumber,
                            'module_name' => 'brandboost',
                            'module_unit_id' => $aData['brandboost_id']
                        );
                        //$mInviter->updateUsage($aUsage);
                        $charCount = strlen($smsContent);
                        $totatMessageCount = ceil($charCount / 160);
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
                }
                //}
            }
        }
    }

    /**
     * Saves sending log
     * @param type $aData
     */
    public function saveLog($aData) {
        //Instantiate Email Model to access its properties and methods
        $mInviter = new BrandboostModel();

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
            $insertID = $mInviter->saveTriggerData($aTriggerData);
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
        $mInviter->saveSendingLog($aTrackData);
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
     * Generates unique email id for each email being sent out
     * @return type
     */
    public function generateMessageId() {
        return time() . rand(100000, 999999) . '.' . uniqid();
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
     * Gets simplified times returns date and time in seconds
     * @param type $delayType
     * @param type $delayUnit
     * @param type $delayValue
     * @param type $sourceTime
     * @return int
     */
    public function simplifiedTime($delayType, $delayUnit, $delayValue, $sourceTime) {
        switch ($delayUnit) {
            case "minute":
                $totalSeconds = 60 * $delayValue;
                break;
            case "hour":
                $totalSeconds = 60 * 60 * $delayValue;
                break;
            case "day":
                $totalSeconds = 60 * 60 * 24 * $delayValue;
                break;
            case "week":
                $totalSeconds = 60 * 60 * 24 * 7 * $delayValue;
                break;
            case "month":
                $totalSeconds = 60 * 60 * 24 * 7 * 30 * $delayValue;
                break;
            case "year":
                $totalSeconds = 60 * 60 * 24 * 7 * 30 * 365 * $delayValue;
                break;
            default :
                $totalSeconds = 0;
        }

        if ($delayType == 'before') {
            $simplifiedTime = $sourceTime - $totalSeconds;
        } else if ($delayType == 'after') {
            $simplifiedTime = $sourceTime + $totalSeconds;
        } else {
            $simplifiedTime = 0;
        }

        return $simplifiedTime;
    }

    /**
     * Used to send email using sendgrid
     * @param type $aData
     * @return boolean
     */
    public function SG_smtp($aData) {
        //Instantiate Email Model to access its properties and methods
        $mInviter = new BrandboostModel();

        if ($aData['brandboost_id'] == $this->testCampaignId) {
            echo "<br>Check 11";
            echo "<br> Sending Email ";
        }
        //For now use detault sendgrid account
        if ($this->use_default_accounts == true) {
            $aSendgridData = $this->defaultSendgridDetails;
            $user = $aSendgridData['user'];
            $password = $aSendgridData['password'];
            $host = $aSendgridData['host'];
            $port = $aSendgridData['port'];
            $type = $aSendgridData['type'];
        } else {
            $aSendgridData = $mInviter->getSendgridAccount($aData['client_id']);
            $user = $aSendgridData->sg_username;
            $password = $aSendgridData->sg_password;
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
        $footerSrc = getDefaultEmailFooter();

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

        $plainText = convertHtmlToPlain($emailContent);
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

        if ($aData['brandboost_id'] == $this->testCampaignId) {
            echo "<br>Check 12";
            pre($result);
            pre($params);
        }
        //pre($result);

        if (isset($result['errors'])) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Used to send sms using Twilio
     * @param type $aData
     * @return boolean
     */
    public function send_Twilio($aData) {
        //Instantiate Email Model to access its properties and methods
        $mInviter = new BrandboostModel();


        if ($this->use_default_accounts == true) {
            $aTwilioData = $this->defaultTwilioDetails;
            $sid = $aTwilioData['sid'];
            $token = $aTwilioData['token'];
            $from = $aData['from_entity'];
        } else {
            $aTwilioAc = $mInviter->getTwilioAccount($aData['client_id']);
            $sid = $aTwilioAc->account_sid;
            $token = $aTwilioAc->account_token;
            $from = $aTwilioAc->contact_no;
        }

        if (empty($aTwilioAc)) {
            return false;
        }

        $to = $aData['to'];

        $msg = $aData['content'];

        $bbID = $aData['brandboost_id'];
        $campaignID = $aData['campaign_id'];
        $eventID = $aData['inviter_id'];
        $subscriberID = $aData['subscriber_id'];


        $qs = '?';

        if (!empty($bbID)) {
            $qs .= 'bb_id=' . $bbID;
        }

        if (!empty($eventID)) {
            $qs .= '&bb_event_id=' . $eventID;
        }

        if (!empty($campaignID)) {
            $qs .= '&bb_campaign_id=' . $campaignID;
        }

        if (!empty($subscriberID)) {
            $qs .= '&bb_subscriber_id=' . $subscriberID;
        }

        $smsTrackURL = config('bbconfig.sms_track_url');

        if (!empty($smsTrackURL)) {
            $smsTrackURL = $smsTrackURL . $qs;
        }

        $urlData = array(
            'to_number' => $to,
            'from_number' => $from,
            'sid' => $sid,
            'subscriber_id' => $subscriberID,
            'brandboost_id' => $bbID,
            'event_id' => $eventID,
            'campaign_id' => $campaignID,
            'long_url' => $smsTrackURL,
            'created' => date("Y-m-d H:i:s")
        );

        $urlID = $mInviter->saveShortURL($urlData);

        $shortURl = base_url('t/' . $urlID);

        //$msgBody = base64_decode($msg);
        $msgBody = str_replace("{TEXT_REVIEW_URL}", replaceEmailTags($bbID, '{TEXT_REVIEW_URL}', 'sms'), $msg);
        $msgBody = str_replace("{REVIEW_URL}", replaceEmailTags($bbID, '{REVIEW_URL}', 'sms'), $msgBody);

        $aSmsData = array(
            'sid' => $sid,
            'token' => $token,
            'to' => $to,
            'from' => $from,
            'msg' => $msgBody,
            'smsTrackURL' => $smsTrackURL
        );
        //Send Sms now
        $response = sendClinetSMS($aSmsData);

        if ($aData['brandboost_id'] == '280') {
            //echo "\n Preparing for sending sms, Ok Response is ". $response;
            //pre($aSmsData);
        }
        return true;

    }

}
