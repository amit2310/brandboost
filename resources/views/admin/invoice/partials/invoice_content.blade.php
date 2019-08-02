<div class="panel-body no-padding-bottom">
    <div class="row">
        <div class="col-md-6 content-group">
            <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/brand_boost_logo.png" alt=""></a>
            <ul class="list-condensed list-unstyled">
                <li>2269 Elba Lane</li>
                <li>Paris, France</li>
                <li>888-555-2311</li>
            </ul>
        </div>

        <div class="col-md-6 content-group">
            <div class="invoice-details">
                <h5 class="text-uppercase text-semibold">Invoice #<?php echo $userdata[0]->local_invoice_id; ?></h5>
                <ul class="list-condensed list-unstyled">
                    <li>Date: <span class="text-semibold"><?php echo date("M, d Y", strtotime($userdata[0]->invoice_date)); ?></span></li>
                    <?php if (!empty($userdata[0]->next_billing_at)): ?>
                        <li>Next Payment Date: <span class="text-semibold"><?php echo date("M, d Y", $userdata[0]->next_billing_at); ?></span></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 content-group">
            <span class="text-muted">Invoice To:</span>
            <ul class="list-condensed list-unstyled">
                <li><h5><?php echo $userdata[0]->firstname . ' ' . $userdata[0]->lastname; ?></h5></li>
                <li><a href="#"><?php echo $userdata[0]->email; ?></a></li>
            </ul>
        </div>

        <div class="col-md-6 content-group">
            <span class="text-muted">Payment Details:</span>
            <ul class="list-condensed list-unstyled invoice-payment-details">
                <li><h5>Total Paid: <span class="text-right text-semibold">$<?php echo number_format($userdata[0]->amount_paid * 0.01, 2); ?></span></h5></li>
                <li>Transaction ID: <span class="text-semibold"><?php echo $userdata[0]->txn_id; ?></span></li>
                <?php if (!empty($userdata[0]->subscription_id)): ?>
                    <li>Subscription ID: <span class="text-semibold"><?php echo $userdata[0]->subscription_id; ?></span></li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-lg">
        <thead>
            <tr>
                <th>Description</th>
                <?php if (!empty($userdata[0]->subscription_id)): ?>
                    <th class="col-sm-2">Date From</th>
                    <th class="col-sm-2">Date To</th>
                <?php endif; ?>
                <th class="col-sm-1">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($userdata)) {
                foreach ($userdata as $oItem) {
                    ?>
                    <tr>
                        <td>
                            <h6 class="no-margin"><?php echo $oItem->description; ?></h6>
                            <span class="text-muted"><?php echo ucwords($oItem->entity_type); ?></span>
                        </td>
                        <?php if (!empty($userdata[0]->subscription_id)): ?>
                            <td><?php echo date("M d, Y", $oItem->date_from); ?></td>
                            <td><?php echo date("M d, Y", $oItem->date_to); ?></td>
                        <?php endif; ?>
                        <td><span class="text-semibold">$<?php echo number_format($oItem->amount * 0.01, 2); ?></span></td>
                    </tr>
                    <?php
                }
            }
            ?>

        </tbody>
    </table>
</div>

<div class="panel-body">
    <div class="row invoice-payment">
        <div class="col-sm-5">
            <div class="content-group">
                <h6>Authorized person</h6>
                <div class="mb-15 mt-15">
                    <img src="<?php echo base_url(); ?>assets/images/signature.png" class="display-block" style="width: 150px;" alt="">
                </div>

                <ul class="list-condensed list-unstyled text-muted">
                    <li>Eugene Kopyov</li>
                    <li>2269 Elba Lane</li>
                    <li>Paris, France</li>
                    <li>888-555-2311</li>
                </ul>
            </div>
        </div>

        <div class="col-sm-7">
            <div class="content-group">
                <h6>Total Paid</h6>
                <div class="table-responsive no-border">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Subtotal:</th>
                                <td class="text-right">$<?php echo number_format($oItem->amount * 0.01, 2); ?></td>
                            </tr>
                            <tr>
                                <th>Tax: <span class="text-regular">(0%)</span></th>
                                <td class="text-right">$0</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td class="text-right text-primary"><h5 class="text-semibold">$<?php echo number_format($oItem->amount * 0.01, 2); ?></h5></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="text-right">
                    <?php if($display_type == 'popup'):?>
                    
                    <a style="cursor:pointer;" class="btn btn-primary btn-labeled send_email"><b><i class="icon-envelope"></i></b> Email</a>

                    <a href="<?php echo base_url('admin/invoices/download_invoice/' . $invoiceID); ?>" class="btn btn-primary btn-labeled"><b><i class="icon-download"></i></b> Download</a>
                    
                    <button type="button" class="btn btn-primary btn-labeled"><b><i class="icon-printer"></i></b> Print</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <h6>Other information</h6>
    <p class="text-muted">Thank you for using Limitless. This invoice can be paid via PayPal, Bank transfer, Skrill or Payoneer. Payment is due within 30 days from the date of delivery. Late payment is possible, but with with a fee of 10% per month. Company registered in England and Wales #6893003, registered office: 3 Goodman Street, London E1 8BF, United Kingdom. Phone number: 888-555-2311</p>
</div>

