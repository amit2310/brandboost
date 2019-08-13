<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin\Crons\ManagerModel;
use App\Models\Admin\Crons\ReferralModel;
use App\Models\Admin\UsersModel;

class ReferralInviter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inviter:referral';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This cron used to send emails/sms for Referral module';

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
     * 
     */
    public function startCampaign() {
        
        //Instanciate cron manager model to access its properties and methods
        $mCron = new ManagerModel();
        
        //Instanciate Referral cron model to access its properties and methods
        $mInviter = new ReferralModel();

        //Check Cron Lock
        $bLocked = false;
        $oCron = $mCron->checkCronStatus('referral');
        if ($oCron->locked == true) {
            die("Currently cron is locked");
        }

        if ($oCron->locked == false) {
            //Lock Cron
            $bLocked = $mCron->lockCron('referral');
        }

        if ($bLocked == false) {
            die("Currently cron is locked!!");
        }
        $aEvents = $mInviter->getInviterEvents();
        
        if (!empty($aEvents)) {
            foreach ($aEvents as $aEvent) {
                $bActiveSubsription = false;
                $userID = $aEvent->client_id;
                if ($userID > 0) {
                    $bActiveSubsription = UsersModel::isActiveSubscription($userID);
                    if ($bActiveSubsription == true) {

                        $eventType = $aEvent->event_type;
                        $previousEventID = $aEvent->previous_event_id;

                        switch ($eventType) {
                            case "main":
                                $this->processInvite($aEvent);
                                break;
                            case "followup":
                                $this->processInviteReminder($aEvent);
                                break;

                            /* case "invite-email":
                              $this->processInvite($aEvent);
                              break;
                              case "invite-sms":
                              $this->processInvite($aEvent);
                              break;
                              case "invite-email-reminder":
                              $this->processInviteReminder($aEvent);
                              break;
                              case "invite-sms-reminder":
                              $this->processInviteReminder($aEvent);
                              break; */
                            case "sale-email":
                                //$this->processSale($aEvent);
                                break;
                            case "sale-sms":
                                //$this->processSale($aEvent);
                                break;
                            case "sale-email-reminder":
                                //$this->processSaleReminder($aEvent);
                                break;
                            case "sale-sms-reminder":
                                //$this->processSaleReminder($aEvent);
                                break;
                        }
                    }
                }
            }
        }
        //Release Cron
        $mCron->releaseCron('referral');
        print("Script Ended");
    }

    
    /**
     * 
     * @param type $aEvent
     */
    public function processInvite($aEvent = array()) {
        //Instanciate Referral cron model to access its properties and methods
        $mInviter = new ReferralModel();

        if (!empty($aEvent)) {
            //pre($aEvent);

            $referralID = $aEvent->referral_id;
            $accountID = $aEvent->account_id;
            $inviterID = $aEvent->id;
            $previousEventID = $aEvent->previous_event_id;
            $oParams = json_decode($aEvent->data);
            $delayType = $oParams->delay_type; //after or before
            $delayUnit = $oParams->delay_unit; // minute or hour or day or week or year
            $delayValue = $oParams->delay_value;
            
            //Get all subscriber and then find eligible subscribers only
            if (empty($previousEventID)) {
                $oSubscribers = $mInviter->getInviterEligibleSubscribers($inviterID, $accountID);
            } else {
                $oSubscribers = $mInviter->getNextInviterEligibleSubscribers($inviterID, $previousEventID);
            }
            
            if ($referralID == $this->testCampaignId) {
                echo "<br>Check 1";
                pre($oSubscribers);
            }

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
                    if ($referralID == $this->testCampaignId) {
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
            
            
            if ($referralID == $this->testCampaignId) {
                echo "<br>Check 3";
                pre($aEligibleSubscriber);
            }

            if (!empty($aEligibleSubscriber)) {
                $aFireData = array(
                    'inviter_data' => $aEvent,
                    'subscribers' => $aEligibleSubscriber,
                    'account_id' => $accountID
                );

                $this->fireAutomationCampaign($aFireData);
            }
        }
    }

    
    /**
     * 
     * @param type $aEvent
     */
    public function processInviteReminder($aEvent = array()) {
        //Instanciate Referral cron model to access its properties and methods
        $mInviter = new ReferralModel();
        
        if (!empty($aEvent)) {
            $accountID = $aEvent->account_id;
            $inviterID = $aEvent->id;
            $previousEventID = $aEvent->previous_event_id;
            $oParams = json_decode($aEvent->data);
            $delayType = $oParams->delay_type; //after or before
            $delayUnit = $oParams->delay_unit; // minute or hour or day or week or year
            $delayValue = $oParams->delay_value;
            $frequency = $aEvent->reminder_loop;
            //Get all subscriber and then find eligible subscribers only
            $oSubscribers = $mInviter->getInviteReminderSubscribers($inviterID, $previousEventID, $frequency);
            
            if ($frequency > 1 && !empty($oSubscribers)) {
                foreach ($oSubscribers as $oSubscriber) {
                    $oLatestSubscriber[$oSubscriber->subscriber_id] = $oSubscriber;
                }
            } else {
                $oLatestSubscriber = $oSubscribers;
            }
            
            $timeNow = time();
            $aEligibleSubscriber = array();
            if (!empty($oLatestSubscriber)) {
                foreach ($oLatestSubscriber as $oSubscriber) {
                    $reminderTime = strtotime($oSubscriber->start_at);
                    $deliverAt = $this->simplifiedTime($delayType, $delayUnit, $delayValue, $reminderTime);
                    $endTime = $deliverAt + 1800;
                    if ($deliverAt <= $timeNow && $timeNow <= $endTime && $oSubscriber->status == 1) {
                        $aEligibleSubscriber[] = $oSubscriber;
                    }
                }
            }
            
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
    
    
    /**
     * 
     * @param type $aEvent
     */
    public function processSale($aEvent = array()) {
        //Instanciate Referral cron model to access its properties and methods
        $mInviter = new ReferralModel();
        
        if (!empty($aEvent)) {

            $accountID = $aEvent->account_id;
            $inviterID = $aEvent->id;
            $previousEventID = $aEvent->previous_event_id;
            $oParams = json_decode($aEvent->data);
            $delayType = $oParams->delay_type; //after or before
            $delayUnit = $oParams->delay_unit; // minute or hour or day or week or year
            $delayValue = $oParams->delay_value;
            //Get all subscriber and then find eligible subscribers only

            if (empty($previousEventID)) {
                $oLatestSales = $mInviter->getLatestSales($accountID);

                if (!empty($oLatestSales)) {
                    foreach ($oLatestSales as $oSales) {
                        $aSaleIDs[] = $oSales->id;
                        $aUsersIDs[] = $oSales->advocate_id;
                    }
                }

                $oSubscribers = $mInviter->getSalesSubscribers($accountID, $inviterID, $aUsersIDs, $aSaleIDs, $oLatestSales);
            }

            if ($previousEventID > 0) {
                $oSubscribers = $mInviter->getNextSalesSubscribers($inviterID, $previousEventID);
            }

            $timeNow = time();
            $aEligibleSubscriber = array();
            if (!empty($oSubscribers)) {
                foreach ($oSubscribers as $oSubscriber) {

                    if ($previousEventID > 0) {
                        $saleTime = strtotime($oSubscriber->start_at);
                    } else {
                        $saleTime = strtotime($oSubscriber->created); //sale date  
                    }
                    $deliverAt = $this->simplifiedTime($delayType, $delayUnit, $delayValue, $saleTime);
                    if ($deliverAt <= $timeNow && $oSubscriber->status == 1) {
                        $aEligibleSubscriber[] = $oSubscriber;
                    }
                }
            }

            if (!empty($aEligibleSubscriber)) {
                $aFireData = array(
                    'inviter_data' => $aEvent,
                    'subscribers' => $aEligibleSubscriber,
                    'account_id' => $accountID
                );

                $this->fireAutomationCampaign($aFireData);
            }
        }
    }

    
    /**
     * 
     */
    public function processSaleReminder($aEvent = array()) {
        //Instanciate Referral cron model to access its properties and methods
        $mInviter = new ReferralModel();
        
        if (!empty($aEvent)) {
            $accountID = $aEvent->account_id;
            $inviterID = $aEvent->id;
            $previousEventID = $aEvent->previous_event_id;
            $oParams = json_decode($aEvent->data);
            $delayType = $oParams->delay_type; //after or before
            $delayUnit = $oParams->delay_unit; // minute or hour or day or week or year
            $delayValue = $oParams->delay_value;
            //Get all subscriber and then find eligible subscribers only
            $oSubscribers = $mInviter->getReminderSales($accountID, $inviterID, $previousEventID);
            
            $timeNow = time();
            $aEligibleSubscriber = array();
            if (!empty($oSubscribers)) {
                foreach ($oSubscribers as $oSubscriber) {
                    $reminderTime = strtotime($oSubscriber->start_at); //sale date
                    $deliverAt = $this->simplifiedTime($delayType, $delayUnit, $delayValue, $reminderTime);
                    if ($deliverAt <= $timeNow && $oSubscriber->status == 1) {
                        $aEligibleSubscriber[] = $oSubscriber;
                    }
                }
            }
            
            if (!empty($aEligibleSubscriber)) {
                $aFireData = array(
                    'inviter_data' => $aEvent,
                    'subscribers' => $aEligibleSubscriber,
                    'account_id' => $accountID
                );

                $this->fireAutomationCampaign($aFireData);
            }
        }
    }

    
    /**
     * 
     */
    public function fireAutomationCampaign($aData = array()) {
        //Instanciate Referral cron model to access its properties and methods
        $mInviter = new ReferralModel();
        
        $oEvent = $aData['inviter_data'];
        $referralID = $oEvent->referral_id;
        $inviterID = $oEvent->id;
        $previousEventID = $oEvent->previous_event_id;
        $clientID = $oEvent->client_id;
        $aSubscribers = $aData['subscribers'];
        $accountID = $aData['account_id'];
        $frequence = isset($aData['frequency']) ? $aData['frequency'] : 1;
        
        //Get owner information
        $this->client_from_email = '';        
        $clientEmail = $oEvent->client_email;
        
        
        if(!empty($clientEmail)){
            $this->client_from_email = $clientEmail;
        }
        
        $aCampaigns = $mInviter->getAutomationCampaign($inviterID);
        if ($referralID == $this->testCampaignId) {
            echo "<br>Check 4";
            pre($aCampaigns);
        }
        if (!empty($aCampaigns)) {
            foreach ($aCampaigns as $aCampaign) {
                $campaignType = $aCampaign->campaign_type;
                $greeting = $aCampaign->greeting;
                $introduction = $aCampaign->introduction;
                $content = base64_decode($aCampaign->stripo_compiled_html);
                $content = str_replace(array('{GREETING}', '{INTRODUCTION}'), array($greeting, $introduction), $content);
                if ($referralID == $this->testCampaignId) {
                    echo "<br>Check 5";
                    echo "Campaign Type is " . $campaignType;
                }
                if (strtolower($campaignType) == 'email') {
                    $subject = $aCampaign->subject;
                    $fromEmail = isset($aCampaign->from_email) ? $aCampaign->from_email : '';
                    $defaultFromEmail = (!empty($this->client_from_email)) ? $this->client_from_email : $this->from_email;
                    $fromEmail = empty($fromEmail) ? $defaultFromEmail : $fromEmail;
                    $aEmailData = array(
                        'subject' => $subject,
                        'content' => $content,
                        'from' => $fromEmail,
                        'referral_id' => $referralID,
                        'account_id' => $accountID,
                        'campaign_id' => $aCampaign->id,
                        'inviter_id' => $inviterID,
                        'previous_event_id' => $previousEventID,
                        'client_id' => $clientID,
                        'module_name' => 'referral',
                        'frequence' => $frequence
                    );
                    // Now Send email
                    $this->sendBulkAutomationEmail($aSubscribers, $aEmailData);
                } else if (strtolower($campaignType) == 'sms') {
                    $content = str_replace('<br/>', "\n", $content);
                    $content = str_replace('<br />', "\n", $content);
                    $content = strip_tags(nl2br($content));
                    $fromNumber = $this->defaultTwilioDetails['from_number'];
                    $aSmsData = array(
                        'from_number' => $fromNumber, //We need this from client twillio phone number
                        'content' => $content,
                        'campaign_id' => $aCampaign->id,
                        'account_id' => $accountID,
                        'referral_id' => $referralID,
                        'inviter_id' => $inviterID,
                        'previous_event_id' => $previousEventID,
                        'client_id' => $clientID,
                        'module_name' => 'referral',
                        'frequence' => $frequence
                    );
                    $this->sendBulkAutomationSms($aSubscribers, $aSmsData);
                }
            }
        }
    }

    
    /**
     * 
     */
    public function sendBulkAutomationEmail($oSubscribers, $aData) {
        //Instanciate Referral cron model to access its properties and methods
        $mInviter = new ReferralModel();
        
        $content = $aData['content'];
        $fromEmail = $aData['from'];
        $subject = $aData['subject'];
        $clientID = $aData['client_id'];
        $accountID = $aData['account_id'];
        $referralID = $aData['referral_id'];
        $frequence = $aData['frequence'];
        if ($aData['referral_id'] == $this->testCampaignId) {
            echo "<br>Check 6";
            pre($oSubscribers);
            echo "<br>Check 7";
            pre($aData);
        }
        if (!empty($oSubscribers)) {
            foreach ($oSubscribers as $oSubscriber) {
                
                $emailContent = $content;
                $messageID = $this->generateMessageId();
                $to = $oSubscriber->email;
                $aTrackSetttings = array();
                $aTrackSetttings['user_id'] = $oSubscriber->advocateID;
                $aTrackSetttings['campaign_id'] = $aData['campaign_id'];
                $aTrackSetttings['inviter_id'] = $aData['inviter_id'];
                $aTrackSetttings['referral_id'] = $referralID;
                $aTrackSetttings['account_id'] = $accountID;
                $aTrackSetttings['email'] = $oSubscriber->email;
                $aTrackSetttings['subscriber_id'] = $oSubscriber->advocateID;
                $aTrackSetttings['client_id'] = $clientID;
                $aTrackSetttings['module_name'] = $aData['module_name'];
                //Replace Tags 
                $contentReplaced = $mInviter->emailTagReplace($referralID, $accountID, $emailContent, 'email', $oSubscriber);

                $msg = $this->prepareHtmlContent($contentReplaced, $messageID, $aTrackSetttings);
                
                $aEmailData = array(
                    'campaign_type' => 'email',
                    'to' => $to,
                    'from_entity' => $fromEmail,
                    'subject' => $subject,
                    'content' => base64_encode($msg),
                    'referral_id' => $referralID,
                    'account_id' => $aData['account_id'],
                    'campaign_id' => $aData['campaign_id'],
                    'inviter_id' => $aData['inviter_id'],
                    'preceded_by' => $aData['previous_event_id'],
                    'message_id' => $messageID,
                    'client_id' => $clientID,
                    'module_name' => $aData['module_name'],
                    'moduleName' => 'referral',
                    'moduleUnitId' => $aData['account_id'],
                    'subscriber_id' => $oSubscriber->subscriber_id,
                    'globalSubscriberId' => $oSubscriber->subscriber_id,
                    'created' => date("Y-m-d H:i:s")
                );
                if ($this->enableQueue == true) {
                    //Add email in the queue
                    $mInviter->saveInviterQueue($aEmailData);
                } else {
                    //Send email now
                    //Okay final check if campaign sent to the subscriber or not
                     $bSkipped = false;
                    if (!empty($frequence) && $frequence > 1) {
                        $iFrequenceCount = $mInviter->countCampaignSentFrequence($aData['campaign_id'], $oSubscriber->advocateID, $oSubscriber->saleID, 'email');
                        if ($iFrequenceCount < $frequence) {
                            $bCampaignAlreadySent = false;
                        } else {
                            $bCampaignAlreadySent = true;
                             $bSkipped = true;
                        }
                    } else {
                        $bCampaignAlreadySent = @($mInviter->checkIfCampaignSent($aData['campaign_id'], $oSubscriber->advocateID, $oSubscriber->saleID, 'subs_email', $oSubscriber->email));
                    }
                    
                    if ($aData['referral_id'] == $this->testCampaignId) {
                        echo "<br>Check 8";
                        echo "<br> Already Sent " . $bCampaignAlreadySent;
                    }

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
                            'subscriber_id' => $oSubscriber->advocateID,
                            'preceded_by' => $aData['previous_event_id'],
                            'message_id' => $messageID,
                            'campaign_id' => $aData['campaign_id'],
                            'sale_id' => isset($oSubscriber->saleID) ? $oSubscriber->saleID : '',
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
                            'module_name' => 'referral',
                            'module_unit_id' => $aData['referral_id']
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
     * 
     */
    public function sendBulkAutomationSms($oSubscribers, $aData) {
        //Instanciate Referral cron model to access its properties and methods
        $mInviter = new ReferralModel();
        
        //pre($aData);
        $content = $aData['content'];
        $fromNumber = $aData['from_number'];
        $clientID = $aData['client_id'];
        $accountID = $aData['account_id'];
        $referralID = $aData['referral_id'];
        $frequence = $aData['frequence'];
        
        if (!empty($oSubscribers)) {
            foreach ($oSubscribers as $oSubscriber) {
                $smsContent = $mInviter->emailTagReplace($referralID, $accountID, $content, 'sms', $oSubscriber);
                //$userCurrentUsage = $mInviter->getCurrentUsage($clientID);
                //if ($userCurrentUsage->sms_balance > 0 || $userCurrentUsage->sms_balance_topup > 0) {
                $messageID = $this->generateMessageId();
                $toNumber = $oSubscriber->phone;
                $aSmsData = array(
                    'campaign_type' => 'sms',
                    'to' => $toNumber,
                    'from_entity' => $fromNumber,
                    'content' => $smsContent,
                    'referral_id' => $referralID,
                    'account_id' => $accountID,
                    'campaign_id' => $aData['campaign_id'],
                    'inviter_id' => $aData['inviter_id'],
                    'subscriber_id' => $oSubscriber->advocateID,
                    'preceded_by' => $aData['previous_event_id'],
                    'message_id' => $messageID,
                    'sending_server_id' => 0,
                    'client_id' => $clientID,
                    'module_name' => 'referral',
                    'created' => date("Y-m-d H:i:s")
                );

                if ($this->enableQueue == true) {
                    $mInviter->saveInviterQueue($aSmsData);
                } else {
                    //Send SMS now
                    $bSkipped = false;
                    if (!empty($frequence) && $frequence > 1) {
                        $iFrequenceCount = $mInviter->countCampaignSentFrequence($aData['campaign_id'], $oSubscriber->advocateID, $oSubscriber->saleID, 'sms');
                        if ($iFrequenceCount < $frequence) {
                            $bCampaignAlreadySent = false;
                        } else {
                            $bCampaignAlreadySent = true;
                            $bSkipped = true;
                        }
                    } else {
                        $bCampaignAlreadySent = @($mInviter->checkIfCampaignSent($aData['campaign_id'], $oSubscriber->advocateID, $oSubscriber->saleID, 'subs_phone', $oSubscriber->phone));
                    }


                    
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
                            'subscriber_id' => $oSubscriber->advocateID,
                            'preceded_by' => $aData['previous_event_id'],
                            'message_id' => $messageID,
                            'campaign_id' => $aData['campaign_id'],
                            'type' => 'sms',
                            'subs_email' => $oSubscriber->email,
                            'subs_phone' => $oSubscriber->phone
                        );
                        $this->saveLog($aLogData);
                        $aUsage = array(
                            'client_id' => $clientID,
                            'usage_type' => 'sms',
                            'direction' => 'outbound',
                            'content' => $smsContent,
                            'spend_to' => $toNumber,
                            'spend_from' => $fromNumber,
                            'module_name' => 'referral',
                            'module_unit_id' => $aData['referral_id']
                        );
                        $charCount = strlen($smsContent);
                        $totatMessageCount = ceil($charCount / 160);
                        if ($totatMessageCount > 1) {
                            for ($i = 0; $i < $totatMessageCount; $i++) {
                                $aUsage['segment'] = $i+1;
                                updateCreditUsage($aUsage);
                            }
                        } else {
                            $aUsage['segment'] = 1;
                            updateCreditUsage($aUsage);
                        }
                    }
                }
                // }
            }
        }
    }

    
    /**
     * 
     */
    public function saveLog($aData) {
        //Instanciate Referral cron model to access its properties and methods
        $mInviter = new ReferralModel();
        

        $timeNow = date("Y-m-d H:i:s");
        $insertID = 0;
        if (!empty($aData)) {
            $aTriggerData = array(
                'auto_event_id' => $aData['inviter_id'],
                'subscriber_id' => $aData['subscriber_id'],
                'preceded_by' => $aData['preceded_by'],
                'sale_id' => isset($aData['sale_id']) ? $aData['sale_id'] : '',
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
            'sale_id' => isset($aData['sale_id']) ? $aData['sale_id'] : '',
            'auto_trigger_id' => $insertID,
            'subs_email' => $aData['subs_email'],
            'subs_phone' => $aData['subs_phone'],
            'status' => 'sent',
            'created_at' => date("Y-m-d H:i:s"),
        );
        $mInviter->saveSendingLog($aTrackData);
    }

    
    /**
     * 
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
     * 
     * @param type $content
     * @param type $msgId
     * @param type $aSettingsData
     * @return type
     */
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
                    $referralID = $aSettingsData['referral_id'];
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
                    if ($referralID > 0) {
                        $additionalParams .= '&refid=' . $referralID;
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
                $trackClickUrl = $this->trackServer . '/referral_track.php?click_redirect=' . $encodeURL . '&msgid=' . $this->base64UrlEncode($msgId) . $additionalParams;

                $newHref = str_replace($url, $trackClickUrl, $href);
                $content = str_replace($href, $newHref, $content);
            }
        }
        return $content;
    }

    
    /**
     * 
     * @param type $content
     * @param type $msgId
     * @return type
     */
    public function addOpenTrackingUrl($content, $msgId) {
        $trackOpenUrl = $this->trackServer . '/referral_track.php?open_track=true&msgid=' . $this->base64UrlEncode($msgId);
        return $content . '<img src="' . $trackOpenUrl . '" width="0" height="0" alt="" style="visibility:hidden" />';
    }

    
    /**
     * 
     * @return type
     */
    public function generateMessageId() {
        return time() . rand(100000, 999999) . '.' . uniqid();
    }

    
    /**
     * 
     * @param type $val
     * @return type
     */
    public function base64UrlEncode($val) {
        return strtr(base64_encode($val), '+/=', '-_,');
    }

    
    /**
     * 
     * @param type $val
     * @return type
     */
    public function base64UrlDecode($val) {
        return base64_decode(strtr($val, '-_,', '+/='));
    }

    
    /**
     * 
     * @param type $delayType
     * @param type $delayUnit
     * @param type $delayValue
     * @param type $sourceTime
     * @return int
     */
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

    
    /**
     * 
     * @param type $aData
     * @return boolean
     */
    public function SG_smtp($aData) {
        //Instanciate Referral cron model to access its properties and methods
        $mInviter = new ReferralModel();
        
        if ($aData['referral_id'] == $this->testCampaignId) {
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
                'bb_referral_id' => $aData['referral_id'],
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
        
        if ($aData['referral_id'] == $this->testCampaignId) {
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

    
    /**
     * 
     * @param type $aData
     * @return boolean
     */
    public function send_Twilio($aData) {
        //Instanciate Referral cron model to access its properties and methods
        $mInviter = new ReferralModel();
        
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

        $referralID = $aData['referral_id'];
        $accountID = $aData['account_id'];
        $campaignID = $aData['campaign_id'];
        $eventID = $aData['inviter_id'];
        $subscriberID = $aData['subscriber_id'];
        $moduleName = $aData['module_name'];

        $qs = '?';

        if (!empty($referralID)) {
            $qs .= '&bb_referral_id=' . $referralID;
        }

        if (!empty($accountID)) {
            $qs .= '&bb_account_id=' . $accountID;
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

        $aSmsData = array(
            'sid' => $sid,
            'token' => $token,
            'to' => $to,
            'from' => $from,
            'msg' => $msg,
            'smsTrackURL' => $smsTrackURL
        );
        //pre($aSmsData);
        //die;
        //Send Sms now
        $response = sendClinetSMS($aSmsData);
        //'<br>--------------- response -------------------<br>';
        //pre($response);
        return true;

    } 
    
}
