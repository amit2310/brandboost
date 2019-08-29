@extends('layouts.main_template') 

@section('title')
{{ $title }}
@endsection

@section('contents')
<script src = "https://code.highcharts.com/highcharts.js"></script>

<style>
    .highcharts-tick{stroke:none!important}
    .highcharts-legend, .highcharts-credits{display: none!important;}
    .highcharts-container, .highcharts-container svg {width: 100% !important;}
    .ratings_new .progress{margin: 7px 0 0;}
</style>	  

<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-7">
                <h3><img style="width: 16px;" src="{{ base_url() }}assets/images/analysis_icon.png"> Analytics Service</h3>
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
                <!--------------LEFT----------->
                <div class="col-md-3">
                    <div class="panel panel-flat review_ratings ratings_new">
                        <div class="panel-heading">
                            <h6 class="panel-title">Review Ratings<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>
                        <div class="panel-body p0 bkg_white">
                            <div class="pt20 pb20 pl40 pr40 bbot">
                                <h1><i><img src="{{ base_url() }}assets/images/smiley_green_26.png"></i> 4.2 <sup><i class="icon-arrow-up5"></i> &nbsp; +15%</sup></h1>
                            </div>
                            <div class="p40 ratings">
                                <div class="row inner">
                                    <div class="col-xs-6">
                                        <i><img src="{{ base_url() }}assets/images/smile_dgreen.png"></i> 
                                    </div>
                                    <div class="col-xs-6 text-right"><p>24% <span>5</span></p></div>
                                    <div class="col-xs-12">
                                        <div data-toggle="tooltip" title="" data-placement="top" class="progress progress_green" data-original-title="Total Requests 17">
                                            <div class="progress-bar progress-bar-dgreen" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40" style="width:40%"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row inner">
                                    <div class="col-xs-6">
                                        <i><img src="{{ base_url() }}assets/images/smile_dgreen.png"></i>  
                                    </div>
                                    <div class="col-xs-6 text-right"><p>61% <span>17</span></p></div>
                                    <div class="col-xs-12">
                                        <div data-toggle="tooltip" title="" data-placement="top" class="progress progress_green" data-original-title="Total Requests 17">
                                            <div class="progress-bar progress-bar-dgreen" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="80" style="width:80%"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row inner">
                                    <div class="col-xs-6">
                                        <i><img src="{{ base_url() }}assets/images/smile_dyellow.png"></i> 
                                    </div>
                                    <div class="col-xs-6 text-right"><p>3% <span>1</span></p></div>
                                    <div class="col-xs-12">
                                        <div data-toggle="tooltip" title="" data-placement="top" class="progress progress_yellow" data-original-title="Total Requests 17">
                                            <div class="progress-bar progress-bar-info progress-bar-dyellow" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="10" style="width:20%"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row inner">
                                    <div class="col-xs-6">
                                        <i><img src="{{ base_url() }}assets/images/smile_dpink.png"></i> 
                                    </div>
                                    <div class="col-xs-6 text-right"><p>0% <span>0</span></p></div>
                                    <div class="col-xs-12">
                                        <div data-toggle="tooltip" title="" data-placement="top" class="progress progress_red" data-original-title="Total Requests 17">
                                            <div class="progress-bar progress-bar-info progress-bar-dred" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="10" style="width:10%"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row inner mb0">
                                    <div class="col-xs-6">
                                        <i><img src="{{ base_url() }}assets/images/smile_dpink.png"></i>   
                                    </div>
                                    <div class="col-xs-6 text-right"><p>0% <span>0</span></p></div>
                                    <div class="col-xs-12">
                                        <div data-toggle="tooltip" title="" data-placement="top" class="progress progress_red" data-original-title="Total Requests 17">
                                            <div class="progress-bar progress-bar-info progress-bar-dred" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="10" style="width:10%"></div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <!------------CENTER------------->
                <div class="col-md-3">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">NPS Score</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>
                        <div class="panel-body min_h398 p0" >
                            <!--<div class="" id="multiple_donuts2" style="height: 280px;"></div>-->

                            <div class="position-relative">
                                <div class="semi_circle_smiley"><img src="{{ base_url() }}assets/images/smiley_green.png"/></div>
                                <div id = "semi_circle_chart3" class="br5 bkg_gradient" style = "width: 100%; height: 280px;"></div>
                            </div>



                            <div class="p20 text-center graph_score btop bot">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <i class="icon-primitive-dot txt_nblue"></i>
                                        <p><strong>39%</strong></p>
                                        <p class="fsize12 txt_grey">Processed</p>
                                    </div>
                                    <div class="col-xs-4">
                                        <i style="opacity: 0.7;" class="icon-primitive-dot txt_blue"></i>
                                        <p><strong>21%</strong></p>
                                        <p class="fsize12 txt_lblue">Cancelled</p>
                                    </div>
                                    <div class="col-xs-4">
                                        <i style="opacity: 0.3;" class="icon-primitive-dot txt_wblue"></i>
                                        <p><strong>13%</strong></p>
                                        <p class="fsize12 txt_grey">Pending</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!------------RIGHT------------->
                <div class="col-md-3">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Services</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>
                        <div class="panel-body p0 pb10 min_h398" >
                            <div class="position-relative">
                                <div class="semi_circle_smiley"><img src="{{ base_url() }}assets/images/service_icon.png"/></div>
                                <div id = "semi_circle_chart" class="br5" style = "width: 100%; height: 280px; "></div>
                            </div>
                            <div class="p20 text-center graph_score btop bot">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <img class="graph" src="{{ base_url() }}assets/images/info_graph1.png"/>
                                    </div>

                                </div>
                            </div>



                        </div>
                    </div>
                </div>
                <!------------RIGHT------------->
                <div class="col-md-3">


                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Resolution</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>
                        <div class="panel-body p0 pb10 min_h398" >
                            <div class="position-relative">
                                <div class="semi_circle_smiley"><img src="{{ base_url() }}assets/images/smiley_green.png"/></div>
                                <div id = "semi_circle_chart2" class="br5 bkg_gradient" style = "width: 100%; height: 280px;"></div>
                            </div>
                            <div class="p20 text-center graph_score btop bot">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <img class="graph" src="{{ base_url() }}assets/images/info_graph2.png"/>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>


                </div>


            </div>



            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Recent Positive Comments</h6>
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
                                        <th>Name</th>
                                        <th>Feedback</th>
                                        <th>Comments</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!--================================================-->
                                    <tr>
                                        <td><div class="media-left media-middle"> <a class="icons" href="#"><img src="{{ base_url() }}assets/images/cust1.png" class="img-circle img-xs" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>Dora Weber</span> <img class="flags" src="{{ base_url() }}assets/images/flags/ao.png"></a></div>
                                                <div class="text-muted text-size-small">carlo.johnston@yahoo.com</div>
                                            </div></td>
                                        <td><div class="media-left media-middle"> <a class="icons" href="#"><img src="{{ base_url() }}assets/images/smiley_green.png" class="img-circle img-xs" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>4.1</span> </a></div>
                                                <div class="text-muted text-size-small">Positive</div>
                                            </div></td>
                                        <td><div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>Share it with my</span> </a></div>
                                                <div class="text-muted text-size-small">Extend dynamic applications</div>
                                            </div></td>
                                    </tr>

                                    <!--================================================-->
                                    <tr>
                                        <td><div class="media-left media-middle"> <a class="icons" href="#"><img src="{{ base_url() }}assets/images/cust2.png" class="img-circle img-xs" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>Della Delgado</span> <img class="flags" src="{{ base_url() }}assets/images/flags/us.png"></a></div>
                                                <div class="text-muted text-size-small">randy.evans@gmail.com</div>
                                            </div></td>
                                        <td><div class="media-left media-middle"> <a class="icons" href="#"><img src="{{ base_url() }}assets/images/smiley_green.png" class="img-circle img-xs" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>4.3</span> </a></div>
                                                <div class="text-muted text-size-small">Positive</div>
                                            </div></td>
                                        <td><div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>Really cool product!</span> </a></div>
                                                <div class="text-muted text-size-small">Engage out-of-the-box content</div>
                                            </div></td>
                                    </tr>

                                    <!--================================================-->
                                    <tr>
                                        <td><div class="media-left media-middle"> <a class="icons" href="#"><img src="{{ base_url() }}assets/images/cust3.png" class="img-circle img-xs" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>Ethel Powers</span> <img class="flags" src="{{ base_url() }}assets/images/flags/us.png"></a></div>
                                                <div class="text-muted text-size-small">carlo.johnston@yahoo.com</div>
                                            </div></td>
                                        <td><div class="media-left media-middle"> <a class="icons" href="#"><img src="{{ base_url() }}assets/images/smiley_green.png" class="img-circle img-xs" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>2.3</span> </a></div>
                                                <div class="text-muted text-size-small">Positive</div>
                                            </div></td>
                                        <td><div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>The only service you need.</span> </a></div>
                                                <div class="text-muted text-size-small">Architect clicks-and-mortar portals</div>
                                            </div></td>
                                    </tr>




                                    <!--================================================-->
                                    <tr>
                                        <td><div class="media-left media-middle"> <a class="icons" href="#"><img src="{{ base_url() }}assets/images/cust2.png" class="img-circle img-xs" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>Della Delgado</span> <img class="flags" src="{{ base_url() }}assets/images/flags/us.png"></a></div>
                                                <div class="text-muted text-size-small">randy.evans@gmail.com</div>
                                            </div></td>
                                        <td><div class="media-left media-middle"> <a class="icons" href="#"><img src="{{ base_url() }}assets/images/smiley_green.png" class="img-circle img-xs" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>4.3</span> </a></div>
                                                <div class="text-muted text-size-small">Positive</div>
                                            </div></td>
                                        <td><div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>Really cool product!</span> </a></div>
                                                <div class="text-muted text-size-small">Engage out-of-the-box content</div>
                                            </div></td>
                                    </tr>

                                    <!--================================================-->
                                    <tr>
                                        <td><div class="media-left media-middle"> <a class="icons" href="#"><img src="{{ base_url() }}assets/images/cust3.png" class="img-circle img-xs" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>Ethel Powers</span> <img class="flags" src="{{ base_url() }}assets/images/flags/us.png"></a></div>
                                                <div class="text-muted text-size-small">carlo.johnston@yahoo.com</div>
                                            </div></td>
                                        <td><div class="media-left media-middle"> <a class="icons" href="#"><img src="{{ base_url() }}assets/images/smiley_green.png" class="img-circle img-xs" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>2.3</span> </a></div>
                                                <div class="text-muted text-size-small">Positive</div>
                                            </div></td>
                                        <td><div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>The only service you need.</span> </a></div>
                                                <div class="text-muted text-size-small">Architect clicks-and-mortar portals</div>
                                            </div></td>
                                    </tr>






                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Recent Negative Comments</h6>
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
                                        <th>Name</th>
                                        <th>Feedback</th>
                                        <th>Comments</th>
                                    </tr>
                                </thead>
                                <tbody>



                                    <!--================================================-->
                                    <tr>
                                        <td><div class="media-left media-middle"> <a class="icons" href="#"><img src="{{ base_url() }}assets/images/cust2.png" class="img-circle img-xs" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>Della Delgado</span> <img class="flags" src="{{ base_url() }}assets/images/flags/us.png"></a></div>
                                                <div class="text-muted text-size-small">randy.evans@gmail.com</div>
                                            </div></td>
                                        <td><div class="media-left media-middle"> <a class="icons" href="#"><img src="{{ base_url() }}assets/images/smiley_red.png" class="img-circle img-xs" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>4.3</span> </a></div>
                                                <div class="text-muted text-size-small">Positive</div>
                                            </div></td>
                                        <td><div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>Really cool product!</span> </a></div>
                                                <div class="text-muted text-size-small">Engage out-of-the-box content</div>
                                            </div></td>
                                    </tr>

                                    <!--================================================-->
                                    <tr>
                                        <td><div class="media-left media-middle"> <a class="icons" href="#"><img src="{{ base_url() }}assets/images/cust3.png" class="img-circle img-xs" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>Ethel Powers</span> <img class="flags" src="{{ base_url() }}assets/images/flags/us.png"></a></div>
                                                <div class="text-muted text-size-small">carlo.johnston@yahoo.com</div>
                                            </div></td>
                                        <td><div class="media-left media-middle"> <a class="icons" href="#"><img src="{{ base_url() }}assets/images/smiley_red.png" class="img-circle img-xs" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>2.3</span> </a></div>
                                                <div class="text-muted text-size-small">Positive</div>
                                            </div></td>
                                        <td><div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>The only service you need.</span> </a></div>
                                                <div class="text-muted text-size-small">Architect clicks-and-mortar portals</div>
                                            </div></td>
                                    </tr>


                                    <!--================================================-->
                                    <tr>
                                        <td><div class="media-left media-middle"> <a class="icons" href="#"><img src="{{ base_url() }}assets/images/cust1.png" class="img-circle img-xs" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>Dora Weber</span> <img class="flags" src="{{ base_url() }}assets/images/flags/ao.png"></a></div>
                                                <div class="text-muted text-size-small">carlo.johnston@yahoo.com</div>
                                            </div></td>
                                        <td><div class="media-left media-middle"> <a class="icons" href="#"><img src="{{ base_url() }}assets/images/smiley_red.png" class="img-circle img-xs" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>4.1</span> </a></div>
                                                <div class="text-muted text-size-small">Positive</div>
                                            </div></td>
                                        <td><div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>Share it with my</span> </a></div>
                                                <div class="text-muted text-size-small">Extend dynamic applications</div>
                                            </div></td>
                                    </tr>

                                    <!--================================================-->
                                    <tr>
                                        <td><div class="media-left media-middle"> <a class="icons" href="#"><img src="{{ base_url() }}assets/images/cust2.png" class="img-circle img-xs" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>Della Delgado</span> <img class="flags" src="{{ base_url() }}assets/images/flags/us.png"></a></div>
                                                <div class="text-muted text-size-small">randy.evans@gmail.com</div>
                                            </div></td>
                                        <td><div class="media-left media-middle"> <a class="icons" href="#"><img src="{{ base_url() }}assets/images/smiley_red.png" class="img-circle img-xs" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>4.3</span> </a></div>
                                                <div class="text-muted text-size-small">Positive</div>
                                            </div></td>
                                        <td><div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>Really cool product!</span> </a></div>
                                                <div class="text-muted text-size-small">Engage out-of-the-box content</div>
                                            </div></td>
                                    </tr>

                                    <!--================================================-->
                                    <tr>
                                        <td><div class="media-left media-middle"> <a class="icons" href="#"><img src="{{ base_url() }}assets/images/cust3.png" class="img-circle img-xs" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>Ethel Powers</span> <img class="flags" src="{{ base_url() }}assets/images/flags/us.png"></a></div>
                                                <div class="text-muted text-size-small">carlo.johnston@yahoo.com</div>
                                            </div></td>
                                        <td><div class="media-left media-middle"> <a class="icons" href="#"><img src="{{ base_url() }}assets/images/smiley_red.png" class="img-circle img-xs" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>2.3</span> </a></div>
                                                <div class="text-muted text-size-small">Positive</div>
                                            </div></td>
                                        <td><div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><span>The only service you need.</span> </a></div>
                                                <div class="text-muted text-size-small">Architect clicks-and-mortar portals</div>
                                            </div></td>
                                    </tr>






                                </tbody>
                            </table>
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
                                        <th>Name</th>
                                        <th>Mentions</th>
                                        <th>Coverage %</th>
                                        <th>Average Rating</th>
                                        <th>Sentiment %</th>
                                        <th>Snippets</th>


                                    </tr>
                                </thead>
                                <tbody>

                                    <!--================================================-->
                                    <tr>
                                        <td><div class="media-left media-middle"> <a class="icons br5" href="#"><i class="icon-hash br5 txt_teal"></i></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default txt_dgrey text-semibold">Service</a> </div>
                                            </div></td>
                                        <td><span class="txt_dgrey">6</span></td>
                                        <td><span class="txt_dgrey">13.5%</span></td>
                                        <td><span class="txt_dgrey">3.9</span></td>
                                        <td><span class="txt_dgrey">100%</span></td>
                                        <td><span class="txt_dgrey">Most Recent Positive Comments</span></td>
                                    </tr>
                                    <!--================================================-->
                                    <tr>
                                        <td><div class="media-left media-middle"> <a class="icons br5" href="#"><i class="icon-hash br5 txt_teal"></i></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default txt_dgrey text-semibold">Test</a> </div>
                                            </div></td>
                                        <td><span class="txt_dgrey">6</span></td>
                                        <td><span class="txt_dgrey">13.5%</span></td>
                                        <td><span class="txt_dgrey">3.9</span></td>
                                        <td><span class="txt_dgrey">100%</span></td>
                                        <td><span class="txt_dgrey">Most Recent Positive Comments</span></td>
                                    </tr>
                                    <!--================================================-->
                                    <tr>
                                        <td><div class="media-left media-middle"> <a class="icons br5" href="#"><i class="icon-hash br5 txt_teal"></i></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default txt_dgrey text-semibold">Service</a> </div>
                                            </div></td>
                                        <td><span class="txt_dgrey">6</span></td>
                                        <td><span class="txt_dgrey">13.5%</span></td>
                                        <td><span class="txt_dgrey">3.9</span></td>
                                        <td><span class="txt_dgrey">100%</span></td>
                                        <td><span class="txt_dgrey">Most Recent Positive Comments</span></td>
                                    </tr>
                                    <!--================================================-->
                                    <tr>
                                        <td><div class="media-left media-middle"> <a class="icons br5" href="#"><i class="icon-hash br5 txt_teal"></i></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default txt_dgrey text-semibold">Test</a> </div>
                                            </div></td>
                                        <td><span class="txt_dgrey">6</span></td>
                                        <td><span class="txt_dgrey">13.5%</span></td>
                                        <td><span class="txt_dgrey">3.9</span></td>
                                        <td><span class="txt_dgrey">100%</span></td>
                                        <td><span class="txt_dgrey">Most Recent Positive Comments</span></td>
                                    </tr>
                                    <!--================================================-->
                                    <tr>
                                        <td><div class="media-left media-middle"> <a class="icons br5" href="#"><i class="icon-hash br5 txt_teal"></i></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default txt_dgrey text-semibold">Service</a> </div>
                                            </div></td>
                                        <td><span class="txt_dgrey">6</span></td>
                                        <td><span class="txt_dgrey">13.5%</span></td>
                                        <td><span class="txt_dgrey">3.9</span></td>
                                        <td><span class="txt_dgrey">100%</span></td>
                                        <td><span class="txt_dgrey">Most Recent Positive Comments</span></td>
                                    </tr>
                                    <!--================================================-->
                                    <tr>
                                        <td><div class="media-left media-middle"> <a class="icons br5" href="#"><i class="icon-hash br5 txt_teal"></i></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default txt_dgrey text-semibold">Test</a> </div>
                                            </div></td>
                                        <td><span class="txt_dgrey">6</span></td>
                                        <td><span class="txt_dgrey">13.5%</span></td>
                                        <td><span class="txt_dgrey">3.9</span></td>
                                        <td><span class="txt_dgrey">100%</span></td>
                                        <td><span class="txt_dgrey">Most Recent Positive Comments</span></td>
                                    </tr>






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
    //Semi Circle chart js -- Highcharts js plugins


    $(document).ready(function () {
        var chart = {
            plotBackgroundColor: false,
            plotBorderWidth: 0,
            plotShadow: false
        };
        var title = {
            text: '83% <br> <span style="border: none;" class="label bkg_green ml0 ">15.9%</span>',
            align: 'center',
            verticalAlign: 'middle',
            y: 60
        };

        var title2 = {
            text: '52% <br> <span style="border: none;" class="label bkg_green ml0 ">22.9%</span>',
            align: 'center',
            verticalAlign: 'middle',
            y: 60
        };

        var title3 = {
            text: 'NPS <br> <span style="border: none;" class="label bkg_green ml0 ">22.9%</span>',
            align: 'center',
            verticalAlign: 'middle',
            y: 60
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
                colors: ['#28adc5', '#bae2ea', '#8bbc21', '#910000'],
                innerSize: '85%',
                data: [
                    ['A', 52],
                    ['B', 48],

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
                colors: ['#5ad491', '#c8eedb', '#8bbc21', '#910000'],
                innerSize: '85%',
                data: [
                    ['A', 19],
                    ['B', 81],

                    {
                        name: 'Others',
                        y: 0,
                        dataLabels: {
                            enabled: false
                        }
                    }
                ]
            }];


        var series3 = [{
                type: 'pie',
                name: 'NPS',
                colors: ['#0a5d8c', '#2186bf ', '#59b4e8', '#910000'],
                innerSize: '85%',
                data: [
                    ['A', 40],
                    ['B', 50],
                    ['C', 10],

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


        var json3 = {};
        json3.chart = chart;
        json3.title = title3;
        json3.tooltip = tooltip;
        json3.series = series3;
        json3.plotOptions = plotOptions;
        $('#semi_circle_chart3').highcharts(json3);





    });
</script>
@endsection