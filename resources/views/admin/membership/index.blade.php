@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')

<div class="content">
    <div class="row mb20">
        <div class="col-lg-12 text-right">

            <a style="margin-left: 20px;" data-toggle="modal" data-target="#membershipLevel" class="btn bl_cust_btn btn-default" href="#"><i class="icon-make-group position-left"></i> ADD MEMBERSHIP LEVEL</a>
        </div>
    </div>


    <div class="row mb20">
        <div class="col-lg-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Brand Boost Membership</h6>
                    <div class="heading-elements">
                        <button type="button" class="btn btn-link daterange-ranges heading-btn text-semibold">
                            <i class="icon-calendar3 position-left"></i> <span></span> <b class="caret"></b>
                        </button>
                    </div>
                </div>

                <div class="panel-body">		
                    <div class="tabbable">
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li class="active"><a href="#right-icon-tab0" data-toggle="tab">Membership Levels <i class="icon-file-text position-right"></i></a></li>
                            <li><a href="#right-icon-tab1" data-toggle="tab">Topup Membership <i class="icon-menu7 position-right"></i></a></li>
                            <li><a href="#right-icon-tab2" data-toggle="tab">Topup <i class="icon-menu7 position-right"></i></a></li>
                        </ul>
                        <div class="tab-content"> 
                            <!--########################TAB 0 ##########################-->
                            <div class="tab-pane active" id="right-icon-tab0">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <!-- Marketing campaigns -->
                                        <!--<div class="panel panel-flat">-->
                                        <div style="margin: 0 -20px;">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <h6 class="panel-title">Membership Levels</h6>
                                                        <?php
                                                        $membershipLevel = 0;
                                                        foreach ($membership_data as $data) {

                                                            if ($data->type == 'membership') {
                                                                $membershipLevel++;
                                                            }
                                                        }
                                                        ?>
                                                        <div class="heading-elements">
                                                            <span class="label bg-success heading-text"><?php echo $membershipLevel; ?> Membership Level</span>
                                                            <ul class="icons-list">
                                                                <li class="dropdown">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i> <span class="caret"></span></a>
                                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                                        <li><a href="#"><i class="icon-sync"></i> Update data</a></li>
                                                                        <li><a href="#"><i class="icon-list-unordered"></i> Detailed log</a></li>
                                                                        <li><a href="#"><i class="icon-pie5"></i> Statistics</a></li>
                                                                        <li class="divider"></li>
                                                                        <li><a href="#"><i class="icon-cross3"></i> Clear list</a></li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="table-responsive">
                                                <div class="custom_action_box">
                                                    <button id="deleteMembershipBtn" class="btn btn-danger btn-xs lgrey">Delete</button>
                                                </div>
                                                <input name="min" id="min" type="hidden">
                                                <input name="max" id="max" type="hidden">
                                                <table class="table text-nowrap datatable-sorting blef0 brig0 membershipTable" id="membershipLevelN">
                                                    <thead>
                                                        <tr>
                                                            <th style="display: none;"></th>
                                                            <th style="display: none;"></th>
                                                            <th style="width: 40px!important;" class="nosort"><input type="checkbox" name="checkAll[]" class="" id="checkAll" ></th>
                                                            <th>Level Name</th>
                                                            <th>Price </th>
                                                            <th>Credits </th>
                                                            <th>Contacts Limit </th>
                                                            <!--<th>Email Limit</th>
                                                            <th>SMS Limit</th>
                                                            <th>Text Review Limit </th>
                                                            <th>Video Review Limit </th>-->
                                                            <th class="col-md-2">Date Created</th>
                                                            <th class="text-center">Status </th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                        foreach ($membership_data as $data) {
                                                            if ($data->type == 'membership') {
                                                                ?>
                                                                <tr id="append-<?php echo $data->id; ?>" class="selectedClass">
                                                                    <td style="display: none;"><?php echo date('m/d/Y', strtotime($data->created)); ?></td>
                                                                    <td style="display: none;"><?php echo $data->id; ?></td>
                                                                    <td style="width: 40px!important;"><input type="checkbox" name="checkRows[]" class="checkRows" id="chk<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" ></td>
                                                                    <td><?php echo $data->level_name; ?></td>
                                                                    <td>
                                                                        $<?php echo number_format($data->price, 2); ?>/<?php
                                                                        if ($data->subs_cycle == 'monthly' || $data->subs_cycle == 'month') {
                                                                            echo 'Month';
                                                                        } else if ($data->subs_cycle == 'yearly' || $data->subs_cycle == 'year') {
                                                                            echo 'Year';
                                                                        } else if ($data->subs_cycle == 'weekly' || $data->subs_cycle == 'week') {
                                                                            echo 'Week';
                                                                        } else if ($data->subs_cycle == 'bi-yearly') {
                                                                            echo '2 Year';
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td><?php echo number_format($data->credits); ?></td>
                                                                    <td><?php echo number_format($data->contact_limit); ?></td>
                                                                    <!--<td><?php echo number_format($data->email_limit, 0); ?></td>
                                                                    <td><?php echo number_format($data->sms_limit, 0); ?></td>
                                                                    <td><?php echo number_format($data->text_review_limit, 0); ?></td>
                                                                    <td><?php echo number_format($data->video_review_limit, 0); ?></td>-->
                                                                    <td><h6 class="text-semibold"><?php echo date('M d, Y', strtotime($data->created)); ?><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($data->created)) . ' (' . timeAgo($data->created) . ')'; ?></div></h6></td>
                                                                    <td class="text-center">
                                                                        <?php
                                                                        if ($data->status == 1) {
                                                                            ?><span class="label bg-success">Active</span><?php
                                                                        } else {
                                                                            ?><span class="label bg-danger">Inactive</span><?php
                                                                        }
                                                                        ?></td>
                                                                    <td class="text-center">
                                                                        <ul class="icons-list">
                                                                            <li class="dropdown">
                                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                                                <ul class="dropdown-menu dropdown-menu-right">
                                                                                    <li>
                                                                                        <?php
                                                                                        if ($data->status == 1) {

                                                                                            echo "<a membershipId='" . $data->id . "' change_status = '0' class='chg_status' data_type='Membership'><i class='icon-gear'></i> Inactive</a>";
                                                                                        } else {
                                                                                            echo "<a membershipId='" . $data->id . "' change_status = '1' class='chg_status' data_type='Membership'><i class='icon-gear'></i> Active</a>";
                                                                                        }
                                                                                        ?> </li>
                                                                                    <li>
                                                                                        <a class="membershipEdit" memID="<?php echo $data->id; ?>"><i class="icon-gear"></i> Edit</a>
                                                                                    </li>
                                                                                    <li> 
                                                                                        <a style="cursor: pointer;" class="membershipDelete" memID="<?php echo $data->id; ?>"><i class="icon-trash"></i> Delete</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </li>
                                                                        </ul>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                        ?>

                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                        <!-- /marketing campaigns -->

                                    </div>
                                </div>
                            </div>

                            <!--########################TAB 1 ##########################-->
                            <div class="tab-pane" id="right-icon-tab1">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <!-- Marketing campaigns -->
                                        <!--<div class="panel panel-flat">-->
                                        <div style="margin: 0 -20px;">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <h6 class="panel-title">Topup Membership Levels</h6>
                                                        <?php
                                                        $membershipLevel = 0;
                                                        foreach ($membership_data as $data) {

                                                            if ($data->type == 'topup-membership') {
                                                                $membershipLevel++;
                                                            }
                                                        }
                                                        ?>
                                                        <div class="heading-elements">
                                                            <span class="label bg-success heading-text"><?php echo $membershipLevel; ?> Membership Level</span>
                                                            <ul class="icons-list">
                                                                <li class="dropdown">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i> <span class="caret"></span></a>
                                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                                        <li><a href="#"><i class="icon-sync"></i> Update data</a></li>
                                                                        <li><a href="#"><i class="icon-list-unordered"></i> Detailed log</a></li>
                                                                        <li><a href="#"><i class="icon-pie5"></i> Statistics</a></li>
                                                                        <li class="divider"></li>
                                                                        <li><a href="#"><i class="icon-cross3"></i> Clear list</a></li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="table-responsive">
                                                <div class="custom_action_box">
                                                    <button id="deleteMembershipBtn" class="btn btn-danger btn-xs lgrey">Delete</button>
                                                </div>
                                                <input name="min" id="min" type="hidden">
                                                <input name="max" id="max" type="hidden">
                                                <table class="table text-nowrap datatable-sorting blef0 brig0 membershipTable" id="membershipLevelN">
                                                    <thead>
                                                        <tr>
                                                            <th style="display: none;"></th>
                                                            <th style="display: none;"></th>
                                                            <th style="width: 40px!important;" class="nosort"><input type="checkbox" name="checkAll[]" class="" id="checkAll" ></th>
                                                            <th>Level Name</th>
                                                            <th>Price </th>
                                                            <th>Credits </th>
                                                            <th>Contacts Limit </th>
                                                            <!--<th>Email Limit</th>
                                                            <th>SMS Limit</th>
                                                            <th>Text Review Limit </th>
                                                            <th>Video Review Limit </th>-->
                                                            <th class="col-md-2">Date Created</th>
                                                            <th class="text-center">Status </th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                        foreach ($membership_data as $data) {
                                                            if ($data->type == 'topup-membership') {
                                                                ?>
                                                                <tr id="append-<?php echo $data->id; ?>" class="selectedClass">
                                                                    <td style="display: none;"><?php echo date('m/d/Y', strtotime($data->created)); ?></td>
                                                                    <td style="display: none;"><?php echo $data->id; ?></td>
                                                                    <td style="width: 40px!important;"><input type="checkbox" name="checkRows[]" class="checkRows" id="chk<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" ></td>
                                                                    <td><?php echo $data->level_name; ?></td>
                                                                    <td>
                                                                        $<?php echo number_format($data->price, 2); ?>/<?php
                                                                        if ($data->subs_cycle == 'monthly' || $data->subs_cycle == 'month') {
                                                                            echo 'Month';
                                                                        } else if ($data->subs_cycle == 'yearly' || $data->subs_cycle == 'year') {
                                                                            echo 'Year';
                                                                        } else if ($data->subs_cycle == 'weekly' || $data->subs_cycle == 'week') {
                                                                            echo 'Week';
                                                                        } else if ($data->subs_cycle == 'bi-yearly') {
                                                                            echo '2 Year';
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td><?php echo number_format($data->credits); ?></td>
                                                                    <td><?php echo number_format($data->contact_limit); ?></td>
                                                                    <!--<td><?php echo number_format($data->email_limit, 0); ?></td>
                                                                    <td><?php echo number_format($data->sms_limit, 0); ?></td>
                                                                    <td><?php echo number_format($data->text_review_limit, 0); ?></td>
                                                                    <td><?php echo number_format($data->video_review_limit, 0); ?></td>-->
                                                                    <td><h6 class="text-semibold"><?php echo date('M d, Y', strtotime($data->created)); ?><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($data->created)) . ' (' . timeAgo($data->created) . ')'; ?></div></h6></td>
                                                                    <td class="text-center">
                                                                        <?php
                                                                        if ($data->status == 1) {
                                                                            ?><span class="label bg-success">Active</span><?php
                                                                        } else {
                                                                            ?><span class="label bg-danger">Inactive</span><?php
                                                                        }
                                                                        ?></td>
                                                                    <td class="text-center">
                                                                        <ul class="icons-list">
                                                                            <li class="dropdown">
                                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                                                <ul class="dropdown-menu dropdown-menu-right">
                                                                                    <li>
                                                                                        <?php
                                                                                        if ($data->status == 1) {

                                                                                            echo "<a membershipId='" . $data->id . "' change_status = '0' class='chg_status' data_type='Membership'><i class='icon-gear'></i> Inactive</a>";
                                                                                        } else {
                                                                                            echo "<a membershipId='" . $data->id . "' change_status = '1' class='chg_status' data_type='Membership'><i class='icon-gear'></i> Active</a>";
                                                                                        }
                                                                                        ?> </li>
                                                                                    <li>
                                                                                        <a class="membershipEdit" memID="<?php echo $data->id; ?>"><i class="icon-gear"></i> Edit</a>
                                                                                    </li>
                                                                                    <li> 
                                                                                        <a style="cursor: pointer;" class="membershipDelete" memID="<?php echo $data->id; ?>"><i class="icon-trash"></i> Delete</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </li>
                                                                        </ul>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                        ?>

                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                        <!-- /marketing campaigns -->

                                    </div>
                                </div>
                            </div>

                            <!--########################TAB 2 ##########################-->
                            <div class="tab-pane" id="right-icon-tab2">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <!-- Marketing campaigns -->
                                        <!--<div class="panel panel-flat">-->
                                        <div style="margin: 0 -20px;">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <h6 class="panel-title">Topup Levels</h6>
                                                        <?php
                                                        $membershipLevel = 0;
                                                        foreach ($membership_data as $data) {

                                                            if ($data->type == 'topup') {
                                                                $membershipLevel++;
                                                            }
                                                        }
                                                        ?>
                                                        <div class="heading-elements">
                                                            <span class="label bg-success heading-text"><?php echo $membershipLevel; ?> Topup Level</span>
                                                            <ul class="icons-list">
                                                                <li class="dropdown">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i> <span class="caret"></span></a>
                                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                                        <li><a href="#"><i class="icon-sync"></i> Update data</a></li>
                                                                        <li><a href="#"><i class="icon-list-unordered"></i> Detailed log</a></li>
                                                                        <li><a href="#"><i class="icon-pie5"></i> Statistics</a></li>
                                                                        <li class="divider"></li>
                                                                        <li><a href="#"><i class="icon-cross3"></i> Clear list</a></li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="table-responsive">
                                                <div class="custom_action_box">
                                                    <button id="deleteTemplateBtn" class="btn btn-danger btn-xs lgrey">Delete</button>
                                                </div>

                                                <table class="table text-nowrap datatable-sorting blef0 brig0 membershipTable" id="membershipTopup">
                                                    <thead>
                                                        <tr>
                                                            <th style="display: none;"></th>
                                                            <th style="display: none;"></th>
                                                            <th style="width: 40px!important;" class="nosort"><input type="checkbox" name="checkAll[]" class="" id="checkAll-topup" ></th>
                                                            <th>Level Name</th>
                                                            <th>Topup Price</th>
                                                            <th>Credits </th>
                                                            <th>Contacts Limit </th>
                                                            <!--<th>Email Limit</th>
                                                            <th>SMS Limit</th>-->
                                                            <th class="col-md-2">Date Created</th>
                                                            <th class="text-center">Status </th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                        foreach ($membership_data as $data) {
                                                            if ($data->type == 'topup') {
                                                                ?>
                                                                <tr>
                                                                <tr id="append-topup-<?php echo $data->id; ?>" class="selectedClass">
                                                                    <td style="display: none;"><?php echo date('m/d/Y', strtotime($data->created)); ?></td>
                                                                    <td style="display: none;"><?php echo $data->id; ?></td>
                                                                    <td style="width: 40px!important;"><input type="checkbox" name="checkRows[]" class="checkRows-topup" id="chk<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" ></td>
                                                                    <td><?php echo $data->level_name; ?></td>
                                                                    <td>$<?php echo number_format($data->price, 2); ?></td>
                                                                    <td><?php echo number_format($data->credits); ?></td>
                                                                    <td><?php echo number_format($data->contact_limit); ?></td>
                                                                    <!--<td><?php echo number_format($data->topup_email_limit, 0); ?></td>
                                                                    <td><?php echo number_format($data->topup_sms_limit, 0); ?></td>-->
                                                                    <td><h6 class="text-semibold"><?php echo date('M d, Y', strtotime($data->created)); ?><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($data->created)) . ' (' . timeAgo($data->created) . ')'; ?></div></h6></td>
                                                                    <td class="text-center">
                                                                        <?php
                                                                        if ($data->status == 1) {
                                                                            ?><span class="label bg-success">Active</span><?php
                                                                        } else {
                                                                            ?><span class="label bg-danger">Inactive</span><?php
                                                                        }
                                                                        ?></td>
                                                                    <td class="text-center">
                                                                        <ul class="icons-list">
                                                                            <li class="dropdown">
                                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                                                <ul class="dropdown-menu dropdown-menu-right">
                                                                                    <li>
                                                                                        <?php
                                                                                        if ($data->status == 1) {

                                                                                            echo "<a membershipId='" . $data->id . "' change_status = '0' class='chg_status' data_type='Topup'><i class='icon-gear'></i> Inactive</a>";
                                                                                        } else {
                                                                                            echo "<a membershipId='" . $data->id . "' change_status = '1' class='chg_status' data_type='Topup'><i class='icon-gear'></i> Active</a>";
                                                                                        }
                                                                                        ?> </li>
                                                                                    <li>
                                                                                        <a class="topUpEdit" memID="<?php echo $data->id; ?>"><i class="icon-gear"></i> Edit</a>
                                                                                    </li>
                                                                                    <li> 
                                                                                        <a style="cursor: pointer;" class="membershipDelete" memID="<?php echo $data->id; ?>"><i class="icon-trash"></i> Delete</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </li>
                                                                        </ul>
                                                                    </td>
                                                                    
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                        ?>

                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                        <!-- /marketing campaigns -->
                                    </div>
                                </div>
                            </div>

                            <!--########################TAB end ##########################--> 
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- /content area -->


<!-- =======================Add topup  popup========================= -->
<div id="addtopupLevel" class="modal fade">
    <div class="modal-dialog">

        <div class="modal-content">
            <form method="post" class="form-horizontal" id="addTopup" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Add Top Up Level</h5>
                </div>

                <div class="modal-body">


                    <div class="form-group">
                        <label class="control-label col-lg-3">Topup Name</label>
                        <div class="col-lg-9">
                            <input name="type" value="topup" type="hidden">
                            <input class="form-control" name="level_name" id="level_name" value="" placeholder="Basic" type="text" required>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Price</label>
                        <div class="col-lg-9">
                            <input class="form-control" name="topup_price" id="topup_price" value="" placeholder="$29" type="text" required>

                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-lg-3">Credits</label>
                        <div class="col-lg-9">
                            <input class="form-control" name="credits" placeholder="Enter number of credits" type="number" required>
                        </div>
                        
                    </div>
                    
                    <!--<<div class="form-group">
                        <label class="control-label col-lg-3">Contact Limit</label>
                        <div class="col-lg-9">
                            <input class="form-control" name="contact_limit" placeholder="Enter contact limit" type="number" required>
                        </div>
                        
                    </div>


                    div class="form-group">
                        <label class="control-label col-lg-3">Email Inivte Limit</label>
                        <div class="col-lg-9">
                            <input class="form-control" name="topup_email_limit" value="" id="topup_email_limit" placeholder="500" type="text" required>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">SMS Inivte Limit</label>
                        <div class="col-lg-9">
                            <input class="form-control" name="topup_sms_limit" id="topup_sms_limit" value="" placeholder="500" type="text">

                        </div>
                    </div>-->

                </div>

                <div class="modal-footer">

                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" id="addButtonTop" class="btn btn-primary"><i class="icon-check"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- =======================membershipLevel popup========================= -->
<div id="membershipLevel" class="modal fade">
    <div class="modal-dialog">

        <div class="modal-content">
            <form method="post" class="form-horizontal" id="addMembership" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Add Plan</h5>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-lg-3">Plan Type</label>
                        <div class="col-lg-9">
                            <select class="form-control" name="type" id="plantype" required="">
                                <option value="">--Select--</option>
                                <option value="membership">Membership</option>
                                <option value="topup-membership">Topup Membership</option>
                                <option value="topup">Topup</option>
                            </select> 
                        </div>
                    </div>

                    <div class="form-group" id="billing-period-section">
                        <label class="control-label col-lg-3">Billing Period</label>
                        <div class="col-lg-9">
                            <select class="form-control" name="periodUnit" id="periodUnit" required="">
                                <option value="">--Select--</option>
                                <option value="week">Week</option>
                                <option value="month">Month</option>
                                <option value="year">Year</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Plan Name</label>
                        <div class="col-lg-9">
                            <input class="form-control" name="level_name"  placeholder="Enter Plan Name" type="text" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Invoice Name</label>
                        <div class="col-lg-9">
                            <input class="form-control" name="invoice_name"  placeholder="Enter Plan Name" type="text" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Price($)</label>
                        <div class="col-lg-9">
                            <input class="form-control" name="price" placeholder="Enter Price" type="text" required>

                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-lg-3">Credits</label>
                        <div class="col-lg-9">
                            <input class="form-control" name="credits" placeholder="Enter number of credits" type="number" required>
                        </div>
                        
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-lg-3">Contact Limit</label>
                        <div class="col-lg-9">
                            <input class="form-control" name="contact_limit" placeholder="Enter contact limit" type="number" required>
                        </div>
                        
                    </div>



                   

                </div>

                <div class="modal-footer">

                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" id="addButtonMem" class="btn btn-primary"><i class="icon-check"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- =======================edit membershipLevel popup========================= -->
<div id="membershipLevelEdit" class="modal fade">
    <div class="modal-dialog">

        <div class="modal-content">
            <form method="post" class="form-horizontal" id="updateMembership" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Edit Membership</h5>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-lg-3">Plan Name</label>
                        <div class="col-lg-9">
                            <input class="form-control" name="level_name" value="" id="e_level_name" placeholder="Basic" type="text" required>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Invoice Name</label>
                        <div class="col-lg-9">
                            <input class="form-control" name="invoice_name" id="e_invoice_name"  placeholder="Enter Invoice Name" type="text" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Price($)</label>
                        <div class="col-lg-7">
                            <input class="form-control" name="price" value="" id="mem_price" placeholder="Enter the price" type="text" required>

                        </div>
                        <div class="col-lg-2">
                            <p id="edit_subs_cycle" style="font-weight:bold; margin-top:10px;">

                            </p>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Credits</label>
                        <div class="col-lg-9">
                            <input class="form-control" name="credits" value="" id="mem_credits" placeholder="Enter number of credits" type="number" required>
                        </div>
                        
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-lg-3">Contact Limit</label>
                        <div class="col-lg-9">
                            <input class="form-control" name="contact_limit" value="" id="mem_contact_limit" placeholder="Enter contact limit" type="number" required>
                        </div>
                        
                    </div>


                   

                </div>

                <div class="modal-footer">

                    <input type="hidden" name="mem_ID" id="e_mem_ID" value="">
                    <input type="hidden" name="plan_id" id="e_plan_id" value="" >
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" id="updateButtonMem" class="btn btn-primary"><i class="icon-check"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- =======================Edit topup popup========================= -->
<div id="edittopupLevel" class="modal fade">
    <div class="modal-dialog">

        <div class="modal-content">
            <form method="post" class="form-horizontal" id="updateTopup" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Update Top Up Level</h5>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-lg-3">Topup Name</label>
                        <div class="col-lg-9">
                            <input name="type" value="topup" type="hidden">
                            <input class="form-control" name="level_name" id="t_level_name" value="" placeholder="Basic" type="text" required>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Price</label>
                        <div class="col-lg-9">
                            <input class="form-control" name="topup_price" id="t_topup_price" value="" placeholder="$29" type="text" required>

                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-lg-3">Credits</label>
                        <div class="col-lg-9">
                            <input class="form-control" name="credits" value="" id="mem_credits" placeholder="Enter number of credits" type="number" required>
                        </div>
                        
                    </div>


                </div>

                <div class="modal-footer">
                    <input type="hidden" name="mem_ID" id="t_mem_ID" value="">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" id="updateButtonTop" class="btn btn-primary"><i class="icon-check"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {

        $("#plantype").change(function () {
            var selectedVal = $(this).val();
            if (selectedVal == 'topup') {
                $("#billing-period-section").hide();
                $("#periodUnit").removeAttr('required');
            } else {
                $("#billing-period-section").show();
                $("#periodUnit").attr('required', 'required');
            }
        });

        $("#productType").change(function () {
            var selectedVal = $(this).val();
            if (selectedVal == 'membership') {
                $(".topupTable").hide();
                $(".membershipTable").show();
            } else {
                $(".topupTable").show();
                $(".membershipTable").hide();
            }
        });

        $('#checkAll').change(function () {
            if (false == $(this).prop("checked")) {
                $(".checkRows").prop('checked', false);
                $(".selectedClass").removeClass('success');
                $('.custom_action_box').hide();
            } else {
                $(".checkRows").prop('checked', true);
                $(".selectedClass").addClass('success');
                $('.custom_action_box').show();
            }
        });

        $(document).on('click', '.checkRows', function () {
            var inc = 0;
            var rowId = $(this).val();
            if (false == $(this).prop("checked")) {
                $('#append-' + rowId).removeClass('success');
            } else {
                $('#append-' + rowId).addClass('success');
            }

            $('.checkRows:checkbox:checked').each(function (i) {
                inc++;
            });

            if (inc == 0) {
                $('.custom_action_box').hide();
            } else {
                $('.custom_action_box').show();
            }

            var numberOfChecked = $('.checkRows:checkbox:checked').length;
            var totalCheckboxes = $('.checkRows:checkbox').length;
            if (totalCheckboxes > numberOfChecked) {
                $('#checkAll').prop('checked', false);
            }
        });

        $(document).on('click', '#deleteMembershipBtn', function () {
            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {
                swal({
                    title: "Are you sure? You want to delete this record!",
                    text: "You will not be able to recover this record!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#EF5350",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                        function (isConfirm) {
                            if (isConfirm) {
                                $('.overlaynew').show();
                                $.ajax({
                                    url: '<?php echo base_url('admin/membership/deleteMemberships'); ?>',
                                    type: "POST",
                                    data: {multipal_record_id: val},
                                    dataType: "json",
                                    success: function (data) {
                                        if (data.status == 'success') {
                                            $('.overlaynew').hide();
                                            window.location.href = window.location.href;
                                        } else {
                                            $('.overlaynew').hide();
                                            alertMessage('Error: Some thing wrong!');
                                        }
                                    },
                                    error: function () {
                                        $('.overlaynew').hide();
                                        alertMessage('Error: Some thing wrong!');
                                    }
                                });
                            }
                        });
            }
        });


        $('#checkAll-topup').change(function () {
            if (false == $(this).prop("checked")) {
                $(".checkRows-topup").prop('checked', false);
                $(".selectedClass").removeClass('success');
                $('.custom_action_box_topup').hide();
            } else {
                $(".checkRows-topup").prop('checked', true);
                $(".selectedClass").addClass('success');
                $('.custom_action_box_topup').show();
            }
        });

        $(document).on('click', '.checkRows-topup', function () {
            var inc = 0;
            var rowId = $(this).val();
            if (false == $(this).prop("checked")) {
                $('#append-topup-' + rowId).removeClass('success');
            } else {
                $('#append-topup-' + rowId).addClass('success');
            }

            $('.checkRows-topup:checkbox:checked').each(function (i) {
                inc++;
            });

            if (inc == 0) {
                $('.custom_action_box').hide();
            } else {
                $('.custom_action_box').show();
            }

            var numberOfChecked = $('.checkRows-topup:checkbox:checked').length;
            var totalCheckboxes = $('.checkRows-topup:checkbox').length;
            if (totalCheckboxes > numberOfChecked) {
                $('#checkAll-topup').prop('checked', false);
            }
        });

        $(document).on('click', '#deleteTopupBtn', function () {
            var val = [];
            $('.checkRows-topup:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {
                swal({
                    title: "Are you sure? You want to delete this record!",
                    text: "You will not be able to recover this record!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#EF5350",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                        function (isConfirm) {
                            if (isConfirm) {
                                $('.overlaynew').show();
                                $.ajax({
                                    url: '<?php echo base_url('admin/membership/deleteMemberships'); ?>',
                                    type: "POST",
                                    data: {multipal_record_id: val},
                                    dataType: "json",
                                    success: function (data) {
                                        if (data.status == 'success') {
                                            $('.overlaynew').hide();
                                            window.location.href = window.location.href;
                                        } else {
                                            $('.overlaynew').hide();
                                            alertMessage('Error: Some thing wrong!');
                                        }
                                    },
                                    error: function () {
                                        $('.overlaynew').hide();
                                        alertMessage('Error: Some thing wrong!');
                                    }
                                });
                            }
                        });
            }
        });


        $("#addMembership").submit(function () {

            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo base_url('admin/membership/add'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = window.location.href;
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });


        $("#addTopup").submit(function () {

            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo base_url('admin/membership/add'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = window.location.href;
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });


        $(document).on('click', '.membershipDelete', function () {
            var memID = $(this).attr('memID');
            swal({
                title: "Are you sure? You want to delete this record!",
                text: "You will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel pls!",
                closeOnConfirm: true,
                closeOnCancel: true
            },
                    function (isConfirm) {
                        if (isConfirm) {
                            $('.overlaynew').show();
                            $.ajax({
                                url: '<?php echo base_url('admin/membership/mem_delete'); ?>',
                                type: "POST",
                                data: {memID: memID},
                                dataType: "json",
                                success: function (data) {
                                    if (data.status == 'success') {
                                        $('.overlaynew').hide();
                                        window.location.href = window.location.href;
                                    } else {
                                        $('.overlaynew').hide();
                                        alertMessage('Error: Some thing wrong!');
                                    }
                                },
                                error: function () {
                                    $('.overlaynew').hide();
                                    alertMessage('Error: Some thing wrong!');
                                }
                            });
                        }
                    });
        });


        $(document).on('click', '.membershipEdit', function () {
            var memID = $(this).attr('memID');
            $.ajax({
                url: '<?php echo base_url('admin/membership/getMemberById'); ?>',
                type: "POST",
                data: {memID: memID},
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {
                        var mem = data.result[0];
                        $('#e_level_name').val(mem.level_name);
                        $('#e_invoice_name').val(mem.invoice_name);
                        $('#mem_price').val(mem.price);
                        $("#mem_credits").val(mem.credits);
                        $("#mem_contact_limit").val(mem.contact_limit);
                        $("#edit_subs_cycle").text('/' + mem.subs_cycle);
                        $('#e_email_limit').val(mem.email_limit);
                        $('#e_sms_limit').val(mem.sms_limit);
                        $('#e_text_review_limit').val(mem.text_review_limit);
                        $('#e_video_review_limit').val(mem.video_review_limit);
                        $('#e_social_invites').val(mem.social_invite_sources);
                        $('#e_add_your_own').val(mem.custom_addons);
                        $('#e_mem_ID').val(mem.id);
                        $("#e_plan_id").val(mem.plan_id);

                        $("#membershipLevelEdit").modal()

                    } else {

                    }
                }
            });
        });


        $(document).on('click', '.topUpEdit', function () {

            var memID = $(this).attr('memID');
            $.ajax({
                url: '<?php echo base_url('admin/membership/getMemberById'); ?>',
                type: "POST",
                data: {memID: memID},
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {
                        var mem = data.result[0];

                        $('#t_level_name').val(mem.level_name);
                        $('#t_topup_price').val(mem.topup_fee);
                        $('#t_topup_email_limit').val(mem.topup_email_limit);
                        $('#t_topup_sms_limit').val(mem.topup_sms_limit);
                        $('#t_mem_ID').val(mem.id);

                        $("#edittopupLevel").modal()

                    } else {

                    }
                }
            });
        });


        $("#updateMembership").submit(function () {

            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo base_url('admin/membership/mem_update'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = window.location.href;
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });


        $("#updateTopup").submit(function () {

            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo base_url('admin/membership/topup_update'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = window.location.href;
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });


        $(document).on('click', '.chg_status', function () {

            $('.overlaynew').show();
            var status = $(this).attr('change_status');
            var membershipId = $(this).attr('membershipId');
            var dataTypeTxt = $(this).attr('data_type');

            $.ajax({
                url: '<?php echo base_url('admin/membership/update_status'); ?>',
                type: "POST",
                data: {status: status, membership_id: membershipId},
                dataType: "json",
                success: function (data) {
                    if (dataTypeTxt == '') {
                        dataTypeTxt = 'Data ';
                    }
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = window.location.href;
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });
    });


    $(function () {


        // Table setup
        // ------------------------------

        // Setting datatable defaults


        $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var min = $('#min').datepicker("getDate");
                    var max = $('#max').datepicker("getDate");
                    //console.log(data);
                    var startDate = new Date(data[7]);
                    if (min == null && max == null) {
                        return true;
                    }
                    if (min == null && startDate <= max) {
                        return true;
                    }
                    if (max == null && startDate >= min) {
                        return true;
                    }
                    if (startDate <= max && startDate >= min) {
                        return true;
                    }
                    return false;
                }
        );


        $("#min").datepicker({onSelect: function () {
                table.draw();
            }, changeMonth: true, changeYear: true});
        $("#max").datepicker({onSelect: function () {
                table.draw();
            }, changeMonth: true, changeYear: true});


        $.extend($.fn.dataTable.defaults, {
            autoWidth: false,
            columnDefs: [{
                    orderable: false,
                    width: '100px'
                }],
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            language: {
                search: '<span>Filter:</span> _INPUT_',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span>Show:</span> _MENU_',
                paginate: {'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;'}
            },
            drawCallback: function () {
                $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
            },
            preDrawCallback: function () {
                $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
            }
        });


        var membershipLevelN = $('#membershipLevelN').DataTable();
        var membershipTopup = $('#membershipTopup').DataTable();

        var d = new Date();
        var month = d.getMonth() + 1;
        var day = d.getDate();
        var currentDate =
                (('' + month).length < 2 ? '0' : '') + month + '/' +
                (('' + day).length < 2 ? '0' : '') + day + '/' + d.getFullYear();



        $('.daterange-ranges').daterangepicker(
                {
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment(),
                    minDate: '01/01/2012',
                    maxDate: currentDate,
                    dateLimit: {days: 60},
                    ranges: {
                        'All': [moment().add(1, 'days'), moment()],
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    opens: 'left',
                    applyClass: 'btn-small bg-slate-600 btn-block',
                    cancelClass: 'btn-small btn-default btn-block',
                    format: 'MM/DD/YYYY'
                },
                function (start, end) {

                    if (start.format('MM/DD/YYYY') > end.format('MM/DD/YYYY')) {

                        $('#min').val('');
                        $('#max').val('');
                        $('.daterange-ranges span').html('Sort by date.');
                    } else {

                        $('#min').val(start.format('MM/DD/YYYY'));
                        $('#max').val(end.format('MM/DD/YYYY'));
                        $('.daterange-ranges span').html(start.format('MMMM DD YYYY') + ' - ' + end.format('MMMM DD YYYY'));
                    }

                    membershipLevelN.draw();
                    membershipTopup.draw();
                }
        );

        //$('.daterange-ranges span').html(moment().subtract(29, 'days').format('MMMM DD YYYY') + ' - ' + moment().format('MMMM DD YYYY'));

        $('.daterange-ranges span').html('Sort by date.');

    });
</script>
@endsection



