<?php

namespace App\Models\Admin\Modules;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class NpsModel extends Model {

    /**
     * Get Member's list of all NPS widgets
     * @param type $userID
     * @param type $id
     * @return type
     */
    public static function getNPSWidgets($userID, $id = '') {

        $oData = DB::table('tbl_nps_widgets')
                ->where('delete_status', 0)
                ->where('user_id', $userID)
                ->when(!empty($id), function ($query) use ($id) {
                    return $query->where('id', $id);
                })
                ->orderBy('id', 'desc')
                //->get();
                ->paginate(10);

        return $oData;
    }

    /**
     * Used to get nps widget list by user id
     * @param type $userID
     * @return type
     */
    public function getNpsLists($userID) {
        $aData = DB::table('tbl_nps_main')
                ->select('tbl_nps_main.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile')
                ->join('tbl_users', 'tbl_nps_main.user_id', '=', 'tbl_users.id')
                ->where('tbl_nps_main.user_id', $userID)
                ->orderBy('id', 'Desc')
                //->get();
                ->paginate();

        return $aData;
    }

    /**
     * Used to get my user by survey info
     * @param type $accountID
     * @return type
     */
    public static function getMyUsers($accountID) {
        $oNPS = self::getSurveyInfoByRef($accountID);

        $npsID = $oNPS->id;
        if ($npsID > 0) {
            $aData = DB::table('tbl_nps_campaign_users')
                    ->select('tbl_nps_campaign_users.*', 'tbl_subscribers.email', 'tbl_subscribers.firstname', 'tbl_subscribers.lastname', 'tbl_subscribers.phone', 'tbl_subscribers.status AS globalStatus', 'tbl_subscribers.facebook_profile', 'tbl_subscribers.twitter_profile', 'tbl_subscribers.linkedin_profile', 'tbl_subscribers.instagram_profile', 'tbl_subscribers.socialProfile', 'tbl_subscribers.id AS global_user_id')
                    ->join('tbl_subscribers', 'tbl_nps_campaign_users.subscriber_id', '=', 'tbl_subscribers.id')
                    ->where('tbl_nps_campaign_users.nps_id', $npsID)
                    ->get();

            return $aData;
        }
    }

    /**
     * Used to get survey info by refKey
     * @param type $refKey
     * @return type
     */
    public static function getSurveyInfoByRef($refKey) {
        $aData = DB::table('tbl_nps_main')
                ->where('hashcode', $refKey)
                ->first();

        return $aData;
    }

    /**
     * Get nps list by date
     * @param type $userID
     * @return type
     */
    public function getNpsListsByDate($userID) {
        $oData = DB::table('tbl_nps_main')
                ->where('user_id', $userID)
                ->select('tbl_nps_main.*', DB::raw('COUNT(created) as createdTotal'))
                ->groupBy(DB::raw('DATE(created)'))
                ->get();
        return $oData;
    }


    /**
     * get nps campaign details
     * @param type $userID
     * @param type $id
     * @return type
     */
    public function getNps($userID, $id = '') {
        $oData = DB::table('tbl_nps_main')
                ->where('user_id', $userID)
                ->when(!empty($id), function($query) use($id) {
                    return $query->where('id', $id);
                })
                ->first();
        return $oData;
    }

    /**
     * Used to add new nps campaign
     * @param type $aData
     * @return boolean
     */
    public function addNPS($aData) {
        $insert_id = DB::table('tbl_nps_main')->insertGetId($aData);
        return $insert_id;
    }

    /**
     * Used to create nps widget
     * @param type $aData
     * @return boolean
     */
    public function createNPSWidget($aData) {
        $insert_id = DB::table('tbl_nps_widgets')->insertGetId($aData);
        return $insert_id;
    }

    /**
     * Used to update nps widget data
     * @param type $aData
     * @param type $id
     * @return boolean
     */
    public function updateNPSWidget($aData, $id) {
        $result = DB::table('tbl_nps_widgets')
                ->where('id', $id)
                ->update($aData);
        return true;
    }

    /**
     * Used to save NPS campaign events
     * @param type $eData
     * @param type $npsID
     * @return boolean
     */
    public function saveNPSEvents($eData, $npsID) {
        if ($npsID != '') {
            //Invite Email
            $aData = array(
                'nps_id' => $npsID,
                'event_type' => 'invite-email',
                'data' => $eData['invite-email'],
                'previous_event_id' => 0,
                'created' => date("Y-m-d H:i:s ")
            );
            $inviteEmailInsertID = DB::table('tbl_nps_automations_events')->insertGetId($aData);

            //Invite SMS
            $aData = array(
                'nps_id' => $npsID,
                'event_type' => 'invite-sms',
                'data' => $eData['invite-sms'],
                'previous_event_id' => $inviteEmailInsertID,
                'created' => date("Y-m-d H:i:s ")
            );

            $inviteSMSInsertID = DB::table('tbl_nps_automations_events')->insertGetId($aData);

            //Reminder Email
            $aData = array(
                'nps_id' => $npsID,
                'event_type' => 'reminder-email',
                'data' => $eData['reminder-email'],
                'previous_event_id' => $inviteSMSInsertID,
                'created' => date("Y-m-d H:i:s ")
            );

            $reminderEmailInsertID = DB::table('tbl_nps_automations_events')->insertGetId($aData);

            //Reminder SMS
            $aData = array(
                'nps_id' => $npsID,
                'event_type' => 'reminder-sms',
                'data' => $eData['reminder-sms'],
                'previous_event_id' => $reminderEmailInsertID,
                'created' => date("Y-m-d H:i:s ")
            );

            $reminderSMSInsertID = DB::table('tbl_nps_automations_events')->insertGetId($aData);

            $oTemplates = $this->getDefaultNPSTemplates();
            if (!empty($oTemplates)) {
                foreach ($oTemplates as $oTemplate) {

                    $templateName = $oTemplate->template_name;
                    $templateType = $oTemplate->template_type;
                    $subject = $oTemplate->template_subject;
                    $content = $oTemplate->template_content;

                    if ($templateName == 'Email Invite') {
                        $eventID = $inviteEmailInsertID;
                    } else if ($templateName == 'SMS Invite') {
                        $eventID = $inviteSMSInsertID;
                    } else if ($templateName == 'Email Reminder') {
                        $eventID = $reminderEmailInsertID;
                    } else if ($templateName == 'SMS Reminder') {
                        $eventID = $reminderSMSInsertID;
                    }

                    $tempData = array(
                        'event_id' => $eventID,
                        'content_type' => ($templateType == 'email') ? 'Regular Html' : 'Plain Text',
                        'campaign_type' => ($templateType == 'email') ? 'Email' : 'Sms',
                        'name' => $templateName,
                        'subject' => $subject,
                        'greeting' => $oTemplate->greeting,
                        'introduction' => $oTemplate->introduction,
                        'html' => $content,
                        'status' => 'draft',
                        'created' => date("Y-m-d H:i:s")
                    );

                    $this->insertNPSCampaigns($tempData);
                }
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to get NPS campaign
     * @param type $id
     * @return boolean
     */
    public function getNPSCampaign($id) {
        $oData = DB::table('tbl_nps_automations_campaigns')
                ->where('id', $id)
                ->get();
        return $oData;
    }

    /**
     * Used to get NPS events
     * @param type $npsID
     * @return boolean
     */
    public function getNPSEvents($npsID) {
        $oData = DB::table('tbl_nps_automations_events')
                ->where('nps_id', $npsID)
                ->orderBy('id', 'asc')
                ->get();
        return $oData;
    }

    /**
     * Get Nps events by various parameters
     * @param type $npsID
     * @param type $eventType
     * @return boolean
     */
    public function getNPSEventsByNPSIdEventType($npsID, $eventType = '') {
        $oData = DB::table('tbl_nps_automations_events')
                ->where('nps_id', $npsID)
                ->when(!empty($eventType), function ($query) use ($eventType) {
                    return $query->where('event_type', $eventType);
                })
                ->get();
        return $oData;
    }

    /**
     * Used to get end campaign for the nps campaign
     * @param type $npsID
     * @return boolean
     */
    public function getNPSEndCampaigns($npsID) {
        $oData = DB::table('tbl_nps_automations_campaigns')
                ->leftJoin('tbl_nps_automations_events', 'tbl_nps_automations_events.id', '=', 'tbl_nps_automations_campaigns.event_id')
                ->select('tbl_nps_automations_campaigns.*')
                ->where('tbl_nps_automations_events.nps_id', $npsID)
                ->where('tbl_nps_automations_campaigns.delete_status', 0)
                ->get();
        return $oData;
    }

    /**
     * Use to get nps campaign by event id
     * @param type $eventID
     * @return boolean
     */
    public function getCampaignsByEventID($eventID) {
        $oData = DB::table('tbl_nps_automations_campaigns')
                ->where('event_id', $eventID)
                ->where('delete_status', 0)
                ->get();
        return $oData;
    }

    /**
     * Get nps default templates
     * @return boolean
     */
    public function getDefaultNPSTemplates() {
        $oData = DB::table('tbl_nps_automations_templates')
                ->where('user_id', 0)
                ->where('status', 'active')
                ->get();
        return $oData;
    }

    /**
     * Add new nps end campaign
     * @param type $tempData
     * @return boolean
     */
    public function insertNPSCampaigns($tempData) {
        $insert_id = DB::table('tbl_nps_automations_campaigns')->insertGetId($aData);
        return $insert_id;
    }

    /**
     * Used to update user campaign
     * @param type $aData
     * @param type $id
     * @return boolean
     */
    public function updateUserCampaign($aData, $id) {
        $result = DB::table('tbl_nps_automations_campaigns')
                ->where('id', $id)
                ->update($aData);
        return true;
    }

    /**
     * Update campaign by event id
     * @param type $aData
     * @param type $eventId
     * @param type $type
     * @param type $templateSourceID
     * @return boolean
     */
    public function updateCampaignByEventId($aData, $eventId, $type = '', $templateSourceID = '') {
        $result = DB::table('tbl_nps_automations_campaigns')
                ->where('event_id', $eventId)
                ->when(!empty($type), function($query) use ($type) {
                    return $query->where('campaign_type', $type);
                })
                ->when(($templateSourceID > 0), function($query) use ($templateSourceID) {
                    return $query->where('template_source', $templateSourceID);
                })
                ->update($aData);
        return true;
    }

    /**
     * Used to update nps campaign event
     * @param type $aData
     * @param type $id
     * @return boolean
     */
    public function updateEvent($aData, $id) {
        $result = DB::table('tbl_nps_automations_events')
                ->where('id', $id)
                ->update($aData);
        return true;
    }

    /**
     * Used to update NPS campaign
     * @param type $aData
     * @param type $userID
     * @param type $id
     * @return boolean
     */
    public function updateNPS($aData, $userID, $id) {
        $result = DB::table('tbl_nps_main')
                ->where('id', $id)
                ->where('user_id', $userID)
                ->update($aData);
        return $id;
    }

    /**
     * Deletes NPS campaign
     * @param type $userID
     * @param type $id
     * @return boolean
     */
    public function deleteNPS($userID, $id) {
        $result = DB::table('tbl_nps_main')
                ->where('id', $id)
                ->where('user_id', $userID)
                ->delete();
        return true;
    }

    /**
     * Update survery feedback
     * @param type $aData
     * @param type $id
     * @return boolean
     */
    public function updateSurveyFeedback($aData, $id) {
        $result = DB::table('tbl_nps_score')
                ->where('id', $id)
                ->update($aData);
        return true;
    }

    /**
     * Used to save survey feedback
     * @param type $aData
     * @return type
     */
    public function saveSurveyFeedback($aData) {
        $refKey = $aData['refkey'];
        $ip = $aData['ip_address'];
        $subscriberID = $aData['subscriber_id'];
        $oSurvery = $this->checkIfRecordedSurvey($refKey, $ip, $subscriberID);
        if (!empty($oSurvery)) {
            $responseID = $oSurvery->id;
            if ($responseID > 0) {
                //Update
                $result = $this->updateSurveyFeedback($aData, $responseID);
            }
        } else {
            //Insert
            $responseID = DB::table('tbl_nps_score')->insertGetId($aData);
        }
        return $responseID;
    }

    /**
     * Checks if survey was recorded
     * @param type $refkey
     * @param type $ip
     * @param type $subscriberID
     * @return type
     */
    public function checkIfRecordedSurvey($refkey, $ip, $subscriberID = '') {
        $oData = DB::table('tbl_nps_score')
                ->where('refkey', $refkey)
                ->where('ip_address', $ip)
                ->when(!empty($subscriberID), function ($query) use ($subscriberID) {
                    return $query->where('subscriber_id', $subscriberID);
                })
                ->first();
        return $oData;
    }

    /**
     * Used to get NPS program info
     * @param type $accountID
     * @return type
     */
    public function getNPSProgramInfo($accountID) {
        $oData = DB::table('tbl_nps_main')
                ->where('hashcode', $accountID)
                ->first();
        return $oData;
    }

    /**
     * Used to get NPS score
     * @param type $hashKey
     * @param type $userID
     * @return type
     */
    public function getNPSScore($hashKey = '', $userID = '') {

        $aData = DB::table('tbl_nps_score')
                        ->select('tbl_nps_score.*', 'tbl_nps_main.title as campaignTitle', 'tbl_nps_main.id as npsID', 'tbl_nps_main.platform', 'tbl_subscribers.email', 'tbl_subscribers.firstname', 'tbl_subscribers.lastname', 'tbl_subscribers.phone', 'tbl_subscribers.id AS subscriberId')
                        ->leftjoin('tbl_subscribers', 'tbl_nps_score.subscriber_id', '=', 'tbl_subscribers.id')
                        ->leftjoin('tbl_nps_main', 'tbl_nps_main.hashcode', '=', 'tbl_nps_score.refkey')
                        ->when(!empty($hashKey), function($query) use ($hashKey) {
                            return $query->where('tbl_nps_score.refkey', $hashKey);
                        })
                        ->when(!empty($userID), function($query) use ($userID) {
                            return $query->where('tbl_nps_main.user_id', $userID);
                        })
                        ->orderBy('tbl_nps_score.id', 'DESC')
                        //->get();
                        ->paginate();

        return $aData;
    }

    /**
     * get Nps score by user id
     * @param type $userId
     * @return type
     */
    public function getNPSScoreByUserId($userId = '') {
        $oData = DB::table('tbl_nps_score')
                ->leftJoin('tbl_subscribers', 'tbl_nps_score.subscriber_id', '=', 'tbl_subscribers.id')
                ->select('tbl_nps_score.*', 'tbl_subscribers.email', 'tbl_subscribers.firstname', 'tbl_subscribers.lastname', 'tbl_subscribers.phone', 'tbl_subscribers.id AS subscriberId')
                ->where('tbl_subscribers.user_id', $userId)
                ->orderBy('tbl_nps_score.id', 'desc')
                ->get();
        return $oData;
    }

    /**
     * Get NPS Score summery
     * @param type $refKey
     * @return object
     */
    public static function getNPSScoreSummery($refKey = '') {

        $response = "";
        $positive = $nuetral = $negative = 0;
        $pScore = $nScore = $negScore = 0;

        $response = DB::table('tbl_nps_score')
                ->when(!empty($refKey), function($query) use ($refKey) {
                    return $query->where('tbl_nps_score.refkey', $refKey);
                })
                ->get();

        //echo $this->db->last_query();
        if ($response->count() > 0) {
            if (!empty($response)) {
                foreach ($response as $oRec) {

                    if ($oRec->score > 8) {
                        $positive++;
                        $pScore += $oRec->score;
                    } else if ($oRec->score > 6 && $oRec->score < 9) {
                        //echo "yes , I am here";
                        $nuetral++;
                        $nScore += $oRec->score;
                    } else if ($oRec->score < 7) {
                        $negative++;
                        $negScore += $oRec->score;
                    }
                }
            }
        }

        $positiveScore = ($positive) ? $positive : 0;
        $nuetralScore = ($nuetral) ? $nuetral : 0;
        $negativeScore = ($negative) ? $negative : 0;
        $NPSScore = '';
        //$positiveGrand = ($pScore > 0) ? ($pScore / $positive) : 0;
        //$negativeGrand = ($negScore > 0) ? ($negScore / $negative) : 0;

        $aData = array(
            'Promoters' => $positiveScore,
            'Passive' => $nuetralScore,
            'Detractors' => $negativeScore,
            'NPSScore' => (count($response) > 0) ? (($pScore + $nScore + $negScore) * 10) / count($response) : 0
        );

        return $aData;
    }

    /**
     *
     * @param type $scoreID
     * @return typeused to get score details
     */
    public function getScoreDetails($scoreID) {
        $oData = DB::table('tbl_nps_score')
                ->leftJoin('tbl_nps_main', 'tbl_nps_main.hashcode', '=', 'tbl_nps_score.refkey')
                ->leftJoin('tbl_subscribers', 'tbl_nps_score.subscriber_id', '=', 'tbl_subscribers.id')
                ->select('tbl_nps_score.*', 'tbl_nps_main.title AS npstitle', 'tbl_subscribers.email', 'tbl_subscribers.firstname', 'tbl_subscribers.lastname', 'tbl_subscribers.phone')
                ->where('tbl_nps_score.id', $scoreID)
                ->first();
        return $oData;
    }

    /**
     *
     */
    public function getNPSSubscribers($accountID) {
        $oNPS = $this->getSurveyInfoByRef($accountID);
        $npsID = $oNPS->id;
        if ($npsID > 0) {

            $oData = DB::table('tbl_nps_campaign_users')
                    ->leftJoin('tbl_subscribers', 'tbl_nps_campaign_users.subscriber_id.subscriber_id', '=', 'tbl_subscribers.id')
                    ->select('tbl_subscribers.email', 'tbl_subscribers.firstname', 'tbl_subscribers.lastname', 'tbl_subscribers.phone')
                    ->where('tbl_nps_campaign_users.nps_id', $npsID)
                    ->orderBy('tbl_nps_campaign_users.id', 'desc')
                    ->get();
            return $oData->toArray();
        }

        return $response;
    }

    /**
     * Used to get NPS subscriber by subscriber id
     */
    public function getNPSSubscriberDataBySubId($subId) {
        $oData = DB::table('tbl_nps_users')
                ->leftJoin('tbl_subscribers', 'tbl_nps_users.subscriber_id', '=', 'tbl_subscribers.id')
                ->select('tbl_subscribers.email', 'tbl_subscribers.firstname', 'tbl_subscribers.lastname', 'tbl_subscribers.phone')
                ->where('tbl_nps_users.id', $subId)
                ->orderBy('tbl_nps_users.id', 'desc')
                ->first();
        return $oData;
    }

    /**
     *
     */
    public function getNPSNotes($id) {
        if (!empty($id)) {
            $oData = DB::table('tbl_nps_notes')
                    ->leftJoin('tbl_users', 'tbl_nps_notes.user_id', '=', 'tbl_users.id')
                    ->select('tbl_nps_notes.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email')
                    ->where('tbl_nps_notes.score_id', $id)
                    ->orderBy('tbl_nps_notes.id', 'desc')
                    ->get();
            return $oData;
        }
    }

    /**
     * Used to get Tags by score id
     * @param type $scoreID
     * @return type
     */
    public function getTagsByScoreID($scoreID) {
        $oData = DB::table('tbl_nps_tags')
                ->leftJoin('tbl_tag_groups_entity', 'tbl_tag_groups_entity.id', '=', 'tbl_nps_tags.tag_id')
                ->select('tbl_tag_groups_entity.*', 'tbl_nps_tags.tag_id', 'tbl_nps_tags.score_id')
                ->where('tbl_nps_tags.score_id', $scoreID)
                ->get();
        return $oData;
    }

    /**
     * Used to save NPS notes
     * @param type $aData
     * @return boolean
     */
    public function saveNPSNotes($aData) {
        $insert_id = DB::table('tbl_nps_notes')->insertGetId($aData);
        return $insert_id;
    }

    /**
     * Used to add NPS tags
     * @param type $aData
     * @return boolean
     */
    public function addNPSTag($aData) {
        $aTagIDs = $aData['aTagIDs'];
        if (!empty($aTagIDs)) {
            foreach ($aTagIDs as $iTagID) {
                $aInput = array(
                    'tag_id' => $iTagID,
                    'score_id' => $aData['score_id'],
                    'applied_tag_created' => date("Y-m-d H:i:s")
                );

                $tagData = $this->getTagByScoreIDTagID($iTagID, $aData['score_id']);
                if ($tagData->id == '') {
                    $result = $this->db->insert('tbl_nps_tags', $aInput);
                }

                $oTags = $this->getTagsByScoreID($aData['score_id']);
                foreach ($oTags as $oTag) {
                    if (in_array($oTag->tag_id, $aTagIDs)) {
                        $result = true;
                    } else {
                        $result = $this->deleteNPSTagByID($oTag->tag_id, $aData['score_id']);
                    }
                }
            }
        }

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to detete NPS tags By id
     * @param type $id
     * @param type $scoreID
     * @return boolean
     */
    public function deleteNPSTagByID($id, $scoreID) {
        $result = DB::table('tbl_nps_tags')
                ->where('tag_id', $id)
                ->where('score_id', $scoreID)
                ->delete();
        return true;
    }

    /**
     *
     * @param type $aTagID
     * @param type $scoreID
     * @return type
     */
    public function getTagByScoreIDTagID($aTagID, $scoreID) {
        $oData = DB::table('tbl_nps_tags')
                ->where('tag_id', $aTagID)
                ->where('score_id', $scoreID)
                ->first();
        return $oData;
    }

    /**
     * Used to remove NPS tags
     * @param type $tagID
     * @param type $scoreID
     * @return boolean
     */
    public function removeNPSTag($tagID, $scoreID) {
        $result = DB::table('tbl_nps_tags')
                ->where('tag_id', $tagID)
                ->where('score_id', $scoreID)
                ->delete();
        return true;
    }

    /**
     *
     * @param type $noteId
     * @return typeUsed to NPS Notes by note id
     */
    public function getNPSNoteByID($noteId) {
        $oData = DB::table('tbl_nps_notes')
                ->where('id', $noteId)
                ->get();
        return $oData;
    }

    /**
     * Used to delete NPS notes by id
     */
    public function deleteNPSNoteByID($noteId) {
        $result = DB::table('tbl_nps_notes')
                ->where('id', $noteId)
                ->delete();
        return true;
    }

    /**
     * Used to update NPS notes
     */
    public function updateNPSNote($aData, $noteId) {
        $result = DB::table('tbl_nps_notes')
                ->where('id', $noteId)
                ->update($aData);
        return true;
    }

    /**
     * Used to get Clients tags
     * @param type $userID
     * @return type
     */
    public function getClientTags($userID = 0) {
        $oData = DB::table('tbl_tag_groups')
                ->leftJoin('tbl_tag_groups_entity', 'tbl_tag_groups.id', '=', 'tbl_tag_groups_entity.group_id')
                ->select('tbl_tag_groups.*', 'tbl_tag_groups_entity.id AS tagid', 'tbl_tag_groups_entity.tag_name', 'tbl_tag_groups_entity.tag_created')
                ->when(($userID > 0), function ($query) use ($userID) {
                    return $query->where('tbl_tag_groups.user_id', $userID);
                })
                ->orderBy('tbl_tag_groups.id', 'desc')
                ->get();
        return $oData;
    }

    /**
     * Checks if users exists
     * @param type $subscriberID
     * @param type $accountID
     * @return type
     */
    public function checkIfExistingUser($subscriberID, $accountID = '') {
        $oData = DB::table('tbl_nps_users')
                ->where('subscriber_id', $subscriberID)
                ->when(!empty($accountID), function ($query) use ($accountID) {
                    return $query->where('account_id', $accountID);
                })
                ->first();
        return $oData;
    }

    /**
     * Used to add NPS users
     * @param type $aData
     * @return boolean
     */
    public function addNPSUser($aData) {
        $insert_id = DB::table('tbl_nps_users')->insertGetId($aData);
        return $insert_id;
    }

    /**
     * Used to get NPS user by id
     * @param type $userID
     * @return type
     */
    public function getNpsUserById($userID) {
        $oData = DB::table('tbl_nps_users')
                ->leftJoin('tbl_subscribers', 'tbl_nps_users.subscriber_id', '=', 'tbl_subscribers.id')
                ->select('tbl_nps_users.*', 'tbl_subscribers.email', 'tbl_subscribers.firstname', 'tbl_subscribers.lastname', 'tbl_subscribers.phone', 'tbl_subscribers.facebook_profile', 'tbl_subscribers.twitter_profile', 'tbl_subscribers.linkedin_profile','tbl_subscribers.instagram_profile', 'tbl_subscribers.socialProfile', 'tbl_subscribers.id AS global_user_id', 'tbl_subscribers.user_id AS bb_user_id')
                ->where('tbl_nps_users.id', $userID)
                ->get();
        return $oData;
    }

    /**
     * Used to update NPS users
     * @param type $aData
     * @param type $userID
     * @return boolean
     */
    public function updateNpsUser($aData, $userID) {
        $result = DB::table('tbl_nps_users')
                ->where('id', $userID)
                ->update($aData);
        return true;
    }

    /**
     * used to detete NPS user
     * @param type $userID
     * @return boolean
     */
    public function deleteNpsUser($userID) {
        $result = DB::table('tbl_nps_users')
                ->where('id', $userID)
                ->delete();
        return true;
    }

    /**
     * used to unsubscriber user
     * @param type $accountID
     * @param type $subscriberID
     * @return boolean
     */
    public function unsubscribeUser($accountID, $subscriberID) {
        $aData = array('status' => 0);
        $result = DB::table('tbl_nps_users')
                ->where('id', $subscriberID)
                ->where('account_id', $accountID)
                ->update($aData);
        return true;
    }

    /**
     * Used to get NPS sendgrid stats
     * @param type $param
     * @param type $id
     * @param type $eventType
     * @return type
     */
    public function getNPSSendgridStats($param, $id, $eventType = '') {
        $sql = "SELECT tbl_nps_automations_tracking_sendgrid.* FROM tbl_nps_automations_tracking_sendgrid "
                . "LEFT JOIN tbl_nps_main ON tbl_nps_automations_tracking_sendgrid.nps_id = tbl_nps_main.id "
                . "LEFT JOIN tbl_nps_automations_events ON tbl_nps_automations_tracking_sendgrid.event_id = tbl_nps_automations_events.id "
                . "LEFT JOIN tbl_nps_automations_campaigns ON tbl_nps_automations_tracking_sendgrid.campaign_id= tbl_nps_automations_campaigns.id "
                . "LEFT JOIN tbl_nps_users ON tbl_nps_automations_tracking_sendgrid.subscriber_id = tbl_nps_users.id ";

        if ($param == 'nps') {
            $sql .= "WHERE tbl_nps_automations_tracking_sendgrid.nps_id='{$id}' ";
        } else if ($param == 'campaign') {
            $sql .= "WHERE tbl_nps_automations_tracking_sendgrid.campaign_id='{$id}' ";
        } else if ($param == 'event') {
            $sql .= "WHERE tbl_nps_automations_tracking_sendgrid.event_id='{$id}' ";
        } else if ($param == 'subscriber') {
            $sql .= "WHERE tbl_nps_automations_tracking_sendgrid.subscriber_id='{$id}' ";
        } else {
            $sql .= "WHERE 1 ";
        }

        if ($eventType == 'open') {
            $sql .= "AND tbl_nps_automations_tracking_sendgrid.event_name='open' ";
        } else if ($eventType == 'click') {
            $sql .= "AND tbl_nps_automations_tracking_sendgrid.event_name='click' ";
        } else if ($eventType == 'processed') {
            $sql .= "AND tbl_nps_automations_tracking_sendgrid.event_name='processed' ";
        } else if ($eventType == 'delivered') {
            $sql .= "AND tbl_nps_automations_tracking_sendgrid.event_name='delivered' ";
        } else if ($eventType == 'bounce') {
            $sql .= "AND tbl_nps_automations_tracking_sendgrid.event_name='bounce' ";
        } else if ($eventType == 'unsubscribe') {
            $sql .= "AND tbl_nps_automations_tracking_sendgrid.event_name='unsubscribe' ";
        } else if ($eventType == 'dropped') {
            $sql .= "AND tbl_nps_automations_tracking_sendgrid.event_name='dropped' ";
        } else if ($eventType == 'spam_report') {
            $sql .= "AND tbl_nps_automations_tracking_sendgrid.event_name='spam_report' ";
        } else if ($eventType == 'group_resubscribe') {
            $sql .= "AND tbl_nps_automations_tracking_sendgrid.event_name='group_resubscribe' ";
        } else if ($eventType == 'group_unsubscribe') {
            $sql .= "AND tbl_nps_automations_tracking_sendgrid.event_name='group_unsubscribe' ";
        } else if ($eventType == 'deferred') {
            $sql .= "AND tbl_nps_automations_tracking_sendgrid.event_name='deferred' ";
        }

        $sql .= "ORDER BY tbl_nps_automations_tracking_sendgrid.id DESC";

        $oData = DB::select(DB::raw($sql));
        return $oData;

    }

    /**
     * Get sendgrid stats data
     * @param type $oData
     * @return array
     */
    public function getEmailSendgridCategorizedStatsData($oData) {

        if (!empty($oData)) {
            $openCount = $clickCount = $processedCount = $deliveredCount = $bounceCount = $unsubscribeCount = $droppedCount = $spamCount = $groupResubscribeCount = $groupUnsubscribeCount = $deferredCount = array();
            $openUniqueCount = $deliveredUniqueCount = $processedUniqueCount = $clickTotalCount = $clickUniqueCount = $bounceTotalCount = $bounceUniqueCount = $unsubscribeTotalCount = $unsubscribeUniqueCount = $droppedTotalCount = $droppedUniqueCount = $spamTotalCount = $spamUniqueCount = $groupResubscribeTotalCount = $groupResubscribeUniqueCount = $groupUnsubscribeTotalCount = $groupUnsubscribeUniqueCount = $deferredTotalCount = $deferredUniqueCount = $otherTotalCount = $otherUniqueCount = $otherDuplicateCount = $openTotalCount = $processedTotalCount = $deliveredTotalCount = array();
            $openDuplicateCount = $clickDuplicateCount = $processedDuplicateCount = $deliveredDuplicateCount = $bounceDuplicateCount = $unsubscribeDuplicateCount = $droppedDuplicateCount = $spamDuplicateCount = $groupResubscribeDuplicateCount = $groupUnsubscribeDuplicateCount = $deferredDuplicateCount = array();
            foreach ($oData as $oRow) {

                if ($oRow->event_name == 'open') {
                    $openTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $openUniqueCount) == true) {
                        $openDuplicateCount[] = $oRow;
                    } else {
                        $openUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'click') {
                    $clickTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $clickUniqueCount) == true) {
                        $clickDuplicateCount[] = $oRow;
                    } else {
                        $clickUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'processed') {
                    $processedTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $processedUniqueCount) == true) {
                        $processedDuplicateCount[] = $oRow;
                    } else {
                        $processedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'delivered') {
                    $deliveredTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $deliveredUniqueCount) == true) {
                        $deliveredDuplicateCount[] = $oRow;
                    } else {
                        $deliveredUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'bounce') {
                    $bounceTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $bounceUniqueCount) == true) {
                        $bounceDuplicateCount[] = $oRow;
                    } else {
                        $bounceUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'unsubscribe') {
                    $unsubscribeTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $unsubscribeUniqueCount) == true) {
                        $unsubscribeDuplicateCount[] = $oRow;
                    } else {
                        $unsubscribeUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'dropped') {
                    $droppedTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $droppedUniqueCount) == true) {
                        $droppedDuplicateCount[] = $oRow;
                    } else {
                        $droppedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'spam_report') {
                    $spamTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $spamUniqueCount) == true) {
                        $spamDuplicateCount[] = $oRow;
                    } else {
                        $spamUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'group_resubscribe') {
                    $groupResubscribeTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $groupResubscribeUniqueCount) == true) {
                        $groupResubscribeDuplicateCount[] = $oRow;
                    } else {
                        $groupResubscribeUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'group_unsubscribe') {
                    $groupUnsubscribeTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $groupUnsubscribeUniqueCount) == true) {
                        $groupUnsubscribeDuplicateCount[] = $oRow;
                    } else {
                        $groupUnsubscribeUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'deferred') {
                    $deferredTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $deferredUniqueCount) == true) {
                        $deferredDuplicateCount[] = $oRow;
                    } else {
                        $deferredUniqueCount[] = $oRow;
                    }
                } else {
                    $otherTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $otherUniqueCount) == true) {
                        $otherDuplicateCount[] = $oRow;
                    } else {
                        $otherUniqueCount[] = $oRow;
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
     * Used to check duplicates in the stats
     * @param type $aSearch
     * @param type $tableData
     * @return boolean
     */
    public function checkIfDuplicateExistsInSendgridStat($aSearch, $tableData) {
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
     * Used to get stats data
     * @param type $param
     * @param type $id
     * @param type $eventType
     * @return type
     */
    public function getEmailTwilioStats($param, $id, $eventType = '') {
        $sql = "SELECT tbl_nps_automations_tracking_twillio.* FROM tbl_nps_automations_tracking_twillio "
                . "LEFT JOIN tbl_nps_main ON tbl_nps_automations_tracking_twillio.nps_id = tbl_nps_main.id "
                . "LEFT JOIN tbl_nps_automations_events ON tbl_nps_automations_tracking_twillio.event_id = tbl_nps_automations_events.id "
                . "LEFT JOIN tbl_nps_automations_campaigns ON tbl_nps_automations_tracking_twillio.campaign_id= tbl_nps_automations_campaigns.id "
                . "LEFT JOIN tbl_nps_users ON tbl_nps_automations_tracking_twillio.subscriber_id = tbl_nps_users.id ";


        if ($param == 'campaign') {
            $sql .= "WHERE tbl_nps_automations_tracking_twillio.campaign_id='{$id}' ";
        } else if ($param == 'event') {
            $sql .= "WHERE tbl_nps_automations_tracking_twillio.event_id='{$id}' ";
        } else if ($param == 'subscriber') {
            $sql .= "WHERE tbl_nps_automations_tracking_twillio.subscriber_id='{$id}' ";
        } else {
            $sql .= "WHERE 1 ";
        }

        if ($eventType == 'accepted') {
            $sql .= "AND tbl_nps_automations_tracking_twillio.event_name='accepted' ";
        } else if ($eventType == 'sent') {
            $sql .= "AND tbl_nps_automations_tracking_twillio.event_name='sent' ";
        } else if ($eventType == 'delivered') {
            $sql .= "AND tbl_nps_automations_tracking_twillio.event_name='delivered' ";
        } else if ($eventType == 'undelivered') {
            $sql .= "AND tbl_nps_automations_tracking_twillio.event_name='undelivered' ";
        } else if ($eventType == 'failed') {
            $sql .= "AND tbl_nps_automations_tracking_twillio.event_name='failed' ";
        } else if ($eventType == 'receiving') {
            $sql .= "AND tbl_nps_automations_tracking_twillio.event_name='receiving' ";
        } else if ($eventType == 'received') {
            $sql .= "AND tbl_nps_automations_tracking_twillio.event_name='received' ";
        } else if ($eventType == 'queued') {
            $sql .= "AND tbl_nps_automations_tracking_twillio.event_name='queued' ";
        } else if ($eventType == 'sending') {
            $sql .= "AND tbl_nps_automations_tracking_twillio.event_name='sending' ";
        }

        $sql .= "ORDER BY tbl_nps_automations_tracking_twillio.id DESC";

        $oData = DB::select(DB::raw($sql));
        return $oData;
    }

    /**
     * Used to filter categorized stats
     */
    public function getEmailTwilioCategorizedStatsData($oData) {
        $acceptedTotalCount = $acceptedUniqueCount = $acceptedDuplicateCount = array();
        $sentTotalCount = $sentUniqueCount = $sentDuplicateCount = array();
        $deliveredTotalCount = $deliveredUniqueCount = $deliveredDuplicateCount = array();
        $undeliveredTotalCount = $undeliveredUniqueCount = $undeliveredDuplicateCount = array();
        $failedTotalCount = $failedUniqueCount = $failedDuplicateCount = array();
        $receivingTotalCount = $receivingUniqueCount = $receivingDuplicateCount = array();
        $receivedTotalCount = $receivedUniqueCount = $receivedDuplicateCount = array();
        $queuedTotalCount = $queuedUniqueCount = $queuedDuplicateCount = array();
        $sendingTotalCount = $sendingUniqueCount = $sendingDuplicateCount = array();
        $otherTotalCount = $otherUniqueCount = $otherDuplicateCount = array();

        if (!empty($oData)) {

            foreach ($oData as $oRow) {

                if ($oRow->event_name == 'accepted') {
                    $acceptedTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $acceptedUniqueCount) == true) {
                        $acceptedDuplicateCount[] = $oRow;
                    } else {
                        $acceptedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'sent') {
                    $sentTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $sentUniqueCount) == true) {
                        $sentDuplicateCount[] = $oRow;
                    } else {
                        $sentUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'delivered') {
                    $deliveredTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $deliveredUniqueCount) == true) {
                        $deliveredDuplicateCount[] = $oRow;
                    } else {
                        $deliveredUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'undelivered') {
                    $undeliveredTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $undeliveredUniqueCount) == true) {
                        $undeliveredDuplicateCount[] = $oRow;
                    } else {
                        $undeliveredUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'failed') {
                    $failedTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $failedUniqueCount) == true) {
                        $failedDuplicateCount[] = $oRow;
                    } else {
                        $failedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'receiving') {
                    $receivingTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $receivingUniqueCount) == true) {
                        $receivingDuplicateCount[] = $oRow;
                    } else {
                        $receivingUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'received') {
                    $receivedTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $receivedUniqueCount) == true) {
                        $receivedDuplicateCount[] = $oRow;
                    } else {
                        $receivedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'queued') {
                    $queuedTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $queuedUniqueCount) == true) {
                        $queuedDuplicateCount[] = $oRow;
                    } else {
                        $queuedUniqueCount[] = $oRow;
                    }
                } else if ($oRow->event_name == 'sending') {
                    $sendingTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $sendingUniqueCount) == true) {
                        $sendingDuplicateCount[] = $oRow;
                    } else {
                        $sendingUniqueCount[] = $oRow;
                    }
                } else {
                    $otherTotalCount[] = $oRow;
                    if ($this->checkIfDuplicateExistsInSendgridStat($oRow, $otherUniqueCount) == true) {
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
     * Used to get NPS campaing templates
     * @param type $npsId
     * @return boolean
     */
    public function getNPSCampaignTemplates($npsId) {
        $oData = DB::table('tbl_nps_automations_campaigns')
                ->join('tbl_nps_automations_events', 'tbl_nps_automations_events.id',  '=' , 'tbl_nps_automations_campaigns.event_id')
                ->select('tbl_nps_automations_campaigns.*')
                ->where('tbl_nps_automations_events.nps_id', $npsId)
                ->get();
        return $oData;
    }

    /**
     * Used to update nps campaign by event id
     * @param type $cData
     * @param type $eventID
     * @return boolean
     */
    public function updataCampaignByEventID($cData, $eventID) {
        $result = DB::table('tbl_nps_automations_campaigns')
                ->where('event_id', $eventID)
                ->update($cData);
        return true;
    }

    /**
     * Used to update auto event
     * @param type $aData
     * @param type $id
     * @return boolean
     */
    public function updateAutoEvent($aData, $id) {
        if ($id > 0) {
            $result = DB::table('tbl_nps_automations_events')
                    ->where('id', $id)
                    ->update($aData);
            return true;
        }
        return false;
    }

}
