<?php //echo count($productsDetails); ?>
<?php //pre($productsDetails); ?>
<?php if((count($productsDetails) > 0) && ($productsDetails[0]->product_name != '')){ ?>
<table style="margin-top: 10px; border-radius: 5px; width: 100%;">

   <!---fourth box--->
    <tbody><tr>
   <td>
    <table width="100%;">
     <tbody><tr>
            <th style="padding:0 60px 32px 60px; border-bottom: 1px solid #f0f2f8;" class="p0"> 
               <table style="margin-top: 20px; width: 100%;">
                <tbody>
                  <tr>
                    <td> 
                      <p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:30px 0 10px; font-size: 20px; color:#0c0c2c; font-weight: 600; padding: 0 10px;" class="col_t_3">Products and Services Details</p>
                    </td>
                 </tr>
                </tbody>
              </table>
                </th>
          </tr>
     <tr>
      <td height="40">&nbsp;</td>
     </tr>
     
    </tbody></table></td>
  </tr>
  <?php foreach($productsDetails as $productData){ ?>
  <tr>
      <td style="padding:0 80px;" class="p10">
       <table width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
        <tbody><tr>
         <td class="" style="width: 19%;"><a title="" href=""><img style="border:0px; margin: 0px 0 0" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $productData->product_image; ?>" alt="" title="" class="box_img" width="82px" height="82px" border="0"></a></td>
         <td class="blank_td" style="font-size: 0; line-height: 0;" width="45">&nbsp;</td>
         <td class="" style="width: 74%;"><h4 style="line-height: 15px; font-weight: 600; margin: 20px 0 13px 0px; font-family: 'Open Sans', sans-serif; font-size: 18px; color: #202040;" class="p15 mt0"><?php echo $productData->product_name; ?></h4>
		 <p style="margin: 0; font-family: 'Open Sans', sans-serif; color:#494968; font-size: 14px; font-weight: normal; line-height: 20px; text-align: justify; color: #494968;" class="p15"><?php echo $productData->product_description; ?></p>
          </td>
        </tr>
       </tbody></table></td>
     </tr>
    
  <?php } ?>

   <!---fourth box--->

 		</tbody></table>
		
<?php } ?>