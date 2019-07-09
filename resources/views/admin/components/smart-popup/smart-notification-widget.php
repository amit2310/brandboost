<style type="text/css">

.box-notification {float: left; display: none;top: 0!important;height: 100%;width: 373px;position:fixed!important;box-sizing: border-box; right: 0!important; border-radius: 0px;   box-shadow: 0 10px 12px 0 rgba(1, 21, 64, 0.06)!important; padding: 0px; background: #fff!important; z-index: 99999; }

.box-notification:before{position: absolute;content: ''; left: -250px; top: 0;  width: 250px;  height: 100%;  opacity: 0.1;box-shadow: 0 10px 12px 0 rgba(1, 21, 64, 0.06);  background-image: linear-gradient(to left, #000000, rgba(0, 0, 0, 0)); z-index: -1 }



.box-notification h5{height: 56px; padding:17px 20px 18px 20px; border-radius: 0 5px 0 0; color: #313b50;font-size: 14px; font-weight: 500;  border-bottom: 1px solid #f5f4f5 !important;}

.box-notification .nav-tabs{ box-shadow: 0 3px 2px 0 rgba(0, 53, 193, 0.01), 0 1px 1px 0 rgba(0, 19, 151, 0.05);}
.box-notification .nav-tabs {padding: 0px 18px;}
.box-notification .nav-tabs > li{margin: 0px 12px!important;}
.box-notification .nav-tabs > li > a {   font-size: 14px;    color: #425784; padding: 16px 0 15px !important; font-weight: 300;}
.box-notification .nav-tabs > li.active > a, .box .nav-tabs > li.active > a:hover, .box .nav-tabs > li.active > a:focus {    color: #5d7df3; font-weight: 400; border-bottom: 1px solid #5d7df3 !important;}
.box-notification textarea{border: none; background: none!important; box-shadow: none!important; resize: none; height: 80px;}
.box-notification .box_heading{padding: 15px 30px; /*background: #fff;*/}
.box-notification .product_des img{ border-radius: 5px; padding: 2px; background: #fff;box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.17); width: 132px; height: 96px;}
.box-notification .product_des p{ font-size: 13px; color: #5e5e7c; margin-bottom: 5px; }
.box-notification .product_des p strong{  color: #080d2e; font-weight: 500; }
.box-notification .product_des p span{float: left; width: 140px;}
.box-notification .table > tbody > tr > td{padding: 20px 15px 20px 15px!important;}
.box-notification .table.new > tbody > tr > td{padding: 10px !important;}
.box-notification .table.campaign > tbody > tr > td{padding: 10px 15px !important;}
.box-notification .table.campaign > tbody > tr > td:first-child{padding-left: 25px !important;}
.box-notification .box_footer_btn {  position: absolute; bottom: 0;  width: 100%; left: 0;   border-top: 1px solid #eee; background: #fff;}
.box-notification .btn.dark_btn{box-shadow: none!important}
.box-notification .btn.dark_btn.bkg_blue {background: #dfe5fd!important; box-shadow: none!important; color: #5d7df3; padding: 7px 20px!important;}
.box-notification a i{font-size: 13px!important; color: #7a8dae!important;}

.box-notification .nav-tabs.smarttablist{ box-shadow: 0 3px 2px 0 rgba(0, 53, 193, 0.01), 0 1px 1px 0 rgba(0, 19, 151, 0.05);}
.box-notification .nav-tabs.smarttablist {padding: 0px 18px;}
.box-notification .nav-tabs.smarttablist > li{margin: 0px 12px!important;}
.box-notification .nav-tabs.smarttablist > li:first-child{margin: 0px 8px 0 0!important;}
.box-notification .nav-tabs.smarttablist > li > a {  font-size: 14px;    color: #425784; padding: 16px 0 15px !important; font-weight: 300;}
.box-notification .nav-tabs.smarttablist > li.active > a, .box .nav-tabs.smarttablist > li.active > a:hover, .box .nav-tabs.smarttablist > li.active > a:focus { color: #5d7df3; font-weight: 400; border-bottom: 1px solid #5d7df3 !important;}
.box-notification .profile_sec .btn.btn-xs.btn_white_table { margin: 0 5px 5px 0!important; color: #09204f!important; font-weight: 400!important;}


</style>

<div class="box-notification" style="width: 345px;">
    <div style="width: 345px;overflow: hidden; height: 100%;">
        <div style="height: 100%; overflow-y:auto; overflow-x: hidden;">

            <div class="row" style="height: 100%;">
                <div class="col-md-12">
                    <a style="left: 35px; top: 15px;" class="reviews notification-smart-popup slide-toggle bkg_grey_light" ><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_arrow_left.png"/></i></a> 
                    <h5 style="padding-left: 75px;" class="panel-title">Notifications</h5>
                </div>
                <div class="notificationSmartPopup"></div>
       			<div class="col-md-12" style="position: absolute; bottom: 30px;">
           			<div class="btop p20 text-center">
           				<a class="txt_blue2 fsize14 " href="<?php echo base_url().'admin/notifications'; ?>">View all notifications <i class="icon-arrow-right13 txt_blue2"></i></a>
           			</div>
           		</div>
                
           
            </div>

        </div>					
    </div>
</div> 

<script>
    $(document).ready(function () {

        $(".notification-smart-popup").click(function(){
            $(".box-notification").animate({
                width: "toggle"
            });
            $(".notificationSmartPopup").html('<h1 class="text-center" style="margin-top:450px;">Loading....</h1>');
            loadNotificationSmartPopup();
            $(".notificationSmartPopup").show();
        });

        /*$(".reviews").click(function(){
            $(".box-notification").animate({
                width: "toggle"
            });
        });*/

        

       /* $('[data-popup="lightbox"]').fancybox({
            padding: 3
        });*/
        
     
        
        //$(".viewFaqSmartPopup").first().trigger('click');
        $(".notificationSmartPopup").hide();


    });
    function loadNotificationSmartPopup() {
         $(".notificationSmartPopup").empty();
           $(".notificationSmartPopup").html('<h1 class="text-center" style="margin-top:450px;">Loading....</h1>');
        $.ajax({
            url: '/admin/notifications/getNotificationSmartPopup/',
            type: "POST",
            data: {action: 'smart-popup'},
            dataType: "json",
            success: function (data) {

                if (data.status == 'success') {
                    var notificationData = data.content;
                    $(".notificationSmartPopup").html(notificationData);
                }
            }
        });
    }


</script>