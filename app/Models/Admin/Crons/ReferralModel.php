<?php

namespace App\Models\Admin\Crons;

use Illuminate\Database\Eloquent\Model;
use DB;

class ReferralModel extends Model {

    /**
     * Get current usage of client's credits
     * @param type $clientID
     * @return type
     */
    public function getCurrentUsage($clientID) {
        $oData = DB::table('tbl_account_usage')
                ->where('user_id', $clientID)
                ->first();
        return $oData;
    }

    /**
     * Get all the main referral campaign events
     * @return type
     */
    public function getInviterEvents() {
        $oData = DB::table('tbl_referral_automations_events')
                ->join('tbl_referral_rewards', 'tbl_referral_rewards.id', '=', 'tbl_referral_automations_events.referral_id')
                ->leftJoin('tbl_users', 'tbl_referral_rewards.user_id', '=', 'tbl_users.id')
                ->select('tbl_referral_automations_events.*', 'tbl_referral_rewards.hashcode AS account_id', 'tbl_referral_rewards.user_id AS client_id', 'tbl_users.firstname AS client_first_name', 'tbl_users.lastname AS client_last_name', 'tbl_users.email AS client_email', 'tbl_users.mobile AS client_phone')
                ->where('tbl_referral_automations_events.status', 'active')
                ->orderBy('tbl_referral_automations_events.id', 'asc')
                ->get();
        return $oData;
    }

    /**
     * Get the list of reminder invite subscribers
     * @param type $currentInviterID
     * @param type $previousID
     * @param type $frequence
     * @return type
     */
    public function getInviteReminderSubscribers($currentInviterID, $previousID, $frequence = 1) {

        if ($frequence > 1) {
            $sql = "SELECT tbl_referral_users.*, tbl_subscribers.email, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.phone, tbl_referral_users.id AS advocateID, tbl_referral_automations_triggers.auto_event_id, "
                    . "tbl_referral_automations_triggers.id AS triggerID, tbl_referral_automations_triggers.subscriber_id, "
                    . "tbl_referral_automations_triggers.preceded_by, tbl_referral_automations_triggers.start_at "
                    . "FROM tbl_referral_automations_events "
                    . "LEFT JOIN tbl_referral_automations_triggers ON tbl_referral_automations_events.id = tbl_referral_automations_triggers.auto_event_id "
                    . "LEFT JOIN tbl_referral_users ON tbl_referral_automations_triggers.subscriber_id=tbl_referral_users.id "
                    . "LEFT JOIN tbl_subscribers ON tbl_referral_users.subscriber_id = tbl_subscribers.id "
                    . "WHERE tbl_referral_users.status = '1' AND tbl_subscribers.status = '1' AND tbl_referral_automations_triggers.auto_event_id='{$previousID}' "
                    . "OR tbl_referral_automations_triggers.auto_event_id='{$currentInviterID}' AND tbl_subscribers.email NOT IN(SELECT email FROM tbl_suppression_list)"
                    . "ORDER BY tbl_referral_automations_triggers.id ASC";
        } else {
            $sql = "SELECT tbl_referral_users.*, tbl_subscribers.email, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.phone, tbl_referral_users.id AS advocateID, tbl_referral_automations_triggers.auto_event_id, "
                    . "tbl_referral_automations_triggers.id AS triggerID, "
                    . "tbl_referral_automations_triggers.preceded_by, tbl_referral_automations_triggers.start_at "
                    . "FROM tbl_referral_automations_events "
                    . "LEFT JOIN tbl_referral_automations_triggers ON tbl_referral_automations_events.id = tbl_referral_automations_triggers.auto_event_id "
                    . "LEFT JOIN tbl_referral_users ON tbl_referral_automations_triggers.subscriber_id=tbl_referral_users.id "
                    . "LEFT JOIN tbl_subscribers ON tbl_referral_users.subscriber_id = tbl_subscribers.id "
                    . "WHERE tbl_referral_users.status = '1' AND tbl_subscribers.status = '1' AND tbl_referral_automations_triggers.auto_event_id='{$previousID}' "
                    . "AND tbl_referral_automations_triggers.subscriber_id NOT IN(SELECT subscriber_id FROM tbl_referral_automations_triggers "
                    . "WHERE auto_event_id='{$currentInviterID}') AND tbl_subscribers.email NOT IN(SELECT email FROM tbl_suppression_list)";
        }
        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    /**
     * Get reminder sales
     * @param type $accountID
     * @param type $inviterID
     * @param type $previousEventID
     * @return type
     */
    public function getReminderSales($accountID, $inviterID, $previousEventID) {
        $MostRecent = array();
        $sql = "SELECT tbl_referral_automations_triggers.*, tbl_referral_automations_triggers.id AS triggerID, "
                . "tbl_referral_automations_triggers.sale_id AS saleID, tbl_referral_users.*, tbl_subscribers.email, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.phone, tbl_referral_users.id AS advocateID "
                . "FROM tbl_referral_automations_triggers "
                . "LEFT JOIN tbl_referral_users ON tbl_referral_users.id=tbl_referral_automations_triggers.subscriber_id "
                . "LEFT JOIN tbl_subscribers ON tbl_referral_users.subscriber_id = tbl_subscribers.id "
                . "WHERE tbl_referral_users.status='1' "
                . "AND tbl_referral_automations_triggers.sale_id IS NOT NULL "
                . "AND tbl_referral_users.account_id='{$accountID}' "
                . "AND tbl_referral_automations_triggers.created_at > DATE_SUB(NOW(), INTERVAL 60 DAY) ORDER BY tbl_referral_automations_triggers.id ASC";
        $oData = DB::select(DB::raw($sql));
        if ($oData->isNotEmpty()) {
            foreach ($oData as $oRow) {
                $MostRecent[$oRow->sale_id] = $oRow;
            }
        }
        return $MostRecent;
    }

    /**
     * Get latest sale of a client account
     * @param type $accountID
     * @return type
     */
    public function getLatestSales($accountID) {
        $sql = "SELECT tbl_referral_sales.*, tbl_referral_sales.id AS saleID, tbl_referral_sales.advocate_id AS advocateID, tbl_referral_users.status "
                . "FROM tbl_referral_sales "
                . "LEFT JOIN tbl_referral_users ON tbl_referral_users.id=tbl_referral_sales.advocate_id "
                . "WHERE tbl_referral_sales.created > DATE_SUB(NOW(), INTERVAL 2 HOUR) "
                . "AND tbl_referral_sales.account_id='{$accountID}' ORDER BY tbl_referral_sales.id DESC";
        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    /**
     * Get the list of sales subscribers
     * @param type $accountID
     * @param type $inviterID
     * @param type $aUserID
     * @param type $aSaleID
     * @param type $oUserData
     * @return boolean
     */
    public function getSalesSubscribers($accountID, $inviterID, $aUserID, $aSaleID, $oUserData) {
        if (!empty($aSaleID)) {
            $sql = "SELECT subscriber_id "
                    . "FROM tbl_referral_automations_triggers "
                    . "WHERE auto_event_id = '$inviterID' "
                    . "AND sale_id IN(" . implode(",", $aSaleID) . ")";
            $oData = DB::select(DB::raw($sql));
            if ($oData->isNotEmpty()) {
                foreach ($oData as $oRow) {
                    $aAlreadySent[] = $oRow->subscriber_id;
                }
            }
        }


        if (!empty($aUserID)) {
            foreach ($aUserID as $userID) {
                if (!in_array($userID, $aAlreadySent)) {
                    $aFilteredUsers[] = $userID;
                }
            }

//            pre($aFilteredUsers);
//            die;
            $oEligibleSubscribers = array();
            if (!empty($aFilteredUsers) && !empty($oUserData)) {
                foreach ($oUserData as $oDataUnit) {
                    if (in_array($oDataUnit->advocate_id, $aFilteredUsers) && (!in_array($oDataUnit->advocate_id, $oEligibleSubscribers))) {
                        $oEligibleSubscribers[] = $oDataUnit;
                    }
                }
            }
//            pre($oEligibleSubscribers);
//            die;
            return $oEligibleSubscribers;
        }
        return false;
    }

    /**
     * Get eligible inviter for an event 
     * @param type $inviterID
     * @param type $accountID
     * @return type
     */
    public function getInviterEligibleSubscribers($inviterID, $accountID) {
        $sql = "SELECT tbl_referral_users.*,tbl_subscribers.email, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.phone, tbl_referral_users.id AS advocateID FROM tbl_referral_users "
                . "LEFT JOIN tbl_subscribers ON tbl_referral_users.subscriber_id = tbl_subscribers.id "
                . "WHERE tbl_referral_users.status = '1' "
                . "AND tbl_subscribers.status = '1' "
                . "AND tbl_referral_users.account_id='$accountID' "
                . "AND tbl_subscribers.email NOT IN(SELECT email FROM tbl_suppression_list) "
                . " GROUP BY tbl_subscribers.email";
        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    /**
     * 
     * @param type $currentInviterID
     * @param type $previousID
     * @return type
     */
    public function getNextInviterEligibleSubscribers($currentInviterID, $previousID) {

        $sql = "SELECT tbl_referral_users.*, tbl_subscribers.email, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.phone, tbl_referral_users.id AS advocateID, tbl_referral_automations_triggers.auto_event_id, "
                . "tbl_referral_automations_triggers.subscriber_id, tbl_referral_automations_triggers.preceded_by, "
                . "tbl_referral_automations_triggers.start_at FROM tbl_referral_automations_events "
                . "LEFT JOIN tbl_referral_automations_triggers ON tbl_referral_automations_events.id = tbl_referral_automations_triggers.auto_event_id "
                . "LEFT JOIN tbl_referral_users ON tbl_referral_automations_triggers.subscriber_id=tbl_referral_users.id "
                . "LEFT JOIN tbl_subscribers ON tbl_referral_users.subscriber_id = tbl_subscribers.id "
                . "WHERE tbl_referral_users.status = '1' AND tbl_subscribers.status = '1' AND tbl_referral_automations_triggers.auto_event_id='{$previousID}' "
                . "AND tbl_referral_automations_triggers.subscriber_id NOT IN(SELECT subscriber_id FROM tbl_referral_automations_triggers "
                . "WHERE auto_event_id='{$currentInviterID}') AND tbl_subscribers.email NOT IN(SELECT email FROM tbl_suppression_list)";

        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    /**
     * Get the list of all referral campaigns
     * @param type $inviterID
     * @return type
     */
    public function getAutomationCampaign($inviterID) {
        $sql = "SELECT * FROM tbl_referral_automations_campaigns WHERE event_id='$inviterID' AND (status ='active' OR status='1')";
        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    /**
     * Get referral settings
     * @param type $referralID
     * @return type
     */
    public function getSettingsInfo($referralID) {
        $oData = DB::table('tbl_referral_settings')
                ->where('referral_id', $referralID)
                ->first();
        return $oData;
    }

    /**
     * Get Referral Links
     * @param type $subscriberID
     * @param type $referralID
     * @return type
     */
    public function getReferralLink($subscriberID, $referralID) {
        $oData = DB::table('tbl_referral_reflinks')
                ->where('referral_id', $referralID)
                ->where('subscriber_id', $subscriberID)
                ->first();
        return $oData;
    }

    /**
     * Get the details of referral settings
     * @param type $id
     * @param type $hash
     * @return type
     */
    public function getReferralSettings($id, $hash = false) {
        $oData = DB::table('tbl_referral_rewards')
                ->leftJoin('tbl_referral_rewards_adv_coupons', 'tbl_referral_rewards_adv_coupons.reward_id', '=', 'tbl_referral_rewards.id')
                ->leftJoin('tbl_referral_rewards_ref_coupons', 'tbl_referral_rewards_ref_coupons.reward_id', '=', 'tbl_referral_rewards.id')
                ->leftJoin('tbl_referral_rewards_cash', 'tbl_referral_rewards_cash.reward_id', '=', 'tbl_referral_rewards.id')
                ->leftJoin('tbl_referral_rewards_custom', 'tbl_referral_rewards_custom.reward_id', '=', 'tbl_referral_rewards.id')
                ->leftJoin('tbl_referral_rewards_promo_links', 'tbl_referral_rewards_promo_links.reward_id', '=', 'tbl_referral_rewards.id')
                ->select('tbl_referral_rewards.*', 'tbl_referral_rewards.id AS rewardID', 'tbl_referral_rewards.created AS rewardCreated', 'tbl_referral_rewards_adv_coupons.*', 'tbl_referral_rewards_adv_coupons.id AS advCouponID', 'tbl_referral_rewards_adv_coupons.created AS advCouponCreated', 'tbl_referral_rewards_ref_coupons.*', 'tbl_referral_rewards_ref_coupons.id AS refCouponID', 'tbl_referral_rewards_ref_coupons.created AS refCouponCreated', 'tbl_referral_rewards_cash.*', 'tbl_referral_rewards_cash.id AS cashID', 'tbl_referral_rewards_cash.created AS cashCreated', 'tbl_referral_rewards_custom.*', 'tbl_referral_rewards_custom.id AS customID', 'tbl_referral_rewards_custom.created AS customCreated', 'tbl_referral_rewards_promo_links.*', 'tbl_referral_rewards_promo_links.id AS promoID', 'tbl_referral_rewards_promo_links.created AS promoCreated')
                ->when(($hash == true) , function ($query) use ($id) {
                    return $query->where('tbl_referral_rewards.hashcode', $id);
                }, function ($query) use ($id) {
                    return $query->where('tbl_referral_rewards.id', $id);
                })
                ->orderBy('tbl_nps_automations_events.id', 'asc')
                ->first();
        return $oData;
    }

    /**
     * Replace email tags of an end campaign
     * @param type $referralID
     * @param type $accountID
     * @param type $sHtml
     * @param type $campaignType
     * @param type $subscriberInfo
     * @return type
     */
    public function emailTagReplace($referralID, $accountID, $sHtml, $campaignType = 'email', $subscriberInfo) {
        $aTags = $this->config->item('email_tags');

        if (!empty($referralID)) {
            $aSettings = $this->getSettingsInfo($referralID);
        }

        if (!empty($accountID)) {

            $oRewardSettings = $this->getReferralSettings($accountID, $hash = true);
        }

        if (!empty($subscriberInfo)) {
            $subscriberID = $subscriberInfo->subscriber_id;
            $oRefLink = $this->getReferralLink($subscriberID, $referralID);
            $refKey = $oRefLink->refkey;
            $refLink = site_url() . 'ref/t/' . $refKey;
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
                        $htmlData = ($subscriberInfo->phone) ? $subscriberInfo->phone : $subscriberInfo->mobile;
                        break;
                    case '{ADVOCATE_REWARD}':
                        if (!empty($accountID)) {
                            //Get Advocate related reward details
                            if (!empty($oRewardSettings->cash_id)) {
                                $advTagline = 'get ' . $oRewardSettings->display_msg;
                            } else if (!empty($oRewardSettings->custom_id)) {
                                $advTagline = 'get ' . $oRewardSettings->reward_title;
                            } else if (!empty($oRewardSettings->adv_coupon_id)) {
                                $advTagline = 'get ' . $oRewardSettings->advocate_display_msg;
                            }

                            if (!empty($advTagline)) {
                                $htmlData = 'Refer your friends and ' . $advTagline;
                            }
                        }


                        break;
                    case '{FRIEND_REWARD}':
                        if (!empty($accountID)) {

                            //Get Referred friend related reward details
                            if (!empty($oRewardSettings->promo_id)) {
                                $refTagline = 'Give your friend ' . $oRewardSettings->link_desc;
                            } else if (!empty($oRewardSettings->ref_coupon_id)) {
                                $refTagline = 'Give your friend ' . $oRewardSettings->referred_display_msg;
                            }
                            if (!empty($refTagline)) {
                                $htmlData = $refTagline;
                            }
                        }

                        break;

                    case '{REFERRAL_LINK}':
                        if ($campaignType == 'email') {
                            $htmlData = "<a href='" . $refLink . "'>" . $refLink . "</a>";
                        } else {
                            $htmlData = $refLink;
                        }
                        break;

                    case '{STORE_NAME}':
                        $htmlData = $aSettings->store_name;
                        break;

                    case '{STORE_URL}':
                        $htmlData = $aSettings->store_url;
                        break;

                    case '{STORE_EMAIL}':
                        $htmlData = $aSettings->store_email;
                        break;

                    case '{UNSUBSCRIBE_LINK}':
                        $htmlData = "<a href='" . base_url() . "admin/brandboost/unsubscribeUser/" . $bbID . "/" . $subscriberInfo->id . "'>Click Here</a> to unsubscribe.";

                        break;
                }
                $sHtml = str_replace($sTag, $htmlData, $sHtml);
            }
        }
        return $sHtml;
    }

    /**
     * Checks if campaign has sent
     * @param type $campaignID
     * @param type $subscriberID
     * @param type $saleID
     * @param type $fieldName
     * @param type $fieldValue
     * @return boolean
     */
    public function checkIfCampaignSent($campaignID, $subscriberID, $saleID = '', $fieldName = '', $fieldValue = '') {
        $oData = DB::table('tbl_referral_automations_tracking_logs')
                ->where('campaign_id', $campaignID)
                ->when((!empty($fieldName) && !empty($fieldValue)), function ($query) use ($fieldName, $fieldValue) {
                    return $query->where($fieldName, $fieldValue);
                }, function ($query) use ($subscriberID) {
                    return $query->where('subscriber_id', $subscriberID);
                })
                ->when(!empty($saleID), function ($query) use ($saleID) {
                    return $query->where('sale_id', $saleID);
                })
                ->exists();
        return $oData;        
    }

    /**
     * Counts total frequency to send out an email or sms campaign
     * @param type $campaignID
     * @param type $subscriberID
     * @param type $saleID
     * @param type $campaignType
     * @return int
     */
    public function countCampaignSentFrequence($campaignID, $subscriberID, $saleID = '', $campaignType) {
        $oData = DB::table('tbl_referral_automations_tracking_logs')
                ->where('campaign_id', $campaignID)
                ->where('subscriber_id', $subscriberID)
                ->where('campaign_type', $campaignType)
                ->when(!empty($saleID), function ($query) use ($saleID) {
                    return $query->where('sale_id', $saleID);
                })
                ->count();
        return $oData;
    }

    /**
     * Used to save trigger data
     * @param type $aData
     * @return type
     */
    public function saveTriggerData($aData) {
        $insertID = DB::table('tbl_referral_automations_triggers')->insertGetId($aData);
        return $insertID;
    }

    /**
     * Used to save sending log 
     * @param type $aData
     * @return type
     */
    public function saveSendingLog($aData) {
        $insertID = DB::table('tbl_referral_automations_tracking_logs')->insertGetId($aData);
        return $insertID;
    }

    /**
     * Get the list of waiting queue
     * @param type $aData
     * @return type
     */
    public function saveInviterQueue($aData) {
        $insertID = DB::table('tbl_referral_automations_inviter_queue')->insertGetId($aData);
        return $insertID;
    }

    /**
     * Get twilio account details
     * @param type $clientID
     * @return type
     */
    public function getTwilioAccount($clientID) {
        $oData = DB::table('tbl_twilio_accounts')
                ->where('user_id', $clientID)
                ->where('status', 1)
                ->first();
        return $oData;
    }

    /**
     * Get sendgrid account details
     * @param type $clientID
     * @return type
     */
    public function getSendgridAccount($clientID) {
        $oData = DB::table('tbl_sendgrid_accounts')
                ->where('user_id', $clientID)
                ->where('status', 1)
                ->first();
        return $oData;
    }

}
