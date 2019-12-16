<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use DB;
use Cookie;
use Session;

class QuestionModel extends Model
{
	/**
     * Used to get brandboost questions response
     * @param type $userID
     * @return type
     */
    public function getAllBrandboostQuestions($userID='') {
		$oData = DB::table('tbl_reviews_question')
			->select('tbl_reviews_question.*', 'tbl_brandboost.brand_title', 'tbl_brandboost.brand_desc', 'tbl_brandboost.review_type', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_users.avatar')
			->when(($userID > 1), function ($query) use ($userID) {
				return $query->where('tbl_brandboost.user_id', $userID);
			})
			->orderBy('tbl_reviews_question.id', 'desc')
			->leftJoin('tbl_brandboost', 'tbl_brandboost.id', '=' , 'tbl_reviews_question.campaign_id')
			->leftJoin('tbl_users', 'tbl_users.id', '=' , 'tbl_reviews_question.user_id')
			//->get();
            ->paginate(10);
        return $oData;
    }

	/**
     * Used to get brandboost all answers of question response
     * @param type $questionID
     * @param type $id
     * @return type
     */
    public static function getAllAnswer($questionID, $id = '') {
		$oData = DB::table('tbl_reviews_question_answers')
			->select('tbl_reviews_question_answers.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_users.avatar')
			->when(($id > 1), function ($query) use ($id) {
				return $query->where('tbl_reviews_question_answers.id', $id);
			})
			->where('tbl_reviews_question_answers.question_id', $questionID)
			->leftJoin('tbl_users', 'tbl_reviews_question_answers.user_id', '=' , 'tbl_users.id')
			->orderBy('tbl_reviews_question_answers.id', 'desc')
			->get();
        return $oData;
    }

	/**
     * Used to get brandboost all questions by campaign id
     * @param type $campId
     * @return type
     */
	public static function getBrandboostQuestions($campId) {
		$oData = DB::table('tbl_reviews_question')
			->select('tbl_reviews_question.*', 'tbl_brandboost.brand_title', 'tbl_brandboost.brand_desc', 'tbl_brandboost.review_type', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_users.avatar')
			->where('tbl_reviews_question.campaign_id', $campId)
			->where('tbl_reviews_question.status', 1)
			->leftJoin('tbl_users', 'tbl_reviews_question.user_id', '=' , 'tbl_users.id')
			->leftJoin('tbl_brandboost', 'tbl_brandboost.id', '=' , 'tbl_reviews_question.campaign_id')
			->orderBy('id', 'desc')
			//->get();
            ->paginate(10);

        return $oData;
    }

	/**
     * Used to get questions details by question id
     * @param type $questionID
     * @return type
     */
	public static function getQuestionDetails($questionID){
		$oData = DB::table('tbl_reviews_question')
			->select('tbl_reviews_question.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email', 'tbl_users.mobile', 'tbl_users.avatar', 'tbl_users_notification_settings.email_notify', 'tbl_users_notification_settings.system_notify')
			->where('tbl_reviews_question.id', $questionID)
			->leftJoin('tbl_users', 'tbl_reviews_question.user_id', '=' , 'tbl_users.id')
			->leftJoin('tbl_users_notification_settings', 'tbl_users_notification_settings.user_id', '=' , 'tbl_users.id')
			->first();
        return $oData;
    }

	/**
     * Used to get questions notes by question id
     * @param type $questionId
     * @return type
     */
	public static function getQuestionNotes($questionId) {
		$oData = DB::table('tbl_reviews_question_notes')
			->select('tbl_reviews_question_notes.*', 'tbl_users.firstname', 'tbl_users.lastname', 'tbl_users.email')
			->where('tbl_reviews_question_notes.question_id', $questionId)
			->leftJoin('tbl_users', 'tbl_reviews_question_notes.user_id', '=' , 'tbl_users.id')
			->orderBy('tbl_reviews_question_notes.id', 'desc')
			->get();
        return $oData;
    }


    /**
     * This function is for count answer helpful count
     * @param type $answerID
     * @return type array
     */
    public function countAnsHelpful($answerID) {
        $result = array();
        $oData = DB::table('tbl_reviews_answers_helpful')
            ->where('answer_id', $answerID)
            ->get();

        $yes = 0;
        $no = 0;
        if ($oData->count() > 0) {
            foreach ($oData as $row) {
                if ($row->helpful_yes == 1) {
                    $yes++;
                } else if ($row->helpful_no == 1) {
                    $no++;
                }
            }
        }
        $result = array('yes' => $yes, 'no' => $no);
        return $result;
    }

    /**
     * This function is for get answer info
     * @param type $answerID
     * @return type array
     */
    public function getAnswerInfo($answerID){

        $oData = DB::table('tbl_reviews_question_answers')
            ->where('id', $answerID)
            ->first();
        return $oData;
    }


    /**
     * This function is for save question notes
     * @param type $aData
     * @return type array
     */
    public function saveQuestionNotes($aData) {

        $insert_id = DB::table('tbl_reviews_question_notes')->insertGetId($aData);
        return $insert_id;
    }


    /**
     * This function is for get question notes info
     * @param type $noteId
     * @return type object
     */
    public function getQuestionNoteInfo($noteId) {

        $oData = DB::table('tbl_reviews_question_notes')
            ->where('id', $noteId)
            ->first();
        return $oData;
    }

    /**
     * This function is for update question notes
     * @param type $aData, $noteId
     * @return type boolean
     */
    public function updateQuestionNote($aData, $noteId) {

        $oData = DB::table('tbl_reviews_question_notes')
                ->where('id', $noteId)
                ->update($aData);
        return true;
    }


    /**
     * This function is for delete question notes
     * @param type $aData, $noteId
     * @return type boolean
     */
    public function deleteQuestionNote($noteId) {

        $oData = DB::table('tbl_reviews_question_notes')
                ->where('id', $noteId)
                ->delete();
        return true;
    }


    /**
     * This function is for update question
     * @param type $aData, $questionID
     * @return type boolean
     */
    public function updateQuestion($aData, $questionID) {

        $oData = DB::table('tbl_reviews_question')
                ->where('id', $questionID)
                ->update($aData);

        return true;
    }


    public function getReviewAnswerHelpful($answerID){

        $response = array();

        $this->db->order_by('id', 'DESC');
        $this->db->where('helpful_yes', 1);
        $this->db->where('answer_id', $answerID);
        $this->db->from('tbl_reviews_answers_helpful');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }







    /*public function getBrandboostQuestions($brandboostID) {
        $response = array();
        $this->db->select("tbl_reviews_question.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile, tbl_users.avatar ");
        $this->db->join("tbl_users", "tbl_reviews_question.user_id = tbl_users.id", "LEFT");
        $this->db->where('tbl_reviews_question.campaign_id', $brandboostID);
        $this->db->order_by('tbl_reviews_question.id', 'DESC');
        $this->db->from('tbl_reviews_question');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }*/

    public function getAllQuestion($id = '') {

        $response = array();
        if (!empty($id)) {
            $this->db->where('id', $id);
        }
        $this->db->order_by('id', 'DESC');
        $this->db->from('tbl_reviews_question');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function getAllQuestionUserid($userID = '') {

        $response = array();
        if (!empty($userID)) {
            $this->db->where('tbl_brandboost.user_id', $userID);
        }
        $this->db->select('tbl_reviews_question.*');
        $this->db->order_by('tbl_reviews_question.id', 'DESC');
        $this->db->from('tbl_reviews_question');
        $this->db->join("tbl_brandboost", "tbl_reviews_question.campaign_id=tbl_brandboost.id", "LEFT");
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }



    public function getAllAnswerModified($questionID, $id = '') {

        $response = array();
        $this->db->select("tbl_reviews_question_answers.*, tbl_reviews_question.campaign_id, tbl_reviews_question.question_title, "
                . "tbl_reviews_question.media_url, tbl_reviews_question.question, tbl_reviews_question.status AS questionStatus, "
                . "tbl_reviews_question.created AS questionCreated, tbl_reviews_question.updated AS questionUpdated");
        $this->db->join("tbl_reviews_question_answers", "tbl_reviews_question_answers.question_id = tbl_reviews_question.id", "LEFT");

        if (!empty($id)) {
            $this->db->where('tbl_reviews_question_answers.id', $id);
        }
        $this->db->order_by('tbl_reviews_question_answers.id', 'DESC');
        $this->db->where('tbl_reviews_question.id', $questionID);
        $this->db->from('tbl_reviews_question');
        $result = $this->db->get();
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }


    /**
    * This function is used to delete the Question
    * @param type $quesId
    * @return type boolean
    */
    public function deleteQuestion($quesId) {

        $oData = DB::table('tbl_reviews_question')
                ->where('id', $quesId)
                ->delete();
        return true;
    }


    /**
    * This function is used to add the Question
    * @param type
    * @return type
    */

    public function addQuestion($aData) {
        $oData = DB::table('tbl_reviews_question')->insertGetId($aData);
        if (!empty($oData))
            return $oData;
        else
            return false;
    }


    /**
    * This function is used to save the question for tracking purpose
    * @param type $clientID
    * @return type
    */
    public function trackQuestionGeo($aData) {
      $oData =   DB::table('tbl_reviews_question_tracking_log')->insertGetId($aData);
        if (!empty($oData))
            return true;
        else
            return false;
    }


    /**
    * This function is used to add answer
    * @param type $aData
    * @return type boolean
    */
    public function addAnswer($aData) {

        $oData =   DB::table('tbl_reviews_question_answers')->insertGetId($aData);
        return true;
    }

    /**
    * This function is used to update answer
    * @param type $aData, $answerID
    * @return type boolean
    */
    public function updateAnswer($aData, $answerID) {

        $result = DB::table('tbl_reviews_question_answers')
                ->where('id', $answerID)
                ->update($aData);
        return true;
    }


    /**
    * This function is used to delete answer
    * @param type $aData, $answerID
    * @return type boolean
    */
    public function deleteAnswer($ansId) {

        $result = DB::table('tbl_reviews_question_answers')
                ->where('id', $ansId)
                ->delete();
        return true;
    }



    /* public function getQuesDetailByCamp($campId, $revId) {


      $response = array();
      $this->db->where('campaign_id', $campId);
      $this->db->where('review_id', $revId);
      $this->db->where('status', '1');
      $this->db->order_by('id', 'DESC');
      $this->db->from('tbl_reviews_question');
      $result = $this->db->get();
      if ($result->num_rows() > 0) {
      $response = $result->result();
      }
      return $response;
      } */
}
