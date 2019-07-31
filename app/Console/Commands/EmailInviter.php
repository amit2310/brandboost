<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin\Crons\ManagerModel;
use App\Models\Admin\Crons\EmailModel;
use App\Models\Admin\UsersModel;

class EmailInviter extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inviter:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This cron used to send emails/sms for Email module';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->trackServer = 'http://brandboost.io/trck';
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
        $this->client_from_email = '';
        $this->testing = false;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        //
        $this->startCampaign();
    }

    /**
     * Main function responsible to initiate all email automation campaigns
     */
    public function startCampaign() {
        //Check Cron Lock
        $bLocked = false;
        //Instanciate cron manager model to access its properties and methods
        $mCron = new ManagerModel();

        //Instanciate Email Model to access its properties and methods
        $mInviter = new EmailModel();

        $oCron = $mCron->checkCronStatus('automation');

        if ($oCron->locked == true) {
            die("Currently cron is locked");
        }

        if ($oCron->locked == false) {
            //Lock Cron
            $bLocked = $mCron->lockCron('automation');
        }

        if ($bLocked == false) {
            die("Currently cron is locked!!");
        }

        $aEvents = $mInviter->getInviterEvents();

        //pre($aEvents);
        if ($aEvents->isNotEmpty()) {
            foreach ($aEvents as $aEvent) {
                //if ($aEvent->automation_id == '190') {
                $bActiveSubsription = false;
                $userID = $aEvent->client_id;
                if ($userID > 0) {
                    $bActiveSubsription = UsersModel::isActiveSubscription($userID);
                    if ($bActiveSubsription == true) {

                        $inviterID = $aEvent->id;
                        $eventType = $aEvent->event_type;
                        $previousEventID = $aEvent->previous_event_id;

                        //echo "Event Type is ". $eventType;
                        switch ($eventType) {
                            case "main":
                                //$this->processListSubscription($aEvent, 'subscribe');
                                $this->processPrimaryContacts($aEvent);
                                break;
                            case "followup":
                                $this->processFollowup($aEvent);
                                break;
                            /* case "broadcast":
                              $this->processSpecificDateTime($aEvent);
                              break;
                              case "specific-datetime":
                              $this->processSpecificDateTime($aEvent);
                              break;
                              case "list-subscription":
                              $this->processListSubscription($aEvent, 'subscribe');
                              break;
                              case "list-unsubscription":
                              $this->processListSubscription($aEvent, 'unsubscribe');
                              break; */
                        }
                    } else {
                        echo "subscription expired";
                    }
                }
                //}
            }
        }

        //Release Cron
        $mCron->releaseCron('automation');
        print("Script Ended");
    }

    /**
     * Used to process followup events
     * @param type $aEvent
     */
    public function processFollowup($aEvent = array()) {
        //Instanciate Email Model to access its properties and methods
        $mInviter = new EmailModel();

        if (!empty($aEvent)) {
            $automationID = $aEvent->automation_id;
            $inviterID = $aEvent->id;
            $previousEventID = $aEvent->previous_event_id;
            $oParams = json_decode($aEvent->data);
            $delayType = $oParams->delay_type; //after or before
            $delayUnit = $oParams->delay_unit; // minute or hour or day or week or year
            $delayValue = $oParams->delay_value;
            $delayTime = $oParams->delay_time;

            //Get all subscriber and then find eligible subscribers only
            $oTriggers = $mInviter->getInviterFollowupSubscribers($inviterID, $previousEventID);
            //pre($oTriggers);
            //die;
            $timeNow = time();
            $aEligibleSubscriber = array();
            if (!empty($oTriggers)) {
                $eligibleSubscribers = array();
                foreach ($oTriggers as $oTrigger) {
                    $lastTriggered = strtotime($oTrigger->start_at);
                    $deliverAt = $this->simplifiedTime($delayType, $delayUnit, $delayValue, $lastTriggered);
                    $endTime = $deliverAt + 1800;
                    if ($this->testing == true) {
                        $deliverAt = $timeNow;
                    }
                    if ($timeNow >= $deliverAt && $timeNow <= $endTime) {
                        $aEligibleSubscriber[] = $oTrigger;
                    }
                }

                if (!empty($aEligibleSubscriber)) {
                    $aFireData = array(
                        'inviter_data' => $aEvent,
                        'subscribers' => $aEligibleSubscriber
                    );
                    //pre($aFireData);
                    //die;

                    $this->fireAutomationCampaign($aFireData);
                }
            }
        }
    }

    /**
     * Used to get all eligible contacts for the campaign
     * @param type $aEvent
     */
    public function processPrimaryContacts($aEvent = array()) {
        //Instanciate Email Model to access its properties and methods
        $mInviter = new EmailModel();

        if (!empty($aEvent)) {

            $automationID = $aEvent->automation_id;
            $inviterID = $aEvent->id;
            $oParams = json_decode($aEvent->data);
            //pre($oParams);
            $delayType = isset($oParams->delay_type) ? $oParams->delay_type : ''; //after or before
            $delayUnit = isset($oParams->delay_unit) ? $oParams->delay_unit : ''; // minute or hour or day or week or year
            $delayValue = isset($oParams->delay_value) ? $oParams->delay_value : '';

            //Get all subscriber and then find eligible subscribers only

            $oSubscribers = $mInviter->getInviterEligibleSubscribers($automationID);
            //pre($oSubscribers);
            $timeNow = time();
            $aEligibleSubscriber = array();

            if (!empty($oSubscribers)) {
                foreach ($oSubscribers as $oSubscriber) {
                    $addedTime = strtotime($oSubscriber->created);
                    $deliverAt = $this->simplifiedTime($delayType, $delayUnit, $delayValue, $addedTime);
                    $endTime = $deliverAt + 1800; //Process for additional 30 minutes of expiry
                    /* echo "<br>Time Now". date("Y-m-d H:i:s", $timeNow);
                      echo "<br>Delivery Time". date("Y-m-d H:i:s", $deliverAt);
                      echo "<br>End Time". date("Y-m-d H:i:s", $endTime); */
                    if ($timeNow >= $deliverAt && $oSubscriber->status == 1) {
                        $aEligibleSubscriber[] = $oSubscriber;
                    }
                }
            }


            //Refine more accurate subscribers

            $aProcessedSubscribers = $mInviter->getTriggeredSubscribers($inviterID);

            $aMoreEligibleSubscriber = array();

            if (!empty($aEligibleSubscriber)) {
                foreach ($aEligibleSubscriber as $oSubs) {
                    if (!in_array($oSubs->id, $aProcessedSubscribers)) {
                        $aMoreEligibleSubscriber[] = $oSubs;
                    }
                }
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
     * Fires Campaign
     * @param type $aData
     */
    public function fireAutomationCampaign($aData = array()) {
        //Instanciate Email Model to access its properties and methods
        $mInviter = new EmailModel();

        $oEvent = $aData['inviter_data'];
        $automationID = $oEvent->automation_id;
        $inviterID = $oEvent->id;
        $previousEventID = $oEvent->previous_event_id;
        $clientID = $oEvent->client_id;
        $aSubscribers = $aData['subscribers'];
        $aCampaigns = $mInviter->getAutomationCampaign($inviterID);
        //Get owner information
        $this->client_from_email = '';
        $clientFirstName = $oEvent->client_first_name;
        $clientLastName = $oEvent->client_last_name;
        $clientEmail = $oEvent->client_email;
        $clientPhone = $oEvent->client_phone;

        if (!empty($clientEmail)) {
            $this->client_from_email = $clientEmail;
        }

        pre($aCampaigns);
        if (!empty($aCampaigns)) {
            foreach ($aCampaigns as $aCampaign) {
                $campaignType = $aCampaign->campaign_type;
                if (strtolower($campaignType) == 'email') {
                    $subject = $aCampaign->subject;
                    $preheader = $aCampaign->preheader;
                    $content = base64_decode($aCampaign->stripo_compiled_html);
                    $defaultFromEmail = (!empty($this->client_from_email)) ? $this->client_from_email : $this->from_email;
                    $fromEmail = $aCampaign->from_email;
                    $fromEmail = empty($fromEmail) ? $defaultFromEmail : $fromEmail;
                    $fromName = $aCampaign->from_name;
                    $replyEmail = $aCampaign->reply_to;

                    $aEmailData = array(
                        'subject' => $subject,
                        'preheader' => $preheader,
                        'content' => $content,
                        'from' => $fromEmail,
                        'campaign_id' => $aCampaign->id,
                        'automation_id' => $automationID,
                        'inviter_id' => $inviterID,
                        'previous_event_id' => $previousEventID,
                        'client_id' => $clientID,
                        'fromName' => $fromName,
                        'replyEmail' => $replyEmail,
                        'module_name' => 'email'
                    );
                    // Now Send email
                    $this->sendBulkAutomationEmail($aSubscribers, $aEmailData);
                } else if (strtolower($campaignType) == 'sms') {
                    /* $content = str_replace('<br>', "\n", base64_decode($aCampaign->stripo_compiled_html));
                      $content = str_replace('<br/>', "\n", $content);
                      $content = str_replace('<br />', "\n", $content);
                      $content = strip_tags(nl2br($content)); */
                    $content = strip_tags(nl2br(str_replace(array('<br>', '<br/>', '<br />'), array("\n", "\n", "\n"), base64_decode($aCampaign->stripo_compiled_html))));
                    $aSmsData = array(
                        'from_number' => $fromNumber, //We need this from client twillio phone number
                        'content' => $content,
                        'campaign_id' => $aCampaign->id,
                        'automation_id' => $automationID,
                        'inviter_id' => $inviterID,
                        'previous_event_id' => $previousEventID,
                        'client_id' => $clientID,
                        'module_name' => 'email'
                    );

                    $this->sendBulkAutomationSms($aSubscribers, $aSmsData);
                }
            }
        }
    }

    /**
     * 
     * @param type $aEventUsed to process thank you invite
     */
    public function processThankyouInvites($aEvent = array()) {
        //Instanciate Email Model to access its properties and methods
        $mInviter = new EmailModel();


        if (!empty($aEvent)) {
            $bbID = $aEvent->brandboost_id;
            $inviterID = $aEvent->id;
            $eventType = $aEvent->event_type;
            $previousEventID = $aEvent->previous_event_id;
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
    }

    /**
     * 
     * @param type $aEventProcess Reminder Invites
     */
    public function processReminderInvites($aEvent = array()) {
        //Instanciate Email Model to access its properties and methods
        $mInviter = new EmailModel();

        if (!empty($aEvent)) {
            $bbID = $aEvent->brandboost_id;
            $inviterID = $aEvent->id;
            $eventType = $aEvent->event_type;
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
            $oSubscribers = $mInviter->getReminderEligibleSubscribers($bbID, $inviterID, $previousEventID);
            $timeNow = time();
            $aEligibleSubscriber = array();
            if (!empty($oSubscribers)) {
                foreach ($oSubscribers as $oSubscriber) {
                    if ($bbType == 'onsite') {
                        //Onsite Brandboost // check only reviews
                        $ifActionTaken = $mInviter->checkIfReviewGiven($bbID, $oSubscriber->user_id);
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
     * Process Specific Events
     */
    public function processSpecificDateTime($aEvent = array()) {
        //Instanciate Email Model to access its properties and methods
        $mInviter = new EmailModel();

        if (!empty($aEvent)) {
            $automationID = $aEvent->automation_id;
            $inviterID = $aEvent->id;
            $oParams = json_decode($aEvent->data);
            $deliveryDate = $oParams->delivery_date;
            $deliveryTime = $oParams->delivery_time;
            $timeString = $deliveryDate . ' ' . $deliveryTime;  //08/31/2017 1:05 AM
            $deliverAt = strtotime($timeString);

            $timeNow = strtotime(date("h:i A"));
            $oSubscribers = $mInviter->getInviterEligibleSubscribers($automationID);

            $aProcessedSubscribers = $mInviter->getTriggeredSubscribers($inviterID);

            $aEligibleSubscriber = array();

            if (!empty($oSubscribers)) {
                foreach ($oSubscribers as $oSubs) {
                    if (!in_array($oSubs->id, $aProcessedSubscribers)) {
                        $aEligibleSubscriber[] = $oSubs;
                    }
                }
            }
            //pre($aEligibleSubscriber);
            //echo "Delivery Time is ". date("Y-m-d H:i:s", $deliverAt);
            //echo "<br>Time now is ". date("Y-m-d H:i:s", $timeNow);
            //die;

            if ($this->testing == true) {
                $deliverAt = $timeNow;
            }

            if ($deliverAt <= $timeNow) {

                if (!empty($aEligibleSubscriber)) {
                    $aFireData = array(
                        'inviter_data' => $aEvent,
                        'subscribers' => $aEligibleSubscriber
                    );
                    $this->fireAutomationCampaign($aFireData);
                }
            }
        }
    }

    /**
     * Used to send Emails in bulk
     */
    public function sendBulkAutomationEmail($oSubscribers, $aData) {
        //Instanciate Email Model to access its properties and methods
        $mInviter = new EmailModel();

        $content = $aData['content'];
        $fromEmail = $aData['from'];
        $subject = $aData['subject'];
        $preheader = $aData['preheader'];
        $clientID = $aData['client_id'];
        $fromName = $aData['fromName'];
        $replyEmail = $aData['replyEmail'];

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
                $aTrackSetttings['automation_id'] = $aData['automation_id'];
                $aTrackSetttings['email'] = $oSubscriber->email;
                $aTrackSetttings['subscriber_id'] = $oSubscriber->id;
                $aTrackSetttings['client_id'] = $clientID;
                $aTrackSetttings['module_name'] = $aData['module_name'];
                //Replace Tags 

                $contentReplaced = $mInviter->emailTagReplace($aData['automation_id'], $emailContent, 'email', $oSubscriber);
                //echo "Content is ". $content;
                $msg = '';
                $msg = $this->prepareHtmlContent($contentReplaced, $messageID, $aTrackSetttings);
                //pre($aData);
                //echo $msg;

                $aEmailData = array(
                    'campaign_type' => 'email',
                    'to' => $to,
                    'from_entity' => $fromEmail,
                    'from_name' => $fromName,
                    'reply_email' => $replyEmail,
                    'subject' => $subject,
                    'preheader' => $preheader,
                    'content' => base64_encode($msg),
                    'automation_id' => $aData['automation_id'],
                    'campaign_id' => $aData['campaign_id'],
                    'inviter_id' => $aData['inviter_id'],
                    'preceded_by' => $aData['previous_event_id'],
                    'message_id' => $messageID,
                    'sending_server_id' => $currentServerID,
                    'client_id' => $clientID,
                    'module_name' => $aData['module_name'],
                    'moduleName' => 'automation',
                    'moduleUnitId' => $aData['automation_id'],
                    'subscriber_id' => $oSubscriber->id,
                    'globalSubscriberId' => $oSubscriber->subscriber_id,
                    'created' => date("Y-m-d H:i:s")
                );
                if ($this->enableQueue == true) {
                    //Add email in the queue
                    $mInviter->saveInviterQueue($aEmailData);
                } else {
                    //Send email now
                    //pre($aEmailData);
                    //die;
                    //Okay final check if campaign sent to the subscriber or not
                    //$bCampaignAlreadySent = $mInviter->checkIfCampaignSent($aData['campaign_id'], $oSubscriber->id);
                    $bCampaignAlreadySent = $mInviter->checkIfCampaignSent($aData['campaign_id'], $oSubscriber->id, 'subs_email', $oSubscriber->email);
                    $bSkipped = false;
                    if ($bCampaignAlreadySent == true) {
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
                            'sending_server_id' => $currentServerID,
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
                            'module_name' => 'automation',
                            'module_unit_id' => $aData['automation_id']
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
     * Used to send SMS in bulk
     */
    public function sendBulkAutomationSms($oSubscribers, $aData) {
        //Instanciate Email Model to access its properties and methods
        $mInviter = new EmailModel();
        $content = $aData['content'];
        $fromNumber = $aData['from_number'];
        $clientID = $aData['client_id'];
        if (!empty($oSubscribers)) {
            foreach ($oSubscribers as $oSubscriber) {

                $smsContent = $mInviter->emailTagReplace($aData['automation_id'], $content, 'sms', $oSubscriber);
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
                    'automation_id' => $aData['automation_id'],
                    'campaign_id' => $aData['campaign_id'],
                    'inviter_id' => $aData['inviter_id'],
                    'subscriber_id' => $oSubscriber->id,
                    'preceded_by' => $aData['previous_event_id'],
                    'message_id' => $messageID,
                    'sending_server_id' => 0,
                    'client_id' => $clientID,
                    'module_name' => $aData['module_name'],
                    'created' => date("Y-m-d H:i:s")
                );
                if ($this->enableQueue == true) {
                    $mInviter->saveInviterQueue($aSmsData);
                } else {
                    //Send SMS now
                    $bSmsSent = false;
                    $bCampaignAlreadySent = $mInviter->checkIfCampaignSent($aData['campaign_id'], $oSubscriber->id, 'subs_phone', $oSubscriber->phone);
                    $bSkipped = false;
                    if ($bCampaignAlreadySent == true) {
                        $bSmsSent = true;
                        $bSkipped = true;
                    } else {
                        $bSmsSent = $this->send_Twilio($aSmsData);
                        $bSmsSent = true;
                    }

                    if ($bSmsSent == true && $bSkipped == false) {
                        //Track Record
                        $aLogData = array(
                            'inviter_id' => $aData['inviter_id'],
                            'subscriber_id' => $oSubscriber->id,
                            'preceded_by' => $aData['previous_event_id'],
                            'message_id' => $messageID,
                            'campaign_id' => $aData['campaign_id'],
                            'sending_server_id' => $currentServerID,
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
                            'module_name' => 'automation',
                            'module_unit_id' => $aData['automation_id']
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
     * Used to save log of a cron
     */
    public function saveLog($aData) {
        //Instanciate Email Model to access its properties and methods
        $mInviter = new EmailModel();

        $timeNow = date("Y-m-d H:i:s");
        $insertID = 0;
        if (!empty($aData)) {
            $aTriggerData = array(
                'auto_event_id' => $aData['inviter_id'],
                'subscriber_id' => $aData['subscriber_id'],
                'preceded_by' => $aData['preceded_by'],
                'start_at' => $timeNow,
                'created_at' => $timeNow
            );
            $insertID = $mInviter->saveTriggerData($aTriggerData); //Trigger table
        }

        //Track Log
        $aTrackData = array(
            'campaign_type' => $aData['type'],
            'message_id' => $aData['message_id'],
            'subscriber_id' => $aData['subscriber_id'],
            'campaign_id' => $aData['campaign_id'],
            'auto_trigger_id' => $insertID,
            'status' => 'sent',
            'subs_email' => $aData['subs_email'],
            'subs_phone' => $aData['subs_phone'],
            'created_at' => date("Y-m-d H:i:s"),
        );
        $mInviter->saveSendingLog($aTrackData);
    }

    public function prepareHtmlContent($sMessage, $msgID, $aTrackSettings) {

        $sMessage = $this->addClickTrackingUrl($sMessage, $msgID, $aTrackSettings);

        $sMessage = $this->addOpenTrackingUrl($sMessage, $msgID, $aTrackSettings);
        return $sMessage;
    }

    function addClickTrackingUrl($content, $msgId, $aSettingsData = array()) {
        if (preg_match_all('/<a[^>]*href=["\'](?<url>http[^"\']*)["\']/i', $content, $matches)) {
            foreach ($matches[0] as $key => $href) {
                $url = $matches['url'][$key];
                $encodeURL = $this->base64UrlEncode($url);
                if (!empty($aSettingsData)) {
                    $userID = $aSettingsData['user_id'];
                    $subscriberID = $aSettingsData['subscriber_id'];
                    $campignID = $aSettingsData['campaign_id'];
                    $inviterID = $aSettingsData['inviter_id'];
                    $automationID = $aSettingsData['automation_id'];
                    $clientID = $aSettingsData['client_id'];
                    $moduleName = $aSettingsData['module_name'];
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
                    if ($automationID > 0) {
                        $additionalParams .= '&autoid=' . $automationID;
                    }
                    if ($subscriberID > 0) {
                        $additionalParams .= '&subid=' . $subscriberID;
                    }
                    if ($clientID > 0) {
                        $additionalParams .= '&clid=' . $clientID;
                    }
                    if (!empty($bbType)) {
                        $additionalParams .= '&modname=' . $moduleName;
                    }
                    $additionalParams = ($additionalParams) ? $additionalParams : '';
                }
                $trackClickUrl = $this->trackServer . '/email_track.php?click_redirect=' . $encodeURL . '&msgid=' . $this->base64UrlEncode($msgId) . $additionalParams;

                $newHref = str_replace($url, $trackClickUrl, $href);
                $content = str_replace($href, $newHref, $content);
            }
        }
        return $content;
    }

    public function addOpenTrackingUrl($content, $msgId) {
        $trackOpenUrl = $this->trackServer . '/email_track.php?open_track=true&msgid=' . $this->base64UrlEncode($msgId);
        return $content . '<img src="' . $trackOpenUrl . '" width="0" height="0" alt="" style="visibility:hidden" />';
    }

    public function generateMessageId() {
        return time() . rand(100000, 999999) . '.' . uniqid();
    }

    public function base64UrlEncode($val) {
        return strtr(base64_encode($val), '+/=', '-_,');
    }

    public function base64UrlDecode($val) {
        return base64_decode(strtr($val, '-_,', '+/='));
    }

    public function simplifiedTime($delayType, $delayUnit, $delayValue, $sourceTime) {
        switch (strtolower($delayUnit)) {
            case "minute":
            case "minutes":
                $totalSeconds = 60 * $delayValue;
                break;
            case "hour":
            case "hours":
                $totalSeconds = 60 * 60 * $delayValue;
                break;
            case "day":
            case "days":
                $totalSeconds = 60 * 60 * 24 * $delayValue;
                break;
            case "week":
            case "weeks":
                $totalSeconds = 60 * 60 * 24 * 7 * $delayValue;
                break;
            case "month":
            case "months":
                $totalSeconds = 60 * 60 * 24 * 7 * 30 * $delayValue;
                break;
            case "year":
            case "years":
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

    public function SG_smtp($aData) {
        //Instanciate Email Model to access its properties and methods
        $mInviter = new EmailModel();
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
        $sPreheaderText = '';
        if (!empty($aData['preheader'])) {
            $preheader = $aData['preheader'];
            $sPreheaderText = '<span class="c3896 c5535" style="box-sizing: border-box;display:none;visibility:hidden;mso-hide:all;font-size:1px;color:#ffffff;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;">' . $preheader . '</span>';
        }



        $emailContent = $sPreheaderText . $emailData . $footerCompiledCode;

        $fromName = $aData['from_name'];
        $replyEmail = !empty($aData['reply_email']) ? $aData['reply_email'] : $aData['from_entity'];

        $url = 'https://api.sendgrid.com/';
        $json_string = array(
            'unique_args' => array(
                'bb_subscriber_id' => $aData['subscriber_id'],
                'bb_event_id' => $aData['inviter_id'],
                'bb_automation_id' => $aData['automation_id'],
                'bb_campaign_id' => $aData['campaign_id'],
                'bb_module_name' => $aData['module_name']
            )
        );
        $plainText = convertHtmlToPlain($emailContent);
        $params = array(
            'api_user' => $user,
            'api_key' => $password,
            'to' => $aData['to'],
            'subject' => ($aData['subject']) ? $aData['subject'] : config('bbconfig.blank_subject'),
            'html' => $emailContent,
            'text' => $plainText,
            'from' => $aData['from_entity'],
            'x-smtpapi' => json_encode($json_string)
        );

        if (!empty($fromName)) {
            $params['fromname'] = $fromName;
        }

        if (!empty($replyEmail)) {
            $params['replyto'] = $replyEmail;
        }


        //pre($params);
        $request = $url . 'api/mail.send.json';
        $session = curl_init($request);
        curl_setopt($session, CURLOPT_POST, true);
        curl_setopt($session, CURLOPT_POSTFIELDS, $params);
        curl_setopt($session, CURLOPT_HEADER, false);
        curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($session);
        if ($errno = curl_errno($session)) {
            $error_message = curl_strerror($errno);
            echo "cURL error ({$errno}):\n {$error_message}";
        }
        curl_close($session);
        $result = (array) json_decode($result, True);

        if (isset($result['errors'])) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 
     * @param type $aData
     * @return booleanUsed to sent Twilio SMS
     */
    public function send_Twilio($aData) {
        //Instanciate Email Model to access its properties and methods
        $mInviter = new EmailModel();

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

        $automationID = $aData['automation_id'];
        $campaignID = $aData['campaign_id'];
        $eventID = $aData['inviter_id'];
        $subscriberID = $aData['subscriber_id'];
        $moduleName = $aData['module_name'];


        $qs = '?';

        if (!empty($automationID)) {
            $qs .= 'auto_id=' . $automationID;
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

        if (!empty($moduleName)) {
            $qs .= '&modname=' . $moduleName;
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

        //$msgBody = base64_decode($msg);
        //mail('regan@123789.org', 'Test SMS MSG', $msg);

        $aSmsData = array(
            'sid' => $sid,
            'token' => $token,
            'to' => $to,
            'from' => $from,
            'msg' => $msg,
            'smsTrackURL' => $smsTrackURL
        );
        //Send Sms now
        $response = sendClinetSMS($aSmsData);
        if ($response)
            return true;
        else
            return false;
    }

    /**
     * Old Method no more in use
     */
    public function emailTagReplace_OLD($bbID, $sHtml, $campaignType = 'email', $subscriberInfo) {
        //Instanciate Email Model to access its properties and methods
        $mInviter = new EmailModel();

        $aTags = config('bbconfig.email_tags');
        $aBrandboost = $mInviter->getBBInfo($bbID);
        if (!empty($aBrandboost)) {
            $bbType = $aBrandboost->review_type;
            $aOffsiteUrls = unserialize($aBrandboost->offsites_links);
            $random_keys = array_rand($aOffsiteUrls, 1);
            $offsiteURL = $aOffsiteUrls[$random_keys];
        }
        if (!empty($aTags)) {
            foreach ($aTags AS $sTag) {
                $htmlData = '';
                switch ($sTag) {
                    case '{FIRST_NAME}':
                        $htmlData = $subscriberInfo->firstname;
                        break;

                    case '{LAST_NAME}':
                        $htmlData = $subscriberInfo->lastname;
                        break;

                    case '{EMAIL}':
                        $htmlData = $subscriberInfo->email;
                        break;

                    case '{PHONE}':
                        $htmlData = $subscriberInfo->phone;
                        break;

                    case '{FIVE_STARS_RATINGS}':
                        $aData = $this->mReviews->getCampReviewsWithFiveRatings($bbID);
                        $htmlData = '<html>
				<head>
				<meta charset="utf-8">
				<title>Brandboost Email Template</title>
				<style>
				@import url("https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700");
				@import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
				body{margin: 0;}
				.bb_txt_review{width: 100%; max-width: 700px; box-sizing: border-box; margin:50px auto; padding:15px 15px 0; background: #fff; border: 15px solid #ddd; font-family: "Open Sans", sans-serif; position: relative; font-size: 14px;}
				.bb_txt_inner{margin: 0 auto; max-width: 100%; width: 100%; position: relative; }
				.bb_txt_review .clearfix{clear: both;}
				.bb_txt_head {text-align: center;  background: #f7faff; padding: 10px; box-sizing: border-box; border: 1px solid #cfe1ff; margin-bottom: 15px;}
				.bb_txt_head img{width: 120px; height: auto;}
				.bb_txt_review p{margin: 0 0 7px; color: #aaa;}
				.bb_txt_review p .fa{font-size: 22px; color: #ccc; margin: 0 3px;}
				.bb_txt_review p .fa.green{font-size: 22px; color: #3b9200;}
				.bb_txt_review p.green{font-size: 15px; border-bottom: 3px solid #3b9200;color: #3b9200; display: inline-block; padding-bottom: 4px; margin-bottom: 30px; }
				.bb_txt_user{position: relative; padding: 15px; margin-bottom: 15px; background: #f9f9f9; border: 1px solid #ddd; box-sizing: border-box; }
				.bb_txt_user.last{margin: 0;}
				.bb_txt_user p strong{ color: #3b9200;}
				.bb_txt_user p span{ font-size: 12px;}
				.bb_txt_user p .fa{font-size: 15px!important;}
				.bb_txt_user_rev p strong{font-size: 16px; color: #333; font-weight: 600;}
				.bb_txt_user_rev p span{font-size: 13px; color: #333; font-weight: 400;}
				.bb_txt_user_rev a.share_bb{color: #aaa; font-size: 13px; font-weight: 600; text-decoration: none;}
				.bb_date_help{position: absolute; right: 0; top: 0; padding: 15px; }
				.bb_date_help p{text-align: right; color: #666}
				.product_details_sec{margin-bottom: 15px;}
				.bb_product_img{width: 50%; max-width: 190px; margin-right: 15px; border: 1px solid #ddd; padding: 10px; float: left; box-sizing: border-box}
				.bb_slides_text{width: 50%; float: left; box-sizing: border-box; padding: 10px;}
				.bb_slides_text p{margin: 0 0 7px; color: #a2a2a2; font-size: 14px;}
				.bb_slides_text p .fa{font-size: 22px; margin: 0 5px 0 0}
				.bb_slides_text p .fa.green{ color: #3b9200;}
				.fa.red{ color: red!important;}
				.bb_slides_text p span{font-style: italic;}
				.bb_slides_text p a.green{color: #3b9200; text-decoration: none; font-weight: 600;}
				.bb_slides_text h4{margin: 0 0 7px; color: #4f4f4f; font-size: 16px; font-weight: 600;}
				</style>
				</head>
				<body>
				<div class="bb_txt_review">
				<div class="bb_txt_inner">
				<div class="bb_txt_head">
				<img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $aData[0]->logo_img . '"/>
				</div>
				<div class="product_details_sec">
				<div class="bb_product_img">
				<img style="width: 100%;" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $aData[0]->brand_img . '"/>
				</div>
				<div class="bb_slides_text">
				<h4>' . $aData[0]->brand_title . '</h4>
				<p><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa fa-star"></i></p>
				<p><span>' . $aData[0]->brand_desc . '</span></p>
				<p><a class="green" href="#">' . $aData[0]->bb_u_firstname . ' ' . $aData[0]->bb_u_lastname . '</a></p>
				</div>
				<div class="clearfix"></div>
				</div>';
                        foreach ($aData as $data) {
                            $helpfulCountArray = $this->mReviews->countHelpful($data->reviewId);
                            $starValue = getReviewStarShow($data->ratings);
                            $htmlData .= '<div class="bb_txt_user">
					<p><strong>' . $data->firstname . ' ' . $data->lastname . '</strong> <span>Verified Buyer</span></p>
					<p>' . $starValue . '</p>
					<div class="bb_txt_user_rev"><p><span>' . $data->comment_text . '</span></p></div>
					<div class="bb_date_help">
					<p>' . date('m/d/Y', strtotime($data->created)) . '</p>
					<p>Was this review helpful?  <i class="fa green fa-hand-o-up"></i> ' . $helpfulCountArray['yes'] . ' &nbsp; <i class="fa red fa-hand-o-down"></i> ' . $helpfulCountArray['no'] . '</p>
					</div>
					</div>';
                        }
                        $htmlData .= '<div class="clearfix"></div>
				</div>
				</div>
				</body>
				</html>';
                        break;

                    case '{FOUR_STARS_RATINGS}':
                        $aData = $this->mReviews->getCampReviewsWithFourRatings($bbID);
                        $htmlData = '<html>
				<head>
				<meta charset="utf-8">
				<title>Brandboost Email Template</title>
				<style>
				@import url("https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700");
				@import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
				body{margin: 0;}
				.bb_txt_review{width: 100%; max-width: 700px; box-sizing: border-box; margin:50px auto; padding:15px 15px 0; background: #fff; border: 15px solid #ddd; font-family: "Open Sans", sans-serif; position: relative; font-size: 14px;}
				.bb_txt_inner{margin: 0 auto; max-width: 100%; width: 100%; position: relative; }
				.bb_txt_review .clearfix{clear: both;}
				.bb_txt_head {text-align: center;  background: #f7faff; padding: 10px; box-sizing: border-box; border: 1px solid #cfe1ff; margin-bottom: 15px;}
				.bb_txt_head img{width: 120px; height: auto;}
				.bb_txt_review p{margin: 0 0 7px; color: #aaa;}
				.bb_txt_review p .fa{font-size: 22px; color: #ccc; margin: 0 3px;}
				.bb_txt_review p .fa.green{font-size: 22px; color: #3b9200;}
				.bb_txt_review p.green{font-size: 15px; border-bottom: 3px solid #3b9200;color: #3b9200; display: inline-block; padding-bottom: 4px; margin-bottom: 30px; }
				.bb_txt_user{position: relative; padding: 15px; margin-bottom: 15px; background: #f9f9f9; border: 1px solid #ddd; box-sizing: border-box; }
				.bb_txt_user.last{margin: 0;}
				.bb_txt_user p strong{ color: #3b9200;}
				.bb_txt_user p span{ font-size: 12px;}
				.bb_txt_user p .fa{font-size: 15px!important;}
				.bb_txt_user_rev p strong{font-size: 16px; color: #333; font-weight: 600;}
				.bb_txt_user_rev p span{font-size: 13px; color: #333; font-weight: 400;}
				.bb_txt_user_rev a.share_bb{color: #aaa; font-size: 13px; font-weight: 600; text-decoration: none;}
				.bb_date_help{position: absolute; right: 0; top: 0; padding: 15px; }
				.bb_date_help p{text-align: right; color: #666}
				.product_details_sec{margin-bottom: 15px;}
				.bb_product_img{width: 50%; max-width: 190px; margin-right: 15px; border: 1px solid #ddd; padding: 10px; float: left; box-sizing: border-box}
				.bb_slides_text{width: 50%; float: left; box-sizing: border-box; padding: 10px;}
				.bb_slides_text p{margin: 0 0 7px; color: #a2a2a2; font-size: 14px;}
				.bb_slides_text p .fa{font-size: 22px; margin: 0 5px 0 0}
				.bb_slides_text p .fa.green{ color: #3b9200;}
				.fa.red{ color: red!important;}
				.bb_slides_text p span{font-style: italic;}
				.bb_slides_text p a.green{color: #3b9200; text-decoration: none; font-weight: 600;}
				.bb_slides_text h4{margin: 0 0 7px; color: #4f4f4f; font-size: 16px; font-weight: 600;}
				</style>
				</head>
				<body>
				<div class="bb_txt_review">
				<div class="bb_txt_inner">
				<div class="bb_txt_head">
				<img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $aData[0]->logo_img . '"/>
				</div>
				<div class="product_details_sec">
				<div class="bb_product_img">
				<img style="width: 100%;" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $aData[0]->brand_img . '"/>
				</div>
				<div class="bb_slides_text">
				<h4>' . $aData[0]->brand_title . '</h4>
				<p><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa fa-star"></i></p>
				<p><span>' . $aData[0]->brand_desc . '</span></p>
				<p><a class="green" href="#">' . $aData[0]->bb_u_firstname . ' ' . $aData[0]->bb_u_lastname . '</a></p>
				</div>
				<div class="clearfix"></div>
				</div>';
                        foreach ($aData as $data) {
                            $helpfulCountArray = $this->mReviews->countHelpful($data->reviewId);
                            $starValue = getReviewStarShow($data->ratings);
                            $htmlData .= '<div class="bb_txt_user">
					<p><strong>' . $data->firstname . ' ' . $data->lastname . '</strong> <span>Verified Buyer</span></p>
					<p>' . $starValue . '</p>
					<div class="bb_txt_user_rev"><p><span>' . $data->comment_text . '</span></p></div>
					<div class="bb_date_help">
					<p>' . date('m/d/Y', strtotime($data->created)) . '</p>
					<p>Was this review helpful?  <i class="fa green fa-hand-o-up"></i> ' . $helpfulCountArray['yes'] . ' &nbsp; <i class="fa red fa-hand-o-down"></i> ' . $helpfulCountArray['no'] . '</p>
					</div>
					</div>';
                        }
                        $htmlData .= '<div class="clearfix"></div>
				</div>
				</div>
				</body>
				</html>';
                        break;

                    case '{TOP_STAR_RATINGS}':
                        $aData = $this->mReviews->getCampReviewsWithTopRatings($bbID);
                        $htmlData = '<html>
				<head>
				<meta charset="utf-8">
				<title>Brandboost Email Template</title>
				</head>
				<body>
				<style>
				@import url("https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700");
				@import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
				body{margin: 0;}
				.bb_txt_review{width: 100%; max-width: 700px; box-sizing: border-box; margin:50px auto; padding:15px 15px 0; background: #fff; border: 15px solid #ddd; font-family: "Open Sans", sans-serif; position: relative; font-size: 14px;}
				.bb_txt_inner{margin: 0 auto; max-width: 100%; width: 100%; position: relative; }
				.bb_txt_review .clearfix{clear: both;}
				.bb_txt_head {text-align: center;  background: #f7faff; padding: 10px; box-sizing: border-box; border: 1px solid #cfe1ff; margin-bottom: 15px;}
				.bb_txt_head img{width: 120px; height: auto;}
				.bb_txt_review p{margin: 0 0 7px; color: #aaa;}
				.bb_txt_review p .fa{font-size: 22px; color: #ccc; margin: 0 3px;}
				.bb_txt_review p .fa.green{font-size: 22px; color: #3b9200;}
				.bb_txt_review p.green{font-size: 15px; border-bottom: 3px solid #3b9200;color: #3b9200; display: inline-block; padding-bottom: 4px; margin-bottom: 30px; }
				.bb_txt_user{position: relative; padding: 15px; margin-bottom: 15px; background: #f9f9f9; border: 1px solid #ddd; box-sizing: border-box; }
				.bb_txt_user.last{margin: 0;}
				.bb_txt_user p strong{ color: #3b9200;}
				.bb_txt_user p span{ font-size: 12px;}
				.bb_txt_user p .fa{font-size: 15px!important;}
				.bb_txt_user_rev p strong{font-size: 16px; color: #333; font-weight: 600;}
				.bb_txt_user_rev p span{font-size: 13px; color: #333; font-weight: 400;}
				.bb_txt_user_rev a.share_bb{color: #aaa; font-size: 13px; font-weight: 600; text-decoration: none;}
				.bb_date_help{position: absolute; right: 0; top: 0; padding: 15px; }
				.bb_date_help p{text-align: right; color: #666}
				.product_details_sec{margin-bottom: 15px;}
				.bb_product_img{width: 50%; max-width: 190px; margin-right: 15px; border: 1px solid #ddd; padding: 10px; float: left; box-sizing: border-box}
				.bb_slides_text{width: 50%; float: left; box-sizing: border-box; padding: 10px;}
				.bb_slides_text p{margin: 0 0 7px; color: #a2a2a2; font-size: 14px;}
				.bb_slides_text p .fa{font-size: 22px; margin: 0 5px 0 0}
				.bb_slides_text p .fa.green{ color: #3b9200;}
				.fa.red{ color: red!important;}
				.bb_slides_text p span{font-style: italic;}
				.bb_slides_text p a.green{color: #3b9200; text-decoration: none; font-weight: 600;}
				.bb_slides_text h4{margin: 0 0 7px; color: #4f4f4f; font-size: 16px; font-weight: 600;}
				</style>
				<div class="bb_txt_review">
				<div class="bb_txt_inner">
				<div class="bb_txt_head">
				<img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $aData[0]->logo_img . '"/>
				</div>
				<div class="product_details_sec">
				<div class="bb_product_img">
				<img style="width: 100%;" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $aData[0]->brand_img . '"/>
				</div>
				<div class="bb_slides_text">
				<h4>' . $aData[0]->brand_title . '</h4>
				<p><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa fa-star"></i></p>
				<p><span>' . $aData[0]->brand_desc . '</span></p>
				<p><a class="green" href="#">' . $aData[0]->bb_u_firstname . ' ' . $aData[0]->bb_u_lastname . '</a></p>
				</div>
				<div class="clearfix"></div>
				</div>';
                        foreach ($aData as $data) {
                            $helpfulCountArray = $this->mReviews->countHelpful($data->reviewId);
                            $starValue = getReviewStarShow($data->ratings);
                            $htmlData .= '<div class="bb_txt_user">
					<p><strong>' . $data->firstname . ' ' . $data->lastname . '</strong> <span>Verified Buyer</span></p>
					<p>' . $starValue . '</p>
					<div class="bb_txt_user_rev"><p><span>' . $data->comment_text . '</span></p></div>
					<div class="bb_date_help">
					<p>' . date('m/d/Y', strtotime($data->created)) . '</p>
					<p>Was this review helpful?  <i class="fa green fa-hand-o-up"></i> ' . $helpfulCountArray['yes'] . ' &nbsp; <i class="fa red fa-hand-o-down"></i> ' . $helpfulCountArray['no'] . '</p>
					</div>
					</div>';
                        }
                        $htmlData .= '<div class="clearfix"></div>
				</div>
				</div>
				</body>
				</html>';
                        break;

                    case '{WRITE_REVIEW_FORM}':
                        $aData = $this->mReviews->getBrandBoostCampaign($bbID);

                        $htmlData = '<html>
				<head>
				<meta charset="utf-8">
				<title>Brandboost Email Template</title>
				<style>
				@import url("https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700");
				@import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
				body{margin: 0;}
				.bb_txt_review{width: 100%; max-width: 700px; box-sizing: border-box; margin:50px auto; padding:15px 15px 0; background: #fff; border: 15px solid #ddd; font-family: "Open Sans", sans-serif; position: relative; font-size: 14px;}
				.bb_txt_inner{margin: 0 auto; max-width: 100%; width: 100%; position: relative; }
				.bb_txt_review .clearfix{clear: both;}
				.bb_txt_head {text-align: center;  background: #f7faff; padding: 10px; box-sizing: border-box; border: 1px solid #cfe1ff; margin-bottom: 15px;}
				.bb_txt_head img{width: 120px; height: auto;}
				.bb_txt_review p{margin: 0 0 7px; color: #aaa;}
				.bb_txt_review p .fa{font-size: 22px; color: #ccc; margin: 0 3px;}
				.bb_txt_review p .fa.green{font-size: 22px; color: #3b9200;}
				.bb_txt_review p.green{font-size: 18px; border-bottom: 3px solid #3b9200;color: #3b9200; display: inline-block; padding-bottom: 4px; margin-bottom: 20px; font-weight:bold;}
				.product_details_sec{margin-bottom: 15px;}
				.bb_product_img{width: 50%; max-width: 190px; margin-right: 15px; border: 1px solid #ddd; padding: 10px; float: left; box-sizing: border-box}
				.bb_slides_text{width: 50%; float: left; box-sizing: border-box; padding: 10px;}
				.bb_slides_text p{margin: 0 0 7px; color: #a2a2a2; font-size: 14px;}
				.bb_slides_text p .fa{font-size: 22px; margin: 0 5px 0 0}
				.bb_slides_text p .fa.green{ color: #3b9200;}
				.fa.red{ color: red!important;}
				.bb_slides_text p span{font-style: italic;}
				.bb_slides_text p a.green{color: #3b9200; text-decoration: none; font-weight: 600;}
				.bb_slides_text h4{margin: 0 0 7px; color: #4f4f4f; font-size: 16px; font-weight: 600;}
				.bb_txt_write{padding: 15px; box-sizing: border-box; border: 1px solid #ddd; border-radius: 3px; margin: 15px 0;}
				.bb_txt_write input[type=text], .bb_txt_write textarea, .bb_txt_write select{border: 1px solid #ddd; height: 30px; display: block;width: 100%; margin-bottom: 15px; box-sizing: border-box; font-family: "Open Sans", sans-serif;background: #fff; border-radius: 3px;}
				.bb_txt_write textarea{ height: 85px;  padding: 15px; }
				.bb_txt_write input[type=submit]{background: #3b9200; color: #3b9200; height: 30px; width: 100px; border: none; color: #fff; float: right; border-radius: 3px;}
				.bb_write_review{display: inline-block; width: 150px; text-align: center; height: 30px; color: #fff; background: #3b9200; line-height: 30px; margin: 0 0 20px; text-decoration: none; text-transform: uppercase; border-radius: 3px;}";
				</style>
				</head>
				<body>
				<div class="bb_txt_review">
				<div class="bb_txt_inner">
				<div class="bb_txt_head">
				<img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $aData->logo_img . '"/>
				</div>
				<div class="product_details_sec">
				<div class="bb_product_img">
				<img style="width: 100%;" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $aData->brand_img . '"/>
				</div>
				<div class="bb_slides_text">
				<h4>' . $aData->brand_title . '</h4>
				<p><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa green fa-star"></i><i class="fa fa-star"></i></p>
				<p><span>' . $aData->brand_desc . '</span></p>
				<p><a class="green">' . $aData->firstname . ' ' . $aData->lastname . '</a></p>
				</div>
				<div class="clearfix"></div>
				</div><div class="bb_txt_write">
				<form name="writeReview" id="writeReview" method="POST" action="' . site_url("/reviews/saveReviewByEmailTemplate") . '">
				<p class="green">WRITE A REVIEW</p>
				<p>Score:</p>
				<select name="ratingValue" id="ratingValue" required>
				<option value="">Select Star Ratings</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				</select>
				<p>Name:</p>
				<input type="text" value="" name="fullname" required>
				<p>Email:</p>
				<input type="text" value="" name="email" required >
				<p>Review: </p>
				<textarea name="content" id="content" required></textarea>
				<input type="hidden" value="text" name="type" >
				<input type="hidden" value="' . $aData->id . '" name="campaign_id" >
				<input type="submit" value="POST" name="post"/>
				</form>
				<div class="clearfix"></div>
				</div><div class="clearfix"></div>
				</div>
				</div>
				</body>
				</html>';
                        break;

                    case '{TEXT_REVIEW_URL}':
                    case '{REVIEW_URL}':
                        if ($bbType == 'offsite') {
                            foreach ($aOffsiteUrls AS $index => $aUrl) {
                                $aWebsiteInfo = $mInviter->getOffsiteWebsite($index);
                                if ($campaignType == 'sms') {
                                    $htmlData .= "<a href='" . $aUrl['shorturl'] . "'>" . $aWebsiteInfo->name . "</a><br>";
                                } else {
                                    $htmlData .= "<a href='" . $aUrl['longurl'] . "'><img src='" . base_url() . "uploads/" . $aWebsiteInfo->image . "' width='44' height='44' />&nbsp;&nbsp;" . $aWebsiteInfo->name . "</a><br><br>";
                                }
                            }
                        } else {
                            $htmlData = "<a href='" . base_url() . "reviews/addnew'>Review link</a>";
                        }

                        break;

                    case '{VIDEO_REVIEW_URL}':

                        if ($bbType == 'offsite') {
                            foreach ($aOffsiteUrls AS $index => $aUrl) {
                                $aWebsiteInfo = $mInviter->getOffsiteWebsite($index);
                                if ($campaignType == 'sms') {
                                    $htmlData .= "<a href='" . $aUrl['shorturl'] . "'>" . $aWebsiteInfo->name . "</a><br>";
                                } else {
                                    $htmlData .= "<a href='" . $aUrl['longurl'] . "'><img src='" . base_url() . "uploads/" . $aWebsiteInfo->image . "' width='44' height='44' />&nbsp;&nbsp;" . $aWebsiteInfo->name . "</a><br><br>";
                                }
                            }
                        } else {
                            //$htmlData = "<a href='" . base_url() . "reviews/add/video/" . $bbID . "'>Video review link</a>";
                            $htmlData = "<a href='" . base_url() . "reviews/addnew'>Review link</a>";
                        }
                        break;
                }
                $sHtml = str_replace($sTag, $htmlData, $sHtml);
            }
        }
        return $sHtml;
    }

    //Unused Methods
    public function processListSubscription($aEvent = array(), $subscriberAction) {
        //Instanciate Email Model to access its properties and methods
        $mInviter = new EmailModel();
        if (!empty($aEvent)) {

            $automationID = $aEvent->automation_id;
            $inviterID = $aEvent->id;
            $eventType = $aEvent->event_type;
            $previousEventID = $aEvent->previous_event_id;
            $oParams = json_decode($aEvent->data);
            $delayType = $oParams->delay_type; //after or before
            $delayUnit = $oParams->delay_unit; // minute or hour or day or week or year
            $delayValue = $oParams->delay_value;
            $delayTime = $oParams->delay_time;

            //Get all subscriber and then find eligible subscribers only
            $oSubscribers = $mInviter->getInviterEligibleSubscribers($automationID);
            $timeNow = time();
            $aEligibleSubscriber = array();
            if ($subscriberAction == 'subscribe') {
                if (!empty($oSubscribers)) {
                    foreach ($oSubscribers as $oSubscriber) {
                        $addedTime = strtotime($oSubscriber->created);
                        $deliverAt = $this->simplifiedTime($delayType, $delayUnit, $delayValue, $addedTime);
                        if ($deliverAt <= $timeNow && $oSubscriber->status == 1) {
                            $aEligibleSubscriber[] = $oSubscriber;
                        }
                    }
                }
            }

            if ($subscriberAction == 'unsubscribe') {

                if (!empty($oSubscribers)) {
                    foreach ($oSubscribers as $oSubscriber) {
                        $updatedTime = strtotime($oSubscriber->updated);
                        $deliverAt = $this->simplifiedTime($delayType, $delayUnit, $delayValue, $updatedTime);
                        if ($deliverAt <= $timeNow && $oSubscriber->status == 0) {
                            $aEligibleSubscriber[] = $oSubscriber;
                        }
                    }
                }
            }

            //Refine more accurate subscribers

            $aProcessedSubscribers = $mInviter->getTriggeredSubscribers($inviterID);

            $aMoreEligibleSubscriber = array();

            if (!empty($aEligibleSubscriber)) {
                foreach ($aEligibleSubscriber as $oSubs) {
                    if (!in_array($oSubs->id, $aProcessedSubscribers)) {
                        $aMoreEligibleSubscriber[] = $oSubs;
                    }
                }
            }

            if (!empty($aMoreEligibleSubscriber)) {
                $aFireData = array(
                    'inviter_data' => $aEvent,
                    'subscribers' => $aMoreEligibleSubscriber
                );

                $this->fireAutomationCampaign($aFireData);
            }
        }
    }

}
