<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\TagsModel;
use Cookie;
use Session;

class Tags extends Controller {


    /**
    * tags index function to load initial view of the module
    * @param type 
    * @return type
    */

    public function index() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs">Tags </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Tags Group" class="sidebar-control active hidden-xs ">Tags Group</a></li>
                    </ul>';

        $aTag = TagsModel::getClientTags($userID);
        return view ('admin.tags.index', array('title' => 'Insight Tags', 'pagename' => $breadcrumb, 'aTag' => $aTag));
    }

    public function review($tagID) {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $mTag = new TagsModel();

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a data-toggle="tooltip" data-placement="bottom" title="Tag Reviews" class="sidebar-control active hidden-xs ">Tag Reviews</a></li>
                </ul>';

        $aTag = TagsModel::getClientTags($userID);
        $getTagsReview = $mTag->getTagsReview($tagID);

        return view ('admin.tags.review_list', array('title' => 'Review List', 'pagename' => $breadcrumb, 'tag_id' => $tagID, 'tReview' => $getTagsReview));
    }

    public function feedback($tagID) {

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $user_role = $aUser->user_role;
        $tagFeedback = $mTag->getTagFeedback($userID, $user_role, $tagID);

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a data-toggle="tooltip" data-placement="bottom" title="Tag Feedback" class="sidebar-control active hidden-xs ">Tag Feedback</a></li>
                </ul>';

        $data = array(
            'title' => 'Tag Feedback',
            'pagename' => $breadcrumb,
            'result' => $tagFeedback
        );

        $this->template->load('admin/admin_template_new', 'admin/feedback/feedback', $data);
    }

    public function tagsreview() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $mTag = new TagsModel();

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs">Tags </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Tags Reviews" class="sidebar-control active hidden-xs ">Tags Reviews</a></li>
                    </ul>';

        $tagData = $mTag->getAllClientTags($userID);
        return view ('admin.tags.tagsreview', array('title' => 'Tags Review', 'pagename' => $breadcrumb, 'tagData' => $tagData));
    }

    public function tagsfeedback() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;


        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs">Tags </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Tags Feedbacks" class="sidebar-control active hidden-xs ">Tags Feedbacks</a></li>
                    </ul>';

        $tagData = $mTag->getAllClientTags($userID);
        $this->template->load('admin/admin_template_new', 'admin/tags/tagsfeedback', array('title' => 'Tags Feedback', 'pagename' => $breadcrumb, 'tagData' => $tagData));
    }

    public function listAllTags(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $mTag = new TagsModel();
        
        if (empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $reviewID = base64_url_decode(strip_tags($request->review_id));
        $feedbackID = base64_url_decode(strip_tags($request->feedback_id));
        $questionID = base64_url_decode(strip_tags($request->question_id));

        if ($reviewID > 0) {
            $aAppliedTags = $mTag->getTagsDataByReviewID($reviewID);
        }
        if ($feedbackID > 0) {
            $aAppliedTags = $mTag->getTagsDataByFeedbackID($feedbackID);
        }

        if ($questionID > 0) {
            $aAppliedTags = $mTag->getTagsDataByQuestionID($questionID);
        }
        $aTag = TagsModel::getClientTags($userID);
        $sTags = view('admin.tags.mytags', array('oTags' => $aTag, 'aAppliedTags' => $aAppliedTags))->render();
        $response = array('status' => 'success', 'list_tags' => $sTags);
        echo json_encode($response);
        exit;
    }

    public function listAllTagsWebchat() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        if (empty($post) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $reviewID = base64_url_decode(strip_tags($request->review_id));
        $feedbackID = base64_url_decode(strip_tags($request->feedback_id));
        $questionID = base64_url_decode(strip_tags($request->question_id));

        if ($reviewID > 0) {
            $aAppliedTags = $mTag->getTagsDataByReviewID($reviewID);
        }
        if ($feedbackID > 0) {
            $aAppliedTags = $mTag->getTagsDataByFeedbackID($feedbackID);
        }

        if ($questionID > 0) {
            $aAppliedTags = $mTag->getTagsDataByQuestionID($questionID);
        }
        $aTag = TagsModel::getClientTags($userID);
        $sTags = $this->load->view('admin/tags/mytags_Web', array('oTags' => $aTag, 'aAppliedTags' => $aAppliedTags), true);
        $response = array('status' => 'success', 'list_tags' => $sTags);
        echo json_encode($response);
        exit;
    }

    public function listAllGroupTags() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        if (empty($post) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aTag = TagsModel::getClientTags($userID);
        $sTags = $this->load->view('admin/tags/mygrouptags', array('aTag' => $aTag), true);
        $response = array('status' => 'success', 'list_tags' => $sTags);
        echo json_encode($response);
        exit;
    }


    /**
    * This function is used to add the new tag Group
    * @param type $clientID
    * @return type
    */

    public function addgroup(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $mTag  = new TagsModel();
        
        if (empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }


        $groupName = strip_tags($request->txtGroupName);
        $bGroupExists = $mTag->checkifGroupExist($groupName, $userID);
        if ($bGroupExists == false) {
            $aInput = array(
                'user_id' => $userID,
                'group_name' => $groupName,
                'group_created' => date("Y-m-d H:i:s")
            );
            $groupID = $mTag->addTagGroup($aInput);
            $response = array('status' => 'success', 'group_id' => $groupID, 'msg' => 'Group added successfully!');
            echo json_encode($response);
            exit;
        } else {
            $response = array('status' => 'error', 'type' => 'duplicate_entry', 'msg' => 'Group name is already exists');
            echo json_encode($response);
            exit;
        }
    }

    /**
    * This function is used to add the tag to the group
    * @param type $clientID
    * @return type
    */

    public function addgroupentity(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $mTag = new TagsModel();
        
        if (empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }


        $tagName = strip_tags($request->txtTagName);
        $bTagExists = $mTag->checkifGroupEntityExist($tagName, $userID);

        if ($bTagExists == false) {
            $groupID = strip_tags($request->groupID);
            $aInput = array(
                'group_id' => $groupID,
                'tag_name' => $tagName,
                'tag_created' => date("Y-m-d H:i:s")
            );
            $tagID = $mTag->addTagGroupEntity($aInput);
            if (!empty($tagID)) {
                $response = array('status' => 'success', 'tag_id' => $tagID, 'msg' => 'Tag added successfully!');
                echo json_encode($response);
                exit;
            } else {
                $response = array('status' => 'error', 'msg' => 'Something went wrong!');
                echo json_encode($response);
                exit;
            }
        } else {
            $response = array('status' => 'error', 'type' => 'duplicate_entry', 'msg' => 'Tag name is already exists!');
            echo json_encode($response);
            exit;
        }
    }

    public function editgroup() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        if (empty($post) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $groupID = strip_tags($request->groupid);
        $aGroup = $mTag->getTagGroupInfo($groupID);
        if (!empty($aGroup)) {
            $response = array('status' => 'success', 'group_id' => $aGroup->id, 'group_name' => $aGroup->group_name, 'msg' => 'Success!');
            echo json_encode($response);
            exit;
        } else {
            $response = array('status' => 'error', 'msg' => 'Something went wrong!');
            echo json_encode($response);
            exit;
        }
    }

    public function editgroupentity() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        if (empty($post) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $tagID = strip_tags($request->tagID);
        $aTag = $mTag->getTagGroupEntityInfo($tagID);
        if (!empty($aTag)) {
            $response = array('status' => 'success', 'tag_id' => $aTag->id, 'tag_name' => $aTag->tag_name, 'group_id' => $aTag->group_id, 'msg' => 'Success!');
            echo json_encode($response);
            exit;
        } else {
            $response = array('status' => 'error', 'msg' => 'Something went wrong!');
            echo json_encode($response);
            exit;
        }
    }

    public function updategroup() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        if (empty($post) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }


        $groupName = strip_tags($request->txtEditGroupName);
        $bGroupExists = $mTag->checkifGroupExist($groupName, $userID);
        if ($bGroupExists == false) {
            $groupID = strip_tags($request->groupID);
            $aInput = array(
                'group_name' => $groupName
            );
            $bUpdated = $mTag->updateTagGroup($aInput, $groupID);
            if ($bUpdated) {
                $response = array('status' => 'success', 'msg' => 'Tag group updated successfully!');
                echo json_encode($response);
                exit;
            } else {
                $response = array('status' => 'error', 'msg' => 'Something went wrong!');
                echo json_encode($response);
                exit;
            }
        } else {
            $response = array('status' => 'error', 'type' => 'duplicate_entry', 'msg' => 'Group name is already exists');
            echo json_encode($response);
            exit;
        }
    }

    public function updategroupentity() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        if (empty($post) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }


        $tagName = strip_tags($request->txtEditTagName);

        $bGroupExists = $mTag->checkifGroupEntityExist($tagName, $userID);
        if ($bGroupExists == false) {
            $tagID = strip_tags($request->tagID);
            $aInput = array(
                'tag_name' => $tagName
            );
            $bUpdated = $mTag->updateTagGroupEntity($aInput, $tagID);
            if ($bUpdated) {
                $response = array('status' => 'success', 'msg' => 'Tag group updated successfully!');
                echo json_encode($response);
                exit;
            } else {
                $response = array('status' => 'error', 'msg' => 'Something went wrong!');
                echo json_encode($response);
                exit;
            }
        } else {
            $response = array('status' => 'error', 'type' => 'duplicate_entry', 'msg' => 'Tag name is already exists');
            echo json_encode($response);
            exit;
        }
    }

    public function deleteTagGroup() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        if (empty($post) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $id = strip_tags($request->id);
        if (!empty($id)) {
            $bDeleted = $mTag->deleteTagGroup($id);
            if ($bDeleted) {
                $response = array('status' => 'success', 'msg' => 'Tag group deleted successfully!');
                echo json_encode($response);
                exit;
            } else {
                $response = array('status' => 'error', 'msg' => 'Something went wrong!');
                echo json_encode($response);
                exit;
            }
        }
    }

    public function archiveMultipleTagGroups() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        if (empty($post) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $id = $request->multipal_record_id;
        if (!empty($id)) {

            foreach ($id as $groupID) {
                $aInput = array(
                    'status' => 2
                );
                $bUpdated = $mTag->updateTagGroup($aInput, $groupID);
            }

            if ($bUpdated) {
                $response = array('status' => 'success', 'msg' => 'Tag group deleted successfully!');
                echo json_encode($response);
                exit;
            } else {
                $response = array('status' => 'error', 'msg' => 'Something went wrong!');
                echo json_encode($response);
                exit;
            }
        }
    }

    public function deleteMultipleTagGroups() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        if (empty($post) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $id = $request->multipal_record_id;
        if (!empty($id)) {

            foreach ($id as $tagID) {
                $bDeleted = $mTag->deleteTagGroup($tagID);
            }

            if ($bDeleted) {
                $response = array('status' => 'success', 'msg' => 'Tag group deleted successfully!');
                echo json_encode($response);
                exit;
            } else {
                $response = array('status' => 'error', 'msg' => 'Something went wrong!');
                echo json_encode($response);
                exit;
            }
        }
    }

    public function deleteMultipalTagGroupEntity() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        if (empty($post) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $multiTagId = $request->multiTagId;

        if (!empty($multiTagId)) {
            foreach ($multiTagId as $id) {
                $bDeleted = $mTag->deleteTagGroupEntity($id);
                if ($bDeleted) {
                    $response = array('status' => 'success', 'msg' => 'Tag group deleted successfully!');
                } else {
                    $response = array('status' => 'error', 'msg' => 'Something went wrong!');
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    /**
    * This function is used to delete Group Entity on the behaof of the group entity id
     * @param type $id
    * @return type
    */

    public function deleteTagGroupEntity(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $mTag = new TagsModel();
        if (empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $id = strip_tags($request->id);
        if (!empty($id)) {
            $bDeleted = $mTag->deleteTagGroupEntity($id);
            if ($bDeleted) {
                $response = array('status' => 'success', 'msg' => 'Tag group deleted successfully!');
                echo json_encode($response);
                exit;
            } else {
                $response = array('status' => 'error', 'msg' => 'Something went wrong!');
                echo json_encode($response);
                exit;
            }
        }
    }

    public function deleteTagGroupEntityFromWeb() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        $grpid = $request->grpid;
        $tag_id = $request->tag_id;
        $review_id = $request->review_id;

        if (empty($review_id) || empty($tag_id)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        if (!empty($review_id) && !empty($tag_id)) {
            $bDeleted = $mTag->deleteTagGroupEntityWebchat($review_id, $tag_id);
            if ($bDeleted) {
                $response = array('status' => 'success', 'msg' => 'Tag group deleted successfully!');
                echo json_encode($response);
                exit;
            } else {
                $response = array('status' => 'error', 'msg' => 'Something went wrong!');
                echo json_encode($response);
                exit;
            }
        }
    }


    /**
     * this function is used to add the tags in the system
     * @return type boolean
     */

    public function applyReviewTag(Request $request) {


        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $mTag = new TagsModel();
       
        $reviewID = base64_url_decode(strip_tags($request->review_id));
        $aTagID = $request->applytag;
        $aInput = array(
            'aTagIDs' => $aTagID,
            'review_id' => $reviewID
        );

        $bAdded = $mTag->addReviewTag($aInput);

        if ($bAdded) {

            //Get refreshed tag list
            $oTags = $mTag->getTagsDataByReviewID($reviewID);

            $sTagDropdown = view("admin/tags/tag_dropdown", array('oTags' => $oTags, 'fieldName' => 'reviewid', 'fieldValue' => base64_url_encode($reviewID), 'actionName' => 'review-tag', 'actionClass' => 'applyInsightTagsReviews'))->render();

            $response = array('status' => 'success', 'msg' => 'Tag added successfully!', 'refreshTags' => $sTagDropdown, 'id' => $reviewID);
            echo json_encode($response);
            exit;
        } else {
            $response = array('status' => 'error', 'msg' => 'Something went wrong!');
            echo json_encode($response);
            exit;
        }
    }

    public function applyFeedbackTag() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        if (empty($post) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $feedbackID = base64_url_decode(strip_tags($request->feedback_id));
        $aTagID = $request->applytag;
        $aInput = array(
            'aTagIDs' => $aTagID,
            'feedback_id' => $feedbackID
        );

        $bAdded = $mTag->addFeedbackTag($aInput);

        if ($bAdded) {

            //Get refreshed tag list
            $oTags = $mTag->getTagsDataByFeedbackID($feedbackID);

            $sTagDropdown = $this->load->view("admin/tags/tag_dropdown", array('oTags' => $oTags, 'fieldName' => 'feedback_id', 'fieldValue' => base64_url_encode($feedbackID), 'actionName' => 'feedback-tag'), true);

            $response = array('status' => 'success', 'msg' => 'Tag added successfully!', 'refreshTags' => $sTagDropdown, 'id' => $feedbackID);
            echo json_encode($response);
            exit;
        } else {
            $response = array('status' => 'error', 'msg' => 'Something went wrong!');
            echo json_encode($response);
            exit;
        }
    }

    public function applyQuestionTag() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        if (empty($post) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $questionID = base64_url_decode(strip_tags($request->question_id));
        $aTagID = $request->applytag;
        $aInput = array(
            'aTagIDs' => $aTagID,
            'question_id' => $questionID
        );

        $bAdded = $mTag->addQuestionTag($aInput);

        if ($bAdded) {

            //Get refreshed tag list
            $oTags = $mTag->getTagsDataByQuestionID($questionID);

            $sTagDropdown = $this->load->view("admin/tags/tag_dropdown", array('oTags' => $oTags, 'fieldName' => 'question_id', 'fieldValue' => base64_url_encode($questionID), 'actionName' => 'question-tag'), true);

            $response = array('status' => 'success', 'msg' => 'Tag added successfully!', 'refreshTags' => $sTagDropdown, 'id' => $questionID);
            echo json_encode($response);
            exit;
        } else {
            $response = array('status' => 'error', 'msg' => 'Something went wrong!');
            echo json_encode($response);
            exit;
        }
    }

    public function getTagList() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        if (empty($post) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $groupID = strip_tags($request->groupID);
        $aTags = $mTag->getTagList($groupID);
        $sTagList = $this->load->view('admin/tags/taglist', array('aTags' => $aTags), true);
        $response = array('status' => 'success', 'content' => $sTagList);
        echo json_encode($response);
        exit;
    }

    public function selectReviewTags() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        if (empty($post) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $reviewID = strip_tags($request->review_id);
        $aTags = getTagsByReviewID($reviewID);

        echo json_encode($aTags);
        exit;
    }

    public function removeTag() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        if (empty($post) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $reviewID = strip_tags($request->review_id);
        $feedbackID = strip_tags($request->feedback_id);
        $tagID = strip_tags($request->tag_id);

        if (!empty($reviewID) && $reviewID > 0) {
            $bDeleted = $mTag->removeReviewTag($tagID, $reviewID);
        }

        if (!empty($feedbackID) && $feedbackID > 0) {
            $bDeleted = $mTag->removeFeedbackTag($tagID, $reviewID);
        }

        if ($bDeleted) {
            $response = array('status' => 'success', 'msg' => 'Tag has been removed successfully!');
            echo json_encode($response);
            exit;
        } else {
            $response = array('status' => 'error', 'msg' => 'Something went wrong!');
            echo json_encode($response);
            exit;
        }
    }

    public function getAllSubscriberTags($iSubscriberID) {
        //Get Feedback Tags
    }

    /**
     * Used to get list of subscriber tags
     * @param Request $request
     */
    public function getSubscriberTags(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        //Instanciate Broadcast model to get its methods and properties
        $mTag = new TagsModel();
        
        
        $subscriberID = strip_tags($request->subscriberId);

        $aTag = TagsModel::getClientTags($userID);
        $aSubscriberTags = TagsModel::getSubscriberTags($subscriberID);

        $sTags = view('admin.tags.mytags', array('oTags' => $aTag, 'aAppliedTags' => $aSubscriberTags))->render();
        $response = array('status' => 'success', 'list_tags' => $sTags);
        echo json_encode($response);
        exit;
    }
    
    /**
     * Used to apply user tags to subscriber
     */
    public function applySubscriberTag(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        
        //Instanciate Broadcast model to get its methods and properties
        $mTag = new TagsModel();
        
        if (empty($request) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $subscriberID = strip_tags($request->tag_subscriber_id);
        $aTagID = $request->applytag;
        $aInput = array(
            'aTagIDs' => $aTagID,
            'subscriber_id' => $subscriberID
        );

        $bAdded = $mTag->addSubscriberTag($aInput);

        //Get refreshed tag list
        $oTags = $mTag->getSubscriberTags($subscriberID);

        //$sTagDropdown = $this->load->view("admin/tags/subscriber_tag_dropdown", array('oTags' => $oTags, 'fieldName'=> 'data-subscriber-id', 'fieldValue'=> $subscriberID, 'actionName'=> 'subscriber-tag'), true);
        $sTagDropdown = view('admin.tags.tag_dropdown', ['oTags' => $oTags, 'fieldName' => 'data-subscriber-id', 'fieldValue' => $subscriberID, 'actionName' => 'subscriber-tag', 'actionClass' => 'applyInsightTags'])->render();

        if ($bAdded) {
            $response = array('status' => 'success', 'msg' => 'Tag added successfully!', 'refreshTags' => $sTagDropdown);
            echo json_encode($response);
            exit;
        } else {
            $response = array('status' => 'error', 'msg' => 'Something went wrong!');
            echo json_encode($response);
            exit;
        }
    }

    public function exportTags() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $oTags = TagsModel::getClientTags($userID);


        $filename = 'tags_' . time() . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");
        //echo "Hello";
        //die;
        // file creation 
        $file = fopen('php://output', 'w');

        $header = array("TAG_GROUP", "TAG_NAME", "TAG_DATE");
        fputcsv($file, $header);

        foreach ($oTags as $key => $line) {
            fputcsv($file, array($line->group_name, $line->tag_name, $line->tag_created));
        }
        fclose($file);
        //Log Export History
        if (!empty($oTags)) {
            $aHistoryData = array(
                'user_id' => $userID,
                'export_name' => 'Tags',
                'item_count' => count($oTags),
                'created' => date("Y-m-d H:i:s")
            );
            $this->mSettings->logExportHistory($aHistoryData);
        }
        exit;
    }

}
