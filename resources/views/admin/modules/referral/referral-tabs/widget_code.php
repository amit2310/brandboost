<div class="tab-pane <?php echo ($defalutTab == 'widgets') ? 'active' : ''; ?>" id="right-icon-tab3">
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
        <div  class="panel panel-flat">
          <div class="panel-heading">
            <h6 class="panel-title">Invite Code</h6>
          </div>
          <div class="panel-body min_h270 p0">
          <div class="p20 bbot">
            <pre class="prettyprint">
&lt;script
    type="text/javascript" 
    id="bbscriptloader" 
    data-key="<?php echo $oSettings->hashcode; ?>" 
    data-widgets="referral" 
    async="true" src="<?php echo site_url(); ?>assets/js/ref_widgets.js"&gt;
&lt;/script&gt;</pre>                        
    </div>
    <div class="invite_code_copy" style="display: none;">&lt;script type="text/javascript" id="bbscriptloader" data-key="<?php echo $oSettings->hashcode; ?>" data-widgets="referral" async="true" src="<?php echo site_url(); ?>assets/js/ref_widgets.js"&gt;&lt;/script&gt;
    </div> 
    <div class="p20">
    <button class="btn btn-xs btn_white_table pl10 pr10"  onclick="copyToClipboard('.invite_code_copy')">Copy Code</button>
    </div>
    
  </div>
</div>

<div  class="panel panel-flat">
  <div class="panel-heading">
    <h6 class="panel-title">Post Purchase Code</h6>
  </div>
  <div class="panel-body min_h270 p0">
  <div class="p20 bbot">

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

   
    <div class="p20">
    <button class="btn btn-xs btn_white_table pl10 pr10 withOutPopup" onclick="copyToClipboard('.prettyprintDivWithoutPopup')">Copy Code</button>
    <button class="btn btn-xs btn_white_table pl10 pr10 withPopup" style="display: none;" onclick="copyToClipboard('.prettyprintDivWithPopup')">Copy Code</button>
    </div>
    
  </div>
</div>


<div  class="panel panel-flat">
  <div class="panel-heading">
    <h6 class="panel-title">Embedded Signup Code</h6>
  </div>
  <div class="panel-body min_h270 p0">
  <div class="p20 bbot">
    <pre class="prettyprint">
&lt;script
    type="text/javascript" 
    id="bbscriptloader" 
    data-key="<?php echo $oSettings->hashcode; ?>" 
    data-widgets="referral-embed" 
    async="true" 
    src="<?php echo site_url(); ?>assets/js/ref_widgets.js"&gt;
&lt;/script&gt;
</pre>
                                
        </div>
        <div class="embSignupCodeCopy" style="display: none;">&lt;script type="text/javascript" id="bbscriptloader" data-key="<?php echo $oSettings->hashcode; ?>" data-widgets="referral-embed" async="true" src="<?php echo site_url(); ?>assets/js/ref_widgets.js"&gt; &lt;/script&gt;
        </div>
        <div class="p20">
        <button class="btn btn-xs btn_white_table pl10 pr10" onclick="copyToClipboard('.embSignupCodeCopy')">Copy Code</button>
        </div>
        
      </div>
    </div>
  </div>
  
  
  <div class="col-md-3">

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
            Display Referral popup after successful purchase
            </label>
        </div>
      </div>
    </div>
  </div>
  
  
</div>

<!-- <div class="row pull-right">
    <div class="col-md-12">
        <a href="<?php echo base_url("/admin/modules/referral/setup/{$programID}?t=workflow") ?>" class="btn dark_btn mt30">Continue</a>
    </div>
</div> -->
</div>

<!-- ****** old ****** -->

<?php /* ?>
<div class="tab-pane <?php echo ($defalutTab == 'widgets') ? 'active' : ''; ?>" id="right-icon-tab3">
    <div class="panel-body">
        <div class="tabbable">
            <ul class="nav nav-tabs nav-tabs-bottom">
                <li class="active"><a href="#referral_tab" data-toggle="tab"><i class="fa fa-envelope position-left"></i> Invite</a></li>
                <li><a href="#post_purchase_tab" data-toggle="tab"><i class="fa fa-comments position-left"></i> Post Purchase</a></li></li>
                <li><a href="#embedded_tab" data-toggle="tab"><i class="fa fa-comments position-left"></i> Embedded Signup </a></li></li>
            </ul>
            <div class="tab-content"> 
                <!--########################TAB 1 ##########################-->
                <div class="tab-pane active" id="referral_tab">
                    <p>A small widget that sits on your store page allowing customers to instantly sign-up as an advocate:</p>

                    <textarea cols="100%" rows="4" name="txtReferral" id="txtReferral">
<script type="text/javascript" id="bbscriptloader" data-key="<?php echo $oSettings->hashcode; ?>" data-widgets="referral" async="true" src="<?php echo site_url(); ?>assets/js/ref_widgets.js">
</script></textarea> <button type="button" id="btnReferral" style="position:relative;height:86px;top:-41px;" class="btn bl_cust_btn">Copy <i class="icon-arrow-right14 position-right"></i></button>
                    
                    


                </div>
                <!--########################TAB 2 ##########################-->
                <div class="tab-pane" id="post_purchase_tab">

                    <p>Visit your store's dashboard and find your purchase completed page.Paste this code just before the closing body tag on your purchase completed page after replacing these dynamic variables:
                        You must replace the following dummy fields in the code snippet with dynamic checkout data from your store platform:
                    <p><strong>data-bb-firstname: Customer First Name</strong></p>

                    <p><strong>data-bb-lastname: Customer Last Name</strong></p>

                    <p><strong>data-bb-email: Customer Email Address</strong></p>

                    <p><strong>data-bb-invoice-id: Invoice Number</strong></p>

                    <p><strong>data-bb-amount: Invoice Amount</strong></p>

                    <p><strong>data-bb-currency: Invoice Currency (3 letter code)</strong></p>

                    <p><strong>data-bb-timestamp=: Purchase Timestamp (UNIX time)</strong></p>


                    </p>
                    <input type="checkbox" id="showPopupAfterSale"> Display Referral popup after successful purchase?
                    <div class="clearfix"></div>
                    <br>
                    <textarea cols="100%" rows="15" name="txtPostPurchase" id="txtPostPurchase">
<div id="bb-invoice_details" 
    data-bb-firstname="Alen"
    data-bb-lastname="Sultanic"
    data-bb-email="umair.products@gmail.com"
    data-bb-invoice-id="12345"
    data-bb-amount="10"
    data-bb-currency="USD"
    data-bb-timestamp="123456789"
    ></div>
<script type="text/javascript" id="bbscriptloader" data-key="<?php echo $oSettings->hashcode; ?>" data-widgets="referral-sale" async="true" src="<?php echo site_url(); ?>assets/js/ref_widgets.js"></script>
                    </textarea> <button type="button" id="btnPostPurchase" style="position:relative;height:86px;top:-41px;left:5px;" class="btn bl_cust_btn">Copy <i class="icon-arrow-right14 position-right"></i></button>
                    <div class="clearfix"></div>
                    
                </div>

                <!--########################TAB 3 ##########################-->
                <div class="tab-pane" id="embedded_tab">
                    <p>Embed your sign-up page into your store, so your customers can sign up as they're browsing:</p>

                    <textarea cols="100%" rows="4" name="txtEmbed" id="txtEmbed">
<script type="text/javascript" id="bbscriptloader" data-key="<?php echo $oSettings->hashcode; ?>" data-widgets="referral-embed" async="true" src="<?php echo site_url(); ?>assets/js/ref_widgets.js">
</script></textarea><button type="button" id="btnEmbed" style="position:relative;height:86px;top:-41px;left:5px;" class="btn bl_cust_btn">Copy <i class="icon-arrow-right14 position-right"></i></button>
                    <div class="clearfix"></div>
                    

                </div>

                <!--########################TAB end ##########################--> 
            </div>
        </div>
    </div>
    <div class="row pull-right">
        <a href="<?php echo base_url("/admin/modules/referral/setup/{$programID}?t=workflow") ?>" class="btn bl_cust_btn bg-blue-600">Continue</a>
    </div>
</div>

<textarea id="dummyPostSaleCodeWithPopup" style="display:none;"><div id="bb-invoice_details" 
    data-bb-firstname="Alen"
    data-bb-lastname="Sultanic"
    data-bb-email="umair.products@gmail.com"
    data-bb-invoice-id="12345"
    data-bb-amount="10"
    data-bb-currency="USD"
    data-bb-timestamp="123456789"
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
    data-bb-timestamp="123456789"
    ></div>
<script type="text/javascript" id="bbscriptloader" data-key="<?php echo $oSettings->hashcode; ?>" data-widgets="referral-sale" async="true" src="<?php echo site_url(); ?>assets/js/ref_widgets.js"></script></textarea>




<script>
    $(document).ready(function () {

        $("#btnReferral").click(function () {
            var copyText = $("#txtReferral").val();

            $("#txtReferral").select();

            document.execCommand("copy");
        });

        $("#btnPostPurchase").click(function () {
            var copyText = $("#txtPostPurchase").val();

            $("#txtPostPurchase").select();

            document.execCommand("copy");
        });


        $("#btnEmbed").click(function () {
            var copyText = $("#txtEmbed").val();

            $("#txtEmbed").select();

            document.execCommand("copy");
        });


        $("#showPopupAfterSale").change(function () {
            if ($(this).is(":checked")) {
                var codeContent = $("#dummyPostSaleCodeWithPopup").val();

            } else {
                var codeContent = $("#dummyPostSaleCodeWithoutPopup").val();

            }

            $("#txtPostPurchase").val('');
            $("#txtPostPurchase").val(codeContent);

        });


    });
</script>

<?php */ ?>