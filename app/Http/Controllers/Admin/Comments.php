<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CommentModel;
use Session;
use App\Libraries\Custom\Mobile_Detect;
use Illuminate\Support\Facades\Input;

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

    /**
     * Function use for get comment by id
     *
     */
    public function getCommentById(Request $request) {

        $response = array();
        $response['status'] = 'error';

        if ($request->commentID) {
            $mComment = new CommentModel();
            $aComment = $mComment->getComment($request->commentID);
            if ($aComment->count() > 0) {
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

    public function update_comment(Request $request) {

        $response = array();

        if (!empty($request->edit_commentid)) {

            $commentID = strip_tags($request->edit_commentid);
            $edit_content = strip_tags($request->edit_content);

            $aData = array(
                'content' => $edit_content
            );
            $mComment = new CommentModel();
            $result = $mComment->updateComment($aData, $commentID);
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


    /**
    * This function is used to update the comment
    * @param type
    * @return type
    */

    public function updateComment(Request $request) {

        $response = array();

        if (!empty($request)) {


            $commentID = $request->comment_id;
            $commentMsg = $request->commentMsg;

            $aData = array(
                'content' => $commentMsg
            );
            $mComment = new CommentModel();
            $result = $mComment->updateComment($aData, $commentID);
            if ($result) {
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        }
    }


     /**
    * This function is used to delete the comment
    * @param type
    * @return type
    */

    public function deleteComment(Request $request) {
        $response = array();
        $mComment = new CommentModel();
        $commentId = $request->commentId;
        $result = $mComment->deleteComment($commentId);
        if ($result) {
            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }


    /**
    * This function is used to update the comment status
    * @param type
    * @return type
    */

    public function update_comment_status(Request $request) {

        $response = array();
        $mComment = new CommentModel();

        if (!empty($request)) {


            $commentID = $request->comment_id;
            $status = $request->status;

            $aData = array(
                'status' => $status
            );

            $result = $mComment->updateComment($aData, $commentID);
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
