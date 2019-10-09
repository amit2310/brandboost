<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\TagsModel;

class HelperUtility extends Controller
{
    /**
     * This function is used to get the list of all tags associated with a subscriber
     * @param Request $request
     */
    public function getSubscriberTags(Request $request){
        $subscriberID = $request->subscriber_id;
        $oTags = TagsModel::getSubscriberTags($subscriberID);
        $iTagCount = 0;
        if(!empty($oTags)){
            $iTagCount = count($oTags);
        }

        echo json_encode(['oTags'=> $oTags, 'tagCount'=> $iTagCount]);
        exit;
    }
}
