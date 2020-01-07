<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;
error_reporting(0);
class TagsModel extends Model {

    /**
     * Get client tags
     * @param type $userid
     * @return type object
     */
    public static function getClientTags($userID = "") {

        $oData = DB::table('tbl_tag_groups')
                ->leftJoin('tbl_tag_groups_entity', 'tbl_tag_groups.id', '=', 'tbl_tag_groups_entity.group_id')
                ->select('tbl_tag_groups.*', 'tbl_tag_groups_entity.id AS tagid', 'tbl_tag_groups_entity.tag_name', 'tbl_tag_groups_entity.tag_created')
                ->when(($userID > 0), function ($query) use ($userID) {
                    return $query->where('tbl_tag_groups.user_id', $userID);
                })
                ->orderBy('tbl_tag_groups.id', 'DESC')
                ->orderBy('tbl_tag_groups_entity.id', 'DESC')
                ->paginate(10);
                //->get();

        return $oData;
    }

    /**
     * Used to add new tag review
     */
    public function createTagReview($aData) {
        $insert_id = DB::table('tbl_tag_groups_entity')
            ->insertGetId($aData);
        return $insert_id;
    }

    /**
     * Used to check if duplicate tag review
     * @param type $tagReviewName
     * @param type $userID
     * @return boolean
     */
    public function isDuplicateTagReview($tagGroupId, $tagReviewName, $userID = 0) {
        $oData = DB::table('tbl_tag_groups_entity')
            ->where('group_id', $tagGroupId)
            ->where('tag_name', $tagReviewName)
            ->exists();
        return $oData;
    }

    /**
     * this function is used to get the tags by the review id
     * @param type $reviewID
     * @return type array
     */
    public static function getTagsDataByReviewID($reviewID) {

        $oData = DB::table('tbl_reviews_tags')
                ->select('tbl_tag_groups_entity.*', 'tbl_reviews_tags.tag_id', 'tbl_reviews_tags.review_id')
                ->join('tbl_tag_groups_entity', 'tbl_tag_groups_entity.id', '=', 'tbl_reviews_tags.tag_id')
                ->where("tbl_reviews_tags.review_id", $reviewID)
                ->get();


        return $oData;
    }


     /**
    * This function will return tags reviews
    * @param type $tagID
    * @return type
    */

    public function getTagsReview($tagID) {

         $oData = DB::table('tbl_reviews')
           ->select('tbl_reviews.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_users.avatar')
             ->leftJoin('tbl_users', 'tbl_reviews.user_id','=','tbl_users.id')
              ->leftJoin('tbl_reviews_tags', 'tbl_reviews.id','=','tbl_reviews_tags.review_id')
               ->where('tbl_reviews_tags.tag_id', $tagID)->get();
        return $oData;
    }


     /**
    * This function will return all tags by subscriber id
    * @param type $subscriberId
    * @return type
    */

    public function getTagsBySubscriberID($subscriberId) {
        $this->db->select("tbl_tag_groups_entity.*");
        $this->db->join("tbl_reviews_tags", "tbl_reviews.id=tbl_reviews_tags.review_id", "LEFT");
    }


     /**
    * This function will return all client tags
    * @param type $userID
    * @return type
    */

    public function getAllClientTags($userID = "") {

       $oData = DB::table('tbl_tag_groups_entity')
        ->select('tbl_tag_groups_entity.*', 'tbl_tag_groups.group_name', 'tbl_tag_groups.user_id')
        ->leftJoin('tbl_tag_groups', 'tbl_tag_groups.id','=','tbl_tag_groups_entity.group_id')
        ->when($userID > 0, function($query) use ($userID){
        return $query->where("tbl_tag_groups.user_id", $userID);
        })

         ->orderBy('tbl_tag_groups.id', 'DESC')->get();
        return $oData;
    }


      /**
    * This function will add Group
    * @param type $aData
    * @return type
    */

    public function addTagGroup($aData) {
         $oData = DB::table('tbl_tag_groups')->insertGetId($aData);
        return $oData;
    }


    /**
    * This function will add Group Entity
    * @param type $aData
    * @return type
    */

    public function addTagGroupEntity($aData) {
        $oData = DB::table('tbl_tag_groups_entity')->insertGetId($aData);
       return $oData;
    }


    /**
    * This function will return Group information
    * @param type $reviewID
    * @return type
    */


    public function getTagGroupInfo($id) {
         $oData = DB::table('tbl_tag_groups')->where('id', $id)->limit(1)->first();
        return $oData;
    }


    /**
    * This function will return Group Entity information
    * @param type $reviewID
    * @return type
    */


    public function getTagGroupEntityInfo($id) {
         $oData = DB::table('tbl_tag_groups_entity')
         ->where('id', $id)->limit(1)->first();
          return $oData;
    }



    /**
     * This function will tagids
     * @param type $aTagID
     * @param type $reviewID
     * @return type
     */


    public function getTagByReviewIDTagID($aTagID, $reviewID) {

        $oData = DB::table('tbl_reviews_tags')
                ->where('tag_id', $aTagID)
                ->where('review_id', $reviewID)
                ->first();
        return $oData;
    }




    /**
    * This function is used to get the feedback tag
    * @param type $aTagID
    * @param type $feedbackID
    * @return type
    */

    public function getTagByFeedbackIDTagID($aTagID, $feedbackID) {
        $oData = DB::table('tbl_feedback_tags')
        ->where('tag_id', $aTagID)
         ->where('feedback_id', $feedbackID)->first();
         return $oData;
    }


    /**
    * This function will return tags on the behalf of tag and question id
    * @param type $aTagID
    * @param type $questionID
    * @return type
    */

    public function getTagByQuestionIDTagID($aTagID, $questionID) {
        $oData = DB::table('tbl_reviews_question_tags')
          ->where('tag_id', $aTagID)
            ->where('question_id', $questionID)
             ->first();
              return $oData;
    }


    /**
    * This function is used to update the tagGroups
    * @param type $id
    * @return type
    */

    public function updateTagGroup($aData, $id) {
         $oData = DB::table('tbl_tag_groups')
            ->where('id', $id)->update($aData);
             return true;
    }


    /**
    * This function is used to update the Tag Group entity
    * @param type $id
    * @return type
    */

    public function updateTagGroupEntity($aData, $id) {
        $oData = DB::table('tbl_tag_groups_entity')
          ->where('id', $id)->update($aData);
       return true;
    }


    /**
    * This function is used to delete the tag Group
    * @param type $id
    * @return type
    */

    public function deleteTagGroup($id) {
        $oData = DB::table('tbl_tag_groups')
         ->where('id', $id)->delete();
          return true;

    }

    public function deleteReviewTagByID($id, $reviewID) {
        $oData = DB::table('tbl_reviews_tags')
                ->where('tag_id', $id)
                ->where('review_id', $reviewID)
                ->delete();
        return $oData;
    }


    /**
    * This function is used to delete feedback tags by id
    * @param type $feedbackID
     * @param type $id
    * @return type
    */

    public function deleteFeedbackTagByID($id, $feedbackID) {
        $oData = DB::table('tbl_feedback_tags')
          ->where('tag_id', $id)->where('feedback_id', $feedbackID)->delete();
            return true;

    }


   /**
    * This function is used to delete Question tags by id
    * @param type $feedbackID
     * @param type $id
    * @return type
    */

    public function deleteQuestionTagByID($id, $questionID) {
         $oData = DB::table('tbl_reviews_question_tags')
         ->where('tag_id', $id)
         ->where('question_id', $questionID)->delete();
           return true;
    }



   /**
    * This function is used to delete Group Entity on the behaof of the group entity id
     * @param type $id
    * @return type
    */

    public function deleteTagGroupEntity($id) {
         $oData = DB::table('tbl_tag_groups_entity')
         ->where('id', $id)->delete();
        return true;

    }

    /**
     * this function is used delete the tags for webchat users
     * @return type boolean
     */
    public function deleteTagGroupEntityWebchat($review_id, $tag_id) {
        $oData = DB::table('tbl_reviews_tags')
                ->where('tag_id', $tag_id)
                ->where('review_id', $review_id)
                ->get();
        return true;
    }

    /**
     * this function is used to add the tags in the system
     * @return type boolean
     */


    public function addReviewTag($aData) {
        $aTagIDs = $aData['aTagIDs'];
        if (!empty($aTagIDs)) {
            foreach ($aTagIDs as $iTagID) {
                $aInput = array(
                    'tag_id' => $iTagID,
                    'review_id' => $aData['review_id'],
                    'applied_tag_created' => date("Y-m-d H:i:s")
                );

                $tagData = $this->getTagByReviewIDTagID($iTagID, $aData['review_id']);

                if (empty($tagData->id)) {
                    $result = DB::table('tbl_reviews_tags')->insert($aInput);
                }

                $reviewTagsData = $this->getTagsDataByReviewID($aData['review_id']);
                foreach ($reviewTagsData as $reviewTagData) {
                    // pre($reviewTagData);die;
                    if (in_array($reviewTagData->tag_id, $aTagIDs)) {
                        $result = true;
                    } else {
                        $result = $this->deleteReviewTagByID($reviewTagData->tag_id, $aData['review_id']);
                    }
                }
            }
        } else {

            if (!empty($aData['review_id'])) {
                $reviewTagsData = $this->getTagsDataByReviewID($aData['review_id']);
                if (!empty($reviewTagsData)) {
                    foreach ($reviewTagsData as $reviewTagData) {
                        if (in_array($reviewTagData->tag_id, $aTagIDs)) {
                            $result = true;
                        } else {
                            $result = $this->deleteReviewTagByID($reviewTagData->tag_id, $aData['review_id']);
                        }
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
    * This function is used to add the feedback data
    * @param type
    * @return type
    */
    public function addFeedbackTag($aData) {
        $aTagIDs = $aData['aTagIDs'];
        if (!empty($aTagIDs)) {
            foreach ($aTagIDs as $iTagID) {
                $aInput = array(
                    'tag_id' => $iTagID,
                    'feedback_id' => $aData['feedback_id'],
                    'applied_tag_created' => date("Y-m-d H:i:s")
                );

                $tagData = $this->getTagByFeedbackIDTagID($iTagID, $aData['feedback_id']);
                if ($tagData->id == '') {
                    $aData =  DB::table('tbl_feedback_tags')->insert($aInput);
                }

                $feedbackTagsData = $this->getTagsDataByFeedbackID($aData['feedback_id']);
                foreach ($feedbackTagsData as $feedbackTagData) {
                    if (in_array($feedbackTagData->tag_id, $aTagIDs)) {
                        $result = true;
                    } else {
                        $result = $this->deleteFeedbackTagByID($feedbackTagData->tag_id, $aData['feedback_id']);
                    }
                }
            }
        } else {
            if (!empty($aData['feedback_id'])) {
                $feedbackTagsData = $this->getTagsDataByFeedbackID($aData['feedback_id']);
                if (!empty($feedbackTagsData)) {
                    foreach ($feedbackTagsData as $feedbackTagData) {
                        if (in_array($feedbackTagData->tag_id, $aTagIDs)) {
                            $result = true;
                        } else {
                            $result = $this->deleteFeedbackTagByID($feedbackTagData->tag_id, $aData['feedback_id']);
                        }
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
    * This function is used to add Questions tags
    * @param type array
    * @return type
    */

    public function addQuestionTag($aData) {
        $aTagIDs = $aData['aTagIDs'];

        if (!empty($aTagIDs)) {
            foreach ($aTagIDs as $iTagID) {
                $aInput = array(
                    'tag_id' => $iTagID,
                    'question_id' => $aData['question_id'],
                    'applied_tag_created' => date("Y-m-d H:i:s")
                );

                $tagData = $this->getTagByQuestionIDTagID($iTagID, $aData['question_id']);
                if (empty($tagData->id)) {
                    $result = DB::table('tbl_reviews_question_tags')->insert($aInput);
                }

                $qustionTagsData = $this->getTagsDataByQuestionID($aData['question_id']);
                foreach ($qustionTagsData as $questionTagData) {
                    if (in_array($questionTagData->tag_id, $aTagIDs)) {
                        $result = true;
                    } else {
                        $result = $this->deleteQuestionTagByID($questionTagData->tag_id, $aData['question_id']);
                    }
                }
            }
        } else {
            if (!empty($aData['question_id'])) {
                $qustionTagsData = $this->getTagsDataByQuestionID($aData['question_id']);
                if (!empty($qustionTagsData)) {
                    foreach ($qustionTagsData as $questionTagData) {
                        $result = $this->deleteQuestionTagByID($questionTagData->tag_id, $aData['question_id']);
                    }
                }
            }
        }

        return true;
    }


    /**
    * This function will return Tags list
    * @param type $groupID
    * @return type
    */

    public function getTagList($groupID) {
        $oData = DB::table('tbl_tag_groups_entity')
        ->where("group_id", $groupID)->get();
        return  $oData;
    }

     /**
    * This function will return Reviews on the behalf of the tag id
    * @param type $clientID
    * @return type
    */

    public static function getReviewsByTagID($tagID) {
        $oData = DB::table('tbl_reviews_tags')->distinct()->select('review_id')->where("tag_id", $tagID)
        ->rightJoin('tbl_reviews', 'tbl_reviews.id','=','tbl_reviews_tags.review_id')
         ->get();
         return $oData;
    }

    /**
    * This function will return feedback on the behalf of the tag id
    * @param type $clientID
    * @return type
    */

    public static function getFeedbackByTagID($tagID) {
        $oData = DB::table('tbl_feedback_tags')->distinct()->where("tag_id", $tagID)->get();
        if ($oData->count() > 0) {
            $aData = $oData;
            return $aData;
        }
        else
        {
          return false;
        }


    }


    /**
    * This function is used to get all the feedback tags
    * @param type $userID
    * @param type $user_role
    * @param type $tagId
    * @return type
    */

    public function getTagFeedback($userID, $user_role, $tagId) {
        if(!empty($userID))
        {
         $oData = DB::select(DB::raw("SELECT `tbl_brandboost_feedback`.*, `tbl_users`.`avatar`, `tbl_subscribers`.`firstname`, `tbl_subscribers`.`lastname`, `tbl_subscribers`.`email`, `tbl_subscribers`.`phone`, `tbl_brandboost`.`brand_title`, `tbl_brandboost`.`brand_img` FROM `tbl_brandboost_feedback` LEFT JOIN `tbl_brandboost_users` ON `tbl_brandboost_users`.`id` = `tbl_brandboost_feedback`.`subscriber_id` LEFT JOIN `tbl_subscribers` ON `tbl_brandboost_users`.`subscriber_id` = `tbl_subscribers`.`id` LEFT JOIN `tbl_users` ON `tbl_users`.`id` = `tbl_brandboost_users`.`user_id` LEFT JOIN `tbl_brandboost` ON `tbl_brandboost`.`id` = `tbl_brandboost_feedback`.`brandboost_id` WHERE `tbl_brandboost_feedback`.`client_id` = '".$userID."' AND `tbl_brandboost`.`brand_title` != '' AND `tbl_brandboost_feedback`.`id` IN(SELECT feedback_id FROM tbl_feedback_tags WHERE tag_id=$tagId) ORDER BY `tbl_brandboost_feedback`.`id` DESC"));
        }
        else
        {
            $oData = DB::select(DB::raw("SELECT `tbl_brandboost_feedback`.*, `tbl_users`.`avatar`, `tbl_subscribers`.`firstname`, `tbl_subscribers`.`lastname`, `tbl_subscribers`.`email`, `tbl_subscribers`.`phone`, `tbl_brandboost`.`brand_title`, `tbl_brandboost`.`brand_img` FROM `tbl_brandboost_feedback` LEFT JOIN `tbl_brandboost_users` ON `tbl_brandboost_users`.`id` = `tbl_brandboost_feedback`.`subscriber_id` LEFT JOIN `tbl_subscribers` ON `tbl_brandboost_users`.`subscriber_id` = `tbl_subscribers`.`id` LEFT JOIN `tbl_users` ON `tbl_users`.`id` = `tbl_brandboost_users`.`user_id` LEFT JOIN `tbl_brandboost` ON `tbl_brandboost`.`id` = `tbl_brandboost_feedback`.`brandboost_id`  AND `tbl_brandboost`.`brand_title` != '' AND `tbl_brandboost_feedback`.`id` IN(SELECT feedback_id FROM tbl_feedback_tags WHERE tag_id=$tagId) ORDER BY `tbl_brandboost_feedback`.`id` DESC"));

        }
    if (count($oData)> 0) {
    $response = $oData;
    }
    return $response;
    }

    /**
     * this function is used to get the tags by the question id
     * @param type $questionID
     * @return type array
     */
    public function getTagsDataByQuestionID($questionID) {

        $oData = DB::table('tbl_reviews_question_tags')
                ->select('tbl_tag_groups_entity.*', 'tbl_reviews_question_tags.tag_id', 'tbl_reviews_question_tags.question_id')
                ->join('tbl_tag_groups_entity', 'tbl_tag_groups_entity.id', '=', 'tbl_reviews_question_tags.tag_id')
                ->where("tbl_reviews_question_tags.question_id", $questionID)
                ->get();

        return $oData;
    }

    public static function getTagsDataByFeedbackID($feedbackID) {

        $oData = DB::table('tbl_feedback_tags')
                ->select('tbl_tag_groups_entity.*', 'tbl_feedback_tags.tag_id', 'tbl_feedback_tags.feedback_id')
                ->join('tbl_tag_groups_entity', 'tbl_tag_groups_entity.id', '=', 'tbl_feedback_tags.tag_id')
                ->where("tbl_feedback_tags.feedback_id", $feedbackID)
                ->get();


        return $oData;
    }


    /**
    * This function is used to check tag groups exists or not
    * @param type $clientID
    * @return type
    */

    public function checkifGroupExist($name, $userID) {
        $oData = DB::table('tbl_tag_groups')
         ->where("group_name", $name)
         ->where("user_id", $userID)->get();
        if ($oData->count() > 0) {
            return true;
        } else {
            return false;
        }
    }


    /**
    * This function is used to check group tags/entity exists or not
    * @param type $clientID
    * @return type
    */

    public function checkifGroupEntityExist($name, $userID) {
        $oGroups = $this->getClientTagGroups($userID);
        if (!empty($oGroups)) {
            foreach ($oGroups as $oGroup) {
                $aGroupID[] = $oGroup->id;
            }
        }

        if (!empty($aGroupID)) {

            $oData = DB::select(DB::raw("SELECT * FROM tbl_tag_groups_entity WHERE tag_name='$name' AND group_id IN(" . implode(",", $aGroupID) . ")"));

            if (!empty($oData)) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }


    /**
    * This function will return tags groups on the behalf of the client / user id
    * @param type $userID
    * @return type
    */

    public function getClientTagGroups($userID = 0) {
        $oData = DB::table('tbl_tag_groups')
            ->where("tbl_tag_groups.user_id", $userID)
            ->orderBy('tbl_tag_groups.id', 'DESC')
            //->get();
            ->paginate(10);

        return $oData;
    }


     /**
    * This function is used to delete the review tags
    * @param type $reviewID
    * @param type $tagID
    * @return type
    */

    public function removeReviewTag($tagID, $reviewID) {
        $oData = DB::table('tbl_reviews_tags')
        ->where("review_id", $reviewID);
         where("tag_id", $tagID)->delete();
        return true;
    }


     /**
    * This function is used to delete the feedback tags
    * @param type $feedbackID
    * @param type $tagID
    * @return type
    */

    public function removeFeedbackTag($tagID, $feedbackID) {
        $oData = DB::table('tbl_feedback_tags')
          ->where("feedback_id", $feedbackID)
           ->where("id", $tagID)->delete();
             return false;
    }

    /**
     * Used to get subscriber's tags
     * @param type $subscriberID
     * @return type
     */
    public static function getSubscriberTags($subscriberID) {
        $oData = DB::table('tbl_subscriber_tags')
                ->leftJoin('tbl_tag_groups_entity', 'tbl_tag_groups_entity.id', '=', 'tbl_subscriber_tags.tag_id')
                ->select('tbl_tag_groups_entity.*', 'tbl_subscriber_tags.tag_id', 'tbl_subscriber_tags.subscriber_id')
                ->where('tbl_subscriber_tags.subscriber_id', $subscriberID)
                ->get();
                 return $oData;
    }

    /**
     * Used to add apply subscriber tags
     * @param type $aData
     * @return boolean
     */
    public function addSubscriberTag($aData) {
        $aTagIDs = $aData['aTagIDs'];
        if (!empty($aTagIDs)) {
            foreach ($aTagIDs as $iTagID) {
                $aInput = array(
                    'tag_id' => $iTagID,
                    'subscriber_id' => $aData['subscriber_id'],
                    'applied_tag_created' => date("Y-m-d H:i:s")
                );

                $tagData = $this->getTagBySubscriberID($iTagID, $aData['subscriber_id']);
                if (empty($tagData)) {
                    $result = DB::table('tbl_subscriber_tags')->insert($aInput);
                }

                $oTags = self::getSubscriberTags($aData['subscriber_id']);
                foreach ($oTags as $oTag) {
                    if (in_array($oTag->tag_id, $aTagIDs)) {
                        $result = true;
                    } else {
                        $result = $this->deleteSubscriberTag($oTag->tag_id, $aData['subscriber_id']);
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
     * Used to get subscriber's tags
     * @param type $aTagID
     * @param type $subscriberID
     * @return type
     */
    public function getTagBySubscriberID($aTagID, $subscriberID) {
        $oData = DB::table('tbl_subscriber_tags')
                    ->where('tag_id', $aTagID)
                    ->where('subscriber_id', $subscriberID)
                    ->first();
        return $oData;
    }

    /**
     * Used to count subscriber on which tags are applied
     * @param type $aTagID
     * @return type
     */
    public function getSubscriberIDsByTagId($aTagID) {
        $oData = DB::table('tbl_subscriber_tags')
            ->where('tag_id', $aTagID)
            ->count();
        return $oData;
    }

    /**
     * Used to get subscriber on which tags are applied
     * @param type $userID
     * @param type $listID
     * @return type
     */
    public function getTagContacts($tagID, $userID = '') {
        $oData = DB::table('tbl_tag_groups_entity')
            ->join('tbl_subscriber_tags', 'tbl_subscriber_tags.tag_id', '=', 'tbl_tag_groups_entity.id')
            ->leftJoin('tbl_subscribers', 'tbl_subscriber_tags.subscriber_id', '=', 'tbl_subscribers.id')
            ->leftJoin('tbl_users', 'tbl_subscribers.user_id', '=', 'tbl_users.id')
            ->select('tbl_subscriber_tags.*', 'tbl_subscribers.firstname', 'tbl_subscribers.lastname', 'tbl_subscribers.email', 'tbl_subscribers.phone', 'tbl_subscribers.user_id AS clientID', 'tbl_tag_groups_entity.tag_name', 'tbl_users.avatar')
            ->when(($tagID > 0), function ($query) use ($tagID) {
                return $query->where('tbl_tag_groups_entity.id', $tagID);
            })
            ->when(($userID > 0), function ($query) use ($userID) {
                return $query->where('tbl_subscribers.user_id', $userID);
            })
            ->paginate(10);
        return $oData;
    }

    /**
     * Used to remove subscriber tags
     * @param type $id
     * @param type $subscriberID
     * @return boolean
     */
    public function deleteSubscriberTag($id, $subscriberID) {
        $result = DB::table('tbl_subscriber_tags')
        ->where('tag_id', $id)
        ->where('subscriber_id', $subscriberID)
        ->delete();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

}
