<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CommentModel;
use Session;
use App\Libraries\Custom\Mobile_Detect;

class Comments extends Controller {

    /**
     * Comments Index function
     *
     */
    public function index() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $oMyComments = $this->mComment->getMyComment($userID);
        $this->template->load('admin/admin_template_new', 'admin/comments/mylist', array('oMyComments' => $oMyComments));
    }

    public function getCommentById() {

        $response = array();
        $response['status'] = 'error';
        $post = array();
        if ($this->input->post()) {
            $post = $this->input->post();
            $aComment = $this->mComment->getComment($post['commentID']);
            if ($aComment) {
                $response['status'] = 'success';
                $response['result'] = $aComment;
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    /**
     * Function use for add a comment
     *
     */
    public function addComment(Request $request) {

        $response = array();

        $mComment = new CommentModel();
          
            $reviewID = strip_tags($request->reviweId);
            $parentCommentId = strip_tags($request->parent_comment_id);
            $comment_content = strip_tags($request->comment_content);
            $aUser = getLoggedUser();
            $userID = $aUser->id;
            $parentCommentId = $parentCommentId == '' ? '0' : $parentCommentId;
            
            if(!empty($reviewID)){
                $oReviews = $mComment->getCommentReviewInfo($reviewID);
            }

            $aData = array(
                'review_id' => $reviewID,
                'user_id' => $userID,
                'content' => $comment_content,
                'parent_comment_id' => $parentCommentId,
                'created' => date("Y-m-d H:i:s")
            );
            
            if($oReviews->ownerID == $userID){
                $aData['status'] = 1;
            }

            $result = $mComment->addComment($aData);
            if ($result) {
                $response['status'] = 'success';
                $response['message'] = "Comment has been added successfully.";
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        
    }

    public function update_comment() {

        $response = array();
        $post = array();
        if ($this->input->post()) {
            $post = $this->input->post();

            $commentID = strip_tags($post['edit_commentid']);
            $edit_content = strip_tags($post['edit_content']);

            $aData = array(
                'content' => $edit_content
            );

            $result = $this->mComment->updateComment($aData, $commentID);
            if ($result) {
                $response['status'] = 'success';
                $response['message'] = "Comment has been updated successfully.";
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function updateComment() {

        $response = array();
        $post = array();
        if ($this->input->post()) {
            $post = $this->input->post();

            $commentID = strip_tags($post['comment_id']);
            $commentMsg = strip_tags($post['commentMsg']);

            $aData = array(
                'content' => $commentMsg
            );

            $result = $this->mComment->updateComment($aData, $commentID);
            if ($result) {
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function deleteComment() {
        $response = array();
        $post = $this->input->post();
        $commentId = strip_tags($post['commentId']);
        $result = $this->mComment->deleteComment($commentId);
        if ($result) {
            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }

    public function update_comment_status() {

        $response = array();
        $post = array();
        if ($this->input->post()) {
            $post = $this->input->post();

            $commentID = strip_tags($post['comment_id']);
            $status = strip_tags($post['status']);

            $aData = array(
                'status' => $status
            );

            $result = $this->mComment->updateComment($aData, $commentID);
            if ($result) {
                $response['status'] = 'success';
                $response['message'] = "Status has been updated successfully.";
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

}

?>