<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/media/fancybox.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/gallery.js"></script>
<div class="box smart-advocate-box" style="width: 680px;z-index:9999999999;">
    <div style="width: 680px;overflow: hidden; height: 100%;">
        <div style="height: 100%; overflow-y:auto; overflow-x: hidden;">

            <div class="row" style="height: 100%;">
                <div class="col-md-12">
                    <a style="left: 35px; top: 15px;" class="reviews smart-contact slide-toggle bkg_grey_light" ><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_arrow_left.png"/></i></a> 
                    <h5 style="padding-left: 75px;" class="panel-title">Advocate Report</h5>
                </div>
                <div id="advocateSmartPopup"></div>
            </div>
        </div>					
    </div>
</div>   
<a style="position: fixed; top: 50%; right: 12px; display:none;" class="reviews smart-contact slide-toggle visible" ><i class="icon-arrow-left5"></i></a>



<?php //$this->load->view('admin/components/smart-popup/contacts'); ?>
<script>
    $(document).ready(function () {

        $(".smart-contact").click(function () {
            $(".smart-advocate-box").animate({
                width: "toggle"
            });
        });

        $(document).on("click", ".viewAdvocateSmartPopup", function () {
			
            $("#advocateSmartPopup").html('<h1 class="text-center" style="margin-top:450px;">Loading....</h1>');
            var subscriberId = $(this).attr('data-modulesubscriberid');
            var accountID = $(this).attr('data-accountid');
            loadAdvocateSmartPopup(subscriberId, accountID);
            $(".smart-advocate-box").show();
        });
        $(".viewContactSmartPopup").first().trigger('click');
        $(".smart-advocate-box").hide();//For auto close

        $(document).on("click", ".addNoteButton2", function () {
            $('.overlaynew').show();
            var subscriberid = $("#subscriberid").val();
            var notes = $("#notes2").val();
            if (notes == '') {
                $('.overlaynew').hide();
                alertMessage('Please enter notes.');
            } else {
                $.ajax({
                    url: "<?php echo base_url('/admin/contacts/add_contact_notes'); ?>",
                    type: "POST",
                    data: {notes: notes, subscriberid: subscriberid, type: 'smartpopup'},
                    dataType: "json",
                    success: function (response) {
                        if (response.status == "success") {
                            //alertMessage('Your notes has been added successfully.');
                            $('.overlaynew').hide();
                            $("#notes2").val('');
                            $("#contact-notes-container").html(response.notes);
//                                $('.notes-table').DataTable({
//                                    "order": []
//                                });

                            $(".contactNewNote").tab('show');
                            //window.location.href = '';
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
    function loadAdvocateSmartPopup(subscriberID, accountId) {
        $.ajax({
            url: '/admin/modules/referral/advocateProfile/' + subscriberID,
            type: "POST",
            data: {subscriberId: subscriberID, accountId: accountId, action: 'smart-popup'},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    var reviewData = data.content;
                    $("#advocateSmartPopup").html(reviewData);
                }
            }
        });
    }
</script>