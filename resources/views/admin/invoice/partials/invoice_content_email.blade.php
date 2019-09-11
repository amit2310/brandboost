<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Brandboost Invoice</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
          rel="stylesheet">
</head>


<style>
    body {
        font-family: 'Roboto', sans-serif;
    }

</style>

<body>

<div style="max-width: 700px; width: 100%; margin: 0 auto;">
    <div class="top_head"
         style="background-image: linear-gradient(264deg, #2eb4dd, #2779dc);box-shadow: 0 3px 2px 0 rgba(0, 53, 193, 0.01), 0 1px 1px 0 rgba(0, 19, 151, 0.05) !important;height: auto !important;border-radius: 5px 5px 0 0 !important;padding: 30px !important; ">
        <h5 style="font-size: 16px;font-weight: 500;color: #fff;line-height: 1.5384616; margin: 0;">Invoice
            #{{ $userdata[0]->local_invoice_id }}</h5>

    </div><!---header--->

    <div class="" style="padding: 20px; width: 100%;box-sizing: border-box;">
        <div class="" style="margin-left: -10px;margin-right: -10px;">
            <div class="left"
                 style="width: 50%;margin-bottom:20px;padding-right: 30px;box-sizing: border-box; float: left">
                <a class="" href="{{ base_url() }}" style="padding: 18px 20px 7px 24px;height: 56px; float: left;"><img
                        src="{{ base_url() }}assets/images/brand_boost_logo.png" alt=""></a>
                <ul class="list-condensed list-unstyled" style="list-style: none;">
                    <li style="margin-top: 3px;">2269 Elba Lane</li>
                    <li style="margin-top: 3px;">Paris, France</li>
                    <li style="margin-top: 3px;">888-555-2311</li>
                </ul>
            </div><!---left--->

            <div class="left"
                 style="width: 50%;margin-bottom:20px;padding-right: 30px;box-sizing: border-box; float: left; text-align: right;">
                <h5 class="" style="font-weight: 400 !important;font-size: 17px; margin: 10px 0;">Invoice
                    #{{ $userdata[0]->local_invoice_id }}</h5>
                <p>Date: <span class="text-semibold">{{ date("M, d Y", strtotime($userdata[0]->invoice_date)) }}</span>
                </p>
                @if (!empty($userdata[0]->next_billing_at))
                    <p>Next Payment Date: <span
                            class="text-semibold">{{ date("M, d Y", $userdata[0]->next_billing_at) }}</span></p>
                @endif
            </div>


        </div>
    </div>
    <div style="clear: both"></div>


    <div class=""
         style="padding: 20px; width: 100%;box-sizing: border-box; border-bottom: 1px solid #c6c8d5; float: left;">
        <div class="" style="margin-left: -10px;margin-right: -10px;">
            <div class="left"
                 style="width: 50%;margin-bottom:20px;padding-right: 30px;box-sizing: border-box; float: left">
                <span class="" style="font-size: 13px !important; color: #5e5e7c !important">Invoice To:</span>
                <ul class="list-condensed list-unstyled" style="list-style: none; padding: 0">
                    <li style="margin-top: 3px;"><h5
                            style="margin: 10px 0;">{{ $userdata[0]->firstname . ' ' . $userdata[0]->lastname }}</h5>
                    </li>
                    <li style="margin-top: 3px;"><a href="mailto:"
                                                    style="text-decoration:none; color:#1E88E5">{{ $userdata[0]->email }}</a>
                    </li>
                </ul>
            </div><!---left--->

            <div class="left"
                 style="width: 50%;margin-bottom:20px;padding-right: 30px;box-sizing: border-box; float: left; text-align: right;">
                <span class="" style="font-size: 13px !important; color: #5e5e7c !important">Payment Details:</span>
                <h5 class="" style="font-weight: 400 !important;font-size: 17px; margin: 10px 0;">Total Paid: <span
                        class="text-right text-semibold">${{ number_format($userdata[0]->amount_paid * 0.01, 2) }}</span>
                </h5>
                <p style="font-size: 13px;">Txn ID: <br><span class="text-semibold">{{ $userdata[0]->txn_id }}</span>
                </p>
                @if (!empty($userdata[0]->subscription_id))
                    <p style="font-size: 13px;">Subscription ID: <br><span
                            class="text-semibold">{{ $userdata[0]->subscription_id }}</span></p>
                @endif
            </div>


        </div>
    </div>


    <div class=""
         style="padding: 10px 20px; width: 100%;box-sizing: border-box; border-bottom: 1px solid #c6c8d5; float: left;">
        <div class="" style="margin-left: -10px;margin-right: -10px;">
            <div class="left"
                 style="width: 50%;margin-bottom:0px;padding-right: 30px;box-sizing: border-box; float: left">
                <p style="margin: 0; padding: 0;font-size: 12px !important;color: #6d788e;">Description</p>
            </div><!---left--->

            <div class="left"
                 style="width: 15%;margin-bottom:0px;padding-right: 30px;box-sizing: border-box; float: left">
                &nbsp;
                @if (!empty($userdata[0]->subscription_id))
                    <p style="margin: 0; padding: 0;font-size: 12px !important;color: #6d788e;">Date From</p>
                @endif
            </div>
            <div class="left"
                 style="width: 15%;margin-bottom:0px;padding-right: 30px;box-sizing: border-box; float: left">
                &nbsp;
                @if (!empty($userdata[0]->subscription_id))
                    <p style="margin: 0; padding: 0;font-size: 12px !important;color: #6d788e;">Date To</p>
                @endif
            </div>


            <div class="left"
                 style="width: 20%;margin-bottom:0px;padding-right: 30px;box-sizing: border-box; float: left; text-align: right;">
                <span class="" style="font-size: 13px !important; color: #5e5e7c !important; margin: 0; padding: 0">Total</span>

            </div>


        </div>
    </div>
    <div style="clear: both"></div>
    @if (!empty($userdata))
        @foreach ($userdata as $oItem)
            <div class="" style="padding: 10px 20px; width: 100%;box-sizing: border-box; float: left;">
                <div class="" style="margin-left: -10px;margin-right: -10px;">
                    <div class="left"
                         style="width: 50%;margin-bottom:0px;padding-right: 30px;box-sizing: border-box; float: left">
                        <p style="margin: 0; padding: 0;color: #6d788e;font-size: 15px;">{{ $oItem->description }}</p>
                        <p style="margin: 0; padding: 0;color:#5e5e7c !important;font-size: 14px; color: #">{{ ucwords($oItem->entity_type) }}</p>
                    </div><!---left--->

                    <div class="left"
                         style="width: 15%;margin-bottom:0px;padding-right: 30px;box-sizing: border-box; float: left">
                        &nbsp;
                        @if (!empty($userdata[0]->subscription_id))
                            <p style="margin: 0; padding: 0;color: #6d788e;font-size: 15px;">{{ date("M d, Y", $oItem->date_from) }}</p>
                        @endif
                    </div>

                    <div class="left"
                         style="width: 15%;margin-bottom:0px;padding-right: 30px;box-sizing: border-box; float: left">
                        &nbsp;
                        @if (!empty($userdata[0]->subscription_id))
                            <p style="margin: 0; padding: 0;color: #6d788e;font-size: 15px;">{{ date("M d, Y", $oItem->date_to) }}</p>
                        @endif
                    </div>

                    <div class="left"
                         style="width: 20%;margin-bottom:0px;padding-right: 30px;box-sizing: border-box; float: left; text-align: right;">
                        <span class=""
                              style="font-size: 14px !important; color: #303a52  !important; margin: 0; padding: 0;font-weight: 500 !important;">${{ number_format($oItem->amount * 0.01, 2) }}</span>

                    </div>


                </div>
            </div>
        @endforeach
    @endif


    <div style="clear: both"></div>
    <div class="" style="padding:20px; width: 100%;box-sizing: border-box;float: left;">
        <div class="" style="margin-left: -10px;margin-right: -10px;">
            <div class="left"
                 style="width: 60%;margin-bottom:0px;padding-right: 30px;box-sizing: border-box; float: left">
                <h6 style="margin: 10px 0;font-size: 15px;font-weight: 400;">Authorized person</h6>
                <div style="margin: 15px 0;">
                    <img src="{{ base_url() }}assets/images/signature.png" class="display-block" style="width: 150px;"
                         alt="">
                </div>
                <ul class="" style="font-size: 13px; font-weight: 400; list-style: none; margin: 0; padding: 0">
                    <li style="margin-top: 3px; color: #5e5e7c !important">Eugene Kopyov</li>
                    <li style="margin-top: 3px;color: #5e5e7c !important">2269 Elba Lane</li>
                    <li style="margin-top: 3px;color: #5e5e7c !important">Paris, France</li>
                    <li style="margin-top: 3px;color: #5e5e7c !important">888-555-2311</li>
                </ul>
            </div><!---left--->

            <div class="left"
                 style="width: 40%;margin-bottom:0px;padding-right: 30px;box-sizing: border-box; float: left; text-align: right;">
                <h6 style="margin: 10px 0;font-size: 15px; font-weight: 400; text-align: left;">Total Paid</h6>
                <p style="padding: 20px 0px 15px; font-size: 13px; text-align: left"><span
                        style="border-bottom: 1px solid #ddd; padding: 12px 20px 20px;">Subtotal:</span><span
                        style="float: right">${{ number_format($oItem->amount * 0.01, 2) }}</span></p>
                <p style="padding: 20px 0px 15px; font-size: 13px; text-align: left"><span
                        style="border-bottom: 1px solid #ddd; padding: 12px 20px 20px;">Tax: (0%)</span><span
                        style="float: right">$0.00</span></p>

                <p style="padding: 20px 0px 15px; font-size: 13px; text-align: left"><span style="padding: 12px 20px;">Total</span><span
                        style="float: right; font-size: 17px; color: #2196F3 ">${{ number_format($oItem->amount * 0.01, 2) }}</span>
                </p>
                @if ($display_type == 'popup')
                    <a style="cursor:pointer;padding-left: 48px;color: #fff;background-color: #2196F3;text-align: center;border-color: #2196F3;padding: 10px 12px; font-size: 13px;border-radius: 3px;position: relative;width: 100%;display: block; margin-bottom: 10px;"
                       class="send_email"><b
                            style="padding: 10px; background: #1c80cf; position: absolute; left: 0; top: 0;border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i><img
                                    src="{{ base_url() }}assets/images/msg.png"></i></b>Email</a>
                    <a href="{{ base_url('admin/invoices/download_invoice/' . $invoiceID) }}"
                       style="cursor:pointer;padding-left: 48px;color: #fff;background-color: #2196F3;text-align: center;border-color: #2196F3;padding: 10px 12px; font-size: 13px;border-radius: 3px;position: relative;width: 100%;display: block; margin-bottom: 10px;"
                       class=""><b
                            style="padding: 10px; background: #1c80cf; position: absolute; left: 0; top: 0;border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i><img
                                    src="{{ base_url() }}assets/images/download.png"></i></b>Download</a>
                    <a style="cursor:pointer;padding-left: 48px;color: #fff;background-color: #2196F3;text-align: center;border-color: #2196F3;padding: 10px 12px; font-size: 13px;border-radius: 3px;position: relative;width: 100%;display: block;"
                       class=""><b
                            style="padding: 10px; background: #1c80cf; position: absolute; left: 0; top: 0;border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i><img
                                    src="{{ base_url() }}assets/images/print.png"></i></b>Print</a>
                @endif
            </div><!---left--->

            <div class="left"
                 style="width: 20%;margin-bottom:0px;padding-right: 30px;box-sizing: border-box; float: left; text-align: right;">
                <span class=""
                      style="font-size: 13px !important; color: #5e5e7c !important; margin: 0; padding: 0"></span>

            </div>


        </div>
    </div>
    <div style="clear: both"></div>
    <div class=""
         style="padding:0px 20px 20px; width: 100%;box-sizing: border-box; border-bottom: 1px solid #c6c8d5; float: left;">
        <div class="" style="margin-left: -10px;margin-right: -10px;">
            <h6 style="font-size: 15px; font-weight: 400; margin: 0;">Other information</h6>
            <p style="color: #5e5e7c !important; font-size: 13px; font-weight: 400;line-height: 1.5384616;">Thank you
                for using Limitless. This invoice can be paid via PayPal, Bank transfer, Skrill or Payoneer. Payment is
                due within 30 days from the date of delivery. Late payment is possible, but with with a fee of 10% per
                month. Company registered in England and Wales #6893003, registered office: 3 Goodman Street, London E1
                8BF, United Kingdom. Phone number: 888-555-2311</p>
        </div>
    </div>
    <div style="clear: both"></div>

    <div class="" style="padding:0px 20px 20px; width: 100%;box-sizing: border-box;float: left;">
        <div class="" style="margin-left: -10px;margin-right: -10px;">
            <a href=""
               style="color: #333;background-color: #fcfcfc;border-color: #ddd;padding: 7px 12px;font-size: 13px; border: 1px solid #ccc; float: right; text-decoration: none; border-radius: 4px; margin-top: 20px;">Close</a>
        </div>
    </div>


    <div style="clear: both;"></div>
</div>


</body>
</html>
