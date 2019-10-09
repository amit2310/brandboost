@extends('layouts.main_template')

@section('title')
{{ $title }}
@endsection

@section('contents')

{{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<script src = "https://code.highcharts.com/highcharts.js"></script>

<!-- /theme JS files -->
<style>


    .label.bkg_green.ml0 {    display: none;}
    .table strong{font-weight: 600!important}

    #myfirstchart{background: url(images/graphbkg.png) left top repeat!important;}
    .highcharts-tick{stroke:none!important}
    .highcharts-credits{display: none!important;}
    .highcharts-container, .highcharts-container svg {width: 100% !important;}
    .highcharts-yaxis-labels{display: none!important;}
    .highcharts-grid {display: none;}
    .highcharts-grid, .highcharts-axis-line {   display: none;}
    .table .img-xs{box-shadow: none!important}

    #circle {
        width: 175px;
        height: 175px;
        margin: 0 auto;
    }

    .loader {
        width: calc(100% - 0px);
        height: calc(100% - 0px);
        border: 9px solid #ebeff6;
        border-top: 9px solid #5ad491;
        border-radius: 50%;
        animation: rotate 20s linear infinite;
        padding: 14px;
        cursor: pointer;
        position: relative;
    }
    .loader.yellow{border-top: 9px solid #ffcb65}
    .loader.red{border-top: 9px solid #f36484}

    @keyframes rotate {
        100% {transform: rotate(360deg);}
    }

</style>--}}

<div class="content" id="masterContainer">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-5">
                <h3><img style="width: 18px;" src="{{ URL::asset('assets/images/menu_icons/Dashboard_Light.svg') }}"/> Dashboard</h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="active"><a href="#tab1" data-toggle="tab">Overview</a></li>
                    <li><a href="#tab2" data-toggle="tab">Statistic</a></li>
                    <li><a href="#tab3" data-toggle="tab">Campaigns</a></li>
                </ul>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-7 text-right btn_area">
                <button type="button" class="btn light_btn "><i class="icon-download4"></i><span> &nbsp;  Import Contacts</span> </button>
                <button type="button" class="btn dark_btn ml10" ><i class="icon-plus3"></i><span> &nbsp;  Add Contacts</span> </button>
                <button type="button" class="btn dark_btn ml10" ><i class="icon-plus3"></i></button>

            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->

    <!--&&&&&&&&&&&& TABBED CONTENT &&&&&&&&&&-->
    <div class="tab-content">
        <!--===========TAB 1===========-->
        <div class="tab-pane active" id="tab1">

            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Email sent</h6>
                        </div>
                        <div class="panel-body p30 db_stats">
                            <div class="row">
                                <div class="col-xs-9">
                                    <div class="media-left"><img class="pull-left" src="{{ URL::asset('assets/images/db_icon2.png') }}"/></div>
                                    <div class="media-left"><h1>5,468</h1><p><strong class="txt_green"><i class="fa fa-arrow-up"></i> 33,87%</strong> &nbsp; <span class="txt_dgrey">from last week</span></p></div>
                                </div>
                                <div class="col-xs-3 text-right"><img src="{{ URL::asset('assets/images/db_graph2.png') }}"/></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Review Widget</h6>
                        </div>
                        <div class="panel-body p30 db_stats">
                            <div class="row">
                                <div class="col-xs-9">
                                    <div class="media-left"><img class="pull-left" src="{{ URL::asset('assets/images/db_icon1.png') }}"/></div>
                                    <div class="media-left"><h1>1,468</h1><p><strong class="txt_green"><i class="fa fa-arrow-up"></i> 33,87%</strong> &nbsp; <span class="txt_dgrey">from last week</span></p></div>
                                </div>
                                <div class="col-xs-3 text-right"><img src="{{ URL::asset('assets/images/db_graph1.png') }}"/></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Live Visitors</h6>
                        </div>
                        <div class="panel-body p30 db_stats">
                            <div class="row">
                                <div class="col-xs-9">
                                    <div class="media-left"><img class="pull-left" src="{{ URL::asset('assets/images/db_icon3.png') }}"/></div>
                                    <div class="media-left"><h1>4.39</h1><p><strong class="txt_green"><i class="fa fa-arrow-up"></i> 33,87%</strong> &nbsp; <span class="txt_dgrey">from last week</span></p></div>
                                </div>
                                <div class="col-xs-3 text-right"><img src="{{ URL::asset('assets/images/db_graph3.png') }}"/></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">People Activity</h6>
                            <div class="heading-elements">
                                <a class="table_more" href="#"><img src="{{ URL::asset('assets/images/more.svg') }}"></a>
                            </div>
                        </div>


                        <div class="panel-body bkg_white pt0 pb0">
                            <div class="row">
                                <div class="col-md-4 pr40 pl20 mt20 brig">
                                    <ul class="onsite_list">
                                        <li class="bnone"><span class="txt_dark"><i class="fa fa-square mr10" style="color: #6190fa;"></i>  New Contacts</span><strong class="txt_dark">51,913</strong></li>
                                        <li><span><i class="fa fa-square mr10" style="color: #5d7df3;"></i> New Tags</span><strong>1,448</strong></li>
                                        <li><span><i class="fa fa-square mr10" style="color: #5869eb;"></i> Lists</span><strong>68,35 %</strong></li>
                                    </ul>
                                </div>
                                <div class="col-md-8 pl20"><div id="column_graph" style="min-width: 300px; height: 220px;"></div></div>
                            </div>

                        </div>





                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">NPS Card</h6>
                            <div class="heading-elements">
                                <a class="table_more" href="#"><img src="{{ URL::asset('assets/images/more.svg') }}"></a>
                            </div>
                        </div>
                        <div class="panel-body min_h300 p20 bkg_white" >
                            <div class="row">
                                <div class="col-md-5 text-center pt40 pb40">


                                    <div data-toggle="tooltip" title="" data-placement="top" data-original-title="NPS Card" id="circle">
                                        <div title="8.5%" class="loader">
                                            <div title="65%" class="loader yellow">
                                                <div title="23%" class="loader red">

                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                                <div class="col-md-7">
                                    <ul class="onsite_list new mt40">
                                        <li style="border-top: none;"><span><img src="{{ URL::asset('assets/images/circle_green.png') }}" width="10"> The Big Lebowski</span><strong class="txt_dark">51,913</strong></li>
                                        <li><span><img src="{{ URL::asset('assets/images/circle_yellow.png') }}" width="10"> Inception</span><strong class="txt_dark">1,448</strong></li>
                                        <li><span><img src="{{ URL::asset('assets/images/circle_red.png') }}" width="10"> Inglourious Basterds</span><strong class="txt_dark">1,448</strong></li>
                                    </ul>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-md-6">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Reviews Activity</h6>
                            <div class="heading-elements">
                                <a class="table_more" href="#"><img src="{{ URL::asset('assets/images/more.svg') }}"></a>
                            </div>
                        </div>
                        <div class="panel-body p0 bkg_white min_h300">
                            <div class="p20 bbot">
                                <p class="txt_grey fw300 m0"><i class="fa fa-square txt_purple"></i> &nbsp; Emails sent this month &nbsp; &nbsp; <strong class="txt_dark">51,913</strong></p>
                            </div>
                            <div class="p20">
                                <div id="myfirstchart" style="height: 195px;"></div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Reviews</h6>
                            <div class="heading-elements">
                                <a class="table_more" href="#"><img src="{{ URL::asset('assets/images/more.svg') }}"></a>
                            </div>
                        </div>
                        <div class="panel-body p0">
                            {{--<dashboard-reivews></dashboard-reivews>--}}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Chats</h6>
                            <div class="heading-elements">
                                <a class="table_more" href="#"><img src="{{ URL::asset('assets/images/more.svg') }}"></a>
                            </div>
                        </div>
                        <div class="panel-body p0">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td><div class="media-left media-middle"> <a href="#"><img src="{{ URL::asset('assets/images/chat_icon_dash.png') }}" class="img-circle img-xs" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class=""><a href="#" class="text-default text-semibold bbot">Lou Reid</a></div>
                                            </div></td>
                                        <td class="text-right"><strong class="text-default text-semibold">Who is your favorite...</strong></td>
                                        <td class="text-right"><strong class="text-default text-semibold">24 Sep 2018</strong></td>
                                        <td class="text-right">
                                            <div class="tdropdown ml10">
                                                <a class="table_more dropdown-toggle" data-toggle="dropdown"><img src="{{ URL::asset('assets/images/more.svg') }}"></a>
                                                <ul style="right: 0;" class="dropdown-menu dropdown-menu-right status">
                                                    <li><a href="#"><i class="icon-primitive-dot txt_green"></i> Active</a> </li>
                                                    <li><a href="#"><i class="icon-primitive-dot txt_grey"></i> Disable</a> </li>
                                                    <li><a href="#"><i class="icon-primitive-dot txt_red"></i> Archive</a> </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><div class="media-left media-middle"> <a href="#"><img src="{{ URL::asset('assets/images/chat_icon_dash.png') }}" class="img-circle img-xs" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class=""><a href="#" class="text-default text-semibold bbot">Dylan Woods</a></div>
                                            </div></td>
                                        <td class="text-right"><strong class="text-default text-semibold">Do you have nice handwriting?</strong></td>
                                        <td class="text-right"><strong class="text-default text-semibold">5 Nov 2018</strong></td>
                                        <td class="text-right">
                                            <div class="tdropdown ml10">
                                                <a class="table_more dropdown-toggle" data-toggle="dropdown"><img src="{{ URL::asset('assets/images/more.svg') }}"></a>
                                                <ul style="right: 0;" class="dropdown-menu dropdown-menu-right status">
                                                    <li><a href="#"><i class="icon-primitive-dot txt_green"></i> Active</a> </li>
                                                    <li><a href="#"><i class="icon-primitive-dot txt_grey"></i> Disable</a> </li>
                                                    <li><a href="#"><i class="icon-primitive-dot txt_red"></i> Archive</a> </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><div class="media-left media-middle"> <a href="#"><img src="{{ URL::asset('assets/images/chat_icon_dash.png') }}" class="img-circle img-xs" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class=""><a href="#" class="text-default text-semibold bbot">Annie Hopkins</a></div>
                                            </div></td>
                                        <td class="text-right"><strong class="text-default text-semibold">What is your favorite ?</strong></td>
                                        <td class="text-right"><strong class="text-default text-semibold">15 Dec 2018</strong></td>
                                        <td class="text-right">
                                            <div class="tdropdown ml10">
                                                <a class="table_more dropdown-toggle" data-toggle="dropdown"><img src="{{ URL::asset('assets/images/more.svg') }}"></a>
                                                <ul style="right: 0;" class="dropdown-menu dropdown-menu-right status">
                                                    <li><a href="#"><i class="icon-primitive-dot txt_green"></i> Active</a> </li>
                                                    <li><a href="#"><i class="icon-primitive-dot txt_grey"></i> Disable</a> </li>
                                                    <li><a href="#"><i class="icon-primitive-dot txt_red"></i> Archive</a> </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><div class="media-left media-middle"> <a href="#"><img src="{{ URL::asset('assets/images/chat_icon_dash.png') }}" class="img-circle img-xs" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class=""><a href="#" class="text-default text-semibold bbot">Lou Reid</a></div>
                                            </div></td>
                                        <td class="text-right"><strong class="text-default text-semibold">Do you like roller coasters?</strong></td>
                                        <td class="text-right"><strong class="text-default text-semibold">24 Sep 2018</strong></td>
                                        <td class="text-right">
                                            <div class="tdropdown ml10">
                                                <a class="table_more dropdown-toggle" data-toggle="dropdown"><img src="{{ URL::asset('assets/images/more.svg') }}"></a>
                                                <ul style="right: 0;" class="dropdown-menu dropdown-menu-right status">
                                                    <li><a href="#"><i class="icon-primitive-dot txt_green"></i> Active</a> </li>
                                                    <li><a href="#"><i class="icon-primitive-dot txt_grey"></i> Disable</a> </li>
                                                    <li><a href="#"><i class="icon-primitive-dot txt_red"></i> Archive</a> </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><div class="media-left media-middle"> <a href="#"><img src="{{ URL::asset('assets/images/chat_icon_dash.png') }}" class="img-circle img-xs" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class=""><a href="#" class="text-default text-semibold bbot">Dylan Woods</a></div>
                                            </div></td>
                                        <td class="text-right"><strong class="text-default text-semibold">Where did you get your name?</strong></td>
                                        <td class="text-right"><strong class="text-default text-semibold">5 Nov 2018</strong></td>
                                        <td class="text-right">
                                            <div class="tdropdown ml10">
                                                <a class="table_more dropdown-toggle" data-toggle="dropdown"><img src="{{ URL::asset('assets/images/more.svg') }}"></a>
                                                <ul style="right: 0;" class="dropdown-menu dropdown-menu-right status">
                                                    <li><a href="#"><i class="icon-primitive-dot txt_green"></i> Active</a> </li>
                                                    <li><a href="#"><i class="icon-primitive-dot txt_grey"></i> Disable</a> </li>
                                                    <li><a href="#"><i class="icon-primitive-dot txt_red"></i> Archive</a> </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><div class="media-left media-middle"> <a href="#"><img src="{{ URL::asset('assets/images/chat_icon_dash.png') }}" class="img-circle img-xs" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class=""><a href="#" class="text-default text-semibold bbot">Annie Hopkins</a></div>
                                            </div></td>
                                        <td class="text-right"><strong class="text-default text-semibold">Where have you traveled?</strong></td>
                                        <td class="text-right"><strong class="text-default text-semibold">15 Dec 2018</strong></td>
                                        <td class="text-right">
                                            <div class="tdropdown ml10">
                                                <a class="table_more dropdown-toggle" data-toggle="dropdown"><img src="{{ URL::asset('assets/images/more.svg') }}"></a>
                                                <ul style="right: 0;" class="dropdown-menu dropdown-menu-right status">
                                                    <li><a href="#"><i class="icon-primitive-dot txt_green"></i> Active</a> </li>
                                                    <li><a href="#"><i class="icon-primitive-dot txt_grey"></i> Disable</a> </li>
                                                    <li><a href="#"><i class="icon-primitive-dot txt_red"></i> Archive</a> </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--===========TAB 2===========-->
        <div class="tab-pane" id="tab2">
            <div class="row">
                <div class="col-md-3">
                    <div class="panel panel-flat review_ratings">
                        <div class="panel-heading">
                            <h6 class="panel-title">Review Ratings</h6>
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
                </div>
                <div class="col-md-3">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">NPS Score</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>


                        <div class="panel-body min_h300 p0 text-center" >
                            <div class="bbot pt50 pb50">
                                <!--<div id="multiple_donuts2" style="height: 200px;"></div>-->
                                <img style="max-width: 276px; display: inline-block;" class="img-responsive graph" src="{{ URL::asset('assets/images/graph2.png') }}"/>
                            </div>
                            <div class="p20 text-center graph_score">
                                <div class="row">
                                    <div class="col-xs-4"><img src="{{ URL::asset('assets/images/smiley_green.png') }}"/>
                                        <p><strong>39</strong> <span>55%</span></p>
                                    </div>
                                    <div class="col-xs-4"><img src="{{ URL::asset('assets/images/smiley_grey2.png') }}"/>
                                        <p><strong>16</strong> <span>20%</span></p>
                                    </div>
                                    <div class="col-xs-4"><img src="{{ URL::asset('assets/images/smiley_red.png') }}"/>
                                        <p><strong>8</strong> <span>13%</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Credits</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>
                        <div class="panel-body text-center p30">
                            <div class="">
                                <img style="width: 191px; height: 159px; max-width: 191px;display: inline-block;" class="img-responsive graph" src="{{ URL::asset('assets/images/graph4.png') }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Email sent</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>
                        <div class="panel-body p20 emailsent">
                            <div class="row">
                                <div class="col-xs-6"><img class="pull-left" src="{{ URL::asset('assets/images/envalopeicon.png') }}"/><h1>159</h1><p>+19.4%</p></div>
                                <div class="col-xs-6"><img src="{{ URL::asset('assets/images/graph5.png') }}"/></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Email sent</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>
                        <div class="panel-body p20 emailsent">
                            <div class="row">
                                <div class="col-xs-6"><img class="pull-left" src="{{ URL::asset('assets/images/envalopeicon.png') }}"/><h1>159</h1><p>+19.4%</p></div>
                                <div class="col-xs-6"><img src="{{ URL::asset('assets/images/graph5.png') }}"/></div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Credits</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>
                        <div class="panel-body text-center p30">
                            <div class="">
                                <img style="width: 191px; height: 159px; max-width: 191px;display: inline-block;" class="img-responsive graph" src="{{ URL::asset('assets/images/graph4.png') }}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <h3 class="mt40 mb20" style="font-size: 16px;">Feedback Report</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="panel panel-flat review_ratings">
                        <div class="panel-heading">
                            <h6 class="panel-title">Review Ratings</h6>
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
                </div>

                <div class="col-md-3">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Credits</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>
                        <div class="panel-body text-center p30">
                            <div class="">
                                <img style="width: 191px; height: 159px; max-width: 191px;display: inline-block;" class="img-responsive graph" src="{{ URL::asset('assets/images/graph4.png') }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Email sent</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>
                        <div class="panel-body p20 emailsent">
                            <div class="row">
                                <div class="col-xs-6"><img class="pull-left" src="{{ URL::asset('assets/images/envalopeicon.png') }}"/><h1>159</h1><p>+19.4%</p></div>
                                <div class="col-xs-6"><img src="{{ URL::asset('assets/images/graph5.png') }}"/></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Email sent</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>
                        <div class="panel-body p20 emailsent">
                            <div class="row">
                                <div class="col-xs-6"><img class="pull-left" src="{{ URL::asset('assets/images/envalopeicon.png') }}"/><h1>159</h1><p>+19.4%</p></div>
                                <div class="col-xs-6"><img src="{{ URL::asset('assets/images/graph5.png') }}"/></div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Credits</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>
                        <div class="panel-body text-center p30">
                            <div class="">
                                <img style="width: 191px; height: 159px; max-width: 191px;display: inline-block;" class="img-responsive graph" src="{{ URL::asset('assets/images/graph4.png') }}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--===========TAB 3===========-->
        <div class="tab-pane" id="tab3">
            <div class="row">
                <div class="col-md-12">
                    <div style="margin: 0;" class="panel panel-flat">

                        <div class="panel-heading">
                            <h6 class="panel-title">17 Campaigns</h6>
                            <div class="heading-elements">
                                <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                    <input class="form-control input-sm" placeholder="Search by name" type="text">
                                    <div class="form-control-feedback">
                                        <i class=""><img src="{{ URL::asset('assets/images/icon_search.png') }}" width="14"></i>
                                    </div>
                                </div>
                                <div class="table_action_tool">
                                    <a href="#" class="brig pr-15">Updated just now &nbsp; <i class=""><img src="{{ URL::asset('assets/images/icon_refresh.png') }}"></i></a>
                                    <a href="#"><i class=""><img src="{{ URL::asset('assets/images/icon_calender.png') }}"></i></a>
                                    <a href="#"><i class=""><img src="{{ URL::asset('assets/images/icon_download.png') }}"></i></a>
                                    <a href="#"><i class=""><img src="{{ URL::asset('assets/images/icon_upload.png') }}"></i></a>
                                    <a href="#"><i class=""><img src="{{ URL::asset('assets/images/icon_edit.png') }}"></i></a>
                                </div>

                            </div>
                        </div>
                        <div class="panel-body p0">


                            <table class="table datatable-basic">
                                <thead>
                                    <tr>
                                        <th><i class=""><img src="{{ URL::asset('assets/images/star_name.png') }}"/></i>Name</th>
                                        <th><i class="icon-star-full2"></i>NPS Score</th>
                                        <th><i class="icon-calendar"></i>Created</th>
                                        <th><i class="icon-user"></i></th>
                                        <th><i class=""><img src="{{ URL::asset('assets/images/smiley_icon_green.png') }}"/></i> Positive</th>
                                        <th><i class=""><img src="{{ URL::asset('assets/images/smiley_icon_yellow.png') }}"/></i> Neutral</th>
                                        <th><i class=""><img src="{{ URL::asset('assets/images/smiley_icon_red.png') }}"/></i> Negative</th>
                                        <th><i class=""><img src="{{ URL::asset('assets/images/clock.png') }}"/></i>Last review</th>
                                        <th class="text-center">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!--=======================-->
                                    <tr>
                                        <td><div class="media-left media-middle"> <a class="icons s32" href="#"><img src="{{ URL::asset('assets/images/media_img1.jpg') }}" class="img-circle img-xs br5" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class=""><a href="#" class="text-default text-semibold">The Palazzo</a> </div>
                                                <div class="text-muted text-size-small">Really cool product!</div>
                                            </div></td>


                                        <td>
                                            <div class="media-left text-right">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold dark">4.1</a></div>
                                                <div class="text-muted text-size-small">Positive</div>
                                            </div>
                                            <div class="media-left media-middle brig pr10"> <a class="icons s28" href="#"><img src="{{ URL::asset('assets/images/smiley_green.png') }}" class="img-circle img-xs" alt=""></a> </div>
                                        </td>



                                        <td><div class="media-left text-right">
                                                <div class=""><a href="#" class="text-default text-semibold">13 May 2018</a> </div>
                                                <div class="text-muted text-size-small">02:51PM</div>
                                            </div></td>
                                        <td>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">58</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle over50 green cp55"> <span>10%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">156</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle  yellow cp33"> <span>33%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">87</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle over50 red cp66"> <span>66%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">56</a> </div></td>


                                        <td>
                                            <div class="media-left text-right">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold dark">4.5</a></div>
                                                <div class="text-muted text-size-small">Luella Burke</div>
                                            </div>
                                            <div class="media-left media-middle brig pr10"> <a class="icons s28" href="#"><img src="{{ URL::asset('assets/images/smiley_green.png') }}" class="img-circle img-xs" alt=""></a> </div>
                                        </td>


                                        <td class="text-center"><label class="custom-form-switch">
                                                <input class="field" type="checkbox" checked="">
                                                <span class="toggle"></span> </label>
                                            <div class="tdropdown ml10"> <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="{{ URL::asset('assets/images/more.svg') }}"></a>
                                                <ul class="dropdown-menu dropdown-menu-right more_act">
                                                    <a href="#" class="dropdown_close">X</a>
                                                    <li><a href="#"><i class="icon-arrow-down16"></i> Import contacts</a> </li>
                                                    <li><a href="#"><i class="icon-arrow-up16"></i> Export data</a> </li>
                                                    <li><a href="#"><i class="icon-stats-growth2"></i> Create report</a> </li>
                                                    <li><a href="#"><i class="icon-bin"></i> Delete</a> </li>
                                                </ul>
                                            </div></td>
                                    </tr>
                                    <!--=======================-->
                                    <tr>
                                        <td><div class="media-left media-middle"> <a class="icons s32" href="#"><img src="{{ URL::asset('assets/images/media_img2.jpg') }}" class="img-circle img-xs br5" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class=""><a href="#" class="text-default text-semibold">Sands Cotai Central</a> </div>
                                                <div class="text-muted text-size-small">Really cool product!</div>
                                            </div></td>


                                        <td>
                                            <div class="media-left text-right">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold dark">4.1</a></div>
                                                <div class="text-muted text-size-small">Positive</div>
                                            </div>
                                            <div class="media-left media-middle brig pr10"> <a class="icons s28" href="#"><img src="{{ URL::asset('assets/images/smiley_green.png') }}" class="img-circle img-xs" alt=""></a> </div>
                                        </td>



                                        <td><div class="media-left text-right">
                                                <div class=""><a href="#" class="text-default text-semibold">13 May 2018</a> </div>
                                                <div class="text-muted text-size-small">02:51PM</div>
                                            </div></td>
                                        <td>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">58</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle over50 green cp55"> <span>10%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">156</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle  yellow cp33"> <span>33%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">87</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle over50 red cp66"> <span>66%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">56</a> </div></td>


                                        <td>
                                            <div class="media-left text-right">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold dark">4.5</a></div>
                                                <div class="text-muted text-size-small">Luella Burke</div>
                                            </div>
                                            <div class="media-left media-middle brig pr10"> <a class="icons s28" href="#"><img src="{{ URL::asset('assets/images/smiley_green.png') }}" class="img-circle img-xs" alt=""></a> </div>
                                        </td>


                                        <td class="text-center"><label class="custom-form-switch">
                                                <input class="field" type="checkbox" checked="">
                                                <span class="toggle"></span> </label>
                                            <div class="tdropdown ml10"> <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="{{ URL::asset('assets/images/more.svg') }}"></a>
                                                <ul class="dropdown-menu dropdown-menu-right more_act">
                                                    <a href="#" class="dropdown_close">X</a>
                                                    <li><a href="#"><i class="icon-arrow-down16"></i> Import contacts</a> </li>
                                                    <li><a href="#"><i class="icon-arrow-up16"></i> Export data</a> </li>
                                                    <li><a href="#"><i class="icon-stats-growth2"></i> Create report</a> </li>
                                                    <li><a href="#"><i class="icon-bin"></i> Delete</a> </li>
                                                </ul>
                                            </div></td>
                                    </tr>
                                    <!--=======================-->
                                    <tr>
                                        <td><div class="media-left media-middle"> <a class="icons s32" href="#"><img src="{{ URL::asset('assets/images/media_img3.jpg') }}" class="img-circle img-xs br5" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class=""><a href="#" class="text-default text-semibold">Delano</a> </div>
                                                <div class="text-muted text-size-small">Really cool product!</div>
                                            </div></td>


                                        <td>
                                            <div class="media-left text-right">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold dark">4.1</a></div>
                                                <div class="text-muted text-size-small">Positive</div>
                                            </div>
                                            <div class="media-left media-middle brig pr10"> <a class="icons s28" href="#"><img src="{{ URL::asset('assets/images/smiley_green.png') }}" class="img-circle img-xs" alt=""></a> </div>
                                        </td>



                                        <td><div class="media-left text-right">
                                                <div class=""><a href="#" class="text-default text-semibold">13 May 2018</a> </div>
                                                <div class="text-muted text-size-small">02:51PM</div>
                                            </div></td>
                                        <td>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">58</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle over50 green cp55"> <span>10%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">156</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle  yellow cp33"> <span>33%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">87</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle over50 red cp66"> <span>66%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">56</a> </div></td>


                                        <td>
                                            <div class="media-left text-right">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold dark">4.5</a></div>
                                                <div class="text-muted text-size-small">Luella Burke</div>
                                            </div>
                                            <div class="media-left media-middle brig pr10"> <a class="icons s28" href="#"><img src="{{ URL::asset('assets/images/smiley_green.png') }}" class="img-circle img-xs" alt=""></a> </div>
                                        </td>


                                        <td class="text-center"><label class="custom-form-switch">
                                                <input class="field" type="checkbox" checked="">
                                                <span class="toggle"></span> </label>
                                            <div class="tdropdown ml10"> <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="{{ URL::asset('assets/images/more.svg') }}"></a>
                                                <ul class="dropdown-menu dropdown-menu-right more_act">
                                                    <a href="#" class="dropdown_close">X</a>
                                                    <li><a href="#"><i class="icon-arrow-down16"></i> Import contacts</a> </li>
                                                    <li><a href="#"><i class="icon-arrow-up16"></i> Export data</a> </li>
                                                    <li><a href="#"><i class="icon-stats-growth2"></i> Create report</a> </li>
                                                    <li><a href="#"><i class="icon-bin"></i> Delete</a> </li>
                                                </ul>
                                            </div></td>
                                    </tr>
                                    <!--=======================-->
                                    <tr>
                                        <td><div class="media-left media-middle"> <a class="icons s32" href="#"><img src="{{ URL::asset('assets/images/media_img4.jpg') }}" class="img-circle img-xs br5" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class=""><a href="#" class="text-default text-semibold">Mandalay Bay</a> </div>
                                                <div class="text-muted text-size-small">Really cool product!</div>
                                            </div></td>


                                        <td>
                                            <div class="media-left text-right">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold dark">4.1</a></div>
                                                <div class="text-muted text-size-small">Positive</div>
                                            </div>
                                            <div class="media-left media-middle brig pr10"> <a class="icons s28" href="#"><img src="{{ URL::asset('assets/images/smiley_green.png') }}" class="img-circle img-xs" alt=""></a> </div>
                                        </td>



                                        <td><div class="media-left text-right">
                                                <div class=""><a href="#" class="text-default text-semibold">13 May 2018</a> </div>
                                                <div class="text-muted text-size-small">02:51PM</div>
                                            </div></td>
                                        <td>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">58</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle over50 green cp55"> <span>10%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">156</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle  yellow cp33"> <span>33%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">87</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle over50 red cp66"> <span>66%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">56</a> </div></td>


                                        <td>
                                            <div class="media-left text-right">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold dark">4.5</a></div>
                                                <div class="text-muted text-size-small">Luella Burke</div>
                                            </div>
                                            <div class="media-left media-middle brig pr10"> <a class="icons s28" href="#"><img src="{{ URL::asset('assets/images/smiley_green.png') }}" class="img-circle img-xs" alt=""></a> </div>
                                        </td>


                                        <td class="text-center"><label class="custom-form-switch">
                                                <input class="field" type="checkbox" checked="">
                                                <span class="toggle"></span> </label>
                                            <div class="tdropdown ml10"> <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="{{ URL::asset('assets/images/more.svg') }}"></a>
                                                <ul class="dropdown-menu dropdown-menu-right more_act">
                                                    <a href="#" class="dropdown_close">X</a>
                                                    <li><a href="#"><i class="icon-arrow-down16"></i> Import contacts</a> </li>
                                                    <li><a href="#"><i class="icon-arrow-up16"></i> Export data</a> </li>
                                                    <li><a href="#"><i class="icon-stats-growth2"></i> Create report</a> </li>
                                                    <li><a href="#"><i class="icon-bin"></i> Delete</a> </li>
                                                </ul>
                                            </div></td>
                                    </tr>
                                    <!--=======================-->
                                    <tr>
                                        <td><div class="media-left media-middle"> <a class="icons s32" href="#"><img src="{{ URL::asset('assets/images/media_img4.jpg') }}" class="img-circle img-xs br5" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class=""><a href="#" class="text-default text-semibold">Ambassador City Jomtien</a> </div>
                                                <div class="text-muted text-size-small">Really cool product!</div>
                                            </div></td>


                                        <td>
                                            <div class="media-left text-right">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold dark">4.1</a></div>
                                                <div class="text-muted text-size-small">Positive</div>
                                            </div>
                                            <div class="media-left media-middle brig pr10"> <a class="icons s28" href="#"><img src="{{ URL::asset('assets/images/smiley_green.png') }}" class="img-circle img-xs" alt=""></a> </div>
                                        </td>



                                        <td><div class="media-left text-right">
                                                <div class=""><a href="#" class="text-default text-semibold">13 May 2018</a> </div>
                                                <div class="text-muted text-size-small">02:51PM</div>
                                            </div></td>
                                        <td>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">58</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle over50 green cp55"> <span>10%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">156</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle  yellow cp33"> <span>33%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">87</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle over50 red cp66"> <span>66%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">56</a> </div></td>


                                        <td>
                                            <div class="media-left text-right">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold dark">4.5</a></div>
                                                <div class="text-muted text-size-small">Luella Burke</div>
                                            </div>
                                            <div class="media-left media-middle brig pr10"> <a class="icons s28" href="#"><img src="{{ URL::asset('assets/images/smiley_green.png') }}" class="img-circle img-xs" alt=""></a> </div>
                                        </td>


                                        <td class="text-center"><label class="custom-form-switch">
                                                <input class="field" type="checkbox" checked="">
                                                <span class="toggle"></span> </label>
                                            <div class="tdropdown ml10"> <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="{{ URL::asset('assets/images/more.svg') }}"></a>
                                                <ul class="dropdown-menu dropdown-menu-right more_act">
                                                    <a href="#" class="dropdown_close">X</a>
                                                    <li><a href="#"><i class="icon-arrow-down16"></i> Import contacts</a> </li>
                                                    <li><a href="#"><i class="icon-arrow-up16"></i> Export data</a> </li>
                                                    <li><a href="#"><i class="icon-stats-growth2"></i> Create report</a> </li>
                                                    <li><a href="#"><i class="icon-bin"></i> Delete</a> </li>
                                                </ul>
                                            </div></td>
                                    </tr>
                                    <!--=======================-->
                                    <tr>
                                        <td><div class="media-left media-middle"> <a class="icons s32" href="#"><img src="{{ URL::asset('assets/images/media_img1.jpg') }}" class="img-circle img-xs br5" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class=""><a href="#" class="text-default text-semibold">The Palazzo</a> </div>
                                                <div class="text-muted text-size-small">Really cool product!</div>
                                            </div></td>


                                        <td>
                                            <div class="media-left text-right">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold dark">4.1</a></div>
                                                <div class="text-muted text-size-small">Positive</div>
                                            </div>
                                            <div class="media-left media-middle brig pr10"> <a class="icons s28" href="#"><img src="{{ URL::asset('assets/images/smiley_green.png') }}" class="img-circle img-xs" alt=""></a> </div>
                                        </td>



                                        <td><div class="media-left text-right">
                                                <div class=""><a href="#" class="text-default text-semibold">13 May 2018</a> </div>
                                                <div class="text-muted text-size-small">02:51PM</div>
                                            </div></td>
                                        <td>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">58</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle over50 green cp55"> <span>10%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">156</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle  yellow cp33"> <span>33%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">87</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle over50 red cp66"> <span>66%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">56</a> </div></td>


                                        <td>
                                            <div class="media-left text-right">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold dark">4.5</a></div>
                                                <div class="text-muted text-size-small">Luella Burke</div>
                                            </div>
                                            <div class="media-left media-middle brig pr10"> <a class="icons s28" href="#"><img src="{{ URL::asset('assets/images/smiley_green.png') }}" class="img-circle img-xs" alt=""></a> </div>
                                        </td>


                                        <td class="text-center"><label class="custom-form-switch">
                                                <input class="field" type="checkbox" checked="">
                                                <span class="toggle"></span> </label>
                                            <div class="tdropdown ml10"> <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="{{ URL::asset('assets/images/more.svg') }}"></a>
                                                <ul class="dropdown-menu dropdown-menu-right more_act">
                                                    <a href="#" class="dropdown_close">X</a>
                                                    <li><a href="#"><i class="icon-arrow-down16"></i> Import contacts</a> </li>
                                                    <li><a href="#"><i class="icon-arrow-up16"></i> Export data</a> </li>
                                                    <li><a href="#"><i class="icon-stats-growth2"></i> Create report</a> </li>
                                                    <li><a href="#"><i class="icon-bin"></i> Delete</a> </li>
                                                </ul>
                                            </div></td>
                                    </tr>
                                    <!--=======================-->
                                    <tr>
                                        <td><div class="media-left media-middle"> <a class="icons s32" href="#"><img src="{{ URL::asset('assets/images/media_img2.jpg') }}" class="img-circle img-xs br5" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class=""><a href="#" class="text-default text-semibold">Sands Cotai Central</a> </div>
                                                <div class="text-muted text-size-small">Really cool product!</div>
                                            </div></td>


                                        <td>
                                            <div class="media-left text-right">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold dark">4.1</a></div>
                                                <div class="text-muted text-size-small">Positive</div>
                                            </div>
                                            <div class="media-left media-middle brig pr10"> <a class="icons s28" href="#"><img src="{{ URL::asset('assets/images/smiley_green.png') }}" class="img-circle img-xs" alt=""></a> </div>
                                        </td>



                                        <td><div class="media-left text-right">
                                                <div class=""><a href="#" class="text-default text-semibold">13 May 2018</a> </div>
                                                <div class="text-muted text-size-small">02:51PM</div>
                                            </div></td>
                                        <td>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">58</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle over50 green cp55"> <span>10%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">156</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle  yellow cp33"> <span>33%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">87</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle over50 red cp66"> <span>66%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">56</a> </div></td>


                                        <td>
                                            <div class="media-left text-right">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold dark">4.5</a></div>
                                                <div class="text-muted text-size-small">Luella Burke</div>
                                            </div>
                                            <div class="media-left media-middle brig pr10"> <a class="icons s28" href="#"><img src="{{ URL::asset('assets/images/smiley_green.png') }}" class="img-circle img-xs" alt=""></a> </div>
                                        </td>


                                        <td class="text-center"><label class="custom-form-switch">
                                                <input class="field" type="checkbox" >
                                                <span class="toggle"></span> </label>
                                            <div class="tdropdown ml10"> <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="{{ URL::asset('assets/images/more.svg') }}"></a>
                                                <ul class="dropdown-menu dropdown-menu-right more_act">
                                                    <a href="#" class="dropdown_close">X</a>
                                                    <li><a href="#"><i class="icon-arrow-down16"></i> Import contacts</a> </li>
                                                    <li><a href="#"><i class="icon-arrow-up16"></i> Export data</a> </li>
                                                    <li><a href="#"><i class="icon-stats-growth2"></i> Create report</a> </li>
                                                    <li><a href="#"><i class="icon-bin"></i> Delete</a> </li>
                                                </ul>
                                            </div></td>
                                    </tr>
                                    <!--=======================-->
                                    <tr>
                                        <td><div class="media-left media-middle"> <a class="icons s32" href="#"><img src="{{ URL::asset('assets/images/media_img3.jpg') }}" class="img-circle img-xs br5" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class=""><a href="#" class="text-default text-semibold">Delano</a> </div>
                                                <div class="text-muted text-size-small">Really cool product!</div>
                                            </div></td>


                                        <td>
                                            <div class="media-left text-right">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold dark">4.1</a></div>
                                                <div class="text-muted text-size-small">Positive</div>

                                            </div>
                                            <div class="media-left media-middle brig pr10"> <a class="icons s28" href="#"><img src="{{ URL::asset('assets/images/smiley_green.png') }}" class="img-circle img-xs" alt=""></a> </div>
                                        </td>



                                        <td><div class="media-left text-right">
                                                <div class=""><a href="#" class="text-default text-semibold">13 May 2018</a> </div>
                                                <div class="text-muted text-size-small">02:51PM</div>
                                            </div></td>
                                        <td>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">58</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle over50 green cp55"> <span>10%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">156</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle  yellow cp33"> <span>33%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">87</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle over50 red cp66"> <span>66%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">56</a> </div></td>


                                        <td>
                                            <div class="media-left text-right">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold dark">4.5</a></div>
                                                <div class="text-muted text-size-small">Luella Burke</div>
                                            </div>
                                            <div class="media-left media-middle brig pr10"> <a class="icons s28" href="#"><img src="{{ URL::asset('assets/images/smiley_green.png') }}" class="img-circle img-xs" alt=""></a> </div>
                                        </td>


                                        <td class="text-center"><label class="custom-form-switch">
                                                <input class="field" type="checkbox" >
                                                <span class="toggle"></span> </label>
                                            <div class="tdropdown ml10"> <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="{{ URL::asset('assets/images/more.svg') }}"></a>
                                                <ul class="dropdown-menu dropdown-menu-right more_act">
                                                    <a href="#" class="dropdown_close">X</a>
                                                    <li><a href="#"><i class="icon-arrow-down16"></i> Import contacts</a> </li>
                                                    <li><a href="#"><i class="icon-arrow-up16"></i> Export data</a> </li>
                                                    <li><a href="#"><i class="icon-stats-growth2"></i> Create report</a> </li>
                                                    <li><a href="#"><i class="icon-bin"></i> Delete</a> </li>
                                                </ul>
                                            </div></td>
                                    </tr>
                                    <!--=======================-->
                                    <tr>
                                        <td><div class="media-left media-middle"> <a class="icons s32" href="#"><img src="{{ URL::asset('assets/images/media_img4.jpg') }}" class="img-circle img-xs br5" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class=""><a href="#" class="text-default text-semibold">Mandalay Bay</a> </div>
                                                <div class="text-muted text-size-small">Really cool product!</div>
                                            </div></td>


                                        <td>
                                            <div class="media-left text-right">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold dark">4.1</a></div>
                                                <div class="text-muted text-size-small">Positive</div>
                                            </div>
                                            <div class="media-left media-middle brig pr10"> <a class="icons s28" href="#"><img src="{{ URL::asset('assets/images/smiley_green.png') }}" class="img-circle img-xs" alt=""></a> </div>
                                        </td>



                                        <td><div class="media-left text-right">
                                                <div class=""><a href="#" class="text-default text-semibold">13 May 2018</a> </div>
                                                <div class="text-muted text-size-small">02:51PM</div>
                                            </div></td>
                                        <td>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">58</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle over50 green cp55"> <span>10%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">156</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle  yellow cp33"> <span>33%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">87</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle over50 red cp66"> <span>66%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">56</a> </div></td>


                                        <td>
                                            <div class="media-left text-right">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold dark">4.5</a></div>
                                                <div class="text-muted text-size-small">Luella Burke</div>
                                            </div>
                                            <div class="media-left media-middle brig pr10"> <a class="icons s28" href="#"><img src="{{ URL::asset('assets/images/smiley_green.png') }}" class="img-circle img-xs" alt=""></a> </div>
                                        </td>


                                        <td class="text-center"><label class="custom-form-switch">
                                                <input class="field" type="checkbox" checked="">
                                                <span class="toggle"></span> </label>
                                            <div class="tdropdown ml10"> <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="{{ URL::asset('assets/images/more.svg') }}"></a>
                                                <ul class="dropdown-menu dropdown-menu-right more_act">
                                                    <a href="#" class="dropdown_close">X</a>
                                                    <li><a href="#"><i class="icon-arrow-down16"></i> Import contacts</a> </li>
                                                    <li><a href="#"><i class="icon-arrow-up16"></i> Export data</a> </li>
                                                    <li><a href="#"><i class="icon-stats-growth2"></i> Create report</a> </li>
                                                    <li><a href="#"><i class="icon-bin"></i> Delete</a> </li>
                                                </ul>
                                            </div></td>
                                    </tr>
                                    <!--=======================-->
                                    <tr>
                                        <td><div class="media-left media-middle"> <a class="icons s32" href="#"><img src="{{ URL::asset('assets/images/media_img4.jpg') }}" class="img-circle img-xs br5" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class=""><a href="#" class="text-default text-semibold">Ambassador City Jomtien</a> </div>
                                                <div class="text-muted text-size-small">Really cool product!</div>
                                            </div></td>


                                        <td>
                                            <div class="media-left text-right">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold dark">4.1</a></div>
                                                <div class="text-muted text-size-small">Positive</div>
                                            </div>
                                            <div class="media-left media-middle brig pr10"> <a class="icons s28" href="#"><img src="{{ URL::asset('assets/images/smiley_green.png') }}" class="img-circle img-xs" alt=""></a> </div>
                                        </td>



                                        <td><div class="media-left text-right">
                                                <div class=""><a href="#" class="text-default text-semibold">13 May 2018</a> </div>
                                                <div class="text-muted text-size-small">02:51PM</div>
                                            </div></td>
                                        <td>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">58</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle over50 green cp55"> <span>10%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">156</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle  yellow cp33"> <span>33%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">87</a> </div></td>
                                        <td><div class="media-left">
                                                <div class="progress-circle over50 red cp66"> <span>66%</span>
                                                    <div class="left-half-clipper">
                                                        <div class="first50-bar"></div>
                                                        <div class="value-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-left"> <a href="#" target="_blank" class="text-default text-semibold">56</a> </div></td>


                                        <td>
                                            <div class="media-left text-right">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold dark">4.5</a></div>
                                                <div class="text-muted text-size-small">Luella Burke</div>
                                            </div>
                                            <div class="media-left media-middle brig pr10"> <a class="icons s28" href="#"><img src="{{ URL::asset('assets/images/smiley_green.png') }}" class="img-circle img-xs" alt=""></a> </div>
                                        </td>


                                        <td class="text-center"><label class="custom-form-switch">
                                                <input class="field" type="checkbox" >
                                                <span class="toggle"></span> </label>
                                            <div class="tdropdown ml10"> <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="{{ URL::asset('assets/images/more.svg') }}"></a>
                                                <ul class="dropdown-menu dropdown-menu-right more_act">
                                                    <a href="#" class="dropdown_close">X</a>
                                                    <li><a href="#"><i class="icon-arrow-down16"></i> Import contacts</a> </li>
                                                    <li><a href="#"><i class="icon-arrow-up16"></i> Export data</a> </li>
                                                    <li><a href="#"><i class="icon-stats-growth2"></i> Create report</a> </li>
                                                    <li><a href="#"><i class="icon-bin"></i> Delete</a> </li>
                                                </ul>
                                            </div></td>
                                    </tr>


                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================================= CONTENT AFTER TAB===============================-->

</div>
{{--<script>

    Morris.Area({
        element: 'myfirstchart',
        parseTime: false,

        data: [
            {y: '01', a: 1},
            {y: '02', a: 8},
            {y: '03', a: 5},
            {y: '04', a: 12},
            {y: '05', a: 10},
            {y: '06', a: 18},
            {y: '07', a: 17},
            {y: '08', a: 12},
            {y: '09', a: 21},
            {y: '10', a: 23},
            {y: '11', a: 20},
            {y: '12', a: 25},
            {y: '13', a: 22},
            {y: '14', a: 23},
            {y: '15', a: 24},
            {y: '16', a: 25},
            {y: '17', a: 27},
            {y: '18', a: 23},
            {y: '19', a: 27},
            {y: '20', a: 29},
            {y: '21', a: 31},
            {y: '22', a: 35},
            {y: '23', a: 30},
            {y: '24', a: 35},
            {y: '25', a: 36},
            {y: '26', a: 38},
            {y: '27', a: 39},
            {y: '28', a: 42},
            {y: '29', a: 48},
            {y: '30', a: 55},
            {y: '31', a: 60}
        ],

        xkey: 'y',
        ykeys: ['a'],
        labels: ['Total'],
        pointSize: 0,
        lineWidth: 2,
        padding: 0,
        fillOpacity: 0.3,
        hideHover: 'auto',
        behaveLikeLine: true,
        resize: true,
        pointFillColors: ['#ffffff'],
        pointStrokeColors: ['black'],
        lineColors: ['#9b83ff', '#0c265a'],

    });





    Highcharts.chart('column_graph', {
        chart: {
            type: 'column',
            backgroundColor: 'rgba(0, 0, 0, 0)',
        },
        title: {
            text: null
        },
        subtitle: {
            text: null
        },
        xAxis: {
            type: 'category',
            labels: {

                style: {
                    fontSize: '10px',
                    fontFamily: 'Verdana, sans-serif',

                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: null
            }
        },
        legend: {
            enabled: false
        },

        plotOptions: {
            column: {
                pointPadding: 0.20,
                borderWidth: 0,
                borderRadius: 3
            }
        },

        colors: ['#6190fa', '#cae4d1'],
        tooltip: {
            pointFormat: '<b>{point.y:.1f}</b>'
        },
        series: [{
                showInLegend: false,
                name: 'Time',
                data: [
                    ['1', 14.2],
                    ['2', 3.8],
                    ['3', 2.9],
                    ['4', 16.7],
                    ['5', 9.1],
                    ['6', 18.7],
                    ['7', 15.4],
                    ['9', 14.2],
                    ['10', 3.8],
                    ['11', 2.9],
                    ['12', 16.7],
                    ['13', 9.1],
                    ['14', 14.2],
                    ['15', 3.8],
                    ['16', 2.9],
                    ['17', 16.7],
                    ['18', 9.1],
                    ['19', 18.7],
                    ['20', 15.4],
                    ['21', 14.2],
                    ['22', 3.8],
                    ['23', 2.9],
                    ['24', 16.7],
                    ['25', 9.1],
                    ['26', 15.4],
                    ['27', 14.2],
                    ['28', 3.8],
                    ['29', 2.9],
                    ['30', 16.7],
                    ['31', 9.1]
                ],

            }]
    });



</script>--}}



@endsection

