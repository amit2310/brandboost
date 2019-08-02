<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\LiveModel;

class Live extends Controller {

	/**
     * Get the list of Live Data
     * @return type
     */
    public function index() {

		$breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
			<li><a data-toggle="tooltip" data-placement="bottom" title="Live" class="sidebar-control active hidden-xs ">Live</a></li>
			</ul>';
			
        $aUser = getLoggedUser();
        $clientID = $aUser->id;
        $oLiveData = LiveModel::getLiveData($clientID);
        return view('admin.live.index', array('title' => 'Live', 'pagename' => $breadcrumb, 'oLiveData' => $oLiveData));
    }

    public function overview() {
    	$breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
			<li><a data-toggle="tooltip" data-placement="bottom" title="Live Overview" class="sidebar-control active hidden-xs ">Live Overview</a></li>
			</ul>';

		$aUser = getLoggedUser();
        $clientID = $aUser->id;
        $oLiveData = $this->mLive->getLiveData($clientID);
        $oCurrentLiveData = $this->mLive->getCurrentLiveData($clientID);

		$this->template->load('admin/admin_template_new', 'admin/live/overview', array('title' => 'Live Details', 'pagename' => $breadcrumb, 'oLiveData' => $oLiveData, 'oCurrentLiveData' => $oCurrentLiveData));
    }
	
	/**
     * Live detail page
     * @return type
     */
	public function details($id) {

		$mLive = new LiveModel();
		$breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
			<li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
			<li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
			<li><a data-toggle="tooltip" data-placement="bottom" title="Live" class="sidebar-control active hidden-xs ">Live Details</a></li>
			</ul>';
			
        $aUser = getLoggedUser();
        $clientID = $aUser->id;
		$oData = $mLive->getLiveDataById($id);
        $oLiveData = $mLive->getLiveDataDetails($clientID, $oData->source_client_id, $oData->ip_address);
        return view('admin.live.details', array('title' => 'Live Details', 'pagename' => $breadcrumb, 'oLiveData' => $oLiveData));
    }
}

?>