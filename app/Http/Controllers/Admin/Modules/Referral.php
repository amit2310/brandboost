<?php
namespace App\Http\Controllers\Admin\Modules;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\UsersModel;
use App\Models\Admin\MediaModel;
use App\Models\Admin\Modules\ReferralModel;
use App\Models\Admin\WorkflowModel;
use App\Models\Admin\SubscriberModel;
use App\Models\Admin\TemplatesModel;
use App\Models\Admin\Crons\InviterModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Filesystem\Filesystem;
use Session;

class Referral extends Controller {

    public function index() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $bActiveSubsription = UsersModel::isActiveSubscription();
        $oPrograms = ReferralModel::getReferralLists($userID);
        $moduleName = 'referral';

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Referral Programs" class="sidebar-control active hidden-xs ">Referral Programs</a></li>
                    </ul>';

        $aPageData = array(
            'title' => 'Referral Module',
            'pagename' => $breadcrumb,
            'oPrograms' => $oPrograms,
            'bActiveSubsription' => $bActiveSubsription,
            'moduleName' => $moduleName
        );
		
		return view('admin.modules.referral.list', $aPageData);
    }

    
	public function overview() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a class="sidebar-control hidden-xs" >Referral</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Overview" class="sidebar-control active hidden-xs "> Overview</a></li>
                    </ul>';
        $oPrograms = ReferralModel::getReferralLists($userID);
        $oSales = ReferralModel::referredTotalSalesByUserId($userID);
        $oVisite = ReferralModel::referredTotalVisitsByUserId($userID);
        $oEmail = ReferralModel::getStatsTotalSentByUserId($userID);
        $oClick = ReferralModel::getStatsTotalClickByUserId($userID);
        $aPageData = array(
            'title' => 'Referral Module',
            'pagename' => $breadcrumb,
            'oPrograms' => $oPrograms,
            'oVisite' => $oVisite,
            'oSales' => $oSales,
            'oEmail' => $oEmail,
            'oClick' => $oClick
        );
		return view('admin.modules.referral.overview', $aPageData);
    }
	
	
	public function changeStatus(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $referralID = $request->refID;
        $status = $request->status;
        $aData = array(
            'status' => $status,
        );
        if ($referralID > 0) {
            $bUpdateID = ReferralModel::updateReferral($aData, $userID, $referralID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'id' => $bUpdateID, 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }
	
	public function moveToArchiveReferral(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $referralID = $request->ref_id;
        $aData = array(
            'status' => 'archive',
            'updated' => date("Y-m-d H:i:s")
        );

        if ($referralID > 0) {
            $bUpdateID = ReferralModel::updateReferral($aData, $userID, $referralID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }


    public function deleteReferral(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $referralID = $request->ref_id;
        if ($referralID > 0) {
            $bDeleted = ReferralModel::deleteReferral($userID, $referralID);
            if ($bDeleted) {
                $response = array('status' => 'success', 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }
	
	
	public function addReferral(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $title = $request->title;
		
        /*$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $hashcode = '';
        for ($i = 0; $i < 20; $i++) {
            $hashcode .= $characters[rand(0, strlen($characters))];
        }
        $hashcode = $hashcode . date('Ymdhis');*/
		
		$str=rand(); 
		$hashcode = sha1($str); 
        $hashcode = $hashcode . date('Ymdhis');
		
        $aData = array(
            'hashcode' => $hashcode,
            'user_id' => $userID,
            'title' => $title,
            'status' => 'draft',
            'created' => date("Y-m-d H:i:s")
        );
        $insertID = ReferralModel::addReferral($aData);

        if ($insertID) {
            //Update in automation table to take effect in email/sms settings
            $aEvent = array(
                'invite-email' => json_encode(array('delay_type' => 'after', 'delay_value' => 10, 'delay_unit' => 'minutes')),
                'invite-sms' => json_encode(array('delay_type' => 'after', 'delay_value' => 10, 'delay_unit' => 'minutes')),
                'invite-email-reminder' => json_encode(array('delay_type' => 'after', 'delay_value' => 2, 'delay_unit' => 'days')),
                'invite-sms-reminder' => json_encode(array('delay_type' => 'after', 'delay_value' => 2, 'delay_unit' => 'days')),
                'sale-email' => json_encode(array('delay_type' => 'after', 'delay_value' => 10, 'delay_unit' => 'minutes')),
                'sale-sms' => json_encode(array('delay_type' => 'after', 'delay_value' => 10, 'delay_unit' => 'minutes')),
                'sale-email-reminder' => json_encode(array('delay_type' => 'after', 'delay_value' => 2, 'delay_unit' => 'days')),
                'sale-sms-reminder' => json_encode(array('delay_type' => 'after', 'delay_value' => 2, 'delay_unit' => 'days'))
            );
            //$bSavedEvent = $this->mReferral->saveReferralEvents($aEvent, $insertID);
            //Save Settings
            $aDefaultSettings = array(
                'user_id' => $userID,
                'referral_id' => $insertID,
                'created' => date("Y-m-d H:i:s")
            );

            $bUpdated = ReferralModel::updateStoreSettings($aDefaultSettings, $insertID);

            $response = array('status' => 'success', 'id' => $insertID, 'msg' => "Success");

            $notificationData = array(
                'event_type' => 'added_referral_program',
                'event_id' => 0,
                'link' => base_url() . 'admin/modules/referral/setup/' . $insertID,
                'message' => 'Created new referral.',
                'user_id' => $userID,
                'status' => 1,
                'created' => date("Y-m-d H:i:s")
            );
            $eventName = 'sys_referral_added';
            //add_notifications($notificationData, $eventName, $userID);
        }
        echo json_encode($response);
        exit;
    }
	
	
	public function setup($referralID) {
        if (empty($referralID)) {
            redirect("admin/modules/referral");
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $bActiveSubsription = UsersModel::isActiveSubscription();
        $selectedTab = Input::get('t');
        $setReferralTab = Session::get("setReferralTab");

        if (empty($setReferralTab)) {
            Session::put("setReferralTab", 'config');
            $setReferralTab = Session::get("setReferralTab");
        }

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a href="' . base_url('admin/modules/referral/') . '" class="sidebar-control hidden-xs">Referral </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Setup" class="sidebar-control active hidden-xs ">Setup</a></li>
                    </ul>';

        $oReferral = ReferralModel::getReferral($userID, $referralID);
		
        if ($oReferral->user_id != $userID) {
            redirect('admin/modules/referral');
            exit;
        }

        if (empty($oReferral)) {
            die("Not authorized to access this page");
        }

        $accountID = $oReferral->hashcode;

        //Configuration Related Data
        $oAccountSettings = ReferralModel::getAccountSettings($referralID);

        $campaignTemplates = ReferralModel::getReferralTemplates($referralID);

        $eventsData = ReferralModel::getReferralEvents($referralID);

        //Reward related Data
        $oSettings = ReferralModel::getReferralSettings($accountID, true);
        $defaultTab = !empty($selectedTab) ? $selectedTab : 'config';
        if (!empty($oSettings)) {
            $programID = $oSettings->rewardID;
            $advCouponID = $oSettings->advCouponID;
            $refCouponID = $oSettings->refCouponID;
			$oAdvCouponCodes = array();
			$oRefCouponCodes = array();
            if ($advCouponID > 0) {
                $oAdvCouponCodes = ReferralModel::getAdvocateCouponCodes($advCouponID);
            }
            if ($refCouponID > 0) {
                $oRefCouponCodes = ReferralModel::getReferralCouponCodes($refCouponID);
            }
        }

        //List of Advocates related data 
        $oContacts = ReferralModel::getMyAdvocates($accountID);

        $moduleName = 'referral';
        $oEvents = WorkflowModel::getWorkflowEvents($referralID, $moduleName);
        $oEventsType = array('main', 'followup');
        $oCampaignTags = WorkflowModel::getWorkflowCampaignTags($moduleName);
        $oDefaultTemplates = WorkflowModel::getWorkflowDefaultTemplates($moduleName);


        $aData = array(
            'title' => 'Referral Settings',
            'pagename' => $breadcrumb,
            'defalutTab' => $defaultTab,
            'programID' => $programID,
            'oReferral' => $oReferral,
            'oSettings' => $oSettings,
            'accountID' => $accountID,
            'campaignTemplates' => $campaignTemplates,
            'oEvents' => $oEvents,
            'moduleName' => $moduleName,
            'moduleUnitID' => $referralID,
            'oEventsType' => $oEventsType,
            'oCampaignTags' => $oCampaignTags,
            'oDefaultTemplates' => $oDefaultTemplates,
            'eventsData' => $eventsData,
            'oAccountSettings' => $oAccountSettings,
            'oAdvCouponCodes' => $oAdvCouponCodes,
            'oRefCouponCodes' => $oRefCouponCodes,
            'oContacts' => $oContacts,
            'setReferralTab' => $setReferralTab,
            'userID' => $userID
        );

        $bActiveSubsription = UsersModel::isActiveSubscription();
		
		return view('admin.modules.referral.setup-source', $aData);
    }
	
	
	public function getReferral(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $referralID = $request->ref_id;
        $oReferral = ReferralModel::getReferral($userID, $referralID);
        if (!empty($oReferral)) {
            $response = array('status' => 'success', 'id' => $oReferral->id, 'title' => $oReferral->title);
        } else {
            $response = array('status' => 'error', 'msg' => 'Not found');
        }

        echo json_encode($response);
        exit;
    }
	
	
	public function updateReferral(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $referralID = $request->ref_id;
        $title = $request->title;
        $aData = array(
            'title' => $title,
            'updated' => date("Y-m-d H:i:s")
        );
        if ($referralID > 0) {
            $bUpdateID = ReferralModel::updateReferral($aData, $userID, $referralID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'id' => $bUpdateID, 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }

    
	public function updateSource(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $referralID = $request->ref_id;
        $sourceType = $request->source_type;
        $aData = array(
            'source_type' => $sourceType,
            'updated' => date("Y-m-d H:i:s")
        );
        if ($referralID > 0) {
            $bUpdateID = ReferralModel::updateReferral($aData, $userID, $referralID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'id' => $bUpdateID, 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }

    
	public function publishReferralStatus(Request $request) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $referralID = $request->ref_id;
        $status = $request->status;
        $aData = array(
            'status' => $status
        );
        if ($referralID > 0) {
            $bUpdateID = ReferralModel::updateReferral($aData, $userID, $referralID);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'id' => $bUpdateID, 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }


	public function reports($referralID) {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
		$referredAmount = 0;
		$untrackedAmount = 0;
        if ($referralID > 0) {
            $oSettings = ReferralModel::getReferralSettings($referralID);
            if (!empty($oSettings)) {
                $accountID = $oSettings->hashcode;
                $oRefPurchased = ReferralModel::referredSales($accountID);
                
                $oUntrackedPurchased = ReferralModel::untrackedSales($accountID);

                if (!empty($oRefPurchased)) {
                    foreach ($oRefPurchased as $row) {
                        $referredAmount = $referredAmount + $row->amount;
                    }
                }

                if (!empty($oUntrackedPurchased)) {
                    foreach ($oUntrackedPurchased as $row2) {
                        $untrackedAmount = $untrackedAmount + $row2->amount;
                    }
                }

                $oRefVisits = ReferralModel::getReferralLinkVisits($accountID);
                $oTotalReferralSent = ReferralModel::getStatsTotalSent($referralID);
                $oTotalReferralTwillio = ReferralModel::getSendgridStats($referralID);
            }


            $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a href="' . base_url('admin/modules/referral') . '" data-toggle="tooltip" data-placement="bottom" title="Referral Module" class="sidebar-control hidden-xs ">Referral Modules</a></li>
						<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" title="' . $oSettings->title . ' Report" class="sidebar-control active hidden-xs ">' . $oSettings->title . ' Report</a></li>
                    </ul>';

            $aData = array(
                'title' => 'Referral Report',
                'pagename' => $breadcrumb,
                'userID' => $userID,
                'oSettings' => $oSettings,
                'oRefPurchased' => $oRefPurchased,
                'referredAmount' => $referredAmount,
                'oRefVisits' => $oRefVisits,
                'untrackedAmount' => $untrackedAmount,
                'oUntrackedPurchased' => $oUntrackedPurchased,
                'oTotalReferralSent' => $oTotalReferralSent,
                'oTotalReferralTwillio' => $oTotalReferralTwillio
            );
			return view('admin.modules.referral.reports', $aData);
        }
    }

	public function stats($referralID,  Request $request) {

        $oUser = getLoggedUser();
        $userID = $oUser->id;

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/modules/referral/') . '">Referral</a></li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a data-toggle="tooltip" data-placement="bottom" title="Referral Report" class="sidebar-control active hidden-xs ">Referral Report</a></li>
                </ul>';

        $aSettings = ReferralModel::getAccountSettings($referralID);
        $oRefEvents = ReferralModel::getAutoEvents($referralID);

        $aData = array(
            'title' => 'Referral Report',
            'pagename' => $breadcrumb,
            'userID' => $userID,
            'aSettings' => $aSettings,
            'oRefEvents' => $oRefEvents,
            'type' => $request->type
        );
		
		return view('admin.modules.referral.referral-stats', $aData);
    }


	public function reward($referralID, Request $request) {
        if (empty($referralID)) {
            redirect("admin/modules/referral");
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $bActiveSubsription = UsersModel::isActiveSubscription();
        $selectedTab = $request->t;
        $setReferralTab = Session::get("setReferralTab");

        if (empty($setReferralTab)) {
            Session::put("setReferralTab", 'config');
            $setReferralTab = Session::get("setReferralTab");
        }

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a href="' . base_url('admin/modules/referral/') . '" class="sidebar-control hidden-xs">Referral </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Setup" class="sidebar-control active hidden-xs ">Setup</a></li>
                    </ul>';

        $oReferral = ReferralModel::getReferral($userID, $referralID);
        if (empty($oReferral)) {
            die("Not authorized to access this page");
        }

        $accountID = $oReferral->hashcode;


        //Configuration Related Data
        $oAccountSettings = ReferralModel::getAccountSettings($referralID);

        $campaignTemplates = ReferralModel::getReferralTemplates($referralID);

        $eventsData = ReferralModel::getReferralEvents($referralID);

        //Reward related Data
        $oSettings = ReferralModel::getReferralSettings($accountID, true);
		
        $defaultTab = !empty($selectedTab) ? $selectedTab : 'config';
		$oAdvCouponCodes = $oRefCouponCodes = 0;
        if (!empty($oSettings)) {
            $programID = $oSettings->rewardID;
            $advCouponID = $oSettings->advCouponID;
            $refCouponID = $oSettings->refCouponID;
            if ($advCouponID > 0) {
                $oAdvCouponCodes = ReferralModel::getAdvocateCouponCodes($advCouponID);
            }
            if ($refCouponID > 0) {
                $oRefCouponCodes = ReferralModel::getReferralCouponCodes($refCouponID);
            }
        }

        //List of Advocates related data 
        $oContacts = ReferralModel::getMyAdvocates($accountID);

        $moduleName = 'referral';
        $oEvents = WorkflowModel::getWorkflowEvents($referralID, $moduleName);
        $oEventsType = array('main', 'followup');
        $oCampaignTags = WorkflowModel::getWorkflowCampaignTags($moduleName);
        $oDefaultTemplates = WorkflowModel::getWorkflowDefaultTemplates($moduleName);


        $aData = array(
            'title' => 'Referral Settings',
            'pagename' => $breadcrumb,
            'defalutTab' => $defaultTab,
            'programID' => $programID,
            'oReferral' => $oReferral,
            'oSettings' => $oSettings,
            'accountID' => $accountID,
            'campaignTemplates' => $campaignTemplates,
            'oEvents' => $oEvents,
            'moduleName' => $moduleName,
            'moduleUnitID' => $referralID,
            'oEventsType' => $oEventsType,
            'oCampaignTags' => $oCampaignTags,
            'oDefaultTemplates' => $oDefaultTemplates,
            'eventsData' => $eventsData,
            'oAccountSettings' => $oAccountSettings,
            'oAdvCouponCodes' => $oAdvCouponCodes,
            'oRefCouponCodes' => $oRefCouponCodes,
            'oContacts' => $oContacts,
            'setReferralTab' => $setReferralTab,
            'userID' => $userID
        );

        $bActiveSubsription = UsersModel::isActiveSubscription();
		return view('admin.modules.referral.setup-reward', $aData);
    }

	
    public function workflow($referralID, Request $request) {
        if (empty($referralID)) {
            redirect("admin/modules/referral");
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $bActiveSubsription = UsersModel::isActiveSubscription();
        $selectedTab = $request->t;
        $setReferralTab = Session::get("setReferralTab");

        if (empty($setReferralTab)) {
            Session::put("setReferralTab", 'config');
            $setReferralTab = Session::get("setReferralTab");
        }

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a href="' . base_url('admin/modules/referral/') . '" class="sidebar-control hidden-xs">Referral </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Setup" class="sidebar-control active hidden-xs ">Setup</a></li>
                    </ul>';

        $oReferral = ReferralModel::getReferral($userID, $referralID);
        if (empty($oReferral)) {
            die("Not authorized to access this page");
        }

        $accountID = $oReferral->hashcode;


        //Configuration Related Data
        $oAccountSettings = ReferralModel::getAccountSettings($referralID);

        $campaignTemplates = ReferralModel::getReferralTemplates($referralID);

        $eventsData = ReferralModel::getReferralEvents($referralID);

        //Reward related Data
        $oSettings = ReferralModel::getReferralSettings($accountID, true);

        $defaultTab = !empty($selectedTab) ? $selectedTab : 'config';
        if (!empty($oSettings)) {
            $programID = $oSettings->rewardID;
            $advCouponID = $oSettings->advCouponID;
            $refCouponID = $oSettings->refCouponID;
            if ($advCouponID > 0) {
                $oAdvCouponCodes = ReferralModel::getAdvocateCouponCodes($advCouponID);
            }
            if ($refCouponID > 0) {
                $oRefCouponCodes = ReferralModel::getReferralCouponCodes($refCouponID);
            }
        }

        //List of Advocates related data 
        $oContacts = ReferralModel::getMyAdvocates($accountID);

        $moduleName = 'referral';
        $oEvents = WorkflowModel::getWorkflowEvents($referralID, $moduleName);
        $oEventsType = array('main', 'followup');
        $oCampaignTags = WorkflowModel::getWorkflowCampaignTags($moduleName);
        $oDefaultTemplates = WorkflowModel::getWorkflowDefaultTemplates($moduleName);
        $oTemplates = TemplatesModel::getCommonTemplates();
        $oCategories = TemplatesModel::getCommonTemplateCategories();


        $aData = array(
            'title' => 'Referral Settings',
            'pagename' => $breadcrumb,
            'defalutTab' => $defaultTab,
            'programID' => $programID,
            'oReferral' => $oReferral,
            'oSettings' => $oSettings,
            'oTemplates' => $oTemplates,
            'accountID' => $accountID,
            'campaignTemplates' => $campaignTemplates,
            'oEvents' => $oEvents,
            'moduleName' => $moduleName,
            'moduleUnitID' => $referralID,
            'oEventsType' => $oEventsType,
            'oCampaignTags' => $oCampaignTags,
            'oDefaultTemplates' => $oDefaultTemplates,
            'oTemplates' => $oTemplates,
            'oCategories' => $oCategories,
            'eventsData' => $eventsData,
            'oAccountSettings' => $oAccountSettings,
            'oAdvCouponCodes' => $oAdvCouponCodes,
            'oRefCouponCodes' => $oRefCouponCodes,
            'oContacts' => $oContacts,
            'setReferralTab' => $setReferralTab,
            'userID' => $userID
        );

        $bActiveSubsription = UsersModel::isActiveSubscription();
		return view('admin.modules.referral.setup-workflow', $aData);
    }
	

    public function configurations($referralID, Request $request) {
        if (empty($referralID)) {
            redirect("admin/modules/referral");
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $bActiveSubsription = UsersModel::isActiveSubscription();
        $selectedTab = $request->t;
        $setReferralTab = Session::get("setReferralTab");

        if (empty($setReferralTab)) {
            Session::put("setReferralTab", 'config');
            $setReferralTab = Session::get("setReferralTab");
        }

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a href="' . base_url('admin/modules/referral/') . '" class="sidebar-control hidden-xs">Referral </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Setup" class="sidebar-control active hidden-xs ">Setup</a></li>
                    </ul>';

        $oReferral = ReferralModel::getReferral($userID, $referralID);
        if (empty($oReferral)) {
            die("Not authorized to access this page");
        }

        $accountID = $oReferral->hashcode;

        //Configuration Related Data
        $oAccountSettings = ReferralModel::getAccountSettings($referralID);

        $campaignTemplates = ReferralModel::getReferralTemplates($referralID);

        $eventsData = ReferralModel::getReferralEvents($referralID);

        //Reward related Data
        $oSettings = ReferralModel::getReferralSettings($accountID, true);
		
        $defaultTab = !empty($selectedTab) ? $selectedTab : 'config';
        if (!empty($oSettings)) {
            $programID = $oSettings->rewardID;
            $advCouponID = $oSettings->advCouponID;
            $refCouponID = $oSettings->refCouponID;
            if ($advCouponID > 0) {
                $oAdvCouponCodes = ReferralModel::getAdvocateCouponCodes($advCouponID);
            }
            if ($refCouponID > 0) {
                $oRefCouponCodes = ReferralModel::getReferralCouponCodes($refCouponID);
            }
        }

        //List of Advocates related data 
        $oContacts = ReferralModel::getMyAdvocates($accountID);

        $moduleName = 'referral';
        $oEvents = WorkflowModel::getWorkflowEvents($referralID, $moduleName);
        $oEventsType = array('main', 'followup');
        $oCampaignTags = WorkflowModel::getWorkflowCampaignTags($moduleName);
        $oDefaultTemplates = WorkflowModel::getWorkflowDefaultTemplates($moduleName);


        $aData = array(
            'title' => 'Referral Settings',
            'pagename' => $breadcrumb,
            'defalutTab' => $defaultTab,
            'programID' => $programID,
            'oReferral' => $oReferral,
            'oSettings' => $oSettings,
            'oTemplates' => $oTemplates,
            'accountID' => $accountID,
            'campaignTemplates' => $campaignTemplates,
            'oEvents' => $oEvents,
            'moduleName' => $moduleName,
            'moduleUnitID' => $referralID,
            'oEventsType' => $oEventsType,
            'oCampaignTags' => $oCampaignTags,
            'oDefaultTemplates' => $oDefaultTemplates,
            'eventsData' => $eventsData,
            'oAccountSettings' => $oAccountSettings,
            'oAdvCouponCodes' => $oAdvCouponCodes,
            'oRefCouponCodes' => $oRefCouponCodes,
            'oContacts' => $oContacts,
            'setReferralTab' => $setReferralTab,
            'userID' => $userID
        );

        $bActiveSubsription = UsersModel::isActiveSubscription();
		return view('admin.modules.referral.setup-configurations', $aData);
    }
	

    public function integrations($referralID, Request $request) {
        if (empty($referralID)) {
            redirect("admin/modules/referral");
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $bActiveSubsription = UsersModel::isActiveSubscription();
        $selectedTab = $request->t;
        $setReferralTab = Session::get("setReferralTab");

        if (empty($setReferralTab)) {
            Session::put("setReferralTab", 'config');
            $setReferralTab = Session::get("setReferralTab");
        }

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a href="' . base_url('admin/modules/referral/') . '" class="sidebar-control hidden-xs">Referral </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Setup" class="sidebar-control active hidden-xs ">Setup</a></li>
                    </ul>';

        $oReferral = ReferralModel::getReferral($userID, $referralID);
        if (empty($oReferral)) {
            die("Not authorized to access this page");
        }

        $accountID = $oReferral->hashcode;


        //Configuration Related Data
        $oAccountSettings = ReferralModel::getAccountSettings($referralID);

        $campaignTemplates = ReferralModel::getReferralTemplates($referralID);

        $eventsData = ReferralModel::getReferralEvents($referralID);

        //Reward related Data
        $oSettings = ReferralModel::getReferralSettings($accountID, true);

        $defaultTab = !empty($selectedTab) ? $selectedTab : 'config';
        if (!empty($oSettings)) {
            $programID = $oSettings->rewardID;
            $advCouponID = $oSettings->advCouponID;
            $refCouponID = $oSettings->refCouponID;
            if ($advCouponID > 0) {
                $oAdvCouponCodes = ReferralModel::getAdvocateCouponCodes($advCouponID);
            }
            if ($refCouponID > 0) {
                $oRefCouponCodes = ReferralModel::getReferralCouponCodes($refCouponID);
            }
        }

        //List of Advocates related data 
        $oContacts = ReferralModel::getMyAdvocates($accountID);

        $moduleName = 'referral';
        $oEvents = WorkflowModel::getWorkflowEvents($referralID, $moduleName);
        $oEventsType = array('main', 'followup');
        $oCampaignTags = WorkflowModel::getWorkflowCampaignTags($moduleName);
        $oDefaultTemplates = WorkflowModel::getWorkflowDefaultTemplates($moduleName);


        $aData = array(
            'title' => 'Referral Settings',
            'pagename' => $breadcrumb,
            'defalutTab' => $defaultTab,
            'programID' => $programID,
            'oReferral' => $oReferral,
            'oSettings' => $oSettings,
            'oTemplates' => $oTemplates,
            'accountID' => $accountID,
            'campaignTemplates' => $campaignTemplates,
            'oEvents' => $oEvents,
            'moduleName' => $moduleName,
            'moduleUnitID' => $referralID,
            'oEventsType' => $oEventsType,
            'oCampaignTags' => $oCampaignTags,
            'oDefaultTemplates' => $oDefaultTemplates,
            'eventsData' => $eventsData,
            'oAccountSettings' => $oAccountSettings,
            'oAdvCouponCodes' => $oAdvCouponCodes,
            'oRefCouponCodes' => $oRefCouponCodes,
            'oContacts' => $oContacts,
            'setReferralTab' => $setReferralTab,
            'userID' => $userID
        );

        $bActiveSubsription = UsersModel::isActiveSubscription();
		return view('admin.modules.referral.setup-widget', $aData);
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	






	
	
	
	
	
	
    public function advocates($referralId = '') {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a class="sidebar-control hidden-xs" >Referral</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Advocates" class="sidebar-control active hidden-xs "> Advocates</a></li>
                    </ul>';

        if ($referralId != '') {
            $referralData = $this->mReferral->getReferral($userID, $referralId);
            $oContacts = $this->mReferral->getAllAdvocates($referralData->hashcode);
        } else {
            $oContacts = $this->mReferral->getAllAdvocates();
        }
        //pre($oContacts);
        $aPageData = array(
            'title' => 'Referral Module',
            'pagename' => $breadcrumb,
            'oContacts' => $oContacts
                //'oPrograms' => $oPrograms,
                //'bActiveSubsription' => $bActiveSubsription
        );
        $this->template->load('admin/admin_template_new', 'admin/modules/referral/advocate', $aPageData);
    }

    public function bulkDeleteReferrals() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $referralIDs = $post['bulk_referral_id'];
        if (!empty($referralIDs)) {
            foreach ($referralIDs as $refID) {
                $bDeleted = $this->mReferral->deleteReferral($userID, $refID);
            }
        }
        if ($bDeleted) {
            $response = array('status' => 'success', 'msg' => "Success");
        }
        echo json_encode($response);
        exit;
    }

    public function bulkArchiveReferrals() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $referralIDs = $post['bulk_referral_id'];
        $aData = array(
            'status' => 'archive',
            'updated' => date("Y-m-d H:i:s")
        );

        if (!empty($referralIDs)) {
            foreach ($referralIDs as $refID) {

                $bUpdateID = $this->mReferral->updateReferral($aData, $userID, $refID);
            }
        }

        if ($bUpdateID) {
            $response = array('status' => 'success', 'msg' => "Success");
        }
        echo json_encode($response);
        exit;
    }

    

    
    

    

    

    public function updateAllCampaign() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $post = $this->input->post();

        if (!empty($post)) {
            $referralId = strip_tags($post['referral_id']);

            if (!empty($referralId)) {
                $aData = array(
                    'status' => 'active'
                );
                $eventsData = $this->mReferral->getReferralEvents($referralId);
                foreach ($eventsData as $eventData) {
                    $bSaved = $this->mReferral->updataCampaignByEventID($aData, $eventData->id);
                }
                if ($bSaved) {
                    $response = array('status' => 'success', 'msg' => "Success");
                }
            }
        }
        echo json_encode($response);
        exit;
    }


    public function getReferralUserById() {

        $post = $this->input->post();
        $subscriberID = $post['subscriberID'];
        $bResponse = $this->mReferral->getReferralUserById($subscriberID);

        if ($bResponse) {
            $response = array('status' => 'success', 'result' => $bResponse);
        }
        echo json_encode($response);
        exit;
    }

    public function updateReferralSubscriber() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $post = $this->input->post();
        $email = $post['edit_email'];
        $firstname = $post['edit_firstname'];
        $lastname = $post['edit_lastname'];
        $phone = $post['edit_phone'];
        $subscriberID = $post['edit_subscriberID'];
        $bInsertedNewGlobalSubscriber = false;

        if (!empty($email)) {
            $oGlobalUser = $this->mSubscriber->checkIfGlobalSubscriberExists($userID, 'email', $email);
            if (!empty($oGlobalUser)) {
                $iSubscriberID = $oGlobalUser->id;
                $aGlobalUserData = array(
                    'email' => $email,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'phone' => $phone,
                    'updated' => date("Y-m-d H:i:s")
                );
                $this->mSubscriber->updateGlobalSubscriber($aGlobalUserData, $iSubscriberID);
            } else {
                //Add global subscriber
                $aSubscriberData = array(
                    'owner_id' => $userID,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'email' => $email,
                    'phone' => $phone,
                    'created' => date("Y-m-d H:i:s")
                );
                $iSubscriberID = $this->mSubscriber->addGlobalSubscriber($aSubscriberData);
                $bInsertedNewGlobalSubscriber = true;
            }
        }

        if ($bInsertedNewGlobalSubscriber == true) {
            $aData = array(
                'subscriber_id' => $iSubscriberID
            );

            $bResponse = $this->mReferral->updateReferralUser($aData, $subscriberID);
        }

        /* $aData = array(
          'email' => $email,
          'firstname' => $firstname,
          'lastname' => $lastname,
          'mobile' => $phone
          );
          $bResponse = $this->mReferral->updateReferralUser($aData, $subscriberID); */

        $response = array('status' => 'success', 'result' => $bResponse);
        echo json_encode($response);
        exit;
    }

    public function deleteReferralUser() {

        $post = $this->input->post();
        $subscriberID = $post['subscriberId'];
        $bResponse = $this->mReferral->deleteReferralUser($subscriberID);

        $response = array('status' => 'success', 'result' => $bResponse);
        echo json_encode($response);
        exit;
    }

    public function bulkDeleteReferralsUser() {

        $post = $this->input->post();
        $bulk_referral_id = $post['bulk_referral_id'];
        foreach ($bulk_referral_id as $subscriberID) {
            $bResponse = $this->mReferral->deleteReferralUser($subscriberID);
        }

        $response = array('status' => 'success', 'result' => $bResponse);
        echo json_encode($response);
        exit;
    }

    public function setup_old() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $selectedTab = $this->input->get('t');
        $breadcrumb = '<ul class="breadcrumb">
			<li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
			<li class=""><a href="' . base_url('admin/modules/referral') . '">Referral Module</a></li>
                        <li class="">Setup</li>
            </ul>';

        //Configuration Related Data
        $oAccountSettings = $this->mReferral->getAccountSettings($userID);

        $oTemplates = $this->mReferral->getUserReferralTemplates($oAccountSettings->id);
        $campaignTemplates = $this->mReferral->getReferralCampaignTemplates($oAccountSettings->id);

        $eventsData = $this->mReferral->getUserReferralEvents($oAccountSettings->id);

        //Reward related Data
        $oSettings = $this->mReferral->getReferralSettings($userID);
        //echo $userID;
        //pre($oSettings);
        $defaultTab = !empty($selectedTab) ? $selectedTab : 'config';
        if (!empty($oSettings)) {
            $programID = $oSettings->rewardID;
            $advCouponID = $oSettings->advCouponID;
            $refCouponID = $oSettings->refCouponID;
            if ($advCouponID > 0) {
                $oAdvCouponCodes = $this->mReferral->getAdvocateCouponCodes($advCouponID);
            }
            if ($refCouponID > 0) {
                $oRefCouponCodes = $this->mReferral->getReferralCouponCodes($refCouponID);
            }
        }

        //List of Advocates related data 
        $hashCode = $oSettings->hashcode;
        if (!empty($hashCode)) {
            $oContacts = $this->mReferral->getMyAdvocates($hashCode);
        }


        $aData = array(
            'title' => 'Referral Settings',
            'pagename' => $breadcrumb,
            'defalutTab' => $defaultTab,
            'programID' => $programID,
            'oSettings' => $oSettings,
            'oTemplates' => $oTemplates,
            'campaignTemplates' => $campaignTemplates,
            'eventsData' => $eventsData,
            'oAccountSettings' => $oAccountSettings,
            'oAdvCouponCodes' => $oAdvCouponCodes,
            'oRefCouponCodes' => $oRefCouponCodes,
            'oContacts' => $oContacts,
            'userID' => $userID
        );



        $bActiveSubsription = $this->mUser->isActiveSubscription();
        $this->template->load('admin/admin_template_new', 'admin/modules/referral/setup.php', $aData);
    }

    public function addReferral_old() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $actionName = strip_tags($post['doaction']);
        if ($actionName == 'setupDefault') {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $hashcode = '';
            for ($i = 0; $i < 20; $i++) {
                $hashcode .= $characters[rand(0, strlen($characters))];
            }
            $hashcode = $hashcode . date('Ymdhis');
            if ($userID > 0) {
                $aData = array(
                    'user_id' => $userID,
                    'hashcode' => md5($hashcode),
                    'updated' => date("Y-m-d H:i:s"),
                    'created' => date("Y-m-d H:i:s")
                );
                $bResponse = $this->mReferral->setupDefaultReferral($aData);
                if ($bResponse) {
                    $response = array('status' => 'success', 'msg' => "Success");
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    public function saveCoupons() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $couponType = strip_tags($post['couponType']);
        $referralID = strip_tags($post['rewardID']);
        $singleCouponCodes = strip_tags($post['singleCouponCodes']);
        $multipleCouponCodes = strip_tags($post['multipleCouponCodes']);
        $couponExpiry = strip_tags($post['coupon_expiry']);
        $specificExpiryTime = strip_tags($post['specific_expiry_picker']);

        $oAdvocateCoupon = $this->mReferral->getAdvocateCouponInfo($referralID);
        $oFriendCoupon = $this->mReferral->getFriendCouponInfo($referralID);

        if ($couponType == 'advocate_single_coupons') {
            $couponID = $oAdvocateCoupon->id;
            if (!empty($singleCouponCodes)) {
                $aData['coupon_id'] = $couponID;
                $aData['coupon_code'] = str_replace(" ", "", $singleCouponCodes);
                $aData['usage_type'] = 'single';
                $aData['updated'] = date("Y-m-d H:i:s");
                $aData['created'] = date("Y-m-d H:i:s");
                $aData['coupon_status'] = 1;
                $bSaved = $this->mReferral->addAdvocateCoupon($aData);
                if ($bSaved) {
                    $aUpdateData = array(
                        'advocate_coupon_type' => 'single',
                        'updated' => date("Y-m-d H:i:s")
                    );
                    $this->mReferral->updateAdvocateCouponCode($aUpdateData, $couponID);
                }
                $response = array('status' => 'success', 'msg' => "Success");
            }
        } else if ($couponType == 'advocate_multiple_coupons') {
            $couponID = $oAdvocateCoupon->id;
            $aData['coupon_id'] = $couponID;
            $aData['coupon_code'] = str_replace(" ", "", $multipleCouponCodes);
            $aData['usage_type'] = 'multiple';
            $aData['expiry'] = $couponExpiry;
            $aData['expiry_specific_date'] = $specificExpiryTime;
            $aData['updated'] = date("Y-m-d H:i:s");
            $aData['created'] = date("Y-m-d H:i:s");
            $aData['coupon_status'] = 1;
            $bSaved = $this->mReferral->addAdvocateCoupon($aData);
            if ($bSaved) {
                $aUpdateData = array(
                    'advocate_coupon_type' => 'multiple',
                    'updated' => date("Y-m-d H:i:s")
                );
                $this->mReferral->updateAdvocateCouponCode($aUpdateData, $couponID);
            }
            $response = array('status' => 'success', 'msg' => "Success");
        } else if ($couponType == 'referred_single_coupons') {
            $couponID = $oFriendCoupon->id;
            if (!empty($singleCouponCodes)) {
                $aData['coupon_id'] = $couponID;
                $aData['coupon_code'] = str_replace(" ", "", $singleCouponCodes);
                $aData['usage_type'] = 'single';
                $aData['updated'] = date("Y-m-d H:i:s");
                $aData['created'] = date("Y-m-d H:i:s");
                $aData['coupon_status'] = 1;
                $bSaved = $this->mReferral->addReferredCoupon($aData);
                if ($bSaved) {
                    $aUpdateData = array(
                        'referred_coupon_type' => 'single',
                        'updated' => date("Y-m-d H:i:s")
                    );
                    $this->mReferral->updateReferredCouponCode($aUpdateData, $couponID);
                }
                $response = array('status' => 'success', 'msg' => "Success");
            }
        } else if ($couponType == 'referred_multiple_coupons') {
            $couponID = $oFriendCoupon->id;
            $aData['coupon_id'] = $couponID;
            $aData['coupon_code'] = str_replace(" ", "", $multipleCouponCodes);
            $aData['usage_type'] = 'multiple';
            $aData['expiry'] = $couponExpiry;
            $aData['expiry_specific_date'] = $specificExpiryTime;
            $aData['updated'] = date("Y-m-d H:i:s");
            $aData['created'] = date("Y-m-d H:i:s");
            $aData['coupon_status'] = 1;
            $bSaved = $this->mReferral->addReferredCoupon($aData);
            if ($bSaved) {
                $aUpdateData = array(
                    'referred_coupon_type' => 'multiple',
                    'updated' => date("Y-m-d H:i:s")
                );
                $this->mReferral->updateReferredCouponCode($aUpdateData, $couponID);
            }
            $response = array('status' => 'success', 'msg' => "Success");
        }



        echo json_encode($response);
        exit;
    }

    public function saveRewards() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $rewardType = strip_tags($post['rewardType']);
        $rewardID = strip_tags($post['rewardID']);
        $advocateCouponDiscount = strip_tags($post['advocate_discount']);
        $advocateCash = strip_tags($post['advocate_cash']);
        $advocateCustom = strip_tags($post['advocate_custom']);
        $referredCouponDiscount = strip_tags($post['referred_discount']);
        $promoLink = strip_tags($post['referred_promo_link']);
        $promoDescription = strip_tags($post['referred_promo_desc']);
        $promoLinkExpiry = strip_tags($post['promo_expiry']);
        $promoLinkExpirySpecific = strip_tags($post['specific_expiry_picker']);

        $advocate_discount_price = strip_tags($post['advocate_discount_price']);
        $advocate_discount_type = strip_tags($post['advocate_discount_type']);
        $amount_type = strip_tags($post['amount_type']);

        $aData = array(
            'reward_id' => $rewardID,
            'updated' => date("Y-m-d H:i:s")
        );

        if ($rewardType == 'advocate_discount') {

            $aData['advocate_display_msg'] = $advocateCouponDiscount;
            //$aData['advocate_coupon_type'] = 'single';
            $aData['advocate_discount'] = $advocate_discount_price;
            $aData['advocate_discount_type'] = $advocate_discount_type;
            $iPrimaryID = $this->mReferral->saveAdvCouponDiscount($aData);
            if ($iPrimaryID > 0) {
                $aUpdateData = array(
                    'adv_coupon_id' => $iPrimaryID,
                    'cash_id' => '',
                    'custom_id' => '',
                    'updated' => date("Y-m-d H:i:s")
                );
            }
        } else if ($rewardType == 'advocate_cash') {
            $aData['display_msg'] = $advocateCash;
            $aData['amount'] = $advocate_discount_price;
            $aData['amount_type'] = $amount_type;
            $iPrimaryID = $this->mReferral->saveCashReward($aData);
            if ($iPrimaryID > 0) {
                $aUpdateData = array(
                    'adv_coupon_id' => '',
                    'cash_id' => $iPrimaryID,
                    'custom_id' => '',
                    'updated' => date("Y-m-d H:i:s")
                );
            }
        } else if ($rewardType == 'advocate_custom') {
            $aData['reward_title'] = $advocateCustom;
            $iPrimaryID = $this->mReferral->saveCustomReward($aData);
            if ($iPrimaryID > 0) {
                $aUpdateData = array(
                    'adv_coupon_id' => '',
                    'cash_id' => '',
                    'custom_id' => $iPrimaryID,
                    'updated' => date("Y-m-d H:i:s")
                );
            }
        } else if ($rewardType == 'referred_discount') {
            $aData['referred_display_msg'] = $referredCouponDiscount;
            //$aData['referred_coupon_type'] = 'single';
            $iPrimaryID = $this->mReferral->saveRefCouponDiscount($aData);
            if ($iPrimaryID > 0) {
                $aUpdateData = array(
                    'ref_coupon_id' => $iPrimaryID,
                    'promo_id' => '',
                    'no_discount' => '',
                    'updated' => date("Y-m-d H:i:s")
                );
            }
        } else if ($rewardType == 'referred_promo') {
            $aData['link_url'] = $promoLink;
            $aData['link_desc'] = $promoDescription;
            $aData['expiry'] = $promoLinkExpiry;
            $aData['expiry_specific_date'] = $promoLinkExpirySpecific;

            $iPrimaryID = $this->mReferral->savePromoLink($aData);
            if ($iPrimaryID > 0) {
                $aUpdateData = array(
                    'ref_coupon_id' => '',
                    'promo_id' => $iPrimaryID,
                    'no_discount' => '',
                    'updated' => date("Y-m-d H:i:s")
                );
            }
        } else if ($rewardType == 'referred_no_discount') {
            $iPrimaryID = 1;  //Just to set any numeric number to make condition true below in order to updte in the main table
            $aUpdateData = array(
                'ref_coupon_id' => '',
                'promo_id' => '',
                'no_discount' => 'yes',
                'updated' => date("Y-m-d H:i:s")
            );
        }




        if ($iPrimaryID > 0) {
            if (!empty($aUpdateData)) {
                $bSaved = $this->mReferral->updateReferralSettings($aUpdateData, $rewardID);
            }

            $response = array('status' => 'success', 'feature_id' => $iPrimaryID, 'msg' => "Success");
        }

        echo json_encode($response);
        exit;
    }

    public function contacts() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        if (!empty($userID)) {
            $oSettings = $this->mReferral->getReferralSettings($userID);
            $hashCode = $oSettings->hashcode;
            if (!empty($hashCode)) {
                $oContacts = $this->mReferral->getMyAdvocates($hashCode);
            }
        }

        $breadcrumb = '<ul class="breadcrumb">
                    <li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li><a href="' . base_url('admin/modules/referral') . '">Referral Module</a></li>
                    <li class="active">Contacts</li>
                </ul>';

        $data = array(
            'title' => 'My Advocates',
            'pagename' => $breadcrumb,
            'oContacts' => $oContacts
        );

        $this->template->load('admin/admin_template_new', 'admin/modules/referral/contacts', $data);
    }

    public function widgets_old() {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        if ($userID > 0) {
            $oSettings = $this->mReferral->getReferralSettings($userID);
            $breadcrumb = '<ul class="breadcrumb">
                    <li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li><a href="' . base_url('admin/modules/referral') . '">Referral Module</a></li>
                    <li class="active">Widgets</li>
                </ul>';

            $data = array(
                'title' => 'Widgets',
                'pagename' => $breadcrumb,
                'oSettings' => $oSettings
            );

            $this->template->load('admin/admin_template_new', 'admin/modules/referral/widget_code', $data);
        }
    }

    public function widgets() {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        if ($userID > 0) {
            $oWidgetsList = $this->mReferral->getReferralWidgets($userID);

            $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
				<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
				<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
				<li><a style="cursor:text;" class="sidebar-control hidden-xs">Widgets </a></li>
				<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
				<li><a data-toggle="tooltip" data-placement="bottom" title="Referral Widgets" class="sidebar-control active hidden-xs ">Referral Widgets</a></li>
				</ul>';

            $bActiveSubsription = $this->mUser->isActiveSubscription();
            $this->session->set_userdata('setTab', '');

            $aData = array(
                'title' => 'Referral Widgets',
                'pagename' => $breadcrumb,
                'oWidgetsList' => $oWidgetsList,
                'bActiveSubsription' => $bActiveSubsription,
                'user_role' => $user_role
            );

            $this->template->load('admin/admin_template_new', 'admin/modules/referral/widget_list', $aData);
        }
    }

    public function configuration() {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        if ($userID > 0) {
            $oSettings = $this->mReferral->getAccountSettings($userID);
            $breadcrumb = '<ul class="breadcrumb">
                    <li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li><a href="' . base_url('admin/modules/referral') . '">Referral Module</a></li>
                    <li class="active">Settings</li>
                </ul>';

            $data = array(
                'title' => 'Referral Settings',
                'pagename' => $breadcrumb,
                'oSettings' => $oSettings,
                'userID' => $userID
            );

            $this->template->load('admin/admin_template_new', 'admin/modules/referral/settings', $data);
        }
    }

    public function deleteBulkReferralWidgets() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $referralIDs = $post['multi_widget_id'];
        $aData = array(
            'delete_status' => 1
        );
        if (!empty($referralIDs)) {
            foreach ($referralIDs as $referralID) {
                $bDeleted = $this->mReferral->updateReferralWidget($aData, $referralID);
            }
        }
        if ($bDeleted) {
            $response = array('status' => 'success', 'msg' => "Success");
        }
        echo json_encode($response);
        exit;
    }

    public function archiveBulkReferralWidgets() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $referralIDs = $post['multi_widget_id'];
        $aData = array(
            'status' => 3
        );
        if (!empty($referralIDs)) {
            foreach ($referralIDs as $referralID) {
                $bDeleted = $this->mReferral->updateReferralWidget($aData, $referralID);
            }
        }
        if ($bDeleted) {
            $response = array('status' => 'success', 'msg' => "Success");
        }
        echo json_encode($response);
        exit;
    }

    public function addReferralWidget() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $post = $this->input->post();
        $referralTitle = $post['referralTitle'];
        $aData = array(
            'widget_title' => $referralTitle,
            'user_id' => $userID,
            'created' => date("Y-m-d H:i:s")
        );

        $response = $this->mReferral->createReferralWidget($aData);

        if ($response) {
            $response = array('status' => 'success', 'widgetId' => $response);
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    public function updatReferralWidgetStatus() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $post = $this->input->post();
        $widgetID = $post['widgetID'];
        $status = $post['status'];
        $aData = array(
            'status' => $status
        );

        $response = $this->mReferral->updateReferralWidget($aData, $widgetID);

        if ($response) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    public function publishReferralWidget() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $post = $this->input->post();
        $widgetID = $post['widget_id'];
        $status = 1;
        $aData = array(
            'status' => $status
        );

        $response = $this->mReferral->updateReferralWidget($aData, $widgetID);

        if ($response) {
            $response = array('status' => 'success');
        } else {
            $response = array('status' => 'error');
        }
        echo json_encode($response);
        exit;
    }

    public function addReferralWidgetApp() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $post = $this->input->post();
        $hashcode = $post['hashcode'];
        $referralId = $post['referral_id'];
        $widgetID = $post['widget_id'];
        $aData = array(
            'hashcode' => $hashcode,
            'referral_id' => $referralId
        );

        $result = $this->mReferral->updateReferralWidget($aData, $widgetID);

        //$referralData = $this->mReferral->getReferral($userID, $referralId);
        //pre($referralData);
        $referralData = $this->getReferralTagLines($hashcode);
        $sEmailPreview = $this->load->view("admin/modules/referral/widgets/widget_preview", array('oReferral' => $referralData), true);
        $referralScriptCode = 'test';
        if ($result) {
            $response = array('status' => 'success', 'preview' => $sEmailPreview, 'referralScriptCode' => $referralScriptCode);
        } else {
            $response = array('status' => 'error');
        }

        echo json_encode($response);
        exit;
    }

    public function delete_referral_widget() {

        $response = array();
        $post = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        //$userID = $this->session->userdata("current_user_id");
        if ($this->input->post()) {
            $post = $this->input->post();
            $widgetID = $post['widget_id'];

            $aData = array(
                'delete_status' => '1'
            );

            $result = $this->mReferral->updateReferralWidget($aData, $widgetID);

            if ($result) {

                $aActivityData = array(
                    'user_id' => $userID,
                    'event_type' => 'referral_widget',
                    'action_name' => 'deleted_referral_widget',
                    'widget_id' => $widgetID,
                    'campaign_id' => '',
                    'inviter_id' => '',
                    'subscriber_id' => '',
                    'feedback_id' => '',
                    'activity_message' => 'Referral Widget Deleted',
                    'activity_created' => date("Y-m-d H:i:s")
                );
                logUserActivity($aActivityData);
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function getReferralWidgetEmbedCode() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $response = array();
        $post = array();
        if ($this->input->post()) {
            $post = $this->input->post();
            $widgetID = $post['widget_id'];

            $result = $this->mReferral->getReferralWidgets($userID, $widgetID);
            $campaign_key = $result[0]->hashcode;
            if (!empty($result)) {
                $response['status'] = 'success';
                if ($campaign_key != '') {
                    $sWidget = 'referral';
                    $response['result'] = htmlentities('<script type="text/javascript" id="bbscriptloader" data-key="' . $campaign_key . '" data-widgets="' . $sWidget . '" async="" src="' . base_url('assets/js/ref_widgets.js') . '"></script>');
                } else {
                    $response['status'] = "Error";
                }
            } else {
                $response['status'] = "Errors";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function getReferralTagLines($accountID) {

        $oRewardSettings = $this->mReferral->getReferralSettings($accountID, $hash = true);
        //Get Advocate related reward details
        if (!empty($oRewardSettings->cash_id)) {
            $advTagline = 'get ' . $oRewardSettings->display_msg;
        } else if (!empty($oRewardSettings->custom_id)) {
            $advTagline = 'get ' . $oRewardSettings->reward_title;
        } else if (!empty($oRewardSettings->adv_coupon_id)) {
            $advTagline = 'get ' . $oRewardSettings->advocate_display_msg;
        }


        //Get Referred friend related reward details
        if (!empty($oRewardSettings->promo_id)) {
            $refTagline = 'Give your friend ' . $oRewardSettings->link_desc;
        } else if (!empty($oRewardSettings->ref_coupon_id)) {
            $refTagline = 'Give your friend ' . $oRewardSettings->referred_display_msg;
        }


        if (!empty($refTagline)) {
            $tagTitle = 'Refer your friends and ' . $advTagline;
            $completeTagLine = $refTagline . ' And when your friends buy from your invite link, you ' . $advTagline;
        }


        $widgetData = array(
            'accountID' => $accountID,
            'tagTitle' => $tagTitle,
            'tagLineDesc' => $completeTagLine
        );

        return $widgetData;
    }

    public function referral_widget_setup($widgetID) {
        $selectedTab = $this->input->get('t');
        $oUser = getLoggedUser();
        $userID = $oUser->id;

        if (empty($widgetID)) {
            redirect("admin/modules/referral/widgets");
            exit;
        }

        $oReferralList = $this->mReferral->getReferralLists($userID);
        $widgetData = $this->mReferral->getReferralWidgets($userID, $widgetID);
        //pre($widgetData);
        //$referralData = $this->mReferral->getReferral($userID, $widgetData[0]->referral_id);
        $referralData = $this->getReferralTagLines($widgetData[0]->hashcode);
        //pre($referralData);
        $sEmailPreview = $this->load->view("admin/modules/referral/widgets/widget_preview", array('oReferral' => $referralData), true);

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a href="' . base_url('admin/modules/referral/widgets') . '" class="sidebar-control hidden-xs">Referral Widgets </a></li>
			<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
			<li><a data-toggle="tooltip" data-placement="bottom" title="' . $widgetData[0]->widget_title . '" class="sidebar-control active hidden-xs ">' . $widgetData[0]->widget_title . '</a></li>
			</ul>';

        $aData = array(
            'title' => 'Referral Widget',
            'pagename' => $breadcrumb,
            'widgetID' => $widgetID,
            'oReferralList' => $oReferralList,
            'widgetData' => $widgetData[0],
            'sEmailPreview' => $sEmailPreview
        );

        $this->template->load('admin/admin_template_new', 'admin/modules/referral/referral_widget_setup', $aData);
    }

    public function saveEmailWorkflow() {

        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();

        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $source = strip_tags($post['notification_source']);
        $inviteDelay = strip_tags($post['invite_delay']);
        $salesDelay = strip_tags($post['sale_delay']);
        $reminderDelay = strip_tags($post['reminder_delay']);
        $userID = strip_tags($post['uid']);
        if ($userID > 0) {
            $aData = array(
                'notification_source' => $source,
                'invite_delay' => $inviteDelay,
                'sale_delay' => $salesDelay,
                'reminder_delay' => $reminderDelay,
                'reminder_delay_invite' => $reminderDelayInvite
            );

            $bUpdated = $this->mReferral->updateStoreSettings($aData, $userID);
            //{"delay_type":"after","delay_value":"10","delay_unit":"minute"}

            if ($bUpdated) {
                //Update in automation table to take effect in email/sms settings
                $aEvent = array(
                    'invite' => json_encode(array('delay_type' => 'after', 'delay_value' => $inviteDelay, 'delay_unit' => 'hours')),
                    'sale' => json_encode(array('delay_type' => 'after', 'delay_value' => $salesDelay, 'delay_unit' => 'days')),
                    'reminder' => json_encode(array('delay_type' => 'after', 'delay_value' => $reminderDelay, 'delay_unit' => 'weeks')),
                    'reminder_invite' => json_encode(array('delay_type' => 'after', 'delay_value' => $reminderDelayInvite, 'delay_unit' => 'weeks'))
                );
                $bSavedEvent = $this->mReferral->saveAutoEvents($aEvent, $source, $userID);
            }

            $response = array('status' => 'success', 'msg' => "Success");
        }

        echo json_encode($response);
        exit;
    }

    public function saveSettings() {

        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();

        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $oUser = getLoggedUser();
        $userID = $oUser->id;

        $referral_title = strip_tags($post['referral_title']);
        $storeName = strip_tags($post['storeName']);
        $storeURL = strip_tags($post['storeURL']);
        $storeEmail = strip_tags($post['storeEmail']);
        $referralStatus = $post['referralStatus'];

        $facebookTitle = $post['facebook_title'];
        $facebookDesc = $post['facebook_desc'];
        $twitterTitle = $post['twitter_title'];
        $twitterDesc = $post['twitter_desc'];
        $siteLink = $post['site_link'];


        if (!empty($referralStatus)) {
            $status = 'active';
        } else {
            $status = 'draft';
        }

        //$userID = strip_tags($post['uid']);
        $referralID = strip_tags($post['refid']);
        if ($referralID > 0 && $userID > 0) {

            $aDataRef = array(
                'title' => $referral_title,
                'status' => $status,
                'updated' => date("Y-m-d H:i:s")
            );

            $bUpdateID = $this->mReferral->updateReferral($aDataRef, $userID, $referralID);

            $aData = array(
                'user_id' => $userID,
                'referral_id' => $referralID,
                'store_name' => $storeName,
                'store_url' => $storeURL,
                'store_email' => $storeEmail,
                'facebook_title' => $facebookTitle,
                'facebook_desc' => $facebookDesc,
                'twitter_title' => $twitterTitle,
                'twitter_desc' => $twitterDesc,
                'site_link' => $siteLink
            );

            $bUpdated = $this->mReferral->updateStoreSettings($aData, $referralID);


            if ($bUpdated) {
                //Update in automation table to take effect in email/sms settings
                $aEvent = array(
                    'invite' => json_encode(array('delay_type' => 'after', 'delay_value' => $inviteDelay, 'delay_unit' => 'hours')),
                    'sale' => json_encode(array('delay_type' => 'after', 'delay_value' => $salesDelay, 'delay_unit' => 'days')),
                    'reminder' => json_encode(array('delay_type' => 'after', 'delay_value' => $reminderDelay, 'delay_unit' => 'weeks')),
                    'reminder_invite' => json_encode(array('delay_type' => 'after', 'delay_value' => $reminderDelayInvite, 'delay_unit' => 'weeks'))
                );
                $bSavedEvent = $this->mReferral->saveAutoEvents($aEvent, $source, $userID);
            }

            $response = array('status' => 'success', 'msg' => "Success");
        }

        echo json_encode($response);
        exit;
    }

    public function templates() {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        if ($userID > 0) {
            $oSettings = $this->mReferral->getAccountSettings($userID);
            if (!empty($oSettings)) {
                $settingsID = $oSettings->id;
                $oCampaigns = $this->mReferral->getUserReferralTemplates($settingsID);
            }

            $breadcrumb = '<ul class="breadcrumb">
                    <li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li><a href="' . base_url('admin/modules/referral') . '">Referral Module</a></li>
                    <li class="active">Email/Sms Templates</li>
                </ul>';

            $data = array(
                'title' => 'Email/Sms Templates',
                'pagename' => $breadcrumb,
                'oSettings' => $oSettings,
                'oCampaigns' => $oCampaigns,
                'userID' => $userID
            );

            $this->template->load('admin/admin_template_new', 'admin/modules/referral/templates', $data);
        }
    }

    public function updateUserCampaign() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $post = $this->input->post();

        if (!empty($post)) {
            $campaignID = strip_tags($post['campaignId']);
            $campaingType = strip_tags($post['campaignType']);
            if ($campaingType == 'Email') {
                $content = $post['emailtemplate'];
            } else {
                $content = $post['smstemplate'];
            }

            if (!empty($campaignID)) {
                $aData = array(
                    'html' => base64_encode($content)
                );
                $bSaved = $this->mReferral->updateUserCampaign($aData, $campaignID);
                if ($bSaved) {
                    $response = array('status' => 'success', 'msg' => "Success");
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    public function updateReferralEvent() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        $post = $this->input->post();

        if (!empty($post)) {
            $eventID = strip_tags($post['event_id']);
            $timeValue = strip_tags($post['delay_value']);
            $timeUnit = strip_tags($post['delay_unit']);

            if (!empty($eventID)) {
                $timeData = json_encode(array('delay_type' => 'after', 'delay_value' => $timeValue, 'delay_unit' => $timeUnit));
                $aData = array(
                    'data' => $timeData
                );

                $bSaved = $this->mReferral->updateAutoEvent($aData, $eventID);
                if ($bSaved) {
                    $response = array('status' => 'success', 'msg' => "Success");
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    public function deleteReferralCampaign() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        $post = $this->input->post();

        if (!empty($post)) {
            $campaignID = strip_tags($post['campaign_id']);

            if (!empty($campaignID)) {
                $aData = array(
                    'delete_status' => 1
                );
                $bSaved = $this->mReferral->updateUserCampaign($aData, $campaignID);
                $rCampaignData = $this->mReferral->getReferralCampaign($campaignID);

                $eventId = $rCampaignData[0]->event_id;
                $rEventData = $this->mReferral->getEventDataByEventID($eventId);
                $previousEventId = $rEventData[0]->previous_event_id;
                $aData = array(
                    'previous_event_id' => $previousEventId
                );
                $this->mReferral->updateEventByPEId($aData, $eventId);
                if ($bSaved) {
                    $response = array('status' => 'success', 'msg' => "Success");
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    public function updateReferralReminderCampaign() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        $post = $this->input->post();

        if (!empty($post)) {
            $eventID = strip_tags($post['event_id']);
            $reminderLoopStatus = strip_tags($post['reminder_loop_status']);

            if (!empty($eventID)) {
                $aData = array(
                    'reminder_loop_status' => $reminderLoopStatus
                );

                $bSaved = $this->mReferral->updateEvent($aData, $eventID);
                if ($bSaved) {
                    $response = array('status' => 'success', 'msg' => "Success");
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    public function updateReferralReminderLoop() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

        $post = $this->input->post();

        if (!empty($post)) {
            $eventID = strip_tags($post['event_id']);
            $loopValue = strip_tags($post['loop_value']);

            if (!empty($eventID)) {
                $aData = array(
                    'reminder_loop' => $loopValue,
                    'total_reminder_loop' => $loopValue
                );

                $bSaved = $this->mReferral->updateEvent($aData, $eventID);
                if ($bSaved) {
                    $response = array('status' => 'success', 'msg' => "Success");
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    public function updateReferralCampaign() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $post = $this->input->post();

        if (!empty($post)) {
            $campaignID = strip_tags($post['campaign_id']);
            $subject = strip_tags($post['subject']);
            $content = $post['template_content'];
            $campaignType = $post['campaign_type'];

            if (!empty($campaignID)) {
                if ($campaignType == 'Email') {
                    $aData = array(
                        'subject' => $subject,
                        'delete_status' => 0,
                        'html' => base64_encode($content)
                    );
                } else {
                    $aData = array(
                        'delete_status' => 0,
                        'html' => base64_encode($content)
                    );
                }

                $bSaved = $this->mReferral->updateUserCampaign($aData, $campaignID);

                $rCampaignData = $this->mReferral->getReferralCampaign($campaignID);

                $eventId = $rCampaignData[0]->event_id;
                $rEventData = $this->mReferral->getEventDataByEventID($eventId);
                $previousEventId = $rEventData[0]->previous_event_id;
                $referralId = $rEventData[0]->referral_id;

                $aData = array(
                    'previous_event_id' => $eventId
                );
                $this->mReferral->updateEventByPreId($aData, $previousEventId, $eventId, $referralId);

                if ($bSaved) {
                    $response = array('status' => 'success', 'msg' => "Success");
                }
            }
        }
        echo json_encode($response);
        exit;
    }

    public function publishReferralCampaign() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $referralId = strip_tags($post['referralId']);
        $aData = array(
            'status' => 'active',
        );
        if ($referralId > 0) {
            $bUpdateID = $this->mReferral->updateReferralSettings($aData, $referralId);
            if ($bUpdateID) {
                $response = array('status' => 'success', 'id' => $referralId, 'msg' => "Success");
            }
        }

        echo json_encode($response);
        exit;
    }

    // Export data in CSV format 
    public function exportCSV() {
        // file name 
        $filename = 'users_' . time() . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");

        $post = $this->input->post();
        $accountId = $post['account_id'];
        $userID = $this->session->userdata("current_user_id");
        $allSubscribers = $this->mReferral->getReferralUsers($accountId);
        //pre($allSubscribers);
        // file creation 
        $file = fopen('php://output', 'w');

        $header = array("EMAIL", "FIRST_NAME", "LAST_NAME", "PHONE");
        fputcsv($file, $header);
        foreach ($allSubscribers as $key => $line) {
            fputcsv($file, $line);
        }
        fclose($file);
        //Add Useractivity log

        $aActivityData = array(
            'user_id' => $userID,
            'event_type' => 'referral_users_export',
            'action_name' => 'downloaded_user_export',
            'referral_account' => $accountId,
            'campaign_id' => '',
            'inviter_id' => '',
            'subscriber_id' => '',
            'feedback_id' => '',
            'activity_message' => 'Users exported from referral module',
            'activity_created' => date("Y-m-d H:i:s")
        );
        logUserActivity($aActivityData);
        exit;
    }

    public function invites() {

        $oUser = getLoggedUser();
        $userID = $oUser->id;
        if ($userID > 0) {
            $oSettings = $this->mReferral->getReferralSettings($userID);
            $breadcrumb = '<ul class="breadcrumb">
                    <li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li><a href="' . base_url('admin/modules/referral') . '">Referral Module</a></li>
                    <li class="active">Invite Advocates</li>
                </ul>';

            $data = array(
                'title' => 'Invite Advocates',
                'pagename' => $breadcrumb,
                'userID' => $userID,
                'oSettings' => $oSettings
            );

            $this->template->load('admin/admin_template_new', 'admin/modules/referral/invite', $data);
        }
    }

    public function registerInvite_old() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (!empty($post)) {
            $accountID = strip_tags($post['bbaid']);
            $firstName = strip_tags($post['firstname']);
            $lastName = strip_tags($post['lastname']);
            $email = strip_tags($post['email']);
            $phone = strip_tags($post['phone']);
            $affiliateID = strip_tags($post['userid']);
            $aData = array(
                'email' => $email,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'phone' => $phone,
                'accountID' => $accountID,
                'affiliateID' => $affiliateID
            );
            $refLink = $this->registerNow($aData);
            if (!empty($refLink)) {
                $response = array('status' => 'success', 'reflink' => $refLink, 'msg' => "Success");
            }
        }
        echo json_encode($response);
        exit;
    }

    public function registerInvite() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $post = $this->input->post();
        if (!empty($post)) {
            $accountID = strip_tags($post['bbaid']);
            $firstName = strip_tags($post['firstname']);
            $lastName = strip_tags($post['lastname']);
            $email = strip_tags($post['email']);
            $phone = strip_tags($post['phone']);
            $affiliateID = strip_tags($post['userid']);
            $oGlobalUser = $this->mSubscriber->checkIfGlobalSubscriberExists($userID, 'email', $email);
            //pre($oGlobalUser);
            //die;
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
                $iSubscriberID = $this->mSubscriber->addGlobalSubscriber($aSubscriberData);
            }

            $aData = array(
                'subscriber_id' => $iSubscriberID,
                'account_id' => $accountID,
                'affiliateid' => $affiliateID,
                'created' => date("Y-m-d H:i:s")
            );
            $refLink = $this->registerNow($aData);
            if (!empty($refLink)) {
                $response = array('status' => 'success', 'reflink' => $refLink, 'msg' => "Success");
            }
        }
        echo json_encode($response);
        exit;
    }

    public function registerNow_old($aData) {
        if (!empty($aData)) {
            $email = $aData['email'];
            $firstName = $aData['firstName'];
            $lastName = $aData['lastName'];
            $phone = $aData['phone'];
            $accountID = $aData['accountID'];
            $affiliateID = $aData['affiliateID'];
            if (!empty($email)) {
                $oExistingUser = $this->mReferral->checkIfExistingAdvocate($email, $accountID);
                if (!empty($oExistingUser)) {
                    $existingUserID = $oExistingUser->id;
                    $refLink = site_url() . 'ref/t/' . $oExistingUser->refkey;
                    $response = array('status' => 'success', 'reflink' => $refLink, 'msg' => "Success");
                } else {
                    //Ok we are good now, go ahead and register a new user
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $randstring = '';
                    for ($i = 0; $i < 8; $i++) {
                        $randstring .= $characters[rand(0, strlen($characters))];
                    }
                    $password_hash = 'Umair';
                    $siteSalt = 'Rahul';
                    $pwd = base64_encode($password . $password_hash . $siteSalt);
                    $data = array(
                        'account_id' => $accountID,
                        'firstname' => $firstName,
                        'lastname' => $lastName,
                        'email' => $email,
                        'status' => 1,
                        'password' => $pwd,
                        'mobile' => $phone,
                        'affiliateid' => $affiliateID,
                        'created' => date("Y-m-d H:i:s")
                    );

                    $referredUserID = $this->mReferral->addReferredUser($data);

                    if (!empty($referredUserID)) {
                        //Generate Referral Link
                        $oSettings = $this->mReferral->getReferralSettings($accountID, $hash = true);
                        //$settingData = $this->mReferral->getAccountSettings($oSettings->user_id);
                        $storeID = $oSettings->rewardID;
                        if ($storeID > 0) {
                            $timeNow = time();
                            $refKey = $referredUserID . '-' . $timeNow;
                            $aRefData = array(
                                'referral_id' => $storeID,
                                'advocate_id' => $referredUserID,
                                'refkey' => $refKey,
                                'created' => date("Y-m-d H:i:s")
                            );
                            $bAdded = $this->mReferral->createReferralLink($aRefData);
                            if ($bAdded) {
                                $refLink = site_url() . 'ref/t/' . $refKey;
                                $response = array('status' => 'success', 'reflink' => $refLink, 'msg' => "Success");
                            }
                        }
                    }
                }
            }

            if (!empty($refLink)) {
                return $refLink;
            }
        }
        return false;
    }

    public function registerNow($aData) {
        if (!empty($aData)) {
            $subscriberID = $aData['subscriber_id'];
            $accountID = $aData['account_id'];
            $affiliateID = $aData['affiliateID'];
            if (!empty($subscriberID)) {
                $oExistingUser = $this->mReferral->checkIfExistingAdvocate($subscriberID, $accountID);

                if (!empty($oExistingUser)) {
                    $refLink = site_url() . 'ref/t/' . $oExistingUser->refkey;
                    $response = array('status' => 'success', 'reflink' => $refLink, 'msg' => "Success");
                } else {
                    //Ok we are good now, go ahead and register a new user
                    $referredUserID = $this->mReferral->addReferredUser($aData);

                    if (!empty($referredUserID)) {
                        //Generate Referral Link
                        $oSettings = $this->mReferral->getReferralSettings($accountID, $hash = true);
                        //$settingData = $this->mReferral->getAccountSettings($oSettings->user_id);
                        $storeID = $oSettings->rewardID;
                        if ($storeID > 0) {
                            $timeNow = time();
                            $refKey = $referredUserID . '-' . $timeNow;
                            $aRefData = array(
                                'referral_id' => $storeID,
                                'advocate_id' => $referredUserID,
                                'refkey' => $refKey,
                                'created' => date("Y-m-d H:i:s")
                            );
                            $bAdded = $this->mReferral->createReferralLink($aRefData);
                            if ($bAdded) {
                                $refLink = site_url() . 'ref/t/' . $refKey;
                                $response = array('status' => 'success', 'reflink' => $refLink, 'msg' => "Success");
                            }
                        }
                    }
                }
            }

            if (!empty($refLink)) {
                return $refLink;
            }
        }
        return false;
    }

    public function importInviteCSV() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        $post = $this->input->post();
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000';
        $accountID = strip_tags($post['bbaid']);
        $affiliateID = strip_tags($post['userid']);


        $this->load->library('upload', $config);

        // If upload failed, display error
        if (!$this->upload->do_upload()) {
            $response = array('status' => 'error', 'msg' => 'Fileupload failed');
        } else {

            $aFile = $this->upload->data();
            $sPath = './uploads/' . $aFile['file_name'];
            if ($this->csvimport->get_array($sPath)) {
                $aUsers = $this->csvimport->get_array($sPath);
                $emailUserId = '';
                foreach ($aUsers as $row) {
                    $firstName = $row['FIRST_NAME'];
                    $lastName = $row['LAST_NAME'];
                    $email = $row['EMAIL'];
                    $phone = $row['PHONE'];
                    $oGlobalUser = $this->mSubscriber->checkIfGlobalSubscriberExists($userID, 'email', $email);
                    //pre($oGlobalUser);
                    //die;
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
                        $iSubscriberID = $this->mSubscriber->addGlobalSubscriber($aSubscriberData);
                    }

                    $aData = array(
                        'subscriber_id' => $iSubscriberID,
                        'account_id' => $accountID,
                        'affiliateid' => $affiliateID,
                        'created' => date("Y-m-d H:i:s")
                    );
                    $refLink = $this->registerNow($aData);
                }
            } else {
                $data['error'] = "Error occured";
            }
        }
        $response = array('status' => 'success', 'msg' => "Success");
        echo json_encode($response);
        exit;
    }

    public function invoices($referralID) {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        if ($userID > 0) {
            $oSettings = $this->mReferral->getReferralSettings($referralID);
            if (!empty($oSettings)) {
                $accountID = $oSettings->hashcode;
                $oInvoices = $this->mReferral->getReferralInvoices($accountID);
            }
            $breadcrumb = '<ul class="breadcrumb">
                    <li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li><a href="' . base_url('admin/modules/referral') . '">Referral Module</a></li>
                    <li class="active">Invoice History</li>
                </ul>';

            $data = array(
                'title' => 'Invite Advocates',
                'pagename' => $breadcrumb,
                'userID' => $userID,
                'oSettings' => $oSettings,
                'oInvoices' => $oInvoices
            );

            $this->template->load('admin/admin_template_new', 'admin/modules/referral/invoices', $data);
        }
    }

    public function integration() {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        if ($userID > 0) {
            $oSettings = $this->mReferral->getReferralSettings($userID);
            $breadcrumb = '<ul class="breadcrumb">
                    <li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li><a href="' . base_url('admin/modules/referral') . '">Referral Module</a></li>
                    <li class="active">Integration</li>
                </ul>';

            $data = array(
                'title' => 'Integration',
                'pagename' => $breadcrumb,
                'userID' => $userID,
                'oSettings' => $oSettings
            );

            $this->template->load('admin/admin_template_new', 'admin/modules/referral/integration', $data);
        }
    }

    

    public function advocateReports($advocateID, $accountID) {
        $oUser = getLoggedUser();
        $userID = $oUser->id;
        if ($advocateID > 0) {
            $advocateData = $this->mReferral->getAdvocateById($advocateID, $accountID);

            $referralData = $this->mReferral->getReferralByAccountId($accountID);
            //$referralTrackData = $this->mReferral->getReferralLinkVisitsByAdvocateId($advocateID, $accountID);
            $referralSaleTrackData = $this->mReferral->referredSalesByAdvocateId($advocateID, $accountID);

            $oTotalReferralSent = $this->mReferral->getStatsTotalSent($referralID);
            $oTotalReferralTwillio = $this->mReferral->getSendgridStats($referralID);

            $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a href="' . base_url('admin/modules/referral/advocates') . '" data-toggle="tooltip" data-placement="bottom" title="Advocates" class="sidebar-control  hidden-xs ">Advocates</a></li>
						<li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" title="' . $advocateData->firstname . ' Report" class="sidebar-controlactive hidden-xs ">' . $oSettings->name . ' Report</a></li>
                    </ul>';

            $data = array(
                'title' => 'Advocate Report',
                'pagename' => $breadcrumb,
                'advocateData' => $advocateData,
                'referralData' => $referralData,
                //'referralTrackData' => $referralTrackData,
                'referralSaleTrackData' => $referralSaleTrackData
            );

            $this->template->load('admin/admin_template_new', 'admin/modules/referral/advocate_reports', $data);
        }
    }

    public function getReferralCampaign() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (empty($post)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $campaignID = strip_tags($post['campaign_id']);
        if ($campaignID > 0) {
            $oCampaign = $this->mReferral->getReferralCampaign($campaignID);
            if (!empty($oCampaign)) {
                $response = array('status' => 'success', 'campData' => $oCampaign[0], 'description' => base64_decode($oCampaign[0]->html), 'content' => base64_decode($oCampaign[0]->html));
            } else {
                $response = array('status' => 'error', 'msg' => 'Campaign not found');
            }
        } else {
            $response = array('status' => 'error', 'msg' => 'Campaign id is missing');
        }
        echo json_encode($response);
        exit;
    }

    

    public function saledetails($id = 0) {

        $oNotes = $this->mReferral->getReferralNotes($id);
        $oSale = $this->mReferral->getResponseDetails($id);
        $oTags = $this->mReferral->getTagsBySaleID($id);



        $breadcrumb = '<ul class="breadcrumb">
			<li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
			<li class=""><a href="' . base_url('admin/modules/referral') . '">Referral Module</a></li>
                        <li class="">Referral Sale Details</li>
            </ul>';

        $this->template->load('admin/admin_template_new', 'admin/modules/referral/sale_details', array(
            'title' => 'Referral Details',
            'pagename' => $breadcrumb,
            'oSale' => $oSale,
            'oNotes' => $oNotes,
            'oTags' => $oTags,
            'scoreID' => $scoreID
        ));
    }

    public function listAllTags() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $post = $this->input->post();
        if (empty($post) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $saleID = $post['sale_id'];
        if ($saleID > 0) {
            $aAppliedTags = $this->mReferral->getTagsBySaleID($saleID);
        }

        $aTag = $this->mReferral->getClientTags($userID);
        $sTags = $this->load->view('admin/tags/mytags', array('oTags' => $aTag, 'aAppliedTags' => $aAppliedTags), true);
        $response = array('status' => 'success', 'list_tags' => $sTags);
        echo json_encode($response);
        exit;
    }

    public function applySaleTag() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $post = $this->input->post();
        if (empty($post) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $saleID = strip_tags($post['sale_id']);
        $aTagID = $post['applytag'];
        $aInput = array(
            'aTagIDs' => $aTagID,
            'referral_response_id' => $saleID
        );

        $bAdded = $this->mReferral->addReferralTag($aInput);

        if ($bAdded) {
            $response = array('status' => 'success', 'msg' => 'Tag added successfully!');
            echo json_encode($response);
            exit;
        } else {
            $response = array('status' => 'error', 'msg' => 'Something went wrong!');
            echo json_encode($response);
            exit;
        }
    }

    public function removeReferralTag() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $post = $this->input->post();
        if (empty($post) || empty($userID)) {
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $saleID = strip_tags($post['saleID']);
        $tagID = strip_tags($post['tag_id']);

        if (!empty($saleID) && $saleID > 0) {
            $bDeleted = $this->mReferral->removeReferralTag($tagID, $saleID);
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

    public function getReferralNoteById() {

        $response = array();
        $response['status'] = 'error';
        $post = array();
        if ($this->input->post()) {
            $post = $this->input->post();
            $noteID = strip_tags($post['noteid']);
            $noteData = $this->mReferral->getReferralNoteByID($noteID);
            if ($noteData) {
                $response['status'] = 'success';
                $response['result'] = $noteData;
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function updatNotes() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (!empty($post)) {
            $noteId = strip_tags($post['edit_noteid']);
            $sNotes = $post['edit_note_content'];
            $aNotesData = array(
                'notes' => $sNotes
            );

            $bSaved = $this->mReferral->updateReferralNote($aNotesData, $noteId);
            if ($bSaved) {
                $response = array('status' => 'success', 'message' => 'Note has been updated succesfully.');
            }
            echo json_encode($response);
            exit;
        }
    }

    public function saveReferralNotes() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if (!empty($post)) {
            $saleID = strip_tags($post['saleid']);
            $referralID = strip_tags($post['referralid']);
            $userID = strip_tags($post['uid']);
            $sNotes = $post['notes'];
            $aNotesData = array(
                'referral_response_id' => $saleID,
                'user_id' => $userID,
                'referral_id' => $referralID,
                'notes' => $sNotes,
                'created' => date("Y-m-d H:i:s")
            );

            $bSaved = $this->mReferral->saveReferralNotes($aNotesData);
            if ($bSaved) {
                $response = array('status' => 'success', 'message' => 'Note has been added succesfully.');
            }
            echo json_encode($response);
            exit;
        }
    }

    public function deleteReferralNote() {
        $response = array();
        $post = $this->input->post();
        $noteid = strip_tags($post['noteid']);
        $result = $this->mReferral->deleteReferralNoteByID($noteid);
        if ($result) {
            $response['status'] = 'success';
        } else {
            $response['status'] = "Error";
        }

        echo json_encode($response);
        exit;
    }

    public function setTab() {

        $response = array();
        $post = array();
        $post = $this->input->post();
        if (!empty($post)) {
            $getActiveText = $post['getActiveText'];
            $this->session->set_userdata("setReferralTab", trim($getActiveText));
            $response['status'] = 'success';
        }

        echo json_encode($response);
        exit;
    }

    public function advocateProfile($contactId) {
        $oUser = getLoggedUser();
        $clientID = $oUser->id;
        $response = array();
        $response['status'] = 'error';
        $post = $this->input->post();
        if (!empty($post)) {
            $subscriberID = strip_tags($post['subscriberId']);
            $actionName = strip_tags($post['action']);
            $accountID = strip_tags($post['accountId']);
        }

        if (!empty($contactId)) {
            $moduleName = 'people';
            $subscriberID = (!empty($subscriberID)) ? $subscriberID : $contactId;
            $subsData = $this->mSubscriber->getModuleSubscriberInfo($moduleName, $subscriberID);
            $subscribersData = $subsData[0];
            if (!empty($subscribersData)) {
                if ($moduleName != 'people') {
                    $contactId = $subscribersData->id;
                }
            }

            //Get Referral Related information
            $oReferral = $this->mReferral->getReferralProgramInfo($accountID);
            $referralID = $oReferral->id;
            $oRefLink = $this->mReferral->getReferralLinkDetails($subscriberID, $referralID);
            $oSettings = $this->mReferral->getReferralSettings($referralID);

            $oSendgridStats = $this->mReferral->getAdvocateSendgridStats($subscriberID, $referralID);

            $oTrackVisit = $this->mReferral->getReferralLinkVisitsByAdvocateId($subscriberID, $referralID);
            $oTrackSale = $this->mReferral->referredSalesByAdvocateId($subscriberID, $accountID);
            $oReferredFriends = $this->mReferral->getReferredFriends($subscriberID, $referralID);
            
            
            


            $aData = array(
                'subscribersData' => $subscribersData,
                'userData' => $subscribersData,
                'contactId' => $contactId,
                'pagename' => $breadcrumb,
                'oReferral' => $oReferral,
                'oRefLink' => $oRefLink,
                'oSettings' => $oSettings,
                'oSendgridStats' => $oSendgridStats,
                'oTrackVisit' => $oTrackVisit,
                'oTrackSale' => $oTrackSale,
                'oReferredFriends' => $oReferredFriends
            );
        }

        if ($actionName == 'smart-popup') {
            $popupContent = $this->load->view('admin/components/smart-popup/advocates', $aData, true);
            $response['status'] = 'success';
            $response['content'] = $popupContent;
            echo json_encode($response);
            exit;
        } else {
            $this->template->load('admin/admin_template_new', 'admin/contacts/contact_profile', $aData);
        }
    }

}
