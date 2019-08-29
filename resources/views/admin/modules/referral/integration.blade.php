<style type="text/css">
    .tab_list{ margin:0px; padding:0px;}
    .tab_list li {
        list-style: none;
        width: 50%;
        float: left;
    }

    .tooltip_table {
        position: relative; cursor: pointer;
    }

    .tooltip_table .tooltiptext {
        display: none;
        width: 224px;
        background-color: #fff;
        color: #333;
        text-align: left;
        border-radius: 3px;
        padding: 10px 15px;
        position: absolute;
        z-index: 1;
        top: -33px;
        border: 1px solid #cccccc;
        left: 113px;
        -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .tooltiptext::before {
        content: "";
        position: absolute;
        top: 40px;
        left: -9px;
        border-style: solid;
        border-width: 6px 6px 0;
        border-color: #ccc transparent;
        display: block;
        width: 0;
        z-index: 0;
        transform: rotate(90deg);
    }

    .tooltiptext::after {
        content: "";
        position: absolute;
        top: 40px;
        left: -7px;
        border-style: solid;
        border-width: 5px 5px 0;
        border-color: #FFFFFF transparent;
        display: block;
        width: 0;
        z-index: 1;
        transform: rotate(90deg);
    }

    .tooltip_table .tooltiptext strong {
        text-transform: uppercase;
        margin-bottom: 10px;
        display: block;
    }

    .tooltip_table:hover .tooltiptext {
        display: block;
    }
    
    .tab-pane p{ font-size: 16px;}
    
    .highlighted { color:#008000;font-size:15px !important;}
    
</style>

<!-- Content area -->
<div class="content">
    <!-- Dashboard content -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-lg-12">
                            <h6 class="panel-title">Referral Module Integrations</h6>
                            
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="tab-pane" id="post_purchase_tab">

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
                        <input type="checkbox" id="showPopupAfterSale"> Display Referral popup after successful purchase?
                        </p>
                        <div class="clearfix"></div>
                        <br>
                        <p>
                        <textarea cols="100%" rows="15" name="txtPostPurchase" id="txtPostPurchase">
<div id="bb-invoice_details" 
    data-bb-firstname="Alen"
    data-bb-lastname="Sultanic"
    data-bb-email="umair.products@gmail.com"
    data-bb-invoice-id="12345"
    data-bb-amount="10"
    data-bb-currency="USD"
    data-bb-timestamp="<?php echo time();?>"
    ></div>
<script type="text/javascript" id="bbscriptloader" data-key="{{ $oSettings->hashcode }}" data-widgets="referral-sale" async="true" src="{{ base_url() }}assets/js/ref_widgets.js"></script>
                        </textarea>
                        </p>
                        <div class="clearfix"></div>
                        <button type="button" id="btnPostPurchase" class="btn bl_cust_btn pull-right">Copy <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <textarea id="dummyPostSaleCodeWithPopup" style="display:none;"><div id="bb-invoice_details" 
    data-bb-firstname="Alen"
    data-bb-lastname="Sultanic"
    data-bb-email="umair.products@gmail.com"
    data-bb-invoice-id="12345"
    data-bb-amount="10"
    data-bb-currency="USD"
    data-bb-timestamp="<?php echo time();?>"
    data-bb-showwidget="true"
    ></div>
<script type="text/javascript" id="bbscriptloader" data-key="{{ $oSettings->hashcode }}" data-widgets="referral-sale" async="true" src="{{ base_url() }}assets/js/ref_widgets.js"></script></textarea>>


<textarea id="dummyPostSaleCodeWithoutPopup" style="display:none;"><div id="bb-invoice_details" 
    data-bb-firstname="Alen"
    data-bb-lastname="Sultanic"
    data-bb-email="umair.products@gmail.com"
    data-bb-invoice-id="12345"
    data-bb-amount="10"
    data-bb-currency="USD"
    data-bb-timestamp="<?php echo time();?>"
    ></div>
<script type="text/javascript" id="bbscriptloader" data-key="{{ $oSettings->hashcode }}" data-widgets="referral-sale" async="true" src="{{ base_url() }}assets/js/ref_widgets.js"></script></textarea>

    <!-- /dashboard content -->

</div>
<!-- /content area -->
<script>
    $(document).ready(function () {
        $("#btnPostPurchase").click(function () {
            var copyText = $("#txtPostPurchase").val();

            /* Select the text field */
            $("#txtPostPurchase").select();

            /* Copy the text inside the text field */
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