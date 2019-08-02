<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class TeamModel extends Model {

    /**
     * Used to get Team member info
     * @param type $memberID
     * @param type $userID
     * @return type
     */
    public static function getTeamMember($memberID, $userID) {
        $oTeamUser = DB::table('tbl_users_team')
                ->where('id', $memberID)
                ->where('parent_user_id', $userID)
                ->first();

        return $oTeamUser;
    }

    /**
     * Checks for member chat permission
     * @param type $MemberID
     * @return type
     */
    public static function Chatpermission($MemberID) {
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $aData = DB::table('tbl_users_team')
                ->where('id', $MemberID)
                ->where('parent_user_id', $userID)
                ->first();
        return $aData;
    }
    
    /**
     * 
     * @param type $tableName
     * @param type $aData
     * @return boolean
     */
    public static function saveActivityLog($tableName, $aData) {
        $result = DB::table($tableName)->insert($aData);
        if ($result) {
            return true;
        } else {
            return true;
        }
    }


 /**
* This function will return Twilio related account details based on the client/user id
* @param type $clientID
* @return type
*/
    public static function getTwilioAccountInfo($clientID) {
        $oData = DB::table('tbl_twilio_accounts')
        ->where('user_id', $clientID)
        ->where("status", 1)->first();
        return $oData;
    }


    /**
     * This function is use for get the team members 
     * @param type $userID
     * @return object
     */
    public function getTeamMembers($userID = '') {
        $oData = DB::table('tbl_users_team')
            ->select("tbl_users_team.*", "tbl_team_role.id AS roleID", "tbl_team_role.role_name")
            ->join('tbl_team_role', 'tbl_users_team.team_role_id', '=' , 'tbl_team_role.id')
            ->when(($userID > 0), function ($query) use ($userID) {
                    return $query->where('tbl_users_team.parent_user_id', $userID);
                })
            ->orderBy('tbl_users_team.id', 'desc')
            ->get();

        return $oData;
    }

   
    /**
    * This function will check role is already exists or not
    * @param type $clientID
    * @return type
    */

    public function checkIfUserRoleExists($roleName, $userID) {
        $oData = DB::table('tbl_team_role')
         ->where("user_id", $userID)
        ->where("role_name", $roleName)->get();
        if ($oData->count() > 0) {
            return true;
        } else {
            return false;
        }
    }


     /**
    * This function will add the team member
    * @param type 
    * @return type
    */

    public function addTeamMember($aData) {
        $aDataRes =  DB::table('tbl_users_team')
        ->where("email", $aData['email'])->get();
        if ($aDataRes->count() > 0) {
            return 'email';
        } else {
           $insert_id = DB::table('tbl_users_team')->insertGetId($aData);
            if ($insert_id>0) {
                return $insert_id;
            } else {
                return false;
            }
        }
    }

     /**
    * This function is used to add the new role 
    * @param type $clientID
    * @return type
    */

    public function addTeamRole($aData) {
        $oData = DB::table('tbl_team_role')->insertGetId($aData);
        if ($oData>0) {
            return $oData;
        } else {
            return false;
        }
    }


    /**
    * This function is use to update the role for team member
    * @param type $clientID
    * @return type
    */


    public function updateTeamRole($aData, $roleID, $userID) {
        $oData = DB::table('tbl_team_role')
         ->where("id", $roleID)
          ->where("user_id", $userID)
         ->update($aData);
       return true;
    }

    /**
    * This function is use to delete the role for team member
    * @param type $clientID
    * @return type
    */

    public function deleteRole($roleID, $userID) {
       $oData =  DB::table('tbl_team_role')
        ->where("id", $roleID)
        ->where("user_id", $userID)->delete();
        return true;
    }


    /**
    * This function will return existing role assing to team member
    * @param type $userID
    * @param type $id
    * @return type
    */

    public function getRole($id, $userID) {
        $oData = DB::table('tbl_team_role')
        ->where("id", $id)
        ->where("user_id", $userID)->first();
        
        return $oData;
    }


    /**
    * This function will update the data for team members
    * @param type $clientID
    * @return type
    */

    public function updateTeamMember($aData, $memberID, $userID) {
        $aData =  DB::table('tbl_users_team')
        ->where('id', $memberID)
        ->where('parent_user_id', $userID)->update($aData);
         return true;
       
    }


    /**
    * This function will delete the team members
    * @param type $clientID
    * @return type
    */

    public function deleteTeamMember($memberID, $userID) {
        $aData =  DB::table('tbl_users_team')
        ->where('id', $memberID)
        ->where('parent_user_id', $userID)->delete();
        return true;
    }

    /**
    * Get All team member
    * @param type $clientID
    * @return type
    */
    public static function getAllteamMembers($userID) {
        
        $oData = DB::table('tbl_users_team')
            ->where('parent_user_id', $userID)
            ->get();
        return $oData;
    }

    public function updateTeamUsers($aData, $teamUserId, $curruserID) {

        $this->db->where('id', $teamUserId);
        $this->db->where('parent_user_id', $curruserID);
        $result = $this->db->update('tbl_users_team', $aData);
        //echo $this->db->last_query();exit;
        if ($result)
            return true;
        else
            return false;
    }

    public function addRolePermission($aData) {
        $yesAddedOne = false;
        if (!empty($aData)) {
            $roleID = $aData['role_id'];
            $aPermissionID = $aData['permission_array'];
            if (!empty($aPermissionID)) {
                foreach ($aPermissionID as $iPermissionID) {
                    //write query here
                    $result = $this->db->insert('tbl_team_role_permission', array('role_id' => $roleID, 'permission_id' => $iPermissionID));
                    if ($result) {
                        $yesAddedOne = true;
                    }
                }
            }
        }

        return $yesAddedOne;
    }


    /**
    * This function is used to update the team member permissions levels
    * @param type 
    * @return type
    */

    public function updateRolePermission($aData) {
        $isUpdated = false;
        $bSomethingChanged = false;
        $selectedPermissionData = $aData['permission_array'];
        if (!empty($selectedPermissionData)) {
            foreach ($selectedPermissionData as $aPermissionUnit) {
                $selectedPermissionID[] = $aPermissionUnit['id'];
                $selectedPermissionValue[$aPermissionUnit['id']] = $aPermissionUnit['permission_value'];
            }
        }

        //pre($selectedPermissionID);
        //pre($selectedPermissionValue);

        $allPermissionID = $aData['all_permission_array'];
        $roleID = $aData['role_id'];
        if (!empty($selectedPermissionData) && !empty($allPermissionID)) {
            foreach ($allPermissionID as $iPermissionID) {
                $iCheckIfAddedAlready = $this->checkIfPermissionAdded($roleID, $iPermissionID);
                if (in_array($iPermissionID, $selectedPermissionID)) {
                    //Add permission
                    if ($iCheckIfAddedAlready == false) {
                        DB::table('tbl_team_role_permission')->insert(array('role_id' => $roleID, 'permission_id' => $iPermissionID, 'permission' => $selectedPermissionValue[$iPermissionID]));
                        $bSomethingChanged = true;
                    } else {
                        //update now
                        $updateData = array('role_id' => $roleID, 'permission_id' => $iPermissionID, 'permission' => $selectedPermissionValue[$iPermissionID]);

                        DB::table('tbl_team_role_permission')
                         ->where("id", $iCheckIfAddedAlready)
                          ->update($updateData);
                        $bSomethingChanged = true;
                    }
                } else {
                    //remove permission
                    if ($iCheckIfAddedAlready) {
                        DB::table('tbl_team_role_permission')
                        ->where('role_id', $roleID)
                        ->where('permission_id', $iPermissionID)
                          ->delete();
                        $bSomethingChanged = true;
                    }
                }
            }
        }

        return $bSomethingChanged;
    }


  /**
* This function will check the permissons already added or not 
* @param type $clientID
* @return type
*/

    public function checkIfPermissionAdded($roleID, $iPermissionID) {
        $oData = DB::table('tbl_team_role_permission')
          ->where('role_id', $roleID)
           ->where('permission_id', $iPermissionID)->first();
        if (!empty($oData->id)) {
            $iPermissionID = $oData->id;
            return $iPermissionID;
        } else {
            return false;
        }
    }

   
    /**
    * This function will return all roles in the sysetm
    * @param type $userID
    * @return type
    */

    public function getRoleList($userID = '') {
        $oData = DB::table('tbl_team_role')
        ->when($userID>0, function($query) use ($userID){
        return $query->where('user_id',$userID);
        })->get();
       
        return $oData;
    }


    /**
    * This function is used to get the team role permissions
    * @param type $roleID
    * @return type
    */

    public function getTeamRolePermission($roleID) {
        $oData = DB::table('tbl_team_role_permission')
        ->where('role_id', $roleID)->get();
        
        return $oData;
    }

  
    /**
    * This function will return team role permissons name 
    * @param type $roleID
    * @return type
    */

    public static function getTeamRolePermissionName($roleID) {
        $oData = DB::table('tbl_team_role_permission')
        ->select('tbl_team_role_permission.*', 'tbl_team_permission.title')
        ->where('role_id', $roleID)
        ->join('tbl_team_permission', 'tbl_team_role_permission.permission_id','=','tbl_team_permission.id')
         ->get();
        return $oData;
    }


    /**
    * This function is used to get the available permissons for the team member
    * @param type
    * @return type
    */

    public function getAvailablePermissions() {
        $oData = DB::table('tbl_team_permission')->get();
        return $oData;
    }

    

    

    /**
    * This function will return team member activity lists
    * @param type
    * @return type
    */

    public function getUserActivities($type = 'team', $userID='') {

      $clientID = Session::get('customer_user_id');
        if ($type == 'team') {


        $oData = DB::table('tbl_team_activities')
        ->when($userID>0, function($query) use ($userID){
        return $query->where('user_id',$userID);
        })

            
             
             ->when($clientID>0, function($query) use ($clientID){
                 return $query->where('tbl_users_team.parent_user_id', $clientID);
        })
            ->select('tbl_team_activities.*', 'tbl_team_activities.id AS activityID', 'tbl_team_activities.activity_created AS activityTime', 'tbl_users_team.*')
               ->leftJoin('tbl_users_team', 'tbl_team_activities.user_id','=','tbl_users_team.id')
                 ->orderBy('tbl_team_activities.id', 'DESC')->get();
        } else if ($type == 'user') {
            $oData = DB::table('tbl_users_team')
            ->select('tbl_users_team.*', 'tbl_users_team.id AS activityID', 'tbl_users_team.activity_created AS activityTime', 'tbl_users.*')
               ->leftJoin('tbl_users', 'tbl_users_team.user_id','=','tbl_users.id')
                 ->orderBy('tbl_users_team.id', 'DESC')->get();
        }

       
        return $oData;
    }


     /**
    * This function will return member permissions
    * @param type $userID
    * @return type
    */

    public function getMemberPermissions($userID) {
        $oData = DB::table('tbl_users_team')
         ->select('tbl_team_role_permission.permission', 'tbl_team_permission.title')
         ->join('tbl_team_role', 'tbl_users_team.team_role_id' ,'=','tbl_team_role.id')
         ->leftJoin('tbl_team_role_permission', 'tbl_team_role_permission.role_id','=','tbl_team_role.id')
          ->leftJoin('tbl_team_permission', 'tbl_team_role_permission.permission_id','=','tbl_team_permission.id')
            ->where('tbl_users_team.id', $userID)->get();
        
        return $oData;
    }


    /**
    * This function will return Team Role on the behalf of the role id
    * @param type $roleID
    * @return type
    */

    public static function getTeamByRoleId($roleID) {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $oData = DB::table('tbl_users_team')
        ->select('tbl_users_team.*')
        ->where('team_role_id', $roleID)
        ->where('parent_user_id', $userID)
        ->where('status', 1)->get();
       
        return $oData;
    }

}
