<div class="panel-heading">
    <h6 class="panel-title"> Subscriber Lists</h6>
    <div class="heading-elements">
        <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
            <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
            <div class="form-control-feedback">
                <i class="icon-search4"></i>
            </div>
        </div>
        <div class="table_action_tool">
            <a href="#"><i class="icon-calendar52"></i></a>
            <a href="javascript:void(0);" class="editDataList"><i class="icon-pencil"></i></a>
            <a href="javascript:void(0);" style="display: none;" id="deleteButtonEmailAutomation" class="custom_action_box"><i class="icon-trash position-left"></i></a>

        </div>

    </div>
</div>

<div class="panel-body p0">

    <table class="table datatable-basic_new" id="<?php echo $tableId; ?>">
        <thead>
            <tr>
                <th style="display: none;"></th>
                <th style="display: none;"></th>
                <th style="display: none;" class="nosort editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
                <th><i class="icon-user"></i>Name</th>
                <th><i class="icon-display"></i>Phone</th>
                <th><i class="icon-calendar"></i>Created</th>
                <th class="text-center"><i class="fa fa-dot-circle-o"></i>Status</th>
            </tr>
        </thead>
        <tbody>

            <?php
            if (count($delivered) > 0) {

                foreach ($delivered as $data) {
                    if (!empty($data->email)) {
                        ?>
                        <tr id="append-<?php echo $data->tracking_id; ?>" class="selectedClass">
                            <td style="display: none;"><?php echo date('m/d/Y', strtotime($data->e_created)); ?></td>
                            <td style="display: none;"><?php echo $data->tracking_id; ?></td>
                            <td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" id="chk<?php echo $data->tracking_id; ?>" value="<?php echo $data->tracking_id; ?>" ><span class="custmo_checkmark"></span></label></td>
                            <td>
                                <div class="media-left media-middle"> <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/userp.png" class="img-circle img-xs" alt=""></a> </div>


                                <div class="media-left">
                                    <div class="pt-5"><a style="cursor: pointer;" class="text-default text-semibold"><span><?php echo $data->firstname; ?> <?php echo $data->lastname; ?></span> <img class="flags" src="<?php echo base_url(); ?>assets/images/flags/us.png"/></a></div>
                                    <div class="text-muted text-size-small"><?php echo $data->email; ?></div>

                                </div>
                            </td>
                            <td>
                                <div class="media-left">
                                    <div class="pt-5"><a href="javascript:void(0);" class="text-default text-semibold"><?php echo $data->phone == '' ? '<span style="color:#999999">Phone Unavailable</span>' : mobileNoFormat($data->phone); ?></a></div>
                                    <div class="text-muted text-size-small">Chat</div>
                                </div>

                            </td>
                            <td>
                                <div class="media-left">
                                    <div class="pt-5"><a href="#" class="text-default text-semibold"><?php //echo date('d M Y', strtotime($oAutomation->created));             ?><?php echo dataFormat($data->e_created); ?></a></div>
                                    <div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($data->e_created)); ?></div>
                                </div>
                            </td>

                            <td class="text-center">

                                <?php
                                if ($data->status == '1') {
                                    echo '<i class="icon-primitive-dot txt_green fsize16"></i> ';
                                } else {
                                    echo '<i class="icon-primitive-dot txt_red fsize16"></i> ';
                                }
                                ?>
                                <a class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown">
                                    <?php
                                    if ($data->status == '1') {
                                        echo 'Active';
                                    } else {
                                        echo 'Inactive';
                                    }
                                    ?>

                                </a>
                                <ul class="dropdown-menu dropdown-menu-right status">

                                </ul>

                            </td>
                        </tr>
                        <?php
                    }
                }
            }
            ?>	
        </tbody>
    </table>
</div>

<script type="text/javascript">

    $(document).ready(function () {

        var tableId = '<?php echo $tableId; ?>';
        var tableBase = custom_data_table(tableId);

    });
</script>

