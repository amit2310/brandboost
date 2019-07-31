<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin\Crons\ManagerModel;
use App\Models\Admin\Crons\EmailModel;
use App\Models\Admin\UsersModel;

class BroadcastInviter extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inviter:broadcast';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This cron used to send emails/sms for broadcast module';

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
        $this->testCampaignId = '192';
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $this->startCampaign();
    }

    public function startCampaign() {

        //Check Cron Lock
        $bLocked = false;
        
        //Instanciate cron manager model to access its properties and methods
        $mCron = new ManagerModel();
        
        //Instanciate Email Model to access its properties and methods
        $mInviter = new EmailModel();
        
        $oCron = $mCron->checkCronStatus('broadcast');

        if ($oCron->locked == true) {
            die("Currently cron is locked");
        }

        if ($oCron->locked == false) {
            //Lock Cron
            $bLocked = $mCron->lockCron('broadcast');
        }

        if ($bLocked == false) {
            die("Currently cron is locked!!");
        }

        $aEvents = $this->mInviter->getInviterEvents();
        //pre($aEvents);
        //die;

        if (!empty($aEvents)) {
            foreach ($aEvents as $aEvent) {
                $bActiveSubsription = false;
                $automationID = $aEvent->automation_id;
                $userID = $aEvent->client_id;
                if ($userID > 0) {
                    $bActiveSubsription = $this->mUser->isActiveSubscription($userID);
                    if ($bActiveSubsription == true) {
                        //echo $automationID.'<br>';
                        /* if($automationID != '35') {
                          continue;
                          } */

                        $inviterID = $aEvent->id;
                        $eventType = $aEvent->event_type;
                        $previousEventID = $aEvent->previous_event_id;

                        if ($eventType == 'broadcast') {
                            $this->processSpecificDateTime($aEvent);
                        }
                    }
                }
            }
        }

        //Release Cron
        $mCron->releaseCron('broadcast');
        echo "<br>=========================<br>";
        print("Script Ended");
    }

    public function processSpecificDateTime($aEvent = array()) {

        if (!empty($aEvent)) {
            $automationID = $aEvent->automation_id;
            $inviterID = $aEvent->id;
            $oParams = json_decode($aEvent->data);
            $deliveryDate = $oParams->delivery_date;
            $deliveryTime = $oParams->delivery_time;
            $timeString = $deliveryDate . ' ' . $deliveryTime;  //08/31/2017 1:05 AM
            $deliverAt = strtotime($timeString);

            $gmt_date = strtotime(gmdate('Y-m-d H:i:s', time()));
            $estTime = date("Y-m-d H:i:s", ($gmt_date - 14400));
            //$timeNow = strtotime(date("h:i A"));
            $timeNow = strtotime($estTime);

            $endTime = $deliverAt + 1800;  //Valid for next 30 minutes after the delivery date


            if ($this->testing == true) {
                $deliverAt = $timeNow;
                $endTime = $timeNow;
            }

            if ($automationID == $this->testCampaignId) {
                echo "Deliver Date " . date("Y-m-d H:i:s", $deliverAt);
                echo "<br> Time Now " . date("Y-m-d H:i:s", $timeNow);
            }

            if ($timeNow >= $deliverAt && $timeNow <= $endTime) {
                //if (1) {

                $oSubscribers = $this->mInviter->getInviterEligibleSubscribers($automationID);


                $aProcessedSubscribers = $this->mInviter->getTriggeredSubscribers($inviterID);

                if ($automationID == $this->testCampaignId) {
                    echo "I am in";
                    pre($oSubscribers);
                    pre($aProcessedSubscribers);
                }

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
                if ($automationID == $this->testCampaignId) {
                    pre($aEligibleSubscriber);
                }
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

    public function fireAutomationCampaign($aData = array()) {
        $oEvent = $aData['inviter_data'];
        $broadcastID = $oEvent->automation_id;
        $inviterID = $oEvent->id;
        $eventType = $oEvent->event_type;
        $previousEventID = $oEvent->previous_event_id;
        $clientID = $oEvent->client_id;
        $aSubscribers = $aData['subscribers'];

        //Get owner information
        $this->client_from_email = '';
        $clientFirstName = $oEvent->client_first_name;
        $clientLastName = $oEvent->client_last_name;
        $clientEmail = $oEvent->client_email;
        $clientPhone = $oEvent->client_phone;

        if (!empty($clientEmail)) {
            $this->client_from_email = $clientEmail;
        }

        if ($broadcastID == $this->testCampaignId) {
            echo "Yes, I am here too";
        }
        if ($broadcastID > 0) {
            //get More info about broadcast campaign
            $oBroadcast = $this->mInviter->getBroadcast($broadcastID);
            if (!empty($oBroadcast)) {
                $sendingMethod = $oBroadcast->sending_method;
                $broadcastStatus = $oBroadcast->status;
                $isSplit = ($sendingMethod == 'split') ? true : false;
                if ($broadcastID == $this->testCampaignId) {
                    echo "Broadcast Status is " . $broadcastStatus;
                    echo "Is Split" . $isSplit;
                }
                if ($broadcastStatus == 'active') {
                    if ($isSplit == true) {
                        //echo "In Split";
                        $aCampaigns = $this->mInviter->getBroadcastSplitCampaign($inviterID);
                    } else {
                        //echo "In Normal";
                        $aCampaigns = $this->mInviter->getBroadcastCampaign($inviterID);
                    }


                    if ($broadcastID == $this->testCampaignId) {
                        pre($aCampaigns);
                    }



                    if (!empty($aCampaigns) && $isSplit == false) {
                        //Normal Sending
                        //die("Normal Sending");
                        $this->sendNormalCampaigns($aData, $aCampaigns);
                    }

                    if (!empty($aCampaigns) && $isSplit == true) {
                        //Split Sending
                        //die("Split Sending");
                        $this->sendSplitCampaigns($aData, $aCampaigns);
                    }
                }
            }
        }
    }

    public function sendNormalCampaigns($aData = array(), $aCampaigns) {
        $oEvent = $aData['inviter_data'];
        $broadcastID = $oEvent->automation_id;
        $inviterID = $oEvent->id;
        $eventType = $oEvent->event_type;
        $previousEventID = $oEvent->previous_event_id;
        $clientID = $oEvent->client_id;
        $aSubscribers = $aData['subscribers'];
        //pre($aCampaigns);
        //Get owner information
        $this->client_from_email = '';
        $clientFirstName = $oEvent->client_first_name;
        $clientLastName = $oEvent->client_last_name;
        $clientEmail = $oEvent->client_email;
        $clientPhone = $oEvent->client_phone;

        if (!empty($clientEmail)) {
            $this->client_from_email = $clientEmail;
        }
        if (!empty($aCampaigns)) {
            foreach ($aCampaigns as $aCampaign) {
                $campaignType = strtolower($aCampaign->campaign_type);
                if ($campaignType == 'email') {
                    $subject = $aCampaign->subject;
                    $preheader = $aCampaign->preheader;
                    $content = base64_decode($aCampaign->stripo_compiled_html);
                    $fromEmail = $aCampaign->from_email;
                    $defaultFromEmail = (!empty($this->client_from_email)) ? $this->client_from_email : $this->from_email;
                    $fromEmail = empty($fromEmail) ? $defaultFromEmail : $fromEmail;
                    $fromName = $aCampaign->from_name;
                    $replyEmail = $aCampaign->reply_to;
                    $aEmailData = array(
                        'subject' => $subject,
                        'preheader' => $preheader,
                        'content' => $content,
                        'from' => $fromEmail,
                        'campaign_id' => $aCampaign->id,
                        'broadcast_id' => $broadcastID,
                        'inviter_id' => $inviterID,
                        'previous_event_id' => $previousEventID,
                        'client_id' => $clientID,
                        'fromName' => $fromName,
                        'replyEmail' => $replyEmail,
                        'module_name' => 'email_broadcast'
                    );

                    if ($broadcastID == $this->testCampaignId) {
                        pre($aEmailData);
                    }
                    // Now Send email
                    $this->sendBulkBroadcastEmail($aSubscribers, $aEmailData);
                } else if ($campaignType == 'sms') {
                    $content = str_replace('<br>', "\n", base64_decode($aCampaign->stripo_compiled_html));
                    $content = str_replace('<br/>', "\n", $content);
                    $content = str_replace('<br />', "\n", $content);
                    $content = strip_tags(nl2br($content));
                    $aSmsData = array(
                        'from_number' => $fromNumber, //We need this from client twillio phone number
                        'content' => $content,
                        'campaign_id' => $aCampaign->id,
                        'broadcast_id' => $broadcastID,
                        'inviter_id' => $inviterID,
                        'previous_event_id' => $previousEventID,
                        'client_id' => $clientID,
                        'module_name' => 'sms_broadcast'
                    );

                    $this->sendBulkBroadcastSms($aSubscribers, $aSmsData);
                }
            }
        }
    }

    public function sendSplitCampaigns($aData = array(), $aCampaigns) {
        $oEvent = $aData['inviter_data'];
        $broadcastID = $oEvent->automation_id;
        $inviterID = $oEvent->id;
        $eventType = $oEvent->event_type;
        $previousEventID = $oEvent->previous_event_id;
        $clientID = $oEvent->client_id;
        $aSubscribers = $aData['subscribers'];
        $totalSubscribers = count($aSubscribers);
        //Get owner information
        $this->client_from_email = '';
        $clientFirstName = $oEvent->client_first_name;
        $clientLastName = $oEvent->client_last_name;
        $clientEmail = $oEvent->client_email;
        $clientPhone = $oEvent->client_phone;

        if (!empty($clientEmail)) {
            $this->client_from_email = $clientEmail;
        }
        //pre($aCampaigns);
        if (!empty($aCampaigns)) {
            $totalLoad = 0;
            foreach ($aCampaigns as $aCampaign) {
                $campaignType = strtolower($aCampaign->campaign_type);
                $iLoad = $aCampaign->split_load;
                $distributedSubscribers = 0;

                if ($iLoad > 0) {
                    $totalLoad = $totalLoad + $iLoad;
                    $distributedSubscribers = ceil(($totalSubscribers * $iLoad) / 100);

                    $aFinalCampaigns[$aCampaign->id] = array(
                        'campaign_id' => $aCampaign->id,
                        'load' => $iLoad,
                        'campaignData' => $aCampaign,
                        'variationSubscribersCount' => $distributedSubscribers
                    );
                }
            }

            //pre($aFinalCampaigns);
            //die;
            //Start process now

            if (!empty($aSubscribers)) {
                $aCampaignIDs = array_keys($aFinalCampaigns);
                //pre($aCampaignIDs);
                //pre($aSubscribers);
                $campaignIndex = 0;
                $lastCampaignID = end($aCampaignIDs);
                foreach ($aSubscribers as $oSubscriber) {
                    //echo "<br>Yes I am going to process a Subscriber with {$oSubscriber->email}";
                    $aSplitData = $this->getNextSplitCampaign($aFinalCampaigns, $aCampaignIDs, $campaignIndex, $aProcessedSubscribersCount);
                    //pre($aSplitData);
                    //die;
                    if (!empty($aSplitData)) {
                        //echo "I am in split Data array";
                        $oSelectedCampaign = $aSplitData['oSelectedCampaign'];
                        //pre($oSelectedCampaign);
                        $campIndex = $aSplitData['campaignIndex'];
                        $camptotalProcessed = $aSplitData['totalProcessed'];
                        $currentCampaignID = $aSplitData['currentCampaignID'];
                        $campaignType = strtolower($oSelectedCampaign->campaign_type);
                        //echo "Campaign Type is ". $campaignType;
                        //Send Now
                        if ($campaignType == 'email') {
                            $subject = $oSelectedCampaign->subject;
                            $preheader = $oSelectedCampaign->preheader;
                            $content = base64_decode($oSelectedCampaign->stripo_compiled_html);
                            $fromEmail = $oSelectedCampaign->from_email;
                            $fromName = $oSelectedCampaign->from_name;
                            $replyEmail = $oSelectedCampaign->reply_to;

                            $defaultFromEmail = (!empty($this->client_from_email)) ? $this->client_from_email : $this->from_email;
                            $fromEmail = empty($fromEmail) ? $defaultFromEmail : $fromEmail;
                            $aEmailData = array(
                                'subject' => $subject,
                                'preheader' => $preheader,
                                'content' => $content,
                                'from' => $fromEmail,
                                'campaign_id' => $oSelectedCampaign->id,
                                'broadcast_id' => $broadcastID,
                                'inviter_id' => $inviterID,
                                'previous_event_id' => $previousEventID,
                                'client_id' => $clientID,
                                'fromName' => $fromName,
                                'replyEmail' => $replyEmail,
                                'module_name' => 'email_broadcast',
                                'sending_method' => 'split'
                            );
                            /* echo "Ready to send Email";
                              echo "Campaign ID is ".$oSelectedCampaign->id;
                              echo " Subject is :".$subject; */

                            $this->sendBroadcastEmail($oSubscriber, $aEmailData);
                            /* echo "<br>";
                              echo "Send to : " . $oSubscriber->email . " and campaign id = {$oSelectedCampaign->id}"; */
                        } else if ($campaignType == 'sms') {
                            $content = str_replace('<br>', "\n", base64_decode($oSelectedCampaign->stripo_compiled_html));
                            $content = str_replace('<br/>', "\n", $content);
                            $content = str_replace('<br />', "\n", $content);
                            $content = strip_tags(nl2br($content));
                            $aSmsData = array(
                                'from_number' => $fromNumber, //We need this from client twillio phone number
                                'content' => $content,
                                'campaign_id' => $oSelectedCampaign->id,
                                'broadcast_id' => $broadcastID,
                                'inviter_id' => $inviterID,
                                'previous_event_id' => $previousEventID,
                                'client_id' => $clientID,
                                'module_name' => 'sms_broadcast',
                                'sending_method' => 'split'
                            );
                            /* echo "Ready to send Sms";
                              echo "Campaign ID is ".$oSelectedCampaign->id;
                              echo "<br>"; */
                            $this->sendBroadcastSms($oSubscriber, $aSmsData);
                        }


                        $campaignIndex = ($currentCampaignID == $lastCampaignID) ? 0 : $campIndex + 1;
                        $totalProcessed = $camptotalProcessed + 1;
                        //echo "Total Processed ". $totalProcessed;
                        $aProcessedSubscribersCount[$currentCampaignID] = $totalProcessed;
                        //pre($aProcessedSubscribersCount);
                    } else {
                        echo "<br>Split Array is blank";
                    }
                }
            }
        }
    }

    public function getNextSplitCampaign($aFinalCampaigns, $aCampaignIDs, $campaignIndex, $aProcessedSubscribersCount) {
        $lastCampaignID = end($aCampaignIDs);
        $currentCampaignID = $aCampaignIDs[$campaignIndex];
        $aVariationInfo = $aFinalCampaigns[$currentCampaignID];
        /* echo "<br>Last Campaign ID = ". $lastCampaignID;
          echo "<br>Current Campaign ID =". $currentCampaignID;
          echo "<br>INdex now = $campaignIndex" ; */
        $allowedMaximumSubscribers = $aVariationInfo['variationSubscribersCount'];

        $totalProcessed = count($aProcessedSubscribersCount[$currentCampaignID]);
        //echo "<br>Allowed Maximum Subscribers" . $allowedMaximumSubscribers . " And Total Processsed" . $totalProcessed;
        if ($allowedMaximumSubscribers > 0) {
            if ($totalProcessed < $allowedMaximumSubscribers) {
                $aSplitData = array(
                    'oSelectedCampaign' => $aVariationInfo['campaignData'],
                    'campaignIndex' => $campaignIndex,
                    'totalProcessed' => $totalProcessed,
                    'currentCampaignID' => $currentCampaignID
                );
            } else {
                // call same function recursively in order to get the next split campaign
                //echo "About to call recursively and current Campaign id is {$currentCampaignID}  and last campaign id is {$lastCampaignID}";
                $campaignIndex = ($currentCampaignID == $lastCampaignID) ? 0 : $campaignIndex + 1;
                //echo "<br> I am inside and campaginIndex is " . $campaignIndex;
                $aSplitData = $this->getNextSplitCampaign($aFinalCampaigns, $aCampaignIDs, $campaignIndex, $aProcessedSubscribersCount);
            }
        } else {

            $aSplitData = array(
                'oSelectedCampaign' => $aVariationInfo['campaignData'],
                'campaignIndex' => $campaignIndex,
                'totalProcessed' => $totalProcessed,
                'currentCampaignID' => $currentCampaignID
            );
        }


        if (!empty($aSplitData)) {
            return $aSplitData;
        }
    }

    public function sendBroadcastEmail($oSubscriber, $aData) {
        $content = $aData['content'];
        $fromEmail = $aData['from'];
        $subject = $aData['subject'];
        $preheader = $aData['preheader'];
        $clientID = $aData['client_id'];
        $fromName = $aData['fromName'];
        $replyEmail = $aData['replyEmail'];
        $sendingMethod = ($aData['sending_method'] == 'split') ? 'split' : 'normal';

        if (!empty($oSubscriber)) {
            //$userCurrentUsage = $this->mInviter->getCurrentUsage($clientID);
            //if ($userCurrentUsage->email_balance > 0 || $userCurrentUsage->email_balance_topup > 0) {
            $emailContent = $content;
            $messageID = $this->generateMessageId();
            $to = $oSubscriber->email;
            $aTrackSetttings = array();
            $aTrackSetttings['user_id'] = $oSubscriber->user_id;
            $aTrackSetttings['campaign_id'] = $aData['campaign_id'];
            $aTrackSetttings['inviter_id'] = $aData['inviter_id'];
            $aTrackSetttings['broadcast_id'] = $aData['broadcast_id'];
            $aTrackSetttings['email'] = $oSubscriber->email;
            $aTrackSetttings['subscriber_id'] = $oSubscriber->id;
            $aTrackSetttings['client_id'] = $clientID;
            $aTrackSetttings['module_name'] = $aData['module_name'];
            $aTrackSetttings['sending_method'] = $sendingMethod;
            //Replace Tags
            $contentReplaced = $this->mInviter->emailTagReplace($aData['broadcast_id'], $emailContent, 'email', $oSubscriber);
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
                'broadcast_id' => $aData['broadcast_id'],
                'campaign_id' => $aData['campaign_id'],
                'inviter_id' => $aData['inviter_id'],
                'subscriber_id' => $oSubscriber->id,
                'preceded_by' => $aData['previous_event_id'],
                'message_id' => $messageID,
                'sending_server_id' => $currentServerID,
                'client_id' => $clientID,
                'module_name' => $aData['module_name'],
                'moduleName' => $aData['module_name'],
                'moduleUnitId' => $aData['broadcast_id'],
                'subscriber_id' => $oSubscriber->id,
                'globalSubscriberId' => $oSubscriber->subscriber_id,
                'sending_method' => $sendingMethod,
                'created' => date("Y-m-d H:i:s")
            );
            if ($this->enableQueue == true) {
                //Add email in the queue
                $this->mInviter->saveInviterQueue($aEmailData);
            } else {
                //Send email now
                pre($aEmailData);
                //die;
                //Okay final check if campaign sent to the subscriber or not
                $bCampaignAlreadySent = $this->mInviter->checkIfCampaignSent($aData['campaign_id'], $oSubscriber->id, 'subs_email', $oSubscriber->email);
                $bSkipped = false;
                if ($bCampaignAlreadySent == true) {
                    $bEmailSent = true;
                    $bSkipped = true;
                    //echo "<br>I skipped";
                } else {
                    //echo "<br>Yes I reached here";
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
                        'sending_method' => $sendingMethod,
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
                        'module_name' => 'broadcast',
                        'module_unit_id' => $aData['broadcast_id']
                    );
                    updateCreditUsage($aUsage);
                }
            }
            //}
        }
    }

    public function sendBroadcastSms($oSubscriber, $aData) {
        $content = $aData['content'];
        $fromNumber = $aData['from_number'];
        $clientID = $aData['client_id'];
        $sendingMethod = ($aData['sending_method'] == 'split') ? 'split' : 'normal';
        if (!empty($oSubscriber)) {
            $smsContent = $this->mInviter->emailTagReplace($aData['broadcast_id'], $content, 'sms', $oSubscriber);
            //$userCurrentUsage = $this->mInviter->getCurrentUsage($clientID);
            //if ($userCurrentUsage->sms_balance > 0 || $userCurrentUsage->sms_balance_topup > 0) {
            $messageID = $this->generateMessageId();
            $toNumber = $oSubscriber->phone;
            $aSmsData = array(
                'campaign_type' => 'sms',
                'to' => $toNumber,
                'from_entity' => $fromNumber,
                'content' => $smsContent,
                'broadcast_id' => $aData['broadcast_id'],
                'campaign_id' => $aData['campaign_id'],
                'inviter_id' => $aData['inviter_id'],
                'subscriber_id' => $oSubscriber->id,
                'preceded_by' => $aData['previous_event_id'],
                'message_id' => $messageID,
                'sending_method' => $sendingMethod,
                'sending_server_id' => 0,
                'client_id' => $clientID,
                'module_name' => $aData['module_name'],
                'created' => date("Y-m-d H:i:s")
            );
            if ($this->enableQueue == true) {
                $this->mInviter->saveInviterQueue($aSmsData);
            } else {
                //Send SMS now
                $bSmsSent = false;
                $bCampaignAlreadySent = $this->mInviter->checkIfCampaignSent($aData['campaign_id'], $oSubscriber->id, 'subs_phone', $oSubscriber->phone);
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
                        'sending_method' => $sendingMethod,
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
                        'module_name' => 'broadcast',
                        'module_unit_id' => $aData['broadcast_id']
                    );
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

    public function sendBulkBroadcastEmail($oSubscribers, $aData) {
        $content = $aData['content'];
        $fromEmail = $aData['from'];
        $subject = $aData['subject'];
        $preheader = $aData['preheader'];
        $clientID = $aData['client_id'];
        $fromName = $aData['fromName'];
        $replyEmail = $aData['replyEmail'];

        if ($aData['broadcast_id'] == $this->testCampaignId) {
            echo "Yes I reached here till now";
        }

        if (!empty($oSubscribers)) {
            foreach ($oSubscribers as $oSubscriber) {
                //$userCurrentUsage = $this->mInviter->getCurrentUsage($clientID);
                //if ($userCurrentUsage->email_balance > 0 || $userCurrentUsage->email_balance_topup > 0) {
                $emailContent = $content;
                $messageID = $this->generateMessageId();
                $to = $oSubscriber->email;
                $aTrackSetttings = array();
                $aTrackSetttings['user_id'] = $oSubscriber->user_id;
                $aTrackSetttings['campaign_id'] = $aData['campaign_id'];
                $aTrackSetttings['inviter_id'] = $aData['inviter_id'];
                $aTrackSetttings['broadcast_id'] = $aData['broadcast_id'];
                $aTrackSetttings['email'] = $oSubscriber->email;
                $aTrackSetttings['subscriber_id'] = $oSubscriber->id;
                $aTrackSetttings['client_id'] = $clientID;
                $aTrackSetttings['module_name'] = $aData['module_name'];
                //Replace Tags
                $contentReplaced = $this->mInviter->emailTagReplace($aData['broadcast_id'], $emailContent, 'email', $oSubscriber);
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
                    'broadcast_id' => $aData['broadcast_id'],
                    'campaign_id' => $aData['campaign_id'],
                    'inviter_id' => $aData['inviter_id'],
                    'subscriber_id' => $oSubscriber->id,
                    'preceded_by' => $aData['previous_event_id'],
                    'message_id' => $messageID,
                    'sending_server_id' => $currentServerID,
                    'client_id' => $clientID,
                    'module_name' => $aData['module_name'],
                    'moduleName' => $aData['module_name'],
                    'moduleUnitId' => $aData['broadcast_id'],
                    'subscriber_id' => $oSubscriber->id,
                    'globalSubscriberId' => $oSubscriber->subscriber_id,
                    'created' => date("Y-m-d H:i:s")
                );
                if ($this->enableQueue == true) {
                    //Add email in the queue
                    $this->mInviter->saveInviterQueue($aEmailData);
                } else {
                    //Send email now
                    //pre($aEmailData);
                    //die;
                    //Okay final check if campaign sent to the subscriber or not
                    $bCampaignAlreadySent = $this->mInviter->checkIfCampaignSent($aData['campaign_id'], $oSubscriber->id, 'subs_email', $oSubscriber->email);
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
                            'module_name' => 'broadcast',
                            'module_unit_id' => $aData['broadcast_id']
                        );
                        updateCreditUsage($aUsage);
                    }
                }
                //}
            }
        }
    }

    public function sendBulkBroadcastSms($oSubscribers, $aData) {
        $content = $aData['content'];
        $fromNumber = $aData['from_number'];
        $clientID = $aData['client_id'];
        if (!empty($oSubscribers)) {
            foreach ($oSubscribers as $oSubscriber) {

                $smsContent = $this->mInviter->emailTagReplace($aData['broadcast_id'], $content, 'sms', $oSubscriber);
                //$userCurrentUsage = $this->mInviter->getCurrentUsage($clientID);
                //if ($userCurrentUsage->sms_balance > 0 || $userCurrentUsage->sms_balance_topup > 0) {
                $messageID = $this->generateMessageId();
                $toNumber = $oSubscriber->phone;
                $aSmsData = array(
                    'campaign_type' => 'sms',
                    'to' => $toNumber,
                    'from_entity' => $fromNumber,
                    'content' => $smsContent,
                    'broadcast_id' => $aData['broadcast_id'],
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
                    $this->mInviter->saveInviterQueue($aSmsData);
                } else {
                    //Send SMS now
                    $bSmsSent = false;
                    $bCampaignAlreadySent = $this->mInviter->checkIfCampaignSent($aData['campaign_id'], $oSubscriber->id, 'subs_phone', $oSubscriber->phone);
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
                            'module_name' => 'broadcast',
                            'module_unit_id' => $aData['broadcast_id']
                        );
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
            $insertID = $this->mInviter->saveTriggerData($aTriggerData); //Trigger table
        }

        //Track Log
        $aTrackData = array(
            'campaign_type' => $aData['type'],
            'message_id' => $aData['message_id'],
            'subscriber_id' => $aData['subscriber_id'],
            'campaign_id' => $aData['campaign_id'],
            'sending_method' => $aData['sending_method'],
            'auto_trigger_id' => $insertID,
            'status' => 'sent',
            'subs_email' => $aData['subs_email'],
            'subs_phone' => $aData['subs_phone'],
            'created_at' => date("Y-m-d H:i:s"),
        );
        $this->mInviter->saveSendingLog($aTrackData);
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
                    $broadcastID = $aSettingsData['broadcast_id'];
                    $clientID = $aSettingsData['client_id'];
                    $moduleName = $aSettingsData['module_name'];
                    $sendingMethod = $aSettingsData['sending_method'];
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
                    if ($broadcastID > 0) {
                        $additionalParams .= '&autoid=' . $broadcastID;
                    }
                    if ($subscriberID > 0) {
                        $additionalParams .= '&subid=' . $subscriberID;
                    }
                    if ($clientID > 0) {
                        $additionalParams .= '&clid=' . $clientID;
                    }
                    if (!empty($moduleName)) {
                        $additionalParams .= '&modname=' . $moduleName;
                    }
                    if (!empty($sendingMethod)) {
                        $additionalParams .= '&sm=' . $sendingMethod;
                    }
                    $additionalParams = ($additionalParams) ? $additionalParams : '';
                }
                $trackClickUrl = $this->trackServer . '/broadcast_track.php?click_redirect=' . $encodeURL . '&msgid=' . $this->base64UrlEncode($msgId) . $additionalParams;

                $newHref = str_replace($url, $trackClickUrl, $href);
                $content = str_replace($href, $newHref, $content);
            }
        }
        return $content;
    }

    public function addOpenTrackingUrl($content, $msgId, $aSettingsData = array()) {

        $sendingMethod = $aSettingsData['sending_method'];
        $sendingMethod = ($sendingMethod) ? $sendingMethod : 'normal';





        $trackOpenUrl = $this->trackServer . '/broadcast_track.php?open_track=true&msgid=' . $this->base64UrlEncode($msgId) . '&sm=' . $sendingMethod;
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

    public function SG_smtp($aData) {
        //pre($aData);
        //For now use detault sendgrid account
        if ($this->use_default_accounts == true) {
            $aSendgridData = $this->defaultSendgridDetails;
            $user = $aSendgridData['user'];
            $password = $aSendgridData['password'];
            $host = $aSendgridData['host'];
            $port = $aSendgridData['port'];
            $type = $aSendgridData['type'];
        } else {
            $aSendgridData = $this->mInviter->getSendgridAccount($aData['client_id']);
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
        $sendingMethod = $aData['sending_method'];

        $sendingMethod = ($sendingMethod) ? $sendingMethod : 'normal';

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
                'bb_broadcast_id' => $aData['broadcast_id'],
                'bb_campaign_id' => $aData['campaign_id'],
                'bb_module_name' => $aData['module_name'],
                'bb_sending_method' => $sendingMethod
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
            'x-smtpapi' => json_encode($json_string)
        );

        if (!empty($fromName)) {
            $params['fromname'] = $fromName;
        }

        if (!empty($replyEmail)) {
            $params['replyto'] = $replyEmail;
        }
        //echo "I have till now";
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
            /* echo "Some error";
              pre($result['errors']); */
            return false;
        } else {
            //echo "Success";
            return true;
        }
    }

    public function send_Twilio($aData) {

        if ($this->use_default_accounts == true) {
            $aTwilioData = $this->defaultTwilioDetails;
            $sid = $aTwilioData['sid'];
            $token = $aTwilioData['token'];
            $from = $aData['from_entity'];
        } else {
            $aTwilioAc = $this->mInviter->getTwilioAccount($aData['client_id']);
            $sid = $aTwilioAc->account_sid;
            $token = $aTwilioAc->account_token;
            $from = $aTwilioAc->contact_no;
        }

        if (empty($aTwilioAc)) {
            return false;
        }

        $to = $aData['to'];

        $msg = $aData['content'];

        $broadcastID = $aData['broadcast_id'];
        $campaignID = $aData['campaign_id'];
        $eventID = $aData['inviter_id'];
        $subscriberID = $aData['subscriber_id'];
        $moduleName = $aData['module_name'];
        $sendingMethod = $aData['sending_method'];

        $sendingMethod = ($sendingMethod) ? $sendingMethod : 'normal';


        $qs = '?';

        if (!empty($broadcastID)) {
            $qs .= 'broadcast_id=' . $broadcastID;
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

        if (!empty($sendingMethod)) {
            $qs .= '&bb_sending_method=' . $sendingMethod;
        }

        $smsTrackURL = $this->config->item('sms_track_url');

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

}
