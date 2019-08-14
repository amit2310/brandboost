<!--=====================body=========================-->
	<div class="container-fluid">
		<div class="col-md-12 col-sm-12">
			<section class="membership">
				<div class="row">
					<div class="col-md-3">
						<div class="input-icon right cust_search"> <i class="fa fa-search"></i>
							<input id="search_event" class="form-control searchbox" style="" placeholder="Search..." type="text">
						</div>
					</div>
					<div class="col-md-9 top_btn">
						
					</div>
					<div class="col-md-12">
						<h1 class="top_heading">User Sendgrid Login Details</h1>
					</div>
					<div class="col-md-12"> 
						<table class="table blef0 brig0">
							<thead>
								<tr>
									<th>Email</th>
									<th>Username</th>
									<th>Password</th>
								</tr>
							</thead>
							
							<tbody>
							<?php 
							
							if(count($sendGridULD) > 0){
								foreach($sendGridULD as $data){ 
							?>
								<tr>
									<td><?php echo $data->sg_email; ?></td>
									<td><?php echo $data->sg_username; ?></td>
									<td><?php echo $data->sg_password; ?></td>
								</tr>
							<?php 
								}
							}else{
								echo '<tr><td colspan="6" style="text-align:center;">No any data found.</td></tr>';
							}
							?>		
							</tbody>
						</table>  			
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<h1 class="top_heading">User Sendgrid Data</h1>
					</div>
					<div class="col-md-12"> 
						<table class="table blef0 brig0">
							<thead>
								<tr>
									<th>Total Requests</th>
									<th>Delivered</th>
									<th>Click</th>
									<th>Opens</th>
									<th>Unique Opens</th>
									<th>Bounces</th>
									<th>Invalid Email</th>
								</tr>
							</thead>
							
							<tbody>
							<?php 
							$sendGridData = json_decode($sendGridData);
							//pre($sendGridData);
							if(count($sendGridData) > 0){
								foreach($sendGridData as $data){ 
							?>
								<tr>
									<td><?php echo $data->requests; ?></td>
									<td><?php echo $data->delivered; ?></td>
									<td><?php echo $data->clicks; ?></td>
									<td><?php echo $data->opens; ?></td>
									<td><?php echo $data->unique_opens; ?></td>
									<td><?php echo $data->bounces; ?></td>
									<td><?php echo $data->invalid_email; ?></td>
									
								</tr>
							<?php 
								}
							}else{
								echo '<tr><td colspan="6" style="text-align:center;">No any data found.</td></tr>';
							}
							?>		
							</tbody>
						</table>  			
					</div>
				</div>
			</section>
		</div>	
	</div>


		