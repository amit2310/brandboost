<script type="text/javascript" src="/assets/js/plugins/editors/summernote/summernote.min.js"></script>
<script type="text/javascript" src="/assets/js/pages/editor_summernote.js"></script>
<style type="text/css">
    .btn.btn-xs.btn_white_table.active{background: #6190fa!important; color: #fff;}
</style>

<?php $this->load->view('admin/notification_smart_popup'); ?>

<div class="content">
    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-7">
                <h3><i class="icon-star-half"></i> &nbsp;<?php echo $title; ?></h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="<?php if ($seletedTab == 'email'): ?>active<?php endif; ?>"><a href="#right-icon-tab1" data-toggle="tab"> Email Notifications</a></li>
                    <li class="<?php if ($seletedTab == 'sms'): ?>active<?php endif; ?>"><a href="#right-icon-tab2" data-toggle="tab"> SMS Notifications</a></li>
                    <li class="<?php if ($seletedTab == 'system'): ?>active<?php endif; ?>"><a href="#right-icon-tab0" data-toggle="tab">System Notifications</a></li>
                </ul>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-5 text-right btn_area">

                <button type="button" class="btn light_btn" data-toggle="modal" data-target="#addEmailNotificationTemplate"><i class="icon-arrow-up16"></i><span> &nbsp;  Add Email Notification</span> </button>
                
                <button type="button" class="btn light_btn" data-toggle="modal" data-target="#addSMSNotificationTemplate"><i class="icon-arrow-up16"></i><span> &nbsp;  Add SMS Notification</span> </button>

                <button type="button" class="btn light_btn" data-toggle="modal" data-target="#addSystemNotificationTemplate"><i class="icon-arrow-up16"></i><span> &nbsp;  Add System Notification</span> </bolutton>
            </div>

        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->

    <div class="tab-content">
        
        <!--===========TAB 2===Preferences========-->
        <?php $this->load->view("admin/settings/notification-tabs/email-notify"); ?>

        <!--===========TAB 3===Preferences========-->
        <?php //$this->load->view("admin/settings/notification-tabs/sms-notify"); ?>

        <?php //$this->load->view("admin/settings/notification-tabs/sys-notify"); ?>
    </div>    

</div>

<script type="text/javascript">
    $(document).ready(function(){
       
        $(document).on("click", ".reviews", function(){ 
            $(".box").animate({
                width: "toggle"
            });
            $('.eSubject').hide();
            $('.emailTextArea').next().hide();
        });

        /*$("#newcampaign").click(function(){
            $(".box").animate({
                width: "toggle"
            });
        });*/
        
        /*$("#notificationslidepopup").click(function(){
            $(".box").animate({
                width: "toggle"
            });
        });*/
        
    });


</script>


