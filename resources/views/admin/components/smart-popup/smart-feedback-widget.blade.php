<script type="text/javascript" src="{{ base_url() }}assets/js/plugins/media/fancybox.min.js"></script>
<script type="text/javascript" src="{{ base_url() }}assets/js/pages/gallery.js"></script>

<div class="box smart-feedback-box" style="width: 680px;z-index:9999999999;">
    <div style="width: 680px;overflow: hidden; height: 100%;">
        <div style="height: 100%; overflow-y:auto; overflow-x: hidden;">

            <div class="row" style="height: 100%;">
                <div class="col-md-12">
                    <a style="left: 35px; top: 15px;" class="reviews smart-feedback slide-toggle bkg_grey_light"><i
                            class=""><img src="{{ base_url() }}assets/images/icon_arrow_left.png"/></i></a>
                    <h5 style="padding-left: 75px;" class="panel-title">Negative Feedback</h5>
                </div>
                <div id="feedbackSmartPopup"></div>
            </div>
        </div>
    </div>
</div>
<a style="position: fixed; top: 50%; right: 12px; display:none;"
   class="reviews smart-feedback slide-toggle visible @{{ $bgClass }}"><i class="icon-arrow-left5"></i></a>


<div id="videoReviewModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Video review</h5>
            </div>
            <div class="modal-body" id="vReview">
                <video width="100%" controls>
                    <source src="" type="">
                </video>
            </div>
            <!-- <div class="modal-footer modalFooterBtn">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
            </div> -->
        </div>
    </div>
</div>

@include('admin.modals.smartPopup.feedback')
<script src="{{ base_url() }}assets/js/modules/smart-popup/feedback.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {

        $(".smart-feedback").click(function () {
            $(".smart-feedback-box").animate({
                width: "toggle"
            });
        });

        $('[data-popup="lightbox"]').fancybox({
            padding: 3
        });

        $(document).on("click", ".viewSmartPopup", function () {

            $("#feedbackSmartPopup").html('<h1 class="text-center" style="margin-top:450px;">Loading....</h1>');
            var feedbackID = $(this).attr('feedbackid');
            loadSmartPopup(feedbackID);
            $(".box").show();
        });
        $(".viewSmartPopup").first().trigger('click');
        $(".box").hide();
        //$(".icon-arrow-left5").trigger('click'); //For auto close


    });

    function loadSmartPopup(feedbackID, selectedTab) {
        //$("#feedbackSmartPopup").empty();
        var tkn = $('meta[name="_token"]').attr('content');
        $.ajax({
            url: '/admin/feedback/details/' + feedbackID + '?t=' + selectedTab,
            type: "POST",
            data: {_token: tkn, feedbackid: feedbackID, action: 'smart-popup'},
            dataType: "json",
            success: function (data) {

                if (data.status == 'success') {
                    var feedbackData = data.content;
                    $("#feedbackSmartPopup").html(feedbackData);
                }
            }
        });
    }


</script>
