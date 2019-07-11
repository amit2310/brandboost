<!--===========TAB 1===========-->
<div class="tab-pane active" id="right-icon-tab0">
	<div class="row">
		<div class="col-md-3 pr6">
			<div class="panel panel-flat mb10">
				<div class="panel-heading">
					<h6 class="panel-title">Conversations<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
								<div class="heading-elements">
								<a style="background: #e4eefd;" href="#" class="icons s20"><i style="color: #9fc3f8!important" class="icon-plus3"></i></a>
								</div>
							  </div>
							  <div class="panel-body p0 bkg_white">
                              <div class="p20">
                                <!--<span class="fsize12 txt_grey pull-left">All <span class="txt_grey">(39)</span> &nbsp;  <i class="icon-arrow-down5 txt_grey"></i></span>-->
                                
                                <div class="tdropdown ml0">
										<a style="margin:0!important;" class="dropdown-toggle fsize12 txt_grey" data-toggle="dropdown" aria-expanded="false">All (39) <i class="icon-arrow-down22"></i></a>
										<ul style="right: 0px!important; margin-top: 25px; left: -20px;" class="dropdown-menu dropdown-menu-left chat_dropdown">
										  <li><strong><a class="active" href="#"><img class="small" src="assets/images/cd_icon1.png"/> All (39) </a></strong></li>
										  <li><strong><a href="#"><img class="small" src="assets/images/cd_icon2.png"/>Open (13) </a></strong></li>
										  <li><strong><a href="#"><img class="small" src="assets/images/cd_icon3.png"/>Resolved (172) </a></strong></li>
										  <li><strong><a href="#"><img class="small" src="assets/images/cd_icon4.png"/>Favorite (5) </a></strong></li>
										  <li><strong><a href="#"><img class="small" src="assets/images/cd_icon5.png"/>Snoozed (28)</a></strong></li>
										</ul>
									  </div>
                              
                              
                              		<div class="tdropdown ml0 pull-right">
										<a style="margin:0!important;" class="dropdown-toggle fsize12 txt_grey" data-toggle="dropdown" aria-expanded="false">Waiting longest <i class="icon-arrow-down22"></i></a>
										<ul style="margin-top: 25px; right: -20px;" class="dropdown-menu dropdown-menu-left chat_dropdown width_170">
											<li><strong><a class="active" href="#">Newest </a></strong></li>
											<li><strong><a href="#">Waiting longest </a></strong></li>
											<li><strong><a href="#">Oldest </a></strong></li>
										</ul>
									  </div>
                               
                                
                                
                                <!--<span class="fsize12 txt_grey pull-right">Waiting longest &nbsp; <i class="icon-arrow-down5 txt_grey"></i></span>-->
                                <div class="clearfix"></div>
                               </div>
           
							  </div>
				</div>
				<div class="panel-body p0 minh950">
					<div class="sidebar-category chat">
					
						<div class="tabbable"> 
							<ul class="nav nav-tabs nav-tabs-bottom bbot" style="display:none">
								<li class="active"><a href="#Chats" data-toggle="tab"><i class="icon-bubble"></i> Chats</a></li>
								<li><a href="#Contacts" data-toggle="tab"><i class="icon-users"></i> Contacts</a></li>
								<li><a href="#Favorites" data-toggle="tab"><i class="icon-star-full2"></i> Favorites</a></li>
							</ul>
							<div class="tab-content"> 
								<!--########################Chats ##########################-->
								<div class="tab-pane active" id="Chats">
									<div class="category-content no-padding">
							
											<?php 
												$key = 0;
												foreach($usersdata as $userData){ 
													$profileImg = $userData->avatar == '' ? base_url('/profile_images/avatar_image.png') : base_url('profile_images/' . $userData->avatar);	
													$chatUsers = $this->smsChat->getSMSThreadsNo($aTwilioAc->contact_no, $userData->phone);
													if(($chatUsers) && ($userData->phone)){
														$favUser = $this->smsChat->getSMSFavouriteUser($loginUserData->id, $userData->id);
														$mmsFile = explode('/Media/', $chatUsers[count($chatUsers)-1]->msg);
														$fileext = end(explode('.', $chatUsers[count($chatUsers)-1]->msg));
														if($fileext == 'png' || $fileext == 'jpg' || $fileext == 'jpeg' || $fileext == 'gif'){
															$fileView = "";
														}
														else if($fileext == 'doc' || $fileext == 'docx' || $fileext == 'odt' || $fileext == 'csv' || $fileext == 'pdf') {
															$fileView = "";
															}else if(count($mmsFile) > 1){
															$fileView = "";
															}else{
															$fileView = $chatUsers[count($chatUsers)-1]->msg;
															$fileView = setStringLimit($fileView, 70);
														}
													?>
													
													<div class="media chatbox_new"> 
													<a href="javascript:void(0);" class="media-link getChatDetails <?php echo $key == 0 ? 'activechat' : ''; ?>" userid="<?php echo $userData->id; ?>" phone_no="<?php echo $userData->phone; ?>">
													<div class="media-left"><img src="<?php echo $profileImg; ?>" class="img-circle img-xs" alt=""></div>
													<div class="media-body"> 
													<span class="fsize12 txt_dark"><?php echo $userData->firstname; ?> <?php echo $userData->lastname; ?></span> 
													<span class="fsize12 txt_grey">VP of Sales at General</span> 
													<span class="fsize12 txt_dark"><?php echo $fileView; ?></span> 
													</div>
													<div class="media-right"><span class="date_time txt_grey fsize12">2m <i class="fa fa-circle txt_green fsize7"></i></span></div>

													</a> 
													</div>
												<?php $key++; }  } ?>
									
									</div>
								</div>
								<!--########################Contacts ##########################-->
								<div class="tab-pane" id="Contacts">
									<div class="category-content no-padding">
										<ul class="media-list media-list-linked" id="testDiv4">
											<?php 
												
												$character = array('A'=>'a', 'B'=>'b', 'C'=>'c', 'D'=>'d', 'E'=>'e', 'F'=>'f', 'G'=>'g', 'H'=>'h', 'I'=>'i', 'J'=>'j', 'K'=>'k', 'L'=>'l', 'M'=>'m', 'N'=>'n', 'O'=>'o', 'P'=>'p', 'Q'=>'q', 'R'=>'r', 'S'=>'s', 'T'=>'t', 'U'=>'u', 'V'=>'v', 'W'=>'w', 'X'=>'x', 'Y'=>'y', 'Z'=>'z');
												foreach ($character as $key => $value) {
													$getCharUserList = $this->mSubscribers->getGlobalSubscribersByChar($loginUserData->id, $value);
													if(!empty($getCharUserList)) {
													?>
													<li class="media alphabet"> <?php echo $key; ?> </li>
													<?php
														foreach ($getCharUserList as  $userData) {
															$profileImg = $userData->avatar == '' ? base_url('/profile_images/avatar_image.png') : base_url('profile_images/' . $userData->avatar);	
															$favUser = $this->smsChat->getSMSFavouriteUser($loginUserData->id, $userData->id);
															
														?>
														<li class="media"> 
															<a href="javascript:void(0);" class="media-link getChatDetails" userid="<?php echo $userData->id; ?>" phone_no="<?php echo $userData->phone; ?>">
																<div class="media-left">
																	<img src="<?php echo $profileImg; ?>" class="img-circle img-xs" alt="">
																</div>
															<div class="media-body">
																<div class="media-heading"><span class="text-semibold"><?php echo $userData->firstname; ?> <?php echo $userData->lastname; ?></span></div>
															<span class="text-muted">(991)-176-2989</span> </div>
															<div class="media-right media-middle"> <span class="status-mark bg-grey-300"></span> </div>
														</a> </li>
														
													<?php } } } ?>
										</ul>
									</div>
								</div>
								<!--########################Favorites ##########################-->
								<div class="tab-pane" id="Favorites">
									<div class="category-content no-padding">
										<ul class="media-list media-list-linked" id="testDiv5">
											<?php 
												foreach($favouriteUserData as $fUserData){ 
													$userId = $fUserData->fav_user_id;
													foreach($usersdata as $userData){ 
														if($userData->id == $userId){
															$profileImg = $userData->avatar == '' ? base_url('/profile_images/avatar_image.png') : base_url('profile_images/' . $userData->avatar);	
														?>
														
														<li class="media"> 
															<a href="javascript:void(0);" class="media-link getChatDetails" userid="<?php echo $userData->id; ?>" phone_no="<?php echo $userData->phone; ?>">
																<div class="media-left">
																	<input type="checkbox" class="styled">
																</div>
																<div class="media-left favouriteSMSUser" userid="<?php echo $userData->id; ?>"><i class="icon-star-full2 txt_blue"></i></div>
																<div class="media-left"><img src="<?php echo $profileImg; ?>" class="img-circle img-md" alt=""></div>
																<div class="media-body">
																	<div class="media-heading">
																		<span class="text-semibold"><?php echo $userData->firstname; ?> <?php echo $userData->lastname; ?></span>
																	</div>
																	<span class="text-muted"><?php echo $userData->phone; ?></span> 
																</div>
																<div class="media-right media-middle"> <span class="status-mark bg-grey-300"></span> </div>
															</a> 
														</li>
														
													<?php } } } ?>
													
										</ul>
									</div>
								</div>
								<!--########################TAB end ##########################--> 
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-md-9 pl0 pr0 userChatData" style="display:none;"></div>
	</div>
</div>
