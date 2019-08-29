@extends('layouts.main_template') 

@section('title')
{{ $title }}
@endsection

@section('contents')
				  <div class="content">
				  <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
					<div class="page_header">
					  <div class="row">
					  <!--=============Headings & Tabs menu==============-->
						<div class="col-md-7">
						  <h3><img style="width: 18px;" src="/assets/images/user_settings_icon.png"> Dashboard</h3>
						  <ul class="nav nav-tabs nav-tabs-bottom">
							<li class="active"><a href="#right-icon-tab0" data-toggle="tab">Users</a></li>
							<li><a href="#right-icon-tab1" data-toggle="tab">Teams</a></li>
							<li><a href="#right-icon-tab2" data-toggle="tab">Roles & User Permissions</a></li>
							<li><a href="#right-icon-tab3" data-toggle="tab">Invites</a></li>
						  </ul>
						  
						</div>
						<!--=============Button Area Right Side==============-->
						<div class="col-md-5 text-right btn_area">
						 <button type="button" class="btn dark_btn ml20" data-toggle="modal" data-target="#addContact"><i class="icon-plus3"></i><span> &nbsp;  Invite User</span> </button>
						 </div>
					  </div>
					</div>
				  <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->
				  
				  
				    <!--&&&&&&&&&&&& TABBED CONTENT START &&&&&&&&&&-->
					 <div class="tab-content"> 
					  <!--===========TAB 1===========-->
					  <div class="tab-pane active" id="right-icon-tab0">
					  
						<div class="row"> 
  <div class="col-md-12">
    <div class="panel panel-flat review_ratings">
      <div class="panel-heading">
        <h6 class="panel-title"><?php echo count($oMembers); ?> Users</h6>
        <div class="heading-elements">
        
        				<div class="btn-group display-inline-block mt-5 mr20">
									<button id="grid" type="button" class="btn btn-xs btn-default"><i class="icon-grid6"></i></button>
									<button id="list" type="button" class="btn btn-xs btn-default"><i class="icon-list2"></i></button>
								</div>
								
								
								
									<div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
									  <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
									  <div class="form-control-feedback"> <i class="icon-search4"></i> </div>
									</div>
									&nbsp; &nbsp;
									<button type="button" class="btn btn-xs btn-default"><i class="icon-pencil position-left"></i> Edit</button>
								  </div>
      </div>
      <div class="panel-body p0">
		<div class="user_display">
			<div class="row">

          <?php 

          //pre($oMembers->role_name);
          $j = 1;
          foreach($oMembers as $subData) {

              $roleID = $subData->roleID;
              $oSelectedPermission = \App\Models\Admin\TeamModel::getTeamRolePermissionName($roleID);

              ?>
              <div class="col-xs-3">
                <div class="user_area">
                  <figure><img src="/assets/images/userp.png"/></figure>
                  <p class="fsize13"><?php echo $subData->firstname.' '.$subData->lastname; ?></p>
                  <p class="text-muted fsize12"><span><?php echo $subData->email; ?></span></p>
                  <div class="text-left">
                    <?php
                      $inc = 1;
                     foreach($oSelectedPermission as $roleName) {
                        
                        ?> <button class="btn btn-xs btn_white_table txt_purple"><?php echo $roleName->title; ?></button><?php
                       
                        if($inc%2 == 0) {
                          ?><div class="clearfix"></div><?php
                        }
                        $inc++;
                    }?>
                    <!-- <button class="btn btn-xs btn_white_table mr10 txt_dark">Core Team</button>
                    <button class="btn btn-xs btn_white_table txt_purple">Marketing</button>
                    <div class="clearfix"></div>
                    <button class="btn btn-xs btn_white_table mt10 txt_green">Sales</button> -->
                     <hr>
                    <button class="btn btn-xs btn_white_table txt_dark"><?php echo $subData->role_name; ?></button>
                  </div>
                </div>
              </div>
              <?php

              if($j%4 == 0) {
                ?></div><div class="row"><?php
              }
              $j++;
          } 
          ?>

			</div> 
            
           
		  </div>
					  
					  <div class="user_display_table" style="display: none;">
					<table class="table datatable-basic">
  <thead>
    <tr>
      <th style="display: none;"></th>
      <th style="display: none;"></th>
      <th><i class="icon-user"></i>User</th>
      <th><i class="icon-arrow-up-left2"></i> Role</th>
      <th class="text-right"><i class="icon-users4"></i>Teams</th>
    </tr>
  </thead>
  <tbody>
    <!--================================================-->


     <?php 
          foreach($oMembers as $subData) {
              //pre($subData->id);
              $roleID = $subData->roleID;
              $oSelectedPermission = \App\Models\Admin\TeamModel::getTeamRolePermissionName($roleID);

              ?>
               <tr>
               <td style="display: none;"></td>
               <td style="display: none;"><?php echo $subData->id; ?></td>
               <td>
                  <div class="media-left media-middle"> <a class="icons" href="#"><img src="/assets/images/userp.png" class="img-circle img-xs" alt=""></a> </div>
                  <div class="media-left">
                    <div class="pt-5"><a href="#" class="text-default text-semibold"><span><?php echo $subData->firstname.' '.$subData->lastname; ?></span></a></div>
                    <div class="text-muted text-size-small"><?php echo $subData->email; ?></div>
                  </div>
                </td>
              
              <td class="text-left">
                <!-- <button class="btn btn-xs btn_white_table pr10 pl10">Core Team</button> 
                <button class="btn btn-xs btn_white_table pr10 pl10 txt_purple">Marketing</button> 
                <button class="btn btn-xs btn_white_table pr10 pl10 txt_green">Sales</button> -->
                <?php
                  $inc = 1;
                  foreach($oSelectedPermission as $roleName) {
                        
                    ?> <button class="btn btn-xs btn_white_table pr10 pl10 txt_purple"><?php echo $roleName->title; ?></button><?php
                  }
                ?>
              </td>
               
              <td class="text-right"><button class="btn btn-xs btn_white_table pr10 pl10"><?php echo $subData->role_name; ?></button> </td>
              </tr>
              <?php
          } 
          ?>

   
    <!--================================================-->
 
    
  </tbody>
</table>
					</div>
							  
      
      </div>
    </div>
  </div>
</div>
		  
					  </div>
					  <!--===========TAB 2===========-->
					  <div class="tab-pane" id="right-icon-tab1">
                     
                      <div class="row"> 
                      <div class="col-md-12">
                        <div class="panel panel-flat review_ratings">
                          <div class="panel-heading">
                            <h6 class="panel-title"><?php echo count($oRoles); ?> Teams</h6>
                            <div class="heading-elements">
                                                       
                                <!-- <div class="btn-group display-inline-block mt-5 mr20">
                                <button id="list_team" type="button" class="btn btn-xs btn-default"><i class="icon-list2"></i></button>
															  <button id="grid_team" type="button" class="btn btn-xs btn-default"><i class="icon-grid6"></i></button>
															
														    </div> -->
                                                       
                                                       
                                                       
                                <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                  <input class="form-control input-sm" placeholder="Search by name" type="text">
                                  <div class="form-control-feedback"> <i class="icon-search4"></i> </div>
                                </div>
                                &nbsp; &nbsp;
                                <button type="button" class="btn btn-xs btn-default"><i class="icon-pencil position-left"></i> Edit</button>
                              </div>
                          </div>
                          <div class="panel-body p0">
                           
                           <div class="listteam_table">
                            <table class="table datatable-basic">
  <thead>
    <tr>
      <th><i class="icon-user"></i>Team</th>
      <th><i class="icon-user"></i>Users</th>
      <th>&nbsp;</th>
      <th class="text-right">&nbsp;</th>
    </tr>
  </thead>
  <tbody>
    <!--================================================-->
     <?php
        foreach($oRoles as $role) {


          $getTeamUser = \App\Models\Admin\TeamModel::getTeamByRoleId($role->id);

          ?>
          <tr>
            <td><div class="media-left media-middle"> <a class="icons bkg_dark" href="#"><i class="icon-user txt_white"></i></a> </div>
              <div class="media-left">
                <div class="pt-5"><a href="#" class="text-default text-semibold"><span><?php echo $role->role_name; ?></span></a></div>
                
              </div></td>
            <td>
            <?php if(!empty($getTeamUser)) {
              echo count($getTeamUser);
            }
            else {
              echo '0';
            }?> Users</td>
            <td>

            <?php if(!empty($getTeamUser)) {
              ?><div class="media-left media-middle userimg"> 
              <a style="width:auto;" class="icons" href="#"><?php
              
              for($inc=0; $inc < count($getTeamUser); $inc++) {
                ?><img src="/assets/images/userp.png" class="img-circle img-xs" alt=""><?php
              }
            }
            else {
              echo '-';
            }?>
              </a> 
            </div>
            </td>
            <td class="text-right"><button class="btn btn-xs btn_white_table pr10 pl10 addTeamMember" roleId="<?php echo $role->id; ?>">Add Users</button></td>
          </tr>
          <?php
        } ?>

    
    
  </tbody>
</table>
                             </div>                    
                                                 
							<div class="listteam_grid p30" style="display: none;">
							<div class="row">
								<div class="col-xs-3">
								<div class="user_area mb0">
								<a href="#" class="icons big bkg_dark m0 mb20"><i class="icon-user txt_white"></i></a>
								<p class="fsize13">Core Team</p>
								<p class="text-muted fsize12"><span>8 Users</span></p>
								<div class="text-center">
							   <div class="media-left media-middle userimg useimg_center"> <a style="width:auto;" class="icons" href="#"><img src="/assets/images/cust1.png" class="img-circle img-xs" alt=""><img src="/assets/images/cust2.png" class="img-circle img-xs" alt=""><img src="/assets/images/cust3.png" class="img-circle img-xs" alt=""><img src="/assets/images/cust1.png" class="img-circle img-xs" alt=""><img src="/assets/images/cust2.png" class="img-circle img-xs" alt=""><img src="/assets/images/cust3.png" class="img-circle img-xs" alt=""></a> </div>
								<hr>
								<button class="btn btn-xs btn_white_table txt_dark">Add User</button>
								</div>
								</div>
								</div>
             
             
             
             
             					<div class="col-xs-3">
								<div class="user_area mb0">
								<a class="icons big bkg_sblue m0 mb20" href="#"><i class="icon-coin-dollar txt_white"></i></a>
								<p class="fsize13">Sales</p>
								<p class="text-muted fsize12"><span>5 Users</span></p>
								<div class="text-center">
							   <div class="media-left media-middle userimg useimg_center"> <a style="width:auto;" class="icons" href="#"><img src="/assets/images/cust1.png" class="img-circle img-xs" alt=""><img src="/assets/images/cust2.png" class="img-circle img-xs" alt=""><img src="/assets/images/cust2.png" class="img-circle img-xs" alt=""><img src="/assets/images/cust3.png" class="img-circle img-xs" alt=""></a> </div>
								<hr>
								<button class="btn btn-xs btn_white_table txt_dark">Add User</button>
								</div>
								</div>
								</div>
             
             
             					<div class="col-xs-3">
								<div class="user_area mb0">
								<a class="icons big bkg_purple m0 mb20" href="#"><i class="icon-power2 txt_white"></i></a>
								<p class="fsize13">Marketing</p>
								<p class="text-muted fsize12"><span>3 Users</span></p>
								<div class="text-center">
							   <div class="media-left media-middle userimg useimg_center"> <a style="width:auto;" class="icons" href="#"><img src="/assets/images/cust1.png" class="img-circle img-xs" alt=""><img src="/assets/images/cust2.png" class="img-circle img-xs" alt=""><img src="/assets/images/cust3.png" class="img-circle img-xs" alt=""></a> </div>
								<hr>
								<button class="btn btn-xs btn_white_table txt_dark">Add User</button>
								</div>
								</div>
								</div>
             
            					 <div class="col-xs-3">
								<div class="user_area mb0">
								<a class="icons big bkg_green m0 mb20" href="#"><i class="icon-cog5 txt_white"></i></a>
								<p class="fsize13">Developers</p>
								<p class="text-muted fsize12"><span>1 Users</span></p>
								<div class="text-center">
							   <div class="media-left media-middle userimg useimg_center"> <a style="width:auto;" class="icons" href="#"><img src="/assets/images/cust1.png" class="img-circle img-xs" alt=""></a> </div>
								<hr>
								<button class="btn btn-xs btn_white_table txt_dark">Add User</button>
								</div>
								</div>
								</div>
              
							</div>
							</div>
                                                  
                                                  
                          
                          </div>
                        </div>
                      </div>
                    </div>
                      
                      </div>
					  <!--===========TAB 3====Preferences=======-->
					  <div class="tab-pane" id="right-icon-tab2">
                      <div class="row"> 
                      <div class="col-md-12">
                        <div class="panel panel-flat review_ratings">
                          <div class="panel-heading">
                            <h6 class="panel-title"><?php echo $oRoles->count(); ?> Roles</h6>
                            <div class="heading-elements">
                                                        <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                                          <input class="form-control input-sm" placeholder="Search by name" type="text">
                                                          <div class="form-control-feedback"> <i class="icon-search4"></i> </div>
                                                        </div>
                                                        &nbsp; &nbsp;
                                                        <button type="button" class="btn btn-xs btn-default"><i class="icon-pencil position-left"></i> Edit</button>
                                                      </div>
                          </div>
                          <div class="panel-body p0">
                            <table class="table datatable-basic">
  <thead>
    <tr>
      <th><i class="icon-user"></i>Roles</th>
      <th><i class="icon-user"></i>Users</th>
      <th>&nbsp;</th>
      <th class="text-right">&nbsp;</th>
    </tr>
  </thead>
  <tbody>
    <!--================================================-->

    <?php
        foreach($oRoles as $role) {

          $getTeamUser = \App\Models\Admin\TeamModel::getTeamByRoleId($role->id);

          ?>
          <tr>
            <td><div class="media-left media-middle"> <a class="icons bkg_dark" href="#"><i class="icon-user txt_white"></i></a> </div>
              <div class="media-left">
                <div class="pt-5"><a href="#" class="text-default text-semibold"><span><?php echo $role->role_name; ?></span></a></div>
                
              </div></td>
            <td>
            <?php if(!empty($getTeamUser)) {
              echo count($getTeamUser);
            }
            else {
              echo '0';
            }?> Users</td>
            <td>

            <?php if(!empty($getTeamUser)) {
              ?><div class="media-left media-middle userimg"> 
              <a style="width:auto;" class="icons" href="#"><?php
              
              for($inc=0; $inc < count($getTeamUser); $inc++) {
                ?><img src="/assets/images/userp.png" class="img-circle img-xs" alt=""><?php
              }
            }
            else {
              echo '-';
            }?>
              </a> 
            </div>
            </td>
            <td class="text-right"><button class="btn btn-xs btn_white_table pr10 pl10 addTeamMember" roleId="<?php echo $role->id; ?>">Add Users</button> <a href="javascript:void(0);" role_id="<?php echo $role->id; ?>" class="btn btn-xs btn_white_table pr10 pl10 managerole">Manage Permissions</a></td>
          </tr>
          <?php
        } ?>
    
  </tbody>
</table>
                                                  
                                                  
                          
                          </div>
                        </div>
                      </div>
                    </div>
                      </div>
					  <!--===========TAB 4====Chat Widget=======-->
					  <div class="tab-pane" id="right-icon-tab3">
                      <div class="row"> 
                      <div class="col-md-12">
                        <div class="panel panel-flat review_ratings">
                          <div class="panel-heading">
                            <h6 class="panel-title">8 Users</h6>
                            <div class="heading-elements">
                              <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                <input class="form-control input-sm" placeholder="Search by name" type="text">
                                <div class="form-control-feedback"> <i class="icon-search4"></i> </div>
                              </div>
                              &nbsp; &nbsp;
                              <button type="button" class="btn btn-xs btn-default"><i class="icon-pencil position-left"></i> Edit</button>
                            </div>
                          </div>
                          <div class="panel-body p0">
                            <table class="table datatable-basic">
  <thead>
    <tr>
      <th><i class="icon-user"></i>User</th>
      
      <th class="text-right">Status</th>
    </tr>
  </thead>
  <tbody>
    <!--================================================-->
    <tr>
     <td>
				<div class="media-left media-middle"> <a class="icons" href="#"><img src="/assets/images/cust1.png" class="img-circle img-xs" alt=""></a> </div>
				<div class="media-left">
					<div class="pt-5"><a href="#" class="text-default text-semibold"><span>Dora Weber</span></a></div>
					<div class="text-muted text-size-small">carlo.johnston@yahoo.com</div>
				</div>
			</td>
     
      <td class="text-right"><button class="btn btn-xs btn_white_table pr10 pl10"><i class="icon-primitive-dot txt_dark"></i> Invited</button> </td>
    </tr>
    <!--================================================-->
    <tr>
     <td>
				<div class="media-left media-middle"> <a class="icons" href="#"><img src="/assets/images/cust2.png" class="img-circle img-xs" alt=""></a> </div>
				<div class="media-left">
					<div class="pt-5"><a href="#" class="text-default text-semibold"><span>Leah Clarke</span></a></div>
					<div class="text-muted text-size-small">wilderman.meghan@yahoo.com</div>
				</div>
			</td>
     
      <td class="text-right"><button class="btn btn-xs btn_white_table pr10 pl10"><i class="icon-primitive-dot txt_green"></i> Active</button> </td>
    </tr>
    
    <!--================================================-->
    <tr>
     <td>
				<div class="media-left media-middle"> <a class="icons" href="#"><img src="/assets/images/cust3.png" class="img-circle img-xs" alt=""></a> </div>
				<div class="media-left">
					<div class="pt-5"><a href="#" class="text-default text-semibold"><span>Bobby Clayton</span></a></div>
					<div class="text-muted text-size-small">gorczany.vida@kaycee.biz</div>
				</div>
			</td>
     
      <td class="text-right"><button class="btn btn-xs btn_white_table pr10 pl10"><i class="icon-primitive-dot txt_dark"></i> Invited</button> </td>
    </tr>
     <!--================================================-->
    <tr>
     <td>
				<div class="media-left media-middle"> <a class="icons" href="#"><img src="/assets/images/cust1.png" class="img-circle img-xs" alt=""></a> </div>
				<div class="media-left">
					<div class="pt-5"><a href="#" class="text-default text-semibold"><span>Dora Weber</span></a></div>
					<div class="text-muted text-size-small">carlo.johnston@yahoo.com</div>
				</div>
			</td>
     
      <td class="text-right"><button class="btn btn-xs btn_white_table pr10 pl10"><i class="icon-primitive-dot txt_dark"></i> Invited</button> </td>
    </tr>
    <!--================================================-->
    <tr>
     <td>
				<div class="media-left media-middle"> <a class="icons" href="#"><img src="/assets/images/cust2.png" class="img-circle img-xs" alt=""></a> </div>
				<div class="media-left">
					<div class="pt-5"><a href="#" class="text-default text-semibold"><span>Leah Clarke</span></a></div>
					<div class="text-muted text-size-small">wilderman.meghan@yahoo.com</div>
				</div>
			</td>
     
      <td class="text-right"><button class="btn btn-xs btn_white_table pr10 pl10"><i class="icon-primitive-dot txt_green"></i> Active</button> </td>
    </tr>
    
    <!--================================================-->
    <tr>
     <td>
				<div class="media-left media-middle"> <a class="icons" href="#"><img src="/assets/images/cust3.png" class="img-circle img-xs" alt=""></a> </div>
				<div class="media-left">
					<div class="pt-5"><a href="#" class="text-default text-semibold"><span>Bobby Clayton</span></a></div>
					<div class="text-muted text-size-small">gorczany.vida@kaycee.biz</div>
				</div>
			</td>
     
      <td class="text-right"><button class="btn btn-xs btn_white_table pr10 pl10"><i class="icon-primitive-dot txt_dark"></i> Invited</button> </td>
    </tr>
    
   
    
    
    
  </tbody>
</table>
                                                  
                                                  
                          
                          </div>
                        </div>
                      </div>
                    </div>
                       </div>
					  <!--===========TAB 5===========-->
					  <div class="tab-pane" id="right-icon-tab4"> </div>
					 </div>
					 <!--&&&&&&&&&&&& TABBED CONTENT  END &&&&&&&&&&-->
				
				
				
					
				
					
					
				  </div>



<!-- addTeamMember -->
<div id="addTeamMemberModal"  class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="post" name="frmaddTeamMemberModal" class="form-horizontal" id="frmaddTeamMemberModal" action="javascript:void();">
               <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Add Team Member</h5>
                </div>

                <div class="modal-body">
            <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">First Name</label>
                                <div class="">
                                    <input name="firstname" id="firstname" class="form-control" type="text" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Last Name</label>
                                <div class="">
                                    <input name="lastname" id="lastname" class="form-control" value="" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <div class="">
                                    <input name="email" id="email" value="" class="form-control" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Phone</label>
                                <div class="">
                                    <input name="phone" id="phone" value="" class="form-control" type="text" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Gender</label>
                                <div class="">
                                    <select class="form-control" name="gender" id="gender">
                                        <option>Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Country</label>
                                <div class="">
                                    <select class="form-control" name="countryCode" id="countryCode">
                                        <option value="">Select Country</option>
                                        <?php
                                        
                                        $countriesList = \App\Models\Admin\CountryModel::getCountriesList();
                                        foreach ($countriesList as $countryName) {
                                            ?>
                                            <option value="<?php echo $countryName->country_code; ?>"><?php echo $countryName->name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">City</label>
                                <div class="">
                                    <input name="cityName" id="cityName" value="" class="form-control" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">State</label>
                                <div class="">
                                    <input name="stateName" id="stateName" value="" class="form-control" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Zip Code</label>
                                <div class="">
                                    <input name="zipCode" id="zipCode" value="" class="form-control" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Social Profile</label>
                                <div class="">
                                    <input name="socialProfile" id="socialProfile" value="" class="form-control" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tags</label>
                                <div class="">
                                    <input name="tags" id="tags" value="" class="form-control" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Select Role</label>
                                <div class="">
                                    <select class="form-control" name="memberRole" id="memberRole" required>
                                        <option value="">Select Role</option>
                                        <?php
                                        if (!empty($oRoles)) {
                                            foreach ($oRoles as $oRole) {
                                                ?>
                                                <option value="<?php echo $oRole->id; ?>"><?php echo $oRole->role_name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer p40">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn dark_btn">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /addTeamMember -->


<div id="editRolePermissionModel" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="frmeditRolePermissionModel" class="form-horizontal" name="frmeditRolePermissionModel">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Manage Role Permission</h5>
        </div>
                <div class="modal-body" id="display_permission_form">
          
        </div>
                <hr>
                <div class="modal-footer p40">
                    <input type="hidden" name="role_id" id="hidRoleID" value="" />
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn dark_btn">Update</button>
          
        </div>
      </form>
    </div>
  </div>
</div>
			
		



<script>

	// top navigation fixed on scroll and side bar collasped
	
		$( window ).scroll( function () {
			var sc = $( window ).scrollTop();
			if ( sc > 100 ) {
				$( "#header-sroll" ).addClass( "small-header" );
			} else {
				$( "#header-sroll" ).removeClass( "small-header" );
			}
		} );

		function smallMenu() {
			if ( $( window ).width() < 1600 ) {
				$( 'body' ).addClass( 'sidebar-xs' );
			} else {
				$( 'body' ).removeClass( 'sidebar-xs' );
			}
		}

		$( document ).ready( function () {
			smallMenu();

			window.onresize = function () {
				smallMenu();
			};
		} );


    $(document).ready(function () {
        $('.addTeamMember').click(function () {
            $('#addTeamMemberModal').modal();
            var roleId = $(this).attr('roleId');
            $('#memberRole option[value="'+roleId+'"]').attr("selected", "selected");
        });


        $('#frmaddTeamMemberModal').on('submit', function () {
            $('.overlaynew').show();
            var formdata = $("#frmaddTeamMemberModal").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/team/addTeamMember'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = '';
                    } else if (data.status == 'error') {
                        $('.overlaynew').hide();
                        $("#addMemberValidation").html(data.msg).show();
                        setTimeout(function () {
                            $("#addMemberValidation").html("").hide();
                        }, 5000);
                    }

                }
            });
            return false;
        });


        $(document).on("click", ".managerole", function () {
            //$('.overlaynew').show();
            var roleID = $(this).attr('role_id');
            $.ajax({
                url: '<?php echo base_url('admin/team/manageRolePermission'); ?>',
                type: "POST",
                data: {'role_id': roleID,_token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#display_permission_form").html(data.permission_form);
                        $("#hidRoleID").val(roleID);
                        $('.overlaynew').hide();
                        $("#editRolePermissionModel").modal();
            } else {
                        alertMessage('Error: Some thing wrong!');
          }
        }
       });
      });


        $(document).on("submit", "#frmeditRolePermissionModel", function () {
            //$('.overlaynew').show();
            var formdata = $("#frmeditRolePermissionModel").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/team/updateRolePermission'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = '';
            } else if (data.status == 'error' && data.type == 'duplicate') {
                        $('.overlaynew').hide();
                        $("#editRoleValidation").html(data.msg).show();
                        setTimeout(function () {
                            $("#editRoleValidation").html("").hide();
            }, 5000);
          }
        }
      });
            return false;
    });


    $(document).on('change', '.choosePermission', function () {
            var selectedText = $(this).attr('chkText');
            if (selectedText == 'All Access') {
                var selectedVal = $(this).val();
                var selectedPerm = $("select[name='permission_val_" + selectedVal + "']").val();
        
                if (this.checked) {
                    $('.choosePermissionVal').each(function () {
                        $(this).val(selectedPerm);
          });
                    $('.choosePermission').each(function () {
                        this.checked = true;
          });
          } else {
                    $('.choosePermission').each(function () {
                        this.checked = false;
          });
        }
        
        
      }
    });
    
    
        $(document).on('change', '.choosePermissionVal', function () {
            var selectedText = $(this).attr('chkText');
            if (selectedText == 'All Access') {
                var selectedVal = $(this).val();
                permID = $(this).attr("name");
                permID = permID.replace('permission_val_', '');
                $(".choosePermission").each(function () {
                    if (($(this).prop("checked") == true) && ($(this).val() == permID)) {
                        $('.choosePermissionVal').each(function () {
                            $(this).val(selectedVal);
            });
          }
        });
        
      }
    });




    });
	

	
	</script>
	



      
      
   <script>

	   
	   
	   
	   
	   
$("#list").click(function(){
    $(".user_display").hide(0);
	$(".user_display_table").show(0);
});
$("#grid").click(function(){
    $(".user_display_table").hide(0);
	$(".user_display").show(0);
});
	  
	   
	   
$("#list_team").click(function(){
    $(".listteam_grid").hide(0);
	$(".listteam_table").show(0);
});
$("#grid_team").click(function(){
    $(".listteam_grid").show(0);
	$(".listteam_table").hide(0);
});
	   
	   
	
	</script>   
 

@endsection    