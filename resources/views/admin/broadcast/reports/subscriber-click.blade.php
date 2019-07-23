<div class="tab-pane <?php echo $clickStatus; ?>" id="right-icon-tab3">
    <div class="row">
        <div class="col-lg-12">
            <!-- Marketing campaigns -->
            <div class="panel panel-flat">
                 <?php $this->load->view("admin/broadcast/reports/subscriber-data"); ?>
            </div>
        </div>
    </div>
</div>





<?php /* ?>

<div class="tab-pane <?php echo $clickStatus; ?>" id="right-icon-tab3">
	
    <?php //$this->load->view('admin/brandboost/list_subscribers', array('subscribersData' => $subscribersData, 'list_id' => $brandboostID, 'display' => 'popup')); ?>
    <?php //pre($oSubscriber); ?>
	
    <!-- Content area -->
    <div class="content offsite_feed">
		
       <!-- Dashboard content -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Marketing campaigns -->
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Subscriber Lists</h6>
                        <div class="heading-elements">
                            <span class="label bg-success heading-text"><?php echo count($click); ?> Subscriber</span>
                           <!--  <ul class="icons-list">
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
							</ul> -->
						</div>
					</div>
					
                    <div class="table-responsive">
                        <table class="table datatable-sorting text-nowrap" >
                            <thead>
                                <tr>
                                    <th class="col-md-4">CONTACT DETAILS</th>
                                    <th class="col-md-4">DATE CREATED</th>
                                    <th class="col-md-2 text-center" style="padding-left: 38px;">STATUS</th>
                                    <th style="display: none;"></th>
								</tr>
							</thead>
                            <tbody>
								
                                <?php

									if (count($click) > 0) {
										foreach ($click as $data) {

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
													<div class="text-muted text-size-small"><?php echo $data->phone; ?></div>
												</div>
											</td>
											
											<td><h6 class="text-semibold"><?php echo date('M d, Y', strtotime($data->e_created)); ?><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($data->e_created)) . ' (' . timeAgo($data->e_created) . ')'; ?></div></h6></td>
											<td class="text-center"><?php echo $data->status == 1 ? '<span class="label bg-success">ACTIVE</span>' : '<span class="label bg-danger">INACTIVE</span>'; ?></td>
											
											<td style="display: none;"><?php echo date('m/d/Y', strtotime($data->e_created)); ?></td>
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
		<!-- /dashboard content -->
		
	</div>
	<!-- /content area -->
	
	
	
	
	
	
</div>
<?php */ ?>