<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\SubscriptionsModel;
use Cookie;
use Session;
use DB;

class Subscriptions extends Controller {


   public function __construct() {
        $this->default_plan_id = array('small-businesses', 'medium-businesses', 'big-businesses');
    }


/**
* controller index call
* @param type
* @return type
*/

    public function index() {

      $mSubscription  = new SubscriptionsModel();
        if ($this->default_plan_id) {
            foreach ($this->default_plan_id AS $planID) {
                $aStats = $mSubscription->getPlanBasicStats($planID);
                $aRectifiedStats = array();
                foreach($aStats AS $aStat){
                    $aRectifiedStats[$aStat->subscription_status] =  $aStat->total_count;
                }
                
                if(isset($aRectifiedStats['active'])) { $active= $aRectifiedStats['active']; } else {  $active="";  }
                 if(isset($aRectifiedStats['paused'])) { $paused = $aRectifiedStats['paused']; } else {  $paused="";  }
                  if(isset($aRectifiedStats['cancelled'])) { $cancelled = $aRectifiedStats['cancelled']; } else {  $cancelled="";  }

                   if(isset($aRectifiedStats['in_trial'])) { $in_trial = $aRectifiedStats['in_trial']; } else {  $in_trial="";  }

                $aBasicStats[$planID] = array(
                    'Active' => $active,
                    'Paused' => $paused,
                    'Cancelled' => $cancelled,
                    'Trial' => $in_trial
                );
                
            }
        }

       
                $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                <li><a style="cursor:text;" class="sidebar-control hidden-xs">Dashboard</a></li>
                <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                <li><a data-toggle="tooltip" data-placement="bottom" title="Overview" class="sidebar-control active hidden-xs ">Subscriptions</a></li>
                </ul>';



        $data = array(
            'title' => 'Brand Boost Subscriptions',
            'pagename' => $breadcrumb,
            'usersdata' => $mSubscription->getSubscriptions(),
            'stats' => $aBasicStats
        );

        return view('admin.subscription.index', $data);
    }

}

?>