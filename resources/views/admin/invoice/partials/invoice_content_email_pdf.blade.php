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
						<b>Invoice #{{ $userdata[0]->local_invoice_id }}</b><br>
						Date: {{ date("M, d Y", strtotime($userdata[0]->invoice_date)) }}
                        @if (!empty($userdata[0]->next_billing_at))
                            <p>Next Payment Date: <span
                                    class="text-semibold">{{ date("M, d Y", $userdata[0]->next_billing_at) }}</span></p>
                        @endif
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
<table width="100%" cellpadding="10">
    <tr>
        <td width="50%" style="text-align: left; ">
					<span style="font-size: 12px;">
						<strong>Invoice To:</strong><br><br>
						{{ $userdata[0]->firstname . ' ' . $userdata[0]->lastname }}<br>
						<a href="#">{{ $userdata[0]->email }}</a>
					</span>
        </td>
        <td width="50%" style="text-align: right;">
            <div style="font-size: 12px; line-height:40px;">
                <strong>Payment Details1:</strong><br>
                <br>
                <div style="padding-bottom:15px;">Total Paid:
                    ${{ number_format($userdata[0]->amount_paid * 0.01, 2) }}</div>
                <div style="padding-bottom:15px;">Transaction ID: {{ $userdata[0]->txn_id }}</div>
                @if (!empty($userdata[0]->subscription_id))
                    <div>Subscription ID: {{ $userdata[0]->subscription_id }}</div>
                @endif
            </div>
        </td>
    </tr>
</table>
<br>
<br>
<table width="100%" cellspacing="10" border="1">
    <thead>
    <tr>
        <td style="padding:5px;">
            <p>Description</p>
        </td>

        <td style="padding:5px;">
            @if (!empty($userdata[0]->subscription_id))
                <p>Date From</p>
            @endif
        </td>

        <td style="padding:5px;">
            @if (!empty($userdata[0]->subscription_id))
                <p>Date To</p>
            @endif
        </td>

        <td style="padding:5px;">
            <span>Total</span>
        </td>

    </tr>
    </thead>
    <tbody>
    @if (!empty($userdata))
        @foreach ($userdata as $oItem)
            <tr>
                <td style="padding:5px;">
                    <p>{{ $oItem->description }}</p>
                    <p></p>
                </td>

                <td style="padding:5px;">
                    @if (!empty($userdata[0]->subscription_id))
                        <p>{{ date("M d, Y", $oItem->date_from) }}</p>
                    @endif
                </td>

                <td style="padding:5px;">
                    @if (!empty($userdata[0]->subscription_id))
                        <p>{{ date("M d, Y", $oItem->date_to) }}</p>
                    @endif
                </td>

                <td style="padding:5px;">
                    <span>${{ number_format($oItem->amount * 0.01, 2) }}</span>
                </td>
            </tr>

        @endforeach
    @endif
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
						<strong>Subtotal:</strong> 	${{ number_format($oItem->amount * 0.01, 2) }}<br>
						<strong>Tax:</strong> (0%) 	$0.00<br>
						<strong>Total:</strong> ${{ number_format($oItem->amount * 0.01, 2) }}
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
