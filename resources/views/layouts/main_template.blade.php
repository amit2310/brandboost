<!DOCTYPE html>
<html>

    <head>

        <title>@yield('title') - Brand Boost</title>

        @include('layouts.main_partials._main_favicon')

        @include('layouts.main_partials._main_head')

        @include('layouts.main_partials._main_css')

        @include('layouts.main_partials._main_js')

    </head>


    <body class="<?php echo $pageColor; ?>_body">
        <span class="userStillLogged">
            <div class="overlaynew" style="position: fixed;width: 100%;height: 100%;background-color: rgba(0, 0, 0, 0.4); z-index: 99999;text-align: center; display:none;">
                <div style="top: 47%;position:relative;">
                    <a class="bg-teal-400" id="spinner-dark-6">
                        <div class="ball-scale-multiple">
                            <div></div>
                            <div></div>
                            <div></div>
                        </div><br> PROCESSING</a>
                </div>
            </div>


            <!--===================TOP SECTION START================-->
            @include('layouts.main_partials._main_topmenu')
            <!--===================TOP SECTION END================-->


            <!-- Page container -->
            <div class="page-container">

                <!-- Page content -->
                <div class="page-content">
                    <!-- Main content -->

                    <div class="content-wrapper <?php echo $pageColor; ?>">
                        <?php echo $contents; ?>
                        @yield('contents')
                    </div>
                    <!-- /main content -->
                </div>
                <!-- /page content -->
            </div>
            <!-- /page container -->


            @include('layouts.main_partials._main_modals')
        </span>
        

        <?php $this->load->view('admin/components/smart-popup/smart-notification-widget.php'); ?>

        <?php $this->load->view("admin/modals/upgrade/upgrade_membership.php", array('oMemberships' => $objMembership, 'oSuggestedPlan' => $oUpgradePlanData, 'additionalPriceToPay' => $additionalPriceToPay, 'oCurrentPlanData' => $oCurrentPlanData, 'oUser' => $aUInfo)); ?>
        
        @include('layouts.main_partials._main_footer_js')
        
    </body>



</html> 

