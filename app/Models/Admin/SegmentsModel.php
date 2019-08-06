<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\FeedbackModel;
use App\Models\ReviewsModel;
use App\Models\Admin\Modules\NpsModel;
use DB;
use Cookie;
use Session;

class SegmentsModel extends Model {


     /**
    * This function is used to create segments
    * @param aData 
    * @return type
    */

    public function createSegment($aData) {
        $aData =  DB::table('tbl_segments')->insertGetId($aData);
         return $aData;
    }


   
     /**
    * This function is used to check duplicate segments
    * @param type 
    * @return type
    */

    public function isDuplicateSegment($segmentName, $userID = 0) {
        $aData =  DB::table('tbl_segments')
         ->where('segment_name', $segmentName)
           ->where('user_id', $userID)->get();
            return $aData;
       
    }


      /**
    * This function is used to get segment subscribers on the behalf of seqmentID
    * @param seqmentID 
    * @return type
    */

    public function getSegmentCoreSubscribers($seqmentID) {
        $aData =  DB::table('tbl_segments_users')
         ->where("segment_id", $seqmentID)->get();
       return $aData ;
    }


      /**
    * This function is used to add segment subscribers 
    * @param type 
    * @return type
    */

    public function addSegmentSubscribers($segmentID, $campaignID, $segmentType, $campaignType, $moduleName = '', $moduleEventID='', $sendingMethod='normal') {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $oExistingSubscribers = array();
        $oExistingSubscribers = $this->getSegmentCoreSubscribers($segmentID);
        if (!empty($oExistingSubscribers)) {
            foreach ($oExistingSubscribers as $oSubs) {
                $aExistingSubsID[] = $oSubs->subscriber_id;
            }
        }

        if (strtolower($campaignType) == 'email') {
            if ($segmentType == 'total-sent') {
                $param = 'delivered';
            } else if ($segmentType == 'total-open') {
                $param = 'open';
            } else if ($segmentType == 'total-click') {
                $param = 'click';
            }else if ($segmentType == 'total-dropped') {
                $param = 'dropped';
            }else if ($segmentType == 'total-deliver') {
                $param = 'delivered';
            }else if ($segmentType == 'total-bounce') {
                $param = 'bounce';
            }else if ($segmentType == 'total-unsubscribe') {
                $param = 'unsubscribe';
            }else if ($segmentType == 'total-spam-report') {
                $param = 'spam_report';
            }
            

            //$oStats = $this->getBroadcastSendgridStats('broadcast', $campaignID, $param);
            $oStats = $this->getCustomSendgridStats($moduleName, $moduleName, $campaignID, $param, $moduleEventID, $sendingMethod);
            $aCategorizedStats = $this->getSGCategorizedStats($oStats);

            $oData = $aCategorizedStats[$param]['UniqueData'];
        } else if ($campaignType == 'sms') {
            if ($segmentType == 'total-sent') {
                $param = 'sent';
            } else if ($segmentType == 'total-delivered') {
                $param = 'delivered';
            } else if ($segmentType == 'total-click') {
                $param = 'click';
            }else if ($segmentType == 'total-bounce') {
                $param = 'bounce';
            }else if ($segmentType == 'total-unsubscribe') {
                $param = 'unsubscribe';
            }else if ($segmentType == 'total-spam-report') {
                $param = 'spam_report';
            }else if ($segmentType == 'total-dropped') {
                $param = 'dropped';
            }

            //$oStats = $this->getBroadcasstTwilioStats('broadcast', $campaignID);
            $oStats = $this->getCustomTwilioStats($moduleName, $moduleName, $campaignID, $param, $moduleEventID, $sendingMethod);
            $aCategorizedStats = $this->getTwiCategorizedStats($oStats);
            $oData = $aCategorizedStats[$param]['UniqueData'];
        }
        if (!empty($oData)) {

            //get Existing subscirbers in the segement if any
            foreach ($oData as $oStat) {
                $str = '';
                $subscriberID = $oStat->global_subscriber_id;
                if (!empty($subscriberID) && !in_array($subscriberID, $aExistingSubsID)) {
                    $str = "(" . $userID . "," . $segmentID . "," . $subscriberID . "," . "'" . date("Y-m-d H:i:s") . "')";
                    $aSqlParam[] = $str;
                }
            }

            if (!empty($aSqlParam)) {
                $sql = "INSERT INTO `tbl_segments_users` (`user_id`, `segment_id`, `subscriber_id`, `created`) VALUES " . implode(",", $aSqlParam);

                $result = DB::statement($sql);
               return true;

            }
        }

        return true;
    }


      /**
    * This function is used to add segment subscribers for Reviews
    * @param type 
    * @return type
    */

    public function addSegmentSubscribersFromReviews($segmentID, $campaignID, $segmentType, $campaignType, $moduleName = '') {
        $positiveSubscribers = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $mReviews  = new ReviewsModel();

        $oExistingSubscribers = array();
        $oExistingSubscribers = $this->getSegmentCoreSubscribers($segmentID);
        if (!empty($oExistingSubscribers)) {
            foreach ($oExistingSubscribers as $oSubs) {
                $aExistingSubsID[] = $oSubs->subscriber_id;
            }
        }
        
        $oReviews = $mReviews->getCampaignReviews($campaignID);
        if(!empty($oReviews)){
            foreach($oReviews as $oReview){
                if($oReview->ratings >=4 && !empty($oReview->subscriberId) && !in_array($oReview->subscriberId, $positiveSubscribers)){
                    //Positive Ratings
                    $positiveSubscribers[] = $oReview->subscriberId;
                }else if($oReview->ratings == 3 && !empty($oReview->subscriberId) && !in_array($oReview->subscriberId, $neutralSubscribers)){
                    $neutralSubscribers[] = $oReview->subscriberId;
                }else if($oReview->ratings < 3 && !empty($oReview->subscriberId) && !in_array($oReview->subscriberId, $negativeSubscribers)){
                    $negativeSubscribers[] = $oReview->subscriberId;;
                }
            }
        }

        if ($segmentType == 'total-positive') {
            $aSubscribers = $positiveSubscribers;
        } else if ($segmentType == 'total-neutral') {
            $aSubscribers = $neutralSubscribers;
        } else if ($segmentType == 'total-negative') {
            $aSubscribers = $negativeSubscribers;
        }
        
        
            
        


        if (!empty($aSubscribers)) {

            //get Existing subscirbers in the segement if any
            foreach ($aSubscribers as $subscriberID) {
                $str = '';
                if (!in_array($subscriberID, $aExistingSubsID)) {
                    $str = "(" . $userID . "," . $segmentID . "," . $subscriberID . "," . "'" . date("Y-m-d H:i:s") . "')";
                    $aSqlParam[] = $str;
                }
            }

            if (!empty($aSqlParam)) {
                $sql = "INSERT INTO `tbl_segments_users` (`user_id`, `segment_id`, `subscriber_id`, `created`) VALUES " . implode(",", $aSqlParam);

                $result = DB::statement($sql);
               return true;
            }
        }

        return true;
    }
    
    /**
    * This function is used to add segment subscribers from feedback
    * @param type 
    * @return type
    */

    public function addSegmentSubscribersFromFeedback($segmentID, $campaignID, $segmentType, $campaignType, $moduleName = '') {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $mFeedback  = new FeedbackModel();

        $oExistingSubscribers = array();
        $oExistingSubscribers = $this->getSegmentCoreSubscribers($segmentID);
        if (!empty($oExistingSubscribers)) {
            foreach ($oExistingSubscribers as $oSubs) {
                $aExistingSubsID[] = $oSubs->subscriber_id;
            }
        }
        
        $oFeedbacks = $mFeedback->getBrandboostFeedback($campaignID);
        //pre($oFeedbacks);
        if(!empty($oFeedbacks)){
            foreach($oFeedbacks as $oReview){
                if($oReview->category == 'Positive' && !empty($oReview->subscriberId) && !in_array($oReview->subscriberId, $positiveSubscribers)){
                    //Positive Ratings
                    $positiveSubscribers[] = $oReview->subscriberId;
                }else if($oReview->category == 'Neutral' && !empty($oReview->subscriberId) && !in_array($oReview->subscriberId, $neutralSubscribers)){
                    $neutralSubscribers[] = $oReview->subscriberId;
                }else if($oReview->category == 'Negative' && !empty($oReview->subscriberId) && !in_array($oReview->subscriberId, $negativeSubscribers)){
                    $negativeSubscribers[] = $oReview->subscriberId;;
                }
            }
        }

        if ($segmentType == 'total-positive') {
            $aSubscribers = $positiveSubscribers;
        } else if ($segmentType == 'total-neutral') {
            $aSubscribers = $neutralSubscribers;
        } else if ($segmentType == 'total-negative') {
            $aSubscribers = $negativeSubscribers;
        }
        
        //pre($aSubscribers);

        if (!empty($aSubscribers)) {

            //get Existing subscirbers in the segement if any
            foreach ($aSubscribers as $subscriberID) {
                $str = '';
                if (!in_array($subscriberID, $aExistingSubsID)) {
                    $str = "(" . $userID . "," . $segmentID . "," . $subscriberID . "," . "'" . date("Y-m-d H:i:s") . "')";
                    $aSqlParam[] = $str;
                }
            }

            if (!empty($aSqlParam)) {
                $sql = "INSERT INTO `tbl_segments_users` (`user_id`, `segment_id`, `subscriber_id`, `created`) VALUES " . implode(",", $aSqlParam);
                $result = DB::statement($sql);
                return true;

            }
        }

        return true;
    }
    
     /**
    * This function is used to add segment subscribers for nps feedback
    * @param type 
    * @return type
    */


    public function addSegmentSubscribersFromNPSFeedback($segmentID, $campaignID, $segmentType, $campaignType, $moduleName = '') {
        $detractorsSubscribers = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $oExistingSubscribers = array();
        $mNPS = new NpsModel();
        $oExistingSubscribers = $this->getSegmentCoreSubscribers($segmentID);
        if (!empty($oExistingSubscribers)) {
            foreach ($oExistingSubscribers as $oSubs) {
                $aExistingSubsID[] = $oSubs->subscriber_id;
            }
        }
        
        $oFeedbacks = $mNPS->getNPSScore($campaignID);
        //pre($oFeedbacks);
        if(!empty($oFeedbacks)){
            foreach($oFeedbacks as $oReview){
                if($oReview->score >8 && !empty($oReview->subscriberId) && !in_array($oReview->subscriberId, $promotorsSubscribers)){
                    //Positive Ratings
                    $promotorsSubscribers[] = $oReview->subscriberId;
                }else if($oReview->score < 9 && $oReview->score>6  && !empty($oReview->subscriberId) && !in_array($oReview->subscriberId, $passiveSubscribers)){
                    $passiveSubscribers[] = $oReview->subscriberId;
                }else if($oReview->score<7 && !empty($oReview->subscriberId) && !in_array($oReview->subscriberId, $detractorsSubscribers)){
                    $detractorsSubscribers[] = $oReview->subscriberId;;
                }
            }
        }

        if ($segmentType == 'total-promoters') {
            $aSubscribers = $promotorsSubscribers;
        } else if ($segmentType == 'total-passive') {
            $aSubscribers = $passiveSubscribers;
        } else if ($segmentType == 'total-detractors') {
            $aSubscribers = $detractorsSubscribers;
        }
        
        //pre($aSubscribers);

        if (!empty($aSubscribers)) {

            //get Existing subscirbers in the segement if any
            foreach ($aSubscribers as $subscriberID) {
                $str = '';
                if (!in_array($subscriberID, $aExistingSubsID)) {
                    $str = "(" . $userID . "," . $segmentID . "," . $subscriberID . "," . "'" . date("Y-m-d H:i:s") . "')";
                    $aSqlParam[] = $str;
                }
            }

            if (!empty($aSqlParam)) {
                $sql = "INSERT INTO `tbl_segments_users` (`user_id`, `segment_id`, `subscriber_id`, `created`) VALUES " . implode(",", $aSqlParam);
                $result = DB::statement($sql);
                 return true;
                
            }
        }

        return true;
    }

    /**
    * This function will returned CustomSendgridStats
    * @param type 
    * @return type
    */

    public function getCustomSendgridStats($moduleName, $param, $id, $eventType = '', $moduleEventID='', $sendingMethod) {
        if (empty($moduleName)) {
            return false;
        }
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_track_sendgrid';
                $filterField = 'brandboost_id';
                $subUserTable = 'tbl_brandboost_users';
                $mainTable = 'tbl_brandboost';
                $eventTable = 'tbl_brandboost_events';
                $campaignTable = 'tbl_campaigns';
                break;
            case "automation":
                $tableName = 'tbl_automations_emails_tracking_sendgrid';
                $filterField = 'automation_id';
                $subUserTable = 'tbl_automation_users';
                $mainTable = 'tbl_automations_emails';
                $eventTable = 'tbl_automations_emails_events';
                $campaignTable = 'tbl_automations_emails_campaigns';
                break;
            case "broadcast":
                $tableName = 'tbl_broadcast_emails_tracking_sendgrid';
                $filterField = 'broadcast_id';
                $subUserTable = 'tbl_broadcast_users';
                $mainTable = 'tbl_automations_emails';
                $eventTable = 'tbl_automations_emails_events';
                $campaignTable = ($sendingMethod == 'normal') ? 'tbl_automations_emails_campaigns' : 'tbl_broadcast_split_campaigns';
                break;
            case "referral":
                $tableName = 'tbl_referral_automations_tracking_sendgrid';
                $filterField = 'referral_id';
                $subUserTable = 'tbl_referral_users';
                $mainTable = 'tbl_referral_rewards';
                $eventTable = 'tbl_referral_automations_events';
                $campaignTable = 'tbl_referral_automations_campaigns';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_tracking_sendgrid';
                $filterField = 'nps_id';
                $subUserTable = 'tbl_nps_users';
                $mainTable = 'tbl_nps_main';
                $eventTable = 'tbl_nps_automations_events';
                $campaignTable = 'tbl_nps_automations_campaigns';
                break;
            default :
                $tableName = '';
                $filterField = '';
                $subUserTable = '';
                $mainTable = '';
                $eventTable = '';
                $campaignTable = '';
        }

        if (empty($tableName) || empty($filterField)) {
            return false;
        }
        //echo "Param Name is ". $param;
        $sql = "SELECT `$tableName`.*, `$subUserTable`.`subscriber_id` as global_subscriber_id FROM `$tableName` "
                . "LEFT JOIN `$mainTable` ON `$tableName`.`$filterField` = `$mainTable`.`id` "
                . "LEFT JOIN `$eventTable` ON `$tableName`.`event_id` = `$eventTable`.`id` "
                . "LEFT JOIN `$campaignTable` ON `$tableName`.`campaign_id`= `$campaignTable`.`id` "
                . "LEFT JOIN `$subUserTable` ON `$tableName`.`subscriber_id` = `$subUserTable`.`id` ";

        if ($param == $moduleName) {
            $sql .= "WHERE `$tableName`.`$filterField`='{$id}' ";
        } else if ($param == 'campaign') {
            $sql .= "WHERE `$tableName`.`campaign_id`='{$id}' ";
        } else if ($param == 'event_id') {
            $sql .= "WHERE `$tableName`.`event_id`='{$id}' ";
        } else if ($param == 'subscriber') {
            $sql .= "WHERE `$tableName`.`subscriber_id`='{$id}' ";
        } else {
            $sql .= "WHERE 1 ";
        }

        if ($eventType == 'open') {
            $sql .= "AND `$tableName`.`event_name`='open' ";
        } else if ($eventType == 'click') {
            $sql .= "AND `$tableName`.`event_name`='click' ";
        } else if ($eventType == 'processed') {
            $sql .= "AND `$tableName`.`event_name`='processed' ";
        } else if ($eventType == 'delivered') {
            $sql .= "AND `$tableName`.`event_name`='delivered' ";
        } else if ($eventType == 'bounce') {
            $sql .= "AND `$tableName`.`event_name`='bounce' ";
        } else if ($eventType == 'unsubscribe') {
            $sql .= "AND `$tableName`.`event_name`='unsubscribe' ";
        } else if ($eventType == 'dropped') {
            $sql .= "AND `$tableName`.`event_name`='dropped' ";
        } else if ($eventType == 'spam_report') {
            $sql .= "AND `$tableName`.`event_name`='spam_report' ";
        } else if ($eventType == 'group_resubscribe') {
            $sql .= "AND `$tableName`.`event_name`='group_resubscribe' ";
        } else if ($eventType == 'group_unsubscribe') {
            $sql .= "AND `$tableName`.`event_name`='group_unsubscribe' ";
        } else if ($eventType == 'deferred') {
            $sql .= "AND `$tableName`.`event_name`='deferred' ";
        }
        
        if(!empty($moduleEventID)){
            $sql .= "AND `$tableName`.`event_id`='$moduleEventID' ";
        }

        $sql .= "ORDER BY `$tableName`.`id` DESC";

        $result =  DB::select(DB::raw($sql));
        return $result;
    }


     /**
    * This function will returned CustomTwilioStats
    * @param type 
    * @return type
    */
   
    public function getCustomTwilioStats($moduleName, $param, $id, $eventType = '', $moduleEventID='', $sendingMethod='normal') {
        if (empty($moduleName)) {
            return false;
        }
        switch ($moduleName) {
            case "brandboost":
                $tableName = 'tbl_track_twillio';
                $filterField = 'brandboost_id';
                $subUserTable = 'tbl_brandboost_users';
                $mainTable = 'tbl_brandboost';
                $eventTable = 'tbl_brandboost_events';
                $campaignTable = 'tbl_campaigns';
                break;
            case "automation":
                $tableName = 'tbl_automations_emails_tracking_twillio';
                $filterField = 'automation_id';
                $subUserTable = 'tbl_automation_users';
                $mainTable = 'tbl_automations_emails';
                $eventTable = 'tbl_automations_emails_events';
                $campaignTable = 'tbl_automations_emails_campaigns';
                break;
            case "broadcast":
                $tableName = 'tbl_broadcast_emails_tracking_twillio';
                $filterField = 'broadcast_id';
                $subUserTable = 'tbl_broadcast_users';
                $mainTable = 'tbl_automations_emails';
                $eventTable = 'tbl_automations_emails_events';
                $campaignTable = ($sendingMethod == 'normal') ? 'tbl_automations_emails_campaigns' : 'tbl_broadcast_split_campaigns';
                break;
            case "referral":
                $tableName = 'tbl_referral_automations_tracking_twillio';
                $filterField = 'referral_id';
                $subUserTable = 'tbl_referral_users';
                $mainTable = 'tbl_referral_rewards';
                $eventTable = 'tbl_referral_automations_events';
                $campaignTable = 'tbl_referral_automations_campaigns';
                break;
            case "nps":
                $tableName = 'tbl_nps_automations_tracking_twillio';
                $filterField = 'nps_id';
                $subUserTable = 'tbl_nps_users';
                $mainTable = 'tbl_nps_main';
                $eventTable = 'tbl_nps_automations_events';
                $campaignTable = 'tbl_nps_automations_campaigns';
                break;
            default :
                $tableName = '';
                $filterField = '';
                $subUserTable = '';
                $mainTable = '';
                $eventTable = '';
                $campaignTable = '';
        }

        if (empty($tableName)) {
            return false;
        }
        $sql = "SELECT `$tableName`.*, `$subUserTable`.`subscriber_id` as global_subscriber_id FROM `$tableName` "
                . "LEFT JOIN `$mainTable` ON `$tableName`.`$filterField` = `$mainTable`.`id` "
                . "LEFT JOIN `$eventTable` ON `$tableName`.`event_id` = `$eventTable`.`id` "
                . "LEFT JOIN `$campaignTable` ON `$tableName`.`campaign_id`= `$campaignTable`.`id` "
                . "LEFT JOIN `$subUserTable` ON `$tableName`.`subscriber_id` = `$subUserTable`.`id` ";

        if ($param == $moduleName) {
            $sql .= "WHERE `$tableName`.`broadcast_id`='{$id}' ";
        } else if ($param == 'campaign') {
            $sql .= "WHERE `$tableName`.`campaign_id`='{$id}' ";
        } else if ($param == 'event_id') {
            $sql .= "WHERE `$tableName`.`event_id`='{$id}' ";
        } else if ($param == 'subscriber') {
            $sql .= "WHERE `$tableName`.`subscriber_id`='{$id}' ";
        } else {
            $sql .= "WHERE 1 ";
        }

        if ($eventType == 'accepted') {
            $sql .= "AND `$tableName`.`event_name`='accepted' ";
        } else if ($eventType == 'sent') {
            $sql .= "AND `$tableName`.`event_name`='sent' ";
        } else if ($eventType == 'delivered') {
            $sql .= "AND `$tableName`.`event_name`='delivered' ";
        } else if ($eventType == 'undelivered') {
            $sql .= "AND `$tableName`.`event_name`='undelivered' ";
        } else if ($eventType == 'failed') {
            $sql .= "AND `$tableName`.`event_name`='failed' ";
        } else if ($eventType == 'receiving') {
            $sql .= "AND `$tableName`.`event_name`='receiving' ";
        } else if ($eventType == 'received') {
            $sql .= "AND `$tableName`.`event_name`='received' ";
        } else if ($eventType == 'queued') {
            $sql .= "AND `$tableName`.`event_name`='queued' ";
        } else if ($eventType == 'sending') {
            $sql .= "AND `$tableName`.`event_name`='sending' ";
        }
        
        if(!empty($moduleEventID)){
            $sql .= "AND `$tableName`.`event_id`='$moduleEventID' ";
        }

        $sql .= "ORDER BY `$tableName`.`id` DESC";

       $result =  DB::select(DB::raw($sql));
      return $result;
    }

   
     /**
    * This function will returned SGCategorizedStats
    * @param type 
    * @return type
    */

    public function getSGCategorizedStats($oData, $oneDayOldData = false) {
        $recent = strtotime('-24 hours');
        if (!empty($oData)) {
            $openUniqueCount= array();
            $clickUniqueCount=array();
            $processedUniqueCount=array();
            $deliveredUniqueCount=array();
            $bounceUniqueCount=array();
            $unsubscribeUniqueCount=array();
            $unsubscribeUniqueCount=array();
            $droppedUniqueCount=array();
            $spamUniqueCount=array();
            $groupResubscribeUniqueCount=array();
            $groupUnsubscribeUniqueCount=array();
            $deferredUniqueCount=array();
            $otherUniqueCount=array();
            $openTotalCount = array();
            $clickUniqueCount =array();
            $openUniqueCount = array();
            $clickTotalCount=array();
            $processedTotalCount =array();
            $bounceTotalCount = array();
            $unsubscribeTotalCount =array();
            $droppedTotalCount = array();
            $spamTotalCount = array();
            $groupResubscribeTotalCount = array();
            $groupUnsubscribeTotalCount = array();
            $deferredTotalCount = array();
            $otherTotalCount = array();
            $otherDuplicateCount = array();
            $deliveredTotalCount = array();

            $openCount = $clickCount = $processedCount = $deliveredCount = $bounceCount = $unsubscribeCount = $droppedCount = $spamCount = $groupResubscribeCount = $groupUnsubscribeCount = $deferredCount = array();
            $openDuplicateCount = $clickDuplicateCount = $processedDuplicateCount = $deliveredDuplicateCount = $bounceDuplicateCount = $unsubscribeDuplicateCount = $droppedDuplicateCount = $spamDuplicateCount = $groupResubscribeDuplicateCount = $groupUnsubscribeDuplicateCount = $deferredDuplicateCount = array();
            foreach ($oData as $oRow) {
                $bIterate = true;
                if ($oneDayOldData == true) {
                    $bIterate = false;
                    if (strtotime($oRow->created) > $recent) {
                        $bIterate = true;
                    }
                }

                if ($bIterate == true) {

                    if ($oRow->event_name == 'open') {
                        $openTotalCount[] = $oRow;
                        if ($this->checkIfDuplicateExistsInStats($oRow, $openUniqueCount) == true) {
                            $openDuplicateCount[] = $oRow;
                        } else {
                            $openUniqueCount[] = $oRow;
                        }
                    } else if ($oRow->event_name == 'click') {
                        $clickTotalCount[] = $oRow;
                        if ($this->checkIfDuplicateExistsInStats($oRow, $clickUniqueCount) == true) {
                            $clickDuplicateCount[] = $oRow;
                        } else {
                            $clickUniqueCount[] = $oRow;
                        }
                    } else if ($oRow->event_name == 'processed') {
                        $processedTotalCount[] = $oRow;
                        if ($this->checkIfDuplicateExistsInStats($oRow, $processedUniqueCount) == true) {
                            $processedDuplicateCount[] = $oRow;
                        } else {
                            $processedUniqueCount[] = $oRow;
                        }
                    } else if ($oRow->event_name == 'delivered') {
                        $deliveredTotalCount[] = $oRow;
                        if ($this->checkIfDuplicateExistsInStats($oRow, $deliveredUniqueCount) == true) {
                            $deliveredDuplicateCount[] = $oRow;
                        } else {
                            $deliveredUniqueCount[] = $oRow;
                        }
                    } else if ($oRow->event_name == 'bounce') {
                        $bounceTotalCount[] = $oRow;
                        if ($this->checkIfDuplicateExistsInStats($oRow, $bounceUniqueCount) == true) {
                            $bounceDuplicateCount[] = $oRow;
                        } else {
                            $bounceUniqueCount[] = $oRow;
                        }
                    } else if ($oRow->event_name == 'unsubscribe') {
                        $unsubscribeTotalCount[] = $oRow;
                        if ($this->checkIfDuplicateExistsInStats($oRow, $unsubscribeUniqueCount) == true) {
                            $unsubscribeDuplicateCount[] = $oRow;
                        } else {
                            $unsubscribeUniqueCount[] = $oRow;
                        }
                    } else if ($oRow->event_name == 'dropped') {
                        $droppedTotalCount[] = $oRow;
                        if ($this->checkIfDuplicateExistsInStats($oRow, $droppedUniqueCount) == true) {
                            $droppedDuplicateCount[] = $oRow;
                        } else {
                            $droppedUniqueCount[] = $oRow;
                        }
                    } else if ($oRow->event_name == 'spam_report') {
                        $spamTotalCount[] = $oRow;
                        if ($this->checkIfDuplicateExistsInStats($oRow, $spamUniqueCount) == true) {
                            $spamDuplicateCount[] = $oRow;
                        } else {
                            $spamUniqueCount[] = $oRow;
                        }
                    } else if ($oRow->event_name == 'group_resubscribe') {
                        $groupResubscribeTotalCount[] = $oRow;
                        if ($this->checkIfDuplicateExistsInStats($oRow, $groupResubscribeUniqueCount) == true) {
                            $groupResubscribeDuplicateCount[] = $oRow;
                        } else {
                            $groupResubscribeUniqueCount[] = $oRow;
                        }
                    } else if ($oRow->event_name == 'group_unsubscribe') {
                        $groupUnsubscribeTotalCount[] = $oRow;
                        if ($this->checkIfDuplicateExistsInStats($oRow, $groupUnsubscribeUniqueCount) == true) {
                            $groupUnsubscribeDuplicateCount[] = $oRow;
                        } else {
                            $groupUnsubscribeUniqueCount[] = $oRow;
                        }
                    } else if ($oRow->event_name == 'deferred') {
                        $deferredTotalCount[] = $oRow;
                        if ($this->checkIfDuplicateExistsInStats($oRow, $deferredUniqueCount) == true) {
                            $deferredDuplicateCount[] = $oRow;
                        } else {
                            $deferredUniqueCount[] = $oRow;
                        }
                    } else {
                        $otherTotalCount[] = $oRow;
                        if ($this->checkIfDuplicateExistsInStats($oRow, $otherUniqueCount) == true) {
                            $otherDuplicateCount[] = $oRow;
                        } else {
                            $otherUniqueCount[] = $oRow;
                        }
                    }
                }
            }
        }
        //Okay Now print result
        $aCatogerizedData = array(
            'open' => array(
                'TotalCount' => count($openTotalCount),
                'UniqueCount' => count($openUniqueCount),
                'DuplicateCount' => count($openDuplicateCount),
                'totalData' => $openTotalCount,
                'UniqueData' => $openUniqueCount,
                'DuplicateData' => $openDuplicateCount
            ),
            'click' => array(
                'TotalCount' => count($clickTotalCount),
                'UniqueCount' => count($clickUniqueCount),
                'DuplicateCount' => count($clickDuplicateCount),
                'totalData' => $clickTotalCount,
                'UniqueData' => $clickUniqueCount,
                'DuplicateData' => $clickDuplicateCount
            ),
            'processed' => array(
                'TotalCount' => count($processedTotalCount),
                'UniqueCount' => count($processedUniqueCount),
                'DuplicateCount' => count($processedDuplicateCount),
                'totalData' => $processedTotalCount,
                'UniqueData' => $processedUniqueCount,
                'DuplicateData' => $processedDuplicateCount
            ),
            'delivered' => array(
                'TotalCount' => count($deliveredTotalCount),
                'UniqueCount' => count($deliveredUniqueCount),
                'DuplicateCount' => count($deliveredDuplicateCount),
                'totalData' => $deliveredTotalCount,
                'UniqueData' => $deliveredUniqueCount,
                'DuplicateData' => $deliveredDuplicateCount
            ),
            'bounce' => array(
                'TotalCount' => count($bounceTotalCount),
                'UniqueCount' => count($bounceUniqueCount),
                'DuplicateCount' => count($bounceDuplicateCount),
                'totalData' => $bounceTotalCount,
                'UniqueData' => $bounceUniqueCount,
                'DuplicateData' => $bounceDuplicateCount
            ),
            'unsubscribe' => array(
                'TotalCount' => count($unsubscribeTotalCount),
                'UniqueCount' => count($unsubscribeUniqueCount),
                'DuplicateCount' => count($unsubscribeDuplicateCount),
                'totalData' => $unsubscribeTotalCount,
                'UniqueData' => $unsubscribeUniqueCount,
                'DuplicateData' => $unsubscribeDuplicateCount
            ),
            'dropped' => array(
                'TotalCount' => count($droppedTotalCount),
                'UniqueCount' => count($droppedUniqueCount),
                'DuplicateCount' => count($droppedDuplicateCount),
                'totalData' => $droppedTotalCount,
                'UniqueData' => $droppedUniqueCount,
                'DuplicateData' => $droppedDuplicateCount
            ),
            'spam_report' => array(
                'TotalCount' => count($spamTotalCount),
                'UniqueCount' => count($spamUniqueCount),
                'DuplicateCount' => count($spamDuplicateCount),
                'totalData' => $spamTotalCount,
                'UniqueData' => $spamUniqueCount,
                'DuplicateData' => $spamDuplicateCount
            ),
            'group_resubscribe' => array(
                'TotalCount' => count($groupResubscribeTotalCount),
                'UniqueCount' => count($groupResubscribeUniqueCount),
                'DuplicateCount' => count($groupResubscribeDuplicateCount),
                'totalData' => $groupResubscribeTotalCount,
                'UniqueData' => $groupResubscribeUniqueCount,
                'DuplicateData' => $groupResubscribeDuplicateCount
            ),
            'group_unsubscribe' => array(
                'TotalCount' => count($groupUnsubscribeTotalCount),
                'UniqueCount' => count($groupUnsubscribeUniqueCount),
                'DuplicateCount' => count($groupUnsubscribeDuplicateCount),
                'totalData' => $groupUnsubscribeTotalCount,
                'UniqueData' => $groupUnsubscribeUniqueCount,
                'DuplicateData' => $groupUnsubscribeDuplicateCount
            ),
            'deferred' => array(
                'TotalCount' => count($deferredTotalCount),
                'UniqueCount' => count($deferredUniqueCount),
                'DuplicateCount' => count($deferredDuplicateCount),
                'totalData' => $deferredTotalCount,
                'UniqueData' => $deferredUniqueCount,
                'DuplicateData' => $deferredDuplicateCount
            ),
            'other' => array(
                'TotalCount' => count($otherTotalCount),
                'UniqueCount' => count($otherUniqueCount),
                'DuplicateCount' => count($otherDuplicateCount),
                'totalData' => $otherTotalCount,
                'UniqueData' => $otherUniqueCount,
                'DuplicateData' => $otherDuplicateCount
            )
        );

        return $aCatogerizedData;
    }


    /**
    * This function will returned CategorizedStats
    * @param type 
    * @return type
    */

    public function getTwiCategorizedStats($oData) {

        $sentUniqueCount =  array();
        $sentDuplicateCount =  array();
        $acceptedUniqueCount=  array();
        $deliveredUniqueCount=  array();
        $deliveredDuplicateCount=  array();
        $undeliveredUniqueCount=  array();
        $failedTotalCount=  array();
        $failedDuplicateCount=  array();
        $receivingUniqueCount=  array();
        $receivingDuplicateCount=  array();
        $receivedUniqueCount=  array();
        $receivedDuplicateCount=  array();
        $queuedUniqueCount=  array();
        $queuedDuplicateCount=  array();
        $sendingUniqueCount=  array();
        $sendingDuplicateCount=  array();
        $otherUniqueCount=  array();
        $otherDuplicateCount=array();
        $acceptedTotalCount = array();
        $acceptedDuplicateCount= array();
        $deliveredTotalCount= array();
        $undeliveredTotalCount =  array();
        $undeliveredDuplicateCount= array();
        $failedUniqueCount=array();
        $receivingTotalCount = array();
        $receivedTotalCount  = array();
        $queuedTotalCount = array();
        $sendingTotalCount = array();
        $otherTotalCount = array();


        if (!empty($oData)) {

            foreach ($oData as $oRow) {

                if ($oRow->event_name == 'accepted') {
                    $acceptedTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInStats($oRow, $acceptedUniqueCount) == true) {
                        $acceptedDuplicateCount[] = $oRow;
                    } else {
                        $acceptedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'sent') {
                    $sentTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInStats($oRow, $sentUniqueCount) == true) {
                        $sentDuplicateCount[] = $oRow;
                    } else {
                        $sentUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'delivered') {
                    $deliveredTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInStats($oRow, $deliveredUniqueCount) == true) {
                        $deliveredDuplicateCount[] = $oRow;
                    } else {
                        $deliveredUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'undelivered') {
                    $undeliveredTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInStats($oRow, $undeliveredUniqueCount) == true) {
                        $undeliveredDuplicateCount[] = $oRow;
                    } else {
                        $undeliveredUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'failed') {
                    $failedTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInStats($oRow, $failedUniqueCount) == true) {
                        $failedDuplicateCount[] = $oRow;
                    } else {
                        $failedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'receiving') {
                    $receivingTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInStats($oRow, $receivingUniqueCount) == true) {
                        $receivingDuplicateCount[] = $oRow;
                    } else {
                        $receivingUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'received') {
                    $receivedTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInStats($oRow, $receivedUniqueCount) == true) {
                        $receivedDuplicateCount[] = $oRow;
                    } else {
                        $receivedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'queued') {
                    $queuedTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInStats($oRow, $queuedUniqueCount) == true) {
                        $queuedDuplicateCount[] = $oRow;
                    } else {
                        $queuedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'sending') {
                    $sendingTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInStats($oRow, $sendingUniqueCount) == true) {
                        $sendingDuplicateCount[] = $oRow;
                    } else {
                        $sendingUniqueCount[] = $oRow;
                    }
                } else {
                    $otherTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInStats($oRow, $otherUniqueCount) == true) {
                        $otherDuplicateCount[] = $oRow;
                    } else {
                        $otherUniqueCount[] = $oRow;
                    }
                }
            }
        }
        //Okay Now print result
        $aCatogerizedData = array(
            'accepted' => array(
                'TotalCount' => count($acceptedTotalCount),
                'UniqueCount' => count($acceptedUniqueCount),
                'DuplicateCount' => count($acceptedDuplicateCount),
                'totalData' => $acceptedTotalCount,
                'UniqueData' => $acceptedUniqueCount,
                'DuplicateData' => $acceptedDuplicateCount
            ),
            'sent' => array(
                'TotalCount' => count($sentTotalCount),
                'UniqueCount' => count($sentUniqueCount),
                'DuplicateCount' => count($sentDuplicateCount),
                'totalData' => $sentTotalCount,
                'UniqueData' => $sentUniqueCount,
                'DuplicateData' => $sentDuplicateCount
            ),
            'delivered' => array(
                'TotalCount' => count($deliveredTotalCount),
                'UniqueCount' => count($deliveredUniqueCount),
                'DuplicateCount' => count($deliveredDuplicateCount),
                'totalData' => $deliveredTotalCount,
                'UniqueData' => $deliveredUniqueCount,
                'DuplicateData' => $deliveredDuplicateCount
            ),
            'undelivered' => array(
                'TotalCount' => count($undeliveredTotalCount),
                'UniqueCount' => count($undeliveredUniqueCount),
                'DuplicateCount' => count($undeliveredDuplicateCount),
                'totalData' => $undeliveredTotalCount,
                'UniqueData' => $undeliveredUniqueCount,
                'DuplicateData' => $undeliveredDuplicateCount
            ),
            'failed' => array(
                'TotalCount' => count($failedTotalCount),
                'UniqueCount' => count($failedUniqueCount),
                'DuplicateCount' => count($failedDuplicateCount),
                'totalData' => $failedTotalCount,
                'UniqueData' => $failedUniqueCount,
                'DuplicateData' => $failedDuplicateCount
            ),
            'receiving' => array(
                'TotalCount' => count($receivingTotalCount),
                'UniqueCount' => count($receivingUniqueCount),
                'DuplicateCount' => count($receivingDuplicateCount),
                'totalData' => $receivingTotalCount,
                'UniqueData' => $receivingUniqueCount,
                'DuplicateData' => $receivingDuplicateCount
            ),
            'received' => array(
                'TotalCount' => count($receivedTotalCount),
                'UniqueCount' => count($receivedUniqueCount),
                'DuplicateCount' => count($receivedDuplicateCount),
                'totalData' => $receivedTotalCount,
                'UniqueData' => $receivedUniqueCount,
                'DuplicateData' => $receivedDuplicateCount
            ),
            'queued' => array(
                'TotalCount' => count($queuedTotalCount),
                'UniqueCount' => count($queuedUniqueCount),
                'DuplicateCount' => count($queuedDuplicateCount),
                'totalData' => $queuedTotalCount,
                'UniqueData' => $queuedUniqueCount,
                'DuplicateData' => $queuedDuplicateCount
            ),
            'sending' => array(
                'TotalCount' => count($sendingTotalCount),
                'UniqueCount' => count($sendingUniqueCount),
                'DuplicateCount' => count($sendingDuplicateCount),
                'totalData' => $sendingTotalCount,
                'UniqueData' => $sendingUniqueCount,
                'DuplicateData' => $sendingDuplicateCount
            ),
            'other' => array(
                'TotalCount' => count($otherTotalCount),
                'UniqueCount' => count($otherUniqueCount),
                'DuplicateCount' => count($otherDuplicateCount),
                'totalData' => $otherTotalCount,
                'UniqueData' => $otherUniqueCount,
                'DuplicateData' => $otherDuplicateCount
            )
        );

        return $aCatogerizedData;
    }



     /**
    * This function is performed duplicate check for the given array
    * @param type $aSearch
    * @param type $tableData
    * @return type
    */

    public function checkIfDuplicateExistsInStats($aSearch, $tableData) {
        if (!empty($tableData)) {
            foreach ($tableData as $oData) {
                if ($oData->subscriber_id == $aSearch->subscriber_id && $oData->campaign_id == $aSearch->campaign_id) {
                    return true;
                }
            }
            return false;
        }
    }

    /**
    * This function is used to get the automation lists 
    * @param type $automationID
    * @return type
    */

    public function getAutomationLists($automationID) {
        $aData =  DB::table('tbl_automations_emails_lists')
        ->where('automation_id', $automationID)->get();
        return  $aData;
       
    }
    


    /**
    * This function is used to get all the segments 
    * @param type $userID
     * @param type $id
    * @return type
    */

    public function getSegments($userID, $id = '') {
        $aData =  DB::table('tbl_segments')
        ->when(!empty($userID), function($query) use ($userID){
        return $query->where('tbl_segments.user_id', $userID);
        })
        ->when(!empty($id), function($query) use ($id){
        return $query->where("tbl_segments.id", $id);
        })->get();
       
        return $aData;
    }


}

?>