<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-12">
                <h3><img style="width: 18px;" src="<?php echo base_url(); ?>assets/images/user_settings_icon.png"> Brand Settings</h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="<?php if(empty($seletedTab)):?>active<?php endif;?>"><a href="#right-icon-tab0" data-toggle="tab">General</a></li>
                    <li class="<?php if($seletedTab=='prefer'):?>active<?php endif;?>"><a href="#right-icon-tab1" data-toggle="tab"> Preferences</a></li>
                    <li class="<?php if($seletedTab=='subs'):?>active<?php endif;?>"><a href="#right-icon-tab2" data-toggle="tab">Subscription & Credits</a></li>
                    <li class="<?php if($seletedTab=='billing'):?>active<?php endif;?>"><a href="#right-icon-tab3" data-toggle="tab">Billing</a></li>
                    <li class="<?php if($seletedTab=='notify'):?>active<?php endif;?>"><a href="#right-icon-tab4" data-toggle="tab">Notifications</a></li>
                    <li class="<?php if($seletedTab=='import'):?>active<?php endif;?>"><a href="#right-icon-tab5" data-toggle="tab">Import</a></li>
                    <li class="<?php if($seletedTab=='export'):?>active<?php endif;?>"><a href="#right-icon-tab6" data-toggle="tab">Export</a></li>
                </ul>

            </div>

        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->


    <!--&&&&&&&&&&&& TABBED CONTENT START &&&&&&&&&&-->
    <div class="tab-content"> 
        <!--===========TAB 1====General=======-->

        <?php $this->load->view("admin/settings/tabs/general"); ?>

        <!--===========TAB 2===Preferences========-->
        <?php $this->load->view("admin/settings/tabs/preferences"); ?>

        <!--===========TAB 3====Subscription & Credits=======-->
        <?php $this->load->view("admin/settings/tabs/subscription_credits"); ?>

        <!--===========TAB 4====Billing=======-->
        <?php $this->load->view("admin/settings/tabs/billing"); ?>

        <!--===========TAB 5===========-->
        <?php $this->load->view("admin/settings/tabs/notifications"); ?>

        <!--===========TAB 6===========-->
        <?php $this->load->view("admin/settings/tabs/import"); ?>

        <!--===========TAB 7===========-->
        <?php $this->load->view("admin/settings/tabs/export"); ?>


    </div>
    <!--&&&&&&&&&&&& TABBED CONTENT  END &&&&&&&&&&-->

</div>

<script>



    $(document).ready(function () {
        $("#frmGeneralBusinessInfo, #frmGeneralBusinessInfo2, #frmGeneralBusinessInfo3, #frmGeneralBusinessInfo4").submit(function () {
            var formData = $(this).serialize();
            $.ajax({
                url: "<?php echo base_url('admin/settings/updateCompanyFormData'); ?>",
                type: "POST",
                data: formData,
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {
                        alertMessage("Updated Successfully!");
                    } else {
                        //display error message if required
                    }
                }
            });
            return false;

        });
    });

    // top navigation fixed on scroll and side bar collasped

    $(window).scroll(function () {
        var sc = $(window).scrollTop();
        if (sc > 100) {
            $("#header-sroll").addClass("small-header");
        } else {
            $("#header-sroll").removeClass("small-header");
        }
    });

    function smallMenu() {
        if ($(window).width() < 1600) {
            $('body').addClass('sidebar-xs');
        } else {
            $('body').removeClass('sidebar-xs');
        }
    }

    $(document).ready(function () {
        smallMenu();

        window.onresize = function () {
            smallMenu();
        };
    });





</script>