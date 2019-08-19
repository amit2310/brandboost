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

class Ref extends Controller {

    public function t($refKey) {
		$mReferral = new ReferralModel();
        if (!empty($refKey)) {
            $oStore = $mReferral->getRefLinkInfo($refKey);
            if (!empty($oStore)) {
                $storeURL = $oStore->store_url;
                //Track visit
                $aLocationData = getLocationData();
                $publicIP = $_SERVER['REMOTE_ADDR'];
                $aTrackData = array(
                    'refkey' => $refKey,
                    'ip_address' => $aLocationData['ip_address'],
                    'platform' => $aLocationData['platform'],
                    'platform_device' => $aLocationData['platform_device'],
                    'browser' => $aLocationData['name'],
                    'useragent' => $aLocationData['userAgent'],
                    'country' => $aLocationData['country'],
                    'countryCode' => $aLocationData['countryCode'],
                    'region' => $aLocationData['region'],
                    'city' => $aLocationData['city'],
                    'longitude' => $aLocationData['longitude'],
                    'latitude' => $aLocationData['latitude'],
                    'created_at' => date("Y-m-d H:i:s")
                );
                $bSaved = $mReferral->trackReferralVisit($aTrackData);
                $aTrackData['ip_address'] = $publicIP;
                //Live Tracking
                $bTracked = $mReferral->trackLiveRefLink($aTrackData);

                if ($bSaved) {
                    //Parse Correct URL
                    $finalURL = $storeURL;
                    $parsedURL = parse_url($storeURL);
                    if (empty($parsedURL['scheme'])) {
                        $finalURL = 'http://' . ltrim($storeURL, '/');
                    }
                    header("Location: $finalURL");
                    exit;
                }
            }
        }
    }

}
