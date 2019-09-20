<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\InvoicesModel;

class Invoice extends Controller {

	public function index($clientID) {

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Invoices" class="sidebar-control active hidden-xs ">Invoices</a></li>
                    </ul>';

        $data = array(
            'title' => 'Brand Boost Invoices',
            'pagename' => $breadcrumb,
            'usersdata' => $this->mInvoices->getInvoices($clientID)
        );

        $this->template->load('admin/admin_template_new', 'admin/invoices/index', $data);
    }

    /**
     * Get the list of Invoice
     * @return type
     */
    public function view($clientID){

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Invoices" class="sidebar-control active hidden-xs ">Invoices</a></li>
                    </ul>';

        $data = array(
            'title' => 'Brand Boost Invoices',
            'pagename' => $breadcrumb,
            'usersdata' => InvoicesModel::getInvoices($clientID)
        );

        return view('admin.invoice.index', $data);
    }

    /**
     * Get the detail of Invoice
     * @return type object
     */
    public function get(Request $request){

        $invoiceID = $request->invoice_id;
        $invoiceDetails = InvoicesModel::getInvoiceDetails($invoiceID);

        if($invoiceDetails->count() > 0){
            $content = view('admin.invoice.get', array('userdata' => $invoiceDetails, 'invoiceID' => $invoiceID))->render();
            echo json_encode(array('status' => 'success', 'content'=> $content));
        }
    }

    public function getUserById(Request $request) {

        $response = array();
        $response['status'] = 'error';

        if (!empty($request)) {

            $aUsers = $this->Users->getAllUsers($request->userID);
            if ($aUsers) {
                $response['status'] = 'success';
                $response['result'] = $aUsers;
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function user_update(Request $request) {

        $response = array();

        if (!empty($request)) {


            $firstname = $request->firstname;
            $lastname = $request->lastname;
            $phone = $request->phone;
            $zip = $request->zip;
            $userID = $request->userID;
            $twilioStatus = $request->e_twilio_status;
            $contactId = $request->e_infusion_user_id;

            $userData = $this->Users->getAllUsers($userID);
            $accountSid = $userData[0]->twilio_subaccount_sid;
            $aData = array(
                'firstname' => $firstname,
                'lastname' => $lastname,
                'mobile' => $phone,
                'zip_code' => $zip,
                    //'twilio_subaccount_status'  => $twilioStatus
            );

            /* if($accountSid != ''){
              $twilioResult = updateTwilioStatus($accountSid, $twilioStatus);
              } */
            //pre($twilioResult);

            $result = $this->Users->updateUsers($aData, $userID);
            if ($result) {
                $response['status'] = 'success';
                $response['message'] = "User has been updated successfully.";
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
            $userId = $request->user_id;

            $aData = array(
                'status' => $status
            );

            $result = $this->Users->updateUsers($aData, $userId);
            if ($result) {
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function user_delete(Request $request) {

        $response = array();

        if (!empty($request)) {


            $userID = $request->userID;
            $contactID = $request->contactID;

            $this->mInfusion->deleteContact($contactID);

            $result = $this->Users->deleteUsers($userID);
            if ($result) {
                $response['status'] = 'success';
                $response['message'] = "User has been deleted successfully.";
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function user_add(Request $request) {

        $response = array();

        if (!empty($request)) {


            $firstname = $request->firstname;
            $lastname = $request->lastname;
            $email = $request->email;
            $phone = $request->phone;
            $zip = $request->zip;

            $aInfusionData = array(
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                //'country' => $country,
                'phone' => $phone,
                'zip' => $zip
            );

            $infusionUserID = $this->mInfusion->createContact($aInfusionData);

            $aData = array(
                'infusion_user_id' => $infusionUserID,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'created' => date("Y-m-d H:i:s"),
                'user_role' => '2',
                'mobile' => $phone,
                'zip_code' => $zip,
                'status' => 1
            );

            $result = $this->Users->addUsers($aData);
            if ($result) {
                $response['status'] = 'success';
                $response['message'] = "User has been add successfully.";
            } else {
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function Sendgriddata($userID) {
        $userData = $this->Users->getUserAllData($userID);
        $sendGridData = $this->mSendgrid->getSendGridData($userData->sg_username, $userData->sg_password, date('Y-m-d', strtotime($userData->created)));
        $sendGridULD = $this->mSendgrid->getSGLoginDetails($userID);
        $this->template->load('admin/admin_template', 'admin/users/sendgrid/index', array('sendGridULD' => $sendGridULD, 'sendGridData' => $sendGridData));
    }

    public function twiliomessage($userID) {

        $getTwillioByUser = $this->mTwillio->getTwillioByUser($userID);
        $result = $getTwillioByUser[0];
        $sid = $result->account_sid;
        $token = $result->account_token;
        $contact_sid = $result->contact_sid;
        $contact_no = $result->contact_no;

        $client = new Client($sid, $token);

        $this->template->load('admin/admin_template', 'admin/users/twilio/index', array('result' => $result, 'client' => $client));
    }

    public function checkEmailExist(Request $request) {

        $response = array();

        if (!empty($request)) {


            $result = $this->Users->checkEmailExist($request->emailID);
            if ($result) {
                $response['status'] = 'success';
                $response['message'] = $result;
            } else {
                $response['status'] = 'error';
                $response['message'] = "Error: Something went wrong, try again";
            }

            echo json_encode($response);
            exit;
        }
    }

    public function createSendGridSA(Request $request) {
        $response = array();

        if (!empty($request)) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randstring = '';
            for ($i = 0; $i < 8; $i++) {
                $randstring .= $characters[rand(0, strlen($characters))];
            }
            $userID = $request->user_id;
            $username = 1000000 + $userID . '@brandboost.io';
            $ip = "168.245.71.20";
            $password = $randstring;
            createSendGridSubAccount($username, $email, $password, $ip);

            $response['status'] = 'success';
        }
        echo json_encode($response);
        exit;
    }

    public function createTwilioAccount(Request $request) {
        $response = array();

        if (!empty($request)) {
            $userID = $request->user_id;
            $username = 1000000 + $userID . '@brandboost.io';
            $userData = $this->mUser->getUserTwilioData($userID);
            if ($userData->user_id == '') {
                $twilioSubAccountData = createTwilioSA($userID, $username);
                $twilioData = json_decode($twilioSubAccountData);

                if ($twilioData->sid != '') {
                    $data = array('account_sid' => $twilioData->sid, 'account_token' => $twilioData->authToken, 'user_id' => $userID, 'account_status' => 'active', 'created' => date("Y-m-d H:i:s"));
                    $this->mUser->addUserTwilioData($data);

                    $response['status'] = 'success';
                }
            }
        }
        echo json_encode($response);
        exit;
    }


    public function download_invoice($invoiceID) {

        //load mPDF library
        $invoiceDetails = InvoicesModel::getInvoiceDetails($invoiceID);


        if($invoiceDetails->count() > 0){
        	$html = view('admin.invoice.download_invoice', array('userdata' => $invoiceDetails, 'invoiceID' => $invoiceID))->render();
        	echo $html;
        }

        die();

        //die();


        $this->load->library('m_pdf');
        $pdfFilePath ="invoice-".time()."-download.pdf";
        $pdf = $this->m_pdf->load();
        $pdf->SetDisplayMode('fullpage');
        $stylesheet = file_get_contents(base_url().'assets/css/bootstrap_new.css');
       // $stylesheet_core = file_get_contents(base_url().'assets/css/core.css');
        //$style_components = file_get_contents(base_url().'assets/css/components.css');
        //$stylesheetCustom = file_get_contents(base_url().'new_pages/assets/css/bootstrap.css');
        //$pdf->WriteHTML($stylesheetCustom,1);
        $pdf->WriteHTML($stylesheet,1);
        //$pdf->WriteHTML($stylesheet_core,1);
        //$pdf->WriteHTML($style_components,1);

        $pdf->WriteHTML($html,2);
        $pdf->Output($pdfFilePath, "D");

    }

    public function test() {

        //load mPDF library
        $invoiceID = 383;
        //$this->load->library('m_pdf');

        $invoiceDetails = $this->mInvoices->getInvoiceDetails($invoiceID);

        if(!empty($invoiceDetails)){
            //$html = $this->load->view('admin/invoices/download_invoice', array('userdata' => $invoiceDetails, 'invoiceID' => $invoiceID), true);
            $html = $this->load->view("admin/invoices/partials/invoice_content_email", array('userdata' => $invoiceDetails, 'invoiceID' => $invoiceID), true);
        }
        echo $html;




    }

    public function email_invoice(Request $request) {
        $response = array();

        if (!empty($request)) {
            $invoiceID = $request->invoice_id;
            $invoiceDetails = $this->mInvoices->getInvoiceDetails($invoiceID);
            $email = $invoiceDetails[0]->email;
            //pre($invoiceDetails);

            if(!empty($invoiceDetails)){
                //$html = $this->load->view('admin/invoices/email_invoice', array('userdata' => $invoiceDetails, 'invoiceID' => $invoiceID), true);
                //$html = $this->load->view("admin/invoices/partials/invoice_content_email", array('userdata' => $invoiceDetails, 'invoiceID' => $invoiceID), true);
                $html = $this->load->view("admin/invoices/partials/invoice_content_email_pdf", array('userdata' => $invoiceDetails, 'invoiceID' => $invoiceID), true);
                //$email = 'darwin@123789.org';
                sendEmail($email , $html, 'Brandboost Invoice');

                $response['status'] = 'success';
            }

            echo json_encode($response);
            exit;
        }
    }

}
?>
