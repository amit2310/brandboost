<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Modules\NpsModel;
use Cookie;
use Session;

class Survey extends Controller {
	

	public function index($hashcode='')
	{

		if (!empty($hashcode)) {
			$oNPS = NpsModel::getSurveyInfoByRef($hashcode);
			$widgetData = array(
				'accountID' => $hashcode,
				'oNPS' => $oNPS,
				'sub_id' => $_GET['subid']
			);
			
			return view("admin.modules.nps.widgets.link_nps", $widgetData);
        }
	}
}
