<html>
	<head>
	</head>
	<body>
		<table width="100%" style="font-family: serif;" cellpadding="10">
			<tr>
				<td width="25%"><img height="50px;" src="http://brandboost.io/new_pages/assets/images/drop_img.png"/></td>
				<td width="50%" style="padding: 0px; border-radius:5px; text-align: left; ">
					<span style="font-size: 14px; color: #555555; font-family: sans;">
						2269 Elba Lane<br>
						Paris, France<br>
						888-555-2311
					</span>
				</td>
				<td width="25%" style="padding: 0px; border-radius:5px; text-align: right;">
					<span style="font-size: 14px; color: #555555; font-family: sans;">
						<b>Invoice #<?php echo $userdata[0]->local_invoice_id; ?></b><br>
						Date: <?php echo date("M, d Y", strtotime($userdata[0]->invoice_date)); ?>
						<?php if (!empty($userdata[0]->next_billing_at)): ?>
                        <p>Next Payment Date: <span class="text-semibold"><?php echo date("M, d Y", $userdata[0]->next_billing_at); ?></span></p>
                        <?php endif; ?>
					</span>
				</td>
			</tr>
		</table>
		<br>
		<table width="100%" cellpadding="10">
			<tr>
				<td style="border-bottom: 1px solid #ddd; ">&nbsp;</td>
			</tr>
		</table>
		<br>
		<table width="100%"  cellpadding="10">
			<tr>
				<td width="50%" style="text-align: left; ">
					<span style="font-size: 12px;">
						<strong>Invoice To:</strong><br><br>
						<?php echo $userdata[0]->firstname . ' ' . $userdata[0]->lastname; ?><br>
						<a href="#"><?php echo $userdata[0]->email; ?></a>
					</span>
				</td>
				<td width="50%" style="text-align: right;">
					<div style="font-size: 12px; line-height:40px;">
						<strong>Payment Details1:</strong><br>
						<br>
						<div style="padding-bottom:15px;">Total Paid: $<?php echo number_format($userdata[0]->amount_paid * 0.01, 2); ?></div>
						<div style="padding-bottom:15px;">Transaction ID: <?php echo $userdata[0]->txn_id; ?></div>
						<?php if (!empty($userdata[0]->subscription_id)): ?>
						<div>Subscription ID: <?php echo $userdata[0]->subscription_id; ?></div>
						<?php endif; ?>
					</div>
				</td>
			</tr>
		</table>
		<br>
		<br>
		<table width="100%" cellspacing="10" border="1">
			<thead><tr>
				<td style="padding:5px;">
					<p>Description</p>
				</td>
				
				<td style="padding:5px;">
					<?php if (!empty($userdata[0]->subscription_id)): ?>
					<p>Date From</p>
					<?php endif; ?>  
				</td>
				
				<td style="padding:5px;">
					<?php if (!empty($userdata[0]->subscription_id)): ?>
					<p>Date To</p>
					<?php endif; ?>  
				</td>
				
				<td style="padding:5px;">
					<span>Total</span>
				</td>
				
			</tr>
			</thead>
			<tbody>
				<?php
					if (!empty($userdata)) {
						foreach ($userdata as $oItem) {
						?>
						
						<tr>
							<td style="padding:5px;">
								<p><?php echo $oItem->description; ?></p>
								<p><?php //echo ucwords($oItem->entity_type); ?></p>
							</td>
							
							<td style="padding:5px;">
								<?php if (!empty($userdata[0]->subscription_id)): ?>
								<p><?php echo date("M d, Y", $oItem->date_from); ?></p>
								<?php endif; ?>
							</td>
							
							<td style="padding:5px;">
								<?php if (!empty($userdata[0]->subscription_id)): ?>
								<p><?php echo date("M d, Y", $oItem->date_to); ?></p>
								<?php endif; ?>
							</td>
							
							<td style="padding:5px;">
								<span>$<?php echo number_format($oItem->amount * 0.01, 2); ?></span>
							</td>
						</tr>
						
						<?php
						}
					}
				?> 
			</tbody>
		</table>
		<table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin:50px 0;">
			<tr>
				<td width="50%">
					<span style="font-size: 12px; color: #555555;">
						<strong>Authorized person</strong>
						<br>
						<img width="150" src="http://brandboost.io/assets/images/signature.png"/>
						<br><br><br>
						Eugene Kopyov<br>
						2269 Elba Lane<br>
						Paris, France<br>
						888-555-2311<br>
					</span><br>
					
				</td>
				<td width="50%" style="text-align: right;">
					<span style="font-size: 13px; line-height: 38px;">		
						<strong>Total Paid</strong><br>
						<strong>Subtotal:</strong> 	$<?php echo number_format($oItem->amount * 0.01, 2); ?><br>
						<strong>Tax:</strong> (0%) 	$0.00<br>
						<strong>Total:</strong> $<?php echo number_format($oItem->amount * 0.01, 2); ?>
					</span>
				</td>
			</tr>	
		</table>
		
		<table width="100%" cellpadding="10">
			<tr>
				<td style="border-bottom: 1px solid #ddd; ">&nbsp;</td>
			</tr>
		</table>
		<br>
		
		<table width="100%" style="font-family: serif;" cellpadding="10">
			<tr>
				<td width="100%" style="padding: 0px; border-radius:5px; text-align: left; ">
					<span style="font-size: 12px; color: #555555; font-family: sans;">
						<strong>Other information</strong><br>
						<br>
						Thank you for using Limitless. This invoice can be paid via PayPal, Bank transfer, Skrill or Payoneer. Payment is due within 30 days from the date of delivery. Late payment is possible, but with with a fee of 10% per month. Company registered in England and Wales #6893003, registered office: 3 Goodman Street, London E1 8BF, United Kingdom. Phone number: 888-555-2311	
					</span>
				</td>
			</tr>
		</table>
		<br>
		<table width="100%" cellpadding="10">
			<tr>
				<td style="border-bottom: 1px solid #ddd; ">&nbsp;</td>
			</tr>
		</table>
	</body>
</html>