<script>
    function displayMessagePopup(msgType = '', msgHeading = '', msgDescription = '') {
        var msgBoxId = 'success_notice';
        if (msgHeading != '') {
            $('.notification_success_msg_heading').text(msgHeading);
        }

        if (msgDescription != '') {
            $('.notification_success_msg_des').text(msgDescription);
        }

        if (msgType == 'success') {
            msgBoxId = 'success_notice';
        } else if (msgType == 'error') {
            msgBoxId = 'error_notice';
        }

        var notice = new PNotify({
            text: $('#' + msgBoxId).html(),
            width: '377px',
            hide: true,
            buttons: {
                closer: false,
                sticker: false
            },
            insert_brs: false
        });
        notice.get().find('a[name=cancel]').on('click', function () {
            notice.remove();
        });
        setTimeout(function () {
            notice.remove();
        }, 3500);
    }

    function deleteConfirmationPopup(message, yesCallback) {

        $('#changeDeleteText').html('This item will deleted immediately.<br>You can\'t undo this action.');
        $('#Deletepopup').modal();
        $('.deletebuttonShow').html('<button id="deleteConfirm" type="button" class="btn dark_btn bkg_sblue fsize14 h52"> Delete</button><button data-toggle="modal" id="deleteCancle" type="button" class="btn btn-link fsize14 txt_blue h52">Cancel</button>');
        $('#deleteConfirm').on('click', function (event) {

            yesCallback();
            $(this).remove();
            $('#Deletepopup').modal('hide');
            return false;
        });
        $(document).on('click', '#deleteCancle', function (event) {
            $('#Deletepopup').modal('hide');
            return false;
        });

        return false;
    }

    function archiveConfirmationPopup(message, yesCallback) {

        $('#changeArchiveText').html(message);
        $('#archiveModalPopup').modal();
        $('#archivebuttonShow').html('<div class="col-xs-6"><button data-dismiss="modal" id="archiveCancle" type="button" class="btn dark_btn h52 w100 ml0">Cancel</button></div><div class="col-xs-6"><button data-toggle="modal" id="archiveConfirm" type="button" class="btn white_btn h52 w100 ml0">Archive</button></div>');
        $(document).on('click', '#archiveConfirm', function (event) {
            //event.stopImmediatePropagation();
            yesCallback();
            $(this).remove();
            $('#archiveModalPopup').modal('hide');
            return false;
        });

        return false;
    }



    $(document).ready(function () {
        $('.txtShowDiv').focus(function () {
            $('.sampleDiv').fadeIn(500);
        }).focusout(function () {
            $('.sampleDiv').fadeOut(500);
        });
    });

    $(document).on("click", ".addModuleContact", function () {
        var moduleaccountid = $(this).attr('data-moduleaccountid');
        var modulename = $(this).attr('data-modulename');
        $("#module_account_id").val(moduleaccountid);
        $("#active_module_name").val(modulename);
        $("#Addnewcontact").modal();

    });

    $(document).on("click", ".importModuleContact", function () {
        var moduleaccountid = $(this).attr('data-moduleaccountid');
        var modulename = $(this).attr('data-modulename');
        var redirectURL = $(this).attr('data-redirect');
        $("#import_module_account_id").val(moduleaccountid);
        $("#import_active_module_name").val(modulename);
        $("#import_redirect_url").val(redirectURL);
        $("#importCentralCSV").modal();

    });

    $("#addCentralSubscriberData").submit(function (event) {
        event.preventDefault();
        $('.overlaynew').show();
        var formData = new FormData($(this)[0]);
        formData.append('_token', '{{csrf_token()}}');
        $.ajax({
            url: "{{ URL::asset('admin/subscriber/add_contact') }}",
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $("#addSubscriber").modal('hide');
                    syncContactSelectionSources();
                    //alertMessageAndRedirect('Subscriber has been add successfully.', window.location.href);
                    setTimeout(function () {
                        window.location.href = window.location.href;
                    }, 1500);

                } else {
                    alertMessage('Error: Some thing wrong!');
                    $('.overlaynew').hide();
                }
            }
        });
    });
    $(".changeModuleContactStatusDisabled").click(function () {
        alertMessage('This contact is master inactive');
    });

    $(document).on('click', '.editModuleSubscriber', function () {
        var module_subscriber_id = $(this).attr("data-modulesubscriberid");
        var module_name = $(this).attr("data-modulename");
        $.ajax({
            url: "{{ URL::asset('admin/subscriber/getSubscriberDetail') }}",
            type: "POST",
            data: {
                    module_name: module_name, 
                    module_subscriber_id: module_subscriber_id,
                    _token: "<?php echo csrf_token(); ?>"
                },
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    var subData = data.result[0];
                    $('#edit_firstname').val(subData.firstname);
                    $('#edit_lastname').val(subData.lastname);
                    $('#edit_email').val(subData.email);
                    $('#edit_phone').val(subData.phone);
                    $('#edit_gender').val(subData.gender);
                    $('#edit_countryCode').val(subData.country_code);
                    $('#edit_cityName').val(subData.cityName);
                    $('#edit_stateName').val(subData.stateName);
                    $('#edit_zipCode').val(subData.zipCode);
                    $('#edit_twitterProfile').val(subData.twitter_profile);
                    $('#edit_facebookProfile').val(subData.facebook_profile);
                    $('#edit_linkedinProfile').val(subData.linkedin_profile);
                    $('#edit_instagramProfile').val(subData.instagram_profile);
                    $('#edit_socialProfile').val(subData.socialProfile);
                    $('#edit_tags').val(subData.tagID);
                    $('#edit_module_name_sms').val(module_name);
                    $('#edit_module_subscriber_id_sms').val(module_subscriber_id);
                    $("#editCentralContact").modal();
                }
            }
        });
    });

    $(document).on('click', '.editModuleSubscriber_sms', function () {

        var module_subscriber_id = $(this).attr("data-modulesubscriberid");
        var module_name = $(this).attr("data-modulename");
        $.ajax({
            url: "{{ URL::asset('admin/subscriber/getSubscriberDetail') }}",
            type: "POST",
            data: {module_name: module_name, module_subscriber_id: module_subscriber_id, _token: "<?php echo csrf_token(); ?>"},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    var subData = data.result[0];
                    $('#edit_firstname_sms').val(subData.firstname);
                    $('#edit_lastname_sms').val(subData.lastname);
                    $('#edit_email_sms').val(subData.email);
                    $('#edit_phone_sms').val(subData.phone);
                    $('#edit_gender_sms').val(subData.gender);
                    $('#edit_countryCode_sms').val(subData.country_code);
                    $('#edit_cityName_sms').val(subData.cityName);
                    $('#edit_stateName_sms').val(subData.stateName);
                    $('#edit_zipCode_sms').val(subData.zipCode);
                    $('#edit_twitterProfile_sms').val(subData.twitter_profile);
                    $('#edit_facebookProfile_sms').val(subData.facebook_profile);
                    $('#edit_linkedinProfile_sms').val(subData.linkedin_profile);
                    $('#edit_instagramProfile_sms').val(subData.instagram_profile);
                    $('#edit_socialProfile_sms').val(subData.socialProfile);
                    $('#edit_tags_sms').val(subData.tagID);
                    $('#edit_module_name_sms').val(module_name);
                    $('#edit_module_subscriber_id_sms').val(module_subscriber_id);
                    $("#editCentralContact_sms").modal('show');
                }
            }
        });
    });

    //main web chat
    $(document).on('click', '.editModuleSubscriber_main_web', function () {

        var module_subscriber_id = $(this).attr("data-modulesubscriberid");
        var module_name = $(this).attr("data-modulename");
        $.ajax({
            url: "{{ URL::asset('admin/subscriber/getSubscriberDetail') }}",
            type: "POST",
            data: {module_name: module_name, module_subscriber_id: module_subscriber_id, _token: "<?php echo csrf_token(); ?>"},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    var subData = data.result[0];
                    $('#edit_firstname_main_web').val(subData.firstname);
                    $('#edit_lastname_main_web').val(subData.lastname);
                    $('#edit_email_main_web').val(subData.email);
                    $('#edit_phone_main_web').val(subData.phone);
                    $('#edit_gender_main_web').val(subData.gender);
                    $('#edit_countryCode_main_web').val(subData.country_code);
                    $('#edit_cityName_main_web').val(subData.cityName);
                    $('#edit_stateName_main_web').val(subData.stateName);
                    $('#edit_zipCode_main_web').val(subData.zipCode);
                    $('#edit_twitterProfile_main_web').val(subData.twitter_profile);
                    $('#edit_facebookProfile_main_web').val(subData.facebook_profile);
                    $('#edit_linkedinProfile_main_web').val(subData.linkedin_profile);
                    $('#edit_instagramProfile_main_web').val(subData.instagram_profile);
                    $('#edit_socialProfile_main_web').val(subData.socialProfile);
                    $('#edit_tags_main_web').val(subData.tagID);
                    $('#edit_module_name_main_web').val(module_name);
                    $('#edit_module_subscriber_id_main_web').val(module_subscriber_id);
                    $("#editCentralContact_main_web").modal('show');
                }
            }
        });
    });
    //main web chat



    $("#updateCentralSubscriberData").submit(function (e) {

        e.preventDefault();
        $('.overlaynew').show();
        var formData = new FormData($(this)[0]);
        formData.append('_token', '<?php echo csrf_token(); ?>');
        $.ajax({
            url: "{{ URL::asset('admin/subscriber/updateSubscriberDetails') }}",
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

    $("#updateCentralSubscriberData_sms").submit(function (e) {
        var fname = $('#edit_firstname_sms').val();
        var lname = $('#edit_lastname_sms').val();
        var fname_1 = fname.charAt(0);
        var lname_1 = lname.charAt(0);
        var fullname = fname + '' + lname;
        var fullname_1 = fname_1 + '' + lname_1;
        e.preventDefault();
        $('.overlaynew').show();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: "{{ URL::asset('admin/subscriber/updateSubscriberDetailsByid') }}",
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    window.location.href = window.location.href;
                    //console.log($('#edit_firstname_sms').val());
                    $('#editCentralContact_sms').modal('hide');
                    //$('.fade').hide();
                    $('.smsContainer .subs_name').html(fullname);
                    $('.smsContainer .usremail').html($('#edit_email_sms').val());
                    $('.smsContainer .city').html($('#edit_cityName_sms').val());
                    $('.smsContainer .code').html($('#edit_countryCode_sms').val());
                    $('.smsContainer .gender').html($('#edit_gender_sms').val());
                    if ($('#avatarFinder').val() == '1')
                    {
                        $('.smsContainer .profile_pic').html('<span class="icons fl_letters s32" style="width:88px!important;height:88px!important;line-height:88px;font-size:21px;">' + fullname_1 + '</span>');

                    }


                    $('.overlaynew').hide();
                } else {

                    alertMessage('Error: Some thing wrong!');
                    $('.overlaynew').hide();

                }
            }
        });
    });



    $("#updateCentralSubscriberData_main_web").submit(function (e) {
        var fname = $('#edit_firstname_main_web').val();
        var lname = $('#edit_lastname_main_web').val();
        var fname_1 = fname.charAt(0);
        var lname_1 = lname.charAt(0);
        var fullname = fname + ' ' + lname;
        var fullname_1 = fname_1 + ' ' + lname_1;
        e.preventDefault();
        $('.overlaynew').show();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: "{{ URL::asset('admin/subscriber/updateSubscriberDetailsByid') }}",
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    window.location.href = window.location.href;
                    //console.log($('#edit_firstname_sms').val());
                    $('#editCentralContact_main_web').modal('hide');
                    //$('.fade').hide();
                    $('.webContainer .subs_name').html(fullname);
                    $('.webContainer .usremail').html($('#edit_email_main_web').val());
                    $('.webContainer .city').html($('#edit_cityName_main_web').val());
                    $('.webContainer .code').html($('#edit_countryCode_main_web').val());
                    $('.webContainer .gender').html($('#edit_gender_main_web').val());
                    if ($('#avatarFinder_main_web').val() == '1')
                    {
                        $('.webContainer .profile_pic').html('<span class="icons fl_letters s32" style="width:88px!important;height:88px!important;line-height:88px;font-size:21px;">' + fullname_1 + '</span>');

                    }


                    $('.overlaynew').hide();
                } else {

                    alertMessage('Error: Some thing wrong!');
                    $('.overlaynew').hide();

                }
            }
        });
    });


<?php if ($aUInfo->login_counter_lu >= 5) { ?>
        setTimeout(function () {
            $.ajax({
                url: "<?php echo base_url('admin/users/updateUserData'); ?>",
                type: "POST",
                data: {userId: '<?php echo $aUInfo->id; ?>', fieldName: 'login_counter_lu', _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('#upgrade_popup1').modal();
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                },
                error() {
                    $('.overlaynew').hide();
                }
            });
        }, 5000);
<?php } ?>

<?php if ($aUInfo->login_counter_au >= 12) { ?>
        setTimeout(function () {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/users/updateUserData'); ?>",
                data: {userId: '<?php echo $aUInfo->id; ?>', fieldName: 'login_counter_au', _token: '<?php echo csrf_token() ?>'},
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {
                        //console.log('success');
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                },
                error() {
                    $('.overlaynew').hide();
                }
            });
        }, 5000);
<?php } ?>

    function createTwilioAccount(userId) {
        $.ajax({
            url: "{{ URL::asset('/admin/users/createTwilioAccount') }}",
            type: "POST",
            data: {
                'user_id': userId
            },
            dataType: "json",
            success: function (response) {
                if (response.status == 'success') {
                    window.location.href = window.location.href;
                } else {
                    alert("Something went wrong");
                }
            },
            error: function (response) {
                alert("Something went wrong");
            }
        });
    }

    function createSandgridAccount(userId) {
        $.ajax({
            url: "{{ URL::asset('/admin/users/createSendGridSA') }}",
            type: "POST",
            data: {
                'user_id': userId
            },
            dataType: "json",
            success: function (response) {
                if (response.status == 'success') {
                    window.location.href = window.location.href;
                } else {
                    alert("Something went wrong");
                }
            },
            error: function (response) {
                alert("Something went wrong");
            }
        });
    }

    $(document).ready(function () {

        $("#addMySubscriberData").submit(function (e) {

            e.preventDefault();
            $('.overlaynew').show();
            var formData = new FormData($(this)[ 0 ]);
            $.ajax({
                url: "{{ URL::asset('admin/contacts/add_contact') }}",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = "{{ URL::asset('admin/contacts/mycontacts') }}";
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                },
                error() {
                    $('.overlaynew').hide();
                }
            });
        });

        $(".addMyCotact").click(function () {
            $("#addMySubscriber").modal("show");
        });

        $("#showAnnualupgradePopup").click(function () {
            $("#showannualPopup").modal("show");
        });

        $("#showupgradePopup").click(function () {
            //$("#upgrade_popup1").modal("show");
        });

        $("#saveyearly").click(function () {
            $("#upgrademonthlypopup").hide();
            $("#upgradebiyearlypopup").hide();
            $("#upgradeyearlypopup").show();
        });

        $("#savebiyearly").click(function () {
            $("#upgrademonthlypopup").hide();
            $("#upgradeyearlypopup").hide();
            $("#upgradebiyearlypopup").show();
        });

        $("#savemonthly").click(function () {
            $("#upgradebiyearlypopup").hide();
            $("#upgradeyearlypopup").hide();
            $("#upgrademonthlypopup").show();
        });
        $(".pDisplayNoActiveSubscription").click(function () {
            $("#viewNotActivePlanModel").modal("show");
        });

        $("#confirmLevelUpdate").click(function () {

            $('.overlaynew').show();
            var hidPlanID = $("#hidLevelPlanId").val();
            if ($('#lvltermsCondition').is(":checked") == true) {
                $.ajax({
                    url: "<?php echo base_url('payment/upgradeMembership'); ?>",
                    type: "POST",
                    data: {
                        plan_id: hidPlanID,
                        _token: '<?php echo csrf_token(); ?>'
                    },
                    dataType: "json",
                    success: function (data) {

                        if (data.status == 'success') {

                            alertMessageAndRedirect(data.msg, window.location.href);


                        } else {
                            alertMessage(data.msg);
                            $('.overlaynew').hide();
                        }
                    }
                });
            } else {
                alertMessage('Please accept terms and condition.');
                $('.overlaynew').hide();
            }
        });

        $("#confirmManualUpgrade").click(function () {


            var planName = $('input[name=selectupgrade]:checked').attr("plan_name");
            var selectedPlanId = $('input[name=selectupgrade]:checked').val();
            if (selectedPlanId) {
                $("#hidLevelPlanId").val(selectedPlanId);
                $("#upgradedPlanTitle").text(planName);
            } else {
                alertMessage('Please select plan for upgrade');
                return false;
            }


        });

        $(".confirmManualUpgrade").click(function () {
            var planName = $(this).attr('plan_name');
            var planID = $(this).attr('plan_id');
            $("#hidLevelPlanId").val(planID);
            $("#upgradedPlanTitle").text(planName);
            $("#confirm_level_upgrade").modal();
        });

        $("#confirmAnnualUpgrade").click(function () {
            var planName = $('input[name=selectannualupgrade]:checked').attr("plan_name");
            var selectedPlanId = $('input[name=selectannualupgrade]:checked').val();
            if (selectedPlanId) {
                $("#hidLevelPlanId").val(selectedPlanId);
                $("#upgradedPlanTitle").text(planName);
            } else {
                alertMessage('Please select plan for upgrade');
                return false;
            }
        });

        $("#btnLevelUpgrade").click(function () {
            var planName = $(this).attr("plan_name");
            var selectedPlanId = $(this).attr("plan_id");
            if (selectedPlanId) {
                $("#hidLevelPlanId").val(selectedPlanId);
                $("#upgradedPlanTitle").text(planName);
            } else {
                alertMessage('No Plan suggested for now');
                return false;
            }

        });

        var ratingValue = 0;
        $('#stars li').on('mouseover', function () {
            var onStar = parseInt($(this).data('value'), 10);
            $(this).parent().children('li.star').each(function (e) {
                if (e < onStar) {
                    $(this).addClass('hover');
                } else {
                    $(this).removeClass('hover');
                }
            });

        }).on('mouseout', function () {
            $(this).parent().children('li.star').each(function (e) {
                $(this).removeClass('hover');
            });
        });


        $('#stars li').on('click', function () {
            var onStar = parseInt($(this).data('value'), 10);
            var stars = $(this).parent().children('li.star');

            for (i = 0; i < stars.length; i++) {
                $(stars[ i ]).removeClass('selected');
            }

            for (i = 0; i < onStar; i++) {
                $(stars[ i ]).addClass('selected');
            }

            ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
            $('#ratingValue').val(ratingValue);
        });
    });

    $(document).ready(function () {


        $("#frmShortListModal").submit(function () {

            var formdata = $("#frmShortListModal").serialize();
            $.ajax({
                url: "{{ URL::asset('admin/chatshortcut/addShortCut') }}",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.BoxClose').trigger('click');
                        var dynamicTriggerId = $('#dvalue').val();
                        var dynamicTriggerId_shortcut = $('#dvalue_shortcut').val();
                        setTimeout(function () {

                            $('#' + dynamicTriggerId).trigger('click');


                        }, 200);
                    }

                    $('#' + dynamicTriggerId_shortcut).toggle();

                }
            });
            return false;
        });

        //Hover Menu in Header
        $('ul.nav li.dropdown').hover(function () {
            $(this).find('.dropdown-menu').stop(true, true).delay(0).fadeIn(400);

        }, function () {
            $(this).find('.dropdown-menu').stop(true, true).delay(0).fadeOut(400);

        });

        /*$('.dataTables_filter input').addClass('search_item');
         $(document).on('keyup', '.cus_search', function () {
         var valuenew = $(this).val();
         $('.search_item').val(valuenew);
         $('.search_item').keyup();
         $('.cus_search').val(valuenew);
         });*/


        $(document).on("click", ".readAllNotification, .viewAllNotification, .readNotification", function () {
            var elem = $(this);
            var redirectURL;
            var notificationid = $(this).attr('data-notifyid');
            if ($(this).attr("class").indexOf('viewAllNotification') != -1) {
                redirectURL = "{{ URL::to('/') }}/admin/notifications";
            }

            if ($(this).attr("class").indexOf('readNotification') != -1) {
                redirectURL = $(this).attr('data-redirect');
            }

            if ($(this).attr("class").indexOf('readAllNotification') != -1) {
                var bUnreadAll = true;
            }
            $.ajax({
                url: '<?php echo base_url("admin/notifications/markRead"); ?>',
                type: "POST",
                data: {param: 'readall', notificationid: notificationid, '_token':'{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $(elem).removeClass('fw700');
                        $(".unreadnotificationcount").text(data.unreadCount);
                        if (redirectURL != '' && redirectURL != undefined) {
                            window.location.href = redirectURL;
                        }

                        if (bUnreadAll == true) {
                            $(".readNotification").removeClass('fw700');
                        }
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }, error() {
                    alertMessage('Error: Some thing wrong!');
                }
            });
        });


    });

    $(document).on('click', '.initwebchat', function () {

        var user_id = $(this).attr('user_id');
        $('#sidebar-user-box-' + user_id).trigger('click');
    });

    $(document).on('click', '.initsmschat', function () {

        var user_id = $(this).attr('user_id');
        $('#sidebar-user-box-sms-' + user_id).trigger('click');
    });

    $('[data-toggle="tooltip"]').tooltip();



    var timeOverStart;
    var timeOutReminder;
    var stillLoggedIn;

    var d = new Date();
    var nTime;
    var setTime;



    $(document).ready(function () {
        var idleState = false;
        var idleTimer = null;

        $('span.userStillLogged').bind('keypress mousemove', function () {


            nTime = d.getTime();
            // Check browser support
            if (typeof (Storage) !== "undefined") {
                localStorage.setItem("setTime", nTime);
            } else {
                console.log("Sorry, your browser does not support Web Storage...");
            }
            clearInterval(timeOverStart);
            clearInterval(timeOutReminder);
            clearInterval(stillLoggedIn);
            timeOverStart = timeOver(0, 0, '<?php echo $inactivity_length; ?>', '');
        });

    });



    function timeOver(sec, min, time, event) {
        var sec = sec;
        var min = min;
        var setTime;
        clearInterval(setTime);
        setTime = setInterval(function () {
            sec = sec + 1;
            if (sec >= 60) {
                sec = 0;
                min = min + 1;
            }
            if (min >= time) {
                setTime = localStorage.getItem("setTime");
                if (setTime == nTime) {
                    $('#logoutpopup').modal();
                    clearInterval(setTime);
                    var logTime = timeOutTime(0, 0, 1, 'logout time');
                    stillLoggedIn = logTime;
                } else {
                    $('.close').trigger('click');
                    clearInterval(timeOverStart);
                    clearInterval(timeOutReminder);
                    clearInterval(stillLoggedIn);
                    timeOverStart = timeOver(0, 0, '<?php echo $inactivity_length; ?>', '');
                }

            }
            //console.log('Sec = '+ sec, 'Min = '+ min, 'event = '+event);

        }, 1000);
        return setTime;
    }


    function timeOutTime(sec, min, time, event) {
        var sec = sec;
        var min = min;
        var setTime;
        clearInterval(setTime);
        clearInterval(timeOverStart);
        setTime = setInterval(function () {
            sec = sec + 1;
            if (sec >= 60) {
                sec = 0;
                min = min + 1;
            }

            if (min >= time) {

                clearInterval(setTime);
                $('.close').trigger('click');
                $('#logoutpopupReminder').modal();
                var tOutRe = timeOutReminderF(0, 0, 1, 'logout time reminder');
                timeOutReminder = tOutRe;


            }

            //console.log('Sec = '+ sec, 'Min = '+ min, 'event = '+event);

        }, 1000);
        return setTime;
    }


    function timeOutReminderF(sec, min, time, event) {
        var sec = sec;
        var min = min;
        var setTime;
        clearInterval(setTime);
        clearInterval(timeOverStart);
        setTime = setInterval(function () {
            sec = sec + 1;
            if (sec >= 60) {
                sec = 0;
                min = min + 1;
            }

            if (min >= time) {

                setTime = localStorage.getItem("setTime");
                if (setTime == nTime) {
                    clearInterval(setTime);
                    clearInterval(timeOverStart);
                    clearInterval(timeOutReminder);
                    clearInterval(stillLoggedIn);
                    window.location.href = "{{ URL::asset('/admin/login/logout/') }}";

                } else {
                    $('.close').trigger('click');
                    clearInterval(timeOverStart);
                    clearInterval(timeOutReminder);
                    clearInterval(stillLoggedIn);
                    
                }

            }

            //console.log('Sec = '+ sec, 'Min = '+ min, 'event = '+event);

        }, 1000);
        return setTime;
    }


    timeOverStart = timeOver(0, 0, '<?php echo $inactivity_length; ?>', '');

    $(document).on('click', '.logoutYes', function () {
        clearInterval(stillLoggedIn);
        $('.close').trigger('click');
        timeOverStart = timeOver(0, 0, '<?php echo $inactivity_length; ?>', '');
    });

    $(document).on('click', '.logoutNo', function () {
        window.location.href = "{{ URL::asset('/admin/login/logout/') }}";
    });

    $(document).on('click', '.remainLoggedIn', function () {
        clearInterval(timeOutReminder);
        $('.close').trigger('click');
        timeOverStart = timeOver(0, 0, '<?php echo $inactivity_length; ?>', '');
    });



</script>
<script type="text/javascript">
    var specialKeys = new Array();
    specialKeys.push(8); //Backspace
    function IsNumeric(e) {
        var keyCode = e.which ? e.which : e.keyCode
        var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
        //document.getElementById("error").style.display = ret ? "none" : "inline";
        return ret;
    }
    //onkeypress="return IsNumeric(event);"

    function IsAlphabet(e) {
        var keyCode = e.which ? e.which : e.keyCode;
        var ret = ((keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || keyCode == 32 || specialKeys.indexOf(keyCode) != -1);
        //document.getElementById("error").style.display = ret ? "none" : "inline";
        return ret;
    }


</script>

<script>
    function syncContactSelectionSources() {
        $.ajax({
            url: "{{ URL::asset('admin/workflow/syncWorkflowAudienceGlobal') }}",
            type: "POST",
            data: {_token: '{{csrf_token()}}'},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    console.log('synced successfully!!');
                }
            }
        });
    }
</script>