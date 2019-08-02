<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\WorkflowModel;
use App\Models\Admin\TagsModel;
use App\Models\Admin\ListsModel;
use App\Models\Admin\UsersModel;
use App\Models\Admin\TeamModel;
use App\Models\Admin\CountryModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Filesystem\Filesystem;
use Cookie;
use Session;

//error_reporting(0);


class Team extends Controller {


    /**
    * This function will return all the list of define roles 
    * @param type $clientID
    * @return type
    */

    public function rolelist(){
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $mUser  = new UsersModel();
        $mTeam = new TeamModel();
        $oRoles = array();
        $userDetail = $mUser->getAllUsers($userID);
        $userRole = $userDetail[0]->user_role;
        if($userRole != '1') {
            $oRoles = $mTeam->getRoleList($userID);
        }
        else {
            $userID = '';
            $oRoles = \App\Models\Admin\UsersModel::getRoleList($userID);
        }

        
        $bActiveSubsription = $mUser->isActiveSubscription();

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs">Team </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Team Roles" class="sidebar-control active hidden-xs ">Team Roles</a></li>
                    </ul>';

        return view ('admin.team.rolelist', array('title' => 'Team Roles', 'pagename' => $breadcrumb,'oRoles' => $oRoles, 'bActiveSubsription' => $bActiveSubsription));
    }
    

    /**
    * This function is used to all the members list 
    * @param type
    * @return type
    */

    public function memberlist(){
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $mTeam = new TeamModel();
        $mUser = new UsersModel();
        $userDetail = $mUser->getAllUsers($userID);
        $userRole = $userDetail[0]->user_role;
        if($userRole != '1'){
            $oMembers = $mTeam->getTeamMembers($userID);
            $oRoles = $mTeam->getRoleList($userID);
        } else {
            $userID = '';
            $oMembers = $mTeam->getTeamMembers($userID);
            $oRoles = $mTeam->getRoleList($userID);
        }

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs">Team </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Team Members" class="sidebar-control active hidden-xs ">Team Members</a></li>
                    </ul>';

        return view ('admin.team.memberlist', array('title' => 'Team Members', 'pagename' => $breadcrumb,'oMembers' => $oMembers, 'oRoles' => $oRoles));
        
        
    }

     public function twilioNumberlisting()
     {

      $post = $this->input->post();
      $area_code = strip_tags($post['area_code']);
      $res  = getTwilioPNByAreaCodeTeam($contryName = '', $area_code);
      return $res;


     }
    
    public function viewLog($teamMemberID){
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $mTeam = new TeamModel();
        $oData = $mTeam->getUserActivities('team', $teamMemberID);
        
        /*$breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                    <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                    <li><a class="sidebar-controlhidden-xs"><i class="icon-arrow-right13"></i></a> </li>
                    <li><a class="sidebar-control hidden-xs">View Activity Log</a></li>
                </ul>';*/ 


        return view ('admin.team.activitylist', array('title' => 'Team Member Activity', 'pagename' => $breadcrumb, 'oData'=>$oData));
        
    }
    
    

    /**
    * This function will return team member activity lists
    * @param type
    * @return type
    */


    public function activitylist(){
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $mTeam = new TeamModel();
        $oData = $mTeam->getUserActivities('team'); 

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs">Team </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Activity" class="sidebar-control active hidden-xs ">Activity</a></li>
                    </ul>';


        return view ('admin.team.activitylist', array('title' => 'Team Member Activity', 'pagename' => $breadcrumb, 'oData'=>$oData));
        
    }
    

    /**
    * This function will add the team member
    * @param type 
    * @return type
    */

    public function addTeamMember() {
        $mTeam = new TeamModel();
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = Input::post();

        if(empty($post)){
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $post['smschat_config']="";
        $post['webchat_config']="";

        $teamRoleID = strip_tags($post['memberRole']);
        $firstName = strip_tags($post['firstname']);
        $lastName = strip_tags($post['lastname']);
        $email = strip_tags($post['email']);
        //$country = $aData['country'];
        $phone = strip_tags($post['phone']);
        if($post['webchat_config']=='on') { $web_chat=1; } else { $web_chat=0;}
        if($post['smschat_config']=='on') { $sms_chat=1; } else { $sms_chat=0;}

        $gender = $post['gender'];
        $countryCode = $post['countryCode'];
        $cityName = $post['cityName'];
        $stateName = $post['stateName'];
        $zipCode = $post['zipCode'];
        $socialProfile = $post['socialProfile'];
        $tags = $post['tags'];

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 8; $i++) {
            $randstring .= $characters[rand(0, strlen($characters))];
        }
        $password = $randstring;
        $password_hash = 'Umair';
        $siteSalt = 'Rahul';
        $pwd = base64_encode($password . $password_hash . $siteSalt);

        $aData = array(
            'team_role_id' => $teamRoleID,
            'parent_user_id' => $userID,
            'firstname' => $firstName,
            'lastname' => $lastName,
            'email' => $email,
            'mobile' => $phone,
            'web_chat'=>$web_chat,
            'sms_chat'=>$sms_chat,

            'gender' => $gender,
            'country' => $countryCode,
            'city' => $cityName,
            'state' => $stateName,
            'zip_code' => $zipCode,
            'socialProfile' => $socialProfile,
            'tagID' => $tags,

            'status' => 1,
            'password' => $pwd,
            'created' => date("Y-m-d H:i:s")
        );
        
        if($post['smschat_config']=='on' && $post['twilioMobileNo']!="" )
        {
            $response = createTwilioCNTeam($post['twilioMobileNo']);
            if($response['status']=='success')
            {
              $aData['bb_number']= $post['twilioMobileNo'];
              $aData['contact_sid']= $response['contact_sid'];
            $teamUserID = $mTeam->addTeamMember($aData);
            if ($teamUserID > 0) {

            //Send Email Notification
            $emailContent = '<p> Hi '. $firstName. ' '. $lastName. ',';
            $emailContent .= '<br><br>You have invited as a Team member on branboost.<br><br>Here is the login details given below: <br>';
            $emailContent .= '<strong>Email: '. $email . '</strong><br>';
            $emailContent .= '<strong>Password: '. $password . '</strong><br>';
            $emailContent .= '<br><br>Regards,<br>Brandboost';
            sendEmail($email, $emailContent, "Brandboost Team Member Registration");            
            $response = array('status' => 'success', 'msg' => "Role added successfully!");
            }
            else if($teamUserID == 'email') {
            $response = array('status' => 'error', 'msg' => "Email is already exist.");
            }

            }
            else
            {

            $response = array('status' => 'error', 'msg' => "Something went wrong.");
            }

        }
        else

        {

           $teamUserID = $mTeam->addTeamMember($aData);
            if ($teamUserID > 0) {
            //Send Email Notification
            $emailContent = '<p> Hi '. $firstName. ' '. $lastName. ',';
            $emailContent .= '<br><br>You have invited as a Team member on branboost.<br><br>Here is the login details given below: <br>';
            $emailContent .= '<strong>Email: '. $email . '</strong><br>';
            $emailContent .= '<strong>Password: '. $password . '</strong><br>';
            $emailContent .= '<br><br>Regards,<br>Brandboost';
            sendEmail($email, $emailContent, "Brandboost Team Member Registration");            
            $response = array('status' => 'success', 'msg' => "Role added successfully!");
            }
            else if($teamUserID == 'email') {
            $response = array('status' => 'error', 'msg' => "Email is already exist.");
            }
            

        }

         //Create a team folder in the amazon s3 server
           $s3 = \Storage::disk('s3');
          
           $res = $s3->put($userID."/".$teamUserID."/",'','public');

            $folderName = ['onsite', 'offsite', 'automation', 'broadcast', 'referral', 'nps','webchat', 'smschat', 'reviews'];

            $subfolder = ['images', 'videos', 'files'];

            foreach ($folderName as  $value) {
               $res = $s3->put($userID."/".$teamUserID."/".$value.'/','','public');

                foreach ($subfolder as $subvalue) {
                   $res = $s3->put($userID."/".$teamUserID."/".$value.'/'.$subvalue.'/','','public');
                }
            }

        //End 




        
        echo json_encode($response);
        exit;
    }
    
    
    /**
    * This function is used to add the new role 
    * @param type $clientID
    * @return type
    */

    public function addRole() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = Input::post();
        if(empty($post)){
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $mTeam = new TeamModel();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $title = strip_tags($post['title']);
        $dateTime = date("Y-m-d H:i:s");
        $aData = array(
            'role_name' => $title,
            'user_id' => $userID,
            'role_created' => $dateTime
        );

        $bAlreadyExists = $mTeam->checkIfUserRoleExists($title, $userID);
        if ($bAlreadyExists == true) {
            $response = array('status' => 'error', 'type'=> 'duplicate', 'msg' => 'Role name already exists');
            echo json_encode($response);
            exit;
        }

        $insertID = $mTeam->addTeamRole($aData);
        if ($insertID > 0) {
            $response = array('status' => 'success', 'msg' => "Role added successfully!");
        }
        
        echo json_encode($response);
        exit;
    }
    
    
    /**
    * This function will return existing role assing to team member
    * @param type $clientID
    * @return type
    */


    public function getRole() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = Input::post();
        $mTeam = new TeamModel();
        if(empty($post)){
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $roleID = strip_tags($post['role_id']);
        $oRole = $mTeam->getRole($roleID, $userID);
        if(!empty($oRole)){
            $response = array('status' => 'success', 'title' => $oRole->role_name);
        }else{
            $response = array('status' => 'error', 'msg' => 'Not found');
        }
        
        echo json_encode($response);
        exit;
    }
    
    
    /**
    * This function is used to update the role name
    * @param type $clientID
    * @return type
    */

    public function updateRole() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = Input::post();
        if(empty($post)){
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $mTeam = new TeamModel();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $roleID = strip_tags($post['role_id']);
        $title = strip_tags($post['title']);
        $dateTime = date("Y-m-d H:i:s");
        $aData = array(
            'role_name' => $title
        );

        $bAlreadyExists = $mTeam->checkIfUserRoleExists($title, $userID);
        if ($bAlreadyExists == true) {
            $response = array('status' => 'error', 'type'=> 'duplicate', 'msg' => 'Role name already exists');
            echo json_encode($response);
            exit;
        }

        $bUpdated = $mTeam->updateTeamRole($aData, $roleID, $userID);
        if ($bUpdated) {
            $response = array('status' => 'success', 'msg' => "Role updated successfully!");
        }
        
        echo json_encode($response);
        exit;
    }
    

    /**
    * This function is use to delete the role for team member
    * @param type $clientID
    * @return type
    */

    public function deleteRole(){
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = Input::post();
        $mTeam  = new TeamModel();
        if(empty($post)){
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $roleID = strip_tags($post['role_id']);
        $bDeleted = $mTeam->deleteRole($roleID, $userID);
        if($bDeleted == true){
            $response = array('status' => 'success', 'msg' => "Role deleted successfully!");
        }
        echo json_encode($response);
        exit;
    }
    
    public function deleteTeamRoles(){
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if(empty($post)){
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $roleIDs = $post['multipal_id'];
        
        foreach($roleIDs as $roleID){
            $bDeleted = $this->mTeam->deleteRole($roleID, $userID);
        }
        
        if($bDeleted == true){
            $response = array('status' => 'success', 'msg' => "Role deleted successfully!");
        }
        echo json_encode($response);
        exit;
    }
    

    /**
    * This function is used to get the team member details 
    * @param type 
    * @return type
    */

    public function getTeamMember() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = Input::post();
        $mTeam = new TeamModel();
        if(empty($post)){
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $memberID = strip_tags($post['member_id']);
        $memberData = $mTeam->getTeamMember($memberID, $userID);
        if(!empty($memberData)){
            $response = array('status' => 'success', 'result' => $memberData);
        }else{
            $response = array('status' => 'error', 'msg' => 'Not found');
        }
        
        echo json_encode($response);
        exit;
    }
    
    
     /**
    * This function is used to update the team member details 
    * @param type 
    * @return type
    */

    public function updateTeamMember() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = Input::post();
        if(empty($post)){
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }

        $memberID = strip_tags($post['edit_member_id']);
        $teamRoleID = strip_tags($post['edit_memberRole']);
        $firstName = strip_tags($post['edit_firstname']);
        $lastName = strip_tags($post['edit_lastname']);
        $email = strip_tags($post['edit_email']);
        $phone = strip_tags($post['edit_phone']);
        if(isset($post['edit_webchat_config']) && $post['edit_webchat_config']=='on') { $web_chat=1; } else { $web_chat=0;}
        if(isset($post['edit_webchat_config']) && $post['edit_smschat_config']=='on') { $sms_chat=1; } else { $sms_chat=0;}

        $edit_gender = $post['edit_gender'];
        $edit_countryCode = $post['edit_countryCode'];
        $edit_cityName = $post['edit_cityName'];
        $edit_stateName = $post['edit_stateName'];
        $edit_zipCode = $post['edit_zipCode'];
        $edit_socialProfile = $post['edit_socialProfile'];
        $edit_tags = $post['edit_tags'];

        
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $mTeam = new TeamModel();
        
        $aData = array(
            'team_role_id' => $teamRoleID,
            'firstname' => $firstName,
            'lastname' => $lastName,
            'email' => $email,
            'mobile' => $phone,
            'web_chat'=>$web_chat,
            'sms_chat'=>$sms_chat,
            'gender' => $edit_gender,
            'country' => $edit_countryCode,
            'city' => $edit_cityName,
            'state' => $edit_stateName,
            'zip_code' => $edit_zipCode,
            'socialProfile' => $edit_socialProfile,
            'tagID' => $edit_tags
        );
        

       if(isset($post['edit_smschat_config']) && $post['edit_smschat_config']=='on' && $post['twilioMobileNo']!="" )
       {
           $response = createTwilioCNTeam($post['twilioMobileNo']);
           if($response['status']=='success')
            {
                $aData['bb_number']= $post['twilioMobileNo'];
                $aData['contact_sid']= $response['contact_sid'];

                $bUpdated = $mTeam->updateTeamMember($aData, $memberID, $userID);
                if ($bUpdated) {
                $response = array('status' => 'success', 'msg' => "Team member has been updated successfully!");
                }

            }
            else
            {
              $response = array('status' => 'success', 'msg' => "Something went wrong!");
            }
       }
       else
       {
            $bUpdated = $mTeam->updateTeamMember($aData, $memberID, $userID);
            if ($bUpdated) {
                $response = array('status' => 'success', 'msg' => "Team member has been updated successfully!");
            }
      }
        
        echo json_encode($response);
        exit;
    }
    
    public function deleteTeamMember(){
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = Input::post();
        if(empty($post)){
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $mTeam = new TeamModel();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $memberID = strip_tags($post['member_id']);
        $bDeleted = $mTeam->deleteTeamMember($memberID, $userID);
        if($bDeleted == true){
            $response = array('status' => 'success', 'msg' => "Team member has been deleted successfully!");
        }
        echo json_encode($response);
        exit;
    }
    
    public function deleteTeamMembers(){
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if(empty($post)){
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $memberIDs = $post['multipal_id'];
        foreach($memberIDs as $memberID){
            $bDeleted = $this->mTeam->deleteTeamMember($memberID, $userID);
        }
        if($bDeleted == true){
            $response = array('status' => 'success', 'msg' => "Team member has been deleted successfully!");
        }
        echo json_encode($response);
        exit;
    }
    

    /**
    * This function is used to manage the role permissions of the team members
    * @param type 
    * @return type
    */

    public function manageRolePermission() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = Input::post();
        if(empty($post)){
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $mTeam = new TeamModel();
        $userID = $aUser->id;
        $roleID = strip_tags($post['role_id']);
        $oSelectedPermission = $mTeam->getTeamRolePermission($roleID);
        
        $oAvailablePermission = $mTeam->getAvailablePermissions();
        
        $permissionForm = view("admin.team.permission_form", array('selected_permission' => $oSelectedPermission, 'oAvailable_permission' => $oAvailablePermission))->render();
            $response = array('status' => 'success', 'permission_form' => $permissionForm, 'msg' => "Role updated successfully!");
        
        
        echo json_encode($response);
        exit;
    }
    
    public function addRolePermission() {
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = $this->input->post();
        if(empty($post)){
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $roleID = strip_tags($post['role_id']);
        $aPermissionID = $post['permission_id'];
        $dateTime = date("Y-m-d H:i:s");
        $aData = array(
            'role_id' => $roleID,
            'permission_array' => $aPermissionID,
            'role_created' => $dateTime
        );

        $bAdded = $this->mTeam->addRolePermission($aData);
        if ($bAdded == true) {
            $response = array('status' => 'success', 'msg' => "Permission added successfully!");
        }
        
        echo json_encode($response);
        exit;
    }
    
    
    
    public function updateRolePermission() {
        $mTeam = new TeamModel();
        $aPermissionData = array();
        $response = array('status' => 'error', 'msg' => 'Something went wrong');
        $post = Input::post();
        if(empty($post)){
            $response = array('status' => 'error', 'msg' => 'Request header is empty');
            echo json_encode($response);
            exit;
        }
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $roleID = strip_tags($post['role_id']);
        if(!empty($post['permission_id']))
        {
          $aPermission = $post['permission_id'];
         }
        if(!empty($aPermission)){
            foreach($aPermission as $iPerID){
               $aPermissionData[] = array(
                   'id' => $iPerID,
                   'permission_value' => strip_tags($post['permission_val_'.$iPerID])
               ); 
            }
        }
        //pre($aPermissionData);
        $oAvailablePermission = $mTeam->getAvailablePermissions();
        if(!empty($oAvailablePermission)){
            foreach($oAvailablePermission as $oPermission){
                $aAllPermissionID[] = $oPermission->id;
            }
        }
        $dateTime = date("Y-m-d H:i:s");
        $aData = array(
            'role_id' => $roleID,
            'permission_array' => $aPermissionData,
            'all_permission_array' => $aAllPermissionID,
            'userID' => $userID
        );

        $bUpdated = $mTeam->updateRolePermission($aData);
        if ($bUpdated == true) {
            $response = array('status' => 'success', 'msg' => "Permission updated successfully!");
        }
        
        echo json_encode($response);
        exit;
    }
    

        /**
        * This function is used for team dashboard
        * @param type 
        * @return type
        */

    public function dashboard() {

        $aUser = getLoggedUser();
        $userID = $aUser->id;
        $mUser = new UsersModel();
        $mTeam = new TeamModel();
          $oRoles = array();
        $userDetail = $mUser->getAllUsers($userID);
        $userRole = $userDetail[0]->user_role;
        if($userRole != '1') {
            $oRoles = $mTeam->getRoleList($userID);
            $oMembers = $mTeam->getTeamMembers($userID);
        }
        else {
            $userID = '';
            $oRoles = $mTeam->getRoleList($userID);
            $oMembers = $mTeam->getTeamMembers($userID);
        }
        
        $bActiveSubsription = $mUser->isActiveSubscription();

        $breadcrumb = '<ul class="nav navbar-nav hidden-xs bradcrumbs">
                        <li><a class="sidebar-control hidden-xs" href="' . base_url('admin/') . '">Home</a> </li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs">Team </a></li>
                        <li><a style="cursor:text;" class="sidebar-control hidden-xs slace">/</a></li>
                        <li><a data-toggle="tooltip" data-placement="bottom" title="Dashboard" class="sidebar-control active hidden-xs ">Dashboard</a></li>
                    </ul>';

        $data = array(
            'title' => 'Contacts',
            'pagename' => $breadcrumb,
            'oRoles' => $oRoles, 
            'oMembers' => $oMembers,
            'bActiveSubsription' => $bActiveSubsription
        );

        return view ('admin.user_setting',$data);
    }
    
    
    

    
}
