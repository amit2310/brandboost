<?php
if (!empty($oAutomationLists)) {
    foreach ($oAutomationLists as $oAutomationList) {
        $aListIDs[] = $oAutomationList->list_id;
    }
}

$newolists = array();

foreach ($oLists as $key => $value) {
    $newolists[$value->id][] = $value;
}
?>
<div class="row" id="listSection" <?php if ($oBroadcast->audience_type != 'lists'): ?>style="display:none;"<?php endif; ?>>
	  <div class="col-md-12">
		<div class="panel panel-flat">
		  <div class="panel-heading"> 


		  	  <span class="pull-left">
			  <h6 class="panel-title">Lists <button class="btn btn-xs btn_white_table pr10 ml10 txt_blue_sky2" style="font-weight: 400!important; background: #ebf6fe!important"> <span id="totalListCount"><?php echo count($aListIDs); ?> </span> list added</button>
			  <button class="btn btn-xs btn_white_table pr10 ml10 txt_blue_sky2" style="font-weight: 400!important; background: #ebf6fe!important"><span id="totalListContactCount"> <?php echo $totalSubscribers; ?>  </span> contact added</button>
			  <button class="btn btn-xs btn_white_table pr10 ml10 txt_blue_sky2" style="font-weight: 400!important; background: #ebf6fe!important"> <span id="totalListDuplicateCount"> <?php echo $duplicateSubscriber; ?> </span> duplicate contact</button>
			 <!--  <a href="javascript:void(0);" class="btn btn-xs btn_white_table pr10 ml10 txt_blue_sky2 selectAudience" >Change Selection</a> -->
				</h6>
			  </span>


			  <div class="heading-elements">
			    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
					<input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
					<div class="form-control-feedback">
						<i class=""><img src="<?php echo base_url(); ?>assets/images/icon_search.png" width="14"></i>
					</div>
				</div>
				<div class="table_action_tool">
					<!-- <a href="#" class="brig pr-15">Updated just now &nbsp; <i class=""><img src="<?php echo base_url(); ?>assets/images/icon_refresh.png"></i></a>
					<a href="#"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_calender.png"></i></a>
					<a href="#"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_download.png"></i></a>
					<a href="#"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_upload.png"></i></a>
					<a href="#"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_edit.png"></i></a> -->
					 <a href="javascript:void(0);" class="btn btn-xs btn_white_table pr10 ml10 txt_blue_sky2 selectAudience" >Change Selection</a>
				</div>
			</div>
			</div>
		  <div class="panel-body p0 bkg_white">
			<table class="table datatable-basic">
			  <thead>
			    <tr>
			      <th style="display: none;"></th>
                  <th style="display: none;"></th>
			      <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_list_small.png"/></i>List</th>
			      <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_name.png"/></i>Contacts</th>
			      <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_created.png"/></i>Created</th>
			      <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_email_small.png"/></i>Email</th>
			      <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_sms.png"/></i>SMS</th>
			      <!-- <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_out.png"/></i>Out</th> -->
			      <th><i class="icon-calendar"></i>Last Incoming Lead</th>
			      <th class="text-right"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_action.png"/></i>Action</th>
			    </tr>
			  </thead>
			  <tbody>
			    
			<!--=======================-->
			<?php
            foreach ($newolists as $oList):
                $totEmailCount = 0;
                $totSMSCount = 0;
                $totUnsubscribeCount = 0;
                if (!empty($oList[0]->l_list_id)) {
                    $totAll = count($oList);
                } else {
                    $totAll = 0;
                }

                //pre($oList);
                $lastList = end($oList);
                //pre($lastList->l_created);
                if(!empty($lastList->l_created)) {
                    $lastListTime = timeAgo($lastList->l_created);
                }
                else {
                    $lastListTime = '<div class="media-left">
                              <div class="">
                                <span class="text-muted text-size-small">[No Data]</span>                                                          </div>
                            </div>';
                }

                foreach ($oList as $value) {

                    if (!empty($value->l_email)) {
                        $totEmailCount++;
                    }
                    if (!empty($value->l_phone)) {
                        $totSMSCount++;
                    }
                }
                $oList = $oList[0];

                $totalContacts = $totAll;
                $totalEmailGraph = 0;
                $totalSMSGraph = 0;
                $totalUnsubGraph = 0;

                $totalEmailGraph = $totEmailCount * 100 / $totalContacts;
                $totalEmailGraph = ceil($totalEmailGraph);

                $totalSMSGraph = $totSMSCount * 100 / $totalContacts;
                $totalSMSGraph = ceil($totalSMSGraph);

                $totalUnsubGraph = $totUnsubscribeCount * 100 / $totalContacts;
                $totalUnsubGraph = ceil($totalUnsubGraph);

                ?>
				<tr>
				  <td style="display: none;"><?php echo date('m/d/Y', strtotime($aTag->tag_created)); ?></td>
                  <td style="display: none;"><?php echo $aTag->tagid; ?></td>
				  <td><div class="media-left brig pr10">
				      <label class="custmo_checkbox ">
				        <input type="checkbox" class="updateList" name="list_id[]" id="list_id" value="<?php echo $oList->id; ?>" <?php if (in_array($oList->id, $aListIDs)): ?> checked="checked"<?php endif; ?> >
				        <span class="custmo_checkmark sblue"></span> </label>
				    </div>
				    <div class="media-left media-middle pl10"> <a class="icons s24" href="#"><img src="<?php echo base_url(); ?>assets/images/icon_list.png" class="img-circle img-xs" alt=""></a> </div>
				    <div class="media-left">
				      <div class=""><a href="#" class="text-default text-semibold"><?php echo $oList->list_name; ?></a> </div>
				    </div></td>
				  <td>
				  	
				  	<div class="media-left">
				      <div class="">
				      	<?php if($totAll > 0) { ?>
					      	<a href="<?php echo base_url() . 'admin/lists/getListContacts?list_id=' . $oList->id; ?>" class="text-default text-semibold"><span class="txt_grey"><?php echo $totAll; ?></span></a> 
					      	<?php
					      } 
					      else {
						      ?><span class="text-muted text-size-small">[No Data]</span><?php
						  }
				      	 ?>
				      </div>
				    </div></td>
				  <td><div class="media-left text-right">
				      <div class=""><a href="#" class="txt_grey"><?php echo dataFormat($oList->list_created); ?> <span class="txt_grey"><?php echo date('h:i A', strtotime($oList->list_created)); ?></span></a> </div>
				    </div></td>
				    
				    
				  <!-- <td><div class="media-left">
				      <img width="16" src="<?php echo base_url(); ?>assets/images/donut_small3.png"/>
				    </div>
				    <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">582</a> </div></td> -->
				  
				  <td>
				  	<?php /*if($totEmailCount > 0) {?>
				  	<div class="media-left">
				      <img width="16" src="<?php echo base_url(); ?>assets/images/donut_small1.png"/>
				    </div>
				    <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold"><?php echo $totEmailCount; ?></a> </div>
				    <?php }
				    else {
					    ?><span class="text-muted text-size-small">[No Data]</span><?php
					} */ ?>

						<?php
	                        $addPC = '';
	                        if ($totalEmailGraph > 50) {
	                            $addPC = 'over50';
	                        }
                        ?>
                        <div class="media-left">
                            <div class="progress-circle <?php echo $addPC; ?> green cp<?php echo $totalEmailGraph; ?>">
                                <div class="left-half-clipper">
                                    <div class="first50-bar"></div>
                                    <div class="value-bar"></div>
                                </div>
                            </div>
                        </div>
                        <div class="media-left">
                            <div data-toggle="tooltip" title="<?php echo $totEmailCount; ?> have email address out of <?php echo $totalContacts; ?> contacts" data-placement="top">
                                <a href="javascript:void(0);" class="text-default text-semibold"><?php echo $totEmailCount; ?></a>
                                <?php if ($newEmails > 0): ?>    
                                    <?php echo '<span style="color:#FF0000;"> (' . $newEmails . ' new)</span>'; ?>    
                                <?php endif; ?>    

                            </div>
                        </div>
				  </td>
				  <td>
				  	<?php /*if($totSMSCount > 0) { ?>
				  	<div class="media-left">
				      <img width="16" src="<?php echo base_url(); ?>assets/images/donut_small2.png"/>
				    </div>
				    <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold"><?php echo $totSMSCount; ?></a> </div>
				    <?php }
				    else{ 
				    	?><span class="text-muted text-size-small">[No Data]</span><?php
				 	}*/ ?>

					 	<?php
	                        $addPC = '';
	                        if ($totalSMSGraph > 50) {
	                            $addPC = 'over50';
                        }
                        ?>
                        <div class="media-left">
                            <div class="progress-circle <?php echo $addPC; ?> grey cp<?php echo $totalSMSGraph; ?>">
                                <div class="left-half-clipper">
                                    <div class="first50-bar"></div>
                                    <div class="value-bar"></div>
                                </div>
                            </div>
                        </div>
                        <div class="media-left">
                            <div data-toggle="tooltip" title="<?php echo $totSMSCount; ?> have sms out of <?php echo $totalContacts; ?> contacts" data-placement="top">
                                <a href="javascript:void(0);" class="text-default text-semibold"><?php echo $totSMSCount; ?></a>
                                <?php if ($newSMS > 0): ?>    
                                    <?php echo '<span style="color:#FF0000;"> (' . $newSMS . ' new)</span>'; ?>    
                                <?php endif; ?>    

                            </div>
                        </div>

				  </td>
				
				  <td><?php echo $lastListTime; ?></td>
				  <td class="text-right">
				  	<div class="media-left pull-right">
				      <div class="tdropdown ml10"> <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a>
				      
				        <ul class="dropdown-menu dropdown-menu-right more_act width-200">
				        	<a href="#" class="dropdown_close">X</a>
                            <li><a href="javascript:void(0);" list_id="<?php echo $oList->id; ?>" class="addModuleContact" data-modulename="list" data-moduleaccountid="<?php echo $oList->id; ?>"><i class="icon-gear"></i> Add Contact</a></li>
                            <li><a href="javascript:void(0);" list_id="<?php echo $oList->id; ?>" class="importModuleContact" data-modulename="list" data-moduleaccountid="<?php echo $oList->id; ?>" data-redirect="<?php echo base_url(); ?>admin/broadcast/edit/<?php echo $oList->id; ?>"><i class="icon-gear"></i> Import Contacts</a></li>

                            <li>
                                <a href="{{ base_url() }}admin/subscriber/exportSubscriberCSV?module_name=list&module_account_id=<?php echo $oList->id; ?>" list_id="<?php echo $oList->id; ?>" class="exportContact" data-modulename="list" data-moduleaccountid="<?php echo $oList->id; ?>"><i class="icon-gear"></i> Export Contacts</a>
                            </li>
                            <li><a target="_blank" href="<?php echo base_url(); ?>admin/lists/getListContacts?list_id=<?php echo $oList->id; ?>"><i class="icon-gear"></i> View Contacts</a></li>
                            <li><a href="javascript:void(0);" list_id="<?php echo $oList->id; ?>" class="editlist"><i class="icon-pencil"></i> Edit</a></li>
                            <li><a href="javascript:void(0);" list_id="<?php echo $oList->id; ?>" class="deletelist"><i class="icon-trash"></i> Delete</a></li>
                        </ul>

				      </div>
				    </div>
				    <div class="media-left pull-right">
				      <div class="">
				      	<a href="javascript:void(0);" list_id="<?php echo $oList->id; ?>" class="addModuleContact text-default text-semibold bbotb" data-modulename="list" data-moduleaccountid="<?php echo $oList->id; ?>"><span class="txt_blue_sky2">Add Contacts</span></a> </div>
				    </div>
				</td>
				</tr>
			<?php endforeach; ?>
			<!--=======================-->
			   
			  </tbody>
			</table>


		  </div>
		</div>
	  </div>
	</div>
						
						
					
		