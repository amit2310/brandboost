@php
	$avatar = $aUInfo->avatar;
	$firstname = $aUInfo->firstname;
	$lastname = $aUInfo->lastname;
	$userRole = $aUInfo->user_role;
	$address = $aUInfo->address;
	
	$username = $firstname.' '.$lastname;
	if(!empty($avatar)){
		$srcUserImg = '/profile_images/'.$avatar;
	}
	else{
		$srcUserImg = '/profile_images/avatar_image.png';
	}
	$pageName = \Request::segment(2);
    $pageSeName = \Request::segment(3);
    $pageThName = \Request::segment(4);
		
	$onBrandBoostCount = getBBCount(0, 'onsite');
	$onBrandBoostCount = $onBrandBoostCount > 0 ? '('.$onBrandBoostCount.')' : '';
	$offBrandBoostCount = getBBCount(0, 'offsite');
	$offBrandBoostCount = $offBrandBoostCount > 0 ? '('.$offBrandBoostCount.')' : '';
@endphp

<!-- Main sidebar -->
<!--<div class="sidebar sidebar-main sidebar-fixed">-->
<div class="sidebar sidebar-main">
    <div class="sidebar-content">
        <!-- User menu -->
        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">
                    <a href="{{ base_url('/admin/dashboard/') }}" class="media-left"><img src="{{ base_url($srcUserImg) }}" class="img-circle img-sm" alt=""></a>
                    <div class="media-body">
                        <span class="media-heading text-semibold">{{ $username }}</span>
                        <div class="text-size-mini text-muted">
                            <i class="icon-pin text-size-small"></i> &nbsp; Brand Boost, Inc. 
                        </div>
                    </div>

                    <div class="media-right media-middle">
                        <ul class="icons-list">
                            <li>
                                <a href="{{ base_url() }}admin/profile/"><i class="icon-cog3"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->
        <hr class="sidebar_divider">
        
        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">


                <ul class="navigation navigation-main navigation-accordion">

                    <!-- Boosts -->
                    <li class="navigation-header"><span>Your Brand Boosts</span> <i class="icon-menu" title="Your Brand Boosts"></i></li>

                    <li class="
						@if ($pageName == 'brandboost' && $pageSeName == 'onsite')
							active
						@endif
                    "><a href="{{ base_url('/admin/brandboost/onsite') }}"><i class="icon-stack2"></i> <span>On Site Brand Boosts {{ $onBrandBoostCount }}</span></a></li>
                    <li class="
						@if ($pageName == 'brandboost' && $pageSeName == 'offsite')
							active
						@endif
					"><a href="{{ base_url('/admin/brandboost/offsite') }}"><i class="icon-stack2"></i> <span>Off Site Brand Boosts {{ $offBrandBoostCount }}</span></a></li>

                    <li><hr class="sidebar_divider mt-10"></li>
                    <!-- Main -->
                    <li class="navigation-header"><span>Navigation</span> <i class="icon-menu" title="Main pages"></i></li>
                    
                    <li class="@if($pageName == 'contacts' && $pageSeName == '') active @endif"><a href="{{ base_url('/admin/contacts/') }}"><i class="icon-address-book"></i> <span>Contacts</span></a></li>
                    <li class="@if($pageName == 'lists' && $pageSeName == '') active @endif"><a href="{{ base_url('/admin/lists/') }}"><i class="icon-file-text"></i> <span>Lists</span></a></li>
                    <li><a style="cursor: pointer;"><i class="icon-hammer-wrench"></i> <span>Campaigns</span></a>
                        <ul>
                            <li><a href="{{ base_url('/admin/brandboost/onsite') }}"><i class="fa fa-check"></i> On Site Reviews {{ $onBrandBoostCount }}</a>
                            </li>
                            <li><a href="{{ base_url('/admin/brandboost/offsite') }}"><i class="fa fa-check"></i> Off Site Reviews {{ $offBrandBoostCount }}</a>
                            </li>
                        </ul>
                    </li>

                    <li class="@if(($pageName == 'users' || $pageName == 'membership' || $pageName == 'email_template' || $pageName == 'invoices' || $pageName == 'tracking' || $pageName == 'questions' || $pageName == 'feedback' || $pageName == 'subscriptions' || $pageName == 'offsite' ) && $pageSeName == '') active @endif">
						<a href="{{ base_url('/admin/dashboard/') }}"><i class="icon-stack2"></i> <span>Dashboard</span></a>
						<ul>
							<li class="@if($pageName == 'users' && $pageSeName == '') active @endif"><a href="{{ base_url() }}admin/users/"><i class="fa fa-user"></i> Users</a></li>
							<li class="@if($pageName == 'membership' && $pageSeName == '') active @endif"><a href="{{ base_url() }}admin/membership/"><i class="fa fa-users"></i> Membership</a></li>
							<li class="@if($pageName == 'email_template' && $pageSeName == '') active @endif"><a href="{{ base_url() }}admin/email_template/"><i class="fa fa-envelope"></i> Email Template</a></li>
							<li class="@if($pageName == 'invoices' && $pageSeName == 'view') active @endif"><a href="{{ base_url('admin/invoices/view/' . $aUInfo->id) }}"><i class="fa fa-first-order"></i> Orders</a></li>
							<li class="@if($pageName == 'tracking' && $pageSeName == '') active @endif"><a href="{{ base_url('admin/tracking/') }}"><i class="fa fa-list"></i> Trcking Logs</a></li>
							<li class="@if($pageName == 'questions' && $pageSeName == '') active @endif"><a href="{{ base_url() }}admin/questions"><i class="fa fa-question-circle"></i> Questions</a></li>
							<li class="@if($pageName == 'feedback' && $pageSeName == '') active @endif"><a href="{{ base_url() }}admin/feedback/"><i class="fa fa-feed"></i> Feedback</a></li>
							<li class="@if($pageName == 'subscriptions' && $pageSeName == '') active @endif"><a href="{{ base_url() }}admin/subscriptions/"><i class="fa fa-gift"></i> Subscriptions</a></li>
							<li class="@if($pageName == 'offsite' && $pageSeName == 'websites') active @endif"><a href="{{ base_url() }}admin/offsite/websites"><i class="fa fa-coffee"></i> Offsite Websites</a></li>
						</ul>
					</li>
                    
                    <li class="@if(($pageName == 'brandboost' && $pageSeName == 'reviews') || ($pageName == 'feedback' && $pageSeName == 'listall') || ($pageName == 'brandboost' && $pageSeName == 'review_request')) active @endif">
                        <a style="cursor: pointer;"><i class="icon-stack2"></i> <span>Your Reviews</span></a>
                        <ul>
                            <li class="@if($pageName == 'brandboost' && $pageSeName == 'reviews') active @endif"><a href="{{ base_url() }}admin/brandboost/reviews/"><i class="icon-checkmark-circle"></i> Reviews</a></li>
                            <li class="@if($pageName == 'feedback' && $pageSeName == 'listall') active @endif"><a href="{{ base_url() }}admin/feedback/listall/"><i class="icon-feed2"></i> Feedback</a></li>
                            <li class="@if($pageName == 'brandboost' && $pageSeName == 'review_request') active @endif"><a href="{{ base_url('/admin/brandboost/review_request') }}"><i class="icon-bubbles2"></i> Review Requests</a></li>
                        </ul>
                    </li>

                    <li class="@if(($pageName == 'brandboost') || ($pageName == 'brandboost' && $pageSeName == 'feedbackreports') || ($pageName == 'report' && $pageSeName == 'brandboost' && $pageThName == 'responseperformance') || ($pageSeName == 'brandboost' && $pageThName == 'repResTimeTrends') || ($pageName == 'brandboost' && $pageSeName == 'servicereports') || ($pageSeName == 'brandboost' && $pageThName == 'reportsOptOut') || ($pageSeName == 'brandboost' && $pageThName == 'insightTags')) active @endif">
                        <a style="cursor: pointer;"><i class="icon-newspaper2"></i> <span>Reports</span></a>
                    	<ul>
                            <li class="@if($pageName == 'brandboost' && $pageSeName == 'reports') active @endif"><a href="{{ base_url() }}admin/brandboost/reports"><i class="icon-menu6"></i> Reports</a></li>
                            <li class="@if($pageName == 'brandboost' && $pageSeName == 'feedbackreports') active @endif"><a href="{{ base_url() }}admin/brandboost/feedbackreports"><i class="icon-info22"></i> Reports Feedback</a></li>
                            <li class="@if($pageSeName == 'brandboost' && $pageThName == 'responseperformance') active @endif"><a href="{{ base_url() }}admin/brandboost/responseperformance"><i class="icon-list3"></i> Response Report</a></li>
                            <li class="@if($pageName == 'report' && $pageSeName == 'brandboost' && $pageThName == 'repResTimeTrends') active @endif"><a href="{{ base_url() }}admin/brandboost/repResTimeTrends"><i class="icon-alarm-check"></i> Response Time Trends</a></li>
                            <li class="@if($pageName == 'brandboost' && $pageSeName == 'servicereports') active @endif"><a href="{{ base_url() }}admin/brandboost/servicereports"><i class="icon-users2"></i> Service Profile</a></li>
                            <li class="@if($pageName == 'report' && $pageSeName == 'brandboost' && $pageThName == 'reportsOptOut') active @endif"><a href="{{ base_url() }}admin/brandboost/reportsOptOut"><i class="icon-move-up"></i>Opt Out</a></li>
                            <li class="@if($pageName == 'report' && $pageSeName == 'brandboost' && $pageThName == 'insightTags') active @endif"><a href="{{ base_url() }}admin/brandboost/insightTags"><i class="icon-price-tag3"></i> Reports Insight Tags</a></li>
                        </ul>
                    </li>
                    
                    <li class="@if($pageName == 'brandboost' && $pageSeName == 'media') active @endif"><a href="{{ base_url() }}admin/brandboost/media"><i class="icon-bubbles6"></i> <span>Media</span></a></li>
                    
                    <li><a href="#"><i class="icon-collaboration"></i> <span>Automations</span></a></li>
                    
                    <li><a href="#"><i class="icon-puzzle4"></i> <span>Apps & Integrations</span></a></li>
                    <li class="@if($pageName == 'tags' && ($pageSeName == '' || $pageSeName == 'tagsreview' || $pageSeName == 'tagsfeedback')) active @endif" ><a style="cursor: pointer;"><i class="icon-price-tag2"></i> <span>Insight Tags</span></a>
                        <ul>
                            <li class="@if($pageName == 'tags' && $pageSeName == '') active @endif"><a href="{{ base_url() }}admin/tags/"><i class="fa fa-check"></i> Tag Management</a>
                            </li>
                            <li class="@if($pageName == 'tags' && $pageSeName == 'tagsreview') active @endif"><a href="{{ base_url() }}admin/tags/tagsreview"><i class="fa fa-check"></i> Tag Reviews</a>
                            </li>
                            <li class="@if($pageName == 'tags' && $pageSeName == 'tagsfeedback') active @endif"><a href="{{ base_url() }}admin/tags/tagsfeedback"><i class="fa fa-check"></i> Tag Feedbacks</a>
                            </li>

                        </ul>
                    </li>
                    <li><a href="#"><i class="icon-code"></i> <span>Sync Sources</span></a></li>
                    <li><a href="#"><i class="icon-grid"></i> <span>Competitor Insights</span></a></li>
                    <li class="@if($pageName == 'team' && ($pageSeName == 'rolelist' || $pageSeName == 'memberlist' || $pageSeName == 'activitylist')) active @endif"><a style="cursor: pointer;"><i class="icon-users"></i> <span>Team</span></a>
                    <ul>
                            <li class="@if($pageName == 'team' && $pageSeName == 'rolelist') active @endif"><a href="{{ base_url() }}admin/team/rolelist"><i class="fa fa-check"></i>Roles</a>
                            </li>
                            <li class="@if($pageName == 'team' && $pageSeName == 'memberlist') active @endif"><a href="{{ base_url() }}admin/team/memberlist"><i class="fa fa-check"></i> Team Members</a>
                            <li class="@if($pageName == 'team' && $pageSeName == 'activitylist') active @endif"><a href="{{ base_url() }}admin/team/activitylist"><i class="fa fa-check"></i> Member Activities</a>    
                            </li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-coffee"></i> <span>Tips And Ideas</span></a></li>
                    <li class="@if($pageName == 'workflow' && $pageThName == 'automation') active @endif"><a href="{{ base_url() }}admin/workflow/templates/automation"><i class="fa fa-cog"></i> <span>Automation Templates</span></a></li>
                    <li class="@if($pageName == 'workflow' && $pageThName == 'broadcast') active @endif"><a href="{{ base_url() }}admin/workflow/templates/broadcast"><i class="fa fa-cog"></i> <span>Broadcast Templates</span></a></li>
                    <li class="@if($pageName == 'settings' && $pageSeName =='setup_system_notifications') active @endif"><a href="{{ base_url() }}admin/settings/setup_system_notifications"><i class="fa fa-cog"></i> <span>System Notificaions</span></a></li>
                    <li class="@if($pageName == 'settings' && $pageSeName =='amazon_s3_storage') active @endif"><a href="{{ base_url() }}admin/settings/amazon_s3_storage"><i class="fa fa-cog"></i> <span>Amazon S3 Storage</span></a></li>

                    <li class="@if($pageName == 'settings' && $pageSeName =='twillo_log') active @endif"><a href="{{ base_url() }}admin/settings/twillo_log"><i class="fa fa-cog"></i> <span>Twillo Log</span></a></li>
                    

                    <li class="@if($pageName == 'settings' && $pageSeName =='creditValues') active @endif"><a href="{{ base_url() }}admin/settings/creditValues"><i class="fa fa-cog"></i> <span>Credit Management</span></a></li>
                    <li class="@if($pageName == 'profile' && $pageSeName == '') active @endif"><a href="{{ base_url() }}admin/profile/"><i class="fa fa-cog"></i> <span>Account Settings</span></a></li>
                    <li><a href="#"><i class="fa fa-question-circle"></i> <span>Need Help?</span></a></li>
                    
                    <li class="navigation-header"><span>Emails Module</span> <i class="icon-menu" title="Email Modules"></i></li>
                    <li class="@if($pageName == 'modules' && $pageSeName == 'emails') active @endif"><a href="{{ base_url('/admin/modules/emails') }}"><i class="icon-hammer-wrench"></i> <span>Email Automations</span></a>
                        
                    </li>

                    <li><hr class="sidebar_divider mt-10"></li>
                    <!-- Our Affiliate Program -->
                    <li class="navigation-header"><span>Our Affiliate Program</span> <i class="icon-menu" title="Our Affiliate Program"></i></li>

                    <li class="
						@if ($pageName == 'modules' && $pageSeName == 'chat')
							active
                        @endif
						"><a href="{{ base_url('/admin/modules/chat/') }}"><i class="icon-browser"></i> <span>Chat Programs</span></a>
                    </li>

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