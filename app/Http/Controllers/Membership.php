<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\MembershipModel;
use Illuminate\Support\Facades\Input;
use Session;

class Membership extends Controller {

    /**
     * This is a membership index function
     * @param type
     */
    public function Index() {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        $Membership = new MembershipModel();
        if ($user_role == 1) {
            $aMembership = $Membership->getMembership();

            $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a class="sidebar-control hidden-xs">Manage Membership Plans</a></li>
                </ul>';

            return view('admin.membership.index', array('title' => 'Brand Boost Membership', 'pagename' => $breadcrumb, 'membership_data' => $aMembership));
        } else {
            echo "Not authorized to access this page";
        }
    }

    public function add(Request $request) {
        $response = array();
        $response['status'] = 'error';

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        if ($user_role == 1) {

            if (!empty($request)) {

                //Apply Validation

                $productType = $request->type;
                $subsCycle = $request->periodUnit;
                $name = $request->level_name;
                $invoiceName = $request->invoice_name;
                $price = $request->price;
                $credits = $request->credits;
                $contactLimit = $request->contact_limit;
                $emailLimit = $request->email_limit;
                $smsLimit = $request->sms_limit;
                $textLimit = $request->text_review_limit;
                $videoLimit = $request->video_review_limit;
                $socialInvites = $request->social_invites;
                $addYourOwn = $request->add_your_own;


                $aChargebeeData = array(
                    'id' => str_replace(' ', '-', strtolower($name)),
                    'name' => $name,
                    'invoiceName' => $invoiceName,
                    'price' => $price*100
                );

                $aData = array(
                    'level_name' => $name,
                    'invoice_name' => $invoiceName,
                    'type' => $productType,
                    'subs_cycle' => $subsCycle,
                    'price' => $price,
                    'credits' => $credits,
                    'contact_limit' => $contactLimit,
                    'email_limit' => $emailLimit,
                    'sms_limit' => $smsLimit,
                    'text_review_limit' => $textLimit,
                    'video_review_limit' => $videoLimit,
                    'social_invite_sources' => $socialInvites,
                    'custom_addons' => $addYourOwn,
                    'status' => 1,
                    'created' => date("Y-m-d H:i:s")
                );


                if ($productType == 'membership' || $productType == 'topup-membership') {
                    $aChargebeeData['period'] = 1;
                    $aChargebeeData['periodUnit'] = $subsCycle; //week, month or year;
                    $planID = $this->Membership->createChargebeePlan($aChargebeeData);

                }else if($productType == 'topup'){
                    $aChargebeeData['chargeType'] = 'non_recurring';
                    $aChargebeeData['pricingModel'] = 'per_unit';
                    $aChargebeeData['unit'] = 'credit';
                    $planID = $this->Membership->createChargebeeAddonPlan($aChargebeeData);
                }



                if (!empty($planID)) {
                    $aData['plan_id'] = $planID;
                    $result = $this->Membership->saveMembership($aData);
                    if ($result) {
                        $response['status'] = 'success';
                        $response['message'] = "Membership has been added successfully.";
                    } else {
                        $response['message'] = "Error: Something went wrong, try again";
                    }
                }

            }
        } else {
            $response['status'] = 'success';
            $response['message'] = "Not Authorize to perform this action";
        }

        echo json_encode($response);
        exit;
    }

    public function getMemberById(Request $request) {

        $response = array();
        $response['status'] = 'error';

        if (!empty($request)) {

            $aMembership = $this->Membership->getMembership($request->memID);
            if ($aMembership) {
                $response['status'] = 'success';
                $response['result'] = $aMembership;
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function mem_delete(Request $request) {

        $response = array();

        if (!empty($request)) {


            $memID = $request->memID;

            $aData = array(
                'delete_status' => 1,
            );

            $result = $this->Membership->deleteMembership($aData, $memID);
            if ($result) {
                $response['status'] = 'success';
                $response['message'] = "Membership has been deleted successfully.";
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function deleteMemberships(Request $request) {

        $response = array();

        if (!empty($request)) {


            $memIDs = $request->multipal_record_id;

            $aData = array(
                'delete_status' => 1,
            );

            foreach ($memIDs as $memID) {
                $result = $this->Membership->deleteMembership($aData, $memID);
            }

            if ($result) {
                $response['status'] = 'success';
                $response['message'] = "Membership has been deleted successfully.";
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function mem_update(Request $request) {

        $response = array();


        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $user_role = $aUser->user_role;
        if ($user_role == 1) {
            if (!empty($request)) {


                $name = $request->level_name;
                $invoiceName = $request->invoice_name;
                $price = $request->price;
                $credits = $request->credits;
                $contactLimit = $request->contact_limit;
                $emailLimit = $request->email_limit;
                $smsLimit = $request->sms_limit;
                $textLimit = $request->text_review_limit;
                $videoLimit = $request->video_review_limit;
                $socialInvites = $request->social_invites;
                $addYourOwn = $request->add_your_own;
                $mem_ID = $request->mem_ID;
                $planID = $request->plan_id;

                $aData = array(
                    'level_name' => $name,
                    'invoice_name' => $invoiceName,
                    'price' => $price,
                    'credits' => $credits,
                    'contact_limit' => $contactLimit,
                    'email_limit' => $emailLimit,
                    'sms_limit' => $smsLimit,
                    'text_review_limit' => $textLimit,
                    'video_review_limit' => $videoLimit,
                    'social_invite_sources' => $socialInvites,
                    'custom_addons' => $addYourOwn
                );

                $aChargebeeData = array(
                    'name' => $name,
                    'invoiceName' => $invoiceName,
                    'price' => $price*100
                );

                $newPlanID = $this->Membership->updateChargebeePlan($planID, $aChargebeeData);
                    if (!empty($newPlanID)) {
                        $result = $this->Membership->updateMembership($aData, $mem_ID);
                    }


                if ($result) {
                    $response['status'] = 'success';
                    $response['message'] = "Membership has been updated successfully.";
                } else {
                    $response['message'] = "Error: Something went wrong, try again";
                }
            }
        } else {
            $response['status'] = 'success';
            $response['message'] = "Not Authorize to perform this action";
        }
        echo json_encode($response);
        exit;
    }

    public function topup_update(Request $request) {

        $response = array();

        if (!empty($request)) {


            $name = $request->level_name;
            $price = $request->topup_price;
            $topupEmailLimit = $request->topup_email_limit;
            $topupSMSLimit = $request->topup_sms_limit;
            $mem_ID = $request->mem_ID;

            $aData = array(
                'level_name' => $name,
                'topup_fee' => $price,
                'topup_email_limit' => $topupEmailLimit,
                'topup_sms_limit' => $topupSMSLimit
            );

            $result = $this->Membership->updateMembership($aData, $mem_ID);
            if ($result) {
                $response['status'] = 'success';
                $response['message'] = "Membership has been updated successfully.";
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function update_status(Request $request) {

        $response = array();

        if (!empty($request)) {
            $status = $request->status;
            $membershipId = $request->membership_id;

            $aData = array(
                'status' => $status
            );

            $result = $this->Membership->updateMembership($aData, $membershipId);
            if ($result) {
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function createInfusionProduct($aData = array()) {

        $name = $aData['productName'];
        $price = $aData['productPrice'];
        $description = $aData['description'];
        $productType = $aData['productType'];
        $billingCycle = $aData['billing_cycle'];
        $product = new Infusionsoft_Product();
        $oAppProductService = new Infusionsoft_ProductService();

        $oProductCategory = new Infusionsoft_ProductCategoryAssign();
        $product->ProductName = $name;
        $product->ProductPrice = $price;
        $product->ShortDescription = $description;
        $product->Description = $description;
        $productCategory = '12';
        $isCreated = $product->save();
        if ($isCreated) {
            $infusionProductID = $product->Id;
            $oProductCategory->ProductCategoryId = $productCategory;
            $oProductCategory->ProductId = $product->Id;
            $oProductCategory->save();
            if ($productType == 'membership') {
                //Add subscription
                if ($price > 0) {
                    $subscriptionPlan = new Infusionsoft_SubscriptionPlan();
                    $subscriptionPlan->ProductId = $infusionProductID;
                    if ($billingCycle == 'weekly') {

                        $subscriptionPlan->Cycle = 3;
                    } else if ($billingCycle == 'monthly') {

                        $subscriptionPlan->Cycle = 2;
                    } else if ($billingCycle == 'yearly') {

                        $subscriptionPlan->Cycle = 1;
                    } else {
                        //By Default Monthly
                        $subscriptionPlan->Cycle = 2;
                    }

                    $subscriptionPlan->Frequency = 1;
                    $subscriptionPlan->Prorate = 0;
                    $subscriptionPlan->Active = 1;
                    $subscriptionPlan->PlanPrice = $price;
                    $isSubscriptionCreated = $subscriptionPlan->save();
                    if ($isSubscriptionCreated) {
                        $subscriptionPlanID = $subscriptionPlan->Id;
                    }
                    $response = array('status' => 'ok', 'subscription_based_product' => 'yes', 'subscription_plan_id' => $subscriptionPlanID, 'infusion_product_id' => $infusionProductID);
                }
            } else if ($productType == 'topup') {

                $response = array('status' => 'ok', 'subscription_based_product' => 'no', 'infusion_product_id' => $infusionProductID);
            }
        } else {
            $response = array('status' => 'error', 'msg' => 'product could not added into infusionsoft', 'infusion_product_id' => $infusionProductID);
        }
        return $response;
    }

}

?>
