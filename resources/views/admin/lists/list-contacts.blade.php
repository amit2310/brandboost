<?php
$iActiveCount = $iArchiveCount = 0;
if (!empty($oSubscriber)) {
    foreach ($oSubscriber as $oCount) {
        if ($oCount->status == 2) {
            $iArchiveCount++;
        } else {
            $iActiveCount++;
        }
    }
}
?>
<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->

    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-3">
                <h3><i class="icon-vcard"></i> &nbsp; Contacts</h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="active"><a href="#right-icon-tab0" data-toggle="tab">Lists Subscribers</a></li>
                    <li><a href="#right-icon-tab1" data-toggle="tab">Archives</a></li>
                </ul>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-9 text-right btn_area">
                <div class="btn-group">
                    <button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-calendar2"></i>&nbsp; &nbsp; Filter Contacts &nbsp; &nbsp; <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu dropdown-content width-320 dropdown-menu-right">
                        <div class="dropdown-content-heading"> Filter
                            <ul class="icons-list">
                                <li><a href="javascript:void(0);"><i class="icon-more"></i></a> </li>
                            </ul>
                        </div>
                        <div class="">
                            <div class="panel-group panel-group-control panel-group-control-right content-group-lg filter_campaign" id="accordion-control-right">
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings active">
                                        <h6 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group1"><i class="icon-star-empty3"></i>&nbsp;Campaign Type</a> </h6>
                                    </div>
                                    <div id="accordion-control-right-group1" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12"> 
                                                    Most startups fail. But many of those failures are preventable. The Lean Startup is a new approach being adopted across the globe, changing the way companies are built and new products are launched.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings">
                                        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group2"><i class="icon-arrow-up-left2"></i>&nbsp; Source</a> </h6>
                                    </div>
                                    <div id="accordion-control-right-group2" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12"> Conetent Goes here... </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings">
                                        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group73"><i class="icon-star-full2"></i>&nbsp; Rating</a> </h6>
                                    </div>
                                    <div id="accordion-control-right-group73" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12"> Conetent Goes here... </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings">
                                        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group74"><i class="icon-calendar"></i>&nbsp; Date Created</a> </h6>
                                    </div>
                                    <div id="accordion-control-right-group74" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12"> Conetent Goes here... </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings">
                                        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group83"><i class="icon-thumbs-up2"></i>&nbsp; Reviews</a> </h6>
                                    </div>
                                    <div id="accordion-control-right-group83" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="row mb20">
                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="control-primary" checked="checked">
                                                            Total Reviews
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input class="form-control input-sm" type="text" name="" value="20" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" />
                                                </div>

                                            </div>
                                            <div class="row mb20">
                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="control-primary" checked="checked">
                                                            Positive
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input class="form-control input-sm" type="text" name="" value="20" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" />
                                                </div>

                                            </div>
                                            <div class="row mb20">
                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="control-primary">
                                                            Neutral
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input class="form-control input-sm" type="text" name="" value="20" disabled /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" disabled />
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="control-primary" checked="checked">
                                                            Negative
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input class="form-control input-sm" type="text" name="" value="0" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="10" />
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-content-footer">
                            <button type="button" class="btn dark_btn dropdown-toggle" style="display: inline-block;"><i class="icon-filter4"></i><span> &nbsp;  Filter</span> </button>
                            &nbsp; &nbsp;
                            <a style="display: inline-block;" href="javascript:void(0);">Clear All</a>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn dark_btn ml20 addModuleContact" data-toggle="modal" data-modulename="list" data-moduleaccountid="<?php echo $list_id; ?>"><i class="icon-plus3"></i><span> &nbsp;  Add Contact</span> </button>

                <button data-toggle="modal" data-target="#importCSV" type="button" class="btn dark_btn ml20 importModuleContact" data-modulename="list" data-moduleaccountid="<?php echo $list_id; ?>" data-redirect="admin/lists/getListContacts?list_id=<?php echo $list_id; ?>"><i class="icon-make-group position-left"></i> Import Contact</button>

                <form method="get" action="{{ base_url() }}admin/subscriber/exportSubscriberCSV" enctype="multipart/form-data" style="float:right;">
                    <input type="hidden" name="module_name" id="module_name" value="list">
                    <input type="hidden" name="module_account_id" value="<?php echo $list_id; ?>">
                    <button type="submit" title="Export" class="btn dark_btn ml20" id="exportButton"><i class="icon-make-group position-left"></i> Export Contact</button>
                </form>
            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->
    <div class="tab-content"> 
        <!--===========TAB 1===========-->
        <div class="tab-pane active" id="right-icon-tab0">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Marketing campaigns -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title"><?php echo $oSubscriber[0]->list_name . ' : ' . $iActiveCount; ?> Subscribers</h6>
                            <div class="heading-elements">
                                <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                    <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                    <div class="form-control-feedback">
                                        <i class="icon-search4"></i>
                                    </div>
                                </div>&nbsp; &nbsp;

                                <button type="button" class="btn btn-xs btn-default editDataList"><i class="icon-pencil position-left"></i> Edit</button>
                                <button id="deleteButtonListsContacts" class="btn btn-xs custom_action_box"><i class="icon-trash position-left"></i> Delete</button>
                                <button id="archiveButtonListsContacts" class="btn btn-xs custom_action_box"><i class="icon-gear position-left"></i> Archive</button>
                            </div>
                        </div>

                        <div class="panel-body p0">
                            <table class="table datatable-basic datatable-sorting" id="allContact">
                                <thead>

                                    <tr>
                                        <th style="display: none;"></th>
                                        <th style="display: none;"></th>
                                        <th style="display: none;" class="nosort editAction" style="width:30px;"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="control-primary" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
                                        <th><i class="icon-user"></i>Name</th>
                                        <th><i class="icon-display"></i>Phone</th>
                                        <th><i class="icon-calendar"></i>Created</th>
                                        <th><i class="icon-hash"></i>Source</th>
                                        <th><i class="icon-atom"></i>Social</th>
                                        <th><i class="icon-price-tag2"></i>Tags</th>
                                        <th class="text-center"><i class="fa fa-dot-circle-o"></i>Status</th>
                                        <th class="text-center nosort"><i class="fa fa-dot-circle-o"></i>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($oSubscriber) > 0) {
                                        foreach ($oSubscriber as $oContact) {
                                            if ($oContact->status != '2') {
                                                ?>
                                                <tr id="append-<?php echo $oContact->id; ?>" class="selectedClass">
                                                    <td style="display: none;"><?php echo date('m/d/Y', strtotime($oContact->created)); ?></td>
                                                    <td style="display: none;"><?php echo $oContact->id; ?></td>
                                                    <td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" value="<?php echo $oContact->id; ?>" ><span class="custmo_checkmark"></span></label></td>
                                                    <td>
                                                        <div class="media-left media-middle"> <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/images/userp.png" class="img-circle img-xs" alt=""></a> </div>


                                                        <div class="media-left">
                                                            <div class="pt-5"><a href="<?php echo base_url(); ?>admin/subscriber/activities/<?php echo $oContact->id; ?>" target="_blank" class="text-default text-semibold"><span><?php echo $oContact->firstname; ?> <?php echo $oContact->lastname; ?></span> <img class="flags" src="<?php echo base_url(); ?>assets/images/flags/us.png"/></a></div>
                                                            <div class="text-muted text-size-small"><?php echo $oContact->email; ?></div>

                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="media-left">
                                                            <div class="pt-5"><a href="javascript:void(0);" class="text-default text-semibold"><?php echo $oContact->phone == '' ? '<span style="color:#999999">Phone Unavailable</span>' : $oContact->phone; ?></a></div>
                                                            <div class="text-muted text-size-small">Chat</div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="media-left">
                                                            <div class="pt-5"><a href="javascript:void(0);" class="text-default text-semibold"><?php echo date('d M Y', strtotime($oContact->created)); ?></a></div>
                                                            <div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oContact->created)); ?></div>
                                                        </div>

                                                    </td>
                                                    <td>
                                                        <div class="media-left media-middle"> <a class="icons" href="javascript:void(0);"><i class="icon-envelop txt_blue"></i></a> </div>
                                                        <div class="media-left">
                                                            <div class="pt-5"><a href="javascript:void(0);" class="text-default text-semibold">Email</a></div>
                                                            <div class="text-muted text-size-small">Form #183</div>
                                                        </div>	
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo $oContact->socialProfile; ?>" target="_blank"><button class="btn btn-xs btn_white_table"><i class="icon-twitter txt_lblue"></i></button></a>
                                                        <a href="<?php echo $oContact->socialProfile; ?>" target="_blank"><button class="btn btn-xs btn_white_table"><i class="icon-facebook txt_dblue"></i></button></a>
                                                        <a href="<?php echo $oContact->socialProfile; ?>" target="_blank"><button class="btn btn-xs btn_white_table"><i class="icon-phone2 txt_green"></i></button></a>
                                                        <a href="<?php echo $oContact->socialProfile; ?>" target="_blank"><button class="btn btn-xs btn_white_table"><i class="icon-envelop txt_blue"></i></button></a>
                                                    </td>
                                                    <td>
                                                        <div class="tdropdown">
                                                            <button type="button" class="btn btn-xs btn_white_table dropdown-toggle " data-toggle="dropdown"><i class="icon-hash"></i> 4 Tags &nbsp; <span class="caret"></span></button>
                                                            <ul class="dropdown-menu dropdown-menu-right width-200">
                                                                <li><a href="javascript:void(0);"><i class="icon-menu7"></i> Action</a>
                                                                </li>
                                                                <li><a href="javascript:void(0);"><i class="icon-screen-full"></i> Another action</a>
                                                                </li>
                                                                <li><a href="javascript:void(0);"><i class="icon-mail5"></i> One more action</a>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li><a href="javascript:void(0);"><i class="icon-gear"></i> Separated line</a> </li>
                                                            </ul>
                                                        </div>
                                                        <button class="btn btn-xs btn_white_table"><i class="icon-plus3"></i></button>
                                                    </td>

                                                    <td class="text-center">
                                                        <button class="btn btn-xs btn_white_table pr10"><?php echo $oContact->status == 1 ? '<i class="icon-primitive-dot txt_green"></i> Active' : '<i class="icon-primitive-dot txt_red"></i> Inactive'; ?></button>
                                                    </td>


                                                    <td class="text-center">
                                                        <div class="tdropdown">
                                                            <button type="button" class="btn btn-xs btn_white_table ml20 dropdown-toggle" data-toggle="dropdown"><i class="icon-more2 txt_blue"></i></button>
                                                            <ul class="dropdown-menu dropdown-menu-right width-200">
																<li><a class="moveToArchiveListContact" href="javascript:void(0);" subscriberid="<?php echo $oContact->id; ?>"><i class="icon-trash"></i> Move To Archive</a></li>

                                                                <?php
                                                                if ($oContact->status == 1) {
                                                                    ?><li><a subscriberId='<?php echo $oContact->id; ?>' change_status = '0' class='chg_status'><i class='icon-file-locked'></i> Inacive</a></li>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <li><a  subscriberId='<?php echo $oContact->id; ?>' change_status = '1' class='chg_status'><i class='icon-file-locked'></i> Active</a></li>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <li><a href="javascript:void(0);" class="editModuleSubscriber" data-modulesubscriberid="<?php echo $oContact->id; ?>" data-modulename="list" data-moduleaccountid="<?php echo $list_id; ?>" data-redirect="admin/lists/getListContacts?list_id=<?php echo $list_id; ?>"><i class="icon-pencil"></i> Edit</a></li>

                                                                <li><a class="deleteSubscriber" href="javascript:void(0);" subscriberid="<?php echo $oContact->id; ?>"><i class="icon-trash"></i> Delete</a></li>
                                                            </ul>
                                                        </div>


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
                    </div>


                </div>
            </div>
        </div>
        <div class="tab-pane" id="right-icon-tab1">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Marketing campaigns -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title"><?php echo $oSubscriber[0]->list_name . ' : ' . $iArchiveCount; ?> Subscribers</h6>
                            <div class="heading-elements">
                                <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                    <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                    <div class="form-control-feedback">
                                        <i class="icon-search4"></i>
                                    </div>
                                </div>&nbsp; &nbsp;

                                <button type="button" class="btn btn-xs btn-default editArchiveDataList"><i class="icon-pencil position-left"></i> Edit</button>
                                <button id="deleteContactsBtn" class="btn btn-danger btn-xs lgrey custom_action_box">Delete</button>
                            </div>
                        </div>

                        <div class="panel-body p0">
                            <table class="table datatable-basic datatable-sorting" id="allContact">
                                <thead>

                                    <tr>
                                        <th style="display: none;"></th>
                                        <th style="display: none;"></th>
                                        <th style="display: none;" class="nosort editArchiveAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
                                        <th><i class="icon-user"></i>Name</th>
                                        <th><i class="icon-display"></i>Phone</th>
                                        <th><i class="icon-calendar"></i>Created</th>
                                        <th><i class="icon-hash"></i>Source</th>
                                        <th><i class="icon-atom"></i>Social</th>
                                        <th><i class="icon-price-tag2"></i>Tags</th>
                                        <th class="text-center"><i class="fa fa-dot-circle-o"></i>Status</th>
                                        <th class="text-center nosort"><i class="fa fa-dot-circle-o"></i>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($oSubscriber) > 0) {
                                        foreach ($oSubscriber as $oContact) {
                                            if ($oContact->status == '2') {
                                                ?>
                                                <tr id="append-<?php echo $oContact->id; ?>" class="selectedClass">
                                                    <td style="display: none;"><?php echo date('m/d/Y', strtotime($oContact->created)); ?></td>
                                                    <td style="display: none;"><?php echo $oContact->id; ?></td>
                                                    <td style="display: none;"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" value="<?php echo $oContact->id; ?>" ><span class="custmo_checkmark"></span></label></td>
                                                    <td>
                                                        <div class="media-left media-middle"> <a href="javascript:void(0);"><img src="http://brandboost.io/admin_new/images/userp.png" class="img-circle img-xs" alt=""></a> </div>


                                                        <div class="media-left">
                                                            <div class="pt-5"><a href="<?php echo base_url(); ?>admin/subscriber/activities/<?php echo $oContact->id; ?>" target="_blank" class="text-default text-semibold"><span><?php echo $oContact->firstname; ?> <?php echo $oContact->lastname; ?></span> <img class="flags" src="<?php echo base_url(); ?>assets/images/flags/us.png"/></a></div>
                                                            <div class="text-muted text-size-small"><?php echo $oContact->email; ?></div>

                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="media-left">
                                                            <div class="pt-5"><a href="javascript:void(0);" class="text-default text-semibold"><?php echo $oContact->phone == '' ? '<span style="color:#999999">Phone Unavailable</span>' : $oContact->phone; ?></a></div>
                                                            <div class="text-muted text-size-small">Chat</div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="media-left">
                                                            <div class="pt-5"><a href="javascript:void(0);" class="text-default text-semibold"><?php echo date('d M Y', strtotime($oContact->created)); ?></a></div>
                                                            <div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oContact->created)); ?></div>
                                                        </div>

                                                    </td>
                                                    <td>
                                                        <div class="media-left media-middle"> <a class="icons" href="javascript:void(0);"><i class="icon-envelop txt_blue"></i></a> </div>
                                                        <div class="media-left">
                                                            <div class="pt-5"><a href="javascript:void(0);" class="text-default text-semibold">Email</a></div>
                                                            <div class="text-muted text-size-small">Form #183</div>
                                                        </div>	
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo $oContact->socialProfile; ?>" target="_blank"><button class="btn btn-xs btn_white_table"><i class="icon-twitter txt_lblue"></i></button></a>
                                                        <a href="<?php echo $oContact->socialProfile; ?>" target="_blank"><button class="btn btn-xs btn_white_table"><i class="icon-facebook txt_dblue"></i></button></a>
                                                        <a href="<?php echo $oContact->socialProfile; ?>" target="_blank"><button class="btn btn-xs btn_white_table"><i class="icon-phone2 txt_green"></i></button></a>
                                                        <a href="<?php echo $oContact->socialProfile; ?>" target="_blank"><button class="btn btn-xs btn_white_table"><i class="icon-envelop txt_blue"></i></button></a>
                                                    </td>
                                                    <td>
                                                        <div class="tdropdown">
                                                            <button type="button" class="btn btn-xs btn_white_table dropdown-toggle " data-toggle="dropdown"><i class="icon-hash"></i> 4 Tags &nbsp; <span class="caret"></span></button>
                                                            <ul class="dropdown-menu dropdown-menu-right width-200">
                                                                <li><a href="javascript:void(0);"><i class="icon-menu7"></i> Action</a>
                                                                </li>
                                                                <li><a href="javascript:void(0);"><i class="icon-screen-full"></i> Another action</a>
                                                                </li>
                                                                <li><a href="javascript:void(0);"><i class="icon-mail5"></i> One more action</a>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li><a href="javascript:void(0);"><i class="icon-gear"></i> Separated line</a> </li>
                                                            </ul>
                                                        </div>
                                                        <button class="btn btn-xs btn_white_table"><i class="icon-plus3"></i></button>
                                                    </td>

                                                    <td class="text-center">
                                                        <button class="btn btn-xs btn_white_table pr10"><?php echo $oContact->status == 1 ? '<i class="icon-primitive-dot txt_green"></i> Active' : '<i class="icon-primitive-dot txt_red"></i> Inactive'; ?></button>
                                                    </td>


                                                    <td class="text-center">
                                                        <div class="tdropdown">
                                                            <button type="button" class="btn btn-xs btn_white_table ml20 dropdown-toggle" data-toggle="dropdown"><i class="icon-more2 txt_blue"></i></button>
                                                            <ul class="dropdown-menu dropdown-menu-right width-200">


                                                                <?php
                                                                if ($oContact->status == 1) {
                                                                    ?><li><a subscriberId='<?php echo $oContact->id; ?>' change_status = '0' class='chg_status'><i class='icon-file-locked'></i> Inacive</a></li>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <li><a  subscriberId='<?php echo $oContact->id; ?>' change_status = '1' class='chg_status'><i class='icon-file-locked'></i> Active</a></li>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <li><a href="javascript:void(0);" class="editModuleSubscriber" data-modulesubscriberid="<?php echo $oContact->id; ?>" data-modulename="list" data-moduleaccountid="<?php echo $list_id; ?>" data-redirect="admin/lists/getListContacts?list_id=<?php echo $list_id; ?>"><i class="icon-pencil"></i> Edit</a></li>

                                                                <li><a class="deleteSubscriber" href="javascript:void(0);" subscriberid="<?php echo $oContact->id; ?>"><i class="icon-trash"></i> Delete</a></li>
                                                            </ul>
                                                        </div>


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
                    </div>


                </div>
                <!-- <div align="right" id="pagination_link"></div> -->
            </div>
        </div>

    </div>
</div>


<!-- /content area -->

<script type="text/javascript">
    $(document).ready(function () {
        
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

        $(document).on('click', '#deleteButtonListsContacts', function () {

            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                var elem = $(this);
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
							url: '<?php echo base_url('admin/lists/deleteMultipalListContact'); ?>',
							type: "POST",
							data: {multipalSubscriberId: val},
							dataType: "json",
							success: function (data) {
								if (data.status == 'success') {
									window.location.href = window.location.href
								} else {
									alertMessage('Error: Some thing wrong!');
									$('.overlaynew').hide();
								}
							}
						});
					}
				});
            }
        });


        $(document).on('click', '#archiveButtonListsContacts', function () {

            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                var elem = $(this);
                swal({
                    title: "Are you sure? You want to move to archive this record!",
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#EF5350",
                    confirmButtonText: "Yes, move to archive!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
				function (isConfirm) {
					if (isConfirm) {
						$('.overlaynew').show();
						$.ajax({
							url: '<?php echo base_url('admin/lists/archiveMultipalListContact'); ?>',
							type: "POST",
							data: {multipalSubscriberId: val},
							dataType: "json",
							success: function (data) {
								if (data.status == 'success') {
									window.location.href = window.location.href
								} else {
									alertMessage('Error: Some thing wrong!');
									$('.overlaynew').hide();
								}
							}
						});
					}
				});
            }
        });


        $(document).on("click", ".moveToArchiveListContact", function () {
            var subscriberId = $(this).attr('subscriberid');
            $.ajax({
                url: '<?php echo base_url('admin/lists/moveToArchiveListContact'); ?>',
                type: "POST",
                data: {subscriberId: subscriberId},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = window.location.href;
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        });

        $(document).on('click', '.chg_status', function () {
            var status = $(this).attr('change_status');
            var subscriberId = $(this).attr('subscriberId');

            $.ajax({
                url: '<?php echo base_url('admin/lists/updateContactStatus'); ?>',
                type: "POST",
                data: {status: status, subscriberId: subscriberId},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        //alertMessageAndRedirect(data.msg, window.location.href);
                        window.location.href = window.location.href;
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        });

        $(document).on('click', '.deleteSubscriber', function () {
            var subscriberId = $(this).attr('subscriberid');


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
			function () {
				$.ajax({
					url: '<?php echo base_url('admin/lists/deleteListContact'); ?>',
					type: "POST",
					data: {subscriberId: subscriberId},
					dataType: "json",
					success: function (data) {
						if (data.status == 'success') {
							//alertMessageAndRedirect(data.msg, window.location.href);
							//swal("Deleted!", "Your imaginary file has been deleted.", "success");
							window.location.href = window.location.href
						} else {
							alertMessage('Error: Some thing wrong!');
							$('.overlaynew').hide();
						}
					}
				});
			});
        });

        $(document).on('click', '.editArchiveDataList', function () {
            $('.editArchiveAction').toggle();
        });

        $(document).on('click', '.editDataList', function () {
            $('.editAction').toggle();
        });

    });
</script>
