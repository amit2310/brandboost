<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class OffsiteModel extends Model {
	
	/**
	* Used to get offsite data
	* @param type $campaignID
	* @return type
	*/
	public static function getOffsite($id = '') {

        $aUser = getLoggedUser();
        $userID = $aUser->id; 

		$oData = DB::table('tbl_offsite_websites')
			->when((!empty($id)), function ($query) use ($id) {
				return $query->where('id', $id);
			}, function ($query) use ($userID){
				return $query->where('user_id', 1)
				->orWhere('user_id', $userID);
			}) 
			->orderBy('id', 'asc')
			->get();
		return $oData;
    }
	
	public static function getOffsiteById($id) {

		$oData = DB::table('tbl_offsite_websites')
				->where('id', $id)
				->orderBy('id', 'asc')
				->get();
		return $oData;
    }
	
	public function offsite_count_all_edit($search, $selected_list) {

        $response = array();
        $selectedListArr = explode(",", $selected_list);
        $this->db->order_by('id', 'DESC');
        $where = "(`name` LIKE '%" . $search . "%' OR ";
        $where .= "`website_url` LIKE '%" . $search . "%' OR";
        $where .= "`description` LIKE '%" . $search . "%')";
        $this->db->where($where);
        $this->db->where_not_in('id', $selectedListArr);
        $this->db->from('tbl_offsite_websites');
        $result = $this->db->get();
        return $result->num_rows();
    }
	
    public function getAllOffsite($id = '') {

        $response = array();
        if ($id > 0) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id', 'DESC');
        }

        $this->db->from('tbl_offsite_websites');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $response = $result->result();
        }
        return $response;
    }

    public function addOffsite($aData) {
        $result = $this->db->insert('tbl_offsite_websites', $aData);
        $inset_id = $this->db->insert_id();
        //echo $this->db->last_query();exit;
        if ($result)
            return $inset_id;
        else
            return false;
    }
    
    public function DelCustomSource($aData) {
        
        $aUser = getLoggedUser();
        $userID = $aUser->id; 
        $where = '(id="'.$aData['CustomSourceID'].'" AND user_id = "'.$aData['user_id'].'")';
        $this->db->where($where);
        $result = $this->db->delete('tbl_offsite_websites');
         //echo $this->db->last_query();exit;
        return true;
    }
    

    

    public function updateOffsite($aData, $offsiteId) {

        $this->db->where('id', $offsiteId);
        $result = $this->db->update('tbl_offsite_websites', $aData);
        if ($result)
            return true;
        else
            return false;
    }

    public function deleteOffsite($offsiteId) {
        $this->db->where('id', $offsiteId);
        $result = $this->db->delete('tbl_offsite_websites');
        return true;
    }

    public function offsite_count_all($search) {

        $response = array();

        $this->db->order_by('id', 'DESC');
        $this->db->like('name', $search);
        $this->db->or_like('website_url', $search);
        $this->db->or_like('description', $search);
        $this->db->from('tbl_offsite_websites');
        $result = $this->db->get();
        return $result->num_rows();
    }

    function offsite_fetch_details($limit, $start, $sortBy, $sortType, $search) {
        $sortBy = $sortBy == '' ? 'id' : $sortBy;
        $sortType = $sortType == '' ? 'ASC' : $sortType;
        $output = '';
        $this->db->like('name', $search);
        $this->db->or_like('website_url', $search);
        $this->db->or_like('description', $search);
        $this->db->from("tbl_offsite_websites");
        $this->db->order_by($sortBy, $sortType);
        $this->db->limit($limit, $start);
        $result = $this->db->get();
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $offsetdata = $result->result();
        }

        if (count($offsetdata) > 0) {
            $inc = 1;
            foreach ($offsetdata as $data) {
                //pre($data);
                $output .= '<li class="media panel-body stack-media-on-mobile">
                    <div class="media-left">
                        <a href="#">
                            <img src="/uploads/' . $data->image . '" height="44" width="44" class="img-rounded img-lg" alt="">
                        </a>
                    </div>

                    <div class="media-body">
                        <h6 class="media-heading text-semibold">
                            <a href="#">' . $data->name . '</a>
                        </h6>

                        <ul class="list-inline list-inline-separate text-muted mb-10">
                            <li><a href="#" class="text-muted">' . $data->website_url . '</a></li>
                        </ul>';
                $output .= $data->description;
                $output .= '</div>

                    <div class="media-right text-nowrap" style="padding-left: 0px !important; padding-right: 18px;">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="javascript:void(0);" class="offsiteEdit" offsiteid="' . $data->id . '"><i class="icon-gear"></i> Edit</a></li>

                                    <li><a href="javascript:void(0);" class="offsiteDelete" offsiteid="' . $data->id . '"><i class="icon-trash"></i> Delete</a></li>

                                </ul>
                            </li>
                        </ul>
                        
                        
                        
                    </div>
                </li>';
                $inc++;
            }
        } else {
            $output .= '<li style="text-align:center;">No any data found.</li>';
        }
        return $output;
    }

    function offsite_step_fetch_details($limit, $start, $sortBy, $sortType, $search, $selected_list) {

        $sortBy = $sortBy == '' ? 'id' : $sortBy;
        $sortType = $sortType == '' ? 'ASC' : $sortType;
        $selectedListArr = explode(",", $selected_list);
        $brandboostID = $this->session->userdata('brandboostID');
        $this->db->where('id', $brandboostID);
        $this->db->where('delete_status', 0);
        $result = $this->db->get('tbl_brandboost');
        if ($result->num_rows() > 0) {
            $aData = $result->result();
        }
        $aBrandboosts = $aData[0];

        $offsite_ids = $aBrandboosts->offsite_ids;
        $offsite_ids = unserialize($offsite_ids);


        $output = '';

        $this->db->like('name', $search);
        $this->db->or_like('website_url', $search);
        $this->db->or_like('description', $search);
        $this->db->from("tbl_offsite_websites");
        $this->db->order_by($sortBy, $sortType);
        $this->db->limit($limit, $start);
        $result = $this->db->get();
        //echo $this->db->last_query();
        if ($result->num_rows() > 0) {
            $offsetdata = $result->result();
        }

        if (count($offsetdata) > 0) {
            $inc = 1;
            foreach ($offsetdata as $value) {
                //pre($data);

                if (in_array($value->id, $offsite_ids)) {
                    $selected = 'selected';
                    $offsiteselected = '1';
                    $alert = 'btn-success';
                } else if (in_array($value->id, $selectedListArr)) {
                    $selected = 'selected';
                    $offsiteselected = '1';
                    $alert = 'btn-success';
                } else {
                    $selected = '';
                    $offsiteselected = '0';
                    $alert = 'bg-blue';
                }

                $output .= '<li class="media panel-body stack-media-on-mobile ' . $selected . '" offsetId="' . $value->id . '" id="review_steps' . $value->id . '">
                        <div class="media-left">
                            <a href="#">
                                <img src="/uploads/' . $value->image . '" class="img-rounded img-lg" alt="">
                            </a>
                        </div>
                        
                        <div class="media-body">
                            <h6 class="media-heading text-semibold">
                                <a href="' . $value->website_url . '">' . $value->name . '</a>
                            </h6>';

                $output .= '<ul class="list-inline list-inline-separate text-muted mb-10">
                                <li><a href="' . $value->website_url . '" class="text-muted">' . $value->website_url . '</a>
                                </li>
                            </ul>';
                $output .= $value->description;
                $output .= '</div>
                        
                        <div class="media-right pt-20 text-nowrap">
                            <button type="submit" class="btn btn-block offsite_selected_popup ' . $alert . '" offsiteSelected="' . $offsiteselected . '" offsiteId="' . $value->id . '">
                                <i class="icon-plus2 text-size-base position-left"></i>
                                Select
                            </button>
                            
                        </div>
                    </li>';
            }
        } else {
            $output .= '<li style="text-align:center;">No any data found.</li>';
        }
        return $output;
    }

    function offsite_step_fetch_details_edit($limit, $start, $sortBy, $sortType, $search, $selected_list, $selected_list_new) {

        $sortBy = $sortBy == '' ? 'id' : $sortBy;
        $sortType = $sortType == '' ? 'ASC' : $sortType;
        $selectedListArr = explode(",", $selected_list);
        $selectedListNewArr = explode(",", $selected_list_new);
        $brandboostID = $this->session->userdata('brandboostID');
        $this->db->where('id', $brandboostID);
        $this->db->where('delete_status', 0);
        $result = $this->db->get('tbl_brandboost');
        if ($result->num_rows() > 0) {
            $aData = $result->result();
        }
        $aBrandboosts = $aData[0];

        $offsite_ids = $aBrandboosts->offsite_ids;
        $offsite_ids = unserialize($offsite_ids);


        $output = '';

        $where = "(`name` LIKE '%" . $search . "%' OR ";
        $where .= "`website_url` LIKE '%" . $search . "%' OR";
        $where .= "`description` LIKE '%" . $search . "%')";
        $this->db->where($where);
        $this->db->where_not_in('id', $selectedListArr);
        $this->db->from("tbl_offsite_websites");
        $this->db->order_by($sortBy, $sortType);
        $this->db->limit($limit, $start);


        $result = $this->db->get();
        $this->db->last_query();

        if ($result->num_rows() > 0) {
            $offsetdata = $result->result();
        }

        if (count($offsetdata) > 0) {
            $inc = 1;
            foreach ($offsetdata as $value) {
                //pre($data);

                if (in_array($value->id, $offsite_ids)) {
                    $selected = 'selected';
                    $offsiteselected = '1';
                    $alert = 'red_cust_btn';
                    $textButton = '<i class="icon-minus2 text-size-base"></i> ';
                } else if (in_array($value->id, $selectedListNewArr)) {
                    $selected = 'selected';
                    $offsiteselected = '1';
                    $alert = 'red_cust_btn';
                    $textButton = '<i class="icon-minus2 text-size-base"></i> ';
                } else {
                    $selected = '';
                    $offsiteselected = '0';
                    $alert = 'bl_cust_btn';
                    $textButton = '<i class="icon-plus2 text-size-base"></i>';
                }

                $output .= '<li style="padding: 20px !important;" class="media panel-body stack-media-on-mobile ' . $selected . '" offsetId="' . $value->id . '" id="review_steps' . $value->id . '">
                        <div class="media-left">
                            <a href="#">
                                <img src="/uploads/' . $value->image . '" class="img-rounded img-lg" alt="">
                            </a>
                        </div>
                        
                        <div class="media-body">
                            <h6 class="media-heading text-semibold">
                                <a href="' . $value->website_url . '">' . $value->name . '</a>
                            </h6>';

                $output .= '<ul class="list-inline list-inline-separate text-muted">
                                <li><a href="' . $value->website_url . '" class="text-muted">' . $value->website_url . '</a>
                                </li>
                            </ul>';

                $output .= '</div>
                        
                        <div class="media-right text-nowrap">
                            <button type="submit" class="btn mt-5 offsite_selected_popup ' . $alert . '" offsiteSelected="' . $offsiteselected . '" offsiteId="' . $value->id . '">';
                $output .= $textButton;
                $output .= ' </button>
                            
                        </div>
                    </li>';
            }
        } else {
            $output .= '<li style="text-align:center;">Record not found.</li>';
        }
        return $output;
    }

}

?>