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
</style>

<script type="text/javascript" src="{{ base_url() }}assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="{{ base_url() }}assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="{{ base_url() }}assets/js/pages/datatables_sorting_date.js"></script>

<!-- Content area -->
<div class="content">
    <!-- Dashboard content -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-lg-12">
                            <h6 class="panel-title">Brandboost Widgets</h6>
                            <div class="heading-elements">
                                <button type="button" class="btn btn-link daterange-ranges heading-btn text-semibold">
                                    <i class="icon-calendar3 position-left"></i> <span></span> <b class="caret"></b>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="tabbable">
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li class="active"><a href="#referral_tab" data-toggle="tab"><i class="fa fa-envelope position-left"></i> Referral</a></li>
                            <li><a href="#post_purchase_tab" data-toggle="tab"><i class="fa fa-comments position-left"></i> Post Purchase</a></li></li>
                            <li><a href="#embedded_tab" data-toggle="tab"><i class="fa fa-comments position-left"></i> Embedded Signup </a></li></li>
                        </ul>
                        <div class="tab-content"> 
                            <!--########################TAB 1 ##########################-->
                            <div class="tab-pane active" id="referral_tab">
                                <p>A small widget that sits on your store page allowing customers to instantly sign-up as an advocate:</p>

                                <textarea cols="100%" rows="4" name="txtReferral" id="txtReferral">
<script type="text/javascript" id="bbscriptloader" data-key="{{ $oSettings->hashcode }}" data-widgets="referral" async="true" src="{{ site_url() }}assets/js/ref_widgets.js">
</script></textarea>
                                <div class="clearfix"></div>
                                <button type="button" id="btnReferral" class="btn bl_cust_btn pull-right">Copy <i class="icon-arrow-right14 position-right"></i></button>
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
<script type="text/javascript" id="bbscriptloader" data-key="{{ $oSettings->hashcode }}" data-widgets="referral-sale" async="true" src="{{ site_url() }}assets/js/ref_widgets.js"></script>
</textarea>
                                <div class="clearfix"></div>
                                <button type="button" id="btnPostPurchase" class="btn bl_cust_btn pull-right">Copy <i class="icon-arrow-right14 position-right"></i></button>
                            </div>

                            <!--########################TAB 3 ##########################-->
                            <div class="tab-pane" id="embedded_tab">
                                <p>Embed your sign-up page into your store, so your customers can sign up as they're browsing:</p>

                                <textarea cols="100%" rows="4" name="txtEmbed" id="txtEmbed">
<script type="text/javascript" id="bbscriptloader" data-key="{{ $oSettings->hashcode }}" data-widgets="referral-embed" async="true" src="{{ site_url() }}assets/js/ref_widgets.js">
</script></textarea>
                                <div class="clearfix"></div>
                                <button type="button" id="btnEmbed" class="btn bl_cust_btn pull-right">Copy <i class="icon-arrow-right14 position-right"></i></button>

                            </div>

                            <!--########################TAB end ##########################--> 
                        </div>
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
    data-bb-timestamp="123456789"
    data-bb-showwidget="true"
    ></div>
<script type="text/javascript" id="bbscriptloader" data-key="{{ $oSettings->hashcode }}" data-widgets="referral-sale" async="true" src="{{ site_url() }}assets/js/ref_widgets.js"></script></textarea>


<textarea id="dummyPostSaleCodeWithoutPopup" style="display:none;"><div id="bb-invoice_details" 
    data-bb-firstname="Alen"
    data-bb-lastname="Sultanic"
    data-bb-email="umair.products@gmail.com"
    data-bb-invoice-id="12345"
    data-bb-amount="10"
    data-bb-currency="USD"
    data-bb-timestamp="123456789"
    ></div>
<script type="text/javascript" id="bbscriptloader" data-key="{{ $oSettings->hashcode }}" data-widgets="referral-sale" async="true" src="{{ site_url() }}assets/js/ref_widgets.js"></script></textarea>

    <!-- /dashboard content -->

</div>
<!-- /content area -->
<script>
    $(document).ready(function () {

        $("#btnReferral").click(function () {
            var copyText = $("#txtReferral").val();

            /* Select the text field */
            $("#txtReferral").select();

            /* Copy the text inside the text field */
            document.execCommand("copy");
        });

        $("#btnPostPurchase").click(function () {
            var copyText = $("#txtPostPurchase").val();

            /* Select the text field */
            $("#txtPostPurchase").select();

            /* Copy the text inside the text field */
            document.execCommand("copy");
        });
        
        
        $("#btnEmbed").click(function () {
            var copyText = $("#txtEmbed").val();

            /* Select the text field */
            $("#txtEmbed").select();

            /* Copy the text inside the text field */
            document.execCommand("copy");
        });
        
        
        $("#showPopupAfterSale").change(function(){
            if($(this).is(":checked")){
                var codeContent = $("#dummyPostSaleCodeWithPopup").val();
                
            }else{
                var codeContent = $("#dummyPostSaleCodeWithoutPopup").val();
                
            }
            
            $("#txtPostPurchase").val('');
            $("#txtPostPurchase").val(codeContent);
            
        });
    });
</script>