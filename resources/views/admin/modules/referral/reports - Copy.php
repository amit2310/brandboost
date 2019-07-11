<style>
    .panel-body p{ font-size: 16px;}

    .highlighted { color:#008000;font-size:15px !important;}
</style>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/datatables_sorting_date.js"></script>
<!-- Content area -->

<?php
$totalEmailSent = $totalSmsSent = 0;
if (!empty($oTotalReferralSent)) {

    foreach ($oTotalReferralSent as $sentCount) {

        if ($sentCount->campaign_type == 'email') {
            $totalEmailSent = ($sentCount->totalCount) ? $sentCount->totalCount : 0;
        }

        if ($sentCount->campaign_type == 'sms') {
            $totalSmsSent = ($sentCount->totalCount) ? $sentCount->totalCount : 0;
        }
    }
}
$totalDelivered = $totalOpened = $totalProcessed = $totalClicked = 0;
if (!empty($oTotalReferralTwillio)) {
    foreach ($oTotalReferralTwillio as $twilliRec) {
        if ($twilliRec->event_name == 'delivered') {
            $totalDelivered = $twilliRec->totalCount;
        } else if ($twilliRec->event_name == 'open') {
            $totalOpened = $twilliRec->totalCount;
        } else if ($twilliRec->event_name == 'processed') {
            $totalProcessed = $twilliRec->totalCount;
        } else if ($twilliRec->event_name == 'clicked') {
            $totalClicked = $twilliRec->totalCount;
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
                <h3><i class="icon-star-half"></i> &nbsp; Referral Report</h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="active"><a href="#Trackedtab" data-toggle="tab"> Tracked Sales </a></li>
                    <li class=""><a href="#Untrackedtab" data-toggle="tab"> Untracked Sales </a></li>
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
                            <a style="display: inline-block;" href="#">Clear All</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->

    <!-- Dashboard content -->
    <div class="tab-content"> 

        <div class="panel-body">
            <p><strong>Referral email sent: </strong><?php echo $totalEmailSent; ?></p>
            <p><strong>Referral sms sent: </strong><?php echo $totalSmsSent; ?></p>
            <p><strong>Opens :</strong> <?php echo $totalOpened; ?></p>
            <p><strong>Clicks :</strong> <?php echo $totalClicked; ?></p>
            <p><strong>Referral Link(Landing Page) Visits: </strong><?php echo (count($oRefVisits)) ? count($oRefVisits) : 0; ?></p>
            <p><strong>Purchases by referred customer: </strong>$<?php echo ($referredAmount) ? $referredAmount : 0; ?></p>
            <p><strong>Total Untracked Sales: </strong><?php echo (count($oUntrackedPurchased)) ? count($oUntrackedPurchased) : 0; ?></p>
            <p><strong>Total Untracked Sales Amount: </strong>$<?php echo ($untrackedAmount) ? $untrackedAmount : 0; ?></p>

        </div>

        <div class="tab-pane active" id="Trackedtab">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Marketing campaigns -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Tracked Sales</h6>
                            <div class="heading-elements">
                                <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                    <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                    <div class="form-control-feedback">
                                        <i class="icon-search4"></i>
                                    </div>
                                </div>&nbsp; &nbsp;
                            </div>
                        </div>
                        
                        <div class="panel-body p0">
                          <table class="table text-nowrap datatable-sorting" id="allContact">
                        <thead>
                            <tr>
                                <th class="col-md-3">Referred Friend</th>
                                <th class="col-md-3">Referrer</th>
                                <th class="col-md-1">Amount</th>
                                <th class="col-md-2">Date</th>
                                <th class="col-md-2 text-center">Applied Tags</th>
                                <th class="col-md-2 text-center">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $inc = 1;
                            foreach ($oRefPurchased as $data) {
                                $oTags = $this->mReferral->getTagsBySaleID($data->id);
                                //pre($data);
                                //$profileImg = $data->avatar == '' ? base_url('/profile_images/avatar_image.png') : base_url('profile_images/' . $data->avatar);
                                ?>
                                <tr>
                                    <td>            
                                        <div style="vertical-align: top!important;" class="media-left media-middle">
                                            <a href="#">
                                                <img src="http://brandboost.io/admin_new/images/userp.png" class="img-circle img-xs" alt="">
                                            </a>
                                        </div>
                                        <div class="media-left">
                                            <a href="javascript:void()" class="text-default text-semibold"><?php echo $data->firstname; ?> <?php echo $data->lastname; ?></a>
                                            <div class="text-muted text-size-small"><?php echo $data->email; ?></div>
                                            <div class="text-muted text-size-small"><?php echo $data->phone == '' ? '<span style="color:#999999">Phone Unavailable</span>' : $data->phone; ?></div>
                                        </div>
                                    </td>

                                    <td>
                                        <div style="vertical-align: top!important;" class="media-left media-middle">
                                            <a href="#">
                                                <img src="http://brandboost.io/admin_new/images/userp.png" class="img-circle img-xs" alt="">
                                            </a>
                                        </div>
                                        <div class="media-left">
                                            <a href="javascript:void()" class="text-default text-semibold"><?php echo $data->aff_firstname; ?> <?php echo $data->aff_lastname; ?></a>
                                            <div class="text-muted text-size-small"><?php echo $data->aff_email; ?></div>
                                            <div class="text-muted text-size-small"><?php echo $data->aff_mobile == '' ? '<span style="color:#999999">Phone Unavailable</span>' : $data->aff_mobile; ?></div>
                                        </div>
                                    </td>

                                    <td><?php echo $data->currency; ?><?php echo $data->amount; ?></td>
                                    <td><h6 class="text-semibold"><?php echo date('M d, Y', strtotime($data->created)); ?><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($data->created)) . ' (' . timeAgo($data->created) . ')'; ?></div></h6></td>
                                    <td class="media_review text-center">
                                        <span class="label bg-success viewtags">View Tags
                                            <?php if (count($oTags) > 0) { ?>
                                                <div class="tagspop">
                                                    <?php
                                                    foreach ($oTags as $tagsData) {
                                                        echo '<span class="label bg-success heading-text">' . $tagsData->tag_name . '</span>';
                                                    }
                                                    ?>
                                                </div>
                                            <?php } ?>
                                        </span>

                                        <a href="javascript:void(0);" class="applyInsightTags" action_name="referral-tag" saleid="<?php echo $data->id; ?>" ><span class="label bg-success addtag heading-text">+ Add Tag</span></a>


                                    </td>
                                    <td>
                                        <a href="<?php echo base_url("admin/modules/referral/saledetails/".$data->id);?>" target="_blank">Details</a>
                                    </td>


                                </tr>
                                <?php
                                $inc++;
                            }
                            ?>
                        </tbody>
                    </table>
                        </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="tab-pane" id="Untrackedtab">
             <div class="row">
                <div class="col-lg-12">
                    <!-- Marketing campaigns -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Untracked Sales</h6>
                            <div class="heading-elements">
                                <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                    <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                    <div class="form-control-feedback">
                                        <i class="icon-search4"></i>
                                    </div>
                                </div>&nbsp; &nbsp;
                            </div>
                        </div>
                        
                        <div class="panel-body p0">
                          <table class="table text-nowrap datatable-sorting" id="allContact">
                                <thead>
                                    <tr>
                                        <th class="col-md-3">Referred Friend</th>
                                        <th class="col-md-3">Referrer</th>
                                        <th class="col-md-1">Amount</th>
                                        <th class="col-md-2">Date</th>
                                        <th class="col-md-2 text-center">Applied Tags</th>
                                        <th class="col-md-2 text-center">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $inc = 1;
                                    foreach ($oUntrackedPurchased as $data) {
                                        $oTags = $this->mReferral->getTagsBySaleID($data->id);
                                        //pre($data);
                                        //$profileImg = $data->avatar == '' ? base_url('/profile_images/avatar_image.png') : base_url('profile_images/' . $data->avatar);
                                        ?>
                                        <tr>
                                            <td>            
                                                <div style="vertical-align: top!important;" class="media-left media-middle">
                                                    <a href="#">
                                                        <img src="http://brandboost.io/admin_new/images/userp.png" class="img-circle img-xs" alt="">
                                                    </a>
                                                </div>
                                               
                                                <div class="media-left">
                                                    <a href="javascript:void()" class="text-default text-semibold"><?php echo $data->firstname; ?> <?php echo $data->lastname; ?></a>
                                                    <div class="text-muted text-size-small"><?php echo $data->email; ?></div>
                                                    <div class="text-muted text-size-small"><?php echo $data->mobile == '' ? '<span style="color:#999999">Phone Unavailable</span>' : $data->mobile; ?></div>
                                                </div>
                                                
                                            </td>

                                            <td>
                                                <div style="vertical-align: top!important;" class="media-left media-middle">
                                                    <a href="#">
                                                        <img src="http://brandboost.io/admin_new/images/userp.png" class="img-circle img-xs" alt="">
                                                    </a>
                                                </div>
                                                 <?php if(!empty($data->aff_email)): ?>
                                                <div class="media-left">
                                                    <a href="javascript:void()" class="text-default text-semibold"><?php echo $data->aff_firstname; ?> <?php echo $data->aff_lastname; ?></a>
                                                    <div class="text-muted text-size-small"><?php echo $data->aff_email; ?></div>
                                                    <div class="text-muted text-size-small"><?php echo $data->aff_mobile == '' ? '<span style="color:#999999">Phone Unavailable</span>' : $data->aff_mobile; ?></div>
                                                </div>
                                                <?php else: ?>
                                                <div class="media-left">
                                                    N/A
                                                </div>
                                                <?php endif; ?>
                                            </td>

                                            <td><?php echo $data->currency; ?><?php echo $data->amount; ?></td>
                                            <td><h6 class="text-semibold"><?php echo date('M d, Y', strtotime($data->created)); ?><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($data->created)) . ' (' . timeAgo($data->created) . ')'; ?></div></h6></td>
                                            <td class="media_review text-center">
                                                <span class="label bg-success viewtags">View Tags
                                                    <?php if (count($oTags) > 0) { ?>
                                                        <div class="tagspop">
                                                            <?php
                                                            foreach ($oTags as $tagsData) {
                                                                echo '<span class="label bg-success heading-text">' . $tagsData->tag_name . '</span>';
                                                            }
                                                            ?>
                                                        </div>
                                                    <?php } ?>
                                                </span>

                                                <a href="javascript:void(0);" class="applyInsightTags" action_name="referral-tag" saleid="<?php echo $data->id; ?>" ><span class="label bg-success addtag heading-text">+ Add Tag</span></a>


                                            </td>
                                            <td>
                                                <a href="<?php echo base_url("admin/modules/referral/saledetails/".$data->id);?>" target="_blank">Details</a>
                                            </td>


                                        </tr>
                                        <?php
                                        $inc++;
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

<?php /* ?>
<div class="tab-content"> 
    <div class="row">
        <div class="col-lg-12">
            <!-- Marketing campaigns -->
            <div class="panel panel-flat">
                

                
                
                <div class="tabbable">
 
 <div class="tab-content">
   <!--########################TAB 1 ##########################-->
   <div class="tab-pane active" id="Trackedtab">
      <div class="table-responsive">
                    <input name="min" id="min" type="hidden">
                    <input name="max" id="max" type="hidden">
                    <table class="table text-nowrap datatable-sorting" id="allContact">
                        <thead>
                            <tr>
                                <th class="col-md-3">Referred Friend</th>
                                <th class="col-md-3">Referrer</th>
                                <th class="col-md-1">Amount</th>
                                <th class="col-md-2">Date</th>
                                <th class="col-md-2 text-center">Applied Tags</th>
                                <th class="col-md-2 text-center">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $inc = 1;
                            foreach ($oRefPurchased as $data) {
                                $oTags = $this->mReferral->getTagsBySaleID($data->id);
                                //pre($data);
                                //$profileImg = $data->avatar == '' ? base_url('/profile_images/avatar_image.png') : base_url('profile_images/' . $data->avatar);
                                ?>
                                <tr>
                                    <td>			
                                        <div style="vertical-align: top!important;" class="media-left media-middle">
                                            <a href="#">
                                                <img src="http://brandboost.io/admin_new/images/userp.png" class="img-circle img-xs" alt="">
                                            </a>
                                        </div>
                                        <div class="media-left">
                                            <a href="javascript:void()" class="text-default text-semibold"><?php echo $data->firstname; ?> <?php echo $data->lastname; ?></a>
                                            <div class="text-muted text-size-small"><?php echo $data->email; ?></div>
                                            <div class="text-muted text-size-small"><?php echo $data->phone == '' ? '<span style="color:#999999">Phone Unavailable</span>' : $data->phone; ?></div>
                                        </div>
                                    </td>

                                    <td>
                                        <div style="vertical-align: top!important;" class="media-left media-middle">
                                            <a href="#">
                                                <img src="http://brandboost.io/admin_new/images/userp.png" class="img-circle img-xs" alt="">
                                            </a>
                                        </div>
                                        <div class="media-left">
                                            <a href="javascript:void()" class="text-default text-semibold"><?php echo $data->aff_firstname; ?> <?php echo $data->aff_lastname; ?></a>
                                            <div class="text-muted text-size-small"><?php echo $data->aff_email; ?></div>
                                            <div class="text-muted text-size-small"><?php echo $data->aff_mobile == '' ? '<span style="color:#999999">Phone Unavailable</span>' : $data->aff_mobile; ?></div>
                                        </div>
                                    </td>

                                    <td><?php echo $data->currency; ?><?php echo $data->amount; ?></td>
                                    <td><h6 class="text-semibold"><?php echo date('M d, Y', strtotime($data->created)); ?><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($data->created)) . ' (' . timeAgo($data->created) . ')'; ?></div></h6></td>
                                    <td class="media_review text-center">
                                        <span class="label bg-success viewtags">View Tags
                                            <?php if (count($oTags) > 0) { ?>
                                                <div class="tagspop">
                                                    <?php
                                                    foreach ($oTags as $tagsData) {
                                                        echo '<span class="label bg-success heading-text">' . $tagsData->tag_name . '</span>';
                                                    }
                                                    ?>
                                                </div>
                                            <?php } ?>
                                        </span>

                                        <a href="javascript:void(0);" class="applyInsightTags" action_name="referral-tag" saleid="<?php echo $data->id; ?>" ><span class="label bg-success addtag heading-text">+ Add Tag</span></a>


                                    </td>
                                    <td>
                                        <a href="<?php echo base_url("admin/modules/referral/saledetails/".$data->id);?>" target="_blank">Details</a>
                                    </td>


                                </tr>
                                <?php
                                $inc++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
   </div>
   <!--########################TAB 2 ##########################-->
   <div class="tab-pane" id="Untrackedtab"> 
       <div class="table-responsive">
                    <input name="min" id="min" type="hidden">
                    <input name="max" id="max" type="hidden">
                    <table class="table text-nowrap datatable-sorting" id="allContact">
                        <thead>
                            <tr>
                                <th class="col-md-3">Referred Friend</th>
                                <th class="col-md-3">Referrer</th>
                                <th class="col-md-1">Amount</th>
                                <th class="col-md-2">Date</th>
                                <th class="col-md-2 text-center">Applied Tags</th>
                                <th class="col-md-2 text-center">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $inc = 1;
                            foreach ($oUntrackedPurchased as $data) {
                                $oTags = $this->mReferral->getTagsBySaleID($data->id);
                                //pre($data);
                                //$profileImg = $data->avatar == '' ? base_url('/profile_images/avatar_image.png') : base_url('profile_images/' . $data->avatar);
                                ?>
                                <tr>
                                    <td>			
                                        <div style="vertical-align: top!important;" class="media-left media-middle">
                                            <a href="#">
                                                <img src="http://brandboost.io/admin_new/images/userp.png" class="img-circle img-xs" alt="">
                                            </a>
                                        </div>
                                       
                                        <div class="media-left">
                                            <a href="javascript:void()" class="text-default text-semibold"><?php echo $data->firstname; ?> <?php echo $data->lastname; ?></a>
                                            <div class="text-muted text-size-small"><?php echo $data->email; ?></div>
                                            <div class="text-muted text-size-small"><?php echo $data->mobile == '' ? '<span style="color:#999999">Phone Unavailable</span>' : $data->mobile; ?></div>
                                        </div>
                                        
                                    </td>

                                    <td>
                                        <div style="vertical-align: top!important;" class="media-left media-middle">
                                            <a href="#">
                                                <img src="http://brandboost.io/admin_new/images/userp.png" class="img-circle img-xs" alt="">
                                            </a>
                                        </div>
                                         <?php if(!empty($data->aff_email)): ?>
                                        <div class="media-left">
                                            <a href="javascript:void()" class="text-default text-semibold"><?php echo $data->aff_firstname; ?> <?php echo $data->aff_lastname; ?></a>
                                            <div class="text-muted text-size-small"><?php echo $data->aff_email; ?></div>
                                            <div class="text-muted text-size-small"><?php echo $data->aff_mobile == '' ? '<span style="color:#999999">Phone Unavailable</span>' : $data->aff_mobile; ?></div>
                                        </div>
                                        <?php else: ?>
                                        <div class="media-left">
                                            N/A
                                        </div>
                                        <?php endif; ?>
                                    </td>

                                    <td><?php echo $data->currency; ?><?php echo $data->amount; ?></td>
                                    <td><h6 class="text-semibold"><?php echo date('M d, Y', strtotime($data->created)); ?><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($data->created)) . ' (' . timeAgo($data->created) . ')'; ?></div></h6></td>
                                    <td class="media_review text-center">
                                        <span class="label bg-success viewtags">View Tags
                                            <?php if (count($oTags) > 0) { ?>
                                                <div class="tagspop">
                                                    <?php
                                                    foreach ($oTags as $tagsData) {
                                                        echo '<span class="label bg-success heading-text">' . $tagsData->tag_name . '</span>';
                                                    }
                                                    ?>
                                                </div>
                                            <?php } ?>
                                        </span>

                                        <a href="javascript:void(0);" class="applyInsightTags" action_name="referral-tag" saleid="<?php echo $data->id; ?>" ><span class="label bg-success addtag heading-text">+ Add Tag</span></a>


                                    </td>
                                    <td>
                                        <a href="<?php echo base_url("admin/modules/referral/saledetails/".$data->id);?>" target="_blank">Details</a>
                                    </td>


                                </tr>
                                <?php
                                $inc++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div> 
   </div>
   <!--########################TAB end ##########################-->
 </div>
</div>


            </div>
            <!-- <div align="right" id="pagination_link"></div> -->
        </div>
    </div>
</div>
<?php */ ?>

</div>
<!-- /content area -->



<!-- =======================add users popup========================= -->

<div id="userLevelAdd" class="modal fade">
    <div class="modal-dialog">

        <div class="modal-content">
            <form method="post" class="form-horizontal" id="addUsers" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Add Users</h5>
                </div>

                <div class="modal-body">

                    <div class="alert-danger" style="margin-bottom:10px;"><?php echo $this->session->userdata('error_message'); ?>
                        <?php echo validation_errors(); ?></div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">First Name</label>
                        <div class="col-lg-9">
                            <input name="firstname" id="firstname" class="form-control" type="text" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Last Name</label>
                        <div class="col-lg-9">
                            <input name="lastname" id="lastname" class="form-control" value="" type="text" required>
                        </div>
                    </div>

                    <div class="form-group" id="emailDiv">
                        <label class="control-label  col-lg-3">Email</label>
                        <div class="col-lg-9">
                            <input name="email" id="email" class="form-control" value="" type="text" required>
                            <div id="msgEmail"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Phone</label>
                        <div class="col-lg-9">
                            <input name="phone" id="phone" class="form-control" value="" type="text" required>
                        </div>
                    </div>

                    <div class="form-group mb0">
                        <label class="control-label col-lg-3">Zip Code</label>
                        <div class="col-lg-9">
                            <input name="zip" id="zip" class="form-control" value="" type="text" required>
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <input type="hidden" name="userID" id="userID" value="">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" id="addButton" class="btn btn-primary"><i class="icon-check"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- =======================edit users popup========================= -->

<div id="userLevelEdit" class="modal fade">
    <div class="modal-dialog">

        <div class="modal-content">
            <form method="post" class="form-horizontal" id="updateUsers" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Edit Users</h5>
                </div>
                <div class="modal-body">

                    <div class="alert-danger" style="margin-bottom:10px;"><?php echo $this->session->userdata('error_message'); ?>
                        <?php echo validation_errors(); ?></div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">First Name</label>
                        <div class="col-lg-9">
                            <input name="firstname" id="e_firstname" class="form-control" type="text" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Last Name</label>
                        <div class="col-lg-9">
                            <input name="lastname" id="e_lastname" class="form-control" value="" type="text" required>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-lg-3">Phone</label>
                        <div class="col-lg-9">
                            <input name="phone" id="e_phone" class="form-control" value="" type="text" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Zip Code</label>
                        <div class="col-lg-9">
                            <input name="zip" id="e_zip" class="form-control" value="" type="text" required>
                        </div>
                    </div>

                    <div class="form-group mb0">
                        <label class="control-label col-lg-3">Twilio Status</label>
                        <div class="col-lg-9">
                            <select name="e_twilio_status" id="e_twilio_status" class="form-control">
                                <option value="">Select Twilio Status Type</option>
                                <option value="active">Active</option>
                                <option value="suspended">Suspend</option>
                                <option value="closed">Disable</option>
                            </select>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <input type="hidden" name="userID" id="e_userID" value="">
                    <input type="hidden" name="e_infusion_user_id" id="e_infusion_user_id" value="">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" id="updateButton" class="btn btn-primary"><i class="icon-check"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="ReferralTagListModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" name="frmReferralTagListModal" id="frmReferralTagListModal" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Apply Tags</h5>
                </div>
                <div class="modal-body" id="tagEntireList"></div>
                <div class="modal-footer modalFooterBtn">
                    <input type="hidden" name="sale_id" id="tag_sale_id" />
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Apply Tag</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {

        $(document).on("click", ".applyInsightTags", function () {
            var sale_id = $(this).attr("saleid");
            var action_name = $(this).attr("action_name");
            $.ajax({
                url: '<?php echo base_url('admin/modules/referral/listAllTags'); ?>',
                type: "POST",
                data: {sale_id: sale_id},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        var dataString = data.list_tags;
                        if (dataString.search('have any tags yet :-') > 0) {
                            $('.modalFooterBtn').hide();
                        } else {
                            $('.modalFooterBtn').show();
                        }
                        $("#tagEntireList").html(dataString);
                        $("#tag_sale_id").val(sale_id);
                        if (action_name == 'referral-tag') {
                            $("#ReferralTagListModal").modal("show");
                        }
                    }
                }
            });
        });


        $("#frmReferralTagListModal").submit(function () {
            var formdata = $("#frmReferralTagListModal").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/modules/referral/applySaleTag'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#ReferralTagListModal").modal("hide");
                        window.location.href = window.location.href;
                    }
                }
            });
            return false;
        });



        $("#email").on("keyup", function () {
            var sEmail = $("#email").val();
            if (sEmail != '') {
                $.ajax({
                    url: "<?php echo base_url('admin/users/checkEmailExist'); ?>",
                    type: "POST",
                    data: {emailID: sEmail},
                    dataType: "json",
                    success: function (data) {

                        if (data.status == 'success') {

                            $('#emailDiv').addClass('has-error has-feedback');
                            $("#msgEmail").show();
                            $("#msgEmail").html('Email already exist.');
                            $('#addButton').prop("disabled", true);
                        } else {

                            $('#emailDiv').removeClass('has-error has-feedback');
                            $("#msgEmail").hide();
                            $("#msgEmail").html('');
                            $('#addButton').prop("disabled", false);
                        }
                    }
                });
            }
        });

        $(document).on('click', '.userDelete', function () {

            $('.overlaynew').show();
            var conf = confirm("Are you sure? You want to delete this user!");
            if (conf == true) {

                var userID = $(this).attr('userID');
                var contactID = $(this).attr('contactID');
                $.ajax({
                    url: '<?php echo base_url('admin/users/user_delete'); ?>',
                    type: "POST",
                    data: {userID: userID, contactID: contactID},
                    dataType: "json",
                    success: function (data) {

                        if (data.status == 'success') {

                            alertMessageAndRedirect('User has been delete successfully.', window.location.href);

                        } else {

                            alertMessage('Error: Some thing wrong!');
                            $('.overlaynew').hide();
                        }
                    }
                });
            } else {
                $('.overlaynew').hide();
            }

        });

        $(document).on('click', '.userEdit', function () {

            var userID = $(this).attr('userID');
            $.ajax({
                url: '<?php echo base_url('admin/users/getUserById'); ?>',
                type: "POST",
                data: {userID: userID},
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {
                        var mem = data.result[0];

                        $('#e_firstname').val(mem.firstname);
                        $('#e_lastname').val(mem.lastname);
                        $('#e_phone').val(mem.mobile);
                        $('#e_zip').val(mem.zip_code);
                        $('#e_userID').val(mem.id);
                        $('#e_twilio_status').val(mem.twilio_subaccount_status);
                        $('#e_infusion_user_id').val(mem.infusion_user_id);

                        $("#userLevelEdit").modal();

                    } else {

                    }
                }
            });
        });

        $("#updateUsers").submit(function () {

            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            var twilioStatus = $('#e_twilio_status').val();
            if (twilioStatus == 'suspended' || twilioStatus == 'closed') {
                var conf = confirm("Do you want to delete long form SMS number?");
            } else {
                var conf = true;
            }
            if (conf == true) {
                $.ajax({
                    url: '<?php echo base_url('admin/users/user_update'); ?>',
                    type: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {

                        if (data.status == 'success') {

                            alertMessageAndRedirect('User has been update successfully.', window.location.href);
                        } else {

                            alertMessage('Error: Some thing wrong!');
                            $('.overlaynew').hide();
                        }
                    }
                });
            } else {
                $('.overlaynew').hide();
            }
        });


        $("#addUsers").submit(function () {

            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $('#addButton').prop("disabled", true);
            $.ajax({
                url: '<?php echo base_url('admin/users/user_add'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {

                        alertMessageAndRedirect('User has been add successfully.', window.location.href);

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
            var userId = $(this).attr('userId');

            $.ajax({
                url: '<?php echo base_url('admin/users/update_status'); ?>',
                type: "POST",
                data: {status: status, user_id: userId},
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {

                        alertMessageAndRedirect('User has been update successfully.', window.location.href);

                    } else {

                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });

    });
</script>		
