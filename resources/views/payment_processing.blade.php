@extends('layouts.front_template') 

@section('contents')
<?php
if ($haveData == 'yes') {
    //pre(Session::get('orderFormData'));
} else {
    die("Not Authorized to access this page");
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <br><br>
            <h2>Please Wait, We are processing your payment!</h2>
            <img src="/assets/images/processing.gif">

        </div>
        <div class="clearfix"></div>
        <br><br><br><br><br><br><br><br>


    </div>


</div>
<script>
    function intiatePayment() {
        $.ajax({
            url: "<?php echo base_url('/payment/cbCharge'); ?>",
            type: "POST",
            data: {_token: '{{csrf_token()}}', action: 'charge'},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    window.location.href = "<?php echo base_url('/thankyou'); ?>";
                } else if (data.status == 'error') {
                    var declinePath = "<?php echo base_url('/checkout/buy/decline'); ?>";
                    var errMsg = data.msg;
                    window.location.href = declinePath + '?msg=' + errMsg;

                }
            }
        });
    }
    $('document').ready(function () {
        intiatePayment();

    });
</script>
@endsection


