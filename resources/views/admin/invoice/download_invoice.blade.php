<div style="width: 1000px; background:#fff; box-sizing: border-box; margin: 0 auto">
    <table width="100%" style="font-family:verdana; font-size: 13px; color: #253b6a;" cellpadding="0">
        <tr>
            <td  width="50%" ><img style="width: 60px;" src="http://brandboost.io/new_pages/assets/images/brandboost_logo_icon.png"/></td>
            <td width="50%" style="text-align: right;">
                <p style="line-height: 1.5; margin-bottom: 15px">BrandBoost<br/>
1331 Hart Ridge Road<br/>
48436 Gaines, MI<br/>
VAT no.: 987654321 </p>
        <p>your.mail@gmail.com <img src="<?php echo base_url(); ?>assets/images/atthrate_blue.png"/></p>
        <p>+386 989 271 3115 <img src="<?php echo base_url(); ?>assets/images/mobile_m.png"/></p>
            </td>
        </tr>
    </table>
    
    
    <table width="100%" style="font-family: verdana; font-size: 13px; color: #253b6a;" cellpadding="0">
        <tr>
            <td><h1>Invoice</h1></td>
        </tr>
    </table>
    
    
    
    
    
    <table width="100%" style="font-family: verdana; font-size: 13px; color: #253b6a; border-collapse: collapse;" cellpadding="0">
        <tr>
            <td width="50%" >
            <p style="line-height: 20px;">
                invoice no #<?php echo $userdata[0]->local_invoice_id; ?><br/>
                <br>
            </p>
            <p style="line-height: 20px;">
                Invoice date<br/>
                <strong><?php echo date("M, d Y", strtotime($userdata[0]->invoice_date)); ?></strong>
            </p>
            </td>
            
            
            <td width="50%" style="text-align: right;">
                <p>Recipient</p>
                <p style="line-height: 20px;"><?php echo ucfirst($userdata[0]->bill_firstname); ?> <?php echo ucfirst($userdata[0]->bill_lastname); ?> <br/>
4304 Liberty Avenue<br/>
92680 Tustin, CA<br/>
VAT no.: 12345678</p>
        <p>company.mail@gmail.com <img src="<?php echo base_url(); ?>assets/images/atthrate_blue.png"/></p>
        <p>+386 714 505 8385 <img src="<?php echo base_url(); ?>assets/images/mobile_m.png"/></p>
            </td>
        </tr>
        
        
    </table>
    
    
    
    
    <table width="100%" class="pricetable" style="font-family: verdana; font-size: 13px; color: #253b6a; border-top: 1px solid #ddd;  margin: 50px 0 0; padding: 50px 0" cellpadding="0">
    <thead>
        <tr>
            <th style="text-align: left; font-size: 12px; color: #5e729d; padding: 15px 0">DESCRIPTION</th>
            <?php if (!empty($userdata[0]->subscription_id)): ?>
                    <th style="text-align: left; font-size: 12px; color: #5e729d; padding: 15px 0" class="col-sm-2">Date From</th>
                    <th style="text-align: left; font-size: 12px; color: #5e729d; padding: 15px 0" class="col-sm-2">Date To</th>
                <?php endif; ?>
            <th style="text-align: left; font-size: 12px; color: #5e729d; padding: 15px 0">PRICE</th>
            <th style="text-align: left; font-size: 12px; color: #5e729d; padding: 15px 0;text-align: right;" class="text_right">AMOUNT</th>
        </tr>
    </thead>
    
    <tbody>
            <?php if(!empty($userdata)){
            foreach($userdata as $oItem){
            ?>
            <tr>
            <td style="padding: 15px 0; border-collapse: collapse;border-bottom: 1px solid #ddd" class="bbot">
            <strong><?php echo $oItem->description;?></strong></td>

             <?php if (!empty($userdata[0]->subscription_id)): ?>
                            <td style="padding: 15px 0; border-collapse: collapse;border-bottom: 1px solid #ddd"><?php echo date("M d, Y", $oItem->date_from); ?></td>
                            <td style="padding: 15px 0; border-collapse: collapse;border-bottom: 1px solid #ddd"><?php echo date("M d, Y", $oItem->date_to); ?></td>
                        <?php endif; ?>


            <td style="padding: 15px 0; border-collapse: collapse;border-bottom: 1px solid #ddd" class="bbot"><?php echo number_format($oItem->amount * 0.01, 2); ?> USD</td>
            <td style="padding: 15px 0; border-collapse: collapse; border-bottom: 1px solid #ddd ;text-align: right;" class="bbot text_right"><?php echo number_format($oItem->amount * 0.01, 2); ?> USD</td>
            </tr>

            <?php
            }
            ?>

         <tr>
            <td  <?php if (!empty($userdata[0]->subscription_id)): ?> colspan="3" <?php endif; ?>>&nbsp;</td>
            <td style="padding: 15px 0;border-bottom: 1px solid #ddd;color: #6b7ea3;" class="bbot txt_grey">SUBTOTAL</td>
            <td style="padding: 15px 0;border-bottom: 1px solid #ddd;text-align: right;" class="bbot text_right"><strong><?php echo number_format($oItem->amount * 0.01, 2); ?> USD</strong></td>
        </tr>
       
        
        <tr>
            <td  <?php if (!empty($userdata[0]->subscription_id)): ?> colspan="3" <?php endif; ?>>&nbsp;</td>
            <td style="padding: 15px 0;border-bottom: 1px solid #ddd;color: #1f2229" class="txt_dark"><strong>TOTAL</strong></td>
            <td style="padding: 15px 0;border-bottom: 1px solid #ddd;text-align: right;" class="text_right txt_blue"><strong><?php echo number_format($oItem->amount * 0.01, 2); ?> USD</strong></td>
        </tr>
 
            <?php
            }
            ?>
        
    </tbody>
        
        
        
    </table>
 <table width="100%" style="font-family: verdana; font-size: 13px; color: #253b6a;margin-top: 20px; margin-bottom: 50px" cellpadding="0">
        <tr>
            <td width="100%" style="text-align: right;">
                <p style="color: #6b7ea3;" class="txt_grey">Transfer the amount to the business account below. Please include invoice number on your check.</p>
                <p style="color: #6b7ea3;" class="txt_grey">BANK: <strong style="color: #1f2229" class="txt_dark">FTSBUS33</strong>&nbsp; &nbsp; IBAN:<strong style="color: #1f2229" class="txt_dark">GB82-1111-2222-3333</strong></p>
                
            </td>
        </tr>
    </table>
    
    
    <table width="100%" style="font-family: verdana; font-size: 13px; color: #253b6a; margin: 50px 0 0 0;" cellpadding="0">
        <tr>
            <td width="60%" style="text-align: left;">
                <p style="color: #5e729d">NOTES</p>
                <p style="color: #5e729d">
                    All amounts are in dollars. Please make the payment within 15 days from the issue of date of this invoice. Tax is not charged on the basis of paragraph 1 of Article 94 of the Value Added Tax Act (I am not liable for VAT).<br>
<br>


Thank you for you confidence in my work.<br>
<img src="/assets/images/signature.png" class="display-block" style="width: 150px;" alt="">
                </p>
                
                
            </td>
            <td style="text-align: right; width: 40%"><img src="<?php echo base_url(); ?>assets/images/invoice_bkg.png" style="float: right"></td>
        </tr>
        
    </table>
    
    
    
    
    
    
</div>


</body>
</html>
