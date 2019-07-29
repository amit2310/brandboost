<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/media/fancybox.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/gallery.js"></script>

<div class="box smart-faq-box" style="width: 680px;z-index:9999999999;">
    <div style="width: 680px;overflow: hidden; height: 100%;">
        <div style="height: 100%; overflow-y:auto; overflow-x: hidden;">

            <div class="row" style="height: 100%;">
                <div class="col-md-12">
                    <a style="left: 35px; top: 15px;" class="reviews smart-faq slide-toggle bkg_grey_light" ><i class=""><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_arrow_left.png"/></i></i></a> 
                    <h5 style="padding-left: 75px;" class="panel-title">FAQs</h5>
                </div>
                <div id="faQSmartPopup"></div>
            </div>
        </div>					
    </div>
</div>   
<a style="position: fixed; top: 50%; right: 12px; display:none;" class="reviews smart-faq slide-toggle visible bkg_dred" ><i class="icon-arrow-left5"></i></a>



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


<script>
    $(document).ready(function () {

        $(".smart-faq").click(function () {
            $(".smart-faq-box").animate({
                width: "toggle"
            });
        });

        $('[data-popup="lightbox"]').fancybox({
            padding: 3
        });
        
     
        $(document).on("click", ".viewFaqSmartPopup", function () {
    
            $("#faQSmartPopup").html('<h1 class="text-center" style="margin-top:450px;">Loading....</h1>');
            var faQListid = $(this).attr('faQListid');
            loadFAQSmartPopup(faQListid);
            $(".smart-faq-box").show();
        });
        $(".viewFaqSmartPopup").first().trigger('click');
        $(".smart-faq-box").hide();//For auto close


    });
    function loadFAQSmartPopup(faQListid, selectedTab) {
         $("#faQSmartPopup").empty();
           $("#faQSmartPopup").html('<h1 class="text-center" style="margin-top:450px;">Loading....</h1>');
        $.ajax({
            url: '/admin/brandboost/getFaqdetails/' + faQListid + '?t=' + selectedTab,
            type: "POST",
            data: {faQListid: faQListid, action: 'smart-popup',_token: '{{csrf_token()}}'},
            dataType: "json",
            success: function (data) {

                if (data.status == 'success') {
                    var questionData = data.content;
                    $("#faQSmartPopup").html(questionData);
                }
            }
        });
    }


</script>