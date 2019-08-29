@php
list($canRead, $canWrite) = fetchPermissions('Onsite Campaign');
@endphp

<!-- Dashboard content -->
<div class="row">
    <div class="col-md-12">
        <div style="margin: 0;" class="panel panel-flat">
            <div class="panel-heading"> <span class="pull-left">
                    <h6 class="panel-title">{{ count($subscribersData) }} Contacts</h6>
                </span>
                <div class="heading-elements">
                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                        <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                        <div class="form-control-feedback"> <i class="icon-search4"></i> </div>
                    </div>
                </div>
            </div>

            <div class="panel-body p0">
                <table class="table datatable-basic datatable-sorting">
                    <thead>
                        <tr>
                            <th style="display: none;"></th>
                            <th style="display: none;"></th>
                            <th style="display: none;" class="nosort editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="control-primary" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
                            <th><i class="icon-user"></i> Name</th>
                            <th><i class="icon-iphone"></i> Phone</th>
                            <th><i class="icon-calendar"></i> Created</th>
                            <th><i class="icon-hash"></i> Source</th>
                            <th><i class="icon-atom"></i> Social</th>
                            <th><i class="icon-price-tag2"></i> Tags</th>
                            <th class="text-center"><i class="fa fa-dot-circle-o"></i> Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subscribersData as $oContact) 
                            <tr id="append-{{ $oContact->id }}" class="selectedClass">
                                <td style="display: none;">{{ date('m/d/Y', strtotime($oContact->created)) }}</td>
                                <td style="display: none;">{{ $oContact->id }}</td>
                                <td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" value="{{ $oContact->id }}" id="chk{{ $oContact->id }}"><span class="custmo_checkmark"></span></label></td>
                                <td>
                                    <div class="media-left media-middle"> <a href="#"><img src="{{ base_url() }}assets/images/userp.png" class="img-circle img-xs" alt=""></a> </div>
                                    <div class="media-left">
                                        <div class="pt-5"><a href="{{ base_url() }}admin/subscriber/activities/{{ $oContact->id }}" target="_blank" class="text-default text-semibold"><span>{{ $oContact->firstname }} {{ $oContact->lastname }}</span> <img class="flags" src="{{ base_url() }}assets/images/flags/us.png"/></a></div>
                                        <div class="text-muted text-size-small">{{ $oContact->email }}</div>

                                    </div>
                                </td>

                                <td>
                                    <div class="media-left">
                                        <div class="pt-5"><a href="#" class="text-default text-semibold">{{ ($oContact->mobile == '') ? '<span style="color:#999999">Phone Unavailable</span>' : $oContact->mobile }}</a></div>
                                        <div class="text-muted text-size-small">Chat</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="media-left">
                                        <div class="pt-5"><a href="#" class="text-default text-semibold">{{ date('d M Y', strtotime($oContact->created)) }}</a></div>
                                        <div class="text-muted text-size-small">{{ date('h:i A', strtotime($oContact->created)) }}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="media-left media-middle"> <a class="icons" href="#"><i class="icon-envelop txt_blue"></i></a> </div>
                                    <div class="media-left">
                                        <div class="pt-5"><a href="#" class="text-default text-semibold">Email</a></div>
                                        <div class="text-muted text-size-small">Form #183</div>
                                    </div>	
                                </td>
                                <td>
                                    <a href="{{ $oContact->socialProfile }}" target="_blank"><button class="btn btn-xs btn_white_table"><i class="icon-twitter txt_lblue"></i></button></a>
                                    <a href="{{ $oContact->socialProfile }}" target="_blank"><button class="btn btn-xs btn_white_table"><i class="icon-facebook txt_dblue"></i></button></a>
                                    <a href="{{ $oContact->socialProfile }}" target="_blank"><button class="btn btn-xs btn_white_table"><i class="icon-phone2 txt_green"></i></button></a>
                                    <a href="{{ $oContact->socialProfile }}" target="_blank"><button class="btn btn-xs btn_white_table"><i class="icon-envelop txt_blue"></i></button></a>
                                </td>
                                <td>
                                    <div class="tdropdown">
                                        <button type="button" class="btn btn-xs btn_white_table dropdown-toggle " data-toggle="dropdown"><i class="icon-hash"></i> 4 Tags &nbsp; <span class="caret"></span></button>
                                        <ul class="dropdown-menu dropdown-menu-right width-200">
                                            <li><a href="#"><i class="icon-menu7"></i> Action</a>
                                            </li>
                                            <li><a href="#"><i class="icon-screen-full"></i> Another action</a>
                                            </li>
                                            <li><a href="#"><i class="icon-mail5"></i> One more action</a>
                                            </li>
                                            <li class="divider"></li>
                                            <li><a href="#"><i class="icon-gear"></i> Separated line</a> </li>
                                        </ul>
                                    </div>
                                    <button class="btn btn-xs btn_white_table"><i class="icon-plus3"></i></button>
                                </td>

                                <td class="text-center">
                                    <button class="btn btn-xs btn_white_table pr10">{{ ($oContact->status == 1) ? '<i class="icon-primitive-dot txt_green"></i> Active' : '<i class="icon-primitive-dot txt_red"></i> Inactive' }}</button>
                                </td>

                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">



    $(document).ready(function () {


        $('#checkSub-list').change(function () {

            if (false == $(this).prop("checked")) {

                $(".checkRows-list").prop('checked', false);
                $(".selectedClass-list").removeClass('success');
                $('.custom_action_box-list').hide();
            } else {

                $(".checkRows-list").prop('checked', true);
                $(".selectedClass-list").addClass('success');
                $('.custom_action_box-list').show();
            }

        });

        $(document).on('click', '.checkRows-list', function () {
            var inc = 0;


            var rowId = $(this).val();

            if (false == $(this).prop("checked")) {
                $('#append-sub-' + rowId).removeClass('success');
            } else {
                $('#append-sub-' + rowId).addClass('success');
            }

            $('.checkRows-list:checkbox:checked').each(function (i) {
                inc++;
            });
            if (inc == 0) {

                $('.custom_action_box-list').hide();
            } else {
                $('.custom_action_box-list').show();
            }

            var numberOfChecked = $('.checkRows-list:checkbox:checked').length;
            var totalCheckboxes = $('.checkRows-list:checkbox').length;
            if (totalCheckboxes > numberOfChecked) {
                $('.checkSub-list').prop('checked', false);
            }

        });

        $(document).on('click', '#deleteButtonBrandboostOnlineSub', function () {

            var val = [];
            $('.checkRows-list:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                var elem = $(this);
                swal({
                    title: "Are you sure? You want to delete this record!",
                    text: "You will not be able to recover this record!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#EF5350",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                        function (isConfirm) {
                            if (isConfirm) {
                                $('.overlaynew').show();
                                $.ajax({
                                    url: "{{ base_url('admin/brandboost/delete_multipal_subscriber') }}",
                                    type: "POST",
                                    data: {multiSubscriberId: val},
                                    dataType: "json",
                                    success: function (data) {
                                        if (data.status == 'success') {
                                            $('.overlaynew').hide();
                                            window.location.href = '';
                                        }
                                    }
                                });
                            }
                        });
            }

        });



        $("#addSubscriberData").submit(function (e) {

            e.preventDefault();
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: "{{ base_url('admin/brandboost/add_subscriber') }}",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = '';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }, error() {
                    $('.overlaynew').hide();
                }
            });
        });

        $("#addSubscriberDataForm, #addSubscriberDataPop").submit(function (e) {

            e.preventDefault();
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: "{{ base_url('admin/brandboost/add_subscriber') }}",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = '';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }, error() {
                    $('.overlaynew').hide();
                }
            });
        });

        $(document).on('click', '.editSubscriber', function () {
            var subscriberID = $(this).attr('subscriberid');
            $.ajax({
                url: "{{ base_url('admin/brandboost/getSubscriberById') }}",
                type: "POST",
                data: {subscriberID: subscriberID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        var subData = data.result[0];
                        $('#edit_firstname').val(subData.firstname);
                        $('#edit_lastname').val(subData.lastname);
                        $('#edit_email').val(subData.email);
                        $('#edit_phone').val(subData.phone);
                        $('#edit_subscriberID').val(subData.id);
                        $("#editSubscriberModal").modal();
                    }
                }
            });
        });

        $("#updateSubscriberData").submit(function (e) {

            e.preventDefault();
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: "{{ base_url('admin/brandboost/update_subscriber') }}",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = '';
                    } else {

                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });

        $("#updateSubscriberDataPop").submit(function (e) {

            e.preventDefault();
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: "{{ base_url('admin/brandboost/update_subscriber') }}",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = '';
                    } else {

                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });

        $(document).on('click', '.deleteSubscriber', function () {
            var subscriberID = $(this).attr('subscriberid');
            swal({
                title: "Are you sure? You want to delete this record!",
                text: "You will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel pls!",
                closeOnConfirm: true,
                closeOnCancel: true
            },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url: "{{ base_url('admin/brandboost/delete_subscriber') }}",
                                type: "POST",
                                data: {subscriberId: subscriberID},
                                dataType: "json",
                                success: function (data) {
                                    if (data.status == 'success') {
                                        window.location.href = '';
                                    } else {

                                        alertMessage('Error: Some thing wrong!');
                                        $('.overlaynew').hide();
                                    }
                                }
                            });
                        } else {
                            $('.overlaynew').hide();
                        }
                    });

        });

        $(document).on('click', '.unSubscribeUAC', function () {
            $('.overlaynew').show();
            var subscriberEmail = $(this).attr('subscriberemail');
            var subscriberid = $(this).attr('subscriberid');

            $.ajax({
                url: "{{ base_url('admin/brandboost/unsubscriber_user') }}",
                type: "POST",
                data: {subscriber_email: subscriberEmail, subscriberid: subscriberid},
                dataType: "json",
                success: function (data) {
                    $('.overlaynew').hide();
                    if (data.status == 'success') {
                        window.location.href = '';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        });

        $(document).on('click', '.chg_status', function () {

            $('.overlaynew').show();
            var status = $(this).attr('change_status');
            var subscriberId = $(this).attr('subscriberId');

            $.ajax({
                url: "{{ base_url('admin/brandboost/update_subscriber_status') }}",
                type: "POST",
                data: {status: status, subscriber_id: subscriberId},
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {
                        window.location.href = '';
                    } else {

                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });
    });
</script>

