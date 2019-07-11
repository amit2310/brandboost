    <script src = "https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript" src="http://www.chartjs.org/dist/2.7.2/Chart.bundle.js"></script>
    <script type="text/javascript" src="http://www.chartjs.org/samples/latest/utils.js"></script>
     
    <!-- /theme JS files -->
    <style>
    .highcharts-tick{stroke:none!important}
    .highcharts-legend, .highcharts-credits{display: none!important;}
    .highcharts-container, .highcharts-container svg {width: 100% !important;}
    #canvas, #canvas2{height: 250px!important;}
    
    </style>
    
                  <div class="content">
                  
                  <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
                    <div class="page_header">
                      <div class="row">
                      <!--=============Headings & Tabs menu==============-->
                        <div class="col-md-7">
                          <h3><img style="width: 16px;" src="/assets/images/refferal_icon.png"> New Referral Program</h3>
                          <?php $defalutTab = $setReferralTab; ?>
                          
                          <ul class="nav nav-tabs nav-tabs-bottom">
                            <li class="<?php
                            if ($defalutTab == 'config') {
                                echo 'active';
                            }
                            ?>"><a href="#right-icon-tab1" data-toggle="tab" class="tabChange" tabName="config">Configuration</a></li>

                            <li class="<?php
                            if ($defalutTab == 'reward') {
                                echo 'active';
                            }
                            ?>"><a href="#right-icon-tab2" data-toggle="tab" class="tabChange" tabName="reward">Reward Management</a></li>

                            <li class="<?php
                            if ($defalutTab == 'widgets') {
                                echo 'active';
                            }
                            ?>"><a href="#right-icon-tab3" data-toggle="tab" class="tabChange" tabName="widgets">Widgets</a></li>

                            <li class="<?php
                            if ($defalutTab == 'workflow') {
                                echo 'active';
                            }
                            ?>"><a href="#right-icon-tab4" data-toggle="tab" class="tabChange" tabName="workflow">Workflow</a></li>

                            <li class="<?php
                            if ($defalutTab == 'advocates') {
                                echo 'active';
                            }
                            ?>"><a href="#right-icon-tab5" data-toggle="tab" class="tabChange" tabName="advocates">Advocates</a></li>

                            <li class="<?php
                            if ($defalutTab == 'integrations') {
                                echo 'active';
                            }
                            ?>"><a href="#right-icon-tab6" data-toggle="tab" class="tabChange" tabName="integrations">Integration</a></li>

                        </ul>


                          <!-- <ul class="nav nav-tabs nav-tabs-bottom">
                            <li class="<?php
                            if ($defalutTab == 'config') {
                                echo 'active';
                            }
                            ?>"><a href="#right-icon-tab1" data-toggle="tab" class="tabChange" tabName="config">Configuration</a></li>

                            <li class="<?php
                            if ($defalutTab == 'reward') {
                                echo 'active';
                                $disableRemaining = true;
                            }
                            ?>"><a href="<?php
                                    if ($disableRemaining == false || $defalutTab == 'reward') {
                                        $bRewardTab = true;
                                        ?>#right-icon-tab2<?php } else { ?>javascript:void(0);<?php } ?>" data-toggle="tab" class="tabChange" tabName="reward">Reward Management</a></li>

                            <li class="<?php
                            if ($defalutTab == 'widgets') {
                                echo 'active';
                                $disableRemaining = true;
                            }
                            ?>"><a href="<?php
                                    if ($disableRemaining == false || $defalutTab == 'widgets') {
                                        $bWidgetTab = true;
                                        ?>#right-icon-tab3<?php } else { ?>javascript:void(0);<?php } ?>" data-toggle="tab" class="tabChange" tabName="widgets">Widgets</a></li>

                            <li class="<?php
                            if ($defalutTab == 'workflow') {
                                echo 'active';
                                $disableRemaining = true;
                            }
                            ?>"><a href="<?php
                                    if ($disableRemaining == false || $defalutTab == 'workflow') {
                                        $bWorkflowTab = true;
                                        ?>#right-icon-tab4<?php } else { ?>javascript:void(0);<?php } ?>" data-toggle="tab" class="tabChange" tabName="workflow">Workflow</a></li>

                            <li class="<?php
                            if ($defalutTab == 'advocates') {
                                echo 'active';
                                $disableRemaining = true;
                            }
                            ?>"><a href="<?php
                                    if ($disableRemaining == false || $defalutTab == 'advocates') {
                                        $bAdvocatesTab = true;
                                        ?>#right-icon-tab5<?php } else { ?>javascript:void(0);<?php } ?>" data-toggle="tab" class="tabChange" tabName="advocates">Advocates</a></li>

                            <li class="<?php
                            if ($defalutTab == 'integrations') {
                                echo 'active';
                                $disableRemaining = true;
                            }
                            ?>"><a href="<?php
                                    if ($disableRemaining == false || $defalutTab == 'integrations') {
                                        $bIntegrationTab = true;
                                        ?>#right-icon-tab6<?php } else { ?>javascript:void(0);<?php } ?>" data-toggle="tab" class="tabChange" tabName="integrations">Integration</a></li>

                        </ul> -->
                          
                        </div>
                        <!--=============Button Area Right Side==============-->
                        <div class="col-md-5 text-right btn_area">

                                <button type="button" class="btn light_btn bl_cust_btn btn-default importModuleContact" data-modulename="<?php echo $moduleName;?>" data-moduleaccountid="<?php echo $oReferral->hashcode; ?>" data-redirect="<?php echo base_url();?>admin/modules/referral/setup/<?php echo $oReferral->id; ?>"><i class="icon-arrow-up16"></i><span> &nbsp;  Import Advocates</span> </button> 

                                <a  href="<?php echo base_url() ?>admin/subscriber/exportSubscriberCSV?module_name=<?php echo $moduleName;?>&module_account_id=<?php echo $oReferral->hashcode; ?>" title="Export" class="btn light_btn ml10 bl_cust_btn btn-default"><i class="icon-arrow-down16"></i><span> &nbsp;  Export Advocates</span> </a>

                                 <button class="btn dark_btn dropdown-toggle ml10 addModuleContact" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $oReferral->hashcode; ?>" ><i class="icon-plus3 txt_green"></i><span> &nbsp; Invite Advocates </button>

                         </div>
                      </div>
                    </div>
                  <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->
                  
                  
                    <!--&&&&&&&&&&&& TABBED CONTENT START &&&&&&&&&&-->
                     <div class="tab-content"> 
                      <!--===========TAB 1=======Configuration====-->
                      
                      <?php $this->load->view("admin/modules/referral/referral-tabs/settings", array('userID' => $userID, 'defalutTab' => $defalutTab, 'programID' => $programID, 'oAccountSettings' => $oAccountSettings, 'oReferral' => $oReferral)); ?>
                      
                      <!--===========TAB 2======Reward Management=====-->
                        <?php //if ($bRewardTab == true): ?>
                            <?php $this->load->view("admin/modules/referral/referral-tabs/reward-setup", array('userID' => $userID, 'defalutTab' => $defalutTab, 'programID' => $programID, 'oSettings' => $oSettings, 'oAdvCouponCodes' => $oAdvCouponCodes, 'oRefCouponCodes' => $oRefCouponCodes)); ?>
                        <?php //endif; ?>
                     
                      <!--===========TAB 3====Workflow=======-->
                      <?php //if ($bWidgetTab == true): ?>
                            <?php $this->load->view("admin/modules/referral/referral-tabs/widget_code", array('userID' => $userID, 'defalutTab' => $defalutTab, 'programID' => $programID, 'oSettings' => $oSettings)); ?>
                      <?php //endif; ?>
                     
                      <!--===========TAB 4====Advocates=======-->
                      <?php //if ($bWorkflowTab == true): ?>
                        <?php $this->load->view("admin/modules/referral/referral-tabs/reward-workflow-beta", array('emailWorkflow' => $emailWorkflow, 'subscribersData' => $subscribersData, 'oEvents' => $oEvents)); ?>
                      <?php //endif; ?>
                     
                      <!--===========TAB 5=======Widgets====-->
                      <?php //if ($bAdvocatesTab == true): ?>
                        <?php $this->load->view("admin/modules/referral/referral-tabs/contacts", array('userID' => $userID, 'defalutTab' => $defalutTab, 'programID' => $programID, 'oSettings' => $oSettings, 'oContacts' => $oContacts)); ?>
                      <?php //endif; ?>
                    
                       <!--===========TAB 6======Integrations=====-->
                       <?php //if ($bIntegrationTab == true): ?>
                        <?php $this->load->view("admin/modules/referral/referral-tabs/integration", array('userID' => $userID, 'defalutTab' => $defalutTab, 'programID' => $programID, 'oSettings' => $oSettings)); ?>
                       <?php //endif; ?>
                      
                     </div>
                     <!--&&&&&&&&&&&& TABBED CONTENT  END &&&&&&&&&&-->
                    
                  </div>
                
        



<script>

    // top navigation fixed on scroll and side bar collasped
    
        $( window ).scroll( function () {
            var sc = $( window ).scrollTop();
            if ( sc > 100 ) {
                $( "#header-sroll" ).addClass( "small-header" );
            } else {
                $( "#header-sroll" ).removeClass( "small-header" );
            }
        } );

        function smallMenu() {
            if ( $( window ).width() < 1600 ) {
                $( 'body' ).addClass( 'sidebar-xs' );
            } else {
                $( 'body' ).removeClass( 'sidebar-xs' );
            }
        }

        $( document ).ready( function () {
            smallMenu();

            window.onresize = function () {
                smallMenu();
            };
        } );
    

    
    
    

    
    </script>
    
    
    

    <script>
    //Semi Circle chart js -- Highcharts js plugins
    
    
         $(document).ready(function() {
            var chart = {
               plotBackgroundColor: false,
               plotBorderWidth: 0,
               plotShadow: false
            };
            var title = {
               text: '83 <br> <span style="border: none;" class="label bkg_green ml0 ">15.9%</span>',
               align: 'center',
               verticalAlign: 'middle',
               y: 50      
            };  
             
              var title2 = {
               text: '52 <br> <span style="border: none;" class="label bkg_green ml0 ">22.9%</span>',
               align: 'center',
               verticalAlign: 'middle',
               y: 50      
            }; 
             
             
            var tooltip = {
               pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            };
            var plotOptions = {
               pie: {
                  dataLabels: {
                     enabled: false,
                     distance: -5550,
                     
                     style: {
                        fontWeight: 'bold',
                        color: 'white',
                        textShadow: '0px 1px 2px black'
                     }
                  },
                  startAngle: -90,
                  endAngle: 90,
                  center: ['50%', '75%']
               }
            };
            var series = [{
               type: 'pie',
               name: 'NPS',
               colors: ['#fd6c81', '#facfd7', '#8bbc21', '#910000'],
               innerSize: '85%',
               data: [
                  ['A',   83],
                  ['B',    17],
                
                  {
                     name: 'Others',
                     y: 0,
                     dataLabels: {
                        enabled: false
                     }
                  }
               ]
            }];  
             
             
             var series2 = [{
               type: 'pie',
               name: 'NPS',
               colors: ['#2eb4dd', '#d3eefa', '#8bbc21', '#910000'],
               innerSize: '85%',
               data: [
                  ['A',   52],
                  ['B',    48],
                
                  {
                     name: 'Others',
                     y: 0,
                     dataLabels: {
                        enabled: false
                     }
                  }
               ]
            }]; 
             
             
      
            var json = {};   
            json.chart = chart; 
            json.title = title;     
            json.tooltip = tooltip;  
            json.series = series;
            json.plotOptions = plotOptions;
            $('#semi_circle_chart').highcharts(json); 
             
             
            var json2 = {};   
            json2.chart = chart; 
            json2.title = title2;     
            json2.tooltip = tooltip;  
            json2.series = series2;
            json2.plotOptions = plotOptions;
            $('#semi_circle_chart2').highcharts(json2); 
             
             
             
             
            
        });
     
        
        var config2 = {
            type: 'line',
            data: {
                labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15"],
                datasets: [{
                    label: 'On Site Reviews Report',
                    backgroundColor: window.chartColors.blue,
                    borderColor: window.chartColors.blue,
                    data: [5, 6, 3, 5, 8, 3, 9, 11, 13, 15, 45, 33, 12, 35, 35],
                    fill: false,
                },
                          
                          {
                    label: 'On Site Reviews Report',
                    backgroundColor: window.chartColors.green,
                    borderColor: window.chartColors.green,
                    data: [12, 50, 3, 5, 22, 3, 12, 19, 3, 5, 45, 3, 12, 35, 3],
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    //stext: 'Chart.js Line Chart'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },

                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: false,
                        scaleLabel: {
                            display: false,
                            labelString: 'Value'
                        }
                    }]
                }
            }
        };
        
        
    
        
    

       /* window.onload = function() {
            
            
            var ctx2 = document.getElementById('canvas2').getContext('2d');
            window.myLine = new Chart(ctx2, config2);
        
        };*/

</script>





<!-- *********** Old  ************ -->
<?php /*?>
<style>
    b, strong {	font-weight: 500!important;}
    .radio, .checkbox{display: inline-block; margin-right: 30px;}
    .btn-info, .btn-info:hover, .btn-info:focus{	background: #2196F3; border: 1px solid #2196F3;}
    .form-wizard-count{border: 2px solid #2196F3; color:#2196F3;	}
    fieldset.step {	min-height: 300px; margin-bottom: 0px; padding: 20px 0!important;}
    .progressbar {	width: 100%;	position: absolute;	left: 0;	bottom: -5px;}
    .progress{border-radius: 0px; height: 6px;}
    .form-group{margin-bottom: 15px;}
    .form-wizard-title{border: none!important; display: none!important;}
    .panel-body{padding: 20px!important;}
    .panel-heading{border-bottom: 1px solid #f5f4f5;}
    .w50m0 .panel{ margin: 0;}
    .video_review{border: none; box-shadow: 0 0px 19px 0 rgba(0, 0, 0, 0.15); margin: 47px auto;}
    .right_content{max-width: 100%;}
    textarea.form-control{height: 60px;}
    .comm_text{float: left; display: inline-block; width: 190px; margin: 8px 0;}
    .checkbox.checkbox-switchery {margin-bottom: 0px!important;padding-left: 0!important;float: left!important;}



    .txt_inp_grp .input-circle {  border: 1px solid #cccccc;  border-radius: 5px!important; margin: 0 0 0 0px!important; width: 60px; z-index:0;}
    .txt_inp_grp select.camp {  -moz-appearance: none;  background: #dddddd none repeat scroll 0 0;  border: medium none;  border-radius: 5px; width: 120px; margin: 0 25px;}
    .txt_inp_grp p, .txt_inp_grp input, .txt_inp_grp select{display: inline-block;}
    .newactive{ display:inline-block; color:#fff; border-radius:4px; background-color: #4CAF50; padding:0.5px 10px 0.5px 10px; }
    .draft{ display:inline-block; color:#000; border-radius:4px; background-color: #e4e4e4; padding:0.5px 10px 0.5px 10px; }
    .inactive{ display:inline-block; color:#fff; border-radius:4px; background-color:#FF0000; padding:0.5px 10px 0.5px 10px; }
    .points{cursor: pointer;}
    .green {color: #ffffff !important;}
    .btn.green, .btn.green .fa {        color: #fff !important;    }
    .page-content-wrapper .page-content{max-width: 1350px;}
    .draft{padding: 6px 12px!important;}
    .eventDiv{margin-top:0px;}
    .updateevent{margin-top:0px!important; }
    .btn.green{background: #0190e6 !important; color: #fff!important; width: 100px!important;}
    .btn.red{background: #f30000  !important; color: #fff!important;}
    .btn.green_cust_btn{}
    .step_star ul > li.star > i.fa{font-size: 30px!important;}
    .video_review h4.review{margin: 23px 0!important;}
    .pl50{padding-left: 30px;}
    .pr50{padding-right: 30px;}
    .panel.blue_bkg{ box-shadow: none!important;border-left: none !important;border-right: none!important;margin: -1px -20px 0px; border-bottom: none!important;}


    .panel.blue_bkg .panel-body{padding: 0px 0!important;}
    .blue_bkg .panel-heading{border-bottom: 1px solid #f5f4f5!important; background: #f7fbfe!important;}
    .media-right.text-nowrap{padding-left: 10px!important;}
    .modal-lg {width: 1200px;}
    .wysihtml5-sandbox{width: 100%; max-width: 100%!important; height: 180px!important;}
    .bg-blue.btn-block{margin-top: 3px;}
    .media-heading.title{line-height: 20px;}

    .fa.fontimgicon {
        background: #ebf4fb;
        width: 30px;
        height: 30px;
        font-size: 14px!important;
        text-align: center;
        line-height: 28px;
        border-radius: 100px; color: #9cc5e8!important;
    }


    .media-right .btn-block{ margin-top: 25px!important; width:100px!important}
    .offsite.img-lg{width:60px!important; height: 60px!important; border-radius: 100%!important; }
    .grbtn{position: absolute; right:-40px; top: 0; z-index: 1;}
    hr{border-color: #eeeeee!important;}
    .content.offsite_feed{padding: 0!important; margin: 0 -20px!important;}
    .content.offsite_feed .panel.panel-flat{ border: none!important; box-shadow: none!important;}
    .editable-buttons .btn.btn-primary{ background: #fff!important; border: 1px solid #2196f3!important; color: #2196f3!important; cursor: pointer;}
    .editable-buttons .btn.btn-primary:hover{background: #2196f3!important; color: #fff!important;}
    .editable-buttons .btn.btn-default{ background: #fff!important; border: 1px solid #f30000!important; color: #f30000 !important; cursor: pointer;}
    .editable-buttons .btn.btn-default:hover{background: #f30000 !important; color: #fff!important;}
    .media-right.text-nowrap .bl_cust_btn:focus{background: #2196f3!important; color: #fff!important;}
    .media-right.text-nowrap .red_cust_btn:focus{background: #f30000 !important; color: #fff!important;}
    select.daysnumber{position: absolute; top: -8px; left: 200px!important; width: 85px;}
    input.daysnumber2{position: absolute; top: -8px; left: 115px!important; width: 70px;}
    .dropzone .dz-default.dz-message::before {font-size: 50px;top: 70px;}
    .dropzone .dz-default.dz-message span {margin-top: 115px;}
    .tabReviews{padding: 0 0 60px 0!important; margin: 0 -20px!important;}
    .tabReviews .datatable-footer, .tabReviews .datatable-header{padding:20px 20px 0!important;}
    .tabReviews .panel{box-shadow: none!important; border: none!important;}
    p.emaildata{width: 100%; display: block;  margin: 2px 0; line-height: 17px;}
    p.emaildata strong{ float: left; width: 75px; display: block; font-weight: 600!important;}
    p.emaildata span{font-size: 11px!important;}
    p.emaildata.inner strong{ font-weight: 400!important; font-size: 12px!important;}

    .emaildata_top p{font-weight: 500!important; font-size: 13px;}
    .tab-pane p{ font-size: 16px;}

    .highlighted { color:#008000;font-size:15px !important;}
</style>
<?php
$disableRemaining = false;
$rewards = '';
$emailWorkflow = '';
$campaign = '';
$reviews = '';
$integrationClass = '';
if ($setTab == 'Review Sources' || $selectedTab == 'Review Sources') {
    $rs = 'active';
} else if ($setTab == 'Campaign Preferences' || $selectedTab == 'Campaign Preferences') {
    $camp = 'active';
} else if (trim($setTab) == 'Rewards & Gifts' || $selectedTab == 'Rewards & Gifts') {
    $rewards = 'active';
} else if (trim($setTab) == 'Configure Widgets' || $selectedTab == 'Configure Widgets') {
    $setupClass = 'active';
} else if (trim($setTab) == 'Email Workflow' || $selectedTab == 'Email Workflow') {
    $emailWorkflow = 'active';
} else if (trim($setTab) == 'Clients' || $selectedTab == 'Clients') {
    $campaign = 'active';
} else if (trim($setTab) == 'Reviews' || $selectedTab == 'Reviews') {
    $reviews = 'active';
} else if (trim($setTab) == 'Integration' || $selectedTab == 'Integration') {
    $integrationClass = 'active';
} else if (trim($setTab) == 'Image' || $selectedTab == 'Image') {
    $imageClass = 'active';
} else if (trim($setTab) == 'Video' || $selectedTab == 'Video') {
    $videoClass = 'active';
} else {
    $rs = 'active';
}
?>
<div class="content">
    <div class="row mb20">

        <div class="col-lg-12 text-right">


            <button class="btn bl_cust_btn btn-default addModuleContact" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $oReferral->hashcode; ?>" style="margin-left:12px;"><i class="icon-make-group position-left"></i> INVITE ADVOCATES </button>

            <button type="button" class="btn bl_cust_btn btn-default importModuleContact" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $oReferral->hashcode; ?>" data-redirect="<?php echo base_url(); ?>admin/modules/referral/setup/<?php echo $oReferral->id; ?>" style="margin-left:12px;"><i class="icon-make-group position-left"></i> ADVOCATES IMPORT</button> 

            <a title="Export" class="btn bl_cust_btn btn-default" id="exportButton" href="<?php echo base_url() ?>admin/subscriber/exportSubscriberCSV?module_name=<?php echo $moduleName; ?>&module_account_id=<?php echo $oReferral->hashcode; ?>"><i class="icon-make-group position-left"></i> ADVOCATE EXPORT</a>



        </div>
    </div> 
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Referral Module Setup</h6>
                </div>
                <div class="panel-body">
                    <div class="tabbable">
                        <ul class="nav nav-tabs nav-tabs-bottom" id="nav-tabs-bottom">
                            <li class="<?php
                            if ($defalutTab == 'config') {
                                echo 'active';
                            }
                            ?>"><a href="#right-icon-tab1" data-toggle="tab"><i class="fa fa-cog position-left"></i> Configuration</a></li>

                            <li class="<?php
                            if ($defalutTab == 'reward') {
                                echo 'active';
                                $disableRemaining = true;
                            }
                            ?>"><a href="<?php
                                    if ($disableRemaining == false || $defalutTab == 'reward') {
                                        $bRewardTab = true;
                                        ?>#right-icon-tab2<?php } else { ?>javascript:void(0);<?php } ?>" data-toggle="tab"><i class="icon-gift position-left"></i> Reward Management</a></li>

                            <li class="<?php
                            if ($defalutTab == 'widgets') {
                                echo 'active';
                                $disableRemaining = true;
                            }
                            ?>"><a href="<?php
                                    if ($disableRemaining == false || $defalutTab == 'widgets') {
                                        $bWidgetTab = true;
                                        ?>#right-icon-tab3<?php } else { ?>javascript:void(0);<?php } ?>" data-toggle="tab"><i class="icon-pushpin position-left"></i> Widgets</a></li>

                            <li class="<?php
                            if ($defalutTab == 'workflow') {
                                echo 'active';
                                $disableRemaining = true;
                            }
                            ?>"><a href="<?php
                                    if ($disableRemaining == false || $defalutTab == 'workflow') {
                                        $bWorkflowTab = true;
                                        ?>#right-icon-tab4<?php } else { ?>javascript:void(0);<?php } ?>" data-toggle="tab"><i class="icon-mention position-left"></i> Email Workflow</a></li>

                            <li class="<?php
                            if ($defalutTab == 'advocates') {
                                echo 'active';
                                $disableRemaining = true;
                            }
                            ?>"><a href="<?php
                                    if ($disableRemaining == false || $defalutTab == 'advocates') {
                                        $bAdvocatesTab = true;
                                        ?>#right-icon-tab5<?php } else { ?>javascript:void(0);<?php } ?>" data-toggle="tab"><i class="icon-address-book position-left"></i> Advocates</a></li>

                            <li class="<?php
                            if ($defalutTab == 'integrations') {
                                echo 'active';
                                $disableRemaining = true;
                            }
                            ?>"><a href="<?php
                                    if ($disableRemaining == false || $defalutTab == 'integrations') {
                                        $bIntegrationTab = true;
                                        ?>#right-icon-tab6<?php } else { ?>javascript:void(0);<?php } ?>" data-toggle="tab"><i class="icon-puzzle4 position-left"></i> Integration</a></li>



                        </ul>
                        <div class="tab-content">
                            <!--########################TAB 1 ##########################-->
                            <?php //$this->load->view("admin/modules/referral/referral-tabs/settings", array('userID' => $userID, 'defalutTab' => $defalutTab, 'programID' => $programID, 'oAccountSettings' => $oAccountSettings)); ?>
                            <!--########################TAB 2 ##########################-->
                            <?php //if ($bRewardTab == true): ?>
                                <?php //$this->load->view("admin/modules/referral/referral-tabs/reward-setup", array('userID' => $userID, 'defalutTab' => $defalutTab, 'programID' => $programID, 'oSettings' => $oSettings, 'oAdvCouponCodes' => $oAdvCouponCodes, 'oRefCouponCodes' => $oRefCouponCodes)); ?>
                            <?php //endif; ?>
                            <!--########################TAB 3 ##########################-->
                            <?php //if ($bWidgetTab == true): ?>
                                <?php //$this->load->view("admin/modules/referral/referral-tabs/widget_code", array('userID' => $userID, 'defalutTab' => $defalutTab, 'programID' => $programID, 'oSettings' => $oSettings)); ?>
                            <?php //endif; ?>
                            <!--########################TAB 4 ##########################-->
                            <?php //if ($bWorkflowTab == true): ?>
                                <?php //$this->load->view("admin/modules/referral/referral-tabs/reward-workflow-beta", array('emailWorkflow' => $emailWorkflow, 'subscribersData' => $subscribersData, 'oEvents' => $oEvents)); ?>
                            <?php //endif; ?>
                            <!--########################TAB 5 ##########################--> 
                            <?php //if ($bAdvocatesTab == true): ?>
                                <?php //$this->load->view("admin/modules/referral/referral-tabs/contacts", array('userID' => $userID, 'defalutTab' => $defalutTab, 'programID' => $programID, 'oSettings' => $oSettings, 'oContacts' => $oContacts)); ?>
                            <?php //endif; ?>
                            <!--########################TAB 6 ##########################--> 
                            <?php //if ($bIntegrationTab == true): ?>
                                <?php //$this->load->view("admin/modules/referral/referral-tabs/integration", array('userID' => $userID, 'defalutTab' => $defalutTab, 'programID' => $programID, 'oSettings' => $oSettings)); ?>
                            <?php //endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php */ ?>
<?php $this->load->view("admin/modals/workflow/workflow-popup", array('oDefaultTemplates' => $oDefaultTemplates)); ?>
<div id="addSubscriber" class="modal fade">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-user"></i>&nbsp; Contacts</h5>
            </div>
            <div class="modal-body">
                <div class="panel-body">

                    <form name="frmInviteCustomer" id="frmInviteCustomer" method="post" action="" >
                        <input type="hidden" name="userid" value="<?php echo $userID; ?>" />
                        <input type="hidden" name="bbaid" value="<?php echo $oSettings->hashcode; ?>" />
                        <div class="col-md-12">

                            <div class="form-group">
                                <label class="control-label">First Name</label>
                                <div class="">
                                    <input name="firstname" id="firstname" class="form-control" type="text" required="">
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="control-label">Last Name</label>
                                <div class="">
                                    <input name="lastname" id="lastname" class="form-control" value="" type="text" required="">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <div class="">
                                    <input name="email" id="email" value="" class="form-control" type="text" required="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Phone</label>
                                <div class="">
                                    <input name="phone" id="phone" value="" class="form-control" type="text">
                                </div>
                            </div>

                            <button class="btn btn-success pull-right" id="btnInvite" type="submit">
                                Invite Advocates
                            </button>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<div id="importCSV" class="modal fade">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-user"></i>&nbsp; Invite via Import</h5>
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    <form name="frmInviteBulkCustomer" id="frmInviteBulkCustomer"  method="post" action="" enctype="multipart/form-data" >
                        <input type="hidden" name="userid" value="<?php echo $userID; ?>" />
                        <input type="hidden" name="bbaid" value="<?php echo $oSettings->hashcode; ?>" />

                        <div class="col-md-8">
                            <strong> Upload a CSV file with customer contact details </strong> <br>
                            -Column 1 should be EMAIL<br>
                            -Column 2 should be FIRST_NAME<br>
                            Column 3 should be LAST_NAME<br>
                            Column 4 should be PHONE<br>                            

                        </div>

                        <div class="col-md-4">
                            <div class="fileupload">
                                <input type="file" name="userfile" id="ctrBrowse" accept=".csv, application/vnd.ms-excel" style="position:relative;top:50px;" />
                            </div>

                        </div>

                        <div class="clearfix"></div>

                        <button class="btn btn-success pull-right" id="btnBulkInvite" type="submit">
                            Import Advocates
                        </button>



                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {


        $(document).on('click', '.tabChange', function() {
            var tabName = $(this).attr('tabName');

            /*if (tabName == 'Reviews') {
                $('.reviewShow').removeClass('hidden');
            }
            else {
                $('.reviewShow').addClass('hidden');
            }
            if (tabName == 'Clients') {
                $('.contactShow').removeClass('hidden');
            }
            else {
                $('.contactShow').addClass('hidden');
            }*/
            changeTabWithoutReload(tabName);
        });



        $("#frmInviteCustomer").submit(function () {

            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $('#btnInvite').prop("disabled", true);
            $.ajax({
                url: '<?php echo base_url('admin/modules/referral/registerInvite'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    $('.overlaynew').hide();
                    if (data.status == 'success') {
                        window.location.href = window.location.href;
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
            return false;
        });

       $(document).on("click", "#publishNPSCampaign", function () {
            $.ajax({
                url: '<?php echo base_url('admin/modules/referral/publishReferralCampaign'); ?>',
                type: "POST",
                data: {'referralId': '<?php echo $programID; ?>'},
                dataType: "html",
                success: function (data) {
                    window.location.href = '<?php echo base_url("/admin/modules/referral/") ?>';
                }, error: function () {
                    alertMessage('Error: Some thing wrong!');
                }
            });
        });

        $("#frmInviteBulkCustomer").submit(function () {

            $('.overlaynew').show();

            var formData = new FormData($(this)[0]);


            $.ajax({
                url: '<?php echo base_url('admin/modules/referral/importInviteCSV'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {

                        alertMessageAndRedirect('Advocated has been invited successfully.', window.location.href);

                    } else {

                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
            return false;
        });


    });

    function changeTabWithoutReload(getActiveText) {
        $.ajax({
            url: "<?php echo base_url('/admin/modules/referral/setTab'); ?>",
            type: "POST",
            data: {getActiveText: getActiveText},
            dataType: "json",
            success: function (response) {
                //window.location.href = window.location.href;
            },
            error: function (response) {
                alertMessage("Something went wrong");
            }
        });
    }

</script>	




