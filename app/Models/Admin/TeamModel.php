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

    public function checkIfUserRoleExists($roleName, $userID) {
        $this->db->where("user_id", $userID);
        $this->db->where("role_name", $roleName);
        $result = $this->db->get('tbl_team_role');
        if ($result->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function addTeamMember($aData) {

        $this->db->where("email", $aData['email']);
        $result = $this->db->get('tbl_users_team');
        if ($result->num_rows() > 0) {
            return 'email';
        } else {
            $result = $this->db->insert("tbl_users_team", $aData);
            $insert_id = $this->db->insert_id();
            if ($result) {
                return $insert_id;
            } else {
                return false;
            }
        }
    }

    public function addTeamRole($aData) {
        $result = $this->db->insert("tbl_team_role", $aData);
        $inset_id = $this->db->insert_id();
        if ($result) {
            return $inset_id;
        } else {
            return false;
        }
    }

    public function updateTeamRole($aData, $roleID, $userID) {
        $this->db->where("id", $roleID);
        $this->db->where("user_id", $userID);
        $result = $this->db->update("tbl_team_role", $aData);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteRole($roleID, $userID) {
        $this->db->where("id", $roleID);
        $this->db->where("user_id", $userID);
        $result = $this->db->delete("tbl_team_role");
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getRole($id, $userID) {
        $this->db->where("id", $id);
        $this->db->where("user_id", $userID);
        $result = $this->db->get('tbl_team_role');
        if ($result->num_rows() > 0) {
            $aData = $result->row();
        }
        return $aData;
    }

    public function updateTeamMember($aData, $memberID, $userID) {
        $this->db->where("id", $memberID);
        $this->db->where("parent_user_id", $userID);
        $result = $this->db->update("tbl_users_team", $aData);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteTeamMember($memberID, $userID) {
        $this->db->where("id", $memberID);
        $this->db->where("parent_user_id", $userID);
        $result = $this->db->delete("tbl_users_team");
        if ($result) {
            return true;
        } else {
            return false;
        }
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
                        $this->db->insert('tbl_team_role_permission', array('role_id' => $roleID, 'permission_id' => $iPermissionID, 'permission' => $selectedPermissionValue[$iPermissionID]));
                        $bSomethingChanged = true;
                    } else {
                        //update now
                        $updateData = array('role_id' => $roleID, 'permission_id' => $iPermissionID, 'permission' => $selectedPermissionValue[$iPermissionID]);
                        $this->db->where("id", $iCheckIfAddedAlready);
                        $this->db->update("tbl_team_role_permission", $updateData);
                        $bSomethingChanged = true;
                    }
                } else {
                    //remove permission
                    if ($iCheckIfAddedAlready) {
                        $this->db->where('role_id', $roleID);
                        $this->db->where('permission_id', $iPermissionID);
                        $this->db->delete('tbl_team_role_permission');
                        $bSomethingChanged = true;
                    }
                }
            }
        }

        return $bSomethingChanged;
    }

    public function checkIfPermissionAdded($roleID, $iPermissionID) {
        $this->db->where('role_id', $roleID);
        $this->db->where('permission_id', $iPermissionID);
        $result = $this->db->get('tbl_team_role_permission');
        if ($result->num_rows() > 0) {
            $aData = $result->row();
            $iPermissionID = $aData->id;
            return $iPermissionID;
        } else {
            return false;
        }
    }

    public function getRoleList($userID = '') {
        $this->db->select("tbl_team_role.*");
        if ($userID > 0) {
            $this->db->where("user_id", $userID);
        }
        $result = $this->db->get('tbl_team_role');
        if ($result->num_rows() > 0) {
            $aData = $result->result();
        }
        return $aData;
    }

    public function getTeamRolePermission($roleID) {
        $this->db->select("tbl_team_role_permission.*");
        $this->db->where("role_id", $roleID);
        $result = $this->db->get("tbl_team_role_permission");
        if ($result->num_rows() > 0) {
            $aData = $result->result();
        }
        return $aData;
    }

    public function getTeamRolePermissionName($roleID) {
        $this->db->select("tbl_team_role_permission.*, tbl_team_permission.title");
        $this->db->where("role_id", $roleID);
        $this->db->join("tbl_team_permission", "tbl_team_role_permission.permission_id=tbl_team_permission.id", "INNER");
        $result = $this->db->get("tbl_team_role_permission");
        if ($result->num_rows() > 0) {
            $aData = $result->result();
        }
        return $aData;
    }

    public function getAvailablePermissions() {
        $this->db->select("tbl_team_permission.*");
        $result = $this->db->get("tbl_team_permission");
        if ($result->num_rows() > 0) {
            $aData = $result->result();
        }
        return $aData;
    }

    public function getTeamMembers($userID = '') {
        $this->db->select("tbl_users_team.*, tbl_team_role.id AS roleID, tbl_team_role.role_name");
        $this->db->join("tbl_team_role", "tbl_users_team.team_role_id=tbl_team_role.id", "LEFT");
        if ($userID > 0) {
            $this->db->where("tbl_users_team.parent_user_id", $userID);
        }
        $this->db->order_by("tbl_users_team.id", "DESC");
        $result = $this->db->get("tbl_users_team");
        if ($result->num_rows() > 0) {
            $aData = $result->result();
        }
        return $aData;
    }

    

    public function getUserActivities($type = 'team', $userID) {
        if ($userID > 0) {
            $this->db->where("user_id", $userID);
        }

        if ($type == 'team') {
            $clientID = $this->session->userdata('customer_user_id');
            if ($clientID > 0) {
                $this->db->where("tbl_users_team.parent_user_id", $clientID);
            }
            $this->db->select("tbl_team_activities.*, tbl_team_activities.id AS activityID, tbl_team_activities.activity_created AS activityTime, tbl_users_team.*");
            $this->db->join("tbl_users_team", "tbl_team_activities.user_id=tbl_users_team.id", "LEFT");
            $this->db->order_by("tbl_team_activities.id", "DESC");
            $result = $this->db->get("tbl_team_activities");
        } else if ($type == 'user') {
            $this->db->select("tbl_users_team.*, tbl_users_team.id AS activityID, tbl_users_team.activity_created AS activityTime, tbl_users.*");
            $this->db->join("tbl_users", "tbl_users_team.user_id=tbl_users.id", "LEFT");
            $this->db->order_by("tbl_users_team.id", "DESC");
            $result = $this->db->get("tbl_users_team");
        }

        if ($result->num_rows() > 0) {
            $aData = $result->result();
        }
        return $aData;
    }

    public function getMemberPermissions($userID) {
        $this->db->select("tbl_team_role_permission.permission, tbl_team_permission.title");
        $this->db->join("tbl_team_role", "tbl_users_team.team_role_id = tbl_team_role.id", "INNER");
        $this->db->join("tbl_team_role_permission", "tbl_team_role_permission.role_id=tbl_team_role.id", "LEFT");
        $this->db->join("tbl_team_permission", "tbl_team_role_permission.permission_id=tbl_team_permission.id", "LEFT");
        $this->db->where("tbl_users_team.id", $userID);
        $result = $this->db->get("tbl_users_team");
        if ($result->num_rows() > 0) {
            $aData = $result->result();
        }
        return $aData;
    }

    public function getTeamByRoleId($roleID) {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $this->db->select("tbl_users_team.*");
        $this->db->where("team_role_id", $roleID);
        $this->db->where("parent_user_id", $userID);
        $this->db->where("status", 1);
        $result = $this->db->get("tbl_users_team");
        if ($result->num_rows() > 0) {
            $aData = $result->result();
        }
        return $aData;
    }

}
