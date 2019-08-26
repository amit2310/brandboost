<div class="content offsite_feed">
<?php //pre($aData);
//pre($aData['open']);


?>
    <!-- Dashboard content -->
    <div class="row">
        <div class="col-lg-12">
            <!-- Marketing campaigns -->
            <div class="panel panel-flat">
                <div class="table-responsive">
                    <table class="table datatable-sorting text-nowrap">
                        <thead>
                            <tr>
                                <th class="col-md-2">Sent</th>
                                <th class="col-md-2">Delivered</th>
                                <th class="col-md-2">Open</th>
                                <th class="col-md-2">Click</th>
                                <th class="col-md-2">Bounce</th>
                                <th class="col-md-2">Dropped</th>
                                <th class="col-md-2">Unsubscribe</th>
                                <th class="col-md-2">Spam Report</th>
                                
                            </tr>
                        </thead>
                        <tbody id="listsubscribers_table">

                            <?php
                            if (!empty($aData)) {
                                    ?>
                                    <tr>
                                        <td class="">
                                            <?php echo $aData['processed']['TotalCount'];?>
                                        </td>
                                        
                                        <td class="">
                                            <?php echo $aData['delivered']['TotalCount'];?>
                                        </td>
                                        
                                        <td class="">
                                            Total: <?php echo $aData['open']['TotalCount'];?><br>
                                            Unique: <?php echo $aData['open']['UniqueCount'];?><br>
                                            Duplicate: <?php echo $aData['open']['DuplicateCount'];?>
                                        </td>
                                        
                                        <td class="">
                                            Total: <?php echo $aData['click']['TotalCount'];?><br>
                                            Unique: <?php echo $aData['click']['UniqueCount'];?><br>
                                            Duplicate: <?php echo $aData['click']['DuplicateCount'];?>
                                        </td>
                                        
                                        <td class="">
                                            Total: <?php echo $aData['bounce']['TotalCount'];?><br>
                                            
                                        </td>
                                        
                                        <td class="">
                                            Total: <?php echo $aData['dropped']['TotalCount'];?><br>
                                            
                                        </td>
                                        
                                        <td class="">
                                            Total: <?php echo $aData['unsubscribe']['TotalCount'];?><br>
                                            
                                        </td>
                                        
                                        <td class="">
                                            Total: <?php echo $aData['spam_report']['TotalCount'];?><br>
                                            
                                        </td>
                                        
                                    </tr>
                                    <?php
                            }
                                    ?>
                                   

                        </tbody>
                    </table>
                </div>
            </div>
            <div align="right" id="pagination_link"></div>
            <!-- /marketing campaigns -->
        </div>
    </div>
    <!-- /dashboard content -->

</div>
<!-- /content area -->






</div>
