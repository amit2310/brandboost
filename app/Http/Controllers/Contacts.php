<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Admin\ListsModel;
use App\Models\Admin\WorkflowModel;
use App\Models\Admin\UsersModel;
use App\Models\Admin\ReviewsModel;
use App\Models\Admin\SubscribersModel;
use App\Libraries\Custom\csvimport;

use Cookie;
use Session;

class Contacts extends Controller  {


    /**
    * index call
    * @param type $clientID
    * @return type
    */

    public function index() {
         $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs">Dashboard </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Tags Group" class="sidebar-control active hidden-xs ">Contacts</a></li>
                    </ul>';

        $mUser  = new UsersModel();
        $mReviews  = new ReviewsModel();
        $userID = Session::get("current_user_id");
        $userDetail = $mUser->getAllUsers($userID);
        $userRole = $userDetail[0]->user_role;

        $data = array(
            'title' => 'Contacts',
            'pagename' => $breadcrumb,
            'usersdata' => $mReviews->getReviewsUserList($userID, $userRole)
        );

        return view('admin.users.contacts', $data);
    }


    public function listingNotes(Request $request)
    {


       $SubscriberPhone = $request->NotesTo;

        $notes_from = db_in($request->notes_from);

       $oNotes = $this->mSubscriber->visitornotes($request->NotesTo);
        //pre($oNotes);
          foreach ($oNotes as $NotesData) {

               $fileext = end(explode('.', $NotesData->message));
                $mmsFile = explode('/Media/', $NotesData->message);

                if ($fileext == 'png' || $fileext == 'jpg' || $fileext == 'jpeg' || $fileext == 'gif') {
                    $NotesData->message = "<div class='mrdia-file'><a href='" . $NotesData->message . "' target='_blank' class='previewImage'><img src='" . $NotesData->message . "' /></a></div>";
                } else if ($fileext == 'doc' || $fileext == 'docx' || $fileext == 'odt' || $fileext == 'csv' || $fileext == 'pdf') {
                   $NotesData->message = "<div class='media-content'><a href='" . $NotesData->message . "' target='_blank'>Download '" . $fileext . "' File</a></div>";
                } else if (count($mmsFile) > 1) {
                   $NotesData->message = "<div class='mrdia-file'><a href='" . $NotesData->message . "' target='_blank' class='previewImage'><img src='" . $NotesData->message . "' /></a></div>";
                }

                    ?>
                    <li class="media reversed">
                       <div class="media-body">
                           <span style="display: none;" class="media-annotation user_icon"><span class="circle_green_status status-mark"></span>
                            <?php echo @showUserAvtar($loginUserData->avatar, $loginUserData->firstname, $loginUserData->lastname, 28, 28, 11); ?>                               </span>
                           <div class="media-content" style="background-color:#fff9ec!important;"><?php echo $NotesData->message; ?>
                           </div>
                               <span style="padding: 0;display: block;font-size: 10px;position: absolute; right: 0;bottom: -16px;" class="text-muted text-size-small">
                               Added By <?php echo assignto($NotesData->room).' '.date('F d Y', strtotime($NotesData->created)); } ?>  </span>
                            </div>
                    </li>
<div style="height:10px" class="clearfix"></div>
                <?php }


    public function profile(Request $request) {
        die;
        $contactId = $request->contactId;
        $oUser = getLoggedUser();
        $clientID = $oUser->id;
        $response = array();
        $response['status'] = 'error';

        if (!empty($request)) {
            $subscriberID = $request->subscriberId;
            $moduleName = $request->moduleName;
            $actionName = $request->action;
        }

        if (!empty($contactId)) {
            $moduleName = (!empty($moduleName)) ? $moduleName : 'people';
            $subscriberID = (!empty($subscriberID)) ? $subscriberID : $contactId;
            $subsData = $this->mSubscriber->getModuleSubscriberInfo($moduleName, $subscriberID);
            if($moduleName == 'automation' || $moduleName =='broadcast'){
                $subscribersData = $subsData;
            }else{
                $subscribersData = $subsData[0];
            }

            //$subscribersData = $this->mSubscriber->getSubscribersById($contactId);
            if(!empty($subscribersData)){
                if($moduleName != 'people'){
                    $contactId = $subscribersData->id;
                }
            }
            $subscriberList = $this->mLists->getSubscriberList($contactId);
            $oClientLists = $this->mLists->getLists($clientID, '', 'active');

            //Get Involved Campaigns in all modules
            //Get Brandboost Campaigns
            $oInvolvedBrandboost = $this->mSubscriber->getSubscriberBBCampaigns($contactId);

            //NPS Campaigns
            $oInvolvedNPS = $this->mSubscriber->getSubscriberNPSCampaigns($contactId);

            //Referral Campaigns
            $oInvolvedReferral = $this->mSubscriber->getSubscriberReferralCampaigns($contactId);
            //pre($oInvolvedBrandboost);
            //die;

            if (!empty($subscribersData->user_id) && $subscribersData->user_id > 0) {
                $userId = $subscribersData->user_id;
                $getUserById = $this->mSubscriber->getUserById($userId);

                $getClientTags = $this->mTags->getClientTags($userId);
                $getUserActivities = $this->mSubscriber->getUserActivities($userId);
                $getFeedback = $this->mFeedback->getFeedback($userId);
                $aReviews = $this->mReviews->getContactBranboostReviews($userId);


                $aUser = getLoggedUser();
                $userID = $aUser->id;
                $oProgramsRef = $this->mReferral->getReferralLists($userID);
                $oPrograms = $this->mNPS->getNpsLists($userID);

                if (!empty($oPrograms)) {
                    foreach ($oPrograms as $oProgram) {
                        $hashCode = $oProgram->hashcode;
                        $aScore = $this->mNPS->getNPSScore($hashCode);
                        $oProgram->NPS = $aScore;
                    }
                }
            } else {
                $getUserById = $subscribersData;
            }

            $subBrandEmail = $this->mSubscriber->getSubscriberEmailSms($contactId, 'email');
            $subBrandSms = $this->mSubscriber->getSubscriberEmailSms($contactId, 'sms');

            $subRefEmail = $this->mSubscriber->getReferalSubscriberEmailSms($contactId, 'email');
            $subRefSms = $this->mSubscriber->getReferalSubscriberEmailSms($contactId, 'sms');


            $subNpsEmail = $this->mSubscriber->getNpsSubscriberEmailSms($contactId, 'email');
            $subNpsSms = $this->mSubscriber->getNpsSubscriberEmailSms($contactId, 'sms');

            $subAutomationEmail = $this->mSubscriber->getAutomationSubsEmailSms($contactId, 'email');
            $subAutomationSms = $this->mSubscriber->getAutomationSubsEmailSms($contactId, 'sms');

            $newArray = array();
            if (!empty($subBrandEmail)) {
                foreach ($subBrandEmail as $value) {
                    $subArray['title'] = $value->brand_title;
                    if ($value->brand_type == 'onsite') {
                        $subArray['url'] = base_url('admin/brandboost/onsite_setup/') . $value->brand_id;
                    } else {
                        $subArray['url'] = base_url('admin/brandboost/offsite_setup/') . $value->brand_id;
                    }
                    $subArray['name'] = 'Campaign';
                    $subArray['type'] = 'Email';
                    $subArray['strtotime'] = strtotime($value->trackdate);
                    $subArray['created'] = $value->trackdate;
                    array_push($newArray, $subArray);
                }
            }

            if (!empty($subBrandSms)) {
                foreach ($subBrandSms as $value) {
                    $subArray['title'] = $value->brand_title;
                    if ($value->brand_type == 'onsite') {
                        $subArray['url'] = base_url('admin/brandboost/onsite_setup/') . $value->brand_id;
                    } else {
                        $subArray['url'] = base_url('admin/brandboost/offsite_setup/') . $value->brand_id;
                    }
                    $subArray['name'] = 'Campaign';
                    $subArray['type'] = 'SMS';
                    $subArray['strtotime'] = strtotime($value->trackdate);
                    $subArray['created'] = $value->trackdate;
                    array_push($newArray, $subArray);
                }
            }

            if (!empty($subRefEmail)) {
                foreach ($subRefEmail as $value) {
                    $subArray['title'] = $value->title;
                    $subArray['url'] = base_url('admin/modules/referral/setup/' . $value->referral_id);
                    $subArray['name'] = 'Referral';
                    $subArray['type'] = 'Email';
                    $subArray['strtotime'] = strtotime($value->trackdate);
                    $subArray['created'] = $value->trackdate;
                    array_push($newArray, $subArray);
                }
            }

            if (!empty($subRefSms)) {
                foreach ($subRefSms as $value) {
                    $subArray['title'] = $value->title;
                    $subArray['url'] = base_url('admin/modules/referral/setup/' . $value->referral_id);
                    $subArray['name'] = 'Referral';
                    $subArray['type'] = 'SMS';
                    $subArray['strtotime'] = strtotime($value->trackdate);
                    $subArray['created'] = $value->trackdate;
                    array_push($newArray, $subArray);
                }
            }

            if (!empty($subNpsEmail)) {
                foreach ($subNpsEmail as $value) {
                    $subArray['title'] = $value->title;
                    $subArray['url'] = base_url('admin/modules/nps/setup/' . $value->npm_id);
                    $subArray['name'] = 'NPS';
                    $subArray['type'] = 'Email';
                    $subArray['strtotime'] = strtotime($value->trackdate);
                    $subArray['created'] = $value->trackdate;
                    array_push($newArray, $subArray);
                }
            }

            if (!empty($subNpsSms)) {
                foreach ($subNpsSms as $value) {
                    $subArray['title'] = $value->title;
                    $subArray['url'] = base_url('admin/modules/nps/setup/' . $value->npm_id);
                    $subArray['name'] = 'NPS';
                    $subArray['type'] = 'SMS';
                    $subArray['strtotime'] = strtotime($value->trackdate);
                    $subArray['created'] = $value->trackdate;
                    array_push($newArray, $subArray);
                }
            }

            if (!empty($subAutomationEmail)) {
                foreach ($subAutomationEmail as $value) {
                    $subArray['title'] = $value->title;
                    $subArray['url'] = base_url('admin/modules/emails/setupAutiomation/' . $value->automation_id);
                    $subArray['name'] = 'Automation';
                    $subArray['type'] = 'Email';
                    $subArray['strtotime'] = strtotime($value->trackdate);
                    $subArray['created'] = $value->trackdate;
                    array_push($newArray, $subArray);
                }
            }

            if (!empty($subAutomationSms)) {
                foreach ($subAutomationSms as $value) {
                    $subArray['title'] = $value->title;
                    $subArray['url'] = base_url('admin/modules/emails/setupAutiomation/' . $value->automation_id);
                    $subArray['name'] = 'Automation';
                    $subArray['type'] = 'SMS';
                    $subArray['strtotime'] = strtotime($value->trackdate);
                    $subArray['created'] = $value->trackdate;
                    array_push($newArray, $subArray);
                }
            }

            $result = array();
            foreach ($newArray as $key => $row) {
                $result[$key] = array(
                    'strtotime' => $row['strtotime'],
                    'title' => $row['title'],
                    'url' => $row['url'],
                    'name' => $row['name'],
                    'type' => $row['type'],
                    'created' => $row['created']
                );
            }
            array_multisort($result, SORT_DESC, $newArray);

            $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/contacts/mycontacts') . '">Contact</a></li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a data-toggle="tooltip" data-placement="bottom" title="Profile" class="sidebar-control active hidden-xs ">Profile</a></li>
                </ul>';

            $oNotes = $this->mSubscriber->getContactNotes($contactId);

            //'userData' => $getUserById,
            //'getMyLists' => $getMyLists
            $aData = array(
                'subscribersData' => $subscribersData,
                'userData' => $subscribersData,
                'contactId' => $contactId,
                'getMyLists' => $subscriberList,
                'oLists' => $oClientLists,
                'oInvolvedBrandboost' => $oInvolvedBrandboost,
                'oInvolvedNPS' => $oInvolvedNPS,
                'oInvolvedReferral' => $oInvolvedReferral,
                'userActivities' => $getUserActivities,
                'getClientTags' => $getClientTags,
                'getFeedback' => $getFeedback,
                'aReviews' => $aReviews,
                'oProgramsRef' => $oProgramsRef,
                'subBrandEmail' => $subBrandEmail,
                'subBrandSms' => $subBrandSms,
                'oNotes' => $oNotes,
                'result' => $result,
                'pagename' => $breadcrumb,
                'oPrograms' => $oPrograms
            );
        }

        if ($actionName == 'smart-popup') {
            $popupContent = $this->load->view('admin/components/smart-popup/contacts', $aData, true);
            $response['status'] = 'success';
            $response['content'] = $popupContent;
            echo json_encode($response);
            exit;
        } else {
            $this->template->load('admin/admin_template_new', 'admin/contacts/contact_profile', $aData);
        }



    }

    public function mycontacts() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $moduleName = 'people';
        $moduleUnitID = $userID;

        if (!empty($userID)) {
            $subscribersData = $this->mSubscriber->getGlobalSubscribers($userID);
            $archiveContacts = $this->mSubscriber->getArchiveGlobalSubscribers($userID);
            $getClientTags = $this->mTags->getClientTags($userID);
        }

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Contacts" class="sidebar-control active hidden-xs ">Contacts</a></li>
                      </ul>';
        $bActiveSubsription = $this->mUser->isActiveSubscription();

        $data = array(
            'title' => 'Contacts',
            'pagename' => $breadcrumb,
            'archiveContacts' => $archiveContacts,
            'oContacts' => isset($oContacts) ? $oContacts : '',
            'subscribersData' => $subscribersData,
            'moduleName' => $moduleName,
            'moduleUnitID' => $moduleUnitID,
            'getClientTags' => $getClientTags,
            'bActiveSubsription' => $bActiveSubsription
        );

        $this->template->load('admin/admin_template_new', 'admin/subscriber/list-subscribers', $data);
    }

    public function add_contact(Request $request) {
        $response = array();

        $oUser = getLoggedUser();
        $userID = $oUser->id;
        if (empty($request)) {
            $response['status'] = "Error";
            echo json_encode($response);
            exit;
        }

        $emailUserId = '';
        $firstName = $request->firstname;
        $lastName = $request->lastname;
        $email = $request->email;
        $gender = $request->gender;
        $countryCode = $request->countryCode;
        $cityName = $request->cityName;
        $stateName = $request->stateName;
        $zipCode = $request->zipCode;
        $socialProfile = $request->socialProfile;
        $tagID = $request->tagID;
        //$emailUser = getUserDetailByEmailId($email);
        $oUserAccount = $this->mUser->checkEmailExist($email);
        if (!empty($oUserAccount)) {
            $emailUserId = $oUserAccount[0]->id;
        }

        $phone = $request->phone;
        $bAlreadyExists = 0;
        $oGlobalUser = $this->mSubscriber->checkIfGlobalSubscriberExists($userID, 'email', $email);
        if (!empty($oGlobalUser)) {
            $iSubscriberID = $oGlobalUser->id;
            $bAlreadyExists = 1;
        } else {
            //Add global subscriber
            $aSubscriberData = array(
                'owner_id' => $userID,
                'firstname' => $firstName,
                'lastname' => $lastName,
                'email' => $email,
                'phone' => $phone,
                'gender' => $gender,
                'country_code' => $countryCode,
                'cityName' => $cityName,
                'stateName' => $stateName,
                'zipCode' => $zipCode,
                'socialProfile' => $socialProfile,
                'source' => 'admin',
                'tagID' => $tagID,
                'created' => date("Y-m-d H:i:s")
            );
            if (!empty($emailUserId)) {
                $aSubscriberData['user_id'] = $emailUserId;
            }
            $iSubscriberID = $this->mSubscriber->addGlobalSubscriber($aSubscriberData);
        }

        if ($iSubscriberID > 0) {
            $response['status'] = 'success';
            $response['pre-exists'] = $bAlreadyExists;
        }

        echo json_encode($response);
        exit;
    }

    public function add_contact_notes(Request $request) {
        $response = array();

        $oUser = getLoggedUser();
        $userID = $oUser->id;
        if (empty($request)) {
            $response['status'] = "Error";
            echo json_encode($response);
            exit;
        }

        $notes = db_in($request->notes);
        $notes_from = db_in($request->notes_from);

        $source = $request->source;
        $type = $request->type;

		if($type == 'smartpopup'){
			$subId = $request->subscriberid;
		}else{
			$subId = $request->NotesTo;
		}

        $aData = array(
            'user_id' => $userID,
            'subscriber_id' => $subId,
            'notes' => $notes,
            'source'=>$source,
            'created' => date("Y-m-d H:i:s")
        );
        $bAdded = $this->mSubscriber->addContactNotes($aData);
        if ($bAdded) {
            $oNotes = $this->mSubscriber->getContactNotes($subId);
            if($type == 'smartpopup'){
                $sNotesContent = $this->load->view("admin/contacts/partial/smart-notes-block", array("oNotes" => $oNotes), true);
            }else{
               $sNotesContent = $this->load->view("admin/contacts/partial/notes-block", array("oNotes" => $oNotes), true);
            }

            $response['status'] = "success";
            $response['notes'] = $sNotesContent;
        }

        echo json_encode($response);
        exit;
    }

    public function get_contact_info(Request $request) {
        $response = array();
        $response['status'] = 'error';


        $contactID = $request->contactID;
        if (!empty($request)) {

            $oSubscriber = $this->mSubscriber->getGlobalSubscriberInfo($contactID);
            if ($oSubscriber) {
                $response['status'] = 'success';
                $response['result'] = $oSubscriber;
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function update_contact_info(Request $request) {
        $response = array();
        $response['status'] = 'Error';
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        if (!empty($request)) {
            $firstname = $request->edit_firstname;
            $lastname = $request->edit_lastname;
            $email = $request->edit_email;
            $phone = $request->edit_phone;
            $subscriberID = $request->edit_subscriberID;
            $gender = $request->edit_gender;
            $countryCode = $request->edit_countryCode;
            $cityName = $request->edit_cityName;
            $stateName = $request->edit_stateName;
            $zipCode = $request->edit_zipCode;
            $socialProfile = $request->edit_socialProfile;
            $tagID = $request->edit_tags;
            $aGlobalUserData = array(
                'email' => $email,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'phone' => $phone,
                'gender' => $gender,
                'country_code' => $countryCode,
                'cityName' => $cityName,
                'stateName' => $stateName,
                'zipCode' => $zipCode,
                'socialProfile' => $socialProfile,
                'source' => 'admin',
                'tagID' => $tagID,
                'updated' => date("Y-m-d H:i:s")
            );
            $this->mSubscriber->updateGlobalSubscriber($aGlobalUserData, $subscriberID);
            $response = array('status' => 'success', 'msg' => "Subscriber updated successfully!");
        }
        echo json_encode($response);
        exit;
    }

    public function delete_contact(Request $request) {
        $response = array();

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        if (!empty($request)) {

            $subscriberID = $request->subscriberId;

            $result = $this->mSubscriber->deleteGlobalSubscriber($userID, $subscriberID);
            if ($result) {
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function archiveBulkContacts(Request $request) {
        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        if (!empty($request)) {


            $sContacts = $request->multipal_record_id;

            $aData = array(
                'status' => 2
            );

            foreach ($sContacts as $iContactID) {
                $result = $this->mSubscriber->archiveGlobalSubscriber($userID, $iContactID, $aData);
            }

            if ($result) {
                $response['status'] = 'success';
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function deleteBulkContacts(Request $request) {
        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        if (!empty($request)) {


            $sContacts = $request->multipal_record_id;

            foreach ($sContacts as $iContactID) {
                $result = $this->mSubscriber->deleteGlobalSubscriber($userID, $iContactID);
            }

            if ($result) {
                $response['status'] = 'success';
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function importcsv(Request $request) {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $someoneadded = false;

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000';
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
                    $emailUser = $this->mUser->checkEmailExist($email);
                    if (!empty($emailUser)) {
                        $emailUserId = $emailUser[0]->id;
                    }

                    $oGlobalUser = $this->mSubscriber->checkIfGlobalSubscriberExists($userID, 'email', $email);
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

                        $iSubscriberID = $this->mSubscriber->addGlobalSubscriber($aSubscriberData);
                    }
                }


                if ($iSubscriberID > 0) {

                    redirect('admin/contacts/mycontacts');
                }
            } else {
                $data['error'] = "Error occured";
            }
        }
    }

    public function exportCSV(Request $request) {
        $filename = 'users_' . time() . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");


        $userID = $this->session->userdata("current_user_id");
        $allSubscribers = $this->mSubscriber->getGlobalSubscribers($userID);

        // file creation
        $file = fopen('php://output', 'w');

        $header = array("EMAIL", "FIRST_NAME", "LAST_NAME", "PHONE");
        fputcsv($file, $header);
        foreach ($allSubscribers as $key => $line) {
            fputcsv($file, array($line->email, $line->firstname, $line->lastname, $line->phone));
        }
        fclose($file);
        exit;
    }

    public function update_status(Request $request) {

        $response = array();

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        if (!empty($request)) {

            $status = $request->status;
            $userId = $request->contactId;

            $aData = array(
                'status' => $status
            );
            $result = $this->mSubscriber->updateGlobalSubscriber($aData, $userId);

            if ($result) {
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        }
    }

}
