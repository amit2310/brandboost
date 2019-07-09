<?php
$avatar = $aUInfo->avatar;
$firstname = $aUInfo->firstname;
$lastname = $aUInfo->lastname;
$userRole = $aUInfo->user_role;
$address = $aUInfo->address;
$hasweb_access = getMemberchatpermission($isLoggedInTeam);

/* if($userRole == '1'){

  $roleName = 'Administrator';
  }
  else if($userRole == '2'){

  $roleName = 'User';
  }
  else if($userRole == '3'){

  $roleName = 'Customer';
  }
  else{

  $roleName = '';
  } */
$username = $firstname . ' ' . $lastname;
if (!empty($avatar)) {
    $srcUserImg = '/profile_images/' . $avatar;
} else {
    $srcUserImg = '/profile_images/avatar_image.png';
}
$pageName = $this->uri->segment(2);

$onBrandBoostCount = getBBCount($aUInfo->id, 'onsite');
$onBrandBoostCount = $onBrandBoostCount > 0 ? '(' . $onBrandBoostCount . ')' : '';

$offBrandBoostCount = getBBCount($aUInfo->id, 'offsite');
$offBrandBoostCount = $offBrandBoostCount > 0 ? '(' . $offBrandBoostCount . ')' : '';
?>

<!-- Main sidebar -->
<!--<div class="sidebar sidebar-main sidebar-fixed">-->
    <div class="sidebar sidebar-main">
    <div class="sidebar-content">
        <!-- User menu -->
        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">
                    <a href="<?php echo base_url('/admin/dashboard/'); ?>" class="media-left"><img src="<?php echo base_url($srcUserImg); ?>" class="img-circle img-sm" alt=""></a>
                    <div class="media-body">
                        <span class="media-heading text-semibold"><?php echo $username; ?></span>
                        <div class="text-size-mini text-muted">
                            <i class="icon-pin text-size-small"></i> &nbsp; <?php //echo $address;    ?> Brand Boost, Inc. 
                        </div>
                    </div>

                    <div class="media-right media-middle">
                        <ul class="icons-list">
                            <li>
                                <a href="<?php echo base_url(); ?>admin/profile/"><i class="icon-cog3"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->
        <hr class="sidebar_divider">
		
		<a  href="javascript:void(0);" class="btn gr_btnn btn-success addMyCotact"><i class="icon-plus-circle2"></i><span> &nbsp; Add Contact </span> </a>


        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">


                <ul class="navigation navigation-main navigation-accordion">

                    <!-- Boosts -->
                    <li class="navigation-header"><span>Your Brand Boosts</span> <i class="icon-menu" title="Your Brand Boosts"></i></li>

                    <li class="<?php
                    if ($this->uri->segment(3) == 'onsite') {
                        echo 'active';
                    }
                    ?>"><a href="<?php echo base_url('/admin/brandboost/onsite'); ?>"><i class="icon-stack2"></i> <span>On Site Brand Boosts <?php echo $onBrandBoostCount; ?></span></a></li>
                    <li class="<?php
                    if ($this->uri->segment(3) == 'offsite') {
                        echo 'active';
                    }
                    ?>"><a href="<?php echo base_url('/admin/brandboost/offsite'); ?>"><i class="icon-stack2"></i> <span>Off Site Brand Boosts <?php echo $offBrandBoostCount; ?></span></a></li>

                    <li><hr class="sidebar_divider mt-10"></li>
                    <!-- Main -->
                    <li class="navigation-header"><span>Navigation</span> <i class="icon-menu" title="Main pages"></i>
                    </li>
                    <li class="<?php
                    if ($pageName != 'dashboard' && $pageName != '' && $pageName != 'brandboost') {
                        echo 'active';
                    }
                    ?>">
                    
                    <li><a href="<?php echo base_url('/admin/contacts/mycontacts'); ?>"><i class="icon-address-book"></i> <span>Contacts</span></a></li>
                    <li><a href="<?php echo base_url('/admin/lists/'); ?>"><i class="icon-file-text"></i> <span>Lists</span></a></li>
                    <li><a href="#"><i class="icon-hammer-wrench"></i> <span>Campaigns</span></a>
                        <ul>
                            <li><a href="<?php echo base_url('/admin/brandboost/onsite'); ?>"><i class="fa fa-check"></i> On Site Reviews <?php echo $onBrandBoostCount; ?></a>
                            </li>
                            <li><a href="<?php echo base_url('/admin/brandboost/offsite'); ?>"><i class="fa fa-check"></i> Off Site Reviews <?php echo $offBrandBoostCount; ?></a>
                            </li>

                        </ul>
                    </li>

                    
                    
                    <li>
                        <a href="#"><i class="icon-stack2"></i> <span>Your Reviews</span></a>
                        <ul>
                            <li><a href="<?php echo base_url(); ?>admin/brandboost/reviews/"><i class="icon-checkmark-circle"></i> Reviews</a></li>
                            <li><a href="<?php echo base_url(); ?>admin/feedback/listall/"><i class="icon-feed2"></i> Feedback</a></li>
                            <li><a href="<?php echo base_url('/admin/brandboost/review_request'); ?>"><i class="icon-bubbles2"></i> Review Requests</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-pie-chart"></i> <span>Analytics</span></a>
                    	<ul>
                            <li><a href="#"><i class="icon-envelop3"></i> Email Analytics</a></li>
                            <li><a href="#"><i class="icon-envelop2"></i> SMS Analytics</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="#"><i class="icon-newspaper2"></i> <span>Reports</span></a>
                    	<ul>
                            <li><a href="<?php echo base_url(); ?>admin/brandboost/reports"><i class="icon-menu6"></i> Reports</a></li>
                            <li><a href="<?php echo base_url(); ?>admin/brandboost/feedbackreports"><i class="icon-info22"></i> Reports Feedback</a></li>
                            <li><a href="<?php echo base_url(); ?>admin/report/brandboost/responseperformance"><i class="icon-list3"></i> Response Report</a></li>
                            <li><a href="<?php echo base_url(); ?>admin/report/brandboost/repResTimeTrends"><i class="icon-alarm-check"></i> Response Time Trends</a></li>
                            <li><a href="<?php echo base_url(); ?>admin/brandboost/servicereports"><i class="icon-users2"></i> Service Profile</a></li>
                            <li><a href="<?php echo base_url(); ?>admin/report/brandboost/reportsOptOut"><i class="icon-move-up"></i>Opt Out</a></li>
                            <li><a href="<?php echo base_url(); ?>admin/report/brandboost/insightTags"><i class="icon-price-tag3"></i> Reports Insight Tags</a></li>
                        </ul>
                    </li>
                    
                    <li><a href="<?php echo base_url(); ?>admin/brandboost/media"><i class="icon-bubbles6"></i> <span>Media</span></a></li>
                     
                    <?php if($hasweb_access->web_chat == 1 || $hasweb_access->sms_chat ==1) {?>
                    <li id="chat-onsite" class="listt0"><a href="javascript:void(0)"><strong class="nav_icon icon_chat"></strong> <span>Chat</span></a>
                        <ul id="Chat" class="hidden-ul">
                    <?php if($hasweb_access->sms_chat == 1){ ?> <li><a href="<?php echo base_url(); ?>admin/smschat"><i class="fa fa-circle"></i>Sms Chat</a></li> <?php } ?>
                           <?php if($hasweb_access->web_chat == 1){ ?>  <li><a href="<?php echo base_url(); ?>admin/webchat"><i class="fa fa-circle"></i>Web Chat</a></li><?php } ?>
                            <li><a href="<?php echo base_url(); ?>admin/chatshortcut"><i class="fa fa-circle"></i>Chat Shortcut</a></li>
                           
                        </ul>
                    </li>
                     <?php } ?>
                    
                    <li><a href="#"><i class="icon-puzzle4"></i> <span>Apps & Integrations</span></a></li>
                    <li><a href="#"><i class="icon-price-tag2"></i> <span>Insight Tags</span></a>
                        <ul>
                            <li><a href="<?php echo base_url(); ?>admin/tags/"><i class="fa fa-check"></i> Tag Management</a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>admin/tags/tagsreview"><i class="fa fa-check"></i> Tag Reviews</a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>admin/tags/tagsfeedback"><i class="fa fa-check"></i> Tag Feedbacks</a>
                            </li>

                        </ul>
                    </li>
                    <li><a href="#"><i class="icon-code"></i> <span>Sync Sources</span></a></li>
                    <li><a href="#"><i class="icon-grid"></i> <span>Competitor Insights</span></a></li>
                    <li><a href="#"><i class="fa fa-coffee"></i> <span>Tips And Ideas</span></a></li>
                    <li><a href="<?php echo base_url(); ?>admin/profile/"><i class="fa fa-cog"></i> <span>Account Settings</span></a></li>
                    <li><a href="#"><i class="fa fa-question-circle"></i> <span>Need Help?</span></a></li>
					<li class="navigation-header"><span>Emails Module</span> <i class="icon-menu" title="Email Modules"></i></li>
                    <li class="<?php
                        if ($pageName == 'lists') {
                            echo 'active';
                        }
                        ?>"><a href="<?php echo base_url('/admin/lists/'); ?>"><i class="icon-file-text"></i> <span>Lists</span></a></li>
                    <li class="<?php
                        if ($pageName == 'modules' && $pageSeName == 'emails') {
                            echo 'active';
                        }
                        ?>"><a href="<?php echo base_url('/admin/modules/emails'); ?>"><i class="icon-hammer-wrench"></i> <span>Email Automations</span></a>
                    <li class="<?php
                        if ($pageName == 'broadcast') {
                            echo 'active';
                        }
                        ?>"><a href="<?php echo base_url('/admin/broadcast/'); ?>"><i class="icon-hammer-wrench"></i> <span>Broadcast</span></a>

                    </li>

                    <li><hr class="sidebar_divider mt-10"></li>
                    <li class="navigation-header"><span>Referral Module</span> <i class="icon-menu" title="Referral Modules"></i></li>
                    <li class="<?php
                        if ($pageName == 'modules' && $pageSeName  == 'referral') {
                            echo 'active';
                        }
                        ?>"><a href="<?php echo base_url('/admin/modules/referral/'); ?>"><i class="icon-browser"></i> <span>Referral Programs</span></a>
                    </li>
<!--                    <li class="<?php
                        if ($pageName == 'modules' && $pageThName == 'dashboard') {
                            echo 'active';
                        }
                        ?>"><a href="<?php echo base_url('/admin/modules/referral/dashboard'); ?>"><i class="icon-browser"></i> <span>Dashboard</span></a></li>
                    
                    
                    <li class="<?php
                        if ($pageName == 'modules' && $pageThName == 'configuration') {
                            echo 'active';
                        }
                        ?>"><a href="<?php echo base_url('/admin/modules/referral/configuration'); ?>"><i class="fa fa-cog"></i> <span>Configurations</span></a></li>
                    <li class="<?php
                        if ($pageName == 'modules' && $pageThName == 'stats') {
                            echo 'active';
                        }
                        ?>"><a href="<?php echo base_url('/admin/modules/referral/stats'); ?>"><i class="fa fa-cog"></i> <span>Referral Stats</span></a></li>
                    <li class="<?php
                        if ($pageName == 'modules' && $pageSeName == 'referral' && empty($pageThName)) {
                            echo 'active';
                        }
                        ?>"><a href="<?php echo base_url('/admin/modules/referral'); ?>"><i class="icon-gift"></i> <span>Reward Management</span></a></li>
                    <li class="<?php
                        if ($pageName == 'modules' && $pageThName == 'integration') {
                            echo 'active';
                        }
                        ?>"><a href="<?php echo base_url('/admin/modules/referral/integration'); ?>"><i class="icon-puzzle4"></i> <span>Integrations</span></a></li>
                    <li class="<?php
                        if ($pageName == 'modules' && $pageThName == 'widgets') {
                            echo 'active';
                        }
                        ?>"><a href="<?php echo base_url('/admin/modules/referral/widgets'); ?>"><i class="icon-pushpin"></i> <span>Widgets</span></a></li>
                    <li class="<?php
                        if ($pageName == 'modules' && $pageThName == 'templates') {
                            echo 'active';
                        }
                        ?>"><a href="<?php echo base_url('/admin/modules/referral/templates'); ?>"><i class="icon-hammer-wrench"></i> <span>Email/Sms Templates</span></a></li>
                    
                    
                    <li class="<?php
                        if ($pageName == 'modules' && $pageThName == 'contacts') {
                            echo 'active';
                        }
                        ?>"><a href="<?php echo base_url('/admin/modules/referral/contacts'); ?>"><i class="icon-address-book"></i> <span>Referral Advocates</span></a></li>
                    <li class="<?php
                        if ($pageName == 'modules' && $pageThName == 'invites') {
                            echo 'active';
                        }
                        ?>"><a href="<?php echo base_url('/admin/modules/referral/invites'); ?>"><i class="icon-users4"></i> <span>Invite Advocates</span></a></li>
                    <li class="<?php
                        if ($pageName == 'modules' && $pageThName == 'reports') {
                            echo 'active';
                        }
                        ?>"><a href="<?php echo base_url('/admin/modules/referral/reports'); ?>"><i class="icon-newspaper2"></i> <span>Referral Report</span></a></li>
                    <li class="<?php
                        if ($pageName == 'modules' && $pageThName == 'invoices') {
                            echo 'active';
                        }
                        ?>"><a href="<?php echo base_url('/admin/modules/referral/invoices'); ?>"><i class="icon-calculator"></i> <span>Referral Invoice History</span></a></li>-->
                    <li><hr class="sidebar_divider mt-10"></li>
                    <li class="navigation-header"><span>NPS Module</span> <i class="icon-menu" title="NPS Modules"></i></li>
                    <li class="<?php
                        if ($pageName == 'modules' && $pageSeName == 'nps') {
                            echo 'active';
                        }
                        ?>"><a href="<?php echo base_url('/admin/modules/nps/'); ?>"><i class="icon-browser"></i> <span>NPS Programs</span></a>
                    </li>
					<li><hr class="sidebar_divider mt-10"></li>
                    <li class="navigation-header"><span>Chat Module</span> <i class="icon-menu" title="SMS Chat"></i></li>
                    <li class="<?php
                        if ($pageName == 'smschat') {
                            echo 'active';
                        }
                        ?>"><a href="<?php echo base_url('/admin/smschat'); ?>"><i class="icon-browser"></i> <span>SMS Chat</span></a>
                    </li>
                    <li><hr class="sidebar_divider mt-10"></li>
                    <!-- Our Affiliate Program -->
                    <li class="navigation-header"><span>Our Affiliate Program</span> <i class="icon-menu" title="Our Affiliate Program"></i></li>
                    <li><a href="#"><i class="icon-stack2"></i> <span>Sign Up Today</span></a></li>
                    <li><hr class="sidebar_divider mt-10"></li>

                    <!-- /page kits -->

                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>
<!-- /main sidebar -->