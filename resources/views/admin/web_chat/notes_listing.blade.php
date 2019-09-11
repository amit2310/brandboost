<div class="panel-body p0 bkg_white minh_880">


    <div class="p20 pr0 pt0 mainchatsvroll2">

        <ul class="media-list chat-list NotesThreadsBox"
            style="display:block; margin-top:10px; height: 615px!important; max-height: 615px!important;">

        </ul>

    </div>

    <!-- SMS CHAT FOOTER BOX -->
    <div class="panel-footer p0 bkg_white no_shadow smschat_footer addSubscriberNotes">
        <div class="p20">

            <textarea class="form-control addnote mb0 NotesContent"
                      placeholder="Shift + Enter to add a new line ,  Start with ‘/’ to select a  Saved Message"></textarea>


        </div>

        <div class="p20 btop" style="padding: 12px 20px!important">
            <div class="pull-left ">

                <a class="mr20 txt_grey msg active common_msg" href="#massage_tab" data-toggle="tab">Message</a>
                <a class="common_note" href="#Notes_tabs" data-toggle="tab">Note</a>

            </div>
            <div class="pull-right">
                <input style="display:none;" id="mmsFile_notes_web" type="file">

                <div class="panel panel-default smilie_emoji supported_smilies_smschat hide"
                     style="position:absolute; top:-194px; left:2px; background:#F0F0F0;">
                    <div class="panel-heading"><span><strong>Supported Smilies</strong></span></div>
                    <div class="panel-body smiley_grid_smschat"></div>
                </div>

                <a style="display:none" class="mr-15 smilieSmsIconMessage" href="javascript:void(0)"><img
                        src="/assets/images/chat_grey_smiley.png"/> </a>
                <a class="mr-15" href="javascript:void(0)"><img src="/assets/images/chat_grey_image.png"/> </a>
                <a class="mr-15 notesFileAttechment" href="javascript:void(0)"><img
                        src="/assets/images/chat_grey_attach.png"/> </a>
                <a class="mr-15" href="javascript:void(0)"><img src="/assets/images/chat_gray_calendar.png"/> </a>

                <button id="sms_but" class="btn dark_btn btn-xs send_btn notes_but">Send <img class="ml10"
                                                                                              src="/assets/images/icon_send_arrow.png">
                </button>

            </div>
            <div class="clearfix"></div>
        </div>

    </div>
    <!-- SMS CHAT FOOTER BOX -->


</div>
<script>
    $(document).ready(function () {

        //$('.NotesThreadsBox').html('');
        $('body').on('keyup', '#Webonly .NotesContent', function (e) {
            if (e.which == 13) {
                $("#Webonly .notes_but").click();
            }
        });

        $('body').on('click', '#Webonly .notes_but', function () {
            var NotesTo = "";
            NotesTo = $('#Webonly #em_inc_id').val();
            var newToken = $('#em_token').val();
            var chatTo = $('#em_id').val();
            var currentUser = $('#em_current_user').val();

            var NotesContent = $('#Webonly .NotesContent').val();
            $('#Webonly .NotesContent').val('');
            var source = 'Sms chat notes';
            if ($.trim(NotesContent) == '') {
                $('#Webonly .NotesContent').addClass('borderClass');

            } else {
                $.ajax({
                    url: "{{ base_url('admin/webchat/addWebNotes') }}",
                    type: "POST",
                    data: {
                        room: newToken,
                        msg: NotesContent,
                        chatTo: chatTo,
                        currentUser: currentUser,
                        notes: '1',
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response.status == "success") {
                            showNoteslisting(chatTo);
                        }
                    },
                    error: function (response) {
                        // error
                    }
                });
            }
        });

        //  ######### media  file upload ############ //
        $(document).on('click', '#Webonly .notesFileAttechment', function () {
            $('#Webonly #mmsFile_notes_web').trigger('click');

        });
        //  ######### media  file upload ############ //

    });

    $(document).on('change', '#Webonly #mmsFile_notes_web', function (e) {
        $('.overlaynew').show();
        const files = document.querySelector('[id=mmsFile_notes_web]').files;
        var NotesTo = $('#Webonly #em_inc_id').val();
        var newToken = $('#em_token').val();
        var chatTo = $('#em_id').val();
        var currentUser = $('#em_current_user').val();
        const formData = new FormData();

        for (let i = 0; i < files.length; i++) {
            let file = files[i];
            formData.append('files[]', file);
        }
        formData.append('_token', '{{ csrf_token() }}');

        fetch('{{ base_url("dropzone/upload_s3_attachment/" . $loginUserData->id . "/webchat") }}', {
            method: 'POST',
            body: formData // This is your file object
        }).then(
            response => response.json() // if the response is a JSON object
        ).then(
            success => {
                if (success.error == '') {

                    var filename = success.result;
                    var fileext = (/[.]/.exec(filename)) ? /[^.]+$/.exec(filename) : undefined;
                    var msg = 'https://s3-us-west-2.amazonaws.com/brandboost.io/' + filename;

                    if (fileext[0] == 'png' || fileext[0] == 'jpg' || fileext[0] == 'jpeg' || fileext[0] == 'gif') {
                        msg = "<a href='" + msg + "' target='_blank'><img src='" + msg + "' height='100' width='100' /></a>";
                    } else if (fileext[0] == 'doc' || fileext[0] == 'docx' || fileext[0] == 'odt' || fileext[0] == 'csv' || fileext[0] == 'pdf') {
                        msg = "<a href='" + msg + "' target='_blank'>Download '" + fileext[0].toUpperCase() + "' File</a>";
                    }

                    var messageText = '<li class="media reversed"> <div class="media-body"> <span class="media-annotation user_icon"><span class="circle_green_status status-mark"></span><span class="icons s32"><img src="{{ $currentUserImg }}" class="img-circle" alt="" width="150" height="auto"></span></span><div class="media-content">' + msg + '</div></div></li>';

                    msg = 'https://s3-us-west-2.amazonaws.com/brandboost.io/' + filename;
                    var source = 'web chat notes';
                    $.ajax({
                        url: "{{ base_url('/admin/webchat/addWebNotes') }}",
                        type: "POST",
                        data: {
                            room: newToken,
                            msg: msg,
                            chatTo: chatTo,
                            currentUser: currentUser,
                            notes: '1',
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: "json",
                        success: function (response) {
                            if (response.status == "success") {
                                showNoteslisting(chatTo);
                            }
                        },
                        error: function (response) {
                            // error
                        }
                    });
                    $('.overlaynew').hide();
                } else {
                    // error
                }
            }
        ).catch(
            error => console.log(error) // Handle the error response object
        );

    });

    function showNoteslisting(NotesTo) {
        $('.NotesThreadsBox').attr('id', 'notesBox_' + NotesTo);
        $.ajax({
            url: "{{ base_url('admin/webchat/listingNotes') }}",
            type: "POST",
            data: {'NotesTo': NotesTo, notes_from: 'web', _token: '{{ csrf_token() }}'},
            dataType: "html",
            success: function (data) {
                $('#Webonly .NotesThreadsBox').html(data);
            }, error: function () {
                alertMessage('Error: Some thing wrong!');
            }
        });

        setTimeout(function () {
            var msgHeight = document.getElementById("notesBox_" + NotesTo).scrollHeight;
            $("#notesBox_" + NotesTo).scrollTop(msgHeight);
        }, 1500);


    }

</script>
