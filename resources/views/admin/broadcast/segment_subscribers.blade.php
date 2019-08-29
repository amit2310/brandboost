@extends('layouts.main_template') 

@section('title')
@endsection

@section('contents')
<!-- Content area -->
<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->

    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-3 mt20">
                <h3><img style="width: 18px;" src="{{ base_url() }}assets/images/menu_icons/Email_Light.svg">{{ $title }}</h3>

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
                                <li><a href="#"><i class="icon-more"></i></a> </li>
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
                                                <div class="col-md-12"> Content Goes here... </div>
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
                                                <div class="col-md-12"> Content Goes here... </div>
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
                                                <div class="col-md-12"> Content Goes here... </div>
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
                            <a style="display: inline-block;" href="#">Clear All</a>
                        </div>
                    </div>
                </div>

                @if (isset($campaignType) && $campaignType == 'Email')
                    <button type="button" class="btn bl_cust_btn new btn-default addBroadcast dark_btn ml20" broadcast_type="Email"><i class="icon-plus3"></i> &nbsp; Email Broadcast</button> 
                @endif
                @if (isset($campaignType) && $campaignType == 'SMS')
                    <button type="button" class="btn bl_cust_btn new btn-default addBroadcast dark_btn ml20" broadcast_type="SMS"><i class="icon-plus3"></i> &nbsp; SMS Broadcast</button>
                @endif
            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->
    @if (!empty($oSubscribers))
        <div class="tab-content"> 
            <!--===========TAB 1===========-->
            <div class="tab-pane active" id="right-icon-tab0">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Marketing campaigns -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <span class="pull-left">
                                    <h6 class="panel-title">Open &nbsp; &nbsp; <img class="mt-5" src="{{ base_url() }}assets/images/user_icon_white.png"/> &nbsp;   {{ count($oSubscribers) }} Contacts </h6>
                                </span>

                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                        <div class="form-control-feedback">
                                            <i class=""><img src="{{ base_url() }} assets/images/icon_search.png" width="14"></i>
                                        </div>
                                    </div>

                                    <div class="table_action_tool">
                                        <a href="javascript:void(0);" class="brig pr-15">Updated just now &nbsp; <i class=""><img src="<?php echo base_url(); ?>assets/images/icon_refresh.png"></i></a>
                                        <!-- <a href="javascript:void(0);"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_calender.png"></i></a>
                                        <a href="javascript:void(0);"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_download.png"></i></a>
                                        <a href="javascript:void(0);"><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_upload.png"></i></a> -->

                                        <a href="#"><i class=""><img src="{{ base_url() }}assets/images/icon_calender.png"></i></a>
                                        <a href="#"><i class=""><img src="{{ base_url() }}assets/images/icon_download.png"></i></a>
                                        <a href="#"><i class=""><img src="{{ base_url() }}assets/images/icon_upload.png"></i></a>
                                        <a href="javascript:void(0);"><i class="editDataListSeg"><img src="{{ base_url() }} assets/images/icon_edit.png"></i></a>

                                        <a href="javascript:void(0);" style="display: none;" title="delete" id="deleteButtonSegment" class="custom_action_box"><i class="icon-trash position-left"></i></a>
                                        <!-- <a href="javascript:void(0);" style="display: none;" title="archive" id="archiveButtonSegment" class="custom_action_box"><i class="icon-gear position-left"></i></a> -->
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body p0">
                                <table class="table datatable-basic">
                                        <thead>

                                            <tr>
                                                <!-- <th style="display: none;"></th>
                                                <th style="display: none;"></th>
                                                <th class="nosort editAction" style="width:30px;display:none;"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="control-primary" id="checkAll" ><span class="custmo_checkmark"></span></label></th>

                                                <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_name.png"></i>Name</th>
                                                <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_device.png"></i>Phone</th>
                                                <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_clock.png"></i>Created</th>
                                                <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_source.png"></i>Source</th>
                                                <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_social.png"></i>Social</th>
                                                <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_id.png"></i>Tags</th>
                                                <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_status.png"></i>Status</th> -->

                                                <th style="display: none;"></th>
                                                <th style="display: none;"></th>
                                                <th class="nosort editAction" style="width:30px;display:none;"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="control-primary" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
                                                <th><i class=""><img src="{{ base_url() }}assets/images/icon_name.png"></i>Name</th>
                                                <th class="text-right"><i class=""><img src="{{ base_url() }}assets/images/icon_device.png"></i>Phone</th>
                                                <th class="text-right"><i class=""><img src="{{ base_url() }}assets/images/icon_clock.png"></i>Created</th>
                                                <th class="text-right"><i class=""><img src="{{ base_url() }}assets/images/icon_source.png"></i>Source</th>
                                                <th><i class=""><img src="{{ base_url() }} assets/images/icon_social.png"></i>Social</th>
                                                <th><i class=""><img src="{{ base_url() }} assets/images/icon_id.png"></i>Tags</th>
                                                <th class="text-right"><i class=""><img src="{{ base_url() }}assets/images/icon_status.png"></i>Status</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            if (count($oSubscribers) > 0) {
                                                foreach ($oSubscribers as $oContact) {

                                                    $subscriberID = $oContact->globalSubscriberId;
                                                    $subscriberUserID = $oContact->subUserId;
                                                    $oTags = \App\Models\Admin\TagsModel::getSubscriberTags($subscriberID);
                                                    //pre($oTags);
                                                    $iTagCount = count($oTags);
                                                    $userData = '';
                                                    if ($oContact->status != '2') {

                                                        if ($oContact->user_id > 0) {
                                                            $userData = $oTags = \App\Models\Admin\UsersModel::getUserInfo($subscriberUserID);
                                                        }
                                                       
                                                        @endphp
                                                        <tr id="append-<?php echo $oContact->id; ?>" class="selectedClass">
                                                            <td style="display: none;">{{ date('m/d/Y', strtotime($oContact->created)) }}</td>
                                                            <td style="display: none;">{{ $oContact->id }}</td>

                                                            <td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" id="chk{{ $oContact->id }}" value="{{ $oContact->id }}" ><span class="custmo_checkmark"></span></label></td>


                                                            <!-- <td class="viewContactSmartPopup" data-modulesubscriberid="<?php echo $oContact->globalSubscriberId; ?>" data-modulename="<?php echo $moduleName; ?>">	
                                                                <div class="media-left media-middle"> <?php echo showUserAvtar($userData->avatar, $oContact->firstname, $oContact->lastname); ?> </div>
                                                                <div class="media-left">
                                                                    <div class="pt-5"><a href="javascript:void(0);" class="text-default text-semibold bbot"><?php if(empty($oContact->firstname) && empty($oContact->lastname)){ echo displayNoData();}else{ echo $oContact->firstname . ' '. $oContact->lastname; } ?></a> <img class="flags" src="<?php echo base_url(); ?>assets/images/flags/<?php echo strtolower($oContact->country_code); ?>.png" onerror="this.src='<?php echo base_url('assets/images/flags/us.png'); ?>'"/></div>
                                                                    <div class="text-muted text-size-small"><?php echo $oContact->email; ?></div>
                                                                </div>
                                                            </td> -->

                                                            <td>
                
       <div class="media-left media-middle"> {!! showUserAvtar($userData->avatar, $oContact->firstname, $oContact->lastname) !!} </div>
        <div class="media-left">
          <div class="pt-5"><a href="#" class="text-default text-semibold bbot"><span>@php if(empty($oContact->firstname) && empty($oContact->lastname)){ echo displayNoData();}else{ echo $oContact->firstname . ' '. $oContact->lastname; } @endphp</span>
          <img class="flags" src="<?php echo base_url(); ?>assets/images/flags/<?php echo strtolower($oContact->country_code); ?>.png" onerror="this.src='<?php echo base_url('assets/images/flags/us.png'); ?>'"/></a></div>
          <div class="text-muted text-size-small"><?php echo $oContact->email; ?></div>
        </div></td>

                                                            <!-- <td class="text-right viewContactSmartPopup" data-modulesubscriberid="<?php echo $oContact->globalSubscriberId; ?>" data-modulename="<?php echo $moduleName; ?>">
                                                                <div class="media-left">
                                                                    <div class="pt-5"><span class="text-default text-semibold dark"><?php echo $oContact->phone == '' ? displayNoData() : mobileNoFormat($oContact->phone); ?></span></div>
                                                                     <?php echo $oContact->phone == '' ? '' : '<div class="text-muted text-size-small">Chat</div>'; ?>
                                                                </div>
                                                            </td> -->

                                                            <td class="text-right viewContactSmartPopup" data-modulesubscriberid="<?php echo $oContact->globalSubscriberId; ?>" data-modulename="<?php echo $moduleName; ?>"><div class="media-left pull-right">
          <div class="pt-5"><a href="#" class="text-default text-semibold dark"><?php echo $oContact->phone == '' ? displayNoData() : mobileNoFormat($oContact->phone); ?></a></div>
          <?php echo $oContact->phone == '' ? '' : '<div class="text-muted text-size-small">Chat</div>'; ?>
        </div></td>

                                                           <!--  <td class="viewContactSmartPopup" data-modulesubscriberid="<?php echo $oContact->globalSubscriberId; ?>" data-modulename="<?php echo $moduleName; ?>">
                                                                <div class="media-left">
                                                                    <div class="pt-5"><span class="text-default text-semibold dark"><?php echo date('F dS Y', strtotime($oContact->created)); ?></span></div>
                                                                    <div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oContact->created)); ?></div>
                                                                </div>
                                                            </td> -->

                                                        <td class="text-right viewContactSmartPopup" data-modulesubscriberid="<?php echo $oContact->globalSubscriberId; ?>" data-modulename="<?php echo $moduleName; ?>"><div class="media-left pull-right">
          <div class="pt-5"><a href="javascript:void();" class="text-default text-semibold dark"><?php echo date('F dS Y', strtotime($oContact->created)); ?></a></div>
          <div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oContact->created)); ?></div>
        </div></td>

                                                            <!-- <td class="viewContactSmartPopup" data-modulesubscriberid="<?php echo $oContact->globalSubscriberId; ?>" data-modulename="<?php echo $moduleName; ?>">
                                                                <div class="media-left text-right">
                                                                    <div class="pt-5"><span class="text-default text-semibold dark">Email</span></div>
                                                                    <div class="text-muted text-size-small">Form #183</div>
                                                                </div>
                                                                <div class="media-left media-middle brig pr10"> <span class="icons s28"><img src="<?php echo base_url(); ?>assets/images/icon_round_email.png" class="img-circle img-xs" alt=""></span> </div>
                                                            </td> -->

                                                            <td class="text-right viewContactSmartPopup" data-modulesubscriberid="<?php echo $oContact->globalSubscriberId; ?>" data-modulename="<?php echo $moduleName; ?>">
       <div class="media-left text-right pull-right mt10 pr10 brig"> <a class="icons s28" href="javascript:void();"><img src="<?php echo base_url(); ?>assets/images/icon_round_email.png" class="img-circle img-xs" alt=""></a> </div>
        <div class="media-left text-right pull-right">
          <div class="pt-5"><a href="#" class="text-default text-semibold dark">Email</a></div>
          <div class="text-muted text-size-small">Form #183</div>
        </div>
        
        </td>

                                                            <td>
                                                                <a class="icons social" <?php if (!empty($oContact->twitter_profile)): ?>href="<?php echo $oContact->twitter_profile; ?>" target="_blank" title="View twitter profile" <?php else: ?>href="javascript:void(0);" title="This profile not found"<?php endif; ?>><img src="<?php echo base_url(); ?>assets/images/icons/twitter.svg"/></a> 
                                                                <a class="icons social"  <?php if (!empty($oContact->facebook_profile)): ?>href="<?php echo $oContact->facebook_profile; ?>" target="_blank" title="View facebook profile"<?php else: ?>href="javascript:void(0);" title="This profile not found"<?php endif; ?>><img src="<?php echo base_url(); ?>assets/images/icons/facebook.svg"/></a> 
                                                                <a class="icons social" href="<?php echo $oContact->socialProfile; ?>"><img src="<?php echo base_url(); ?>assets/images/icons/google.svg"/></a> 
                                                                <a class="icons social" href="mailto:<?php echo $oContact->email; ?>"><img src="<?php echo base_url(); ?>assets/images/icons/mail.svg"/></a>

                                                                <!-- 
                                                                        <a <?php if (!empty($oContact->twitter_profile)): ?>href="<?php echo $oContact->twitter_profile; ?>" target="_blank" title="View twitter profile" <?php else: ?>href="javascript:void(0);" title="This profile not found"<?php endif; ?>><button class="btn btn-xs plus_icon"><i class="icon-twitter txt_lblue" <?php if (empty($oContact->twitter_profile)): ?>style="color:#cccccc !important;"<?php endif; ?>></i></button></a>
                                                                        <a <?php if (!empty($oContact->facebook_profile)): ?>href="<?php echo $oContact->facebook_profile; ?>" target="_blank" title="View facebook profile"<?php else: ?>href="javascript:void(0);" title="This profile not found"<?php endif; ?>><button class="btn btn-xs plus_icon"><i class="icon-facebook txt_dblue" <?php if (empty($oContact->facebook_profile)): ?>style="color:#cccccc !important;"<?php endif; ?>></i></button></a>
                                                                        <a <?php if (!empty($oContact->linkedin_profile)): ?>href="<?php echo $oContact->linkedin_profile; ?>" target="_blank" title="View linkedin profile"<?php else: ?>href="javascript:void(0);" title="This profile not found"<?php endif; ?>><button class="btn btn-xs plus_icon"><i class="icon-linkedin txt_dblue" <?php if (empty($oContact->linkedin_profile)): ?>style="color:#cccccc !important;"<?php endif; ?>></i></button></a>
                                                                        <a <?php if (!empty($oContact->instagram_profile)): ?>href="<?php echo $oContact->instagram_profile; ?>" target="_blank" title="View instagram profile" <?php else: ?>href="javascript:void(0);" title="This profile not found"<?php endif; ?>><button class="btn btn-xs plus_icon"><i class="icon-instagram txt_dblue" <?php if (empty($oContact->instagram_profile)): ?>style="color:#cccccc !important;"<?php endif; ?>></i></button></a>
                                                                <?php if (!empty($oContact->phone)): ?>
                                                                                        <a href="javascript:void(0);" class="initsmschat" user_id="<?php echo $oContact->global_user_id; ?>" chat_class="sms_head" chat_type="SMS | <?php echo $oContact->phone; ?>" from_no="+123" to_no="<?php echo $oContact->phone; ?>" target="_blank"><button class="btn btn-xs plus_icon"><i class="icon-phone2 txt_green"></i></button></a>
                                                                <?php else: ?>
                                                                                        <a href="<?php echo $oContact->socialProfile; ?>" title="Contact Number not found" target="_blank"><button class="btn btn-xs plus_icon"><i class="icon-phone2 txt_green" style="color:#CCCCCC;"></i></button></a>
                                                                <?php endif; ?>
                                                                        <a href="mailto:<?php echo $oContact->email; ?>"><button class="btn btn-xs plus_icon"><i class="icon-envelop txt_blue" <?php if (empty($oContact->email)): ?>style="color:#cccccc !important;"<?php endif; ?>></i></button></a>
                                                                -->
                                                            </td>

                                                            <td id="tag_container_<?php echo $subscriberID; ?>">
                                                                <div class="media-left pl30 blef">
                                                                    <div class=""><a href="javascript:void(0);" class="text-default text-semibold bbot"><?php echo count($oTags); ?> Tags</a> </div>
                                                                </div>
                                                                <div class="media-left pr30 brig">
                                                                    <div class="tdropdown">
                                                                        <button class="btn btn-xs plus_icon dropdown-toggle ml10" data-toggle="dropdown" aria-expanded="false"><i class="icon-plus3"></i></button>
                                                                        <ul style="right: 0px!important;" class="dropdown-menu dropdown-menu-right tagss">
                                                                            <?php
                                                                            if (count($oTags) > 0) {
                                                                                foreach ($oTags as $oTag) {
                                                                                    ?>
                                                                                    <button class="btn btn-xs btn_white_table pr10"> <?php echo $oTag->tag_name; ?> </button>                                                            
                                                                                    <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                            <button class="btn btn-xs plus_icon ml10 applyInsightTags" data-subscriber-id="<?php echo $subscriberID; ?>"><i class="icon-plus3"></i></button>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td>
        <div class="media-left pull-right">
          <div class="tdropdown ml10"> <a class="table_more dropdown-toggle" data-toggle="dropdown"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a>
            <ul style="right: 0;" class="dropdown-menu dropdown-menu-right status">
              <li><a href="javascript:void();"><i class="icon-primitive-dot txt_green"></i> Active</a> </li>
              <li><a href="javascript:void();"><i class="icon-primitive-dot txt_grey"></i> Disable</a> </li>
              <li><a href="javascript:void();"><i class="icon-primitive-dot txt_red"></i> Archive</a> </li>
            </ul>
          </div>
        </div>
        <div class="media-left pull-right">
          <div class=""><?php echo ($oContact->status == 1) ? '<i class="icon-primitive-dot txt_green fsize16"></i>' : '<i class="icon-primitive-dot txt_red fsize16"></i>'; ?> <a class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown"><?php echo ($oContact->status == 1) ? ' Active' : ' Inactive'; ?></a> </div>
        </div>
        </td>

                                                            <!-- <td>
                                                                <div class="tdropdown">
                                                                    <?php echo ($oContact->status == 1) ? '<i class="icon-primitive-dot txt_green fsize16"></i>' : '<i class="icon-primitive-dot txt_red fsize16"></i>'; ?> <a class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown"><?php echo ($oContact->status == 1) ? ' Active' : ' Inactive'; ?></a> -->
                                                                    <!-- <ul style="right: 0;" class="dropdown-menu dropdown-menu-right status">
                                                                        <?php
                                                                        if ($oContact->status == 1) {
                                                                            ?><li><a class='changeModuleContactStatus' data-modulesubscriberid="<?php echo $oContact->globalSubscriberId; ?>" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $moduleUnitID; ?>" data_status = '0'><i class="icon-primitive-dot txt_grey"></i> Inactive</a></li>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <li><a class='<?php if ($oContact->status == 1): ?>changeModuleContactStatus<?php else: ?>changeModuleContactStatusDisabled<?php endif; ?>'  data-modulesubscriberid="<?php echo $oContact->globalSubscriberId; ?>" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $moduleUnitID; ?>" data_status = '1'><i class="icon-primitive-dot txt_green"></i> Active</a></li>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <li><a class="moveToArchiveModuleContact" href="javascript:void(0);" data-modulesubscriberid="<?php echo $oContact->globalSubscriberId; ?>" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $moduleUnitID; ?>"><i class="icon-primitive-dot txt_red"></i> Archive</a> </li>
                                                                    </ul> -->
                                                                <!-- </div>
                                                            </td> -->
                                                            
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


        </div>

<?php else: ?>

        <div class="tab-content"> 
            <!--===========TAB 1===========-->
            <div class="tab-pane active" id="right-icon-tab0">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Marketing campaigns -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title"><?php echo $iActiveCount; ?> Segment Contacts</h6>
                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                        <div class="form-control-feedback">
                                            <i class="icon-search4"></i>
                                        </div>
                                    </div>&nbsp; &nbsp;

                                    <button type="button" class="btn btn-xs btn-default "><i class="icon-pencil position-left"></i> Edit</button>
                                    <button id="" class="btn custom_action_box btn-xs">Delete</button>
                                    <button id="" class="btn custom_action_box btn-xs">Archive</button>
                                </div>
                            </div>
                            <div class="panel-body p0">
                                <table class="table datatable-basic datatable-sorting">
                                    <thead>
                                        <tr>
                                            <th style="display: none;"></th>
                                                <th style="display: none;"></th>
                                                <th class="nosort" style="width:30px;"><label class="custmo_checkbox pull-left" style="display:none;"><input type="checkbox" name="checkAll[]" class="control-primary" id="checkAll" ><span class="custmo_checkmark"></span></label></th>

                                                <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_name.png"></i>Name</th>
                                                <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_device.png"></i>Phone</th>
                                                <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_clock.png"></i>Created</th>
                                                <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_source.png"></i>Source</th>
                                                <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_social.png"></i>Social</th>
                                                <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_id.png"></i>Tags</th>
                                                <th><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_status.png"></i>Status</th>
                                                
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="9">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div style="margin: 20px 0px 0;" class="text-center">

                                                            <h5 class="mb-20 mt40">
                                                                No Contact(s) Found in this segment
                                                            </h5>


                                                            

                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="display: none;"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endif


</div>

<div id="subscriberTagListsModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" name="frmSubscriberApplyTag" id="frmSubscriberApplyTag" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Apply Tags</h5>
                </div>
                <div class="modal-body" id="tagEntireList"></div>
                <div class="modal-footer modalFooterBtn">
                    <input type="hidden" name="tag_subscriber_id" id="tag_subscriber_id" />
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Apply Tag</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/js/modules/people/subscribers.js" type="text/javascript"></script> 
<script>

    $(document).ready(function () {

        $(document).on('click', '#deleteButtonSegment', function () {
            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                deleteConfirmationPopup(
                "This segment will deleted immediately.<br>You can't undo this action.", 
                function() {

                    $('.overlaynew').show();
                    $.ajax({
                        url: "<?php echo base_url('admin/broadcast/deleteMultipalSegmentUser'); ?>",
                        type: "POST",
                        data: {multiSegmentUserid: val},
                        dataType: "json",
                        success: function (data) {
                            if (data.status == 'success') {
                                location.reload();
                            } else {
                                alert("Having some error.");
                            }
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                });
            }
        });


        $('[data-toggle="tooltip"]').tooltip();

        $('.addBroadcast').click(function () {
            $('.campaignContainer .hide_sms, .campaignContainer .hide_email').show();
            if ($(this).attr('broadcast_type') == 'Email') {
                $('.campaignContainer .hide_sms').hide();
            } else {
                $('.campaignContainer .hide_email').hide();
            }
            $('#broadCastType').val($(this).attr('broadcast_type'));
            $("#addBroadcast").modal();
        });

        $('.hideABModalBox').click(function () {
            $("#addBroadcast").modal('hide');
        });

        $('.select_campaign_box').click(function () {
            var templateID = $(this).attr('template_id');
            var templateContent = $(this).attr('template_content');
            $('#campaignTemplateID').val(templateID);
            $('#campaignTemplateContant').val(templateContent);
            $('.select_campaign_box').css('border', '1px solid #e6e6e6');
            $(this).css('border', '3px solid #1F8EE7');
        });

        $('.editBroadcast').click(function () {
            var broadcastId = $(this).attr('broadcast_id');
            var broadcastTitle = $(this).attr('broadcast_title');
            var broadcastDes = $(this).attr('broadcast_des');
            $('#edit_broadcast').val(broadcastTitle);
            $('#edit_description').val(broadcastDes);
            $('#edit_broadcastId').val(broadcastId);
            $("#updateBroadcast").modal();
        });

        
        $(document).on('click', '.editDataListSeg', function () {
            $('.editAction').toggle();
        });

    });
</script>	
@endsection
