<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Admin\ListsModel;
use App\Models\Admin\WorkflowModel;
use App\Models\Admin\UsersModel;
use App\Models\Admin\SubscribersModel;
use App\Libraries\Custom\csvimport;

use Cookie;
use Session;

class Lists extends Controller {

    /**
     * Default controller
     */
    public function index()
    {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Users model to get its methods and properties
        $mUser = new UsersModel();


        $userDetail = $mUser->getAllUsers($userID);
        $userRole = $userDetail[0]->user_role;
        if ($userRole != '1') {
            $oLists = $mLists->getLists($userID);
        } else {
            $oLists = $mLists->getLists();
        }

        //$oContacts = $mLists->getListContacts($userID);
        $bActiveSubsription = $mUser->isActiveSubscription();

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs">Email </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Lists" class="sidebar-control active hidden-xs ">Lists</a></li>
                    </ul>';

        /* Computed Data In A List */
        if (count($oLists) > 0) {

            $newolists = array();

            $archiveList = $activeList = 0;
            foreach ($oLists as $value) {
                $newolists[$value->id][] = $value;
            }

            $totEmailCount = 0;
            $totSMSCount = 0;
            $totUnsubscribeCount = 0;
            $newEmails = $newSMS = $newUnsubs = 0;

            foreach ($newolists as $countObject) {

                if ($countObject[0]->status == 'archive') {
                    $archiveList++;
                } else {
                    $activeList++;
                }

                $lastList = end($countObject);
                //pre($lastList->l_created);
                if (!empty($lastList->l_created)) {
                    $lastListTime = timeAgo($lastList->l_created);
                } else {
                    $lastListTime = '<div class="media-left">
                                                          <div class="">
                                                            <span class="text-muted text-size-small">[No Data]</span>                                                          </div>
                                                        </div>';
                }
                //pre($lastListTime);
                if (!empty($countObject[0]->l_list_id)) {
                    $totAll = count($countObject);
                } else {
                    $totAll = 0;
                }

                foreach ($countObject as $value) {

                    if (!empty($value->l_email)) {
                        $totEmailCount++;
                    }
                    if (!empty($value->l_phone)) {
                        $totSMSCount++;
                    }
                    if (!empty($value->l_status) && $value->l_status == '0') {
                        $totUnsubscribeCount++;
                    }
                }

                $countObject = $countObject[0];

                $totalContacts = $totAll;
                $totalEmailGraph = 0;
                $totalSMSGraph = 0;
                $totalUnsubGraph = 0;

                if ($totalContacts > 0) {
                    $totalEmailGraph = $totEmailCount * 100 / $totalContacts;
                    $totalEmailGraph = ceil($totalEmailGraph);

                    $totalSMSGraph = $totSMSCount * 100 / $totalContacts;
                    $totalSMSGraph = ceil($totalSMSGraph);

                    $totalUnsubGraph = $totUnsubscribeCount * 100 / $totalContacts;
                    $totalUnsubGraph = ceil($totalUnsubGraph);
                }
            }

            $addPC = '';
            if ($totalEmailGraph > 50)
                $addPC = 'over50';
            //$newolists1 = arrayToObject($newolists);
            //print_r($newolists1);
            $aData = array(
                'title' => 'Lists',
                'pagename' => $breadcrumb,
                'oLists' => $oLists,
                'newolists' => $newolists,
                'bActiveSubsription' => $bActiveSubsription,
                'uRole' => $userRole,
                'listtype' => 'email',
                'archiveList' => $archiveList,
                'activeList' => $activeList,
                'totAll' => $totAll,
                'totalContacts' => $totalContacts,
                'totEmailCount' => $totEmailCount,
                'totSMSCount' => $totSMSCount,
                'totUnsubscribeCount' => $totUnsubscribeCount,
                'newEmails' => $newEmails,
                'newSMS' => $newSMS,
                'newUnsubs' => $newUnsubs,
                'totalEmailGraph' => $totalEmailGraph,
                'totalSMSGraph' => $totalSMSGraph,
                'totalUnsubGraph' => $totalUnsubGraph,
                'addPC' => $addPC,
                'lastListTime' => $lastListTime
            );
        }
        /* Computed Data In A List */

        //return view('admin.lists.index', $aData);

        echo json_encode($aData)."^^^^^".json_encode($newolists);
        exit();
    }

    /**
     * Convert Array into Object
     */
    public function arrayToObject($d) {
        if (is_array($d)) {
            /*
            * Return array converted to object
            * Using __FUNCTION__ (Magic constant)
            * for recursive call
            */
            return (object) array_map(__FUNCTION__, $d);
        }
        else {
            // Return object
            return $d;
        }
    }

    /**
     * Used to get Sms lists
     */
    public function smslists() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Users model to get its methods and properties
        $mUser = new UsersModel();


        $userDetail = $mUser->getAllUsers($userID);
        $userRole = $userDetail[0]->user_role;
        if ($userRole != '1') {
            $oLists = $mLists->getLists($userID);
        } else {
            $oLists = $mLists->getLists();
        }
        //$oContacts = $mLists->getListContacts($userID);
        $bActiveSubsription = $mUser->isActiveSubscription();

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs">SMS </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Lists" class="sidebar-control active hidden-xs ">Lists</a></li>
                    </ul>';

        $aData = array(
            'title' => 'Lists',
            'pagename' => $breadcrumb,
            'oLists' => $oLists,
            'bActiveSubsription' => $bActiveSubsription,
            'uRole' => $userRole,
            'listtype' => 'sms'
        );
        return view('admin.lists.index', $aData);
    }


    /**
     * Used to get contact lists
     */
    public function getListContacts(Request $request) {

        $listID = strip_tags($request->list_id);

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Users model to get its methods and properties
        $mUser = new UsersModel();

        //Instantiate Workflow model to get its methods and properties
        $mWorkflow = new WorkflowModel();

        $moduleName = 'list';
        $moduleUnitID = $listID;
        $subscribersData = $mWorkflow->getWorkflowSubscribers($moduleUnitID, $moduleName);
        $oList = $mLists->getLists('', $listID);

        $listName = $oList[0]->list_name;

        if ($oList[0]->user_id != $userID) {
            redirect('admin/lists');
            exit();
        }
        $bActiveSubsription = $mUser->isActiveSubscription();
        $aBreadcrumb = array(
            'Home' => '#/',
            'People' => '#/contacts/dashboard',
            'Lists' => '#/lists/',
            'Subscribers' => ''
        );
        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/lists') . '">Email</a> </li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/lists') . '">Lists</a> </li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a data-toggle="tooltip" data-placement="bottom" title="' . $listName . '" class="sidebar-control active hidden-xs ">' . $listName . '</a></li>
                </ul>';

        $aData = array(
            'title' => 'List Subscribers',
            'allData' => $subscribersData,
            'subscribersData' => $subscribersData->items(),
            'pagename' => $breadcrumb,
            'breadcrumb' => $aBreadcrumb,
            'moduleName' => $moduleName,
            'moduleUnitID' => $moduleUnitID,
            'moduleAccountID' => '',
            'listName' => $listName,
            'activeCount' => 0,
            'archiveCount' => 0,
            'list_id' => $listID,
            'listtype' => 'email',
            'bActiveSubsription' => $bActiveSubsription
        );
        echo json_encode($aData);
        exit;
        //return view('admin.lists.list-contacts-beta', $aData);
    }


    /**
     * Used to get SMS list contacts
     */
    public function getSMSListContacts(Request $request) {

        $listID = strip_tags($request->list_id);
        $aUser = getLoggedUser();

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Users model to get its methods and properties
        $mUser = new UsersModel();

        //Instantiate Workflow model to get its methods and properties
        $mWorkflow = new WorkflowModel();


        $userID = $aUser->id;
        $moduleName = 'list';
        $moduleUnitID = $listID;
        $subscribersData = $mWorkflow->getWorkflowSubscribers($moduleUnitID, $moduleName);
        $oList = $mLists->getLists('', $listID);
        $listName = $oList[0]->list_name;

        if ($oList[0]->user_id != $userID) {
            redirect('admin/lists');
            exit();
        }
        $bActiveSubsription = $mUser->isActiveSubscription();

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/lists/smslists') . '">SMS</a> </li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/lists/smslists') . '">Lists</a> </li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a data-toggle="tooltip" data-placement="bottom" title="' . $listName . '" class="sidebar-control active hidden-xs ">' . $listName . '</a></li>
                </ul>';

        $aData = array(
            'title' => 'List Contacts : '.$listName,
            'subscribersData' => $subscribersData,
            'pagename' => $breadcrumb,
            'moduleName' => $moduleName,
            'moduleUnitID' => $moduleUnitID,
            'listName' => $listName,
            'listtype' => 'sms',
            'bActiveSubsription' => $bActiveSubsription
        );
        return view('admin.lists.list-contacts-beta', $aData);
    }


    /**
     * Used to get contact details
     */
    public function getContactDetail(Request $request) {

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();



        $subscriberId = $request->subscriberId;
        $oContactsDetail = $mLists->getContactDetail($subscriberId);
        $oContactsDetail = $oContactsDetail[0];

        $firstname = $oContactsDetail->firstname;
        $lastname = $oContactsDetail->lastname;
        $email = $oContactsDetail->email;
        $phone = $oContactsDetail->phone;
        $subscriberId = $oContactsDetail->id;
        if (!empty($oContactsDetail)) {
            $response = array('status' => 'success', 'firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'phone' => $phone, 'subscriberId' => $subscriberId);
        } else {
            $response = array('status' => 'error', 'msg' => 'Not found');
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to update subscriber details
     */
    public function updateSubscriber(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Users model to get its methods and properties
        $mUser = new UsersModel();

        //Instantiate Subscriber model to get its methods and properties
        $mSubscriber = new SubscriberModel();




        $firstName = strip_tags($request->firstname);
        $lastName = strip_tags($request->lastname);
        $email = strip_tags($request->email);
        $phone = strip_tags($request->phone);
        $subscriberId = strip_tags($request->subscriberId);
        $bInsertedNewGlobalSubscriber = false;

        if (!empty($email)) {
            $oGlobalUser = $mSubscriber->checkIfGlobalSubscriberExists($userID, 'email', $email);
            if (!empty($oGlobalUser)) {
                $iSubscriberID = $oGlobalUser->id;
                $aGlobalUserData = array(
                    'email' => $email,
                    'firstname' => $firstName,
                    'lastname' => $lastName,
                    'phone' => $phone,
                    'updated' => date("Y-m-d H:i:s")
                );
                $mSubscriber->updateGlobalSubscriber($aGlobalUserData, $iSubscriberID);
                $response = array('status' => 'success', 'msg' => "Subscriber updated successfully!");
            } else {
                //Add global subscriber
                $emailUser = $mUser->checkEmailExist($email);
                if (!empty($emailUser)) {
                    $emailUserId = $emailUser[0]->id;
                }

                $aSubscriberData = array(
                    'owner_id' => $userID,
                    'firstName' => $firstName,
                    'lastName' => $lastName,
                    'email' => $email,
                    'phone' => $phone,
                    'created' => date("Y-m-d H:i:s")
                );
                if (!empty($emailUserId)) {
                    $aSubscriberData['user_id'] = $emailUserId;
                }
                $iSubscriberID = $mSubscriber->addGlobalSubscriber($aSubscriberData);
                $bInsertedNewGlobalSubscriber = true;
            }
        }

        if ($bInsertedNewGlobalSubscriber == true) {
            $aData = array(
                'subscriber_id' => $iSubscriberID
            );

            $res = $mLists->updateListSubscriberDetail($aData, $subscriberId);

            if ($res) {
                $response = array('status' => 'success', 'msg' => "Subscriber updated successfully!");
            }
        }
        echo json_encode($response);
        exit;
    }


    /**
     * Used to create a new list
     */
    public function addList(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        $title = strip_tags($request->title);
        $listDescription = strip_tags($request->listDescription);
        $dateTime = date("Y-m-d H:i:s");
        $aData = array(
            'list_name' => $title,
            'description' => $listDescription,
            'user_id' => $userID,
            'list_created' => $dateTime
        );

        $bAlreadyExists = $mLists->checkIfListExists($title, $userID, '');
        if ($bAlreadyExists == true) {
            $response = array('status' => 'error', 'type' => 'duplicate', 'msg' => 'List name already exists');
            echo json_encode($response);
            exit;
        }

        $insertID = $mLists->addLists($aData);
        if ($insertID > 0) {
            //Add Useractivity log
            $aActivityData = array(
                'user_id' => $userID,
                'event_type' => 'manage_lists',
                'action_name' => 'added_list',
                'list_id' => $insertID,
                'brandboost_id' => '',
                'campaign_id' => '',
                'inviter_id' => '',
                'subscriber_id' => '',
                'feedback_id' => '',
                'activity_message' => 'Added a new contact list',
                'activity_created' => date("Y-m-d H:i:s")
            );
            logUserActivity($aActivityData);
            $response = array('status' => 'success', 'list_id' => $insertID, 'msg' => "Lists added successfully!");

            $notificationData = array(
                'event_type' => 'added_new_list',
                'event_id' => 0,
                'link' => base_url() . 'admin/lists/getListContacts?list_id=' . $insertID,
                'message' => 'Created new list.',
                'user_id' => $userID,
                'status' => 1,
                'created' => date("Y-m-d H:i:s")
            );
            $eventName = 'sys_list_added';
            add_notifications($notificationData, $eventName, $userID);
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to fetch lists
     */
    public function getList(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Users model to get its methods and properties
        $mUser = new UsersModel();


        $listID = strip_tags($request->list_id);

        $userDetail = $mUser->getAllUsers($userID);
        $userRole = $userDetail[0]->user_role;
        if ($userRole != '1') {
            $oList = $mLists->getLists($userID, $listID);
        } else {
            $userID = '';
            $oList = $mLists->getLists($userID, $listID);
        }


        if (!empty($oList)) {
            $response = array('status' => 'success', 'title' => $oList[0]->list_name, 'description' => $oList[0]->description);
        } else {
            $response = array('status' => 'error', 'msg' => 'Not found');
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to update contact lists
     */

    public function updateList(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Users model to get its methods and properties
        $mUser = new UsersModel();


        $listID = strip_tags($request->list_id);
        $title = strip_tags($request->title);
        $description = strip_tags($request->edit_description);
        $dateTime = date("Y-m-d H:i:s");
        $aData = array(
            'list_name' => $title,
            'description' => $description
        );

        $bAlreadyExists = $mLists->checkIfListExists($title, $userID, $listID);
        if ($bAlreadyExists == true) {
            $response = array('status' => 'error', 'type' => 'duplicate', 'msg' => 'List name already exists');
            echo json_encode($response);
            exit;
        }

        $userDetail = $mUser->getAllUsers($userID);
        $userRole = $userDetail[0]->user_role;
        if ($userRole != '1') {
            $bUpdated = $mLists->updateLists($aData, $listID, $userID);
        } else {
            $userID = '';
            $bUpdated = $mLists->updateLists($aData, $listID, $userID);
        }

        if ($bUpdated) {
            //Add Useractivity log
            $aActivityData = array(
                'user_id' => $userID,
                'event_type' => 'manage_lists',
                'action_name' => 'updated_list',
                'list_id' => $listID,
                'brandboost_id' => '',
                'campaign_id' => '',
                'inviter_id' => '',
                'subscriber_id' => '',
                'feedback_id' => '',
                'activity_message' => 'Updated contact list',
                'activity_created' => date("Y-m-d H:i:s")
            );
            logUserActivity($aActivityData);
            $response = array('status' => 'success', 'msg' => "List updated successfully!");
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to make archive lists in bulk
     */
    public function archiveMultipalLists(Request $request) {

        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();


        $user_role = $aUser->user_role;
        if ($user_role == 1) {
            $userID = '';
        }
        $multiListId = $request->multi_list_id;

        if (!empty($multiListId)) {
            foreach ($multiListId as $listID) {
                $bArchived = $mLists->archiveLists($listID, $userID);

                if ($bArchived == true) {
                    //Add Useractivity log
                    $aActivityData = array(
                        'user_id' => $aUser->id,
                        'event_type' => 'manage_lists',
                        'action_name' => 'archive_list',
                        'list_id' => $listID,
                        'brandboost_id' => '',
                        'campaign_id' => '',
                        'inviter_id' => '',
                        'subscriber_id' => '',
                        'feedback_id' => '',
                        'activity_message' => 'move to Archive contact list',
                        'activity_created' => date("Y-m-d H:i:s")
                    );
                    logUserActivity($aActivityData);
                }
                $response = array('status' => 'success', 'msg' => "List deleted successfully!");
            }
        }
        echo json_encode($response);
        exit;
    }


    /**
     * Used to delete lists in bulk
     */
    public function deleteMultipalLists(Request $request) {

        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();


        $user_role = $aUser->user_role;
        if ($user_role == 1) {
            $userID = '';
        }
        $multiListId = $request->multi_list_id;
        if (!empty($multiListId)) {

            foreach ($multiListId as $listID) {
                $bDeleted = $mLists->deleteLists($listID, $userID);

                if ($bDeleted == true) {
                    //Add Useractivity log
                    $aActivityData = array(
                        'user_id' => $aUser->id,
                        'event_type' => 'manage_lists',
                        'action_name' => 'deleted_list',
                        'list_id' => $listID,
                        'brandboost_id' => '',
                        'campaign_id' => '',
                        'inviter_id' => '',
                        'subscriber_id' => '',
                        'feedback_id' => '',
                        'activity_message' => 'Deleted contact list',
                        'activity_created' => date("Y-m-d H:i:s")
                    );
                    logUserActivity($aActivityData);
                }
                $response = array('status' => 'success', 'msg' => "List deleted successfully!");
            }
        }
        echo json_encode($response);
        exit;
    }


    /**
     * Used to delete a lists
     */
    public function deleteLists(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();


        $user_role = $aUser->user_role;
        if ($user_role == 1) {
            $userID = '';
        }
        $listID = strip_tags($request->list_id);

        $bDeleted = $mLists->deleteLists($listID, $userID);

        if ($bDeleted == true) {
            //Add Useractivity log
            $aActivityData = array(
                'user_id' => $userID,
                'event_type' => 'manage_lists',
                'action_name' => 'deleted_list',
                'list_id' => $listID,
                'brandboost_id' => '',
                'campaign_id' => '',
                'inviter_id' => '',
                'subscriber_id' => '',
                'feedback_id' => '',
                'activity_message' => 'Deleted contact list',
                'activity_created' => date("Y-m-d H:i:s")
            );
            logUserActivity($aActivityData);
            $response = array('status' => 'success', 'msg' => "List deleted successfully!");
        }
        echo json_encode($response);
        exit;
    }


    /**
     * Used to add subscriber in a list
     */
    public function addListSusbscriber(Request $request) {
        $oUser = getLoggedUser();
        $userID = $oUser->id;

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Users model to get its methods and properties
        $mUser = new UsersModel();

        //Instantiate Subscriber model to get its methods and properties
        $mSubscriber = new SubscriberModel();


        $response = array();

        if (empty($request)) {
            $response['status'] = "Error";
            echo json_encode($response);
            exit;
        }


        $listID = strip_tags($request->listId);

        if (empty($listID)) {
            $response['status'] = "Error";
            echo json_encode($response);
            exit;
        }
        $emailUserId = 0;
        $firstName = strip_tags($request->firstname);
        $lastName = strip_tags($request->lastname);
        $email = strip_tags($request->email);
        $emailUser = $mUser->checkEmailExist($email);
        if (!empty($emailUser)) {
            $emailUserId = $emailUser[0]->id;
        }

        $phone = strip_tags($request->phone);

        //Check Contact in Centralized Contact list
        $oGlobalUser = $mSubscriber->checkIfGlobalSubscriberExists($userID, 'email', $email);
        if (!empty($oGlobalUser)) {
            $iSubscriberID = $oGlobalUser->id;
        } else {
            //Add global subscriber
            $aSubscriberData = array(
                'owner_id' => $userID,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $email,
                'phone' => $phone,
                'created' => date("Y-m-d H:i:s")
            );
            if (!empty($emailUserId)) {
                $aSubscriberData['user_id'] = $emailUserId;
            }

            $iSubscriberID = $mSubscriber->addGlobalSubscriber($aSubscriberData);
        }





        $aData = array(
            'user_id' => $emailUserId,
            'list_id' => $listID,
            'subscriber_id' => $iSubscriberID,
            'created' => date("Y-m-d H:i:s")
        );

        $result = $mLists->addListSubscriber($aData);
        if ($result) {
            $userID = Session::get("current_user_id");
            //Add Useractivity log
            $aActivityData = array(
                'user_id' => $userID,
                'event_type' => 'manage_lists',
                'action_name' => 'added_user',
                'list_id' => $listID,
                'brandboost_id' => '',
                'campaign_id' => '',
                'inviter_id' => '',
                'subscriber_id' => '',
                'feedback_id' => '',
                'activity_message' => 'Added subscriber into the list',
                'activity_created' => date("Y-m-d H:i:s")
            );
            logUserActivity($aActivityData);
            $response['status'] = 'success';
            $response['msg'] = 'Contact added successfully.';
            $response['id'] = $result;
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to import list through csv
     */
    public function importListCSV(Request $request) {
        $oUser = getLoggedUser();
        $userID = $oUser->id;

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Users model to get its methods and properties
        $mUser = new UsersModel();

        //Instantiate Subscriber model to get its methods and properties
        $mSubscriber = new SubscriberModel();


        $someoneadded = false;

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000';
        $list_id = $request->list_id;

        $this->load->library('upload', $config);

        // If upload failed, display error
        if (!$this->upload->do_upload()) {

        } else {

            $file_data = $this->upload->data();
            $file_path = './uploads/' . $file_data['file_name'];

            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);

                foreach ($csv_array as $row) {
                    $firstName = $row['FIRST_NAME'];
                    $lastName = $row['LAST_NAME'];
                    $email = $row['EMAIL'];
                    $phone = $row['PHONE'];

                    $emailUserId = 0;
                    $emailUser = $mUser->checkEmailExist($email);
                    if (!empty($emailUser)) {
                        $emailUserId = $emailUser[0]->id;
                    }

                    $oGlobalUser = $mSubscriber->checkIfGlobalSubscriberExists($userID, 'email', $email);
                    if (!empty($oGlobalUser)) {
                        $iSubscriberID = $oGlobalUser->id;
                    } else {
                        //Add global subscriber
                        $aSubscriberData = array(
                            'owner_id' => $userID,
                            'firstName' => $firstName,
                            'lastName' => $lastName,
                            'email' => $email,
                            'phone' => $phone,
                            'created' => date("Y-m-d H:i:s")
                        );
                        if (!empty($emailUserId)) {
                            $aSubscriberData['user_id'] = $emailUserId;
                        }

                        $iSubscriberID = $mSubscriber->addGlobalSubscriber($aSubscriberData);
                    }

                    $aData = array(
                        'user_id' => $emailUserId,
                        'list_id' => $list_id,
                        'subscriber_id' => $iSubscriberID,
                        'created' => date("Y-m-d H:i:s")
                    );

                    $result = $mLists->addListSubscriber($aData);
                    $someoneadded = true;
                }
                if ($someoneadded == true) {
                    //Add Useractivity log
                    $aActivityData = array(
                        'user_id' => $userID,
                        'event_type' => 'manage_lists',
                        'action_name' => 'added_user_import',
                        'brandboost_id' => $list_id,
                        'campaign_id' => '',
                        'inviter_id' => '',
                        'subscriber_id' => '',
                        'feedback_id' => '',
                        'activity_message' => 'Users imported into the list',
                        'activity_created' => date("Y-m-d H:i:s")
                    );
                    logUserActivity($aActivityData);
                }

                if (!empty($result)) {

                    redirect('admin/lists/getListContacts?list_id=' . $list_id);
                }
            } else {
                $data['error'] = "Error occured";
            }
        }
    }


    /**
     * Used to export lists in csv format
     */
    public function exportListCSV(Request $request) {
        // file name
        $oUser = getLoggedUser();
        $userID = $oUser->id;

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Users model to get its methods and properties
        $mUser = new UsersModel();


        $userRole = $oUser->user_role;
        $filename = 'users_' . time() . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");


        $listId = $request->list_id;
        //$userDetail = $mUser->getAllUsers($userID);

        if ($userRole != '1') {
            $allSubscribers = $mLists->getListContacts($userID, $listId);
        } else {
            //$userID = '';
            $allSubscribers = $mLists->getListContacts('', $listId);
        }

        // file creation
        $file = fopen('php://output', 'w');

        $header = array("EMAIL", "FIRST_NAME", "LAST_NAME", "PHONE");
        fputcsv($file, $header);
        foreach ($allSubscribers as $key => $line) {
            fputcsv($file, array($line->email, $line->firstname, $line->lastname, $line->phone));
        }
        fclose($file);
        //Add Useractivity log

        $aActivityData = array(
            'user_id' => $userID,
            'event_type' => 'manage_lists',
            'action_name' => 'downloaded_user_export',
            'brandboost_id' => $listId,
            'campaign_id' => '',
            'inviter_id' => '',
            'subscriber_id' => '',
            'feedback_id' => '',
            'activity_message' => 'Users exported from list',
            'activity_created' => date("Y-m-d H:i:s")
        );
        logUserActivity($aActivityData);
        exit;
    }


    /**
     * Used to get role lists
     */
    public function rolelist() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Users model to get its methods and properties
        $mUser = new UsersModel();

        //Instantiate Team model to get its methods and properties
        $mTeam = new TeamModel();


        $oRoles = $mTeam->getRoleList($userID);
        $bActiveSubsription = $mUser->isActiveSubscription();

        $breadcrumb = '<ul class="breadcrumb">
			<li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
			<li class="active">Team</li>
                        <li class="active">Roles</li>
            </ul>';
        return view('admin.team.rolelist', ['title' => 'Team Roles', 'pagename' => $breadcrumb, 'oRoles' => $oRoles, 'bActiveSubsription' => $bActiveSubsription]);
    }


    /**
     * Used to get member lists
     */
    public function memberlist() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Team model to get its methods and properties
        $mTeam = new TeamModel();


        $oMembers = $mTeam->getTeamMembers($userID);
        $oRoles = $mTeam->getRoleList($userID);
        $breadcrumb = '<ul class="breadcrumb">
			<li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
			<li class="active">Team</li>
                        <li class="active">Members</li>
            </ul>';
        return view('admin.team.memberlist', ['title' => 'Team Members', 'pagename' => $breadcrumb, 'oMembers' => $oMembers, 'oRoles' => $oRoles]);
    }


    /**
     * Used to get view log
     * @param type $teamMemberID
     */
    public function viewLog($teamMemberID) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Team model to get its methods and properties
        $mTeam = new TeamModel();


        $oData = $mTeam->getUserActivities('team', $teamMemberID);

        $breadcrumb = '<ul class="breadcrumb">
			<li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
			<li class="active">Team</li>
                        <li class="active">Members</li>
                        <li class="active">View Activity Log</li>
            </ul>';
        return view('admin.team.activitylist', ['title' => 'Team Member Activity', 'pagename' => $breadcrumb, 'oData' => $oData]);
    }


    /**
     * Used to get subscriber activity list
     */
    public function activitylist() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Team model to get its methods and properties
        $mTeam = new TeamModel();


        $oData = $mTeam->getUserActivities('team');

        $breadcrumb = '<ul class="breadcrumb">
			<li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
			<li class="active">Team</li>
                        <li class="active">Members</li>
                        <li class="active">View Activity Log</li>
            </ul>';
        return view('admin.team.activitylist', ['title' => 'Team Member Activity', 'pagename' => $breadcrumb, 'oData' => $oData]);
    }


    /**
     * Used to add team member
     */
    public function addTeamMember(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Team model to get its methods and properties
        $mTeam = new TeamModel();


        $teamRoleID = strip_tags($request->memberRole);
        $firstName = strip_tags($request->firstname);
        $lastName = strip_tags($request->lastname);
        $email = strip_tags($request->email);
        //$country = $aData['country'];
        $phone = strip_tags($request->phone);
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 8; $i++) {
            $randstring .= $characters[rand(0, strlen($characters))];
        }
        $password = $randstring;
        $password_hash = 'Umair';
        $siteSalt = 'Rahul';
        $pwd = base64_encode($password . $password_hash . $siteSalt);

        $aData = array(
            'team_role_id' => $teamRoleID,
            'parent_user_id' => $userID,
            'firstname' => $firstName,
            'lastname' => $lastName,
            'email' => $email,
            'mobile' => $phone,
            'status' => 1,
            'password' => $pwd,
            'created' => date("Y-m-d H:i:s")
        );

        $teamUserID = $mTeam->addTeamMember($aData);
        if ($teamUserID > 0) {
            //Send Email Notification
            $emailContent = '<p> Hi ' . $firstName . ' ' . $lastName . ',';
            $emailContent .= '<br><br>You have invited as a Team member on branboost.<br><br>Here is the login details given below: <br>';
            $emailContent .= '<strong>Email: ' . $email . '</strong><br>';
            $emailContent .= '<strong>Password: ' . $password . '</strong><br>';
            $emailContent .= '<br><br>Regards,<br>Brandboost';
            sendEmail($email, $emailContent, "Brandboost Team Member Registration");
            $response = array('status' => 'success', 'msg' => "Role added successfully!");
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to add role for the team members
     */
    public function addRole(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Team model to get its methods and properties
        $mTeam = new TeamModel();


        $title = strip_tags($request->title);
        $dateTime = date("Y-m-d H:i:s");
        $aData = array(
            'role_name' => $title,
            'user_id' => $userID,
            'role_created' => $dateTime
        );

        $bAlreadyExists = $mTeam->checkIfUserRoleExists($title, $userID);
        if ($bAlreadyExists == true) {
            $response = array('status' => 'error', 'type' => 'duplicate', 'msg' => 'Role name already exists');
            echo json_encode($response);
            exit;
        }

        $insertID = $mTeam->addTeamRole($aData);
        if ($insertID > 0) {
            $response = array('status' => 'success', 'msg' => "Role added successfully!");
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to get team member roles
     */
    public function getRole(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Team model to get its methods and properties
        $mTeam = new TeamModel();


        $roleID = strip_tags($request->role_id);
        $oRole = $mTeam->getRole($roleID, $userID);
        if (!empty($oRole)) {
            $response = array('status' => 'success', 'title' => $oRole->role_name);
        } else {
            $response = array('status' => 'error', 'msg' => 'Not found');
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to update Team member role
     */
    public function updateRole(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Team model to get its methods and properties
        $mTeam = new TeamModel();


        $roleID = strip_tags($request->role_id);
        $title = strip_tags($request->title);
        $dateTime = date("Y-m-d H:i:s");
        $aData = array(
            'role_name' => $title
        );

        $bAlreadyExists = $mTeam->checkIfUserRoleExists($title, $userID);
        if ($bAlreadyExists == true) {
            $response = array('status' => 'error', 'type' => 'duplicate', 'msg' => 'Role name already exists');
            echo json_encode($response);
            exit;
        }

        $bUpdated = $mTeam->updateTeamRole($aData, $roleID, $userID);
        if ($bUpdated) {
            $response = array('status' => 'success', 'msg' => "Role updated successfully!");
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to delete team member role
     */
    public function deleteRole(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Team model to get its methods and properties
        $mTeam = new TeamModel();


        $roleID = strip_tags($request->role_id);
        $bDeleted = $mTeam->deleteRole($roleID, $userID);
        if ($bDeleted == true) {
            $response = array('status' => 'success', 'msg' => "Role deleted successfully!");
        }
        echo json_encode($response);
        exit;
    }


    /**
     * Used to get the list of team members
     */
    public function getTeamMember(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Team model to get its methods and properties
        $mTeam = new TeamModel();


        $memberID = strip_tags($request->member_id);
        $memberData = $mTeam->getTeamMember($memberID, $userID);
        if (!empty($memberData)) {
            $response = array('status' => 'success', 'result' => $memberData);
        } else {
            $response = array('status' => 'error', 'msg' => 'Not found');
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to update team members
     */
    public function updateTeamMember(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $memberID = strip_tags($request->edit_member_id);
        $teamRoleID = strip_tags($request->edit_memberRole);
        $firstName = strip_tags($request->edit_firstname);
        $lastName = strip_tags($request->edit_lastname);
        $email = strip_tags($request->edit_email);
        $phone = strip_tags($request->edit_phone);

        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Team model to get its methods and properties
        $mTeam = new TeamModel();



        $aData = array(
            'team_role_id' => $teamRoleID,
            'firstname' => $firstName,
            'lastname' => $lastName,
            'email' => $email,
            'mobile' => $phone
        );

        $bUpdated = $mTeam->updateTeamMember($aData, $memberID, $userID);
        if ($bUpdated) {
            $response = array('status' => 'success', 'msg' => "Team member has been updated successfully!");
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to delete team member
     */
    public function deleteTeamMember(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Team model to get its methods and properties
        $mTeam = new TeamModel();

        $memberID = strip_tags($request->member_id);
        $bDeleted = $mTeam->deleteTeamMember($memberID, $userID);
        if ($bDeleted == true) {
            $response = array('status' => 'success', 'msg' => "Team member has been deleted successfully!");
        }
        echo json_encode($response);
        exit;
    }


    /**
     * Used to manage team member role permission
     */
    public function manageRolePermission(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Team model to get its methods and properties
        $mTeam = new TeamModel();


        $roleID = strip_tags($request->role_id);
        $oSelectedPermission = $mTeam->getTeamRolePermission($roleID);

        $oAvailablePermission = $mTeam->getAvailablePermissions();

        $permissionForm = view('admin.team.permission_form', ['selected_permission' => $oSelectedPermission, 'oAvailable_permission' => $oAvailablePermission])->render();
        if ($permissionForm) {
            $response = array('status' => 'success', 'permission_form' => $permissionForm, 'msg' => "Role updated successfully!");
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to add team role permission
     */
    public function addRolePermission(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Team model to get its methods and properties
        $mTeam = new TeamModel();


        $roleID = strip_tags($request->role_id);
        $aPermissionID = $request->permission_id;
        $dateTime = date("Y-m-d H:i:s");
        $aData = array(
            'role_id' => $roleID,
            'permission_array' => $aPermissionID,
            'role_created' => $dateTime
        );

        $bAdded = $mTeam->addRolePermission($aData);
        if ($bAdded == true) {
            $response = array('status' => 'success', 'msg' => "Permission added successfully!");
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to update role permission
     */
    public function updateRolePermission(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();

        //Instantiate Team model to get its methods and properties
        $mTeam = new TeamModel();

        $roleID = strip_tags($request->role_id);
        $aPermission = $request->permission_id;
        if (!empty($aPermission)) {
            foreach ($aPermission as $iPerID) {
                $aPermissionData[] = array(
                    'id' => $iPerID,
                    'permission_value' => strip_tags($request->permission_val_ . $iPerID)
                );
            }
        }
        //pre($aPermissionData);
        $oAvailablePermission = $mTeam->getAvailablePermissions();
        if (!empty($oAvailablePermission)) {
            foreach ($oAvailablePermission as $oPermission) {
                $aAllPermissionID[] = $oPermission->id;
            }
        }
        $dateTime = date("Y-m-d H:i:s");
        $aData = array(
            'role_id' => $roleID,
            'permission_array' => $aPermissionData,
            'all_permission_array' => $aAllPermissionID,
            'userID' => $userID
        );

        $bUpdated = $mTeam->updateRolePermission($aData);
        if ($bUpdated == true) {
            $response = array('status' => 'success', 'msg' => "Permission updated successfully!");
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to update the status of a contact
     */
    public function updateContactStatus(Request $request) {

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();




        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $status = $request->status;
        $subscriberId = $request->subscriberId;

        $bUpdated = $mLists->updateListSubscriber($subscriberId, $status);
        if ($bUpdated == true) {
            $response = array('status' => 'success', 'msg' => "Contact status updated successfully!");
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to delete list contacts in bulk
     */
    public function deleteMultipalListContact(Request $request) {

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();




        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $multipalSubscriberId = $request->multipalSubscriberId;
        foreach ($multipalSubscriberId as $subscriberId) {
            $bUpdated = $mLists->deleteListSubscriber($subscriberId);
        }

        if ($bUpdated == true) {
            $response = array('status' => 'success', 'msg' => "Contact deleted successfully!");
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to make archive of lists in bulk
     */
    public function archiveMultipalListContact(Request $request) {

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();



        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $multipalSubscriberId = $request->multipalSubscriberId;

        foreach ($multipalSubscriberId as $subscriberId) {
            $bUpdated = $mLists->updateListSubscriber($subscriberId, 2);
        }

        if ($bUpdated == true) {
            $response = array('status' => 'success', 'msg' => "Contact archived successfully!");
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to make archive of a list contact
     */
    public function moveToArchiveListContact(Request $request) {

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();



        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $subscriberid = $request->subscriberId;

        $bUpdated = $mLists->updateListSubscriber($subscriberid, 2);

        if ($bUpdated == true) {
            $response = array('status' => 'success', 'msg' => "Contact archived successfully!");
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to move a contact into archive list
     */
    public function moveToArchiveList(Request $request) {

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();




        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $listId = $request->list_id;

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;

        if ($user_role == 1) {
            $userID = '';
        }

        $bArchived = $mLists->archiveLists($listId, $userID);

        if ($bArchived == true) {
            $response = array('status' => 'success', 'msg' => "Contact archived successfully!");
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to update the status of the list
     */
    public function changeListStatus(Request $request) {



        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $listId = strip_tags($request->list_id);
        $status = strip_tags($request->status);


        $aUser = getLoggedUser();
        $userID = $aUser->id;

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();


        $user_role = $aUser->user_role;

        if ($user_role == 1) {
            $userID = '';
        }

        $bArchived = $mLists->updateListStatus($listId, $userID, $status);

        if ($bArchived == true) {
            $response = array('status' => 'success', 'msg' => "List updated successfully");
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to delete contact list
     */
    public function deleteListContact(Request $request) {

        //Instantiate Lists model to get its methods and properties
        $mLists = new ListsModel();



        if (empty($request)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $subscriberId = $request->subscriberId;

        $bUpdated = $mLists->deleteListSubscriber($subscriberId);
        if ($bUpdated == true) {
            $response = array('status' => 'success', 'msg' => "Contact deleted successfully!");
        }

        echo json_encode($response);
        exit;
    }

}
