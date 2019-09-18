<script type="text/javascript" src="{{ base_url() }}assets/js/plugins/media/fancybox.min.js"></script>
<script type="text/javascript" src="{{ base_url() }}assets/js/pages/gallery.js"></script>
<style>
    .fancybox-opened {
        z-index: 2147483647 !important;
    }

    .fancybox-overlay {
        z-index: 2147483646 !important;
    }
</style>

<div class="box smart-review-box" style="width: 680px;z-index:2147483646;">
    <div style="width: 680px;overflow: hidden; height: 100%;">
        <div style="height: 100%; overflow-y:auto; overflow-x: hidden;">
            <div class="row" style="height: 100%;">
                <div class="col-md-12">
                    <a style="left: 35px; top: 15px;" class="reviews smart-review slide-toggle bkg_grey_light">
						<i class=""><img src="{{ base_url() }}assets/images/icon_arrow_left.png"/></i>
					</a>
                    <h5 style="padding-left: 75px;" class="panel-title">Review</h5>
                </div>
                <div id="reviewSmartPopup"></div>
            </div>
        </div>
    </div>
</div>

<a style="position: fixed; top: 50%; right: 12px;display:none;" class="reviews smart-review slide-toggle visible bkg_purple">
   <i class="icon-arrow-left5"></i>
</a>


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
        </div>
    </div>
</div>

<script src="{{ base_url() }}assets/js/modules/smart-popup/reviews.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {

        $(".smart-review").click(function () {
            $(".smart-review-box").animate({
                width: "toggle"
            });
        });

        $('[data-popup="lightbox"]').fancybox({
            padding: 3
        });

        $(document).on('click', '.preview_video_src', function () {
            var filepath = $(this).attr('filepath');
            var fileext = $(this).attr('fileext');
            $('#vReview video source').attr('src', filepath);
            $('#vReview video source').attr('type', 'video/' + fileext);
            $("#vReview video")[0].load();
            $('#videoReviewModal').modal();
        });

        $(document).on("click", ".viewSmartPopup", function () {
            $("#reviewSmartPopup").html('<h1 class="text-center" style="margin-top:450px;">Loading....</h1>');
            var reviewID = $(this).attr('reviewid');
            loadSmartPopup(reviewID);
            $(".smart-review-box").show();
        });
		
        $(".viewSmartPopup").first().trigger('click');
        $(".smart-review-box").hide();
    });

    function loadSmartPopup(reviewID, selectedTab) {
        $.ajax({
            url: '/admin/brandboost/reviewdetails/' + reviewID + '?t=' + selectedTab,
            type: "POST",
            data: {reviewid: reviewID, action: 'smart-popup', _token: '{{csrf_token()}}'},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    var reviewData = data.content;
                    $("#reviewSmartPopup").html(reviewData);
                }
            }
        });
    }
</script>