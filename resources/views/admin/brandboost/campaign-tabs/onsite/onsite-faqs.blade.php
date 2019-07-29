<?php list($canRead, $canWrite) = fetchPermissions('Onsite Campaign');
   //pre($faQData);
if(!empty($oQuestion))
{
$oQuestionstatus  = $oQuestion->status!='' ? $oQuestion->status : '';
}
else
{
   $oQuestionstatus ="";
}

   ?>
<!--===========TAB 3=====FAQ'S======-->
<div class="tab-pane" id="right-icon-tab2">
   <div class="row">
      <div class="col-md-12">
         <div style="margin: 0;" class="panel panel-flat">
            <?php if (!empty($faQData)): ?>
             @include("admin.components.smart-popup.smart-faq-widget")
            <?php endif;
               ?>
            <div class="panel-heading">
               <h6 class="panel-title">FAQ List</h6>
               <div class="heading-elements">
                  <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                     <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                     <div class="form-control-feedback">
                        <i class=""><img src="/assets/images/icon_search.png" width="14"></i>
                     </div>
                  </div>
                  <div class="table_action_tool" style="display:none">
                     <a href="#" class="brig pr-15">Updated just now &nbsp; <i class=""><img src="/assets/images/icon_refresh.png"></i></a>
                     <a href="#"><i class=""><img src="/assets/images/icon_calender.png"></i></a>
                     <a href="#"><i class=""><img src="/assets/images/icon_download.png"></i></a>
                     <a href="#"><i class=""><img src="/assets/images/icon_upload.png"></i></a>
                     <a href="#"><i class=""><img src="/assets/images/icon_edit.png"></i></a>
                  </div>
               </div>
            </div>
            <div class="panel-body p0">
               <table class="table datatable-basic">
                  <thead>
                     <tr>
						 <th style="display:none"></th> 
						 <th style="display:none"></th>
                        <th><i class=""><img src="/assets/images/icon_name.png"></i>Questions</th>
                        <th><i class=""><img src="/assets/images/icon_device.png"></i>Answer</th>
                        <th><i class=""><img src="assets/images/icon_status.png"></i>Status</th>
                        <th>&nbsp;</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php  foreach ($faQData as $faQDataRow) { ?>
                     <!--================================================-->
                     <tr>
						 <td style="display:none"></td> 
						 <td style="display:none"><?php echo $faQDataRow->id; ?></td>
                        <td class="viewFaqSmartPopup" faQListid="<?php echo $faQDataRow->id; ?>">
                           <div class="media-left"> <a class="icons red" href="#"><i class="icon-question7 txt_dred2"></i></a> </div>
                           <div class="media-left">
                              <div class=""><a href="javascript:void(0)" class="text-default text-semibold bbot"><?php echo setStringLimit($faQDataRow->question,'40'); ?></a> </div>
                           </div> 
                        </td>
                        <td>
                           <div class="text-muted viewFaqSmartPopup" faQListid="<?php echo $faQDataRow->id; ?>"><?php echo setStringLimit($faQDataRow->answer,'95'); ?></div>
                        </td>
                        <td>
                           <div class="tdropdown ml10">
                              <?php
                                 if ($faQDataRow->status == 0) {
                                     echo '<i class="icon-primitive-dot txt_red fsize16"></i> ';
                                 } else if ($faQDataRow->status == 2) {
                                     echo '<i class="icon-primitive-dot txt_grey fsize16"></i> ';
                                 } else {
                                     echo '<i class="icon-primitive-dot txt_green fsize16"></i> ';
                                 }
                                 ?>
                              <a class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown">
                              <?php
                                 if ($faQDataRow->status == 0) {
                                     echo 'Inactive';
                                 } else if ($faQDataRow->status == 2) {
                                     echo 'Pending';
                                 } else {
                                     echo 'Active';
                                 }
                                 ?>
                              </a>
                              <ul class="dropdown-menu dropdown-menu-right status">
                                 <?php
                                    if ($faQDataRow->status == 1) {
                                        echo "<li><a faq_id='" . $faQDataRow->id . "' change_status = '0' class='chg_status red'><i class='icon-primitive-dot txt_red'></i> Inactive</a></li>";
                                    } else if ($oQuestionstatus == 2) {
                                        echo "<li><a faq_id='" . $faQDataRow->id . "' change_status = '1' class='chg_status green'><i class='icon-primitive-dot txt_green'></i> Active</a></li>";
                                        echo "<li><a faq_id='" . $faQDataRow->id . "' change_status = '0' class='chg_status red'><i class='icon-primitive-dot txt_red'></i> Inactive</a></li>";
                                    } else {
                                        echo "<li><a faq_id='" . $faQDataRow->id . "' change_status = '1' class='chg_status green'><i class='icon-primitive-dot txt_green'></i> Active</a></li>";
                                    }
                                    ?>
                              </ul>
                           </div>
                        </td>
                        <td>
                           <div class="media-left pull-right text-right">
                              <div class="tdropdown ml10 open">
                                 <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><img src="/assets/images/more.svg"></a>
                                 <ul class="dropdown-menu dropdown-menu-right more_act">
                                    <a href="#" class="dropdown_close">X</a>
                                    <li><a class="viewFaqSmartPopup" faQListid="<?php echo $faQDataRow->id; ?>" href="javascript:void(0)"><i class="icon-stats-growth2"></i>Edit</a> </li>
                                    <li><a class="deleteFaq" faq_id="<?php echo $faQDataRow->id; ?>" href="javascript:void(0)"><i class="icon-bin"></i> Delete</a> </li>
                                 </ul>
                              </div>
                           </div>
                        </td>
                     </tr>
                     <!--================================================-->
                     <?php } ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>