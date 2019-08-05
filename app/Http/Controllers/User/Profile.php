<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Reviews_model", "mReviews");
    }

    public function index() {

    	$aUInfo = getLoggedUser();
        $userID = $aUInfo->id;
        $oReviews = $this->mReviews->getUserReviews($userID);

        $aData = array(
        	'aUInfo' => $aUInfo,
        	'oReviews' => $oReviews
        );

    	$this->template->load('user/user_template', 'user/profile', $aData);
    }

}
?>