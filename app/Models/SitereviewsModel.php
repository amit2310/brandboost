<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class SitereviewsModel extends Model {

    public function deleteSiteReviewByID($reviewID) {
        $this->db->where('id', $reviewID);
        $result = $this->db->delete('tbl_reviews_site');
        return true;
    }

    public function getSiteReviewByReviewID($reviewid) {
		$oData = DB::table('tbl_reviews_site')
			->where('id', $reviewid)
			->get();

        return $oData;
    }

    public function updateSiteReview($aData, $reviewID) {

        $this->db->where('id', $reviewID);
        $result = $this->db->update('tbl_reviews_site', $aData);
        if ($result)
            return true;
        else
            return false;
    }

    public static function getCampSiteReviews($campaignID) {
		$oData = DB::table('tbl_reviews_site')
			->where('campaign_id', $campaignID)
			->orderBy('id', 'desc')
			->get();

        return $oData;
    }
	
	public static function getCampSiteReviewsRA($campaignID) {
		$oData = DB::table('tbl_reviews_site')
			->where('campaign_id', $campaignID)
			->orderBy('id', 'desc')
			->get();

        return $oData;
    }

    public function getCampSiteReviewsCount($campaignID) {
		$oData = DB::table('tbl_reviews_site')
			->where('campaign_id', $campaignID)
			->orderBy('id', 'desc')
			->get();

        return $oData->count();
		
    }
}
