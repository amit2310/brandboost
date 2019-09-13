@php
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
@endphp

<!-- Main sidebar -->
<!--<div class="sidebar sidebar-main sidebar-fixed">-->
<div class="sidebar sidebar-main">
    <div class="sidebar-content">
        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">
                    <!-- Boosts -->
                    <li class="active"><a href="{{ base_url('/admin/dashboard') }}"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
					 <li><hr class="sidebar_divider"></li> 
                    <li class="
					@if ($pageName == 'brandboost' && $pageSeName == 'onsite')
						active
                    @endif
					"><a href="{{ base_url('/admin/brandboost/onsite') }}"><i class="icon-stack2"></i> <span>On Site Boosts</span></a></li>

                    <li class="
					@if ($pageName == 'brandboost' && $pageSeName == 'offsite')
						active
                    @endif
					"><a href="{{ base_url('/admin/brandboost/offsite') }}"><i class="icon-stack2"></i> <span>Off Site Boosts</span></a></li>

                    <li><hr class="sidebar_divider"></li>
                    <!-- Main -->
                    
                    <li class="
					@if ($pageName != 'dashboard' && $pageName != '' && $pageName != 'brandboost')
						active
                    @endif
					">

                    <li class="
						@if ($pageName == 'contacts')
							active
                        @endif
						"><a href="{{ base_url('/admin/contacts/mycontacts') }}"><i class="icon-address-book"></i> <span>Contacts</span></a></li>
                    

                    <li><a style="cursor: pointer;"><i class="icon-hammer-wrench"></i> <span>Campaigns</span></a>
                        <ul class="hidden-ul">
                            <li><a href="{{ base_url('/admin/brandboost/onsite') }}"><i class="fa fa-check"></i> On Site Reviews {{ $onBrandBoostCount }}</a>
                            </li>
                            <li><a href="{{ base_url('/admin/brandboost/offsite') }}"><i class="fa fa-check"></i> Off Site Reviews {{ $offBrandBoostCount }}</a>
                            </li>

                        </ul>
                    </li>
                    
                    <li class="
						@if ($pageName == 'brandboost' && $pageSeName == 'widgets')
							active
                        @endif
						"><a href="{{ base_url() }}admin/brandboost/widgets"><i class="icon-hammer-wrench"></i> <span>Widgets</span></a>
                    </li>

                    <li class="
						@if (($pageName == 'brandboost' && $pageSeName == 'reviews') || ($pageName == 'feedback' && $pageSeName == 'listall') || ($pageName == 'brandboost' && $pageSeName == 'review_request'))
							active
						@endif
						">
                        <a style="cursor: pointer;"><i class="icon-stack2"></i> <span>Your Reviews</span></a>
                        <ul class="hidden-ul">
                            <li class="
								@if ($pageName == 'brandboost' && $pageSeName == 'reviews')
									active
								@endif
							"><a href="{{ base_url() }}admin/brandboost/reviews/"><i class="icon-checkmark-circle"></i> Reviews</a></li>
                            <li class="
								@if ($pageName == 'feedback' && $pageSeName == 'listall')
									active
								@endif
							"><a href="{{ base_url() }}admin/feedback/listall/"><i class="icon-feed2"></i> Feedback</a></li>
                            <li class="
								@if ($pageName == 'brandboost' && $pageSeName == 'review_request')
									active
								@endif
							">
                            <a href="{{ base_url('/admin/questions') }}"><i class="icon-bubbles2"></i> Questions</a>

                            <a href="{{ base_url('/admin/brandboost/review_request') }}"><i class="icon-bubbles2"></i> Review Requests</a></li>
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
                            <li class="
								@if ($pageName == 'brandboost' && $pageSeName == 'reports')
									active
                                @endif
								"><a href="{{ base_url() }}admin/brandboost/reports"><i class="icon-menu6"></i> Reports</a></li>
                            <li class="
								@if ($pageName == 'brandboost' && $pageSeName == 'feedbackreports')
									active
                                @endif
								"><a href="{{ base_url() }}admin/brandboost/feedbackreports"><i class="icon-info22"></i> Reports Feedback</a></li>
                            <li class="
								@if ($pageName == 'report' && $pageSeName == 'brandboost' && $pageThName == 'responseperformance')
									active
								@endif
								"><a href="{{ base_url() }}admin/report/brandboost/responseperformance"><i class="icon-list3"></i> Response Report</a></li>
                            <li class="
								@if ($pageName == 'report' && $pageSeName == 'brandboost' && $pageThName == 'repResTimeTrends')
									active
								@endif
							"><a href="{{ base_url() }}admin/report/brandboost/repResTimeTrends"><i class="icon-alarm-check"></i> Response Time Trends</a></li>
                            <li class="
								@if ($pageName == 'brandboost' && $pageSeName == 'servicereports')
									active
                                @endif
								"><a href="{{ base_url() }}admin/brandboost/servicereports"><i class="icon-users2"></i> Service Profile</a></li>
                            <li class="
								@if ($pageName == 'report' && $pageSeName == 'brandboost' && $pageThName == 'reportsOptOut')
									active
								@endif
							"><a href="{{ base_url() }}admin/report/brandboost/reportsOptOut"><i class="icon-move-up"></i>Opt Out</a></li>
                            <li class="
								@if ($pageName == 'report' && $pageSeName == 'brandboost' && $pageThName == 'insightTags') {
									active
								@endif
							"><a href="{{ base_url() }}admin/report/brandboost/insightTags"><i class="icon-price-tag3"></i> Reports Insight Tags</a></li>
                        </ul>
                    </li>

                    <li class="
						@if ($pageName == 'brandboost' && $pageSeName == 'media')
							active
						@endif
					"><a href="{{ base_url() }}admin/brandboost/media"><i class="icon-bubbles6"></i> <span>Media</span></a></li>

                    <li><a href="#"><i class="icon-puzzle4"></i> <span>Integrations</span></a></li>
                    <li><a href="#"><i class="icon-price-tag2"></i> <span>Insight Tags</span></a>
                        <ul class="hidden-ul">
                            <li class="
								@if ($pageName == 'tags' && $pageSeName == '')
									active
								@endif
							"><a href="{{ base_url() }}admin/tags/"><i class="fa fa-check"></i> Tag Management</a>
                            </li>
                            <li class="
								@if ($pageName == 'tags' && $pageSeName == 'tagsreview')
									active
								@endif
							"><a href="{{ base_url() }}admin/tags/tagsreview"><i class="fa fa-check"></i> Tag Reviews</a>
                            </li>
                    <li class="
						@if ($pageName == 'tags' && $pageSeName == 'tagsfeedback')
							active
						@endif
					"><a href="{{ base_url() }}admin/tags/tagsfeedback"><i class="fa fa-check"></i> Tag Feedbacks</a>
                    </li>

                        </ul>
                    </li>
                    <li><a href="#"><i class="icon-code"></i> <span>Sync Sources</span></a></li>
                    <li><a href="#"><i class="icon-grid"></i> <span>Comp. Insights</span></a></li>
                    <li><a href="#"><i class="icon-users"></i> <span>Team</span></a>
                        <ul class="hidden-ul">

                    <li class="
						@if ($pageName == 'team' && $pageSeName == 'dashboard')
							active
						@endif
					"><a href="{{ base_url() }}admin/team/dashboard"><i class="fa fa-check"></i>Dashboard</a>
                            </li>
                    <li class="
						@if ($pageName == 'team' && $pageSeName == 'rolelist')
							active
						@endif
					"><a href="{{ base_url() }}admin/team/rolelist"><i class="fa fa-check"></i>Roles</a>
                            </li>
                    <li class="
						@if ($pageName == 'team' && $pageSeName == 'memberlist')
							active
                        @endif
						"><a href="{{ base_url() }}admin/team/memberlist"><i class="fa fa-check"></i> Team Members</a></li>
                    
					<li class="
						@if ($pageName == 'team' && $pageSeName == 'activitylist')
							active
                        @endif
						"><a href="{{ base_url() }}admin/team/activitylist"><i class="fa fa-check"></i> Member Activities</a>    
                            </li>


                        </ul>
                    </li>
                    
                    <li><hr class="sidebar_divider"></li>
                    
                    <li><a href="#"><i class="fa fa-coffee"></i> <span>Tips And Ideas</span></a></li>
                    <li class="
						@if ($pageName == 'profile' && $pageSeName == '')
							active
                        @endif
						"><a href="{{ base_url() }}admin/profile/"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
                    <li><a href="#"><i class="fa fa-question-circle"></i> <span>Need Help?</span></a></li>

                   
                    <li class="
						@if ($pageName == 'lists')
							active
                        @endif
						"><a href="{{ base_url('/admin/lists/') }}"><i class="icon-file-text"></i> <span>Lists</span></a></li>
                    <li class="
						@if ($pageName == 'modules' && $pageSeName == 'emails')
							active
						@endif
						"><a href="{{ base_url('/admin/modules/emails') }}"><i class="icon-hammer-wrench"></i> <span>Automations</span></a>
                    <li class="
						@if ($pageName == 'broadcast')
							active
                        @endif
						"><a href="{{ base_url('/admin/broadcast/') }}"><i class="icon-hammer-wrench"></i> <span>Broadcast</span></a>

                    </li>

                    <li><hr class="sidebar_divider"></li>
                    
                    <li class="
						@if ($pageName == 'modules' && $pageSeName  == 'referral')
							active
                        @endif
						"><a href="{{ base_url('/admin/modules/referral/') }}"><i class="icon-browser"></i> <span>Ref. Programs</span></a>
                    </li>
					
                    <li class="
						@if ($pageName == 'modules' && $pageSeName == 'nps')
							active
                        @endif
						"><a href="{{ base_url('/admin/modules/nps/') }}"><i class="icon-browser"></i> <span>NPS Programs</span></a>
                    </li>
					
                    
                    <li class="
						@if ($pageName == 'smschat')
                            active
                        @endif
						"><a href="{{ base_url('/admin/smschat') }}"><i class="icon-browser"></i> <span>SMS Chat</span></a>
                    </li>

                    <li class="
						@if ($pageName == 'modules' && $pageSeName == 'chat')
							active
                        @endif
						"><a href="{{ base_url('/admin/modules/chat/') }}"><i class="icon-browser"></i> <span>Chat Programs</span></a>
                    </li>
                    
                    <!-- Our Affiliate Program -->
                    
                    <li><a href="#"><i class="icon-stack2"></i> <span>Sign Up Today</span></a></li>
                </ul>
            </div>
        </div>
        <!-- /main navigation -->
    </div>
</div>
<!-- /main sidebar -->