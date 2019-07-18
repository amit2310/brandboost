<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use DB;
use Cookie;
use Session;

class QuestionModel extends Model
{
	/**
     * get brandboost questions response
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
			->get();
        return $oData;
    }
	
	/**
     * get brandboost all answers of question response
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
	
	public function countAnsHelpful($answerID) {
		$result = array();
		$this->db->where("answer_id", $answerID);
		$rResponse = $this->db->get("tbl_reviews_answers_helpful");
		$yes = 0;
		$no = 0;
		//echo $this->db->last_query();
		if ($rResponse->num_rows() > 0) {
			$oResult = $rResponse->result();
			foreach ($oResult as $row) {
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
    
    public function getQuestionDetails($questionID){
        $response = array();
        $this->db->select("tbl_reviews_question.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email, tbl_users.mobile, tbl_users.avatar, "
                . "tbl_users_notification_settings.email_notify, tbl_users_notification_settings.system_notify");
        $this->db->join("tbl_users", "tbl_reviews_question.user_id = tbl_users.id", "LEFT");
        $this->db->join("tbl_users_notification_settings", "tbl_users_notification_settings.user_id = tbl_users.id", "LEFT");
        $this->db->where('tbl_reviews_question.id', $questionID);
        $this->db->from('tbl_reviews_question');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }
    
    public function saveQuestionNotes($aData) {
        $bSaved = $this->db->insert("tbl_reviews_question_notes", $aData);
        $insert_id = $this->db->insert_id();
        //echo $this->db->last_query();
        if ($bSaved)
            return $insert_id;
        return false;
    }
    
    public function getQuestionNotes($id) {
        if (!empty($id)) {
            $this->db->select("tbl_reviews_question_notes.*, tbl_users.firstname, tbl_users.lastname, tbl_users.email");
            $this->db->join("tbl_users", "tbl_reviews_question_notes.user_id=tbl_users.id", "LEFT");
            $this->db->where("tbl_reviews_question_notes.question_id", $id);
            $this->db->order_by("tbl_reviews_question_notes.id", "DESC");
            $result = $this->db->get("tbl_reviews_question_notes");
            //echo $this->db->last_query();
            //die;
            if ($result->num_rows() > 0) {
                $response = $result->result();
            }
            return $response;
        }
    }
    
    
    public function getQuestionNoteInfo($noteId) {

        $this->db->where('id', $noteId);
        $this->db->from('tbl_reviews_question_notes');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->row();
        }
        return $response;
    }
    
    public function updateQuestionNote($aData, $noteId) {

        $this->db->where('id', $noteId);
        $result = $this->db->update('tbl_reviews_question_notes', $aData);
        if ($result)
            return true;
        else
            return false;
    }
    
    public function deleteQuestionNote($noteId) {
        $this->db->where('id', $noteId);
        $result = $this->db->delete('tbl_reviews_question_notes');
        return true;
    }
    
   public function getAnswerInfo($answerID){
       $this->db->where('id', $answerID);
       $result = $this->db->get("tbl_reviews_question_answers");
        if ($result->num_rows() > 0) {
            $response = $result->row();
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

    public function getBrandboostQuestions($campId) {
        $response = array();
        $this->db->where('campaign_id', $campId);
        $this->db->where('status', '1');
        $this->db->order_by('id', 'DESC');
        $this->db->from('tbl_reviews_question');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

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

    public function updateQuestion($aData, $questionID) {

        $this->db->where('id', $questionID);
        $result = $this->db->update('tbl_reviews_question', $aData);
        /* echo $this->db->last_query();
          exit; */
        if ($result)
            return true;
        else
            return false;
    }

    public function deleteQuestion($quesId) {

        $this->db->where('id', $quesId);
        $result = $this->db->delete('tbl_reviews_question');
        if ($result)
            return true;
        else
            return false;
    }

    public function addQuestion($aData) {

        $result = $this->db->insert('tbl_reviews_question', $aData);
        $insert_id = $this->db->insert_id();
        if ($insert_id)
            return $insert_id;
        else
            return false;
    }

    public function trackQuestionGeo($aData) {
        $result = $this->db->insert('tbl_reviews_question_tracking_log', $aData);
        if ($result)
            return true;
        else
            return false;
    }

    public function addAnswer($aData) {

        $result = $this->db->insert('tbl_reviews_question_answers', $aData);
        if ($result)
            return true;
        else
            return false;
    }

    public function updateAnswer($aData, $answerID) {

        $this->db->where('id', $answerID);
        $result = $this->db->update('tbl_reviews_question_answers', $aData);
        /* echo $this->db->last_query();
          exit; */
        if ($result)
            return true;
        else
            return false;
    }

    public function deleteAnswer($ansId) {

        $this->db->where('id', $ansId);
        $result = $this->db->delete('tbl_reviews_question_answers');
        if ($result)
            return true;
        else
            return false;
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