<div id="addUserCredit" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="frmAddUserCredit" class="form-horizontal" id="frmAddUserCredit">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Add User Credits</h5>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-lg-3">Add Manual Credits to: </label>
                        <div class="col-lg-9">
                            <p>
                                <strong>
                                    <span id="lblFullName"></span><br>
                                    <span id="lblEmail"></span><br>
                                    <span id="lblPhone"></span>
                                </strong>
                            </p>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-lg-3">Credits</label>
                        <div class="col-lg-9">
                            <input name="credits" id="email_credits" class="form-control" type="number">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-lg-3">Contact Limit</label>
                        <div class="col-lg-9">
                            <input name="contact_limit" id="contact_limit" class="form-control" type="number">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-lg-3">Notes</label>
                        <div class="col-lg-9">
                            <textarea name="credit_notes" id="credit_notes" class="form-control" rows="6"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Secret Code</label>
                        <div class="col-lg-9">
                            <input name="secret_key" id="secret_key" class="form-control" required="required">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="creditor_user_id" id="creditor_user_id">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" id="btnAddUserCredits" class="btn btn-primary"><i class="icon-check"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#frmAddUserCredit').on('submit', function (e) {
            $("#btnAddUserCredits").attr('disabled', 'disabled');
            var formdata = $("#frmAddUserCredit").serialize();
            $.ajax({
                url: "{{ base_url('admin/transactions/addManualCredits') }}",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        alert(data.msg);
                        window.location.href = '';
                    } else {
                        alert('Error: ' + data.msg);
                        $("#btnAddUserCredits").removeAttr('disabled');
                    }
                }
            });
            return false;
        });


        $(document).on('click', '.addManualCredit', function () {
            var userid = $(this).attr('id');
            $.ajax({
                url: "{{ base_url('admin/users/getUserInfo') }}",
                type: "POST",
                data: {uid: userid,_token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#lblFullName").html(data.datarow.firstname + ' ' + data.datarow.lastname);
                        $("#lblEmail").html(data.datarow.email);
                        $("#lblPhone").html(data.datarow.mobile);
                        $("#creditor_user_id").val(userid);
                        $("#addUserCredit").modal();
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });
    });
</script>