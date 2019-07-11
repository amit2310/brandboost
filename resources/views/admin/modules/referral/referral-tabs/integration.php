<div class="tab-pane <?php echo ($defalutTab == 'integrations') ? 'active' : ''; ?>" id="right-icon-tab6">
  <div class="row">
      <div class="col-md-3">
        <div style="margin: 0;" class="panel panel-flat">
          <div class="panel-heading">
            <h6 class="panel-title">How to add widget</h6>
          </div>
          <div class="panel-body p0">
            <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item br0"  src="https://www.youtube.com/embed/2H_Jsgh2Z3Y?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
          </div>
      
      
      
          </div>
        </div>
      </div>
      
      <div class="col-md-6">
        <div style="margin: 0;" class="panel panel-flat">
          <div class="panel-heading">
            <h6 class="panel-title">You’re All Set!</h6>
          </div>
          <div class="panel-body min_h270 p0">
	        <div class="bbot p20 m0">
	          <p>Visit your store's dashboard and find your purchase completed page.Paste this code just before the closing body tag on your purchase completed page after replacing these dynamic variables: You must replace the following dummy fields in the code snippet with dynamic checkout data from your store platform:
	          </p>
            </div>
          
          
            <div class="bbot p20">
                <p class="fsize11 text-muted m0">
                data-bb-firstname: Customer First Name<br><br>

				data-bb-lastname: Customer Last Name<br><br>

				data-bb-email: Customer Email Address<br><br>

				data-bb-invoice-id: Invoice Number<br><br>

				data-bb-amount: Invoice Amount<br><br>

				data-bb-currency: Invoice Currency (3 letter code)<br><br>

				data-bb-timestamp: Purchase Timestamp (UNIX time)<br><br>                      
        		</p>
    		</div>
		    <div class="p20">
		        <label class="custmo_checkbox">
		        <input type="checkbox" class="showPopupAfterSaleIntegration">
		        <span class="custmo_checkmark"></span>
		        &nbsp; Display Referral popup after successful purchase
		        </label>
		    </div>
  		  </div>
		</div>
	</div>

<div class="col-md-3">
<div style="margin: 0;" class="panel panel-flat">
  <div class="panel-heading">
    <h6 class="panel-title">How to add widget</h6>
  </div>
    <div class="panel-body min_h270 p0">
		<div class="p20 bbot" >
 <pre class="prettyprint dummyPostSaleCodeWithoutPopup_new">
   &lt;div id="bb-invoice_details" 
			data-bb-firstname="Alen"
			data-bb-lastname="Sultanic"
			data-bb-email="umair.products@gmail.com"
			data-bb-invoice-id="12345"
			data-bb-amount="10"
			data-bb-currency="USD"
			data-bb-timestamp="<?php echo time(); ?>"&gt;
  &lt;/div&gt;
  &lt;script type="text/javascript" 
  			 id="bbscriptloader" 
  			 data-key="<?php echo $oSettings->hashcode; ?>" 
  			 data-widgets="referral-sale" 
  			 async="true" 
  			 src="<?php echo site_url(); ?>assets/js/ref_widgets.js"&gt;
  &lt;/script&gt;
</pre>                      

<pre class="prettyprint dummyPostSaleCodeWithPopup_new" style="display: none;" >
   &lt;div id="bb-invoice_details" 
			data-bb-firstname="Alen"
			data-bb-lastname="Sultanic"
			data-bb-email="umair.products@gmail.com"
			data-bb-invoice-id="12345"
			data-bb-amount="10"
			data-bb-currency="USD"
			data-bb-timestamp="<?php echo time(); ?>"
			data-bb-showwidget="true"&gt;
  &lt;/div&gt;
  &lt;script type="text/javascript" 
  			 id="bbscriptloader" 
  			 data-key="<?php echo $oSettings->hashcode; ?>" 
  			 data-widgets="referral-sale" 
  			 async="true" 
  			 src="<?php echo site_url(); ?>assets/js/ref_widgets.js"&gt;
  &lt;/script&gt;
</pre>                      
        </div>
        <div class="prettyprintDivWithoutPopup" style="display: none;">
&lt;div id="bb-invoice_details" data-bb-firstname="Alen" data-bb-lastname="Sultanic" data-bb-email="umair.products@gmail.com" data-bb-invoice-id="12345" data-bb-amount="10" data-bb-currency="USD" data-bb-timestamp="<?php echo time(); ?>"&gt; &lt;/div&gt; &lt;script type="text/javascript" id="bbscriptloader" data-key="<?php echo $oSettings->hashcode; ?>" data-widgets="referral-sale" async="true" src="<?php echo site_url(); ?>assets/js/ref_widgets.js"&gt; &lt;/script&gt;
        </div>
        <div class="prettyprintDivWithPopup" style="display: none;">
&lt;div id="bb-invoice_details" data-bb-firstname="Alen" data-bb-lastname="Sultanic" data-bb-email="umair.products@gmail.com" data-bb-invoice-id="12345" data-bb-amount="10" data-bb-currency="USD" data-bb-timestamp="<?php echo time(); ?>" data-bb-showwidget="true"&gt; &lt;/div&gt; &lt;script type="text/javascript" id="bbscriptloader" data-key="<?php echo $oSettings->hashcode; ?>" data-widgets="referral-sale" async="true" src="<?php echo site_url(); ?>assets/js/ref_widgets.js"&gt; &lt;/script&gt;
        </div>
        <div class="p20 text-right">
        <button class="btn btn-xs btn_white_table pl10 pr10 withOutPopup" onclick="copyToClipboard('.prettyprintDivWithoutPopup')">Copy Code</button>
        <button class="btn btn-xs btn_white_table pl10 pr10 withPopup" style="display: none;" onclick="copyToClipboard('.prettyprintDivWithPopup')">Copy Code</button>
        </div>
        
      </div>
    </div>
  </div>
  
 
</div>

<!-- <div class="row pull-right">
	<div class="col-md-12">
        <a href="javascript:void(0);" id="publishNPSCampaign" class="btn dark_btn mt30">Publish</a>
    </div>
</div> -->
</div>


<!-- ******* Old ******* -->

<?php /* ?>
<div class="tab-pane <?php echo ($defalutTab == 'integrations') ? 'active' : ''; ?>" id="right-icon-tab6">
	
    <p>Visit your store's dashboard and find your purchase completed page.Paste this code just before the closing body tag on your purchase completed page after replacing these dynamic variables:
        You must replace the following dummy fields in the code snippet with dynamic checkout data from your store platform:
		
		<p class="highlighted"><strong>data-bb-firstname: Customer First Name</strong></p>
		
		<p class="highlighted"><strong>data-bb-lastname: Customer Last Name</strong></p>
		
		<p class="highlighted"><strong>data-bb-email: Customer Email Address</strong></p>
		
		<p class="highlighted"><strong>data-bb-invoice-id: Invoice Number</strong></p>
		
		<p class="highlighted"><strong>data-bb-amount: Invoice Amount</strong></p>
		
		<p class="highlighted"><strong>data-bb-currency: Invoice Currency (3 letter code)</strong></p>
		
		<p class="highlighted"><strong>data-bb-timestamp: Purchase Timestamp (UNIX time)</strong></p>
		
		
	</p>
	<p>
		<br>
	</p>
	<p>
		<input type="checkbox" id="showPopupAfterSaleIntegration"> Display Referral popup after successful purchase?
	</p>
	<div class="clearfix"></div>
	<br>
	<p>
		<textarea cols="100%" rows="15" name="txtPostPurchase" id="txtPostPurchaseIntegration"><div id="bb-invoice_details" 
			data-bb-firstname="Alen"
			data-bb-lastname="Sultanic"
			data-bb-email="umair.products@gmail.com"
			data-bb-invoice-id="12345"
			data-bb-amount="10"
			data-bb-currency="USD"
			data-bb-timestamp="<?php echo time(); ?>"
			></div><script type="text/javascript" id="bbscriptloader" data-key="<?php echo $oSettings->hashcode; ?>" data-widgets="referral-sale" async="true" src="<?php echo site_url(); ?>assets/js/ref_widgets.js"></script>
		</textarea><button type="button" id="btnPostPurchaseIntegration" class="btn bl_cust_btn" style="position:relative;height:86px;top:-41px;left:5px;">Copy <i class="icon-arrow-right14 position-right"></i></button>
	</p>
	<div class="clearfix"></div>
	<div class="row pull-right">
		<a href="javascript:void(0);" id="publishNPSCampaign" class="btn bl_cust_btn bg-blue-600">Publish</a>
	</div>
	
</div>

<textarea id="dummyPostSaleCodeWithPopup" style="display:none;"><div id="bb-invoice_details" 
    data-bb-firstname="Alen"
    data-bb-lastname="Sultanic"
    data-bb-email="umair.products@gmail.com"
    data-bb-invoice-id="12345"
    data-bb-amount="10"
    data-bb-currency="USD"
    data-bb-timestamp="<?php echo time(); ?>"
    data-bb-showwidget="true"
    ></div>
<script type="text/javascript" id="bbscriptloader" data-key="<?php echo $oSettings->hashcode; ?>" data-widgets="referral-sale" async="true" src="<?php echo site_url(); ?>assets/js/ref_widgets.js"></script></textarea>


<textarea id="dummyPostSaleCodeWithoutPopup" style="display:none;"><div id="bb-invoice_details" 
    data-bb-firstname="Alen"
    data-bb-lastname="Sultanic"
    data-bb-email="umair.products@gmail.com"
    data-bb-invoice-id="12345"
    data-bb-amount="10"
    data-bb-currency="USD"
    data-bb-timestamp="<?php echo time(); ?>"
    ></div>
<script type="text/javascript" id="bbscriptloader" data-key="<?php echo $oSettings->hashcode; ?>" data-widgets="referral-sale" async="true" src="<?php echo site_url(); ?>assets/js/ref_widgets.js"></script></textarea>
<?php */ ?>
<script>
    $(document).ready(function () {
		
        /*$("#btnPostPurchaseIntegration").click(function () {
            var copyText = $("#txtPostPurchaseIntegration").val();
           
            $("#txtPostPurchaseIntegration").select();
			
            document.execCommand("copy");
		});*/
		
		
        /*$("#showPopupAfterSaleIntegration").change(function () {
            if ($(this).is(":checked")) {
                var codeContent = $("#dummyPostSaleCodeWithPopup").val();
				
				} else {
                var codeContent = $("#dummyPostSaleCodeWithoutPopup").val();
				
			}
			
            $("#txtPostPurchaseIntegration").val('');
            $("#txtPostPurchaseIntegration").val(codeContent);
			
		});*/

		$(".showPopupAfterSaleIntegration").change(function () {

            if ($(this).is(":checked")) {
            	$(".dummyPostSaleCodeWithoutPopup_new").hide();
                $(".dummyPostSaleCodeWithPopup_new").show();

                $('.withOutPopup').hide();
                $('.withPopup').show();
				$(".showPopupAfterSaleIntegration").prop("checked", true);

			} else {
                $(".dummyPostSaleCodeWithoutPopup_new").show();
                $(".dummyPostSaleCodeWithPopup_new").hide();

                $('.withOutPopup').show();
                $('.withPopup').hide();
                $(".showPopupAfterSaleIntegration").prop("checked", false);
			}
			
		});
		
	});



	function copyToClipboard(element) {
	  console.log(element);
	  var $temp = $("<input>");
	  $("body").append($temp);
	  var widgetScript = String($(element).text());
	  $temp.val(widgetScript).select();
	  document.execCommand("copy");
	  $temp.remove();
	}

</script>