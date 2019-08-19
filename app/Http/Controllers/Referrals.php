<?php
/*header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
defined('BASEPATH') OR exit('No direct script access allowed');*/

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\Admin\UsersModel;
use App\Models\Admin\Modules\ReferralModel;
use App\Models\Admin\SubscriberModel;
use Session;

class Referrals extends Controller {

    public function registerReferral(Request $request) {
		$mSubscriber = new SubscriberModel();
		$mReferral = new ReferralModel();
		
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        
		$accountID = $request->bbaid;
		$fullName = $request->bbadvname;
		$aName = explode(' ', $fullName, 2);
		if(count($aName) > 1){
			$firstName = $aName[0];
			$lastName = $aName[1];
		}else{
			$firstName = $aName[0];
			$lastName = '';
		}
		$email = $request->bbadvemail;
		$affiliateID = $request->affid;
		$publicIP = $request->ip();

		if (!empty($accountID)) {
			$oReferral = $mReferral->getReferralProgramInfo($accountID);
			$referralID = $oReferral->id;
		}

		if (!empty($oReferral)) {
			$userID = $oReferral->user_id;
		}

		//Now lookout the referrer cookie if found
		$oLiveTrackDate = $mReferral->getLiveReferralLinkTrackData($publicIP);

		if (!empty($oLiveTrackDate)) {
			$referrerKey = $oLiveTrackDate->refkey;
		}
		//echo "Referrer Key is " . $referrerKey;
		//die;
		if (!empty($referrerKey)) {
			//Release live track data now
			$mReferral->deleteLiveReferralLinkTrackData($publicIP);
			//Get Referrer Info
			$oReferrer = $mReferral->getRefLinkInfo($referrerKey);
			if (!empty($oReferrer)) {
				$advocateID = $oReferrer->subscriber_id;
				$affiliateReferralID = $oReferrer->referral_id;
				if ($advocateID > 0) {
					$affiliateID = $advocateID;
				}
			}
		}


		if (!empty($userID)) {
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
					'created' => date("Y-m-d H:i:s")
				);
				$iSubscriberID = $mSubscriber->addGlobalSubscriber($aSubscriberData);
			}
		}



		if (!empty($iSubscriberID)) {
			$oExistingUser = $mReferral->checkIfExistingAdvocate($iSubscriberID, $accountID);
			if (!empty($oExistingUser)) {
				$existingUserID = $oExistingUser->id;
				$refLink = base_url() . 'ref/t/' . $oExistingUser->refkey;
				$response = array('status' => 'success', 'reflink' => $refLink, 'msg' => "Success");
			} else {
				//Ok we are good now, go ahead and register a new user
				$aData = array(
					'subscriber_id' => $iSubscriberID,
					'user_id' => $userID,
					'account_id' => $accountID,
					'affiliateid' => $affiliateID,
					'created' => date("Y-m-d H:i:s")
				);

				$referredUserID = $mReferral->addReferredUser($aData);

				$notificationData = array(
					'event_type' => 'new_referral_registration',
					'event_id' => 0,
					'link' => base_url() . 'admin/modules/referral/setup/' . $oReferral->id,
					'message' => 'Got new referral registration',
					'user_id' => $oReferral->user_id,
					'status' => 1,
					'created' => date("Y-m-d H:i:s")
				);
				$eventName = 'sys_referral_add';
				add_notifications($notificationData, $eventName, $oReferral->user_id);

				if (!empty($referredUserID)) {
					//Generate Referral Link
					$oSettings = $mReferral->getReferralSettings($accountID, $hash = true);
					$storeID = $oSettings->rewardID;
					if ($storeID > 0) {
						$timeNow = time();
						$refKey = $iSubscriberID . '-' . $timeNow;
						$aRefData = array(
							'referral_id' => $storeID,
							'advocate_id' => $referredUserID,
							'subscriber_id' => $iSubscriberID,
							'refkey' => $refKey,
							'created' => date("Y-m-d H:i:s")
						);
						$bAdded = $mReferral->createReferralLink($aRefData);
						if ($bAdded) {
							$refLink = base_url() . 'ref/t/' . $refKey;
							$response = array('status' => 'success', 'reflink' => $refLink, 'msg' => "Success");
						}
					}
				}
			}
		}

		if (!empty($affiliateID)) {
			//Add Affiliate Record into the advocate account
			$affData = array(
				'advocate_id' => $iSubscriberID,
				'advocate_referral_id' => $referralID,
				'affiliate_id' => $affiliateID,
				'affiliate_referral_id' => $affiliateReferralID,
				'created' => date("Y-m-d H:i:s")
			);
			$mReferral->addAdvoateAffiliate($affData);
		}
        echo json_encode($response);
        exit;
    }


    public function recordSale(Request $request) {
		$mSubscriber = new SubscriberModel();
		$mReferral = new ReferralModel();
        $referrerKey = Session::get('bbtrkreferrer');
        $publicIP = $_SERVER['REMOTE_ADDR'];
        $response = array('status' => 'error', 'msg' => 'Something went wrong');

		$timeNow = time();
		$accountID = $request->bb_accountid;
		$firstName = $request->bb_firstname;
		$lastName = $request->bb_lastname;
		$email = $request->bb_email;
		$amount = $request->bb_amount;
		$currency = $request->bb_currency;
		$invoiceID = $request->bb_invoiceid;
		$created = $request->bb_timestamp;
		$showWidget = $request->show_widget;
		$affliateID = '';
		$affiliateID = '';

		if (!empty($accountID)) {
			$oReferral = $mReferral->getReferralProgramInfo($accountID);
			$referralID = $oReferral->id;
		}

		if (!empty($oReferral)) {
			$userID = $oReferral->user_id;
		}

		//Now lookout the referrer cookie if found
		$oLiveTrackDate = $mReferral->getLiveReferralLinkTrackData($publicIP);

		if (!empty($oLiveTrackDate)) {
			$referrerKey = $oLiveTrackDate->refkey;
		}
		
		if (!empty($referrerKey)) {
			//Release live track data now
			$mReferral->deleteLiveReferralLinkTrackData($publicIP);
			//Get Referrer Info
			$oReferrer = $mReferral->getRefLinkInfo($referrerKey);
			if (!empty($oReferrer)) {
				$advocateID = $oReferrer->subscriber_id;
				$affiliateReferralID = $oReferrer->referral_id;
				if ($advocateID > 0) {
					$affliateID = $advocateID;
				}
			}
		}

		$aSaleData = array(
			'account_id' => $accountID,
			'affiliateid' => $affliateID,
			'firstname' => $firstName,
			'lastname' => $lastName,
			'email' => $email,
			'invoice_id' => $invoiceID,
			'amount' => $amount,
			'currency' => $currency,
			'purchase_date' => date("y-m-d H:i:s", $created),
			'created' => date("Y-m-d H:i:s")
		);

		if (!empty($userID)) {
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
					'created' => date("Y-m-d H:i:s")
				);
				$iSubscriberID = $mSubscriber->addGlobalSubscriber($aSubscriberData);
			}

			if (!empty($iSubscriberID)) {
				$oExistingUser = $mReferral->checkIfExistingAdvocate($iSubscriberID, $accountID);
				
				if (!empty($oExistingUser)) {
					$existingUserID = $oExistingUser->id;
					$refKey = $oExistingUser->refkey;
					if (empty($refKey)) {
						//Add missing Referral link
						$refKey = $iSubscriberID . '-' . $timeNow;
						$aRData = array(
							'referral_id' => $referralID,
							'advocate_id' => '',
							'subscriber_id' => $iSubscriberID,
							'refkey' => $refKey,
							'created' => date("Y-m-d H:i:s")
						);
						$mReferral->createReferralLink($aRData);
					}
					//Mark Sale to this refkey
					$aSaleData['refkey'] = $refKey;
					$aSaleData['advocate_id'] = $iSubscriberID;
					$refLink = base_url() . 'ref/t/' . $refKey;
				} else {
					//Ok we are good now, go ahead and register a new user
					//echo "I am here";

					$aData = array(
						'subscriber_id' => $iSubscriberID,
						'user_id' => $userID,
						'account_id' => $accountID,
						'affiliateid' => $affiliateID,
						'created' => date("Y-m-d H:i:s")
					);

					$referredUserID = $mReferral->addReferredUser($aData);

					if (!empty($referredUserID)) {
						//Generate Referral Link
						$oSettings = $mReferral->getReferralSettings($accountID, $hash = true);
						$storeID = $oSettings->rewardID;
						if ($storeID > 0) {
							$refKey = $iSubscriberID . '-' . $timeNow;
							$aRefData = array(
								'referral_id' => $storeID,
								'advocate_id' => $referredUserID,
								'subscriber_id' => $iSubscriberID,
								'refkey' => $refKey,
								'created' => date("Y-m-d H:i:s")
							);
							$bAdded = $mReferral->createReferralLink($aRefData);
							if ($bAdded) {
								$aSaleData['refkey'] = $refKey;
								$refLink = base_url() . 'ref/t/' . $refKey;
								$aSaleData['advocate_id'] = $iSubscriberID;
							}
						}
					}
				}
			}
		}

		if ($showWidget) {
			//Get Widget
			$aTagLineData = $this->getReferralTagLines($accountID);
			$widgetData = array(
				'accountID' => $accountID,
				'tagTitle' => $aTagLineData['tagTitle'],
				'tagLineDesc' => $aTagLineData['tagLineDesc'],
				'refLink' => $refLink
			);
			
			$content = view('admin.modules.referral.widgets.post_purchase', $widgetData)->render();
		}

		if (!empty($refKey)) {
			//Save Sale related data
			$bSavedSale = $mReferral->saveReferralSale($aSaleData);
			if ($bSavedSale) {
				$response = array('status' => 'success', 'display_widget' => true, 'content' => utf8_encode($content), 'reflink' => $refLink, 'msg' => "Success");
			}
		}

		if (!empty($affiliateID)) {
			//Add Affiliate Record into the advocate account
			$affData = array(
				'advocate_id' => $iSubscriberID,
				'advocate_referral_id' => $referralID,
				'affiliate_id' => $affiliateID,
				'affiliate_referral_id' => $affiliateReferralID,
				'created' => date("Y-m-d H:i:s")
			);
			$mReferral->addAdvoateAffiliate($affData);
		}
        
        echo json_encode($response);
        exit;
    }

    public function displayWidget($widgetName, $accountID) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        if (!empty($accountID) && !empty($widgetName)) {
            if ($widgetName == 'referral') {
                $aTagLineData = $this->getReferralTagLines($accountID);
                $widgetData = array(
                    'accountID' => $accountID,
                    'tagTitle' => $aTagLineData['tagTitle'],
                    'tagLineDesc' => $aTagLineData['tagLineDesc']
                );
				$content = view('admin.modules.referral.widgets.referral', $widgetData)->render();
            }
            $aData = array('content' => utf8_encode($content));
            echo json_encode($aData);
            exit;
        }
    }

    public function display_embed_widget($widgetName, $accountID) {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        if (!empty($accountID) && !empty($widgetName)) {
            if ($widgetName == 'referral-embed') {
                $aTagLineData = $this->getReferralTagLines($accountID);
                $widgetData = array(
                    'accountID' => $accountID,
                    'tagTitle' => $aTagLineData['tagTitle'],
                    'tagLineDesc' => $aTagLineData['tagLineDesc']
                );
                $content = view('admin.modules.referral.widgets.embed_joining', $widgetData)->render();
            }
            $aData = array('content' => utf8_encode($content));
            echo json_encode($aData);
            exit;
        }
    }

    public function getReferralTagLines($accountID) {
		$mReferral = new ReferralModel();
        $oRewardSettings = $mReferral->getReferralSettings($accountID, $hash = true);
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

}
