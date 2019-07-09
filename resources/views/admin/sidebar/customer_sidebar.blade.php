<?php
$avatar = $aUInfo->avatar;
$firstname = $aUInfo->firstname;
$lastname = $aUInfo->lastname;
$userRole = $aUInfo->user_role;
$address = $aUInfo->address;


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

$pageName = $this->uri->segment(2);
$pageSeName = $this->uri->segment(3);
$pageThName = $this->uri->segment(4);
?>

<!-- Main sidebar -->
<!--<div class="sidebar sidebar-main sidebar-fixed">-->
<div class="sidebar sidebar-main">
    <div class="sidebar-content">
      
        
        

        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">


                <ul class="navigation navigation-main navigation-accordion">

                    <!-- Boosts -->
                    
                    <li class="active"><a href="<?php echo base_url('/admin/dashboard'); ?>"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
					 <li><hr class="sidebar_divider"></li> 


                   

                    <li class="<?php
                    if ($pageName == 'brandboost' && $pageSeName == 'onsite') {
                        echo 'active';
                    }
                    ?>"><a href="<?php echo base_url('/admin/brandboost/onsite'); ?>"><i class="icon-stack2"></i> <span>On Site Boosts <?php //echo $onBrandBoostCount; ?></span></a></li>

                    <li class="<?php
                    if ($pageName == 'brandboost' && $pageSeName == 'offsite') {
                        echo 'active';
                    }
                    ?>"><a href="<?php echo base_url('/admin/brandboost/offsite'); ?>"><i class="icon-stack2"></i> <span>Off Site Boosts <?php //echo $offBrandBoostCount; ?></span></a></li>

                    <li><hr class="sidebar_divider"></li>
                    <!-- Main -->
                    
                    <li class="<?php
                    if ($pageName != 'dashboard' && $pageName != '' && $pageName != 'brandboost') {
                        echo 'active';
                    }
                    ?>">

                    <li class="<?php
                        if ($pageName == 'contacts') {
                            echo 'active';
                        }
                        ?>"><a href="<?php echo base_url('/admin/contacts/mycontacts'); ?>"><i class="icon-address-book"></i> <span>Contacts</span></a></li>
                    

                    <li><a style="cursor: pointer;"><i class="icon-hammer-wrench"></i> <span>Campaigns</span></a>
                        <ul class="hidden-ul">
                            <li><a href="<?php echo base_url('/admin/brandboost/onsite'); ?>"><i class="fa fa-check"></i> On Site Reviews <?php echo $onBrandBoostCount; ?></a>
                            </li>
                            <li><a href="<?php echo base_url('/admin/brandboost/offsite'); ?>"><i class="fa fa-check"></i> Off Site Reviews <?php echo $offBrandBoostCount; ?></a>
                            </li>

                        </ul>
                    </li>
                    
                    <li class="<?php
                            if ($pageName == 'brandboost' && $pageSeName == 'widgets') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo base_url(); ?>admin/brandboost/widgets"><i class="icon-hammer-wrench"></i> <span>Widgets</span></a>
                    </li>




                    <li class="<?php
                            if (($pageName == 'brandboost' && $pageSeName == 'reviews') || ($pageName == 'feedback' && $pageSeName == 'listall') || ($pageName == 'brandboost' && $pageSeName == 'review_request')) {
                                echo 'active';
                            }
                            ?>">
                        <a style="cursor: pointer;"><i class="icon-stack2"></i> <span>Your Reviews</span></a>
                        <ul class="hidden-ul">
                            <li class="<?php
                            if ($pageName == 'brandboost' && $pageSeName == 'reviews') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo base_url(); ?>admin/brandboost/reviews/"><i class="icon-checkmark-circle"></i> Reviews</a></li>
                            <li class="<?php
                            if ($pageName == 'feedback' && $pageSeName == 'listall') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo base_url(); ?>admin/feedback/listall/"><i class="icon-feed2"></i> Feedback</a></li>
                            <li class="<?php
                            if ($pageName == 'brandboost' && $pageSeName == 'review_request') {
                                echo 'active';
                            }
                            ?>">
                            <a href="<?php echo base_url('/admin/questions'); ?>"><i class="icon-bubbles2"></i> Questions</a>

                            <a href="<?php echo base_url('/admin/brandboost/review_request'); ?>"><i class="icon-bubbles2"></i> Review Requests</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-pie-chart"></i> <span>Analytics</span></a>
                        <ul class="hidden-ul">
                            <li><a href="#"><i class="icon-envelop3"></i> Email Analytics</a></li>
                            <li><a href="#"><i class="icon-envelop2"></i> SMS Analytics</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-newspaper2"></i> <span>Reports</span></a>
                        <ul class="hidden-ul">
                            <li class="<?php
                                if ($pageName == 'brandboost' && $pageSeName == 'reports') {
                                    echo 'active';
                                }
                                ?>"><a href="<?php echo base_url(); ?>admin/brandboost/reports"><i class="icon-menu6"></i> Reports</a></li>
                            <li class="<?php
                                if ($pageName == 'brandboost' && $pageSeName == 'feedbackreports') {
                                    echo 'active';
                                }
                                ?>"><a href="<?php echo base_url(); ?>admin/brandboost/feedbackreports"><i class="icon-info22"></i> Reports Feedback</a></li>
                            <li class="<?php
                    if ($pageName == 'report' && $pageSeName == 'brandboost' && $pageThName == 'responseperformance') {
                        echo 'active';
                    }
                                ?>"><a href="<?php echo base_url(); ?>admin/report/brandboost/responseperformance"><i class="icon-list3"></i> Response Report</a></li>
                            <li class="<?php
                            if ($pageName == 'report' && $pageSeName == 'brandboost' && $pageThName == 'repResTimeTrends') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo base_url(); ?>admin/report/brandboost/repResTimeTrends"><i class="icon-alarm-check"></i> Response Time Trends</a></li>
                            <li class="<?php
                                if ($pageName == 'brandboost' && $pageSeName == 'servicereports') {
                                    echo 'active';
                                }
                                ?>"><a href="<?php echo base_url(); ?>admin/brandboost/servicereports"><i class="icon-users2"></i> Service Profile</a></li>
                            <li class="<?php
                            if ($pageName == 'report' && $pageSeName == 'brandboost' && $pageThName == 'reportsOptOut') {
                                echo 'active';
                            }
                                ?>"><a href="<?php echo base_url(); ?>admin/report/brandboost/reportsOptOut"><i class="icon-move-up"></i>Opt Out</a></li>
                            <li class="<?php
                            if ($pageName == 'report' && $pageSeName == 'brandboost' && $pageThName == 'insightTags') {
                                echo 'active';
                            }
                                ?>"><a href="<?php echo base_url(); ?>admin/report/brandboost/insightTags"><i class="icon-price-tag3"></i> Reports Insight Tags</a></li>
                        </ul>
                    </li>

                    <li class="<?php
                            if ($pageName == 'brandboost' && $pageSeName == 'media') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo base_url(); ?>admin/brandboost/media"><i class="icon-bubbles6"></i> <span>Media</span></a></li>

                    <li><a href="#"><i class="icon-puzzle4"></i> <span>Integrations</span></a></li>
                    <li><a href="#"><i class="icon-price-tag2"></i> <span>Insight Tags</span></a>
                        <ul class="hidden-ul">
                            <li class="<?php
                            if ($pageName == 'tags' && $pageSeName == '') {
                                echo 'active';
                            }
                            ?>"><a href="<?php echo base_url(); ?>admin/tags/"><i class="fa fa-check"></i> Tag Management</a>
                            </li>
                            <li class="<?php
                    if ($pageName == 'tags' && $pageSeName == 'tagsreview') {
                        echo 'active';
                    }
                            ?>"><a href="<?php echo base_url(); ?>admin/tags/tagsreview"><i class="fa fa-check"></i> Tag Reviews</a>
                            </li>
                            <li class="<?php
                    if ($pageName == 'tags' && $pageSeName == 'tagsfeedback') {
                        echo 'active';
                    }
                    ?>"><a href="<?php echo base_url(); ?>admin/tags/tagsfeedback"><i class="fa fa-check"></i> Tag Feedbacks</a>
                            </li>

                        </ul>
                    </li>
                    <li><a href="#"><i class="icon-code"></i> <span>Sync Sources</span></a></li>
                    <li><a href="#"><i class="icon-grid"></i> <span>Comp. Insights</span></a></li>
                    <li><a href="#"><i class="icon-users"></i> <span>Team</span></a>
                        <ul class="hidden-ul">

                            <li class="<?php
                    if ($pageName == 'team' && $pageSeName == 'dashboard') {
                        echo 'active';
                    }
                    ?>"><a href="<?php echo base_url(); ?>admin/team/dashboard"><i class="fa fa-check"></i>Dashboard</a>
                            </li>
                            <li class="<?php
                    if ($pageName == 'team' && $pageSeName == 'rolelist') {
                        echo 'active';
                    }
                    ?>"><a href="<?php echo base_url(); ?>admin/team/rolelist"><i class="fa fa-check"></i>Roles</a>
                            </li>
                            <li class="<?php
                        if ($pageName == 'team' && $pageSeName == 'memberlist') {
                            echo 'active';
                        }
                    ?>"><a href="<?php echo base_url(); ?>admin/team/memberlist"><i class="fa fa-check"></i> Team Members</a></li>
                            <li class="<?php
                        if ($pageName == 'team' && $pageSeName == 'activitylist') {
                            echo 'active';
                        }
                        ?>"><a href="<?php echo base_url(); ?>admin/team/activitylist"><i class="fa fa-check"></i> Member Activities</a>    
                            </li>


                        </ul>
                    </li>
                    
                    <li><hr class="sidebar_divider"></li>
                    
                    <li><a href="#"><i class="fa fa-coffee"></i> <span>Tips And Ideas</span></a></li>
                    <li class="<?php
                        if ($pageName == 'profile' && $pageSeName == '') {
                            echo 'active';
                        }
                        ?>"><a href="<?php echo base_url(); ?>admin/profile/"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
                    <li><a href="#"><i class="fa fa-question-circle"></i> <span>Need Help?</span></a></li>

                   
                    <li class="<?php
                        if ($pageName == 'lists') {
                            echo 'active';
                        }
                        ?>"><a href="<?php echo base_url('/admin/lists/'); ?>"><i class="icon-file-text"></i> <span>Lists</span></a></li>
                    <li class="<?php
                        if ($pageName == 'modules' && $pageSeName == 'emails') {
                            echo 'active';
                        }
                        ?>"><a href="<?php echo base_url('/admin/modules/emails'); ?>"><i class="icon-hammer-wrench"></i> <span>Automations</span></a>
                    <li class="<?php
                        if ($pageName == 'broadcast') {
                            echo 'active';
                        }
                        ?>"><a href="<?php echo base_url('/admin/broadcast/'); ?>"><i class="icon-hammer-wrench"></i> <span>Broadcast</span></a>

                    </li>

                    <li><hr class="sidebar_divider"></li>
                    
                    <li class="<?php
                        if ($pageName == 'modules' && $pageSeName  == 'referral') {
                            echo 'active';
                        }
                        ?>"><a href="<?php echo base_url('/admin/modules/referral/'); ?>"><i class="icon-browser"></i> <span>Ref. Programs</span></a>
                    </li>
					<!--  <li class="<?php
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
                    
                    
                    <li class="<?php
                        if ($pageName == 'modules' && $pageSeName == 'nps') {
                            echo 'active';
                        }
                        ?>"><a href="<?php echo base_url('/admin/modules/nps/'); ?>"><i class="icon-browser"></i> <span>NPS Programs</span></a>
                    </li>
					
                    
                    <li class="<?php
                        if ($pageName == 'smschat') {
                            echo 'active';
                        }
                        ?>"><a href="<?php echo base_url('/admin/smschat'); ?>"><i class="icon-browser"></i> <span>SMS Chat</span></a>
                    </li>

                    <li class="<?php
                        if ($pageName == 'modules' && $pageSeName == 'chat') {
                            echo 'active';
                        }
                        ?>"><a href="<?php echo base_url('/admin/modules/chat/'); ?>"><i class="icon-browser"></i> <span>Chat Programs</span></a>
                    </li>
                    
                    <!-- Our Affiliate Program -->
                    
                    <li><a href="#"><i class="icon-stack2"></i> <span>Sign Up Today</span></a></li>
                    

                    <!-- /page kits -->

                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>
<!-- /main sidebar -->