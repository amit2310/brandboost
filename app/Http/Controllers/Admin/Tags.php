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
        $mTag = new TagsModel();

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs">Tags </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Tags Group" class="sidebar-control active hidden-xs ">Tags Group</a></li>
                    </ul>';

        $aBreadcrumb = array(
            'Home' => '#/',
            'Tags' => '#/contacts/tags/'
        );

        $aTag = $mTag->getClientTags($userID);

        if (!empty($aTag->items())) {
            foreach ($aTag->items() as $aUnit) {
                $aGroupID[$aUnit->id]['group_name'] = $aUnit->group_name;
                $aGroupID[$aUnit->id]['status'] = $aUnit->status;
                $aGroupID[$aUnit->id]['id'] = $aUnit->id;

                $tagIdArr[] = $aUnit->tagid;
            }
        }
        krsort($aGroupID);

        array_unique($tagIdArr);

        $TagSubscribers = [];
        if(!empty($tagIdArr)) {
            foreach ($tagIdArr as $tid) {
                $TagSubscribers[$tid] = $mTag->getSubscriberIDsByTagId($tid);
            }
        }

        $aData = array(
            'title' => 'Tags',
            'breadcrumb' => $aBreadcrumb,
            'allData' => $aTag,
            'aTag' => $aTag->items(),
            'aGroupID' => $aGroupID,
            'aTagSubscribers' => $TagSubscribers
        );
        //$aTag->aGroupID = $aGroupID;
//        return view ('admin.tags.index', array('title' => 'Insight Tags', 'pagename' => $breadcrumb, 'aTag' => $aTag));
        return $aData;;
    }

    /**
     * tags index function to load initial view of the tax groups
     * @param type
     * @return type
     */

    public function TagGroups() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $mTag = new TagsModel();

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs">Tags </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Tags Group" class="sidebar-control active hidden-xs ">Tags Group</a></li>
                    </ul>';
        $aBreadcrumb = array(
            'Home' => '#/',
            'TagGroups' => '#/tags/groups'
        );

        $aTagGroups = $mTag->getClientTagGroups($userID);

        $aData = array(
            'title' => 'Insight Tags',
            'pagename' => $breadcrumb,
            'breadcrumb' => $aBreadcrumb,
            'userID' => $userID,
            'allData' => $aTagGroups,
            'aTagGroups' => $aTagGroups->items()
        );

//        return view ('admin.tags.index', array('title' => 'Insight Tags', 'pagename' => $breadcrumb, 'aTag' => $aTag));
        echo json_encode($aData);
        exit;
    }

    /**
     * Used to get contact lists
     */
    public function getTagContacts(Request $request) {

        $tagID = strip_tags($request->tag_id);

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Tags model to get its methods and properties
        $mTag = new TagsModel();

        $oList = $mTag->getTagContacts($tagID);

        $tagName = $oList->items()[0]->tag_name;

        $aBreadcrumb = array(
            'Home' => '#/',
            'People' => '#/contacts/dashboard',
            'Tags' => '#/tags/',
            'Subscribers' => ''
        );

        $aData = array(
            'title' => 'Tags Subscribers',
            'breadcrumb' => $aBreadcrumb,
            'moduleName' => '',
            'moduleUnitID' => '',
            'moduleAccountID' => '',
            'tagName' => $tagName,
            'tag_id' => $tagID,
            'user_id' => $userID,
            'allData' => $oList,
            'subscribersData' => $oList->items(),
            'activeCount' => 0,
            'archiveCount' => 0
        );

        echo json_encode($aData);
        exit;

        //return view('admin.lists.list-contacts-beta', $aData);
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


    /**
    * This function is used to list all the feedback tags list
    * @param type $clientID
    * @return type
    */

    public function feedback($tagID) {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $mTag  = new TagsModel();

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

        return view ('admin.feedback.feedback', $data);
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
        $aBreadcrumb = array(
            'Home' => '#/',
            'Tags Review' => '#/tagsreview'
        );

        $tagData = $mTag->getAllClientTags($userID);

        if (!empty($tagData)) {
            foreach ($tagData as $tagDataVal) {
                $tagDataByIdCnt = $mTag->getReviewsByTagID($tagDataVal->id);
                $tagDataVal->TagDataById = !empty($tagDataByIdCnt) ? count($tagDataByIdCnt) : 0;
            }
        }

        $aData = array(
            'title' => 'Tag Reviews',
            'breadcrumb' => $aBreadcrumb,
            'allData' => $tagData,
            'atagData' => $tagData->items(),
            'aTag' => $tagData->items()
        );

        //return view ('admin.tags.tagsreview', array('title' => 'Tags Review', 'pagename' => $breadcrumb, 'tagData' => $tagData));

        echo json_encode($aData);
        exit;
    }


    /**
    * This function is used to list all feedback tags
    * @param type $clientID
    * @return type
    */
    public function tagsfeedback() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;

       $mTag = new TagsModel();
        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs">Tags </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Tags Feedbacks" class="sidebar-control active hidden-xs ">Tags Feedbacks</a></li>
                    </ul>';
        $aBreadcrumb = array(
            'Home' => '#/',
            'TagsFeedback' => '#/tagsfeedback'
        );

        $tagData = $mTag->getAllClientTags($userID);
        //return view ('admin.tags.tagsfeedback', array('title' => 'Tags Feedback', 'pagename' => $breadcrumb, 'tagData' => $tagData));4

        if (!empty($tagData)) {
            foreach ($tagData as $tagDataVal) {
                $tagDataByIdCnt = $mTag->getFeedbackByTagID($tagDataVal->id);
                $tagDataVal->TagDataById = !empty($tagDataByIdCnt) ? count($tagDataByIdCnt) : 0;
            }
        }

        $aData = array(
            'title' => 'Insight Tags Feedback',
            'uRole' => $userRole,
            'breadcrumb' => $aBreadcrumb,
            'allData' => $tagData,
            'atagData' => $tagData->items()
        );

        echo json_encode($aData);
        exit;
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

        $reviewID = $request->review_id;//base64_url_decode(strip_tags($request->review_id));
        $feedbackID = $request->feedback_id;//base64_url_decode(strip_tags($request->feedback_id));
        $questionID = $request->question_id;//base64_url_decode(strip_tags($request->question_id));

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

    public function listAllTagsWebchat(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $mTag = new TagsModel();

        if (empty($request) || empty($userID)) {
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

    public function listAllGroupTags(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        if (empty($request) || empty($userID)) {
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
        $validatedData = $request->validate([
            'txtGroupName' => ['required'],
            'description' => ['required']
        ]);

        $groupName = strip_tags($request->txtGroupName);
        $description = strip_tags($request->description);

        $bGroupExists = $mTag->checkifGroupExist($groupName, $userID);
        if ($bGroupExists == false) {
            $aInput = array(
                'user_id' => $userID,
                'group_name' => $groupName,
                'group_description' => $description,
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

        $validatedData = $request->validate([
            'txtTagName' => ['required'],
            'description' => ['required']
        ]);

        $tagName = strip_tags($request->txtTagName);
        $description = strip_tags($request->description);
        $bTagExists = $mTag->checkifGroupEntityExist($tagName, $userID);

        if ($bTagExists == false) {
            $groupID = strip_tags($request->groupID);
            $aInput = array(
                'group_id' => $groupID,
                'tag_name' => $tagName,
                'tag_description' => $description,
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

    public function editgroup(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        if (empty($request) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $mTag = new TagsModel();
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

    public function editgroupentity(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        if (empty($request) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $mTag = new TagsModel();
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

    public function updategroup(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        if (empty($request) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $mTag = new TagsModel();
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

    public function updategroupentity(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        if (empty($request) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $mTag = new TagsModel();
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

    public function deleteTagGroup(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        if (empty($request) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $mTag = new TagsModel();
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

    public function archiveMultipleTagGroups(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        if (empty($request) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $mTag = new TagsModel();
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

    public function deleteMultipleTagGroups(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        if (empty($request) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $mTag = new TagsModel();
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

        if (empty($request) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $mTag = new TagsModel();
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
                $response = array('status' => 'success', 'msg' => 'Tag deleted successfully!');
                echo json_encode($response);
                exit;
            } else {
                $response = array('status' => 'error', 'msg' => 'Something went wrong!');
                echo json_encode($response);
                exit;
            }
        }
    }

    public function deleteTagGroupEntityFromWeb(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $mTag = new TagsModel();
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

        $reviewID = $request->review_id;//base64_url_decode(strip_tags($request->review_id));
        $aTagID = $request->applytag;
        $aInput = array(
            'aTagIDs' => $aTagID,
            'review_id' => $reviewID
        );

        $bAdded = $mTag->addReviewTag($aInput);

        if ($bAdded) {

            //Get refreshed tag list
            $oTags = $mTag->getTagsDataByReviewID($reviewID);

            //$sTagDropdown = view("admin/tags/tag_dropdown", array('oTags' => $oTags, 'fieldName' => 'reviewid', 'fieldValue' => $reviewID, 'actionName' => 'review-tag', 'actionClass' => 'applyInsightTagsReviews'))->render();
            $sTagDropdown = view("admin/tags/tag_dropdown", array('oTags' => $oTags, 'fieldName' => 'reviewid', 'fieldValue' => $reviewID, 'actionName' => 'review-tag', 'actionClass' => 'applyInsightTagsReviewsNew'))->render();

            $response = array('status' => 'success', 'msg' => 'Tag added successfully!', 'refreshTags' => $sTagDropdown, 'id' => $reviewID);

        } else {
            $response = array('status' => 'error', 'msg' => 'Something went wrong!');
        }

        echo json_encode($response);
        exit;
    }

    public function applyFeedbackTag(Request $request) {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $mTag = new TagsModel();

        $feedbackID = $request->feedback_id;//base64_url_decode(strip_tags($request->feedback_id));
        $aTagID = $request->applytag;
        $aInput = array(
            'aTagIDs' => $aTagID,
            'feedback_id' => $feedbackID
        );

        $bAdded = $mTag->addFeedbackTag($aInput);

        if ($bAdded) {

            //Get refreshed tag list
            $oTags = $mTag->getTagsDataByFeedbackID($feedbackID);

            //$sTagDropdown = view("admin/tags/tag_dropdown", array('oTags' => $oTags, 'fieldName' => 'feedback_id', 'fieldValue' => base64_url_encode($feedbackID), 'actionName' => 'feedback-tag'))->render();
            $sTagDropdown = view("admin/tags/tag_dropdown", array('oTags' => $oTags, 'fieldName' => 'feedback_id', 'fieldValue' => $feedbackID, 'actionName' => 'feedback-tag', 'actionClass' => 'applyInsightTagsFeedbackNew'))->render();

            $response = array('status' => 'success', 'msg' => 'Tag added successfully!', 'refreshTags' => $sTagDropdown, 'id' => $feedbackID);

        } else {
            $response = array('status' => 'error', 'msg' => 'Something went wrong!');
        }

        echo json_encode($response);
        exit;
    }

    public function applyQuestionTag(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $mTag = new TagsModel();

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

            $sTagDropdown = view("admin.tags.tag_dropdown", array('oTags' => $oTags, 'fieldName' => 'question_id', 'fieldValue' => base64_url_encode($questionID), 'actionName' => 'question-tag', 'actionClass' => 'actionClass'))->render();

            $response = array('status' => 'success', 'msg' => 'Tag added successfully!', 'refreshTags' => $sTagDropdown, 'id' => $questionID);
            echo json_encode($response);
            exit;
        } else {
            $response = array('status' => 'error', 'msg' => 'Something went wrong!');
            echo json_encode($response);
            exit;
        }
    }

    public function getTagList(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $mTag = new TagsModel();

        if (empty($request) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $groupID = strip_tags($request->id);

        $aTagGroupDetails = $mTag->getTagGroupDetails($groupID);
        $aTags = $mTag->getTagList($groupID);

        //$sTagList = $this->load->view('admin/tags/taglist', array('aTags' => $aTags), true);
        //$response = array('status' => 'success', 'content' => $sTagList);
        $aBreadcrumb = array(
            'Home' => '#/',
            'Tag Group' => '#/tags/groups',
            'Tags' => '#/tags/list/'.$groupID
        );

        $aData = array(
            'title' => 'Insight Tags',
            'pagename' => $breadcrumb,
            'breadcrumb' => $aBreadcrumb,
            'userID' => $userID,
            'groupID' => $groupID,
            'allData' => $aTags,
            'aTags' => $aTags->items(),
            'aTagGroupDetails' => $aTagGroupDetails
        );

        echo json_encode($aData);
        exit;
    }

    public function selectReviewTags(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        if (empty($request) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $reviewID = strip_tags($request->review_id);
        $aTags = getTagsByReviewID($reviewID);

        echo json_encode($aTags);
        exit;
    }

    public function removeTag(Request $request) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $mTag = new TagsModel();
        if (empty($request) || empty($userID)) {
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

        //Instantiate Broadcast model to get its methods and properties
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

        //Instantiate Broadcast model to get its methods and properties
        $mTag = new TagsModel();

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

    /**
     * Used to add tag review under a tag group
     */
    public function addTagReviews(Request $request){
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        $validatedData = $request->validate([
            'tagReviewName' => ['required'],
            'tagGroupId' => ['required'],
            'tagReviewDescription' => ['required']
        ]);

        //Instantiate Tags model to get its methods and properties
        $mTag  = new TagsModel();

        $tagReviewName = $request->tagReviewName;
        $tagGroupId = $request->tagGroupId;
        $tagReviewDescription = $request->tagReviewDescription;

        //check for already
        $bDuplicate = $mTag->isDuplicateTagReview($tagGroupId, $tagReviewName, $userID);
        if ($bDuplicate == true) {
            //Display Error and ask to enter template name something else
            $response['status'] = 'error';
            $response['msg'] = 'duplicate';
        } else {
            //Insert Segment
            $aData = array(
                'group_id' => $tagGroupId,
                'tag_name' => $tagReviewName,
                'tag_description' => $tagReviewDescription,
                'tag_created' => date("Y-m-d H:i:s")
            );

            $tagReviewIdID = $mTag->createTagReview($aData);

            if ($tagReviewIdID) {
                $response = array('status' => 'success');
            } else {
                $response = array('status' => 'error');
            }
        }



        echo json_encode($response);
        exit;


    }

}
