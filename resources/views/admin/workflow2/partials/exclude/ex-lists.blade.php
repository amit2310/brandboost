<?php
$oExcludedLists = $aContactSelectionData['oExcludeLists'];
$aListIDs = array();
if (!empty($oExcludedLists)) {
    foreach ($oExcludedLists as $oExcludedList) {
        $aListIDs[] = $oExcludedList->list_id;
    }
}

$newolists = array();
$oLists = $aContactSelectionData['oLists'];
foreach ($oLists as $key => $value) {
    $newolists[$value->id][] = $value;
}
//pre($newolists);
?>
<div class="panel panel-flat wfSwitchMenu" id="wfExcludeFromList" style="display:none;">
    <div class="panel-heading">
        <h6 class="panel-title pull-left"><a style="color: #5e729d!important;" class="backtoExcludeOptionMenu" href="javascript:void(0);"> <i class=""><img width="20" src="<?php echo base_url(); ?>assets/images/back_icon.png"/></i> &nbsp; Back</a></h6>
        <h6 class="panel-title pull-right">Exclude Contacts</h6>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body pt0 bkg_white" style="padding:0;">
        <div class="col-md-12">

            <div class="p20 bbot">
                <h3 class="fsize20 fw500 txt_dark m0">Exclude From Lists <span id="totalExcludeListCount"><?php echo count($aListIDs);?></span></h3>

            </div>
            <div class="alert alert-danger" id="validateAddedContacts" style="display:none;">You did not add any contacts yet</div>



            <div class="p0">

                <table class="table" id="listExcludeLists">
                    <thead>
                        <tr>
                            <th style="display: none;"></th>
                            <th style="display: none;"></th>
                            <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_list_small.png"></i>List Name</th>
                            <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_name.png"></i>Contacts</th>
                            

                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                    foreach ($newolists as $oList):
                        if (!empty($oList[0]->l_list_id)) {
                            $totAll = count($oList);
                        } else {
                            $totAll = 0;
                        }
                        $oList = $oList[0];
                        ?>

                        <tr role="row">
                            <td style="display: none;"><?php echo date('m/d/Y', strtotime($oList->list_created)); ?></td>
                            <td style="display: none;" class="sorting_1"><?php echo $oList->id; ?></td>
                            <td>
                                <div class="media-left brig pr10">
                                    <label class="custmo_checkbox ">
                                        <input type="checkbox" class="addListToExcludeCampaign" name="list_id[]" value="<?php echo $oList->id; ?>" <?php if (in_array($oList->id, $aListIDs)): ?> checked="checked"<?php endif; ?>>
                                        <span class="custmo_checkmark sblue"></span> 
                                    </label>
                                </div>
                                <div class="media-left media-middle pl10"> 
                                    <a class="icons s24" href="#"><img src="<?php echo base_url();?>assets/images/icon_list.png" class="img-circle img-xs" alt=""></a>
                                </div>
                                <div class="media-left">
                                    <div class=""><a href="javascript:void(0);" class="text-default text-semibold"><?php echo $oList->list_name; ?></a> </div>
                                </div>
                            </td>
                            <td class="text-right">
                                <div class="media-left text-right pull-right">
                                    <div class=""><a href="#" class="txt_grey"><?php echo $totAll;?></a> </div>
                                </div>
                            </td>
                           
                        </tr>
                        
                        
                        <?php endforeach; ?> 

                        

                        

                    </tbody>
                </table>

            </div>


        </div>
    </div>


</div>
<script>
    var tableId = 'listExcludeLists';
    custom_data_table(tableId);
</script>