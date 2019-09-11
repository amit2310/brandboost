<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h5 class="modal-title">Invoice #{{ $userdata[0]->local_invoice_id }}</h5>
</div>

@include("admin.invoice.partials.invoice_content", array('display_type' => 'popup'))


<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>


<script type="text/javascript">
    $(document).ready(function () {

        $(".send_email").on('click', function () {

            $('.overlaynew').show();
            var invoiceid = "{{ $invoiceID }}";
            $.ajax({
                url: "{{ base_url('admin/invoices/email_invoice') }}",
                type: "POST",
                data: {invoice_id: invoiceid},
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {

                        alertMessageAndRedirect('Email send successfuly.', window.location.href);

                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });
    });
</script>
