
<div class="tab-pane <?php if($seletedTab=='history'):?>active<?php endif;?>" id="right-icon-tab1">
    <div class="row">
        <div class="col-md-12">
            <div style="margin: 0;" class="panel panel-flat">
                <div class="panel-heading"> <span class="pull-left">
                        <h6 class="panel-title"><?php echo count($oCrValuesHistory); ?> Credit Properties</h6>
                    </span>
                    <div class="heading-elements">
                        <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                            <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                            <div class="form-control-feedback"> <i class="icon-search4"></i> </div>
                        </div>
                    </div>
                </div>

                <div class="panel-body p0">
                    <table class="table datatable-basic datatable-sorting">
                        <thead>
                            <tr>
                                <th style="display:none;"></th>
                                <th style="display:none;"></th>
                                <th><i class="icon-user"></i> Property Name</th>
                                <th><i class="icon-user"></i> Property Key</th>
                                <th class="text-center"><i class="icon-user"></i> Credit</th>
                                <th><i class="icon-calendar"></i>Last Updated</th>
                                
                            </tr>
                        </thead>
                        <tbody>

                            <!--=======================-->
                            <?php foreach ($oCrValuesHistory as $oCr) { ?>
                                <tr>
                                    <td style="display:none;"></td>
                                    <td style="display:none;"></td>
                                    <td>
                                        <?php echo $oCr->feature_name; ?>
                                    </td>
                                    
                                    <td>
                                        <?php echo $oCr->feature_key; ?>
                                    </td>

                                    <td class="text-center">
                                        <?php echo $oCr->credit_value; ?>
                                    </td>

                                    <td>
                                        <div class="media-left">
                                            <div class="pt-5"><a href="#" class="text-default text-semibold"><?php echo date('d M Y', strtotime($oCr->created)); ?></a></div>
                                            <div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oCr->created)); ?></div>
                                        </div>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
