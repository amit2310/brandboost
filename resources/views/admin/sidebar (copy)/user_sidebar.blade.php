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
	$pageName = $this->uri->segment(2);
	$pageSeName = $this->uri->segment(3);
	$pageThName = $this->uri->segment(4);
@endif

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
					@if ($pageName == 'reviews')
						active
                    @endif
					"><a href="{{ base_url('/admin/reviews/') }}"><i class="icon-stack2"></i> <span>Reviews</span></a></li>

                    <li class="
					@if ($pageName == 'feedback')
						active
                    @endif
					"><a href="{{ base_url('/admin/feedback/my') }}"><i class="icon-stack2"></i> <span>Feedbacks</span></a></li>
                    
                    <li class="
					@if ($pageName == 'comments')
						active
                    @endif
					"><a href="{{ base_url() }}admin/comments/"><i class="icon-stack2"></i> <span>Comments</span></a></li>
                    <li class="
					@if ($pageName == 'notifications')
                        active
                    @endif
					"><a href="{{ base_url() }}admin/notifications/"><i class="icon-stack2"></i> <span>Notifications</span></a></li>
   
                    <li><hr class="sidebar_divider"></li>
                    
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