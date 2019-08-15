<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin\Crons\ManagerModel;
use App\Models\Admin\Crons\NpsModel;
use App\Models\Admin\UsersModel;

class NpsInviter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inviter:nps';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This cron used to send emails/sms for NPS module';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        $this->client_from_email = '';
        $this->testing = false;
        $this->testCampaignId = '';
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       $this->startCampaign();
    }
    
    
    /**
     * Starts the campaign cron
     */
    public function startCampaign() {
        
        //Instantiate cron manager model to access its properties and methods
        $mCron = new ManagerModel();
        
        //Instantiate Nps cron model to access its properties and methods
        $mInviter = new NpsModel();

        //Check Cron Lock
        $bLocked = false;
        $oCron = $mCron->checkCronStatus('nps');
        if ($oCron->locked == true) {
            die("Currently cron is locked");
        }

        if ($oCron->locked == false) {
            //Lock Cron
            $bLocked = $mCron->lockCron('nps');
        }

        if ($bLocked == false) {
            die("Currently cron is locked!!");
        }

        $aEvents = $mInviter->getInviterEvents();
        //pre($aEvents);
        //die;
        if (!empty($aEvents)) {
            foreach ($aEvents as $aEvent) {
                $bActiveSubsription = false;
                $userID = $aEvent->client_id;
                if ($userID > 0) {
                    $bActiveSubsription = UsersModel::isActiveSubscription($userID);
                    //pre($bActiveSubsription); exit;
                    if ($bActiveSubsription == true) {
                        
                        $eventType = $aEvent->event_type;                        

                        //echo "Event Type is ". $eventType;
                        switch ($eventType) {
                            case "main":
                                $this->processNPSInvite($aEvent);
                                break;
                            case "followup":
                                $this->processNPSReminder($aEvent);
                                break;
                            case "invite-email":
                                $this->processNPSInvite($aEvent);
                                break;
                            case "invite-sms":
                                $this->processNPSInvite($aEvent);
                                break;
                            case "reminder-email":
                                $this->processNPSReminder($aEvent);
                                break;
                            case "reminder-sms":
                                $this->processNPSReminder($aEvent);
                                break;
                        }
                    }
                }
            }
        }
        //Release Cron
        $mCron->releaseCron('nps');
        print("Script Ended");
    }

    
    public function processNPSInvite($aEvent = array()) {
        //Instantiate Nps cron model to access its properties and methods
        $mInviter = new NpsModel();
        
        if (!empty($aEvent)) {
            //pre($aEvent);
            $npsID = $aEvent->nps_id;
            $accountID = $aEvent->account_id;
            $inviterID = $aEvent->id;
            $previousEventID = $aEvent->previous_event_id;
            $oParams = json_decode($aEvent->data);
            $delayType = $oParams->delay_type; //after or before
            $delayUnit = $oParams->delay_unit; // minute or hour or day or week or year
            $delayValue = $oParams->delay_value;
            
            //Get all subscriber and then find eligible subscribers only
            if (empty($previousEventID)) {
                $oSubscribers = $mInviter->getInviterEligibleSubscribers($inviterID, $npsID);
            } else {
                $oSubscribers = $mInviter->getNextInviterEligibleSubscribers($inviterID, $previousEventID);
            }

            if ($npsID == $this->testCampaignId) {
                echo "<br>Check 1";
                pre($oSubscribers);
            }

            //echo "Inviter ID is ". $inviterID;
            //pre($oSubscribers);
            //die;
            $timeNow = time();
            $aEligibleSubscriber = array();
            if (!empty($oSubscribers)) {
                foreach ($oSubscribers as $oSubscriber) {

                    if (empty($previousEventID)) {
                        $addedTime = strtotime($oSubscriber->created);
                    } else {
                        $addedTime = strtotime($oSubscriber->start_at);
                    }
                    $deliverAt = $this->simplifiedTime($delayType, $delayUnit, $delayValue, $addedTime);
                    $endTime = $deliverAt + 1800;
                    if ($npsID == $this->testCampaignId) {
                        echo "<br>Check 2";
                        echo "<br>=====================Subscriber Details";
                        pre($oSubscriber);
                        echo "<br>Added time is " . date("Y-m-d H:i:s", $addedTime);
                        echo "<br>Deliver time is " . date("Y-m-d H:i:s", $deliverAt);
                        echo "<br>End time is " . date("Y-m-d H:i:s", $endTime);
                        echo "<br>Time Now " . date("Y-m-d H:i:s", $timeNow);
                    }
                    if ($deliverAt <= $timeNow && $oSubscriber->status == 1) {
                        $aEligibleSubscriber[] = $oSubscriber;
                    }
                }
            }

            if ($npsID == $this->testCampaignId) {
                echo "<br>Check 3";
                pre($aEligibleSubscriber);
            }

            //pre($aEligibleSubscriber);
            //die;

            if (!empty($aEligibleSubscriber)) {
                $aFireData = array(
                    'inviter_data' => $aEvent,
                    'subscribers' => $aEligibleSubscriber,
                    'account_id' => $accountID,
                    'frequency' => 1
                );

                $this->fireAutomationCampaign($aFireData);
            }
        }
    }

    public function processNPSReminder($aEvent = array()) {
        //Instantiate Nps cron model to access its properties and methods
        $mInviter = new NpsModel();
        
        if (!empty($aEvent)) {
            //pre($aEvent);
            
            $accountID = $aEvent->account_id;
            $inviterID = $aEvent->id;
            $previousEventID = $aEvent->previous_event_id;
            $oParams = json_decode($aEvent->data);
            $delayType = $oParams->delay_type; //after or before
            $delayUnit = $oParams->delay_unit; // minute or hour or day or week or year
            $delayValue = $oParams->delay_value;
            $frequency = $aEvent->reminder_loop;
            //Get all subscriber and then find eligible subscribers only
            $oSubscribers = $mInviter->getReminderSubscribers($inviterID, $previousEventID, $frequency);
            //pre($oSubscribers);
            //echo "Frequency is ". $frequency;
            if ($frequency > 1 && !empty($oSubscribers)) {
                foreach ($oSubscribers as $oSubscriber) {
                    $oLatestSubscriber[$oSubscriber->subscriber_id] = $oSubscriber;
                }
            } else {
                $oLatestSubscriber = $oSubscribers;
            }
            //pre("===================");
            //pre($oLatestSubscriber);
            //die;
//            die;
            $timeNow = time();
            $aEligibleSubscriber = array();
            if (!empty($oLatestSubscriber)) {
                foreach ($oLatestSubscriber as $oSubscriber) {
                    //Check if NPS rating given
                    //$ifActionTaken = $mInviter->checkIfNPSScoreGiven($accountID, $oSubscriber->id);
                    $ifActionTaken = false;
                    if ($ifActionTaken == false) {
                        $reminderTime = strtotime($oSubscriber->start_at);
                        $deliverAt = $this->simplifiedTime($delayType, $delayUnit, $delayValue, $reminderTime);
                        //echo "Next Reminder Date is ". date("Y-m-d H:i:s", $deliverAt);
                        if ($deliverAt <= $timeNow && $oSubscriber->status == 1) {
                            $aEligibleSubscriber[] = $oSubscriber;
                        }
                    }
                }
            }
            //pre($aEligibleSubscriber);

            if (!empty($aEligibleSubscriber)) {
                $aFireData = array(
                    'inviter_data' => $aEvent,
                    'subscribers' => $aEligibleSubscriber,
                    'account_id' => $accountID,
                    'frequency' => $frequency
                );

                $this->fireAutomationCampaign($aFireData);
            }
        }
    }

    public function fireAutomationCampaign($aData = array()) {
        //Instantiate Nps cron model to access its properties and methods
        $mInviter = new NpsModel();
        
        $oEvent = $aData['inviter_data'];
        $npsID = $oEvent->nps_id;
        $inviterID = $oEvent->id;
        $previousEventID = $oEvent->previous_event_id;
        $clientID = $oEvent->client_id;
        $aSubscribers = $aData['subscribers'];
        $accountID = $aData['account_id'];
        $frequence = $aData['frequency'];
        //Get owner information
        $this->client_from_email = '';
        $clientFirstName = $oEvent->client_first_name;
        $clientLastName = $oEvent->client_last_name;
        $clientEmail = $oEvent->client_email;
        $clientPhone = $oEvent->client_phone;
        
        if(!empty($clientEmail)){
            $this->client_from_email = $clientEmail;
        }
        
        
        //echo "Inviter ID is ". $inviterID;
        //echo '<br> -------------------- subscriber data ------------------------- <br>';
        //pre($aData);
        //echo '<br> -------------------- Campaign data ------------------------- <br>';
        $aCampaigns = $mInviter->getAutomationCampaign($inviterID);

        if ($npsID == $this->testCampaignId) {
            echo "<br>Check 4";
            pre($aCampaigns);
        }
        //pre($aCampaigns);
        //die("ok");
        if (!empty($aCampaigns)) {
            foreach ($aCampaigns as $aCampaign) {
                $campaignType = $aCampaign->campaign_type;
                $greeting = $aCampaign->greeting;
                $introduction = $aCampaign->introduction;
                $content = base64_decode($aCampaign->stripo_compiled_html);
                $content = str_replace(array('{{GREETING}}','{GREETING}', '{{INTRODUCTION}}', '{INTRODUCTION}'), array($greeting, $greeting, $introduction, $introduction), $content);
                if ($npsID == $this->testCampaignId) {
                    echo "<br>Check 5";
                    echo "Campaign Type is " . $campaignType;
                }
                if (strtolower($campaignType) == 'email') {
                    $subject = $aCampaign->subject;
                    $fromEmail = $aCampaign->from_email;
                    
                    $defaultFromEmail = (!empty($this->client_from_email)) ? $this->client_from_email : $this->from_email;
                    $fromEmail = empty($fromEmail) ? $defaultFromEmail : $fromEmail;
                    $aEmailData = array(
                        'subject' => $subject,
                        'content' => $content,
                        'from' => $fromEmail,
                        'account_id' => $accountID,
                        'campaign_id' => $aCampaign->id,
                        'nps_id' => $npsID,
                        'inviter_id' => $inviterID,
                        'previous_event_id' => $previousEventID,
                        'client_id' => $clientID,
                        'module_name' => 'nps',
                        'frequence' => $frequence
                    );
                    // Now Send email
                    $this->sendBulkAutomationEmail($aSubscribers, $aEmailData);
                } else if (strtolower($campaignType) == 'sms') {
                    //$content = strip_tags(base64_decode($aCampaign->html));
                    $content = str_replace('<br>', "\n", $content);
                    $content = str_replace('<br/>', "\n", $content);
                    $content = str_replace('<br />', "\n", $content);
                    $content = strip_tags(nl2br($content));
                    $fromNumber = $this->defaultTwilioDetails['from_number'];
                    $aSmsData = array(
                        'from_number' => $fromNumber, //We need this from client twillio phone number
                        'content' => $content,
                        'campaign_id' => $aCampaign->id,
                        'account_id' => $accountID,
                        'nps_id' => $npsID,
                        'inviter_id' => $inviterID,
                        'previous_event_id' => $previousEventID,
                        'client_id' => $clientID,
                        'module_name' => 'nps',
                        'frequency' => $frequence                          
                    );
                    $this->sendBulkAutomationSms($aSubscribers, $aSmsData);
                }
            }
        }
    }

    public function sendBulkAutomationEmail($oSubscribers, $aData) {
        //Instantiate Nps cron model to access its properties and methods
        $mInviter = new NpsModel();
        
        $content = $aData['content'];
        $fromEmail = $aData['from'];
        $subject = $aData['subject'];
        $clientID = $aData['client_id'];
        $accountID = $aData['account_id'];
        $frequence = $aData['frequence'];

        if ($aData['nps_id'] == $this->testCampaignId) {
            echo "<br>Check 6";
            pre($oSubscribers);
            echo "<br>Check 7";
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
                $aTrackSetttings['user_id'] = $oSubscriber->id;
                $aTrackSetttings['campaign_id'] = $aData['campaign_id'];
                $aTrackSetttings['inviter_id'] = $aData['inviter_id'];
                $aTrackSetttings['nps_id'] = $aData['nps_id'];
                $aTrackSetttings['account_id'] = $accountID;
                $aTrackSetttings['email'] = $oSubscriber->email;
                $aTrackSetttings['subscriber_id'] = $oSubscriber->subscriber_id;
                $aTrackSetttings['client_id'] = $clientID;
                $aTrackSetttings['module_name'] = $aData['module_name'];
                //Replace Tags 
                $contentReplaced = $mInviter->emailTagReplace($aData['nps_id'], $accountID, $emailContent, 'email', $oSubscriber);
                $contentReplaced = $mInviter->emailTagReplace($aData['nps_id'], $accountID, $emailContent, 'email', $oSubscriber);
//                    echo "Content is ". $content;
//                    die;
                $msg = '';
                $msg = $this->prepareHtmlContent($contentReplaced, $messageID, $aTrackSetttings);
                //pre($aData);
                //echo $msg;

                $aEmailData = array(
                    'campaign_type' => 'email',
                    'to' => $to,
                    'from_entity' => $fromEmail,
                    'subject' => $subject,
                    'content' => base64_encode($msg),
                    'nps_id' => $aData['nps_id'],
                    'account_id' => $aData['account_id'],
                    'campaign_id' => $aData['campaign_id'],
                    'inviter_id' => $aData['inviter_id'],
                    'preceded_by' => $aData['previous_event_id'],
                    'message_id' => $messageID,
                    'client_id' => $clientID,
                    'module_name' => $aData['module_name'],
                    'moduleName' => 'nps',
                    'moduleUnitId' => $aData['nps_id'],
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
                    $bSkipped = false;
                    if (!empty($frequence) && $frequence > 1) {
                        $iFrequenceCount = $mInviter->countCampaignSentFrequence($aData['campaign_id'], $oSubscriber->id, 'email');
                        if ($iFrequenceCount < $frequence) {
                            $bCampaignAlreadySent = false;
                        } else {
                            $bCampaignAlreadySent = true;
                            $bSkipped = true;
                        }
                    } else {
                        $bCampaignAlreadySent = $mInviter->checkIfCampaignSent($aData['campaign_id'], $oSubscriber->id, 'subs_email', $oSubscriber->email);
                    }
                    
                    if ($aData['nps_id'] == $this->testCampaignId) {
                        echo "<br>Check 8";
                        echo "<br> Already Sent " . $bCampaignAlreadySent;
                    }

                    $bSkipped = false;
                    $bEmailSent = false;
                    if ($bCampaignAlreadySent == true) {
                        $bSkipped = true;
                        $bEmailSent = true;
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
                            'module_name' => 'nps',
                            'module_unit_id' => $aData['nps_id']
                        );
                        //$mInviter->updateUsage($aUsage);
                        updateCreditUsage($aUsage);
                    }
                }
                //}
            }
        }
    }

    public function sendBulkAutomationSms($oSubscribers, $aData) {
        //Instantiate Nps cron model to access its properties and methods
        $mInviter = new NpsModel();
        
        $content = $aData['content'];
        $fromNumber = $aData['from_number'];
        $clientID = $aData['client_id'];
        $accountID = $aData['account_id'];
        $npsID = $aData['nps_id'];
        $frequence = $aData['frequency'];
        //pre($oSubscribers);
        //exit;
        if (!empty($oSubscribers)) {
            foreach ($oSubscribers as $oSubscriber) {
                //pre($oSubscriber);

                $smsContent = $mInviter->emailTagReplace($npsID, $accountID, $content, 'sms', $oSubscriber);

                //$userCurrentUsage = $mInviter->getCurrentUsage($clientID);
                //if ($userCurrentUsage->sms_balance > 0 || $userCurrentUsage->sms_balance_topup > 0) {
                $messageID = $this->generateMessageId();
                $toNumber = $oSubscriber->phone;
                $aSmsData = array(
                    'campaign_type' => 'sms',
                    'to' => $toNumber,
                    'from_entity' => $fromNumber,
                    'content' => $smsContent,
                    'nps_id' => $npsID,
                    'account_id' => $accountID,
                    'campaign_id' => $aData['campaign_id'],
                    'inviter_id' => $aData['inviter_id'],
                    'subscriber_id' => $oSubscriber->subscriber_id,
                    'preceded_by' => $aData['previous_event_id'],
                    'message_id' => $messageID,
                    'sending_server_id' => 0,
                    'client_id' => $clientID,
                    'module_name' => 'nps',
                    'created' => date("Y-m-d H:i:s")
                );

                if ($this->enableQueue == true) {
                    $mInviter->saveInviterQueue($aSmsData);
                } else {
                    //Send SMS now
                    $bSkipped = false;
                    if (!empty($frequence) && $frequence > 1) {
                        $iFrequenceCount = $mInviter->countCampaignSentFrequence($aData['campaign_id'], $oSubscriber->id, 'sms');
                        if ($iFrequenceCount < $frequence) {
                            $bCampaignAlreadySent = false;
                        } else {
                            $bCampaignAlreadySent = true;
                            $bSkipped = true;
                        }
                    } else {
                        $bCampaignAlreadySent = $mInviter->checkIfCampaignSent($aData['campaign_id'], $oSubscriber->id, 'subs_phone', $oSubscriber->phone);
                    }

                    //echo $bCampaignAlreadySent.'Raj';
                    //exit;
                    if ($bCampaignAlreadySent == true) {
                        $bSmsSent = true;
                        $bSkipped = true;
                    } else {
                        //echo "Ready to send ";
                        $bSmsSent = $this->send_Twilio($aSmsData);
                    }

                    if ($bSmsSent == true && $bSkipped == false) {
                        //echo "Yes track now";
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
                        //pre($aLogData);
                        //Update Client Usage
                        $aUsage = array(
                            'client_id' => $clientID,
                            'usage_type' => 'sms',
                            'direction' => 'outbound',
                            'content' => $smsContent,
                            'spend_to' => $toNumber,
                            'spend_from' => $fromNumber,
                            'module_name' => 'nps',
                            'module_unit_id' => $aData['nps_id']
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

    public function saveLog($aData) {
        //Instantiate Nps cron model to access its properties and methods
        $mInviter = new NpsModel();
        
        echo " I a mhere";
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
            echo $insertID = $mInviter->saveTriggerData($aTriggerData); //Trigger table
        }

        //Track Log
        $aTrackData = array(
            'campaign_type' => $aData['type'],
            'message_id' => $aData['message_id'],
            'subscriber_id' => $aData['subscriber_id'],
            'campaign_id' => $aData['campaign_id'],
            'auto_trigger_id' => $insertID,
            'subs_email' => $aData['subs_email'],
            'subs_phone' => $aData['subs_phone'],
            'status' => 'sent',
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
                    $npsID = $aSettingsData['nps_id'];
                    $accountID = $aSettingsData['account_id'];
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
                    if ($npsID > 0) {
                        $additionalParams .= '&npsid=' . $npsID;
                    }
                    if ($accountID > 0) {
                        $additionalParams .= '&accid=' . $accountID;
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
                $trackClickUrl = $this->trackServer . '/nps_track.php?click_redirect=' . $encodeURL . '&msgid=' . $this->base64UrlEncode($msgId) . $additionalParams;

                $newHref = str_replace($url, $trackClickUrl, $href);
                $content = str_replace($href, $newHref, $content);
            }
        }
        return $content;
    }

    public function addOpenTrackingUrl($content, $msgId) {
        $trackOpenUrl = $this->trackServer . '/nps_track.php?open_track=true&msgid=' . $this->base64UrlEncode($msgId);
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
        switch ($delayUnit) {
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
        //Instantiate Nps cron model to access its properties and methods
        $mInviter = new NpsModel();
        
        if ($aData['nps_id'] == $this->testCampaignId) {
            echo "<br>Check 10";
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
                'bb_nps_id' => $aData['nps_id'],
                'bb_account_id' => $aData['account_id'],
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
        
        
        if ($aData['nps_id'] == $this->testCampaignId) {
            echo "<br>Check 11";
            pre($result);
            pre($params);
        }
        if (isset($result['errors'])) {
            return false;
        } else {
            return true;
        }
    }

    public function send_Twilio($aData) {
        //Instantiate Nps cron model to access its properties and methods
        $mInviter = new NpsModel();
        
        //pre($aData);
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

        $npsID = $aData['nps_id'];
        $accountID = $aData['account_id'];
        $campaignID = $aData['campaign_id'];
        $eventID = $aData['inviter_id'];
        $subscriberID = $aData['subscriber_id'];
        $moduleName = $aData['module_name'];

        $qs = '?';

        if (!empty($eventID)) {
            $qs .= '&bb_event_id=' . $eventID;
        }

        if (!empty($npsID)) {
            $qs .= '&bb_nps_id=' . $npsID;
        }

        if (!empty($accountID)) {
            $qs .= '&bb_account_id=' . $accountID;
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

        $aSmsData = array(
            'sid' => $sid,
            'token' => $token,
            'to' => $to,
            'from' => $from,
            'msg' => $msg,
            'smsTrackURL' => $smsTrackURL
        );
        //pre($aSmsData);
        //Send Sms now
        $response = sendClinetSMS($aSmsData);
        //'<br>--------------- response -------------------<br>';
        //pre($response);
        return true;
        if ($response)
            return true;
        else
            return false;
    }
}
