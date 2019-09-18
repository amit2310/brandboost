<?php

namespace App\Http\Controllers;

use App\Models\Admin\TrackingModel;
use Illuminate\Http\Request;


class R extends Controller
{
    /**
     * Get params from the short url and redirect request to the actual url
     * @param $brandboostID
     * @param $websiteID
     */
    public function index(Request $request) {
        //Instantiate Tracking Model to get its properties and methods
        $brandboostID = $request->brandboostid;
        $websiteID = $request->websiteid;
        $mTracking = new TrackingModel();
        $result = $mTracking->getShortURLByBBID($brandboostID);
        $urlData = @unserialize($result[0]->offsites_links);
        //pre($urlData); exit;
        //$this->load->helper('url');
        redirect($urlData[$websiteID]['longurl']);
        exit;
    }
}
