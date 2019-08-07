   @extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')
    <script src = "https://code.highcharts.com/highcharts.js"></script>
    <style>
    .highcharts-tick{stroke:none!important}
    .highcharts-legend, .highcharts-credits{display: none!important;}
    .highcharts-container, .highcharts-container svg {width: 100% !important;}
		.ratings .inner {
	margin-bottom: 17px;
}
    </style>

  <div class="content">
  
  <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
      <div class="row">
      <!--=============Headings & Tabs menu==============-->
        <div class="col-md-7">
          <h3><img style="width: 16px;" src="<?php echo base_url(); ?>assets/images/analysis_icon.png"> Reviews Report</h3>
          <ul class="nav nav-tabs nav-tabs-bottom">
            <li class="active"><a href="#right-icon-tab0" data-toggle="tab">Today</a></li>
            <li><a href="#right-icon-tab1" data-toggle="tab">Yesterday</a></li>
            <li><a href="#right-icon-tab2" data-toggle="tab">Week</a></li>
            <li><a href="#right-icon-tab3" data-toggle="tab">Month</a></li>
            <li><a href="#right-icon-tab4" data-toggle="tab">3 Month</a></li>
          </ul>
          
        </div>
        <!--=============Button Area Right Side==============-->
        <div class="col-md-5 text-right btn_area">
         <div class="btn-group">
                    <button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-calendar2"></i>&nbsp; &nbsp; Filter reports &nbsp; &nbsp; <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu dropdown-content width-320 dropdown-menu-right">
                      <div class="dropdown-content-heading"> Filter
                        <ul class="icons-list">
                          <li><a href="#"><i class="icon-more"></i></a> </li>
                        </ul>
                      </div>
                      <div class="">
                        <div class="panel-group panel-group-control panel-group-control-right content-group-lg filter_campaign" id="accordion-control-right">
                          <div class="panel panel-white">
                            <div class="panel-heading sidebarheadings active">
                              <h6 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group1"><i class="icon-star-empty3"></i>&nbsp;Campaign Type</a> </h6>
                            </div>
                            <div id="accordion-control-right-group1" class="panel-collapse collapse">
                              <div class="panel-body">
                                <div class="row">
                                  <div class="col-md-12"> 
                        Most startups fail. But many of those failures are preventable. The Lean Startup is a new approach being adopted across the globe, changing the way companies are built and new products are launched.
                         </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-white">
                            <div class="panel-heading sidebarheadings">
                              <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group2"><i class="icon-arrow-up-left2"></i>&nbsp; Source</a> </h6>
                            </div>
                            <div id="accordion-control-right-group2" class="panel-collapse collapse">
                              <div class="panel-body">
                                <div class="row">
                                  <div class="col-md-12"> Conetent Goes here... </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-white">
                            <div class="panel-heading sidebarheadings">
                              <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group73"><i class="icon-star-full2"></i>&nbsp; Rating</a> </h6>
                            </div>
                            <div id="accordion-control-right-group73" class="panel-collapse collapse">
                              <div class="panel-body">
                                <div class="row">
                                  <div class="col-md-12"> Conetent Goes here... </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-white">
                            <div class="panel-heading sidebarheadings">
                              <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group74"><i class="icon-calendar"></i>&nbsp; Date Created</a> </h6>
                            </div>
                            <div id="accordion-control-right-group74" class="panel-collapse collapse">
                              <div class="panel-body">
                                <div class="row">
                                  <div class="col-md-12"> Conetent Goes here... </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-white">
                            <div class="panel-heading sidebarheadings">
                              <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group83"><i class="icon-thumbs-up2"></i>&nbsp; Reviews</a> </h6>
                            </div>
                            <div id="accordion-control-right-group83" class="panel-collapse collapse in">
                              <div class="panel-body">
                                <div class="row mb20">
                                  <div class="col-xs-6">
                                  <div class="checkbox">
                                  <label>
                                    <input type="checkbox"  class="control-primary" checked="checked">
                                    Total Reviews
                                    </label>
                                    </div>
                                  </div>
                                  <div class="col-xs-6">
                                  <input class="form-control input-sm" type="text" name="" value="20" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" />
                                  </div>

                                </div>
                                <div class="row mb20">
                                  <div class="col-xs-6">
                                  <div class="checkbox">
                                  <label>
                                    <input type="checkbox"  class="control-primary" checked="checked">
                                    Positive
                                    </label>
                                    </div>
                                  </div>
                                  <div class="col-xs-6">
                                  <input class="form-control input-sm" type="text" name="" value="20" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" />
                                  </div>

                                </div>
                                <div class="row mb20">
                                  <div class="col-xs-6">
                                  <div class="checkbox">
                                  <label>
                                    <input type="checkbox"  class="control-primary">
                                    Neutral
                                    </label>
                                    </div>
                                  </div>
                                  <div class="col-xs-6">
                                  <input class="form-control input-sm" type="text" name="" value="20" disabled /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" disabled />
                                  </div>

                                </div>
                                <div class="row">
                                  <div class="col-xs-6">
                                  <div class="checkbox">
                                  <label>
                                    <input type="checkbox"  class="control-primary" checked="checked">
                                    Negative
                                    </label>
                                    </div>
                                  </div>
                                  <div class="col-xs-6">
                                  <input class="form-control input-sm" type="text" name="" value="0" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="10" />
                                  </div>

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-content-footer">
                        <button type="button" class="btn dark_btn dropdown-toggle" style="display: inline-block;"><i class="icon-filter4"></i><span> &nbsp;  Filter</span> </button>
                        &nbsp; &nbsp;
                        <a style="display: inline-block;" href="#">Clear All</a>
                      </div>
                    </div>
                </div>
         </div>
      </div>
    </div>
  <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->
  
  
    <!--&&&&&&&&&&&& TABBED CONTENT START &&&&&&&&&&-->
     <div class="tab-content"> 
      <!--===========TAB 1===========-->
      <div class="tab-pane active" id="right-icon-tab0">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-flat review_ratings">
              <div class="panel-heading">
                <h6 class="panel-title">Review Ratings<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
                <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
              </div>
              <div class="panel-body p0 bkg_white">
              <div class="pt20 pb20 pl40 pr40 bbot">
                <h1><i class="icon-star-full2"></i> 4.2 <sup><i class="icon-arrow-up5"></i> &nbsp; +15%</sup></h1>
              </div>
              <div class="p40 ratings">
                <div class="row inner">
                    <div class="col-xs-6">
                        <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> 
                    </div>
                    <div class="col-xs-6 text-right"><p>24% <span>5</span></p></div>
                <div class="col-xs-12">
                    <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40" style="width:40%"></div>
                    </div>
                    </div>
                </div>
                <div class="row inner">
                    <div class="col-xs-6">
                        <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> 
                    </div>
                    <div class="col-xs-6 text-right"><p>61% <span>17</span></p></div>
                <div class="col-xs-12">
                    <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="70" style="width:70%"></div>
                    </div>
                    </div>
                </div>
                <div class="row inner">
                    <div class="col-xs-6">
                        <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> 
                    </div>
                    <div class="col-xs-6 text-right"><p>3% <span>1</span></p></div>
                <div class="col-xs-12">
                    <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="10" style="width:20%"></div>
                    </div>
                    </div>
                </div>
                <div class="row inner">
                    <div class="col-xs-6">
                        <i class="icon-star-full2"></i> <i class="icon-star-full2"></i>  
                    </div>
                    <div class="col-xs-6 text-right"><p>0% <span>0</span></p></div>
                <div class="col-xs-12">
                    <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="10" style="width:10%"></div>
                    </div>
                    </div>
                </div>
                <div class="row inner mb0">
                    <div class="col-xs-6">
                        <i class="icon-star-full2"></i>   
                    </div>
                    <div class="col-xs-6 text-right"><p>0% <span>0</span></p></div>
                <div class="col-xs-12">
                    <div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="10" style="width:10%"></div>
                    </div>
                    </div>
                </div>
                
                
                </div>
              </div>
            </div>
                
                        <div class="panel panel-flat">
              <div class="panel-heading">
                <h6 class="panel-title">Positive Reviews</h6>
                <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
              </div>
              <div class="panel-body p30">
              <div class="row">
                <div class="col-xs-6">
                    <div class="topchart_value">
                <div class="row">
                    <div class="col-xs-5">
                    <img class="" width="43" src="<?php echo base_url(); ?>assets/images/smiley_green.png"/>
                    </div>
                    <div class="col-xs-6">
                    <h1 class="m0 lh25">69</h1>
                    <p><span style="border: none;" class="label bkg_green ml0 ">75.9%</span></p>
                    </div>
                </div>
              </div>
                </div>
                <div class="col-xs-6">
                    <img src="<?php echo base_url(); ?>assets/images/green_small_graph.png"/>
                </div>
              </div>
                
              </div>
            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-flat">
                          <div class="panel-heading">
                            <h6 class="panel-title">Product Feedback Received</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                          </div>
                          <div class="panel-body p0 pb10" >
                          <div class="semi_circle_smiley"><img src="<?php echo base_url(); ?>assets/images/smiley_green.png"/></div>
                            <div id = "semi_circle_chart" class="br5" style = "width: 100%; height: 240px; "></div>
                          </div>
                        </div>
                        
                        <div class="panel panel-flat">
                          <div class="panel-heading">
                            <h6 class="panel-title">Product Warnings</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                          </div>
                          <div class="panel-body p0 pb10" >
                          <div class="semi_circle_smiley"><img src="<?php echo base_url(); ?>assets/images/yellow_info.png"/></div>
                            <div id = "semi_circle_chart2" class="br5 bkg_gradient" style = "width: 100%; height: 240px;"></div>
                          </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-flat">
              <div class="panel-heading">
                <h6 class="panel-title">Negative Reviews</h6>
                <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
              </div>
              <div class="panel-body p30">
              <div class="row">
                <div class="col-xs-6">
                    <div class="topchart_value">
                <div class="row">
                    <div class="col-xs-5">
                    <img class="" width="43" src="<?php echo base_url(); ?>assets/images/smiley_red.png"/>
                    </div>
                    <div class="col-xs-7">
                    <h1 class="m0 lh25">31</h1>
                    <p><span style="border: none;" class="label bkg_red ml0 ">15.9%</span></p>
                    </div>
                </div>
              </div>
                </div>
                <div class="col-xs-6">
                    <img src="<?php echo base_url(); ?>assets/images/graph5_1.png"/>
                </div>
              </div>
                
              </div>
            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-flat">
              <div class="panel-heading">
                <h6 class="panel-title">Neurtal Reviews</h6>
                <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
              </div>
              <div class="panel-body p30">
              <div class="row">
                <div class="col-xs-6">
                    <div class="topchart_value">
                <div class="row">
                    <div class="col-xs-5">
                    <img class="" width="43" src="<?php echo base_url(); ?>assets/images/smiley_grey_neutral.png"/>
                    </div>
                    <div class="col-xs-7">
                    <h1 class="m0 lh25">31</h1>
                    <p><span style="border: none;" class="label bkg_green ml0 ">15.9%</span></p>
                    </div>
                </div>
              </div>
                </div>
                <div class="col-xs-6">
                    <img src="<?php echo base_url(); ?>assets/images/graph_small_grey.png"/>
                </div>
              </div>
                
              </div>
            </div>
                    </div>
                    <div class="col-md-12">
                    <div class="panel panel-flat">
              <div class="panel-heading">
                <h6 class="panel-title">Reviews Requests</h6>
                <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
              </div>
              <div class="panel-body p20 pb0 bkg_white">
              <div id="column_graph" style="height: 367px;"></div>
              </div>
            </div>
                    
                    
                    
                    
                        
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-flat">
              <div class="panel-heading">
                <h6 class="panel-title">Montly Reviews Report</h6>
                <div class="heading-elements">
								<div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
														<input class="form-control input-sm" placeholder="Search by name" type="text">
														<div class="form-control-feedback">
															<i class="icon-search4"></i>
														</div>
													</div>
													<div class="table_action_tool">
														<a href="#"><i class="icon-calendar52"></i></a>
														<a href="#"><i class="icon-arrow-down16"></i></a>
														<a href="#"><i class="icon-arrow-up16"></i></a>
														<a href="#"><i class="icon-pencil"></i></a>
													</div>
													
								</div>
              </div>
              <div class="panel-body p0">
<table class="table datatable-basic">
  <thead>
    <tr>
      <th style="display: none;"></th>
      <th style="display: none;"></th>
      <th><i class="icon-calendar"></i>Date</th>
      <th>Total</th>
      <th><i class="fa fa-smile-o"></i>5</th>
      <th><i class="fa fa-smile-o"></i>4</th>
      <th><i class="fa fa-smile-o"></i>3</th>
      <th><i class="fa fa-smile-o"></i>2</th>
      <th><i class="fa fa-smile-o"></i>1</th>
      <th><i class="icon-stats-growth2"></i>Stats</th>
      <th>&nbsp;</th>
    </tr>
  </thead>
  <tbody>
    
    <!--================================================-->

    <?php 
        foreach($aData['bbStatsData'] as $bbData){ 
            $ratingOne = 0;
            $ratingTwo = 0;
            $ratingThree = 0;
            $ratingFour = 0;
            $ratingFive = 0;
            $bbReportData = getBBReportStats(date('Y-m-d', strtotime($bbData->created)));
            foreach($bbReportData as $statsData){
                if($statsData->ratings == 1){
                    $ratingOne = $ratingOne + 1;
                }
                if($statsData->ratings == 2){
                    $ratingTwo = $ratingTwo + 1;
                }
                if($statsData->ratings == 3){
                    $ratingThree = $ratingThree + 1;
                }
                if($statsData->ratings == 4){
                    $ratingFour = $ratingFour + 1;
                }
                if($statsData->ratings == 5){
                    $ratingFive = $ratingFive + 1;
                }
            }

            if($ratingFive > 0 ) {
                $totRatingFive = $ratingFive * 5;
            }
            else {
                $totRatingFive = 0;
            }

            if($ratingFour > 0 ) {
                $totalRatingFour = $ratingFour * 4;
            }
            else {
                $totalRatingFour = 0;
            }

            if($ratingThree > 0 ) {
                $totalRatingThree = $ratingThree * 3;
            }
            else {
                $totalRatingThree = 0;
            }

            if($ratingTwo > 0 ) {
                $totalRatingTwo = $ratingTwo * 2;
            }
            else {
                $totalRatingTwo = 0;
            }

            if($ratingOne > 0 ) {
                $totalRatingOne = $ratingOne * 1;
            }
            else {
                $totalRatingOne = 0;
            }

            $totalRatingSum = $totRatingFive + $totalRatingFour + $totalRatingThree + $totalRatingTwo + $totalRatingOne;

            if($bbData->totalNo > 0) {
                $totSum = $bbData->totalNo * 5;
            }
        
            $per = ($totalRatingSum / $totSum)* 100;

            if($per >= 70) {
                $imgUrl =  base_url().'assets/images/smiley_green.png';
            }
            else if( $per >= 40 ) {
                $imgUrl =  base_url().'assets/images/smiley_grey2.png';
            }
            else {
                $imgUrl =  base_url().'assets/images/smiley_red.png';
            }
        ?>

        <tr>
          <td style="display: none;"></td>
          <td style="display: none;"><?php echo strtotime($bbData->created); ?></td>
          <td><div class="media-left media-middle"> <a class="icons" href="#"><img src="<?php echo $imgUrl; ?>" class="img-circle img-xs" alt=""></a> </div>
            <div class="media-left">
              <div class="pt-5"><a href="#" class="text-default txt_dgrey text-semibold"><?php echo date('d M Y', strtotime($bbData->created)); ?></a> </div>
            </div></td>
          <td><span class="txt_dgrey"><?php echo $bbData->totalNo; ?></span></td>
          <td><span class="txt_green"><img src="<?php echo base_url(); ?>assets/images/progress_green2.png"/> <?php echo $ratingFive; ?></span></td>
          <td><span class="txt_green"><img src="<?php echo base_url(); ?>assets/images/progress_green2.png"/> <?php echo $ratingFour; ?></span></td>
          <td><span class="txt_dgrey"><img src="<?php echo base_url(); ?>assets/images/progress_grey.png"/> <?php echo $ratingThree; ?></span></td>
          <td><span class="txt_red"><img src="<?php echo base_url(); ?>assets/images/progress_red.png"/> <?php echo $ratingTwo; ?></span></td>
          <td><span class="txt_red"><img src="<?php echo base_url(); ?>assets/images/progress_red.png"/> <?php echo $ratingOne; ?></span></td>
          <td><img width="170" src="<?php echo base_url(); ?>assets/images/table_graph.png"/></td>
          <td class="text-right"><button class="btn btn-xs btn_white_table pr10 pl10 view_review_btn"><i class="icon-stats-growth2"></i>View Reviews</button></td>
        </tr>
    <?php } ?>

    <!-- smiley_red  smiley_green smiley_grey2 -->
    
    <!--================================================-->
   
  </tbody>
</table>
              </div>
            </div>
          </div>
        </div>
        
      </div>
      <!--===========TAB 2===========-->
      <div class="tab-pane" id="right-icon-tab1"> </div>
      <!--===========TAB 3====Preferences=======-->
      <div class="tab-pane" id="right-icon-tab2"> </div>
      <!--===========TAB 4====Chat Widget=======-->
      <div class="tab-pane" id="right-icon-tab3"> </div>
      <!--===========TAB 5===========-->
      <div class="tab-pane" id="right-icon-tab4"> </div>
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
               colors: ['#5ad491', '#c8eedb', '#8bbc21', '#910000'],
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
             
             
             var series2 = [{
               type: 'pie',
               name: 'NPS',
               colors: ['#ffa04f', '#fce6ce', '#8bbc21', '#910000'],
               innerSize: '85%',
               data: [
                  ['A',   19],
                  ['B',    81],
                
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
      </script>
    
    
    
<script>
    Highcharts.chart('column_graph', {
    chart: {
        type: 'column'
    },
        title: {
        text: null
    },
    subtitle: {
        text: null
    },
    
    colors: ['#9b83ff', '#ded6fd', '#8bbc21', '#910000'],
        
    credits: {
    enabled: false
    },
        
        
  
    xAxis: {
        categories: [
            '1',
            '2',
            '3',
            '4',
            '5',
            '6',
            '7',
            '8',
            '9',
            '10',
            '11',
            '12'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        uniqueNames: false,
        title: {
            text: null
        }
    },
    

    plotOptions: {
        column: {
            pointPadding: 0.10,
            borderWidth: 0,
            borderRadius: 5
        }
    },
    series: [{
        name: 'A',
        data: [49.9, 31.5, 26.4, 19.2, 24.0, 36.0, 45.6, 48.5, 16.4, 14.1, 45.6, 24.4]

    }, {
        name: 'B',
        data: [43.6, 48.8, 38.5, 23.4, 26.0, 44.5, 35.0, 14.3, 21.2, 33.5, 46.6, 12.3]

    }]
});
        
    

    </script>


<?php /* ?>
<div class="content ">


	<!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-3">
                <h3><i class="icon-star-half"></i> &nbsp; Report</h3>
               
            </div>
            <!--=============Button Area Right Side==============-->
              <div class="col-md-9 text-right btn_area">
                <div class="btn-group">
                    <button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-calendar2"></i>&nbsp; &nbsp; Filter Reports &nbsp; &nbsp; <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu dropdown-content width-320 dropdown-menu-right">
                        <div class="dropdown-content-heading"> Filter
                            <ul class="icons-list">
                                <li><a href="#"><i class="icon-more"></i></a> </li>
                            </ul>
                        </div>
                        <div class="">
                            <div class="panel-group panel-group-control panel-group-control-right content-group-lg filter_campaign" id="accordion-control-right">
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings active">
                                        <h6 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group1"><i class="icon-star-empty3"></i>&nbsp;Campaign Type</a> </h6>
                                    </div>
                                    <div id="accordion-control-right-group1" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12"> 
                                                    Most startups fail. But many of those failures are preventable. The Lean Startup is a new approach being adopted across the globe, changing the way companies are built and new products are launched.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings">
                                        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group2"><i class="icon-arrow-up-left2"></i>&nbsp; Source</a> </h6>
                                    </div>
                                    <div id="accordion-control-right-group2" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12"> Conetent Goes here... </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings">
                                        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group73"><i class="icon-star-full2"></i>&nbsp; Rating</a> </h6>
                                    </div>
                                    <div id="accordion-control-right-group73" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12"> Conetent Goes here... </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings">
                                        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group74"><i class="icon-calendar"></i>&nbsp; Date Created</a> </h6>
                                    </div>
                                    <div id="accordion-control-right-group74" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12"> Conetent Goes here... </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings">
                                        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group83"><i class="icon-thumbs-up2"></i>&nbsp; Reviews</a> </h6>
                                    </div>
                                    <div id="accordion-control-right-group83" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="row mb20">
                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="control-primary" checked="checked">
                                                            Total Reviews
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input class="form-control input-sm" type="text" name="" value="20" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" />
                                                </div>

                                            </div>
                                            <div class="row mb20">
                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="control-primary" checked="checked">
                                                            Positive
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input class="form-control input-sm" type="text" name="" value="20" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" />
                                                </div>

                                            </div>
                                            <div class="row mb20">
                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="control-primary">
                                                            Neutral
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input class="form-control input-sm" type="text" name="" value="20" disabled /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" disabled />
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="control-primary" checked="checked">
                                                            Negative
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input class="form-control input-sm" type="text" name="" value="0" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="10" />
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-content-footer">
                            <button type="button" class="btn dark_btn dropdown-toggle" style="display: inline-block;"><i class="icon-filter4"></i><span> &nbsp;  Filter</span> </button>
                            &nbsp; &nbsp;
                            <a style="display: inline-block;" href="#">Clear All</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->

    <div class="tab-content"> 
        <div class="row">

        	<!--div class="col-sm-6 col-md-3 result_box">
        	<div class="panel panel-flat review_ratings">
			  <div class="panel-heading">
				<h6 class="panel-title">Review Ratings<a class="heading-elements-toggle"><i class="icon-more"></i></a><a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
				<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
			  </div>
			  <div class="panel-body p0">
			  <div class="pt20 pb20 pl40 pr40 bbot">
			  	<h1><i class="icon-star-full2"></i> 4.2 <sup><i class="icon-arrow-up5"></i> &nbsp; +15%</sup></h1>
			  </div>
			  <div class="p40 ratings">
				<div class="row inner">
					<div class="col-xs-6">
						<i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> 
					</div>
					<div class="col-xs-6 text-right"><p>24% <span>5</span></p></div>
				<div class="col-xs-12">
					<div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
						<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40" style="width:40%"></div>
					</div>
					</div>
				</div>
				<div class="row inner">
					<div class="col-xs-6">
						<i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> 
					</div>
					<div class="col-xs-6 text-right"><p>61% <span>17</span></p></div>
				<div class="col-xs-12">
					<div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
						<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="70" style="width:70%"></div>
					</div>
					</div>
				</div>
				<div class="row inner">
					<div class="col-xs-6">
						<i class="icon-star-full2"></i> <i class="icon-star-full2"></i> <i class="icon-star-full2"></i> 
					</div>
					<div class="col-xs-6 text-right"><p>3% <span>1</span></p></div>
				<div class="col-xs-12">
					<div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
						<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="10" style="width:20%"></div>
					</div>
					</div>
				</div>
				<div class="row inner">
					<div class="col-xs-6">
						<i class="icon-star-full2"></i> <i class="icon-star-full2"></i>  
					</div>
					<div class="col-xs-6 text-right"><p>0% <span>0</span></p></div>
				<div class="col-xs-12">
					<div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
						<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="10" style="width:10%"></div>
					</div>
					</div>
				</div>
				<div class="row inner mb0">
					<div class="col-xs-6">
						<i class="icon-star-full2"></i>   
					</div>
					<div class="col-xs-6 text-right"><p>0% <span>0</span></p></div>
				<div class="col-xs-12">
					<div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total Requests 17">
						<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="10" style="width:10%"></div>
					</div>
					</div>
				</div>
				
				
				</div>
			  </div>
			</div>
		    </div-->


        	<!--div class="col-sm-6 col-md-3 result_box">
				<div class="panel panel-body boxshadow bkg6">
					<div class="media no-margin">
						<div class="media-body text-left results">
							<?php 
								$currentUserID = $this->session->userdata("current_user_id");
								$ratingOne = 0;
								$ratingTwo = 0;
								$ratingThree = 0;
								$ratingFour = 0;
								$ratingFive = 0;
								foreach($aData['bbStatsData'] as $statsData){ 
									if($statsData->ratings == 1){
										$ratingOne = $ratingOne + 1;
									}
									if($statsData->ratings == 2){
										$ratingTwo = $ratingTwo + 1;
									}
									if($statsData->ratings == 3){
										$ratingThree = $ratingThree + 1;
									}
									if($statsData->ratings == 4){
										$ratingFour = $ratingFour + 1;
									}
									if($statsData->ratings == 5){
										$ratingFive = $ratingFive + 1;
									}
								}
								$totalReviews = $ratingOne+$ratingTwo+$ratingThree+$ratingFour+$ratingFive;
								$avgRating = ($ratingOne+($ratingTwo*2)+($ratingThree*3)+($ratingFour*4)+($ratingFive*5))/$totalReviews; 
								$emailData = $this->mBrandboost->getSentEmailCountByUserIdAndBBId($currentUserID, '');
								$smsData = $this->mBrandboost->getSentSMSCountByUserIdAndBBId($currentUserID, '');
								
							?>
							<h5 class="mb0"><i class="icon-star-full2"></i> &nbsp; <span><?php echo number_format($avgRating, 1); ?></span> &nbsp; <span><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i></span></h5>
							<h5>Average Review Rating</h5>
							
							<div class="rating_progress">
								<p><span>5 Star</span><strong class="pull-right"><?php echo $ratingFive; ?></strong></p>
								<div class="progress">
									<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%"></div>
								</div>
							</div>
							<div class="rating_progress">
								<p><span>4 Star</span><strong class="pull-right"><?php echo $ratingFour; ?></strong></p>
								<div class="progress">
									<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%"></div>
								</div>
							</div>
							<div class="rating_progress">
								<p><span>3 Star</span><strong class="pull-right"><?php echo $ratingThree; ?></strong></p>
								<div class="progress">
									<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%"></div>
								</div>
							</div>
							<div class="rating_progress">
								<p><span>2 Star</span><strong class="pull-right"><?php echo $ratingTwo; ?></strong></p>
								<div class="progress">
									<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%"></div>
								</div>
							</div>
							<div class="rating_progress">
								<p><span>1 Star</span><strong class="pull-right"><?php echo $ratingOne; ?></strong></p>
								<div class="progress">
									<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:20%"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div-->
			<div class="col-sm-6 col-md-3 result_box">
				<div class="panel panel-flat">
				  <div class="panel-heading">
					<h6 class="panel-title">Total Reviews Requested<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
					<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
				  </div>
				  <div class="panel-body p0">
					<div class="image_video">
						<div class="panel panel-body boxshadow ">
							<div class="media no-margin">
								<div class="media-body text-left results">
									<h5 class="mb0"><i class="icon-upload"></i> &nbsp; <span><?php echo $totalReviews; ?></span></h5>
									<h5>Total Reviews Requested</h5>
									<div class="svg-center" id="pie_progress_bar"></div>
								</div>
							</div>
						</div>
					</div>
				  </div>
				</div>
			</div>
			<div class="col-sm-6 col-md-3 result_box">
				<div class="panel panel-flat">
				  <div class="panel-heading">
					<h6 class="panel-title">Collected Reviews<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
					<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
				  </div>
				  <div class="panel-body p0">
					<div class="image_video">
						<div class="panel panel-body boxshadow">
							<div class="media text-left ">
								<div class="media-body results">
									<h5 class="mb0"><i class="icon-file-text2"></i> &nbsp;  <span><?php echo $totalReviews; ?></span></h5>
									<h5>Collected Reviews</h5>
									<hr>
									<p>3 Review replied.</p>
									<hr>
								<span class="text-uppercase text-size-mini text-muted">Collected Reviews</span> </div>
							</div>
						</div>
					</div>
				  </div>
				</div>
			</div>
			<div class="col-sm-6 col-md-3 result_box">
				
				<div class="panel panel-flat">
				  <div class="panel-heading">
					<h6 class="panel-title">Emails Sent<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
					<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
				  </div>
				  <div class="panel-body p0">
					<div class="image_video">
						<div class="panel panel-body boxshadow">
							<div class="media no-margin">
								<div class="media-body text-left results">
									<h5 class="mb0"><i class="icon-envelop"></i> &nbsp;  <span><?php echo count($emailData)-1; ?></span></h5>
									<h5 class="mb30">Emails Sent</h5>
									<div class="svg-center" id="arc_multi"></div>
								</div>
							</div>
						</div>
					</div>
				  </div>
				</div>
			</div>
			<div class="col-sm-6 col-md-3 result_box">
				<div class="panel panel-flat">
				  <div class="panel-heading">
					<h6 class="panel-title">SMS Sent<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
					<div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
				  </div>
				  <div class="panel-body p0">
					<div class="image_video">
						<div class="panel panel-body boxshadow">
							<div class="media text-left ">
								<div class="media-body results">
									<h5 class="mb0"><i class="icon-envelop2"></i> &nbsp;  <span><?php echo count($smsData)-1; ?></span></h5>
									<h5 class="mb30">SMS Sent</h5>
									<div class="svg-center" id="arc_single2"></div>
								</div>
							</div>
						</div>
					</div>
				  </div>
				</div>
			</div>


            <div class="col-lg-12">
                <!-- Marketing campaigns -->
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Product</h6>
                        <div class="heading-elements">
                            <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                <div class="form-control-feedback">
                                    <i class="icon-search4"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body p0">
                        <table class="table datatable-basic datatable-sorting">
                        	<thead>
								<tr>
									<th style="display: none;"></th>
									<th style="display: none;"></th>
									<th>Feedback Activity</th>
									<th class="text-center">Feedback Received</th>
									<th class="text-center">5 Star</th>
									<th class="text-center">4 Star</th>
									<th class="text-center">3 Star</th>
									<th class="text-center">2 Star</th>
									<th style="display: none;"></th>
									<th class="text-center">1 Star </th>
									
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach($aData['bbStatsData'] as $bbData){ 
										$ratingOne = 0;
										$ratingTwo = 0;
										$ratingThree = 0;
										$ratingFour = 0;
										$ratingFive = 0;
										$bbReportData = getBBReportStats(date('Y-m-d', strtotime($bbData->created)));
										foreach($bbReportData as $statsData){
											if($statsData->ratings == 1){
												$ratingOne = $ratingOne + 1;
											}
											if($statsData->ratings == 2){
												$ratingTwo = $ratingTwo + 1;
											}
											if($statsData->ratings == 3){
												$ratingThree = $ratingThree + 1;
											}
											if($statsData->ratings == 4){
												$ratingFour = $ratingFour + 1;
											}
											if($statsData->ratings == 5){
												$ratingFive = $ratingFive + 1;
											}
										}
									?>
									<tr>
										<td style="display: none;"><?php echo date('m/d/Y', strtotime($bbData->created)); ?></td>
                                        <td style="display: none;"><?php echo $bbData->created; ?></td>
										<!--td><h6 class="text-semibold"><?php echo date("M d, Y h:i A", strtotime($bbData->created)); ?> <div class="text-muted text-size-small"><?php echo date("h:i A", strtotime($bbData->created)); ?> (<?php echo timeAgo($bbData->created); ?>)</div></h6></td-->
										<td>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><?php echo date('d M Y', strtotime($bbData->created)); ?></a></div>
                                                <div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($bbData->created)); ?></div>
                                            </div>
                                        </td>
										<td class="text-center"><a href="#"><?php echo $bbData->totalNo; ?></a></td>
										<td class="text-center"><a href="#"><?php echo $ratingFive; ?></a></td>
										<td class="text-center"><a href="#"><?php echo $ratingFour; ?></a></td>
										<td class="text-center"><a href="#"><?php echo $ratingThree; ?></a></td>
										<td class="text-center"><a href="#"><?php echo $ratingTwo; ?></a></td>
										<td style="display: none;"><?php echo date('m/d/Y', strtotime($bbData->created)); ?></td>
										<td class="text-center"><a href="#"><?php echo $ratingOne; ?></a></td>
										
										
									</tr>
								<?php } ?>
								
							</tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>			
	// Daterange picker
	// ------------------------------
	$('.daterange-ranges').daterangepicker(
	{
		startDate: moment().subtract(29, 'days'),
		endDate: moment(),
		minDate: '01/01/2012',
		maxDate: '12/31/2016',
		dateLimit: { days: 60 },
		ranges: {
			'Today': [moment(), moment()],
			'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'Last 7 Days': [moment().subtract(6, 'days'), moment()],
			'Last 30 Days': [moment().subtract(29, 'days'), moment()],
			'This Month': [moment().startOf('month'), moment().endOf('month')],
			'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		},
		opens: 'left',
		applyClass: 'btn-small bg-slate-600 btn-block',
		cancelClass: 'btn-small btn-default btn-block',
		format: 'MM/DD/YYYY'
	},
	function(start, end) {
		$('.daterange-ranges span').html(start.format('MMMM D') + ' - ' + end.format('MMMM D'));
	}
    );
	
	$('.daterange-ranges span').html(moment().subtract(29, 'days').format('MMMM D') + ' - ' + moment().format('MMMM D'));
	
	
	// Initialize chart
    progressArcMulti("#arc_multi", 78, 700);
	progressArcMulti("#arc_multi2", 78, 700);
	
    // Chart setup
    function progressArcMulti(element, size, goal) {
		
        // Main variables
        var d3Container = d3.select(element),
		radius = size,
		thickness = 20,
		startColor = '#66BB6A',
		midColor = '#FFA726',
		endColor = '#EF5350';
		
        // Colors
        var color = d3.scale.linear()
		.domain([0, 70, 100])
		.range([startColor, midColor, endColor]);
		
		
        // Create chart
        // ------------------------------
		
        // Add svg element
        var container = d3Container.append("svg");
        
        // Add SVG group
        var svg = container
		.attr('width', radius * 2)
		.attr('height', radius + 20);
		
		
        // Construct chart layout
        // ------------------------------
		
        // Pie
        var arc = d3.svg.arc()
		.innerRadius(radius - thickness)
		.outerRadius(radius)
		.startAngle(-Math.PI / 2);
		
		
        // Append chart elements
        // ------------------------------
		
        //
        // Group arc elements
        //
		
        // Group
        var chart = svg.append('g')
		.attr('transform', 'translate(' + radius + ',' + radius + ')');
		
        // Background
        var background = chart.append('path')
		.datum({
			endAngle: Math.PI / 2
		})
		.attr({
			'd': arc,
			'fill': '#eee'
		});
		
        // Foreground
        var foreground = chart.append('path')
		.datum({
			endAngle: -Math.PI / 2
		})
		.style('fill', startColor)
		.attr('d', arc);
		
        // Counter value
        var value = svg.append('g')
		.attr('transform', 'translate(' + radius + ',' + (radius * 0.9) + ')')
		.append('text')
		.text(0 + '%')
		.attr({
			'text-anchor': 'middle',
			'fill': '#555'
		})
		.style({
			'font-size': 19,
			'font-weight': 400
		});
		
		
        //
        // Min and max text
        //
		
        // Group
        var scale = svg.append('g')
		.attr('transform', 'translate(' + radius + ',' + (radius + 15) + ')')
		.style({
			'font-size': 12,
			'fill': '#999'
		});
		
        // Max
        scale.append('text')
		.text(100)
		.attr({
			'text-anchor': 'middle',
			'x': (radius - thickness / 2)
		});
		
        // Min
        scale.append('text')
		.text(0)
		.attr({
			'text-anchor': 'middle',
			'x': -(radius - thickness / 2)
		});
		
		
        //
        // Animation
        //
		
        // Interval
        setInterval(function() {
            update(Math.random() * 100);
		}, 1500);
		
        // Update
        function update(v) {
            v = d3.format('.0f')(v);
            foreground.transition()
			.duration(750)
			.style('fill', function() {
				return color(v);
			})
			.call(arcTween, v);
			
            value.transition()
			.duration(750)
			.call(textTween, v);
		}
		
        // Arc
        function arcTween(transition, v) {
            var newAngle = v / 100 * Math.PI - Math.PI / 2;
            transition.attrTween('d', function(d) {
                var interpolate = d3.interpolate(d.endAngle, newAngle);
                return function(t) {
                    d.endAngle = interpolate(t);
                    return arc(d);
				};
			});
		}
		
        // Text
        function textTween(transition, v) {
            transition.tween('text', function() {
                var interpolate = d3.interpolate(this.innerHTML, v),
				split = (v + '').split('.'),
				round = (split.length > 1) ? Math.pow(10, split[1].length) : 1;
                return function(t) {
                    this.innerHTML = d3.format('.0f')(Math.round(interpolate(t) * round) / round) + '<tspan>%</tspan>';
				};
			});
		}
	}
	
	
	
	
	// Progress arc - single color
    // ------------------------------
	
    // Initialize chart
    progressArcSingle("#arc_single", 78);
	progressArcSingle("#arc_single2", 78);
	
    // Chart setup
    function progressArcSingle(element, size) {
		
        // Main variables
        var d3Container = d3.select(element),
		radius = size,
		thickness = 20,
		color = '#29B6F6';
		
		
        // Create chart
        // ------------------------------
		
        // Add svg element
        var container = d3Container.append("svg");
        
        // Add SVG group
        var svg = container
		.attr('width', radius * 2)
		.attr('height', radius + 20)
		.attr('class', 'gauge');
		
		
        // Construct chart layout
        // ------------------------------
		
        // Pie
        var arc = d3.svg.arc()
		.innerRadius(radius - thickness)
		.outerRadius(radius)
		.startAngle(-Math.PI / 2);
		
		
        // Append chart elements
        // ------------------------------
		
        //
        // Group arc elements
        //
		
        // Group
        var chart = svg.append('g')
		.attr('transform', 'translate(' + radius + ',' + radius + ')');
		
        // Background
        var background = chart.append('path')
		.datum({
			endAngle: Math.PI / 2
		})
		.attr({
			'd': arc,
			'fill': '#eee'
		});
		
        // Foreground
        var foreground = chart.append('path')
		.datum({
			endAngle: -Math.PI / 2
		})
		.style('fill', color)
		.attr('d', arc);
		
        // Counter value
        var value = svg.append('g')
		.attr('transform', 'translate(' + radius + ',' + (radius * 0.9) + ')')
		.append('text')
		.text(0 + '%')
		.attr({
			'text-anchor': 'middle',
			'fill': '#555'
		})
		.style({
			'font-size': 19,
			'font-weight': 400
		});
		
		
        //
        // Min and max text
        //
		
        // Group
        var scale = svg.append('g')
		.attr('transform', 'translate(' + radius + ',' + (radius + 15) + ')')
		.style({
			'font-size': 12,
			'fill': '#999'
		});
		
        // Max
        scale.append('text')
		.text(100)
		.attr({
			'text-anchor': 'middle',
			'x': (radius - thickness / 2)
		});
		
        // Min
        scale.append('text')
		.text(0)
		.attr({
			'text-anchor': 'middle',
			'x': -(radius - thickness / 2)
		});
		
		
        //
        // Animation
        //
		
        // Interval
        setInterval(function() {
            update(Math.random() * 100);
		}, 1500);
		
        // Update
        function update(v) {
            v = d3.format('.0f')(v);
            foreground.transition()
			.duration(750)
			.call(arcTween, v);
			
            value.transition()
			.duration(750)
			.call(textTween, v);
		}
		
        // Arc
        function arcTween(transition, v) {
            var newAngle = v / 100 * Math.PI - Math.PI / 2;
            transition.attrTween('d', function(d) {
                var interpolate = d3.interpolate(d.endAngle, newAngle);
                return function(t) {
                    d.endAngle = interpolate(t);
                    return arc(d);
				};
			});
		}
		
        // Text
        function textTween(transition, v) {
            transition.tween('text', function() {
                var interpolate = d3.interpolate(this.innerHTML, v),
				split = (v + '').split('.'),
				round = (split.length > 1) ? Math.pow(10, split[1].length) : 1;
                return function(t) {
                    this.innerHTML = d3.format('.0f')(Math.round(interpolate(t) * round) / round) + '<tspan>%</tspan>';
				};
			});
		}
	}
	
	
	// Pie with progress bar
    // ------------------------------
	
    // Initialize chart
    pieWithProgress("#pie_progress_bar", 100);
	pieWithProgress("#pie_progress_bar2", 100);
	
    // Chart setup
    function pieWithProgress(element, size) {
		
        // Demo dataset
        var dataset = [
		{ name: 'New', count: 639 },
		{ name: 'Pending', count: 255 },
		{ name: 'Shipped', count: 215 }
		];
		
        // Main variables
        var d3Container = d3.select(element),
		total = 0,
		width = size,
		height = size,
		progressSpacing = 6,
		progressSize = (progressSpacing + 2),
		arcSize = 20,
		outerRadius = (width / 2),
		innerRadius = (outerRadius - arcSize);
		
        // Colors
        var color = d3.scale.ordinal()
		.range(['#EF5350', '#29b6f6', '#66BB6A']);
		
		
        // Create chart
        // ------------------------------
		
        // Add svg element
        var container = d3Container.append("svg");
        
        // Add SVG group
        var svg = container
		.attr("width", width)
		.attr("height", height)
		.append("g")
		.attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");
		
		
        // Construct chart layout
        // ------------------------------
		
        // Add dataset
        dataset.forEach(function(d){
            total+= d.count;
		});
		
        // Pie layout
        var pie = d3.layout.pie()
		.value(function(d){ return d.count; })
		.sort(null);
		
        // Inner arc
        var arc = d3.svg.arc()
		.innerRadius(innerRadius)
		.outerRadius(outerRadius);
		
        // Line arc
        var arcLine = d3.svg.arc()
		.innerRadius(innerRadius - progressSize)
		.outerRadius(innerRadius - progressSpacing)
		.startAngle(0);
		
		
        // Append chart elements
        // ------------------------------
		
        //
        // Animations
        //
        var arcTween = function(transition, newAngle) {
            transition.attrTween("d", function (d) {
                var interpolate = d3.interpolate(d.endAngle, newAngle);
                var interpolateCount = d3.interpolate(0, dataset[0].count);
                return function (t) {
                    d.endAngle = interpolate(t);
                    middleCount.text(d3.format(",d")(Math.floor(interpolateCount(t))));
                    return arcLine(d);
				};
			});
		};
		
		
        //
        // Donut paths
        //
		
        // Donut
        var path = svg.selectAll('path')
		.data(pie(dataset))
		.enter()
		.append('path')
		.attr('d', arc)
		.attr('fill', function(d, i) {
			return color(d.data.name);
		})
		.style({
			'stroke': '#fff',
			'stroke-width': 2,
			'cursor': 'pointer'
		});
		
        // Animate donut
        path
		.transition()
		.delay(function(d, i) { return i; })
		.duration(600)
		.attrTween("d", function(d) {
			var interpolate = d3.interpolate(d.startAngle, d.endAngle);
			return function(t) {
				d.endAngle = interpolate(t);
				return arc(d);  
			}; 
		});
		
		
        //
        // Line path 
        //
		
        // Line
        var pathLine = svg.append('path')
		.datum({endAngle: 0})
		.attr('d', arcLine)
		.style({
			fill: color('New')
		});
		
        // Line animation
        pathLine.transition()
		.duration(600)
		.delay(300)
		.call(arcTween, (2 * Math.PI) * (dataset[0].count / total));
		
		
        //
        // Add count text
        //
		
        var middleCount = svg.append('text')
		.datum(0)
		.attr('dy', 6)
		.style({
			'font-size': '14px',
			'font-weight': 500,
			'text-anchor': 'middle'
		})
		.text(function(d){
			return d;
		});            
		
		
        //
        // Add interactions
        //
		
        // Mouse
        path
		.on('mouseover', function(d, i) {
			$(element + ' [data-slice]').css({
				'opacity': 0.3,
				'transition': 'all ease-in-out 0.15s'
			});
			$(element + ' [data-slice=' + i + ']').css({'opacity': 1});
		})
		.on('mouseout', function(d, i) {
			$(element + ' [data-slice]').css('opacity', 1);
		});
		
		
        //
        // Add legend
        //
		
        // Append list
        var legend = d3.select(element)
		.append('ul')
		.attr('class', 'chart-widget-legend')
		.selectAll('li')
		.data(pie(dataset))
		.enter()
		.append('li')
		.attr('data-slice', function(d, i) {
			return i;
		})
		.attr('style', function(d, i) {
			return 'border-bottom: solid 2px ' + color(d.data.name);
		})
		.text(function(d, i) {
			return d.data.name + ': ';
		});
		
        // Append legend text
        legend.append('span')
		.text(function(d, i) {
			return d.data.count;
		});
	}
	
</script>	
<?php */?>

@endsection  