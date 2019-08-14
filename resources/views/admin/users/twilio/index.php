<!--=====================body=========================-->
	<div class="container-fluid">
		<div class="col-md-12 col-sm-12">
			<section class="membership">
				<div class="row">
					<div class="col-md-6">
						<div class="input-icon right cust_search"> <i class="fa fa-search"></i>
							<input id="search_event" class="form-control searchbox" style="" placeholder="Search..." type="text">
						</div>
					</div>
					<div class="col-md-6 top_btn">
						<!-- <a style="margin-left: 20px;" data-toggle="modal" data-target="#userLevelAdd" class="btn-orange" href="#"><strong></strong>&nbsp; &nbsp; <span>&nbsp; &nbsp; ADD USERS</span></a> -->
					</div>
					<div class="col-md-12">
						<h1 class="top_heading">Brand Boost Twillio message Detail</h1>
					</div>
					<div class="col-md-12"> 
						<table class="table blef0 brig0">
							<thead>
								<tr>
								
									<th class="text-center">Body</th>
									<th class="text-center">From</th>
									<th class="text-center">To</th>
									<th class="text-center">Direction</th>
									<th class="text-center">Date</th>
									<th class="text-center">Status</th>
								</tr>
							</thead>
							
							<tbody>
								<?php foreach($client->messages->read() as $message){ 
									//pre($message);
									?>
								<tr>
									
									<td class="text-center" width="30%"><?php echo $message->body; ?></td>
									<td class="text-center"><?php echo $message->from; ?></td>
									<td class="text-center"><?php echo $message->to; ?></td>
									<td class="text-center"><?php echo $message->direction; ?></td>
									<td class="text-center"><?php echo date_format($message->dateCreated, 'd M, Y'); ?></td>
									<td class="text-center"><?php echo $message->status; ?></td>
									
								</tr>
								<?php } ?>										
							</tbody>
							
						</table>  			
					</div>
				</div>
			</section>
		</div>	
	</div>