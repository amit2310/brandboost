<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class TagsModel extends Model {

    /**
     * Get client tags
     * @param type $userid
     * @return type object
     */
    public static function getClientTags($userID = 0) {

        $oData = DB::table('tbl_tag_groups')
                ->leftJoin('tbl_tag_groups_entity', 'tbl_tag_groups.id', '=', 'tbl_tag_groups_entity.group_id')
                ->select('tbl_tag_groups.*', 'tbl_tag_groups_entity.id AS tagid', 'tbl_tag_groups_entity.tag_name', 'tbl_tag_groups_entity.tag_created')
                ->when(($userID > 0), function ($query) use ($userID) {
                    return $query->where('tbl_tag_groups.user_id', $userID);
                })
                ->orderBy('tbl_tag_groups.id', 'desc')
                ->orderBy('tbl_tag_groups_entity.id', 'asc')
                ->get();

        return $oData;
    }

    public function getTagsReview($tagID) {

        $this->db->select("tbl_reviews.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile, tbl_users.avatar");
        $this->db->join("tbl_users", "tbl_reviews.user_id=tbl_users.id", "LEFT");
        $this->db->join("tbl_reviews_tags", "tbl_reviews.id=tbl_reviews_tags.review_id", "LEFT");
        $this->db->where("tbl_reviews_tags.tag_id", $tagID);
        $rResponse = $this->db->get("tbl_reviews");
        //echo $this->db->last_query();exit;
        if ($rResponse->num_rows() > 0) {
            $aReviews = $rResponse->result();
        }
        return $aReviews;
    }

    public function getTagsBySubscriberID($subscriberId) {
        $this->db->select("tbl_tag_groups_entity.*");
        $this->db->join("tbl_reviews_tags", "tbl_reviews.id=tbl_reviews_tags.review_id", "LEFT");
    }

    public function getAllClientTags($userID = 0) {

        $this->db->select("tbl_tag_groups_entity.*, tbl_tag_groups.group_name, tbl_tag_groups.user_id");
        $this->db->join("tbl_tag_groups", "tbl_tag_groups.id=tbl_tag_groups_entity.group_id", "LEFT");
        if ($userID > 0) {
            $this->db->where("tbl_tag_groups.user_id", $userID);
        }
        $this->db->order_by("tbl_tag_groups.id", "DESC");
        $result = $this->db->get('tbl_tag_groups_entity');
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $aData = $result->result();
        }

        return $aData;
    }

    public function addTagGroup($aData) {
        $result = $this->db->insert('tbl_tag_groups', $aData);
        $inset_id = $this->db->insert_id();
        if ($result) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function addTagGroupEntity($aData) {
        $result = $this->db->insert('tbl_tag_groups_entity', $aData);
        $inset_id = $this->db->insert_id();
        if ($result) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function getTagGroupInfo($id) {
        $this->db->where('id', $id);
        $this->db->limit(1);
        $result = $this->db->get('tbl_tag_groups');
        if ($result->num_rows() > 0) {
            $aData = $result->row();
        }

        return $aData;
    }

    public function getTagGroupEntityInfo($id) {
        $this->db->where('id', $id);
        $this->db->limit(1);
        $result = $this->db->get('tbl_tag_groups_entity');
        if ($result->num_rows() > 0) {
            $aData = $result->row();
        }

        return $aData;
    }

    public function getTagByReviewIDTagID($aTagID, $reviewID) {
        $this->db->where('tag_id', $aTagID);
        $this->db->where('review_id', $reviewID);
        $result = $this->db->get('tbl_reviews_tags');
        if ($result->num_rows() > 0) {
            $aData = $result->row();
        }
        return $aData;
    }

    public function getTagByFeedbackIDTagID($aTagID, $feedbackID) {
        $this->db->where('tag_id', $aTagID);
        $this->db->where('feedback_id', $feedbackID);
        $result = $this->db->get('tbl_feedback_tags');
        if ($result->num_rows() > 0) {
            $aData = $result->row();
        }
        return $aData;
    }

    public function getTagByQuestionIDTagID($aTagID, $questionID) {
        $this->db->where('tag_id', $aTagID);
        $this->db->where('question_id', $questionID);
        $result = $this->db->get('tbl_reviews_question_tags');
        if ($result->num_rows() > 0) {
            $aData = $result->row();
        }
        return $aData;
    }

    public function updateTagGroup($aData, $id) {
        $this->db->where('id', $id);
        $result = $this->db->update('tbl_tag_groups', $aData);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function updateTagGroupEntity($aData, $id) {
        $this->db->where('id', $id);
        $result = $this->db->update('tbl_tag_groups_entity', $aData);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteTagGroup($id) {
        $this->db->where('id', $id);
        $result = $this->db->delete('tbl_tag_groups');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteReviewTagByID($id, $reviewID) {
        $this->db->where('tag_id', $id);
        $this->db->where('review_id', $reviewID);
        $result = $this->db->delete('tbl_reviews_tags');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteFeedbackTagByID($id, $feedbackID) {
        $this->db->where('tag_id', $id);
        $this->db->where('feedback_id', $feedbackID);
        $result = $this->db->delete('tbl_feedback_tags');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteQuestionTagByID($id, $questionID) {
        $this->db->where('tag_id', $id);
        $this->db->where('question_id', $questionID);
        $result = $this->db->delete('tbl_reviews_question_tags');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteTagGroupEntity($id) {
        $this->db->where('id', $id);
        $result = $this->db->delete('tbl_tag_groups_entity');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteTagGroupEntityWebchat($review_id, $tag_id) {
        $this->db->where('tag_id', $tag_id);
        $this->db->where('review_id', $review_id);
        $result = $this->db->delete('tbl_reviews_tags');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

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
                if ($tagData->id == '') {
                    $result = $this->db->insert('tbl_reviews_tags', $aInput);
                }

                $reviewTagsData = $this->getTagsDataByReviewID($aData['review_id']);
                foreach ($reviewTagsData as $reviewTagData) {
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
                    $result = $this->db->insert('tbl_feedback_tags', $aInput);
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
                if ($tagData->id == '') {
                    $result = $this->db->insert('tbl_reviews_question_tags', $aInput);
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

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getTagList($groupID) {
        $this->db->where("group_id", $groupID);
        $result = $this->db->get('tbl_tag_groups_entity');
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $aData = $result->result();
        }

        return $aData;
    }

    public function getReviewsByTagID($tagID) {
        $this->db->distinct();
        $this->db->select('review_id');
        $this->db->where("tag_id", $tagID);
        $this->db->join("tbl_reviews", "tbl_reviews.id=tbl_reviews_tags.review_id", "right");
        $result = $this->db->get('tbl_reviews_tags');
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $aData = $result->result();
        }

        return $aData;
    }

    public function getFeedbackByTagID($tagID) {
        $this->db->distinct();
        $this->db->select('feedback_id');
        $this->db->where("tag_id", $tagID);
        $result = $this->db->get('tbl_feedback_tags');
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $aData = $result->result();
        }

        return $aData;
    }

    public function getTagFeedback($userID, $user_role, $tagId) {
        $response = array();
        $this->db->select('tbl_brandboost_feedback.*, tbl_users.avatar, tbl_subscribers.firstname, tbl_subscribers.lastname, tbl_subscribers.email, tbl_subscribers.phone, tbl_brandboost.brand_title, tbl_brandboost.brand_img');
        $this->db->from('tbl_brandboost_feedback');
        if ($user_role > 1) {
            $this->db->where("tbl_brandboost_feedback.client_id", $userID);
        }
        $this->db->where("tbl_brandboost.brand_title !=", "");
        $this->db->where("tbl_brandboost_feedback.id IN(SELECT feedback_id FROM tbl_feedback_tags WHERE tag_id=$tagId)");
        $this->db->join('tbl_brandboost_users', 'tbl_brandboost_users.id = tbl_brandboost_feedback.subscriber_id', 'left');
        $this->db->join('tbl_subscribers', 'tbl_brandboost_users.subscriber_id = tbl_subscribers.id', 'left');
        $this->db->join('tbl_users', 'tbl_users.id = tbl_brandboost_users.user_id', 'left');
        $this->db->join('tbl_brandboost', 'tbl_brandboost.id = tbl_brandboost_feedback.brandboost_id', 'left');
        $this->db->order_by('tbl_brandboost_feedback.id', 'DESC');
        $result = $this->db->get();
        //echo $this->db->last_query();
        //die;
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getTagsDataByReviewID($reviewID) {

        $this->db->select("tbl_tag_groups_entity.*, tbl_reviews_tags.tag_id, tbl_reviews_tags.review_id");
        $this->db->join("tbl_tag_groups_entity", "tbl_tag_groups_entity.id=tbl_reviews_tags.tag_id", "LEFT");
        $this->db->where("tbl_reviews_tags.review_id", $reviewID);
        $result = $this->db->get("tbl_reviews_tags");
        //echo $this->db->last_query();exit;
        if ($result->num_rows() > 0) {
            $aData = $result->result();
        }

        return $aData;
    }

    public function getTagsDataByQuestionID($questionID) {

        $this->db->select("tbl_tag_groups_entity.*, tbl_reviews_question_tags.tag_id, tbl_reviews_question_tags.question_id");
        $this->db->join("tbl_tag_groups_entity", "tbl_tag_groups_entity.id=tbl_reviews_question_tags.tag_id", "LEFT");
        $this->db->where("tbl_reviews_question_tags.question_id", $questionID);
        $result = $this->db->get("tbl_reviews_question_tags");
        //echo $this->db->last_query();exit;
        if ($result->num_rows() > 0) {
            $aData = $result->result();
        }

        return $aData;
    }

    public function getTagsDataByFeedbackID($feedbackID) {

        $this->db->select("tbl_tag_groups_entity.*, tbl_feedback_tags.tag_id, tbl_feedback_tags.feedback_id");
        $this->db->join("tbl_tag_groups_entity", "tbl_tag_groups_entity.id=tbl_feedback_tags.tag_id", "LEFT");
        $this->db->where("tbl_feedback_tags.feedback_id", $feedbackID);
        $result = $this->db->get("tbl_feedback_tags");
        //echo $this->db->last_query();exit;
        if ($result->num_rows() > 0) {
            $aData = $result->result();
        }

        return $aData;
    }

    public function checkifGroupExist($name, $userID) {
        $this->db->where("group_name", $name);
        $this->db->where("user_id", $userID);
        $result = $this->db->get('tbl_tag_groups');
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkifGroupEntityExist($name, $userID) {
        $oGroups = $this->getClientTagGroups($userID);
        if (!empty($oGroups)) {
            foreach ($oGroups as $oGroup) {
                $aGroupID[] = $oGroup->id;
            }
        }

        if (!empty($aGroupID)) {
            $sql = "SELECT * FROM tbl_tag_groups_entity WHERE tag_name='$name' AND group_id IN(" . implode(",", $aGroupID) . ")";
            $result = $this->db->query($sql);
            if ($result->num_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function getClientTagGroups($userID = 0) {
        $this->db->where("tbl_tag_groups.user_id", $userID);
        $result = $this->db->get('tbl_tag_groups');
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $aData = $result->result();
        }

        return $aData;
    }

    public function removeReviewTag($tagID, $reviewID) {
        $this->db->where("review_id", $reviewID);
        $this->db->where("tag_id", $tagID);
        $result = $this->db->delete('tbl_reviews_tags');
        //echo $this->db->last_query(); exit;
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function removeFeedbackTag($tagID, $feedbackID) {
        $this->db->where("feedback_id", $feedbackID);
        $this->db->where("id", $tagID);
        $result = $this->db->delete('tbl_feedback_tags');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getSubscriberTags($subscriberID) {
        $this->db->select("tbl_tag_groups_entity.*, tbl_subscriber_tags.tag_id, tbl_subscriber_tags.subscriber_id");
        $this->db->join("tbl_tag_groups_entity", "tbl_tag_groups_entity.id=tbl_subscriber_tags.tag_id", "LEFT");
        $this->db->where("tbl_subscriber_tags.subscriber_id", $subscriberID);
        $result = $this->db->get("tbl_subscriber_tags");
        //echo $this->db->last_query();exit;
        if ($result->num_rows() > 0) {
            $aData = $result->result();
        }

        return $aData;
    }

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
                if ($tagData->id == '') {
                    $result = $this->db->insert('tbl_subscriber_tags', $aInput);
                }

                $oTags = $this->getSubscriberTags($aData['subscriber_id']);
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

    public function getTagBySubscriberID($aTagID, $subscriberID) {
        $this->db->where('tag_id', $aTagID);
        $this->db->where('subscriber_id', $subscriberID);
        $result = $this->db->get('tbl_subscriber_tags');
        if ($result->num_rows() > 0) {
            $aData = $result->row();
        }
        return $aData;
    }

    public function deleteSubscriberTag($id, $subscriberID) {
        $this->db->where('tag_id', $id);
        $this->db->where('subscriber_id', $subscriberID);
        $result = $this->db->delete('tbl_subscriber_tags');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

}
