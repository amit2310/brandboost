<script type="text/javascript" src="{{ base_url() }}assets/js/plugins/media/fancybox.min.js"></script>
<script type="text/javascript" src="{{ base_url() }}assets/js/pages/gallery.js"></script>
<div class="box smart-contact-onsite-box" style="width: 680px;z-index:9999999999;">
    <div style="width: 680px;overflow: hidden; height: 100%;">
        <div style="height: 100%; overflow-y:auto; overflow-x: hidden;">
            <div class="row" style="height: 100%;">
                <div class="col-md-12">
                    <a style="left: 35px; top: 15px;" class="reviews smart-contact slide-toggle bkg_grey_light" ><i class=""><img src="{{ base_url() }}assets/images/icon_arrow_left.png"/></i></a> 
                    <h5 style="padding-left: 75px;" class="panel-title">Profile</h5>
                </div>
                <div id="contactSmartPopupReview"></div>
            </div>
        </div>					
    </div>
</div>   
<a style="position: fixed; top: 50%; right: 12px; display:none;" class="reviews smart-contact slide-toggle visible" ><i class="icon-arrow-left5"></i></a>

@include('admin.components.smart-popup.contacts')

<script>
    $(document).ready(function () {

        $(".smart-contact").click(function () {
            $(".smart-contact-onsite-box").animate({
                width: "toggle"
            });
        });

        $(document).on("click", ".viewContactSmartPopupReview", function () {
            $("#contactSmartPopupReview").html('<h1 class="text-center" style="margin-top:450px;">Loading....</h1>');
            var subscriberId = $(this).attr('data-modulesubscriberid');
            var moduleName = $(this).attr('data-modulename');
            loadContactSmartPopupReview(subscriberId, moduleName);
            $(".smart-contact-onsite-box").show();
        });
		
        $(".viewContactSmartPopupReview").first().trigger('click');
        $(".smart-contact-onsite-box").hide();//For auto close

        $(document).on("click", ".addNoteButton2", function () {
            $('.overlaynew').show();
            var subscriberid = $("#subscriberid").val();
            var notes = $("#notes2").val();
            if (notes == '') {
                $('.overlaynew').hide();
                alertMessage('Please enter notes.');
            } else {
                $.ajax({
                    url: "{{ base_url('/admin/contacts/add_contact_notes') }}",
                    type: "POST",
                    data: {notes: notes, subscriberid: subscriberid, type: 'smartpopup',_token: '{{csrf_token()}}'},
                    dataType: "json",
                    success: function (response) {
                        if (response.status == "success") {
                            $('.overlaynew').hide();
                            $("#notes2").val('');
                            $("#contact-notes-container").html(response.notes);
                            $(".contactNewNote").tab('show');
                        }
                    },
                    error: function (response) {
                        $('.overlaynew').hide();
                        alertMessage(response.message);
                    }
                });
            }
        });


        var activityStart = 10;
        var activityEnd = 20;
        var activityDiff = activityEnd - activityStart;

        $(document).on('click', '.loadMoreActivity', function () {
            $('.activityShow').slice(activityStart, activityEnd).slideDown();
            activityStart = Number(activityStart) + Number(activityDiff);
            activityEnd = Number(activityEnd) + Number(activityDiff);
            if ($(".activityShow:hidden").length == 0) {
                $('.loadMoreRecordActivity').remove();
            }
        });
    });
	
    function loadContactSmartPopupReview(subscriberID, moduleName) {
        $.ajax({
            url: '/admin/contacts/profile/' + subscriberID,
            type: "POST",
            data: {subscriberId: subscriberID, moduleName: moduleName, action: 'smart-popup',_token: '{{csrf_token()}}'},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    var reviewData = data.content;
                    $("#contactSmartPopupReview").html(reviewData);
                }
            }
        });
    }
</script>